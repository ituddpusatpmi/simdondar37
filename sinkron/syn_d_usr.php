<?php
//include("config.php");
$start_proses=new DateTime(date("Y-m-d H:i:s"));
$q_insert="INSERT INTO `user`(`usrutd`,`usrid_user`,`usrnama_lengkap`,`usremail`,`usrlevel`,`usrmulti`,`usrtelp`)VALUES
		  (:vusrutd, :vusrid_user, :vusrnama_lengkap, :vusremail, :vusrlevel, :vusrmulti, :vusrtelp)";


$q_update=("UPDATE `user` SET `usrnama_lengkap` = :vusrnama_lengkap,  `usremail` = :vusremail,  `usrlevel` = :vusrlevel,
		`usrmulti` = :vusrmulti,  `usrtelp` = :vusrtelp WHERE `usrutd` = :vusrutd and `usrid_user` = :vusrid_user");

$q_user=$dblocal->prepare("SELECT `id_user`,  `nama_lengkap`, `email`, `level`, `multi`, `telp`, `up_data` FROM `user` WHERE (`up_data`='0') or (`up_data`='2')");
$q_user->execute();
$q_update_up_lokal=("update `user` set up_data='1' WHERE id_user = :vid_user");
$status_aksi='';
$no=0;	
$results=$q_user->fetchAll();
$qry_ok="";
foreach($results as $result)
{
	if($result['up_data']==0){
		$status_aksi='I---';
		try{
	            $q_insertpusat=$dbpusat->prepare($q_insert);
    	        $q_insertpusat->bindParam(':vusrutd', $row['id']);
    			$q_insertpusat->bindParam(':vusrid_user', $result['id_user']);
			    $q_insertpusat->bindParam(':vusrnama_lengkap', $result['nama_lengkap']);
			    $q_insertpusat->bindParam(':vusremail', $result['email']);
			    $q_insertpusat->bindParam(':vusrlevel', $result['level']);
			    $q_insertpusat->bindParam(':vusrmulti', $result['multi']);
			    $q_insertpusat->bindParam(':vusrtelp', $result['telp']);
    	        $q_insertpusat->execute();
    	        $q_time=date("h:i:s");
    	        $qry_ok='Ok';
		} catch(PDOException $ex) {
   				//handle me.
   				$qry_ok='Error';
		}
	} else {
		try{
				$status_aksi='-U--';
				$q_updatepusat=$dbpusat->prepare($q_update);
			    $q_updatepusat->bindParam(':vusrnama_lengkap', $result['nama_lengkap']);
			    $q_updatepusat->bindParam(':vusremail', $result['email']);
			    $q_updatepusat->bindParam(':vusrlevel', $result['level']);
			    $q_updatepusat->bindParam(':vusrmulti', $result['multi']);
			    $q_updatepusat->bindParam(':vusrtelp', $result['telp']);
    	        $q_updatepusat->bindParam(':vusrutd', $row['id']);
    			$q_updatepusat->bindParam(':vusrid_user', $result['id_user']);
    	        $q_updatepusat->execute();		
    	        $q_time=date("h:i:s");
    	        $qry_ok='Ok';
		} catch(PDOException $ex) {
   				$qry_ok=$ex;
		}
	}

	if (($qry_ok=='Ok') or ($ex->errorInfo[1] == 1062)){
		$update_up_local=$dblocal->prepare($q_update_up_lokal);
    	$update_up_local->bindParam(':vid_user', $result['id_user']);
		$update_up_local->execute();
	}
	$no++;
	$idd=$result['id_user'];
	$q_time=date('H:i:s').' WIB';
	print "$no $idd $status_aksi $q_time $qry_ok\n"; 
}
$end_proses= new DateTime(date("Y-m-d H:i:s"));
$interval = $start_proses->diff($end_proses);
echo "User: ".$no." Data" .$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
