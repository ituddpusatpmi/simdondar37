<?php
$namaudd='';
include ('db.php');
$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT upper(`nama`) as `udd` FROM `utd` where `aktif`='1'"));
$namaudd=$udd['udd'];
echo $namaudd;
?>