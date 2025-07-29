<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from jenisdiklat where kode='$_GET[Kode]'");
    if($hapus_dr){
        echo ("Data Kategori Diklat telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmidiklat.php?module=tambah_kategori\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `jenisdiklat` (`kode`,`Nama`)
                values ('$_POST[Kode]','$_POST[NamaRs]')
                on duplicate key
                update `kode`='$_POST[Kode]',`Nama`='$_POST[NamaRs]'");
}
if ($tambah) 
    echo ("Kategori Diklat telah ditambahkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from jenisdiklat where kode='$_GET[Kode]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH KATEGORI DIKLAT</h1>
    <form method="post" action="pmidiklat.php?module=tambah_kategori" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode</td>
                <td class="input"><input name="Kode" type="hidden" value="<?=$a_edit[kode]?>"><?=$a_edit[kode]?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td class="input">
                    <input name="NamaRs" type="text" size="30" value="<?=$a_edit[Nama]?>">
                </td>
            </tr>
        </table>
        </td>
        <!--td>
        <table>
            <tr>
                <td>Alamat</td>
                <td class="input">
                    <input name="AlamatRS" type="text" size="30" value="<?=$a_edit[AlamatRS]?>">
                </td>
            </tr>
            <tr>
                <td>No Telp</td>
                <td class="input">
                    <input name="telp" type="text" size="30" value="<?=$a_edit[telp]?>">
                </td>
            </tr>
            </tr>
        </table>
        </td>
    </tr>
    </table-->
<table>
<tr>
<td>
        <input border=0 type="submit" name="submit1" value="Simpan">
</td>
</tr>
</table>    
</form>

<?php
}else {
    $kodekd = "DI";
	 $idp	= mysql_query("select kode from jenisdiklat
                          order by kode desc limit 1");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)(substr($idp1[kode],2,2));
	 $idp3=(int)$idp2+1;
	 $j_nol1= 2-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode_baru="DI".$idp4.$idp3;
     
	?>

    <h1 class="table">MASTER KATEGORI DIKLAT</h1>
    <form method="post" action="pmidiklat.php?module=tambah_kategori" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode</td>
                <td class="input"><input name="Kode" type="hidden" value="<?=$kode_baru?>"><?=$kode_baru?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td class="input">
                    <input name="NamaRs" type="text" size="30">
                </td>
            </tr>
        </table>
        </td>
        <!--td>
        <table>
            <tr>
                <td>Alamat</td>
                <td class="input">
                    <input name="AlamatRS" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>No Telp</td>
                <td class="input">
                    <input name="telp" type="text" size="30">
                </td>
            </tr>
            </tr>
        </table>
        </td>
    </tr>
    </table-->
<table>
<tr>
<td>

                    <input border=0 type="submit" name="submit1" value="Simpan">
</td>
</tr>
</table>
    </form> 
<?php    
}
?>
<br>
<br>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>No.</th><th>Kode</th><th>Kategori</th><th>Aksi</th></tr>
<?php
$q_dr=mysql_query("select * from jenisdiklat order by kode ASC");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[kode]."</td>".
            "<td>".$a_dr[Nama]."</td>";
            		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                                <a href=\"".$PHP_SELF."?module=tambah_kategori&aksi=hapus&Kode=".$a_dr[kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Hapus Data Kategori Diklat\">
                                <span class=\"ui-icon ui-icon-closethick\"></span></li>
                                </a>
                            <a href=\"".$PHP_SELF."?module=tambah_kategori&aksi=edit&Kode=".$a_dr[kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Ubah Data Kategori Diklat\">
                                <span class=\"ui-icon ui-icon-pencil\"></span></li>
                                </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
