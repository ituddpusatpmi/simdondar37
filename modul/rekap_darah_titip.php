<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$today=date('Y-m-d');
$today1=$today;
$srcnama="";
$srcrm="";
$srcform="";
$nokan="";
$src_abo="";
$src_rh="";
$src_rs="";
$src_lyn="";
$src_shift="";


if ($_POST[nama]!='') $srcnama=$_POST[nama];
if ($_POST[rm]!='') $srcrm=$_POST[rm];
if ($_POST[nomorf]!='') $srcform=$_POST[nomorf];
if ($_POST[nokan]!='') $srckan=$_POST[nokan];

?>
<style>
  tr { background-color: #FDF5E6}
  .initial { background-color: #FDF5E6; color:#000000 }
  .normal { background-color: #FDF5E6 }
  .highlight { background-color: #8888FF }
</style>
<font size="5" color=red>REKAP DARAH TITIPAN</font><br>
<form method=post>
	<font size="2" color=black>
	NO.FORM <input type=text name=nomorf id=nomorf size=10 value=<?=$srcform?>>
	NO.KANTONG <input type=text name=nokan id=nokan size=10 value=<?=$srckan?>>
	KODE PASIEN <input type=text name=rm id=rm size=10 value=<?=$srcrm?>>
	NAMA PASIEN<input type=text name=nama id=nama size=8 value=<?=$srcnama?>>
	<input type="submit" name="submit" value="Lihat" class="swn_button_blue"> 
</form>
<?

$allcount=mysql_query("select * from dtransaksipermintaan where status='1' ");
$trans0=mysql_query("select dtransaksipermintaan.*, pasien.nama, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin from dtransaksipermintaan inner join pasien on pasien.no_rm=dtransaksipermintaan.no_rm
  		     where dtransaksipermintaan.status='1'
		     and pasien.nama like '%$srcnama%'
		     and pasien.no_rm like '%$srcrm%'
		     and dtransaksipermintaan.NoForm like '%$srcform%'
		     and dtransaksipermintaan.nokantong like '%$srckan%' order by tgl DESC");
$rows=mysql_num_rows($trans0);
$rows2=mysql_num_rows($allcount);

echo'<b>';
echo $rows ;
echo' data dari total ';
echo $rows2;
echo' data permintaan ';
echo'<b>';
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="110%">
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align="center">NO</td>
		<td align="center">NO FORM</td>
		<td align="center">TGL CROSS</td>
		<td align="center">KANTONG</td>
		<td align="center">Gol&Rh</td>
		<td align="center">PRODUK</td>
		<td align="center">NO. RM</td>
	    	<td align="center">NAMA PASIEN</td>
		<td align="center">L/P</td>
		<td align="center">Gol&Rh</td>
	    	<td align="center">ALAMAT</td>
	    	<td align="center">RUMAH SAKIT</td>
		<td align="center">BAGIAN</td>
		<td align="center">KLAS</td>
		<td align="center">RUANGAN</td>
	 	<td align="center">JENIS<br>LAYANAN</td>
		<td align="center">TGL DIPERLUKAN</td>
		<td align="center">JENIS<br>PERMINTAAN</td>	
		<td align="center">SHIFT</td>
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
            <? if ($_SESSION[leveluser]=='kasir2') {
                    $bayar=mysql_query("select * from dtransaksipermintaan where NoForm='$trans[NoForm]' and status='1'");
                    $nbayar=mysql_num_rows($bayar);
                    if ($nbayar>0) {
                        echo "<td class=input><a href=pmikasir2.php?module=pembayaran&noform=$trans[NoForm] TITLE=\"Pembayaran\">$trans[NoForm]</a></td>";
                    } } else {?><td class=input><?=$trans[NoForm]?></td><?}?>
			<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>
		
			<td class=input><?=$trans[NoKantong]?></td>
			<td class=input><?=$trans[gol_darah].' ('.$trans[rh_darah].')'?></td>
			<td class=input><?=$trans[produk_darah]?></td>
			
			
		
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
	</tr>
<?
}
?>
</table>
<br>
<form name=xls method=post action=modul/rekap_darah_titipan_xls.php>
  	
		
	<input type=hidden name=srcnama value='<?=$srcnama?>'>
	<input type=hidden name=srcrm value='<?=$srcrm?>'>
	<input type=hidden name=srcform value='<?=$srcform?>'>
	<input type=hidden name=nokan value='<?=$nokan?>'>
	
	<input type=submit name=submit2 value='Print Rekap Darah Titipan (.XLS)'>
</form>
