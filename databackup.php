<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />

<?
include '../config/db_connect.php';
$today="Backup-".date("Y-m-d");
if(isset($_POST[submit])){
    //=======Audit Trial====================================================================================
	$log_mdl ='Utility';
	$log_aksi='Backup Data Manual';
	include_once "user_log.php";
	//=====================================================================================================
    system("/usr/bin/mysqldump -uroot -h localhost --password=F201603907 --add-drop-database pmi 2>&1 > gerai/$today.sql; /bin/rm gerai/$today.zip;/usr/bin/zip -j gerai/$today.zip gerai/$today.sql;/bin/rm gerai/$today.sql;",$hasil);
        echo "<br><br><br>";
    if ($hasil=="0") {
        ?> <h2>Proses backup database server sudah selesai. Klik unduh untuk menyimpan file </h2>  <?
    } else {
        ?> <h2> Proses backup database GAGAL...</h2> <?
    }
	?> <h2> <a href=/gerai/<?=$today?>.zip>  Unduh file backup  </a></h2> <?
    }else{?>
	<h2>Backup Database Server</h2>
	<h3>Klik backup database untuk memulai proses backup database server! </h3>
	<form name="download" method="post" action="<? $PHP_SELF ?>">
	<button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
	    <span class="ui-button-text">  Backup Database  </span>
	</button>
	</form>    
    <?}
?>
