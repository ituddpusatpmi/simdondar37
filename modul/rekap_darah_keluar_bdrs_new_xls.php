<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_keluar_bdrs.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');


$today      =$_POST[today];
$today1     =$_POST[today1];
$src_bdrs 	=$_POST[bdrs];
$src_produk    	=$_POST[produk];
$src_status  	=$_POST[status];
$src_golongan  	=$_POST[golongan];
$src_rhesus  	=$_POST[rhesus];

$bdrs=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode = '$src_bdrs' "));

?>
<h1>REKAP DARAH KELUAR KE <?=$bdrs[nama]?></h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>


<?
$transaksipermintaan=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.volume,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");

//gol darah
$gola=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah='A' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$golb=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah='B' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$golo=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah='O' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$golab=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah='AB' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");

//rh darah
$rhp=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah like '$src_golongan%' and RhesusDrh='+' and k.status like '%$src_status%' order by k.tgl ASC  ");
$rhn=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah like '$src_golongan%' and RhesusDrh='-' and k.status like '%$src_status%' order by k.tgl ASC  ");

//komponen
$transaksipermintaan1=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='WB' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan2=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='PRC' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan3=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='TC' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan4=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='LP' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan5=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='FFP' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan6=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='FP' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan7=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='AHF' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$transaksipermintaan8=mysql_query("select k.nokantong,k.tgl,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk='WE' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");


$countp=mysql_num_rows($transaksipermintaan);

$kompwb=mysql_num_rows($transaksipermintaan1);
$kompprc=mysql_num_rows($transaksipermintaan2);
$komptc=mysql_num_rows($transaksipermintaan3);
$komplp=mysql_num_rows($transaksipermintaan4);
$kompffp=mysql_num_rows($transaksipermintaan5);
$kompfp=mysql_num_rows($transaksipermintaan6);
$kompahf=mysql_num_rows($transaksipermintaan7);
$kompwe=mysql_num_rows($transaksipermintaan8);

$kompa=mysql_num_rows($gola);
$kompb=mysql_num_rows($golb);
$kompo=mysql_num_rows($golo);
$kompab=mysql_num_rows($golab);

$komppos=mysql_num_rows($rhp);
$kompneg=mysql_num_rows($rhn);

$namabdrs=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode = '$src_bdrs' "));
echo"<br>";
echo"Total Data Darah $namabdrs[nama] sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " Data Kantong, Dg Rincian :";
echo "<br><br>";
echo "Gol Darah: (A = $kompa ktg) - (B = $kompb ktg) - (O = $kompo ktg) - (AB = $kompab ktg) ----------- Rh Darah: (Pos = $komppos ktg) - (Neg = $kompneg ktg)";
echo "<br> <br>Jenis Komponen: (WB = $kompwb ktg) - (PRC = $kompprc ktg) - (TC = $komptc ktg) - (LP = $komplp ktg) - (FFP = $kompffp ktg) - (FP = $kompfp ktg) 
- (AHF = $kompahf ktg) - (WE = $kompwe ktg)";

?>
<br>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>Tgl Keluar</td>
	<td>Nama BDRS</td>
	<td>No Kantong</td>
        <td>Gol (Rh) Darah</td>
        <td>Komponen</td>
		<td>Volume</td>
        <td>Tgl Aftap</td>
	<td>Tgl Exp.</td>
        <td>Tgl Periksa</td>
	<td>Jenis</td>
	<td>Petugas</td>
	<td>Status</td>	
	<td>tgl Kembali</td>
        </tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FFFFFF; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl']?></td>
	
	<? 	
	$bdrs=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$datatransaksipermintaan[bdrs]'"));
	
	?>
	
	<td align="center"><?=$bdrs['nama']?></td>
	<td align="center"><?=$datatransaksipermintaan['nokantong']?></td>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?> (<?=$datatransaksipermintaan['RhesusDrh']?> )</td>
	<td align="center"><?=$datatransaksipermintaan['produk']?></td>
	<td align="center"><?=$datatransaksipermintaan['volume']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_Aftap']?></td>
	<td align="center"><?=$datatransaksipermintaan['kadaluwarsa']?></td>
	<td align="center"><?=$datatransaksipermintaan['tglperiksa']?></td>
	<?
	$jns="Double";
	if ($datatransaksipermintaan['jenis']=='1') $jns="Single";
	if ($datatransaksipermintaan['jenis']=='3') $jns="Threeple";
	if ($datatransaksipermintaan['jenis']=='4') $jns="Quadruple";
	if ($datatransaksipermintaan['jenis']=='6') $jns="Pediatrik";

		?>
	<td align="center"><?=$jns?></td>
	<td align="center"><?=$datatransaksipermintaan['petugas']?></td>
			<?
			if ($datatransaksipermintaan[status]=='0') $status='keluar';
			if ($datatransaksipermintaan[status]=='1') $status='Kembali';
			
			$tglkembali=$datatransaksipermintaan[tglkembali];
			if ($datatransaksipermintaan[tglkembali]==NULL) $tglkembali='-';
				
			 ?>
	<td align="center"><?=$status?></td>

	
	<td align="center"><?=$tglkembali?></td>
</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
