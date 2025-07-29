<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->		
<!-- Modernizr -->
<script src="js/modernizr-1.5.min.js"></script>
<!-- Webforms2 -->
<script src="webforms2/webforms2.js"></script>
<!-- cookies -->
<script src="js/cookies.js"></script>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- Form layout -->
<script src="js/html5forms.fallback.js"></script>
<!-- Select menu 
<link rel="Stylesheet" href="css/ui.selectmenu.css" type="text/css" />
<script type="text/javascript" src="js/ui.selectmenu.js"></script>
<script type="text/javascript" src="js/jquery_select.js"></script>
-->
<script type="text/javascript" src="js/aftap.js"></script>
     <script type="text/javascript">
       jQuery(document).ready(function() {
	 $('#id_kantong11').focus();
       });
	window.onload = function(){ document.getElementById('id_kantong11').focus(); }
     </script>
	<style type="text/css">
		/*demo styles*/
		body {font-size: 62.5%; font-family:"Verdana",sans-serif; margin: 70px 10px;}
		fieldset { border:0;  margin-bottom: 40px;}	
		label,select,.ui-select-menu { float: left; margin-right: 10px; }
		select { width: 200px; }
		
		/*select with custom icons*/
		body a.customicons { height: 2.8em;}
		body .customicons li a, body a.customicons span.ui-selectmenu-status { line-height: 2em; padding-left: 30px !important; }
		body .video .ui-selectmenu-item-icon, body .podcast .ui-selectmenu-item-icon, body .rss .ui-selectmenu-item-icon { height: 24px; width: 24px; }
		body .video .ui-selectmenu-item-icon { background: url(sample_icons/24-video-square.png) 0 0 no-repeat; }
		body .podcast .ui-selectmenu-item-icon { background: url(sample_icons/24-podcast-square.png) 0 0 no-repeat; }
		body .rss .ui-selectmenu-item-icon { background: url(sample_icons/24-rss-square.png) 0 0 no-repeat; }
	</style>

<?
require_once('config/db_connect.php');
require_once('clogin.php');
require_once('modul/background_process.php');

if ($_POST['submit']!=""){
    	$kdl 		= mktime(0,0,0,date("m"),date("d")+35,date("Y"));
	$kembali0 	= mktime(0,0,0,date("m"),date("d")+75,date("Y"));
	$tensi 		= $_POST['tensi_diastol']."/".$_POST['tensi_sistol'];
	$idp		= mysql_query("select * from tempat_donor where active='1'");
	$status_test	=1; 				
	$today 		= date('Y-m-d H:i:s');
	$kembali 	= date('Y-m-d',$kembali0);	
	$kadaluwarsa	= date('Y-m-d H:i:s',$kdl);
	$kodepasien	= $_POST['kodepasien'];		
	$notransaksi 	= $_POST['notransaksi'];
	$keberhasilan 	= $_POST['keberhasilan'];	
	$volume_darah 	= $_POST['volume_darah'];	
	$catatan 	= $_POST['catatan'];
	$reaksi 	= $_POST['reaksi'];		
	$caraambil 	= $_POST['caraambil'];
	$id_kantong 	= $_POST['id_kantong11'];		
	//$namauser 	= $_SESSION['namauser'];
	$idp1		=mysql_fetch_assoc($idp);       
	$golda		= $_POST['golda'];
	$rhesus		= $_POST['rhesus'];
	$petugas	= $_POST['petugas'];		
	$dokterudd	= $_POST['dokterudd'];
    $ambil3=$_POST['ambil'];
    $selesai3=$_POST['selesai'];
    $today1         = date('Y-m-d');
    
    $ambil2        = str_replace(";",":",$ambil3);
    $ambil1        = str_replace(",",":",$ambil2);
    $ambil        = str_replace(".",":",$ambil1);

    $selesai2    = str_replace(";",":",$selesai3);
    $selesai1    = str_replace(",",":",$selesai2);
    $selesai    = str_replace(".",":",$selesai1);
    
    //interval AFTAP-----------
    $jama=$ambil;
    $jamb=$selesai;
    $test1=substr($jama,0,2);
    $test2=substr($jama,3,2);
    $test3=substr($jama,6);
    $test4=substr($jamb,0,2);
    $test5=substr($jamb,3,2);
    $test6=substr($jamb,6);
    $waktua=mktime($test1,$test2,$test3);
    $waktub=mktime($test4,$test5,$test6);
    $selisih=$waktub-$waktua;
    $sisa=$selisih % 86400;
    $jam=floor($sisa/3600);
    $sisa=$sisa%3600;
    $menit=floor($sisa/60);

    $lama_pengambilan=$menit;
    $tglp1= $today1.' '.$ambil;
    $tglp2= $today1.' '.$selesai;
    
    //echo $lastnkt.'-'.$nkt;
	//Kembali 35 Hari jika cara ambil AFERESIS
	if ($caraambil=='6') $kembali = date('Y-m-d',$kdl);
	
	if (substr($idp1[id1],0,1)=="M") { 
                $mu="1";
	} else {
		$mu="";
	}

	$stok=mysql_query("select * from stokkantong where nokantong='$id_kantong' and Status='0' and StatTempat='1'");
	$stok1=mysql_fetch_array($stok);
	
	if ($stok1['Status']=="0"){
		if ($keberhasilan=="1") {		//0:Belum diambil, 1:Berhasil, 2:Batal 3:Gagal 
		 $tambah=mysql_query("UPDATE transaksi_plebotomi
					SET tglaftap  ='$today',	aftaper   ='$petugas',
					    dokterudd ='$dokterudd',	nokantong ='$id_kantong',
					    status    ='1',		catatan   ='$catatan',
					    diambil   ='$volume_darah'
					WHERE (status='0' and notransaksi='$notransaksi')");
		  $tambah2=mysql_query("UPDATE stokkantong
					 SET Status	='8',		gol_darah 	= '$golda',
					     RhesusDrh	='$rhesus',	kodePendonor	='$kodepasien',
					     tgl_Aftap	='$tglp1',	kadaluwarsa	='$tglp2',
                        volumeasal	='$volume_darah', lama_pengambilan='$lama_pengambilan'
					 WHERE nokantong='$id_kantong'");
		  $tambah3=mysql_query("UPDATE pasien_plebotomi SET jumlah_plebotomi=jumlah_plebotomi+1 WHERE kode='$kodepasien'");
		} 
		 elseif ($keberhasilan=="3"){       //0:Belum diambil, 1:Berhasil, 2:Batal 3:Gagal 
		 $tambah=mysql_query("UPDATE transaksi_plebotomi
					SET tglaftap  ='$today',	aftaper   ='$petugas',
					    dokterudd ='$dokterudd',	nokantong ='$id_kantong',
					    status    ='3',		catatan   ='$catatan',
					    diambil   ='$volume_darah'
					WHERE (status='0' and notransaksi='$notransaksi')");
		 $tambah2=mysql_query("UPDATE stokkantong SET Status='5'
				      WHERE nokantong='$id_kantong'");
		}
		if ($tambah) {
			echo "Data pengambilan plebotomi pasien $nama telah berhasil dimasukkan<br>";
			switch ($_SESSION[leveluser]){
				case "aftap":
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=daftar_permintaan_plebotomi"> <?
					break;
				case "kasir":
					?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=daftar_permintaan_plebotomi"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=daftar_permintaan_plebotomi"> <?
					break;
				default:
					echo "Anda tidak memiliki hak akses";
				}
		}
	} else {
		echo "NO. KANTONG tidak sesuai, silahkan periksa status kantong.<br>";
		switch ($_SESSION[leveluser]){
			case "aftap":
				?> <META http-equiv="refresh" content="1; url=pmiaftap.php?module=pengambilan_plebotomi"> <?
				break;
			case "kasir":
				?> <META http-equiv="refresh" content="1; url=pmikasir.php?module=pengambilan_plebotomi"> <?
				break;
			case "mobile":
				?> <META http-equiv="refresh" content="1; url=pmiaftap.php?module=pengambilan_plebotomi"> <?
				break;
			default:
				echo "Anda tidak memiliki hak akses";
		}
	}
                
	$_POST['periksa']="";
}


	$check=mysql_query("select * from pmi.transaksi_plebotomi where (notransaksi='$_GET[notransaksi]' or notransaksi='$_POST[notransaksi]')");
	$check1=mysql_fetch_assoc($check);
	$q_dok=mysql_query("select Nama from dokter_periksa where kode='$check1[NamaDokter]'");
	$a_dok=mysql_fetch_assoc($q_dok);
	$check1[kodepasien]=str_replace("'","\'",$check1[kodepasien]);
	$data=mysql_query("select nama,golda,rhesus,alamat from pasien_plebotomi where kode='$check1[kodepasien]'");
	$data1=mysql_fetch_array($data);
	?>
	<h1 class="table">FORM PENGAMBILAN DARAH PLEBOTOMI</h1>
<form name="periksa" onsubmit="return ok()" method="post" action="<?=$PHPSELF?>" >
	<table class="form" cellspacing="2" cellpadding="2">
		<tr><td><table class="form" cellspacing="3" cellpadding="3">
			<tr><td>Kode Pasien</td><td class="input"><?=$check1[kodepasien]?> &nbsp;</td></tr>
			<tr><td>Pengambilan</td>
				<td class="input">
				<select name="keberhasilan">
			          <option value="0">Pilih status pengambilan</option>
			          <option value="1">Berhasil</option>
			          <option value="3">Gagal</option>
			        </select></td></tr>
			
			<tr><td>Catatan</td>
				<td class="input"><input name='catatan' id='comments' size="30" placeholder="Catatan plebotomi"></input></td></tr>	
		</tr>
			<tr><td>Diambil Sebanyak</td><td class="input"><input name="volume_darah" value="350"></input> cc</td></tr>
			<tr><td>Dokter pendamping</td><td class="input">
				<select name="dokterudd">
				  <?
				  $dokter="select * from dokter_periksa order by Nama";
				  $do=mysql_query($dokter);
				  while($data=mysql_fetch_array($do)){
				   ?><option value="<?=$data[Nama]?>"><?=$data[Nama]?></option><? } ?></select></td></tr>
			<tr><td>Petugas Aftap</td><td class="input">
				<select name="petugas">
				  <?
				  $dokter="select * from user order by nama_lengkap";
				  $do=mysql_query($dokter);
				  while($data=mysql_fetch_array($do)){
				     ?>	<option value="<?=$data[nama_lengkap]?>"><?=$data[nama_lengkap]?></option> <? } ?></select></td></tr>
                              
                              <tr>
                                 <td>Jam Ambil</td>
                                 <td class="input">
                                     <input size="6" name="ambil" value="" id="jam_ambil" placeholder="13:00" required>
                                     </input>Selesai
                                     <input size="6" name="selesai" value="" id="jam_selesai" placeholder="13:20" required>
                                     </input>
                                 </td>
                             </tr>
			<tr><td>No Kantong</td><td class="input">
				<input name="id_kantong11" id="id_kantong11" onkeydown="chang(event,this);" type="text" size="30"></td></tr>
		</table></td>
		<td><table class="form" cellspacing="4" cellpadding="4">
			<tr><td>Nama Pasien</td>		<td class="input"><?=$data1[nama]?> &nbsp;</td></tr>
			<tr><td>Golongan Darah</td>		<td class="input"><? echo $data1[golda].",   Rhesus(".$data1[rhesus].")"?></td></tr>
			<tr><td>Alamat</td>			<td class="input"><?=$data1[alamat];?></td></tr>
			<tr><td>Rumah Sakit</td>		<td class="input"><?=$check1[rumahsakit];?></td></tr>
			<tr><td>Bagian</td>			<td class="input"><?=$check1[bagian];?></td></tr>
			<tr><td>Dokter yg merawat</td>		<td class="input"><?=$check1[dokterpasien];?></td></tr>
			<tr><td>Diagnosa</td>			<td class="input"><?=$check1[diagnosa];?></td></tr>
			<tr><td>Tanggal terima</td>		<td class="input"><?=$check1[tgltransaksi];?></td></tr>
			<tr><td>Petugas yg menerima</td>	<td class="input"><?=$check1[petugaspenerima];?></td></tr>
		</table></td>
	</tr></table>
	<br>
	<input type="hidden" name="notransaksi" value="<?=$_GET[notransaksi]?>">
	<input type="hidden" name="kodepasien" value="<?=$check1[kodepasien]?>">
	<input type="hidden" name="golda" value="<?=$data1[golda]?>">
	<input type="hidden" name="rhesus" value="<?=$data1[rhesus]?>">
	<input type="submit" name="submit" value="Simpan Data Plebotomi">
</form>
<div class="alert" id="alert">
	<div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!"><p>Silahkan cek kembali kantong yang anda masukkan, atau masukkan kantong lain</p></div>
</div>


