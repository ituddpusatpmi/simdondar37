<?php
session_start();
include '../config/dbi_connect.php';
//include '../config/dta_config.php';

header("Content-Type: application/json");
if (!isset($_POST['noTransaksi'])) {
    echo json_encode(array("status" => "error", "message" => "Parameter tidak lengkap"));
    exit;
}

$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `nama`,`id` FROM `utd` WHERE `aktif`='1';"));
$id_uddaktif=$udd['id'];
$nama_uddaktif=$udd['nama'];
$g_noserahterima = $_POST['noTransaksi'];
$shift_terima   =   mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `nama` FROM `shift` WHERE `jam`<=current_time() and `sampai_jam`>=current_time()"));
$shift          =   $shift_terima['nama'];
$arr_sr         = array();
$arr_srd        = array();
$arr_kantong    = array();
$arr_pendonor   = array();
$arr_ht         = array();

$tgl        = date('Ymd');
$token      = "17091945".$tgl;
$sekarang   = date("Y-m-d H:i:s");


//Cari Serahterima 
$curlsr = curl_init();
    curl_setopt_array($curlsr, array(
    CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_terima_trans.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('trans' => $g_noserahterima, 'mode' => 'sr'),
    ));
    $responsesr = curl_exec($curlsr);
    curl_close($curlsr);
    //echo $response;
    $datasr = json_decode($responsesr, true);

    for($a=0; $a < count($datasr['data']); $a++){
        $no=$a+1;
        $chkdata=strlen($datasr['data'][$a]['hst_notrans']);
        if ($chkdata>0){
            
            $arr_sr = $datasr['data'][0];
            /*
            foreach($datasrd as $isinya){
                $nokantong = $isinya[‘nokantong’];
            Dst
            }
            */
        }
       }

if (!$arr_sr) {
    $arr_sr = array();
}


//Curl serahterima detail

$curlsrd = curl_init();
    curl_setopt_array($curlsrd, array(
    CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_terima_trans.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('trans' => $g_noserahterima, 'mode' => 'srd'),
    ));
    $responsesrd = curl_exec($curlsrd);
    curl_close($curlsrd);
    //echo $response;
    $datasrd = json_decode($responsesrd, true);

    for($a=0; $a < count($datasrd['data']); $a++){
        $no=$a+1;
        $chkdatasrd=strlen($datasrd['data'][$a]['dst_notrans']);
        if ($chkdatasrd>0){
            $arr_srd[]    = $datasrd['data'][$a];
        }
       }

    if (!$arr_srd) {
       $arr_srd        = array();

    }


//Curl serahterima kantong
$curlsrk = curl_init();
    curl_setopt_array($curlsrk, array(
    CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_terima_trans.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('trans' => $g_noserahterima, 'mode' => 'srk'),
    ));
    $responsesrk = curl_exec($curlsrk);
    curl_close($curlsrk);
    //echo $response;
    $datasrk = json_decode($responsesrk, true);

    for($b=0; $b < count($datasrk['data']); $b++){
        $nok=$b+1;
        $chkdatasrk=strlen($datasrk['data'][$b]['noKantong']);
        if ($chkdatasrk>0){
            $arr_kantong[]    = $datasrk['data'][$b];
        }
       }

    if (!$arr_kantong) {
       $arr_kantong        = array();

    }



//Curl serahterima pendonor
$curlsrp = curl_init();
curl_setopt_array($curlsrp, array(
CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_terima_trans.php",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => array('trans' => $g_noserahterima, 'mode' => 'srp'),
));
$responsesrp = curl_exec($curlsrp);
curl_close($curlsrp);
//echo $responsesrp;
$datasrp = json_decode($responsesrp, true);

for($c=0; $c < count($datasrp['data']); $c++){
    $nop=$c+1;
    $chkdatasrp=strlen($datasrp['data'][$c]['pkode']);
    if ($chkdatasrp>0){
        $arr_pendonor[]    = $datasrp['data'][$c];
    }
   }

if (!$arr_pendonor) {
   $arr_pendonor        = array();

}

//Curl serahterima htransaksi
$curlsrh = curl_init();
curl_setopt_array($curlsrh, array(
CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_terima_trans.php",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => array('trans' => $g_noserahterima, 'mode' => 'ht'),
));
$responsesrh = curl_exec($curlsrh);
curl_close($curlsrh);
//echo $responsesrp;
$datasrh = json_decode($responsesrh, true);

for($d=0; $d < count($datasrh['data']); $d++){
    $noh=$d+1;
    $chkdatasrh=strlen($datasrh['data'][$d]['htnotrans']);
    if ($chkdatasrh>0){
        $arr_ht[]    = $datasrh['data'][$d];
    }
   }

if (!$arr_ht) {
   $arr_ht        = array();

}



$arr_kirim = array(
    //'notransaksi' => $g_noserahterima,
    'serahterima' => $arr_sr,
    'serahterimadetail' => $arr_srd,
    'stokkantong' => $arr_kantong,
    'pendonor' => $arr_pendonor,
    'htransaksi' => $arr_ht
);

$json_data = json_encode($arr_kirim);
if (!$json_data) {
    echo json_encode(array("status" => "error", "message" => "Gagal mengonversi data ke JSON"));
    exit;
}

$file_path = 'terima_data.json';
file_put_contents($file_path, $json_data);


//JIKA FILE JSON TERBENTUK
if ($json_data) {
   // echo json_encode(array("status" => "success", "message" => "mengonversi data ke JSON"));
   // exit;

    $json_datasr  = file_get_contents("terima_data.json");
    $split        = explode("\n", $json_datasr);
    $datasr     = json_decode($json_datasr, true);

    //file_put_contents("debug_json.log", json_encode($datasr, JSON_PRETTY_PRINT));

    // Variable :
   
    
    
    //foreach ($split as $record) { 
        //$datasr                 = json_decode($record, true);
        $v_hst_id               = $datasr["serahterima"]["hst_id"];
        $v_hst_notrans          = $datasr["serahterima"]["hst_notrans"];
        $v_hst_bagpengirim      = $datasr["serahterima"]["hst_bagpengirim"];
        $v_hst_bagpenerima      = $datasr["serahterima"]["hst_bagpenerima"];
        $v_hst_tgl              = $datasr["serahterima"]["hst_tgl"];
        $v_hst_asal             = $datasr["serahterima"]["hst_asal"];
        $v_hst_jenis_st         = $datasr["serahterima"]["hst_jenis_st"];
        $v_hst_user             = $datasr["serahterima"]["hst_user"];
        $v_hst_pengirim         = $datasr["serahterima"]["hst_pengirim"];
        $v_hst_penerima         = $datasr["serahterima"]["hst_penerima"];
        $v_hst_penerima2        = $datasr["serahterima"]["hst_penerima2"];
        $v_hst_penerima3        = $datasr["serahterima"]["hst_penerima3"];
        $v_hst_kode_alat        = $datasr["serahterima"]["hst_kode_alat"];
        $v_hst_suhuterima       = $datasr["serahterima"]["hst_suhuterima"];
        $v_hst_kondisiumum      = $datasr["serahterima"]["hst_kondisiumum"];
        $v_hst_peruntukan       = $datasr["serahterima"]["hst_peruntukan"];
        $v_hst_modul            = $datasr["serahterima"]["hst_modul"];
        $v_hst_shift_penerima   = $datasr["serahterima"]["hst_shift_penerima"];
        $v_hst_termometer       = $datasr["serahterima"]["hst_termometer"];

        
        

    //$sql = "INSERT INTO ksl_serahterima VALUES ('".$v_hst_notrans."')";

    $query = "INSERT INTO serahterima 
    (hst_notrans, hst_bagpengirim, hst_bagpenerima, hst_tgl, hst_asal, hst_jenis_st, hst_user, 
    hst_pengirim, hst_penerima, hst_penerima2, hst_penerima3, hst_kode_alat, hst_suhuterima, 
    hst_kondisiumum, hst_peruntukan, hst_modul, hst_shift_penerima, hst_termometer) 
    VALUES 
    ('$v_hst_notrans', '$v_hst_bagpengirim', '$v_hst_bagpenerima', '$v_hst_tgl', '$v_hst_asal', '$v_hst_jenis_st', 
    '$v_hst_user', '$v_hst_pengirim', '$v_hst_penerima', '$v_hst_penerima2', '$v_hst_penerima3', '$v_hst_kode_alat', 
    '$v_hst_suhuterima', '$v_hst_kondisiumum', '$v_hst_peruntukan','$v_hst_modul', '$shift', '$v_hst_termometer')";

    $resultst = mysqli_query($dbi, $query);

   // }

    //INSERT DETAIL SERAH TERIMA

    $inserted_rows = 0;
    foreach ($datasr['serahterimadetail'] as $itemskantong){
        $dst_no_aftap       =   $itemskantong["dst_no_aftap"];
        $dst_tglaftap       =   $itemskantong["dst_tglaftap"];
        $dst_notrans        =   $itemskantong["dst_notrans"];
        $dst_nokantong      =   $itemskantong["dst_nokantong"];
        $dst_produk         =   $itemskantong["dst_produk"];
        $dst_statusktg      =   $itemskantong["dst_statusktg"];
        $st_statusktg_new   =   $itemskantong["st_statusktg_new"];
        $dst_old_position   =   $itemskantong["dst_old_position"];
        $dst_new_position   =   $itemskantong["dst_new_position"];
        $dst_sahktg         =   $itemskantong["dst_sahktg"];
        $dst_sahktg_new     =   $itemskantong["dst_sahktg_new"];
        $dst_merk           =   $itemskantong["dst_merk"];
        $dst_golda          =   $itemskantong["dst_golda"];
        $dst_rh             =   $itemskantong["dst_rh"];
        $dst_kodedonor      =   $itemskantong["dst_kodedonor"];
        $dst_berat          = $itemskantong["dst_berat"];
        $dst_volumektg      = $itemskantong["dst_volumektg"];
        $dst_jenisktg       = $itemskantong["dst_jenisktg"];
        $dst_sample         = $itemskantong["dst_sample"];
        $dst_sah            = $itemskantong["dst_sah"];
        $dst_dsdp           = $itemskantong["dst_dsdp"];
        $dst_lamabaru       = $itemskantong["dst_lamabaru"];
        $dst_umur           = $itemskantong["dst_umur"];
        $dst_lama_aftap     = $itemskantong["dst_lama_aftap"];
        $dst_statuspengambilan= $itemskantong["dst_statuspengambilan"];
        $dst_kel            = $itemskantong["dst_kel"];
        $dst_ptgaftap       = $itemskantong["dst_ptgaftap"];
        $dst_volambil       = $itemskantong["dst_volambil"];
        $dst_receive1       = $itemskantong["dst_receive1"];
        $dst_stat_receive1  = $itemskantong["dst_stat_receive1"];
        $dst_date_receive1  = $itemskantong["dst_date_receive1"];
        $dst_shift_receive1 = $itemskantong["dst_shift_receive1"];
        $dst_receive2       = $itemskantong["dst_receive2"];
        $dst_stat_receive2  = $itemskantong["dst_stat_receive2"];
        $dst_date_receive2  = $itemskantong["dst_date_receive2"];
        $dst_shift_receive2 = $itemskantong["dst_shift_receive2"];
        $dst_receive3       = $itemskantong["dst_receive3"];
        $dst_stat_receive3  = $itemskantong["dst_stat_receive3"];
        $dst_date_receive3  = $itemskantong["dst_date_receive3"];
        $dst_shift_receive3 = $itemskantong["dst_shift_receive3"];
        $simltd             = $itemskantong["simltd"];
        $skgd               = $itemskantong["skgd"];
        $snat               = $itemskantong["snat"];
        $packing            = $itemskantong["packing"];
        $label              = $itemskantong["label"];
        $splasma            = $itemskantong["splasma"];
        $sserum             = $itemskantong["sserum"];
        $swb                = $itemskantong["swb"];
        $volket             = $itemskantong["volket"];
        $lisis              = $itemskantong["lisis"];
        $dokumen            = $itemskantong["dokumen"];
        $infoklinis         = $itemskantong["infoklinis"];
        $no_cb              = $itemskantong["no_cb"];
        $suhu_cb            =  $itemskantong["suhu_cb"];
        $up_data            = $itemskantong["up_data"];
        $dst_donasi         = $itemskantong["dst_donasi"];
        $dst_samplevol      = $itemskantong["dst_samplevol"];
        $dst_samplejml      = $itemskantong["dst_samplejml"];
        $dst_tglolah        = $itemskantong["dst_tglolah"];
        $dst_tgled          = $itemskantong["dst_tgled"];
        $dst_tglrelease     = $itemskantong["dst_tglrelease"];
        $dts_hasilrelease   = $itemskantong["dts_hasilrelease"];
        $dst_suhusimpan     = $itemskantong["dst_suhusimpan"];
        $dst_reposisijarum  = $itemskantong["dst_reposisijarum"];
        $dst_caraambil      = $itemskantong["dst_caraambil"];
        $dst_tempataftap    = $itemskantong["dst_tempataftap"];
        $dst_imltd          = $itemskantong["dst_imltd"];
        $dst_kgd            = $itemskantong["dst_kgd"];

        $inserted_rows++;

        $querysrd = "INSERT INTO serahterima_detail 
        (dst_no_aftap, dst_tglaftap, dst_notrans, dst_nokantong, dst_produk, 
        dst_statusktg, st_statusktg_new, dst_old_position, dst_new_position, dst_sahktg, 
        dst_sahktg_new, dst_merk, dst_golda, dst_rh, dst_kodedonor, dst_berat, dst_volumektg, 
        dst_jenisktg, dst_sample, dst_sah, dst_dsdp, dst_lamabaru, dst_umur, dst_lama_aftap, 
        dst_statuspengambilan, dst_kel, dst_ptgaftap, dst_volambil, dst_receive1, dst_stat_receive1, 
        dst_date_receive1, dst_shift_receive1, dst_receive2, dst_stat_receive2, dst_date_receive2, 
        dst_shift_receive2, dst_receive3, dst_stat_receive3, dst_date_receive3, dst_shift_receive3, 
        simltd, skgd, snat, packing, label, splasma, sserum, swb, volket, lisis, dokumen, 
        infoklinis, no_cb, suhu_cb, up_data, dst_donasi, dst_samplevol, dst_samplejml, dst_tglolah, 
        dst_tgled, dst_tglrelease, dts_hasilrelease, dst_suhusimpan, dst_reposisijarum, 
        dst_caraambil, dst_tempataftap, dst_imltd, dst_kgd) 
        VALUES 
        ('$dst_no_aftap', '$dst_tglaftap', '$dst_notrans', '$dst_nokantong', '$dst_produk', 
        '$dst_statusktg', '$st_statusktg_new', '$dst_old_position', '$dst_new_position', '$dst_sahktg', 
        '$dst_merk', '$dst_merk', '$dst_golda', '$dst_rh', '$dst_kodedonor', '$dst_berat', '$dst_volumektg', 
        '$dst_jenisktg', '$dst_sample', '$dst_sah', '$dst_dsdp', '$dst_lamabaru', '$dst_umur', '$dst_lama_aftap', 
        '$dst_statuspengambilan', '$dst_kel', '$dst_ptgaftap', '$dst_volambil', '$dst_receive1', '$dst_stat_receive1', 
        '$dst_date_receive1', '$dst_shift_receive1', '$dst_receive2', '$dst_stat_receive2', '$dst_date_receive2', 
        '$dst_shift_receive2', '$dst_receive3', '$dst_stat_receive3', '$dst_date_receive3', '$dst_shift_receive3', 
        '$simltd', '$skgd', '$snat', '$packing', '$label', '$sserum', '$sserum', '$dokumen', '$dokumen', '$dokumen', '$dokumen', 
        '$infoklinis', '$no_cb', '$suhu_cb', '$up_data', '$dst_donasi', '$dst_samplevol', '$dst_samplejml', '$dst_tglolah', 
        '$dst_tgled', '$dst_tglrelease', '$dts_hasilrelease', '$dst_suhusimpan', '$dst_reposisijarum', 
        '$dst_caraambil', '$dst_tempataftap', '$dst_imltd', '$dst_kgd')";

       $resulstdt = mysqli_query($dbi, $querysrd);

    }



    $insertedkantong_rows = 0;
    foreach ($datasr['stokkantong'] as $itemskantong) {
        $noKantong      = $itemskantong['noKantong'];
        $jenis          = $itemskantong['jenis'];
        $Status         = $itemskantong['Status'];
        $tglTerima      = $itemskantong['tglTerima'];
        $tglEDBuka      = $itemskantong['tglEDBuka'];
        $volume         = $itemskantong['volume'];
        $merk           = $itemskantong['merk'];
        $kantongAsal    = $itemskantong['kantongAsal'];
        $produk         = $itemskantong['produk'];
        $sah            = $itemskantong['sah'];
        $position       = $itemskantong['position'];
        $opname_count   = $itemskantong['opname_count'];
        $opname_lasttime    = $itemskantong['opname_lasttime'];
        $Isi            = $itemskantong['Isi'];
        $gol_darah      = $itemskantong['gol_darah'];
        $RhesusDrh      = $itemskantong['RhesusDrh'];
        $stat2          = $itemskantong['stat2'];
        $StatTempat     = $itemskantong['StatTempat'];
        $kodePendonor   = $itemskantong['kodePendonor'];
        $kodePendonor_lama  = $itemskantong['kodePendonor_lama'];
        $statKonfirmasi     = $itemskantong['statKonfirmasi'];
        $tgl_konfirmasi     = $itemskantong['tgl_konfirmasi'];
        $statQC         = $itemskantong['statQC'];
        $AsalUTD        = $itemskantong['AsalUTD'];
        $tgl_Aftap      = $itemskantong['tgl_Aftap'];
        $kadaluwarsa    = $itemskantong['kadaluwarsa'];
        $pengambilan    = $itemskantong['pengambilan'];
        $tglpengolahan  = $itemskantong['tglpengolahan'];
        $tglperiksa     = $itemskantong['tglperiksa'];
        $metoda         = $itemskantong['metoda'];
        $mu             = $itemskantong['mu'];
        $stokcheck      = $itemskantong['stokcheck'];
        $ident          = $itemskantong['ident'];
        $volumeasal     = $itemskantong['volumeasal'];
        $tgl_keluar     = $itemskantong['tgl_keluar'];
        $tglmutasi      = $itemskantong['tglmutasi'];
        $hasil          = $itemskantong['hasil'];
        $kadaluwarsa_ktg    = $itemskantong['kadaluwarsa_ktg'];
        $nolot_ktg      = $itemskantong['nolot_ktg'];
        $hasilNAT       = $itemskantong['hasilNAT'];
        $keterangan     = $itemskantong['keterangan'];
        $up_data        = $itemskantong['up_data'];
        $insert_on      = $itemskantong['insert_on'];
        $tgl_release    = $itemskantong['tgl_release'];
        $prolis         = $itemskantong['prolis'];
        $hasil_release  = $itemskantong['hasil_release'];
        $kodebarang     = $itemskantong['kodebarang'];
        $tglbeli        = $itemskantong['tglbeli'];
        $lama_pengambilan = $itemskantong['lama_pengambilan'];
        $abs            = $itemskantong['abs'];
        $tgl_abs        = $itemskantong['tgl_abs'];
        $donor_tpk      = $itemskantong['donor_tpk'];
        $no_produk_tpk  = $itemskantong['no_produk_tpk'];
        $position_bag   = $itemskantong['position_bag'];
        $user_barcode   = $itemskantong['user_barcode'];
        $user_mutasi    = $itemskantong['user_mutasi'];
        $tgl_nat        = $itemskantong['tgl_nat'];
        $noSelang       = $itemskantong['noSelang'];
        $puf_status     = $itemskantong['puf_status'];

        $insertedkantong_rows++;

        $querykantong = "INSERT INTO `stokkantong`(`noKantong`, `jenis`, `Status`, `tglTerima`, `tglEDBuka`, `volume`, `merk`, `kantongAsal`, 
                   `produk`, `sah`, `position`, `opname_count`, `opname_lasttime`, `Isi`, `gol_darah`, `RhesusDrh`, `stat2`, `StatTempat`, 
                   `kodePendonor`, `kodePendonor_lama`, `statKonfirmasi`, `tgl_konfirmasi`, `statQC`, `AsalUTD`, `tgl_Aftap`, `kadaluwarsa`, 
                   `pengambilan`, `tglpengolahan`, `tglperiksa`, `metoda`, `mu`, `stokcheck`, `ident`, `volumeasal`, `tgl_keluar`, `tglmutasi`, 
                   `hasil`, `kadaluwarsa_ktg`, `nolot_ktg`, `hasilNAT`, `keterangan`, `up_data`, `insert_on`, `tgl_release`, `prolis`, `hasil_release`, 
                   `kodebarang`, `tglbeli`, `lama_pengambilan`, `abs`, `tgl_abs`, `donor_tpk`, `no_produk_tpk`, `position_bag`, `user_barcode`, 
                   `user_mutasi`, `tgl_nat`, `noSelang`, `puf_status`) 
                   VALUES (
                   '$noKantong', '$jenis', '$Status', '$tglTerima', '$tglEDBuka', '$volume', '$merk', '$kantongAsal', 
                   '$produk', '$sah', '$position', '$opname_count', '$opname_lasttime', '$Isi', '$gol_darah', '$RhesusDrh', '$stat2', '$StatTempat', 
                   '$kodePendonor', '$kodePendonor_lama', '$statKonfirmasi', '$tgl_konfirmasi', '$statQC', '$AsalUTD', '$tgl_Aftap', '$kadaluwarsa', 
                   '$pengambilan', '$tglpengolahan', '$tglperiksa', '$metoda', '$mu', '$stokcheck', '$ident', '$volumeasal', '$tgl_keluar', '$tglmutasi', 
                   '$hasil', '$kadaluwarsa_ktg', '$nolot_ktg', '$hasilNAT', '$keterangan', '$up_data', '$insert_on', '$tgl_release', '$prolis', '$hasil_release', 
                   '$kodebarang', '$tglbeli', '$lama_pengambilan', '$abs', '$tgl_abs', '$donor_tpk', '$no_produk_tpk', '$position_bag', '$user_barcode', 
                   '$user_mutasi', '$tgl_nat', '$noSelang', '$puf_status')";

       $resultktg = mysqli_query($dbi, $querykantong);

    
    }

    //Insert Pendonor
    $insertpendonor_rows = 0;
    foreach ($datasr['pendonor'] as $itemskantong) {
        $pkode          = $itemskantong['pkode'];
        $pkodelama      = $itemskantong['pkodelama'];
        $pnoktp         = $itemskantong['pnoktp'];
        $pnama          = $itemskantong['pnama'];
        $palamat        = $itemskantong['palamat'];
        $pkelurahan     = $itemskantong['pkelurahan'];
        $pkecamatan     = $itemskantong['pkecamatan'];
        $pwilayah       = $itemskantong['pwilayah'];
        $pprovinsi      = $itemskantong['pprovinsi'];
        $pkodepos       = $itemskantong['pkodepos'];
        $ptempatlahir   = $itemskantong['ptempatlahir'];
        $ptgllahir      = $itemskantong['ptgllahir'];
        $pumur          = $itemskantong['pumur'];
        $pgoldarah      = $itemskantong['pgoldarah'];
        $prhesus        = $itemskantong['prhesus'];
        $pketdarah      = $itemskantong['pketdarah'];
        $pjk            = $itemskantong['pjk'];
        $pstatus        = $itemskantong['pstatus'];
        $psukubangsa    = $itemskantong['psukubangsa'];
        $ppekerjaan     = $itemskantong['ppekerjaan'];
        $ptelp1         = $itemskantong['ptelp1'];
        $ptelp2         = $itemskantong['ptelp2'];
        $pibukandung    = $itemskantong['pibukandung'];
        $pjmldonor      = $itemskantong['pjmldonor'];
        $pcall          = $itemskantong['pcall'];
        $papheresis     = $itemskantong['papheresis'];
        $pcekal         = $itemskantong['pcekal'];
        $pjns           = $itemskantong['pjns'];
        $ptglkembali    = $itemskantong['ptglkembali'];
        $ptglkembaliapheresis   = $itemskantong['ptglkembaliapheresis'];
        $pmu            = $itemskantong['pmu'];
        $p10            = $itemskantong['p10'];
        $p25            = $itemskantong['p25'];
        $p50            = $itemskantong['p50'];
        $p75            = $itemskantong['p75'];
        $p100           = $itemskantong['p100'];
        $psatya         = $itemskantong['psatya'];
        $pprov          = $itemskantong['pprov'];
        $pinstansi      = $itemskantong['pinstansi'];
        $ppencatat      = $itemskantong['ppencatat'];
        $on_insert      = $itemskantong['on_insert'];
        $on_update      = $itemskantong['on_update'];
        $userfoto       = $itemskantong['userfoto'];
        $token          = $itemskantong['token'];
        $donor_tpk      = $itemskantong['donor_tpk'];
        $verif_tpk      = $itemskantong['verif_tpk'];

        $insertpendonor_rows++;

        $querypendonor = "insert into pendonor
        (`Kode`,`NoKTP`,`Nama`,`Alamat`,`Jk`,`Pekerjaan`,
        `telp`,`TempatLhr`,`TglLhr`,`Status`,`GolDarah`,
        `Rhesus`,`Call`,`kelurahan`,`kecamatan`,`wilayah`,`jumDonor`,`title`,
        `telp2`,`umur`,`tglkembali`,`tglkembali_apheresis`,
        `pencatat`,`mu`,`cekal`,`up`,`waktu_update`,`tanggal_entry`,`apheresis`)
        values ('$pkode','$pnoktp','$pnama','$palamat','$pjk','$ppekerjaan',
        '$ptelp2','$ptempatlahir','$ptgllahir','$pstatus','$pgoldarah',
        '$prhesus','1','$pkelurahan','$pkecamatan','$pwilayah','$pjmldonor','-',
        '$ptelp2','$pumur','$ptglkembali','$ptglkembaliapheresis',
        'Admin','','$pcekal','','$sekarang','$sekarang','$papheresis')
         ON DUPLICATE KEY UPDATE 
            `NoKTP` = '$pnoktp',
            `Nama` = '$pnama',
            `Alamat` = '$palamat',
            `Jk` = '$pjk',
            `Pekerjaan` = '$ppekerjaan',
            `telp` = '$ptelp2',
            `TempatLhr` = '$ptempatlahir',
            `TglLhr` = '$ptgllahir',
            `Status` = '$pstatus',
            `GolDarah` = '$pgoldarah',
            `Rhesus` = '$prhesus',
            `Call` = '1',
            `kelurahan` = '$pkelurahan',
            `kecamatan` = '$pkecamatan',
            `wilayah` = '$pwilayah',
            `jumDonor` = '$pjmldonor',
            `title` = '-',
            `telp2` = '$ptelp2',
            `umur` = '$pumur',
            `tglkembali` = '$ptglkembali',
            `tglkembali_apheresis` = '$ptglkembaliapheresis',
            `pencatat` = 'Admin',
            `mu` = '',
            `cekal` = '$pcekal',
            `up` = '',
            `waktu_update` = '$sekarang',
            `tanggal_entry` = '$sekarang',
            `apheresis` = '$papheresis'";

            $resultpendonor = mysqli_query($dbi, $querypendonor);

    }


    $insertht_rows = 0;
    foreach ($datasr['htransaksi'] as $itemskantong) {
        $htutd              = $itemskantong['htutd'];
        $htnotrans          = $itemskantong['htnotrans'];
        $htkodependonorlama = $itemskantong['htkodependonorlama'];
        $htkodependonor     = $itemskantong['htkodependonor'];
        $httgl              = $itemskantong['httgl'];
        $htnoantri          = $itemskantong['htnoantri'];
        $htjenisdonor       = $itemskantong['htjenisdonor'];
        $htdiambil          = $itemskantong['htdiambil'];
        $htreaksi           = $itemskantong['htreaksi'];
        $htpengambilan      = $itemskantong['htpengambilan'];
        $htcatatan          = $itemskantong['htcatatan'];
        $htkodedokter       = $itemskantong['htkodedokter'];
        $htoKantong         = $itemskantong['htoKantong'];
        $httatus            = $itemskantong['httatus'];
        $htnopol            = $itemskantong['htnopol'];
        $htnoform           = $itemskantong['htnoform'];
        $htstatdonor        = $itemskantong['htstatdonor'];
        $httempat           = $itemskantong['httempat'];
        $htuseraftap        = $itemskantong['htuseraftap'];
        $htuserregister     = $itemskantong['htuserregister'];
        $htpaketdonor       = $itemskantong['htpaketdonor'];
        $htketbatal         = $itemskantong['htketbatal'];
        $htuserhb           = $itemskantong['htuserhb'];
        $htusertensi        = $itemskantong['htusertensi'];
        $htjumhb            = $itemskantong['htjumhb'];
        $htberatbadan       = $itemskantong['htberatbadan'];
        $htinstansi         = $itemskantong['htinstansi'];
        $httahun            = $itemskantong['httahun'];
        $httensi            = $itemskantong['httensi'];
        $htsuhu             = $itemskantong['htsuhu'];
        $htnadi             = $itemskantong['htnadi'];
        $hthb               = $itemskantong['hthb'];
        $hthct              = $itemskantong['hthct'];
        $htjnsperiksa       = $itemskantong['htjnsperiksa'];
        $htcaraambil        = $itemskantong['htcaraambil'];
        $htshift            = $itemskantong['htshift'];
        $htkota             = $itemskantong['htkota'];
        $htidpermintaan     = $itemskantong['htidpermintaan'];
        $htmu               = $itemskantong['htmu'];
        $htstatustest       = $itemskantong['htstatustest'];
        $htgoldarah         = $itemskantong['htgoldarah'];
        $htrhesus           = $itemskantong['htrhesus'];
        $htjeniskantong     = $itemskantong['htjeniskantong'];
        $htvolumekantong    = $itemskantong['htvolumekantong'];
        $htumur             = $itemskantong['htumur'];
        $htdonorbaru        = $itemskantong['htdonorbaru'];
        $htpekerjaan        = $itemskantong['htpekerjaan'];
        $htjk               = $itemskantong['htjk'];
        $htdonorke          = $itemskantong['htdonorke'];
        $htapheresis        = $itemskantong['htapheresis'];
        $hthematokrit       = $itemskantong['hthematokrit'];
        $hthemoglobin       = $itemskantong['hthemoglobin'];
        $httrombosit        = $itemskantong['httrombosit'];
        $htleukosit         = $itemskantong['htleukosit'];
        $htsisadarah        = $itemskantong['htsisadarah'];
        $htkendaraan        = $itemskantong['htkendaraan'];
        $htmesinapheresis   = $itemskantong['htmesinapheresis'];
        $htlamaaftap        = $itemskantong['htlamaaftap'];
        $htrs               = $itemskantong['htrs'];
        $on_insert          = $itemskantong['on_insert'];
        $on_update          = $itemskantong['on_update'];
        $httiter_abs        = $itemskantong['httiter_abs'];


        $insertht_rows++;


        $q_htrans = "insert into htransaksi
        (`NoTrans`,`KodePendonor`,`KodePendonor_lama`,`Tgl`,`Pengambilan`,`ketBatal`,`tempat`,`Instansi`, `JenisDonor`,
        `id_permintaan`,`Status`,`Nopol`,`apheresis`,`kendaraan`,`shift`,`kota`,`umur`,`donorbaru`,`jk`, `gol_darah`,`rhesus`,
        `pekerjaan`,`donorke`,`user`,`jam_mulai`,`rs`, `donor_tpk`, `Diambil`,`NoKantong`,`StatDonor`,`jumHB`,`beratBadan`,`tensi`,
        `suhu`,`nadi`,`Hb`,`Hct`,`jnsperiksa`,`caraAmbil`,`petugasHB`,`petugasTensi`) 
        values 
        ('$htnotrans','$htkodependonor','$htkodependonor','$httgl','$htpengambilan','$htketbatal','$httempat','$htinstansi',
        '$htjenisdonor','','$httatus','-','$htapheresis','','$htshift','$htkota','$htumur','$htdonorbaru','$htjk','$htgoldarah','$htrhesus',
        '$htpekerjaan','$htdonorke','admin','$jam_donor','','$tpk','$htdiambil','$htoKantong','$htstatdonor','$htjumhb','$htberatbadan',
        '$httensi','$htsuhu','$htnadi','$hthb','$hthct','$htjnsperiksa','$htcaraambil','$htuserhb','$htusertensi')";

        $resultht = mysqli_query($dbi, $q_htrans);


    }

    if ($resultst){
        //UPDATE Antrian Konsolidasi selesai
        $curltr = curl_init();
        curl_setopt_array($curltr, array(
        CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_proses_transaksi.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('mode' => 'terima', 'trans' => $v_hst_notrans),
        ));
        $responsetr = curl_exec($curltr);
        curl_close($curltr);

        echo json_encode(array("status" => "success", "message" => "Data konsolidasi sudah diterima"));
        exit;

    } else {
        echo json_encode(array("error" => "success", "message" => "Data konsolidasi gagal diterima"));
        exit;
    }

    
        

 }




?>