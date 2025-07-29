<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<style>
div.scroll {
    width: 500px;
    height: 300px;
    overflow: scroll;
}
</style>
<?
function uptime(){
  if(PHP_OS == "Linux") {
    $uptime = @file_get_contents( "/proc/uptime");
    if ($uptime !== false) {
      $uptime = explode(" ",$uptime);
      $uptime = $uptime[0];
      $days = explode(".",(($uptime % 31556926) / 86400));
      $hours = explode(".",((($uptime % 31556926) % 86400) / 3600));
      $minutes = explode(".",(((($uptime % 31556926) % 86400) % 3600) / 60));
      $time = ".";
      if ($minutes > 0)
        $time=$minutes[0]." menit".$time;
      if ($minutes > 0 && ($hours > 0 || $days > 0))
        $time = ", ".$time;
      if ($hours > 0)
        $time = $hours[0]." jam".$time;
      if ($hours > 0 && $days > 0)
        $time = ", ".$time;
      if ($days > 0)
        $time = $days[0]." hari".$time;
    } else {
      $time = false;
    }
  } else {
    $time = false;
  }
  return $time;
}
function human_filesize($bytes, $decimals = 2) {
    $size = array(' B',' kB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}
function sisa_harddisk(){
    $bytes = disk_free_space(".");
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    //echo $bytes;
    return sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
}
function total_harddisk(){
    $bytes = disk_total_space("/");
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    //echo $bytes;
    return sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
}
$fld="/var/www/simudda/backup_data";
//$fld="/media/server/PMISOLO1/";
if (!file_exists($fld)) {
    mkdir($fld);
}
include '../config/db_connect.php';
date_default_timezone_set('Asia/Makassar');
$today="PMI_Backup-".date("Ymd-His");
$qsql=("SHOW GLOBAL STATUS LIKE 'uptime'");
if(isset($_POST[submit])){
    system("/usr/bin/mysqldump -uroot -h localhost --password=F201603907 --routines --add-drop-database pmi 2>&1 > $fld/$today.sql; /bin/rm $fld/$today.zip;/usr/bin/zip -j $fld/$today.zip $fld/$today.sql;/bin/rm $fld/$today.sql;",$hasil);
        echo "<br><br><br>";
    if ($hasil=="0") {
	//=======Audit Trial====================================================================================
	$log_mdl ='ADMIN';
	$log_aksi='Backup: '.$today.'.zip';
	include_once "user_log.php";
	//=====================================================================================================
        ?> <h2>Database sudah berhasil dibackup. Klik unduh untuk menyimpan file </h2>  <?
	?> <a href="backup_data/<?=$today?>.zip" class="swn_button_red">Unduh File</a><?
    } else {
        ?> <h2> Proses backup database GAGAL...</h2> <?
    }
}else{?>
    <h2>Backup Data</h2>
	<form name="download" method="post" action="<? $PHP_SELF ?>">
	<button type="submit" value="Simpan" name="submit" class="swn_button_red" role="button" aria-disabled="false">Klik untuk mulai backup data</button>
	<br>
	<?
	$no=0;
	$files = array();
	if (is_dir($fld)){
		if ($dh = opendir($fld)){
			while (($file = readdir($dh)) !== false){
				if (($file!=='..') and ($file!=='.')){
					$files[] = $file;
				}
			}
			natsort($files);
			?>
			<p>Server Uptime : <?=uptime();?><br>
			Terdapat : <font color='red'> <?=count($files);?> </font>file backup. Klik salah satu file untuk mengunduhnya. Kapasitas penyimpanan tersisa sekitar : <font color='red'> <?=sisa_harddisk();?> </font> dari total : <font color='red'> <?=total_harddisk();?> </font>
			
			<div class="scroll">
			<?
			foreach($files as $file) {
				$no++;?>
				<table>
					<tr>
						<td align="right" width="30"><?=$no.'.'?></td>
						<td><a href="<?='backup_data/'.$file?>"> <?=$file; echo ' - '.human_filesize(filesize('backup_data/'.$file));?> </a> | Backup data sukses</td>
					</tr>
				</table><?
			}?>
			</div><?
		closedir($dh);
		}
	} ?>
    </form>    
<?}?>
