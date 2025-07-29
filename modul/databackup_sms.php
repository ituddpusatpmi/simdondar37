<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<?
include '../config/db_connect.php';
$today="SMS_Backup-".date("Y-m-d");
if(isset($_POST[submit])){
    system("/usr/bin/mysqldump -uroot -h localhost --password=F201603907 --routines --add-drop-database sms 2>&1 > gerai/$today.sql; /bin/rm gerai/$today.zip;/usr/bin/zip -j gerai/$today.zip gerai/$today.sql;/bin/rm gerai/$today.sql;",$hasil);
        echo "<br><br><br>";
    if ($hasil=="0") {
        ?><h2>Proses backup database SMS sudah selesai. Klik unduh untuk menyimpan file </h2><?
	?><a href="/gerai/<?=$today?>.zip" class="swn_button_green">Unduh File</a><?
    } else {
        ?> <h2> Proses backup database SMS GAGAL...</h2> <?
    }
}else{?>
    <h2>Backup Database SMS</h2
    <h3>Klik backup SMS untuk memulai proses backup database SMS! </h3>
    <form name="download" method="post" action="<? $PHP_SELF ?>">
	<button type="submit" value="Simpan" name="submit" class="swn_button_green" role="button" aria-disabled="false">Backup SMS</button>
    </form><?
}?>
