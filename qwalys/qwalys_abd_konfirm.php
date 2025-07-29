<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
//Chek field on stokkantong for abs
$mode="0";
$col=mysql_query("select `operator` from dkonfirmasi limit 1");
    if (!$col){
        mysql_query("ALTER TABLE `dkonfirmasi` ADD `operator` VARCHAR( 20 ) NOT NULL COMMENT 'Operator Alat' AFTER `petugas`");
        mysql_query("ALTER TABLE `dkonfirmasi` ADD `pengesah` VARCHAR( 20 ) NOT NULL COMMENT 'Yang mengesahkan hasil' AFTER `operator`");
        mysql_query("ALTER TABLE `dkonfirmasi` ADD `kode_donor` VARCHAR( 20 ) NOT NULL AFTER `NoKantong`");
    }

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
if(isset($_POST['Button']))  {
    $mode="1";
    $today          = date("Y-m-d");
    $time_now       = date("Y-m-d H:i:s");
    $lot_plate		= $_POST['lot_plate'];
    $ed_plate		= $_POST['ed_plate'];
    //Personal parameter
	$ptgKonfirmasi 	= $_POST[konfirmasi];
	$ptgSah			= $_POST[disahkan_oleh];
	$ptgOperator	= $_POST[operator];
	$jumlah_sample   =count($_POST[kantong]);
    echo "Jumlah sample : $jumlah_sample<br>";

	//Generated NoTransaksi===============================================
    $k_today="K".date("dmy")."-";
    $idp	= mysql_query("select NoKonfirmasi from dkonfirmasi where NoKonfirmasi like '$k_today%' order by NoKonfirmasi DESC limit 1");
    $idp1	= mysql_fetch_assoc($idp);
    $idp2	= substr($idp1[NoKonfirmasi],8,3);
    if ($idp2<1) {$idp2="000";}
    $int_idp2=(int)$idp2+1;
    $j_nol1= 3-(strlen(strval($int_idp2)));
    $idp4='';
    for ($n=0; $n<$j_nol1; $n++){
        $idp4 .="0";
    }
    $notrans=$k_today.$idp4.$int_idp2;
	echo "No. Transaksi :  ".$notrans." Tanggal Periksa : ".$time_now." ( Time Zone :".date_default_timezone_get().")<br>";
	//END Generate no transaksi===============================================

		//Counting data
		for ($i=0;$i<count($_POST[kantong]);$i++) {
            //Collecting individual sample
            $v_id       = $_POST[id_raw][$i];
            $v_sample   = $_POST[kantong][$i];
            $v_aksi     = $_POST[aksi][$i];
            $v_stts_ktg = $_POST[statusktg][$i];
            $v_id_donor = $_POST[kodedonor][$i];
            $v_tgl_aftap= $_POST[tglaftap][$i];
            $v_metode   = 'Auto Qwalys';
            $v_jenis    = $_POST[jenis_kantong][$i];
            $v_anti_a	= $_POST[antia][$i];
            $v_anti_b	= $_POST[antib][$i];
            $v_anti_d	= $_POST[antid][$i];
            $v_anti_rhc	= $_POST[antirhc][$i];
            $v_cella	= $_POST[cella][$i];
            $v_cellb	= $_POST[cellb][$i];
            $v_abo		=$_POST[rsultabo][$i];
            $v_rh		=$_POST[rsultrh][$i];
            $v_abo_awal	=$_POST[golabo][$i];
            $v_rh_awal	=$_POST[rhesus][$i];
            $v_cocok	=$_POST[cocok][$i];

            if($v_aksi!=='2'){
                if ($v_anti_rhc=='Neg'){$v_anti_rhc='1';}else{$v_anti_rhc='0';}
                $q_kgd="insert into dkonfirmasi
            					    (`NoKonfirmasi`,`NoKantong`,kode_donor,`GolDarah`,`Rhesus`,`ket`,`tgl`,`petugas`, `operator`,`pengesah`,
            					    `Cocok`,`goldarah_asal`, `rhesus_asal`,`metode`,`sel`,
            					    `antiA`,`antiB`,`antiO`,`serum`,`tA`,`tB`,`tsO`,`antiD`,`ac`,`ba`,
								    `nolot_aa`,`expa`,`nolot_ab`,`expb`,`nolot_ad`,`expd`)
							 	    value
								    ('$notrans','$v_sample','$v_id_donor','$v_abo','$v_rh','Qwalys 3','$time_now','$ptgKonfirmasi','$ptgOperator', '$ptgSah',
								    '$v_cocok','$v_abo_awal','$v_rh_awal','$v_metode','0',
								    '$v_anti_a','$v_anti_b','-','0','$v_cella','$v_cellb','Neg','$v_anti_d','1','$v_anti_rhc',
								    '$lot_plate','$ed_plate','$lot_plate','$ed_plate','$lot_plate','$ed_plate')";
                //echo "$q_kgd<br>";
                $insert_kgd=mysql_query($q_kgd);
                $last='';
				
				//Update 
                $no_kantong0=substr($v_sample,0,-1);
                for($j=0;$j<$v_jenis;$j++){
                    switch ($j){
                        case 0 :$no_ktg=$no_kantong0.'A';break;
                        case 1 :$no_ktg=$no_kantong0.'B';break;
                        case 2 :$no_ktg=$no_kantong0.'C';break;
                        case 3 :$no_ktg=$no_kantong0.'D';break;
                        case 4 :$no_ktg=$no_kantong0.'E';break;
                        case 5 :$no_ktg=$no_kantong0.'F';break;
                        case 6 :$no_ktg=$no_kantong0.'G';break;
                        case 7 :$no_ktg=$no_kantong0.'H';break;
                        case 8 :$no_ktg=$no_kantong0.'I';break;
                    }
                    
                    
                    //=======Audit Trial====================================================================================
			        $log_mdl ='KONFIRMASI';
	    		    $log_aksi='KGD: Auto-Qwalys, No Kantong: '.$no_ktg.', transaksi: '.$notrans. ', Gol. Awal: '.$v_abo_awal.$v_rh_awal.', hasil: '.$v_abo.$v_rh;
			        include('user_log.php');
	    		    //=====================================================================================================
					
					//Update kantong
					$tambah=mysql_query("UPDATE stokkantong set statKonfirmasi='1', gol_darah='$v_abo',RhesusDrh='$v_rh' where noKantong='$no_ktg'");
					//Update pendonor
					$donor=mysql_query("UPDATE pendonor set GolDarah='$v_abo',Rhesus='$v_rh' where Kode='$v_id_donor'");
					//Update pengolahan
					$komp=mysql_query("UPDATE dpengolahan set goldarah='$v_abo',rhesus='$v_rh' where noKantong='$no_ktg'");
					//Update htransaksi
					//$htrans=mysql_query("UPDATE htransaksi set gol_darah='$v_abo',rhesus='$v_rh' where KodePendonor='$v_id_donor");
					
				}
               
                //Update Qwalys Raw : Konfirmed
                $qupd_raw=mysql_query("update qwalys_abd_raw set `confirm`='$v_aksi', `confirm_user`='$ptgKonfirmasi', `ket`='$notrans' where `id`='$v_id'");
            }
        }
        echo "<meta http-equiv='refresh' content='2;url=pmikonfirmasi.php?module=qwalys_view_confirm_abd&notrans=$notrans&mode=1'>";
}

$psn        = $_GET['sn'];
$ptgl       = $_GET['tgl'];
$puser      = $_GET['user'];
$pplate     = $_GET['plate'];
$pparam     = $_GET['param'];
if ($mode=="0"){

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
   q.`CellB_Reag1ED`, q.`ResultABD`, q.`ResultRh`,
   s.nokantong, s.jenis, s.status, s.sah, s.gol_darah, s.RhesusDrh, s.sah, s.StatTempat, s.stat2, s.tgl_Aftap, s.kodePendonor 
   FROM `qwalys_abd_raw` q left join `stokkantong` s on s.`noKantong`=q.`sample_id`
   WHERE date(q.`runtime`) = '$ptgl'
   AND q.`microplate` = '$pplate'
   AND q.`sn` = '$psn'
   AND q.`operator` = '$puser'
   AND q.`parameter1` = '$pparam' and `confirm` is null
   order by q.`id`";

$Sq=mysql_query($q);
//echo "$q<br>";
?>
<a name="atas" id="atas"></a>
<table border=0 cellpadding="5" cellspacing="5" width="80%">
   <tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;"><b>Konfirmasi Golongan Darah - Qwalys<sup>&reg</sup> 3</td>
		<td align="right" style="background-color: #ffffff"><a href="#bawah" class="swn_button_blue">Ke bawah</a></td>
   </tr>
</table>
<form name="manual_input" align="left" method="post" action="<?echo $PHPSELF?>">
	<table class="list" border=1 cellpadding="2" cellspacing="2" width="80%" style="border-collapse:collapse">
		<tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td rowspan=2 align="center">No</td>
			<td rowspan=2 align="center">Sample</td>
            <td colspan=8 align="center">Pemeriksaan Qwalys</td>
			<td colspan=5 align="center">Kantong Darah & Donor</td>
			<td rowspan=2 align="center">Keterangan</td>
            <td rowspan=2 align="center">Konfirmasi</td>
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
			<td align="center">Tgl Aftap</td>
			<td align="center">Status</td>
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
			if (($status_ktg=='1') and ($kantong_sah=='1')){$valid++;}
			?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <input type=hidden name=sample[]   value="<?=$data['id']?>">
                <input type="hidden" name=id_raw[] value=<?=$data[id]?>>
                <input type="hidden" name=jenis_kantong[] value=<?=$data[jenis]?>>
                <td align='right'><input type="hidden" name=no[] 	 value=<?=$no?>> 	 				 <?=$no.'.'?></td>
                <td align='center'><input type="hidden" name=kantong[] value=<?=$data[sample_id]?>> 	 <?=$data['sample_id']; ?></td>
				<td align='center'><input type="hidden" name=antia[] value=<?=$data[AntiA_Result]?>> 	 <?=$data[AntiA_Result]?></td>
                <td align='center'><input type="hidden" name=antib[] value=<?=$data[AntiB_Result]?>> 	 <?=$data[AntiB_Result]?></td>
                <td align='center'><input type="hidden" name=antid[] value=<?=$data[AntiD_Result]?>> 	 <?=$data[AntiD_Result]?></td>
                <td align='center'><input type="hidden" name=antirhc[] value=<?=$data[AntiRHC_Result]?>> <?=$data[AntiRHC_Result]?></td>
                <td align='center'><input type="hidden" name=cella[] value=<?=$data[CellA1_Result]?>> 	 <?=$data[CellA1_Result]?></td>
                <td align='center'><input type="hidden" name=cellb[] value=<?=$data[CellB_Result]?>> 	 <?=$data[CellB_Result]?></td>
                <td align='center'><input type="hidden" name=rsultabo[] value=<?=$data[ResultABD]?>> 	 <?=$data[ResultABD]?></td>
                <td align='center'> 	 	 															 <?=$data[ResultRh]?></td>
                <td align='center'><input type="hidden" name=golabo[] value=<?=$data[gol_darah]?>> 	 	 <?=$data[gol_darah]?></td>
                				   <input type="hidden" name=rhesus[] value=<?=$data[RhesusDrh]?>>

                <?php
                	$rh_result='';
                	if ($data[ResultRh]=='Neg'){$rh_result='-';} else {$rh_result='+';}
                	switch ($data[RhesusDrh]=='+'){
	                	case '+' : $rhawal='Pos';break;
    	            	case '-' : $rhawal='Neg';break;
    	            	default  : $rhawal='';break;                 	
    	            }
                	$gol_awal=$data[gol_darah].$rhawal;
                	$gol_akhir=$data[ResultABD].$data[ResultRh];
                ?>
                <input type="hidden" name=rsultrh[] value=<?=$rh_result?>>
				<td align='center'><?=$rhawal?></td>
                <td align='center' nowrap><input type="hidden" name=tglaftap[] value=<?=$data[tgl_Aftap]?>> 	<?=$data[tgl_Aftap]?></td>
                <td align='center' nowrap><input type="hidden" name=statusktg[] value=<?=$status_ktg?>> 	 	<?=$statuskantong?></td>
                <td align='center' nowrap><input type="hidden" name=kodedonor[] value=<?=$data[kodePendonor]?>> <?=$data[kodePendonor]?></td>                  
                <?php
                	if ($rhawal!==''){
                		if ($gol_awal==$gol_akhir){
                			?><td align='center' nowrap><input type="hidden" name=cocok[] value="0">Cocok</td><?
                		}else{
                			?><td align='center' nowrap><input type="hidden" name=cocok[] value="1">Tidak Cocok</td><?
                		}
                	} else {
                		?><td align='center' nowrap><input type="hidden" name=cocok[] value="1">-</td><?
                	}
                	$sel0="";$sel1="";$sel2="";
                	if ($status_ktg=="0"){$sel2="selected";}
                	if ($status_ktg=="1"){$sel1="selected";}
                	if ($status_ktg=="2"){$sel1="selected";}
                ?>
                <td align='left'>
                	<select name="aksi[]">
                		<option value="0" <?=$sel0?>>-</option>
                		<option value="1" <?=$sel1?>>Konfirmasi</option>
                		<option value="2" <?=$sel2?>>Tunda</option>
                	</select>
                </td>
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
            <td align="center" colspan="17">REAGEN/BAHAN HABIS PAKAI YANG TERPAKAI</td>
        </tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">No.</td>
            <td align="center" colspan="5">Reagan/Bahan Habis Pakai</td>
            <td align="center" colspan="4">Barcode</td>
            <td align="center" colspan="3">Batch</td>	
            <td align="center" colspan="2">ED</td>
            <td align="center" colspan="2">Ket</td>
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
            <td colspan="2"></td>
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
                <td colspan="2"></td>
            </tr>
            <?
        }
        ?>

        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Dikonfirmasi oleh</td>
		<input type="hidden" name="konfirmasi" value="<?=$namauser?>">
		<td colspan="5" align="left"> <?echo $namalengkap;?></td>
        <td colspan="10" rowspan="3" align="left" style="background-color: ghostwhite; color: #000000">
                <ol>
                    <li>Kantong yang diproses adalah kantong yang terdaftar dalam sistem</li>
                    <li>Pilihan <b>konfirmasi</b> : apabila ada <b>ketidakcocokan</b> antara golongan darah awal dengan hasil pemeriksaan konfirmasi golongan darah, maka semua data golongan darah yang terkait akan otomatis <b>diubah</b> sesuai hasil Konfirmasi Golongan Darah</li>
                    <li>Operator Qwalys 3 <b>HARUS SAMA</b> dengan username yang ada di SIMDONDAR agar proses <i>trace data</i> akurat</li>
                </ol>
        </td>
	</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Operator Qwalys</td>
		<td colspan="5" align="left">
			<select name="operator" > <?
				$user1="select * from user where trim(id_user)<>'' and trim(`nama_lengkap`)<>'' ORDER BY `user`.`nama_lengkap` ASC";
				$do1=mysql_query($user1);
				while($data1=mysql_fetch_assoc($do1)) {
					if (strtoupper($data1[id_user])==strtoupper($operator)){
						$select=" selected";
					} else{
						$select="";
					}?>
					<option value="<?=$data1[id_user]?>"<?=$select?>><?=$data1[nama_lengkap]?></option><?
				}?>
			</select>
		</td>
	</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Disahkan Oleh</td>
		<td colspan="5" align="left">
			<select name="disahkan_oleh" > <?
				$user="select * from user where trim(id_user)<>'' and trim(`nama_lengkap`)<>'' ORDER BY `user`.`nama_lengkap` ASC";
				$do=mysql_query($user);
				while($data=mysql_fetch_assoc($do)) {
					$select1="";?>
					<option value="<?=$data[id_user]?>"<?=$select1?>><?=$data[nama_lengkap]?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	</table>
	<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah">
	<a href="pmikonfirmasi.php?module=konfirm_abd"class="swn_button_blue">Kembali ke list data</a>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
    <?
    if ($no!==0){?>
	    <input type="submit" name="Button" value="Proses Konfirmasi" title="Proses kantong" class="swn_button_red">
    <?}?>
</form>
<?php } ?>
</body>
</html>
