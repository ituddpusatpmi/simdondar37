<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
?>

<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>

</script>
<?
//include('../clogin.php');
include('../config/db_connect.php');
$namauser=$_SESSION[namauser];
$IdBrg=$_GET[ID];
if (isset($_POST[submit])) {
	$kode=strtoupper($_POST[kode]);
	$tgl=$_POST[tgl];
	$uraian=$_POST[uraian];
	$status=$_POST[status];
	$petugas=$_POST[petugas];
	$tempat=$_POST[tempat];
        if ($kode!=="") {
		$tambah=mysql_query("insert into logbook_d (kode, tgl , uraian, status, petugas)
		values ('$kode','$tgl','$uraian','$status','$petugas')");
		$tambah1=mysql_query("UPDATE logbook_h
		SET status='$status'  WHERE kode='$kode'");
	//=======Audit Trial====================================================================================
	$log_mdl ='LOGBOOK';
	$log_aksi='Input Aksi Logbook Kode: '.$kode.' Uraian: '.$uraian.' status: '.$status;
	include_once "user_log.php";
	//=====================================================================================================

			if ($tambah) {
		        echo "Transaksi Logbook telah berhasil <script>parent.$.fn.colorbox.close();</script>";
			?><META http-equiv="refresh" content="1; url=pmiqc.php?module=entry_aksilogbook"><?
			} else {
			echo "Data Barang gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
			?><META http-equiv="refresh" content="1; url=pmiqc.php?module=entry_aksilogbook"><?
				}
			}
			  }
?>
	<form name="barang" method="POST" action="<?=$PHPSELF?>">
	<h1>Entry Aktivitas Log Book</h1>
	<div>
	<table border="0">
<tr valign="top">
<td>
	<table class="form" border="2">
	<tr> 	<td>Kode Barang</td>
		<td class="input">
		<input type="text" name="kode" value="<?=$IdBrg?>"></td>
			</td>
	</tr>

	<tr>
		<td>Tgl</td>
		<td class="input"> <input type="text" name="tgl" id="datepicker" placeholder="yyyy-mm-dd" size=11></td>
		</tr>

	<tr> 	<td>Uraian</td>
		<td class="input"><textarea maxlenght="100"  rows="5" cols="57" wrap="physical" name=uraian {font-family:"Helvetica Neue", Helvetica, sans-serif; }></textarea></td>
		</tr>

	<tr>
		<td>Status (Keadaan)</td>
		<td class="input">		
			<select name="status">
		        <option value="0">Rusak</option>
		        <option value="1">Baik</option>
		        <option value="2">Dalam Proses Kalibrasi</option>
		        <option value="3">Dalam Proses Perawatan</option>
			<option value="4">Dimusnahkan</option>			
		        </select></td>
		</tr>
       
		<tr>
			<td>Petugas</td>
			<td class="input">
			<select name="petugas" >
				<option value="" selected></option>
				<?php
				$q="select * from user where level='admin' OR level='QC' order by nama_lengkap";
				$do=mysql_query($q,$con);
				while($data=mysql_fetch_assoc($do)){
				$select="";
				 ?>
				<option value="<?=$data[nama_lengkap]?>"<?=$select?>><?=$data[nama_lengkap]?>
				</option>
				 <?}?>
			</select>
			</td>
		</tr>
</table></div>
<div>
	</td><td align="center"> 
		<table bgcolor="#000012" cellspacing="1" cellpadding="3">	
			<tr bgcolor="#FF1000">
				<th colspan=4 color="#DDDDDD"><b>HISTORY PERALATAN</b></th>
				
			</tr>
		</table>

		<table class="list" border=1 cellspacing=1 cellpadding=3 style="border-collapse:collapse">
		   <tr class="field">
		     <td>No</td>
		     <td>Tanggal</td>
		     <td>Uraian</td>
		     <td>Status</td>
		     <td>Petugas</td>
		    </tr>
		  <?
		  $no=0;
		  $sqllbk=mysql_query("select logbook_d.tgl, logbook_d.uraian, logbook_d.petugas, logbook_d.status, logbook_h.tempat, DATE_FORMAT(logbook_d.tgl, '%d %M %Y') as tanggal from logbook_d inner join logbook_h on logbook_d.kode=logbook_h.kode where logbook_h.kode='$IdBrg' order by tgl DESC");
		   while ($dtrans = mysql_fetch_assoc($sqllbk)){
			  $no++;
			  $pesan='';
			  if ($dtrans['status']=='0') {$pesan = 'Rusak';}
			  if ($dtrans['status']=='1') {$pesan = 'Baik';}
			  if ($dtrans['status']=='2') {$pesan = 'Dalam Proses Kalibrasi';}
			  if ($dtrans['status']=='3') {$pesan = 'Dalam Proses Perawatan';}
			  if ($dtrans['status']=='4') {$pesan = 'Dimusnahkan';}
			  ?>
			  	<tr>
			  	<td><?=$no?></td>
				<td><?=$dtrans[tanggal]?></td>
				<td><?=$dtrans[uraian]?></td>
				<td><?=$pesan?></td>
				<td><?=$dtrans[petugas]?></td>
			      </tr>
			<?}?>
	
			  </table>
			
	</td></tr>
</table></div>
	<input name="submit" type="submit" value="Simpan Data">
</form>
