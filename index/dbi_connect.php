<?php
$dbi=mysqli_connect('localhost','root','F201603907','pmi');
if (mysqli_connect_errno()) {
	echo "Connect failed: %s\n", mysqli_connect_error($dbi).'<br>';
}
?>
