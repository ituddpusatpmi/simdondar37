<?php

	include "koneksi.php";

if($_POST['submit'] == 'Submit')
	{
		include "exe_laporan1.php";
	}
else if($_POST['submit'] == 'Update')
	{
		include "exe_laporan2.php";
	}
?>