<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
?>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script language=javascript src="util.js" type="text/javascript"> </script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<style>
    tr { background-color: #ffffff;}
    .initial { background-color: #ffffff; color:#000000 }
    .normal { background-color: #ffffff; }
    .highlight { background-color: #7CFC00 }
</style>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid brown;
    }
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<style>body {font-family: "Lato", sans-serif;}</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIMDONDAR</title>
</head>

<body>
    <?
        if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
        if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
        $status=$_POST['status'];
    
    if ($_POST[merk]!='') {
        $merk   = $_POST[merk];
        $qmerk  = " AND ValidKantong.merk = '$merk' ";
        } else {$qmerk    ="";}
    
    if ($_POST[volktg]!='') {
        $volktg   = $_POST[volktg];
        $qvolktg  = " AND ValidKantong.vol = '$volktg' ";
        } else {$qvolktg    ="";}
    
        
    ?>
    <a name="atas" id="atas"></a>
    <font size="4" color=00008B>RINCIAN <b>VALIDASI KANTONG DARAH</b></font><br><br>
    <form name="cari" method="POST" action="<?echo $PHPSELF?>">
        <table cellpadding=1 cellspacing="0" border="0">
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <td align="left" nowrap>Tanggal <input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size="10" style="font-family:monospace"></td>
                <td align="right" nowrap>s/d <input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size="10" style="font-family:monospace"></td>
                <!--td align="right" nowrap>Inisial Petugas <input name="petugas" id="petugas" value="<?=$petugas?>" type=text size="10" style="font-family:monospace"></td-->
                
    
                <td align="right" nowrap>Merk Kantong
                <select name="merk" >
                    <option value=""<?=$select?>>SEMUA</option>
                          <?php
                          $q="select merk from master_kantong group by merk";
                          $do=mysql_query($q,$con);
                          while($data=mysql_fetch_assoc($do)){
                               $select="";
                          ?>
                     <option value="<?=$data[merk]?>"<?=$select?>>
                          <?=$data[merk]?>
                     </option>
                          <?}?>
                </select>
                </td>
    
                <td align="right" nowrap>Volume Kantong
                <?
                    $sel4='';$sel5='';$sel6='';
                    switch ($status){
                        case '':$sel6='selected';break;
                        case '350':$sel4='selected';break;
                        case '450':$sel5='selected';break;
                    }
                ?>
                <select name="volktg" class="styled-select">
                        <option value="350" <?=$sel4?>>350</option>
                        <option value="450" <?=$sel5?>>450</option>
                        <option value=""  <?=$sel6?>>SEMUA</option>
                </select>

                </td>
    
                <td align="right" nowrap>Status Validasi
                <?
                    $sel1='';$sel2='';$sel3='';
                    switch ($status){
                        case '':$sel3='selected';break;
                        case '0':$sel2='selected';break;
                        case '1':$sel1='selected';break;
                    }
                ?>
                <select name="status" class="styled-select">
                        <option value="1" <?=$sel1?>>LULUS</option>
                        <option value="0" <?=$sel2?>>TIDAK LULUS</option>
                        <option value=""  <?=$sel3?>>SEMUA</option>
                </select>

                </td>
                
                <td><input type=submit name=submit class="swn_button_blue" value="Tampilkan data">
                    <a href="#bawah" class="swn_button_blue">Ke bawah</a>
                    <a href="pmiaftap.php?module=rekap"class="swn_button_blue">Kembali</a></td>
            </tr>
        </table>
    </form>
    <table border=1 cellpadding=4  style="border-collapse:collapse">
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th rowspan="2">NO.</th>
            
            <th colspan="4">KANTONG DARAH</th>
            
            <th colspan="6">TRANSAKSI DONOR</th>
    
            <th colspan="3">LABEL<br>BARCODE</th>
    
            <th colspan="9">VALIDASI KANTONG DARAH</th>
    
            <th rowspan="2">HASIL</th>
        </tr>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th>No. Kantong</th>
            <th>Merk</th>
            <th>Jenis</th>
            <th>Volume</th>
    
            <th>Tanggal</th>
            <th>No. Transaksi</th>
            <th>Gol Darah</th>
            <th>Rhesus</th>
            <th>No. Meja</th>
            <th>Shift</th>
    
            <th>Jumlah</th>
            <th>Pakai</th>
            <th>Musnah</th>
    
            <th>Barcode Kantong identik dengan nomor selang</th>
            <th>Kantong Darah belum melewati tanggal kadaluwarsa</th>
            <th>Tidak ada tanda kebocoran kantong dan selang</th>
            <th>Volume Antikoagulan cukup dan tidak keruh</th>
            <th>Selang dan Kantong darah tidak memiliki cacat fisik</th>
            <th>Terdapat keterangan volume kantong</th>
            <th>Terdapat keterangan jenis Antikoagulan</th>
            <th>Terdapat keterangan nomor lot</th>
            <th>Jarum pada kantong darah dalam kondisi baik dan tajam</th>
    
            
        </tr>

    <?php
    $no=0;
    $sql="SELECT\n".
    "pmi.ValidKantong.*,\n".
    "pmi.stokkantong.gol_darah,\n".
    "pmi.stokkantong.RhesusDrh\n".
    "FROM\n".
    "pmi.ValidKantong\n".
    "JOIN pmi.stokkantong\n".
    "ON pmi.ValidKantong.noKantong = pmi.stokkantong.noKantong\n".
    "WHERE DATE(on_insert)>='$tglawal' AND date(on_insert)<='$hariini' and ValidKantong.keterangan like '%$status%' $qmerk $qvolktg order by on_insert asc";
    //echo $sql;
    
    
    //echo "$sql";
    $qraw=mysql_query($sql);
    $statusrelease='';
    while($tmp=mysql_fetch_assoc($qraw)){$no++;
    if ($tmp['jenis']=='1'){$ktg='Single';}else if ($tmp['jenis']=='2'){$ktg='Double';}else if ($tmp['jenis']=='3'){$ktg='Triple';}else{$ktg='Quadruple';}
        
        ?>
        <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="right"><?=$no.'.'?></td>
        
            <td align="left"><?=$tmp['noKantong']?></td>
            <td align="left" nowrap><?=$tmp['merk']?></td>
            <td align="left" nowrap><?=$ktg?></td>
            <!--td align="center" nowrap><?=$tmp['jenis']?></td-->
            <td align="left" nowrap><?=$tmp['vol']?></td>
        
            <td align="left" nowrap><?=$tmp['on_insert']?></td>
            <td align="left" nowrap><?=$tmp['NoTrans']?></td>
            <td align="left" nowrap><?=$tmp['gol_darah']?></td>
            <td align="left" nowrap><?=$tmp['RhesusDrh']?></td>
            <td align="left" nowrap><?=$tmp['meja']?></td>
            <td align="left" nowrap><?=$tmp['shift']?></td>
            
            <td align="left" nowrap><?=$tmp['jum_bc']?></td>
            <td align="left" nowrap><?=$tmp['jum_bcpakai']?></td>
            <td align="left" nowrap><?=$tmp['jum_bcmusnah']?></td>
        
            <?if ($tmp['v_1']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_2']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_3']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_4']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_5']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_6']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_7']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_8']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['v_9']=='1'){?><td align="center">&radic;</td><?}else{?><td align="center" bgcolor="red"><font color="white">X</font></td><?}?>
            <?if ($tmp['keterangan']=='1'){?><td align="center"><b>VALID</b></td><?}else{?><td align="center" bgcolor="red"><font color="white"><b>INVALID</b></font></td><?}?>
        </tr>
    <?}
    if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan=31 align="center">Tidak ada data validasi kantong</td>
    <?}?>
    </table><br>
    <a href="pmiaftap.php?module=rekap"class="swn_button_blue">Kembali</a>
    <?
        if ($no!==0){
        ?><a href="pmiaftap.php?module=excell_validktg&tgl1=<?=$tglawal?>&tgl2=<?=$hariini?>&stts=<?=$status?>&mrk=<?=$merk?>&vol=<?=$volktg?>" class="swn_button_blue">Export ke Excel</a>
          <!--a href="pmiqa.php?module=print_rekap&tgl1=<?=$tglawal?>&tgl2=<?=$hariini?>&stts=<?=$status?>&ptgs=<?=$petugas?>" class="swn_button_blue">Cetak</a-->
            
            <a href="pmiaftap.php?module=cetak_validktg&tgl1=<?=$tglawal?>&tgl2=<?=$hariini?>&stts=<?=$status?>&mrk=<?=$merk?>&vol=<?=$volktg?>" class="swn_button_blue">Cetak Laporan</a>
            
            <?
        }
    ?>
    <a href="#atas" class="swn_button_blue">Ke Atas</a>
    <a name="bawah" id="bawah"></a>
    <?
?>
</body>
</html>

