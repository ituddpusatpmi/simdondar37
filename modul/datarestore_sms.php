<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<?php include '../config/db_connect.php'; ?>
<h2>Restore Database SMS</h2><br>
    <?
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    echo "<br />";
$today=date("Y-m-d");
$SafeFile = $_FILES['file']['name'];
$uploaddir = "gerai/";
$path = $uploaddir.$SafeFile;
$path1 = substr($SafeFile,0,-3)."sql";
$file=$_POST['file'];
//Create the upload directory with the right permissions if it doesn't exist
if(!is_dir($uploaddir)){
	mkdir($uploaddir, 0777);
	chmod($uploaddir, 0777);
}
if (isset($_POST["upload_backup"])) {
    if(copy($_FILES['file']['tmp_name'], $path)){
        chdir('gerai');
	//echo getcwd(). "\n";
        system("/usr/bin/unzip $SafeFile");
	system("/usr/bin/mysql -uroot -h localhost --password=F201603907 sms < $path1",$hasil);
        unlink("$Safefile");
        unlink("$path1");
        chdir("..");
	echo "<br><br><br>";
	if ($hasil=="0") {
	    echo "<h2>Proses Restore database SMS sudah berhasil dilakukan</h2>";
	} else {
	    echo "<h2>Proses Restore database SMS Gagal</h2>";
	}
    }
} else{?>
    <form action="<? $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <input type="file"  name="file" id="file" class="swn_button_green"/>
        <input type="submit" name="upload_backup" value="Restore" class="swn_button_green" />
    </form>
<?}?>