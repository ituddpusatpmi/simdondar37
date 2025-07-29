<script language=javascript src="js/udd.js" type="text/javascript"> </script>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/alert.js" type="text/javascript"> </script>
<script language=javascript src="js/jquery-1.4.2.min.js"></script>
<script language=javascript src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
  $('#instansi').autocomplete({source:'keuangan/suggest_udd.php', minLength:2});});
	  </script>
	<script type="text/javascript">
  jQuery(document).ready(function(){
  
	$('#instansi1').autocomplete({source:'keuangan/suggest_udd1.php', minLength:2});});
  </script>
<?$today=date("Y-m-d");
$tgl1=date("d",strtotime($today));
$bln1=date("n",strtotime($today));
$thn1=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];

include('clogin.php');
include('config/db_connect.php');
require_once("modul/background_process.php");

$namauser=$_SESSION[namauser];


if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from detailpiutang where KodeDetail='$_GET[id]'");
    if($hapus_dr){
        echo ("Data Diklat telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikeuangan.php?module=tambah_piutang\">");
    }
}
if ($_GET[aksi]=='pilih'){
    if($hapus_dr){
        echo ("Diklat telah dipilih !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikeuangan.php?module=tambah_piutang\">");
    }
}

if (isset($_POST[submit1])) {
    $_POST[submit1]="";

if (!$_GET[aksi]) {
$knama=substr($_POST[nama],0,2);
$nama=mysql_query("select cast(substring(KodeDetail,3) as unsigned) as kd from detailpiutang where KodeDetail like '$knama%' order by kd DESC");
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
} else { $kodedetail=$_POST[notrans];}

     $tambah=mysql_query("INSERT INTO `detailpiutang` (`KodeDetail`,`kodeudd`,`nama`,`nofaktur`,`tglnota`,`jumlah`,
`jatuhtempo`,`tlp`,`cp`,`status`,`sisa`)
                values ('$kodedetail','$_POST[kode]','$_POST[nama]','$_POST[nofaktur]','$_POST[tglnota]','$_POST[jumlah]',
'$_POST[tglbayar]','$_POST[telp1]','$_POST[cp]','$_POST[status]','$_POST[jumlah]')
                on duplicate key
                update `nama`='$_POST[nama]',`kodeudd`='$_POST[kode]',`tglnota`='$_POST[tglnota]',`jumlah`='$_POST[jumlah]',`jatuhtempo`='$_POST[tglbayar]',`tlp`='$_POST[telp1]',`cp`='$_POST[cp]',`status`='$_POST[status]',`tglbayar`='$_POST[tglcicil]',`jumbayar`='$_POST[jumbayar]',`sisa`=`jumlah`-`jumbayar`");
}
if ($tambah) 
    echo ("Detail Piutang telah ditambah !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("select * from detailpiutang where KodeDetail='$_GET[id]'");
    $a_edit=mysql_fetch_assoc($q_edit);
 	$namaudd1=mysql_query("select * from utd where id='$_GET[kode]'");
    $namaudd=mysql_fetch_assoc($namaudd1);
	$sisa=$a_edit[jumlah]-$a_edit[jumbayar];
    ?>
    <h1 class="table">FORM EDIT DATA PIUTANG</h1>
    <form method="post" action="pmikeuangan.php?module=tambah_piutang&aksi=edit1" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
        <!--tr>
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
            </tr-->
            <tr><td>No. Transaksi </td><td><input class="input" type="text" name="notrans" value="<?=$a_edit[KodeDetail]?>">
	</td></tr>
    	<tr><td>Kode UDD</td><td><input type=text name="kode" id="instansi" size="7" value="<?=$a_edit[kodeudd]?>">
	</td></tr>
            <tr>
                <td>Nama UDD</td>
                <td class="input">
                    <input name="nama" type="text" id="instansi1" size="30" value="<?=$a_edit[nama]?>">
                </td>
            </tr>
	<tr>
                <td>No. Faktur</td>
                <td class="input">
                    <input name="nofaktur" type="text" size="30" value="<?=$a_edit[nofaktur]?>">
                </td>
            </tr>
            <tr>
                <td>Tgl. Faktur</td>
                <td class="input">
						 <input type="text" name="tglnota" id="datepicker1" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);" value="<?=$a_edit[tglnota]?>">
					</td>
            </tr>
 	<tr>
                <td>Nominal</td>
                <td class="input">
                    <input name="jumlah" type="text" size="15" value="<?=$a_edit[jumlah]?>">
                </td>
            </tr>
        </table>
        </td>
        <td>
        <table>
	<tr>
                <td>Tgl Jatuh Tempo</td>
                <td class="input">
						 <input type="text" name="tglbayar" id="datepicker" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);" value="<?=$a_edit[jatuhtempo]?>">
					</td>
            </tr>
            <tr>
                <td>Telp Contact person</td>
                <td class="input">
                    <input name="telp1" type="text" size="30" value="<?=$a_edit[tlp]?>">
                </td>
            </tr>
            <tr>
                <td>Nama Contact Person</td>
                <td class="input">
                    <input name="cp" type="text" size="30" value="<?=$a_edit[cp]?>">
                </td>
            </tr>
	  <tr>
			      <td>Status</td>
			      <td class="input">
				<select name="status" value="<?=$a_edit[status]?>">
				  <option value="0" >Hutang</option>
				  <option value="1" >Lunas</option>
					<option value="2" >Cicilan</option>
				</select>
			      </td>
			   </tr>
		<tr>
                <td>Tgl. Bayar</td>
                <td class="input">
						 <input type="text" name="tglcicil" id="datepicker" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);" value="<?=$a_edit[tglbayar]?>">
					</td>
            </tr>
		<tr>
                <td>Jml. Bayar</td>
                <td class="input">
                    <input name="jumbayar" type="text" size="30" value="<?=$a_edit[jumbayar]?>">
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

    <h1 class="table">FORM TAMBAH PIUTANG</h1>
    <form method="post" action="pmikeuangan.php?module=tambah_piutang" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <!--tr>
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
            </tr-->
	<tr><td>Kode UDD</td><td><input type=text name="kode" id="instansi" size="7">
	</td></tr>
            <tr>
                <td>Nama UDD</td>
                <td class="input">
                    <input name="nama" type="text" id="instansi1" size="30" value="<?=$namaudd[nama]?>">
                </td>
            </tr>
	<tr>
                <td>No. Faktur</td>
                <td class="input">
                    <input name="nofaktur" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>Tgl. Faktur</td>
                <td class="input">
						 <input type="text" name="tglnota" id="datepicker" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
					</td>
            </tr>
 	<tr>
                <td>Nominal</td>
                <td class="input">
                    <input name="jumlah" type="text" size="15">
                </td>
            </tr>
        </table>
        </td>
        <td>
        <table>
	<tr>
                <td>Tgl Jatuh Tempo</td>
                <td class="input">
						 <input type="text" name="tglbayar" id="datepicker" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
					</td>
            </tr>
            <tr>
                <td>Telp Contact person</td>
                <td class="input">
                    <input name="telp1" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td>Nama Contact Person</td>
                <td class="input">
                    <input name="cp" type="text" size="30">
                </td>
            </tr>
	  <tr>
			      <td>Status</td>
			      <td class="input">
				<select name="status">
				  <option value="0" >Hutang</option>
				  <option value="1" >Lunas</option>
				</select>
			      </td>
			   </tr>
        </table>
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
<h1 class="table">RINCIAN FAKTUR BELUM TERBAYAR</h1>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>Nomor</th><th>Nomor faktur</th><th>Kode UDD</th><th>Nama UDD</th><th>Tgl Faktur</th><th>Jumlah Tagihan</th><th>Jumlah Cicilan</th><th>Sisa Tagihan</th><th>Tgl Jatuh Tempo</th><th>Tgl. Cicilan</th><th>Handphone</th><th>Contact Person</th><th>Status</th><th>Perintah data</th>
    </tr>
<?php

/*$q_dr=mysql_query("select KodeDetail,kodeudd, nama,nofaktur, tglnota,jumlah,jatuhtempo, tlp, cp, status,
                  (select count(id) from utd where id=detailpiutang.kodeudd) as jml
		                  from detailpiutang order by nama");*/
$q_dr=mysql_query("select KodeDetail,kodeudd, nama,nofaktur, tglnota,jumlah,jatuhtempo, tlp, cp, status,sisa,jumbayar,tglbayar from detailpiutang where (status='0' or status='2')  order by nama");

while($a_dr=mysql_fetch_assoc($q_dr)){

$status0='Hutang';
if ($a_dr[status]=='2') $status0="Cicilan";

    $no++;
    echo "<tr>";
        echo 	"<td>".$no."</td>".
		"<td>".$a_dr[nofaktur]."</td>".
            	"<td>".$a_dr[kodeudd]."</td>".
            	"<td>".$a_dr[nama]."</td>".
            	"<td>".$a_dr[tglnota]."</td>".
		"<td>".$a_dr[jumlah]."</td>".
		"<td>".$a_dr[jumbayar]."</td>".
		"<td>".$a_dr[sisa]."</td>".
            	"<td>".$a_dr[jatuhtempo]."</td>".
		"<td>".$a_dr[tglbayar]."</td>".
		"<td>".$a_dr[tlp]."</td>".
		"<td>".$a_dr[cp]."</td>".
		"<td>".$status0."</td>";
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
			    <a href=\"".$PHP_SELF."?module=tambah_piutang&aksi=hapus&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
			    <span class=\"ui-icon ui-icon-closethick\"></span></li>
			</a>
			<a href=\"".$PHP_SELF."?module=tambah_piutang&aksi=edit&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
			    <span class=\"ui-icon ui-icon-pencil\"></span></li>
			</a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
<br>
<h1 class="table">RINCIAN FAKTUR SUDAH TERBAYAR</h1>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>Nomor</th><th>Nomor faktur</th><th>Kode UDD</th><th>Nama UDD</th><th>Tgl Faktur</th><th>Jumlah Tagihan</th><th>Jumlah Bayar</th><th>Tgl Jatuh Tempo</th><th>Tgl Pelunasan</th><th>Handphone</th><th>Contact Person</th><th>Status</th><th>Perintah data</th>
    </tr>
<?php

/*$q_dr=mysql_query("select KodeDetail,kodeudd, nama,nofaktur, tglnota,jumlah,jatuhtempo, tlp, cp, status,
                  (select count(id) from utd where id=detailpiutang.kodeudd) as jml
		                  from detailpiutang order by nama");*/
$q_dr=mysql_query("select KodeDetail,kodeudd, nama,nofaktur, tglnota,jumlah,jatuhtempo, tlp, cp, status,sisa,jumbayar,tglbayar from detailpiutang where status='1'  order by nama");


while($a_dr=mysql_fetch_assoc($q_dr)){


$status1='Lunas';

    $no1++;
    echo "<tr>";
        echo 	"<td>".$no1."</td>".
		"<td>".$a_dr[nofaktur]."</td>".
            	"<td>".$a_dr[kodeudd]."</td>".
            	"<td>".$a_dr[nama]."</td>".
            	"<td>".$a_dr[tglnota]."</td>".
		"<td>".$a_dr[jumlah]."</td>".
		"<td>".$a_dr[jumbayar]."</td>".
            	"<td>".$a_dr[jatuhtempo]."</td>".
		"<td>".$a_dr[tglbayar]."</td>".
		"<td>".$a_dr[tlp]."</td>".
		"<td>".$a_dr[cp]."</td>".
		"<td>".$status1."</td>";
		echo "<td>
			<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">
			    <a href=\"".$PHP_SELF."?module=tambah_piutang&aksi=hapus&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
			    <span class=\"ui-icon ui-icon-closethick\"></span></li>
			</a>
			<a href=\"".$PHP_SELF."?module=tambah_piutang&aksi=edit&id=".$a_dr[KodeDetail]."\">
			    <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
			    <span class=\"ui-icon ui-icon-pencil\"></span></li>
			</a>
            </ul></td>";
    echo "</tr>";
}
?>
</table>
