<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />

<?
include '../config/db_connect.php';
$today=date("Y-m-d H:i:s");
if(isset($_POST[submit])){
	system("rsync -ur --include='*.js' -f 'hide,! */' -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.php' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.png' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.csv' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.css' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.ico' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	system("rsync -ur --include='*.swf' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
	//system("rsync -ur --include='*.jpg' -f 'hide,! */'  -e 'ssh -o StrictHostKeyChecking=no' root@$_POST[ip_server]:/var/www/simudda/* /var/www/simudda/");
    echo "<br><br><br>";
        echo "<b> Proses Tranfer Sudah berhasil dilakukan</b>";
    echo "<meta http-equiv=\"refresh\" content=\"5; URL=../pmiadmin.php?module=update\">";    
}else{?>
    <h1>Apakah anda yakin untuk mengupdate SIMUDDA dari server ?</h1>
    <form name="download" method="post" action="<? $PHP_SELF ?>">
	IP SERVER <input type=text name=ip_server size=18 value='36.84.14.3'><br>
    <button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
        <span class="ui-button-text">Update SIMUDDA dari SERVER UTDP</span>
    </button>
    </form>    
<?}
?>
