<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir_minta.js"></script>
<script type="text/javascript" src="js/tgl_butuh.js"></script>

<?php
include('clogin.php');
include('config/db_connect.php');
$today=date("Y-m-d");
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
//print_r($_GET);
//print_r($_POST);
?>
<?
if ($_GET[aksi]=='hapus'){
    $hapus_dr=mysql_query("delete from kegiatandiklat where NoTrans='$_GET[id]'");
    if($hapus_dr){
        echo ("Data Jadwal DIKLAT telah dihapus !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmidiklat.php?module=data_jadwal_diklat\">");
    }
}
if ($_GET[aksi]=='pilih'){
$tgp=date("Y-m-d H:i:s");
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,2);
    $ganti=mysql_query("update tempat_donor set active='0'");
    $ganti=mysql_query("update tempat_donor set active='1' where id1='$td0'");
    $hapus_dr=mysql_query("update detaildiklat set aktif='0'");
    $hapus_dr=mysql_query("update detaildiklat set aktif='1' where KodeDetail='$_GET[kd]'");
    $hapus_dr=mysql_query("update kegiatandiklat set TglPelaksanaan='$tgp' where NoTrans='$_GET[id]'");
    if($hapus_dr){
        echo ("Diklat telah dipilih dan Tanggal Pelaksanaan telah ditentukan !!
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmimobile.php?module=data_jadwal_mobile\">");
    }
}
if (isset($_POST[submit1])) {
    $_POST[submit1]="";
    if ($_GET[aksi]=='edit1') {
    $tgj=$_POST[tanggal1].' '.$_POST[jam];
    $estimasi=$_POST[jumlah];
    $doktermu=$_POST[dokter];
    $sopirmu=$_POST[sopir];
    $adminmu=$_POST[admin];
    $atd1mu=$_POST[atd1];
    $atd2mu=$_POST[atd2];
    $atd3mu=$_POST[atd3];
    $tambah=mysql_query("update kegiatandiklat
			set `TglPenjadwalan`='$tgj',
			jumlah = '$estimasi',
			dokter ='$doktermu',
			sopir  ='$sopirmu',
			admin  ='$adminmu',
			atd1   ='$atd1mu',
			atd2   ='$atd2mu',
			atd3   ='$atd3mu'
			where NoTrans='$_POST[notrans]'");
} }
if ($tambah) 
    echo ("Data Jadwal DIKLAT telah diedit !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");

if ($_GET[aksi]=='edit'){
    $q_edit=mysql_query("SELECT NoTrans, TglPenjadwalan, TglPelaksanaan, kodeinstansi, Status, jumlah, id_udd, lat, lng,
                        dokter, upper(sopir) as sopir, upper(atd1) as atd1, upper(atd2) as atd2, upper(atd3) as atd3, upper(admin) as admin
			from kegiatandiklat
			where NoTrans='$_GET[id]'
			order by TglPenjadwalan ASC");
    
    //$q_edit=mysql_query("select * from kegiatan where NoTrans='$_GET[id]' ORDER BY TglPenjadwalan ASC");
    $a_edit=mysql_fetch_assoc($q_edit);
    $a_edit1=mysql_fetch_assoc(mysql_query("select * from detaildiklat where KodeDetail='$a_edit[kodeinstansi]'"));
    ?>
    <h1 class="table">FORM EDIT JADWAL DIKLAT</h1>
    <form method="post" action="pmidiklat.php?module=data_jadwal_diklat&aksi=edit1" >
    <table class="form" cellspacing="1" cellpadding="2">
    <tr>
        <td>
        <table>
            <tr>
                <td>Nama DIKLAT</td>
		<input type=hidden name=notrans value="<?=$a_edit[NoTrans]?>">
                <td class="input"><?=$a_edit1[nama]?>
                </td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td class="input"><?=$a_edit1[alamat]?>
                </td>
            </tr>
        </table>
        </td>
        <td>
        <table>
            <tr>
                <td>Tanggal</td>
                <td class="input">
                    <input name="tanggal1" id="datepicker" type="text" size="30" value="<?=substr($a_edit[TglPenjadwalan],0,10)?>">
                </td>
            </tr>
            <tr>
                <td>Jam</td>
                <td class="input">
                    <input name="jam" type="text" size="30" value="<?=substr($a_edit[TglPenjadwalan],11)?>">
                </td>
            </tr>
	    <tr>
                <td>Jumlah Peserta</td>
                <td class="input">
                    <input name="jumlah" type="text" size="30" value="<?=$a_edit[jumlah]?>">
                </td>
            </tr>
        </table>
	</td>
	<td>
	<table>
            <tr>
		<td>Dokter</td>
		<td class="input">
                    <input name="dokter" type="text" size="30" value="<?=$a_edit[dokter]?>">
		</td>
            </tr>
            <tr>
                <td>Sopir</td>
		<td class="input">
                    <input name="sopir" type="text" size="30" value="<?=$a_edit[sopir]?>">
		</td>
		</td>
            </tr>
	    <tr>
               <td>Admin</td>
	       <td class="input">
                    <input name="admin" type="text" size="30" value="<?=$a_edit[admin]?>">
		</td>
            </tr>
        </table>
        </td>
	<td>
	<table>
            <tr>
               <td>HB</td>
		<td class="input">
                    <input name="atd1" type="text" size="30" value="<?=$a_edit[atd1]?>">
		</td>
            </tr>
            <tr>
                <td>Tensi</td>
		<td class="input">
                    <input name="atd2" type="text" size="30" value="<?=$a_edit[atd2]?>">
		</td>
            </tr>
	    <tr>
                <td>Aftap</td>
		<td class="input">
                    <input name="atd3" type="text" size="30" value="<?=$a_edit[atd3]?>">
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
<form method=post action="pmidiklat.php?module=data_jadwal_diklat&aksi=baru" name="jadwal">
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
<td class="input">Tanggal</td><td class="input"><input name=tanggal id=butuh type=text onchange="submit()"></td></tr>
</table>
</form>
<? if ($_GET[aksi]=='baru') {
    
//$q_dr=mysql_query("select * from kegiatan where cast(TglPenjadwalan as date)='$_POST[tanggal]'");
$q_dr=mysql_query("SELECT NoTrans, TglPenjadwalan, TglPelaksanaan, kodeinstansi, Status, jumlah, id_udd, lat, lng,
                        dokter, upper(sopir) as sopir, upper(atd1) as atd1, upper(atd2) as atd2, upper(atd3) as atd3, upper(admin) as admin
			from kegiatandiklat
			where cast(TglPenjadwalan as date)='$_POST[tanggal]'");
} else { 
//$q_dr=mysql_query("select * from kegiatan where  cast(TglPenjadwalan as date)>='$today' ORDER BY TglPenjadwalan ASC");
$q_dr=mysql_query("SELECT NoTrans, TglPenjadwalan, TglPelaksanaan, kodeinstansi, Status, jumlah, id_udd, lat, lng,
                        dokter, upper(sopir) as sopir, upper(atd1) as atd1, upper(atd2) as atd2, upper(atd3) as atd3, upper(admin) as admin
			from kegiatandiklat
			where cast(TglPenjadwalan as date)>='$today' ORDER BY TglPenjadwalan ASC");
}
?>
<table class="ui-widget ui-widget-content">
    <tr class="ui-widget-header">
        <th>No.</th>
	<th>Tanggal</th>
	<th>Jam</th>
	<th>Instansi</th>
	<th>Alamat</th>
	<th>Kontak Person</th>
	<th>Jumlah</th>
	<th>Dokter</th>
	<th>Sopir</th>
	<th>Admin</th>
	<th>HB</th>
	<th>Tensi</th>
	<th>Aftap</th>
	<th>Aksi</th>
    </tr>
<?php
while($a_dr=mysql_fetch_assoc($q_dr)){
      $tgl=explode(' ',$a_dr[TglPenjadwalan]);
      $tgl1=substr($tgl[0],8);
      $tgl1=(int)$tgl1;
      $tgl10=substr($tgl[0],5,2);
      $tgl10=(int)$tgl10;
      $bulan=$array_bulan[$tgl10];
      $bln =substr($tgl[0],5,2);
      $thn =substr($tgl[0],0,4);
      $th  =substr($tgl[0],2,2);
      $tg  =substr($tgl[0],8,2);
      //$tgl2=$tgl1.' '.$bulan.' '.$thn;
      $tgl2=$tg.'/'.$bln.'/'.$th;
    $cp=mysql_fetch_assoc(mysql_query("select * from detaildiklat where KodeDetail='$a_dr[kodeinstansi]'"));
    $no++;
    echo "<tr>";
        echo "<td>".$no."</td>".
            "<td>".$tgl2."</td>".
            "<td>".substr($a_dr[TglPenjadwalan],11,5)."</td>".
            "<td>".$cp[nama]."</td>".
            "<td>".$cp[alamat]."</td>".
            "<td>".$cp[cp]."</td>".
            "<td>".$a_dr[jumlah]."</td>".
	    "<td>".$a_dr[dokter]."</td>".
	    "<td>".$a_dr[sopir]."</td>".
	    "<td>".$a_dr[admin]."</td>".
	    "<td>".$a_dr[atd1]."</td>".
	    "<td>".$a_dr[atd2]."</td>".
	    "<td>".$a_dr[atd3]."</td>";
	echo "<td>
	    <ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\">";
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,1);
if ($td0!='M') { 
                    echo "<a href=\"".$PHP_SELF."?module=data_jadwal_diklat&aksi=hapus&id=".$a_dr[NoTrans]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Hapus\">
                        <span class=\"ui-icon ui-icon-closethick\"></span></li>
                    </a>";
	echo "
                    <a href=\"".$PHP_SELF."?module=data_jadwal_diklat&aksi=edit&id=".$a_dr[NoTrans]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Ubah\">
                        <span class=\"ui-icon ui-icon-pencil\"></span></li>
                    </a>";
}
if ($td0=='M') { 
if ($cp[aktif]=='0') {
            echo        "<a href=\"".$PHP_SELF."?module=data_jadwal_diklat&aksi=pilih&kd=".$a_dr[kodeinstansi]."&id=".$a_dr[NoTrans]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Pilih\">
                        <span class=\"ui-icon ui-icon-unlocked\"></span></li>
                    </a>";
} else {
            echo        "<a href=\"".$PHP_SELF."?module=data_jadwal_diklat&aksi=pilih0&kd=".$a_dr[kodeinstansi]."&id=".$a_dr[NoTrans]."\">
                        <li class=\"ui-state-default ui-corner-all\" title=\"Pilih\">
                        <span class=\"ui-icon ui-icon-locked\"></span></li>
                    </a>";
}
 }  
            echo "</ul>";
	echo "</td>";
    echo "</tr>";
}
?>
</table>
