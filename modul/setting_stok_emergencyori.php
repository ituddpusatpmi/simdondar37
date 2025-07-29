<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?php
  include('clogin.php');
  include('config/db_connect.php');
  session_start();
  $namauser=$_SESSION[namauser];
  
if ($_POST[submit]) {
   $sosa  	= $_POST['intsosa'];
   $sosb  	= $_POST['intsosb'];
   $soso  	= $_POST['intsoso'];
   $sosab  	= $_POST['intsosab'];
   $lengkap  	= $_POST['namalengkap'];
   $umurhari  	= $_POST['umurhari'];
//   $umurjam  	= $_POST['umurjam'];
   for ($i=0;$i<count($lengkap);$i++) {
    $simpan=mysql_query("update produk set sosA='$sosa[$i]', sosB='$sosb[$i]', sosO='$soso[$i]', sosAB='$sosab[$i]', umurhari='$umurhari[$i]'
			where lengkap='$lengkap[$i]'");
  }
}

  $h=mysql_query("select no, Nama, lengkap, sosA, sosB, sosO, sosAB, umurhari, umurjam from produk order by no");
?>
<h1><strong>SETTING STOK EMERGENCY</h1></strong>
<form name="transaksi"  method="post" action="<?=$PHPSELF?>">
  <table class="form" border="0" cellspacing="1" cellpadding="5" width=750 style="border-collapse:collapse">
    <table class="list" border="1" cellspacing="4" cellpadding="5" width=750 style="border-collapse:collapse">
      <tr class="field">
	<td  align="center">No</td>
	<td  align="center">Nama Produk</td>
	<td  align="center">SOS A</td>
	<td  align="center">SOS B</td>
	<td  align="center">SOS O</td>
	<td  align="center">SOS AB</td>
	<td  align="center">EXP. HARI</td>
      </tr>
	
      <?
      $no=0;
    while ($dtrans = mysql_fetch_assoc($h)){
	  $no++;
	  echo "<tr class=\"record\">
                <td align=center>".$dtrans['no']."</td>
                <td align=left>".$dtrans['lengkap']."</td><input type=hidden name='namalengkap[]' value='$dtrans[lengkap]'>
		<td class='input'><input name='intsosa[]' type='text' size='5' value='$dtrans[sosA]' style='text-align:right'></td>
		<td class='input'><input name='intsosb[]' type='text' size='5' value='$dtrans[sosB]' style='text-align:right'></td>
		<td class='input'><input name='intsoso[]' type='text' size='5' value='$dtrans[sosO]' style='text-align:right'></td>
		<td class='input'><input name='intsosab[]' type='text' size='5' value='$dtrans[sosAB]' style='text-align:right'></td>
		<td class='input'><input name='umurhari[]' type='text' size='5' value='$dtrans[umurhari]' style='text-align:right'></td>
		
		</tr>";
  }
  ?>
</table>
</table>
  <br>
<input name="submit" type="submit" value="Simpan">
</form>


  

