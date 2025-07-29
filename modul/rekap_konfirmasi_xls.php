<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_rekap_konfirmasi_goldar.xls");
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
<h5 colspan='9' class="table">Rekap Konfirmasi Golongan Darah Dari Tanggal :   <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?>
<br></h5>
<?
$a=mysql_query("select * from dkonfirmasi where  CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' order by NoKonfirmasi ASC");
$jumcocok   =mysql_fetch_assoc(mysql_query("select count(NoKonfirmasi) as cocok    from dkonfirmasi where Cocok='0'  and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' "));
$jumtdkcocok=mysql_fetch_assoc(mysql_query("select count(NoKonfirmasi) as tdkcocok from dkonfirmasi where Cocok='1'  and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' "));
	$TRec=mysql_num_rows($a);
?>
<h4>Total Konfirmasi Gol Darah = <?=$TRec?> Kantong darah </h4>
<h4>Hasil Cocok = <?=$jumcocok[cocok]?> Kantong darah </h4>
<h4>Hasil Tidak Cocok = <?=$jumtdkcocok[tdkcocok]?> Kantong darah </h4>
<table border=1 cellpadding=0 cellspacing=0 >
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='3'>No</td>
	<td rowspan='3'>Tanggal</td>
	<td rowspan='3'>No Konfirmasi</td>
	<td rowspan='3'>No Kantong</td>
        <td rowspan='3'>Gol(Rh) Darah Asal</td>
        <td rowspan='3'>Gol(Rh) Darah Baru</td>
        <td rowspan='3'>Hasil<br>Konfirmasi</td>
	<td rowspan='3'>Antibody<br>Screening</td>
	<td rowspan='3'>Metode</td>
	<td colspan='3'>Anti A</td>
	<td colspan='3'>Anti B</td>
	<td colspan='3'>Anti D</td>
	<td rowspan='3'>TS-A</td>
	<td rowspan='3'>TS-B</td>
	<td rowspan='3'>TS-O</td>	
	<td rowspan='3'>AC</td>
	<td rowspan='3'>BA 6%</td>
	<td rowspan='3'>Petugas</td>
	</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>
	<!--td>YA/Tdk</td-->
	
	<!--td>Anti AB</td>

	<td>YA/Tdk</td--->
	<td rowspan='2'>Nilai</td>
	<td rowspan='2'>Nolot</td>
	<td rowspan='2'>Epx.</td>

	<td rowspan='2'>Nilai</td>
	<td rowspan='2'>Nolot</td>
	<td rowspan='2'>Epx.</td>

	<td rowspan='2'>Nilai</td>
	<td rowspan='2'>Nolot</td>
	<td rowspan='2'>Epx.</td>

	
	</tr>

</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>
	
	</tr>
</tr>
<?
$no=1;


while($a_dtransaksipermintaan=mysql_fetch_assoc($a)){
	
?>

	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
<? 
$cocok1='-';
if ($a_dtransaksipermintaan[Cocok]=='0') $cocok1='Cocok';
if ($a_dtransaksipermintaan[Cocok]=='1') $cocok1='Tidak Cocok';
$kodependonor1=mysql_query("select KodePendonor from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]'");
$kodependonor=mysql_fetch_assoc($kodependonor1);
$namadonor=mysql_query("select Nama from pendonor where Kode='$kodependonor[KodePendonor]'");
$namadonor1=mysql_fetch_assoc($namadonor);
if($a_dtransaksipermintaan[sel]=='0') $sel='Ya';
if($a_dtransaksipermintaan[sel]=='1') $sel='Tidak';
if($a_dtransaksipermintaan[serum]=='0') $serum='Ya';
if($a_dtransaksipermintaan[serum]=='1') $serum='Tidak';
if($a_dtransaksipermintaan[ac]=='0') $ac='Pos';
if($a_dtransaksipermintaan[ac]=='1') $ac='Neg';
if($a_dtransaksipermintaan[ba]=='0') $ba='Pos';
if($a_dtransaksipermintaan[ba]=='1') $ba='Neg';

$pengolahan=$a_dtransaksipermintaan[tgl];
$tglkel=date("d",strtotime($pengolahan));
$blnkel=date("n",strtotime($pengolahan));
$thnkel=date("Y",strtotime($pengolahan));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($pengolahan));
?>
<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>


<!--?
$blnkel=substr($a_dtransaksipermintaan[tglpengolahan],5,2);
$tglkel=substr($a_dtransaksipermintaan[tglpengolahan],8,2);
$thnkel=substr($a_dtransaksipermintaan[tglpengolahan],0,4);
?>
      	<td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td-->
	<td class=input><?=$a_dtransaksipermintaan[NoKonfirmasi]?></td>
	<td class=input><?=$a_dtransaksipermintaan[NoKantong]?></td>
	<td class=input><?=$a_dtransaksipermintaan[goldarah_asal]?> (<?=$a_dtransaksipermintaan[rhesus_asal]?>)</td>
	<td class=input><?=$a_dtransaksipermintaan[GolDarah]?> (<?=$a_dtransaksipermintaan[Rhesus]?>)</td>

	<td class=input><?=$cocok1?></td>
	<?
		$abs = mysql_fetch_assoc(mysql_query("SELECT abs from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]'"));
		$absfix='Negatif';
			if ($abs[abs]=='negative') $absfix='Negatif';
			if ($abs[abs]=='negatif') $absfix='Negatif';
			if ($abs[abs]=='positive') $absfix='Positif';
			if ($abs[abs]=='positif') $absfix='Positif';
	if ($absfix=="Positif") {
	   echo '<td nowrap class=input style="color:red;font-weight:bold;">'.$absfix.'</td>';
	} else {
	   echo"<td class=input>".$absfix."</td>";	
	}
	?>
       	<td class=input><?=$a_dtransaksipermintaan[metode]?></td>
	<!--td class=input><?=$sel?></td-->
      	<td class=input><?=$a_dtransaksipermintaan[antiA]?></td>
	<td class=input><?=$a_dtransaksipermintaan[nolot_aa]?></td>
	<td class=input><?=$a_dtransaksipermintaan[expa]?></td>
	<td class=input><?=$a_dtransaksipermintaan[antiB]?></td>
	<td class=input><?=$a_dtransaksipermintaan[nolot_ab]?></td>
	<td class=input><?=$a_dtransaksipermintaan[expb]?></td>
	<td class=input><?=$a_dtransaksipermintaan[antiD]?></td>
	<td class=input><?=$a_dtransaksipermintaan[nolot_ad]?></td>
	<td class=input><?=$a_dtransaksipermintaan[expd]?></td>
	<td class=input><?=$a_dtransaksipermintaan[tA]?></td>
	<td class=input><?=$a_dtransaksipermintaan[tB]?></td>
	<td class=input><?=$a_dtransaksipermintaan[tsO]?></td>
	
	<!--td class=input><?=$a_dtransaksipermintaan[antiO]?></td>
	<td class=input><?=$serum?></td-->
      	
	<td class=input><?=$ac?></td>
	<td class=input><?=$ba?></td>
	<td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
	<!--td class=input><?=$kodependonor[KodePendonor]?></td>
	<td class=input><?=$namadonor1[Nama]?></td-->
	</tr>
<?
}
?>



</table>

<?
mysql_close();
?>
