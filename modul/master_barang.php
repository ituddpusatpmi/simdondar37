<script type="text/javascript">
//var str;
function showHint(str)
{
if (str.length==0)
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","modul/master_barang.php?q="+str,true);
xmlhttp.send();
}
</script>
<? if ($_GET[q]=='') { ?>
<h1 class="table">Master Barang</h1>
<table class="form">
   <tr>
	  <td> Nama Barang</td>
	  <td class="input">
		 <input type="text" onkeyup="showHint(this.value)" size="20" />
	  </td>
   </tr>
</table>
<table border='0'>
<tr>
<td><input name=tbrg type=button value="Tambah Barang"
onclick="$.fn.colorbox({href:'modul/entry_barang.php',
iframe:true, innerWidth:350, innerHeight:250});">
</td>
<td>
<form name=minta method=post action=lihat_minta.php>
<input type=submit name=submit3 value='Lihat Permintaan'>
</form>
</td></tr></table>

<? } ?>
<p><span id="txtHint"></span></p>
<?php
if (isset($_GET[q])) {
include ('../config/db_connect.php');
$q=$_GET["q"];
?>
<?

   $query = "SELECT * FROM hstok WHERE NamaBrg like '%$q%' order by Kode ASC limit 10";
   $hasil = mysql_query($query);
   ?>
   <h1 class="table">Data Barang Hasil Pencarian</h1>
   <table class="list" border=1 cellspacing=0 cellpadding=0>
   <tr class="field">
	  <td>Kode</td>
	  <td>Nama Barang</td>
	  <td>Stok Total</td>
	  <td>Harga</td>
	  <td>Status</td>
	  <td>Satuan</td>
	  <td>Ket Satuan</td>
	  <td>Min</td>
	  <td>Snack</td>
	  <td>Cetak Barang</td>
   </tr>
   <?
   while ($data = mysql_fetch_assoc($hasil)){
	  if($bgcolor=='#f1f1f1'){$bgcolor='#ffffff';}
	  else{$bgcolor='#f1f1f1';}
	  if ($data['status']=="0") $jbar="ATK"; else $jbar="LAB";	   
	  echo "<tr class=\"record\">
		 <td bgcolor=$bgcolor>".$data['Kode']."</td>
		 <td bgcolor=$bgcolor>";
		 $data[Kode]=str_replace(" ","%20",$data[Kode]);
				  echo "$data[NamaBrg]";?><br>
		<?	  
		echo "</td>
		 <td bgcolor=$bgcolor align=center>".$data['StokTotal']."</td>
		 <td bgcolor=$bgcolor align=center>".$data['Harga']."</td>
		 <td bgcolor=$bgcolor>".$jbar."</td>
		 <td bgcolor=$bgcolor>".$data['satuan']."</td>
		 <td bgcolor=$bgcolor>".$data['ketSatuan']."</td>
		 <td bgcolor=$bgcolor>".$data['min']."</td>
		 <td bgcolor=$bgcolor>".$data['snack']."</td>";
		?><td bgcolor=<?=$bgcolor?>>
		<form name=cetak method=post action=modul/cetak_barang.php>
		<input type=hidden name=nama value='<?=$data[NamaBrg]?>'>
		<input type=submit name=submit1 value='Print'>
		</form>
		<form name=kartu method=post action=kartu_stok.php>
		<input type=hidden name=namabrg value='<?=$data[NamaBrg]?>'>
		<input type=submit name=submit2 value='Kartu Stok'>
		</form>
		</td>
		 <? echo " </tr>";?>
<?
	
	}
	  echo "</table>";
} else {
?>
<?php
include ('../config/db_connect.php');
?>
<?

   $query = "SELECT * FROM hstok order by Kode ASC limit 10";
   $hasil = mysql_query($query);
   ?>
   <h1 class="table">Master Data Barang</h1>
   <table class="list" border=1 cellspacing=0 cellpadding=0>
   <tr class="field">
	  <td>Kode</td>
	  <td>Nama Barang</td>
	  <td>Stok Total</td>
	  <td>Harga</td>
	  <td>Status</td>
	  <td>Satuan</td>
	  <td>Ket Satuan</td>
	  <td>Min</td>
	  <td>Snack</td>
	  <td>Cetak Barang</td>
   </tr>
   <?
   while ($data = mysql_fetch_assoc($hasil)){
	  if($bgcolor=='#f1f1f1'){$bgcolor='#ffffff';}
	  else{$bgcolor='#f1f1f1';}
	  if ($data['status']=="0") $jbar="ATK"; else $jbar="LAB";
	  echo "<tr class=\"record\">
		 <td bgcolor=$bgcolor>".$data['Kode']."</td>
		 <td bgcolor=$bgcolor>";
		 $data[Kode]=str_replace(" ","%20",$data[Kode]);
				  echo "$data[NamaBrg]";?><br>
		<?
		echo "</td>
		 <td bgcolor=$bgcolor align=center>".$data['StokTotal']."</td>
		 <td bgcolor=$bgcolor align=center>".$data['Harga']."</td>
		 <td bgcolor=$bgcolor>".$jbar."</td>
		 <td bgcolor=$bgcolor>".$data['satuan']."</td>
		 <td bgcolor=$bgcolor>".$data['ketSatuan']."</td>
		 <td bgcolor=$bgcolor>".$data['min']."</td>
		 <td bgcolor=$bgcolor>".$data['snack']."</td>";
		?><td bgcolor=<?=$bgcolor?>>
		<form name=cetak method=post action=modul/cetak_barang.php>
		<input type=hidden name=nama value='<?=$data[NamaBrg]?>'>
		<input type=submit name=submit1 value='Print'>
		</form>
		<form name=kartu method=post action=kartu_stok.php>
		<input type=hidden name=namabrg value='<?=$data[NamaBrg]?>'>
		<input type=submit name=submit2 value='Kartu Stok'>
		</form>
		</td>
		 <? echo " </tr>";?>
<?

	}
	  echo "</table>";

}
?>


