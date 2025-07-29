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
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$id=$_POST[transaksi];
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

?>



<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
<h1 class="table">Rekap Serah terima sampel darah dari tanggal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10 value="<?=$today?>">
Sampai :
<input type=text name=minta2 id=datepicker1 size=10 value="<?=$today1?>">
Transaksi :
<select name='transaksi'>
	<option value="" selected="selected">SEMUA</option>
	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
	<option value="4" >4</option>
	<option value="5" >5</option>
	<option value="6" >6</option>
	<option value="7" >7</option>
	<option value="8" >8</option>
	<option value="9" >9</option>
	<option value="10" >10</option>
	<option value="11" >11</option>
	<option value="12" >12</option>
	<option value="13" >13</option>
	<option value="14" >14</option>
	<option value="15" >15</option>
	<option value="16" >16</option>
	<option value="17" >17</option>
	<option value="18" >18</option>
	<option value="19" >19</option>
	<option value="20" >20</option>
	<option value="21" >21</option>
	<option value="22" >22</option>
	<option value="23" >23</option>
	<option value="24" >24</option>
	<option value="25" >25</option>
</select>
<input type=submit name=submit value=Submit>

</form></div>
<?
$a=mysql_query("select nokantong,tgl,shift,jns,ket,ygmenyerahkan,ygmengesahkan,penerimaktg from pengesahan where  CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and up='1' and trans like '%$id%' order by tgl ASC");
	$TRec=mysql_num_rows($a);
?>
<h4>Jumlah sampel dan kantong darah yang diserahkan dari aftap = <?=$TRec?> Kantong </h4>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>Tanggal</td>
	<td>No Kantong</td>
	<td>Jenis</td>
        <td>Gol & Rh<br>Darah</td>
        <td>Tgl aftap</td>
	<td>Status <br>Pengambilan</td>
        <td>Shift</td>
	<td>Asal</td>
	<td>Instansi</td>
	<td>Yang <br>Menyerahkan</td>
	<td>Penerima <br>Sampel Darah</td>
	<td>Penerima <br>Kantong Darah</td>
	
	</tr>

</tr>
<?
$no=1;


while($a_dtransaksipermintaan=mysql_fetch_assoc($a)){
	
?>

	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
 
<?
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
	<td class=input><?=$a_dtransaksipermintaan[nokantong]?></td>
<?
$jenis=$a_dtransaksipermintaan[jns];
switch ($jenis)
{
case 1:
	$jenis='Single';
	break;
case 2:
	$jenis='Double';
	break;
case 3:
	$jenis='Triple';
	break;
case 4:
	$jenis='Quadruple';
	break;
case 6:
	$jenis='Pediatrik';
	break;
	
}
?>
	<td class=input><?=$jenis?></td>
<?
$a_dtransaksipermintaan1=mysql_fetch_assoc(mysql_query("select gol_darah,RhesusDrh,tgl_Aftap from stokkantong where noKantong='$a_dtransaksipermintaan[nokantong]'"));
?>
	<td class=input><?=$a_dtransaksipermintaan1[gol_darah]?> (<?=$a_dtransaksipermintaan1[RhesusDrh]?>)</td>
       	<td class=input><?=$a_dtransaksipermintaan1[tgl_Aftap]?></td>
<?
$a_dtransaksipermintaan2=mysql_fetch_assoc(mysql_query("select Pengambilan,tempat,instansi from htransaksi where noKantong='$a_dtransaksipermintaan[nokantong]'"));
?>
<?
if ($a_dtransaksipermintaan[ket]=='0') $peng='Berhasil';
if ($a_dtransaksipermintaan[ket]=='2') $peng='Gagal';
if ($a_dtransaksipermintaan[ket]=='1') $peng='Batal';
$peng1='Dalam Gedung';
if ($a_dtransaksipermintaan2[tempat] == 'M') $peng1='Mobil Unit';
?>
<?
$instansi=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where KodeDetail='$a_dtransaksipermintaan2[instansi]'"));
?>
      	<td class=input><?=$peng?></td>
      	<td class=input><?=$a_dtransaksipermintaan[shift]?></td>
	<td class=input><?=$peng1?></td>
	<td class=input><?=$a_dtransaksipermintaan2[instansi]?></td>	
	<td class=input><?=$a_dtransaksipermintaan[ygmenyerahkan]?></td>
	<td class=input><?=$a_dtransaksipermintaan[ygmengesahkan]?></td>
	<td class=input><?=$a_dtransaksipermintaan[penerimaktg]?></td>
	

	</tr>
<?
}
?>



</table>
<br>
<form name=xls method=post action=modul/rekap_pengesahan_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=id1 value='<?=$id?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Serah Terima sampel dan kantong darah (.XLS)'>
</form>

<?
mysql_close();
?>
