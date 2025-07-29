<?
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
//buat tabel htransaksilama
$ptg=mysql_query("SELECT `id` FROM htransaksilama"); if(!$ptg){mysql_query("CREATE TABLE htransaksilama (
 `id` INT( 12 ) NOT NULL AUTO_INCREMENT ,
 `KodePendonor` varchar( 20 ) NULL,
 `Tgl` date NULL,
 `JenisDonor` CHAR( 1 ) NOT NULL COMMENT '0=Sukarela 1=Pengganti' DEFAULT '',
  `Diambil` varchar(6) DEFAULT NULL,
  `Pengambilan` char(1) DEFAULT NULL COMMENT '0=Sukses 1=Batal 2=Gagal',
  `NoKantong` varchar(20) DEFAULT NULL,
  `tempat` varchar(3) DEFAULT NULL COMMENT '0=utd 1=mobil blm ditransfer 2=mobil sdh ditransfer 3=mobil dalam gedung',
  `petugas` varchar(25) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL,
  `petugasHB` varchar(25) DEFAULT NULL,
  `petugasTensi` varchar(25) DEFAULT NULL,
  `jumHB` char(1) DEFAULT NULL,
  `beratBadan` varchar(4) DEFAULT NULL,
  `Instansi` varchar(40) DEFAULT NULL,
  `tensi` varchar(10) DEFAULT NULL,
  `Hb` varchar(10) DEFAULT NULL,
  `caraAmbil` varchar(30) DEFAULT NULL COMMENT '0=biasa 1=tromboferesis 2=leukaferesis 3 =plasmaferesis 4=Eritoferesis 5=plebotomi',
  `kota` varchar(10) DEFAULT NULL,
  `gol_darah` varchar(5) DEFAULT NULL,
  `rhesus` varchar(5) DEFAULT NULL,
  PRIMARY KEY ( `id` ) )");}

$lama1=mysql_query("SELECT `KodePendonor_lama` FROM `htransaksilama`");if (!$lama1){mysql_query("
ALTER TABLE `htransaksilama` 
ADD `KodePendonor_lama` VARCHAR( 30 ) NULL DEFAULT NULL");}



?>
<head>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>

<script language="javascript">
function selectSupplier(Kode){
	  $('input[@name=kodeSup]').val(Kode);
	  tb_remove(); 
}
function selectKode(Kode){
	  $('input[@name=kode]').val(Kode);
	  tb_remove(); 
	  dbar(Kode);
}
</script>

<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>

<!-- This javascript is only used for the show/hide source on my example page.
     It is not used by the Calendar Popup script -->
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>

<!-- This prints out the default stylehseets used by the DIV style calendar.
     Only needed if you are using the DIV style popup -->
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>

<!-- These styles are here only as an example of how you can over-ride the default
     styles that are included in the script itself. -->
<SCRIPT LANGUAGE="JavaScript" ID="jscal1xx">
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</SCRIPT>

</head>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
                
//Membuat nomor transaksi 5 digit ==============================================                               
$tgl    = date('Y-m-d');
$prefix   = "HD"; //Invoice
$kdthn    = substr(date("Y"),2,2);
$kdprefix = $prefix.$kdthn;
$jumdigit = 6;
$kddata   = mysql_fetch_assoc(mysql_query("select id from htransaksilama where substring(id,1,4)='$kdprefix' order by id desc limit 1"));
$nodata   = substr($kddata[notrans],4,$jumdigit);
$no       = $nodata+1;
$j_nol   = $jumdigit-(strlen(strval($no)));
          for ($i=0; $i<$j_nol; $i++){
		    $jnol.="0";
	  }
$notrans  = $kdprefix.$jnol.$no;
$uraian="Input Data Donor Lama-".$notrans."-".$namauser;
//Akhir pembuatan nomor transaksi otomatis======================================


if (isset($_POST[submit])) {
	$kode		=$_POST[kode];		$instansi	=$_POST[instansi];	
     	$tglaftap	=$_POST[tglaftap];	$jenisdonor	=$_POST[jenisdonor];
	$petugas1	=$_POST[petugas1];	$pengambilan	=$_POST[pengambilan];
	$petugas2	=$_POST[petugas2];	$caraambil	=$_POST[caraambil];
	$petugas3	=$_POST[petugas3];
	$tensi		=$_POST[tensi];
	$hb		=$_POST[hb];
	$hb1		=$_POST[hb1];
	$nokantong	=$_POST[kantong];	$cc		=$_POST[cc];
	$tempat		=$_POST[tempat];	$bb		=$_POST[bb];
	
	$kota=mysql_fetch_assoc(mysql_query("select id from utd where aktif='1'"));
	$pendonor=mysql_fetch_assoc(mysql_query("select GolDarah,Rhesus,Kode_lama from pendonor where Kode='$kode'"));
	
	//insert header transaksi
	$simpan=mysql_query("insert into htransaksilama(KodePendonor,Tgl,JenisDonor,Diambil,Pengambilan,
	Nokantong,tempat,petugas,user,petugasHB,petugasTensi,jumHB,Hb,Instansi,tensi,caraAmbil,beratBadan,kota,gol_darah,rhesus,KodePendonor_lama)
                        values ('$kode','$tglaftap','$jenisdonor','$cc','$pengambilan','$nokantong','$tempat','$petugas3','$namauser','$petugas2','$petugas1',
				'$hb','$hb1','$instansi','$tensi','$caraambil','$bb','$kota[id]','$pendonor[GolDarah]','$pendonor[Rhesus]','$pendonor[Kode_lama]')");
	//tambah jumlah donorke pendonor
	$donorke=mysql_query("update pendonor set jumDonor=jumDonor + 1  where Kode='$kode'");
	//insert detail transaksi
	//$detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, qtytransaksi, qtymasuk, qtykeluar)
          //              values ('$notrans','$kode','$qtytransaksi','$qtymasuk','$qtykeluar')");
	
	if ($simpan) echo ("Data History Donor telah tersimpan !!
	  <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
	
}

?>

<form name="masterbarang" method="POST" action="<?=$PHPSELF?>">
<h1 class="table">FORM INPUT HISTORY TANGGAL DONOR</h1>
<table class="form" >
<script type="text/javascript">
function dbar(browser){
     var brg1;
     var brg2;
	var brg3;
	var reagenujs;
	var ketsatuan;
	var satuan;
          $.ajax({
                    url: "pdnr.php?kode="+browser,
                    async: false,
                    dataType: 'json',
                    success: function(json) {
				
			      brg2 	= json.barang.nama;
			      brg1 	= json.barang.kode;
                     	      brg3 	= json.barang.kodelama;
			      reagenujs = json.barang.reagenujs;
			      ketsatuan = json.barang.ketsatuan;
				 satuan	= json.barang.satuan;
                    }
                });
	  document.masterbarang.namadonor.value=brg2;
	  document.masterbarang.kodelama.value=brg3;
	  document.masterbarang.reagenujs.value=reagenujs;
	  document.masterbarang.ketsatuan.value=ketsatuan;
	  document.masterbarang.satuan.value=satuan;
        }
</script>

<script>
function hitung(){
	var stok = eval(document.masterbarang.stoktotal.value);
	var update = eval(document.masterbarang.qtytransaksi.value);
	if (document.masterbarang.korek[0].checked==true) {
        var total = stok + update; } 
	if (document.masterbarang.korek[1].checked==true) {
        var total= stok - update; } 
        document.masterbarang.stokakhir.value=total;
}

</script>
<!--tr>
	<td>Nomor transaksi</td>
	<td class="input"><?=$notrans?></td>
	</tr>
<!--tr>
	<td>Uraian Transaksi</td>
	<td class="input"><?=$uraian?></td>
	</tr-->
<tr>
	<td>Kode Pendonor</td>
	<td class="input"><input name="kode" type="text" required size="20"> <a href="modul/daftar_pendonor_header.php?&width=500&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a></td>
	</tr>

<!--tr>
	<td>Nama Barang</td>
	<td class="input"><input name="namadonor" type="text" size="50" readonly="readonly"></td>
	</tr-->
<td>Tgl Aftap</td>
        <td class="input"><INPUT TYPE="text" NAME="tglaftap" VALUE="" SIZE=10 required placeholder="YYYY-MM-DD">
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglaftap,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglaftap,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>
<tr>
						<td>Petugas Tensi</td>
						<td class="input">
							<select name="petugas1"">
							  <?
							  $dokter="select * from user order by nama_lengkap";
							  $do=mysql_query($dokter);
							  while($data=mysql_fetch_array($do)){					
							  if ($data[id_user] == $data_combo[petugas3]){
											  echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
										  }else{
											  echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
										  }
										  ?>
							  <? } ?>
							  <option value="--">-</option>
								</select> <input name="tensi" type="text"  size="4" placeholder="---/--">  <input name="bb" type="text"  size="2" placeholder="--">Kg
							</td>
					</tr>
<tr>
						<td>Petugas HB</td>
						<td class="input">
							<select name="petugas2"">
							  <?
							  $dokter="select * from user order by nama_lengkap";
							  $do=mysql_query($dokter);
							  while($data=mysql_fetch_array($do)){					
							  if ($data[id_user] == $data_combo[petugas3]){
											  echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
										  }else{
											  echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
										  }
										  ?>
							  <? } ?>
							  <option value="--">-</option>
								</select> <input name="hb" type="text" size="3" placeholder="--,-" >gr/dl
							<select name="hb1" onchange='disabletext(this.value);'>
				<option value="1" >Tenggelam</option>
				<option value="0" >Mengapung</option>
				<option value="2" >Melayang</option>
			</select>
							</td>
					</tr>

					<tr>
						<td>Petugas Aftap</td>
						<td class="input">
							<select name="petugas3"">
							  <?
							  $dokter="select * from user order by nama_lengkap";
							  $do=mysql_query($dokter);
							  while($data=mysql_fetch_array($do)){					
							  if ($data[id_user] == $data_combo[petugas3]){
											  echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
										  }else{
											  echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
										  }
										  ?>
							  <? } ?>
							  <option value="--">-</option>
								</select>
							</td>
					</tr>

<tr>
	<td>No Kantong</td>
	<td class="input"><input name="kantong" type="text"  size="15" > <input name="cc" type="text" size="3"> CC</td>
	</tr>
<tr>
		<td>Tempat Donor</td>
		<td class="input">
			<select name="tempat" onchange='disabletext(this.value);'>
				<option value="0" >Dalam Gedung</option>
				<option value="M" >Mobile Unit</option>
				
			</select>
	</tr>
<tr>
		<td>Instansi</td>
		<td class="input"><input type='text' name='instansi' size="20"></td>
	</tr>

	<tr>
		<td>Jenis Donor</td>
		<td class="input">
			<select name="jenisdonor" onchange='disabletext(this.value);'>
				<option value="0" >Sukarela</option>
				<option value="1" >Pengganti</option>
				<option value="3" >Autologus</option>
			</select>
	</tr>
	<tr>
		<td>Cara Pengambilan</td>
		<td class="input">
			<select name="caraambil" onchange='disabletext(this.value);'>
				<option value="0" >Biasa</option>
				<option value="1" >Tromboferesis</option>
				<option value="2" >Leukaferesis</option>
				<option value="3" >Plasmaferesis</option>
				<option value="4" >Eritoferesis</option>
				
			</select>
	</tr>
	<tr>
		<td>Status Pengambilan</td>
		<td class="input">
			<select name="pengambilan" onchange='disabletext(this.value);'>
				<option value="0" >Berhasil</option>
				<option value="2" >Gagal</option>
				
			</select>
	</tr>
</table>
<input name="submit" type="submit" value="Simpan">
</form>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
