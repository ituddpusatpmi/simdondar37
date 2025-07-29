<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pengiriman_bdrs.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';

$namauser=$_GET[namauser];
$rs1=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$_GET[rs]'"));
$rmhskt=$rs1[nama];
$today=date("Y-m-d");
$tgl1=date("d",strtotime($today));
$bln1=date("n",strtotime($today));
$thn1=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];
?>
<h3 class=table>
Pengiriman Darah BDRS <br>
Tujuan : <?=$rmhskt?> <br>
Tanggal : <?=$tgl1?> - <?=$bln11?> - <?=$thn1?><br>
</h3>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
         <td rowspan=2>No. </td>
         <td rowspan=2>No. Bag</td>
         <td rowspan=2>Gol. Darah</td>
		<td rowspan=2>Rhesus Darah</td>
		<td rowspan=2>Komponen</td>
		<td rowspan=2>Volume<br> (ml)</td>
		<td rowspan=2>Tgl Aftap</td>
		<td rowspan=2>Tgl Kadaluarsa</td>
		<td rowspan=2>Tgl Pengolahan</td>
         <td colspan=4>Hasil Pemeriksaan**</td>
         </tr>
         <tr><td>HIV</td><td>HBsAg</td><td>HCV</td><td>SYPHILIS</td></tr>
<?
$nk=substr($_GET[nk1],1);
$nk0=explode(";",$nk);
$no=0;
for ($i=0;$i<count($nk0);$i++) {
//echo "<br> $nk0[$i] $rmhskt";

$bdrs=mysql_fetch_assoc(mysql_query("select noKantong,produk,volume,gol_darah,RhesusDrh,tgl_Aftap,kadaluwarsa,tglpengolahan from stokkantong where noKantong='$nk0[$i]'"));
$no++;
?>
<tr class="record">
<td class=input><?=$no?></td>
<td class=input><?=$bdrs[noKantong]?></td>
<td class=input><?=$bdrs[gol_darah]?></td>
<td class=input><?=$bdrs[RhesusDrh]?></td>
<td class=input><?=$bdrs[produk]?></td>
<td class=input><?=$bdrs[volume]?></td>
<td class=input><?=$bdrs[tgl_Aftap]?></td>
<td class=input><?=$bdrs[kadaluwarsa]?></td>
<td class=input><?=$bdrs[tglpengolahan]?></td>
<td class=input>NR</td>
<td class=input>NR</td>
<td class=input>NR</td>
<td class=input>NR</td>
</tr>
<?
}
?>
</table>
                        ** R : Reaktif, NR : Non Reaktif
<table>
<tr><td></td><td></td><td></td><td></td><d></td><td></td><td align="center">Yang Menyerahkan :</td></tr>
<?
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
?>
<tr><td></td><td></td><td></td><td></td><d></td><td></td><td align="center"><?=$udd[nama]?></td></tr>
<tr><td></td><td>Yang Menerima</td><td></td><td></td><d></td><td></td><td align="center">Koordinator Laborat</td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td>(.......................)</td><td></td><td></td><td></td><td align="center">( <? echo $namauser;?> )</td></tr>
</table>
