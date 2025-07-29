<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('terima').focus();
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});
	});
  </script>


<?
require_once("modul/background_process.php");
include('config/db_connect.php');

$namauser=$_SESSION[namauser];
$today=date('Y-m-d');
$today1=$today;
$src_nomorf="";
$src_ambil="";
$src_status="";
$src_shift="";
$src_ktg="";
$src_drh="";
$src_jk="";
$hasil="";
$src_rh="";
$src_ds="";
$src_baru="";

if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') 	$today1=$_POST[minta2];
if ($_POST[hasil]!='')      	$hasil=$_POST[hasil];
if ($_POST[nomorf]!='')      	$src_nomorf=$_POST[nomorf];
if ($_POST[gol_status]!='')  	$src_status=$_POST[gol_status];
if ($_POST[gol_ambil]!='')   	$src_ambil=$_POST[gol_ambil];
if ($_POST[gol_shift]!='')   	$src_shift=$_POST[gol_shift];
if ($_POST[gol_ktg]!='')     	$src_ktg=$_POST[gol_ktg];
if ($_POST[gol_drh]!='')     	$src_drh=$_POST[gol_drh];
if ($_POST[gol_jk]!='')      	$src_jk=$_POST[gol_jk];
if ($_POST[gol_rh]!='')        	$src_rh=$_POST[gol_rh];
if ($_POST[ds]!='')            	$src_ds=$_POST[ds];
if ($_POST[baru]!='')          	$src_baru=$_POST[baru];



if (isset($_POST[terima])) {
$no_kantong = mysql_real_escape_string($_POST[terima]);
$ck=mysql_fetch_assoc(mysql_query("select Status,sah from stokkantong where noKantong like '$no_kantong%'"));
	$cek1=mysql_fetch_assoc(mysql_query("select * from stokkantong where nokantong like '$no_kantong%'"));
	

if ($ck[Status] < '4')  {
$updatektg=mysql_query("update stokkantong set status='2' where noKantong like '$no_kantong%'");
                   
        
echo  "Darah dengan NoKantong<b> $no_kantong -- $cek1[produk] </b>Telah Berhasil Masukkan kembali ke STOK SEHAT";
		backgroundPost('http://localhost/simudda/modul/background_up_karantina.php');
} else {
echo "NoKantong<b> $no_kantong </b> TIDAK DITEMUKAN ";
}
}
/*
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[terima1])) {$today=$_POST[terima1];$today1=$today;}
if ($_POST[terima2]!='') $today1=$_POST[terima2];*/
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

//$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));
?>


<!--div>
<form name=sahdarah1 method=post> Mulai:
<input type=text name=terima1 id="datepicker" size=10>
Sampai:
<input type=text name=terima2 id="datepicker1" size=10>
<input type=submit name=submit value=Submit>
</form></div-->
<? 
if (($_SESSION[leveluser]=='laboratorium') or ($_SESSION[leveluser]=='kasir') or ($_SESSION[leveluser]=='aftap') or ($_SESSION[leveluser]=='komponen')){ ?>
<div>
<form name=sahdarah method=post><h3>Kembalikan KOMPONEN ke STOK SEHAT, Masukkan No Kantong -->
<input type=text name=terima id=terima size=15 placeholder="Jika Diketik, ENTER" onChange="this.form.submit();"> </h3>
</form></div>
<? } ?>
