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
</head>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
                
//Membuat nomor transaksi 5 digit ==============================================                               
$tgl    = date('Y-m-d');
$prefix   = "AJ"; //Invoice
$kdthn    = substr(date("Y"),2,2);
$kdprefix = $prefix.$kdthn;
$jumdigit = 6;
$kddata   = mysql_fetch_assoc(mysql_query("select notrans from hstok_transaksi where substring(notrans,1,4)='$kdprefix' order by notrans desc limit 1"));
$nodata   = substr($kddata[notrans],4,$jumdigit);
$no       = $nodata+1;
$j_nol   = $jumdigit-(strlen(strval($no)));
          for ($i=0; $i<$j_nol; $i++){
		    $jnol.="0";
	  }
$notrans  = $kdprefix.$jnol.$no;
$uraian="Penyesuan Barang-".$notrans."-".$namauser;
//Akhir pembuatan nomor transaksi otomatis======================================


if (isset($_POST[submit])) {
	$kode		=$_POST[kode];
     $qtytransaksi	=$_POST[qtytransaksi];
	$keterangan	=$_POST[keterangan];
	$tipe		=$_POST[korek];
	$reagenimltd	=$_POST[reagenujs];
	$kadaluwarsa	=$_POST[kadaluwarsa];
	$nolot		=$_POST[nolot];
	
	
	if ($tipe=="min"){
		$qtymasuk =0;
		$qtykeluar=$qtytransaksi;
		$update=mysql_query("update hstok set stoktotal=stoktotal-'$qtykeluar' where kode='$kode'");
	}else{
		$qtymasuk =$qtytransaksi;
		$qtykeluar=0;
		$update=mysql_query("update hstok set stoktotal=stoktotal+'$qtymasuk' where kode='$kode'");
		
		//Proses apabila Reagen IMLTD
		$sql        = mysql_query("select reagenujs,nama_reagen,metode,ketsatuan from hstok where kode='$kode'");
		$sql1       = mysql_fetch_array($sql);
		if($reagenimltd=='1'){
			$nama_reagen	= $sql1['nama_reagen'];
			$metode     	= $sql1['metode'];
			$jmlkit     	= $qtymasuk;
			$jmltest		= $sql1['ketsatuan'];
			$kodestok   	= $kode;
			$nm     		= substr($nama_reagen,0,2);
               $idp			= mysql_query("select max(kode) as kode from reagen where kode like '$nm%'");
               $idp1		= mysql_fetch_assoc($idp);
               $kdtp		= substr($idp1[kode],2);
			
               if ($kdtp<1) {
                    $kdtp="00000";
               }
               $kdtp2=(int)$kdtp;
			for ($jk=0;$jk<$jmlkit;$jk++){
                    $kdtp2++;
                    $j_nol1= 6-(strlen($kdtp2));
                    $idp4='';
                    for ($i=0; $i<$j_nol1; $i++){
                        $idp4 .="0";
                    }
                    $kodereagen=$nm.$idp4.$kdtp2;	
                    $sqlreagen="insert into reagen (kodeSup,Nama,noLot,jumTest,metode,tglKad,status,kode,keterangan, kodestok) values
                            ('UDD','$nama_reagen','$nolot','$jmltest','$metode','$kadaluwarsa','0','$kodereagen','$notrans','$kodestok')";
                    $insertreagen=mysql_query($sqlreagen);
                }
		}
	}
	//insert header transaksi
	$simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, petugas,uraian, noreferensi)
                        values ('$notrans','Logistik','$tgl','$prefix','$namauser','$uraian','$keterangan')");
	//insert detail transaksi
	$detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, qtytransaksi, qtymasuk, qtykeluar)
                        values ('$notrans','$kode','$qtytransaksi','$qtymasuk','$qtykeluar')");
	
	if ($update) echo ("Data telah ter-update !!
	  <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
}

?>

<form name="masterbarang" method="POST" action="<?=$PHPSELF?>">
<h1 class="table">PENYESUAIAN STOK BARANG</h1>
<table class="form" border="1" cellpadding=2 cellspacing=3>
<script type="text/javascript">
function dbar(browser){
     var brg1;
     var brg2;
	var brg3;
	var reagenujs;
	var ketsatuan;
	var satuan;
          $.ajax({
                    url: "brg_koreksi_stok.php?kode="+browser,
                    async: false,
                    dataType: 'json',
                    success: function(json) {
			      brg2 	= json.barang.nama;
			      brg1 	= json.barang.kode;
                     brg3 	= json.barang.stok;
			      reagenujs= json.barang.reagenujs;
			      ketsatuan= json.barang.ketsatuan;
				 satuan	= json.barang.satuan;
                    }
                });
	  document.masterbarang.namabarang.value=brg2;
	  document.masterbarang.stoktotal.value=brg3;
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
<tr>
	<td>Nomor transaksi</td>
	<td class="input"><?=$notrans?></td>
	</tr>
<tr>
	<td>Uraian Transaksi</td>
	<td class="input"><?=$uraian?></td>
	</tr>
<tr>
	<td>Kode </td>
	<td class="input"><input name="kode" type="text" size="29" placeholder="Klik LUV untuk Lihat daftar barang -->"> <a href="modul/koreksi_stok_headerlist.php?&width=400&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a> </td>
	</tr>
<tr>
	<td>Nama Barang</td>
	<td class="input"><input name="namabarang" type="text" size="50" readonly="readonly"></td>
	</tr>
<tr>
	  <td>Reagen IMLTD?</td>
	  <td class="input"><input name="reagenujs" type="text" size="1" readonly="readonly">* 0:Tidak; 1:Ya</td>
	  </tr>

<tr>
	<td>Jumlah Stok</td>
	<td class="input"><input name="stoktotal" type="text" size="5" readonly="readonly" ></td>
	</tr>
<tr>
     <td>Jumlah</td> <td>
	<input type="radio" name="korek" value="plus" checked="checked">+
        <input type="radio" name="korek" value="min">-
	<input  onchange="hitung()" name="qtytransaksi" type="text" size="5" placeholder="Isi Angka"> Klik '+' jika menambah '-' jika mengurangi</td>
        </tr>
<tr>
	<td>Tanggal Kadaluwarsa</td>
	<td class="input"><input name="kadaluwarsa" type="zdate" size="10" placeholder="YYYY-MM-DD"> Harus diisi jika koreksi stok REAGEN</td>
</tr>
<tr>
	<td>Nomor LOT</td>
	<td class="input"><input name="nolot" type="text" size="15"> Harus diisi jika koreksi stok REAGEN</td>
</tr>
<tr>
	<td>Jumlah test/isi</td>
	<td class="input"><input name="ketsatuan" type="text" size="6" readonly="readonly">** khusus reagen IMLTD</td>
</tr>
<tr>
        <td>Stok Total</td>
        <td class="input"><input name="stokakhir" type="text" size="5" readonly="readonly"></td>
        </tr>
<tr>
        <td>Keterangan</td>
        <td class="input"><input name="keterangan" type="text" size="30"></td>
        </tr>
</table>
<input name="submit" type="submit" value="Simpan Koreksi Stok">
</form>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
