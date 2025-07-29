<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />

<script type="text/javascript">
  jQuery(document).ready(function(){
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});});
  </script>

<?
session_start();
$pd=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='1'"));
if (isset($_POST[submit1])) {
echo "";
echo "<form method=post>
<table>
<tr><td valign=top>ISI Pesan</td><td valign=top>:</td><td><textarea rows=5 cols=60 wrap=physical name=pesan {font-family:Helvetica Neue, Helvetica, sans-serif; }></textarea></td></tr>
</table>
<input type=submit name=submit2 class=swn_button_blue value='Kirim Pesan WA Ke Pendonor'>
<a href=pmip2d2s.php?module=wa_donor_instansi class=swn_button_red>Batal</a>
";
echo "<table>";
	 $q_utd	= mysql_query("select id from utd where aktif='1'");			
	 $utd	= mysql_fetch_assoc($q_utd);
$search=" WHERE Kode like '$utd[id]%' and LENGTH(telp2)>8 and tglkembali<=CURRENT_DATE() and Cekal='0'";
if ($_POST[tgl]!='' and $_POST[tgl1]!='') $search=" WHERE Kode like '$utd[id]%' and LENGTH(telp2)>8 and CAST(tglkembali as date)>='$_POST[tgl]' and CAST(tglkembali as date)<='$_POST[tgl1]'  and Cekal='0' ";
if ($_POST[gol_darah]!='semua') $search.=" AND GolDarah='$_POST[gol_darah]' ";
if ($_POST[rhesus]!='semua') $search.=" AND Rhesus='$_POST[rhesus]' ";
if ($_POST[alamat]!='') $search.=" AND alamat like '%$_POST[alamat]%' ";
if ($_POST[instansi]!='') $search.=" AND Instansi='$_POST[instansi]' ";


echo "<tr><td>|</td><td>No.</td><td>|</td>
	  <td>Nama Pendonor</td><td>|</td>
	  <td>Gol Darah</td>|</td>
	  <td>|</td><td>Alamat</td>
	  <td>|</td><td>No. Handphone</td><td>|</td>
	  <td>Tgl Kembali Donor</td><td>|</td>
      </tr>";
echo " ";
$pd=mysql_query("select htransaksi.KodePendonor,htransaksi.Instansi,pendonor.nama,pendonor.GolDarah,pendonor.rhesus,pendonor.alamat,pendonor.Jk,pendonor.Status,pendonor.telp2 
,concat(DATE_FORMAT(pendonor.tglkembali,'%e '),ELT( MONTH(pendonor.tglkembali), 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),DATE_FORMAT(pendonor.tglkembali,' %Y')) as tgl
from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor where htransaksi.Instansi='$_POST[instansi]' and pendonor.Kode like '$utd[id]%' and LENGTH(pendonor.telp2)>8 and pendonor.Cekal='0' and CAST(pendonor.tglkembali as date)<='$_POST[tgl]' ");

$no=0;
while ($pd1=mysql_fetch_assoc($pd)) {
	if ($pd1[Jk]=='0' and $pd1[Status]=='1') $sapa='Bpk';
	if ($pd1[Jk]=='0' and $pd1[Status]=='0') $sapa='Sdr';
	if ($pd1[Jk]=='1' and $pd1[Status]=='1') $sapa='Ibu';
	if ($pd1[Jk]=='1' and $pd1[Status]=='0') $sapa='Sdri';
    $no++;
	if (strlen($pd1[telp2])>9) $telp=$pd1[telp2];
    echo "<tr>
	<td>|</td><td>$no</td>
	<td>|</td><td>$pd1[nama]</td>
	<td>|</td><td>$pd1[GolDarah]($pd1[rhesus])</td>
	<td>|</td><td>$pd1[alamat]</td>
	
	<td>|</td><td>$telp</td>
	<td>|</td><td>$pd1[tgl]</td>
	<td>|</td></tr>";
    echo "<input type=hidden name=pendonor[] value=$telp>";
    echo "<input type=hidden name=namadonor[] value='$sapa, $pd1[nama]'>";
}
echo "</table></form>";
} 
if (isset($_POST[submit2])) {
    echo "Mengirimkan sms broadcast Donor Kembali......";
    for ($i=0;$i<sizeof($_POST[pendonor]);$i++) {
        $pendonor=$_POST[pendonor][$i];
        $namanya=$_POST[namadonor][$i];
	
	//kirim wa 
	$kirim="insert into wagw.outbox (wa_mode,wa_no,wa_text) 
			values ('0','$pendonor','Yth. $namanya, $_POST[pesan]')";
	$kirim1=mysql_query($kirim);
	//

}

    if (($_SESSION[leveluser])=='p2d2s'){
    echo '<META http-equiv="refresh" content="2; url=../pmip2d2s.php?module=wa_donor_instansi">';
    } else {
    echo '<META http-equiv="refresh" content="2; url=../pmiadmin.php?module=wa_donor_instansi">';	
    }	
}
if (!isset($_POST[submit1]) and !isset($_POST[submit2])) {
?>
<h1>WhatsApp Broadcast Donor Instansi</h1>
<h2>Pendonor yang ditampilkan adalah pendonor yang sudah waktunya donor dan bukan pendonor cekal</h2>
<form method=post>
<table>
<tr><td>Tanggal Kegiatan</td><td>:
    <input type=text name=tgl id="datepicker" size=10> 
    </td></tr>

<tr><td>Masukkan Instansi:</td><td>:
    <input type='text' name="instansi" id='instansi'>
    </td></tr>

</table>
<input type=submit name=submit1 class=swn_button_blue value=Submit>
</form>
<? } ?>
