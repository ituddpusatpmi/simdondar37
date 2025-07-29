<?php
include '../config/db_connect.php';
 $today=date('Y-m-d');
 $perbln=substr($today,5,2);
 $pertgl=substr($today,8,2);
 $perthn=substr($today,0,4);
?>
<div id="content">

          <table class="list" width="1050px">
          <tr class="header"><td colspan=5>STOK DARAH SEHAT</td></tr>
          <tr class="tgl"><td colspan=5>Tanggal: <?=$pertgl?> - <?=$perbln?> - <?=$perthn?></td></tr>
            <tr class="field">
		<td>Produk</td>
		<td>A</td>
		<td>B</td>
		<td>AB</td>
		<td>O</td>
	</tr>
<?
$produk=mysql_query("select * from produk order by no");
while ($produk1=mysql_fetch_assoc($produk)) {
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1')"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1')"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1') "));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1')"));
$pa=$produk1[Nama]."_a";
$pb=$produk1[Nama]."_b";
$pab=$produk1[Nama]."_ab";
$po=$produk1[Nama]."_o";
$stok=mysql_query("update stok set $pa='$A',$pb='$B',$pab='$AB',$po='$O' where status='1'");
if ($A<1) $A='-';
if ($B<1) $B='-';
if ($AB<1) $AB='-';
if ($O<1) $O='-';
echo "<tr class=record2>
		<td>$produk1[Nama]</td>
		<td>$A</td>
		<td>$B</td>
		<td>$AB</td>
		<td>$O</td>
	</tr>";}?>
</table>

    </div>
