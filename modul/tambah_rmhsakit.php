<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from rmhsakit where Kode='$_GET[Kode]'");
    if($hapus_dr){
        echo ("Data rumah sakit telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir2.php?module=tambah_rs\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah = mysql_query("INSERT INTO `rmhsakit` (`Kode`,`NamaRs`,`AlamatRS`,`telp`,`wilayah`)
                values ('$_POST[Kode]','$_POST[NamaRs]','$_POST[AlamatRS]',
                        '$_POST[telp]','$_POST[wilayah]')
                on duplicate key
                update `Kode`='$_POST[Kode]',`NamaRs`='$_POST[NamaRs]',`AlamatRS`='$_POST[AlamatRS]',
                        `telp`='$_POST[telp]',`wilayah`='$_POST[wilayah]'
                        ");
    $tambahbdrs = mysql_query("INSERT INTO `bdrs` (`kode`,`nama`)
    values ('$_POST[Kode]','$_POST[NamaRs]')
    on duplicate key
    update `kode`='$_POST[Kode]',`nama`='$_POST[NamaRs]'");
}
if ($tambah) 
    echo ("Rumah sakit telah ditambahkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from rmhsakit where Kode='$_GET[Kode]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH RUMAH SAKIT PENGGUNA DARAH</h1>
    <form method="post" action="pmikasir2.php?module=tambah_rs" >
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
	<td>
	<table>
            <tr>
                <td>Wilayah</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="wilayah">
						<option value="0">DALAM KOTA</option>
						<option value="1">LUAR KOTA</option>
					</select>
					</td>
            </tr>
            
        </table>
        </td>
    </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan" class="swn_button_blue" >
    </form>

<?php
}else {
    $kodekd = "RS";
	 $idp	= mysql_query("select max(convert(substring(kode,3), SIGNED INTEGER)) as Kode from rmhsakit");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)($idp1[Kode]);
	 $idp3=(int)$idp2+1;
	 $j_nol1= 4-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode_baru="RS".$idp4.$idp3;
     
	?>

    <h1 class="table">MASTER RUMAH SAKIT</h1>
    <form method="post" action="pmikasir2.php?module=tambah_rs" >
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
	
	<td>
        <table>
	<td>Wilayah</td>
                <td class="styled-select" bgcolor="#ffa688">
					<select name="wilayah">
						<option value="0">DALAM KOTA</option>
						<option value="1">LUAR KOTA</option>
					</select>
					</td>
	
        </td>
	</table>
	
    </tr>
    </table>

                    <input border=0 type="submit" name="submit1" value="Simpan" class="swn_button_blue" >
    </form> 
<?php    
}
?>
<br>
<br>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>No.</th><th>Kode RS</th><th>Nama Rumah Sakit</th><th>Alamat</th><th>Wilayah</th><th>No.Telepon</th><th>Perintah Data</th>
    </tr>
<?php
$q_dr=mysql_query("select * from rmhsakit order by Kode ASC");
while($a_dr=mysql_fetch_assoc($q_dr)){
$wil="HARAP DIEDIT";
if ($a_dr[wilayah]=='1') $wil="LUAR KOTA";
if ($a_dr[wilayah]=='0') $wil="DALAM KOTA";
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[Kode]."</td>".
            "<td>".$a_dr[NamaRs]."</td>".
            "<td>".$a_dr[AlamatRS]."</td>".
		"<td>".$wil."</td>".
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
