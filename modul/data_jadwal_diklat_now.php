<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?php
include('clogin.php');
include('config/db_connect.php');
$today=date("Y-m-d");
$waktunya_donor=date("Y-m-d", strtotime("-3 month") );
$q_dr=mysql_query("select kodeinstansi,concat(DATE_FORMAT(TglPelaksanaan,'%e '),' ',ELT( MONTH(TglPelaksanaan), 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),' ',DATE_FORMAT(TglPelaksanaan,' %Y')) as tgll from kegiatandiklat where  cast(TglPelaksanaan as date)<='$waktunya_donor'");
?>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>No.</th><th>Tanggal</th><th>Instansi</th><th>Alamat</th><th>Kontak Person</th>
    </tr>
<?php
while($a_dr=mysql_fetch_assoc($q_dr)){
$cp=mysql_fetch_assoc(mysql_query("select * from detaildiklat where KodeDetail='$a_dr[kodeinstansi]'"));
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[tgll]."</td>".
            "<td>".$cp[nama]."</td>".
            "<td>".$cp[alamat]."</td>".
            "<td>".$cp[cp]."</td>";
    echo "</tr>";
}
?>
</table>
