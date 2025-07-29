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

<body OnLoad="document.mintadarah1.minta1.focus();">
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[submit])) {$nkt=$_POST[minta1];
	$no_kantong0=substr($nkt,0,-1);
	$komponen0=mysql_query("select * from stokkantong where nokantong like '$no_kantong0%' order by noKantong ASC");	
}
?>

<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
<h1 class="table"><font size="4">CEK KANTONG</font></h1>
<div>
	<form name=mintadarah1 method=post><font size="3"> Masukkan Nomor Kantong</font>
		<INPUT type="text"  name="minta1"  size='23' placeholder="Nokantong Bebas" >
		<input type=submit name=submit value=Submit>
	</form>
</div>

<br><font size="4">DATA KANTONG</font>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan='2'>No</td>
        <th rowspan=2>No Kantong</th>
	<th rowspan=2>Asal</th>
	<th rowspan=2>Merk</th>
	<th rowspan=2'>Jenis</th>
	<th rowspan=2>Produk</th>	
	<th rowspan=2>Vol/CC</th>
	<th rowspan=2>Darah</th>
	<th colspan=2>Status</th>
	<th colspan=6>Tanggal</th>
	<th rowspan=2>Pengesahan</th>	
	<th rowspan=2>Konfir. gol</th>
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th> </th>
	<th> </th>
	<th>Aftap</th>
	<th>IMLTD</th>
	<th>Diolah</th>
	<th>Exp</th>
	<th>Keluar</th>
	<th>Musnah</th>
      </tr>

<?
$no=1;
while ($komponen=mysql_fetch_assoc($komponen0)) {
?>
<tr class="record">
	<td><?=$no++?></td>
        <td class=input><?=$komponen[noKantong]?></td>
<?
$asalutd=mysql_fetch_assoc(mysql_query("select nama from utd where id='$komponen[AsalUTD]'"));
$utdintern=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'"));
$bawa=mysql_fetch_assoc(mysql_query("select Status from dtransaksipermintaan where nokantong='$komponen[noKantong]'"));
$utd=$asalutd[nama];
if ($komponen[AsalUTD]==NULL) $utd=$utdintern[nama];
?>
	<td class=input><?=$utd?></td>
	<td class=input><?=$komponen[merk]?></td>
<?
switch ($komponen[Status]) {
	case 0 :
		$ckt_status="Kosong";
		if ($komponen[StatTempat]==NULL) $ckt_status="Kosong Di Logistik";		
		if ($komponen[StatTempat]=='0') $ckt_status="Kosong Di Logistik";
		if ($komponen[StatTempat]=='1') $ckt_status="Kosong Di Aftap";
		break;
	case 1:
		$ckt_status="Aftap";
		if ($komponen[sah]=='1') $ckt_status="Baru Isi/Karantina";
		break;
	case 2:
		$ckt_status="Sehat";
		if (substr($komponen[stat2],0,1)=='b') $tempat=" (BDRS)";
		break;
	case 3:
		$ckt_status="Keluar_Bawa";
		if ($bawa[Status]=='1') $ckt_status="Keluar_Titip";
		break;
	case 4:
		$ckt_status="Rusak";
		break;
	case 5:
		$ckt_status="Rusak-Gagal";
		break;
	case 6:
		$ckt_status="Dimusnahkan";
		break;
}

switch($komponen[jenis]) {
case '1':
	$jenis='Single';
	break;
case '2':
	$jenis='Double';
	break;
case '3':
	$jenis='Triple';
	break;
case '4':
	$jenis='Quadruple';
	break;
case '6':
	$jenis='Pediatrik';
	break;
default:
	$jenis='';
}
?>
	
	<td class=input><?=$jenis?></td>
	<td class=input><?=$komponen[produk]?></td>
	<td class=input align="right"><?=$komponen[volume]?></td>
	<td class=input><?=$komponen[gol_darah]?>(<?=$komponen[RhesusDrh]?>)</td>
	<td class=input><?=$ckt_status?></td>
<?
	$bdrs=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$komponen[stat2]'"));
	$tujuan=mysql_fetch_assoc(mysql_query("select nama from utd where id='$komponen[stat2]'"));
	$tujuan1=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$komponen[stat2]'"));
	$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$ttp1[rs]'"));
	if ($komponen[stat2]==NULL and $komponen[Status]==3) $rs="RS";
	if ($komponen[stat2]==NULL and $komponen[Status]!=3) $rs="";
	$buang=mysql_fetch_assoc(mysql_query("select * from ar_stokkantong where noKantong='$komponen[noKantong]'"));
?>
	<td class=input><?=$tujuan1[nama]?><?=$tujuan[nama]?><?=$rs?></td>
	<td class=input><?=$komponen[tgl_Aftap]?></td>
	<td class=input><?=$komponen[tglperiksa]?></td>
	<td class=input><?=$komponen[tglpengolahan]?></td>
	<td class=input><?=$komponen[kadaluwarsa]?></td>
	<td class=input><?=$komponen[tgl_keluar]?></td>
	<td class=input><?=$buang[tgl_buang]?></td>
<?
$sah='Belum';
if ($komponen[sah]=='1') $sah='Sudah';
$konfirm='Belum';
if ($komponen[statKonfirmasi]=='1') $konfirm='Sudah';

?>
	<td class=input><?=$sah?></td>
	<td class=input><?=$konfirm?></td>
	</tr>

<?
}

?>
</table>
<?
mysql_close();
?>
