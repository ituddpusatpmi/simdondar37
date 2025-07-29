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



    
    $trans0=mysql_query("select * from v_antripk_sudah
                         where date(tgl_register) between '$today' and '$today1'
                         $qbag $qnama $qrm $qform $qgol $qrh $qrs $qlyn $qproduk $qshift $qdiag $qminta
                         and `status` = '3'
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
            <td rowspan=2 align="center">NO FORM</td>
        <td rowspan=2 align="center">AKSI</td>
            <td rowspan=2 align="center">TGL MINTA</td>
        <td rowspan=2 align="center">NO. RM</td>
            <td rowspan=2 align="center">NAMA PASIEN</td>
        <td rowspan=2 align="center">JENIS<br>KEL</td>
        <td rowspan=2 align="center">TGL LAHIR</td>
            <td rowspan=2 align="center">ALAMAT</td>
            <td rowspan=2 align="center">RUMAH SAKIT</td>
        <td rowspan=2 align="center">DIAGNOSA</td>
        <td rowspan=2 align="center">BAGIAN</td>
        <td rowspan=2 align="center">KLAS</td>
         <td rowspan=2 align="center">JENIS<br>LAYANAN</td>
            <td rowspan=2 align="center">GOL</td>
        <!--td rowspan=2 align="center">TGL DIPERLUKAN</td-->
        <td rowspan=2 align="center">JENIS DARAH/JML</td>
            <td colspan=2 align="center">STATUS</td>
        <td rowspan=2 align="center">JENIS<br>PERMINTAAN</td>
        <td rowspan=2 align="center">SHIFT</td>
        <!--td rowspan=2 align="center">TEMPAT</td-->
        <td rowspan=2 align="center">PETUGAS INPUT</td></tr>
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td>BAWA</td>
        <td>TITIP</td></tr>
    <?
    $no=1;
    while ($trans=mysql_fetch_assoc($trans0)) {
        $norm= $trans[no_rm];
        if ($trans['status']=='0'){?>
        <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                                            <?} elseif ($trans['status']=='3') {?>
        <tr style="background-color:#f7b75e; font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                                            <?} else {?>
        <tr style="background-color:#89f0eb; font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                                            <?}
        ?>
        <!--tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"-->
            <td align="right"><?=$no++?>.</td>
            <?
                                            $bawa = $trans[bawa];
                                            $titip = $trans[titip];
            $total=$bawa+$titip;
            if ($_SESSION[leveluser]=='laboratorium' or $_SESSION[leveluser]=='bdrs') {
                if ($total==0) {
                    if ($_SESSION[leveluser]=='laboratorium') echo "<td class=input><a href=pmilaboratorium.php?module=crossmatch&noform=$trans[noform]>$trans[noform]</a></td>";
                    if ($_SESSION[leveluser]=='bdrs') echo "<td class=input><a href=pmibdrs.php?module=crossmatch&noform=$trans[noform]>$trans[noform]</a></td>";
                } else {?>
                    <td class=input><?=$trans[noform]?></td><?
                }
            } else {
                if ($_SESSION[leveluser]=='kasir2' or $_SESSION[leveluser]=='bdrs') {
                    
                    if ($titip>0) {
                        echo "<td class=input><a href=pmikasir2.php?module=pembayaran&noform=$trans[noform]>$trans[noform]</a></td>";
                    } else {?>
                        <td class=input><?=$trans[noform]?></td><?
                    }
                } else {?>
                    <td class=input><?=$trans[noform]?></td><?
                }
            }
            if ($_SESSION[leveluser]=='kasir2') {?>
            <td><input type="button" class="swn_button_blue" onclick="location.href = 'idpasien_barcode2.php?idpendonor=<?=$trans['noform']?>';" value="cetak"> &nbsp;
                <a href="pmikasir2.php?module=batalminta&notrans=<?=$trans['noform']?>"><input type="button"  class="swn_button_red" onclick="return confirm('Batalkan Permintaan Darah <?=$trans['noform']?> ?')" value="batal"/></a> &nbsp;
                <a href="pmikasir2.php?module=bookminta&notrans=<?=$trans['noform']?>"><input type="button" class="swn_button_green" onclick="" value="note"></a></td>
            <?} else {?>
            <td>
            <a href="pmilaboratorium.php?module=batalminta&notrans=<?=$trans['noform']?>"><input type="button"  class="swn_button_red" onclick="return confirm('Batalkan Permintaan Darah <?=$trans['noform']?> ?')" value="batal"/></a> &nbsp;
                    <?}?>
            <?  if ($_SESSION[leveluser]=='kasir2') {?>
            <td class=input nowrap><?=$trans[tgl_register]?><br><br>
                <? if($trans[sampel]=="0"){?>
                <a href="pmikasir2.php?module=sampel&noform=<?=$trans['noform']?>&nama=<?=$trans['nama']?>&gol=<?=$trans[gol_darah]?>&rs=<?=$trans[NamaRs]?>"><input type="button" class="swn_button_green" onclick="return confirm('Terima Sampel Darah Pasien ?')" value="Terima Sampel"></a></td>
                                            <?} else{
                echo "<font size='1' color='BLACK'>SAMPEL DARAH :<br>$trans[tgl_sampel]</font>";
                                            }?>
                </td>
                                            <?} else {?>
            <td class=input nowrap><?=$trans[tgl_register]?><br><br>
                <? if($trans[sampel]=="1"){
                echo "<font size='1' color='RED'>SAMPEL DARAH :<br>$trans[tgl_sampel]</font>";
                                            } else {?>
                <a href="pmilaboratorium.php?module=sampel&noform=<?=$trans['noform']?>&nama=<?=$trans['nama']?>&gol=<?=$trans[gol_darah]?>&rs=<?=$trans[NamaRs]?>"><input type="button" class="swn_button_green" onclick="return confirm('Terima Sampel Darah Pasien ?')" value="Terima Sampel"></a></td>
                                            <?}?>
            </td>
            <?}?>
            <td class=input><?=$trans[no_rm]?><br>No. Dok : <font size="4" color="BLUE"><?=$trans[ID]?></font></td>
            <td class=input><?=$trans[nama]?></td>
            <td class=input><?=$trans[kelamin]?></td>
            <td class=input><?=$trans[tgl_lahir]?></td>
            <td class=input><?=$trans[alamat]?></td>
            
            <td class=input><?=$trans[NamaRs]?></td>
            <td class=input><?=$trans[diagnosa]?></td>
            <td class=input><?=$trans[bagian]?></td>
            <td class=input nowrap><?=$trans[kelas]?></td>
            
            <td class=input><?=$trans[namalayanan]?></td>
            <td class=input><?=$trans[gol_darah].'('.$trans[rhesus].')'?></td>
            <!--td class=input><?=$trans[tglminta]?></td-->
            <td class=input><?=$trans[produk]?></td>
            <td class=input><?=$bawa?></td>
            <td class=input><?=$titip?></td>
            <? $shif3='';
            if ($trans[shift]=='1') $shif3='I';
            if ($trans[shift]=='2') $shif3='II';
            if ($trans[shift]=='3') $shif3='III';
            if ($trans[shift]=='4') $shif3='IV';
             ?>
            <?
            if ($nat0[statnat]=='1') $nat1='(NAT)';
            if ($nat0[statnat]=='0') $nat1='';
            ?>
            <td class=input align=center><?=$trans[jenis_permintaan].' '.$nat1?></td>
            <td class=input><? echo $shif3?></td>
            <!--td class=input><?=$trans[tempat]?></td-->
            <td class=input><?=$trans[petugas]?></td>
    </tr>
<?
}
?>
</table>
<br>
    <table>
            <td style="background-color: #FFFFFF;"><div style="background-color: #89f0eb;  border: 1px solid #000000; height: auto; margin: 10px 0px; padding: 5px; text-align: center; width: 10px;"></div></td>
            <td style="background-color: #FFFFFF;">: ada catatan</td>
            <td style="background-color: #FFFFFF;"></td>
            <td style="background-color: #FFFFFF;"><div style="background-color: #fffcab;  border: 1px solid #000000; height: auto; margin: 10px 0px; padding: 5px; text-align: center; width: 10px;"></div></td>
            <td style="background-color: #FFFFFF;">: tanpa catatan</td>
            <td style="background-color: #FFFFFF;"></td>
            <td style="background-color: #FFFFFF;"><div style="background-color: #f7b75e;  border: 1px solid #000000; height: auto; margin: 10px 0px; padding: 5px; text-align: center; width: 10px;"></div></td>
            <td style="background-color: #FFFFFF;">: permintaan selesai</td>
                                           
    </table>
            
<form name=xls method=post action=modul/rekap_permintaan_harian_xls.php>
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
    <input type=submit class="swn_button_green" name=submit2 value='Print Rekap permintaan harian (.XLS)'>
</form>
