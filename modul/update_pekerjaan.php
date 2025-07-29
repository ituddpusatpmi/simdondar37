<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<link type="text/css" href="/css/blitzer/suwena.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?php
  session_start();
  include('clogin.php');
  include('config/db_connect.php');
  
if ($_POST["submit"]) {
  $oldpekerjaan=$_POST['pekerjaan'];
  $newpekerjaan=$_POST['ubah'];
  for ($i=0;$i<count($oldpekerjaan);$i++) {
	if ($oldpekerjaan[$i]!==$newpekerjaan[$i]){
	  $q="update pendonor set pekerjaan='$newpekerjaan[$i]' where pekerjaan='$oldpekerjaan[$i]'";
	  $simpan=mysql_query($q);
	  if ($simpan){
	  echo "Data Sudah di update<br>";}
	}
  }
}

$h=mysql_query("select pekerjaan, count(kode) as jml from pendonor group by pekerjaan");
$sel="";
?>
<font size="4" color="red" font-family="Arial">UPDATE DATA PEKERJAAN</font><br>
<form name="transaksi"  method="post" action="<?=$PHPSELF?>">
  <table class="list" border="1" cellspacing="1" cellpadding="1" width="400" style="border-collapse:collapse">
      <tr class="field">
		<td align="center">No</td>
		<td align="center">Pekerjaan</td>
		<td align="center">Jumlah<br>Data</td>
		<td align="center">Di Ubah<br>Ke:</td>
      </tr>
      <?php $no=0;
	  while ($dtrans = mysql_fetch_assoc($h)){
		$no++; 
		echo "<tr class=\"record\">
			  <td align=center>".$no."</td>
			  <td align=left>".$dtrans['pekerjaan']."</td><input type=hidden name='pekerjaan[]' value='$dtrans[pekerjaan]'>
			  <td align=right>".$dtrans['jml']."</td>
			  <td class='input'> <select name='ubah[]'>";
				$pek=mysql_query("select Nama from pekerjaan order by Nama");
				while ($p = mysql_fetch_assoc($pek)){
				if ($dtrans['pekerjaan']==$p['Nama']){
					$sel='Selected';} else {$sel="";}
					echo "<option value='$p[Nama]' $sel> $p[Nama]</option>";
			  }?>
			</select>
		  </td>
		</tr>
  <?}?>
</table>
<input name="submit" type="submit" value="Simpan" class="swn_button_blue">
</form>