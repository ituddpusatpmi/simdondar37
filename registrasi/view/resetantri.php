<?php
session_start();
include '../adm/config.php';
$reset = mysqli_query($con,"UPDATE antrian set `stat`=1");
?>
<META http-equiv="refresh" content="0; url=panggilantrian.php">