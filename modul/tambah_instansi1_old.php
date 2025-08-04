<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<?php
include('clogin.php');
include('config/db_connect.php');
//print_r($_GET);
//print_r($_POST);
$col4=mysql_query("SELECT `jumdonor` FROM `detailinstansi`");if(!$col4){mysql_query("ALTER TABLE `detailinstansi` 
ADD `jumdonor` INT( 11 ) NULL,
ADD `tglakhir_donor` DATE NULL,
ADD `tgldonor_lagi` DATE NULL ");
mysql_query("update detailinstansi set jumdonor= (select count(kodeinstansi) from kegiatan where kodeinstansi=detailinstansi.KodeDetail and status='1')");
mysql_query("update detailinstansi as d ,kegiatan as k set d.tglakhir_donor=( select tglpelaksanaan from `kegiatan` where kodeinstansi=d.kodedetail order by tglpelaksanaan DESC LIMIT 1)");
mysql_query("update `detailinstansi` set tgldonor_lagi=date_add((tglakhir_donor), interval 75 day)");
}


if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from detailinstansi where KodeDetail='$_GET[id]'");
    if($hapus_dr){
        echo ("Data instansi telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmip2d2s.php?module=tambah_instansi\">");
    }
}
if ($_GET[aksi]=='pilih'){
    if($hapus_dr){
        echo ("Instansi telah dipilih !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmip2d2s.php?module=tambah_instansi\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";

if (!$_GET[aksi]) {
$knama=substr($_POST[nama],0,2);
$nama=mysql_query("select cast(substring(KodeDetail,3) as unsigned) as kd from detailinstansi where KodeDetail like '$knama%' order by kd DESC");
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

     $tambah=mysql_query("INSERT INTO `detailinstansi` (`KodeDetail`,`KodeHeader`,`nama`,`alamat`,`telp`,`cp`)
                values ('$kodedetail','$_POST[kodeheader]','$_POST[nama]','$_POST[alamat]',
                        '$_POST[telp1]','$_POST[cp]')
                on duplicate key
                update `nama`='$_POST[nama]',`KodeHeader`='$_POST[kodeheader]',`alamat`='$_POST[alamat]',
                        `telp`='$_POST[telp1]',`cp`='$_POST[cp]'
                        ");
}
if ($tambah) 
    echo ("Instansi telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from detailinstansi where KodeDetail='$_GET[id]'");
    $a_edit=mysql_fetch_assoc($q_edit);
    ?>
    <h1 class="table">FORM EDIT INSTANSI</h1>
    <form method="post" action="pmip2d2s.php?module=tambah_instansi&aksi=edit1" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
        <tr>
                <td>Kategori Instansi</td>
<td class="input"> <select name="kodeheader" ><option selected>--Pilih--</option>
<?
    $ins="select * from headerinstansi";
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
                <td>Nama Instansi</td>
                <input type=hidden name=kode value="<?=$a_edit[KodeDetail]?>">
                <td class="input">
                    <input name="nama" type="text" size="30" value="<?=$a_edit[nama]?>">
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

    <h1 class="table">FORM TAMBAH MASTER INSTANSI</h1>
    <form method="post" action="pmip2d2s.php?module=tambah_instansi" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Kategori Instansi</td>
                <td class="input"> <select name="kodeheader" ><option selected >--=Pilih=--</option>
<?
    $ins="select * from headerinstansi order by Nama Asc";
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
                <td>Nama Instansi</td>
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
        <th>Nomor</th><th>Kategori</th><th>Kode Instansi</th><th>Nama Instansi</th><th>Alamat</th><th>Contact Person</th><th>Telphone</th><th>Jumlah</th><th>Perintah data</th>
    </tr>
<?php

$q_dr=mysql_query("select KodeDetail, KodeHeader, nama, alamat, telp, cp, aktif,
                  (select count(kodeinstansi) from kegiatan where kodeinstansi=detailinstansi.KodeDetail and status='1') as jml
		                  from detailinstansi order by nama");

while($a_dr=mysql_fetch_assoc($q_dr)){
$kodedetail=$a_dr[KodeDetail];


    $no++;
    echo "<tr>";
        echo 	"<td>".$no."</td>".
		"<td>".$a_dr[KodeHeader]."</td>".
            	"<td>".$a_dr[KodeDetail]."</td>".
            	"<td>".$a_dr[nama]."</td>".
            	"<td>".$a_dr[alamat]."</td>".
		"<td>".$a_dr[cp]."</td>".
            	"<td>".$a_dr[telp]."</td>".
		"<td> <a href=pmi".$_SESSION[leveluser].".php?module=history_donor_instansi&q=".$kodedetail." TITLE=\"History Kegiatan\">".$a_dr[jml]." kali </a></td>";
				
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
			    <a href=\"".$PHP_SELF."?module=tambah_instansi&aksi=hapus&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
			    <span class=\"ui-icon ui-icon-closethick\"></span></li>
			</a>
			<a href=\"".$PHP_SELF."?module=tambah_instansi&aksi=edit&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
			    <span class=\"ui-icon ui-icon-pencil\"></span></li>
			</a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
