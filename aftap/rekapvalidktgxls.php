<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=validasi_kantong.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once('clogin.php');
require_once('config/db_connect.php');

$v_tgl1        =$_GET[tgl1];
$v_tgl2        =$_GET[tgl2];
$v_merk        =$_GET[mrk];
$v_vol         =$_GET[vol];
$v_stts        =$_GET[stts];
    
    if ($_POST[$v_merk]!='') {
        $merk   = $_POST[$v_merk];
        $qmerk  = " AND ValidKantong.merk = '$merk' ";
        } else {$qmerk    ="";}
    
    if ($_POST[$v_vol]!='') {
        $volktg   = $_POST[$v_vol];
        $qvolktg  = " AND ValidKantong.vol = '$volktg' ";
        } else {$qvolktg    ="";}
    
    if ($_POST[$v_stts]!='') {
        $status   = $_POST[$v_stts];
        $qstatus  = " AND ValidKantong.keterangan like '%$status%' ";
        } else {$qstatus    ="";}

?>

<font size="4" color=00008B>RINCIAN <b>VALIDASI KANTONG</b></font><br><br>
<table border=0 cellpadding=4>
<tr>
        <th rowspan="2">NO.</th>

        <th colspan="4">KANTONG DARAH</th>

        <th colspan="6">TRANSAKSI DONOR</th>

        <th colspan="3">LABEL<br>BARCODE</th>

        <th colspan="9">VALIDASI KANTONG DARAH</th>

        <th rowspan="2">HASIL</th>
        </tr>
        <tr>
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
"WHERE DATE(on_insert)>='$v_tgl1' AND date(on_insert)<='$v_tgl2' and ValidKantong.keterangan like '%$status%' $qmerk $qvolktg order by on_insert asc";

        /*$sql="SELECT\n".
        "pmi.ValidKantong.*,\n".
        "pmi.stokkantong.volume,\n".
        "pmi.stokkantong.tglbeli\n".
        "FROM\n".
        "pmi.ValidKantong\n".
        "JOIN pmi.stokkantong\n".
        "ON pmi.ValidKantong.noKantong = pmi.stokkantong.noKantong\n".
        "WHERE DATE(on_insert)>='$v_tgl1' AND date(on_insert)<='$v_tgl2' $qstatus $qmerk $qvolktg  order by on_insert asc";*/
        //echo $sql;
    
    $qraw=mysql_query($sql);
    $statusrelease='';
    while($tmp=mysql_fetch_assoc($qraw)){$no++;

        ?>
        <tr style="font-size:11px; color:#000000; font-family:Verdana;">
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
    </table>

