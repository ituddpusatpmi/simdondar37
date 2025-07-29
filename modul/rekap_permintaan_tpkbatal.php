<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$today=date('Y-m-d');
$today1=$today;
$srcnama="";
$srcrm="";
$srcform="";
$src_abo="";
$src_rh="";
$src_rs="";
$src_lyn="";
$src_shift="";
$src_diag="";
$jnspermintaan="";
$srcbagian="";
$src_produk="";

//Query dinamis
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[nama_bagian]!='') {
                $srcbagian  = $_POST[nama_bagian];
                $qbag       = " AND bagian = '$srcbagian' ";
                            } else {$qbag    ="";}
if ($_POST[nama]!='') {
                $srcnama    = $_POST[nama];
                $qnama       = " AND nama like '%$srcnama%' ";
                } else {$qnama    ="";}
if ($_POST[rm]!='') {
                $srcrm      = $_POST[rm];
                $qrm        = " AND no_rm = '$srcrm' ";
                } else {$qrm    ="";}
if ($_POST[nomorf]!='') {
                $srcform    = $_POST[nomorf];
                $qform      = " AND noform = '$srcform' ";
                } else {$qform    ="";}
if ($_POST[gol_abo]!='') {
                $src_abo    = $_POST[gol_abo];
                $qgol       = " AND gol_darah = '$src_abo' ";
                } else {$qgol    ="";}
if ($_POST[gol_rh]!='') {
                $src_rh     = $_POST[gol_rh];
                $qrh        = " AND rhesus = '$src_rh' ";
                } else {$qrh    ="";}
if ($_POST[gol_rs]!='') {
                $src_rs     = $_POST[gol_rs];
                $qrs        = " AND NamaRs like '%$src_rs%' ";
                } else {$qrs    ="";}
if ($_POST[gol_lyn]!='') {
                $src_lyn    = $_POST[gol_lyn];
                $qlyn       = " AND namalayanan = '$src_lyn' ";
                } else {$qlyn    ="";}
if ($_POST[produk_lyn]!='') {
                $src_produk = $_POST[produk_lyn];
                $qproduk    = " AND JenisDarah = '$src_produk' ";
                } else {$qproduk    ="";}
if ($_POST[gol_shift]!='') {
                $src_shift  = $_POST[gol_shift];
                $qshift     = " AND shift = '$src_shift' ";
                } else {$qshift    ="";}
if ($_POST[diag]!='') {
                $src_diag   = $_POST[diag];
                $qdiag      = " AND diagnosa like '%$src_diag%' ";
                } else {$qdiag    ="";}
if ($_POST[jnspermintaan]!='') {
                $jnspermintaan  = $_POST[jnspermintaan];
                $qminta          = " AND jenis_permintaan = '$jnspermintaan' ";
                } else {$qminta    ="";}
?>
<style>
tr { background-color: #FDF5E6}
  .initial { background-color: #FDF5E6; color:#000000 }
  .normal { background-color: #FDF5E6 }
  .highlight { background-color: #7FFF00 }
</style>
<center><font size="5" color=red>DAFTAR PERMINTAAN DARAH</font></center><br>
<form method=post>
    <font size="2" color=black>
    
<table width ="100%">
      <tr>
      <td>TANGGAL</td><td><input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
      S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>></td><td>BAGIAN</td><td>
        <select name="nama_bagian">
        <option value="" selected>- SEMUA -</option>
                <?php
                $permintaan1="select * from bagian";
                $do1=mysql_query($permintaan1);
                while($data1=mysql_fetch_assoc($do1)){
                    $select1="";?>
                    <option value="<?=$data1[nama]?>"<?=$select1?>><?=$data1[nama]?></option><?
                }?></select>
      </td>
      </tr>
      <tr>
    <td>NO.FORM</td> <td><input type=text name=nomorf id=nomorf size=10 value=<?=$srcform?>></td>
    <td>NO.CM </td> <td><input type=text name=rm id=rm size=10 value=<?=$srcrm?>></td></tr>
      <tr>
    <td>NAMA PASIEN </td> <td><input type=text name=nama id=nama size=8 value=<?=$srcnama?>></td>
      <td>PRODUK DARAH</td> <td>
      <select name="produk_lyn">
      <option value="" selected>- SEMUA -</option>
      <?php
      $ql= mysql_query("select Nama from produk ");

      while ($rowl1 = mysql_fetch_array($ql)){?>
       <option value="<?=$rowl1[Nama]?>"><?=$rowl1[Nama]?></option><?
      }
      ?>
      </select></td></tr>
      <tr><td>GOLONGAN DARAH </td> <td><select name="gol_abo">
                        <option value="">PILIH</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select></td>
    
    <td>RHESUS </td> <td><select name="gol_rh">
                        <option value="">PILIIH</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select></td></tr>
    <tr><td>DIAGNOSA</td> <td><input type=text name=diag id=diag size=12 ></td>

      <td>LAYANAN
</td> <td><select name="gol_lyn">
<option value="" selected>- SEMUA -</option>
<?php
$ql= mysql_query("select * from jenis_layanan ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[nama]>$rowl1[nama]</option>";
}
?>
</select></td>

    <!--JENIS LAYANAN<input type=text name=gol_lyn id=gol_lyn size=10 value=<?=$src_lyn?>>
    </font-->

<tr><td>RUMAH SAKIT</td> <td><input type=text name=gol_rs id=nama size=20></td>
                <!--td class="styled-select" bgcolor="#ffa688"-->
      
<td>JENIS PERMINTAAN</td> <td><select name="jnspermintaan">
          <option value="">- SEMUA -</option>
          <option value="Biasa">BIASA</option>
          <option value="Cadangan">CADANGAN</option>
          <option value="Siap Pakai">SIAP PAKAI</option>
          <option value="Cyto/Segera">CYTO/SEGERA</option>
      </select></td></tr>

<tr><td>SHIFT</td> <td><select name="gol_shift">
                        <option value="">PILIIH</option>
                        <option value="1">SHIFT I</option>
                        <option value="2">SHIFT II</option>
                        <option value="3">SHIFT III</option>
                        <option value="4">SHIFT IV</option>
                    </select></td>

    <td></td> <td align="right"><input type="submit" name="submit" value="Lihat" class="swn_button_blue"></td></tr></table>
</form>
<?



    
    $trans0=mysql_query("select * from v_antripk_batal
                         where date(tgl_register) between '$today' and '$today1'
                         $qbag $qnama $qrm $qform $qgol $qrh $qrs $qlyn $qproduk $qshift $qdiag $qminta
                          order by tgl_register desc");
                       
$rows=mysql_num_rows($trans0);
$rows2=mysql_num_rows($trans0);

echo'<br><b>';
echo 'Terdapat '.$rows ;
/*echo' data dari total ';
echo $rows2;*/
echo' data permintaan ';
echo $src_produk ;
echo'<b>';
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" >
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td rowspan=2 align="center">NO</td>
            <td rowspan=2 align="center">TGL MINTA</td>
            <td rowspan=2 align="center">TGL. BATAL</td>
            <td rowspan=2 align="center">NAMA PASIEN</td>
        <td rowspan=2 align="center">JENIS<br>KEL</td>
        <td rowspan=2 align="center">TGL LAHIR</td>
            <td rowspan=2 align="center">ALAMAT</td>
            <td rowspan=2 align="center">RUMAH SAKIT</td>
        <td rowspan=2 align="center">DIAGNOSA</td>
        <td rowspan=2 align="center">BAGIAN</td>
        <td rowspan=2 align="center">PERMINTAAN<br>PRODUK</td>
         <td rowspan=2 align="center">JENIS<br>LAYANAN</td>
            <td rowspan=2 align="center">GOL</td>
        <!--td rowspan=2 align="center">TGL DIPERLUKAN</td-->
        <td rowspan=2 align="center">JENIS BATAL</td>
        <td rowspan=2 align="center">KETERANGAN</td>
        <td rowspan=2 align="center">PETUGAS INPUT</td></tr>
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        </tr>
    <?
    $no=1;
    while ($trans=mysql_fetch_assoc($trans0)) {

        $norm= $trans[no_rm];?>
        <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="right"><?=$no++?>.</td>
            
            
            <td class=input nowrap><?=$trans[tgl_register]?></td>
            <td class=input nowrap><?=$trans[tgl]?></td>
                                            <td class=input><?=$trans[nama].' ('.$trans[umur].'thn)'?></td>
            <td class=input><?=$trans[kelamin]?></td>
            <td class=input><?=$trans[tgl_lahir]?></td>
            <td class=input><?=$trans[alamat]?></td>
            <td class=input><?=$trans[NamaRs]?></td>
            <td class=input><?=$trans[diagnosa]?></td>
            <td class=input><?=$trans[bagian]?></td>
            <td class=input nowrap><?=$trans[JenisDarah]?></td>
            <?
            $jenis=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$trans[jenis]'"));
                ?>
            <td class=input><?=$trans[nama]?></td>
            <td class=input><?=$dtrans[GolDarah].'('.$trans[rhesus].')'?></td>
            <!--td class=input><?=$trans[tglminta]?></td-->

            <? $jnsbtl='LAIN-LAIN';
            if ($trans[detail]=='1') $jnsbtl='PASIEN SEMBUH';
            if ($trans[detail]=='2') $jnsbtl='PASIEN MENINGGAL';
            if ($trans[detail]=='3') $jnsbtl='PERMINTAAN RUMAH SAKIT';
            if ($trans[detail]=='4') $jnsbtl='PERMINTAAN KELUARGA';
            ?>
            <td class=input><? echo $jnsbtl?></td>
            <td class=input><?=$trans[uraian]?></td>
            <td class=input><?=$trans[petugasb]?></td>
    </tr>
<?
}
?>
</table>
<br>
<form name=xls method=post action=modul/rekap_permintaan_harian_tpkbatal_xls.php>
      <input type=hidden name=today value='<?=$today?>'>
    <input type=hidden name=today1 value='<?=$today1?>'>
    <input type=hidden name=srcnama value='<?=$srcnama?>'>
    <input type=hidden name=srcrm value='<?=$srcrm?>'>
    <input type=hidden name=srcform value='<?=$srcform?>'>
    <input type=hidden name=src_abo value='<?=$src_abo?>'>
    <input type=hidden name=src_rh value='<?=$src_rh?>'>
    <input type=hidden name=src_rs value='<?=$src_rs?>'>
    <input type=hidden name=src_lyn value='<?=$src_lyn?>'>
    <input type=hidden name=src_diag value='<?=$src_diag?>'>
    <input type=hidden name=src_produk value='<?=$src_produk?>'>
    <input type=submit name=submit2 class="swn_button_red" value='Print Rekap Pembatalan (.XLS)'>
</form>
