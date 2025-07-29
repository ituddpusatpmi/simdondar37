<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />

<?
include '../config/db_connect.php';
$today=date("Y-m-d H:i:s");
if(isset($_POST[submit])){
    system("/usr/bin/mysqldump -upmimu -h $_POST[ip_server] --password=F201603907 --add-drop-database pmi pendonor htransaksi htransaksilama stokkantong user detailinstansi level tempat_donor utd kegiatan pekerjaan dokter_periksa produk stok idcard | /usr/bin/mysql -h localhost pmi -uroot --password=F201603907",$hasil);
	$ganti=mysql_query("update detailinstansi set aktif='0'");
	system("rsync -ur --include='*.js' -f 'hide,! */' -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.php' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	//system("rsync -ur --include='*.jpg' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.png' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
    echo "<br><br><br>";
    if ($hasil=="0") {
        echo "<b> Proses Tranfer Sudah berhasil dilakukan</b>";
    } else {
        echo "<b>Proses Transfer ke Gagal</b>";
        echo mysql_error();
    }
    echo "<meta http-equiv=\"refresh\" content=\"5; URL=../pmimobile.php?module=mobile_transfer\">";    
}else{?>
    <h1>Apakah anda yakin untuk mendownload data dari data base server ?</h1>
    <h2>Setelah mendownload, data transaksi mobile unit sebelumnya akan terhapus.</h2>
    <form name="download" method="post" action="<? $PHP_SELF ?>">
	IP SERVER <input type=text name=ip_server size=13 value='192.168.10.200'><br>
    <button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
        <span class="ui-button-text">Download ke mobile unit</span>
    </button>
    </form>    
<?}
?>
