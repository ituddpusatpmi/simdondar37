<?php
include('../config/db_connect.php');
$sq0="SELECT kegiatan.NoTrans,
	date(kegiatan.TglPenjadwalan) as tglasli,
	date_format(kegiatan.TglPenjadwalan,'%w') as hari,
    date_format(kegiatan.TglPenjadwalan,'%d-%m-%y') as tanggal,
    date_format(kegiatan.jammulai,'%H:%i') as jam,
    kegiatan.jumlah as jumlah, kegiatan.lat as lat,
    kegiatan.lng as lng, detailinstansi.nama as nama, detailinstansi.alamat as alamat,
    kegiatan.dokter, kegiatan.sopir, kegiatan.admin, kegiatan.atd1, kegiatan.atd2, kegiatan.atd3  
    from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
    where cast(kegiatan.TglPenjadwalan as date)>=current_date
    ORDER BY kegiatan.TglPenjadwalan ASC";
$sq1="SELECT kegiatan.NoTrans,date(kegiatan.TglPenjadwalan) as tglasli,
    date_format(kegiatan.TglPenjadwalan,'%w') as hari,
    date_format(kegiatan.TglPenjadwalan,'%d-%m-%y') as tanggal,
    date_format(kegiatan.TglPenjadwalan,'%H:%i') as jam,
    kegiatan.jumlah as jumlah, kegiatan.lat as lat, kegiatan.lng as lng, detailinstansi.nama as nama, detailinstansi.alamat as alamat,
        kegiatan.dokter, kegiatan.sopir, kegiatan.admin, kegiatan.atd1, kegiatan.atd2, kegiatan.atd3 
    from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
    where (upper(detailinstansi.nama) like '%$_POST[fsrc]%' or
	upper(detailinstansi.alamat) like '%$_POST[fsrc]%') and date(kegiatan.TglPenjadwalan)>'2012-01-01' ORDER BY kegiatan.TglPenjadwalan ASC";

$sq=$sq1;
$aksi="Mencari data kegiatan MU dengan kata kunci : ".$_POST[fsrc];
$namahari="";
$today=date('Y-m-d');
if (!isset($_POST[fsrc]) || empty($_POST[fsrc])) {$sq=$sq0;$aksi="Melihat data kegiatan mobile unit.";}
$sql=mysql_query($sq);
//=======Audit Trial====================================================================================
$log_mdl ='SIMDONDAR';
$log_aksi=$aksi;
include_once "user_log_ekternal.php";
//=====================================================================================================

?>

<font size="3" color="red" face="Trebuchet MS"><b>UTD PMI PROVINSI BALI</b><BR></font>
	<form name=rekap method=post>
		<font size="2" color="red" face="Trebuchet MS">Cari tempat kegiatan<input type="text" name="fsrc" id="fsrc" size="30">
		<input type=submit name=submit value=Tampilkan>
	</form>
<table border=0 cellpadding=2 cellspacing=1>
    <tr bgcolor=#ED6161>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>NO</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>HARI</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>TANGGAL</b></font></td>
	
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>TEMPAT KEGIATAN</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>DOKTER</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>AFTAP</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>TENSI</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>HB</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>SOPIR</b></font></td>
	<td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>ADMIN</b></font></td>
    </tr>
<?
$sql=mysql_query($sq);
while($data=mysql_fetch_assoc($sql)){
    $no++;
	switch ($data[hari]){
		case '0':$hari="Minggu";break;
		case '1':$hari="Senin";break;
		case '2':$hari="Selasa";break;
		case '3':$hari="Rabu";break;
		case '4':$hari="Kamis";break;
		case '5':$hari="Jumat";break;
		case '6':$hari="Sabtu";break;
	}
    echo "<tr bgcolor=#FCC5C5>
		<td align=right><font size=2 face='Trebuchet MS'>$no.</font></td>
		<td align=left><font size=2 face='Trebuchet MS'>$hari</font></td>
		<td align=center nowrap><font size=2 face='Trebuchet MS'>$data[tanggal] $data[jam]</font></td>
		<td align=right><font size=2 face='Trebuchet MS'>$data[jumlah]</font></td>";
	if ($data[tglasli]>=$today){
	echo"<td align=left><font size=2 face='Trebuchet MS'><a href=http://map.google.com/?z=12&t=m&q=loc:$data[lat]+$data[lng] title='Perkiraan jumlah donor : $data[jumlah] orang. Klik untuk melihat lokasi kegiatan di Google Map' target=_blank>$data[nama]</a></font></td>";
	} else {echo"<td align=left><font size=2 face='Trebuchet MS'>$data[nama] $data[alamat]</a></font></td>";}
	echo"<td align=left nowrap><font size=2 face='Trebuchet MS'>$data[dokter]</font></td>";
	echo"<td align=left nowrap><font size=2 face='Trebuchet MS'>$data[atd3]</font></td>";
	echo"<td align=left nowrap><font size=2 face='Trebuchet MS'>$data[atd2]</font></td>";
	echo"<td align=left nowrap><font size=2 face='Trebuchet MS'>$data[atd1]</font></td>";
	echo"<td align=left nowrap><font size=2 face='Trebuchet MS'>$data[sopir]</font></td>";
	echo"<td align=left nowrap><font size=2 face='Trebuchet MS'>$data[admin]</font></td></tr>";
}
?>
</table>
