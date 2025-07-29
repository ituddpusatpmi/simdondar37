<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from dokter where kode='$_GET[id]'");
    if($hapus_dr){
        echo ("Data dokter telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `dokter` (`kode`,`Nama`,`alamat`,`telp1`,`telp2`)
                values ('$_POST[kode]','$_POST[nama]','$_POST[alamat]',
                        '$_POST[telp1]','$_POST[telp2]')
                on duplicate key
                update `kode`='$_POST[kode]',`Nama`='$_POST[nama]',`alamat`='$_POST[alamat]',
                        `telp1`='$_POST[telp1]',`telp2`='$_POST[telp2]'
                        ");
}
if ($tambah) 
    echo ("Dokter telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from dokter where kode='$_GET[id]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH DOKTER RUMAH SAKIT</h1>
    <form method="post" action="pmikasir2.php?module=tambah_dokter" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode Dokter</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$a_edit[kode]?>"><?=$a_edit[kode]?></td>
            </tr>
            <tr>
                <td>Nama Dokter</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[Nama]?>">
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td class="input">
                    <input name="alamat" type="text" size="30" value="<?=$a_edit[alamat]?>">
                </td>
            </tr>
        </table>
        </td>
        <td>
        <table>
            <tr>
                <td>No Telp</td>
                <td class="input">
                    <input name="telp1" type="text" size="30" value="<?=$a_edit[telp1]?>">
                </td>
            </tr>
            <tr>
                <td>No HP</td>
                <td class="input">
                    <input name="telp2" type="text" size="30" value="<?=$a_edit[telp2]?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    </table>
        <input border=0 type="submit" name="submit1" value="Simpan">
    </form>

<?php
}else {
	// $idp	= mysql_query("select kode from dokter order by kode desc limit 1");
	 //$idp1	= mysql_fetch_assoc($idp);
	 //$idp2	= (int)(substr($idp1[kode],1,5));
	 //$idp3=(int)$idp2+1;
	// $kode_baru=$idp3;
		$sql_dokter=mysql_fetch_assoc(mysql_query("select max(convert(`kode`, SIGNED INTEGER)) as Kode from dokter"));
		$int_kode=$sql_dokter['Kode']+1;
		$j_nol0= 5-(strlen(strval($int_kode)));
		for ($i=0; $i<$j_nol0; $i++){$nol .="0";}
		 $kode_baru=$nol.$int_kode;
    ?>

    <h1 class="table">FORM TAMBAH DOKTER RUMAH SAKIT</h1>
    <form method="post" action="pmikasir2.php?module=tambah_dokter" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode Dokter</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$kode_baru?>"><?=$kode_baru?></td>
            </tr>
            <tr>
                <td>Nama Dokter</td>
                <td class="input">
                    <input name="nama" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td class="input">
                    <input name="alamat" type="text" size="30">
                </td>
            </tr>
        </table>
        </td>
        <td>
        <table>
            <tr>
                <td>No Telp</td>
                <td class="input">
                    <input name="telp1" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>No HP</td>
                <td class="input">
                    <input name="telp2" type="text" size="30">
                </td>
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
        <th>No.</th><th>Kode</th><th>Nama</th><th>Alamat</th><th>Telepon</th><th>HP</th><th>Aksi</th>
    </tr>
<?php
$q_dr=mysql_query("select * from dokter");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[kode]."</td>".
            "<td>".$a_dr[Nama]."</td>".
            "<td>".$a_dr[alamat]."</td>".
            "<td>".$a_dr[telp1]."</td>".
            "<td>".$a_dr[telp2]."</td>";
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"".$PHP_SELF."?module=tambah_dokter&aksi=hapus&id=".$a_dr[kode]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"".$PHP_SELF."?module=tambah_dokter&aksi=edit&id=".$a_dr[kode]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
