<?php
//include("syn_config.php");
//include("syn_init.php");
$start_proses=new DateTime(date("Y-m-d H:i:s"));
$q_iktg="INSERT INTO  `stokkantong`(`skutd`, `sknokantong`, `sknolotktg`, `sktgledkantong`, `skmerk`, `skjenis`,
        `skvolumeasal`, `sktglbarcode`, `sktglmutasi`, `sktglaftap`, `skkodependonor`, `skkodependonorlama`,
        `skgoldarah`, `skrhesus`, `skstatus`, `skproduk`, `skvolume`, `sksah`, `skisi`, `sktglimltd`, `sktglnat`,
        `skhasilimltd`, `skhasilnat`, `skkantongasal`, `sktglpengolahan`, `sktgledproduk`, `sktglkeluar`,
        `skstart2`, `skstattempat`, `skstatkonfirmasi`, `skstatqa`, `skasalutd`, `skmu`, `skstokcheck`, `skident`, `sknoselang`)
        VALUES(
        :putd, :pnoktg, :pnolot, :pedktg, :pmerk, :pjenis, :pvolasal, :ptglbarcode, :ptglmutasi, :ptglaftap,
        :pkodedonor, :pkodedonorlama, :pgolda, :prhesus, :pstatus, :pproduk, :pvolproduk, :psah, :pisi,
        :ptglimltd, :ptglnat, :phasilimltd, :phasilnat, :pkantongasal, :ptglolah, :ptgledproduk, :ptglkeluar,
        :pstart2, :pstattempat, :pkonfirmasi, :pQA, :pasalutd, :pmu, :pstokcheck, :pident, :pnoselang)";

$q_uktg="UPDATE `stokkantong` SET   `sknolotktg` = :pnolot,  `sktgledkantong` = :pedktg,  `skmerk` = :pmerk,
        `skjenis` = :pjenis,  `skvolumeasal` = :pvolasal,  `sktglbarcode` = :ptglbarcode,  `sktglmutasi` = :ptglmutasi,
        `sktglaftap` = :ptglaftap,  `skkodependonor` = :pkodedonor,  `skkodependonorlama` = :pkodedonorlama,
        `skgoldarah` = :pgolda,  `skrhesus` = :prhesus,  `skstatus` = :pstatus,  `skproduk` = :pproduk,
        `skvolume` = :pvolproduk,  `sksah` = :psah,  `skisi` = :pisi,  `sktglimltd` = :ptglimltd,  `sktglnat` = :ptglnat,
        `skhasilimltd` = :phasilimltd,  `skhasilnat` = :phasilnat,  `skkantongasal` = :pkantongasal,  `sktglpengolahan` = :ptglolah,
        `sktgledproduk` = :ptgledproduk,  `sktglkeluar` = :ptglkeluar,  `skstart2` = :pstart2,  `skstattempat` = :pstattempat,
        `skstatkonfirmasi` = :pkonfirmasi,  `skstatqa` = :pQA,  `skasalutd` = :pasalutd,  `skmu` = :pmu,
        `skstokcheck` = :pstokcheck,  `skident` = :pident, `sknoselang`=:pnoselang	WHERE  `skutd` = :putd AND `sknokantong` = :pnoktg";

$q_ktg=$dblocal->prepare("SELECT `noKantong`, `jenis`, `Status`, `tglTerima`, `volume`, `merk`, `kantongAsal`, `produk`,
        `sah`, `Isi`, `gol_darah`, `RhesusDrh`, `stat2`, `StatTempat`, `kodePendonor`, `kodePendonor_lama`, `statKonfirmasi`,
        `statQC`, `AsalUTD`, `tgl_Aftap`, `kadaluwarsa`, `tglpengolahan`, `tglperiksa`, `mu`, `stokcheck`, `ident`, `volumeasal`,
        `tgl_keluar`, `tglmutasi`, `hasil`, `kadaluwarsa_ktg`, `nolot_ktg`, `hasilNAT`, `up_data` FROM `stokkantong`
        WHERE (`up_data` in (0,2)) AND (`Status` NOT IN (0,1)) AND (tgl_Aftap IS NOT NULL) LIMIT $jmldataupload");
$q_ktg->execute();
$q_update_up_lokal=("update `stokkantong` set up_data='1' WHERE `noKantong` = :pnokantong");
$no=0;	
$results=$q_ktg->fetchAll();
$qry_ok="";
foreach($results as $result){
	if($result['up_data']==0){
        if($result['tglTerima']=='0000-00-00'){$tglbarcode=NULL;} else{$tglbarcode=$result['tglTerima'];}
        if($result['kadaluwarsa_ktg']=='0000-00-00'){$tgledkantong=NULL;} else{$tgledkantong=$result['kadaluwarsa_ktg'];}
        if($result['tgl_Aftap']=='0000-00-00 00:00:00'){$tglaftap=NULL;} else{$tglaftap=$result['tgl_Aftap'];}
        if($result['kadaluwarsa']=='0000-00-00 00:00:00'){$tgled=NULL;} else{$tged=$result['kadaluwarsa'];}
        if($result['tglpengolahan']=='0000-00-00 00:00:00'){$tglolah=NULL;} else{$tglolah=$result['tglpengolahan'];}
        if($result['tglperiksa']=='0000-00-00 00:00:00'){$tglperiksa=NULL;} else{$tglperiksa=$result['tglperiksa'];}
        if($result['tgl_keluar']=='0000-00-00 00:00:00'){$tglkeluar=NULL;} else{$tglkeluar=$result['tgl_keluar'];}
        if($result['tglmutasi']=='0000-00-00 00:00:00'){$tglmutasi=NULL;} else{$tglmutasi=$result['tglmutasi'];}
        $tglnat=NULL;
        $noselang=$result['noKantong']; //ini harus dirubah setelah penetapan kode unik
		try{
	        $q_insertpusat=$dbpusat->prepare($q_iktg);
            $q_insertpusat->bindParam(':putd', $row['id']);
            $q_insertpusat->bindParam(':pnoktg', $result['noKantong']);
            $q_insertpusat->bindParam(':pnolot', $result['nolot_ktg']);
            $q_insertpusat->bindParam(':pedktg', $tgledkantong);
            $q_insertpusat->bindParam(':pmerk', $result['merk']);
            $q_insertpusat->bindParam(':pjenis', $result['jenis']);
            $q_insertpusat->bindParam(':pvolasal', $result['volumeasal']);
            $q_insertpusat->bindParam(':ptglbarcode', $tglbarcode);
            $q_insertpusat->bindParam(':ptglmutasi', $tglmutasi);
            $q_insertpusat->bindParam(':ptglaftap', $tglaftap);
            $q_insertpusat->bindParam(':pkodedonor', $result['kodePendonor']);
            $q_insertpusat->bindParam(':pkodedonorlama', $result['kodePendonor_lama']);
            $q_insertpusat->bindParam(':pgolda', $result['gol_darah']);
            $q_insertpusat->bindParam(':prhesus', $result['RhesusDrh']);
            $q_insertpusat->bindParam(':pstatus', $result['Status']);
            $q_insertpusat->bindParam(':pproduk', $result['produk']);
            $q_insertpusat->bindParam(':pvolproduk', $result['volume']);
            $q_insertpusat->bindParam(':psah', $result['sah']);
            $q_insertpusat->bindParam(':pisi', $result['Isi']);
            $q_insertpusat->bindParam(':ptglimltd', $tglperiksa);
            $q_insertpusat->bindParam(':ptglnat', $tglnat);
            $q_insertpusat->bindParam(':phasilimltd', $result['hasil']);
            $q_insertpusat->bindParam(':phasilnat', $result['hasilNAT']);
            $q_insertpusat->bindParam(':pkantongasal', $result['kantongAsal']);
            $q_insertpusat->bindParam(':ptglolah', $tglolah);
            $q_insertpusat->bindParam(':ptgledproduk', $tgled);
            $q_insertpusat->bindParam(':ptglkeluar', $tglkeluar);
            $q_insertpusat->bindParam(':pstart2', $result['stat2']);
            $q_insertpusat->bindParam(':pstattempat', $result['StatTempat']);
            $q_insertpusat->bindParam(':pkonfirmasi', $result['statKonfirmasi']);
            $q_insertpusat->bindParam(':pQA', $result['statQC']);
            $q_insertpusat->bindParam(':pasalutd', $result['AsalUTD']);
            $q_insertpusat->bindParam(':pmu', $result['mu']);
            $q_insertpusat->bindParam(':pstokcheck', $result['stokcheck']);
            $q_insertpusat->bindParam(':pident', $result['ident']);
            $q_insertpusat->bindParam(':pnoselang', $noselang);
    	    $q_insertpusat->execute();
    	    $q_time=date("h:i:s");
    	    $qry_ok='I-Ok';
		} catch(PDOException $ex) {
   			//handle me.
   			$qry_ok=$ex;
		}
	} else {
		try{
			$q_updatepusat=$dbpusat->prepare($q_uktg);
            $q_updatepusat->bindParam(':pnolot', $result['nolot_ktg']);
            $q_updatepusat->bindParam(':pedktg', $tgledkantong);
            $q_updatepusat->bindParam(':pmerk', $result['merk']);
            $q_updatepusat->bindParam(':pjenis', $result['jenis']);
            $q_updatepusat->bindParam(':pvolasal', $result['volumeasal']);
            $q_updatepusat->bindParam(':ptglbarcode', $tglbarcode);
            $q_updatepusat->bindParam(':ptglmutasi', $tglmutasi);
            $q_updatepusat->bindParam(':ptglaftap', $tglaftap);
            $q_updatepusat->bindParam(':pkodedonor', $result['kodePendonor']);
            $q_updatepusat->bindParam(':pkodedonorlama', $result['kodePendonor_lama']);
            $q_updatepusat->bindParam(':pgolda', $result['gol_darah']);
            $q_updatepusat->bindParam(':prhesus', $result['RhesusDrh']);
            $q_updatepusat->bindParam(':pstatus', $result['Status']);
            $q_updatepusat->bindParam(':pproduk', $result['produk']);
            $q_updatepusat->bindParam(':pvolproduk', $result['volume']);
            $q_updatepusat->bindParam(':psah', $result['sah']);
            $q_updatepusat->bindParam(':pisi', $result['Isi']);
            $q_updatepusat->bindParam(':ptglimltd', $tglperiksa);
            $q_updatepusat->bindParam(':ptglnat', $tglnat);
            $q_updatepusat->bindParam(':phasilimltd', $result['hasil']);
            $q_updatepusat->bindParam(':phasilnat', $result['hasilNAT']);
            $q_updatepusat->bindParam(':pkantongasal', $result['kantongAsal']);
            $q_updatepusat->bindParam(':ptglolah', $tglolah);
            $q_updatepusat->bindParam(':ptgledproduk', $tgled);
            $q_updatepusat->bindParam(':ptglkeluar', $tglkeluar);
            $q_updatepusat->bindParam(':pstart2', $result['stat2']);
            $q_updatepusat->bindParam(':pstattempat', $result['StatTempat']);
            $q_updatepusat->bindParam(':pkonfirmasi', $result['statKonfirmasi']);
            $q_updatepusat->bindParam(':pQA', $result['statQC']);
            $q_updatepusat->bindParam(':pasalutd', $result['AsalUTD']);
            $q_updatepusat->bindParam(':pmu', $result['mu']);
            $q_updatepusat->bindParam(':pstokcheck', $result['stokcheck']);
            $q_updatepusat->bindParam(':pident', $result['ident']);
            $q_insertpusat->bindParam(':pnoselang', $noselang);
            $q_updatepusat->bindParam(':putd', $row['id']);
            $q_updatepusat->bindParam(':pnoktg', $result['noKantong']);
    	    $q_updatepusat->execute();
    	    $q_time=date("h:i:s");
    	    $qry_ok='U-Ok';
		} catch(PDOException $ex) {
   			$qry_ok=$ex;
		}
	}

	if (($qry_ok=='I-Ok')or ($qry_ok=='U-Ok') or ($ex->errorInfo[1] == 1062)){
		$update_up_local=$dblocal->prepare($q_update_up_lokal);
    	$update_up_local->bindParam(':pnokantong', $result['noKantong']);
		$update_up_local->execute();
	}
	$no++;
	$q_time=date('H:i:s').' WIB';
	print "$no \t$result[noKantong] \t$q_time $qry_ok\n";
}
$end_proses= new DateTime(date("Y-m-d H:i:s"));
$interval = $start_proses->diff($end_proses);
echo "Kantong: ".$no." Data, " .$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
