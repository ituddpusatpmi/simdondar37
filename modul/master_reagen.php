<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<? 
if (isset($_POST[submit])) {
        $_POST[submit]="";
	if ($_POST[id_edit]!="")	{
		$master=mysql_query("update master_reagen set nama_reagen='$_POST[nama_reagen]',metode='$_POST[metode]',jenis_reagen='$_POST[jenis_reagen]',reaktif='$_POST[reaktif]',nonreaktif='$_POST[nonreaktif]',greyzone='$_POST[greyzone]' where id='$_POST[id_edit]'");
		if ($master) echo ("Barang $_POST[nama_reagen] telah diubah !! 
		<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=pmiimltd.php?module=master_reagen\">"); 
        	$_POST[id_edit]=="";
		}
	else	{
		//$ck=mysql_query("select nama_reagen from master_reagen where nama_reagen='$_POST[nama_reagen]'");
		//if ($ck) $num_ck=mysql_num_rows($ck);
        	//if ($num_ck<1) {
		$id=mysql_fetch_assoc(mysql_query("select id from master_reagen order by id desc limit 1"));		
		$kodet2 = substr($id[id],0,2);
		//$kodet2 = (int)$kodet2;
		$kodet3 = $kodet2+1;

			$reag=mysql_query("insert into master_reagen (id,nama_reagen,jenis_reagen,metode,reaktif,nonreaktif,greyzone) value 
			('$kodet3','$_POST[nama_reagen]','$_POST[jenis_reagen]','$_POST[metode]','$_POST[reaktif]','$_POST[nonreaktif]','$_POST[greyzone]')");
        		if ($reag) {echo ("<b>$_POST[nama_reagen]</b> telah berhasil ditambahkan
<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=pmiimltd.php?module=master_reagen\">");}
			//}
		else {echo "Barang <b>$_POST[nama_reagen]</b> sudah diinput , silakan check ulang";}
		}
	}
else {
	if ($_GET[hapus]=="1")  { 
		$gosok=mysql_query("delete from master_reagen where id='$_GET[id]'");
		if ($gosok) echo ("<b>$_POST[nama_reagen]</b> telah terhapus !! 
		<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=pmiimltd.php?module=master_reagen\">"); }
	else	{
        	$rg=mysql_query("select * from master_reagen where id='$_GET[id]'");
        	$hasil=mysql_fetch_array($rg); 
?>  
<table border="0">
<tr>
<td>
<form name="tambah" method="post">
<p><font color="#0000FF" size="2" face="Verdana">
  Master Reagen</font></p> 
 <table class="form">
    <tr> 
      <td>Nama Reagen</td>
      <th>:</th>
      <td class="input"> 
        <input name="nama_reagen" type="text" value="<?=$hasil[nama_reagen]?>"></td>
    </tr>
    <tr> 
      <!--td>Jenis Reagen</td>
      <th>:</th>
      <td class="input"> 
        <input name="jenis_reagen" type="text" value="<?=$hasil[jenis_reagen]?>">
<input name="id_edit" type="hidden" value="<?=$hasil[id]?>">
</td>
    </tr-->

<?
$jenis1='';
$jenis2='';
$jenis3='';
$jenis4='';
if ($hasil[jenis_reagen]=="HBsAg") $jenis1='selected';
if ($hasil[jenis_reagen]=="HCV") $jenis2='selected';
if ($hasil[jenis_reagen]=="HIC") $jenis3='selected';
if ($hasil[jenis_reagen]=="Syphilis") $jenis4='selected';
?>
    <tr> 
      <td>Jenis Reagen</td>
      <th>:</th>
      <td class="input"> 
	<select name='jenis_reagen'>
	<option value='HBsAg' <?=$jenis1?>>HBsAg</option>
	<option value='HCV' <?=$jenis2?>>HCV</option>
	<option value='HIV' <?=$jenis3?>>HIV</option>
	<option value='Syphilis' <?=$jenis3?>>Syphilis</option>
	</select>
<input name="id_edit" type="hidden" value="<?=$hasil[id]?>">
</td>
    </tr>



<?
$pilih1='';
$pilih2='';
$pilih3='';
if ($hasil[metode]=="elisa") $pilih1='selected';
if ($hasil[metode]=="rapid") $pilih2=='selected';
if ($hasil[metode]=="nat") $pilih3='selected';
if ($hasil[metode]=="clia") $pilih4='selected';
?>
    <tr> 
      <td>Metoda</td>
      <th>:</th>
      <td class="input"> 
	<select name='metode'>
	<option value='rapid' <?=$pilih2?>>Rapid</option>
	<option value='elisa' <?=$pilih1?>>Elisa</option>
	<option value='nat' <?=$pilih3?>>NAT</option>
	<option value='clia' <?=$pilih3?>>CLIA</option>
	</select>
</td>
    </tr>
    <tr> 
      <td>Reaktif</td>
      <th>&ge;</th>
      <td class="input"> 
	<input name="reaktif" type="text" value="<?=$hasil[reaktif]?>">
</td>
    </tr>
    <tr> 
      <td>Non Reaktif</td>
      <th><</th>
      <td class="input"> 
	<input name="nonreaktif" type="text" value="<?=$hasil[nonreaktif]?>">
</td>
    </tr>
    <tr> 
      <td>Grey Zone</td>
      <th>&ge;</th>
      <td class="input"> 
	<input name="greyzone" type="text" value="<?=$hasil[greyzone]?>">
</td>
    </tr>
  </table>
  <br>
  <input name="submit" type="submit" value="Submit">
</form>
<? } }?>
<?
$brg=mysql_query("select * from master_reagen order by nama_reagen ASC");
if ($brg) $num_brg=mysql_num_rows($brg);
if ($num_brg>0) {
?>
</td><td width="50"></td>
<td>
<table class="form">
<tr><td>No</td><td>Aksi</td><td>Nama Reagen</td><td>Jenis Reagen</td><td>Metode</td><td>Reaktif&nbsp;&ge;</td><td>Non Reaktif&nbsp;<</td><td>Grey Zone&nbsp;&ge;</td></tr>
<?
$no=0;
	while($brg1=mysql_fetch_array($brg)) {
		$no++;
		echo "<tr><td class=input>$no</td><td class=input>
	         <a href=pmiimltd.php?module=master_reagen&id=$brg1[id] onClick=\"javascript: if (confirm('Are sure to EDIT Data Reagen ?')) { return true; } { return false; }\"><img src=images/ubah.png></a>
                <a href=pmiimltd.php?module=master_reagen&hapus=1&id=$brg1[id] onClick=\"javascript: if (confirm('Are sure to HAPUS Data Reagen ?')) { return true; } { return false; }\"><img src=images/hapus.png></a>	
		</td><td class=input>$brg1[nama_reagen]</td><td class=input>$brg1[jenis_reagen]</td><td class=input>$brg1[metode]</td><td class=input>$brg1[reaktif]</td><td class=input>$brg1[nonreaktif]</td><td class=input>$brg1[greyzone]</td></tr>";
		}

?>
</table>
</td>
</tr>
</table>
<? } ?>	
