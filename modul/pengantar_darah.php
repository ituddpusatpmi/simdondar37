<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];

//buat table pengantar
$col5=mysql_query("SELECT `nomer` FROM `pengantar`");if(!$col5){mysql_query("create table pengantar  (
  `nomer` varchar(30) NOT NULL DEFAULT '',
  `NoForm` varchar(15) DEFAULT NULL,
  `Tgl` date DEFAULT NULL,
  `petugas` varchar(15) DEFAULT NULL,
  `no_rm` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nomer`))ENGINE=MyISAM DEFAULT CHARSET=latin1;");}



?>


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
$q=$_POST[minta1];
if (isset($_POST[submit])) {$nkt=$_POST[minta1];
$no_kantong0=substr($nkt,0,-1);
  $komponen0=mysql_query("select * from dtransaksipermintaan where NoForm = '$nkt'  and Status='0' and antar='0' order by NoForm ASC");	
//  $distribusi0=mysql_query("select * from dtransaksipermintaan where NoKantong like '$no_kantong0%' order by NoKantong ASC");
 // $donasi0=mysql_query("select * from htransaksi where nokantong ='$nkt'");	

	
}


?>



<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
<h1 style=color:#24006B >Form Pengantar Darah</h1>
<div>
<form name=mintadarah1 method=post style=color:#24006B> Masukkan Nomor Formulir-->
<INPUT type="text"  name="minta1"  size='10' placeholder="No Form" >
<input type=submit name=submit value=Submit>

</form></div>
<!--?
$a=mysql_query("select noKantong,Status,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar,tglpengolahan from stokkantong where  CAST(tglpengolahan as date)>='$today' and CAST(tglpengolahan as date)<='$today1' and Status != 0 and produk !='WB' order by tglpengolahan ASC");
	$TRec=mysql_num_rows($a);
?-->
<h4 style=color:#24006B >DATA FORMULIR </h4>

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#24006B; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center"   >
	<td rowspan='2'>No</td>
	<th rowspan=2>No Form</th>
	<th colspan=3'>Darah</th>
	<th colspan=4>Pasien</th>	
	<th rowspan='2'>No Kwitansi</th>
       
	</tr>
      <tr tr style="background-color:#24006B; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center"  >
	<th>No Kantong</th>
	<th>Gol (rh)</th>
	<th>produk</th>
	<th>No RM</th>
	<th>Nama</th>
	<th>Gol (rh)</th>
	<th>RS</th>
	
      </tr>

<?


//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($komponen=mysql_fetch_assoc($komponen0)) {

?>
<tr tr style="background-color:#AA80FE; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
      



	<td><?=$no++?></td>
	<td ><?=$komponen[NoForm]?></td>
        <td ><?=$komponen[NoKantong]?></td>
	<td ><?=$komponen[gol_darah]?>(<?=$komponen[rh_darah]?>)</td>
	<td ><?=$komponen[produk_darah]?></td>
	<?
	$pasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$komponen[no_rm]' "));
	$rs=mysql_fetch_assoc(mysql_query("select * from rmhsakit where Kode='$komponen[rs]' "));
	$kwitansi=mysql_fetch_assoc(mysql_query("select * from kwitansi where NoForm='$komponen[NoForm]' "));
		?>
	<td ><?=$komponen[no_rm]?></td>
	<td ><?=$pasien[nama]?></td>
	<td ><?=$pasien[gol_darah]?>(<?=$pasien[rhesus]?>)</td>
	<td ><?=$rs[NamaRs]?></td>
	<td ><?=$kwitansi[nomer]?></td>	
	</tr>


<?
}

?>
</table>

<tr>
<td>
<form name="kirim" method="post" action="modul/form_pengantar_darah.php" target="_blank">
<input name="noform" type="hidden" value="<?=$q?>">
<input name="notrans" type="hidden" value="<?=$id_transaksi_baru?>">
<input name="instansi" type="hidden" value="<?=$instansi[nama]?>">
<input name="kendaraan" type="hidden" value="<?=$kendaraan[kendaraan]?>">
<input name="submit" type="submit" value="Cetak Pengantar Darah">
</form></td>
</tr>

<!--br>
<form name=xls method=post action=modul/rekap_pembuatan_komponen_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Komponen (.XLS)'>
</form>
-->
<?
mysql_close();
?>
