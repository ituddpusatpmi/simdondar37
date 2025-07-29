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

<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('minta1').focus();});
  </script>

<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;

if (isset($_POST[submit])) {$nkt=$_POST[minta1];
	$box=$_POST['sah'];
 $no_kantong0=substr($nkt,0,-1);
  $komponen0=mysql_query("select * from stokkantong where nokantong like '$no_kantong0%' order by noKantong ASC");	
  $distribusi0=mysql_query("select * from dtransaksipermintaan where NoKantong like '$no_kantong0%' order by NoKantong ASC");
  $donasi0=mysql_query("select * from htransaksi where nokantong ='$nkt'");	

	if (isset($_POST['Button'])) {
	$box=$_POST['sah'];
	$nk=$_POST['nkantong'];
	$pengirim=$_POST['sah0'];
	$penerima=$_POST['sah1'];
	$penerima2=$_POST['sah2'];
	//$shift=$_POST['shift'];
	$jns=$_POST['jenis'];
	for ($i=0;$i<count($box);$i++) {
	if ($box[$i]!='0') {
		
		$sahkan=mysql_query("update pengesahan set ygmenyerahkan='$pengirim',ygmengesahkan='$penerima',up='1',penerimaktg='$penerima2' where nokantong='$box[$i]'");
		}
		}
	if ($sahkan) echo "<META http-equiv='refresh' content='10; url=$PHPSELF'>";
}

}
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
<h1 class="table">Form Cek Kantong</h1>
<div>
<form name=mintadarah1 method=post> Masukkan Nomor Kantong-->
<INPUT type="text"  name="minta1"  size='23' placeholder="Nokantong Bebas" >
<input type=submit name=submit value=Submit>

</form></div>
<!--?
$a=mysql_query("select noKantong,Status,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar,tglpengolahan from stokkantong where  CAST(tglpengolahan as date)>='$today' and CAST(tglpengolahan as date)<='$today1' and Status != 0 and produk !='WB' order by tglpengolahan ASC");
	$TRec=mysql_num_rows($a);
?-->
<h4>DATA KANTONG </h4>

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
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
	<th rowspan=2>Cek</th>
	
	
	
	
       
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


//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

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
	case 0 and $komponen[StatTempat]==NULL:
		$ckt_status="Kosong Di logistik";
		break;
	case 0 and $komponen[StatTempat]=='0':
		$ckt_status="Kosong Di Aftap";
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
	//if ($komponen[stat2]==NULL and $komponen[Status]==3) $ckt_tujuan="Rumah Sakit"; 
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

	<td>
			<input type=checkbox name=sah[] value="<?=$baris[nokantong]?>" checked>Lolos
			
	</td>
	</tr>

<?
}

?>
</table>

<h4>DATA DONASI </h4>

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan='2'>No</td>
        <th rowspan=2>No Kantong</th>
	<th colspan=10>Pendonor</th>
	<th colspan=5>Aftap</th>
	<th colspan=5>Petugas</th>
	
	
	
	
       
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th>ID</th>
	<th>Nama</th>
	<th>JK</th>
	<th>Umur</th>	
	<th>Gol</th>
	<th>Donor</th>
	<th>BB</th>
	<th>Tensi</th>
	<th>HB</th>
	<th>Ket</th>

	<th>Tgl</th>
	<th>Jenis</th>	
	<th>Asal</th>
	<th>Instansi</th>
	<th>Status</th>

	<th>Dokter</th>
	<th>Tensi</th>
	<th>HB</th>
	<th>Aftap</th>
	<th>Input</th>
      </tr>

<?


//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($donasi=mysql_fetch_assoc($donasi0)) {

?>
<tr class="record">
      



	<td><?=$no++?></td>
        <td class=input><?=$donasi[NoKantong]?></td>
	<td class=input><?=$donasi[KodePendonor]?></td>
<?
$pendonor=mysql_fetch_assoc(mysql_query("select Nama from pendonor where Kode='$donasi[KodePendonor]'"));
?>
	<td class=input><?=$pendonor[Nama]?></td>
<?
if ($donasi[jk]=='0') $jk='Laki-laki';
if ($donasi[jk]=='1') $jk='Perempuan';
if ($donasi[jumHB]=='1') $hb='tenggelam';
if ($donasi[jumHB]=='2') $hb='Melayang';
if ($donasi[jumHB]=='3') $hb='Mengapung';
if ($donasi[donorbaru]=='0') $baru='Baru';
if ($donasi[donorbaru]=='1') $baru='Ulang';
?>
	<td class=input><?=$jk?></td>
	<td class=input><?=$donasi[umur]?>th</td>
	<td class=input><?=$donasi[gol_darah]?>(<?=$donasi[rhesus]?>)</td>
	<td class=input><?=$donasi[donorke]?> kali</td>
	<td class=input><?=$donasi[beratBadan]?></td>
	<td class=input><?=$donasi[tensi]?></td>
	<td class=input><?=$donasi[Hb]?>_<?=$hb?></td>
	<td class=input><?=$baru?></td>

	<td class=input><?=$donasi[Tgl]?></td>
<?
if ($donasi[JenisDonor]=='0') $ds='DS';
if ($donasi[JenisDonor]=='1') $ds='DP';
if ($donasi[JenisDonor]=='2') $ds='Autologus';
if ($donasi[tempat]=='M') $tempat1='MU';
if ($donasi[tempat]!='M') $tempat1='DG';
?>
	<td class=input><?=$ds?></td>
	<td class=input><?=$tempat1?></td>
	<td class=input><?=$donasi[Instansi]?></td>
<?
if ($donasi[Pengambilan]=='0') $status='Berhasil';
if ($donasi[Pengambilan]=='2') $status='Gagal/Mislek';
?>
	<td class=input><?=$status?></td>
<?
$dokter=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='$donasi[NamaDokter]'"));
?>
	<td class=input><?=$dokter[Nama]?></td>
	<td class=input><?=$donasi[petugasHB]?></td>
	<td class=input><?=$donasi[petugasTensi]?></td>
	<td class=input><?=$donasi[petugas]?></td>
	<td class=input><?=$donasi[user]?></td>
	</tr>

<?
}

?>
</table>


<h4>DATA DISTRIBUSI RMH SAKIT </h4>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan='2'>No</td>
        <th rowspan=2>No Kantong</th>
	<th rowspan=2>No Form</th>
	<th colspan=2>Rumah Sakit</th>
	<th colspan=7>Pasien</th>	
	

	
	
	
       
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th>Nama RS</th>
	<th>No RM</th>
	<th>ID</th>
	<th>Nama</th>
	<th>Gol(rh)</th>
	<th>Kelamin</th>
	<th>Umur</th>
	<th>Layanan</th>
	<th>Status</th>
      </tr>

<?


//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($distribusi=mysql_fetch_assoc($distribusi0)) {

?>
<tr class="record">
      



	<td><?=$no++?></td>
	  <td class=input><?=$distribusi[NoKantong]?></td>
	<td class=input><?=$distribusi[NoForm]?></td>
<?
$data1=mysql_fetch_assoc(mysql_query("select * from htranspermintaan where noform='$distribusi[NoForm]'"));
$pasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm ='$distribusi[no_rm]'"));
$nmrs=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$data1[rs]'"));
$layanan=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$data1[jenis]'"));	
?>
      
	<td class=input><?=$nmrs[NamaRs]?></td>
	<td class=input><?=$data1[regrs]?></td>
	<td class=input><?=$pasien[no_rm]?></td>
	<td class=input><?=$pasien[nama]?></td>
	<td class=input align="center"><?=$pasien[gol_darah]?>(<?=$pasien[rhesus]?>)</td>
<?
if ($pasien[kelamin]=='L') $kelamin='Laki-laki';
if ($pasien[kelamin]=='P') $kelamin='Perempuan';

if ($distribusi[Status]=='0') $stat='DiBawa';
if ($distribusi[Status]=='1') $stat='Titip';
if ($distribusi[Status]=='B') $stat='Batal';
?>
	<td class=input><?=$kelamin?></td>
	<td class=input><?=$data1[umur]?></td>
	<td class=input><?=$layanan[nama]?></td>
	<td class=input><?=$stat?></td>
	

	</tr>

<?
}

?>
</table>



<?
mysql_close();
?>
