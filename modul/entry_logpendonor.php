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
$IdBrg=$_GET[Kode];
$nama=$_GET[nama];
if (isset($_POST[submit])) {
	$kode=strtoupper($_POST[kode]);
	$tgl=$_POST[tgl];
	$uraian=$_POST[uraian];
	$status=$_POST[catatan];
	$petugas=$_POST[user];
	$tempat=$_POST[tempat];
        if ($kode!=="") {
		$tambah=mysql_query("insert into pendonor_log (Kode, tgl , uraian, catatan, petugas)
		values ('$kode','$tgl','$uraian','$status','$petugas')");

	//=======Audit Trial====================================================================================
	$log_mdl ='LOGBOOK';
	$log_aksi='Input Log Pendonor: '.$nama.' Catatan: '.$uraian;
	include_once "user_log.php";
	//=====================================================================================================

			if ($tambah) {
		        echo "Transaksi Logbook telah berhasil <script>parent.$.fn.colorbox.close();</script>";
			?><META http-equiv="refresh" content="1; url=pmip2d2s.php?module=logpendonor&Kode=<?=$IdBrg?>&nama=<?=$nama?>"><?
			} else {
			echo "Data Log Pendonor gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
			?><META http-equiv="refresh" content="1; url=pmip2d2s.php?module=logpendonor&Kode=<?=$IdBrg?>&nama=<?=$nama?>""><?
				}
			}
			  }
?>
	<form name="barang" method="POST" action="<?=$PHPSELF?>">
	<h1 align="center">DATA CATATAN PENDONOR</h1><p>
	<div>

	<table halign="top" border="0" width="100%">
<tr>
<td>
	<table class="form" border="2">
	<tr> 	<td>Kode Pendonor</td>
		<td class="input">
		<input type="hidden" name="kode" value="<?=$IdBrg?>"><?=$IdBrg?></td>
			</td>
	</tr>
	<tr> 	<td>Nama Pendonor</td>
		<td class="input">
		<input type="hidden" name="nama" value="<?=$nama?>"><?=$nama?></td>
		<input type="hidden" name="user" value="<?=$_SESSION['namauser']?>">
		
			</td>
	</tr>

	<tr>
		<td>Tgl</td>
		<td class="input"> <input type="text" name="tgl" id="datepicker" placeholder="yyyy-mm-dd" size=11 value="<?=date('Y-m-d')?>"></td>
		</tr>
	<tr>
		<td>Catatan</td>
		<td class="input">		
			<select name="catatan">
		        <option value="1">Piagam DDS 10x</option>
		        <option value="2">Piagam DDS 15x</option>
		        <option value="3">Piagam DDS 25x</option>
			<option value="4">Piagam DDS 50x</option>
			<option value="5">Piagam DDS 75x</option>
			<option value="6">Piagam DDS 100x</option>
			<option value="7">Souvenir Donor</option>
			<option value="8">Pembenahan Data</option>			
		        </select></td>
		</tr>

	<tr> 	<td>Uraian</td>
		<td class="input"><textarea maxlenght="100"  rows="5" cols="57" wrap="physical" name=uraian {font-family:"Helvetica Neue", Helvetica, sans-serif; } required></textarea></td>
		</tr>
	<tr><td height=50 colspan=2><input name="submit" type="submit" value="Tambah Data">

	</table>
</td>

	<td align=top> 
		<table bgcolor="#000012" cellspacing="1" cellpadding="3">	
			<tr bgcolor="#ede9e8">
				<th colspan=4 color="#DDDDDD"><b>HISTORY CATATAN PENDONOR</b></th>
				
			</tr>
		</table>

		<table class="list" border=1 cellspacing=1 cellpadding=3 style="border-collapse:collapse">
		   <tr class="field">
		     <td>No</td>
		     <td>Tanggal</td>
		     <td>Catatan</td>
		     <td>Uraian</td>
		     <td>Petugas</td>
		     <td>Aksi</td>

		    </tr>
		  <?
		  $no=0;
		  $sqllbk=mysql_query("select pendonor_log.id, pendonor_log.Kode, pendonor_log.catatan, pendonor_log.uraian, pendonor_log.petugas, DATE_FORMAT(pendonor_log.tgl, '%d %M %Y') as tanggal from pendonor_log where Kode='$IdBrg' order by tgl DESC");
		   while ($dtrans = mysql_fetch_assoc($sqllbk)){
			  $no++;
			  $pesan='';
			  if ($dtrans['catatan']=='1') {$pesan = 'Piagam DDS 10x';}
			  if ($dtrans['catatan']=='2') {$pesan = 'Piagam DDS 15x';}
			  if ($dtrans['catatan']=='3') {$pesan = 'Piagam DDS 25x';}
			  if ($dtrans['catatan']=='4') {$pesan = 'Piagam DDS 50x';}
			  if ($dtrans['catatan']=='5') {$pesan = 'Piagam DDS 75x';}
			  if ($dtrans['catatan']=='6') {$pesan = 'Piagam DDS 100x';}
			  if ($dtrans['catatan']=='7') {$pesan = 'Souvenir Donor';}
			  if ($dtrans['catatan']=='8') {$pesan = 'Pembenahan Data';}
			  ?>
			  	<tr>
			  	<td><?=$no?></td>
				<td><?=$dtrans[tanggal]?></td>
				<td><?=$pesan?></td>
				<td><?=$dtrans[uraian]?></td>
				<td><?=$dtrans[petugas]?></td>
				<? switch ($_SESSION[leveluser]){
	case "p2d2s":
            ?><td><form name="kirim" method="post" action="del_logpendonor.php?Kode=<? echo $dtrans['Kode'] ?>&id=<? echo $dtrans['id']?>&nama=<? echo $nama?>" target="_blank"><input type=submit name=submit4 value='Hapus'></form></td><?
            break;
        default:
            echo "Anda tidak memiliki hak akses";
    }?></td>
			      </tr>
			<?}?>
	
			  </table>
			
	</td></tr>
</table></div>
	
</form>
