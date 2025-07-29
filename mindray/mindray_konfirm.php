
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
    <style>
        .shadow{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .shadow-xx{
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
        }
        .select-sm{
            font-size: 100%;
            height: 25px;
            padding-top: 2px;
            padding-bottom: 3px;
        }
        .contain-border{
            border: 2px solid red;
        }
        .container-frame {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            }
        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
    </style>
    <script language="javascript">
        function show1(idreag){
            var campur = document.getElementById('reagen1').value;
            var reag1 = campur.split('*');
            document.getElementById('nama1').innerHTML = reag1[0];
            document.getElementById('nolot1').innerHTML = reag1[1];
            document.getElementById('kode1').innerHTML = reag1[2];
            document.getElementById('sisa_test1').innerHTML = reag1[3];
            document.getElementById('tgl_ed1').innerHTML = reag1[4];
            if (reag1[0]===""){alert("Reagen HBsAg harus dipilih");}
        }
        function show2(idreag){
            var campur = document.getElementById('reagen2').value;
            var reag2 = campur.split('*');
            document.getElementById('nama2').innerHTML = reag2[0];
            document.getElementById('nolot2').innerHTML = reag2[1];
            document.getElementById('kode2').innerHTML = reag2[2];
            document.getElementById('sisa_test2').innerHTML = reag2[3];
            document.getElementById('tgl_ed2').innerHTML = reag2[4];
            if (reag2[0]===""){alert("Reagen HCV harus dipilih");}
        }
        function show3(idreag){
            var campur = document.getElementById('reagen3').value;
            var reag3 = campur.split('*');
            document.getElementById('nama3').innerHTML = reag3[0];
            document.getElementById('nolot3').innerHTML = reag3[1];
            document.getElementById('kode3').innerHTML = reag3[2];
            document.getElementById('sisa_test3').innerHTML = reag3[3];
            document.getElementById('tgl_ed3').innerHTML = reag3[4];
            if (reag3[0]===""){alert("Reagen HIV harus dipilih");}
        }
        function show4(idreag){
            var campur = document.getElementById('reagen4').value;
            var reag4 = campur.split('*');
            document.getElementById('nama4').innerHTML = reag4[0];
            document.getElementById('nolot4').innerHTML = reag4[1];
            document.getElementById('kode4').innerHTML = reag4[2];
            document.getElementById('sisa_test4').innerHTML = reag4[3];
            document.getElementById('tgl_ed4').innerHTML = reag4[4];
            if (reag4[0]===""){alert("Reagen Syphilis harus dipilih");}
        }
    </script>
<body>
<?php
session_start();
$namauser=$_SESSION['namauser'];
$namalengkap=$_SESSION['nama_lengkap'];
require_once('config/dbi_connect.php');
date_default_timezone_set('Asia/Makassar');
$merk_reagen="Mindray";
$g_i=$_GET['i'];
$g_j=$_GET['j'];
$g_inst=$_GET['ints'];
$tanggal2=date("Y-m-d");
$lanjut='0';
$progFinish='0';
$display="";
/*$select_query="SELECT l.`mdr_instrument`, l.`mdr_sample_id`, l.`mdr_out_created`,l.`mdr_report_type`, s.`Status`, s.`sah`,s.`stat2`, s.`StatTempat`, s.`jenis`, h.`KodePendonor`, h.`JenisDonor`, h.`Instansi`, h.`umur`, h.`donorbaru` ,  MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_od` END ) 'b_od', MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_sample_result` END ) 'b_result', MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_param_range` END ) 'b_range', MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_param_unit` END ) 'b_unit', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_od` END ) 'c_od', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_sample_result` END ) 'c_result', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_param_range` END ) 'c_range', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_param_unit` END ) 'c_unit', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_od` END ) 'i_od', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_sample_result` END ) 'i_result', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_param_range` END ) 'i_range', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_param_unit` END ) 'i_unit', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_od` END ) 's_od', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_sample_result` END ) 's_result', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_param_range` END ) 's_range', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_param_unit` END ) 's_unit' FROM `lis_pmi`.`mindray_result` l LEFT JOIN `pmi`.`stokkantong` s on s.`noKantong`=l.`mdr_sample_id` LEFT JOIN `pmi`.`htransaksi` h on h.`NoKantong`=l.`mdr_sample_id`  WHERE l.`mdr_out_created`='$g_i' AND l.`mdr_report_type`='$g_j' and  l.`mdr_instrument`='$g_inst' and l.`mdr_konfirm`='0' GROUP BY l.`mdr_instrument`, l.`mdr_sample_id`, l.`mdr_out_created`, l.`mdr_report_type`, s.`Status`, s.`sah`,s.`stat2`, s.`StatTempat`, s.`jenis`,h.`KodePendonor`,h.`JenisDonor`, h.`Instansi`,h.`umur`,h.`donorbaru` ";*/

//09022022 EDIT (Theo) Hilangkan Left Join Htransaksi
    $select_query="SELECT l.`mdr_instrument`, l.`mdr_sample_id`, l.`mdr_out_created`,l.`mdr_report_type`, s.`Status`, s.`sah`,s.`stat2`, s.`StatTempat`, s.`jenis`,  MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_od` END ) 'b_od', MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_sample_result` END ) 'b_result', MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_param_range` END ) 'b_range', MAX( CASE WHEN l.`mdr_parameter` = '1' THEN l.`mdr_param_unit` END ) 'b_unit', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_od` END ) 'c_od', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_sample_result` END ) 'c_result', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_param_range` END ) 'c_range', MAX( CASE WHEN l.`mdr_parameter` = '2' THEN l.`mdr_param_unit` END ) 'c_unit', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_od` END ) 'i_od', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_sample_result` END ) 'i_result', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_param_range` END ) 'i_range', MAX( CASE WHEN l.`mdr_parameter` = '3' THEN l.`mdr_param_unit` END ) 'i_unit', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_od` END ) 's_od', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_sample_result` END ) 's_result', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_param_range` END ) 's_range', MAX( CASE WHEN l.`mdr_parameter` = '4' THEN l.`mdr_param_unit` END ) 's_unit' FROM `lis_pmi`.`mindray_result` l LEFT JOIN `pmi`.`stokkantong` s on s.`noKantong`=l.`mdr_sample_id`   WHERE l.`mdr_out_created`='$g_i' AND l.`mdr_report_type`='$g_j' and  l.`mdr_instrument`='$g_inst' and l.`mdr_konfirm`='0' GROUP BY l.`mdr_instrument`, l.`mdr_sample_id`, l.`mdr_out_created`, l.`mdr_report_type`, s.`Status`, s.`sah`,s.`stat2`, s.`StatTempat`, s.`jenis` ";
$result = mysqli_query($dbi,$select_query);
if ($result){$jumdata=mysqli_num_rows($result);}
if(isset($_POST['Button']))  {
    $display ='<br>Posting...';
    $today           = date("Y-m-d");
    $today1          = date("Y-m-d H:i:s");
    $output_date     = $_POST['list_i'];
    $output_type     = $_POST['list_j'];
    $jumlah_sample   =count($_POST['sample']);
    $jml_test_b      = $_POST['jml_test_b'];
    $jml_test_c      = $_POST['jml_test_c'];
    $jml_test_i      = $_POST['jml_test_i'];
    $jml_test_s      = $_POST['jml_test_s'];
    $ptgKonfirmasi   = $_POST['ptgs_konfirmasi'];
    $ptgSah          = $_POST['ptgs_sah'];
    $ptgAlat         = $_POST['ptgs_alat'];
    $reagen1=$_POST['reagen1'];	$reag1_ex=explode('*',$reagen1);
		$reag1_nama=$reag1_ex[0]; 	$reag1_nolot=$reag1_ex[1]; 	$reag1_kode=$reag1_ex[2];	$reag1_tes=$reag1_ex[3];    $reag1_ed=$reag1_ex[4];	$reagen2=$_POST['reagen2'];	$reag2_ex=explode('*',$reagen2);
		$reag2_nama=$reag2_ex[0]; 	$reag2_nolot=$reag2_ex[1]; 	$reag2_kode=$reag2_ex[2];	$reag2_tes=$reag2_ex[3];    $reag2_ed=$reag2_ex[4];	$reagen3=$_POST['reagen3'];	$reag3_ex=explode('*',$reagen3);
		$reag3_nama=$reag3_ex[0]; 	$reag3_nolot=$reag3_ex[1]; 	$reag3_kode=$reag3_ex[2];	$reag3_tes=$reag3_ex[3];    $reag3_ed=$reag3_ex[4];	$reagen4=$_POST['reagen4'];	$reag4_ex=explode('*',$reagen4);
		$reag4_nama=$reag4_ex[0]; 	$reag4_nolot=$reag4_ex[1]; 	$reag4_kode=$reag4_ex[2];	$reag4_tes=$reag4_ex[3];    $reag4_ed=$reag4_ex[4]; $e_msg="";
		if (intval($reag1_tes) < $jml_test_b){$lanjut=1;$e_msg="Jumlah tes reagensia HBsAg kurang dari jumlah sample yang diperiksa";}
		if (intVal($reag2_tes) < $jml_test_c){$lanjut=2;$e_msg="Jumlah tes reagensia Anti-HCV kurang dari jumlah sample yang diperiksa";}
		if (intval($reag3_tes) < $jml_test_i){$lanjut=3;$e_msg="Jumlah tes reagensia Anti-HIV kurang dari jumlah sample yang diperiksa";}
		if (intval($reag4_tes) < $jml_test_s){$lanjut=4;$e_msg="Jumlah tes reagensia Syipilis/TP kurang dari jumlah sample yang diperiksa";		}
		if ($ptgKonfirmasi==""){$lanjut=5;$e_msg="Pilih petugas yang melakukan konfirmasi";}
		if (($ptgSah=="") or ($ptgSah=="-")){$lanjut=6;$e_msg="Pilih petugas yang melakukan pengesahan hasil";}
    if (($ptgAlat=="") or ($ptgAlat=="-")){$lanjut=7;$e_msg="Pilih petugas yang menjadi operator alat";}
    if ($e_msg!==""){echo "<SCRIPT>alert('".$e_msg."');</SCRIPT>";}
    if ($lanjut == 0){
		//Generated NoTransaksi===============================================
		$sql_elisa	= mysqli_query($dbi,"SELECT MAX(CONVERT(notrans, SIGNED INTEGER)) AS Kode FROM pmi.hasilelisa");
		$dta_elisa	= mysqli_fetch_assoc($sql_elisa);
		$int_elisa  = (int)($dta_elisa['Kode']);
		$int_no=$int_elisa;
		$int_no_inc=(int)$int_no+1;
		$j_nol= 8-(strlen(strval($int_no_inc)));
		for ($i=0; $i<$j_nol; $i++){$no_tmp .="0";}
		$notrans = $no_tmp.$int_no_inc;
        $display .= '<br>No Transaksi : '.$notrans;
		//------------ END Generate no transaksi ---------------
    $jmlreag_b=0;
    $jmlreag_c=0;
    $jmlreag_i=0;
    $jmlreag_s=0;
        for ($i=0;$i<count($_POST['sample']);$i++) {
            $display .= '<br> Sample : '.$_POST['sample'][$i];
            $d_cekal_b=$d_cekal_c=$d_cekal_i=$d_cekal_s="";
            $d_instrument   = $_POST['instrument'][$i];
            $d_sample       = $_POST['sample'][$i];
            $d_aksi_konfirm = $_POST['aksi'][$i];
            $d_umur		    = $_POST['umur'][$i]; if (empty($d_umur)){$d_umur='0';}
            $d_jnsdonor	    = $_POST['jenis_donor'][$i];
            $d_kodedonor	= $_POST['kodedonor'][$i];
            $d_barulama	    = $_POST['donorbaru'][$i];
            $d_status_kantong=$_POST['statuskantong'][$i];
            $d_jeniskantong = $_POST['jeniskantong'][$i]; 
            $d_od_b         = $_POST['od_b'][$i];
            $d_result_b     = $_POST['result_b'][$i]; if ($d_result_b=='Reaktif'){$d_cekal_b=='1';}
            $d_range_b      = $_POST['range_b'][$i];
            $d_unit_b       = $_POST['unit_b'][$i];
            $d_od_c         = $_POST['od_c'][$i];
            $d_result_c     = $_POST['result_c'][$i]; if ($d_result_c=='Reaktif'){$d_cekal_c=='1';}
            $d_range_c      = $_POST['range_c'][$i];
            $d_unit_c       = $_POST['unit_c'][$i];
            $d_od_i         = $_POST['od_i'][$i];
            $d_result_i     = $_POST['result_i'][$i]; if ($d_result_i=='Reaktif'){$d_cekal_i=='1';}
            $d_range_i      = $_POST['range_i'][$i];
            $d_unit_i       = $_POST['unit_i'][$i];
            $d_od_s         = $_POST['od_s'][$i];
            $d_result_s     = $_POST['result_s'][$i]; if ($d_result_s=='Reaktif'){$d_cekal_s=='1';}
            $d_range_s      = $_POST['range_s'][$i];
            $d_unit_s       = $_POST['unit_s'][$i];
            if($d_result_b!==''){
                switch($d_result_b){
                    case 'NonReaktif' : $d_hasil_b="0";break;
                    case 'Reaktif' : $d_hasil_b="1";break;
                }
            }
            if($d_result_c!==''){
                switch($d_result_c){
                    case 'NonReaktif' : $d_hasil_c="0";break;
                    case 'Reaktif' : $d_hasil_c="1";break;
                }
            }
            if($d_result_i!==''){
                switch($d_result_i){
                    case 'NonReaktif' : $d_hasil_i="0";break;
                    case 'Reaktif' : $d_hasil_i="1";break;
                }
            }
            if($d_result_s!==''){
                switch($d_result_s){
                    case 'NonReaktif' : $d_hasil_s="0";break;
                    case 'Reaktif' : $d_hasil_s="1";break;
                }
            }
            if ($d_aksi_konfirm!=="3"){
                $display .='<br> Aksi Sample : '.$d_aksi_konfirm;
                if ($d_result_b!==""){$jmlreag_b++;}
                if ($d_result_c!==""){$jmlreag_c++;}
                if ($d_result_i!==""){$jmlreag_i++;}
                if ($d_result_s!==""){$jmlreag_s++;}
                //insert record to table konfirmasi kecuali "aksi=3"
                $q_konfirm="INSERT INTO `pmi`.`mindray_confirm`(`no_trans`, `instr`, `user`, `id_tes`, `rpt_type`, `rpt_created`,
                            `b_lot_reag`, `b_ed_reag`, `b_kode_reag`, `b_od`, `b_hasil`, `b_unit`,`b_range`, `c_lot_reag`, `c_ed_reag`, `c_kode_reag`, `c_od`, `c_hasil`, `c_unit`,`c_range`,
                            `i_lot_reag`, `i_ed_reag`, `i_kode_reag`, `i_od`, `i_hasil`, `i_unit`,`i_range`,`s_lot_reag`, `s_ed_reag`, `s_kode_reag`, `s_od`, `s_hasil`, `s_unit`,`s_range`,
                             `konfirmer`, `disahkan`, `status_kantong`, `konfirm_action`) VALUES('$notrans','$d_instrument','$ptgAlat','$d_sample','$output_type','$output_date',
                             '$reag1_nolot','$reag1_ed','$reag1_kode','$d_od_b','$d_result_b','$d_unit_b','$d_range_b','$reag2_nolot','$reag2_ed','$reag2_kode','$d_od_c','$d_result_c','$d_unit_c','$d_range_c',
                             '$reag3_nolot','$reag3_ed','$reag3_kode','$d_od_i','$d_result_i','$d_unit_i','$d_range_i', '$reag4_nolot','$reag4_ed','$reag4_kode','$d_od_s','$d_result_s','$d_unit_s','$d_range_s',
                             '$ptgKonfirmasi','$ptgSah','$d_status_kantong','$d_aksi_konfirm')";
                $insert_konfirm=mysqli_query($dbi,$q_konfirm);
                if (!$insert_konfirm){
                     $display .= "-table konfirm ERR-";
                }else{
                    $display .= '<br> Insert Table Confirm OK';
                }
                if ($d_result_b!==""){$sq_hbsag="insert into pmi.hasilelisa (noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa, dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode, umur, jns_donor, baru_ulang, catatan) values ('$d_sample','$d_od_b','1.00','$d_hasil_b','$notrans','0','$today', '$ptgAlat','$ptgKonfirmasi','$ptgSah','$reag1_nolot','chlia','$d_umur', '$d_jnsdonor', '$d_barulama', '')";$sql_hbsag=mysqli_query($dbi,$sq_hbsag);}
                if ($sql_hbsag){$display .= '<br> Insert Elisa B, OK';}else{$display .= '<br>Insert Elisa B Err';}
                if ($d_result_C!==""){$sq_hcv="insert into pmi.hasilelisa (noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa, dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode, umur, jns_donor, baru_ulang, catatan) values ('$d_sample','$d_od_c','1.00','$d_hasil_c','$notrans','1','$today', '$ptgAlat','$ptgKonfirmasi','$ptgSah','$reag2_nolot','chlia','$d_umur', '$d_jnsdonor', '$d_barulama', '')";$sql_hcv=mysqli_query($dbi,$sq_hcv);}
                if ($sql_hcv){$display .= '<br> Insert Elisa C, OK';}else{ $display .= '<br>Insert Elisa C Err';}
                if ($d_result_i!==""){$sq_hiv="insert into pmi.hasilelisa (noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa, dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode, umur, jns_donor, baru_ulang, catatan) values ('$d_sample','$d_od_i','1.00','$d_hasil_i','$notrans','2','$today', '$ptgAlat','$ptgKonfirmasi','$ptgSah','$reag3_nolot','chlia','$d_umur', '$d_jnsdonor', '$d_barulama', '')";$sql_hiv=mysqli_query($dbi,$sq_hiv);}
                if ($sql_hiv){$display .= '<br> Insert Elisa I, OK';}else{ $display .= '<br>Insert Elisa I Err';}
                if ($d_result_s!==""){$sq_vdrl="insert into pmi.hasilelisa (noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa, dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode, umur, jns_donor, baru_ulang, catatan) values ('$d_sample','$d_od_s','1.00','$d_hasil_s','$notrans','3','$today', '$ptgAlat','$ptgKonfirmasi','$ptgSah','$reag4_nolot','chlia','$d_umur', '$d_jnsdonor', '$d_barulama', '')";$sql_vdrl=mysqli_query($dbi,$sq_vdrl);}
                if ($sql_vdrl){$display .= '<br> Insert Elisa S, OK';}else{ $display .= '<br>Insert Elisa S Err';}
                //4. Merubah Status kantong sehat
                if ($d_aksi_konfirm=='1'){
                    $display .= '<br>- Aksi: 1 (sehat)';
                    $display .= "<br>- Jenis : ".$d_jeniskantong;
                    $kantong0 = substr($d_sample,0,-1);$alpabhet="A";
                    for ($x = 0; $x < $d_jeniskantong; $x++) {
                        $no_kantong_satelite=$kantong0.$alpabhet;$upd_ktg=mysqli_query($dbi,"UPDATE `pmi`.`stokkantong` set `Status`='2', `hasil`='2', `sah`='1', `StatTempat`='1', `tglpengolahan`=`tgl_Aftap`, `tglperiksa`='$today1' where `NoKantong`='$no_kantong_satelite'");$alpabhet++;
                        $display .= "<br>- Sql: UPDATE `pmi`.`stokkantong` set `Status`='2', `hasil`='2', `sah`='1', `StatTempat`='1', `tglpengolahan`=`tgl_Aftap`, `tglperiksa`='$today1' where `NoKantong`='$no_kantong_satelite'";
                        if ($upd_ktg){$display .= '<br>- Update kantong '.$no_kantong_satelite.' Ok';}else{$display .= '<br>- Update kantong '.$no_kantong_satelite.' Err';}
					}
                    $sql_htrans="UPDATE pmi.htransaksi SET `status_test`='0', `hasil_hbsag`='0', `hasil_hcv`='0', `hasil_hiv`='0', `hasil_syp`='0', `tglperiksa`='$today1' where NoKantong='$d_sample'";$sql_htransaksi=mysqli_query($dbi,$sql_htrans);
                    if ($sql_htransaksi){$display .= '<br>- Update transaksi '.$no_kantong_satelite.' Ok';}else{$display .= '<br>- Update transaksi '.$no_kantong_satelite.' Err';}
                }
                //5. aksi donor apabila kantong "cekal"
                if ($d_aksi_konfirm=='2'){
                    $display .= '<br>- Konfirm 2: Cekal';
                    $upd_donor_cekal=mysqli_query($dbi,"UPDATE pendonor SET Cekal='1' WHERE Kode='$d_kodedonor'");
                    $display .= "<br>- UPDATE pendonor SET Cekal='1' WHERE Kode='$d_kodedonor'";
                    $sq_htransaksi=mysqli_query($dbi,"UPDATE pmi.htransaksi SET `status_test`='0', `hasil_hbsag`='$d_cekal_b', `hasil_hcv`='$d_cekal_c', `hasil_hiv`='$d_cekal_i', `hasil_syp`='$d_cekal_s', `tglperiksa`='$today' where NoKantong='$d_sample'");
                    $display .= "<br>- UPDATE pmi.htransaksi SET `status_test`='0', `hasil_hbsag`='$d_cekal_b', `hasil_hcv`='$d_cekal_c', `hasil_hiv`='$d_cekal_i', `hasil_syp`='$d_cekal_s', `tglperiksa`='$today' where NoKantong='$d_sample'";
                    $kantong0 = substr($d_sample,0,-1);
                    $alpabhet="A";
                    $display .= "<br>- Jenis : ".$d_jeniskantong;
                    for ($x = 0; $x < $d_jeniskantong; $x++) {
                        $no_kantong_satelite=$kantong0.$alpabhet;
                        $display .= "<br>- No Kantong Satelite ".$no_kantong_satelite;
                        $tambah3s=mysqli_query($dbi,"UPDATE pmi.stokkantong set Status='6',hasil='4',sah='1',StatTempat='1', tglperiksa='$today1' where `NoKantong`='$no_kantong_satelite'");
                        $display .= "<br>- UPDATE pmi.stokkantong set Status='7',hasil='4',sah='1',StatTempat='1', tglperiksa='$today1' where `NoKantong`='$no_kantong_satelite'";
                        $keluarkan__kantong=mysqli_query($dbi,"insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck) select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$no_kantong_satelite'");$alpabhet++;
                        $display .= "<br>- insert into pmi.ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck) select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$no_kantong_satelite'<br>";
                    }
                    if ($upd_donor_cekal){
                        if ($d_cekal_b=="1"){$tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`, `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`) VALUES ('$d_kodedonor','$d_sample', '$ptgKonfirmasi','1', '$d_od_b', '$notrans')");}
                        if($tambah_cekal){$display .='<br>- Insert Cekal B OK ';}else{'<br>- Insert Cekal B ERR ';}
                        if ($d_cekal_c=="1"){$tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`, `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`) VALUES ('$d_kodedonor','$d_sample', '$ptgKonfirmasi','2', '$d_od_c', '$notrans')");}
                        if($tambah_cekal){$display .='<br>- Insert Cekal C OK ';}else{'<br>- Insert Cekal C ERR ';}
                        if ($d_cekal_i=="1"){$tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`, `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`) VALUES ('$d_kodedonor','$d_sample', '$ptgKonfirmasi','3', '$d_od_i', '$notrans')");}
                        if($tambah_cekal){$display .='<br>- Insert Cekal I OK ';}else{'<br>- Insert Cekal I ERR ';}
                        if ($d_cekal_s=="1"){$tambah_cekal=mysqli_query($dbi,"INSERT INTO pmi.`cekal`(`kode_pendonor`, `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`) VALUES ('$d_kodedonor','$d_sample', '$ptgKonfirmasi','4', '$d_od_s', '$notrans')");}
                        if($tambah_cekal){$display .='<br>- Insert Cekal A OK ';}else{'<br>- Insert Cekal S ERR ';}
                    }
                }
                $q_upd_list=mysqli_query($dbi,"UPDATE `lis_pmi`.`mindray_result` SET `mdr_konfirm`='1' WHERE `mdr_out_created`='$output_date' AND `mdr_report_type`='$output_type' AND `mdr_sample_id`='$d_sample'");
                if ($q_upd_list){$display .="<br>- Update list record OK ";}else{$display .="<br>- Update list record ERR ";}
                //=======Audit Trial====================================================================================
		    	$log_mdl ='IMLTD';
		    	$log_aksi='IMLTD Mindray: '.$notrans.', Sample: '.$d_sample.'; hasil HBV: '.$d_result_b.'; HCV: '.$d_result_c.'; HIV: '.$d_result_i.'; Shypilis: '.$d_result_s;
		    	include('user_log.php');
            }
        }
        $sq_rb=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_b where kode='$reag1_kode'");$sq_rc=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_c where kode='$reag2_kode'");$sq_ri=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_i where kode='$reag3_kode'");$sq_rs=mysqli_query($dbi,"update pmi.reagen set jumTest=jumTest-$jmlreag_s where kode='$reag4_kode'");
        $progFinish='1';
        echo '
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header"><h3>Hasil Konfirmasi Mindray Chlia no.: '.$notrans.'</h3></div>
                <div class="nav navbar-nav navbar-right" style="margin-top:15px;">
                    <a href="pmiimltd.php?module=mindray_before_raw" class="btn  btn-primary shadow-xx"><span class="glyphicon glyphicon-repeat" style="font-size: 120%;"></span>&nbsp;&nbsp;Kembali</a>&nbsp;
                    <a href="pmiimltd.php?module=mindray_menu" class="btn  btn-primary shadow-xx"><span class="glyphicon glyphicon-home" style="font-size: 120%;"></span>&nbsp;&nbsp;Menu</a>&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <iframe class="responsive-iframe" src="mindray/mindray_konfirm_rpt.php?notrans='.$notrans.'&#zoom=FitH&pagemode=none"  frameborder="0" allowtransparency="true" style="height:500px;"></iframe>
                </div>
            </div>
        </div>';
   }
}
if ($progFinish=='0'){
    ?>
    <nav class="navbar" id="atas">
        <div class="container-fluid">
            <div class="navbar-header"><h3>Konfirmasi Hasil Mindray Chlia </h3></div>
            <?php
            if ($jumdata>20){
                echo'<div class="nav navbar-nav navbar-right" style="margin-top:20px;">
                        <a href="pmiimltd.php?module=mindray_before_raw" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-repeat" style="font-size: 120%;"></span>&nbsp;&nbsp;Kembali</a>
                        <a href="#bawah" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-down" style="font-size: 120%;"></span>&nbsp;&nbsp;Ke Bawah</a>
                        &nbsp;&nbsp;
                    </div>';
            }?>
        </div>
    </nav>
    <div class="container-fluid">    
        <form name="mindray_konfirmasi" method="POST" action="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed contain-border shadow">
                            <thead style="background-color: #FF7276;color:white;font-size:120%;">
                                <tr>
                                    <td colspan="12" class="text-center contain-border"> <?php echo 'Instrument: '.$g_inst.', Tanggal: <strong>'.$g_i.'</strong>, Jenis output: <strong>'.$g_j;?> </strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-center contain-border">
                                        <select name="reagen1" id="reagen1" onChange="show1(1)" class="form-control select-sm">
                                            <?php
                                            echo '<option value="">Pilih reagen HBsAg</option>';
                                            $jreagen1=mysqli_query($dbi,"select * from reagen where upper(Nama) like upper('%$merk_reagen%Hbsag%') and aktif='1' and jumTest>0");
                                            while ($jreagen11=mysqli_fetch_assoc($jreagen1)) { 
                                                echo '
                                                <option value="'.$jreagen11['Nama'].'*'.$jreagen11['noLot'].'*'.$jreagen11['kode'].'*'.$jreagen11['jumTest'].'*'.$jreagen11['tglKad'].'">
                                                            '.$jreagen11['Nama'].'-'.$jreagen11['noLot'].'-'.$jreagen11['jumTest'].'</option>';
                                            } ?>
                                        </select>    
                                    </td>
                                    <td colspan="3" class="text-center contain-border">
                                        <select name="reagen2" id="reagen2" onChange="show2(2)" class="form-control select-sm">
                                            <?php
                                            echo '<option value="">Pilih reagen Anti-HCV</option>';
                                            $jreagen1=mysqli_query($dbi,"select * from reagen where upper(Nama) like upper('%$merk_reagen%HCV%') and aktif='1' and jumTest>0");
                                            while ($jreagen11=mysqli_fetch_assoc($jreagen1)) { 
                                                echo '
                                                <option value="'.$jreagen11['Nama'].'*'.$jreagen11['noLot'].'*'.$jreagen11['kode'].'*'.$jreagen11['jumTest'].'*'.$jreagen11['tglKad'].'">
                                                            '.$jreagen11['Nama'].'-'.$jreagen11['noLot'].'-'.$jreagen11['jumTest'].'</option>';
                                            } ?>
                                        </select>    
                                    </td>
                                    <td colspan="3" class="text-center contain-border">
                                        <select name="reagen3" id="reagen3" onChange="show3(3)" class="form-control select-sm">
                                            <?php
                                            echo '<option value="">Pilih reagen Anti-HIV</option>';
                                            $jreagen1=mysqli_query($dbi,"select * from reagen where upper(Nama) like upper('%$merk_reagen%HIV%') and aktif='1' and jumTest>0");
                                            while ($jreagen11=mysqli_fetch_assoc($jreagen1)) { 
                                                echo '
                                                <option value="'.$jreagen11['Nama'].'*'.$jreagen11['noLot'].'*'.$jreagen11['kode'].'*'.$jreagen11['jumTest'].'*'.$jreagen11['tglKad'].'">
                                                            '.$jreagen11['Nama'].'-'.$jreagen11['noLot'].'-'.$jreagen11['jumTest'].'</option>';
                                            } ?>
                                        </select>    
                                    </td>
                                    <td colspan="3" class="text-center contain-border">
                                        <select name="reagen4" id="reagen4" onChange="show4(4)" class="form-control select-sm">
                                            <?php
                                            echo '<option value="">Pilih reagen Sypilis/TP</option>';
                                            $jreagen1=mysqli_query($dbi,"select * from reagen where upper(Nama) like upper('%$merk_reagen%Syphilis%') and aktif='1' and jumTest>0");
                                            while ($jreagen11=mysqli_fetch_assoc($jreagen1)) { 
                                                echo '
                                                <option value="'.$jreagen11['Nama'].'*'.$jreagen11['noLot'].'*'.$jreagen11['kode'].'*'.$jreagen11['jumTest'].'*'.$jreagen11['tglKad'].'">
                                                            '.$jreagen11['Nama'].'-'.$jreagen11['noLot'].'-'.$jreagen11['jumTest'].'</option>';
                                            } ?>
                                        </select>    
                                    </td>
                                </tr>
                                <tr class="text-center contain-border" style="font-size: 100%;color:white;font-weight:bold;height:10px;padding-top:0px;padding-bottom:10px;display:none;">
                                    <td class="contain-border" colspan="2"><div id="nama1"></div></td> 	<td class="contain-border"><div id="kode1"></div></td> 
                                    <td class="contain-border" colspan="2"><div id="nama2"></div></td> 	<td class="contain-border"><div id="kode2"></div></td>
                                    <td class="contain-border" colspan="2"><div id="nama3"></div></td> 	<td class="contain-border"><div id="kode3"></div></td>
                                    <td class="contain-border" colspan="2"><div id="nama4"></div></td> 	<td class="contain-border"><div id="kode4"></div></td>
                                </tr>
                                <tr class="text-center contain-border" style="font-size: 100%;color:white;font-weight:bold;">
                                    <td class="contain-border">Lot: <span id="nolot1"></span></td>	<td class="contain-border">Jml: <span id="sisa_test1"></span></td>    <td class="contain-border">ED: <span id="tgl_ed1"></span></td>
                                    <td class="contain-border">Lot: <span id="nolot2"></span></td>	<td class="contain-border">Jml: <span id="sisa_test2"></span></td>    <td class="contain-border">ED: <span id="tgl_ed2"></span></td>
                                    <td class="contain-border">Lot: <span id="nolot3"></span></td>	<td class="contain-border">Jml: <span id="sisa_test3"></span></td>    <td class="contain-border">ED: <span id="tgl_ed3"></span></td>
                                    <td class="contain-border">Lot: <span id="nolot4"></span></td>	<td class="contain-border">Jml: <span id="sisa_test4"></span></td>    <td class="contain-border">ED: <span id="tgl_ed4"></span></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-condensed shadow">
                            <thead class="pmi">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;" rowspan="2">NO</th>
                                <th class="text-center" style="vertical-align: middle;" rowspan="2">SAMPLE</th>
                                <th class="text-center" style="vertical-align: middle;" colspan="3">HBSAG</th>
                                <th class="text-center" style="vertical-align: middle;" colspan="3">ANTI-HCV</th>
                                <th class="text-center" style="vertical-align: middle;" colspan="3">ANTI-HIV</th>
                                <th class="text-center" style="vertical-align: middle;" colspan="3">SIFILIS/TP</th>
                                <th class="text-center" style="vertical-align: middle;" rowspan="2">STATUS<br>KANTONG</th>
                                <th class="text-center" style="vertical-align: middle;" rowspan="2">AKSI</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">OD</th>
                                <th class="text-center" style="vertical-align: middle;">RANGE</th>
                                <th class="text-center" style="vertical-align: middle;">HASIL</th>
                                <th class="text-center" style="vertical-align: middle;">OD</th>
                                <th class="text-center" style="vertical-align: middle;">RANGE</th>
                                <th class="text-center" style="vertical-align: middle;">HASIL</th>
                                <th class="text-center" style="vertical-align: middle;">OD</th>
                                <th class="text-center" style="vertical-align: middle;">RANGE</th>
                                <th class="text-center" style="vertical-align: middle;">HASIL</th>
                                <th class="text-center" style="vertical-align: middle;">OD</th>
                                <th class="text-center" style="vertical-align: middle;">RANGE</th>
                                <th class="text-center" style="vertical-align: middle;">HASIL</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no				=0;
                                $valid			=0;
                                $jumlahproses	=0;
                                $jml_test_b		=0;
                                $jml_test_c		=0;
                                $jml_test_i		=0;
                                $jml_test_s		=0;				
                                if ($jumdata>0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $od_b=$range_b=$result_b=$unit_b="";
                                        $od_c=$range_c=$result_c=$unit_c="";
                                        $od_i=$range_i=$result_i=$unit_i="";
                                        $od_s=$range_b=$result_s=$unit_s="";
                                        $bg_colorb=$bg_colorc=$bg_colori=$bg_colors=$bg_color=" default ";
                                        $umur="0";$jenisdonor="0";$donorbaru="0";
                                        $no++;
                                        $idsample=$row['mdr_sample_id'];
                                        echo '<input type="hidden" name=jeniskantong[] value="'.$row['jenis'].'">
                                            <input type="hidden" name=instrument[] value="'.$row['mdr_instrument'].'">';
                                        $od_b=$row['b_od']; $range_b=$row['b_range'];$result_b=$row['b_result'];$unit_b=$row['b_unit'];
                                        $od_c=$row['c_od']; $range_c=$row['c_range'];$result_c=$row['c_result'];$unit_c=$row['c_unit'];
                                        $od_i=$row['i_od']; $range_i=$row['i_range'];$result_i=$row['i_result'];$unit_i=$row['i_unit'];
                                        $od_s=$row['s_od']; $range_s=$row['s_range'];$result_s=$row['s_result'];$unit_s=$row['s_unit'];
                                        $nr_all="0";
                                        $cekal='0';
                                        if (($result_b=="NonReaktif") && ($result_c=="NonReaktif") && ($result_i=="NonReaktif") && ($result_s=="NonReaktif")){$all_param='1';} else {$all_param='0';}
                                        if (($result_b!=="") && ($result_c!=="") && ($result_i!=="") && ($result_s!=="")){$all_param='1';} else {$all_param='0';}
                                        if (($result_b=="Reaktif") || ($result_c=="Reaktif") || ($result_i=="Reaktif") || ($result_s=="Reaktif")){$cekal='1';}
                                        if ($result_b!==""){$jml_test_b++;};
                                        if ($result_c!==""){$jml_test_c++;};
                                        if ($result_i!==""){$jml_test_i++;};
                                        if ($result_s!==""){$jml_test_s++;};
                                        if ( $result_b=='Reaktif' ){$bg_colorb=" danger";$bg_color=" danger";}
                                        if ( $result_c=='Reaktif' ){$bg_colorc=" danger";$bg_color=" danger";}
                                        if ( $result_i=='Reaktif' ){$bg_colori=" danger";$bg_color=" danger";}
                                        if ( $result_s=='Reaktif' ){$bg_colors=" danger";$bg_color=" danger";}
                                        $status_ktg=$row['Status']; $kantong_sah=$row['sah'];
                                        $statuskantong="--";
                                        switch ($status_ktg){
                                            case '0' : $statuskantong='Kosong('.$status_ktg.')';
                                                    if ($row['StatTempat']==NULL) $statuskantong='Kosong-Logistik('.$status_ktg.')';		
                                                    if ($row['StatTempat']=='0')  $statuskantong='Kosong-Logistik ('.$status_ktg.')';
                                                    if ($row['StatTempat']=='1')  $statuskantong='Kosong-Aftap('.$status_ktg.')';
                                                    break;
                                            case '1' : if ($kantong_sah['sah']=="1"){
                                                            $statuskantong='Karantina('.$status_ktg.')';
                                                        } else{
                                                            $statuskantong='Belum disahkan('.$status_ktg.')';
                                                        }
                                                        break;
                                            case '2' : $statuskantong='Sehat('.$status_ktg.')';
                                                        if (substr($row['stat2'],0,1)=='b') $tempat=" (BDRS)";
                                                        break;
                                            case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
                                            case '4' : $statuskantong='Rusak('.$status_ktg.')';break;
                                            case '5' : $statuskantong='Rusak-Gagal('.$status_ktg.')';break;
                                            case '6' : $statuskantong='Dimusnahkan('.$status_ktg.')';break;
                                            default  : $statuskantong='-';
                                        }
                                        if (($status_ktg=='1') and ($kantong_sah=='1')){$valid++;}
                                        ////09022022 EDIT (Theo) Ambil parameter tabel Htransaksi 
                                        $htrans =  mysqli_fetch_assoc(mysqli_query($dbi,"SELECT KodePendonor, JenisDonor, umur, donorbaru  from htransaksi where NoKantong='$row[mdr_sample_id]'"));
                                        
                                        echo'
                                        <tr>
                                            <td nowrap class="text-right">'.$no.'.</td>
                                            <td nowrap class="text-left'.$bg_color.'">'.$row['mdr_sample_id'].'<input type="hidden" name="sample[]" value="'.$row['mdr_sample_id'].'">
                                                <input type="hidden" name="kodedonor[]" value="'.$htrans['KodePendonor'].'">
                                                <input type="hidden" name="jenis_donor[]" value="'.$htrans['JenisDonor'].'">
                                                <input type="hidden" name="umur[]" value="'.$htrans['umur'].'">
                                                <input type="hidden" name="donorbaru[]" value="'.$htrans['donorbaru'].'">
                                            </td>
                                            <td nowrap class="text-center'.$bg_colorb.'">'.$od_b.'<input type="hidden" name="od_b[]" value="'.$od_b.'"></td>
                                            <td nowrap class="text-center'.$bg_colorb.'">'.$range_b.' '.$unit_b.'<input type="hidden" name="range_b[]" value="'.$range_b.'"><input type="hidden" name="unit_b[]" value="'.$unit_b.'"></td>
                                            <td nowrap class="text-center'.$bg_colorb.'">'.$result_b.'<input type="hidden" name="result_b[]" value="'.$result_b.'"></td>
                                            <td nowrap class="text-center'.$bg_colorc.'">'.$od_c.'<input type="hidden" name="od_c[]" value="'.$od_c.'"></td>
                                            <td nowrap class="text-center'.$bg_colorc.'">'.$range_c.' '.$unit_c.'<input type="hidden" name="range_c[]" value="'.$range_c.'"><input type="hidden" name="unit_c[]" value="'.$unit_c.'"></td>
                                            <td nowrap class="text-center'.$bg_colorc.'">'.$result_c.'<input type="hidden" name="result_c[]" value="'.$result_c.'"></td>
                                            <td nowrap class="text-center'.$bg_colori.'">'.$od_i.'<input type="hidden" name="od_i[]" value="'.$od_i.'"></td>
                                            <td nowrap class="text-center'.$bg_colori.'">'.$range_i.' '.$unit_i.'<input type="hidden" name="range_i[]" value="'.$range_i.'"><input type="hidden" name="unit_i[]" value="'.$unit_i.'"></td>
                                            <td nowrap class="text-center'.$bg_colori.'">'.$result_i.'<input type="hidden" name="result_i[]" value="'.$result_i.'"></td>
                                            <td nowrap class="text-center'.$bg_colors.'">'.$od_s.'<input type="hidden" name="od_s[]" value="'.$od_s.'"></td>
                                            <td nowrap class="text-center'.$bg_colors.'">'.$range_s.' '.$unit_s.'<input type="hidden" name="range_s[]" value="'.$range_s.'"><input type="hidden" name="unit_s[]" value="'.$unit_s.'"></td>
                                            <td nowrap class="text-center'.$bg_colors.'">'.$result_s.'<input type="hidden" name="result_s[]" value="'.$result_s.'"></td>
                                            <td nowrap class="text-center">'.$statuskantong.'<input type="hidden" name=statuskantong[]  value="'.$status_ktg.'"></td>';
                                            $sel0="";$sel1="";$sel2="";$sel3="";
                                            if (($status_ktg=="1") && ($kantong_sah['sah']=="1") && ($nr_all=="0")){$sel1="selected";}
                                            if (($status_ktg=="1") && ($kantong_sah['sah']=="1") && ($nr_all!=="0")){$sel2="selected";}
                                            if ($status_ktg=="0"){$sel3="selected";}
                                            if ($cekal!=="0"){$sel2="selected";}
                                    echo '<td>
                                                <select name="aksi[]" class="form-control select-sm">
                                                    <option value="0" '.$sel0.'>-</option>
                                                    <option value="1" '.$sel1.'>Sehatkan</option>
                                                    <option value="2" '.$sel2.'>Cekal</option>
                                                    <option value="3" '.$sel3.'>Tunda</option>
                                                </select>
                                            </td>
                                        </tr>';
                                    }
                                }else{
                                    echo'
                                        <tr>
                                            <td nowrap class="text-center" colspan="7">'.$no.'.</td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table contain-border table-condensed shadow">
                            <tr>
                                <td class="pmi_2" style="width: 170px;">Operator Mindray</td>
                                <td style="width: 400px;" class="pmi_2">
                                    <select name="ptgs_alat" class="form-control select-sm" > 
                                        <?php
                                        $opr=mysqli_query($dbi,"select * from user where (level like '%laboratorium%' or level like '%imltd%') order by nama_lengkap");
                                        while($dt=mysqli_fetch_assoc($opr)) {
                                            ( strtoupper($dt['id_user']) == strtoupper($_SESSION['namauser']) ) ? $select=" selected" : $select="";
                                            echo '<option value="'.$dt['id_user'].'" '.$select.'>'.$dt['nama_lengkap'].'</option>';
                                        }?>
                                    </select>
                                </td>
                                <td rowspan="3" class="text-left pmi_2">
                                    <b>Catatan :</b>
                                    <ol>
                                        <li>Kantong yang bisa di-SEHAT-kan adalah semua parameter diperiksa lengkap dan status kantong Karantina</li>
                                        <li>Reagen harus dipilih sesuai parameter, jumlah dan nomor lot pemeriksaan</li>
                                        <li>Kantong darah yang diproses sesuai dengan aksi konfirmasi pada pilihan kolom paling kanan</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td class="pmi_2">Konfirmasi</td>
                                <td class="pmi_2"> <b><?php echo $namalengkap;?></b> <input type="hidden" name="ptgs_konfirmasi" value="<?php echo $namauser;?>"></td>
                            </tr>
                            <tr>
                                <td class="pmi_2">Pengesahan</td>
                                <td class="pmi_2">
                                    <select name="ptgs_sah" class="form-control select-sm" > 
                                        <?php
                                        $opr=mysqli_query($dbi,"select * from user  where (level like '%laboratorium%') or (level like '%pimpinan%') or (level like '%konseling%') or (level like '%imltd%') order by nama_lengkap");
                                        while($dt=mysqli_fetch_assoc($opr)) {
                                            ( strtoupper($dt['id_user']) == strtoupper($_SESSION['namauser']) ) ? $select=" selected" : $select="";
                                            echo '<option value="'.$dt['id_user'].'" '.$select.'>'.$dt['nama_lengkap'].'</option>';
                                        }?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="list_i" value="<?php echo $g_i;?>">
                        <input type="hidden" name="list_j" value="<?php echo $g_j;?>">
                        <input type="hidden" name="jml_test_b" value="<?php echo $jml_test_b;?>">
                        <input type="hidden" name="jml_test_c" value="<?php echo $jml_test_c;?>">
                        <input type="hidden" name="jml_test_i" value="<?php echo $jml_test_i;?>">
                        <input type="hidden" name="jml_test_s" value="<?php echo $jml_test_s;?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <?php 
                        if ($no>20){
                            echo '<a href="#atas" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-up" style="font-size: 120%;"></span>&nbsp;&nbsp;Ke Atas</a><a name="bawah" id="bawah">&nbsp';
                        }
                        echo '<a href="pmiimltd.php?module=mindray_before_raw" class="btn  btn-primary  shadow-xx"><span class="glyphicon glyphicon-repeat" style="font-size: 120%;"></span>&nbsp;&nbsp;Kembali</a>&nbsp';
                        echo '<a href="pmiimltd.php?module=mindray_menu" class="btn  btn-primary shadow-xx"><span class="glyphicon glyphicon-home" style="font-size: 120%;"></span>&nbsp;&nbsp;Menu</a>&nbsp';
                        if ($no!==0){
                            echo '<button type="submit" name="Button"  title="Proses kantong" class="btn btn-danger shadow-xx"><span class="glyphicon glyphicon-check" style="font-size: 120%;"></span>&nbsp;&nbsp;Proses Konfirmasi</button>';
                        }?>
                </div>
            </div>    
            <p>&nbsp</p>
        </form>
       
    </div>
<?php } ?>

</body>
