<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
//Chek field on stokkantong for abs

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

$notrans     = $_GET['notrans'];
$mode        = $_GET['mode'];

$q="SELECT q.`id`, q.`version`, q.`sn`, q.`sample_id`, q.`parameter1`, q.`microplate`, q.`runtime`, q.`operator`, 
   q.`AntiA_Name`, q.`AntiA_Result`, q.`AntiA_Well`, q.`AntiA_Reag1`, q.`AntiA_Reag1Barcode`, q.`AntiA_Reag1Batch`, q.`AntiA_Reag1ED`, 
   q.`AntiA_Reag2`,q.`AntiA_Reag2Barcode`, q.`AntiA_Reag2Batch`, q.`AntiA_Reag2ED`, q.`AntiB_Name`, q.`AntiB_Result`, q.`AntiB_Well`, 
   q.`AntiB_Reag1`, q.`AntiB_Reag1Barcode`, q.`AntiB_Reag1Batch`, q.`AntiB_Reag1ED`, q.`AntiB_Reag2`, q.`AntiB_Reag2Barcode`, 
   q.`AntiB_Reag2Batch`, q.`AntiB_Reag2ED`, q.`AntiD_Name`, q.`AntiD_Result`, q.`AntiD_Well`, q.`AntiD_Reag1`, q.`AntiD_Reag2`, 
   q.`AntiD_Reag1Barcode`, q.`AntiD_Reag2Barcode`, q.`AntiD_Reag1Batch`, q.`AntiD_Reag2Batch`, q.`AntiD_Reag1ED`, q.`AntiD_Reag2ED`, 
   q.`AntiRHC_Name`, q.`AntiRHC_Result`, q.`AntiRHC_Well`, q.`AntiRHC_Reag1`, q.`AntiRHC_Reag2`, q.`AntiRHC_Reag1Barcode`, 
   q.`AntiRHC_Reag2Barcode`, q.`AntiRHC_Reag1Batch`, q.`AntiRHC_Reag2Batch`, q.`AntiRHC_Reag1ED`, q.`AntiRHC_Reag2ED`, 
   q.`CellA1_Name`, q.`CellA1_Result`, q.`CellA1_Well`, q.`CellA1_Reag1`, q.`CellA1_Reag1Barcode`, q.`CellA1_Reag1Batch`, 
   q.`CellA1_Reag1ED`, q.`CellB_Name`, q.`CellB_Result`, q.`CellB_Well`, q.`CellB_Reag1`, q.`CellB_Reag1Barcode`, q.`CellB_Reag1Batch`, 
   q.`CellB_Reag1ED`, q.`ResultABD`, q.`ResultRh`,q.`ket`,q.`confirm`,
   d.operator, d.pengesah, d.petugas, d.goldarah_asal, d.rhesus_asal, d.`Cocok`,d.`kode_donor`
   FROM `qwalys_abd_raw` q left join `dkonfirmasi`d  on q.`sample_id`=d.`NoKantong` 
   WHERE q.`ket`='$notrans' group by d.`kode_donor`
   order by q.`id`";
$Sq=mysql_query($q);
?>
<a name="atas" id="atas"></a>
<table border=0 cellpadding="5" cellspacing="5" width="80%">
   <tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;"><b>Hasil Pengesahan Konfirmasi Golongan Darah - Qwalys<sup>&reg</sup> 3</td>
		<td align="right" style="background-color: #ffffff"><a href="#bawah" class="swn_button_blue">Ke bawah</a></td>
   </tr>
</table>
<form name="manual_input" align="left" method="post" action="<?echo $PHPSELF?>">
	<table class="list" border=1 cellpadding="2" cellspacing="2" width="80%" style="border-collapse:collapse">
		<tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td rowspan=2 align="center">No</td>
			<td rowspan=2 align="center">Sample</td>
            <td colspan=8 align="center">Pemeriksaan Qwalys</td>
			<td colspan=3 align="center">Kantong Darah & Donor</td>
			<td rowspan=2 align="center">Keterangan</td>
            <td rowspan=2 align="center">Aksi User</td>
		</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">Anti A</td>
            <td align="center">Anti B</td>
            <td align="center">Anti D</td>
            <td align="center">RH Ctrl</td>
            <td align="center">Cell A1</td>
            <td align="center">Cell B</td>
            <td align="center">ABO Result</td>
			<td align="center">RH Result</td>

			<td align="center">ABO</td>
			<td align="center">RH</td>
			<td align="center">Kode Pendonor</td>
		</tr>
		<?
		$no	=0;
		$batchreag1='';
		$batchreag2='';
		$batchreag3='';
		$batchreag4='';
        $arr_reag=array();
        $rec=0;
		while($data=mysql_fetch_assoc($Sq)){
			$no++;
            $operator=$data['operator'];
            $pplate=$data['microplate'];
            $petugas=$data['petugas'];
            $pengesah=$data['pengesah'];
			?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='center'><?=$data['sample_id']; ?></td>
				<td align='center'><?=$data[AntiA_Result]?></td>
                <td align='center'><?=$data[AntiB_Result]?></td>
                <td align='center'><?=$data[AntiD_Result]?></td>
                <td align='center'><?=$data[AntiRHC_Result]?></td>
                <td align='center'><?=$data[CellA1_Result]?></td>
                <td align='center'><?=$data[CellB_Result]?></td>
                <td align='center'><?=$data[ResultABD]?></td>
                <td align='center'><?=$data[ResultRh]?></td>
                <td align='center'><?=$data[goldarah_asal]?></td>
                <td align='center'><?=$data[rhesus_asal]?></td>
                <td align='center' nowrap><?=$data[kode_donor]?></td>
                <?php
                	if ($data[Cocok]=='0'){
                		if ($gol_awal==$gol_akhir){
                			?><td align='center' nowrap>Cocok</td><?
                		}else{
                			?><td align='center' nowrap>Tidak Cocok</td><?
                		}
                	} else {
                		?><td align='center' nowrap>-</td><?
                	}
                	switch ($data[confirm]){
                        case "0" : $aksi="-";break;
                        case "1" : $aksi="Konfirmasi";break;
                        case "2" : $aksi="Ditunda";break;
                    }
                ?>
                <td align='left'><?=$aksi?></td>
				<?
				// Populatting BHP
				// BromeLine 		AntiA_Reag1		AntiB_Reag1		AntiD_Reag1		AntiRHC_Reag1
					if ($data['AntiA_Reag1Batch']!==$batchreag1){
						$batchreag1=$data['AntiA_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiA_Reag1'], 'barcode'=>$data['AntiA_Reag1Barcode'], 'batch'=>$data['AntiA_Reag1Batch'], 'ed'=>$data['AntiA_Reag1ED']);
                    }
				    if ($data['AntiB_Reag1Batch']!==$batchreag1){
						$batchreag1=$data['AntiB_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiB_Reag1'], 'barcode'=>$data['AntiB_Reag1Barcode'], 'batch'=>$data['AntiB_Reag1Batch'], 'ed'=>$data['AntiB_Reag1ED']);
                  	}
					if ($data['AntiD_Reag1Batch']!==$batchreag1){
						$batchreag1=$data['AntiD_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiD_Reag1'], 'barcode'=>$data['AntiD_Reag1Barcode'], 'batch'=>$data['AntiD_Reag1Batch'], 'ed'=>$data['AntiD_Reag1ED']);
                     }
					if ($data['AntiRHC_Reag1Batch']!==$batchreag1){
						$batchreag1=$data['AntiRHC_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiRHC_Reag1'], 'barcode'=>$data['AntiRHC_Reag1Barcode'], 'batch'=>$data['AntiRHC_Reag1Batch'], 'ed'=>$data['AntiRHC_Reag1ED']);
				    }
				// MagneLys		AntiA_Reag2		AntiB_Reag3		AntiD_Reag2		AntiRHC_Reag2
				    if ($data['AntiA_Reag2Batch']!==$batchreag2){
                        $batchreag2=$data['AntiA_Reag2Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiA_Reag2'], 'barcode'=>$data['AntiA_Reag2Barcode'], 'batch'=>$data['AntiA_Reag2Batch'], 'ed'=>$data['AntiA_Reag2ED']);
                    }
				    if ($data['AntiB_Reag2Batch']!==$batchreag2){
						$batchreag2=$data['AntiB_Reag2Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiB_Reag2'], 'barcode'=>$data['AntiB_Reag2Barcode'], 'batch'=>$data['AntiB_Reag2Batch'], 'ed'=>$data['AntiB_Reag2ED']);
                    }
					if ($data['AntiD_Reag2Batch']!==$batchreag2){
						$batchreag2=$data['AntiD_Reag2Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiD_Reag2'], 'barcode'=>$data['AntiD_Reag2Barcode'], 'batch'=>$data['AntiD_Reag2Batch'], 'ed'=>$data['AntiD_Reag2ED']);
                    }
					if ($data['AntiRHC_Reag2Batch']!==$batchreag2){
						$batchreag2=$data['AntiRHC_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['AntiRHC_Reag2'], 'barcode'=>$data['AntiRHC_Reag2Barcode'], 'batch'=>$data['AntiRHC_Reag2Batch'], 'ed'=>$data['AntiRHC_Reag2ED']);
                    }
				// HemaLys A1 S1	CellA1_Reag1
                    if ($data['CellA1_Reag1Batch']!==$batchreag3){
                        $batchreag3=$data['CellA1_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['CellA1_Reag1'], 'barcode'=>$data['CellA1_Reag1Barcode'], 'batch'=>$data['CellA1_Reag1Batch'], 'ed'=>$data['CellA1_Reag1ED']);
                     }
				// HemaLys B S1	CellB_Reag1
                    if ($data['CellB_Reag1Batch']!==$batchreag4){
                        $batchreag4=$data['CellB_Reag1Batch'];
                        $rec++;
                        $arr_reag[$rec] = array('reag'=>$data['CellB_Reag1'], 'barcode'=>$data['CellB_Reag1Barcode'], 'batch'=>$data['CellB_Reag1Batch'], 'ed'=>$data['CellB_Reag1ED']);
                    }
				?>
			</tr>
		<?
		}
        ?>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center" colspan="15">REAGEN/BAHAN HABIS PAKAI YANG TERPAKAI</td>
        </tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">No.</td>
            <td align="center" colspan="5">Reagan/Bahan Habis Pakai</td>
            <td align="center" colspan="4">Barcode</td>
            <td align="center" colspan="3">Batch</td>	
            <td align="center" colspan="2">ED</td>
        </tr>
        <?

        	$lot_plate=substr($pplate,8,3);
        	$ed_plate =substr($pplate,4,2).'/20'.substr($pplate,6,2);
        	$a_date   = "20".substr($pplate,6,2).'-'.substr($pplate,4,2).'-01';
			$ed_plate = date("Y-m-t", strtotime($a_date));
        ?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td align='right'>1.</td>
            <td align='left' colspan="5">Mircoplate</td>
            <td align='center' colspan="4"><?=$pplate?></td>
            <td align='center' colspan="3"><?=$lot_plate?></td>		<input type="hidden" name=lot_plate value=<?=$lot_plate?>>
            <td align='center' colspan="2"><?=date("d/m/Y",strtotime($ed_plate))?></td><input type="hidden" name=ed_plate value=<?=$ed_plate?>>
        </tr>

        <?
        $nomor=1;
        foreach($arr_reag as $result) {
            $nomor++;
            ?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$nomor.'.'?></td>
                <td align='left' colspan="5"><?=$result['reag']?></td>
                <td align='center' colspan="4"><?=$result['barcode']?></td>
                <td align='center' colspan="3"><?=$result['batch']?></td>
                <td align='center' colspan="2"><?=$result['ed']?></td>
            </tr>
            <?
        }
        ?>

        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Dikonfirmasi oleh</td>
		<td colspan="5" align="left"> <?echo $petugas;?></td>
        <td colspan="10" rowspan="3" align="left" style="background-color: ghostwhite; color: #000000"></td>
	</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Operator Qwalys</td>
		<td colspan="5" align="left"><?=$operator;?></td>
	</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Disahkan Oleh</td>
		<td colspan="5" align="left"><?=$pengesah;?></td>
	</tr>
	</table>
	<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah">
     <a href="pmikonfirmasi.php?module=qwalys_view_confirm_abdp&notrans=<?=$notrans?>&mode=<?=$mode?>" class="swn_button_blue">Cetak</a>
	<a href="pmikonfirmasi.php?module=abd_to_data"class="swn_button_blue">Kembali ke list data</a>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
</form>
</body>
</html>
