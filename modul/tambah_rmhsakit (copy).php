<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from rmhsakit where Kode='$_GET[Kode]'");
    if($hapus_dr){
        echo ("Data rumah sakit telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir.php?module=tambah_rs\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `rmhsakit` (`Kode`,`NamaRs`,`AlamatRS`,`telp`,`wilayah`)
                values ('$_POST[Kode]','$_POST[NamaRs]','$_POST[AlamatRS]',
                        '$_POST[telp]','$_POST[wilayah]')
                on duplicate key
                update `Kode`='$_POST[Kode]',`NamaRs`='$_POST[NamaRs]',`AlamatRS`='$_POST[AlamatRS]',
                        `telp`='$_POST[telp]',`wilayah`='$_POST[wilayah]'
                        ");
}
if ($tambah) 
    echo ("Rumah sakit telah ditambahkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from rmhsakit where Kode='$_GET[Kode]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH RUMAH SAKIT</h1>
    <form method="post" action="pmikasir.php?module=tambah_rs" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode RS</td>
                <td class="input"><input name="Kode" type="hidden" value="<?=$a_edit[Kode]?>"><?=$a_edit[Kode]?></td>
            </tr>
            <tr>
                <td>Nama RS</td>
                <td class="input">
                    <input name="NamaRs" type="text" size="30" value="<?=$a_edit[NamaRs]?>">
                </td>
            </tr>
        </table>
        </td>
        <td>
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
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
}else {
    $kodekd = "RS";
	 $idp	= mysql_query("select Kode from rmhsakit
                          order by Kode desc limit 1");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)(substr($idp1[Kode],2,3));
	 $idp3=(int)$idp2+1;
	 $j_nol1= 3-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode_baru="DR".$idp4.$idp3;
     
	?>

    <h1 class="table">MASTER RUMAH SAKIT</h1>
    <form method="post" action="pmikasir.php?module=tambah_rs" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode RS</td>
                <td class="input"><input name="Kode" type="hidden" value="<?=$kode_baru?>"><?=$kode_baru?></td>
            </tr>
            <tr>
                <td>Nama RS</td>
                <td class="input">
                    <input name="NamaRs" type="text" size="30">
                </td>
            </tr>
        </table>
        </td>
        <td>
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
        <th>No.</th><th>Kode RS</th><th>Nama Rumah Sakit</th><th>Alamat</th><th>No.Telepon</th><th>Perintah Data</th>
    </tr>
<?php
$q_dr=mysql_query("select * from rmhsakit order by NamaRs");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[Kode]."</td>".
            "<td>".$a_dr[NamaRs]."</td>".
            "<td>".$a_dr[AlamatRS]."</td>".
            "<td>".$a_dr[telp]."</td>";
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                                <a href=\"".$PHP_SELF."?module=tambah_rs&aksi=hapus&Kode=".$a_dr[Kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Hapus Data Rumah Sakit\">
                                <span class=\"ui-icon ui-icon-closethick\"></span></li>
                                </a>
                            <a href=\"".$PHP_SELF."?module=tambah_rs&aksi=edit&Kode=".$a_dr[Kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Ubah Data Rumah Sakit\">
                                <span class=\"ui-icon ui-icon-pencil\"></span></li>
                                </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
