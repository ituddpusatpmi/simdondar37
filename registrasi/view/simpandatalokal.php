<?php
session_start();
include '../adm/config.php';
$idudd    = $_SESSION['idudd'];
$idunit   = $_SESSION['unit'];
$iduser   = $_SESSION['user'];

$today = date("Y-m-d H:i:s");
$curdate = date("Y-m-d");
$jam_donor = date("H:i:s");
//  $donorke=$data['pjmldonor']+1;  
/*$aph=$tpk="0";
    switch ($data['metode']) {
        case '2': $aph=1;break;
        case '3': $tpk=1;break;
        default:break;
    }*/

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

//POST DATA
$v_notransaksi = $id_transaksi_baru;
$kodep    = $_POST['kodep'];
$ktp      = $_POST['ktp'];
$gol      = $_POST['gol'];
$rh       = $_POST['rh'];
$jmldnr   = $_POST['jmldnr'];
$donorke  = $_POST['jmldnr'] + 1;
$namap    = $_POST['namap'];
$jk       = $_POST['jk'];
$alamat   = $_POST['alamat'];
$kel      = $_POST['kel'];
$kec      = $_POST['kec'];
$wil      = $_POST['wil'];
$telp     = $_POST['telp'];
$tmp_lhr  = $_POST['tmp_lhr'];
$tgl_lhr  = $_POST['tgl_lhr'];
$pekerjaan = $_POST['pekerjaan'];
$nikah    = $_POST['nikah'];
$jenis_donor = $_POST['jenis_donor'];
$metode   = $_POST['metode'];
$lengan   = $_POST['lengan'];
$umur     = $_POST['umur'];
$aph = $tpk = "0";
switch ($_POST['metode']) {
  case '2':
    $aph = 1;
    break;
  case '3':
    $tpk = 1;
    break;
  default:
    break;
}

$v_no1         = $_POST['no1'];
$v_no2         = $_POST['no2'];
$v_no3         = $_POST['no3'];
$v_no4         = $_POST['no4'];
$v_no5         = $_POST['no5'];
$v_no6         = $_POST['no6'];
$v_no7         = $_POST['no7'];
$v_no8         = $_POST['no8'];
$v_no9         = $_POST['no9'];
$v_no10        = $_POST['no10'];
$v_no11        = $_POST['no11'];
$v_no12        = $_POST['no12'];
$v_no13        = $_POST['no13'];
$v_no14        = $_POST['no14'];
$v_no15        = $_POST['no15'];
$v_no16        = $_POST['no16'];
$v_no17        = $_POST['no17'];
$v_no18        = $_POST['no18'];
$v_no19        = $_POST['no19'];
$v_no20        = $_POST['no20'];
$v_no21        = $_POST['no21'];
$v_no22        = $_POST['no22'];
$v_no23        = $_POST['no23'];
$v_no24        = $_POST['no24'];
$v_no25        = $_POST['no25'];
$v_no26        = $_POST['no26'];
$v_no27        = $_POST['no27'];
$v_no28        = $_POST['no28'];
$v_no29        = $_POST['no29'];
$v_no30        = $_POST['no30'];
$v_no31        = $_POST['no31'];
$v_no32        = $_POST['no32'];
$v_no33        = $_POST['no33'];
$v_no34        = $_POST['no34'];
$v_no35        = $_POST['no35'];
$v_no36        = $_POST['no36'];
$v_no37        = $_POST['no37'];
$v_no38        = $_POST['no38'];
$v_no39        = $_POST['no39'];
$v_no40        = $_POST['no40'];
$v_no41        = $_POST['no41'];
$v_no42        = $_POST['no42'];
$v_no43        = $_POST['no43'];
$v_no44        = $_POST['no44'];

$tahunlhr = substr($tgl_lhr, 0, 4);
$tahun    = date("Y");
$umur     = $tahun - $tahunlhr;
//

//CARI PENDONOR DI LOKAL
if ($data['rhesus'] == 'Neg') {
  $rhesus = '-';
} else {
  $rhesus = '+';
}
$sql_upd = "UPDATE `pendonor` SET
						`NoKTP`='$ktp',
						`Nama`='$namap',
						`Alamat`='$alamat',
						`Jk`='$jk',
						`Pekerjaan`='$pekerjaan',
						`TempatLhr`='$tmp_lhr',
						`TglLhr`='$tgl_lhr',
						`Status`='$nikah,
						`GolDarah`='$gol',
						`Rhesus`='$rh',
						`kelurahan`='$kel',
						`kecamatan`='$kec',
						`wilayah`='$wil',
						`telp2`='$telp',
						`pencatat`='$iduser',
            `umur`='$umur',
						`up_data`='2'
						WHERE `Kode`='$kodep'";
if (mysqli_query($con, $sql_upd)) {
  $msg .= '- Update data Pendonor - sukses<br>';
  $lanjut = '0';
} else {
  $msg .= '- Update data Pendonor - Gagal<br>';
  $lanjut = '1';
}

    //insert ke nasional
    $curlinsdn = curl_init();
    curl_setopt_array($curlinsdn, array(
      CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/simdondar/insertpendonor.php",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 10,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => array('idudd' => $udd[id], 'Kode' => $kodep, 'NoKTP' => $ktp, 'Nama' => $namap, 'Alamat' => $alamat, 'Jk' => $jk, 'Pekerjaan' => $pekerjaan, 'TempatLhr' => $tmp_lhr, 'TglLhr' => $tgl_lhr, 'Status' => $nikah, 'kelurahan' => $kel, 'kecamatan' => $kec, 'wilayah' => $wil, 'telp2' => $telp,  'GolDarah' => $gol, 'Rhesus' => $rh, 'jumDonor' => $jmldnr, 'Call' => '1','tglkembali' => $curdate, 'umur' => $umur, 'metode' => 'insert' ),
    ));
    $response = curl_exec($curlinsdn);
    $datains  = json_decode($response, true);
    //echo "<pre>"; print_r($response); echo "</pre>";
    curl_close($curlinsdn);

$idtrans = substr($id_transaksi_baru, 0, 8);
$check_p = mysqli_num_rows(mysqli_query($con, "select KodePendonor from htransaksi where NoTrans like '$idtrans%' and KodePendonor='$kodep'"));
if ($check_p == 0) {

  $q_htrans = "insert into htransaksi 
        (NoTrans,KodePendonor,KodePendonor_lama,Tgl,Pengambilan,ketBatal,tempat,Instansi,
        JenisDonor,id_permintaan,Status,Nopol,apheresis,kendaraan,shift,kota,umur,donorbaru,jk,
        gol_darah,rhesus,pekerjaan,donorke,user,jam_mulai,rs, donor_tpk) 
        value
        ('$id_transaksi_baru','$kodep','$kodep','$today','-','-','0','',
         '$jenis_donor','','0','-','$aph','','$shif','$udd[id]','$umur','1','$jk',
				 '$gol','$rh','$pekerjaan','$donorke','$iduser','$jam_donor','','$tpk')";
  if (mysqli_query($con, $q_htrans)) {
    $msg .= '- Diantrekan ke Medical Checkup - berhasil<br>';
    $q_ic = "INSERT INTO `htransaksi_ic` (`notrans`, `pendonor`,
						`satu`, `dua`, `tiga`, `empat`, `lima`, `enam`, `tujuh`, `delapan`, `sembilan`, `sepuluh`,
						`sebls`, `duabls`, `tigabls`, `empatbls`, `limabls`, `enambls`, `tujuhbls`, `delapanbls`, `sembilanbls`, `duapuluh`,
						`duasatu`, `duadua`, `duatiga`, `duaempat`, `dualima`, `duaenam`, `duatujuh`, `duadelapan`, `duasembilan`, `tigapuluh`,
						`tigasatu`, `tigadua`, `tigatiga`, `tigaempat`, `tigalima`, `tigaenam`, `tigatujuh`, `tigadelapan`, `tigasembilan`, `empatpuluh`,
						`empatsatu`, `empatdua`, `empattiga`, `empatempat`)
						VALUES (
						'$id_transaksi_baru', '$kodep',
						'$v_no1','$v_no2','$v_no3','$v_no4','$v_no5','$v_no6','$v_no7','$v_no8','$v_no9','$v_no10',
            '$v_no11','$v_no12','$v_no13','$v_no14','$v_no15','$v_no16','$v_no17','$v_no18','$v_no19','$v_no20',
            '$v_no21','$v_no22','$v_no23','$v_no24','$v_no25','$v_no26','$v_no27','$v_no28','$v_no29','$v_no30',
            '$v_no31','$v_no32','$v_no33','$v_no34','$v_no35','$v_no36','$v_no37','$v_no38','$v_no39','$v_no40',
            '$v_no41','$v_no42','$v_no43')";
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
    `empatsatu`, `empatdua`, `empattiga`, `empatempat`,`donorke`,`lengan`)
    VALUES (
    '$id_transaksi_baru', '$kodep','$namap','$no_antri','$curdate',
    '$v_no1','$v_no2','$v_no3','$v_no4','$v_no5','$v_no6','$v_no7','$v_no8','$v_no9','$v_no10',
    '$v_no11','$v_no12','$v_no13','$v_no14','$v_no15','$v_no16','$v_no17','$v_no18','$v_no19','$v_no20',
    '$v_no21','$v_no22','$v_no23','$v_no24','$v_no25','$v_no26','$v_no27','$v_no28','$v_no29','$v_no30',
    '$v_no31','$v_no32','$v_no33','$v_no34','$v_no35','$v_no36','$v_no37','$v_no38','$v_no39','$v_no40',
    '$v_no41','$v_no42','$v_no43','$v_no44','$donorke','$lengan')";
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
  $lanjut = '1';
}
if ($lanjut == '0') {
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
} else {
  echo "<p>
          <center> <img src='../../tpksolo/dist/img/cloud.png' width='300'><br>TRANSAKSI DONOR SUDAH ADA
          <meta http-equiv='refresh' content='5; url=donordarah.php'>";
}
mysqli_close()
?>
