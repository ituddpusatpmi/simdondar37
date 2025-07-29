<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus=mysql_query("delete from kecamatan where Nama='$_GET[Nama]'");
    if($hapus){
        echo ("Data kecamatan telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir.php?module=tambah_kecamatan\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `kecamatan` (`Nama`) values ('$_POST[nama]')");
}
if ($tambah) 
    echo ("Data kecamatan telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from kecamatan where Nama='$_GET[Nama]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM INPUT JENIS KECAMATAN </h1>
    <form method="post" action="pmikasir.php?module=tambah_kecamatan" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>Nama kecamatan</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[Nama]?>">
                </td>
    </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
    $del=mysql_query("delete from kecamatan where `nama`='$_GET[Nama]'");
}else {
?>
    <h1 class="table">FORM DAFTAR KECAMATAN</h1>
    <form method="post" action="pmikasir.php?module=tambah_kecamatan" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>Nama kecamatan</td>
                <td class="input">
                    <input name="nama" type="text" size="30">
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
$q_dr=mysql_query("select * from kecamatan");
$jum_bagian=mysql_numrows($q_dr);
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[Nama]."</td>";
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"".$PHP_SELF."?module=tambah_kecamatan&aksi=hapus&Nama=".$a_dr[Nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"".$PHP_SELF."?module=tambah_kecamatan&aksi=edit&Nama=".$a_dr[Nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
