<?
//$tgl=date("Y-m-d");
include '../config/db_connect.php';
$perbln=$_POST[perbln];
$pertgl=$_POST[pertgl];
$perthn=$_POST[perthn];
$perbln1=$_POST[perbln1];
$pertgl1=$_POST[pertgl1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$perthn1."-".$perbln1."-".$pertgl1;
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_pengambilan_donor_$today.xls");
header("Pragma: no-cache");
header("Expires: 0");

//$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));

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
			<td><input type=text name=terima1 id=datepicker size=10 value=<?=$today?>></td>
			<td><input type=text name=terima2 id=datepicker1 size=10 value=<?=$today1?>></td>
			<td><input type=submit name=submit value=Tampilkan class="swn_button_blue">
			<!--td><a href="pmi<?=$level_user?>.php?module=rekap_transaksi" class='swn_button_blue'>Rekap Transaksi Donor</a>
			</td-->
		</tr>
	</table>
	</form>
</div>

<?
$sql_intsansidonor="select Instansi from htransaksi where CAST(`Tgl` as date)>='$today' and CAST(`Tgl` as date)<='$today1' group by Instansi";
$sql_trans="select instansi, COUNT(case when JenisDonor='0' THEN 1 END) As Sukarela, COUNT(case when JenisDonor='1' THEN 1 END) As Pengganti, COUNT(case when donorbaru='0' THEN 1 END) As baru, COUNT(case when donorbaru='1' THEN 1 END) As ulang, COUNT(case when Pengambilan='-' THEN 1 END) As Antri,COUNT(case when Pengambilan='0' THEN 1 END) As Berhasil,COUNT(case when Pengambilan='1' THEN 1 END) As Batal,
		COUNT(case when Pengambilan='' THEN 1 END) As Gagal,COUNT(case when jk='0' THEN 1 END) As Laki,COUNT(case when jk='1' THEN 1 END) As Perempuan, COUNT(case when caraAmbil='0' THEN 1 END) As Biasa,COUNT(case when caraAmbil >'0' THEN 1 END) As Apheresis,COUNT(case when gol_darah='A' THEN 1 END) As A,
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
		<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
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
