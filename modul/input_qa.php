<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];

//hapus table htranspermintaan lama
$qa=mysql_query("SELECT `notrans` FROM `qa`");if(!$qa){
//buat tabel htranspermintaan baru
mysql_query("CREATE TABLE qa (
  `notrans` varchar(17) NOT NULL DEFAULT '',
  `nokantong` varchar(15) DEFAULT NULL,
  `petugas` varchar(30) DEFAULT NULL,
  `pengesah` varchar(30) DEFAULT NULL,
  `hasil` int(1 ) NOT NULL DEFAULT '0',
  `ket` varchar(30) DEFAULT '-',
  `alasan` varchar(25) DEFAULT NULL,
  `hb` varchar(3) DEFAULT NULL, PRIMARY KEY (`notrans`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;" );}

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



<style type="text/css" title="currentStyle">
			@import "css/dt_page.css";
			@import "css/dt_table.css";
			@import "css/dt_table_jui.css";
		</style>
		<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
		<link type="text/css" href="css/TableTools_JUI.css" rel="stylesheet" />
		<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>



<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('minta1').focus();});
  </script>

<script>
			function disabletext(val){ // masih belum berfungsi
				if(val=='0'){
					document.getElementById('comments').hidden = true;
					
}
				else {
					document.getElementById('comments').hidden = false;
					
}
			}
			</script>




<body OnLoad="document.mintadarah1.minta1.focus();">
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today2=date('Y-m-d H:i:s');
$today1=$today;

?>


<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
<body id="dt_example" class="ex_highlight_row">
<h1><b>FORM HASIL QUALITY ASSURANCE</b></h1>

<div id="dynamic">
<form name=mintadarah1 method=post> NO KANTONG : 
<INPUT type="text"  name="minta1"  size='23' placeholder="Masukan No Kantong" >
<input type=submit name=cari value=Cari>
</form></div>

<?
if (isset($_POST[cari])) {$nkt=$_POST[minta1];
  $stokkantong=mysql_query("select * from stokkantong where nokantong='$nkt'");
?>

<h1>Quality Assurance Logistik</h1>
<table class="list" id="box-table-b">
<tr class="field"><th>No Kantong</th><th>Merk</th><th>Jenis</th><th>Nolot</th><th>Tanggal Exp</th><th>Tanggal Barkode</th><th>Tanggal Mutasi </th><th>Status Tempat</th><th>Status</th></tr>
<? while ($datastokkantong=mysql_fetch_array($stokkantong)){ 
//jenis kantong
if ($datastokkantong['jenis']=='1') { $jeniskantong='Single';};
if ($datastokkantong['jenis']=='2') { $jeniskantong='Double';};
if ($datastokkantong['jenis']=='3') { $jeniskantong='Triple';};
if ($datastokkantong['jenis']=='4') { $jeniskantong='Quadruple';};
if ($datastokkantong['jenis']=='5') { $jeniskantong='Pediatrik';};
//status tempat
if ($datastokkantong['StatTempat']=='0') { $status_tempat='stokkantong';};
if ($datastokkantong['StatTempat']=='1') { $status_tempat='Aftap';};
?>
<tr class="record"><td><? echo $datastokkantong['noKantong'] ?></td><td><? echo $datastokkantong['merk'] ?></td><td><? echo $jeniskantong ?></td><td><? echo $datastokkantong['nolot_ktg'] ?></td><td><? echo $datastokkantong['kadaluwarsa_ktg'] ?></td><td><? echo $datastokkantong['tglTerima'] ?></td><td><? echo $datastokkantong['tglmutasi'] ?></td><td><? echo $status_tempat ?></td> <td><input type="checkbox" name="ck_Logistik" value="1"></td></tr>
<? } ?>
</table>

<? $donasi=mysql_query("select * from htransaksi where nokantong ='$nkt'"); ?>
<h1>Quality Assurance Aftap</h1>
<table class="list" id="box-table-b">
<tr class="field"><th>No Kantong</th><th>Jenis Donor</th><th>Pengambilan</th><th>Tempat Donor</th><th>Gol Darah </th><th>Mulai Donor</th><th>Selesai Donor</th><th>Status</th></tr>
<? while ($dataaftap=mysql_fetch_array($donasi)){ 
//jenis Donor
if ($dataaftap['JenisDonor']=='0') { $jenis_donor='Sukarela';};
if ($dataaftap['JenisDonor']=='1') { $jenis_donor='Pengganti';};

//pengambilan
if ($dataaftap['Pengambilan']=='0') { $pengambilan='Berhasil';};
if ($dataaftap['Pengambilan']=='1') { $pengambilan='Batal';};
if ($dataaftap['Pengambilan']=='2') { $pengambilan='Gagal';};

//tempat donor
if ($dataaftap['tempat']=='0') { $tempat='Dalam Gedung';};
if ($dataaftap['tempat']=='2') { $tempat='Mobile Unit';};
if ($dataaftap['tempat']=='3') { $tempat='Mobile Unit Dalam Gedung';};



?>
<tr class="record"><td><? echo $dataaftap['NoKantong'] ?></td><td><? echo $jenis_donor ?></td><td><? echo $pengambilan ?></td><td><? echo $tempat ?></td><td><? echo $dataaftap['gol_darah'] ?></td><td><? echo $dataaftap['jam_mulai'] ?></td><td><? echo $dataaftap['jam_selesai'] ?></td><td><input type="checkbox" name="ck_Aftap" value="1" onchange='disabletext(this.value);'></td></tr>
<? } ?>
</table>

<? $imltd=mysql_query("select * from stokkantong where nokantong ='$nkt'"); ?>

<h1>Quality Assurance IMLTD</h1>
<?
$hasil=mysql_query("select noKantong as nk, jenis as jn, tglperiksa as tgl,gol_darah as gd,RhesusDrh as rh,tgl_Aftap as ta,statKonfirmasi as kon from stokkantong where hasil='2' and ident='m' and nokantong='$nkt' ");
	$TRec=mysql_num_rows($hasil);

?>
<table class="list" id="box-table-b">
      <tr>

        <!--td colspan=2>Daftar Kantong Non Reaktif :
          <?=$bln22?>
          -

          <?=$perthn?></td>
		  <!--td>Ketik No Kantong <input name="cari" type="text" /></td-->
      </tr>
      <!--tr class="record">
        <th colspan=17><b>Total =
          <?=mysql_num_rows($hasil)?>
          Kantong</b></th>
      </tr-->
      <tr class="field">
        <th rowspan=2><b>No</b></th>
        <th rowspan=2><b>No Kantong</b></th>
        <th colspan=4><b>Jenis Periksa</b></th>
        <th rowspan=2><b>Tanggal Test</b></th>
	<th rowspan=2><b>Pemeriksa</b></th>
	<th rowspan=2><b>Metode</b></th>
	<th rowspan=2><b>Status</b></th>
      </tr>
      <tr class="field">
        <th><b>HBsAg</b></th>
        <th><b>HCV</b></th>
        <th><b>HIV</b></th>
        <th><b>Syp</b></th>
      </tr>
      <?
				$no=1;
				while($baris=mysql_fetch_assoc($hasil)){ 

$kon='Belum';
if($baris[kon]=='1') $kon='Sudah';
?>
      <tr class="record">
        <td><div align="center"><font size="2">
            

          </font></div></td>
        <td><?=$baris[nk]?></td>
        <?
for ($jenis=0;$jenis<4;$jenis++) {
$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh,Metode from drapidtest where nokantong='$baris[nk]' and jenisperiksa='$jenis' limit 1");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='0') $hasilr='Reaktif';
?>
        <td><?=$hasilr?></td>
        <?
$tgl=$reak[tgl_tes];
$pemeriksa=$reak[dicatatoleh];
$metode=$reak[Metode];
} else {

$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh,OD,Metode from hasilelisa where noKantong='$baris[nk]' and jenisPeriksa='$jenis' limit 1");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';

?>
        <td><?=$hasilr?> , <?=$reak2[OD]?></td>
        <?
$tgl=$reak2[tglPeriksa];

$pemeriksa=$reak2[dicatatOleh];
$metode=$reak2[Metode];
$umur=mysql_fetch_assoc(mysql_query("select umur as um ,JenisDonor as jd ,jk as jk,donorbaru as db from htransaksi  where nokantong='$baris[nk]'"));
}
}
?>

        <!--td><?=$tgl?></td-->
	<td><?=$baris[tgl]?></td>
	<td><?=$pemeriksa?></td>
	<td><?=$metode?></td>
<td><input type="checkbox" name="ck_IMLTD" value="1"></td>
      </tr>
      <?

		$no++;
	} ?>
    </table>

<?
$konfirmasi=mysql_query("select * from dkonfirmasi where NoKantong ='$nkt'"); ?>

<h1>Quality Assurance Konfirmasi Golongan Darah</h1>
<table class="list" id="box-table-b">
<tr class="field"><th>No Kantong</th><th>Metode</th><th>Gol. Darah</th><th>KGD</th><th>Tgl Konfirmasi</th><th>Anti A</th><th>Anti B</th><th>TA</th><th>TB</th><th>TO</th><th>AC</th><th>BA 6%</th><th>Status</th></tr>
<? 
while ($datakonfirmasi=mysql_fetch_array($konfirmasi)){ 
//status konfirmasi
$datakonfirmasi1=mysql_num_rows($konfirmasi);
if ($datakonfirmasi1>=1){ 
$statuskonfirmasi="Sudah";
} else {
$statuskonfirmasi="Belum";
};

//status AC
if ($datakonfirmasi['0']==1){ $status_AC="Ya";} else { $status_AC="Tidak";};
//status BA
if ($datakonfirmasi['0']==1){ $status_BA="Ya";} else { $status_BA="Tidak";};

?>
<tr class="record"><td><? echo $datakonfirmasi['NoKantong'] ?></td><td><? echo $datakonfirmasi['metode'] ?></td><td><? echo $datakonfirmasi['GolDarah'] ?></td><td><? echo $statuskonfirmasi ?></td><td><? echo $datakonfirmasi['tgl'] ?></td><td><? echo $datakonfirmasi['antiA'] ?></td><td><? echo $datakonfirmasi['antiB'] ?></td><td><? echo $datakonfirmasi['tA'] ?></td><td><? echo $datakonfirmasi['tB'] ?></td><td><? echo $datakonfirmasi['tsO'] ?></td><td><? echo $status_AC ?></td><td><? echo $status_BA ?></td><td><input type="checkbox" name="ck_Kgd" value="1"></td></tr>
<? } ?>
</table>

<?
$komponen=mysql_query("select * from stokkantong where nokantong LIKE '$nkt%'"); ?>

<h1>Quality Assurance Komponen</h1>
<table class="list" id="box-table-b">
<tr class="field"><th>No Kantong</th><th>Produk</th><th>Volume</th><th>Tgl Pengolahan</th><th>Kadaluwarsa</th><th>Status</th></tr>
<? 
while ($datakomponen=mysql_fetch_array($komponen)){ 
?>
<tr class="record"><td><? echo $datakomponen['noKantong'] ?></td><td><? echo $datakomponen['produk'] ?></td><td><? echo $datakomponen['volume'] ?></td><td><? echo $datakomponen['tglpengolahan'] ?></td><td><? echo $datakomponen['kadaluwarsa']  ?></td><td><input type="checkbox" name="ck_Komponen" value="1"></td></tr>
<? } ?>
</table>


<h1>Quality Assurance</h1>
<form action="pmiqa.php?module=hasil_qa" method="post">
<table class="list" id="box-table-b">
<tr class="field">
<td>Hasil Kantong </td><td>:</td>
<td>
<select name="hasil_qa" onchange='disabletext(this.value);' id="comments1">
				<option value="0" >LOLOS</option>
				<option value="1" >TIDAK LOLOS</option> 
			</select>
</td><td>Alasan Tidak Lolos</td>
<td><input type="text" placeholder="Alasan" name="alasan_qa" size="40" id="comments"></td>
<td>
<input type="hidden" name="user_qa" value="<? echo $_SESSION[namauser] ?>">
<input type="hidden" name="nokantong_qa" value="<? echo $nkt ?>">
<input type="hidden" name="tgl_qa" value="<? echo $today2 ?>">
<input type="submit" name="simpan" value="simpan">
</td>
</tr>
</table>
</form>
<? }?>

<? 
//if (isset($_POST[simpan])) {

//echo"selesai";
//};



