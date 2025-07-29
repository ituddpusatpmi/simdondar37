

<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/instansi.js"></script>
			
<?
include ('config/db_connect.php');

//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= substr($idp1[id1],0,2).$tgl.$bl.$th."-";
$idp	= mysql_query("select notrans from konseling where notrans like '$kdtp%' order by notrans DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[notrans],9,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

$namauser = $_SESSION[namauser];
$lv0=$_SESSION[leveluser];
//$today1=gmdate("Y-m-d H:i:s",time()+60*60*7);
$today1=date("Y-m-d H:i:s");
if (isset($_POST['submit'])){
	$id = $_POST['Kode'];
	$id1 = $_POST['Kode_lama'];
	echo "Check $id";
	echo "Check $id1";
	$idtrans=substr($id_transaksi_baru,0,8);
	$parameter=$_POST[parameter];
	$nilai=$_POST[nilai];
	$hasil=$_POST[hasil];
	$ket=$_POST[ket];
	$check_p=mysql_num_rows(mysql_query("select kodependonor from konseling where notrans like '$idtrans%' and kodePendonor='$id'"));
	if ($check_p==0) {
	$tambah=mysql_query("insert into konseling (notrans,kodependonor,kodependonor_lama,tgl,parameter,nilai,hasil,ket,petugas) 
	value ('$id_transaksi_baru','$id','$id1','$today1','$parameter','$nilai','$hasil','$ket','$namauser')");
	
	if ($tambah) {
		echo "Data Telah berhasil dimasukkan<br>";
		//=======Audit Trial====================================================================================
		$log_mdl ='KONSELING';
		$log_aksi='Konseling: '.$id_transaksi_baru.'; Kode Donor: '.$id.'; Parameter: '.$parameter.'; Hasil: '.$hasil.'; Ket: '.$ket;
		include_once "user_log.php";
		//=====================================================================================================
		}
	
	}
	switch ($lv0){
		case "konseling":
			?><META http-equiv="refresh" content="1; url=pmikonseling.php?module=search_pendonor"><?
		break;
			echo "Anda tidak memiliki hak akses";
    }
}
?>

<body onload=disabletext(0)>
<h1 class="table">FORM KONSELING</h1>
<form name="periksa" method="post" action="<?=$PHP_SELF?>" >
<table class="form" cellspacing="0" cellpadding="2">
	<tr>
    <?php
	$check=mysql_query("select * from pendonor where Kode='$_GET[Kode]'");
	$check1=mysql_fetch_assoc($check);
	$tempat=mysql_query("select * from tempat_donor where active='1'");
	$tempat1=mysql_fetch_assoc($tempat);
	?>
		<td>Kode Baru</td>
		<td class="input">
			<input type=hidden name=Kode value="<?=$check1[Kode]?>">
			<?=$check1[Kode]?>
		</td>
		</tr>
		<tr>
		<td>Kode Lama</td>
		<td class="input">
			<input type=hidden name=Kode_lama value="<?=$check1[Kode_lama]?>">
			<?=$check1[Kode_lama]?>
			</td>
	</tr>
	<tr>
		<td>Nama Pendonor</td>
		<td class="input">
			<?=$check1[Nama]?>
		</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td class="input">
			<?=$check1[Alamat]?>
		</td>
	<tr>
		<td>Golongan Darah</td>
		<td class="input"><?=$check1[GolDarah]?>
		</td>
	</tr>
	<tr>
		<td>Rhesus</td>
		<td class="input"><?=$check1[Rhesus]?>
		</td>
	</tr>
	<tr>
		<td>Parameter</td>
		<td class="input">
			<select name="parameter" onchange='disabletext(this.value);'>
				<option value="0" >HBsAg</option>
				<option value="1" >HCV</option>
				<option value="2" >HIV</option>
				<option value="3" >SYPHILIS</option>
			</select>
	<tr>
		<td>Nilai</td>
		<td class="input">
			<input name="nilai" type="text" size="5" id='comments'></font>
		</td>
	</tr>

	<tr>
		<td>Tindak Lanjut</td>
		<td class="input">
			<select name="hasil" onchange='disabletext(this.value);'>
				<option value="0" >Dirujuk</option>
				<option value="1" >Diberikan obat</option>
				<option value="2" >Konsultasi</option>
			</select>
	<tr>
		<td>Keterangan</td>
		<td class="input">
			<textarea  rows="5" cols="57" wrap="physical" name="ket" {font-family:"Helvetica Neue", Helvetica, sans-serif; }></textarea>
			<!--input name="ket" type="text" size="10" id='comments'--></font>
		</td>
	</tr>


	
</table>
<br>

<input type="submit" name="submit" value="Simpan">

</form>
