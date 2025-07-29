<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus=mysql_query("delete from shift where nama='$_GET[nama]'");
    if($hapus){
        echo ("Data Shift telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmiadmin.php?module=edit_shift\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `shift` (`nama`,`jam_awal`,`jam_akhir`) values ('$_POST[nama]','$_POST[awal]','$_POST[akhir]')
			 on duplicate key
                update nama='$_POST[nama]',jam_awal='$_POST[awal]',jam_akhir='$_POST[akhir]'");
}
if ($tambah) 
    echo ("Jenis layanan telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from shift where nama='$_GET[nama]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM GANTI JAM SHIFT </h1>
    <form method="post" action="pmiadmin.php?module=edit_shift" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>Nama Shift</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
                </td>
		<td>Jam Awal</td>
                <td class="input">
                    <input name="awal" type="text" size="30" value="<?=$a_edit[jam_awal]?>">
                </td>
		<td>Jam Akhir</td>
                <td class="input">
                    <input name="akhir" type="text" size="30" value="<?=$a_edit[jam_akhir]?>">
                </td>
    </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
    $del=mysql_query("delete from shift where `nama`='$_GET[nama]'");
}else {
?>
    <h1 class="table">FORM GANTI JAM SHIFT</h1>
    <form method="post" action="pmiadmin.php?module=edit_shift" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
                <td>Nama Shift</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
                </td>
		<td>Jam Awal</td>
                <td class="input">
                    <input name="awal" type="text" size="30" value="<?=$a_edit[jam_awal]?>">
                </td>
		<td>Jam Akhir</td>
                <td class="input">
                    <input name="akhir" type="text" size="30" value="<?=$a_edit[jam_akhir]?>">
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
        <th>No.</th><th>Nama</th><th>Jam Awal</th><th>Jam Akhir</th><th>Aksi</th>
    </tr>
<?php
$q_dr=mysql_query("select * from shift");
$jum_bagian=mysql_numrows($q_dr);
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
	"<td>".$a_dr[nama]."</td>".
	"<td>".$a_dr[jam_awal]."</td>".
	"<td>".$a_dr[jam_akhir]."</td>";	
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"".$PHP_SELF."?module=edit_shift&aksi=hapus&nama=".$a_dr[nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"".$PHP_SELF."?module=edit_shift&aksi=edit&nama=".$a_dr[nama]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
