<?
include('clogin.php');
include('config/db_connect.php');
if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("update pengumuman set pengumuman='$_POST[pengumuman]' where id='1'");
}
if ($tambah) 
    echo ("Update Sukses !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");
?>
<h1 class="table">Update Pengumuman</h1>
<form method="post" action="<?php echo $PHP_SELF;?>" >
<table class="form" width=50% cellspacing="1" cellpadding="2">
    <tr>
        <td>Isi Pengumuman</td>
        <td class="input">
<?
$tampil=mysql_query("select * from pengumuman where id='1'");
$tampil1=mysql_fetch_array($tampil);
?>
            <textarea name="pengumuman" cols="60" rows="7"><?=$tampil1[pengumuman]?></textarea>
        </td>
    </tr>
</table>
<br>
<input type="submit" name="submit1" value="Update">
</form>
