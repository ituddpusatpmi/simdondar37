<?php
//include("syn_config.php");
$start_proses=new DateTime(date("Y-m-d H:i:s"));
$q_insert="INSERT INTO `dokter`(`drutd`, `drkode`, `drnama`, `dralamat`, `drtelp1`, `drtelp2`, `draktif`) VALUES
		(:vdrutd, :vdrkode, :vdrnama, :vdralamat, :vdrtelp1, :vdrtelp2, :vdraktif)";


$q_update=("UPDATE `dokter` SET `drnama` = :vdrnama, `dralamat` = :vdralamat, `drtelp1` = :vdrtelp1, `drtelp2` = :vdrtelp2, `draktif` = :vdraktif WHERE
		`drutd` = :vdrutd and `drkode` = :vdrkode");

$q_dokter=$dblocal->prepare("SELECT `kode`, `Nama`, `alamat`, `telp1`, `telp2`, `aktif`, `up_data` FROM `dokter_periksa` WHERE (`up_data`='0') or (`up_data`='2')");
$q_dokter->execute();
$q_update_up_lokal=("update dokter_periksa set up_data='1' WHERE kode = :vpkode");
$status_aksi='';
$no=0;	
$results=$q_dokter->fetchAll();
$qry_ok="";
foreach($results as $result)
{
	if($result['up_data']==0){
		$status_aksi='I---';
		try{
	            $q_insertpusat=$dbpusat->prepare($q_insert);
    	        $q_insertpusat->bindParam(':vdrutd', $row['id']);
    			$q_insertpusat->bindParam(':vdrkode', $result['kode']);
			    $q_insertpusat->bindParam(':vdrnama', $result['Nama']);
			    $q_insertpusat->bindParam(':vdralamat', $result['alamat']);
			    $q_insertpusat->bindParam(':vdrtelp1', $result['telp1']);
			    $q_insertpusat->bindParam(':vdrtelp2', $result['telp2']);
			    $q_insertpusat->bindParam(':vdraktif', $result['aktif']);
    	        $q_insertpusat->execute();
    	        $q_time=date("h:i:s");
    	        $qry_ok='Ok';
		} catch(PDOException $ex) {
   				//handle me.
   				$qry_ok=$ex;
		}
	} else {
				//update data pendonor pusat
		try{
				$status_aksi='-U--';
				$q_updatepusat=$dbpusat->prepare($q_update);
			    $q_updatepusat->bindParam(':vdrnama', $result['Nama']);
			    $q_updatepusat->bindParam(':vdralamat', $result['Alamat']);
			    $q_updatepusat->bindParam(':vdrtelp1', $result['telp1']);
			    $q_updatepusat->bindParam(':vdrtelp2', $result['telp2']);
			    $q_updatepusat->bindParam(':vdraktif', $result['aktif']);
			    $q_updatepusat->bindParam(':vdrutd', $row['id']);
    			$q_updatepusat->bindParam(':vdrkode', $result['kode']);
    	        $q_updatepusat->execute();		
    	        $q_time=date("h:i:s");
    	        $qry_ok='Ok';
		} catch(PDOException $ex) {
   			//handle me.
   				$qry_ok=$ex;
		}
	}
	//code update local data pendonor --> field up_data = 1
	if (($qry_ok=='Ok') or ($ex->errorInfo[1] == 1062)){
		$update_up_local=$dblocal->prepare($q_update_up_lokal);
    	$update_up_local->bindParam(':vpkode', $result['kode']);
		$update_up_local->execute();
	}
	$no++;
	$idd=$result['kode'];
	$q_time=date('H:i:s').' WIB';
	print "$no $idd $status_aksi $q_time $qry_ok\n"; 
}
$end_proses= new DateTime(date("Y-m-d H:i:s"));
$interval = $start_proses->diff($end_proses);
echo "Dokter ".$no." Data: ".$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";

