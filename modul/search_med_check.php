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
    
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,1);
switch($td0){case 'M' :$nt="M";break;case 'S':$nt="D";break;default : $nt="";break;}
$td=mysqli_fetch_assoc(mysqli_query($dbi,"select id1 from tempat_donor where active='1'"));

//$query = ("SELECT * FROM htransaksi where Status='0' and NoTrans like '$nt%' and (date(Tgl)BETWEEN curdate()-INTERVAL 6 DAY AND curdate())");
$query = ("SELECT * FROM htransaksi where Status='0' and NoTrans like '$nt%' and (date(Tgl)BETWEEN curdate()-INTERVAL 6 DAY AND curdate())");//0=baru, 1=med cheked, 2=aftap
$hasil = mysqli_query($dbi,$query);
?>
<body>
<div style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">DATA ANTRIAN CHECK UP PENDONOR</div>
    <table class="list bayangan" cellspacing=1 cellpadding=4 >
        <tr class="field" style="height:40px;">
            <th>No</th>
            <th>Registrasi</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Tgl Lahir</th>
            <th>Gol Darah</th>
            <th>Jenis Donor</th>
            <th>Donor Ulang/Baru</th>
            <th>Jenis Pengambilan</th>
            <th>Aksi User</th>
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
                <td nowrap>".$data['NoTrans']."</td>
                 <!--td nowrap>".$data['NoTrans']."</td-->
                <td align=left nowrap>";
                switch($jenis_pemngambilan){
                    case '0' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=checkup&NoTrans=".$data['NoTrans']." title='Klik untuk melanjutkan ke Medical Check Up DONOR BIASA'>".$hasil1['Nama']."</a>";break;
                    case '1' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=checkup_aph&kode=".$hasil1['Kode']."&tpk=0&trx=".$data['NoTrans']." title='Klik untuk melanjutkan ke Medical Check Up donor APHERESIS'>".$hasil1['Nama']."</a>";break;
                    case '2' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=checkup_aph&kode=".$hasil1['Kode']."&tpk=1&trx=".$data['NoTrans']." title='Klik untuk melanjutkan ke Medical Check Up donor APHERESIS PLASMA KONVALESEN'>".$hasil1['Nama']."</a>";break;
                }
            echo "</td>
                <td align=left nowrap>".$hasil1['Kode']."</td>
                <td nowrap>".$hasil1['TglLhr']."</td>
                <td class='text-center' nowrap>".$data['gol_darah'].$data['rhesus']."</td>
                <td nowrap>".$dsdp."</td>
                <td nowrap>".$brlm."</td>";
            if ($jenis_pemngambilan=='2'){
                echo "<td nowrap>".$jenis_pemngambilan1."</td>";
            }else{
                echo "<td nowrap align=left>".$jenis_pemngambilan1."</td>";
            }
            
            echo"
            <td align=left nowrap>";
                switch($jenis_pemngambilan){
                    case '0' :echo "<a href=formulir_donor_PDF2.php?kp=".$data['KodePendonor']." title='Klik untuk cetak formulir'><input type='button' value='Formulir'></a>
                        <a href=pmi".$_SESSION['leveluser'].".php?module=inputpengambilansample&kode=".$data['KodePendonor']."&trans=".$data['NoTrans']." title='Klik untuk pengambilan sampel pendonor'><input type='button' value='Sampel'></a>
                        <a href=pmi".$_SESSION['leveluser'].".php?module=edit_transaksi_donor&Notrans=".$data['NoTrans']."&Kode=".$data['KodePendonor']." title='Klik untuk edit registrasi'><input type='button' value='Edit'></a>";break;
                    case '1' :echo "<a href=formulir_donor_PDF2.php?kp=".$data['KodePendonor']." title='Klik untuk cetak formulir'><input type='button' value='Formulir'></a>
                                    <a href=pmi".$_SESSION['leveluser'].".php?module=inputpengambilansample&kode=".$data['KodePendonor']."&trans=".$data['NoTrans']." title='Klik untuk pengambilan sampel Apheresis'><input type='button' value='Sampel'></a>
                                    <a href=pmi".$_SESSION['leveluser'].".php?module=edit_transaksi_donor&Notrans=".$data['NoTrans']."&Kode=".$data['KodePendonor']." title='Klik untuk edit registrasi'><input type='button' value='Edit'></a>";break;
                    case '2' :echo "<a href=formulir_donor_PDF2.php?kp=".$data['KodePendonor']." title='Klik untuk cetak formulir'><input type='button' value='Formulir'></a>
                                    <a href=pmi".$_SESSION['leveluser'].".php?module=inputpengambilansample&kode=".$data['KodePendonor']."&trans=".$data['NoTrans']." title='Klik untuk pengambilan sampel Plasma Konvalesen'><input type='button' value='Sampel'></a>
                                    <a href=pmi".$_SESSION['leveluser'].".php?module=edit_transaksi_donor&Notrans=".$data['NoTrans']."&Kode=".$data['KodePendonor']." title='Klik untuk edit registrasi'><input type='button' value='Edit'></a>";break;
                }
            echo "</td>
            </tr>";
        }
        ?>
    </tbody>
</table>
<br><div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2020-12-25</div>
