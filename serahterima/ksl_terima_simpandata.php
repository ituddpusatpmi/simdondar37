<?php
header("Content-Type: application/json");
//require_once('dta_config.php');
require_once('config/dta_config.php');
$msg ="Response : ";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
    exit;
}

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Format JSON tidak valid"]);
    exit;
}

if (!isset($data['serahterima'], $data['serahterimadetail'], $data['stokkantong'])) {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit;
}

file_put_contents("debug_json.log", json_encode($data, JSON_PRETTY_PRINT));

try {
    $dbi_pdo->beginTransaction();
    $data['serahterima']['hst_shift_penerima'] = !empty($data['serahterima']['hst_shift_penerima']) ? $data['serahterima']['hst_shift_penerima'] : null;
    $data['serahterima']['hst_termometer'] = !empty($data['serahterima']['hst_termometer']) ? $data['serahterima']['hst_termometer'] : null;

    $v_notransaksi  = $data['notransaksi'];
    $v_dariudd      = $data['dariudd'];
    $v_keudd        = $data['keudd'];
    // Variable :
    $v_hst_id = $data["serahterima"]["hst_id"];
    $v_hst_notrans = $data["serahterima"]["hst_notrans"];
    $v_hst_bagpengirim = $data["serahterima"]["hst_bagpengirim"];
    $v_hst_bagpenerima = $data["serahterima"]["hst_bagpenerima"];
    $v_hst_tgl = $data["serahterima"]["hst_tgl"];
    $v_hst_asal = $data["serahterima"]["hst_asal"];
    $v_hst_jenis_st = $data["serahterima"]["hst_jenis_st"];
    $v_hst_user = $data["serahterima"]["hst_user"];
    $v_hst_pengirim = $data["serahterima"]["hst_pengirim"];
    $v_hst_penerima = $data["serahterima"]["hst_penerima"];
    $v_hst_penerima2 = $data["serahterima"]["hst_penerima2"];
    $v_hst_penerima3 = $data["serahterima"]["hst_penerima3"];
    $v_hst_kode_alat = $data["serahterima"]["hst_kode_alat"];
    $v_hst_suhuterima = $data["serahterima"]["hst_suhuterima"];
    $v_hst_kondisiumum = $data["serahterima"]["hst_kondisiumum"];
    $v_hst_peruntukan = $data["serahterima"]["hst_peruntukan"];
    $v_hst_modul = $data["serahterima"]["hst_modul"];
    $v_hst_shift_penerima = $data["serahterima"]["hst_shift_penerima"];
    $v_hst_termometer = $data["serahterima"]["hst_termometer"];
    
    $query = "INSERT INTO serahterima 
        (hst_notrans, hst_bagpengirim, hst_bagpenerima, hst_tgl, hst_asal, hst_jenis_st, hst_user, 
        hst_pengirim, hst_penerima, hst_penerima2, hst_penerima3, hst_kode_alat, hst_suhuterima, 
        hst_kondisiumum, hst_peruntukan, hst_modul, hst_shift_penerima, hst_termometer, hst_dariudd, hst_keudd) 
        VALUES 
        (:hst_notrans, :hst_bagpengirim, :hst_bagpenerima, :hst_tgl, :hst_asal, :hst_jenis_st, 
        :hst_user, :hst_pengirim, :hst_penerima, :hst_penerima2, :hst_penerima3, :hst_kode_alat, 
        :hst_suhuterima, :hst_kondisiumum, :hst_peruntukan, :hst_modul, :hst_shift_penerima, :hst_termometer, :hst_dariudd, :hst_keudd) 
        ON DUPLICATE KEY UPDATE 
        hst_bagpengirim = VALUES(hst_bagpengirim), 
        hst_bagpenerima = VALUES(hst_bagpenerima),
        hst_tgl = VALUES(hst_tgl), 
        hst_asal = VALUES(hst_asal), 
        hst_jenis_st = VALUES(hst_jenis_st), 
        hst_user = VALUES(hst_user),
        hst_pengirim = VALUES(hst_pengirim), 
        hst_penerima = VALUES(hst_penerima), 
        hst_penerima2 = VALUES(hst_penerima2), 
        hst_penerima3 = VALUES(hst_penerima3),
        hst_kode_alat = VALUES(hst_kode_alat), 
        hst_suhuterima = VALUES(hst_suhuterima), 
        hst_kondisiumum = VALUES(hst_kondisiumum), 
        hst_peruntukan = VALUES(hst_peruntukan), 
        hst_modul = VALUES(hst_modul), 
        hst_shift_penerima = VALUES(hst_shift_penerima), 
        hst_termometer = VALUES(hst_termometer),
        hst_dariudd  = VALUES(hst_dariudd),
        hst_keudd  = VALUES(hst_keudd)";
    
    $stmt = $dbi_pdo->prepare($query);
    $stmt->bindParam(":hst_notrans", $v_hst_notrans);
    $stmt->bindParam(":hst_bagpengirim", $v_hst_bagpengirim);
    $stmt->bindParam(":hst_bagpenerima", $v_hst_bagpenerima);
    $stmt->bindParam(":hst_tgl", $v_hst_tgl);
    $stmt->bindParam(":hst_asal", $v_hst_asal);
    $stmt->bindParam(":hst_jenis_st", $v_hst_jenis_st);
    $stmt->bindParam(":hst_user", $v_hst_user);
    $stmt->bindParam(":hst_pengirim", $v_hst_pengirim);
    $stmt->bindParam(":hst_penerima", $v_hst_penerima);
    $stmt->bindParam(":hst_penerima2", $v_hst_penerima2);
    $stmt->bindParam(":hst_penerima3", $v_hst_penerima3);
    $stmt->bindParam(":hst_kode_alat", $v_hst_kode_alat);
    $stmt->bindParam(":hst_suhuterima", $v_hst_suhuterima);
    $stmt->bindParam(":hst_kondisiumum", $v_hst_kondisiumum);
    $stmt->bindParam(":hst_peruntukan", $v_hst_peruntukan);
    $stmt->bindParam(":hst_modul", $v_hst_modul);
    $stmt->bindParam(":hst_shift_penerima", $v_hst_shift_penerima);
    $stmt->bindParam(":hst_termometer", $v_hst_termometer);
    $stmt->bindParam(":hst_dariudd", $v_dariudd);
    $stmt->bindParam(":hst_keudd", $v_keudd);
    
    if (!$stmt->execute()) {
        file_put_contents("debug_sql.log", "Error serahterima: " . json_encode($stmt->errorInfo()) . "\n", FILE_APPEND);
    }
    
    // Serah Terima Detail
    $query = "INSERT INTO serahterima_detail 
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
        (:dst_no_aftap, :dst_tglaftap, :dst_notrans, :dst_nokantong, :dst_produk, 
        :dst_statusktg, :st_statusktg_new, :dst_old_position, :dst_new_position, :dst_sahktg, 
        :dst_sahktg_new, :dst_merk, :dst_golda, :dst_rh, :dst_kodedonor, :dst_berat, :dst_volumektg, 
        :dst_jenisktg, :dst_sample, :dst_sah, :dst_dsdp, :dst_lamabaru, :dst_umur, :dst_lama_aftap, 
        :dst_statuspengambilan, :dst_kel, :dst_ptgaftap, :dst_volambil, :dst_receive1, :dst_stat_receive1, 
        :dst_date_receive1, :dst_shift_receive1, :dst_receive2, :dst_stat_receive2, :dst_date_receive2, 
        :dst_shift_receive2, :dst_receive3, :dst_stat_receive3, :dst_date_receive3, :dst_shift_receive3, 
        :simltd, :skgd, :snat, :packing, :label, :splasma, :sserum, :swb, :volket, :lisis, :dokumen, 
        :infoklinis, :no_cb, :suhu_cb, :up_data, :dst_donasi, :dst_samplevol, :dst_samplejml, :dst_tglolah, 
        :dst_tgled, :dst_tglrelease, :dts_hasilrelease, :dst_suhusimpan, :dst_reposisijarum, 
        :dst_caraambil, :dst_tempataftap, :dst_imltd, :dst_kgd)
    ON DUPLICATE KEY UPDATE
        dst_tglaftap = VALUES(dst_tglaftap),
        dst_nokantong = VALUES(dst_nokantong),
        dst_produk = VALUES(dst_produk),
        dst_statusktg = VALUES(dst_statusktg),
        st_statusktg_new = VALUES(st_statusktg_new),
        dst_old_position = VALUES(dst_old_position),
        dst_new_position = VALUES(dst_new_position),
        dst_sahktg = VALUES(dst_sahktg),
        dst_sahktg_new = VALUES(dst_sahktg_new),
        dst_merk = VALUES(dst_merk),
        dst_golda = VALUES(dst_golda),
        dst_rh = VALUES(dst_rh),
        dst_kodedonor = VALUES(dst_kodedonor),
        dst_berat = VALUES(dst_berat),
        dst_volumektg = VALUES(dst_volumektg),
        dst_jenisktg = VALUES(dst_jenisktg),
        dst_sample = VALUES(dst_sample),
        dst_sah = VALUES(dst_sah),
        dst_dsdp = VALUES(dst_dsdp),
        dst_lamabaru = VALUES(dst_lamabaru),
        dst_umur = VALUES(dst_umur),
        dst_lama_aftap = VALUES(dst_lama_aftap),
        dst_statuspengambilan = VALUES(dst_statuspengambilan),
        dst_kel = VALUES(dst_kel),
        dst_ptgaftap = VALUES(dst_ptgaftap),
        dst_volambil = VALUES(dst_volambil),
        dst_receive1 = VALUES(dst_receive1),
        dst_stat_receive1 = VALUES(dst_stat_receive1),
        dst_date_receive1 = VALUES(dst_date_receive1),
        dst_shift_receive1 = VALUES(dst_shift_receive1),
        dst_receive2 = VALUES(dst_receive2),
        dst_stat_receive2 = VALUES(dst_stat_receive2),
        dst_date_receive2 = VALUES(dst_date_receive2),
        dst_shift_receive2 = VALUES(dst_shift_receive2),
        dst_receive3 = VALUES(dst_receive3),
        dst_stat_receive3 = VALUES(dst_stat_receive3),
        dst_date_receive3 = VALUES(dst_date_receive3),
        dst_shift_receive3 = VALUES(dst_shift_receive3),
        simltd = VALUES(simltd),
        skgd = VALUES(skgd),
        snat = VALUES(snat),
        packing = VALUES(packing),
        label = VALUES(label),
        splasma = VALUES(splasma),
        sserum = VALUES(sserum),
        swb = VALUES(swb),
        volket = VALUES(volket),
        lisis = VALUES(lisis),
        dokumen = VALUES(dokumen),
        infoklinis = VALUES(infoklinis),
        no_cb = VALUES(no_cb),
        suhu_cb = VALUES(suhu_cb),
        up_data = VALUES(up_data),
        dst_donasi = VALUES(dst_donasi),
        dst_samplevol = VALUES(dst_samplevol),
        dst_samplejml = VALUES(dst_samplejml),
        dst_tglolah = VALUES(dst_tglolah),
        dst_tgled = VALUES(dst_tgled),
        dst_tglrelease = VALUES(dst_tglrelease),
        dts_hasilrelease = VALUES(dts_hasilrelease),
        dst_suhusimpan = VALUES(dst_suhusimpan),
        dst_reposisijarum = VALUES(dst_reposisijarum),
        dst_caraambil = VALUES(dst_caraambil),
        dst_tempataftap = VALUES(dst_tempataftap),
        dst_imltd = VALUES(dst_imltd),
        dst_kgd = VALUES(dst_kgd)";
    $stmt = $dbi_pdo->prepare($query);

    // Proses setiap data dalam array JSON
    $inserted_rows = 0;
    foreach ($data['serahterimadetail'] as $itemskantong) {
        $stmt->execute([
            ":dst_no_aftap" => $itemskantong["dst_no_aftap"],
            ":dst_tglaftap" => $itemskantong["dst_tglaftap"],
            ":dst_notrans" => $itemskantong["dst_notrans"],
            ":dst_nokantong" => $itemskantong["dst_nokantong"],
            ":dst_produk" => $itemskantong["dst_produk"],
            ":dst_statusktg" => $itemskantong["dst_statusktg"],
            ":st_statusktg_new" => $itemskantong["st_statusktg_new"],
            ":dst_old_position" => $itemskantong["dst_old_position"],
            ":dst_new_position" => $itemskantong["dst_new_position"],
            ":dst_sahktg" => $itemskantong["dst_sahktg"],
            ":dst_sahktg_new" => $itemskantong["dst_sahktg_new"],
            ":dst_merk" => $itemskantong["dst_merk"],
            ":dst_golda" => $itemskantong["dst_golda"],
            ":dst_rh" => $itemskantong["dst_rh"],
            ":dst_kodedonor" => $itemskantong["dst_kodedonor"],
            ":dst_berat" => $itemskantong["dst_berat"],
            ":dst_volumektg" => $itemskantong["dst_volumektg"],
            ":dst_jenisktg" => $itemskantong["dst_jenisktg"],
            ":dst_sample" => $itemskantong["dst_sample"],
            ":dst_sah" => $itemskantong["dst_sah"],
            ":dst_dsdp" => $itemskantong["dst_dsdp"],
            ":dst_lamabaru" => $itemskantong["dst_lamabaru"],
            ":dst_umur" => $itemskantong["dst_umur"],
            ":dst_lama_aftap" => $itemskantong["dst_lama_aftap"],
            ":dst_statuspengambilan" => $itemskantong["dst_statuspengambilan"],
            ":dst_kel" => $itemskantong["dst_kel"],
            ":dst_ptgaftap" => $itemskantong["dst_ptgaftap"],
            ":dst_volambil" => $itemskantong["dst_volambil"],
            ":dst_receive1" => $itemskantong["dst_receive1"],
            ":dst_stat_receive1" => $itemskantong["dst_stat_receive1"],
            ":dst_date_receive1" => $itemskantong["dst_date_receive1"],
            ":dst_shift_receive1" => $itemskantong["dst_shift_receive1"],
            ":dst_receive2" => $itemskantong["dst_receive2"],
            ":dst_stat_receive2" => $itemskantong["dst_stat_receive2"],
            ":dst_date_receive2" => $itemskantong["dst_date_receive2"],
            ":dst_shift_receive2" => $itemskantong["dst_shift_receive2"],
            ":dst_receive3" => $itemskantong["dst_receive3"],
            ":dst_stat_receive3" => $itemskantong["dst_stat_receive3"],
            ":dst_date_receive3" => $itemskantong["dst_date_receive3"],
            ":dst_shift_receive3" => $itemskantong["dst_shift_receive3"],
            ":simltd" => $itemskantong["simltd"],
            ":skgd" => $itemskantong["skgd"],
            ":snat" => $itemskantong["snat"],
            ":packing" => $itemskantong["packing"],
            ":label" => $itemskantong["label"],
            ":splasma" => $itemskantong["splasma"],
            ":sserum" => $itemskantong["sserum"],
            ":swb" => $itemskantong["swb"],
            ":volket" => $itemskantong["volket"],
            ":lisis" => $itemskantong["lisis"],
            ":dokumen" => $itemskantong["dokumen"],
            ":infoklinis" => $itemskantong["infoklinis"],
            ":no_cb" => $itemskantong["no_cb"],
            ":suhu_cb" => $itemskantong["suhu_cb"],
            ":up_data" => $itemskantong["up_data"],
            ":dst_donasi" => $itemskantong["dst_donasi"],
            ":dst_samplevol" => $itemskantong["dst_samplevol"],
            ":dst_samplejml" => $itemskantong["dst_samplejml"],
            ":dst_tglolah" => $itemskantong["dst_tglolah"],
            ":dst_tgled" => $itemskantong["dst_tgled"],
            ":dst_tglrelease" => $itemskantong["dst_tglrelease"],
            ":dts_hasilrelease" => $itemskantong["dts_hasilrelease"],
            ":dst_suhusimpan" => $itemskantong["dst_suhusimpan"],
            ":dst_reposisijarum" => $itemskantong["dst_reposisijarum"],
            ":dst_caraambil" => $itemskantong["dst_caraambil"],
            ":dst_tempataftap" => $itemskantong["dst_tempataftap"],
            ":dst_imltd" => $itemskantong["dst_imltd"],
            ":dst_kgd" => $itemskantong["dst_kgd"]
        ]);
        $inserted_rows++;
    }
    // Data Kantong
    $querykantong = "INSERT INTO `stokkantong`(`noKantong`, `jenis`, `Status`, `tglTerima`, `tglEDBuka`, `volume`, `merk`, `kantongAsal`, 
                   `produk`, `sah`, `position`, `opname_count`, `opname_lasttime`, `Isi`, `gol_darah`, `RhesusDrh`, `stat2`, `StatTempat`, 
                   `kodePendonor`, `kodePendonor_lama`, `statKonfirmasi`, `tgl_konfirmasi`, `statQC`, `AsalUTD`, `tgl_Aftap`, `kadaluwarsa`, 
                   `pengambilan`, `tglpengolahan`, `tglperiksa`, `metoda`, `mu`, `stokcheck`, `ident`, `volumeasal`, `tgl_keluar`, `tglmutasi`, 
                   `hasil`, `kadaluwarsa_ktg`, `nolot_ktg`, `hasilNAT`, `keterangan`, `up_data`, `insert_on`, `tgl_release`, `prolis`, `hasil_release`, 
                   `kodebarang`, `tglbeli`, `lama_pengambilan`, `abs`, `tgl_abs`, `donor_tpk`, `no_produk_tpk`, `position_bag`, `user_barcode`, 
                   `user_mutasi`, `tgl_nat`, `noSelang`, `puf_status`) 
                   VALUES (
                   :noKantong, :jenis, :Status, :tglTerima, :tglEDBuka, :volume, :merk, :kantongAsal, 
                   :produk, :sah, :position, :opname_count, :opname_lasttime, :Isi, :gol_darah, :RhesusDrh, :stat2, :StatTempat, 
                   :kodePendonor, :kodePendonor_lama, :statKonfirmasi, :tgl_konfirmasi, :statQC, :AsalUTD, :tgl_Aftap, :kadaluwarsa, 
                   :pengambilan, :tglpengolahan, :tglperiksa, :metoda, :mu, :stokcheck, :ident, :volumeasal, :tgl_keluar, :tglmutasi, 
                   :hasil, :kadaluwarsa_ktg, :nolot_ktg, :hasilNAT, :keterangan, :up_data, :insert_on, :tgl_release, :prolis, :hasil_release, 
                   :kodebarang, :tglbeli, :lama_pengambilan, :abs, :tgl_abs, :donor_tpk, :no_produk_tpk, :position_bag, :user_barcode, 
                   :user_mutasi, :tgl_nat, :noSelang, :puf_status)
                   ON DUPLICATE KEY UPDATE 
                   `Status` = VALUES(`Status`), 
                   `tglTerima` = VALUES(`tglTerima`),
                   `tglEDBuka` = VALUES(`tglEDBuka`),
                   `volume` = VALUES(`volume`),
                   `merk` = VALUES(`merk`),
                   `kantongAsal` = VALUES(`kantongAsal`),
                   `produk` = VALUES(`produk`),
                   `sah` = VALUES(`sah`),
                   `position` = VALUES(`position`),
                   `opname_count` = VALUES(`opname_count`),
                   `opname_lasttime` = VALUES(`opname_lasttime`),
                   `Isi` = VALUES(`Isi`),
                   `gol_darah` = VALUES(`gol_darah`),
                   `RhesusDrh` = VALUES(`RhesusDrh`),
                   `stat2` = VALUES(`stat2`),
                   `StatTempat` = VALUES(`StatTempat`),
                   `kodePendonor` = VALUES(`kodePendonor`),
                   `statKonfirmasi` = VALUES(`statKonfirmasi`),
                   `tgl_konfirmasi` = VALUES(`tgl_konfirmasi`),
                   `statQC` = VALUES(`statQC`),
                   `AsalUTD` = VALUES(`AsalUTD`),
                   `tgl_Aftap` = VALUES(`tgl_Aftap`),
                   `kadaluwarsa` = VALUES(`kadaluwarsa`),
                   `pengambilan` = VALUES(`pengambilan`),
                   `tglpengolahan` = VALUES(`tglpengolahan`),
                   `tglperiksa` = VALUES(`tglperiksa`),
                   `metoda` = VALUES(`metoda`),
                   `mu` = VALUES(`mu`),
                   `stokcheck` = VALUES(`stokcheck`),
                   `ident` = VALUES(`ident`),
                   `volumeasal` = VALUES(`volumeasal`),
                   `tgl_keluar` = VALUES(`tgl_keluar`),
                   `tglmutasi` = VALUES(`tglmutasi`),
                   `hasil` = VALUES(`hasil`),
                   `kadaluwarsa_ktg` = VALUES(`kadaluwarsa_ktg`),
                   `nolot_ktg` = VALUES(`nolot_ktg`),
                   `hasilNAT` = VALUES(`hasilNAT`),
                   `keterangan` = VALUES(`keterangan`),
                   `up_data` = VALUES(`up_data`),
                   `insert_on` = VALUES(`insert_on`),
                   `tgl_release` = VALUES(`tgl_release`),
                   `prolis` = VALUES(`prolis`),
                   `hasil_release` = VALUES(`hasil_release`),
                   `kodebarang` = VALUES(`kodebarang`),
                   `tglbeli` = VALUES(`tglbeli`),
                   `lama_pengambilan` = VALUES(`lama_pengambilan`),
                   `abs` = VALUES(`abs`),
                   `tgl_abs` = VALUES(`tgl_abs`),
                   `donor_tpk` = VALUES(`donor_tpk`),
                   `no_produk_tpk` = VALUES(`no_produk_tpk`),
                   `position_bag` = VALUES(`position_bag`),
                   `user_barcode` = VALUES(`user_barcode`),
                   `user_mutasi` = VALUES(`user_mutasi`),
                   `tgl_nat` = VALUES(`tgl_nat`),
                   `noSelang` = VALUES(`noSelang`),
                   `puf_status` = VALUES(`puf_status`)";
    $stmt = $dbi_pdo->prepare($querykantong);
    $insertedkantong_rows = 0;
    foreach ($data['stokkantong'] as $itemskantong) {
        $stmt->execute([
            ':noKantong' => $itemskantong['noKantong'],
            ':jenis' => $itemskantong['jenis'],
            ':Status' => $itemskantong['Status'],
            ':tglTerima' => $itemskantong['tglTerima'],
            ':tglEDBuka' => $itemskantong['tglEDBuka'],
            ':volume' => $itemskantong['volume'],
            ':merk' => $itemskantong['merk'],
            ':kantongAsal' => $itemskantong['kantongAsal'],
            ':produk' => $itemskantong['produk'],
            ':sah' => $itemskantong['sah'],
            ':position' => $itemskantong['position'],
            ':opname_count' => $itemskantong['opname_count'],
            ':opname_lasttime' => $itemskantong['opname_lasttime'],
            ':Isi' => $itemskantong['Isi'],
            ':gol_darah' => $itemskantong['gol_darah'],
            ':RhesusDrh' => $itemskantong['RhesusDrh'],
            ':stat2' => $itemskantong['stat2'],
            ':StatTempat' => $itemskantong['StatTempat'],
            ':kodePendonor' => $itemskantong['kodePendonor'],
            ':kodePendonor_lama' => $itemskantong['kodePendonor_lama'],
            ':statKonfirmasi' => $itemskantong['statKonfirmasi'],
            ':tgl_konfirmasi' => $itemskantong['tgl_konfirmasi'],
            ':statQC' => $itemskantong['statQC'],
            ':AsalUTD' => $itemskantong['AsalUTD'],
            ':tgl_Aftap' => $itemskantong['tgl_Aftap'],
            ':kadaluwarsa' => $itemskantong['kadaluwarsa'],
            ':pengambilan' => $itemskantong['pengambilan'],
            ':tglpengolahan' => $itemskantong['tglpengolahan'],
            ':tglperiksa' => $itemskantong['tglperiksa'],
            ':metoda' => $itemskantong['metoda'],
            ':mu' => $itemskantong['mu'],
            ':stokcheck' => $itemskantong['stokcheck'],
            ':ident' => $itemskantong['ident'],
            ':volumeasal' => $itemskantong['volumeasal'],
            ':tgl_keluar' => $itemskantong['tgl_keluar'],
            ':tglmutasi' => $itemskantong['tglmutasi'],
            ':hasil' => $itemskantong['hasil'],
            ':kadaluwarsa_ktg' => $itemskantong['kadaluwarsa_ktg'],
            ':nolot_ktg' => $itemskantong['nolot_ktg'],
            ':hasilNAT' => $itemskantong['hasilNAT'],
            ':keterangan' => $itemskantong['keterangan'],
            ':up_data' => $itemskantong['up_data'],
            ':insert_on' => $itemskantong['insert_on'],
            ':tgl_release' => $itemskantong['tgl_release'],
            ':prolis' => $itemskantong['prolis'],
            ':hasil_release' => $itemskantong['hasil_release'],
            ':kodebarang' => $itemskantong['kodebarang'],
            ':tglbeli' => $itemskantong['tglbeli'],
            ':lama_pengambilan' => $itemskantong['lama_pengambilan'],
            ':abs' => $itemskantong['abs'],
            ':tgl_abs' => $itemskantong['tgl_abs'],
            ':donor_tpk' => $itemskantong['donor_tpk'],
            ':no_produk_tpk' => $itemskantong['no_produk_tpk'],
            ':position_bag' => $itemskantong['position_bag'],
            ':user_barcode' => $itemskantong['user_barcode'],
            ':user_mutasi' => $itemskantong['user_mutasi'],
            ':tgl_nat' => $itemskantong['tgl_nat'],
            ':noSelang' => $itemskantong['noSelang'],
            ':puf_status' => $itemskantong['puf_status']
        ]);
    }
    $insertedkantong_rows++;
    
    $dbi_pdo->commit();
    echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
} catch (Exception $e) {
    $dbi_pdo->rollBack();
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $e->getMessage()]);
}
?>
