<!DOCTYPE html>
<html lang="en">
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet">
<style>
.bayangan {
    border:0.2px solid;
    padding: 1px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
}
</style>

<?php
include ('config/dbi_connect.php');
$td=mysqli_fetch_assoc(mysqli_query($dbi,"select id1 from tempat_donor where active='1'"));
$query = ("SELECT h.*,ic.*
                     FROM htransaksi h left join htransaksi_ic ic on ic.notrans=h.NoTrans
          where h.Status='0' and h.NoTrans like '$td[id1]%' and date(h.Tgl)>=current_date-7 and h.apheresis=1 and date(h.Tgl)<=current_date");
//0=baru, 1=med cheked, 2=aftap
$hasil = mysqli_query($dbi,$query);
?>
<body>
<div style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">DATA ANTRIAN PENDONOR APHERESIS</div>
    <table class="list bayangan" cellspacing=1 cellpadding=4 >
        <tr class="field" style="height:40px;">
            <th>No</th>
            <th>Tgl Daftar</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Usia</th>
            <th>Gol Darah</th>
            <th>Jenis Donor</th>
            <th>Donor Ulang/Baru</th>
            <th>Jenis Pengambilan</th>
            <th>Pasien</th>
            <th>Tgl Minta</th>
            <th>Rumah Sakit</th>
            <th>Titer</th>
            <th>IMLTD</th>
            <th>NAT</th>
            <th>Hematologi</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $no=0;
        while ($data = mysqli_fetch_assoc($hasil)){
            $no++;
            $data['KodePendonor']=str_replace("'","\'",$data['KodePendonor']);
            $query1 = mysqli_query($dbi,"SELECT * FROM pendonor where Kode='$data[KodePendonor]'");
            $hasil1 = mysqli_fetch_assoc($query1);
            $jenis_pemngambilan ='0';
            if ($data['apheresis']=='1'){$jenis_pemngambilan='1';}
            if ($data['donor_tpk']=='1'){$jenis_pemngambilan='2';}
            switch ($jenis_pemngambilan){
                case '0': $jenis_pemngambilan1='Donor Biasa';break;
                case '1': $jenis_pemngambilan1='Donor Apheresis';break;
                case '2': $jenis_pemngambilan1='Donor Plasma Konvalesen';break;
            }
            $dsdp=$data['JenisDonor'];if ($data['JenisDonor']=='1'){$dsdp='Donor Pengganti';}else{$dsdp='Donor Sukarela';}
            $brlm=$data['donorbaru'];    if ($data['donorbaru']=='1'){$brlm='Donor Ulang';}else{$brlm='Donor Baru';}
            echo '<tr class="record" style="height:30px;">';
            echo "
                <td class='text-right' nowrap>".$no."</td>
                <td nowrap>".$data['Tgl']."</td>
                <td align=left nowrap>";
                switch($jenis_pemngambilan){
                    case '0' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=checkup&NoTrans=".$data['NoTrans']." title='Klik untuk melanjutkan ke Medical Check Up DONOR BIASA'>".$hasil1['Nama']."</a>";break;
                    case '1' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=checkup_aph&kode=".$hasil1['Kode']."&tpk=0&trx=".$data['NoTrans']." title='Klik untuk melanjutkan ke Medical Check Up donor APHERESIS'>".$hasil1['Nama']."</a>";break;
                    case '2' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=checkup_aph&kode=".$hasil1['Kode']."&tpk=1&trx=".$data['NoTrans']." title='Klik untuk melanjutkan ke Medical Check Up donor APHERESIS PLASMA KONVALESEN'>".$hasil1['Nama']."</a>";break;
                }
            echo "</td>
                <td align=left nowrap>".$hasil1['Kode']."</td>
                <td nowrap>".$hasil1['umur']." Thn</td>
                <td class='text-center' nowrap>".$data['gol_darah'].$data['rhesus']."</td>
                <td nowrap>".$dsdp."</td>
                <td nowrap>".$brlm."</td>";
            if ($jenis_pemngambilan=='2'){
                echo "<td nowrap>".$jenis_pemngambilan1."</td>";
            }else{
                echo "<td nowrap align=left>".$jenis_pemngambilan1."</td>";
            }
            //cari Pasien
            $noform = $data['id_permintaan'];
            $pasien = mysqli_fetch_assoc(mysqli_query($dbi,"select htranspermintaan.*, pasien.nama, DATE_FORMAT(pasien.tgl_lahir, '%d-%m-%Y') as tgl_lahir, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin, dtranspermintaan.JenisDarah from htranspermintaan JOIN pasien ON htranspermintaan.no_rm = pasien.no_rm JOIN dtranspermintaan ON dtranspermintaan.NoForm = htranspermintaan.noform where htranspermintaan.noform ='$noform' limit 1"));
            
            $namars = $pasien['rs'];
            $rmhskt= mysqli_fetch_assoc(mysqli_query($dbi,"select NamaRs from rmhsakit where Kode='$namars' limit 1"));
            
            
            echo"
                <td align=left nowrap>".$pasien['nama']."</td>
                <td align=left nowrap>".$pasien['tglminta']."</td>
                <td align=left nowrap>".$rmhskt['NamaRs']."</td>
            </tr>";
        }
        ?>
    </tbody>
</table>
<br><div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2020-12-25</div>

