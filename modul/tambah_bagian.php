<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus=mysql_query("delete from bagian where nama='$_GET[nama]'");
    if($hapus){
        echo ("Data bagian telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir.php?module=tambah_bagian\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `bagian` (`nama`) values ('$_POST[nama]')");
}
if ($tambah) 
    echo ("bagian RS telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from bagian where nama='$_GET[nama]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM bagian RUMAH SAKIT`</h1>
    <form method="post" action="pmikasir2.php?module=tambah_bagian" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>nama bagian</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
                </td>
    </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
    $del=mysql_query("delete from bagian where `nama`='$_GET[nama]'");
}else {
?>
    <h1 class="table">FORM bagian RUMAH SAKIT</h1>
    <form method="post" action="pmikasir2.php?module=tambah_bagian" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>nama bagian RS</td>
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
        <th>No.</th><th>nama</th><th>Aksi</th>
    </tr>
<?php
$q_dr=mysql_query("select * from bagian");
$jum_bagian=mysql_numrows($q_dr);
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[nama]."</td>";
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"".$PHP_SELF."?module=tambah_bagian&aksi=hapus&nama=".$a_dr[nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"".$PHP_SELF."?module=tambah_bagian&aksi=edit&nama=".$a_dr[nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
