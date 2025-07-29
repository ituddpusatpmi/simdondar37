<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_titipan.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');

	

$srcnama =$_POST[srcnama];
$srcrm   =$_POST[srcrm];
$srcform =$_POST[srcform];
$nokan   =$_POST[nokan];

?>
<font size="5" color=blue>DAFTAR REKAP DARAH TITIPAN</font><br>
<!--form method=post>
	<font size="3" color=blue>
	DARI TANGGAL :    <?=$today?>   
	S/D TANGGAL  :    <?=$today1?>
	
	</font>
	<br>
	<font size="3" color=magenta>
	<input type="submit" name="submit" value="Lihat" class="swn_button_blue"> 
</form-->
<font size="3" color=magenta>
<?


$allcount=mysql_query("select * from dtransaksipermintaan where status='1' ");
	$trans0=mysql_query("select dtransaksipermintaan.*, pasien.nama, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin from dtransaksipermintaan inner join pasien on pasien.no_rm=dtransaksipermintaan.no_rm
						 where dtransaksipermintaan.status='1'
						 and pasien.nama like '%$srcnama%'
						 and pasien.no_rm like '%$srcrm%'
						 and dtransaksipermintaan.NoForm like '%$srcform%'
						 and dtransaksipermintaan.nokantong like '%$srckan%'
						 
						 order by tgl");
$rows=mysql_num_rows($trans0);
$rows2=mysql_num_rows($allcount);

echo'<b>';
echo $rows ;
echo' data dari total ';
echo $rows2;
echo' data Darah Titip ';
echo'<b>';
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="110%">
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td rowspan=2 align="center">NO</td>
		<td rowspan=2 align="center">TGL CROSS</td>
		<td rowspan=2 align="center">NO KANTONG</td>
		<td rowspan=2 align="center">Gol&Rh</td>
		<td rowspan=2 align="center">PRODUK</td>
		
	    	<td rowspan=2 align="center">NO FORM</td>
	    	
		<td rowspan=2 align="center">NO. RM</td>
	    	<td rowspan=2 align="center">NAMA PASIEN</td>
		<td rowspan=2 align="center">L/P</td>
		<td rowspan=2 align="center">Gol&Rh</td>
	    	<td rowspan=2 align="center">ALAMAT</td>
	    	<td rowspan=2 align="center">RUMAH SAKIT</td>
		<td rowspan=2 align="center">BAGIAN</td>
		<td rowspan=2 align="center">KLAS</td>
		<td rowspan=2 align="center">RUANGAN</td>
	 	<td rowspan=2 align="center">JENIS<br>LAYANAN</td>

		<td rowspan=2 align="center">TGL DIPERLUKAN</td>
	
	 
		<td rowspan=2 align="center">JENIS<br>PERMINTAAN</td>	
		<td rowspan=2 align="center">SHIFT</td>
		<td rowspan=2 align="center">TEMPAT</td>
		
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		
		
		
		</tr>	
	<?
	$no=1;
	while ($trans=mysql_fetch_assoc($trans0)) {
		$jenisminta=mysql_fetch_assoc(mysql_query("select group_concat(' ',`JenisDarah`,'(',jumlah,')') as jenis from dtranspermintaan where `NoForm`='$trans[NoForm]'"));
		$dtrans=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah,GolDarah,JenisDarah from dtranspermintaan where NoForm='$trans[NoForm]'"));
		
		$minta=mysql_fetch_assoc(mysql_query("select rs,bagian,kelas,bagian,jenis_permintaan,jenis,tglminta,ruangan from htranspermintaan where noform='$trans[NoForm]'"));
		$norm= $trans[no_rm];?>
		<tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no++?>.</td> 
			<?
			$bawa=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as NoForm from dtransaksipermintaan as dt where dt.NoForm='$trans[NoForm]' and (dt.Status='0' or dt.Status='L')"));
			$titip=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as NoForm from dtransaksipermintaan as dt where dt.NoForm='$trans[NoForm]' and dt.Status='1'"));
			$total=$bawa[NoForm]+$titip[NoForm];
			if ($_SESSION[leveluser]=='laboratorium' or $_SESSION[leveluser]=='bdrs') {
				if ($dtrans[Jumlah]>$total) {
					if ($_SESSION[leveluser]=='laboratorium') echo "<td class=input><a href=pmilaboratorium.php?module=crossmatch&NoForm=$trans[NoForm]>$trans[NoForm]</a></td>";  
					if ($_SESSION[leveluser]=='bdrs') echo "<td class=input><a href=pmibdrs.php?module=crossmatch&NoForm=$trans[NoForm]>$trans[NoForm]</a></td>";  

				} }?>

<?
$kadaluwarsa=$trans[tgl];
$tglkel=date("d",strtotime($kadaluwarsa));
$blnkel=date("n",strtotime($kadaluwarsa));
$thnkel=date("Y",strtotime($kadaluwarsa));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($kadaluwarsa));
?>

			<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>
		
			<td class=input><?=$trans[NoKantong]?></td>
			<td class=input><?=$trans[gol_darah].' ('.$trans[rh_darah].')'?></td>
			<td class=input><?=$trans[produk_darah]?></td>
			<td class=input><?=$trans[NoForm]?>
			<td class=input><?=$trans[no_rm]?></td>
			<td class=input><?=$trans[nama]?></td>
			<td class=input><?=$trans[kelamin]?></td>
			<td class=input><?=$trans[gol_darah].' ('.$trans[rhesus].')'?></td>
			<td class=input><?=$trans[alamat]?></td>
			<?$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$minta[rs]'"));?>
			<td class=input><?=$rmhskt[NamaRs]?></td>
			<td class=input><?=$minta[bagian]?></td>
			<td class=input nowrap><?=$minta[kelas]?></td>
			<td class=input nowrap><?=$minta[ruangan]?></td>
		<?
			$jl=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$minta[jenis]'"));
		?>
			<td class=input><?=$jl[nama]?></td>
		
			<td class=input><?=$minta[tglminta]?></td>
			
			
			<? $shif3='';
			if ($trans[shift]=='1') $shif3='I';
			if ($trans[shift]=='2') $shif3='II';
			if ($trans[shift]=='3') $shif3='III';
			
			if ($minta[jenis_permintaan]=='0') $jenisminta='Biasa';
			if ($minta[jenis_permintaan]=='1') $jenisminta='Cadangan';
			if ($minta[jenis_permintaan]=='2') $jenisminta='Siap Pakai';
			if ($minta[jenis_permintaan]=='3') $jenisminta='Cyto';	
			 ?>
			<td class=input align=center><? echo $jenisminta?></td>
			<td class=input><? echo $shif3?></td>	
			<td class=input><?=$trans[tempat]?></td>
			<!--td class=input><?=$trans[petugas]?></td-->
	</tr>
<?
}
?>
</table>
<?
mysql_close();
?>
