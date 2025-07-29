<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);

if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from detaildiklat where KodeDetail='$_GET[id]'");
    if($hapus_dr){
        echo ("Data Diklat telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmidiklat.php?module=tambah_diklat\">");
    }
}
if ($_GET[aksi]=='pilih'){
    if($hapus_dr){
        echo ("Diklat telah dipilih !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmidiklat.php?module=tambah_diklat\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";

if (!$_GET[aksi]) {
$knama=substr($_POST[nama],0,2);
$nama=mysql_query("select cast(substring(KodeDetail,3) as unsigned) as kd from detaildiklat where KodeDetail like '$knama%' order by kd DESC");
$nama1=mysql_fetch_assoc($nama);
$nama2=$nama1[kd];
$nama2 = (int)$nama2;
$nama3=$nama2+1;
$j_nol1= 4-(strlen(strval($nama3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $nama4 .="0";
	 }
//$kode_baru="RS".$idp4.$idp3;
$kodedetail=$knama.$nama4.$nama3;
} else { $kodedetail=$_POST[kode];}

     $tambah=mysql_query("INSERT INTO `detaildiklat` (`KodeDetail`,`KodeHeader`,`nama`,`alamat`,`telp`,`cp`)
                values ('$kodedetail','$_POST[kodeheader]','$_POST[nama]','$_POST[alamat]',
                        '$_POST[telp1]','$_POST[cp]')
                on duplicate key
                update `nama`='$_POST[nama]',`KodeHeader`='$_POST[kodeheader]',`alamat`='$_POST[alamat]',
                        `telp`='$_POST[telp1]',`cp`='$_POST[cp]'
                        ");
}
if ($tambah) 
    echo ("Detail Diklat telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from detaildiklat where KodeDetail='$_GET[id]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM EDIT INSTANSI</h1>
    <form method="post" action="pmidiklat.php?module=tambah_diklat&aksi=edit1" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
        <tr>
                <td>Kategori Diklat</td>
<td class="input"> <select name="kodeheader" ><option selected>--Pilih--</option>
<?
    $ins="select * from jenisdiklat";
    $do=mysql_query($ins);
    while($data=mysql_fetch_assoc($do))
    {
       $select="";
       ?>
       <option value="<?=$data[Nama]?>"<?=$select?>>
        <?=$data[Nama]?>
        </option>
        <?
        }
        ?>
        </select></td>
            </tr>
            
            <tr>
                <td>Nama Diklat</td>
                <input type=hidden name=kode value="<?=$a_edit[KodeDetail]?>">
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
                </td>
            </tr>
            <tr>
                <td>Tempat</td>
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
                    <input name="telp1" type="text" size="30" value="<?=$a_edit[telp]?>">
                </td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td class="input">
                    <input name="cp" type="text" size="30" value="<?=$a_edit[cp]?>">
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

   ?>

    <h1 class="table">FORM TAMBAH MASTER DIKLAT</h1>
    <form method="post" action="pmidiklat.php?module=tambah_diklat" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kategori Diklat</td>
                <td class="input"> <select name="kodeheader" ><option selected >--=Pilih=--</option>
<?
    $ins="select * from jenisdiklat order by Nama Asc";
    $do=mysql_query($ins);
    while($data=mysql_fetch_assoc($do))
    {
       $select="";
       ?>
       <option value="<?=$data[Nama]?>"<?=$select?>>
        <?=$data[Nama]?>
        </option>
        <?
        }
        ?>
        </select></td>
            </tr>
            <tr>
                <td>Nama Diklat</td>
                <td class="input">
                    <input name="nama" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>Tempat</td>
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
                <td>Contact Person</td>
                <td class="input">
                    <input name="cp" type="text" size="30">
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

</table>
</form>

<br>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>Nomor</th><th>Kategori</th><th>Kode Diklat</th><th>Nama Diklat</th><th>Alamat</th><th>Contact Person</th><th>Telphone</th><th>Jumlah</th><th>Perintah data</th>
    </tr>
<?php

$q_dr=mysql_query("select KodeDetail, KodeHeader, nama, alamat, telp, cp, aktif,
                  (select count(kodeinstansi) from kegiatandiklat where kodeinstansi=detaildiklat.KodeDetail) as jml
		                  from detaildiklat order by nama");

while($a_dr=mysql_fetch_assoc($q_dr)){


    $no++;
    echo "<tr>";
        echo 	"<td>".$no."</td>".
		"<td>".$a_dr[KodeHeader]."</td>".
            	"<td>".$a_dr[KodeDetail]."</td>".
            	"<td>".$a_dr[nama]."</td>".
            	"<td>".$a_dr[alamat]."</td>".
		"<td>".$a_dr[telp]."</td>".
            	"<td>".$a_dr[cp]."</td>".
                "<td>".$a_dr[jml]." x"."</td>";
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
			    <a href=\"".$PHP_SELF."?module=tambah_diklat&aksi=hapus&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
			    <span class=\"ui-icon ui-icon-closethick\"></span></li>
			</a>
			<a href=\"".$PHP_SELF."?module=tambah_diklat&aksi=edit&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
			    <span class=\"ui-icon ui-icon-pencil\"></span></li>
			</a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
