<form action="<? $PHP_SELF ?>" method="post" enctype="multipart/form-data">
<input type="file"  name="file" id="file" />
<input type="submit" value="Upload" />
</form>
<?
include '../config/db_connect.php';
/*
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
*/
$today=date("Y-m-d");
$SafeFile = $_FILES['file']['name'];
$uploaddir = "gerai/";
$path = $uploaddir.$SafeFile;
$path1 = substr($SafeFile,0,-3)."sql";
$file=$_POST['file'];
if($file != none){
if(copy($_FILES['file']['tmp_name'], $path)){
        chdir('gerai');
	//echo getcwd(). "\n";
        system("/usr/bin/unzip $SafeFile");
    system("/usr/bin/mysql -uroot -h localhost --password=F201603907 pmi < $path1",$hasil);
        unlink("$Safefile");
        unlink("$path1");
        chdir("..");
    echo "<br><br><br>";
    if ($hasil=="0") {
        echo "<b> Proses Tranfer Sudah berhasil dilakukan</b>";
    } else {
        echo "<b>Proses Transfer ke Gagal</b>";
    }
}
}
?>
