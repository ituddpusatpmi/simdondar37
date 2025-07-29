<script language=javascript src="idhasil.js" type="text/javascript"> </script>
<script language=javascript src="util.js" type="text/javascript"> </script>
<body OnLoad="document.label_cross.noform.focus();">
<form name="label_cross" method="POST">
    <table border=0>
        <tr>
            <td>No Kantong</td>
            <td><input name="noform" type="text" value="<?=$_GET[NoKantong]?>"></td>
        </tr>
        <tr>
            <td colspan=2>
            <input name="submit" type="submit" value="Submit">
            </td>
        </tr>
</form>
<? 
require_once('config/db_connect.php');
if (isset($_POST[submit])) {
    $hasil=mysql_query("select * from dtransaksipermintaan where NoKantong='$_POST[noform]' and status >'0'");
	$hasil3=mysql_query("select NoForm from dtransaksipermintaan where NoKantong='$_POST[noform]' and status >'0'");
	$hasil2=mysql_fetch_assoc($hasil3);
    $cek=mysql_query("select * from htranspermintaan where noform='$hasil2[noform]'");
    $nhasil1=mysql_num_rows($hasil);
    if (1>0) {
        $h=mysql_fetch_assoc($cek);
	$norm= $h[no_rm];
	$pasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$norm'"));
	$nors= $h[rs];
	$rmsakit=mysql_fetch_assoc(mysql_query("select * from rmhsakit where Kode='$nors'"));
        ?><tr><td>Nama Pasien</td><td><?=$pasien[nama]?></td></tr>
        <tr><td>Rumah Sakit</td><td><?=$rmsakit[NamaRs]?></td></tr>
        <tr><td>Nama Dokter</td><td><?=$h[namadokter]?></td></tr><?php
        while($hasil1=mysql_fetch_assoc($hasil)){ ?>
        
        <tr><td>No Kantong</td><td><?=$hasil1[NoKantong]?></td></tr>
        <tr><td>Metode CrossMatch</td><td><?=$hasil1[MetodeCross]?></td></tr>
        <tr><td>Hasil CrossMatch</td><td><?=$hasil1[StatusCross]?></td></tr>
        <?} 
    } else {
        echo "Nomer Formulir belum dientry/diproses";
    }
}

if (isset($h[noform])) {
?>
<tr><td colspan=2>
	<input name="cetak" type="button" value="Cetak" onClick="$.fn.colorbox({href:'idcross.php?NoKantong=<?=$h[noform]?>', iframe:true, innerWidth:400, innerHeight:350},function(){ $().bind('cbox_closed', function(){window.location ='pmilaboratorium.php?module=label_cross1'})});">
	</td></tr>
<? } ?>
</table>
</body>
