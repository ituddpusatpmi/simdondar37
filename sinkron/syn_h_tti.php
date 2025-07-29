<?php
//include("syn_config.php");
//include("syn_init.php");
$start_proses=new DateTime(date("Y-m-d H:i:s"));
$q_insert="INSERT INTO  `imltd` (    `ttiutd`,    `ttinotrans`,    `ttitgl`,    `ttinokantong`,    `ttimetode`,
    `ttinamareagen`,    `ttilotreagen`,    `ttiedreagen`,    `ttiod`,    `tticov`,    `ttihasil`,    `ttiuser`,
    `ttiusercek`,    `ttiusersah`,    `ttiulang`  )VALUES(
    :vttiutd,    :vttinotrans,    :vttitgl,    :vttinokantong,    :vttimetode,    :vttinamareagen,    :vttilotreagen,
    :vttiedreagen,    :vttiod,    :vtticov,    :vttihasil,    :vttiuser,    :vttiusercek,    :vttiusersah,    :vttiulang)";

$q_elisa=$dblocal->prepare("SELECT `hasilelisa`.`id`, `hasilelisa`.`noKantong` , `hasilelisa`.`OD` , `hasilelisa`.`COV` ,
    `hasilelisa`.`Hasil` , `hasilelisa`.`notrans` , `hasilelisa`.`jenisPeriksa` , `hasilelisa`.`tglPeriksa` , `hasilelisa`.`dicatatOleh` ,
    `hasilelisa`.`dicekOleh` , `hasilelisa`.`DisahkanOleh` , `hasilelisa`.`noLot` , `hasilelisa`.`Metode` , `hasilelisa`.`ulang` ,
    `reagen`.`Nama` , `reagen`.`noLot` , `reagen`.`tglKad` , `hasilelisa`.`up_data`
    FROM `hasilelisa` INNER JOIN `reagen` ON `reagen`.`kode` = `hasilelisa`.`noLot`
     WHERE (`hasilelisa`.`up_data` = '0' ) AND (`hasilelisa`.`tglPeriksa`  IS NOT NULL) LIMIT $jmldataupload");
$q_elisa->execute();
$q_updelisa=("update `hasilelisa` set up_data='1' WHERE `id` = :vid");
$no=0;	
$results=$q_elisa->fetchAll();
$qry_ok="";
foreach($results as $result){
		try{
            $q_insertpusat=$dbpusat->prepare($q_insert);
            $q_insertpusat->bindParam(':vttiutd', $row['id']);
            $q_insertpusat->bindParam(':vttinotrans', $result['notrans']);
            $q_insertpusat->bindParam(':vttitgl', $result['tglPeriksa']);
            $q_insertpusat->bindParam(':vttinokantong', $result['noKantong']);
            $q_insertpusat->bindParam(':vttimetode', $result['Metode']);
            $q_insertpusat->bindParam(':vttinamareagen', $result['Nama']);
            $q_insertpusat->bindParam(':vttilotreagen', $result['noLot']);
            $q_insertpusat->bindParam(':vttiedreagen', $result['tglKad']);
            $q_insertpusat->bindParam(':vttiod', $result['OD']);
            $q_insertpusat->bindParam(':vtticov', $result['COV']);
            $q_insertpusat->bindParam(':vttihasil', $result['Hasil']);
            $q_insertpusat->bindParam(':vttiuser', $result['dicatatOleh']);
            $q_insertpusat->bindParam(':vttiusercek', $result['dicekOleh']);
            $q_insertpusat->bindParam(':vttiusersah', $result['DisahkanOleh']);
            $q_insertpusat->bindParam(':vttiulang', $result['ulang']);
    	    $q_insertpusat->execute();
    	    $q_time=date("h:i:s");
    	    $qry_ok='I-Ok';
		} catch(PDOException $ex) {
   			//handle me.
   			$qry_ok=$ex;
		}
	if (($qry_ok=='I-Ok') or ($ex->errorInfo[1] == 1062)){
		$update_up_local=$dblocal->prepare($q_updelisa);
    	$update_up_local->bindParam(':vid', $result['id']);
		$update_up_local->execute();
	}
	$no++;
	$idd=$result['id'];
    $ktg=$result['noKantong'];
	$q_time=date('H:i:s').' WIB';
	print "$no \t$idd \t$ktg \t$q_time $qry_ok\n";
}
$end_proses= new DateTime(date("Y-m-d H:i:s"));
$interval = $start_proses->diff($end_proses);
echo "Elisa: ".$no." Data" .$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
