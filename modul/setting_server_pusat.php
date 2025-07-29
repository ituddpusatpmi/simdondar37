<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<?php
require_once('clogin.php');
include('config/dbi_connect.php');
$result = mysqli_query($dbi,"SHOW COLUMNS FROM `db_server` LIKE 'modul'");
$exists = (mysqli_num_rows($result));
if(!$exists) {
    $q_upd_table=mysqli_query($dbi,"ALTER TABLE `db_server` ADD `modul` VARCHAR( 30 ) NULL ,ADD `alias` VARCHAR( 30 ) NULL");
    $_drop_primary=mysqli_query($dbi,"ALTER TABLE db_server DROP PRIMARY KEY");
    $upd_ayodonor=mysqli_query($dbi,"UPDATE `db_server` SET `modul`='ayodonor', `alias`='Server Ayodonor'");
}

//Database Ayo Donor
$sqlconfig  = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * from db_server where modul='ayodonor'"));
$server_usr = $sqlconfig['user'];
$server_ip  = $sqlconfig['ip'];
$server_db  = $sqlconfig['db'];
$server_pwd = $sqlconfig['password'];
$server_mdl = $sqlconfig['modul'];
$server_alias=$sqlconfig['alias'];
$server_port=$sqlconfig['port'];
if ($server_mdl=='ayodonor'){$set_ayodonor='1';}else{$set_ayodonor='0';}

//Database Laporan
$sqlconfig=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * from db_server where modul='laporan'"));
$svr_lap_usr=$sqlconfig['user'];
$svr_lap_ip=$sqlconfig['ip'];
$svr_lap_db=$sqlconfig['db'];
$svr_lap_pwd=$sqlconfig['password'];
$svr_lap_mdl=$sqlconfig['modul'];
$svr_lap_alias=$sqlconfig['alias'];
$svr_lap_port=$sqlconfig['port'];
if ($svr_lap_mdl=='laporan'){$set_laporan='1';}else{$set_laporan='0';}
$sqludd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif=1"));
$id_udd=$sqludd['id'];


if(isset($_POST['submit'])){
    $v_set_ayodonor=$_POST['set_ayodonor'];
    $v_set_laporan =$_POST['set_laporan'];
    if ($v_set_ayodonor=='1'){
        $qupd="UPDATE db_server set user = '$_POST[usrname]', password = '$_POST[password]', ip = '$_POST[ipserver]', port='$_POST[portserver]', db = '$_POST[database]',alias='$_POST[alias]' WHERE modul='ayodonor'";
        $sqlupd=mysqli_query($dbi, $qupd);
        if ($sqlupd){
            echo "<br>Setting database server AYODONOR telah berhasil diupdate!";

        } else {
            echo "<br>Update setting AYODONOR Gagal!";
        }
    } else {
        $qinst="INSERT INTO `db_server`(`user`, `password`, `ip`, `db`,port, `alias`, `modul`) VALUES ('$_POST[usrname]','$_POST[password]','$_POST[ipserver]', '$_POST[database]', '$_POST[portserver]', '$_POST[alias]','ayodonor')";
        $sqlins=mysqli_query($dbi, $qinst);
        if ($sqlins){echo "<br>Penambahan data setting Ayodonor berhasil";}else{echo "Penambahan setting Ayodonor TIDAK BERHASIL";}
    }

    if ($v_set_laporan=='1'){
        $qupd="UPDATE db_server set user = '$_POST[usrname_lap]', password = '$_POST[password_lap]', ip = '$_POST[ipserver_lap]', db = '$_POST[database_lap]', port='$_POST[port_lap]', alias='$_POST[alias_lap]' WHERE modul='laporan'";
        $sqlupd=mysqli_query($dbi, $qupd);
        if ($sqlupd){echo "<br>Setting database server LAPORAN telah berhasil diupdate!";} else {echo "<br>Update setting LAPORAN Gagal!";}
    }else {
        $qinst="INSERT INTO `db_server`(`user`, `password`, `ip`, `db`, port, `alias`,`modul`) VALUES ('$_POST[usrname_lap]','$_POST[password_lap]','$_POST[ipserver_lap]', '$_POST[port_lap]', '$_POST[database_lap]','$_POST[alias_lap]','laporan')";
        $sqlins=mysqli_query($dbi, $qinst);
        if ($sqlins){echo "<br>Penambahan data setting Laporan berhasil";}else{echo "Penambahan setting Laporan TIDAK BERHASIL";}
    }
    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmiadmin.php?module=settingserver\">";
} if(isset($_POST['submit2'])){
	echo "TES KONEKSI SERVER AYODONOR<br>";
    echo "Koneksi ke : $server_ip<br>";
    echo "Database : $server_db<br>";
    echo "User : $server_usr<br>";
    echo "Port : $server_port<br>";
    $con_pmipusat = mysqli_connect($server_ip, $server_usr, $server_pwd, $server_db, $server_port);
    if (!$con_pmipusat) { 
        echo "wahhhhh.... testingnya ke server AYODONOR, GAGAL lho...."; 
    } else { 
        echo "Yuhuuu... TES SERVER AYODONOR slayyy! Gas pol, berhasil cuy!";
    }
    
    echo "<meta http-equiv=\"refresh\" content=\"5; URL=../pmiadmin.php?module=settingserver\">";      
} if(isset($_POST['submit3'])){
    echo "TES KONEKSI SERVER LAPORAN<br>";
    echo "Koneksi ke : $svr_lap_ip<br>";
    echo "Database : $svr_lap_db<br>";
    echo "User : $svr_lap_usr<br>";
    echo "Port : $svr_lap_port<br>";
    $con_pmipusat = mysqli_connect($svr_lap_ip, $svr_lap_usr, $svr_lap_pwd, $svr_lap_db, $svr_lap_port);
    if (!$con_pmipusat) { 
        echo "WADUHHH... testing ke server LAPORAN yaampun, GAGAL cuy!!!"; 
        echo "<br>Error Message: " . mysqli_connect_error();
    } else { 
        echo "TES SERVER LAPORAN amazing! Gaskeun, berhasil bro!";
    }
    echo "<meta http-equiv=\"refresh\" content=\"8; URL=../pmiadmin.php?module=settingserver\">";
}?>
	<form name="setting" method="post" action="<? $PHP_SELF ?>">
        <input type="hidden" name="set_ayodonor" value=<?=$set_ayodonor?>>
        <input type="hidden" name="set_laporan" value=<?=$set_laporan?>>
        <table class="form" cellspacing="2" cellpadding="5" border="0" width="700px;">
            <tr>
                <td>
                    <table class="form" cellspacing="2" cellpadding="5" border="0">
                        <tr style="background-color: #ffffff;">
                            <td colspan="2"><font size="4" color="red" face="Trebuchet MS"><b>Setting Server Ayo Donor</b></font></td>
                        </tr>
                        <tr>
                            <td>SERVER IP/DOMAIN</td>
                            <td class="input"><input name="ipserver" type="text" size="30" placeholder="IP Server Ayodonor" value=<?=$server_ip?> ></td>
                        </tr>
                        <tr>
                            <td>PORT</td>
                            <td class="input"><input name="portserver" type="text" size="30" placeholder="3306" value=<?=$server_port?> ></td>
                        </tr>
                        <tr>
                            <td>Nama lain/Alias</td>
                            <td class="input"><input name="alias" type="text" size="30" placeholder="nama lain" value="<?=$server_alias?>" ></td>
                        </tr>
                        <tr>
                            <td>Nama Database</td>
                            <td class="input"><input name="database" type="text" size="30" placeholder="nama database Ayodonor" value=<?=$server_db?> ></td>
                        </tr>
                        <tr>
                            <td>Nama User</td>
                            <td class="input"><input name="usrname" type="text" size="30" placeholder="nama user Ayodonor" value=<?=$server_usr?> ></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td class="input"><input name="password" type="password" size="30" placeholder="password Ayodonor" value=<?=$server_pwd?> ></td>
                        </tr>
                    </table>
                </td>

                <td>
                    <table class="form" cellspacing="2" cellpadding="5" border="0">
                        <tr style="background-color: #ffffff;">
                            <td colspan="2"><font size="4" color="red" face="Trebuchet MS"><b>Setting Server Laporan Online</b></font></td>
                        </tr>
                        <tr>
                            <td>SERVER IP/DOMAIN</td>
                            <td class="input"><input name="ipserver_lap" type="text" size="30" placeholder="IP Server Laporan Online" value=<?=$svr_lap_ip?> ></td>
                        </tr>
                        <tr>
                            <td>PORT</td>
                            <td class="input"><input name="port_lap" type="text" size="30" placeholder="IP Server Laporan Online" value=<?=$svr_lap_port?> ></td>
                        </tr>
                        <tr>
                            <td>Nama lain/Alias</td>
                            <td class="input"><input name="alias_lap" type="text" size="30" placeholder="nama lain" value="<?=$svr_lap_alias?>" ></td>
                        </tr>
                        <tr>
                            <td>Nama Database</td>
                            <td class="input"><input name="database_lap" type="text" size="30" placeholder="nama Database Laporan Online" value=<?=$svr_lap_db?> ></td>
                        </tr>
                        <tr>
                            <td>Nama User</td>
                            <td class="input"><input name="usrname_lap" type="text" size="30" placeholder="nama user Laporan Online" value=<?=$svr_lap_usr?> ></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td class="input"><input name="password_lap" type="password" size="30" placeholder="password Laporan Online" value=<?=$svr_lap_pwd?> ></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background-color: #ffffff">
                    <button type="submit" value="Simpan" name="submit" class="swn_button_blue">Simpan</button>
                    <button type="submit" value="Test" name="submit2" class="swn_button_blue">Tes Koneksi Server Ayo Donor</button>
                    <button type="submit" value="Test" name="submit3" class="swn_button_blue">Tes Koneksi Server Laporan</button>
                </td>
            </tr>
        </table>
    </form>

