<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from biaya where Kode='$_GET[Kode]'");
    if($hapus_dr){
        echo ("Data biaya telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir2.php?module=edit_harga\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `biaya` (`Kode`,`NamaBiaya`,`Harga`)
                values ('$_POST[Kode]','$_POST[NamaBiaya]','$_POST[Harga]')
                on duplicate key
                update `Kode`='$_POST[Kode]',`NamaBiaya`='$_POST[NamaBiaya]',`Harga`='$_POST[Harga]'");
}
if ($tambah) 
    echo ("Jenis Biaya telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from biaya where Kode='$_GET[Kode]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM EDIT JENIS BIAYA</h1>
    <form method="post" action="pmikasir2.php?module=edit_harga" >
    <table class="form" cellspacing="1" cellpadding="2">
            <tr>
                <td>Kode</td>
                <td class="input"><input name="Kode" type="hidden" value="<?=$a_edit[Kode]?>"><?=$a_edit[Kode]?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td class="input">
                    <input name="NamaBiaya" type="text" size="30" value="<?=$a_edit[NamaBiaya]?>">
                </td>
            </tr>
            <tr>
                <td>Biaya</td>
                <td class="input">
                    <input name="Harga" type="text" size="30" value="<?=$a_edit[Harga]?>">
                </td>
            </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
}else {
	 $idp	= mysql_query("select Kode from biaya order by Kode desc limit 1");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)(substr($idp1[Kode],2,3));
	 $idp3=(int)$idp2+1;
	 $j_nol1= 3-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode="BY".$idp4.$idp3;
    ?>

    <h1 class="table">FORM TAMBAH JENIS BIAYA</h1>
    <form method="post" action="pmikasir2.php?module=edit_harga" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
            <tr>
                <td>Kode</td>
                <td class="input">
                    <input name="Kode" type="hidden" value="<?=$kode?>"><?=$kode?>
                </td>
            </tr>
            <tr>
                <td>Nama </td>
                <td class="input">
                    <input name="NamaBiaya" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>Biaya</td>
                <td class="input">
                    <input name="Harga" type="text" size="30">
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
        <th>No.</th><th>Kode</th><th>Nama</th><th>Biaya</th><th>Aksi</th>
    </tr>
<?php
$q_dr=mysql_query("select * from biaya");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[Kode]."</td>".
            "<td>".$a_dr[NamaBiaya]."</td>".
            "<td>".$a_dr[Harga]."</td>";
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"pmikasir2.php?module=edit_harga&aksi=hapus&Kode=".$a_dr[Kode]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"pmikasir2.php?module=edit_harga&aksi=edit&Kode=".$a_dr[Kode]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
