<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style>
    .awesomeText {
        color: #000;
        font-size: 150%;
    }
</style>
<style type="text/css">
    @import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
    .normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>
<style>
    td {font-family: "Arial", Verdana, serif;}
    tr th {font-family: "Arial", Verdana, serif;}
</style>
<body OnLoad="document.mintadarah1.minta1.focus();">
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$ket="";
if (!empty($_POST[submit])) {
    $nkt=$_POST[minta1];
    $ket= 'ID Sample: '.$nkt;
    $no_kantong0=substr($nkt,0,-1);
    $komponen0=mysql_query("select * from stokkantong where nokantong like '$no_kantong0%' order by noKantong ASC");
} else {
	$ket="";
}?>

<color="blue" class="awesomeText"><b>DETAIL PEMERIKSAAN IMLTD <?=$ket?></b><br>
<div>
    <form name=mintadarah1 method=post> Masukkan ID Sample : <INPUT type="text"  name="minta1"  size='23' required>
    <input type=submit name=submit value=Submit class="swn_button_blue">
</form></div>

DATA KANTONG<br>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th rowspan='2'>No</th>
        <th rowspan=2>No Kantong</th>
        <th rowspan=2>Asal</th>
        <th rowspan=2>Merk</th>
        <th rowspan=2'>Jenis</th>
        <th rowspan=2>Produk</th>
        <th rowspan=2>Vol(ml)</th>
        <th rowspan=2>Golda</th>
        <th colspan=2 rowspan="2">Status</th>
        <th colspan=6>Tanggal</th>
        <th rowspan=2>Pengesahan</th>
        <th rowspan=2>KGD</th>
    </tr>
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th>Aftap</th>
        <th>IMLTD</th>
        <th>Komponen</th>
        <th>ED</th>
        <th>Keluar</th>
        <th>Musnah</th>
    </tr>
    <?

    $no="1";

    while ($komponen=mysql_fetch_assoc($komponen0)) {
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td><?=$no++?></td>
            <td class=input><?=$komponen[noKantong]?></td>
            <?
            $asalutd=mysql_fetch_assoc(mysql_query("select nama from utd where id='$komponen[AsalUTD]'"));
            $utdintern=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'"));
            $bawa=mysql_fetch_assoc(mysql_query("select Status from dtransaksipermintaan where nokantong='$komponen[noKantong]'"));
            $utd=$asalutd[nama];
            if ($komponen[AsalUTD]==NULL) $utd=$utdintern[nama];
            ?>
            <td class=input><?=$utd?></td>
            <td class=input><?=$komponen[merk]?></td>
            <?
            switch ($komponen[Status]) {
                case 0 :
                    $ckt_status="Kosong";
                    if ($komponen[StatTempat]==NULL) $ckt_status="Kosong Di Logistik";
                    if ($komponen[StatTempat]=='0') $ckt_status="Kosong Di Logistik";
                    if ($komponen[StatTempat]=='1') $ckt_status="Kosong Di Aftap";
                    break;
                case 1:
                    $ckt_status="Aftap";
                    if ($komponen[sah]=='1') $ckt_status="Baru Isi/Karantina";
                    break;
                case 2:
                    $ckt_status="Sehat";
                    if (substr($komponen[stat2],0,1)=='b') $tempat=" (BDRS)";
                    break;
                case 3:
                    $ckt_status="Keluar_Bawa";
                    if ($bawa[Status]=='1') $ckt_status="Keluar_Titip";
                    break;
                case 4:
                    $ckt_status="Rusak";
                    break;
                case 5:
                    $ckt_status="Rusak-Gagal";
                    break;
                case 6:
                    $ckt_status="Dimusnahkan";
                    break;
            }
            switch($komponen[jenis]) {
                case '1':$jenis='Single';break;
                case '2':$jenis='Double';break;
                case '3':$jenis='Triple';break;
                case '4':$jenis='Quadruple';break;
                case '6':$jenis='Pediatrik';break;
                default:$jenis='';
            }
            ?>

            <td class=input><?=$jenis?></td>
            <td class=input><?=$komponen[produk]?></td>
            <td class=input align="right"><?=$komponen[volume]?></td>
            <td class=input><?=$komponen[gol_darah]?>(<?=$komponen[RhesusDrh]?>)</td>
            <td class=input><?=$ckt_status?></td>
            <?
            $bdrs=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$komponen[stat2]'"));
            $tujuan=mysql_fetch_assoc(mysql_query("select nama from utd where id='$komponen[stat2]'"));
            $tujuan1=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$komponen[stat2]'"));
            $rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$ttp1[rs]'"));
            if ($komponen[stat2]==NULL and $komponen[Status]==3) $rs="RS";
            if ($komponen[stat2]==NULL and $komponen[Status]!=3) $rs="";
            $buang=mysql_fetch_assoc(mysql_query("select * from ar_stokkantong where noKantong='$komponen[noKantong]'"));
            ?>
            <td class=input><?=$tujuan1[nama]?><?=$tujuan[nama]?><?=$rs?></td>
            <td class=input><?=$komponen[tgl_Aftap]?></td>
            <td class=input><?=$komponen[tglperiksa]?></td>
            <td class=input><?=$komponen[tglpengolahan]?></td>
            <td class=input><?=$komponen[kadaluwarsa]?></td>
            <td class=input><?=$komponen[tgl_keluar]?></td>
            <td class=input><?=$buang[tgl_buang]?></td>
            <?
            $sah='Belum';    if ($komponen[sah]=='1') $sah='Sudah';
            $konfirm='Belum';if ($komponen[statKonfirmasi]=='1') $konfirm='Sudah';
            ?>
            <td class=input><?=$sah?></td>
            <td class=input><?=$konfirm?></td>
        </tr>
    <?
    }
    if($no=="1"){
        ?><tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="18" class=input align="center">TIDAK ADA DATA KANTONG</td>
        </tr>
    <?
    }
    ?>
</table>
<?

//DATA PEMERIKSAAN IMLTD ELISA ==========================================================================================
$sq_elisa=mysql_query("SELECT `id`, `noKantong`, `OD`, `COV`, `notrans`,
                          case
                            when `jenisPeriksa`='0' then 'HBsAg'
                            when `jenisPeriksa`='1' then 'Anti HCV'
                            when `jenisPeriksa`='2' then 'Anti HIV'
                            when `jenisPeriksa`='3' then 'Syphilis' End As Parameter,
                          case
                            when `Hasil`='0' then 'Non Reaktif'
                            when `Hasil`='1' then 'Reaktif' 
                            when `Hasil`='2' then 'Grayzone'  End As Hasil,
                          `tglPeriksa`, `dicatatOleh`, `dicekOleh`, `DisahkanOleh`, `noLot`, `Metode`, `ulang`, `up_data`, `insert_on`
                          FROM `hasilelisa` WHERE `noKantong`='$nkt' and Metode='elisa' order by `id`");                       
?>
<br>DATA PEMERIKSAAN IMLTD METODE ELISA<br>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th rowspan="2">ID</th>
        <th rowspan="2">Kantong</th>
        <th rowspan="2">Transaksi</th>
        <th rowspan="2">Tanggal</th>
        <th rowspan="2">Parameter</th>
        <th rowspan="2">OD</th>
        <th rowspan="2">Hasil</th>
        <th colspan="3">Reagen</th>
        <th rowspan="2">Pencatat</th>
        <th rowspan="2">Di Cek</th>
        <th rowspan="2">Disahkan</th>
    </tr>
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th>Nama</th>
        <th>Lot</th>
        <th>ED</th>
    </tr>
    <?
    $no="0";
    while ($imltd=mysql_fetch_assoc($sq_elisa)){$no++;
        $sq_reagen=mysql_fetch_assoc(mysql_query("SELECT `Nama`, `noLot`, `tglKad`  FROM `reagen` WHERE kode='$imltd[noLot]'"));
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td class=input><?=$imltd[id]?></td>
            <td class=input><?=$imltd[noKantong]?></td>
            <td class=input><a href="pmiimltd.php?module=imltd_arc2000_cetakhasil&notrans=<?=$imltd[notrans]?>&nokantong=<?=$imltd[noKantong]?>&metode=elisa" target="blank"><?=$imltd[notrans]?></a></td>
            <td class=input><?=$imltd[tglPeriksa]?></td>
            <td class=input><?=$imltd[Parameter]?></td>
            <td class=input><?=$imltd[OD]?></td>
            <?if($imltd[Hasil]=="Non Reaktif"){?><td align="left"><font color="black"><?=$imltd[Hasil]?></font></td><?} else {?><td align="left"><font color="red"><?=$imltd[Hasil]?></font></td><?}?>
            <td class=input><?=$sq_reagen[Nama]?></td>
            <td class=input><?=$sq_reagen[noLot]?></td>
            <td class=input><?=$sq_reagen[tglKad]?></td>
            <td class=input><?=$imltd[dicatatOleh]?></td>
            <td class=input><?=$imltd[dicekOleh]?></td>
            <td class=input><?=$imltd[DisahkanOleh]?></td>
        </tr>
    <?}
    if ($no=="0"){
        ?><tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="13" class=input align="center">TIDAK ADA DATA PEMERIKSAAN IMLTD METODE ELISA</td>
        </tr>
    <?}
    ?>
</table>
<?


//DATA PEMERIKSAAN IMLTD CLIA ==========================================================================================
$sq_elisa=mysql_query("SELECT `id`, `noKantong`, `OD`, `COV`, `notrans`,
                          case
                            when `jenisPeriksa`='0' then 'HBsAg'
                            when `jenisPeriksa`='1' then 'Anti HCV'
                            when `jenisPeriksa`='2' then 'Anti HIV'
                            when `jenisPeriksa`='3' then 'Syphilis' End As Parameter,
                          case
                            when `Hasil`='0' then 'Non Reaktif'
                            when `Hasil`='1' then 'Reaktif' 
                            when `Hasil`='2' then 'Grayzone'  End As Hasil,
                          `tglPeriksa`, `dicatatOleh`, `dicekOleh`, `DisahkanOleh`, `noLot`, `Metode`, `ulang`, `up_data`, `insert_on`
                          FROM `hasilelisa` WHERE `noKantong`='$nkt' and Metode='clia' order by `id`");                       
?>
<br>DATA PEMERIKSAAN IMLTD METODE CLIA<br>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th rowspan="2">ID</th>
        <th rowspan="2">Kantong</th>
        <th rowspan="2">Transaksi</th>
        <th rowspan="2">Tanggal</th>
        <th rowspan="2">Parameter</th>
        <th rowspan="2">OD</th>
        <th rowspan="2">Hasil</th>
        <th colspan="3">Reagen</th>
        <th rowspan="2">Pencatat</th>
        <th rowspan="2">Di Cek</th>
        <th rowspan="2">Disahkan</th>
    </tr>
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th>Nama</th>
        <th>Lot</th>
        <th>ED</th>
    </tr>
    <?
    $no="0";
    while ($imltd=mysql_fetch_assoc($sq_elisa)){$no++;
        $sq_reagen=mysql_fetch_assoc(mysql_query("SELECT `Nama`, `noLot`, `tglKad`  FROM `reagen` WHERE noLot='$imltd[noLot]'"));
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td class=input><?=$imltd[id]?></td>
            <td class=input><?=$imltd[noKantong]?></td>
            <td class=input><a href="pmiimltd.php?module=imltd_arc2000_cetakhasil&notrans=<?=$imltd[notrans]?>&nokantong=<?=$imltd[noKantong]?>&metode=elisa" target="blank"><?=$imltd[notrans]?></a></td>
            <td class=input><?=$imltd[tglPeriksa]?></td>
            <td class=input><?=$imltd[Parameter]?></td>
            <td class=input><?=$imltd[OD]?></td>
            <?if($imltd[Hasil]=="Non Reaktif"){?><td align="left"><font color="black"><?=$imltd[Hasil]?></font></td><?} else {?><td align="left"><font color="red"><?=$imltd[Hasil]?></font></td><?}?>
            <td class=input><?=$sq_reagen[Nama]?></td>
            <td class=input><?=$sq_reagen[noLot]?></td>
            <td class=input><?=$sq_reagen[tglKad]?></td>
            <td class=input><?=$imltd[dicatatOleh]?></td>
            <td class=input><?=$imltd[dicekOleh]?></td>
            <td class=input><?=$imltd[DisahkanOleh]?></td>
        </tr>
    <?}
    if ($no=="0"){
        ?><tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="13" class=input align="center">TIDAK ADA DATA PEMERIKSAAN IMLTD METODE CLIA</td>
        </tr>
    <?}
    ?>
</table>



<?




//DATA PEMERIKSAAN IMLTD RAPID================================================================================================
$sq_rapid=mysql_query("SELECT `id`, `NoTrans`, `noKantong`, `Kontrol`,
						case
							when `jenisperiksa`='0' then 'HBsAg'
						    when `jenisperiksa`='1' then 'Anti HCV'
						    when `jenisperiksa`='2' then 'Anti HIV'
						    when `jenisperiksa`='3' then 'Syphilis' End As Parameter,
						 case
						    when `Hasil`='1' then 'Non Reaktif'
						    when `Hasil`='0' then 'Reaktif' End As Hasil,
						 `nolot`, `tgl_tes`, `dicatatoleh`, `dicekOleh`, `DisahkanOleh`, `Metode`, `ulang`, `up_data`
						FROM `drapidtest` WHERE `noKantong`='$nkt' order by `id`");
?>
<br>DATA PEMERIKSAAN IMLTD METODE RAPID<br>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th rowspan="2">ID</th>
        <th rowspan="2">Kantong</th>
        <th rowspan="2">Transaksi</th>
        <th rowspan="2">Tanggal</th>
        <th rowspan="2">Parameter</th>
        <th rowspan="2">Kontrol</th>
        <th rowspan="2">Hasil</th>
        <th colspan="3">Reagen</th>
        <th rowspan="2">Pencatat</th>
        <th rowspan="2">Di Cek</th>
        <th rowspan="2">Disahkan</th>
    </tr>
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th>Nama</th>
        <th>Lot</th>
        <th>ED</th>
    </tr>
    <?
    $no="0";
    while ($imltd_r=mysql_fetch_assoc($sq_rapid)){$no++;
        $sq_reagen=mysql_fetch_assoc(mysql_query("SELECT `Nama`, `noLot`, `tglKad`  FROM `reagen` WHERE kode='$imltd_r[nolot]'"));
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td class=input><?=$imltd_r[id]?></td>
            <td class=input><?=$imltd_r[noKantong]?></td>
            <td class=input><a href="pmiimltd.php?module=imltd_arc2000_cetakhasil&notrans=<?=$imltd_r[NoTrans]?>&nokantong=<?=$imltd_r[noKantong]?>&metode=rapid" target="blank"><?=$imltd_r[NoTrans]?></a></td>
            <td class=input><?=$imltd_r[tgl_tes]?></td>
            <td class=input><?=$imltd_r[Parameter]?></td>
            <td class=input><?=$imltd_r[Kontrol]?></td>
            <?if($imltd_r[Hasil]=="Non Reaktif"){?><td align="left"><font color="black"><?=$imltd_r[Hasil]?></font></td><?} else {?><td align="left"><font color="red"><?=$imltd_r[Hasil]?></font></td><?}?>
            <td class=input><?=$sq_reagen[Nama]?></td>
            <td class=input><?=$sq_reagen[noLot]?></td>
            <td class=input><?=$sq_reagen[tglKad]?></td>
            <td class=input><?=$imltd_r[dicatatoleh]?></td>
            <td class=input><?=$imltd_r[dicekOleh]?></td>
            <td class=input><?=$imltd_r[DisahkanOleh]?></td>
        </tr>
    <?}
    if ($no=="0"){
        ?><tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="13" class=input align="center">TIDAK ADA DATA PEMERIKSAAN IMLTD METODE RAPID</td>
        </tr>
    <?}
    ?>
</table>


<?
$sql_arc="SELECT `id`, `no_trans`, `instr`, date(`trans_time`) as trans_time, `user`,
            `id_tes`,
            `b_lot_reag`, `b_id_raw`, `b_ed_reag`, `b_kode_reag`, `b_abs`, `b_run_time`, `b_hasil`, `b_ket_tes`,
            `c_lot_reag`, `c_id_raw`, `c_ed_reag`, `c_kode_reag`, `c_abs`, `c_run_time`, `c_hasil`, `c_ket_tes`,
            `i_lot_reag`, `i_id_raw`, `i_ed_reag`, `i_kode_reag`, `i_abs`, `i_run_time`, `i_hasil`, `i_ket_tes`,
            `s_lot_reag`, `s_id_raw`, `s_ed_reag`, `s_kode_reag`, `s_abs`, `s_run_time`, `s_hasil`, `s_ket_tes`,
            `konfirmer`, `koonfirm_time`, `disahkan`, `status_kantong`, `konfirm_action`
            FROM `alinity_confirm` WHERE `id_tes`='$nkt'";
$qry_arc=mysql_query($sql_arc);
?>
<br><b>DATA PEMERIKSAAN DENGAN ALINITY I ABBOTT</b><br>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th rowspan="2">ID</th>
        <th rowspan="2">Instrument</th>
        <th colspan="6">HBSAG</th>
        <th colspan="6">Anti HCV</th>
        <th colspan="6">Anti HIV</th>
        <th colspan="6">Syphilis</th>
        <th rowspan="2">Operator<br>ALINITY I</th>
        <th rowspan="2">Konfirmasi</th>
        <th rowspan="2">Pengesahan</th>
    </tr>
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th>Abs</th>
        <th>Hasil</th>
        <th>Lot<br>Reag</th>
        <th>ED<br>Reag</th>
        <th>Run Time</th>
        <th>Ket</th>
        <th>Abs</th>
        <th>Hasil</th>
        <th>Lot<br>Reag</th>
        <th>ED<br>Reag</th>
        <th>Run Time</th>
        <th>Ket</th>
        <th>Abs</th>
        <th>Hasil</th>
        <th>Lot<br>Reag</th>
        <th>ED<br>Reag</th>
        <th>Run Time</th>
        <th>Ket</th>
        <th>Abs</th>
        <th>Hasil</th>
        <th>Lot<br>Reag</th>
        <th>ED<br>Reag</th>
        <th>Run Time</th>
        <th>Ket</th>
    </tr>
    <?
    $no="0";
    while ($arc=mysql_fetch_assoc($qry_arc)){ $no++;
        switch ($arc['b_hasil']){
            case '0' : $hasilb="NR";break;
            case '1' : $hasilb="R";break;
            case '2' : $hasilb="GZ"; break;
            default  :  $hasilb="";
        }
        switch ($arc['c_hasil']){
            case '0' : $hasilc="NR";break;
            case '1' : $hasilc="R";break;
            case '2' : $hasilc="GZ"; break;
            default  :  $hasilc="";
        }
        switch ($arc['i_hasil']){
            case '0' : $hasili="NR";break;
            case '1' : $hasili="R";break;
            case '2' : $hasili="GZ"; break;
            default  :  $hasili="";
        }
        switch ($arc['s_hasil']){
            case '0' : $hasils="NR";break;
            case '1' : $hasils="R";break;
            case '2' : $hasils="GZ"; break;
            default  :  $hasils="";
        }
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td class=input><a href="pmiimltd.php?module=imltd_alinity_cetakhasil_abbott&noid=<?=$arc['id']?>&notrans=<?=$arc['no_trans']?>" target="blank"><?=$arc['no_trans']?></a></td>
            
            <td class=input><?=$arc['instr']?></td>

            <td class=input align="right"><?=$arc['b_abs']?></td>
            <td class=input align="center"><?=$hasilb?></td>
            <td class=input><?=$arc['b_lot_reag']?></td>
            <?if ($hasilb=="") {echo "<td></td>";} else {?><td class=input><?=$arc['b_ed_reag']?></td><?}?>
            <?if ($hasilb=="") {echo "<td></td>";} else {?><td class=input><?=$arc['b_run_time']?></td><?}?>
            <td class=input><?=$arc['b_ket_tes']?></td>

            <td class=input align="right"><?=$arc['c_abs']?></td>
            <td class=input align="center"><?=$hasilc?></td>
            <td class=input><?=$arc['c_lot_reag']?></td>
            <?if ($hasilc=="") {echo "<td></td>";} else {?><td class=input><?=$arc['c_ed_reag']?></td><?}?>
            <?if ($hasilc=="") {echo "<td></td>";} else {?><td class=input><?=$arc['c_run_time']?></td><?}?>
            <td class=input><?=$arc['c_ket_tes']?></td>

            <td class=input align="right"><?=$arc['i_abs']?></td>
            <td class=input align="center"><?=$hasili?></td>
            <td class=input><?=$arc['i_lot_reag']?></td>
            <?if ($hasili=="") {echo "<td></td>";} else {?><td class=input><?=$arc['i_ed_reag']?></td><?}?>
            <?if ($hasili=="") {echo "<td></td>";} else {?><td class=input><?=$arc['i_run_time']?></td><?}?>
            <td class=input><?=$arc['i_ket_tes']?></td>

            <td class=input align="right"><?=$arc['s_abs']?></td>
            <td class=input align="center"><?=$hasils?></td>
            <td class=input><?=$arc['s_lot_reag']?></td>
            <?if ($hasils=="") {echo "<td></td>";} else {?><td class=input><?=$arc['s_ed_reag']?></td><?}?>
            <?if ($hasils=="") {echo "<td></td>";} else {?><td class=input><?=$arc['s_run_time']?></td><?}?>
            <td class=input><?=$arc['s_ket_tes']?></td>

            <td class=input><?=$arc['user']?></td>

            <td class=input><?=$arc['konfirmer']?></td>
            <td class=input><?=$arc['disahkan']?></td>
        </tr>
    <?}?>
    <?
    if ($no=="0"){
        ?><tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="29" class=input align="center">TIDAK ADA DATA PEMERIKSAAN COBAS 6000</td>
        </tr>
    <?}
    ?>

</table>
<?
$sq_nat="SELECT `id`, `date_transfer`, `sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`,
        `internal_Control_result`, `analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`,
        `analyte_cutoff`, `neg_calibrator_analyte_avg`, `neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`,
        `hcv_pos_analyte_avg`, `hcv_pos_calibartor_ic_avg`, `lot_number`, `lot_date`, `procleix_sn`, `procleix_firmware`,
        `run_number_prefix`, `type_of_tube`, `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`, `userinput`, `konfirmasi`,
        `tgl_konfirmasi`, `userkonfirmasi` FROM `imltd_procleix_raw` WHERE `sample_id`='$nkt'";
$sql_nat=mysql_query($sq_nat);
//echo "$sq_nat";
?>
<br>DATA PEMERIKSAAN NAT<br>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th rowspan="2">ID</th>
        <th rowspan="2">Protokol</th>
        <th rowspan="2">Waktu Periksa</th>
        <th rowspan="2">Operator</th>
        <th colspan="2">Master Lot</th>
        <th rowspan="2">Overall<br>Interpretarion</th>
        <th rowspan="2">Status<br>Flag</th>
        <th colspan="2">Internal Control</th>
        <th colspan="2">Analyte</th>
        <th colspan="2">Kofirmasi Hasil</th>
    </tr>
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <th>Number</th>
        <th>Date</th>
        <th>RLU</th>
        <th>Result</th>
        <th>RLU</th>
        <th>S/CO</th>
        <th>Tanggal</th>
        <th>User</th>
    </tr>
    <?
    $no="0";
    while ($nat=mysql_fetch_assoc($sql_nat)){$no++; ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td class=input align="right"><a href="pmiimltd.php?module=imltd_arc2000_cetakhasilnat&notrans=<?=$nat['id']?>&nokantong=<?=$nat['sample_id']?>&metode=nat" target="blank"><?=$nat['id']?></a></td>
            <td class=input><?=$nat['protocol']." ".$nat['procleix_sn']?></td>
            <td class=input><?=$nat['date']?></td>
            <td class=input align="center"><?=$nat['operator_name']?></td>
            <td class=input><?=$nat['lot_number']?></td>
            <td class=input><?=$nat['lot_date']?></td>
            <td class=input align="center"><?=$nat['interpretation']?></td>
            <td class=input align="center"><?=$nat['flag']?></td>
            <td class=input><?=$nat['internal_control_rlu']?></td>
            <td class=input><?=$nat['internal_Control_result']?></td>
            <td class=input><?=$nat['analyte_rlu']?></td>
            <td class=input><?=$nat['analyte_s_co']?></td>
            <td class=input><?=$nat['tgl_konfirmasi']?></td>
            <td class=input align="center"><?=$nat['userkonfirmasi']?></td>
        </tr>
    <?}?>
    <?
    if ($no=="0"){
        ?><tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="14" class=input align="center">TIDAK ADA DATA PEMERIKSAAN NAT</td>
        </tr>
    <?}
    ?>
</table>

<br>
<a href="pmiimltd.php?module=import_alinity"class="swn_button_blue">Kembali ke Awal</a>

