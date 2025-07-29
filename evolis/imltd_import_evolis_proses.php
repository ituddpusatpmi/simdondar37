<div style="margin: 30px;">
<?php
if (isset($_GET['op'])){
    $action = $_GET['op'];
    $mode = $_GET['m'];
    if($action=='del'){
        $sql=mysqli_query($dbi,"TRUNCATE TABLE `imltd_import_temp`");
        if ($sql){
            echo "<h2>Clear temporary......</h2>";
        } else {
            echo "<h2>GAGAL Clear temporary</h2>";
        }
    }
}else{
    echo 'Error Action';
}
switch($mode){
    case "evolis": echo "<meta http-equiv='refresh' content='1;url=?module=evolisbiorad'>";break;
    case "import": echo "<meta http-equiv='refresh' content='1;url=?module=import_evolishasil'>";break;
}
?>
</div>