<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>

<?php 
include('clogin.php');
include('config/db_connect.php'); 
if (isset($_POST[submit])) {
	 $nomortelp	= $_POST["notlp"];
	 $pesansms	= $_POST["pesan"];

	 if (($lv0=='admin') or ($lv0=='mobile')) {
		  $tambah=mysql_query("INSERT into wagw.outbox(`wa_mode`,`wa_no`,`wa_text`) values
		  	  ('1','$nomortelp','$pesansms')");
		  } else {
		  $tambah=mysql_query("INSERT into wagw.outbox(`wa_mode`,`wa_no`,`wa_text`) values
		  	  ('1','$nomortelp','$pesansms')");
		  }
	if ($tambah) {
		  echo "Pesan sedang dikirim<br> ";
		   
	if (($_SESSION[leveluser])=='p2d2s'){
	    echo '<META http-equiv="refresh" content="2; url=../pmip2d2s.php?module=wa_outbox">';
	    } else {
	    echo '<META http-equiv="refresh" content="2; url=../pmiadmin.php?module=wa_outbox">';	
	    } 		
	               
	 }
	 $_POST['periksa']="";
}

if (isset($_GET[ID])) {
	 $perintah=mysql_query("select * from wagw.inbox where id='$_GET[ID]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($nrow<1){
		  echo "Nomor ID tidak sesuai";
		   ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=wa_inbox"><?
	 } else {
		$nope = $row['wa_no'];
		$str1 = str_replace("+62 ","0",$nope);
		$str2 = str_replace("-","",$str1);
	 ?>
	 <h1 class="table">BALAS PESAN</h1>
	 <form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
	 <table class="form" width=50%  cellspacing="2" cellpadding="3" border="2">
		  <tr>
			 <td>Pengirim</td>
			 <td class="input"> <input name="notlp" value=<?=$str2?>>
			 </td>
		  </tr>
		  <tr>
		  	 <td>Isi Pesan</td>
			 <td class="input"><?=$row[wa_text]?>
			 </td>
		  </tr>
		  <tr>
			   <td>Balasan</td>
			   <td class="input"><textarea  rows="10" cols="70" wrap="physical" name=pesan {font-family:"Helvetica Neue", Helvetica, sans-serif; }></textarea>
			   </td>
		  </tr>

	 </table><br>
	 <input type="hidden" value="1" name="periksa">
	 <input type="hidden" value="<?=$row[Kode]?>" name="kode">
	 <input type="submit" value="Kirim Pesan Balasan" name="submit">
	 </form>
	 <?
	 }
}
?>
