<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript">
	function setFocus(){document.kantong.nokantong.focus();}
</script>
</head>
<?

require_once('config/dbi_connect.php');
require_once('clogin.php');
$namauser=$_SESSION['namauser'];
$lv0=$_SESSION['leveluser'];
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$namaudd=$q_udd['nama'];
$kodependonor=$_GET['kode'];
$notrans=$_GET['trans'];

if (isset($_POST['simpan'])) { 
		$v_tgl		= $_POST['tgl'];
		$v_kodependonor =$_POST['pendonor'];
		$v_volume	= $_POST['vol'];
		$v_tempat	= $_POST['tempat'];
		$v_rhesus	= $_POST['rh'];
		$v_goldarah	= $_POST['golda'];
		$v_hasil	= $_POST['hasil'];
		$v_ket		= $_POST['ket'];
		$v_kodesample = $_POST['kodesample'];
		$v_petugas	= $_POST['petugas'];
		$v_penanggungjawab= $_POST['sah'];
		$sql="UPDATE samplekode SET sk_donor='$v_kodependonor', sk_tgl_plebotomi=now() ,sk_vol_plebotomi='$v_volume',sk_tmp_plebotomi='$v_tempat',sk_rh='$v_rhesus',sk_gol='$v_goldarah',sk_hasilrapid='$v_hasil',sk_ptg_plebotomi='$v_petugas',sk_pj_plebotomi='$v_penanggungjawab',sk_notrans='$notrans' WHERE sk_kode='$v_kodesample'";
		$update=mysqli_query($dbi,$sql);
        echo "DATA SUDAH TERSIMPAN";
        echo '<META http-equiv="refresh" content="2; url=pmi'.$lv0.'.php?module=check">';
		} 

	$today=date('Y-m-d');
	$qdnr=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `NoKTP`, `Pekerjaan`,`TempatLhr`, `jumDonor`, CONCAT_WS(',', `telp2`,`telp` ) AS `tlp`,`Kode`,`Nama`,`Alamat`, case when `Jk`='0' THEN 'Laki-laki' ELSE 'Perempuan' END AS Kelamin,`GolDarah`,`Rhesus`,DATE_FORMAT(TglLhr, '%d-%m-%Y') as tgllahir  FROM `pendonor` WHERE `Kode` = '$kodependonor'"));
    ?>
	<body onLoad=setFocus()>
    <div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Pengambilan Sample Donor</div>
	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table style="border:0px solid brown;" cellpadding="1" cellspacing="5">
			<tr>
				<td style="vertical-align: top;">
					<table cellpadding="10" cellspacing="1" style="border: 1px solid brown;" class="form bayangan">
						<tr><td colspan="2"><strong>DATA PENDONOR</strong></td></tr>
						<tr><td>Kode Pendonor</td><td class="input"><input type="hidden" name="pendonor" value="<?php echo $qdnr['Kode'];?>"><?php echo $qdnr['Kode'];?></tr>
                        <tr><td>No. Transaksi</td><td class="input"><input type="hidden" name="trans" value="<?php echo $trans;?>"><?php echo $notrans;?></tr>
						<tr><td>Nama</td><td class="input" style="white-space:nowrap;font-size:150%;"><?php echo $qdnr['Nama'];?></tr>
						<tr><td>Gol Darah</td><td class="input" style="white-space:nowrap;font-size:150%;"><?php echo $qdnr['GolDarah'].$qdnr['Rhesus'];?><input type="hidden" name="golda" value="<?php echo $qdnr['GolDarah'];?>"><input type="hidden" name="rh" value="<?php echo $qdnr['Rhesus'];?>"></td></tr>
						<tr><td>Lahir</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['TempatLhr'].', '.$qdnr['tgllahir'];?></td></tr>
						<tr><td>Kelamin</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['Kelamin'];?></td></tr>
						<tr><td>Telp</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['tlp'];?></td></tr>
						<tr><td>Alamat</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['Alamat'];?></td></tr>
						<tr><td>Donasi</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['jumDonor'].'Kali';?></td></tr>
					</table>
					
					
				</td>
				<td style="vertical-align: top;">
					<table cellpadding="4" cellspacing="1" style="border: 1px solid brown;" class="form bayangan">
						
							<td>Nomor Sample</td>    
							<td class="input"><input type="text" name="kodesample" required style="width:6cm;"></td>
							</tr>
						<tr>
							<td>Volume Sample (cc)</td>    
							<td class="input"><input type="text" name="vol" required style="width:1cm ;"></td>
						</tr>
						<tr>
							<td>Nama Petugas </td> 
							<td class="input">
							<select name="petugas">
							  <?
							  $dokter="select * from user order by nama_lengkap";
							  $do=mysql_query($dokter);
							  while($data=mysql_fetch_array($do)){					
							  if ($data[id_user] == $data_combo[petugas3]){
					 echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
					  }else{
					  echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
					  }
						  ?>
							  <? } ?>
							  <option value="--">-</option>
								</select>
							</td>
					</tr>
					<tr>
							</tr>
						<tr>
							<td>Tanggal Pengambilan Sample</td>           
							<td class="input"><input type="text" name="tgl" id="datepicker" value ="<?php echo $today;?>" placeholder="yyyy-mm-dd" required style="width:2.5cm;"></td>
						</tr>
						<tr>
							<td>Tempat Pengambilan Sample</td>    
							<td class="input"><input type="text" name="tempat" required style="width:8cm;"></td>
						</tr>
						<tr>
							<td>Penanggung Jawab</td>    
							<td class="input"> <select name="sah" > <?
							      $user="select * from dokter_periksa";
					                       $do=mysql_query($user);
								      while($data=mysql_fetch_assoc($do)) {
									      $select=""; ?>
									      <option value="<?=$data[Nama]?>"<?=$select?>>
									      <?=$data[Nama]?>
									      </option>
							      <? } ?>
						      </select>
						     </td>
							</tr>
						<tr>
							<td>Hasil Pemeriksaan Awal</td>    
							<td class="input">
							<select name="hasil" style="width:5cm;">
								<option value="-">-</option>
								<option value="Positif">Positif</option>
								<option value="Negatif">Negatif</option>
							</select>
							</td>
						</tr>
						</table>
					<table style="border:0px solid brown;" cellpadding="1" cellspacing="5">
						<tr></td><input name="simpan" type="submit" value="Simpan" class="swn_button_blue">
						<div style="font-size: 10px;color: #000000">Update 2020-12-24</div>
						</td></tr>
					</table>
				
				</td>
			</tr>
        
</form>


<style>
	.bayangan {
		border:0.2px solid red;
		padding: 1px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
	}
</style>
