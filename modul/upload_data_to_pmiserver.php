<link type="text/css" href="/css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="/css/style.css" rel="stylesheet" />
<link type="text/css" href="/css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<?
$namauser = $_SESSION[namauser];
include('config/db_connect.php');
$tanggal=date("Y-m-d");
$sqlconfig=mysql_fetch_assoc(mysql_query("select * from db_server limit 1", $con));
$sqludd=mysql_fetch_assoc(mysql_query("select * from utd where aktif=1", $con));
$server_usr=$sqlconfig['user'];
$server_ip=$sqlconfig['ip'];
$server_db=$sqlconfig['db'];
$server_pwd=$sqlconfig['password'];
$id_udd=$sqludd[id];
if(isset($_POST[submit])){
	$tanggal=$_POST['tanggal'];
	//echo "$tanggal<br>";
	$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
	mysql_select_db($server_db);
	if (!$con_pmipusat){ echo "tidak dapat connect ke database"; exit;}
	//============UPLOAD STTOK=================================
	//echo "<BR>UPLOAD STOK DARAH<BR>";
	include('modul/upload_data_to_pmiserver_stok.php');
	$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
	mysql_select_db($server_db);
	if (!$con_pmipusat){ echo "tidak dapat connect ke database"; exit;}
	for ($i=1;$i<count($namaproduk)+1;$i++) {
	   //proses upload data
	   //echo "$namaproduk[$i]<BR>";
	   $chkserver=mysql_fetch_assoc(mysql_query("select udd from stokdarah where udd='$id_udd' and produk='$namaproduk[$i]'", $con_pmipusat));
	   if ($chkserver[udd]==$id_udd) {
		$updserver=("UPDATE stokdarah SET nama='$namalengkap[$i]',a_pos  = '$Ap[$i]', b_pos  = '$Bp[$i]', o_pos  = '$Op[$i]', ab_pos = '$ABp[$i]', a_neg  = '$An[$i]',
			     b_neg  = '$Bn[$i]', o_neg  = '$On[$i]', ab_neg = '$ABn[$i]', update_on=current_timestamp WHERE udd = '$id_udd' AND produk='$namaproduk[$i]'");
		//echo "- $updserver <BR>";
		$updserver1=mysql_query($updserver,$con_pmipusat);
		} else {
		$addserver=("INSERT INTO stokdarah (udd, produk, nama, a_pos, b_pos, o_pos, ab_pos, a_neg, b_neg, o_neg, ab_neg, ket, update_on)
			VALUES ('$id_udd', '$namaproduk[$i]', '$$namalengkap[$i]','$Ap[$i]','$Bp[$i]','$Op[$i]','$ABp[$i]','$An[$i]','$Bn[$i]','$On[$i]','$ABn[$i]','$namauser', current_timestamp)");
		//echo "- $addserver <br>";
		$addserver1=mysql_query($addserver,$con_pmipusat);
	   }
	}
	//==============UPLOAD PENDONOR==========================
	//echo "<BR>UPLOAD DATA PENDONOR<BR>";
	include('modul/upload_data_to_pmiserver_pendonor.php');
	$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
	mysql_select_db($server_db);
	if (!$con_pmipusat){ echo "tidak dapat connect ke database"; exit;}
	$chkserver=mysql_fetch_assoc(mysql_query("select udd from pendonor where udd='$id_udd'", $con_pmipusat));
	if ($chkserver[udd]==$id_udd){
		$updserver="UPDATE pendonor set lk_apos='$lk_Apos',lk_bpos='$lk_Bpos',lk_abpos='$lk_ABpos',lk_opos='$lk_Opos',
			lk_aneg='$lk_Aneg',lk_bneg='$lk_Bneg',lk_abneg='$lk_ABneg',lk_oneg='$lk_Oneg',
			pr_apos='$pr_Apos',pr_bpos='$pr_Bpos',pr_abpos='$pr_ABpos',pr_opos='$pr_Opos',
			pr_aneg='$pr_Aneg',pr_bneg='$pr_Bneg',pr_abneg='$pr_ABneg',pr_oneg='$pr_Oneg',
			d1='$Jum1',d10='$Jum10',d25='$Jum25',d50='$Jum50',d75='$Jum75',d100='$Jum100',
			umur17_30 ='$umur17_30',umur31_40 ='$umur31_40',umur41_50 ='$umur41_50',umur51_60 ='$umur51_60',umur60_lebih ='$umur60_lebih',
			update_on=current_timestamp WHERE udd='$id_udd'";
		//echo "- $updserver <BR>";
		$updserver1=mysql_query($updserver,$con_pmipusat);
	}else{
		$addserver="INSERT INTO pendonor (udd,lk_apos,lk_bpos,lk_abpos,lk_opos,lk_aneg,lk_bneg,lk_abneg,lk_oneg,pr_apos,
			pr_bpos,pr_abpos,pr_opos,pr_aneg,pr_bneg,pr_abneg,pr_oneg,d1,d10,d25,d50,d75,d100,
			umur17_30, umur31_40, umur41_50, umur51_60, umur60_lebih, update_on)
			VALUES ('$id_udd','$lk_Apos','$lk_Bpos','$lk_ABpos','$lk_Opos','$lk_Aneg','$lk_Bneg','$lk_ABneg','$lk_Oneg',
			'$pr_Apos','$pr_Bpos','$pr_ABpos','$pr_Opos','$pr_Aneg','$pr_Bneg','$pr_ABneg','$pr_Oneg',
			'$Jum1','$Jum10','$Jum25','$Jum50','$Jum75','$Jum100','$umur17_30', '$umur31_40', '$umur41_50', '$umur51_60', '$umur60_lebih',current_timestamp)";
		//echo "- $addserver <br>";
		$addserver1=mysql_query($addserver,$con_pmipusat);
	}
	
	//============UPLOAD KEGIATAN MU===========================
	//echo "<BR>UPLOAD DATA KEGIATAN MOBILE UNIT<BR>";
	include('modul/upload_data_to_pmiserver_kegiatan_mu.php');
	$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
	mysql_select_db($server_db);
	if (!$con_pmipusat){ echo "tidak dapat connect ke database"; exit;}
	for ($i=1;$i<count($NoTrans)+1;$i++){
		$chkserver=mysql_fetch_assoc(mysql_query("select udd from kegiatan where udd='$id_udd' and NoTrans='$NoTrans[$i]'", $con_pmipusat));
		if ($chkserver[udd]==$id_udd){
			$updserver="UPDATE kegiatan set instansi='$instansi[$i]', alamat='$alamat[$i]', TglPenjadwalan='$TglPenjadwalan[$i]', jumlah='$jumlah[$i]',
				lat='$lat[$i]', lng='$lng[$i]', kendaraan='$kendaraan[$i]', update_on=current_timestamp WHERE NoTrans='$NoTrans[$i]' AND udd='$id_udd'";
			//echo "- $updserver <BR>";
			$updserver1=mysql_query($updserver,$con_pmipusat);
		}else{
			$addserver="INSERT INTO kegiatan (NoTrans, udd, instansi, alamat, TglPenjadwalan, jumlah, lat, lng, kendaraan, update_on)
				VALUES ('$NoTrans[$i]','$udd[$i]','$instansi[$i]','$alamat[$i]','$TglPenjadwalan[$i]','$jumlah[$i]','$lat[$i]','$lng[$i]','$kendaraan[$i]', current_timestamp)";
			//echo "- $addserver <br>";
			$addserver1=mysql_query($addserver,$con_pmipusat);
		}
	}
	
	//UPLOAD SUMMARY KEGIATAN HARI INI===============================
	//echo "<BR>UPLOAD DATA KEGIATAN HARIAN<BR>";
	include('modul/upload_data_to_pmiserver_transaksi.php');
	$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
	mysql_select_db($server_db);
	$chkserver=mysql_fetch_assoc(mysql_query("select udd from transaksi where udd='$id_udd' and tanggal='$_POST[tanggal]'", $con_pmipusat));
	if ($chkserver[udd]==$id_udd){
		$updserver=" UPDATE transaksi SET dg_lk_dp_a_pos  ='$dg_lk_dp_a_pos', dg_lk_dp_ab_pos ='$dg_lk_dp_ab_pos', dg_lk_dp_b_pos  ='$dg_lk_dp_b_pos',
			dg_lk_dp_o_pos  ='$dg_lk_dp_o_pos', dg_lk_dp_a_neg  ='$dg_lk_dp_a_neg', dg_lk_dp_ab_neg ='$dg_lk_dp_ab_neg', dg_lk_dp_b_neg  ='$dg_lk_dp_b_neg',
			dg_lk_dp_o_neg  ='$dg_lk_dp_o_neg', dg_lk_ds_a_pos  ='$dg_lk_ds_a_pos', dg_lk_ds_ab_pos ='$dg_lk_ds_ab_pos', dg_lk_ds_b_pos  ='$dg_lk_ds_b_pos',
			dg_lk_ds_o_pos  ='$dg_lk_ds_o_pos', dg_lk_ds_a_neg  ='$dg_lk_ds_a_neg', dg_lk_ds_ab_neg ='$dg_lk_ds_ab_neg', dg_lk_ds_b_neg  ='$dg_lk_ds_b_neg',
			dg_lk_ds_o_neg  ='$dg_lk_ds_o_neg', dg_pr_dp_a_pos  ='$dg_pr_dp_a_pos', dg_pr_dp_ab_pos ='$dg_pr_dp_ab_pos', dg_pr_dp_b_pos  ='$dg_pr_dp_b_pos',
			dg_pr_dp_o_pos  ='$dg_pr_dp_o_pos', dg_pr_dp_a_neg  ='$dg_pr_dp_a_neg', dg_pr_dp_ab_neg ='$dg_pr_dp_ab_neg', dg_pr_dp_b_neg  ='$dg_pr_dp_b_neg',
			dg_pr_dp_o_neg  ='$dg_pr_dp_o_neg', dg_pr_ds_a_pos  ='$dg_pr_ds_a_pos', dg_pr_ds_ab_pos ='$dg_pr_ds_ab_pos', dg_pr_ds_b_pos  ='$dg_pr_ds_b_pos',
			dg_pr_ds_o_pos  ='$dg_pr_ds_o_pos', dg_pr_ds_a_neg  ='$dg_pr_ds_a_neg', dg_pr_ds_ab_neg ='$dg_pr_ds_ab_neg', dg_pr_ds_b_neg  ='$dg_pr_ds_b_neg',
			dg_pr_ds_o_neg  ='$dg_pr_ds_o_neg', mu_lk_ds_a_pos_nbus  ='$mu_lk_ds_a_pos_nbus', mu_lk_ds_ab_pos_nbus ='$mu_lk_ds_ab_pos_nbus',
			mu_lk_ds_b_pos_nbus  ='$mu_lk_ds_b_pos_nbus', mu_lk_ds_o_pos_nbus  ='$mu_lk_ds_o_pos_nbus', mu_lk_ds_a_pos_bus   ='$mu_lk_ds_a_pos_bus',
			mu_lk_ds_ab_pos_bus  ='$mu_lk_ds_ab_pos_bus', mu_lk_ds_b_pos_bus   ='$mu_lk_ds_b_pos_bus', mu_lk_ds_o_pos_bus   ='$mu_lk_ds_o_pos_bus', 
			mu_lk_ds_a_neg_nbus  ='$mu_lk_ds_a_neg_nbus', mu_lk_ds_ab_neg_nbus ='$mu_lk_ds_ab_neg_nbus', mu_lk_ds_b_neg_nbus  ='$mu_lk_ds_b_neg_nbus',
			mu_lk_ds_o_neg_nbus  ='$mu_lk_ds_o_neg_nbus', mu_lk_ds_a_neg_bus   ='$mu_lk_ds_a_neg_bus', mu_lk_ds_ab_neg_bus  ='$mu_lk_ds_ab_neg_bus',
			mu_lk_ds_b_neg_bus   ='$mu_lk_ds_b_neg_bus', mu_lk_ds_o_neg_bus   ='$mu_lk_ds_o_neg_bus', mu_pr_ds_a_pos_nbus  ='$mu_pr_ds_a_pos_nbus',
			mu_pr_ds_ab_pos_nbus ='$mu_pr_ds_ab_pos_nbus', mu_pr_ds_b_pos_nbus  ='$mu_pr_ds_b_pos_nbus', mu_pr_ds_o_pos_nbus  ='$mu_pr_ds_o_pos_nbus',
			mu_pr_ds_a_pos_bus   ='$mu_pr_ds_a_pos_bus', mu_pr_ds_ab_pos_bus  ='$mu_pr_ds_ab_pos_bus', mu_pr_ds_b_pos_bus   ='$mu_pr_ds_b_pos_bus',
			mu_pr_ds_o_pos_bus   ='$mu_pr_ds_o_pos_bus', mu_pr_ds_a_neg_nbus  ='$mu_pr_ds_a_neg_nbus', mu_pr_ds_ab_neg_nbus ='$mu_pr_ds_ab_neg_nbus',
			mu_pr_ds_b_neg_nbus  ='$mu_pr_ds_b_neg_nbus', mu_pr_ds_o_neg_nbus  ='$mu_pr_ds_o_neg_nbus', mu_pr_ds_a_neg_bus   ='$mu_pr_ds_a_neg_bus',
			mu_pr_ds_ab_neg_bus  ='$mu_pr_ds_ab_neg_bus', mu_pr_ds_b_neg_bus   ='$mu_pr_ds_b_neg_bus', mu_pr_ds_o_neg_bus   ='$mu_pr_ds_o_neg_bus', update_on=current_timestamp
			WHERE udd ='$id_udd' AND tanggal = '$_POST[tanggal]'"; 
		//echo "- $updserver <BR>";
		$updserver1=mysql_query($updserver,$con_pmipusat);
	}else{
		$addserver="INSERT INTO transaksi (udd, tanggal, dg_lk_dp_a_pos,  dg_lk_dp_ab_pos, dg_lk_dp_b_pos, dg_lk_dp_o_pos, 
			dg_lk_dp_a_neg, dg_lk_dp_ab_neg, dg_lk_dp_b_neg, dg_lk_dp_o_neg, dg_lk_ds_a_pos, dg_lk_ds_ab_pos, dg_lk_ds_b_pos, dg_lk_ds_o_pos,
			dg_lk_ds_a_neg, dg_lk_ds_ab_neg, dg_lk_ds_b_neg, dg_lk_ds_o_neg, dg_pr_dp_a_pos, dg_pr_dp_ab_pos, dg_pr_dp_b_pos, dg_pr_dp_o_pos,
			dg_pr_dp_a_neg, dg_pr_dp_ab_neg, dg_pr_dp_b_neg, dg_pr_dp_o_neg, dg_pr_ds_a_pos, dg_pr_ds_ab_pos, dg_pr_ds_b_pos, dg_pr_ds_o_pos,
			dg_pr_ds_a_neg, dg_pr_ds_ab_neg, dg_pr_ds_b_neg, dg_pr_ds_o_neg, mu_lk_ds_a_pos_nbus, mu_lk_ds_ab_pos_nbus, mu_lk_ds_b_pos_nbus, mu_lk_ds_o_pos_nbus,
			mu_lk_ds_a_pos_bus, mu_lk_ds_ab_pos_bus, mu_lk_ds_b_pos_bus, mu_lk_ds_o_pos_bus, mu_lk_ds_a_neg_nbus, mu_lk_ds_ab_neg_nbus, mu_lk_ds_b_neg_nbus, mu_lk_ds_o_neg_nbus,
			mu_lk_ds_a_neg_bus, mu_lk_ds_ab_neg_bus, mu_lk_ds_b_neg_bus, mu_lk_ds_o_neg_bus, mu_pr_ds_a_pos_nbus, mu_pr_ds_ab_pos_nbus, mu_pr_ds_b_pos_nbus, mu_pr_ds_o_pos_nbus,
			mu_pr_ds_a_pos_bus, mu_pr_ds_ab_pos_bus, mu_pr_ds_b_pos_bus, mu_pr_ds_o_pos_bus, mu_pr_ds_a_neg_nbus, mu_pr_ds_ab_neg_nbus, mu_pr_ds_b_neg_nbus, mu_pr_ds_o_neg_nbus,
			mu_pr_ds_a_neg_bus, mu_pr_ds_ab_neg_bus, mu_pr_ds_b_neg_bus, mu_pr_ds_o_neg_bus, update_on) VALUES ('$id_udd', '$_POST[tanggal]',
			'$dg_lk_dp_a_pos', '$dg_lk_dp_ab_pos', '$dg_lk_dp_b_pos', '$dg_lk_dp_o_pos', '$dg_lk_dp_a_neg', '$dg_lk_dp_ab_neg', '$dg_lk_dp_b_neg', '$dg_lk_dp_o_neg',
			'$dg_lk_ds_a_pos', '$dg_lk_ds_ab_pos', '$dg_lk_ds_b_pos', '$dg_lk_ds_o_pos', '$dg_lk_ds_a_neg', '$dg_lk_ds_ab_neg', '$dg_lk_ds_b_neg', '$dg_lk_ds_o_neg',
			'$dg_pr_dp_a_pos', '$dg_pr_dp_ab_pos', '$dg_pr_dp_b_pos', '$dg_pr_dp_o_pos', '$dg_pr_dp_a_neg', '$dg_pr_dp_ab_neg', '$dg_pr_dp_b_neg', '$dg_pr_dp_o_neg',
			'$dg_pr_ds_a_pos', '$dg_pr_ds_ab_pos', '$dg_pr_ds_b_pos', '$dg_pr_ds_o_pos', '$dg_pr_ds_a_neg', '$dg_pr_ds_ab_neg', '$dg_pr_ds_b_neg', '$dg_pr_ds_o_neg',
			'$mu_lk_ds_a_pos_nbus', '$mu_lk_ds_ab_pos_nbus', '$mu_lk_ds_b_pos_nbus', '$mu_lk_ds_o_pos_nbus', '$mu_lk_ds_a_pos_bus', '$mu_lk_ds_ab_pos_bus', '$mu_lk_ds_b_pos_bus', '$mu_lk_ds_o_pos_bus',
			'$mu_lk_ds_a_neg_nbus', '$mu_lk_ds_ab_neg_nbus', '$mu_lk_ds_b_neg_nbus', '$mu_lk_ds_o_neg_nbus', '$mu_lk_ds_a_neg_bus', '$mu_lk_ds_ab_neg_bus', '$mu_lk_ds_b_neg_bus', '$mu_lk_ds_o_neg_bus',
			'$mu_pr_ds_a_pos_nbus', '$mu_pr_ds_ab_pos_nbus', '$mu_pr_ds_b_pos_nbus', '$mu_pr_ds_o_pos_nbus', '$mu_pr_ds_a_pos_bus', '$mu_pr_ds_ab_pos_bus', '$mu_pr_ds_b_pos_bus', '$mu_pr_ds_o_pos_bus',
			'$mu_pr_ds_a_neg_nbus', '$mu_pr_ds_ab_neg_nbus', '$mu_pr_ds_b_neg_nbus', '$mu_pr_ds_o_neg_nbus', '$mu_pr_ds_a_neg_bus', '$mu_pr_ds_ab_neg_bus', '$mu_pr_ds_b_neg_bus', '$mu_pr_ds_o_neg_bus', current_timestamp)";
		//echo "- $addserver <br>";
		$addserver1=mysql_query($addserver,$con_pmipusat);
	}
    echo "<font size='3' color='blue' face='Trebuchet MS'>Upload data sudah berhasil dilakukan!</b><br></font><br>";
    include('modul/upload_data_to_pmiserver_hasil.php');
    //echo "<meta http-equiv=\"refresh\" content=\"15; URL=../pmiadmin.php?module=uploadserverpmi\">";    
}else{?>
    <form name="upload" method="post" action="<? $PHP_SELF ?>">
	<font size="5" color="red" face="Trebuchet MS"><b>Upload Data ke server PMI Pusat</b><br></font>
	<font size="2" color="black" face="Trebuchet MS">Tanggal (khusus transaksi harian)</font>
	<input name="tanggal" id="datepicker" type=date size=10 value=<?=$tanggal?>><br>
	<font size="4" color="red" face="Trebuchet MS"><b>Data upload :</b></font>
	<font size="3" color="black" face="Trebuchet MS">Stok Darah Sehat, Rekap Pendonor, Data Kegiatan Mobile Unit, Rekap Donor Harian</font></br></br>
	<font size="4" color="black" face="Trebuchet MS"><b>IP SERVER PUSAT : <?=$server_ip?></b></font><br>
	<font size="2" color="black" face="Trebuchet MS">Perubahan database server pusat dapat dilakukan pada Admin - Utility - Setting Server Pusat<br></font>
	<font size="2" color="black" face="Trebuchet MS">Atau <b><a href="pmiadmin.php?module=settingserver">klik disini</b></a> untuk melakukan perubahan<br><br></font>
	<button type="submit" value="Simpan" name="submit" class="swn_button_red">Proses Upload Data</button>
    </form>    
<?}
?>
