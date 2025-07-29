<?php
//include("syn_config.php");
//include("syn_init.php");
$start_proses=new DateTime(date("Y-m-d H:i:s"));
$q_ikgd="INSERT INTO `dkonfirmasi`(`kgdutd`, `kgdnotrans`, `kgdtanggal`, `kgdnokantong`, `kgdgolda`, `kgdrhesus`, `kgdket`,
        `kgdcocok`, `kgdgoldaasal`, `kgdrhesusasal`, `kgdmetode`,  `kgdsel`, `kgdantia`, `kgdantib`, `kgdantio`, `kgdserum`,
        `kgdtsa`, `kgdtsb`, `kgdtso`, `kgdantid`, `kgdac`, `kgdba`, `kgdlotaa`, `kgdedaa`, `kgdlotab`, `kgdedab`, `kgdlotad`,
        `kgdedad`, `kgduser`) VALUES(:vkgdutd, :vkgdnotrans, :vkgdtanggal, :vkgdnokantong, :vkgdgolda, :vkgdrhesus,	:vkgdket,
        :vkgdcocok, :vkgdgoldaasal, :vkgdrhesusasal, :vkgdmetode, :vkgdsel,	:vkgdantia, :vkgdantib, :vkgdantio, :vkgdserum,
        :vkgdtsa, :vkgdtsb, :vkgdtso, :vkgdantid, :vkgdac, :vkgdba, :vkgdlotaa, :vkgdedaa, :vkgdlotab,
	    :vkgdedab, :vkgdlotad, :vkgdedad, :vkgduser)";

$q_ukgd="UPDATE `dkonfirmasi` SET
        `kgdgolda` = :vkgdgolda,  `kgdrhesus` = :vkgdrhesus,  `kgdket` = :vkgdket,  `kgdcocok` = :vkgdcocok,
        `kgdgoldaasal` = :vkgdgoldaasal,  `kgdrhesusasal` = :vkgdrhesusasal,  `kgdmetode` = :vkgdmetode,
        `kgdsel` = :vkgdsel,  `kgdantia` = :vkgdantia,  `kgdantib` = :vkgdantib,  `kgdantio` = :vkgdantio,
        `kgdserum` = :vkgdserum,  `kgdtsa` = :vkgdtsa,  `kgdtsb` = :vkgdtsb,  `kgdtso` = :vkgdtso,
        `kgdantid` = :vkgdantid,  `kgdac` = :vkgdac,  `kgdba` = :vkgdba,  `kgdlotaa` = :vkgdlotaa,
        `kgdedaa` = :vkgdedaa,  `kgdlotab` = :vkgdlotab,  `kgdedab` = :vkedab,  `kgdlotad` = :vklotad,
        `kgdedad` = :vkedad,  `kgduser` = :vkuser WHERE  `kgdutd` = :vkgdutd AND  `kgdnotrans` = :vkgdnotrans AND
        `kgdtanggal` = :vkgdtanggal AND  `kgdnokantong` = :vkgdnokantong";

$q_kgd=$dblocal->prepare("SELECT `NoKonfirmasi`, `NoKantong`, `GolDarah`, `Rhesus`, `ket`, `Cocok`, `tgl`, `petugas`, `goldarah_asal`,
        `rhesus_asal`, `metode`, `sel`, `antiA`, `antiB`, `antiO`, `serum`, `tA`, `tB`, `tsO`, `antiD`, `ac`, `ba`,
        `nolot_aa`, `expa`, `nolot_ab`, `expb`, `nolot_ad`, `expd`, `up_data`  FROM `dkonfirmasi`
        WHERE (`up_data` IN (0,2)) AND (`tgl` IS NOT NULL) LIMIT $jmldataupload");
$q_kgd->execute();
$q_update_up_lokal=("update `dkonfirmasi` set up_data='1' WHERE (`NoKonfirmasi` = :pnokonfirmasi) AND (tgl=:ptgl) AND (NoKantong=:pnokantong)");
$no=0;	
$results=$q_kgd->fetchAll();
$qry_ok="";
foreach($results as $result){
	if($result['up_data']==0){
        if($result['tgl']=='0000-00-00 00:00:00'){$tgl=NULL;} else{$tgl=$result['tgl'];}
        if($result['expa']=='0000-00-00'){$tglexpa=NULL;} else{$tglexpa=$result['expa'];}
        if($result['expb']=='0000-00-00'){$tglexpb=NULL;} else{$tglexpb=$result['expb'];}
        if($result['expd']=='0000-00-00'){$tglexpd=NULL;} else{$tglexpd=$result['expb'];}
        
		try{
	        $q_insertpusat=$dbpusat->prepare($q_ikgd);
            $q_insertpusat->bindParam(':vkgdutd', $row['id']);
            $q_insertpusat->bindParam(':vkgdnotrans', $result['NoKonfirmasi']);
            $q_insertpusat->bindParam(':vkgdtanggal', $tgl);
            $q_insertpusat->bindParam(':vkgdnokantong', $result['NoKantong']);
            $q_insertpusat->bindParam(':vkgdgolda', $result['GolDarah']);
            $q_insertpusat->bindParam(':vkgdrhesus', $result['Rhesus']);
            $q_insertpusat->bindParam(':vkgdket', $result['ket']);
            $q_insertpusat->bindParam(':vkgdcocok', $result['Cocok']);
            $q_insertpusat->bindParam(':vkgdgoldaasal', $result['goldarah_asal']);
            $q_insertpusat->bindParam(':vkgdrhesusasal', $result['rhesus_asal']);
            $q_insertpusat->bindParam(':vkgdmetode', $result['metode']);
            $q_insertpusat->bindParam(':vkgdsel', $result['sel']);
            $q_insertpusat->bindParam(':vkgdantia', $result['antiA']);
            $q_insertpusat->bindParam(':vkgdantib', $result['antiB']);
            $q_insertpusat->bindParam(':vkgdantio', $result['antiO']);
            $q_insertpusat->bindParam(':vkgdserum', $result['serum']);
            $q_insertpusat->bindParam(':vkgdtsa', $result['tA']);
            $q_insertpusat->bindParam(':vkgdtsb', $result['tB']);
            $q_insertpusat->bindParam(':vkgdtso', $result['tsO']);
            $q_insertpusat->bindParam(':vkgdantid', $result['antiD']);
            $q_insertpusat->bindParam(':vkgdac', $result['ac']);
            $q_insertpusat->bindParam(':vkgdba', $result['ba']);
            $q_insertpusat->bindParam(':vkgdlotaa', $result['nolot_aa']);
            $q_insertpusat->bindParam(':vkgdedaa', $tglexpa);
            $q_insertpusat->bindParam(':vkgdlotab', $result['nolot_ab']);
            $q_insertpusat->bindParam(':vkgdedab', $tglexpb);
            $q_insertpusat->bindParam(':vkgdlotad', $result['nolot_ad']);
            $q_insertpusat->bindParam(':vkgdedad', $tglexpd);
            $q_insertpusat->bindParam(':vkgduser', $result['petugas']);
    	    $q_insertpusat->execute();
    	    $q_time=date("h:i:s");
    	    $qry_ok='I-Ok';
		} catch(PDOException $ex) {
   			//handle me.
   			$qry_ok=$ex;
		}
	} else {
		try{
            $q_updatepusat=$dbpusat->prepare($q_ukgd);
            $q_updatepusat->bindParam(':vkgdutd', $row['id']);
            $q_updatepusat->bindParam(':vkgdnotrans', $result['NoKonfirmasi']);
            $q_updatepusat->bindParam(':vkgdtanggal', $tgl);
            $q_updatepusat->bindParam(':vkgdnokantong', $result['noKantong']);
            $q_updatepusat->bindParam(':vkgdgolda', $result['GolDarah']);
            $q_updatepusat->bindParam(':vkgdrhesus', $result['Rhesus']);
            $q_updatepusat->bindParam(':vkgdket', $result['ket']);
            $q_updatepusat->bindParam(':vkgdcocok', $result['Cocok']);
            $q_updatepusat->bindParam(':vkgdgoldaasal', $result['goldarah_asal']);
            $q_updatepusat->bindParam(':vkgdrhesusasal', $result['rhesus_asal']);
            $q_updatepusat->bindParam(':vkgdmetode', $result['metode']);
            $q_updatepusat->bindParam(':vkgdsel', $result['sel']);
            $q_updatepusat->bindParam(':vkgdantia', $result['antiA']);
            $q_updatepusat->bindParam(':vkgdantib', $result['antiB']);
            $q_updatepusat->bindParam(':vkgdantio', $result['antiO']);
            $q_updatepusat->bindParam(':vkgdserum', $result['serum']);
            $q_updatepusat->bindParam(':vkgdtsa', $result['tA']);
            $q_updatepusat->bindParam(':vkgdtsb', $result['tB']);
            $q_updatepusat->bindParam(':vkgdtso', $result['tsO']);
            $q_updatepusat->bindParam(':vkgdantid', $result['antiD']);
            $q_updatepusat->bindParam(':vkgdac', $result['ac']);
            $q_updatepusat->bindParam(':vkgdba', $result['ba']);
            $q_updatepusat->bindParam(':vkgdlotaa', $result['nolot_aa']);
            $q_updatepusat->bindParam(':vkgdedaa', $result['expa']);
            $q_updatepusat->bindParam(':vkgdlotab', $result['nolot_ab']);
            $q_updatepusat->bindParam(':vkgdedab', $result['expb']);
            $q_updatepusat->bindParam(':vkgdlotad', $result['nolot_ad']);
            $q_updatepusat->bindParam(':vkgdedad', $result['expd']);
            $q_updatepusat->bindParam(':vkgduser', $result['petugas']);
            $q_updatepusat->execute();
    	    $q_time=date("h:i:s");
    	    $qry_ok='U-Ok';
		} catch(PDOException $ex) {
   			$qry_ok=$ex;
		}
	}
	$noktg=$result['NoKantong'];$ntrans=$result['NoKonfirmasi'];$tgll=$result['tgl'];
	if (($qry_ok=='I-Ok')or ($qry_ok=='U-Ok') or ($ex->errorInfo[1] == 1062)){
		$update_up_local=$dblocal->prepare($q_update_up_lokal);
    	$update_up_local->bindParam(':pnokonfirmasi', $ntrans);
        $update_up_local->bindParam(':ptgl', $tgll);
        $update_up_local->bindParam(':pnokantong', $noktg);
		$update_up_local->execute();
	}
	$no++;
	$q_time=date('H:i:s').' WIB';
	print "$no \t $noktg \t$tgll\t$ntrans \t$q_time $qry_ok\n";
}
$end_proses= new DateTime(date("Y-m-d H:i:s"));
$interval = $start_proses->diff($end_proses);
echo "Kantong: ".$no." Data, " .$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
