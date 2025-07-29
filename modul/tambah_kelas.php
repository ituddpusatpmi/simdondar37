<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus=mysql_query("delete from kelas where Nama='$_GET[Nama]'");
    if($hapus){
        echo ("Data kelas telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir2.php?module=tambah_kelas\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `kelas` (`Nama`) values ('$_POST[Nama]')");
}
if ($tambah) 
    echo ("Kelas RS telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from kelas where Nama='$_GET[Nama]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM KELAS RUMAH SAKIT`</h1>
    <form method="post" action="pmikasir2.php?module=tambah_kelas" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>Nama Kelas</td>
                <td class="input">
                    <input name="Nama" type="text" size="30" value="<?=$a_edit[Nama]?>">
                </td>
    </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
    $del=mysql_query("delete from kelas where `Nama`='$_GET[Nama]'");
}else {
?>
    <h1 class="table">FORM KELAS RUMAH SAKIT</h1>
    <form method="post" action="pmikasir2.php?module=tambah_kelas" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>Nama Kelas RS</td>
                <td class="input">
                    <input name="Nama" type="text" size="30">
                </td>
    </tr>
    </table>
                    <input border=0 type="submit" name="submit1" value="Simpan">
    </form> 
<?php    
}
?>
<br>
<br>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>No.</th><th>Nama</th><th>Aksi</th>
    </tr>
<?php
$q_dr=mysql_query("select * from kelas");
$jum_kelas=mysql_numrows($q_dr);
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[Nama]."</td>";
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"".$PHP_SELF."?module=tambah_kelas&aksi=hapus&Nama=".$a_dr[Nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"".$PHP_SELF."?module=tambah_kelas&aksi=edit&Nama=".$a_dr[Nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
