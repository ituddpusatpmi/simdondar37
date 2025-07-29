<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pengiriman_darah_keudd_lain.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';

$namauser=$_GET[namauser];
$rs1=mysql_fetch_assoc(mysql_query("select nama from utd where id='$_GET[rs]'"));
$rmhskt=$rs1[nama];
$today=date("Y-m-d");
$tgl1=date("d",strtotime($today));
$bln1=date("n",strtotime($today));
$thn1=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];
?>
<h3 class=table>
Pengiriman Darah UDD Lain <br>
Tujuan : <?=$rmhskt?> <br>
Tanggal : <?=$tgl1?> - <?=$bln11?> - <?=$thn1?><br>
</h3>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
        <td>No </td>
        <td>No Kantong</td>
        <td>Gol & Rh Darah</td>
	<td>Komponen</td>
	<td>Tgl Aftap</td>
	<td>Tgl Kadaluarsa</td>
	<td>Tgl Pengolahan</td>
	<td>Tgl Periksa</td>
         </tr>
<?
$nk=substr($_GET[nk1],1);
$nk0=explode(";",$nk);
$no=0;
for ($i=0;$i<count($nk0);$i++) {
//echo "<br> $nk0[$i] $rmhskt";

$bdrs=mysql_fetch_assoc(mysql_query("select noKantong,gol_darah,RhesusDrh,produk,tgl_Aftap,kadaluwarsa,tglpengolahan,tglperiksa from stokkantong where noKantong='$nk0[$i]'"));
$no++;
?>
<tr class="record">
<td class=input><?=$no?></td>
<td class=input><?=$bdrs[noKantong]?></td>
<td class=input><?=$bdrs[gol_darah]?>(<?=$bdrs[RhesusDrh]?>)</td>
<td class=input><?=$bdrs[produk]?></td>
<td class=input><?=$bdrs[tgl_Aftap]?></td>
<td class=input><?=$bdrs[kadaluwarsa]?></td>
<td class=input><?=$bdrs[tglpengolahan]?></td>
<td class=input><?=$bdrs[tglperiksa]?></td>
</tr>
<?
}
?>
</table>
<table>
<tr><td></td><td></td><td>Yang Menyerahkan :</td></tr>
<?
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
?>
<tr><td></td><td></td><td><?=$udd[nama]?></td></tr>
<tr><td></td><td>Yang Menerima</td><td>Yang Menyerahkan</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td>(.......................)</td><td>( <? echo $namauser;?> )</td></tr>
</table>
