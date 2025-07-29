<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIMDONDAR</title>
<?php
require_once('clogin.php');
require_once('config/dbi_connect.php');
$namauser=$_SESSION['namauser'];
$namalengkap=$_SESSION['nama_lengkap'];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
$s1=$s2=$s3=$s4="";
?>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script language=javascript src="util.js" type="text/javascript"> </script>

<style>
    tr { background-color: #ffffff;}
        .initial { background-color: #ffffff; color:#000000 }
        .normal { background-color: #ffffff; }
        .highlight { background-color: #7CFC00 }
    table {
        border-collapse: collapse;
        box-shadow: 4px 4px 8px grey;
    }
    table, th, td {
        border: 1px solid brown;
    }
</style>
<style>body {font-family: "Lato", sans-serif;}</style>
</head>

<body>
	<?php
		if (isset($_POST['waktu'])) {$tglawal=$_POST['waktu'];$hariini=$hariini;}
		if ($_POST['waktu1']!='') $hariini=$_POST['waktu1'];
        $status=$_POST['status'];
        $param = $_POST['param'];
            switch($param){
                case "4" : $wparam=" ";$h0="selected";break;
                case "0" : $wparam="  AND (`jenisPeriksa`='0') ";$h1="selected";break;
                case "1" : $wparam="  AND (`jenisPeriksa`='1') ";$h2="selected";break;
                case "2" : $wparam="  AND (`jenisPeriksa`='2') ";$h3="selected";break;
                case "3" : $wparam="  AND (`jenisPeriksa`='3') ";$h4="selected";break;
                default  : $wparam=" ";break;
            }
        switch($status){
            case "0" : $whasil=" ";$s1="selected";break;
            case "1" : $whasil="  AND (`Hasil`='0') ";$s2="selected";break;
            case "2" : $whasil="  AND (`Hasil`='2') ";$s3="selected";break;
            case "3" : $whasil="  AND (`Hasil`='1') ";$s4="selected";break;
            default  : $whasil=" ";break;
        }
	?>
    <a name="atas" id="atas"></a>
    <div style="background-color: #ffffff;font-size:20px; color:blue;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">RINCIAN PEMERIKSAAN UJI SARING <b>IMLTD</b></div><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<table cellpadding="5" cellspacing="5" style="border: none;">
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
				<td align="left" nowrap>Dari tanggal <input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size="10" style="font-family:monospace"></td>
				<td align="right" nowrap>sampai dengan tanggal <input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size="10" style="font-family:monospace"></td>
                <td align="right" nowrap>Status 
                    <select name="status" style="background-color: white; border: none;width: 4cm;padding: 3px;font-size: 12px;cursor: pointer;">
                        <option value="0" <?php echo $s1;?> >Semua</option>
                        <option value="1" <?php echo $s2;?>>Non Reaktif</option>
                        <option value="2" <?php echo $s3;?>>Greyzone</option>
                        <option value="3" <?php echo $s4;?>>Reaktif</option>
                    </select>
                </td>
                <td align="right" nowrap>Parameter
                    <select name="param" style="background-color: white; border: none;width: 4cm;padding: 3px;font-size: 12px;cursor: pointer;">
                        <option value="4" <?php echo $h0;?> >Semua</option>
                        <option value="0" <?php echo $h1;?>>HBsAg</option>
                        <option value="1" <?php echo $h2;?>>HCV</option>
                        <option value="2" <?php echo $h3;?>>HIV</option>
                        <option value="3" <?php echo $h4;?>>TPHA</option>
                    </select>
                </td>
				<td><input type=submit name=submit class="swn_button_red" value="Tampilkan data"><a href="#bawah" class="swn_button_blue">Ke bawah</a></td>
			</tr>
		</table>	
	</form>

    <div style="background-color: #ffffff;font-size:18px; color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Metode Chlia</div>
	<table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
  	        <th rowspan="3">NO.</th>
            <th rowspan="3">Tanggal</th>
            <th rowspan="3">No.Trans</th>
            <th rowspan="3">No Kantong/<br>Sample</th>
	        <th colspan="12">HASIL PEMERIKSAAN IMLTD</th>
	        <th colspan="3">DONASI</th>
            <th rowspan="3">Pemeriksa</th>
            <th rowspan="3">Checker</th>
            <th rowspan="3">Pengesahan</th>
		</tr>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th colspan="3">HBsAG</th>
            <th colspan="3">Anti-HCV</th>
            <th colspan="3">Anti-HIV</th>
            <th colspan="3">Syphilis/TPHA</th>
            <th rowspan="2">DS/<br>DP</th>
            <th rowspan="2">Baru/<br>Ulang</th>
            <th rowspan="2">Umur</th>
        </tr>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
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
	$sql_s="SELECT
            h.`notrans`,
            h.`tglPeriksa`,
            h.`noKantong`,
            h.`dicatatOleh`,
            h.`dicekOleh`,
            h.`DisahkanOleh`,
            h.`OD` as nilai,
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
    $sql_w=" WHERE date(h.`tglPeriksa`)>='$tglawal' and date(h.`tglPeriksa`)<='$hariini'";
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
    // echo $sql;
    $hasil_b="";$hasil_c="";$Hasil_i="";$hasil_s="";
	$qraw=mysqli_query($dbi,$sql);
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
        <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td align="right"><?=$no.'.'?></td>
	    <td align="center" nowrap><?=$tmp['tglPeriksa']?></td>
            <td align="center" nowrap><?=$tmp['notrans']?></td>
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
	        <td align="center" nowrap><?=$tmp['jns_donor']?></td>
            <td align="center" nowrap><?=$tmp['baru_ulang']?></td>
            <td align="center" nowrap><?=$tmp['umur']?></td>
            <td align="center" nowrap><?=$tmp['dicatatOleh']?></td>
            <td align="center" nowrap><?=$tmp['dicekOleh']?></td>
            <td align="center" nowrap><?=$tmp['DisahkanOleh']?></td>
	 </tr>
	<?php }
	if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	        <td colspan=31 align="center">Tidak ada data pemeriksaan IMLTD</td>
        </tr>
	<?}?>
    </table>
    <br><br>
    <?php
    if ($no>0){
       echo '<a href="#atas" class="swn_button_blue">Ke Atas</a>';
       echo '<a href="modul/rincian_pemeriksaan_imltd_elisa_xls.php?t1='.$tglawal.'&t2='.$hariini.'&st='.$status.'" class="swn_button_blue" >Export ke Excel</a>';
    }
    ?>
    <a name="bawah" id="bawah"></a>
    <br><br>
	<div style="font-size: 12px;color: #f00000;text-shadow: 0px 0px 1px #000000;">Keterangan : NR (Non Reaktif); R (Reaktif); GZ (Greyzone)</div>
</body>
</html>

