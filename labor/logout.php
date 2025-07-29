<?php
session_start();
unset($_SESSION['userid']);
session_destroy();

echo "<script type='text/javascript'>
			window.alert('Logout Sukses');
			eval(\"parent.location='index.php'\");
			</script>";

?>
