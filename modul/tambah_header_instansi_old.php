<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from headerinstansi where kode='$_GET[id]'");
    if($hapus_dr){
        echo ("Data kategori telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmip2d2s.php?module=tambah_kategori\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    $tambah=mysql_query("INSERT INTO `headerinstansi` (`kode`,`Nama`)
                values ('$_POST[kode]','$_POST[nama]')
                on duplicate key
                update `kode`='$_POST[kode]',`Nama`='$_POST[nama]'
                        ");
}
if ($tambah) 
    echo ("Data kategori telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from headerinstansi where kode='$_GET[id]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM TAMBAH KATEGORI</h1>
    <form method="post" action="pmip2d2s.php?module=tambah_kategori" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$a_edit[kode]?>"><?=$a_edit[kode]?></td>
            </tr>
            <tr>
                <td>Nama Kategori</td>
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[Nama]?>">
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
	 $idp	= mysql_query("select kode from headerinstansi order by kode desc limit 1");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)(substr($idp1[kode],2,3));
	 $idp3  = (int)$idp2+1;

	//enabled and edit by suwena ===========================
	//memastikan kode dibelakang dr adalah 2 digit	 
	$j_nol1= 2-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	//=======================================================

	 $kode_baru="kt".$idp4.$idp3;
     
//     print_r($idp1);
//     echo $idp2.";".$idp3.";".$j_nol1.";".$idp4;
     echo mysql_error();
    ?>

    <h1 class="table">FORM TAMBAH KATEGORI</h1>
    <form method="post" action="pmip2d2s.php?module=tambah_kategori" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kode</td>
                <td class="input"><input name="kode" type="hidden" value="<?=$kode_baru?>"><?=$kode_baru?></td>
            </tr>
            <tr>
                <td>Nama Kategori</td>
                <td class="input">
                    <input name="nama" type="text" size="30">
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
        <th>No.</th><th>Kode</th><th>Nama Kategori</th><th>Aksi</th>
    </tr>
<?php
$q_dr=mysql_query("select * from headerinstansi order by kode asc");
while($a_dr=mysql_fetch_assoc($q_dr)){
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$a_dr[kode]."</td>".
            "<td>".$a_dr[Nama]."</td>";
            
		echo "<td>
				<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
                    <a href=\"".$PHP_SELF."?module=tambah_kategori&aksi=hapus&id=".$a_dr[kode]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>
                    <a href=\"".$PHP_SELF."?module=tambah_kategori&aksi=edit&id=".$a_dr[kode]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
