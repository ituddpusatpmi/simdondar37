<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
<!-- Modernizr -->
<script src="js/modernizr-1.5.min.js"></script>
<!-- Webforms2 -->
<script src="webforms2/webforms2.js"></script>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_diajukan.js"></script>
<script type="text/javascript" src="js/tgl_dicetak.js"></script>
<script type="text/javascript" src="js/tgl_diberikan.js"></script>
<script type="text/javascript" src="js/tgl_dikembalikan.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- disable enter -->
<script type="text/javascript" src="js/disable_enter.js"></script>
<!-- Form layout -->
<!--<link rel="stylesheet" href="css/html5forms.layout.css"> -->
<script src="js/html5forms.fallback.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        document.reg.nama.focus();
      });
    </script>
<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
</script>

<?php 
include('clogin.php');
include('config/db_connect.php');
$lv0=$_SESSION[leveluser];
require_once('modul/background_process.php');
$idp=mysql_query("select * from tempat_donor where active='1'",$con);
$idp1=mysql_fetch_assoc($idp);
if (substr($idp1[id1],0,1)=="M") { 
   mysql_query("update pendonor set mu='1' where Kode='$kode'",$con); 
   $mu="1"; 
} else {
   $mu="";
}	  
if (isset($_POST[submit])) {
  	 $kode = $_POST["kode"];
	 $nopiagam=$_POST["nopiagam"];
         $diajukan=$_POST["diajukan"];
         $dicetak=$_POST["dicetak"];
         $diberikan=$_POST["diberikan"];
         $status=$_POST["status"];
         $notrans=$kode.$status;

if ($lv0=='admin') {
    if (($diajukan != "") and ($dicetak == "") and ($diberikan == "")){
    if ($status=="p10"){
	$tambah=mysql_query("UPDATE pendonor SET
		  p10='1'
		  where kode='$kode'");
    }  elseif ($status=="p25") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p25='1'
		  where kode='$kode'");
    } elseif ($status=="p50") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p50='1'
		  where kode='$kode'");
    } elseif ($status=="p75") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p75='1'
		  where kode='$kode'");
    } elseif ($status=="p100") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p100='1'
		  where kode='$kode'");
    } elseif ($status=="psatya") {
        $tambah=mysql_query("UPDATE pendonor SET
		  psatya='1'
		  where kode='$kode'");
    } else {
        $tambah=mysql_query("UPDATE pendonor SET
		  pprov='1'
		  where kode='$kode'");
    }

     $tambah_sql=mysql_query("INSERT INTO `pmi`.`piagam` (`notrans` ,`kodependonor` ,`tglDiajukan` ,`jenispiagam` ,`nopiagam` ,`tglDicetak` ,`tglDiberikan`)
			         values ('$notrans','$kode','$diajukan','$status','$nopiagam','$dicetak','$diberikan')");

  }else if (($diajukan != "") and ($dicetak != "") and ($diberikan == "")){
    if ($status=="p10"){
	$tambah=mysql_query("UPDATE pendonor SET
		  p10='2'
		  where kode='$kode'");
    }  elseif ($status=="p25") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p25='2'
		  where kode='$kode'");
    } elseif ($status=="p50") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p50='2'
		  where kode='$kode'");
    } elseif ($status=="p75") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p75='2'
		  where kode='$kode'");
    } elseif ($status=="p100") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p100='2'
		  where kode='$kode'");
    } elseif ($status=="psatya") {
        $tambah=mysql_query("UPDATE pendonor SET
		  psatya='2'
		  where kode='$kode'");
    } else {
        $tambah=mysql_query("UPDATE pendonor SET
		  pprov='2'
		  where kode='$kode'");
    }

     $tambah_sql=mysql_query("INSERT INTO `pmi`.`piagam` (`notrans` ,`kodependonor` ,`tglDiajukan` ,`jenispiagam` ,`nopiagam` ,`tglDicetak` ,`tglDiberikan`)
			         values ('$notrans','$kode','$diajukan','$status','$nopiagam','$dicetak','$diberikan')");

     
    } else {

      if ($status=="p10"){
	$tambah=mysql_query("UPDATE pendonor SET
		  p10='3'
		  where kode='$kode'");
    }  elseif ($status=="p25") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p25='3'
		  where kode='$kode'");
    } elseif ($status=="p50") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p50='3'
		  where kode='$kode'");
    } elseif ($status=="p75") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p75='3'
		  where kode='$kode'");
    } elseif ($status=="p100") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p100='3'
		  where kode='$kode'");
    } elseif ($status=="psatya") {
        $tambah=mysql_query("UPDATE pendonor SET
		  psatya='3'
		  where kode='$kode'");
    } else {
        $tambah=mysql_query("UPDATE pendonor SET
		  pprov='3'
		  where kode='$kode'");
    }

    $tambah_sql=mysql_query("INSERT INTO `pmi`.`piagam` (`notrans` ,`kodependonor` ,`tglDiajukan` ,`jenispiagam` ,`nopiagam` ,`tglDicetak` ,`tglDiberikan`)
			         values ('$notrans','$kode','$diajukan','$status','$nopiagam','$dicetak','$diberikan')");
    } 

} else {
	if (($diajukan != "") and ($dicetak == "") and ($diberikan == "")){
    if ($status=="p10"){
	$tambah=mysql_query("UPDATE pendonor SET
		  p10='1'
		  where kode='$kode'");
    }  elseif ($status=="p25") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p25='1'
		  where kode='$kode'");
    } elseif ($status=="p50") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p50='1'
		  where kode='$kode'");
    } elseif ($status=="p75") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p75='1'
		  where kode='$kode'");
    } elseif ($status=="p100") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p100='1'
		  where kode='$kode'");
    } elseif ($status=="psatya") {
        $tambah=mysql_query("UPDATE pendonor SET
		  psatya='1'
		  where kode='$kode'");
    } else {
        $tambah=mysql_query("UPDATE pendonor SET
		  pprov='1'
		  where kode='$kode'");
    }

     $tambah_sql=mysql_query("INSERT INTO `pmi`.`piagam` (`notrans` ,`kodependonor` ,`tglDiajukan` ,`jenispiagam` ,`nopiagam` ,`tglDicetak` ,`tglDiberikan`)
			         values ('$notrans','$kode','$diajukan','$status','$nopiagam','$dicetak','$diberikan')");
	//=======Audit Trial====================================================================================
	$log_mdl ='PPDDS';
	$log_aksi='Ajukan Piagam: '.$$notrans.', Pendonor: '.$kode.', Status: '.$status;
	include_once "user_log.php";
	//=====================================================================================================

  }else if (($diajukan != "") and ($dicetak != "") and ($diberikan == "")){
    if ($status=="p10"){
	$tambah=mysql_query("UPDATE pendonor SET
		  p10='2'
		  where kode='$kode'");
    }  elseif ($status=="p25") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p25='2'
		  where kode='$kode'");
    } elseif ($status=="p50") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p50='2'
		  where kode='$kode'");
    } elseif ($status=="p75") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p75='2'
		  where kode='$kode'");
    } elseif ($status=="p100") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p100='2'
		  where kode='$kode'");
    } elseif ($status=="psatya") {
        $tambah=mysql_query("UPDATE pendonor SET
		  psatya='2'
		  where kode='$kode'");
    } else {
        $tambah=mysql_query("UPDATE pendonor SET
		  pprov='2'
		  where kode='$kode'");
    }

     $tambah_sql=mysql_query("INSERT INTO `pmi`.`piagam` (`notrans` ,`kodependonor` ,`tglDiajukan` ,`jenispiagam` ,`nopiagam` ,`tglDicetak` ,`tglDiberikan`)
			         values ('$notrans','$kode','$diajukan','$status','$nopiagam','$dicetak','$diberikan')");
	

    } else {

      if ($status=="p10"){
	$tambah=mysql_query("UPDATE pendonor SET
		  p10='3'
		  where kode='$kode'");
    }  elseif ($status=="p25") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p25='3'
		  where kode='$kode'");
    } elseif ($status=="p50") {
       $tambah=mysql_query("UPDATE pendonor SET
		  p50='3'
		  where kode='$kode'");
    } elseif ($status=="p75") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p75='3'
		  where kode='$kode'");
    } elseif ($status=="p100") {
        $tambah=mysql_query("UPDATE pendonor SET
		  p100='3'
		  where kode='$kode'");
    } elseif ($status=="psatya") {
        $tambah=mysql_query("UPDATE pendonor SET
		  psatya='3'
		  where kode='$kode'");
    } else {
        $tambah=mysql_query("UPDATE pendonor SET
		  pprov='3'
		  where kode='$kode'");
    }

    $tambah_sql=mysql_query("INSERT INTO `pmi`.`piagam` (`notrans` ,`kodependonor` ,`tglDiajukan` ,`jenispiagam` ,`nopiagam` ,`tglDicetak` ,`tglDiberikan`)
			         values ('$notrans','$kode','$diajukan','$status','$nopiagam','$dicetak','$diberikan')");


    }

}	
	backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	if (($tambah)and ($tambah_sql)) {
	//=======Audit Trial====================================================================================
	$log_mdl ='PPDDS';
	$log_aksi='Ajukan Piagam: '.$$notrans.', Pendonor: '.$kode.', Piagam : '.$status;
	include_once "user_log.php";
	//=====================================================================================================
		  echo "Data pendonor $notrans Telah Diajukan <br> ";
		  $idp=mysql_query("select * from tempat_donor where active='1'");
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'"); 
                
		  switch ($lv0){
			   case "mobile":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where kode='$kode'"));
				?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=piagam"><?
			   break;
			   case "p2d2s":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));
				?><META http-equiv="refresh" content="0; url=pmip2d2s.php?module=piagam"><?
				break;
			   case "admin":
				?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=piagam"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}
function now(){
	$now=time();
	$skrg=date("Y-m-d",$now);
	return $skrg;
}
if (isset($_GET[kode])) {
         $tglnow=now();
         $status=$_GET[status];
	 $perintah=mysql_query("select * from pendonor where kode='$_GET[kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Data yang anda inginkan tidak ada dalam database";
		  ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=piagam"><?
	 } else {	
?>
<h1 class="table">AJUKAN DATA PIAGAM</h1>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" width=380  cellspacing="1" cellpadding="2">
<tr>
	 <td>Kode Pasien</td>
	 <td class="input"><?=$row[Kode]?></td>
</tr>
<tr>
	 <td>Nama Pendonor</td>
	 <td class="input">
	 <?=$row[Nama]?>
	 </td>
</tr>
<tr>
	 <td>Alamat</td>
	 <td class="input">
	 <?=$row[Alamat]?>
	 </td>
</tr>
<tr>
	<td>Jenis Kelamin</td>
	<td class="input" >
	<?php
		$type=$row[Jk];
		$checked[$type]="checked";
         if ($type==0){?>
             Laki-Laki
        <?php } else { ?>
  	Perempuan
             <?php } ?>
  	</td>

</tr>
<tr> 
	<td>Tgl Lahir</td>
	<td class="input">
	<?=$row[TglLhr]?></td>
</tr> 
<tr>
	<td>Golongan Darah</td>
     	<td class="input">
	<?=$row[GolDarah]?>
	</td>
</tr>
<tr>
	<td>Jumlah Sumbangan</td>
	<td class="input">
	<?=$row[jumDonor]?>
	</td>
</tr>
<tr>
	 <td>No Piagam</td>
	 <td class="input">
	 <input name="nopiagam" type="text" size="30" value="" placeholder="Nomor Piagam">
	 </td>
</tr>
<tr>
	<td>Tanggal Diajukan</td>
	<td class="input">
	<input type="text" name="diajukan" id="diajukan" value="<?=$tglnow?>" placeholder="Tgl Pengajuan" size=15 required ></td>
</tr>
<tr>
	<td>Tanggal Dicetak</td>
	<td class="input">
	<input type="text" name="dicetak" id="dicetak" placeholder="Tgl Cetak" size=15 ></td>
</tr>
<tr>
	<td>Tanggal Diberikan</td>
	<td class="input">
	<input type="text" name="diberikan" id="diberikan" placeholder="Tgl Beri" size=15 ></td>
</tr>

</table><br>
<input type="hidden" value="1" name="periksa">
<input type="hidden" name="mu" value="<?=$mu?>">
<input type="hidden" name="status" value="<?=$status?>">
<input type="hidden" value="<?=$row[Kode]?>" name="kode">
<input type="submit" value="Ajukan Piagam" name="submit">
</form>
<?
}}
?>
