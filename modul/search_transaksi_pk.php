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
$td0=substr($td0,0,2);
$query = ("SELECT * FROM htransaksi where Status='1' and jumHB='1' and date(Tgl)>= current_date -7 and date(Tgl) <= current_date");
if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM htransaksi where NoTrans like '$td0%' and Status='1' and jumHB='1' ");
$hasil = mysqli_query($dbi,$query);
?>
<br><div style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">DATA ANTRIAN AFTAP (PENGAMBILAN DARAH)</div>
<table class="list bayangan" cellspacing=1 cellpadding=4 >
    <tr class="field" style="height:40px;">
        <td>No</td>
        <td>No Registrasi</td>
        <td>Nama Pendonor</td>
        <td>Kode Pendonor</td>
        <td>Tgl Lahir</td>
        <td>Gol Darah</td>
        <td>Jenis Donor</td>
        <td>Donor Ulang/Baru</td>
        <td>Jenis Pengambilan</td>
        <td>Tindakan</td>
        <td>Sampel</td>
    </tr>
    <?
    $no=0;
    while ($data = mysqli_fetch_assoc($hasil)){
        $no++;
        $jenis_pemngambilan ='0';
        if ($data['apheresis']=='1'){$jenis_pemngambilan='1';}
        if ($data['donor_tpk']=='1'){$jenis_pemngambilan='2';}
        switch ($jenis_pemngambilan){
            case '0': $jenis_pemngambilan1='Biasa';break;
            case '1': $jenis_pemngambilan1='Apheresis';break;
            case '2': $jenis_pemngambilan1='Plasma Konvalesen';break;
        }
        
        if ($data['JenisDonor']=='1'){$dsdp='Pengganti';}else{$dsdp='Sukarela';}
        if ($data['donorbaru']=='1'){$lmbr='Ulang';}else{$lmbr='Baru';}
        $data['KodePendonor']=str_replace("'","\'",$data['KodePendonor']);
        $query1 = mysqli_query($dbi,"SELECT * FROM pendonor where Kode='$data[KodePendonor]'");
        $hasil1 = mysqli_fetch_array($query1);
        echo "
            <tr class='record' style='height:30px;'>
                <td>".$no."</td>
                <td>".$data['NoTrans']."</td>
                <td align=left nowrap>";
                    switch($jenis_pemngambilan){
                        case '0' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=pengambilan&NoTrans=".$data['NoTrans']." title='Klik untuk melanjutkan ke pengambilan DONOR BIASA'>".$hasil1['Nama']."</a>";break;
                        case '1' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=pengambilan_apheresis&tpk=0&NoTrans=".$data['NoTrans']." title='Klik untuk melanjutkan ke pengambilan donor APHERESIS'>".$hasil1['Nama']."</a>";break;
                        case '2' :echo "<a href=pmi".$_SESSION['leveluser'].".php?module=pengambilan_apheresis&tpk=1&NoTrans=".$data['NoTrans']." title='Klik untuk melanjutkan ke pengambilan donor APHERESIS PLASMA KONVALESEN'>".$hasil1['Nama']."</a>";break;
                    }
        echo "  </td>
                <td align=left>".$hasil1['Kode']."</td>
                <td>".$hasil1['TglLhr']."</td>
                <td>".$data['gol_darah'].$data['rhesus']."</td>
                <td>".$dsdp."</td>
                <td>".$lmbr."</td>
                <td align=left>".$jenis_pemngambilan1."</td>
                <td><a href=pmi".$_SESSION['leveluser'].".php?module=deltransaksi&NoTrans=".$data['NoTrans']." title='Batalkan transaksi pengambilan'>Batalkan</a></td>
                <td>".$data['id_sample']."</td>
            </tr>";
    }
echo "</table>";
?>
<br><div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2020-12-25</div>

