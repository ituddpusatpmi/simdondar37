<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_form_permintaan_darah.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');

	
$today   =$_POST[today];
$today1  =$_POST[today1];
$srcnama =$_POST[srcnama];
$srcrm   =$_POST[srccm];
$srcform =$_POST[srcform];
$src_abo =$_POST[src_abo];
$src_rh  =$_POST[src_rh];
$src_rs  =$_POST[src_rs];
$src_lyn =$_POST[src_lyn];
$src_produk=$_POST[src_produk];
?>
<font size="5" color=blue>DAFTAR REKAP PERMINTAAN DARAH</font><br>
<form method=post>
	<font size="3" color=blue>
	DARI TANGGAL :    <?=$today?>   
	S/D TANGGAL  :    <?=$today1?>
	
	</font>
	<br>
	<font size="3" color=magenta>
	<!--input type="submit" name="submit" value="Lihat" class="swn_button_blue"--> 
</form>
<?


if ($src_produk==''){
$allcount=mysql_query("select * from htranspermintaan where CAST(htranspermintaan.tgl_register as date) >='$today' and CAST(htranspermintaan.tgl_register as date)<='$today1' ");
    $trans0=mysql_query("select htranspermintaan.*, pasien.nama, DATE_FORMAT(pasien.tgl_lahir, '%d-%m-%Y') as tgl_lahir, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin, dtranspermintaan.JenisDarah from htranspermintaan JOIN pasien
    ON htranspermintaan.no_rm = pasien.no_rm
    JOIN dtranspermintaan
    ON dtranspermintaan.NoForm = htranspermintaan.noform
                         where CAST(htranspermintaan.tgl_register as date) >='$today' and CAST(htranspermintaan.tgl_register as date)<='$today1'
                         and pasien.nama like '%$srcnama%'
                         and pasien.no_rm like '%$srcrm%'
                         and htranspermintaan.noform like '%$srcform%'
                         and pasien.gol_darah like '%$src_abo%'
                         and pasien.rhesus like '%$src_rh%'
                         and htranspermintaan.jenis like '%$src_lyn%'
                         and htranspermintaan.diagnosa like '%$src_diag%'
                         and htranspermintaan.shift like '%$src_shift%'
                         and htranspermintaan.rs like '%$src_rs%'
                         and htranspermintaan.bagian like '%$srcbagian%'
                         and htranspermintaan.jenis_permintaan like '%$jnspermintaan%'

                         and htranspermintaan.status!=2
                         group by htranspermintaan.noform
                         order by tgl_register desc");
                        } else {
                        $allcount=mysql_query("select * from htranspermintaan where CAST(htranspermintaan.tgl_register as date) >='$today' and CAST(htranspermintaan.tgl_register as date)<='$today1' ");
                        $trans0=mysql_query("select htranspermintaan.*, pasien.nama, DATE_FORMAT(pasien.tgl_lahir, '%d-%m-%Y') as tgl_lahir, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin, dtranspermintaan.JenisDarah from htranspermintaan JOIN pasien
                        ON htranspermintaan.no_rm = pasien.no_rm
                        JOIN dtranspermintaan
                        ON dtranspermintaan.NoForm = htranspermintaan.noform
                                             where CAST(htranspermintaan.tgl_register as date) >='$today' and CAST(htranspermintaan.tgl_register as date)<='$today1'
                                             and pasien.nama like '%$srcnama%'
                                             and pasien.no_rm like '%$srcrm%'
                                             and htranspermintaan.noform like '%$srcform%'
                                             and pasien.gol_darah like '%$src_abo%'
                                             and pasien.rhesus like '%$src_rh%'
                                             and htranspermintaan.jenis like '%$src_lyn%'
                                             and htranspermintaan.diagnosa like '%$src_diag%'
                                             and htranspermintaan.shift like '%$src_shift%'
                                             and htranspermintaan.rs like '%$src_rs%'
                                             and htranspermintaan.bagian like '%$srcbagian%'
                                             and htranspermintaan.jenis_permintaan like '%$jnspermintaan%'
                                             and dtranspermintaan.JenisDarah = '$src_produk'
                                             and htranspermintaan.status!=2
                                             group by htranspermintaan.noform
                                             order by tgl_register desc");
                        
                        }
$rows=mysql_num_rows($trans0);
$rows2=mysql_num_rows($allcount);

echo'Sebanyak ';
echo $rows ;
echo' data dari total ';
echo $rows2;
echo' data permintaan ';
echo'<b>';
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="110%">
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td rowspan=2 align="center">NO</td>
	    	<td rowspan=2 align="center">NO FORM</td>
	    	<td rowspan=2 align="center">TGL MINTA</td>
		<td rowspan=2 align="center">NO. RM</td>
	    	<td rowspan=2 align="center">NAMA PASIEN</td>
		<td rowspan=2 align="center">KEL</td>
	    	<td rowspan=2 align="center">ALAMAT</td>
	    	<td rowspan=2 align="center">RUMAH SAKIT</td>
		<td rowspan=2 align="center">DIAGNOSA</td>
		<td rowspan=2 align="center">BAGIAN</td>
		<td rowspan=2 align="center">KLAS</td>
	 	<td rowspan=2 align="center">JENIS<br>LAYANAN</td>
	    	<td rowspan=2 align="center">GOL</td>
		<td rowspan=2 align="center">TGL DIPERLUKAN</td>
		<td rowspan=2 align="center">JENIS DARAH/JML</td>
	    	<td colspan=2 align="center">STATUS</td>
		<td rowspan=2 align="center">JENIS<br>PERMINTAAN</td>		
		<td rowspan=2 align="center">SHIFT</td>
		<td rowspan=2 align="center">TEMPAT</td>
		<td rowspan=2 align="center">PETUGAS INPUT</td></tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td>BAWA</td>
		<td>TITIP</td></tr>	
	<?
	$no=1;
	while ($trans=mysql_fetch_assoc($trans0)) {
		$jenisminta=mysql_fetch_assoc(mysql_query("select group_concat(' ',`JenisDarah`,'(',jumlah,')') as jenis from dtranspermintaan where `NoForm`='$trans[noform]'"));
		$dtrans=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah,GolDarah,JenisDarah from dtranspermintaan where NoForm='$trans[noform]'"));
		$norm= $trans[no_rm];?>
		<tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no++?>.</td> 
			<?
			$bawa=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as noform from dtransaksipermintaan as dt where dt.NoForm='$trans[noform]' and (dt.Status='0' or dt.Status='L')"));
			$titip=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as noform from dtransaksipermintaan as dt where dt.NoForm='$trans[noform]' and dt.Status='1'"));
			$total=$bawa[noform]+$titip[noform];
			if ($_SESSION[leveluser]=='laboratorium' or $_SESSION[leveluser]=='bdrs') {
				if ($dtrans[Jumlah]>$total) {
					if ($_SESSION[leveluser]=='laboratorium') echo "<td class=input><a href=pmilaboratorium.php?module=crossmatch&noform=$trans[noform]>$trans[noform]</a></td>";  
					if ($_SESSION[leveluser]=='bdrs') echo "<td class=input><a href=pmibdrs.php?module=crossmatch&noform=$trans[noform]>$trans[noform]</a></td>";  
				} else {?>
					<td class=input><?=$trans[noform]?></td><?
				}
			} else { 
				if ($_SESSION[leveluser]=='kasir' or $_SESSION[leveluser]=='bdrs') {
					$bayar=mysql_query("select * from dtransaksipermintaan where noForm='$trans[noform]' and (status='0' or status='1')");
					$nbayar=mysql_num_rows($bayar);
					if ($nbayar>0) {
						echo "<td class=input><a href=pmikasir.php?module=pembayaran&noform=$trans[noform]>$trans[noform]</a></td>"; 
					} else {?>
						<td class=input><?=$trans[noform]?></td><?
					}
				} else {?>
					<td class=input><?=$trans[noform]?></td><?
				}
			}?>
			<td class=input nowrap><?=$trans[tgl_register]?></td>
			<td class=input><?=$trans[no_rm]?></td>
			<td class=input><?=$trans[nama]?></td>
			<td class=input><?=$trans[kelamin]?></td>
			<td class=input><?=$trans[alamat]?></td>
			<?$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$trans[rs]'"));?>
			<td class=input><?=$rmhskt[NamaRs]?></td>
			<td class=input><?=$trans[diagnosa]?></td>
			<td class=input><?=$trans[bagian]?></td>
			<td class=input nowrap><?=$trans[kelas]?></td>
			<?
			$jenis=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$trans[jenis]'"));
			?>		
			<td class=input><?=$jenis[nama]?></td>
			<td class=input><?=$dtrans[GolDarah].'('.$trans[rhesus].')'?></td>
			<td class=input><?=$trans[tglminta]?></td>
			<td class=input><?=$jenisminta[jenis]?></td>
			<td class=input><?=$bawa[noform]?></td>
			<td class=input><?=$titip[noform]?></td>
			<? $shif3='';
			if ($trans[shift]=='1') $shif3='I';
			if ($trans[shift]=='2') $shif3='II';
			if ($trans[shift]=='3') $shif3='III';
			if ($trans[shift]=='4') $shif3='IV';		
			?>
			<td class=input align=center><?=$trans[jenis_permintaan]?></td>
			<td class=input><? echo $shif3?></td>	
			<td class=input><?=$trans[tempat]?></td>
			<td class=input><?=$trans[petugas]?></td>
	</tr>
<?
}
?>
</table>
<?
mysql_close();
?>
