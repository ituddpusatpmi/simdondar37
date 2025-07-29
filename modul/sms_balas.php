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
		  $tambah=mysql_query("INSERT into sms.outbox(`DestinationNumber`,`TextDecoded`,`CreatorID`) values
		  	  ('$nomortelp','$pesansms',1)");
		  } else {
		  $tambah=mysql_query("INSERT into sms.outbox(`DestinationNumber`,`TextDecoded`,`CreatorID`) values
		  ('$nomortelp','$pesansms',1)");
		  }
	if ($tambah) {
		  echo "SMS balasan sedang dikirim<br> ";
		  ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=sms_inbox"><?               
	 }
	 $_POST['periksa']="";
}

if (isset($_GET[ID])) {
	 $perintah=mysql_query("select * from sms.inbox where ID='$_GET[ID]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Nomor ID tidak sesuai";
		   ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=sms_inbox"><?
	 } else {	
	 ?>
	 <h1 class="table">BALAS SMS</h1>
	 <form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
	 <table class="form" width=50%  cellspacing="2" cellpadding="3" border="2">
		  <tr>
			 <td>Pengirim</td>
			 <td class="input"> <input name="notlp" value=<?=$row[SenderNumber]?>>
			 </td>
		  </tr>
		  <tr>
		  	 <td>ISI SMS</td>
			 <td class="input"><?=$row[TextDecoded]?>
			 </td>
		  </tr>
		  <tr>
			   <td>Balasan SMS</td>
			   <td class="input"><textarea  rows="10" cols="70" wrap="physical" name=pesan {font-family:"Helvetica Neue", Helvetica, sans-serif; }></textarea>
			   </td>
		  </tr>

	 </table><br>
	 <input type="hidden" value="1" name="periksa">
	 <input type="hidden" value="<?=$row[Kode]?>" name="kode">
	 <input type="submit" value="Kirim SMS balasan ini" name="submit">
	 </form>
	 <?
	 }
}
?>
