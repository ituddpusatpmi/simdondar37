<?php
include('config/db_connect.php');
$sq="SELECT kegiatan.NoTrans,
    date_format(kegiatan.TglPenjadwalan,'%d-%m-%y') as tanggal,
    date_format(kegiatan.TglPenjadwalan,'%H:%i') as jam,
    kegiatan.jumlah as jumlah,
    kegiatan.lat as lat,
    kegiatan.lng as lng,
    detailinstansi.nama as nama,
    detailinstansi.alamat as alamat
    from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
    where cast(kegiatan.TglPenjadwalan as date)>=current_date
    ORDER BY kegiatan.TglPenjadwalan ASC";
$sql=mysql_query($sq);
?>
<font size="3" color="red" face="Trebuchet MS"><b>UDD PMI PROVINSI BALI</b><BR></font>
<table border=0 cellpadding=2 cellspacing=1 width=475px>
    <tr bgcolor=#ED6161>
	   <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>NO</b></font></td>
	   <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>TANGGAL</b></font></td>
	   <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>JAM</b></font></td>
	   <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>TEMPAT KEGIATAN</b></font></td>
    </tr>
<?
$sql=mysql_query($sq);
while($data=mysql_fetch_assoc($sql)){
    $no++;
    echo "<tr bgcolor=#FCC5C5>
		<td align=right><font size=2 face='Trebuchet MS'>$no.</font></td>
		<td align=center><font size=2 face='Trebuchet MS'>$data[tanggal]</font></td>
		<td align=center><font size=2 face='Trebuchet MS'>$data[jam]</font></td>
		<td align=left><font size=2 face='Trebuchet MS'><a href=http://map.google.com/?z=12&t=m&q=loc:$data[lat]+$data[lng] title='Perkiraan jumlah donor : $data[jumlah] orang. Klik untuk melihat lokasi kegiatan di Google Map' target=_blank>$data[nama] $data[alamat]</a></font></td>
	</tr>";
}
?>
</table>

