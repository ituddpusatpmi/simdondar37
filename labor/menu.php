<?php
	include "cek.php";
?>
<html>
<body>
<table border="0" width="100%">
<tr>
	<td>
	<?php if($_SESSION['tingkat'] == "admin")
		{
			include_once "home.php";
		}
		if($_SESSION['tingkat'] == "laborat")
		{
			include_once "home.php";
		}
		if($_SESSION['tingkat'] == "pimpinan")
		{
			include_once "menua.php";
		}
	?>
	</td>
</tr>
</table>
<table align="center" border="0">
<tr>
	<td><div data-role="footer" data-theme="a">Username : <?php echo $_SESSION['userid']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;Level : <?php echo $_SESSION['tingkat']; ?>&nbsp;&nbsp;|Copyright@2014 by <img src="images/dewo.png" width="50" height="20" /></div></td>
</tr>
</table>
</body>
</html>