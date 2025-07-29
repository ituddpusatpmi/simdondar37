<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
 //-->
</style>
<?
$tangga =tgl_indo(date("Y-m-d"));
if ($_POST[tgl]!='') $tangga=tgl_indo($_POST[tgl]);

$tangga1 =tgl_indo(date("Y-m-d"));
if ($_POST[tgl1]!='') $tangga1=tgl_indo($_POST[tgl1]);

?>
<?
include ('../config/db_connect.php');
$sms=mysql_query("select SendingDateTime as jam,Destinationnumber as hp,Status,textdecoded from sms.sentitems where Destinationnumber!='' and status='SendingOK' and DATE_FORMAT( SendingDateTime, '%Y %m %d' ) = DATE_FORMAT( CURDATE( ) , '%Y %m %d')  order by jam ASC");

if (isset($_POST[submit])) { $sms=mysql_query("select SendingDateTime as jam,Destinationnumber as hp,Status,textdecoded from sms.sentitems where Destinationnumber!='' and status='SendingOK' and DATE_FORMAT( SendingDateTime, '%Y-%m-%d' ) >= '$_POST[tgl]' and DATE_FORMAT( SendingDateTime, '%Y-%m-%d' ) <= '$_POST[tgl1]' order by jam ASC");

}
$jml=$sms;
?>
<h1>Jumlah Rekap SMS Terkirim = <?=mysql_num_rows($jml)?>  SMS</h1>

<form method=post>
<table>
<tr><td>
Dari Tanggal </td><td>:</td><td>
<input type=text name=tgl id="datepicker" size=10 onChange="this.form.submit();">
<? echo "<b> $tangga </b>"; ?>
</td> <td>
Sampai dengan Tanggal</td> <td>:</td>
<td>
<input type=text name=tgl1 id="datepicker1" size=10 onChange="this.form.submit();">
<? echo "<b> $tangga1 </b>"; ?>
</td> <td>
	<input type=submit name=submit value="Submit"></td></tr>
</table>

<table border=1>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<th>No.</th><th>Jam</th><th>HP</th><th>Status</th><th>Pesan</th></tr>
<?

$no=0;
while ($sms1=mysql_fetch_assoc($sms)) {
$no++;
?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<?
echo "<td>$no</td><td>$sms1[jam]</td></td><td>$sms1[hp]</td><td>$sms1[Status]</td><td>$sms1[textdecoded]</td></tr>";

}
?>
</table>
