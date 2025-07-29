<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem InforMasi DONor DARah</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/tgl_rekap.js"></script>
    <link type="text/css" href="css/calender.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
    <link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
</head>
<script type="text/javascript">
function setCheckedValue(radioObj, newValue) {
		if(!radioObj)
		    return;
			var radioLength = radioObj.length;
			if(radioLength == undefined) {
				radioObj.checked = (radioObj.value == newValue.toString());
				return;
			}
			for(var i = 0; i < radioLength; i++) {
				radioObj[i].checked = false;
				if(radioObj[i].value == newValue.toString()) {
					radioObj[i].checked = true;
				}
			}
	}

function suhutubuh(suhu){
		suhu=parseFloat(suhu)
		if(suhu>37){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}

function berat(hb){
		hb=parseFloat(hb)
		if(hb<45){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}
function chb(hb){
		hb=parseFloat(hb)
		if(hb!=1){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else {
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}
function sistol(hb){
		hb=parseFloat(hb)
		if(hb<90){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
		if(hb>150){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}
function diastol(hb){
		hb=parseFloat(hb)
		if(hb<60){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
		if(hb>100){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}
</script>
<?php
include ('config/dbi_connect.php');
include ('clogin.php');
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$namaudd=$_SESSION['namaudd'];
$tempat = mysqli_fetch_assoc(mysqli_query($dbi,"select * from tempat_donor where active='1'"));
$shift = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama,jam,sampai_jam FROM `shift` WHERE (time(jam)<=current_time and time(sampai_jam)>=current_time)"));
$shif = $shift['nama'];

if (isset($_POST['simpan'])) { 
    $v_notransaksi = $_POST['notransaksi'];
    $v_kodedonor   = $_POST['kodedonor'];
    $v_goldarah    = $_POST['goldarah'];
    $v_rhesus      = $_POST['rhesus'];
    $v_goldarah_a  = $_POST['abo_pendonor'];
    $v_rhesus_a    = $_POST['rh_pendonor'];
    $v_bb          = $_POST['reqberat_badan'];
    $v_tb          = $_POST['tinggi_badan'];
    $v_sistol      = $_POST['reqtensi_sistol'];
    $v_diastol     = $_POST['reqtensi_diastol'];
    $v_suhu        = $_POST['reqtemperatur']; 
    $v_nadi        = $_POST['reqnadi']; 
    $v_ptgdokter   = $_POST['id_dokter']; 
    $v_ptgtensi    = $_POST['id_tensi']; 
    $v_ptgshb      = $_POST['id_hb']; 
    $v_lolos       = $_POST['h_medical']; 
    $v_alasan      = $_POST['alasan']; 
    $v_no1         = $_POST['no1'];
    $v_no2         = $_POST['no2'];
    $v_no3         = $_POST['no3'];
    $v_no4         = $_POST['no4'];
    $v_no5         = $_POST['no5'];
    $v_no6         = $_POST['no6'];
    $v_no7         = $_POST['no7'];
    $v_no8         = $_POST['no8'];
    $v_no9         = $_POST['no9'];
    $v_no10        = $_POST['no10'];
    $v_no11        = $_POST['no11'];
    $v_no12        = $_POST['no12'];
    $v_no13        = $_POST['no13'];
    $v_no14        = $_POST['no14'];
    $v_no15        = $_POST['no15'];
    $v_no16        = $_POST['no16'];
    $v_no17        = $_POST['no17'];
    $v_no18        = $_POST['no18'];
    $v_no19        = $_POST['no19'];
    $v_no20        = $_POST['no20'];
    $v_no21        = $_POST['no21'];
    $v_no22        = $_POST['no22'];
    $v_no23        = $_POST['no23'];
    $v_no24        = $_POST['no24'];
    $v_no25        = $_POST['no25'];
    $v_no26        = $_POST['no26'];
    $v_no27        = $_POST['no27'];
    $v_no28        = $_POST['no28'];
    $v_no29        = $_POST['no29'];
    $v_no30        = $_POST['no30'];
    $v_no31        = $_POST['no31'];
    $v_no32        = $_POST['no32'];
    $v_no33        = $_POST['no33'];
    $v_no34        = $_POST['no34'];
    $v_no35        = $_POST['no35'];
    $v_no36        = $_POST['no36'];
    $v_no37        = $_POST['no37'];
    $v_no38        = $_POST['no38'];
    $v_no39        = $_POST['no39'];
    $v_no40        = $_POST['no40']; 
    $v_no41        = $_POST['no41']; 
    $v_no42        = $_POST['no42']; 
    $v_no43        = $_POST['no43']; 
    $v_sample      = $_POST['reqid_sample']; 
    $v_hematokrit  = $_POST['reqhematokrit'];
    $v_hemoglobin  = $_POST['reqhemoglobin'];
    $v_trombosit   = $_POST['reqtrombosit'];
    $v_leukosit    = $_POST['reqleukosit'];
    $v_tgl_pcr_pos = $_POST['tgl_positif'];
    $v_tgl_pcr_neg = $_POST['tgl_negatif'];
    $v_fdonor      = $_POST['pernahdonor'];
    $v_fdonor_a    = $_POST['pernahdonor_a'];
    $v_rtrans      = $_POST['pernahdonor_t'];
    $v_hamil       = $_POST['hamil'];
    $v_jmlanak     = $_POST['jumlahanak'];
    $v_jantung     = $_POST['jantung'];
    $v_hipertensi  = $_POST['hipertensi'];
    $v_paru        = $_POST['paru'];
    $v_hati        = $_POST['hati'];
    $v_ginjal      = $_POST['ginjal'];
    $v_kronik      = $_POST['kronik'];
    $v_hiv         = $_POST['hiv'];
    $v_panas       = $_POST['panas'];
    $v_batuk       = $_POST['batuk'];
    $v_tenggorokan = $_POST['tenggorokan'];
    $v_sesak       = $_POST['sesak'];
    $v_pilek       = $_POST['pilek'];
    $v_lesu        = $_POST['lesu'];
    $v_kepala      = $_POST['kepala'];
    $v_diare       = $_POST['diare'];
    $v_muntah      = $_POST['muntah'];

    echo 'Nomor 1 '.$v_no1.'<br>';
    echo 'Nomor 3 '.$v_no3.'<br>';
    //Update htransaksi
    //Insert htransaksi_ic
    //Insert/Update attrib_tpk
    //Update kode_sampel
    //Cek dan konfirmasi parameter yang tidak sesuai apabila diloloskan
    if ($v_lolos=='0'){
        //Check validasi parameter2 yang dapat dilakukann secara komputansi
        //Berat, Tensi, Suhu, IC Tidak Sehat, 
        //APH
        //TPK : Pernah transfusi 6 bulan, Komorbid,
        //Hasil Lab

    }else{
        //KOnfirmasi tidak lolos
    }
}

$kode_donor=$_GET['kode'];
$kode_transaksi=$_GET['trx'];
$namauser = $_SESSION['namauser'];
$lv0='pmi'.$_SESSION['leveluser'];
$today1=date("Y-m-d H:i:s");
$today2=date("Y-m-d");
$jam_donor=date("H:i:s");
$tipe_donor='0';
$qdonor=mysqli_query($dbi,"select * from `pendonor` where `Kode`='$kode_donor'");
$qtrans=mysqli_fetch_assoc(mysqli_query($dbi,"select * from `htransaksi` where `NoTrans`='$kode_transaksi'"));
$dtdonor=mysqli_fetch_assoc($qdonor);
$jenis_pengambilan='Donor Biasa';$msg="DONOR BIASA";
if($qtrans['apheresis']=='1'){$jenis_pengambilan="Donor Apheresis";$msg="APHERESIS";}
if($qtrans['donor_tpk']=='1'){$jenis_pengambilan="Donor Plasma Konvalesen";$msg="PLASMA KONVALESEN";}
$qtrans['KodePendonor']=str_replace("'","\'",$qtrans['KodePendonor']);
$swab=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT *, DATEDIFF(current_date,`pcr_tglperiksa`) as hari FROM `covid_pcr` WHERE `pcr_pendonor`='$kode_donor' order by `pcr_tglperiksa` DESC limit 1"));
$hasiswab='Tidak ada data';
$ln=strlen($swab['pcr_hasil']);
if($ln>0){
    $hasiswab=$swab['pcr_tglperiksa'].', (<b>'.$swab['pcr_hasil'].'</b>)'.' - '.$swab['hari'].' hari';
}

?>
<div class="container-fluid" style="padding-top:20px;margin-left:15px;margin-right:15px;">
    <div class="row">
        <div class="col-6 pull-left">
            <div style="font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">INFORMED CONCENT - <?php echo $msg;?></div>
        </div>
        <div class="col-6 pull-right">
            <div class="text-danger blink" id="alert1"></div>
        </div>
    </div>
    <div class="row">
        <form name="periksa" autocomplete="off" id="periksa" action="" method="post" onSubmit="return checkrequired(this)">
            <input type="hidden" name="notransaksi" value="<?php echo $kode_transaksi;?>">
            <input type="hidden" name="kodedonor" value="<?php echo $kode_donor;?>">
            <div class="panel with-nav-tabs panel-default bayangan">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_pendonor" data-toggle="tab">Pendonor</a></li>
                            <li><a href="#tab_ic" data-toggle="tab">Inform Concent</a></li>
                            <?php
                            if ($qtrans['donor_tpk']=='1'){
                                echo '<li><a data-toggle="tab" href="#tab_ictpk">Inform Concent PK</a></li>';
                            }
                            ?>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        
                        <div id="tab_pendonor" class="tab-pane fade in active"> 
                            <div class="col-xs-6" >
                                <?php
                                ($dtdonor['Jk']=='0') ? $kel="Laki-laki" : $kel="Perempuan" ; 
                                ($dtdonor['Status']=='0') ? $status="Belum Menikah" : $status="Sudah Menikah" ; 
                                ?>
                                <div class="table-responsive" id="shadow1">
                                    <table class="table borderless table-striped table-hover">
                                        <tr><td>Kode</td><td><?php echo $dtdonor['Kode'];?></td></tr>
                                        <tr><td>NIK</td><td><?php echo $dtdonor['NoKTP'];?></td></tr>
                                        <tr><td>Nama</td><td><strong><?php echo $dtdonor['Nama'];?></strong></td></tr>
                                        <tr><td>Gol</td><td><strong><?php echo $dtdonor['GolDarah'].' ('.$dtdonor['Rhesus'].')';?></strong></td></tr>
                                        <tr><td>Kelamin</td><td><?php echo $kel;?></td></tr>
                                        <tr><td>Status</td><td><?php echo $status;?></td></tr>
                                        <tr><td>Tempat Lahir</td><td><?php echo $dtdonor['TempatLhr'];?></td></tr>
                                        <tr><td>Tanggal Lahir</td><td><?php echo $dtdonor['TglLhr'];?></td></tr>
                                        <tr><td>Jumlah Donasi</td><td><?php echo $dtdonor['jumDonor'];?></td></tr>
                                        <tr><td>Tgl Kembali Donor</td><td><?php echo $dtdonor['tglkembali'];?></td></tr>
                                        <tr><td>Tgl Kembali Apheresis</td><td><?php echo $dtdonor['tglkembali_apheresis'];?></td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    
                                </div>
                            </div>
                        </div>
                        <div id="tab_ic" class="tab-pane fade">
                            <div class="col-xs-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table borderless table-striped table-condensed">
                                        <tr><td>1</td><td>Merasa sehat pada hari ini? (tidak sedang flue/batuk/demam/pusing)</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no1" value="0">
                                                    <input type="checkbox" name="no1" class="onoffswitch-checkbox" id="no1" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no1"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>2</td><td>Apakah anda semalam tidur minimal 4 jam?</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no2" value="0">
                                                    <input type="checkbox" name="no2" class="onoffswitch-checkbox" id="no2" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no2"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>3</td><td>Apakah anda sedang minum obat?</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no3" value="0">
                                                    <input type="checkbox" name="no3" class="onoffswitch-checkbox" id="no3" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no3"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>4</td><td>Apakah anda minum jamu?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no4" value="0">
                                                    <input type="checkbox" name="no4" class="onoffswitch-checkbox" id="no4" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no4"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>5</td><td>Apakah anda mencabut gigi?</td>
                                        <td><div class="onoffswitch">   
                                                    <input type="hidden" name="no5" value="0">
                                                    <input type="checkbox" name="no5" class="onoffswitch-checkbox" id="no5" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no5"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>6</td><td>Apakah anda mengalami deman lebih dari 38 derajat celcius?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no6" value="0">
                                                    <input type="checkbox" name="no6" class="onoffswitch-checkbox" id="no6" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no6"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>7</td><td>Apakah anada sedang hamil?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no7" value="0">
                                                    <input type="checkbox" name="no7" class="onoffswitch-checkbox" id="no7" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no7"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>8</td><td>Apakah anda mendonorkan darah trombosit atau plasma?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no8" value="0">
                                                    <input type="checkbox" name="no8" class="onoffswitch-checkbox" id="no8" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no8"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>9</td><td>Apakah anda menerima vaksinasi atau suntikan lain?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no9" value="0">
                                                    <input type="checkbox" name="no9" class="onoffswitch-checkbox" id="no9" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no9"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>10</td><td>Apakah anda oernah kontak dengan orang yang pernah menerima vaksinasi smallpox?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no10" value="0">
                                                    <input type="checkbox" name="no10" class="onoffswitch-checkbox" id="no10" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no10"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>11</td><td>Apakah anda mendonorkan 2 kantong sel darah merah melalui proses aferesis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no11" value="0">
                                                    <input type="checkbox" name="no11" class="onoffswitch-checkbox" id="no11" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no11"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>12</td><td>Apakah anda saat ini menyusui?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no12" value="0">
                                                    <input type="checkbox" name="no12" class="onoffswitch-checkbox" id="no12" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no12"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>13</td><td>Apakah penah anda menerima transfusi darah?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no13" value="0">
                                                    <input type="checkbox" name="no13" class="onoffswitch-checkbox" id="no13" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no13"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>14</td><td>Apakah anda pernah mendapat transplantasi, organ, jaringan atau sumsum tulang?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no14" value="0">
                                                    <input type="checkbox" name="no14" class="onoffswitch-checkbox" id="no14" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no14"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>15</td><td>Apakah anda pernah cangkok tulang untuk kulit?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no15" value="0">
                                                    <input type="checkbox" name="no15" class="onoffswitch-checkbox" id="no15" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no15"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>16</td><td>Apakah anda pernah tertusuk jarum medis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no16" value="0">
                                                    <input type="checkbox" name="no16" class="onoffswitch-checkbox" id="no16" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no16"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>17</td><td>Apakah anda pernah berhubungan seks dengan orang dengan HIV/AIDS?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no17" value="0">
                                                    <input type="checkbox" name="no17" class="onoffswitch-checkbox" id="no17" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no17"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>18</td><td>Apakah anda pernah berhubungan seks dengan pekerja seks komersial?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no18" value="0">
                                                    <input type="checkbox" name="no18" class="onoffswitch-checkbox" id="no18" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no18"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>19</td><td>Apakah anda pernah berhubungan seks dengan penggunaan narkoba jarum suntik?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no19" value="0">
                                                    <input type="checkbox" name="no19" class="onoffswitch-checkbox" id="no19" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no19"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>20</td><td>Apakah anda pernah berhubungan seks dengan pengguna konsentrat faktor pembekuan?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no20" value="0">
                                                    <input type="checkbox" name="no20" class="onoffswitch-checkbox" id="no20" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no20"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>21</td><td>Donor Wanita, Apakah anda pernah berhububgan seks dengan laki-laki biseksual?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no21" value="0">
                                                    <input type="checkbox" name="no21" class="onoffswitch-checkbox" id="no21" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no21"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table borderless table-striped table-condensed"">
                                        <tr><td>22</td><td>Apakah anda pernah berhubungan dengan penderita hepatitis?</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no22" value="0">
                                                    <input type="checkbox" name="no22" class="onoffswitch-checkbox" id="no22" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no22"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>23</td><td>Apakah anda pernah tinggal bersama penderita hepatitis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no23" value="0">
                                                    <input type="checkbox" name="no23" class="onoffswitch-checkbox" id="no23" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no23"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>24</td><td>Apakah anda memiliki tatto></td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no24" value="0">
                                                    <input type="checkbox" name="no24" class="onoffswitch-checkbox" id="no24" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no24"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>25</td><td>Apakah anda menindik telinga atau bagian tubuh lainnya?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no25" value="0">
                                                    <input type="checkbox" name="no25" class="onoffswitch-checkbox" id="no25" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no25"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>26</td><td>Apakah anda sedang atau pernah mendapatkan pengobatan Sifilis atau GO (Kencing Nanah)?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no26" value="0">
                                                    <input type="checkbox" name="no26" class="onoffswitch-checkbox" id="no26" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no26"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>27</td><td>Apakah anda pernah ditahan/dipenjara dalam waktu 72 jam?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no27" value="0">
                                                    <input type="checkbox" name="no27" class="onoffswitch-checkbox" id="no27" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no27"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>28</td><td>Apakah anda pernah berada diluar wilayah Indonesia?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no28" value="0">
                                                    <input type="checkbox" name="no28" class="onoffswitch-checkbox" id="no28" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no28"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>29</td><td>Apakah anda menerima uang, obat, atau pembayaran lainnya untuk seks?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no29" value="0">
                                                    <input type="checkbox" name="no29" class="onoffswitch-checkbox" id="no29" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no29"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>30</td><td>Laki-laki : Apakah anda pernah berhubungan seksual dengan laki-laki, walaupun sekali?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no30" value="0">
                                                    <input type="checkbox" name="no30" class="onoffswitch-checkbox" id="no30" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no30"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>31</td><td>Apakah anda tinggal selama 5 tahun atau lebih di Eropa?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no31" value="0">
                                                    <input type="checkbox" name="no31" class="onoffswitch-checkbox" id="no31" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no31"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>32</td><td>Apakah anda pernah menerima transfusi darah di Inggris?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no32" value="0">
                                                    <input type="checkbox" name="no32" class="onoffswitch-checkbox" id="no32" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no32"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>33</td><td>Apakah anda tinggal selama 3 bulan atau lebih di Inggris?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no33" value="0">
                                                    <input type="checkbox" name="no33" class="onoffswitch-checkbox" id="no33" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no33"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>34</td><td>Apakah anda pernah mendapat hasil Positif untuk test HIV/AIDS?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no34" value="0">
                                                    <input type="checkbox" name="no34" class="onoffswitch-checkbox" id="no34" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no34"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>35</td><td>Apakah anda menggunakan jarum suntik untuk obat-obatan?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no35" value="0">
                                                    <input type="checkbox" name="no35" class="onoffswitch-checkbox" id="no35" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no35"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>36</td><td>Apakah anda menggunakan konsentrat pembekuan?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no36" value="0">
                                                    <input type="checkbox" name="no36" class="onoffswitch-checkbox" id="no36" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no36"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>37</td><td>Apakah anda menderita Hepatitis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no37" value="0">
                                                    <input type="checkbox" name="no37" class="onoffswitch-checkbox" id="no37" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no37"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>38</td><td>Apakah anda menderita Malaria?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no38" value="0">
                                                    <input type="checkbox" name="no38" class="onoffswitch-checkbox" id="no38" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no38"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>39</td><td>Apakah anda menderita Kanker?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no39" value="0">
                                                    <input type="checkbox" name="no39" class="onoffswitch-checkbox" id="no39" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no39"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>40</td><td>Apakah anda bermasalah dengan jantung dan atau paru?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no40" value="0">
                                                    <input type="checkbox" name="no40" class="onoffswitch-checkbox" id="no40" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no40"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>41</td><td>Apakah anda menderita perdarahan atau penyakit berhubungan dengan darah?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no41" value="0">
                                                    <input type="checkbox" name="no41" class="onoffswitch-checkbox" id="no41" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no41"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>42</td><td>Apakah anda pernah berhubungan seksual dengan orang-orang tinggal di Afrika?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no42" value="0">
                                                    <input type="checkbox" name="no42" class="onoffswitch-checkbox" id="no42" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no42"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td>43</td><td>Apakah anda pernah tinggal di Afrika?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no43" value="0">
                                                    <input type="checkbox" name="no43" class="onoffswitch-checkbox" id="no43" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="no43"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab_sampel" class="tab-pane fade">
                            <div class="col-xs-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <td>Kode Sample<sup style="color:red;"><strong>*</strong></sup></td>
                                            <td  colspan="3">
                                                <input name="reqid_sample" id="id_sample"  type="text" onkeyup="showHint(this.value)" maxlength="15">
                                                <input name="reqid_samplevalid" id="id_samplevalid"  type="hidden">
                                            </td>
                                        </tr>
                                        <?php 
                                        if($qtrans['donor_tpk']=='1'){
                                            echo'
                                                <tr>
                                                    <td colspan="2" style="font-size:110%;font-weight:bold;">SYARAT DONOR PLASMA KONVALESEN</td>
                                                </tr>
                                                <tr>
                                                    <td>Swab PCR Covid-19</td><td>'.$hasiswab.'</td>
                                                </tr>
                                                <tr>
                                                    <td>Titer Antibody Covid-19</td>
                                                    <td><div id="titer"></div></td>
                                                </tr>';
                                        }
                                        ?>
                                        
                                        <tr>
                                            <td>Antibody Screening</td> <td colspan="3"  style="white-space:nowrap;" id="abs"></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="col-xs-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <td colspan="4" style="font-size:110%;font-weight:bold;">HASIL DARAH LENGKAP</td>
                                        </tr>
                                        <tr>
                                            <td>Hematokrit<sup style="color:red;"><strong>*</strong></sup></td><td style="white-space:nowrap;"><input style='width:15mm' name="reqhematokrit" id="hematokrit" type="text" maxlength="3"> %</td>
                                            <td>Hemoglobin<sup style="color:red;"><strong>*</strong></sup></td><td style="white-space:nowrap;"><input style='width:15mm' name="reqhemoglobin" id="hemoglobin" type="text" maxlength="5"> g/dL</td>
                                        </tr>
                                        <tr>
                                            <td>Trombosit<sup style="color:red;"><strong>*</strong></sup></td><td style="white-space:nowrap;"><input style='width:15mm' name="reqtrombosit" id="trombosit" type="text" maxlength="5">10<sup>3</sup>/&micro;l</td>
                                            <td>Leukosit<sup style="color:red;"><strong>*</strong></sup></td><td><input style='width:15mm' name="reqleukosit" id="leukosit"  type="text" maxlength="5">10<sup>3</sup>/&micro;l</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"  style="font-size:110%;font-weight:bold;">UJI SARING & KGD</td>
                                        </tr>
                                        <tr>
                                            <td>IMLTD Elisa/Chlia</td><td colspan="3"  style="white-space:nowrap;" id="imltd"></td>
                                        </tr>
                                        <tr>
                                            <td>IMLTD NAT</td><td colspan="3"  style="white-space:nowrap;" id="nat"></td>
                                        </tr>
                                        <tr>
                                            <td>Konfirmasi Gol Darah</td><td colspan="3"  style="white-space:nowrap;" id="kgd"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab_ictpk" class="tab-pane fade">
                            <div class="col-xs-4">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table borderless table-striped">
                                        <tr><td>Tgl Pos Covid-19<sup style="color:red;"><strong>*</strong></sup></td><td><input type="text" name="tgl_positif" id="datepicker" class="form-control input-sm" value="<?php echo $tgl1;?>"></td></tr>
                                        <tr><td>Tgl Sembuh Covid-19</td><td><input type="text" name="tgl_negatif" id="datepicker1" class="form-control input-sm" value="<?php echo $tgl1;?>"></td></tr>
                                        <tr>
                                            <td>Pernah Donor biasa</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="pernahdonor" value="0">
                                                    <input type="checkbox" name="pernahdonor" class="onoffswitch-checkbox" id="pernahdonor" tabindex="0" value="1">
                                                    <label class="onoffswitch-label" for="pernahdonor"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pernah Donor Apheresis</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="pernahdonor_a" value="0">
                                                    <input type="checkbox" name="pernahdonor_a" class="onoffswitch-checkbox" id="pernahdonor_a" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="pernahdonor_a"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pernah Transfusi (6 bln terakhir)</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="pernahdonor_t" value="0">
                                                    <input type="checkbox" name="pernahdonor_t" class="onoffswitch-checkbox" id="pernahdonor_t" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="pernahdonor_t"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                                if ($dtdonor['Jk']=='1'){
                                                    echo '
                                                    <tr>
                                                        <td>Pernah hamil?</td>
                                                        <td>
                                                            <div class="onoffswitch">
                                                                <input type="hidden" name="hamil" value="0">
                                                                <input type="checkbox" name="hamil" class="onoffswitch-checkbox" id="hamil" tabindex="1" value="1">
                                                                <label class="onoffswitch-label" for="hamil"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah anak</td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" name="jumlahanak" value="0">
                                                        </td>
                                                    </tr>
                                                    ';
                                                }
                                                ?>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table borderless  table-striped">
                                        <tr><td colspan="2" class="bg-danger"><strong>Penyakit penyerta/komorbid</strong></td></tr>
                                        <tr>
                                            <td>Penyakit jantung</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="jantung" value="0">
                                                    <input type="checkbox" name="jantung" class="onoffswitch-checkbox" id="jantung" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="jantung"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penyakit Hipertensi</td>
                                            <td style="width:15mm;">
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="hipertensi" value="0">
                                                    <input type="checkbox" name="hipertensi" class="onoffswitch-checkbox" id="hipertensi" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="hipertensi"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penyakit paru-paru</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="paru" value="0">
                                                    <input type="checkbox" name="paru" class="onoffswitch-checkbox" id="paru" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="paru"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penyakit Hati/Liver</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="hati" value="0">
                                                    <input type="checkbox" name="hati" class="onoffswitch-checkbox" id="hati" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="hati"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penyakit Ginjal</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="ginjal" value="0">
                                                    <input type="checkbox" name="ginjal" class="onoffswitch-checkbox" id="ginjal" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="ginjal"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penyakit Kronik/Neuromuskular</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="kronik" value="0">
                                                    <input type="checkbox" name="kronik" class="onoffswitch-checkbox" id="kronik" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="kronik"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penyakit HIV</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="hiv" value="0">
                                                    <input type="checkbox" name="hiv" class="onoffswitch-checkbox" id="hiv" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="hiv"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>    
                            </div>
                            <div class="col-xs-4">
                                <div class="table-responsive" id="shadow1">
                                    <table class="table borderless table-striped">
                                        <tr><td colspan="2" class="bg-danger"><strong>Riwayat Gejala klinis</strong></td></tr>
                                        <tr>
                                            <td>Panas/demam > 38<sup>o</sup> celcius</td>
                                            <td  style="width:15mm;">
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="panas" value="0">
                                                    <input type="checkbox" name="panas" class="onoffswitch-checkbox" id="panas" tabindex="0" value="1">
                                                    <label class="onoffswitch-label" for="panas"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Batuk</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" name="batuk" class="onoffswitch-checkbox" id="batuk" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="batuk"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sakit tenggorokan</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="tenggorokan" value="0">
                                                    <input type="checkbox" name="tenggorokan" class="onoffswitch-checkbox" id="tenggorokan" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="tenggorokan"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sesak napas</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="sesak" value="0">
                                                    <input type="checkbox" name="sesak" class="onoffswitch-checkbox" id="sesak" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="sesak"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pilek</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="pilek" value="0">
                                                    <input type="checkbox" name="pilek" class="onoffswitch-checkbox" id="pilek" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="pilek"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lesu</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="lesu" value="0">
                                                    <input type="checkbox" name="lesu" class="onoffswitch-checkbox" id="lesu" tabindex="1">
                                                    <label class="onoffswitch-label" for="lesu"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sakit kepala</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="kepala" value="0">
                                                    <input type="checkbox" name="kepala" class="onoffswitch-checkbox" id="kepala" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="kepala"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Diare</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="diare" value="0">
                                                    <input type="checkbox" name="diare" class="onoffswitch-checkbox" id="diare" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="diare"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mual dan Muntah</td>
                                            <td>
                                                <div class="onoffswitch">
                                                    <input type="hidden" name="muntah" value="0">
                                                    <input type="checkbox" name="muntah" class="onoffswitch-checkbox" id="muntah" tabindex="1" value="1">
                                                    <label class="onoffswitch-label" for="muntah"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-6 pull-left">
                            
                        </div>
                        <div class="col-6 pull-right" style="margin-right:20px;">
                            <input type=submit name="simpan" value="Proses" class="btn btn-primary bayangan">
                            <a href="<?=$lv0?>.php?module=check" class="btn btn-danger bayangan">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<style>
.top-buffer { margin-top:20px; }
    a:link {
    color: white;
    background-color: transparent;
    text-decoration: none;
    }
    a:visited {
    color: pink;
    background-color: transparent;
    text-decoration: none;
    }
    a:hover {
    color: red;
    background-color: transparent;
    text-decoration: underline;
    }
    a:active {
    color: yellow;
    background-color: transparent;
    text-decoration: underline;
    }
    .blink {
        animation: blinker 1.7s linear infinite;
        color: red;
        font-size: 16px;
        font-weight: bold;
      }
      @keyframes blinker {
        50% {
          opacity: 0;
        }
      }
</style>

<script type="text/javascript">
function showHint(str){
   if (str.length==0){ 
      document.getElementById("imltd").innerHTML="Input kode sampel";
      document.getElementById("nat").innerHTML="Input kode sampel";
      document.getElementById("kgd").innerHTML="Input kode sampel";
      document.getElementById("titer").innerHTML="Input kode sampel";
      document.getElementById("abs").innerHTML="Input kode sampel";
      return;
   }
   if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
   } else  {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
   xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
          var hasil=xmlhttp.responseText;
          var res = hasil.split(";");
         document.getElementById("imltd").innerHTML=res[0];
         document.getElementById("nat").innerHTML=res[1];
         document.getElementById("kgd").innerHTML=res[2];
         document.getElementById("hemoglobin").value=res[4];
         document.getElementById("hematokrit").value=res[5];
         document.getElementById("trombosit").value=res[6];
         document.getElementById("leukosit").value=res[7];
         document.getElementById("abs").innerHTML=res[8];
         document.getElementById("id_samplevalid").value=res[9];
         if (document.getElementById('titer')){
             document.getElementById("titer").innerHTML=res[3];}
      }
   }
   xmlhttp.open("GET","tpk/gethasilab.php?q="+str,true);
   xmlhttp.send();
}
function checkrequired(which){
    var pass=true
    if (document.images){
        for (i=0;i<which.length;i++){
            var tempobj=which.elements[i]
            if (tempobj.name.substring(0,3)=="req"){
                if (((tempobj.type=="text"||tempobj.type=="hidden"||tempobj.type=="textarea")&&tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
                    pass=false
                    break
                }
            }
        }
    }
    if (!pass){
        alert("Beberapa parameter masih belum terisi atau belum valid, data belum bisa disimpan!");
        document.getElementById("alert1").innerHTML=" Lengkapi data dengan benar sebelum disimpan!";
        return false
    }
        else
        return true
}
</script>   