<?php
// timezone default
date_default_timezone_set('Asia/Jakarta');

session_start();
$ip		= $_SESSION['ipserver'];
//koneksi
$con = mysqli_connect($ip, 'root', 'F201603907', 'pmi');
if(mysqli_connect_errno()) {
	echo mysqli_connect_error();
}

// fungsi base_url
function base_url($url = null) {
	$base_url = "http://localhost/transfusi";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url;
	}
}
?>
