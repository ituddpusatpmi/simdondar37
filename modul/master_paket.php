<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script language="javascript" src="js/jquery.js"></script>
 <script language="javascript" src="modul/thickbox/thickbox.js"></script>
	
 <script language="javascript">
function selectKodePaket(Kode){
	  $('input[@name=kodepaket]').val(Kode);
	    tb_remove(); 
		dpak(Kode);
}
function selectKode(Kode){
	  $('input[@name=kode]').val(Kode);
	    tb_remove(); 
		dbar(Kode);
}
 </script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
if (isset($_POST[submit])) {
	$kode=$_POST[kodepaket];
        $stoktotal=$_POST[stoktotal];
        $update=mysql_query("update paket set jumlah='$stoktotal' where Kode='$kode'"); 
	$today=date("Y-m-d G:i:s");
        $kartu=mysql_query("insert into kartustokpaket (KodeBrg,Tgl,Debit,Kredit,Ket) values ('$kode','$today','$stoktotal','0','Buat Paket')");
	if ($update) echo ("Data telah ter-update !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
	}
	if (isset($_POST[submit1])) {
	$kode=$_POST[kode];
        $namabar=$_POST[namabarang];
        $namapaket=$_POST[namapaket];
	$ck=mysql_query("select KodeBrg from isipaket where KodeBrg='$kode'");
                if ($ck) $num_ck=mysql_num_rows($ck);
                if ($num_ck<1) {
                        $ip=mysql_query("insert into isipaket (KodeBrg,Nama,KodePaket) value 
                        ('$kode','$namabar','$namapaket')");
              if ($ip) {
echo ("Data telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");}
 }
                else {echo "Barang <b>$_POST[nama_barang]</b> sudah ada! , silakan check kalau gak percaya";}
                }
if ($_GET[hapus]=="1")  {
                $gosok=mysql_query("delete from isipaket where KodeBrg like '$_GET[id]%'");
	if ($gosok) {
echo ("Data telah dihapus !!
<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmilogistik.php?module=master_paket\">");}
}
if (isset($_POST[submit2])) {
	$kode=$_POST[kode];
        $namabar=$_POST[namabarang];
        $namapaket=$_POST[namapaket];
	$up1=mysql_query("update isipaket set KodeBrg='$kode',Nama='$namabar',KodePaket='$namapaket' where KodeBrg='$_GET[id]'");
	if ($up1) echo ("Data telah ter-update !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmilogistik.php?module=master_paket\">");
        }

if (isset($_POST[submit5])) {
        $kode=$_POST[kodepaket];
        $nama=$_POST[namapaket];
        $stoktotal=$_POST[stoktotal];
        $tpaket=mysql_query("insert into paket (Kode,Nama,aktif,jumlah) values ('$kode','$nama','','$stoktotal')");
        if ($tpaket) echo ("Data telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
        }

?>
	<form name="masterstok" method="POST" action="<?=$PHPSELF?>">
<h1 class="table">Master Paket</h1>
	<table class="form" border="0">
<script type="text/javascript">
function dpak(browser){
                var pkt1;
                var pkt2;
                $.ajax({
                        url: "paket.php?kodepaket="+browser,
                        async: false,
                        dataType: 'json',
                        success: function(json) {
                                pkt1 = json.paket.nama;
                                pkt2 = json.paket.jumlah;
                        }
                });
                document.masterstok.namapaket.value=pkt1;
                document.masterstok.stoktotal.value=pkt2;
        }
        </script>

<script>
function hitung(){
	var stok = eval(document.masterstok.stoktotal.value);
	var jum = eval(document.masterstok.jumracik.value);
        var total = stok + jum;
        document.masterstok.stoktotal.value=total;
}
</script>
<?
//$pk=mysql_fetch_assoc(mysql_query("select * from paket"));
?>
    	<tr>
        <td>Kode Paket</td>
	<td class="input"><input name="kodepaket" type="text" size="15" value="<?=$pk[Kode]?>"> <a href="modul/daftar_paket.php?&width=400&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a></td>
        </tr>
        <td>Nama Paket</td>
        <td class="input"><input name="namapaket" type="text" size="15" value="<?=$pk[Nama]?>"></td>
        </tr>
	<tr>
	<td>Jumlah Racik Baru</td>
	<td class="input"><input onChange="hitung()" name="jumracik" type="text" size="15"></td>
        </tr>
	<tr>
	<td>Stok Total</td>
	<td class="input"><input name="stoktotal" type="text" size="5" value="<?=$pk[jumlah]?>"></td>
        </tr>
</table>
<table><tr><td>
	<input type=submit name=submit5 value='Tambah Paket'>
	<input name="submit" type="submit" value="Save">
</form></td>
<form name=stok_paket method=post action=kartu_stok_paket.php>
<td>
<input type=submit name=submit4 value='Kartu Stok'>
</form></td></tr></table>
<br>
<table border="0">
<tr>
<td>
<h1 class="table">Detail Isi Paket</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Pilih Paket :</td><td class="input">
                <select name="paket"><option selected>--Pilih--</option>
                <?
		$pilpak0=mysql_query("select * from paket");
		while($pilpak=mysql_fetch_assoc($pilpak0)) {
		?>
		 <option value="<?=$pilpak[Kode]?>"><?=$pilpak[Kode]?></option>
		<? }?>
                </select>
        </td>
<td><input type=submit name=submit7 value="Pilih"></td>
</tr>
</table>
</form>
<form name="isipaket" method="POST" action="<?=$PHPSELF?>">

<table class="form" border="0">
<script type="text/javascript">
function dbar(browser){
                var barang1;
                var barang2;
                $.ajax({
                        url: "brg_paket.php?kode="+browser,
                        async: false,
                        dataType: 'json',
                        success: function(json) {
                                barang1 = json.barang.nama;
                                barang2 = json.barang.stok;
                        }
                });
		document.isipaket.namabarang.value=barang1;
		document.isipaket.jumbarang.value=barang2;
        }
	</script>
<?
$isi=mysql_fetch_assoc(mysql_query("select * from isipaket where KodeBrg='$_GET[id]'"));
?>
<tr>
<td>Kode </td>
	<td class="input"><input name="kode" type="text" size="15" value="<?=$isi[KodeBrg]?>"> <a href="modul/daftar_barang_paket.php?&width=400&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a></td>
	</tr>
        <tr>
	<td>Nama Barang</td>
	<td class="input"><input name="namabarang" type="text" size="25" value="<?=$isi[Nama]?>"></td>
	</tr>
    	<tr>
        <td>Nama Paket</td>
        <td class="input">
	<select name="namapaket"> 
	<?
                $pilpak0=mysql_query("select * from paket");
                while($pilpak=mysql_fetch_assoc($pilpak0)) {
                $terpilih="";
        	if ($isi[KodePaket]==$pilpak[Kode]) $terpilih="selected";
		?>
                 <option value="<?=$pilpak[Kode]?>" <?=$terpilih?>><?=$pilpak[Kode]?></option>
                <? }?>
                </select>

	</td>
        </tr>
</table>
<?
$pak=mysql_query("select * from isipaket where KodePaket='$_POST[paket]'");
if ($pak) $num_pak=mysql_num_rows($pak);
if ($num_pak>0) {
?>
</td><td width="80"></td>
<td>
<h1 class="table">Nama Paket : <?=$_POST[paket]?></h1>
<table class="form">
<tr><td>No</td><td>Aksi</td><td>Kode Barang</td><td>Nama Barang</td><td>Nama Paket</td></tr>
<?
$no=0;
        while($pak1=mysql_fetch_array($pak)) {
                $no++;
                echo "<tr><td class=input>$no</td><td class=input>
                 <a href=pmilogistik.php?module=master_paket&id=$pak1[KodeBrg] onClick=\"javascript: if (confirm('Are sure to EDIT Data Isi Paket ?')) { return true; } { return false; }\"><img src=images/ubah.png></a>
                <a href=pmilogistik.php?module=master_paket&hapus=1&id=$pak1[KodeBrg] onClick=\"javascript: if (confirm('Are sure to HAPUS Isi Paket ?')) { return true; } { return false; }\"><img src=images/hapus.png></a>     
                </td><td class=input>$pak1[KodeBrg]</td><td class=input>$pak1[Nama]</td><td class=input>$pak1[KodePaket]</td></tr>";
                }
?>
</table>
</td></tr>
</table>
<?}?>
	<input name="submit1" type="submit" value="Ganti/Tambah Isi Paket">
	<input name="submit2" type="submit" value="Simpan Perubahan Isi Paket">
</form>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
