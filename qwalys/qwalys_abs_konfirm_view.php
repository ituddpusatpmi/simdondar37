<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>
<style>
    .awesomeText {
    color: #000;
    font-size: 150%;
 }
</style>

<script>
$(function() {
	$('a[href*=#]:not([href=#])').click(function(){
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {$('html,body').animate({scrollTop: target.offset().top}, 1000);return false;}
    }
  });
});

</script>

<title>SIMDONDAR</title>
</head>
<body>
<?php

$notransaksi = $_GET['notrans'];
$mode=$_GET['mode'];

$q="SELECT q.`id` , q.`sn` , q.`sample_id` , q.`parameter1` , q.`microplate` , q.`parameter2` , q.`runtime` ,
                q.`result1` , q.`result_status` , q.`operator` , q.`wellplate` , q.`nl` , q.`nl_barcode` , q.`nl_batch` ,
                q.`nl_ed` , q.`sd` , q.`sd_barcode` , q.`sd_batch` , q.`sd_ed` , q.`hsp` , q.`hsp_barcode` , q.`hsp_batch` ,
                q.`hsp_ed` , q.`result_inter` , q.`result_grade` ,q.`ket`, s.nokantong, s.jenis, s.status, s.sah, s.gol_darah, s.RhesusDrh,
                s.sah, s.StatTempat, s.stat2, s.tgl_Aftap, s.kodePendonor, a.`abs_kantong_status`, a.`abs_action`,
                a.`abs_user`, a.`abs_supervisor`, a.`abs_checker`
                FROM `qwalys_abs_raw` q
                LEFT JOIN `abs` a on q.`id`=a.`abs_ref_id`
                LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                WHERE q.`ket`='$notransaksi'
                order by q.`id`";

$Sq=mysql_query($q);
//echo "$q<br>";
?>
<a name="atas" id="atas"></a>
<table border=0 cellpadding="5" cellspacing="5" width="100%">
   <tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;"><b>Hasil Konfirmasi Pemeriksaan Antibody Screening Qwalys<sup>&reg</sup> 3</td>
    </tr>
    <tr>
        <td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">No Transaksi : <?php echo $notransaksi; ?></td>
        <td align="right" style="background-color: #ffffff"><a href="#bawah" class="swn_button_blue">Ke bawah</a></td>
    </tr>


</table>
<form name="manual_input" align="left" method="post" action="<?echo $PHPSELF?>">
	<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
		<tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td rowspan=2 align="center">No</td>
			<td rowspan=2 align="center">Sample</td>
            <td colspan=5 align="center">Pemeriksaan</td>
			<td colspan=4 align="center">Kantong Darah</td>
			<td rowspan=2 align="center">Kode Pendonor</td>
            <td rowspan=2 align="center">Aksi User</td>
		</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">Well</td>
            <td align="center">Parameter</td>
            <td align="center">Reaksi</td>
            <td align="center">Inter pretasi</td>
            <td align="center">Mark</td>
            <td align="center">Tgl Aftap</td>
            <td align="center">Status Saat Konfirmasi</td>
            <td align="center">Status Saat Ini</td>
			<td align="center">Golongan<br>Darah</td>
		</tr>
		<?
		$no	=0;
		while($data=mysql_fetch_assoc($Sq)){
            $pplate    =$data['microplate'];
            $user      =$data['abs_user'];
            $checker   =$data['abs_checker'];
            $supervisor=$data['abs_supervisor'];

			$no++;
			$status_ktg=$data['abs_kantong_status'];
			switch ($status_ktg){
				case '0' : $statuskantong_old='Kosong';break;
				case '1' : $statuskantong_old='Karantina';break;
				case '2' : $statuskantong_old='Sehat';break;
				case '3' : $statuskantong_old='Keluar';break;
				case '4' : $statuskantong_old='Rusak';break;
				case '5' : $statuskantong_old='Rusak-Gagal';break;
				case '6' : $statuskantong_old='Dimusnahkan';break;
				default  : $statuskantong_old='Tidak ada';
			}

            $status_ktg=$data['status']; $kantong_sah=$data['sah'];
            switch ($status_ktg){
                case '0' : $statuskantong='Kosong';
                    if ($c_ktg[StatTempat]==NULL) $statuskantong='Kosong-Logistik';
                    if ($c_ktg[StatTempat]=='0')  $statuskantong='Kosong-Logistik';
                    if ($c_ktg[StatTempat]=='1')  $statuskantong='Kosong-Aftap';
                    break;
                case '1' : if ($c_ktg['sah']=="1"){
                    $statuskantong='Karantina';
                } else{
                    $statuskantong='Belum disahkan';
                }
                    break;
                case '2' : $statuskantong='Sehat';
                    if (substr($c_ktg[stat2],0,1)=='b') $tempat=" (BDRS)";
                    break;
                case '3' : $statuskantong='Keluar';break;
                case '4' : $statuskantong='Rusak';break;
                case '5' : $statuskantong='Rusak-Gagal';break;
                case '6' : $statuskantong='Dimusnahkan';break;
                default  : $statuskantong='Tidak ada';
            }
            //Clear Var
				$cekal='0';

			if (($status_ktg=='1') and ($kantong_sah=='1')){$valid++;}
			?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
				<td align='center'><?=$data['sample_id']; ?></td>
                <td align='center'><?=$data[wellplate]?></td>
                <td align='center' nowrap><?=$data[parameter2]?></td>
                <td align='center'><?=$data[result1]?></td>
                <?php if($data[result_inter]=='Pos'){
                    ?> <td align='center'><b><font color="red"> <?=$data[result_inter]?></b></font></td> <?
                } else {
                    ?> <td align='center'><?=$data[result_inter]?></td> <?
                }?>
                <td align='center'><?=$data[result_status ]?></td>
                <td align='center' nowrap><?=$data[tgl_Aftap]?></td>
                <td align='center' nowrap><?=$statuskantong_old?></td>
                <td align='center' nowrap><?=$statuskantong?></td>
                <td align='center'><?=$data[gol_darah].'('.$data[RhesusDrh].')'?></td>
                <td align='center' nowrap><?=$data[kodePendonor]?></td>
                	<?
                    switch($data['abs_action']){
                        case 0 : $aksi='-';break;
                        case 1 : $aksi='Disehatkan';break;
                        case 2 : $aksi='Dicekal/Musnahkan';break;
                        case 3 : $aksi='Ditunda';break;
                    }
                	?>
                <td align='left'><?=$aksi?></td>
				
			</tr>
		<?
		}
        ?>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center" colspan="13">REAGEN/BAHAN HABIS PAKAI YANG TERPAKAI</td>
        </tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">No.</td>
            <td align="center" colspan="3">Reagan/Bahan Habis Pakai</td>
            <td align="center" colspan="3">Barcode</td>
            <td align="center" colspan="2">Batch</td>
            <td align="center" colspan="2">ED</td>
            <td align="center" colspan="3">Ket</td>
        </tr>
        <?
        $lot_plate=substr($pplate,8,3);
        $ed_plate =substr($pplate,4,2).'/20'.substr($pplate,6,2);
        $a_date   = "20".substr($pplate,6,2).'-'.substr($pplate,4,2).'-01';
        $ed_plate = date("Y-m-t", strtotime($a_date));
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td align='right'>1.</td>
            <td align='left' colspan="3">Mircoplate</td>
            <td align='center' colspan="3"><?=$pplate?></td>
            <td align='center' colspan="2"><?=$lot_plate?></td>
            <td align='center' colspan="2"><?=date("d/m/Y",strtotime($ed_plate))?></td>
            <td colspan="2"></td>
        </tr>
        <?
        $Sq=mysql_query("SELECT q.`nl` as nama , q.`nl_barcode` as barcode, q.`nl_batch` as batch ,q.`nl_ed` as ed
                         FROM `qwalys_abs_raw` q LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                         WHERE q.`ket`='$notransaksi'
                         group by q.`nl_barcode`");
        $no	=1;
        while($reag=mysql_fetch_assoc($Sq)){
            $no++;?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='left' colspan="3"><?=$reag[nama]?></td>
                <td align='center' colspan="3"><?=$reag[barcode]?></td>
                <td align='center' colspan="2"><?=$reag[batch]?></td>
                <td align='center' colspan="2"><?=$reag[ed]?></td>
                <td colspan="2"></td>
            </tr>
        <?}?>
        <?
        $Sq=mysql_query("SELECT q.`sd` as nama , q.`sd_barcode` as barcode, q.`sd_batch` as batch ,q.`sd_ed` as ed
                         FROM `qwalys_abs_raw` q LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                         WHERE q.`ket`='$notransaksi'
                         group by q.`sd`");
        while($reag=mysql_fetch_assoc($Sq)){
            $no++;?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='left' colspan="3"><?=$reag[nama]?></td>
                <td align='center' colspan="3"><?=$reag[barcode]?></td>
                <td align='center' colspan="2"><?=$reag[batch]?></td>
                <td align='center' colspan="2"><?=$reag[ed]?></td>
                <td colspan="2"></td>
            </tr>
        <?}?>
        <?
        $Sq=mysql_query("SELECT q.`hsp` as nama , q.`hsp_barcode` as barcode, q.`hsp_batch` as batch ,q.`hsp_ed` as ed
                         FROM `qwalys_abs_raw` q LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                         WHERE q.`ket`='$notransaksi'
                         group by q.`hsp_barcode`");
        while($reag=mysql_fetch_assoc($Sq)){
            $no++;?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='left' colspan="3"><?=$reag[nama]?></td>
                <td align='center' colspan="3"><?=$reag[barcode]?></td>
                <td align='center' colspan="2"><?=$reag[batch]?></td>
                <td align='center' colspan="2"><?=$reag[ed]?></td>
                <td colspan="2"></td>
            </tr>
        <?}?>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		    <td colspan="2" align="left" nowrap>Dikonfirmasi oleh</td>
		    <td colspan="5" align="left"> <?echo $namalengkap;?></td>
            <td colspan="10" rowspan="3" align="left"></td>
	    </tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		    <td colspan="2" align="left" nowrap>Operator Qwalys</td>
		    <td colspan="5" align="left"><?=$user?> </td>
	    </tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		    <td colspan="2" align="left" nowrap>Disahkan Oleh</td>
		    <td colspan="5" align="left"><?=$supervisor?></td>
	</tr>
	</table>
    <a href="pmikonfirmasi.php?module=qwalys_view_confirmp&notrans=<?=$notransaksi?>&mode=<?=$mode?>" class="swn_button_blue">Cetak</a>
	<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah">
        <?php
        if ($mode=='1'){
            ?> <a href="pmikonfirmasi.php?module=konfirm_abs"class="swn_button_blue">Kembali</a> <?php
        }else{
            ?> <a href="pmikonfirmasi.php?module=abs_to_data"class="swn_button_blue">Kembali</a> <?php
        }
        ?>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
</form>
</body>
</html>
