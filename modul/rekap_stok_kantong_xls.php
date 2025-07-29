<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_stok_kantong.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<table><td> DATA REKAP STOK KANTONG DARAH PADA <?=$today1?></td></table>
<br>
<table border=0 width=70% align=left>
  <tr><td>
  <!--link type="text/css" href="css/stok_darah.css" rel="stylesheet" />

  <!--form name="checkkantong" method="POST">
    <table id="background-image" summary="Check kantong" width="80%">
    <tr><td> Check No Kantong</td><td>:<input type=text name=nokantong1></td></tr>
    <tr><td></td><td><input type=submit name=submit value="Submit"></td></tr>
    </table>
  </form-->
<font color="#e30f0f" size=2 face="Verdana, Arial, Helvetica, sans-serif">DARAH KARANTINA</font>
<!--font color="#000000" size=1 face="Verdana, Arial, Helvetica, sans-serif">(tanpa dikurangi stok emergency)</font-->
<table>
	<tr>
		<th >Produk</th>
		<th >A</th>
		<th >B</th>
		<th >AB</th>
		<th >O</th>
		<th align="center">JUMLAH</th>
	</tr>
<?
$jumAK='0';
$jumBK='0';
$jumABK='0';
$jumOK='0';
$produkk=mysql_query("select * from produk order by no");
while ($produk1k=mysql_fetch_assoc($produkk)) {
$AK=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1k[Nama]' and Status='1'
		and gol_darah='A' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$BK=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1k[Nama]' and Status='1'
		and gol_darah='B' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$ABK=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1k[Nama]' and Status='1'
		and gol_darah='AB' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$OK=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1k[Nama]' and Status='1'
		and gol_darah='O' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$pak=$produk1k[Nama]."_a";
$pbk=$produk1k[Nama]."_b";
$pabk=$produkk1[Nama]."_ab";
$pok=$produk1k[Nama]."_o";
$jumAK=$jumAK+$AK;
$jumBK=$jumBK+$BK;
$jumABK=$jumABK+$ABK;
$jumOK=$jumOK+$OK;
$stokk=mysql_query("update stok set $pak='$AK',$pbk='$BK',$pabk='$ABK',$pok='$OK' where status='0'");
if ($AK<1)  $AK='-';
if ($BK<1)  $BK='-';
if ($ABK<1) $ABK='-';
if ($OK<1)  $OK='-';
$totalk=$AK+$BK+$ABK+$OK;
$jumtotalk=$jumAK+$jumBK+$jumABK+$jumOK;
if ($totalk<1) $totalk='-';
echo "<tr>
		<td>$produk1k[Nama]</td>
		<td>$AK</td>
		<td>$BK</td>
		<td>$ABK</td>
		<td>$OK</td>
		<td align='center'>$totalk</td>
	</tr>"	;}
echo "
<tr>
		<th scope='col'>Jumlah</th>
		<th scope='col'>$jumAK</th>
		<th scope='col'>$jumBK</th>
		<th scope='col'>$jumABK</th>
		<th scope='col'>$jumOK</th>
		<th align='center'>$jumtotalk</th>
	</tr>
";
?>
</table>
<br>
<font color="#e30f0f" size=2 face="Verdana, Arial, Helvetica, sans-serif">DARAH SEHAT</font>
<font color="#000000" size=1 face="Verdana, Arial, Helvetica, sans-serif">(tanpa dikurangi stok emergency)</font>
<table>
	<tr>
		<th >Produk</th>
		<th >A</th>
		<th >B</th>
		<th >AB</th>
		<th >O</th>
		<th align="center">JUMLAH</th>
	</tr>
<?
$jumA='0';
$jumB='0';
$jumAB='0';
$jumO='0';
$produk=mysql_query("select * from produk order by no");
while ($produk1=mysql_fetch_assoc($produk)) {
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$pa=$produk1[Nama]."_a";
$pb=$produk1[Nama]."_b";
$pab=$produk1[Nama]."_ab";
$po=$produk1[Nama]."_o";
$jumA=$jumA+$A;
$jumB=$jumB+$B;
$jumAB=$jumAB+$AB;
$jumO=$jumO+$O;
$stok=mysql_query("update stok set $pa='$A',$pb='$B',$pab='$AB',$po='$O' where status='0'");
if ($A<1) $A='-';
if ($B<1) $B='-';
if ($AB<1) $AB='-';
if ($O<1) $O='-';
$total=$A+$B+$AB+$O;
$jumtotal=$jumA+$jumB+$jumAB+$jumO;
if ($total<1) $total='-';
echo "<tr>
		<td>$produk1[Nama]</td>
		<td>$A</td>
		<td>$B</td>
		<td>$AB</td>
		<td>$O</td>
		<td align='center'>$total</td>
	</tr>"	;}
echo "
<tr>
		<th scope='col'>Jumlah</th>
		<th scope='col'>$jumA</th>
		<th scope='col'>$jumB</th>
		<th scope='col'>$jumAB</th>
		<th scope='col'>$jumO</th>
		<th align='center'>$jumtotal</th>
	</tr>
";
?>
</table>
<br>
<table>
<font color="#e30f0f" size=2 face="Verdana, Arial, Helvetica, sans-serif">Darah Titipan</font>
<table>
    	<tr>
            <th scope="col">Produk</th>
            <th scope="col">A</th>
            <th scope="col">B</th>
            <th scope="col">AB</th>
            <th scope="col">O</th>
		<th scope="col">JUMLAH</th>
        </tr>
<?php
$produk=mysql_query("select * from produk order by no");
while ($produk1=mysql_fetch_assoc($produk)) {
	$A=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='A' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$B=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='B' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$AB=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='AB' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$O=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='O' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
$pa=$produk1[Nama]."_a";
$pb=$produk1[Nama]."_b";
$pab=$produk1[Nama]."_ab";
$po=$produk1[Nama]."_o";
$pjumA=$pjumA+$A;
$pjumB=$pjumB+$B;
$pjumAB=$pjumAB+$AB;
$pjumO=$pjumO+$O;
$stok=mysql_query("update stok set $pa='$A',$pb='$B',$pab='$AB',$po='$O' where status='2'");
if ($A<1) $A='-';
if ($B<1) $B='-';
if ($AB<1) $AB='-';
if ($O<1) $O='-';
$ptotal=$A+$B+$AB+$O;
$pjumtotal=$pjumA+$pjumB+$pjumAB+$pjumO;
if ($ptotal<1) $ptotal='-';
echo "<tr>
		<td>$produk1[Nama]</td>
		<td>$A</td>
		<td>$B</td>
		<td>$AB</td>
		<td>$O</td>
		<td align='center'>$ptotal</td>
	</tr>"	;}
echo "
<tr>
		<th scope='col'>Jumlah</th>
		<th scope='col'>$pjumA</th>
		<th scope='col'>$pjumB</th>
		<th scope='col'>$pjumAB</th>
		<th scope='col'>$pjumO</th>
		<th align='center'>$pjumtotal</th>
	</tr>
";
?>




</table>

<?
mysql_close();
?>
