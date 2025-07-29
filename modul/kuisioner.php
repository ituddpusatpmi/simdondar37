<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
//-->
</style>
<?
session_start();
include('clogin.php');
include('config/koneksiold.php');
?>
<?php
//$today=date('Y-m-01');
$today=date('Y-m-d');
$today1=date('Y-m-d');


if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
  
$quser="select nilai from kusioner group by nilai";
?>
<a name="atas"><br>
<h2 class="list">DATA KEPUASAN PELANGGAN</h2>

</a><a href="#bawah">Ke bawah</a><br>
<form namme=rekap method=post>
	<table border=1 cellpadding=5 cellspacing=2 width="100%">
	<tr>
	  <td>Tanggal : 
	  <input name="minta1" id="datepicker"  value="<?=$today?>" type=date> s/d
		<input name="minta2" id="datepicker1" value="<?=$today1?>" type=date>
	  </td>
	<td>  Nilai 	
	<select name="namauser"">
		<option value="">Semua</option>
		<option value="3">Sangat Puas</option>
		<option value="2">Puas</option>
		<option value="1">Tidak Puas</option>
	</select><br></td>

	<td><input type=submit name=submit value="Tampilkan"></td></tr></table>
</form>

<?
if (isset($_POST[submit])){

	$perbln=substr($_POST[minta1],5,2);
	$pertgl=substr($_POST[minta1],8,2);
	$perthn=substr($_POST[minta1],0,4);

	$perbln1=substr($_POST[minta2],5,2);
	$pertgl1=substr($_POST[minta2],8,2);
	$perthn1=substr($_POST[minta2],0,4);
    $user_src=$_POST['namauser'];
?>


<?  	
    $data=mysql_query("select date(date) as Tanggal,TIME(date) as Jam, CASE nilai
			   WHEN 3 THEN 'SANGAT PUAS'
			   WHEN 2 THEN 'PUAS'
				 WHEN 1 THEN 'TIDAK PUAS'
			   ELSE nilai END AS Nilai,
				CASE keterangan
			   WHEN 1 THEN 'WAKTU PELAYANAN DONOR LAMBAT'
			   WHEN 2 THEN 'TIDAK ADA INFORMASI FASILITAS'
				 WHEN 3 THEN 'PETUGAS KURANG TERAMPIL'
				 WHEN 4 THEN 'SUASANA RUANGAN TUNGGU TIDAK NYAMAN'
			   WHEN 5 THEN 'PENANGANAN KOMPLAIN PETUGAS TIDAK BAIK'
				 WHEN 6 THEN 'PETUGAS TIDAK RAMAH KETIKA MENERIMA DONOR'
			   ELSE keterangan END AS Keterangan
				 from HASIL
		        where date(HASIL.date)>='$_POST[minta1]' and date(HASIL.date)<='$_POST[minta2]' and
			nilai like '%$user_src%'");
			 
		$data3=mysql_query("select count(HASIL.nilai) as SANGAT,
			(select count(HASIL.nilai)  from HASIL where (date(HASIL.date)>='$_POST[minta1]' and date(HASIL.date)<='$_POST[minta2]') AND nilai=2) as PUAS,
			(select count(HASIL.nilai)  from HASIL where (date(HASIL.date)>='$_POST[minta1]' and date(HASIL.date)<='$_POST[minta2]') AND nilai=1) as TIDAK
			from HASIL where nilai=3 AND
		         date(HASIL.date)>='$_POST[minta1]' and date(HASIL.date)<='$_POST[minta2]'");

?>
<table  cellpadding=3 cellspacing=1 width="100%">
	<tr class="field" style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:verdana;" 
	    onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align=center>NO.</td>
		<td align=center>TGL</td>
		<td align=center>JAM</td>
		<td align=center>NILAI</td>
        	<td align=center>KETERANGAN</td>

	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	    $no++;?>
	<tr class="record" style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align=right><?=number_format($no,0,".",".")?></td>
		<td align=left><?=$data1[Tanggal]?></td>
		<td align=left><?=$data1[Jam]?></td>
		<td align=left><?=$data1[Nilai]?></td>
        <td align=left  nowrap><?=$data1[Keterangan]?></td>
		
	</tr>
	<? } ?>
</table>

<br>
<table  cellpadding=3 cellspacing=1 >
	<tr class="field" style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:verdana;" 
	    onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align=center>SANGAT PUAS</td>
		<td align=center>PUAS</td>
		<td align=center>TIDAK PUAS</td>


	</tr>
	<?
	$no=0;
	while ($data4=mysql_fetch_assoc($data3)) { 
	    $no++;?>
	<tr class="record" style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align=right><?=$data4[SANGAT]?></td>
		<td align=right><?=$data4[PUAS]?></td>
		<td align=right><?=$data4[TIDAK]?></td>

		
	</tr>
	<? } ?>
</table>
<a href="#atas">Ke Atas</a>
	<a name="bawah"></a>
</form>
<?
}
?>
