<? 
$fld="/var/www/simudda/backup_data";
if (!file_exists('$fld')) {
    mkdir('$fld');
}
include '/var/www/simudda/config/db_connect.php';
date_default_timezone_set('Asia/Jakarta');
$today="PMI_Backup-".date("Ymd-His");
system("/usr/bin/mysqldump -uroot -h localhost --password=F201603907 --routines --add-drop-database pmi 2>&1 > $fld/$today.sql;
	/bin/rm $fld/$today.zip; /usr/bin/zip -j $fld/$today.zip $fld/$today.sql;/bin/rm $fld/$today.sql;",$hasil);
if ($hasil=="0") {echo "Sukses";} else {echo "Gagal";}
?>
