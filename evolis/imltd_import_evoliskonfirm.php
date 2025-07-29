<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
<script src="bootsrap337/js/html5shiv.min.js"></script>
<script src="bootsrap337/js/respond.min.js"></script>
<link href="bootsrap337/bspmi.css" rel="stylesheet">
<script src="bootsrap337/js/jquery.min.js"></script>
<script src="bootsrap337/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bootsrap337/fonts/font-awesome.min.css" />
<link type="text/css" href="css/calender.css" rel="stylesheet" /> 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style>
    .sdw{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .reactive{
        color:red;
    }
</style>
<?php 
$namauser=$_SESSION['namauser'];
$namalengkap=$_SESSION['nama_lengkap'];
$lanjut=0;
if ($_POST['proseskonfirmasi']){
    // echo var_dump($_POST);
    $tanggal=date('Y-m-d H:i:s');
    $v_reagb = $_POST['ReagenHbsag'];
        $ex_reagb=explode("|",$v_reagb);
        $v_reagb_nama=$ex_reagb[0];
        $v_reagb_lot=$ex_reagb[1];
        $v_reagb_ed=$ex_reagb[2];
        $v_reagb_kode=$ex_reagb[3];
        $v_reagb_metode=$ex_reagb[4];
        $v_reagb_tes=$ex_reagb[5];
        
    $v_reagc = $_POST['ReagenHCV'];
        $ex_reagc=explode("|",$v_reagc);
        $v_reagc_nama=$ex_reagc[0];
        $v_reagc_lot=$ex_reagc[1];
        $v_reagc_ed=$ex_reagc[2];
        $v_reagc_kode=$ex_reagc[3];
        $v_reagc_metode=$ex_reagb[4];
        $v_reagc_tes=$ex_reagc[5];
    $v_reagi = $_POST['ReagenHIV'];
        $ex_reagi=explode("|",$v_reagi);
        $v_reagi_nama=$ex_reagi[0];
        $v_reagi_lot=$ex_reagi[1];
        $v_reagi_ed=$ex_reagi[2];
        $v_reagi_kode=$ex_reagi[3];
        $v_reagi_metode=$ex_reagb[4];
        $v_reagi_tes=$ex_reagi[5];
    $v_reags = $_POST['ReagenSYP'];
        $ex_reags=explode("|",$v_reags);
        $v_reags_nama=$ex_reags[0];
        $v_reags_lot=$ex_reags[1];
        $v_reags_ed=$ex_reags[2];
        $v_reags_kode=$ex_reags[3];
        $v_reags_metode=$ex_reagb[4];
        $v_reags_tes=$ex_reags[5];
    $v_tempID = $_POST['inpTmpID'];
    $v_nokantong=$_POST['inpkantong'];
    $v_action = $_POST['konfirmasi'];
    $v_jmlperiksab=$_POST['InptJmlTes_b'];
    $v_jmlperiksac=$_POST['InptJmlTes_c'];
    $v_jmlperiksai=$_POST['InptJmlTes_i'];
    $v_jmlperiksas=$_POST['InptJmlTes_s'];
    $v_pemeriksa = $_POST['inptOperator'];
    $v_konfirmasi = $_POST['InpKonfimrasi'];
    $v_pengesah = $_POST['inptpengesah'];
    
    if ($v_reagb_tes<$v_jmlperiksab){echo '<br>Sisa Reagen HbsAg tidak mencukupi -> Sample HBsAG:'.$v_jmlperiksab.', Sisa Reagen:'.$v_reagb_tes;$lanjut=1;}
    if ($v_reagc_tes<$v_jmlperiksac){echo '<br>Sisa Reagen HCV tidak mencukupi -> Sample HCV:'.$v_jmlperiksac.', Sisa Reagen:'.$v_reagc_tes;$lanjut=1;}
    if ($v_reagi_tes<$v_jmlperiksai){echo '<br>Sisa Reagen HIV tidak mencukupi -> Sample HIV:'.$v_jmlperiksac.', Sisa Reagen:'.$v_reagi_tes;$lanjut=1;}
    if ($v_reags_tes<$v_jmlperiksas){echo '<br>Sisa Reagen TPHA tidak mencukupi -> Sample TPHA:'.$v_jmlperiksac.', Sisa Reagen:'.$v_reags_tes;$lanjut=1;}
    if ($lanjut=='0'){
        echo '<br>Proses konfirmasi';
        $jmlreag_b=0;
        $jmlreag_c=0;
        $jmlreag_i=0;
        $jmlreag_s=0;
        //Generated NoTransaksi===============================================
		$dta_elisa	= mysqli_fetch_assoc(mysqli_query($dbi,"SELECT MAX(CONVERT(notrans, SIGNED INTEGER)) AS Kode FROM pmi.hasilelisa"));
		$int_elisa  = (int)($dta_elisa['Kode']);
		$int_no=$int_elisa;
		$int_no_inc=(int)$int_no+1;
		$j_nol= 8-(strlen(strval($int_no_inc)));
		for ($i=0; $i<$j_nol; $i++){$no_tmp .="0";}
		$notrans = $no_tmp.$int_no_inc;
		echo "<br>No. Transaksi :  ".$notrans;
		//------------ END Generate no transaksi ---------------
        for ($i=0;$i<count($v_tempID);$i++) {
            $d_id = $v_tempID[$i];
            $d_kantong = $v_nokantong[$i];
            $d_action = $v_action[$i];
            echo '<br>'.$d_id.': '.$d_kantong.' - '.$d_action;
            if ($d_action!="3"){
                $temp=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * FROM `imltd_import_temp` WHERE `id`='$d_id'"));
                $trx=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT KodePendonor, umur, donorbaru, JenisDonor FROM htransaksi WHERE NoKantong='$d_kantong'"));
                $idpendonor =$trx['KodePendonor'];
                $umur       =$trx['umur'];
                $jenisdonor =$trx['JenisDonor'];
                $donorbaru  =$trx['donorbaru'];
                $cekal_b=$cekal_c=$cekal_i=$cekal_s='0';
                $b_od=$temp['hbsag_od'];
                $b_cov=$temp['hbsag_cut_off'];
                $b_results=$temp['hbsag_result'];
                if($b_results=='REACTIVE'){$b_result="1";$cekal_b='1';}elseif($b_results=='NEG'){$b_result="0";}else{$b_result="2";}

                $c_od=$temp['hcv_od'];
                $c_cov=$temp['hcv_cut_off'];
                $c_results=$temp['hcv_result'];
                if($c_results=='REACTIVE'){$c_result="1";$cekal_c='1';}elseif($c_results=='NEG'){$c_result="0";}else{$c_result="2";}

                $i_od=$temp['hiv_od'];
                $i_cov=$temp['hiv_cut_off'];
                $i_results=$temp['hiv_result'];
                if($i_results=='REACTIVE'){$i_result="1";$cekal_i='1';}elseif($i_results=='NEG'){$i_result="0";}else{$i_result="2";}
                 
                $s_od=$temp['syp_od'];
                $s_cov=$temp['syp_cut_off'];
                $s_results=$temp['syp_result'];
                if($s_results=='REACTIVE'){$s_result="1";$cekal_s='1';}elseif($s_results=='NEG'){$s_result="0";}else{$s_result="2";}

                if ($b_result!==""){$jmlreag_b++;}
                if ($c_result!==""){$jmlreag_c++;}
                if ($i_result!==""){$jmlreag_i++;}
                if ($s_result!==""){$jmlreag_s++;}

                $upd_temp=mysqli_query($dbi,"UPDATE `imltd_import_temp` SET `sudah_proses`='1' WHERE `id`='$d_id'");
                if ($b_results!=""){
                $sq_hbsag=mysqli_query($dbi,"INSERT INTO `hasilelisa` (`noKantong`,`OD`,`COV`,`Hasil`,`notrans`,`jenisPeriksa`,`tglPeriksa`,`dicatatOleh`,`dicekOleh`,`DisahkanOleh`,`nolot`,`Metode`, `umur`, `jns_donor`, `baru_ulang`)
						   VALUE ('$d_kantong','$b_od','$b_cov','$b_result','$notrans','0','$tanggal', '$v_pemeriksa','$v_konfirmasi','$v_pengesah','$v_reagb_lot','$v_reagb_metode','$umur', '$jenisdonor', '$donorbaru')");
                           if ($sq_hbsag){echo "-  b ";}else{echo '- b error ';}
                }
                if ($c_results!=""){
                    $sq_hcv=mysqli_query($dbi,"INSERT INTO `hasilelisa` (`noKantong`,`OD`,`COV`,`Hasil`,`notrans`,`jenisPeriksa`,`tglPeriksa`,`dicatatOleh`,`dicekOleh`,`DisahkanOleh`,`nolot`,`Metode`, `umur`, `jns_donor`, `baru_ulang`)
                               VALUE ('$d_kantong','$c_od','$c_cov','$c_result','$notrans','1','$tanggal', '$v_pemeriksa','$v_konfirmasi','$v_pengesah','$v_reagc_lot','$v_reagc_metode','$umur', '$jenisdonor', '$donorbaru')");
                               if ($sq_hbsag){echo "-  c ";}else{echo '- c error ';}
                }
                if ($i_results!=""){
                    $sq_hiv=mysqli_query($dbi,"INSERT INTO `hasilelisa` (`noKantong`,`OD`,`COV`,`Hasil`,`notrans`,`jenisPeriksa`,`tglPeriksa`,`dicatatOleh`,`dicekOleh`,`DisahkanOleh`,`nolot`,`Metode`, `umur`, `jns_donor`, `baru_ulang`)
                               VALUE ('$d_kantong','$i_od','$i_cov','$i_result','$notrans','2','$tanggal', '$v_pemeriksa','$v_konfirmasi','$v_pengesah','$v_reagi_lot','$v_reagi_metode','$umur', '$jenisdonor', '$donorbaru')");
                               if ($sq_hbsag){echo "-  i ";}else{echo '- i error ';}
                }
                if ($s_results!=""){
                    $sq_syp=mysqli_query($dbi,"INSERT INTO `hasilelisa` (`noKantong`,`OD`,`COV`,`Hasil`,`notrans`,`jenisPeriksa`,`tglPeriksa`,`dicatatOleh`,`dicekOleh`,`DisahkanOleh`,`nolot`,`Metode`, `umur`, `jns_donor`, `baru_ulang`)
                               VALUE ('$d_kantong','$s_od','$s_cov','$s_result','$notrans','3','$tanggal', '$v_pemeriksa','$v_konfirmasi','$v_pengesah','$v_reags_lot','$v_reags_metode','$umur', '$jenisdonor', '$donorbaru')");
                               if ($sq_hbsag){echo "-  s ";}else{echo '- s error ';}
                }    
                $kantong_0  = substr($d_kantong,0,-1);
                $nkantong_a	= $kantong_0.'A';
                $nkantong_b	= $kantong_0.'B';
                $nkantong_c	= $kantong_0.'C';
                $nkantong_d	= $kantong_0.'D';
                $nkantong_e	= $kantong_0.'E';
                $nkantong_f	= $kantong_0.'F';
                $nkantong_g	= $kantong_0.'G';
                if ($d_action=='1'){
                    $upd_ktgo=mysqli_query($dbi,"UPDATE `stokkantong` set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tanggal' where NoKantong='$nkantong_a'");
                    $upd_ktgo=mysqli_query($dbi,"UPDATE `stokkantong` set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tanggal' where NoKantong='$nkantong_b'");
                    $upd_ktgo=mysqli_query($dbi,"UPDATE `stokkantong` set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tanggal' where NoKantong='$nkantong_c'");
                    $upd_ktgo=mysqli_query($dbi,"UPDATE `stokkantong` set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tanggal' where NoKantong='$nkantong_d'");
                    $upd_ktgo=mysqli_query($dbi,"UPDATE `stokkantong` set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tanggal' where NoKantong='$nkantong_e'");
                    $upd_ktgo=mysqli_query($dbi,"UPDATE `stokkantong` set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tanggal' where NoKantong='$nkantong_f'");
                    $sql_htrans=mysqli_query($dbi,"UPDATE `htransaksi` SET `status_test`='0', `hasil_hbsag`='0', `hasil_hcv`='0', `hasil_hiv`='0', `hasil_syp`='0', `tglperiksa`='$tanggal' where NoKantong='$d_kantong'");
                    echo "- Stokkantong ".$d_kantong." Sehat ";
                }
                //if ($aksi_konfirm=="2"){
                if ($d_action=="2"){
/**
                    $pendonor	=mysqli_query($dbi,"select `kodePendonor` as `kode` from `htransaksi` where `NoKantong`='$d_kantong'");
					$datapendonor=mysqli_fetch_assoc($pendonor);
					$idpendonor	=$datapendonor['kode'];
*/
                    $upd_donor_cekal=mysqli_query($dbi,"UPDATE `pendonor` SET `Cekal`='1' WHERE `Kode`='$idpendonor'");
                    $sq_htransaksi=mysqli_query($dbi,"UPDATE `htransaksi` SET `status_test`='0', `hasil_hbsag`='$cekal_b', `hasil_hcv`='$cekal_c', `hasil_hiv`='$cekal_i', `hasil_syp`='$cekal_s', `tglperiksa`='$tanggal' where NoKantong='$d_kantong'");
                    $updatekantong=mysqli_query($dbi,"UPDATE `stokkantong` set Status='7',`hasil`='4',`sah`='1',`StatTempat`='1', `tglperiksa`='$tanggal' where `NoKantong` like '$kantong_0%'");
                    echo "- Stokkantong $kantong_0 Dimusnahkan ";
                    $sq_ar_a="insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkantong_a'";
					$keluarkan_a=mysqli_query($dbi,$sq_ar_a);
                    if ($keluarkan_a){echo "- $nkantong_a Sukses Musnah-";}else{echo "- $nkantong_a GAGAL Musnah-";}
					$keluarkan_b=mysqli_query($dbi,"insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkantong_b'");
                    if ($keluarkan_b){echo "- $nkantong_b Sukses Musnah-";}else{echo "- $nkantong_b GAGAL Musnah-";}
					$keluarkan_c=mysqli_query($dbi,"insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkantong_c'");
                    if ($keluarkan_c){echo "- $nkantong_c Sukses Musnah-";}else{echo "- $nkantong_c GAGAL Musnah-";}
					$keluarkan_d=mysqli_query($dbi,"insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkantong_d'");
                    if ($keluarkan_d){echo "- $nkantong_d Sukses Musnah-";}else{echo "- $nkantong_d GAGAL Musnah-";}
					$keluarkan_e=mysqli_query($dbi,"insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkantong_e'");
                    if ($keluarkan_e){echo "- $nkantong_e Sukses Musnah-";}else{echo "- $nkantong_e GAGAL Musnah-";}
					$keluarkan_f=mysqli_query($dbi,"insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkantong_f'");
                    if ($keluarkan_f){echo "- $nkantong_f Sukses Musnah-";}else{echo "- $nkantong_f GAGAL Musnah-";}
                    $sq_ar_upd="update pmi.ar_stokkantong set alasan_buang='4', tgl_buang='$tanggal', user='$v_konfirmasi' where noKantong like '$kantong_0%'";
					$update=mysqli_query($dbi,$sq_ar_upd);
                    if ($update){echo "-update buang kantong $kantong_0% SUKSES";}else{echo "-update buang kantong $kantong_0% GAGAL";}
                    if($upd_donor_cekal){
                        echo "- ID $idpendonor ($cekal_b $cekal_c $cekal_i $cekal_s) OK ";
                        if ($cekal_b=="1"){
							$tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`, `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
							VALUES ('$idpendonor','$d_kantong', '$v_konfirmasi','1', '', '$notrans')");
							if ($tambah_cekal){echo "-Insert $idpendonor Cekal HBsAg, Sukses-";}else{echo"-Insert Cekal HBsAg $idpendonor Gagal-";}
						}
                        if ($ckl_c=="1"){
                            $tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`,  `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
                            VALUES ('$idpendonor','$d_kantong', '$v_konfirmasi','2', '', '$notrans')");
                            if ($tambah_cekal){echo "-Insert $idpendonor Cekal HCV Sukses-";}else{echo"-Insert Cekal HCV $idpendonor Gagal-";}
                        }
                        if ($ckl_i=="1"){
                            $tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`,  `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
                            VALUES ('$idpendonor','$d_kantong', '$v_konfirmasi','3', '', '$notrans')");
                            if ($tambah_cekal){echo "-Insert $idpendonor Cekal HIV Sukses-";}else{echo"-Insert Cekal  HIV $idpendonor Gagal-";}
                        }
                        if ($ckl_s=="1"){
                            $tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`,  `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
                            VALUES ('$idpendonor','$d_kantong', '$v_konfirmasi','4', '', '$notrans')");
                            if ($tambah_cekal){echo "-Insert $idpendonor Cekal Sypilis Sukses-";}else{echo"-Insert Cekal Sypilis $idpendonor Gagal-";}
                        }
                    }else {echo "-Update Cekal pendonor $idpendonor GAGAL-";}
                }
            }else{
                echo " - DITUNDA ";
            }
        }
        $sq_rb=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_b where kode='$v_reagb_kode'");
        $sq_rc=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_c where kode='$v_reagc_kode'");
        $sq_ri=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_i where kode='$v_reagi_kode'");
        $sq_rs=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_s where kode='$v_reags_kode'");

        // echo "<meta http-equiv='refresh' content='2;url=evolis/imltd_rpt_konfirm.php?notrans=$notrans'>";
    }

}
$namareagen="BIORAD";
?>
<body style="margin: 20px;">
    <form action="" method="POST">
    <div class="container-fluid">
        <h2 class="text-success">Konfirmasi Hasil Evolis BIORAD</h2>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-responsive table-bordered table-condensed sdw" style="width:100%;">
                    <tr>
                        <td class="text-center bg-primary">Reagen HBsAG</td>
                        <td class="text-center bg-primary">Reagen HCV</td>
                        <td class="text-center bg-primary">Reagen HIV</td>
                        <td class="text-center bg-primary">Reagen TPHA</td>
                    </tr>
                    <tr>
                        <td>
                            <select id="ReagenHbsag" name="ReagenHbsag" class="form-control input-sm" onChange="show(1)">
                                <?php 
                                    $jreagen1=mysqli_query($dbi,"select * from reagen where (( Nama like '%".$namareagen."%HBsAg%') or (Nama like '%".$namareagen."%HBsAg%')) and aktif='1' and jumTest>0");
                                    while($reagen=mysqli_fetch_assoc($jreagen1)){
                                        echo '<option value="'.$reagen['Nama'].'|'.$reagen['noLot'].'|'.$reagen['tglKad'].'|'.$reagen['kode'].'|'.$reagen['metode'].'|'.$reagen['jumTest'].'">'.$reagen['Nama'].'-'.$reagen['noLot'].'-'.$reagen['jumTest'].' Tes</option>';
                                    }
                                ?>
                            </select>
                        </td>
                    
                        <td>
                            <select id="ReagenHCV" name="ReagenHCV" class="form-control input-sm"onChange="show(2)">
                                <?php 
                                    $jreagen1=mysqli_query($dbi,"select * from reagen where (( Nama like '%".$namareagen."%HCV%') or (Nama like '%".$namareagen."%hcv%')) and aktif='1' and jumTest>0");
                                    while($reagen=mysqli_fetch_assoc($jreagen1)){
                                        echo '<option value="'.$reagen['Nama'].'|'.$reagen['noLot'].'|'.$reagen['tglKad'].'|'.$reagen['kode'].'|'.$reagen['metode'].'|'.$reagen['jumTest'].'">'.$reagen['Nama'].'-'.$reagen['noLot'].'-'.$reagen['jumTest'].' Tes</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select id="ReagenHIV" name="ReagenHIV" class="form-control input-sm"onChange="show(3)">
                                <?php 
                                    $jreagen1=mysqli_query($dbi,"select * from reagen where (( Nama like '%".$namareagen."%HIV%') or (Nama like '%".$namareagen."%hiv%')) and aktif='1' and jumTest>0");
                                    while($reagen=mysqli_fetch_assoc($jreagen1)){
                                        echo '<option value="'.$reagen['Nama'].'|'.$reagen['noLot'].'|'.$reagen['tglKad'].'|'.$reagen['kode'].'|'.$reagen['metode'].'|'.$reagen['jumTest'].'">'.$reagen['Nama'].'-'.$reagen['noLot'].'-'.$reagen['jumTest'].' Tes</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select id="ReagenSYP" name="ReagenSYP" class="form-control input-sm" onChange="show(4)">
                                <?php 
                                    $jreagen1=mysqli_query($dbi,"select * from reagen where (( Nama like '%".$namareagen."%TP%') or (Nama like '%".$namareagen."%Syphilis%')) and aktif='1' and jumTest>0");
                                    while($reagen=mysqli_fetch_assoc($jreagen1)){
                                        echo '<option value="'.$reagen['Nama'].'|'.$reagen['noLot'].'|'.$reagen['tglKad'].'|'.$reagen['kode'].'|'.$reagen['metode'].'|'.$reagen['jumTest'].'">'.$reagen['Nama'].'-'.$reagen['noLot'].'-'.$reagen['jumTest'].' Tes</option>';
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                    <table class="table table-responsive table-condensed table-hover table-bordered sdw">
                        <thead class="bg-primary">
                            <tr>
                                <th rowspan="2" class="text-center">No</th>
                                <th rowspan="2" class="text-center">Sample</th>
                                <th colspan="4" class="text-center">Parameter HBsAG</th>
                                <th colspan="4" class="text-center">Parameter HCV</th>
                                <th colspan="4" class="text-center">Parameter HIV</th>
                                <th colspan="4" class="text-center">Parameter TPHA</th>
                                <th rowspan="2" class="text-center">Status</th>
                                <th rowspan="2" class="text-center">Konfirm</th>
                            </tr>
                            <tr>
                                <th class="text-center">OD</th>
                                <th class="text-center">S/CO</th>
                                <th class="text-center">Result</th>
                                <th class="text-center">Ket</th>
                            
                                <th class="text-center">OD</th>
                                <th class="text-center">S/CO</th>
                                <th class="text-center">Result</th>
                                <th class="text-center">Ket</th>
                            
                                <th class="text-center">OD</th>
                                <th class="text-center">S/CO</th>
                                <th class="text-center">Result</th>
                                <th class="text-center">Ket</th>
                            
                                <th class="text-center">OD</th>
                                <th class="text-center">S/CO</th>
                                <th class="text-center">Result</th>
                                <th class="text-center">Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no=0;
                                $jml_testb=$jml_testc=$jml_testi=$jml_tests=0;
                                $nr_all=0;
                                $sql=mysqli_query($dbi,"SELECT `id`, `tanggal`, `nokantong`, `hbsag_cut_off`, `hbsag_od`, `hbsag_result`,`hbsag_reader`,
                                                       `hcv_cut_off`, `hcv_od`, `hcv_result`,`hcv_reader`, `hiv_cut_off`, `hiv_od`, `hiv_result`,`hiv_reader`, `syp_cut_off`, `syp_od`, `syp_result`,`syp_reader`FROM `imltd_import_temp` WHERE `sudah_proses`='0'");
                                while($dt=mysqli_fetch_assoc($sql)){
                                    if ( $dt['hbsag_result']!=="" ){$jml_testb++;}
                                    if ( $dt['hcv_result']!=="" ){$jml_testc++;}
                                    if ( $dt['hiv_result']!=="" ){$jml_testi++;}
                                    if ( $dt['syp_result']!=="" ){$jml_tests++;}
                                    $qcek="select Status, sah, StatTempat, stat2, jenis from stokkantong where noKantong='$dt[nokantong]'";
                                    $cek_ktg=mysqli_query($dbi,$qcek);
                                    $c_ktg=mysqli_fetch_assoc($cek_ktg);
                                    $status_ktg=$c_ktg['Status']; $kantong_sah=$c_ktg['sah'];
                                    switch ($status_ktg){
                                        case '0' : $statuskantong='Kosong('.$status_ktg.')';
                                                   if ($c_ktg['StatTempat']==NULL) $statuskantong='Kosong-Logistik('.$status_ktg.')';		
                                                   if ($c_ktg['StatTempat']=='0')  $statuskantong='Kosong-Logistik ('.$status_ktg.')';
                                                   if ($c_ktg['StatTempat']=='1')  $statuskantong='Kosong-Aftap('.$status_ktg.')';
                                                   break;
                                        case '1' : if ($c_ktg['sah']=="1"){
                                                        $statuskantong='Karantina('.$status_ktg.')';
                                                    } else{
                                                        $statuskantong='Belum disahkan('.$status_ktg.')';
                                                    }
                                                    break;
                                        case '2' : $statuskantong='Sehat('.$status_ktg.')';
                                                    if (substr($c_ktg['stat2'],0,1)=='b') $tempat=" (BDRS)";
                                                    break;
                                        case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
                                        case '4' : $statuskantong='Rusak('.$status_ktg.')';break;
                                        case '5' : $statuskantong='Rusak-Gagal('.$status_ktg.')';break;
                                        case '6' : $statuskantong='Dimusnahkan('.$status_ktg.')';break;
                                        default  : $statuskantong='Tidak ada';break;
                                    }
                                    // -----------------
                                    $allparam=1;
                                    $cekal="0";
                                    $warna=' class="text-default" ';
                                    if ( $dt['hbsag_result']=='' OR $dt['hcv_result']=='' OR $dt['hiv_result']=='' OR $dt['syp_result']=='' ){
                                        $allparam=0;
                                        $nr_all='0';
                                        $warna=' class="text-warning" ';
					$cekal='0';
                                    }
                                    elseif ( ($dt['hbsag_result']=='REACTIVE') OR ($dt['hcv_result']=='REACTIVE') OR ($dt['hiv_result']=='REACTIVE') OR ($dt['syp_result']=='REACTIVE') ){
                                        //$nr_all='1';
                                        $warna=' class="reactive" ';
                                        $cekal='1';
                                    }
                                    $no++;

                                    $sel0="";$sel1="";$sel2="";$sel3="";
                                    if ($statuskantong=='Tidak ada'){$sel1="";$sel0="selected";$sel2="";$sel3="";}
                                    if (($status_ktg=="1") and ($c_ktg['sah']=="1") and ($nr_all=="0")){$sel0="";$sel2="";$sel3="";$sel1="selected";}
                                    if (($status_ktg=="1") and ($c_ktg['sah']=="1") and ($nr_all!="0")){$sel0="";$sel1="";$sel3="";$sel2="selected";}
                                    if ($status_ktg=="0"){$sel0="";$sel1="";$sel2="";$sel3="selected";}
                                    if (($status_ktg=='1') AND ($allparam=="0")){$sel1="";$sel0="selected";$sel2="";$sel3="";}

                                    if ($cekal!="0"){$sel2="selected";}

                                    echo '<tr>
                                    <td class="text-center" nowrap>'.$no.'<input type="hidden" name="inpTmpID[]" value="'.$dt['id'].'"></td>
                                    <td nowrap '.$warna.'>'.$dt['nokantong'].'<input type="hidden" name="inpkantong[]" value="'.$dt['nokantong'].'"></td>
                                    <td nowrap class="text-center">'.$dt['hbsag_od'].'</td>
                                    <td nowrap class="text-center">'.$dt['hbsag_cut_off'].'</td>
                                    <td nowrap class="text-center">'.$dt['hbsag_result'].'</td>
                                    <td nowrap class="text-center">'.$dt['hbsag_reader'].'</td>

                                    <td nowrap class="text-center">'.$dt['hcv_od'].'</td>
                                    <td nowrap class="text-center">'.$dt['hcv_cut_off'].'</td>
                                    <td nowrap class="text-center">'.$dt['hcv_result'].'</td>
                                    <td nowrap class="text-center">'.$dt['hcv_reader'].'</td>

                                    <td nowrap class="text-center">'.$dt['hiv_od'].'</td>
                                    <td nowrap class="text-center">'.$dt['hiv_cut_off'].'</td>
                                    <td nowrap class="text-center">'.$dt['hiv_result'].'</td>
                                    <td nowrap class="text-center">'.$dt['hiv_reader'].'</td>

                                    <td nowrap class="text-center">'.$dt['syp_od'].'</td>
                                    <td nowrap class="text-center">'.$dt['syp_cut_off'].'</td>
                                    <td nowrap class="text-center">'.$dt['syp_result'].'</td>
                                    <td nowrap class="text-center">'.$dt['syp_reader'].'</td>

                                    <td nowrap>'.$statuskantong.'</td>
                                    <td nowrap>
                                        <select name="konfirmasi[]">
                                            <option value="0" '.$sel0.'>-</option>
                                            <option value="1" '.$sel1.'>Sehat</option>
                                            <option value="2" '.$sel2.'>Cekal</option>
                                            <option value="3" '.$sel3.'>Tunda</option>
                                        </select>
                                    </td>
                                    </tr>';
                                }                   
                                echo '<input type="hidden" name="InptJmlTes_b" value="'.$jml_testb.'">';
                                echo '<input type="hidden" name="InptJmlTes_c" value="'.$jml_testc.'">';
                                echo '<input type="hidden" name="InptJmlTes_i" value="'.$jml_testi.'">';
                                echo '<input type="hidden" name="InptJmlTes_s" value="'.$jml_tests.'">';
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-responsive table-condensed table-bordered sdw">
                    <tr>
                        <td style="width: 150px;" class="bg-primary">Diperiksa oleh</td>
                        <td style="width: 300px;">
                            <select class="form-control input-sm" name="inptOperator">
                                <?php 
                                    $user=mysqli_query($dbi,"select * from user where (level like '%laboratorium%' or level like '%imltd%') order by nama_lengkap");
                                    while($dtuser=mysqli_fetch_assoc($user)) {
                                        echo '<option value="'.$dtuser['id_user'].'">'.$dtuser['nama_lengkap'].'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td rowspan="3">
                            <b>Catatan :</b>
                                <ol>
                                    <li>Kantong yang bisa di-SEHAT-kan adalah semua parameter diperiksa lengkap dan status kantong Karantina</li>
                                    <li>Reagen harus dipilih sesuai parameter, jumlah dan nomor lot pemeriksaan</li>
                                    <li>Kantong darah yang diproses sesuai dengan aksi konfirmasi pada pilihan kolom paling kanan</li>
                                </ol>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="bg-primary">Dikonfirmasi oleh</td>
                        <td><input type="text" name="InpKonfimrasi" class="form-control input-sm" value="<?php echo $namalengkap;?>" readonly>
                            <input type="hidden" name="InpUser" value="<?php echo $namauser;?>">
                        </td>
                        
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="bg-primary">Disahkan oleh</td>
                        <td style="width: 300px;">
                            <select class="form-control input-sm" name="inptpengesah">
                                <?php 
                                    $user=mysqli_query($dbi,"select * from user where (level like '%laboratorium%' or level like '%imltd%' or  level like '%pimpinan%') order by nama_lengkap");
                                    while($dtuser=mysqli_fetch_assoc($user)) {
                                        echo '<option value="'.$dtuser['id_user'].'">'.$dtuser['nama_lengkap'].'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel sdw">
                    <div class="panel-body text-center">
                            <input type="submit" class="btn btn-danger sdw" name="proseskonfirmasi" value="Proses Konfirmasi">
                            <a href="?module=evolisbiorad" class="btn btn-primary sdw">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
