<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];

?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        @import url("topstyle.css");tr { background-color: #ffffff}.initial { background-color: #ffffff; color:black }
        .normal { background-color: #ffffff }.highlight { background-color: #ffffff }
    </style>
    <style>
        .awesomeText {
            color: #000000;
            font-size: 150%;
        }
    </style>


<title>SIMDONDAR</title>
    <style type="text/css" media="print">
        @page
        {
            size:  auto;   /* auto is the initial value */
            margin: 15mm;  /* this affects the margin in the printer settings */
        }

        html
        {
            background-color: #ffffff;
            margin: 3px;  /* this affects the margin on the html before sending to printer */
        }

        body
        {
            border: solid 0px #ffffff ;
            margin: 0mm 10mm 10mm 15mm; /* margin you want for the content */
        }
    </style>
</head>
<body onload="window.print()">
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
   q.`CellB_Reag1ED`, q.`ResultABD`, q.`ResultRh`,q.`ket`,q.`confirm`,q.`on_insert`,
   d.operator, d.pengesah, d.petugas, d.goldarah_asal, d.rhesus_asal, d.`Cocok`,d.`kode_donor`
   FROM `qwalys_abd_raw` q left join `dkonfirmasi`d  on q.`sample_id`=d.`NoKantong` 
   WHERE q.`ket`='$notrans'
   order by q.`id`";
$Sq=mysql_query($q);
?>
<a name="atas" id="atas"></a>
<table border=0 cellpadding="5" cellspacing="5" width="80%">
   <tr>
       <td align="left" style="background-color: #ffffff;font-size:24px; color:#000000; font-family:Verdana;"><b>Hasil Pengesahan Konfirmasi Golongan Darah - Qwalys<sup>&reg</sup> 3</td>
       </tr>
    <tr>
       <td align="left" style="background-color: #ffffff;font-size:24px; color:#000000; font-family:Verdana;"><b>No. Transaksi :<b> <?=$notrans?></b></td>
   </tr>
</table>
<form name="manual_input" align="left" method="post" action="<?echo $PHPSELF?>">
    <table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
        <tr style="background-color:#DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:Verdana;">
			<td rowspan=2 align="center">No</td>
			<td rowspan=2 align="center">Sample</td>
            <td colspan=8 align="center" height="30">Pemeriksaan Qwalys</td>
			<td colspan=3 align="center">Kantong Darah & Donor</td>
			<td rowspan=2 align="center">Keterangan</td>
            <td rowspan=2 align="center">Aksi User</td>
		</tr>
        <tr style="background-color:#DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:Verdana;">
            <td align="center" height="30">Anti A</td>
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
            $tanggal=$data['on_insert'];
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
        <tr style="background-color:#DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:Verdana;">
            <td align="center" colspan="15" height="30">REAGEN/BAHAN HABIS PAKAI YANG TERPAKAI</td>
        </tr>
        <tr style="background-color:#DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:Verdana;">
            <td align="center" height="30">No.</td>
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
        <tr style="background-color:#DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:Verdana;">
            <td align="center" colspan="7" height="40">WAKTU PEMERIKSAAN DAN PETUGAS</td>
            <td colspan="8" rowspan="5" valign="top" style="background-color:#ffffff;">Catatan:</td>
        </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="2" align="left" nowrap>Waktu Pengesahan</td>
            <td colspan="4" align="left"> <?echo $tanggal;?></td>
            <td>Paraf Petugas</td>
        </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
		    <td colspan="2" align="left" nowrap height="30">Dikonfirmasi oleh</td>
		    <td colspan="4" align="left"> <?echo $petugas;?></td>
            <td></td>
	    </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
		    <td colspan="2" align="left" nowrap height="30">Operator Qwalys</td>
		    <td colspan="4" align="left"><?=$operator;?></td>
            <td></td>
	    </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
		    <td colspan="2" align="left" nowrap height="30">Disahkan Oleh</td>
		    <td colspan="4" align="left"><?=$pengesah;?></td>
            <td></td>
	    </tr>
	</table>

</form>
<?
if ($mode=="1"){
    echo "<meta http-equiv='refresh' content='2;url=pmikonfirmasi.php?module=konfirm_abd'";
}else{
    echo "<meta http-equiv='refresh' content='2;url=pmikonfirmasi.php?module=abd_to_data'";
}

?>
</body>

</html>
