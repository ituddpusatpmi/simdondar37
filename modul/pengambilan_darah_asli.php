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
	$kdl 		= mktime(0,0,0,date("m"),date("d")+14,date("Y"));
	$kembali0 	= mktime(0,0,0,date("m"),date("d")+60,date("Y"));
	$tensi 		= $_POST['tensi_diastol']."/".$_POST['tensi_sistol'];
	$idp		=	mysql_query("select * from tempat_donor where active='1'");
	$status_test	=1; 				$today 		= date('Y-m-d H:i:s');
	$kembali 	= date('Y-m-d',$kembali0);	$kadaluwarsa	= date('Y-m-d H:i:s',$kdl);
	$kodependonor	= $_POST['kodependonor'];	$notrans 	= $_POST['notrans'];
	                                    		$keberhasilan 	= $_POST['keberhasilan'];	
	$volume_darah 	= $_POST['volume_darah'];	$catatan 	= $_POST['catatan'];
	$reaksi 	= $_POST['reaksi'];		$caraambil 	= $_POST['caraambil'];
	$id_kantong 	= $_POST['id_kantong11'];		$namauser 	= $_SESSION['namauser'];
	$idp1		= mysql_fetch_assoc($idp);       $today1=date("Y-m-d");
	$GolDarah	= $_POST['goldarah'];
	$Rhesus		= $_POST['Rhesus'];
	$petugas	=$_POST['petugas'];
	//Kembali 35 Hari jika cara ambil AFERESIS---> apakah tidak 14 hari ya? (suwena)
	if ($caraambil=='5') $kembali = date('Y-m-d',$kdl);
	
	if (substr($idp1[id1],0,1)=="M") { 
		$mu="1";
	} else {
		$mu="";
	}
	
	$stok=mysql_query("select * from stokkantong where NoKantong='$id_kantong' and Status='0' and StatTempat='1' and kadaluwarsa_ktg >'$today1'");
	$stok1=mysql_fetch_array($stok);
	$pendonor=mysql_query("select * from pendonor where Kode='$kodependonor' ");
	$pendonor1=mysql_fetch_assoc($pendonor);
	$kota=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
	
	$shift=mysql_fetch_assoc(mysql_query("select * from shift where jam_awal >= current_time and jam_akhir <= current_time "));

	if ($stok1['Status']=="0"){
		if ($keberhasilan==0) {		//0=berhasil, 1=batal, 2=gagal 
		$tambah=mysql_query("UPDATE htransaksi
					SET diambil='$volume_darah',reaksi='$reaksi',
						pengambilan='$keberhasilan',catatan='$catatan',ketBatal='-',jeniskantong='$stok1[jenis]',volumekantong='$stok1[volumeasal]',
						nokantong='$id_kantong',petugas='$petugas',
						caraambil='$caraambil',status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$pendonor1[jumDonor]+1'
					WHERE (Status='1' and NoTrans='$notrans')");
			if($caraambil!=5){
				$kembali1=mysql_query("UPDATE pendonor
						SET tglkembali='$kembali',jumDonor=jumDonor+1,mu='$mu',up=b'1',tglkembali_apheresis='$kembali'
						WHERE Kode='$kodependonor'");

				$tambah2=mysql_query("UPDATE stokkantong
					SET Status='1',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='WB',sah='0',
					kodePendonor='$kodependonor',kadaluwarsa=(tgl_aftap + interval 35 day),mu='$mu'
					WHERE noKantong='$id_kantong'");	
					
				$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
				$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");

				switch ($gol_darah){
				    case 'A':
					$update_wba=mysql_query("UPDATE stok SET wb_a = wb_a + 1 where status ='0'");
					break;
				    case 'B':
					$update_wbb=mysql_query("UPDATE stok SET wb_b = wb_b + 1 where status ='0'");
					break;
				    case 'AB':
					$update_wbab=mysql_query("UPDATE stok SET wb_ab = wb_ab + 1 where status ='0'");
					break;
				    case 'O':
					$update_wbo=mysql_query("UPDATE stok SET wb_o = wb_o + 1 where status ='0'");
					break;
				    default:
					$update_wbx=mysql_query("UPDATE stok SET wb_x = wb_x + 1 where status ='0'");
				}
				backgroundPost('http://localhost/simudda/modul/background_up_wb.php');
			}else{ //plebotomi
				$tambah2=mysql_query("UPDATE stokkantong
					SET Status='6',tgl_Aftap='$today',
						kodePendonor='$kodependonor',kadaluwarsa='$kadaluwarsa',mu='$mu'
					WHERE noKantong='$id_kantong'");
			}
		} elseif ($keberhasilan==2){
		$tambah=mysql_query("UPDATE htransaksi
					SET diambil='$volume_darah',reaksi='$reaksi',
						pengambilan='$keberhasilan',catatan='$catatan',ketBatal='12',jeniskantong='$stok1[jenis]',volumekantong='$volume_darah',
						nokantong='$id_kantong',petugas='$petugas',
						caraambil='$caraambil',status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$pendonor1[jumDonor]+1'
					WHERE (Status='1' and NoTrans='$notrans')");
				$kembali1=mysql_query("UPDATE pendonor

						SET tglkembali='$kembali',jumDonor=jumDonor+1,mu='$mu',up=b'1',tglkembali_apheresis='$kembali'
						WHERE Kode='$kodependonor'");

		
				$tambah2=mysql_query("UPDATE stokkantong
					SET Status='5',hasil='5',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',sah='0',
					kodePendonor='$kodependonor',kadaluwarsa='$kadaluwarsa',mu='$mu'
					WHERE noKantong='$id_kantong'");

				$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
				$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} elseif ($keberhasilan==1){
		$tambah=mysql_query("UPDATE htransaksi

					SET pengambilan='$keberhasilan',catatan='$catatan',ketBatal='Pendonor Pergi',petugas='$petugas',
			status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',
		pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$pendonor1[jumDonor]'
					WHERE (Status='1' and NoTrans='$notrans')");


					/*UPDATE htransaksi
					SET reaksi='$reaksi',
						pengambilan='$keberhasilan',catatan='$catatan',petugas='$petugas',status_test='2',Status='2',mu='$mu'
					WHERE (Status='1' and NoTrans='$notrans')");
				$tambah2=mysql_query("UPDATE stokkantong
					SET Status='5',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',
					kodePendonor='$kodependonor',kadaluwarsa='$kadaluwarsa',mu='$mu'
					WHERE noKantong='$id_kantong'");
				$tambah2=mysql_query("UPDATE stokkantong
					SET Status='0',mu='$mu'
					WHERE noKantong='$id_kantong'");*/

				//$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
				$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");

		}
        //disini ditambahkan sql penyimpanan data sementara
	//check apakah data temp sudah ada, jika ada, update data temp
	//yang disimpan : nama dokter, petugas tensi, petugas hb
	 //=======Audit Trial====================================================================================
	$log_mdl ='PENGAMBILAN';
	$log_aksi='Pengambilan darah: '.$notrans.' Pendonor: '.$kodependonor.' Kantong: '.$id_kantong.' status: '.$keberhasilan;
	include_once "user_log.php";
	//=====================================================================================================

	   $tambah_tmp=mysql_query("UPDATE tempudd  SET petugas3='$petugas' where modul='MU CHECKUP'");
	
		if ($tambah) {
			echo "Data Telah berhasil dimasukkan<br>";
			switch ($_SESSION[leveluser]){
				case "aftap":
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=check"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=search_pendonor"> <?
					break;
				case "p2d2s":
					?> <META http-equiv="refresh" content="2; url=pmip2d2s.php?module=search_pendonor"> <?
					break;
				case "kasir":
					?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=check"> <?
					break;
				default:
					echo "Anda tidak memiliki hak akses";
				}
		}
	} else {
		echo "No tidak sesuai, silahkan periksa status kantong.<br>";
		switch ($_SESSION[leveluser]){
			case "aftap":
				?> <META http-equiv="refresh" content="1; url=pmiaftap.php?module=spengambilan"> <?
				break;
			case "mobile":
				?> <META http-equiv="refresh" content="1; url=pmimobile.php?module=spengambilan"> <?
				break;
			case "p2d2s":
				?> <META http-equiv="refresh" content="1; url=pmip2d2s.php?module=transaksi"> <?
				break;
			case "kasir":
				?> <META http-equiv="refresh" content="1; url=pmikasir.php?module=spengambilan"> <?
				break;

			default:
				echo "Anda tidak memiliki hak akses";
		}
	}
                
	$_POST['periksa']="";
}

	$cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
	
	  $query_combo = "select * from tempudd where modul='MU CHECKUP'";
 		$hasil_combo = mysql_query($query_combo);
 		$data_combo = mysql_fetch_array($hasil_combo);
	$check=mysql_query("select * from pmi.htransaksi where (NoTrans='$_GET[NoTrans]' or NoTrans='$_POST[NoTrans]')");
	$check1=mysql_fetch_assoc($check);
	$q_dok=mysql_query("select Nama from dokter_periksa where kode='$check1[NamaDokter]'");
	$a_dok=mysql_fetch_assoc($q_dok);
	$check1[KodePendonor]=str_replace("'","\'",$check1[KodePendonor]);
	$data=mysql_query("select Nama,GolDarah,Rhesus from pendonor where Kode='$check1[KodePendonor]'");
	$data1=mysql_fetch_array($data);
	?>
	<h1 class="table">FORM PENGAMBILAN DARAH</h1>
	<form name="periksa" onsubmit="return ok()" method="post" action="<?=$PHPSELF?>" >
	<table class="form" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table class="form" cellspacing="0" cellpadding="0">
					<tr>
						<td>Kode Pendonor</td>
						<td class="input"><?=$check1[KodePendonor]?> &nbsp;</td>
					</tr>
						<td>Pengambilan</td>
						<td class="input">
						<script>
							function disabletext(val){
								if(val=='0'){
									document.getElementById('comments').disabled = true;
									document.getElementById('id_kantong11').disabled = false;
							document.getElementById('id_kantong11').type = 'text';
									}
								if(val=='2'){
							document.getElementById('id_kantong11').type = 'text';
									document.getElementById('comments').disabled = false;
								}
								if(val=='1'){
							document.getElementById('comments').disabled = false;
							document.getElementById('id_kantong11').type = 'hidden';
							
									}
							}
						</script>
						<input type='radio' name='keberhasilan' value='0' checked onclick='disabletext(this.value);'>Berhasil
						<input type='radio' name='keberhasilan' value='2' onclick='disabletext(this.value);'>Gagal
						<input type='radio' name='keberhasilan' value='1' onclick='disabletext(this.value);'>Batal &nbsp;<br>
						<!--input name='catatan' id='comments' placeholder="Keterangan"></input>&nbsp;-->
						<select name='catatan'>
						<option value="">Pilih Jika Gagal</option>
						<option value="">Mislek</option>
						<option value="Saran Dokter">Saran Dokter</option>
						<option value="Permintaan Pendonor">Permintaan Pendonor</option>
						
						</select>
						</td>
					</tr>
					<tr>
						<td>Diambil Sebanyak</td>
						<td class="input">
							<input size="5" name="volume_darah" value="350">CC
								<!--option value="1">100cc</option>
								<option selected value="2">350</option-->
							</input>
						</td>
					</tr>
					<tr>
						<td>Reaksi Donor</td>
						<td class="input">
							<select name="reaksi" >
								<option value="Mual">Mual</option>
								<option value="Pusing">Pusing</option>
								<option value="Pingsan">Pingsan</option>
								<option selected value="Normal">Tidak Ada Keluhan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Cara Ambil</td>
						<td class="input">
							<select name="caraambil" >
								<option selected value="0">Aftap</option>
								<option value="1">Tromboferesis</option>
								<option value="2">Leukaferesis</option>
								<option value="3">Plasmaferesis</option>
								<option value="4">Eritoferesis</option>
								<option value="5">Aferesis</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>No Kantong</td>
						<td class="input">
							<input name="id_kantong11" id="id_kantong11" onkeydown="chang(event,this);" type="text" size="20">
						</td>
					</tr>
					<tr>
						<td>Petugas Aftap</td>
						<td class="input">
							<select name="petugas"">
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
					<!--
					<tr>
						<td>Paket</td>
						<td class="input">
							<select name="speedB" id="speedB">
								<option>biskuit</option>
								<option>aqua</option>
							</select>
						</td>
					</tr>-->
				</table>
			</td>
			<td>
				<table class="form" cellspacing="3" cellpadding="3">
					<tr>
						<td>Nama Pendonor</td>
						<td class="input"><?=$data1[Nama]?> &nbsp;</td>
					</tr>
					<tr>
						<td>Golongan Darah &nbsp;</td>
						<td class="input"><? echo $data1[GolDarah]."(".$data1[Rhesus].")"?></td>
					</tr>
					<tr>
						<td>Nama Dokter &nbsp;</td>
						<td class="input"><?=$a_dok[Nama];?></td>
					</tr>
					<tr>
						<td>Berat</td><td class="input"><?=$check1[beratBadan];?> &nbsp;kg</td>
					</tr>
					<tr>
						<td>CuSO<sub>4</td>
						<td class="input">Tenggelam</td>
					</tr>
					<tr>
						<td>HCT</td>
						<td class="input"><?=$check1[Hct];?> &nbsp; %</td>
					</tr>
					<tr>
						<td>Tensi</td>
						<td class="input"><?=$check1[tensi];?><td>
					</tr>
					<tr>
						<td>Suhu</td>
						<td class="input"><?=$check1[suhu];?><td>
					</tr>
					<tr>
						<td>Nadi</td>
						<td class="input"><?=$check1[nadi];?><td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<br>
<input type="hidden" name="paket" value="1">
<input type="hidden" name="notrans" value="<?=$_GET[NoTrans]?>">
<input type="hidden" name="kodependonor" value="<?=$check1[KodePendonor]?>">
<input type="hidden" name="goldarah" value="<?=$data1[GolDarah]?>">
<input type="hidden" name="Rhesus" value="<?=$data1[Rhesus]?>">
<input type="submit" name="submit" value="Simpan">

</form>




<div class="alert" id="alert">
	<div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!">
		<p>Silahkan cek kembali kantong yang anda masukkan dari menu CHECK KANTONG, atau masukkan kantong lain</p>
	</div>
</div>


