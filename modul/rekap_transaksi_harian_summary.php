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
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 5px;font-size: 15px;cursor: pointer; }</style>
<STYLE>
  tr { background-color: #FFF8DC}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: ##FFF8DC }
  .highlight { background-color: #8888FF }
</style>
<?
include('config/db_connect.php');

$level_user=$_SESSION['leveluser'];
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[terima1])) {$today=$_POST[terima1];$today1=$today;}
if ($_POST[terima2]!='') $today1=$_POST[terima2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

$tot_ds=0;
$tot_dp=0;
$tot_baru=0;
$tot_ulang=0;
$tot_lk=0;
$tot_pr=0;
$tot_antri=0;
$tot_berhasil=0;
$tot_gagal=0;
$tot_batal=0;
$tot_biasa=0;
$tot_aph=0;
$tot_a=0;
$tot_b=0;
$tot_ab=0;
$tot_o=0;
$tot_x=0;
$tot_ttl=0;
?>
<font size="4" color=red font-family="Arial">REKAP PENGAMBILAN DARAH DONOR Tanggal <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> s/d <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></font><br>
<div>
	<form name=sahdarah1 method=post>
	<table class="form" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>Dari Tanggal :<input type=text name=terima1 id=datepicker size=10 value=<?=$today?>></td>
			<td>sampai : <input type=text name=terima2 id=datepicker1 size=10 value=<?=$today1?>></td>
			<td><input type=submit name=submit value=Tampilkan class="swn_button_blue">
			<td><a href="pmi<?=$level_user?>.php?module=rekap_transaksi1" class='swn_button_blue'>Rekap Transaksi Donor</a>
			</td>
		</tr>
	</table>
	</form>
</div>

<?
$sql_intsansidonor="select Instansi from htransaksi where CAST(`Tgl` as date)>='$today' and CAST(`Tgl` as date)<='$today1' group by Instansi";
$sql_trans="select instansi, COUNT(case when JenisDonor='0' THEN 1 END) As Sukarela, COUNT(case when JenisDonor='1' THEN 1 END) As Pengganti, COUNT(case when donorbaru='0' THEN 1 END) As baru, COUNT(case when donorbaru='1' THEN 1 END) As ulang, COUNT(case when Pengambilan='-' THEN 1 END) As Antri,COUNT(case when Pengambilan='0' THEN 1 END) As Berhasil,COUNT(case when Pengambilan='1' THEN 1 END) As Batal,
		COUNT(case when Pengambilan='2' THEN 1 END) As Gagal,COUNT(case when jk='0' THEN 1 END) As Laki,COUNT(case when jk='1' THEN 1 END) As Perempuan, COUNT(case when caraAmbil='0' THEN 1 END) As Biasa,COUNT(case when caraAmbil >'0' THEN 1 END) As Apheresis,COUNT(case when gol_darah='A' THEN 1 END) As A,
		COUNT(case when gol_darah='B' THEN 1 END) As B,COUNT(case when gol_darah='AB' THEN 1 END) As AB,COUNT(case when gol_darah='O' THEN 1 END) As O,COUNT(case when gol_darah='X' THEN 1 END) As X,
		COUNT(NoTrans) AS Jumlah from htransaksi where CAST(`Tgl` as date)>='$today' and CAST(`Tgl` as date)<='$today1'group by instansi";?>
	<table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
		<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
			<td rowspan="2" align="center">NO</td>
			<td rowspan="2" align="center">TEMPAT DONOR</td>
			<td colspan="4" align="center">JENIS DONOR</td>
			<!--td colspan="2" align="center">JENIS PENDONOR</td-->
			<td colspan="2" align="center">KELAMIN</td>
			<td colspan="4" align="center">PENGAMBILAN</td>
			<td colspan="2" align="center">CARA AMBIL</td>
			<td colspan="5" align="center">GOLONGAN DARAH</td>
			<td rowspan="2" align="center">TOTAL</td>
        </tr>
		<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
			<td align="center">DS</td>
			<td align="center">DP</td>
			<td align="center">BARU</td>
			<td align="center">ULANG</td>
			<td align="center">LK</td>
			<td align="center">PR</td>
			<td align="center">ANTRI</td>
			<td align="center">BERHASIL</td>
			<td align="center">GAGAL</td>
			<td align="center">BATAL</td>
			<td align="center">BIASA</td>
			<td align="center">APHERESIS</td>
			<td align="center">A</td>
			<td align="center">B</td>
			<td align="center">AB</td>
			<td align="center">O</td>
			<td align="center">X</td>
        </tr>
	<?
	$no=0;$tempatdonor="";$sq_sum=mysql_query($sql_trans);$rec=mysql_num_rows($sq_sum);
	while($data=mysql_fetch_assoc($sq_sum)){
		$no++;if ($data[instansi]==""){$tempatdonor='DALAM GEDUNG';}else{$tempatdonor=$data[instansi];}
		$tot_ds=$tot_ds + $data[Sukarela];
		$tot_dp=$tot_dp + $data[Pengganti];
		$tot_baru=$tot_baru + $data[baru];
		$tot_ulang=$tot_ulang + $data[ulang];
		$tot_lk=$tot_lk + $data[Laki];
		$tot_pr=$tot_pr + $data[Perempuan];
		$tot_antri=$tot_antri + $data[Antri];
		$tot_berhasil=$tot_berhasil + $data[Berhasil];
		$tot_gagal=$tot_gagal + $data[Gagal];
		$tot_biasa=$tot_biasa + $data[Biasa];
		$tot_batal=$tot_batal + $data[Batal];
		$tot_aph=$tot_aph + $data[Apheresis];
		$tot_a=$tot_a + $data[A];
		$tot_b=$tot_b + $data[B];
		$tot_ab=$tot_ab + $data[AB];
		$tot_o=$tot_o + $data[O];
		$tot_x=$tot_x + $data[X];
		$tot_ttl=$tot_ttl + $data[Jumlah];
		?>
		<tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no?>.</td>
			<td align="left"><?=$tempatdonor?></td>
			<td align="right" class=input><?=$data[Sukarela]?></td>
			<td align="right" class=input><?=$data[Pengganti]?></td>
			<td align="right" class=input><?=$data[baru]?></td>
			<td align="right" class=input><?=$data[ulang]?></td>
			<td align="right" class=input><?=$data[Laki]?></td>
			<td align="right" class=input><?=$data[Perempuan]?></td>
			<td align="right" class=input><?=$data[Antri]?></td>
			<td align="right" class=input><?=$data[Berhasil]?></td>
			<td align="right" class=input><?=$data[Gagal]?></td>
			<td align="right" class=input><?=$data[Batal]?></td>
			<td align="right" class=input><?=$data[Biasa]?></td>
			<td align="right" class=input><?=$data[Apheresis]?></td>
			<td align="right" class=input><?=$data[A]?></td>
			<td align="right" class=input><?=$data[B]?></td>
			<td align="right" class=input><?=$data[AB]?></td>
			<td align="right" class=input><?=$data[O]?></td>
			<td align="right" class=input><?=$data[X]?></td>
			<td align="right" class=input><?=$data[Jumlah]?></td>
		</tr>
	<?
	}?>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
			<td align="center" colspan=2>TOTAL</td>
			<td align="right" class=input><?=$tot_ds?></td>
			<td align="right" class=input><?=$tot_dp?></td>
			<td align="right" class=input><?=$tot_baru?></td>
			<td align="right" class=input><?=$tot_ulang?></td>			
			<td align="right" class=input><?=$tot_lk?></td>
			<td align="right" class=input><?=$tot_pr?></td>
			<td align="right" class=input><?=$tot_antri?></td>
			<td align="right" class=input><?=$tot_berhasil?></td>
			<td align="right" class=input><?=$tot_gagal?></td>
			<td align="right" class=input><?=$tot_batal?></td>
			<td align="right" class=input><?=$tot_biasa?></td>
			<td align="right" class=input><?=$tot_aph?></td>
			<td align="right" class=input><?=$tot_a?></td>
			<td align="right" class=input><?=$tot_b?></td>
			<td align="right" class=input><?=$tot_ab?></td>
			<td align="right" class=input><?=$tot_o?></td>
			<td align="right" class=input><?=$tot_x?></td>
			<td align="right" class=input><?=$tot_ttl?></td>
		</tr>
	</table>
<br>
</br>

<form name=xls method=post action=modul/rekap_transaksi_harian_summary_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit value='Print Rekap pengambilan darah donor (.XLS)'>
</form>
