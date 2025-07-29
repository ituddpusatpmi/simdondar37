<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_antara.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />

<script type="text/javascript">
  jQuery(document).ready(function(){	
  	$('#kelurahan').autocomplete({source:'modul/suggest_kelurahan.php', minLength:2});});
</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
	$('#kecamatan').autocomplete({source:'modul/suggest_kecamatan.php', minLength:2});});
  </script>


<?
include('config/db_connect.php');
$today=date('Y-m-d');
//$today1=$today;

//if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
//if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[kode]!='') $kode=$_POST[kode];
if ($_POST[nama]!='') $nama=$_POST[nama];
if ($_POST[jk]!='') $jk=$_POST[jk];
if ($_POST[alamat]!='') $alamat=$_POST[alamat];
if ($_POST[hp]!='') $hp=$_POST[hp];
if ($_POST[lhr]!='') $lhr=$_POST[lhr];
if ($_POST[kelurahan]!='') $kelurahan=$_POST[kelurahan];
if ($_POST[kecamatan]!='') $kecamatan=$_POST[kecamatan];
if ($_POST[goldar]!='') $goldar=$_POST[goldar];
if ($_POST[rhesus]!='') $rhesus=$_POST[rhesus];
if ($_POST[cekal]!='') $cekal=$_POST[cekal];


?>
<h1>REKAP DATA PENDONOR</h1>
<form method=post>
<!--TANGGAL DONOR KEMBALI : <input type=text name=minta1 id=datepicker1 size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker2 size=10 value=<?=$today1?>><br-->
KODE <input type=text name=kode id=kode size=25 placeholder="Ketik Kode Donor lengkap" value=<?=$kode?>>
NAMA <input type=text name=nama id=nama size=30 placeholder="Tidak Boleh ada Tanda Petik" value=<?=$nama?>>
JK<select name="jk">
	<option value="">-SEMUA-</option>
	<option value="0">Laki-Laki</option>
	<option value="1">Perempuan</option>
	</select>
ALAMAT <input type=text name=alamat id=alamat size=30 placeholder="Tidak Boleh ada Tanda Petik" value=<?=$alamat?>>
No.HP <input type=text name=hp id=hp size=14 placeholder="081..." value=<?=$hp?>>
</br>

<br>
TGL LAHIR <input type=text name=lhr id="datepicker" placeholder="yyyy-mm-dd" size=11 value=<?=$lhr?>>
KELURAHAN <input type=text name=kelurahan id=kelurahan size=20 placeholder="Ketik Nama Kelurahan" value=<?=$kelurahan?>>
KECAMATAN <input type=text name=kecamatan id=kecamatan size=20 placeholder="Ketik Nama Kecamatan" value=<?=$kecamatan?>>



		

	GOL DARAH<select name="goldar">
	<option value="">-SEMUA-</option>
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="O">O</option>
	<option value="AB">AB</option>
	<option value="X">X</option>
	</select>

	RHESUS<select name="rh">
	<option value="">-SEMUA-</option>
	<option value="+">Positip</option>
	<option value="-">Negatip</option>
	</select>
	
	STATUS<select name="cekal">
	<option value="">-SEMUA-</option>
	<option value="0">OK</option>
	<option value="1">Confirm</option>
	</select> 
</br>
<br>
<input type="submit" name="submit" value="Lihat" class="swn_button_blue">
</form>
<?
if (isset($_POST[submit])){ 

//$transaksipermintaan=mysql_query("select * from pendonor where CAST(tglkembali as date)>='$today' and CAST(tglkembali as date)<='$today1' and Kode like '%$kode%' and Nama like '%$nama%' and Jk like '%$jk%' and Alamat like '%$alamat%' and telp2 like '%$hp%' and TglLhr like '%$lhr%' and kelurahan like '$kelurahan%' and kecamatan like '$kecamatan%' and GolDarah like '$goldar%' and Rhesus like '%$rh%' and Cekal like '%$cekal%' order by GolDarah ASC  ");

$transaksipermintaan=mysql_query("select * from pendonor where Kode like '%$kode%' and Nama like '%$nama%' and Jk like '%$jk%' and Alamat like '%$alamat%' and telp2 like '%$hp%' and TglLhr like '%$lhr%' and kelurahan like '$kelurahan%' and kecamatan like '$kecamatan%' and GolDarah like '$goldar%' and Rhesus like '%$rh%' and Cekal like '%$cekal%' order by GolDarah ASC  ");

}

$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Total Data Yang tereksport ";
echo"<b>";
echo $countp;
echo"</b>";
echo " Data";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">Kode</td>
	
	<td rowspan='2' align="center">Nama</td>
	<td rowspan='2' align="center">Alamat</td>
	<td rowspan='2' align="center">JK</td>
	
	<td colspan='2' align="center">Darah</td>
	<td rowspan='2' align="cemter">Donasi</td>
        <td rowspan='2' align="center">Handphone</td>
	<td rowspan='2' align="center">Kelurahan</td>
	<td rowspan='2' align="center">Kecamatan</td>
	<td rowspan='2' align="center">Tgl Kembali</td>  
	<td colspan='2' align="center">Status</td>      
	</tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">Gol</td>
	<td align="center">Rh</td>
	<td align="center">IMLTD</td>
	<td align="center">DONOR</td>
	
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="left"><?=$datatransaksipermintaan['Kode']?></td>
	<td align="left"><?=$datatransaksipermintaan['Nama']?></td>
	<td align="left"><?=$datatransaksipermintaan['Alamat']?></td>
			<?
			if ($datatransaksipermintaan[Jk]=='0') $kelamin='Laki-Laki';
			if ($datatransaksipermintaan[Jk]=='1') $kelamin='Perempuan';
			?>
	
	<td align="left"><?=$kelamin?></td>
	<td align="center"><?=$datatransaksipermintaan['GolDarah']?></td>
	<td align="center"><?=$datatransaksipermintaan['Rhesus']?></td>
	<td align="center"><?=$datatransaksipermintaan['jumDonor']?>x</td>
	<td align="left"><?=$datatransaksipermintaan['telp2']?></td>
	<td align="left"><?=$datatransaksipermintaan['kelurahan']?></td>
	<td align="left"><?=$datatransaksipermintaan['kecamatan']?></td>

			<?
			if ($datatransaksipermintaan[Cekal]=='0') $status='-';
			if ($datatransaksipermintaan[Cekal]=='1') $status='Confirm';
			 ?>
	
	<td class=input align=center><?=$datatransaksipermintaan['tglkembali']?></td>
	<td class=input align=center><?=$status?></td>
			<?
			if ($datatransaksipermintaan[tglkembali] <= $today) $donor='Tiba Saat Donor';
			if ($datatransaksipermintaan[tglkembali] > $today) $donor='Belum Saat Donor';
			if ($datatransaksipermintaan[Cekal] == '1')  $donor='Tidak Boleh Donor' ;
			?>
	
	<td class=input align=left><?=$donor?></td>
</tr>
<? $no++;} ?>
</table>
<br>
<form name=xls method=post action=modul/rekap_pendonor_xls.php>



<input type=hidden name=kode value='<?=$kode?>'>
<input type=hidden name=nama value='<?=$nama?>'>
<input type=hidden name=jk value='<?=$jk?>'>
<input type=hidden name=alamat value='<?=$alamat?>'>
<input type=hidden name=hp value='<?=$hp?>'>
<input type=hidden name=lhr value='<?=$lhr?>'>
<input type=hidden name=kelurahan value='<?=$kelurahan?>'>
<input type=hidden name=kecamatan value='<?=$kecamatan?>'>
<input type=hidden name=goldar value='<?=$goldar?>'>
<input type=hidden name=rhesus value='<?=$rhesus?>'>
<input type=hidden name=cekal value='<?=$cekal?>'>
<input type=submit name=submit2 value='Eksport Rekap Data Terpilih ke (.XLS)'>
</form>

<?
mysql_close();
?>
