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
if (isset($_POST[submit])) {
	$kode=$_POST[kode];
        $stoktotal=$_POST[jumbarang];
        $update=mysql_query("update hstok set StokTotal='$stoktotal' where Kode='$kode'"); 
	if ($update) echo ("Data telah ter-update !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
	}

?>

<form name="masterbarang" method="POST" action="<?=$PHPSELF?>">

<h1 class="table">Koreksi Stok</h1>
<table class="form" border="0">
<script type="text/javascript">
function dbar(browser){
                var barang1;
                var barang2;
                $.ajax({
                        url: "brg.php?kode="+browser,
                        async: false,
                        dataType: 'json',
                        success: function(json) {
                                barang1 = json.barang.nama;
                                barang2 = json.barang.stok;
                        }
                });
		document.masterbarang.namabarang.value=barang1;
		document.masterbarang.jumbarang.value=barang2;
        }
	</script>
<script>
function hitung(){
	var stok = eval(document.masterbarang.jumbarang.value);
	var update = eval(document.masterbarang.updatebar.value);
	if (document.masterbarang.korek[0].checked==true) {
        var total = stok + update; } 
	if (document.masterbarang.korek[1].checked==true) {
        var total= stok - update; } 
        document.masterbarang.jumbarang.value=total;
}
</script>
<tr>
<td>Kode </td>
	<td class="input"><input name="kode" type="text" size="15"> <a href="modul/daftar_barang.php?&width=400&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a></td>
	</tr>
        <tr>
	<td>Nama Barang</td>
	<td class="input"><input name="namabarang" type="text" size="15"></td>
	</tr>
    	<tr>
        <td>Jumlah</td>
        <td class="input">
	<input type="radio" name="korek" value="plus">+
        <input type="radio" name="korek" value="min">-
	<input onChange="hitung()" name="updatebar" type="text" size="5"></td>
        </tr>
    	<tr>
        <td>Stok Barang</td>
        <td class="input"><input name="jumbarang" type="text" size="5"></td>
        </tr>
</table>
	<input name="submit" type="submit" value="Simpan">
</form>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
