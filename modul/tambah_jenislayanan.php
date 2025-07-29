<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

$rs=mysql_query("SELECT kode from jenis_layanan"); if (!$rs) {mysql_query("DROP TABLE `jenis_layanan`");}
$rs1=mysql_query("SELECT kode from jenis_layanan"); if (!$rs1) {mysql_query("CREATE TABLE `jenis_layanan` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");}


if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from jenis_layanan where kode='$_GET[kode]'");
    if($hapus_dr){
        echo ("Data rumah sakit telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir2.php?module=tambah_layanan\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `jenis_layanan` (`kode`,`nama`)
                values ('$_POST[kode]','$_POST[nama]')
                on duplicate key
                update `kode`='$_POST[kode]',`nama`='$_POST[nama]'
                        ");
}
if ($tambah) 
    echo ("Jenis Layanan telah ditambahkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from jenis_layanan where kode='$_GET[kode]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH JENIS LAYANAN</h1>
    <form method="post" action="pmikasir2.php?module=tambah_layanan" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>kode Jenis Layanan</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$a_edit[kode]?>"><?=$a_edit[kode]?></td>
            </tr>
            <tr>
                <td>Nama Jenis Layanan</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
                </td>
            </tr>
        </table>
        <input border=0 type="submit" name="submit1" value="Simpan" class="swn_button_blue" >
    </form>

<?php
}else {
    $kodekd = "JL";
	 $idp	= mysql_query("select max(convert(substring(kode,3), SIGNED INTEGER)) as kode from jenis_layanan");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)($idp1[kode]);
	 $idp3=(int)$idp2+1;
	 $j_nol1= 4-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode_baru="JL".$idp4.$idp3;
     
	?>

    <h1 class="table">MASTER JENIS LAYANAN</h1>
    <form method="post" action="pmikasir2.php?module=tambah_layanan" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>kode Jenis Layanan</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$kode_baru?>"><?=$kode_baru?></td>
            </tr>
            <tr>
                <td>Nama Jenis Layanan</td>
                <td class="input">
                    <input name="nama" type="text" size="30">
                </td>
            </tr>
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
        <th>No.</th><th>kode Jenis Layanan</th><th>Nama Jenis Layanan</th><th>Aksi</th> </tr>
<?php
$q_dr=mysql_query("select * from jenis_layanan order by kode ASC");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[kode]."</td>".
            "<td>".$a_dr[nama]."</td>";
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                                <a href=\"".$PHP_SELF."?module=tambah_layanan&aksi=hapus&kode=".$a_dr[kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Hapus Data Rumah Sakit\">
                                <span class=\"ui-icon ui-icon-closethick\"></span></li>
                                </a>
                            <a href=\"".$PHP_SELF."?module=tambah_layanan&aksi=edit&kode=".$a_dr[kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Ubah Data Rumah Sakit\">
                                <span class=\"ui-icon ui-icon-pencil\"></span></li>
                                </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
