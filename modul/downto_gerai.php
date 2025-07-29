<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />

<?
include '../config/db_connect.php';
$today=date("Y-m-d");
if(isset($_POST[submit])){
    system("/usr/bin/mysqldump -upmimu -h localhost --password=F201603907 --add-drop-database pmi pendonor htransaksi stokkantong user detailinstansi level tempat_donor utd kegiatan pekerjaan dokter_periksa produk stok 2>&1 > gerai/$today.sql; /bin/rm gerai/$today.zip;/usr/bin/zip -j gerai/$today.zip gerai/$today.sql;/bin/rm gerai/$today.sql;",$hasil);
    echo "<br><br><br>";
    if ($hasil=="0") {
        echo "<b> Proses Sudah berhasil dilakukan silahkan Klik Download untuk menyimpan file</b>";
    } else {
        echo "<b>Proses Gagal</b>";
    }
	?>
	<br> <a href=/gerai/<?=$today?>.zip>Download</a>
	<?
}else{?>
    <h1>Apakah anda yakin untuk mendownload data dari data base server ?</h1>
    <form name="download" method="post" action="<? $PHP_SELF ?>">

    <button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
        <span class="ui-button-text">Download ke Gerai</span>
    </button>
    </form>    
<?}
?>
