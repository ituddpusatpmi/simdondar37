<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />

<?php 
session_start();
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
		  ?> 
<?if (($_SESSION[leveluser])=='p2d2s'){
    echo '<META http-equiv="refresh" content="2; url=../pmip2d2s.php?module=wa_outbox">';
    } else {
    echo '<META http-equiv="refresh" content="2; url=../pmiadmin.php?module=wa_outbox">';	
    }               
	 }
}

if (isset($_GET[nomortelp])) {
	 $perintah=mysql_query("select * from `user` where telp='$_GET[nomortelp]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Nomor ID tidak sesuai";
	 } else {
	 ?>
	 <h1 class="table">KIRIM PESAN KE STAF</h1>
	 <form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
	 <table class="form" width=50%  cellspacing="2" cellpadding="3" border="2">
		  <tr>
			 <td>Nomor Tujuan</td>
			 <td class="input"> <input name="notlp" value=<?=$row[telp]?>>
			 </td>
		  </tr>
		  <tr>
			 <td>Nama staf</td>
			 <td class="input"><?=$row[nama_lengkap]?>
			 </td>
		  </tr>
		  <tr>
			<td>ISI SMS</td>
			<td class="input"><textarea  rows="5" cols="57" wrap="physical" name=pesan {font-family:"Helvetica Neue", Helvetica, sans-serif; }></textarea>
			</td>
		  </tr>

	 </table><br>
	 <input type="hidden" value="<?=$row[Kode]?>" name="kode">
	 <input type="submit" value="Kirim SMS" name="submit">
	 </form>
	 <?
	 }
}else{
	 ?>
	 <h1 class="table">Kirim WhatsApp Per Nomor Kontak</h1>
	 <form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
	 <table class="form" width=50%  cellspacing="2" cellpadding="3" border="2">
		  <tr>
			 <td>Nomor Tujuan</td>
			 <td class="input"> <input name="notlp">
			 </td>
		  </tr>
		  <tr>
			   <td>Pesan WhatsApp</td>
			   <td class="input"><textarea  rows="5" cols="57" wrap="physical" name=pesan {font-family:"Helvetica Neue", Helvetica, sans-serif; }></textarea>
			   </td>
		  </tr>

	 </table><br>
	 <input type="hidden" value="<?=$row[Kode]?>" name="kode">
	 <input type="submit" class=swn_button_blue value="Kirim Pesan WA" name="submit">
	 </form>
	 <?
}
?>
