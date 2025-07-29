<!---
berat >=45
tensi kosongi keputusan lewat centang
Harus isi berat, tensi
-->
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
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        document.periksa.satu.focus();
      });
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
            function hct(hb){
                var x = document.getElementById("hb");
                document.getElementById('hct').value = x*3;


                }
            function chb(hb){
                hb=parseFloat(hb)
                if(hb!=1){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                    }
                else {
                    if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
                }
            function berat(hb){
                if(hb=='-'){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');}
                    document.getElementById("pesan").style.display="inline";
                hb=parseFloat(hb)
                if(hb<45){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else if(hb>=45){
                    setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
            }
            function sistol(hb){
                hb=parseFloat(hb)
                if(hb<90){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else{
                    if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
                if(hb>160){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else{
                    if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
            }
            function diastol(hb){
                hb=parseFloat(hb)
                if(hb<60){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else{
                    if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
                if(hb>100){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else{
                    if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
            }
            
            function cek(hb){
                hb=parseFloat(hb)
                if(hb<12.5){
                    setCheckedValue(document.periksa.elements['cuso4'],'2');
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else if (hb>17){
                    setCheckedValue(document.periksa.elements['cuso4'],'2');
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else{
                    setCheckedValue(document.periksa.elements['cuso4'],'1');
                    setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";
                }
            }

            function suhu(hb){
                hb=parseFloat(hb)
                if(hb<36.5){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else if (hb>37.5){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                } else {
                    setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";}
            }

            function nadi(hb){
                hb=parseFloat(hb)
                if(hb<50){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                }else if (hb>100){
                    setCheckedValue(document.periksa.elements['h_medical'],'1');
                    document.getElementById("pesan").style.display="inline";
                } else {
                    setCheckedValue(document.periksa.elements['h_medical'],'0');
                    document.getElementById("pesan").style.display="none";}
            }
            function pesan(nilai){
                if (nilai == 1 ) document.getElementById("pesan").style.display="inline";
                else document.getElementById("pesan").style.display="none";
            }
    </script>

<?
include ('config/db_connect.php');
include ('clogin.php');
session_start();
$lv0=$_SESSION[leveluser];
$user=$_SESSION[namauser];
if ($_POST['periksa']=="1" ) { if ($_POST[berat_badan]!="" and $_POST[tensi_sistol]!="" and $_POST[tensi_diastol]!=""){
    //print_r($_POST);
    $kdl         = mktime(0,0,0,date("m"),date("d")+35,date("Y"));
    $kembali0     = mktime(0,0,0,date("m"),date("d")+75,date("Y"));
    $kembali     = date('Y-m-d',$kembali0);
    $kadaluwarsa    = date("Y-m-d",$kdl);
    $tensi         = $_POST['tensi_sistol']."/".$_POST['tensi_diastol'];
    $idp        = mysql_query("select * from tempat_donor where active='1'");
    $status_test    = 1;
    $today         = date('Y-m-d H:i:s');
    $hariini    = date('Y-m-d');
    $kodependonor   = $_POST['kodependonor'];
    $namapendonor   = $_POST['namapendonor'];
    $notrans    = $_POST['notrans'];
    $cuso4            = $_POST['cuso4'];
    $HCT         = $_POST['HCT'];
    //if ($_POST[h_medical]=='1') $cuso4='4';
    $kuesioner    = $_POST['kuesioner'];
    //$cek_kuesioner    = $_POST['cek_kuesioner'];
    $berat_badan    = $_POST['berat_badan'];
    $id_dokter     = $_POST['id_dokter'];
    $temperatur     = $_POST['temperatur'];
    $nadi         = $_POST['nadi'];
    $gol_darah     = $_POST['goldarah'];
    $rhesus     = $_POST['rhesus'];
    $id_tensi    = $_POST['id_tensi'];
    $id_hb        = $_POST['id_hb'];
    $apheresis    = $_POST['apheresis1'];
    $idp1        = mysql_fetch_assoc($idp);
    $hb        = $_POST['hb'];
    $alasan        = $_POST['alasan'];
    $donorke    = $_POST['donorke'];

    $satu=$_POST['satu'];        $dua=$_POST['dua'];        $tiga=$_POST['tiga'];
    $empat=$_POST['empat'];        $lima=$_POST['lima'];        $enam=$_POST['enam'];
    $tujuh=$_POST['tujuh'];        $delapan=$_POST['delapan'];    $sembilan=$_POST['sembilan'];
    $sepuluh=$_POST['sepuluh'];    $sebls=$_POST['sebls'];        $duabls=$_POST['duabls'];
    $tigabls=$_POST['tigabls'];    $empatbls=$_POST['empatbls'];    $limabls=$_POST['limabls'];
    $enambls=$_POST['enambls'];    $tujuhbls=$_POST['tujuhbls'];    $delapanbls=$_POST['delapanbls'];
    $sembilanbls=$_POST['sembilanbls'];                $duapuluh=$_POST['duapuluh'];
    $duasatu=$_POST['duasatu'];    $duadua=$_POST['duadua'];    $duatiga=$_POST['duatiga'];
    $duaempat=$_POST['duaempat'];    $dualima=$_POST['dualima'];    $duaenam=$_POST['duaenam'];
    $duatujuh=$_POST['duatujuh'];                    $duadelapan=$_POST['duadelapan'];
    $duasembilan=$_POST['duasembilan'];                $tigapuluh=$_POST['tigapuluh'];
    $tigasatu=$_POST['tigasatu'];    $tigadua=$_POST['tigadua'];    $tigatiga=$_POST['tigatiga'];
    $tigaempat=$_POST['tigaempat'];    $tigalima=$_POST['tigalima'];    $tigaenam=$_POST['tigaenam'];
    $tigatujuh=$_POST['tigatujuh'];                    $tigadelapan=$_POST['tigadelapan'];
    $tigasembilan=$_POST['tigasembilan'];                $empatpuluh=$_POST['empatpuluh'];
    $empatsatu=$_POST['empatsatu'];    $empatdua=$_POST['empatdua'];    $empattiga=$_POST['empattiga'] ;



    
    if ($_POST[h_medical]=='1') {$pengambilan="1" and $status="-" and $jumHB="-";}else{$pengambilan='3' and $status="1" and $jumHB=$cuso4;}
    if ($_POST[h_medical]=='1') {$ketbatal=$alasan;}else{$ketbatal='-';}
    if (substr($idp1[id1],0,1)=="M") {
        $mu="1";
    } else {
    $mu="";
    }
    $tambah_sql="UPDATE htransaksi    SET NoForm ='$kuesioner', petugasTensi='$user',beratbadan='$berat_badan', tensi='$tensi',suhu='$temperatur',nadi='$nadi', status_test='1', Status='$status', Pengambilan='$pengambilan',ketBatal='$ketbatal',
                        mu='$mu' WHERE (NoTrans='$notrans')";

$cek_kuesioner = mysql_fetch_assoc(mysql_query("select transaksi from `antrian` where transaksi='$notrans'"));
if ($cek_kuesioner[transaksi] == $notrans){
$update_kuesioner = mysql_query("UPDATE `antrian` SET
`satu`='$satu',`dua`='$dua',`tiga`='$tiga',`empat`='$empat',`lima`='$lima',`enam`='$enam',`tujuh`='$tujuh',`delapan`='$delapan',
`sembilan`='$sembilan',`sepuluh`='$sepuluh',`sebls`='$sebls',`duabls`='$duabls', `tigabls`='$tigabls',`empatbls`='$empatbls',
`limabls`='$limabls',`enambls`='$enambls',`tujuhbls`='$tujuhbls',`delapanbls`='$delapanbls',`sembilanbls`='$sembilanbls',
`duapuluh`='$duapuluh',`duasatu`='$duasatu',`duadua`='$duadua',`duatiga`='$duatiga',`duaempat`='$duaempat',`dualima`='$dualima',
`duaenam`='$duaenam',`duatujuh`='$duatujuh',`duadelapan`='$duadelapan',`duasembilan`='$duasembilan',`tigapuluh`='$tigapuluh',
`tigasatu`='$tigasatu',`tigadua`='$tigadua',`tigatiga`='$tigatiga',`tigaempat`='$tigaempat',`tigalima`='$tigalima',
`tigaenam`='$tigaenam',`tigatujuh`='$tigatujuh',`tigadelapan`='$tigadelapan',`tigasembilan`='$tigasembilan',
`empatpuluh`='$empatpuluh',`empatsatu`='$empatsatu',`empatdua`='$empatdua',`empattiga`='$empattiga', stat='$kuesioner' WHERE `transaksi`='$notrans'");} else {
$insert_kuesioner = mysql_query("
INSERT INTO `antrian`(`nama`, `tgl`, `pendonor`, `transaksi`, `satu`, `dua`, `tiga`, `empat`, `lima`, `enam`, `tujuh`, `delapan`, `sembilan`, `sepuluh`, `sebls`, `duabls`,`tigabls`, `empatbls`, `limabls`, `enambls`, `tujuhbls`, `delapanbls`, `sembilanbls`, `duapuluh`, `duasatu`, `duadua`, `duatiga`, `duaempat`, `dualima`, `duaenam`, `duatujuh`, `duadelapan`, `duasembilan`, `tigapuluh`, `tigasatu`, `tigadua`, `tigatiga`, `tigaempat`, `tigalima`, `tigaenam`, `tigatujuh`, `tigadelapan`, `tigasembilan`, `empatpuluh`, `empatsatu`, `empatdua`, `empattiga`, `donorke`, `stat`) VALUES
('$namapendonor','$hariini','$kodependonor','$notrans','$satu','$dua','$tiga','$empat','$lima','$enam','$tujuh','$delapan',
'$sembilan','$sepuluh','$sebls','$duabls','$tigabls','$empatbls',
'$limabls','$enambls','$tujuhbls','$delapanbls','$sembilanbls',
'$duapuluh','$duasatu','$duadua','$duatiga','$duaempat','$dualima',
'$duaenam','$duatujuh','$duadelapan','$duasembilan','$tigapuluh',
'$tigasatu','$tigadua','$tigatiga','$tigaempat','$tigalima',
'$tigaenam','$tigatujuh','$tigadelapan','$tigasembilan',
'$empatpuluh','$empatsatu','$empatdua','$empattiga','$donorke','$kuesioner')");
}
    
    $tambah=mysql_query($tambah_sql);
    $tambah1=mysql_fetch_assoc(mysql_query("select Pengambilan from htransaksi where NoTrans='$notrans'"));
    //=======Audit Trial====================================================================================
    $log_mdl ='SELEKSI';
    $log_aksi='Check Up: '.$notrans.', Pendonor: '.$kodependonor.' Status: '.$status;
    include_once "user_log.php";
    //=====================================================================================================
    
    //disini ditambahkan sql penyimpanan data sementara
    //check apakah data temp sudah ada, jika ada, update data temp
    //yang disimpan : nama dokter, petugas tensi, petugas hb
    
    $cek_tmpudd=1;
    $cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
    if ($cek_tmpudd==0) {
       $tambah_tmp=mysql_query("INSERT INTO tempudd (modul,dokter,petugas2,petugas1)
                   values ('MU CHECKUP','$id_dokter','$id_hb','$id_tensi')");
    } else {
       $tambah_tmp=mysql_query("UPDATE tempudd  SET dokter='$id_dokter',petugas1='$id_tensi', petugas2='$id_hb'
                   where modul='MU CHECKUP'");
    }
    
    //baru sampai disini
    //$update_pendonor=mysql_query("UPDATE pendonor SET GolDarah='$gol_darah',Rhesus='$rhesus' WHERE Kode='$kodependonor'");
                    //status_test->0=baru,1=med ok, 2=aftap `ok
                    //Status->0=baru,1=med checkup, 2=aftap
    
        if ($tambah) {
            echo "Data Telah berhasil dimasukkan<br>";
                
            if ($tambah1[Pengambilan]=='3') {
                
            switch ($lv0){
                case "aftap":
                    ?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=checktensi"> <?
                    break;
                case "mobile":
                    ?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=checktensi"> <?
                    break;
                case "p2d2s":
                    ?> <META http-equiv="refresh" content="2; url=pmip2d2s.php?module=checktensi"> <?
                    break;
                case "kasir":
                    if ($apheresis=='1'){
                    ?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=checktensi"> <?
                    }else{
                    ?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=checktensi"> <?
                    }
                    break;
    
                default:
                    echo "Anda tidak memiliki hak akses";
                }
            } else {
            echo "Hasil Medical Checkup tidak memenuhi Syarat untuk Donor";
            switch ($lv0){
                case "aftap":
                    ?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=checktensi"> <?
                    break;
                case "mobile":
                    ?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=checktensi"> <?
                    break;
                case "p2d2s":
                    ?> <META http-equiv="refresh" content="2; url=pmip2d2s.php?module=checktensi"> <?
                    break;
                case "kasir":
                    ?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=checktensi"> <?
                    break;

                default:
                    echo "Anda tidak memiliki hak akses";
                }
            }
        }
                
    $_POST['periksa']="";
} else  { echo "Data tidak lengkap!!!";
            switch ($lv0){
                case "aftap":
                    ?> <META http-equiv="refresh" content="1; url=pmiaftap.php?module=checktensi"> <?
                    break;
                case "mobile":
                    ?> <META http-equiv="refresh" content="1; url=pmimobile.php?module=checktensi"> <?
                    break;
                case "p2d2s":
                    ?> <META http-equiv="refresh" content="1; url=pmip2d2s.php?module=checktensi"> <?
                    break;
                case "kasir":
                    ?> <META http-equiv="refresh" content="1; url=pmikasir.php?module=checktensi"> <?
                    break;
                default:
                    echo "Anda tidak memiliki hak akses";
                }
            }
}
if ($_POST['periksa']=="") {?>


<?php
$cek_tmpudd=1;
    $cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
    
      $query_combo = "select * from tempudd where modul='MU CHECKUP'";
         $hasil_combo = mysql_query($query_combo);
         $data_combo = mysql_fetch_array($hasil_combo);
$kodedonor= $_GET[NoTrans];
        $notrans1=$_GET[NoTrans];
      if ($_POST[NoTrans1]!="") {
    $cek1=mysql_query("SELECT `NoTrans` FROM `htransaksi` WHERE `KodePendonor` = '$_POST[NoTrans1]' AND `Pengambilan` = '4' LIMIT 1");
    $notranstmp=mysql_fetch_assoc($cek1); $notrans1 = $notranstmp[NoTrans];
}

$kuesioner = mysql_fetch_array(mysql_query("SELECT * FROM `antrian` WHERE `transaksi` = '$notrans1'"));
?>
    <h1 class="table" align="center">FORM MEDICAL CHECKUP TENSI <? echo $_POST[periksa]; ?></h1> <!-- didik menambahkan onsubmit="return validasi_input(this)" 01052019-->
    <form name="periksa" autocomplete="off" id="periksa" method="post" action="<?=$PHPSELF?>" onsubmit="return validasi_input(this)">
<table  cellpadding="3" cellspacing="1" border="1" class="input" style="background-color:#C4DFE6">
<tr >
    <td colspan="9" align="center" style="background-color:#FF420E"><b>VERIFIKASI KUESIONER PENDONOR <?=$notrans1?>  </b></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>HARI INI</b></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 1 TAHUN TERAKHIR</b></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>TAHUN 1977 HINGGA SEKARANG</b></td>
</tr>
<tr>
    <td>1.</td><td <? if($kuesioner[satu]=='' OR $kuesioner[satu]=='TIDAK') echo "style='background-color:yellow'";?>>Sehat ?</td><td>
<select name="satu" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[satu]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[satu]=="TIDAK") echo "selected"?>>TIDAK</option></select>
</td>
    <td>13.</td><td <? if($kuesioner[tigabls]=='' OR $kuesioner[tigabls]=='YA') echo "style='background-color:yellow'";?>>Menerima transfusi darah</td><td>
<select name="tigabls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigabls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigabls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>30.</td><td <? if($kuesioner[tigapuluh]=='' OR $kuesioner[tigapuluh]=='YA') echo "style='background-color:yellow'";?>>Laki-laki: Berhubungan sesama jenis ?</td><td>
<select name="tigapuluh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigapuluh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigapuluh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>2.</td><td <? if($kuesioner[dua]=='' OR $kuesioner[dua]=='TIDAK') echo "style='background-color:yellow'";?>>Tidur min 4jam ?</td><td>
<select name="dua" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[dua]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[dua]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>14.</td><td <? if($kuesioner[empatbls]=='' OR $kuesioner[empatbls]=='YA') echo "style='background-color:yellow'";?>>Transplanasi organ ?</td><td>
<select name="empatbls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[empatbls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[empatbls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>TAHUN 1980 HINGGA SEKARANG</b></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 3 HARI TERAKHIR</b></td>
    <td>15.</td><td <? if($kuesioner[limabls]=='' OR $kuesioner[limabls]=='YA') echo "style='background-color:yellow'";?>>Cangkok tulang ?</td><td>
<select name="limabls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[limabls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[limabls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>31.</td><td <? if($kuesioner[tigasatu]=='' OR $kuesioner[tigasatu]=='YA') echo "style='background-color:yellow'";?>>Tinggal di Eropa terutama Inggris</td><td>
<select name="tigasatu" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigasatu]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigasatu]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>3.</td><td <? if($kuesioner[tiga]=='' OR $kuesioner[tiga]=='YA') echo "style='background-color:yellow'";?>>Minum obat ?</td><td>
<select name="tiga" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tiga]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tiga]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>16.</td><td <? if($kuesioner[enambls]=='' OR $kuesioner[enambls]=='YA') echo "style='background-color:yellow'";?>>Tertusuk jarum medis ?</td><td>
<select name="enambls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[enambls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[enambls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>32.</td><td <? if($kuesioner[tigadua]=='' OR $kuesioner[tigadua]=='YA') echo "style='background-color:yellow'";?>>Menerima transfusi darah di Inggris ?</td><td>
<select name="tigadua" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigadua]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigadua]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>4.</td><td <? if($kuesioner[empat]=='' OR $kuesioner[empat]=='YA') echo "style='background-color:yellow'";?>>Minum jamu ?</td><td>
<select name="empat" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[empat]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[empat]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>17.</td><td <? if($kuesioner[tujuhbls]=='' OR $kuesioner[tujuhbls]=='YA') echo "style='background-color:yellow'";?>>Sex dengan orang-HIV/AIDS ?</td><td>
<select name="tujuhbls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tujuhbls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tujuhbls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>TAHUN 1980 HINGGA 1996</b></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 1 MINGGU TERAKHIR</b></td>
    <td>18.</td><td <? if($kuesioner[delapanbls]=='' OR $kuesioner[delapanbls]=='YA') echo "style='background-color:yellow'";?>>Sex dengan PSK ?</td><td>
<select name="delapanbls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[delapanbls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[delapanbls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>33</td><td <? if($kuesioner[tigatiga]=='' OR $kuesioner[tigatiga]=='YA') echo "style='background-color:yellow'";?>>Tinggal 3 bulan di Inggis ?</td><td>
<select name="tigatiga" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigatiga]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigatiga]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>5.</td><td <? if($kuesioner[lima]=='' OR $kuesioner[lima]=='YA') echo "style='background-color:yellow'";?>>Cabut gigi ?</td><td>
<select name="lima" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[lima]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[lima]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>19.</td><td <? if($kuesioner[sembilanbls]=='' OR $kuesioner[sembilanbls]=='YA') echo "style='background-color:yellow'";?>>Konsumsi Narkoba ?</td><td>
<select name="sembilanbls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[sembilanbls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[sembilanbls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>APAKAH PERNAH</b></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 2 MINGGU TERAKHIR</b></td>
    <td>20.</td><td <? if($kuesioner[duapuluh]=='' OR $kuesioner[duapuluh]=='YA') echo "style='background-color:yellow'";?>>Sex dengan pengguna konsentrat faktor pembekuan ?</td><td>
<select name="duapuluh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duapuluh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duapuluh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>34</td><td <? if($kuesioner[tigaempat]=='' OR $kuesioner[tigaempat]=='YA') echo "style='background-color:yellow'";?>>Positif tes HIV/AIDS ?</td><td>
<select name="tigaempat" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigaempat]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigaempat]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
<tr>
    <td>6.</td><td <? if($kuesioner[enam]=='' OR $kuesioner[enam]=='YA') echo "style='background-color:yellow'";?>>Demam lebih dari 38C</td><td>
<select name="enam" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[enam]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[enam]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>21.</td><td <? if($kuesioner[duasatu]=='' OR $kuesioner[duasatu]=='YA') echo "style='background-color:yellow'";?>>Wanita : Sex dengan laki-laki biseksual ?</td><td>
<select name="duasatu" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duasatu]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duasatu]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>35.</td><td <? if($kuesioner[tigalima]=='' OR $kuesioner[tigalima]=='YA') echo "style='background-color:yellow'";?>>Pengguna jarum suntik untuk obat ?</td><td>
<select name="tigalima" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigalima]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigalima]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 6 MINGGU TERAKHIR</b></td>
    <td>22.</td><td <? if($kuesioner[duadua]=='' OR $kuesioner[duadua]=='YA') echo "style='background-color:yellow'";?>>Sex dengan orang-Hepatitis ?</td><td>
<select name="duadua" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duadua]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duadua]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>36.</td><td <? if($kuesioner[tigaenam]=='' OR $kuesioner[tigaenam]=='YA') echo "style='background-color:yellow'";?>>Pengguna konsentrat faktor pembekuan ?</td><td>
<select name="tigaenam" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigaenam]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigaenam]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>7.</td><td <? if($kuesioner[tujuh]=='' OR $kuesioner[tujuh]=='YA') echo "style='background-color:yellow'";?>>Wanita: Sedang hamil ?</td><td>
<select name="tujuh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tujuh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tujuh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>23.</td><td <? if($kuesioner[duatiga]=='' OR $kuesioner[duatiga]=='YA') echo "style='background-color:yellow'";?>>Tinggal bersama orang-Hepatitis ?</td><td>
<select name="duatiga" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duatiga]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duatiga]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>37.</td><td <? if($kuesioner[tigatujuh]=='' OR $kuesioner[tigatujuh]=='YA') echo "style='background-color:yellow'";?>>Menderita Hepatitis ?</td><td>
<select name="tigatujuh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigatujuh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigatujuh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 2 BULAN TERAKHIR</b></td>
    <td>24.</td><td <? if($kuesioner[duaempat]=='' OR $kuesioner[duaempat]=='YA') echo "style='background-color:yellow'";?>>Pernah tatto ?</td><td>
<select name="duaempat" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duaempat]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duaempat]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>38.</td><td <? if($kuesioner[tigadelapan]=='' OR $kuesioner[tigadelapan]=='YA') echo "style='background-color:yellow'";?>>Menderita Malaria ?</td><td>
<select name="tigadelapan" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigadelapan]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigadelapan]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>8.</td><td <? if($kuesioner[delapan]=='' OR $kuesioner[delapan]=='YA') echo "style='background-color:yellow'";?>>Mendonorkan darah ?</td><td>
<select name="delapan" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[delapan]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[delapan]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>25.</td><td <? if($kuesioner[dualima]=='' OR $kuesioner[dualima]=='YA') echo "style='background-color:yellow'";?>>Tindik telinga atau bagian lainya ?</td><td>
<select name="dualima" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[dualima]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[dualima]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>39.</td><td <? if($kuesioner[tigasembilan]=='' OR $kuesioner[tigasembilan]=='YA') echo "style='background-color:yellow'";?>>Menderita Kangker ?</td><td>
<select name="tigasembilan" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[tigasembilan]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[tigasembilan]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>9.</td><td <? if($kuesioner[sembilan]=='' OR $kuesioner[sembilan]=='YA') echo "style='background-color:yellow'";?>>Vaksin atau Suntik ?</td><td>
<select name="sembilan" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[sembilan]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[sembilan]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>26.</td><td <? if($kuesioner[duaenam]=='' OR $kuesioner[duaenam]=='YA') echo "style='background-color:yellow'";?>>Pernah pengobatan sifilis atau GO ?</td><td>
<select name="duaenam" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duaenam]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duaenam]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>40.</td><td <? if($kuesioner[empatpuluh]=='' OR $kuesioner[empatpuluh]=='YA') echo "style='background-color:yellow'";?>>Bermasalah jantung atau paru-paru ?</td><td>
<select name="empatpuluh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[empatpuluh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[empatpuluh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>10.</td><td <? if($kuesioner[sepuluh]=='' OR $kuesioner[sepuluh]=='YA') echo "style='background-color:yellow'";?>>Kontak penerima smallpox</td><td>
<select name="sepuluh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[sepuluh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[sepuluh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>27.</td><td <? if($kuesioner[duatujuh]=='' OR $kuesioner[duatujuh]=='YA') echo "style='background-color:yellow'";?>>Ditahan atau dipenjara 3hari ?</td><td>
<select name="duatujuh" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duatujuh]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duatujuh]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>41.</td><td <? if($kuesioner[empatsatu]=='' OR $kuesioner[empatsatu]=='YA') echo "style='background-color:yellow'";?>>Menderita sakit terkait darah ?</td><td>
<select name="empatsatu" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[empatsatu]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[empatsatu]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 4 BULAN TERAKHIR</b></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 3 TAHUN TERAKHIR</b></td>
    <td>42.</td><td <? if($kuesioner[empatdua]=='' OR $kuesioner[empatdua]=='YA') echo "style='background-color:yellow'";?>>Sex dengan orang tingal di Afrika ?</td><td>
<select name="empatdua" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[empatdua]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[empatdua]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td>11.</td><td <? if($kuesioner[sebls]=='' OR $kuesioner[sebls]=='YA') echo "style='background-color:yellow'";?>>Donor 2x PRC-Aferesis</td><td>
<select name="sebls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[sebls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[sebls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>28.</td><td <? if($kuesioner[duadelapan]=='' OR $kuesioner[duadelapan]=='YA') echo "style='background-color:yellow'";?>>Berada di luar daerah Indonesia ? Sebutkan...</td><td>
<select name="duadelapan" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duadelapan]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duadelapan]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>43</td><td <? if($kuesioner[empattiga]=='' OR $kuesioner[empattiga]=='YA') echo "style='background-color:yellow'";?>>Tingal di Afrika ?</td><td>
<select name="empattiga" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[empattiga]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[empattiga]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
</tr>
<tr>
    <td colspan="3" align="center" style="background-color:#F98866"><b>DALAM 6 BULAN TERAKHIR</b></td>
    <td colspan="3" align="center" style="background-color:#F98866"><b>TAHUN 1977 HINGGA SEKARANG</b></td>
    <td></td><td></td><td></td>
</tr>
<tr>
    <td>12.</td><td <? if($kuesioner[duabls]=='' OR $kuesioner[duabls]=='YA') echo "style='background-color:yellow'";?>>Wanita: Sedang menyusui ?</td><td>
<select name="duabls" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duabls]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duabls]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td>29.</td><td <? if($kuesioner[duasembilan]=='' OR $kuesioner[duasembilan]=='YA') echo "style='background-color:yellow'";?>>Menerima uang, obat, dll untuk sex ?</td><td>
<select name="duasembilan" style="font-size:9px" required>
<option value="">Pilih</option>
<option value="YA" <? if($kuesioner[duasembilan]=="YA") echo "selected"?>>YA</option>
<option value="TIDAK" <? if($kuesioner[duasembilan]=="TIDAK") echo "selected"?>>TIDAK</option></select></td>
    <td></td><td></td><td></td>
</tr>
</table> <br><br>
    <table class="form" cellspacing="0" cellpadding="0">
<?
        $kodedonor= $_GET[NoTrans];
        $notrans1=$_GET[NoTrans];
      if ($_POST[NoTrans1]!="") {
    $cek1=mysql_query("SELECT `NoTrans` FROM `htransaksi` WHERE `KodePendonor` = '$_POST[NoTrans1]' AND `Pengambilan` = '4' LIMIT 1");
    $notranstmp=mysql_fetch_assoc($cek1); $notrans1 = $notranstmp[NoTrans];
}
switch ($lv0){
    case "aftap": $urlnya = "pmiaftap";break;
    case "mobile": $urlnya = "pmimobile";break;
    case "p2d2s": $urlnya = "pmip2d2s";break;
    case "kasir": $urlnya = "pmikasir";break;
    default: echo "Anda tidak memiliki hak akses";
}
if ($notrans1 == '') {echo "<META http-equiv='refresh' content='1; url=$urlnya.php?module=checktensi'>";}

       $check=mysql_query("select * from pmi.htransaksi where NoTrans='$notrans1' and Status<=2");
         $check1=mysql_fetch_assoc($check);
        $apheresis=$check1['apheresis'];
        $apheresis1=$check1['apheresis'];
        if($apheresis1=='1'){$apheresis1='YA';}else{
          $apheresis1='TIDAK';
        }
    ?>
    <tr>
      <td>Donor Apheresis</td>
      <td class="input"><?=$apheresis1?></td>
    </tr>
    <tr>
      <td>Kode Pendonor</td>
      <td class="input"><?=$check1[KodePendonor]?></td>
    </tr>
    <? $check1[KodePendonor]=str_replace("'","\'",$check1[KodePendonor]);?>
    <?$data=mysql_query("select * from pendonor where Kode='$check1[KodePendonor]'");
    $data1=mysql_fetch_assoc($data);?>
    <tr>
        <td>Nama Pendonor</td>
        <td class="input" style="font-size:25px;color:blue"><b><?=$data1[Nama]?></b></td>
    </tr>
        <tr>
        <td>Berat</td>
        <td class="input"><span title="min 45kg, Afe min 55kg"><input name="berat_badan" type="text" size="3" onChange="berat(this.value)" required>kg</span></td>
    </tr>
        <tr>
        <td>Check</td>
        <td class="input"><span title="sistolik 90-160, diastolik 60-100, range min 20">Tensi</span>
            <input name="tensi_sistol" type="text"  size="3" onChange="sistol(this.value)" required>/
            <input name="tensi_diastol" type="text" size="3" onChange="diastol(this.value)" required>
            <br><span title="50-100/detik dan teratur">Nadi</span> &nbsp;<input name="nadi" type="text" size="3" onChange="nadi(this.value)" required>
            <br><span title="36.5 sd 37.5">Suhu</span> &nbsp;<input name="temperatur" type="text" size="3" onChange="suhu(this.value)" required>
        <td>
    </tr>
    <tr>
        <td>Verifikasi Petugas</td>
        <td class="input"><span title="">
            <input type="checkbox" name="kuesioner" value="1" required>VERIFIKASI INFORMED CONSENT DONOR</span></td>
    </tr>
<tr>
        <td>Hasil</td>
        <td class="input">
            <input type="radio" name="h_medical" checked value="0" onChange="pesan(this.value)">Lolos ke AFTAP
            <input type="radio" name="h_medical" value="1" onChange="pesan(this.value)">Tidak Lolos
        </td></tr>
        <tr>
        <tr>
        <td>Alasan Tidak Lolos</td>
        <td class="input">
            <select name="alasan">
                <option value="">-</option>
                <option value="0">Tensi Rendah</option>
                <option value="1">Tensi Tinggi</option>
                <option value="5">BB Kurang</option>
                <option value="6">Habis Minum Obat</option>
                <option value="7">Riwayat Bepergian</option>
                <option value="8">Kondisi Medis Lain</option>
                <option value="9">Perilaku Beresiko</option>
                <option value="10">Alasan Lain</option>
            </select>
        </td>
        </tr>
<tr>
        <td>Petugas Tensi</td>
        <td class="input">
        <input type="text" name="id_tensi" value="<?=$user?>" disabled>
        </td>
</tr>
<tr><td><td><td>

</td></tr>

</table>
<input type="hidden" name="periksa" value="1">
<input type="hidden" name="apheresis1" value="<?=$apheresis?>">
<input type="hidden" name="paket" value="1">
<input type="hidden" name="notrans" value="<?=$notrans1?>">
<input type="hidden" name="kodependonor" value="<?=$check1[KodePendonor]?>">
<input type="hidden" name="namapendonor" value="<?=$data1[Nama]?>">
<span id="pesan" style="display:none" title="Silahkan posisikan 'HASIL' pada 'LOLOS' secara MANUAL jika diperlukan"><br><font color="fuchsia" size="3"><b>Pendonor tidak lolos karena tidak memenuhi persyaratan</b></font></span>
<br>
<input type="submit" name="submit2" value="Simpan" style="background-color:Chartreuse;color:black;width:120px;height:40px;">
</form>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">
<tr bgcolor="#FF1000"><th colspan=33 color="#DDDDDD"><b>INFO HISTORY DONOR</b></th></tr>
    <tr bgcolor="#FAEBD7">
        <td rowspan='2'>No.</td>
        <td rowspan='2'>Tanggal</td>
        <td rowspan='2'>Donor Ke</td>
        <td rowspan='2'>BB</td>
        <td rowspan='2'>Tensi</td>
        <td rowspan='2'>Hb</td>
        <td rowspan='2'>Alat Hb</td>
        <td rowspan='2'>Lot & ED<br>Cuvette</td>
        <td rowspan='2'>Jenis</td>
<td rowspan='2'>Tempat</td>
<td rowspan='2'>Instansi</td>
<td rowspan='2'>Nokantong</td>
<td rowspan='2'>Timbangan</td>
<td rowspan='2'>Status<br>Aftap</td>
<td colspan='5' align="center">petugas</td>
    </tr>
<tr bgcolor="#FAEBD7">
<td>Admin</td>
<td>HB</td>
<td>Tensi</td>
<td>Aftap</td>
<td align="center">Transaksi</td>
<!--td>Aksi</td-->
</tr>
<?
$no=1;
//$trans=mysql_query("select * from htransaksi where KodePendonor='$q' order by Tgl ASC");
/*SELECT fname, lname, addr FROM prospect
-> UNION
-> SELECT first_name, last_name, address FROM customer
-> UNION
-> SELECT company, '', street FROM vendor;
*/
/*$trans=mysql_query(" SELECT Kodependonor,Tgl,NoTrans,Pengambilan,beratBadan,tensi,Hb,lot_cuvette,ed_cuvette,mesin_hb,mesin_timbang,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,donorke FROM htransaksi where KodePendonor='$check1[KodePendonor]'
        UNION
            SELECT Kodependonor,Tgl,id,Pengambilan,beratBadan,tensi,Hb,lot_cuvette,ed_cuvette,mesin_hb,mesin_timbang,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,donorke FROM htransaksilama where KodePendonor='$check1[KodePendonor]' order by Tgl DESC ");*/

$trans=mysql_query(" SELECT Kodependonor,Tgl,NoTrans,Reaksi,Pengambilan,Catatan,ketBatal,beratBadan,tensi,Hb,lot_cuvette,ed_cuvette,mesin_hb,mesin_timbang,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,donorke FROM htransaksi where KodePendonor='$check1[KodePendonor]' order by Tgl DESC ");

/*$trans=mysql_query(" SELECT Kodependonor,NoTrans,Tgl,Pengambilan,beratBadan,tensi,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,donorke FROM htransaksi where KodePendonor='$q' order by Tgl DESC ");*/
     while ($dtrans = mysql_fetch_assoc($trans)):
$notr=$dtrans[NoTrans];
$jenis='DS';
    if ($dtrans[JenisDonor]=='1') $jenis='DP';
$tempat='DG';
    if ($dtrans[tempat]=='M') $tempat='MU';

      
?>

    <tr bgcolor="#FFFFFF">
        <td><?=$no++?></td>
        <td><?=$dtrans[Tgl]?></td>
        <td><?=$dtrans[donorke]?> Kali</td>
        <td><?=$dtrans[beratBadan]?> kg</td>
        <td align="center"><?=$dtrans[tensi]?></td>
        <td align="center"><?=$dtrans[Hb]?></td>
<?$alathb=mysql_fetch_assoc(mysql_query("SELECT `inisial` FROM `smg_inventaris` WHERE `no_inventaris` = '$dtrans[mesin_hb]' LIMIT 1 "));?>
        <td align="center"><b><?=$alathb[inisial]?></b></br><?=$dtrans[mesin_hb]?></td>
        <td align="center"><b><?=$dtrans[lot_cuvette]?></b></br><?=$dtrans[ed_cuvette]?></td>
        <td align="center"><?=$jenis?></td>
        <td align="center"><?=$tempat?></td>
        <td align="center"><?=$dtrans[Instansi]?></td>
        <td align="center"><?=$dtrans[NoKantong]?></td>
<?$alattimbang=mysql_fetch_assoc(mysql_query("SELECT `inisial` FROM `smg_inventaris` WHERE `no_inventaris` = '$dtrans[mesin_timbang]' LIMIT 1 "));?>
        <td align="center"><b><?=$alattimbang[inisial]?></b></br><?=$dtrans[mesin_timbang]?></td>
<?
//$pengambilan=mysql_fetch_assoc(mysql_query("select Pengambilan from htransaksi where KodePendonor='$q'"));
    if($dtrans[Catatan]=="Mislek") $ketC="Mislek";
    if($dtrans[Catatan]=="Saran Dokter") $ketC="Saran Dokter";
    if($dtrans[Catatan]=="Permintaan Pendonor") $ketC="Permintaan Pendonor";
        
    if($dtrans[ketBatal]=="0") $ketB="Tensi Rendah";
    if($dtrans[ketBatal]=="1") $ketB="Tensi Tinggi";
    //if($dtrans[ketBatal]=="2") $ketB="";
    //if($dtrans[ketBatal]=="3") $ketB="";
    if($dtrans[ketBatal]=="4") $ketB="HB Tinggi";
    if($dtrans[ketBatal]=="5") $ketB="BB Kurang";
    if($dtrans[ketBatal]=="6") $ketB="Habis Minum Obat";
    if($dtrans[ketBatal]=="7") $ketB="Riwayat Bepergian";
    if($dtrans[ketBatal]=="8") $ketB="Kondisi Medis Lain";
    if($dtrans[ketBatal]=="9") $ketB="Perilaku Beresiko";
    if($dtrans[ketBatal]=="10") $ketB="Alasan Lain";
    if($dtrans[ketBatal]=="11") $ketB="HB Rendah";
    if($dtrans[ketBatal]=="Pendonor Pergi") $ketB="Pendonor Pergi";

    if ($dtrans[Pengambilan]=='0') {$pengambilan1="Berhasil"; $ket1=$dtrans[Reaksi];}
    if ($dtrans[Pengambilan]=='2') {$pengambilan1="Gagal"; $ket1=$ketC;}
    if ($dtrans[Pengambilan]=='1') {$pengambilan1="Batal"; $ket1=$ketB;}
    if ($dtrans[Pengambilan]=='3') {$pengambilan1="Antrian Aftap"; $ket1="";}
    if ($dtrans[Pengambilan]=='4') {$pengambilan1="Antrian Tensi"; $ket1="";}
    if ($dtrans[Pengambilan]=='-') {$pengambilan1="Antrian HB-Golda"; $ket1="";}
?>
        <td align="center"><? echo "$pengambilan1</br>$ket1"?></td>
        <td align="center"><?=$dtrans[user]?></td>
        <td align="center"><?=$dtrans[petugasHB]?></td>
        <td align="center"><?=$dtrans[petugasTensi]?></td>
        <td align="center"><?=$dtrans[petugas]?></td>
        <td align="center"><?=$dtrans[NoTrans]?></td>
        <td align="center"><?=$dtrans[donorke]?></td>
        <!--td><a href=pmiaftap.php?module=delhistory&NoTrans=<? echo $dtrans['NoTrans'] ?>&kode=<? echo $dtrans['Kodependonor'] ?>&tgl=<? echo $dtrans['tgl'] ?>>Hapus</a></td-->
    </tr>

    <? endwhile; ?>
</table>
<?
}
?>
