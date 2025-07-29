<!DOCTYPE html>

<html lang="en">
<head>
    <title>SIMDONDAR</title>
    <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
    <link type="text/css" href="css/table1.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
    <link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
    <style>
        .awesomeText {
            color: #000;
            font-size: 100%;
        }
    </style>

    <style>
        #serahterima {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 14px;
            border-collapse: collapse;
        }

        #serahterima td, #serahterima th {
            border: 1px solid #ddd;
            padding: 3px;
        }

        #serahterima tr:nth-child(even){background-color: #ffe6e6;}

        #serahterima tr:hover {background-color: #ddd;}

        #serahterima th {
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            font-weight: lighter;
            background-color: #ff9999;
            color: #000000;
        }
        #serahterima input{
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            background-color: lightyellow;
            color: #000000;
        }
    </style>
    <style>
        #entrybox {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 14px;
            border-collapse: collapse;
        }

        #entrybox td, #entrybox th {
            border: 1px solid #ddd;
            background-color: #ffe6e6;
            padding: 3px;
        }

        #entrybox th {
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            font-weight: lighter;
            background-color: #ffe6e6;
            color: #000000;
        }
        #entrybox input{
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            font-weight: bold;
            background-color: #e6ffe6;
            color: #000000;
        }
    </style>
    <script type="text/javascript">

        /***********************************************
         * Disable "Enter" key in Form script- By Nurul Fadilah(nurul@REMOVETHISvolmedia.com)
         * This notice must stay intact for use
         * Visit http://www.dynamicdrive.com/ for full source code
         ***********************************************/

        function handleEnter (field, event) {
            var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
            if (keyCode == 13) {
                var i;
                for (i = 0; i < field.form.elements.length; i++)
                    if (field == field.form.elements[i])
                        break;
                i = (i + 1) % field.form.elements.length;
                field.form.elements[i].focus();
                return false;
            }
            else
                return true;
        }

    </script>
<head>
<body><center>

<html xmlns="http://www.w3.org/1999/xhtml">
<style>body {font-family: "Lato", sans-serif;}</style>

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
$namauser		= $_SESSION[namauser];
$client_ip      = $_SESSION[client_ip];
include('config/db_connect.php');
if($_POST['submit']){
    $password_lama			= $_POST['password_lama'];
    $pwd                    = md5($password_lama);
    $password_baru			= $_POST['password_baru'];
    $konfirmasi_password	= $_POST['konfirmasi_password'];
    $password_lama			= md5($password_lama);
    $new_pwd                = MD5($_POST['password_baru']);
    $edit=mysql_query("SELECT id_user FROM user WHERE id_user='$namauser' and `password`='$pwd'");
    $r=mysql_fetch_assoc($edit);

	
    if($namauser=$r['id_user']){
        if(strlen($password_baru) >= 4){
			 if(($password_baru == $konfirmasi_password) && ($new_pwd != $password_lama)){
                $password_baru 	= md5($password_baru);
                $id_user 		= $_SESSION['id_user']; //ini dari session saat login
                $update 		= mysql_query("UPDATE `user` SET `password`='$new_pwd', `tglpwd`=CURRENT_DATE(), `update_on`=CURRENT_DATE()  WHERE `id_user`='$namauser'");
                if($update){
                    //=======Audit Trial====================================================================================
                    $log_mdl ='Login';
                    $log_aksi='User merubah password -  Berhasil';
                    $log=mysql_query("INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`, `keterangan`) VALUES
			        ('$client_ip', '$_SESSION[namauser]', '$log_mdl', '$log_aksi', '')");
                    //=====================================================================================================
                    echo '<br>Password berhasil di rubah';
                }else{
                    //=======Audit Trial====================================================================================
                    $log_mdl ='Login';
                    $log_aksi='User merubah password -  Gagal';
                    $log=mysql_query("INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`, `keterangan`) VALUES
			        ('$client_ip', '$_SESSION[namauser]', '$log_mdl', '$log_aksi', '')");
                    //=====================================================================================================
                    echo '<br>Gagal merubah password';
                }
            }else{
                //=======Audit Trial====================================================================================
                $log_mdl ='Login';
                $log_aksi='User merubah password -  Ditolak - Konfirmasi password baru tidak sesuai';
                $log=mysql_query("INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`, `keterangan`) VALUES
			        ('$client_ip', '$_SESSION[namauser]', '$log_mdl', '$log_aksi', '')");
                //=====================================================================================================
                echo '<br>Konfirmasi password tidak sesuai atau sudah digunakan';
            }
        }else{
            //=======Audit Trial====================================================================================
            $log_mdl ='Login';
            $log_aksi='User merubah password -  Ditolak - Password terlalu pendek';
            $log=mysql_query("INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`, `keterangan`) VALUES
			        ('$client_ip', '$_SESSION[namauser]', '$log_mdl', '$log_aksi', '')");
            //=====================================================================================================
            echo '<br>Minimal password baru adalah 4 karakter';
        }
    }else{
        //=======Audit Trial====================================================================================
        $log_mdl ='Login';
        $log_aksi='User merubah password -  Ditolak - Password lama tidak cocok';
        $log=mysql_query("INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`, `keterangan`) VALUES
			        ('$client_ip', '$_SESSION[namauser]', '$log_mdl', '$log_aksi', '')");
        //=====================================================================================================
        echo '<br>Password lama tidak cocok atau sudah digunakan sebelumnya';
    }
	//echo $new_pwd." = ".$password_lama;
    echo "<meta http-equiv='refresh' content='2;url=index.php'>";
}
?>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">PEMBAHARUAN KODE SANDI</div>
<div style="background-color: #ffffff;font-size:16px; color:#0099ff;text-shadow: 1px 0px 0px #000000; font-family:Verdana;">Kode Sandi (password) harus diganti setiap 90 hari</div>
<br>
<form method="post" action="">
    <table id="entrybox" style="border-collapse: collapse;border: 2px solid #ff0000; box-shadow: 5px 7px 6px #e60000;" width="400px">
        <tr style="background-color:mistyrose; font-size:14px; color:#000000;">
            <td>Username</td>
            <td><input type="text" name="usr_name" value="<?=$namauser?>" disabled></td>
        <tr>
        <tr style="background-color:mistyrose; font-size:14px; color:#000000;">
            <td>Password Lama</td>
            <td><input type="password" name="password_lama" required><br>Masukkan password lama</td>
        <tr>
        <tr style="background-color:mistyrose; font-size:14px; color:#000000;">
            <td>Password Baru</td>
            <td><input type="password" name="password_baru" required><br>Password baru min 4 karakter</td>
        <tr>
        <tr style="background-color:mistyrose; font-size:14px; color:#000000;">
            <td>Konfirmasi Password</td>
            <td><input type="password" name="konfirmasi_password" required><br>Konfirmasi password baru</td>
        <tr>
    </table>
        <br><br>
        <a href="index.php" class="swn_button_blue">Kembali</a>
        <input type="submit" name="submit" class="swn_button_blue" value="Update">
</form>
</center>
</body>
</html>
