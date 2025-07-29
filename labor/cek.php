<?php
 
if (!isset($_SESSION['userid']))
{
	?>
		<script>
			alert ("Maaf ..!! Anda Harus LOGIN Terlebih Dahulu"); history.back();
		</script>
	<?php
	//echo "Anda belum login";
	exit;
}
?>