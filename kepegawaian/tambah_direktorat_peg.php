<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

$rs=mysql_query("SELECT kode from direktoratpeg"); if (!$rs) {mysql_query("DROP TABLE `direktoratpeg`");}
$rs1=mysql_query("SELECT kode from direktoratpeg"); if (!$rs1) {mysql_query("CREATE TABLE `direktoratpeg` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");}


if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from direktoratpeg where kode='$_GET[kode]'");
    if($hapus_dr){
        echo ("Data rumah sakit telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikepegawaian.php?module=tambah_direktorat\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `direktoratpeg` (`kode`,`nama`)
                values ('$_POST[kode]','$_POST[nama]')
                on duplicate key
                update `kode`='$_POST[kode]',`nama`='$_POST[nama]'
                        ");
}
if ($tambah) 
    echo ("Nama Direktorat telah ditambahkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from direktoratpeg where kode='$_GET[kode]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH DIREKTORAT</h1>
    <form method="post" action="pmikepegawaian.php?module=tambah_direktorat" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>kode DIREKTORAT</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$a_edit[kode]?>"><?=$a_edit[kode]?></td>
            </tr>
            <tr>
                <td>Nama DIREKTORAT</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
                </td>
            </tr>
        </table>
        <input border=0 type="submit" name="submit1" value="Simpan" class="swn_button_blue" >
    </form>

<?php
}else {
    $kodekd = "DIR";
	 $idp	= mysql_query("select max(convert(substring(kode,4), SIGNED INTEGER)) as kode from direktoratpeg");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)($idp1[kode]);
	 $idp3=(int)$idp2+1;
	 $j_nol1= 4-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode_baru="DIR".$idp4.$idp3;
     
	?>

    <h1 class="table">MASTER DIREKTORAT</h1>
    <form method="post" action="pmikepegawaian.php?module=tambah_direktorat" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>kode DIREKTORAT</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$kode_baru?>"><?=$kode_baru?></td>
            </tr>
            <tr>
                <td>Nama DIREKTORAT</td>
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
        <th>No.</th><th>kode Direktorat</th><th>Nama Direktorat</th><th>Aksi</th> </tr>
<?php
$q_dr=mysql_query("select * from direktoratpeg order by kode ASC");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[kode]."</td>".
            "<td>".$a_dr[nama]."</td>";
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                                <a href=\"".$PHP_SELF."?module=tambah_direktorat&aksi=hapus&kode=".$a_dr[kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Hapus Data Rumah Sakit\">
                                <span class=\"ui-icon ui-icon-closethick\"></span></li>
                                </a>
                            <a href=\"".$PHP_SELF."?module=tambah_direktorat&aksi=edit&kode=".$a_dr[kode]."\">
                                <li class=\"ui-state-default ui-corner-all\" title=\"Ubah Data Rumah Sakit\">
                                <span class=\"ui-icon ui-icon-pencil\"></span></li>
                                </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
