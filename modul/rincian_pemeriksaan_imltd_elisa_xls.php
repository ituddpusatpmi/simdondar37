<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rincian_imltd.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once('../config/dbi_connect.php');
$utd		= mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif=1"));
$namautd	= $utd['nama'];
$namauser   = $_SESSION['namauser'];
$v_tgl1    	= $_GET['t1'];
$v_tgl2    	= $_GET['t2'];
$v_status	= $_GET['st'];
$v_param    = $_GET['pr'];
switch($v_status){
    case "0" : $whasil=" ";break;
    case "1" : $whasil="  AND (`Hasil`='0') ";break;
    case "2" : $whasil="  AND (`Hasil`='2') ";break;
    case "3" : $whasil="  AND (`Hasil`='1') ";break;
    default  : $whasil=" ";break;
}
switch($v_param){
    case "4" : $wparam=" ";$h0="selected";break;
    case "0" : $wparam="  AND (`jenisPeriksa`='0') ";break;
    case "1" : $wparam="  AND (`jenisPeriksa`='1') ";break;
    case "2" : $wparam="  AND (`jenisPeriksa`='2') ";break;
    case "3" : $wparam="  AND (`jenisPeriksa`='3') ";break;
    default  : $wparam=" ";break;
}
$sql_s="SELECT
            h.`notrans`,
            h.`tglPeriksa`,
            h.`noKantong`,
            h.`dicatatOleh`,
            h.`dicekOleh`,
            h.`DisahkanOleh`,
            h.`umur`,
            case when h.`jns_donor`='0' then 'DS' 
	         when h.`jns_donor`='1' then 'DP 'else '' end as `jns_donor`,
            case when h.`baru_ulang`='1' then 'Ulang' 
 	         when h.`baru_ulang`='0' then 'Baru' else '' end as `baru_ulang`,
            MAX(Case when h.`jenisPeriksa`='0' Then `OD` else null end) as OD_B,
            MAX(Case when h.`jenisPeriksa`='1' Then format(`OD`,3,'id_ID') else null end) as OD_C,
            MAX(Case when h.`jenisPeriksa`='2' Then format(`OD`,3,'id_ID') else null end) as OD_I,
            MAX(Case when h.`jenisPeriksa`='3' Then `OD` else null end) as OD_S,
            MAX(Case when h.`jenisPeriksa`='0' Then `Hasil` else null end) as H_B,
            MAX(Case when h.`jenisPeriksa`='1' Then `Hasil` else null end) as H_C,
            MAX(Case when h.`jenisPeriksa`='2' Then `Hasil` else null end) as H_I,
            MAX(Case when h.`jenisPeriksa`='3' Then `Hasil` else null end) as H_S,
            MAX(Case when h.`jenisPeriksa`='0' Then `Metode` else null end) as M_B,
            MAX(Case when h.`jenisPeriksa`='1' Then `Metode` else null end) as M_C,
            MAX(Case when h.`jenisPeriksa`='2' Then `Metode` else null end) as M_I,
            MAX(Case when h.`jenisPeriksa`='3' Then `Metode` else null end) as M_S
            FROM `hasilelisa` h ";
    $sql_w=" WHERE date(h.`tglPeriksa`)>='$v_tgl1' and date(h.`tglPeriksa`)<='$v_tgl2'";
    $sql_gb=" GROUP BY
                h.`notrans`,
                h.`tglPeriksa`,
                h.`noKantong`,
                h.`dicatatOleh`,
                h.`dicekOleh`,
                h.`DisahkanOleh`,
                h.`umur`, h.`jns_donor`,h.`baru_ulang`	";
	$no=0;
    $sql=$sql_s.$sql_w.$whasil.$wparam.$sql_gb;
    $qraw=mysqli_query($dbi,$sql);
?>
<font size="5" color=black><b>RINCIAN PEMERIKSAAN IMLTD</b><br>
<font size="5" color=black><b><?=$namautd;?></b><br>
<font size="5" color=black><b>Tanggal : <?=$v_tgl1.' s/d '.$v_tgl2;?></b><br>
<table border=1 cellpadding=4  style="border-collapse:collapse">
    <tr style="background-color:darkgrey; font-size:11px; color:#000000;">
        <th rowspan="3">NO.</th>
        <th rowspan="3">Tanggal</th>
        <!--th rowspan="3">No.Trans</th-->
        <th rowspan="3">No Kantong/<br>Sample</th>
        <th colspan="12">HASIL PEMERIKSAAN IMLTD</th>
        <!--th colspan="3">DONASI</th-->
        <th rowspan="3">Pemeriksa</th>
        <!--th rowspan="3">Checker</th-->
        <th rowspan="3">Pengesahan</th>
    </tr>
    <tr style="background-color:darkgrey; font-size:11px; color:#000000;">
        <th colspan="3">HBsAG</th>
        <th colspan="3">Anti-HCV</th>
        <th colspan="3">Anti-HIV</th>
        <th colspan="3">Syphilis/TPHA</th>
        <!--th rowspan="2">DS/<br>DP</th-->
        <!--th rowspan="2">Baru/<br>Ulang</th-->
        <!--th rowspan="2">Umur</th-->
    </tr>
    <tr style="background-color:darkgrey; font-size:11px; color:#000000;">
        <th>OD</th>
        <th>Hasil</th>
        <th>Metode</th>            
        <th>OD</th>
        <th>Hasil</th>
        <th>Metode</th>            
        <th>OD</th>
        <th>Hasil</th>
        <th>Metode</th>            
        <th>OD</th>
        <th>Hasil</th>
        <th>Metode</th>            
    </tr>
    <?php
    while($tmp=mysqli_fetch_assoc($qraw)){
        $no++;
        switch($tmp['H_B']){
            case '0' : $hasil_b='NR';   $bg_b="";break;
            case '1' : $hasil_b='R';    $bg_b="background-color:#ff0000;color:#ffffff;";break;
            case '2' : $hasil_b='GZ';   $bg_b="background-color:#ff9900;color:#ffffff;";break;
            default  : $hasil_b='';     $bg_b="color:#000000;";break;
        }
        switch($tmp['H_C']){
            case '0' : $hasil_c='NR';   $bg_c="";break;
            case '1' : $hasil_c='R';    $bg_c="background-color:#ff0000;color:#ffffff;";break;
            case '2' : $hasil_c='GZ';   $bg_c="background-color:#ff9900;color:#ffffff;";break;
            default  : $hasil_c='';     $bg_c="color:#ffffff;";break;
        }
        switch($tmp['H_I']){
            case '0' : $hasil_i='NR';   $bg_i="";break;
            case '1' : $hasil_i='R';    $bg_i="background-color:#ff0000;color:#ffffff;";break;
            case '2' : $hasil_i='GZ';   $bg_i="background-color:#ff9900;color:#ffffff;";break;
            default  : $hasil_i='';     $bg_i="color:#ffffff;";break;
        }
        switch($tmp['H_S']){
            case '0' : $hasil_s='NR';   $bg_s="";break;
            case '1' : $hasil_s='R';    $bg_s="background-color:#ff0000;color:#ffffff;";break;
            case '2' : $hasil_s='GZ';   $bg_s="background-color:#ff9900;color:#ffffff;";break;
            default  : $hasil_s='';     $bg_s="color:#ffffff;";break;
        }
        ?>
        <tr style="font-size:10px; color:#000000; font-family:Verdana;">
	    <td align="right"><?=$no.'.'?></td>
	    <td align="center" nowrap><?=$tmp['tglPeriksa']?></td>
            <!--td align="center" nowrap><?=$tmp['notrans']?></td-->
            <td align="left" nowrap><?=$tmp['noKantong']?></td>
            <td align="center" nowrap style="<?php echo $bg_b;?>"><?=$tmp['OD_B']?></td>
            <td align="center" nowrap style="<?php echo $bg_b;?>"><?=$hasil_b?></td>
            <td align="center" nowrap style="<?php echo $bg_b;?>"><?=$tmp['M_B']?></td>
            <td align="center" nowrap style="<?php echo $bg_c;?>"><?=$tmp['OD_C']?></td>
            <td align="center" nowrap style="<?php echo $bg_c;?>"><?=$hasil_c?></td>
            <td align="center" nowrap style="<?php echo $bg_c;?>"><?=$tmp['M_C']?></td>
            <td align="center" nowrap style="<?php echo $bg_i;?>"><?=$tmp['OD_I']?></td>
            <td align="center" nowrap style="<?php echo $bg_i;?>"><?=$hasil_i?></td>
            <td align="center" nowrap style="<?php echo $bg_i;?>"><?=$tmp['M_I']?></td>
            <td align="center" nowrap style="<?php echo $bg_s;?>"><?=$tmp['OD_S']?></td>
            <td align="center" nowrap style="<?php echo $bg_s;?>"><?=$hasil_s?></td>
            <td align="center" nowrap style="<?php echo $bg_s;?>"><?=$tmp['M_S']?></td>
	    <!--td align="center" nowrap><?=$tmp['jns_donor']?></td-->
            <!--td align="center" nowrap><?=$tmp['baru_ulang']?></td-->
            <!--td align="center" nowrap><?=$tmp['umur']?></td-->
            <td align="center" nowrap><?=$tmp['dicatatOleh']?></td>
            <!--td align="center" nowrap><?=$tmp['dicekOleh']?></td-->
            <td align="center" nowrap><?=$tmp['DisahkanOleh']?></td>
	 </tr>
    <?php
    } ?>
</table>
