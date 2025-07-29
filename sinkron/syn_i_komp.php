<?php
//include("syn_config.php");
//include("syn_init.php");
$start_proses=new DateTime(date("Y-m-d H:i:s"));
$q_insert="INSERT INTO `dpengolahan`(`dputd`,`dpnokantong`,`dpproduk`,`dpuser`,`dptgl`,`dpmetode`,`dppisah`,`dpgolda`,`dprh`,`dpjenis`) VALUES(
    :vdputd, :vdpnokantong, :vdpproduk, :vdpuser, :vdptgl, :vdpmetode, :vdppisah, :vdpgolda, :vdprh, :vdpjenis)";

$q_komp=$dblocal->prepare("SELECT `noKantong`, `Produk`, `petugas`, `tgl`, `cara`, `pisah`, `goldarah`, `rhesus`, `jenis`, `up_data`
	FROM `dpengolahan` WHERE (`up_data` = '0' ) AND (`tgl`  IS NOT NULL) LIMIT $jmldataupload");
$q_komp->execute();
$q_updkomp=("update `dpengolahan` set up_data='1' WHERE `noKantong` = :vnoKantong");
$no=0;	
$results=$q_komp->fetchAll();
$qry_ok="";
foreach($results as $result){
		if($result['tgl']=='0000-00-00 00:00:00'){$tgl=NULL;} else{$tgl=$result['tgl'];}
		if($result['tgl']=='0000-00-00'){$tgl=NULL;} else{$tgl=$result['tgl'];}
		try{
            $q_insertpusat=$dbpusat->prepare($q_insert);
            $q_insertpusat->bindParam(':vdputd',$row['id']);
    		$q_insertpusat->bindParam(':vdpnokantong',$result['noKantong']);
		    $q_insertpusat->bindParam(':vdpproduk',$result['Produk']);
		    $q_insertpusat->bindParam(':vdpuser',$result['petugas']);
		    $q_insertpusat->bindParam(':vdptgl',$tgl);
		    $q_insertpusat->bindParam(':vdpmetode',$result['cara']);
		    $q_insertpusat->bindParam(':vdppisah',$result['pisah']);
		    $q_insertpusat->bindParam(':vdpgolda',$result['goldarah']);
		    $q_insertpusat->bindParam(':vdprh',$result['rhesus']);
		    $q_insertpusat->bindParam(':vdpjenis',$result['jenis']);
    	    $q_insertpusat->execute();
    	    $q_time=date("h:i:s");
    	    $qry_ok='I-Ok';
		} catch(PDOException $ex) {
   			//handle me.
   			$qry_ok=$ex;
		}
	if (($qry_ok=='I-Ok') or ($ex->errorInfo[1] == 1062)){
		$update_up_local=$dblocal->prepare($q_updkomp);
    	$update_up_local->bindParam(':vnoKantong', $result['noKantong']);
		$update_up_local->execute();
	}
	$no++;
    $ktg=$result['noKantong'];
	$q_time=date('H:i:s').' WIB';
	print "$no \t$ktg \t$q_time $qry_ok\n";
}
$end_proses= new DateTime(date("Y-m-d H:i:s"));
$interval = $start_proses->diff($end_proses);
echo "Pengolahan: ".$no." Data" .$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
