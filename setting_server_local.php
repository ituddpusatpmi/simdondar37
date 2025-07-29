<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />

<?
require_once('clogin.php');
include('config/db_connect.php');
$sqlconfig=mysql_fetch_assoc(mysql_query("select * from db_local limit 1", $con));
$sqludd=mysql_fetch_assoc(mysql_query("select * from utd where aktif=1", $con));
$server_usr=$sqlconfig['user'];
$server_ip=$sqlconfig['ip'];
$server_db=$sqlconfig['db'];
$server_port=$sqlconfig['port'];
$server_pwd=$sqlconfig['password'];
$id_udd=$sqludd[id];




if(isset($_POST[submit])){
	$qupd="UPDATE db_local set user = '$_POST[usrname]', password = '$_POST[password]', ip = '$_POST[ipserver]', db = '$_POST[database]', port = '$_POST[port]'";
	$sqlupd=mysql_query($qupd,$con);
	if ($sqlupd){
		echo "<br><br>Setting database server pusat telah berhasil diupdate!</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmiadmin.php?module=settingserver\">";    	
	} else {
		echo "<br><br>Update Gagal!</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmiadmin.php?module=settingserver\">";    
	}
} if(isset($_POST[submit2])){
	echo "TES KONEKSI SERVER<br>";
	echo "Koneksi ke : $server_ip<br>";
	echo "Database : $server_db<br>";
	echo "User : $server_usr<br>";
	echo "Port : $server_port<br>";
	$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
	mysql_select_db($server_db);
	if (!$con_pmipusat){ echo "<br>GAGAL???????";} else {echo "<br>BERHASIL!";}
	echo "<meta http-equiv=\"refresh\" content=\"5; URL=../pmiadmin.php?module=settingserver\">";    
}else{?>
    <font size="4" color="red" face="Trebuchet MS"><b>Setting Database Server Pusat</b></font>
	<form name="setting" method="post" action="<? $PHP_SELF ?>">
	<table class="form" cellspacing="2" cellpadding="5" border="0">
		<tr>
			<td>SERVER IP/DOMAIN</td>
			<td class="input"><input name="ipserver" type="text" size="30" placeholder="IP Server" value=<?=$server_ip?> ></td>
		</tr>
		<tr>
			<td>Nama Database</td>
			<td class="input"><input name="database" type="text" size="30" placeholder="nama database" value=<?=$server_db?> ></td>
		</tr>
		<tr>
			<td>Nama User</td>
			<td class="input"><input name="usrname" type="text" size="30" placeholder="nama user" value=<?=$server_usr?> ></td>
		</tr>
		<tr>
			<td>Password</td>
			<td class="input"><input name="password" type="password" size="30" placeholder="password" value=<?=$server_pwd?> ></td>
		</tr>
		<tr>
			<td>Port</td>
			<td class="input"><input name="port" type="text" size="30" placeholder="Port" value=<?=$server_port?> ></td>
		</tr>
	</table>
	<button type="submit" value="Simpan" name="submit" class="swn_button_blue">Simpan</button>
	<button type="submit" value="Test" name="submit2" class="swn_button_blue">Tes Koneksi</button>
    </form>
    
<?}
?>
