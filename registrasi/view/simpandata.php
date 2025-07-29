<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include '../adm/config.php';
$idudd    = $_SESSION['idudd'];
$idunit   = $_SESSION['unit'];
$iduser   = $_SESSION['user'];

//UPLOAD FOTO
$nama_file = time() . '.jpg';
$direktori = 'foto/';
$target = $direktori . $nama_file;
move_uploaded_file($_FILES['webcam']['tmp_name'], $target);
//UPLOAD

$data = unserialize($_POST['data']);
//echo var_dump($data);
$today = date("Y-m-d H:i:s");
$curdate = date("Y-m-d");
$jam_donor = date("H:i:s");
$donorke = $data['pjmldonor'] + 1;
$aph = $tpk = "0";
switch ($data['pjmldonor']) {
  case '2':
    $aph = 1;
    break;
  case '3':
    $tpk = 1;
    break;
  default:
    break;
}

//Shift Petugas
$shift  = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama,jam,sampai_jam FROM `shift` WHERE time(now()) between time(jam) AND time(sampai_jam)"));
if ($shift['nama'] == "I") {
  $shif   = '1';
} else if ($shift['nama'] == "II") {
  $shif   = '2';
} else if ($shift['nama'] == "III") {
  $shif   = '3';
} else {
  $shif   = '4';
}

//------------------------ set id transaksi ------------------------->
$udd1   = mysqli_query($con, "select id from utd where aktif='1'");
$udd    = mysqli_fetch_assoc($udd1);
//$idp	  = mysqli_query($con,"select * from tempat_donor where active='1'");
//$idp1	  = mysqli_fetch_assoc($idp);
$th      = substr(date("Y"), 2, 2);
$bl      = date("m");
$tgl    = date("d");
$kdtp    = $idunit . $tgl . $bl . $th . "-" . $udd[id] . "-";
$idp    = mysqli_query($con, "select NoTrans from htransaksi where NoTrans like '$kdtp%' order by NoTrans DESC");
$idp1    = mysqli_fetch_assoc($idp);
$idp2    = substr($idp1[NoTrans], 14, 4);
if ($idp2 < 1) {
  $idp2 = "0000";
}
$idp3    = (int)$idp2 + 1;
$id31    = strlen($idp2) - strlen($idp3);
$idp4    = "";
for ($i = 0; $i < $id31; $i++) {
  $idp4 .= "0";
}
$id_transaksi_baru = $kdtp . $idp4 . $idp3;
//------------------------ END set id transaksi ------------------------->
//echo 'Nomor Transaksi : '.$id_transaksi_baru.'<br>';

//CARI PENDONOR DI LOKAL
$kodependonor = $data['pkode'];
if ($data['rhesus'] == 'Neg') {
  $rhesus = '-';
} else {
  $rhesus = '+';
}
$cekal_cloud = $data['pcekal'];
$q_check = mysqli_fetch_assoc(mysqli_query($con, "select * from pendonor where Kode='$kodependonor'"));
$tgl_kembali_lokal = $q_check['tglkembali'];
$tgl_kembali_cloud = $data['ptglkembali'];
if ($tglkembali_lokal > $tgl_kembali_cloud) {
  $tglkembali = $tgl_kembali_lokal;
} else {
  $tglkembali = $tgl_kembali_cloud;
}
$cekal_lokal = $q_check['Cekal'];
if ($q_check['Kode'] == $kodependonor) {
  $sql_upd = "UPDATE `pendonor` SET
						`NoKTP`='$data[pnoktp]',
						`Nama`='$data[pnama]',
						`Alamat`='$data[palamat]',
						`Jk`='$data[pjk]',
						`Pekerjaan`='$data[ppekerjaan]',
						`telp`='$data[ptelp1]',
						`TempatLhr`='$data[ptempatlahir]',
						`TglLhr`='$data[ptgllahir]',
						`Status`='$data[pstatus]',
						`GolDarah`='$data[pgoldarah]',
						`Rhesus`='$rhesus',
						`kelurahan`='$data[pkelurahan]',
						`kecamatan`='$data[pkecamatan]',
						`wilayah`='$data[pwilayah]',
						`KodePos`='$data[pkodepos]',
						`telp2`='$data[ptelp2]',
						`umur`='$data[pumur]',
						`ibukandung`='$data[pibukandung]',
						`pencatat`='$namauser',
            `tglkembali`='$tglkembali',
            `tglkembali_apheresis`='$tglkembali',
						`up_data`='2'
						WHERE `Kode`='$kodependonor'";
  if (mysqli_query($con, $sql_upd)) {
    $msg .= '- Update data Pendonor - sukses<br>';
    $lanjut = '0';
  } else {
    $msg .= '- Update data Pendonor - Gagal<br>';
    $lanjut = '1';
  }
} else {
  $sql_inst = "INSERT INTO `pendonor` (`Kode`,`NoKTP`, `Nama`, `Alamat`, `Jk`, `Pekerjaan`, `TempatLhr`, `TglLhr`,
						 `Status`, `GolDarah`, `Rhesus`,`kelurahan`, `kecamatan`, `wilayah`, `KodePos`,`telp2`, `umur`, `ibukandung`, `pencatat`, `tglkembali`)
						VALUES ('$kodependonor', '$data[pnoktp]','$data[pnama]','$data[palamat]','$data[pjk]','$data[ppekerjaan]','$data[ptempatlahir]','$data[ptgllahir]',
						 '$data[pstatus]','$data[pgoldarah]','$rhesus','$data[pkelurahan]','$data[pkecamatan]','$data[pwilayah]','$data[pkodepos]', '$data[ptelp2]','$data[pumur]','$data[pibukandung]','$iduser', '$tglkembali')";
  if (mysqli_query($con, $sql_inst)) {
    $msg .= '- Menambah data Pendonor - sukses<br>';
    $lanjut = '0';
  } else {
    $msg .= '- Menambah data Pendonor - Gagal<br>';
    $lanjut = '1';
  }
}

$idtrans = substr($id_transaksi_baru, 0, 8);
$check_p = mysqli_num_rows(mysqli_query($con, "select KodePendonor from htransaksi where NoTrans like '$idtrans%' and KodePendonor='$kodependonor'"));
if ($check_p == 0) {
  $tempatdonor = $tempat['id'];
  $q_htrans = "insert into htransaksi 
        (NoTrans,KodePendonor,KodePendonor_lama,Tgl,Pengambilan,ketBatal,tempat,Instansi,
        JenisDonor,id_permintaan,Status,Nopol,apheresis,kendaraan,shift,kota,umur,donorbaru,jk,
        gol_darah,rhesus,pekerjaan,donorke,user,jam_mulai,rs, donor_tpk) 
        value
        ('$id_transaksi_baru','$kodependonor','$kodependonor','$today','-','9','$tempatdonor','',
         '$jenisdonor','','0','-','$aph','','$shif','$udd[id]','$data[pumur]','1','$data[pjk]',
				 '$data[pgoldarah]','$rhesus','$data[ppekerjaan]','$donorke','$iduser','$jam_donor','','$tpk')";
  if (mysqli_query($con, $q_htrans)) {
    $msg .= '- Diantrekan ke Medical Checkup - berhasil<br>';
    $q_ic = "INSERT INTO `htransaksi_ic` (`notrans`, `pendonor`,
						`satu`, `dua`, `tiga`, `empat`, `lima`, `enam`, `tujuh`, `delapan`, `sembilan`, `sepuluh`,
						`sebls`, `duabls`, `tigabls`, `empatbls`, `limabls`, `enambls`, `tujuhbls`, `delapanbls`, `sembilanbls`, `duapuluh`,
						`duasatu`, `duadua`, `duatiga`, `duaempat`, `dualima`, `duaenam`, `duatujuh`, `duadelapan`, `duasembilan`, `tigapuluh`,
						`tigasatu`, `tigadua`, `tigatiga`, `tigaempat`, `tigalima`, `tigaenam`, `tigatujuh`, `tigadelapan`, `tigasembilan`, `empatpuluh`,
						`empatsatu`, `empatdua`, `empattiga`, `empatempat`)
						VALUES (
						'$id_transaksi_baru', '$data[pkode]',
						'$data[satu]','$data[dua]','$data[tiga]','$data[empat]','$data[lima]','$data[enam]','$data[tujuh]','$data[delapan]','$data[sembilan]','$data[sepuluh]',
						'$data[sebls]','$data[duabls]','$data[tigabls]','$data[empatbls]','$data[limabls]','$data[enambls]','$data[tujuhbls]','$data[delapanbls]','$data[sembilanbls]','$data[duapuluh]',
						'$data[duasatu]','$data[duadua]','$data[duatiga]','$data[duaempat]','$data[dualima]','$data[duaenam]','$data[duatujuh]','$data[duadelapan]','$data[duasembilan]','$data[tigapuluh]',
						'$data[tigasatu]','$data[tigadua]','$data[tigatiga]','$data[tigaempat]','$data[tigalima]','$data[tigaenam]','$data[tigatujuh]','$data[tigadelapan]','$data[tigasembilan]','$data[empatpuluh]',
						'$data[empatsatu]','$data[empatdua]','$data[empattiga]','$data[empatempat]')";
    if (mysqli_query($con, $q_ic)) {
      $msg .= '- Inform Concent - berhasil<br>';
      $lanjut = '0';
    } else {
      $msg .= '- Inform Concent - GAGAL<br>';
      $lanjut = '1';
    }
  } else {
    $msg .= '- Diantrekan ke Medical Checkup - GAGAL<br>';
    $lanjut = '1';
  }

  //NOMOR ANTRIAN
  $antri      = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(nomor) as nomor from `antrian` where tgl= curdate() limit 1"));
  $no_antri   = $antri['nomor'] + 1;

  $q_antri = "INSERT INTO `antrian` (`transaksi`, `pendonor`, `nama`,`nomor`,`tgl`,
    `satu`, `dua`, `tiga`, `empat`, `lima`, `enam`, `tujuh`, `delapan`, `sembilan`, `sepuluh`,
    `sebls`, `duabls`, `tigabls`, `empatbls`, `limabls`, `enambls`, `tujuhbls`, `delapanbls`, `sembilanbls`, `duapuluh`,
    `duasatu`, `duadua`, `duatiga`, `duaempat`, `dualima`, `duaenam`, `duatujuh`, `duadelapan`, `duasembilan`, `tigapuluh`,
    `tigasatu`, `tigadua`, `tigatiga`, `tigaempat`, `tigalima`, `tigaenam`, `tigatujuh`, `tigadelapan`, `tigasembilan`, `empatpuluh`,
    `empatsatu`, `empatdua`, `empattiga`, `empatempat`,`donorke`)
    VALUES (
    '$id_transaksi_baru', '$data[pkode]','$data[pnama]','$no_antri','$curdate',
    '$data[satu]','$data[dua]','$data[tiga]','$data[empat]','$data[lima]','$data[enam]','$data[tujuh]','$data[delapan]','$data[sembilan]','$data[sepuluh]',
    '$data[sebls]','$data[duabls]','$data[tigabls]','$data[empatbls]','$data[limabls]','$data[enambls]','$data[tujuhbls]','$data[delapanbls]','$data[sembilanbls]','$data[duapuluh]',
    '$data[duasatu]','$data[duadua]','$data[duatiga]','$data[duaempat]','$data[dualima]','$data[duaenam]','$data[duatujuh]','$data[duadelapan]','$data[duasembilan]','$data[tigapuluh]',
    '$data[tigasatu]','$data[tigadua]','$data[tigatiga]','$data[tigaempat]','$data[tigalima]','$data[tigaenam]','$data[tigatujuh]','$data[tigadelapan]','$data[tigasembilan]','$data[empatpuluh]',
    '$data[empatsatu]','$data[empatdua]','$data[empattiga]','$data[empatempat]','$donorke')";
  //echo $q_antri ;  

  $lanjut = '0';
  if (mysqli_query($con, $q_antri)) {
    $msg .= '- Antrian - berhasil<br>';

    $lanjut = '0';
  } else {
    $msg .= '- Antrian - GAGAL<br>';
    $lanjut = '1';
  }
} else {
  $msg .= '- Transaksi Medical Checkup sudah ada<br>';
}
if ($lanjut == '0') {
  $curl = curl_init();
  $idtransaksi = $data['id'];
  $idpendonor = $data['pkode'];
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/update_antrean_id.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('idtransaksi' => $idtransaksi, 'idpendonor' => $idpendonor, 'status' => '1'),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $msg .= '- Update Antrean Mobile<br>';


?>

  <div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col-lg-6">
        <h4><?php echo $msg; ?></h4>
        <h4>Silahkan lanjutkan pada antrean di Medical Check Up</h4>
      </div>
    </div>
  </div>
  <META http-equiv="refresh" content="0; url=../../Formulir23st.php?kp=<?php echo $kodep;?>&trans=<?php echo $id_transaksi_baru; ?>">
<?php
}
mysqli_close()
?>
