
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />    
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>



<?php 
include('clogin.php');
include('config/db_connect.php');
		  $lv0=$_SESSION[leveluser];
require_once('modul/background_process.php');
		  $idp=mysql_query("select * from tempat_donor where active='1'",$con);
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") { 
			   mysql_query("update pendonor set mu='1' where Kode='$kode'",$con); 
			   $mu="1"; 
		  } else {
			   $mu="";
		  }	  
if (isset($_POST[submit])) {
	 $kode 		= $_POST["kode"];		$noktp 		= $_POST["noktp"];
	 $nama 		= $_POST["nama"];		$alamat		= $_POST["alamat"];
	 $jk 		= $_POST["jk"];			$pekerjaan 	= $_POST["pekerjaan"];
	 $telpa 	= $_POST["telp"]; 		$tempatlhr 	= $_POST["tempatlhr"];
	 $tgllhr 	= $_POST["tgllhr"];		$status 	= $_POST["status"];
	 $goldarah 	= $_POST["goldarah"];		$rhesus 	= $_POST["rhesus"];
	 $call 		= $_POST["call"];		$kelurahan 	= $_POST["kelurahan"];
	 $kecamatan     = $_POST["kecamatan"];		$wilayah        = $_POST["wilayah"];
	$kodepos 	= $_POST["kodepos"];
	 $jumdonor 	= $_POST["jumdonor"];		$telp2a 		= $_POST["telp2"];
	 $umur 		= $_POST["umur"];		$ibukandung	=$_POST["ibukandung"];
	 $namauser 	= $_SESSION[namauser];		$sekarang	= date("Y-m-d h:m:s");
	 $tglkembali	= $_POST['tglkembali'];         $mu		=$_POST["mu"];
	 $apheresis	= $_POST['apheresis'];		$tglkembali_apheresis= $_POST['tglkembali_apheresis'];  
	 
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }
	  
	  $telp=trimed($telpa);
	  $telp2=trimed($telp2a);

if ($lv0=='admin') {
	$tambah=mysql_query("UPDATE pendonor SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
		  TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
		  Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',KodePos='$kodepos',jumDonor='$jumdonor',
		  telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
		  pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali', apheresis='$apheresis',
		  tglkembali_apheresis='$tglkembali_apheresis'
		  where Kode='$kode'");
} else {
	$tambah=mysql_query("UPDATE pendonor SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
		  TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
		  Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',
		  KodePos='$kodepos',jumDonor='$jumdonor',
		  telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
		  pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali',apheresis='$apheresis',
		  tglkembali_apheresis='$tglkembali_apheresis'
		  where Kode='$kode'");

		  //pencatat='$namauser',up=b'1',waktu_update='$sekarang'
}	
	backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	if ($tambah) {
		  echo "Data Telah berhasil di-Update <br> ";
		  $idp=mysql_query("select * from tempat_donor where active='1'");
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'"); 
                
		  switch ($lv0){
			   case "mobile":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
?>				
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=transaksi_donor&Kode=<?=$kode?>">
					<? 
				} else { ?>
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=search_pendonor">
                                        <? }
			   break;
			   case "kasir":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
					?><META http-equiv="refresh" content="0; url=pmikasir.php?module=transaksi_donor&Kode=<?=$kode?>&apheresis=<?=$apheresis?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmikasir.php?module=search_pendonor"><?
				}
				break;
			   case "aftap":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
					?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=search_pendonor"><?
				}
				break;
			   case "admin":
					?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pendonor"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}

if (isset($_POST[update])) {
	 $kode 		= $_POST["kode"];		$noktp 		= $_POST["noktp"];
	 $nama 		= $_POST["nama"];		$alamat		= $_POST["alamat"];
	 $jk 		= $_POST["jk"];			$pekerjaan 	= $_POST["pekerjaan"];
	 $telpa 	= $_POST["telp"]; 		$tempatlhr 	= $_POST["tempatlhr"];
	 $tgllhr 	= $_POST["tgllhr"];		$status 	= $_POST["status"];
	 $goldarah 	= $_POST["goldarah"];		$rhesus 	= $_POST["rhesus"];
	 $call 		= $_POST["call"];		$kelurahan 	= $_POST["kelurahan"];
	 $kecamatan     = $_POST["kecamatan"];		$wilayah        = $_POST["wilayah"];
	$kodepos 	= $_POST["kodepos"];
	 $jumdonor 	= $_POST["jumdonor"];		$telp2a 		= $_POST["telp2"];
	 $umur 		= $_POST["umur"];		$ibukandung	=$_POST["ibukandung"];
	 $namauser 	= $_SESSION[namauser];		$sekarang	= date("Y-m-d h:m:s");
	 $tglkembali	= $_POST['tglkembali'];         $mu		=$_POST["mu"];
	 $apheresis	= $_POST['apheresis'];		$tglkembali_apheresis= $_POST['tglkembali_apheresis'];  
	 
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }
	  
	  $telp=trimed($telpa);
	  $telp2=trimed($telp2a);

if ($lv0=='admin') {
	$tambah=mysql_query("UPDATE pendonor SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',

		  TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
		  Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',KodePos='$kodepos',jumDonor='$jumdonor',
		  telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
		  pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali', apheresis='$apheresis',
		  tglkembali_apheresis='$tglkembali_apheresis', up_data='2'
		  where Kode='$kode'");
} else {
	$tambah=mysql_query("UPDATE pendonor SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
		  TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
		  Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',
		  KodePos='$kodepos',jumDonor='$jumdonor',
		  telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
		  pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali',apheresis='$apheresis',
		  tglkembali_apheresis='$tglkembali_apheresis', up_data='2' 
		  where Kode='$kode'");

		  //pencatat='$namauser',up=b'1',waktu_update='$sekarang'
}	
	backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	if ($tambah) {

		//=======Audit Trial====================================================================================
		$log_mdl ='REGISTRASI';
		$log_aksi='Edit pendonor: '.$kode.' - '.$nama;
		include_once "user_log.php";

	$lacak=mysql_fetch_assoc(mysql_query("SELECT
           if(NoKTP <> '$noktp', CONCAT_WS(' | ','No. KTP',NoKTP,'$noktp'), '') as col1,
           if(Nama <> '$nama', CONCAT_WS(' | ','Nama',Nama,'$nama'), '') as col2,
           if(Alamat <> '$alamat', CONCAT_WS(' | ','Alamat',Alamat,'$alamat'), '') as col3,
           if(Jk<> '$jk', CONCAT_WS(' | ','Jenis Kelamin',Jk,'$jk'), '') as col4,
           if(Pekerjaan <> '$pekerjaan', CONCAT_WS(' | ','Pekerjaan',Pekerjaan,'$pekerjaan'), '') as col5,
           if(telp <> '$telp', CONCAT_WS(' | ','Telp',telp,'$telp'), '') as col6,
           if(TempatLhr <> '$tempatlhr', CONCAT_WS(' | ','Tempat Lahir',TempatLhr,'$tempatlhr'), '') as col7,
           if(TglLhr <> '$tgllhr', CONCAT_WS(' | ','Tgl Lahir',TglLhr,'$tgllhr'), '') as col8,
           if(ibukandung <> '$ibukandung', CONCAT_WS(' | ','Ibu',ibukandung,'$ibukandung'), '') as col9,
           if(Status <> '$status', CONCAT_WS(' | ','Menikah',Status,'$status'), '') as col10,
           if(GolDarah <> '$goldarah', CONCAT_WS(' | ','Gol. Darah',GolDarah,'$goldarah'), '') as col11,
           if(Rhesus<> '$rhesus', CONCAT_WS(' | ','Rhesus',Rhesus,'$rhesus'), '') as col12,
           if(`Call` <> '$call', CONCAT_WS(' | ','Dapat Dipanggil',`Call`,'$call'), '') as col13,
           if(KodePos <> '$kodepos', CONCAT_WS(' | ','Kode Pos',KodePos,'$kodepos'), '') as col14,
           if(jumDonor <> '$jumdonor', CONCAT_WS(' | ','Jumlah Donor',jumDonor,'$jumdonor'), '') as col15,
           if(tglkembali <> '$tglkembali', CONCAT_WS(' | ','Tgl Kembali',tglkembali,'$tglkembali'), '') as col16,
           if(telp2 <> '$telp2', CONCAT_WS(' | ','No.HP',telp2,'$telp2'), '') as col17,
           if(kelurahan <> '$kelurahan', CONCAT_WS(' | ','Kelurahan',kelurahan,'$kelurahan'), '') as col18,
           if(kecamatan<> '$kecamatan', CONCAT_WS(' | ','Kecamatan',kecamatan,'$kecamatan'), '') as col19,
           if(wilayah<> '$wilayah', CONCAT_WS(' | ','Wilayah',wilayah,'$wilayah'), '') as col20
           FROM pendonor
           WHERE Kode='$kode'"));
  	  $inslacak=mysql_query("INSERT INTO histori
              (notrans, username, level_editor, waktu, KodePendonor, action, jenis, tempat, up)
              VALUES
              ('$id_transaksi_baru','$usr','$lv0','$sekarang','$kode','$lacak[col1] $lacak[col2] $lacak[col3] $lacak[col4] $lacak[col5] $lacak[col6] $lacak[col7] $lacak[col8] $lacak[col9] $lacak[col10] $lacak[col11] $lacak[col12] $lacak[col13] $lacak[col14] $lacak[col15] $lacak[col16] $lacak[col17] $lacak[col18] $lacak[col19] $lacak[col20]', '1', '$temp', '$up')");
		$hapuskosong=mysql_query("DELETE FROM histori WHERE action='                   '");

		//=====================================================================================================

		  echo "Data Telah berhasil di-Update <br> ";
		  $idp=mysql_query("select * from tempat_donor where active='1'");
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'"); 
                
		  switch ($lv0){
			   case "mobile":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
?>				
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=transaksi_donor&Kode=<?=$kode?>">
					<? 
				} else { ?>

				<META http-equiv="refresh" content="0; url=pmimobile.php?module=search_pendonor">
                                        <? }
			   break;
			   case "kasir":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
					?><META http-equiv="refresh" content="0; url=pmikasir.php?module=transaksi_donor&Kode=<?=$kode?>&apheresis=<?=$apheresis?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmikasir.php?module=search_pendonor"><?
				}
				break;
			   case "aftap":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
					?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=transaksi_donor&Kode=<?=$kode?>&apheresis=<?=$apheresis?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=search_pendonor"><?
				}
				break;
			   case "admin":
					?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pendonor"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}
                            
//SINKRON DATA THEO 040622
                            if (isset($_POST[sinkron])) {
                                 $kode         = $_POST["kode"];        $noktp         = $_POST["noktp"];
                                 $nama         = $_POST["nama"];        $alamat        = $_POST["alamat"];
                                 $jk         = $_POST["jk"];            $pekerjaan     = $_POST["pekerjaan"];
                                 $telpa     = $_POST["telp"];         $tempatlhr     = $_POST["tempatlhr"];
                                 $tgllhr     = $_POST["tgllhr"];        $status     = $_POST["status"];
                                 $goldarah     = $_POST["goldarah"];        $rhesus     = $_POST["rhesus"];
                                 $call         = $_POST["call"];        $kelurahan     = $_POST["kelurahan"];
                                 $kecamatan     = $_POST["kecamatan"];        $wilayah        = $_POST["wilayah"];
                                $kodepos     = $_POST["kodepos"];
                                 $jumdonor     = $_POST["jumdonor"];        $telp2a         = $_POST["telp2"];
                                 $umur         = $_POST["umur"];        $ibukandung    =$_POST["ibukandung"];
                                 $namauser     = $_SESSION[namauser];        $sekarang    = date("Y-m-d h:m:s");
                                 $tglkembali    = $_POST['tglkembali'];         $mu        =$_POST["mu"];
                                 $apheresis    = $_POST['apheresis'];        $tglkembali_apheresis= $_POST['tglkembali_apheresis'];
                                 
                                 function trimed($txt){
                                  $txt = trim($txt);
                                  while(strpos($txt, ' ') ){
                                  $txt = str_replace(' ', '', $txt);
                                  }
                                  return $txt;
                                  }
                                  
                                  $telp=trimed($telpa);
                                  $telp2=trimed($telp2a);

                            if ($lv0=='admin') {
                                $tambah=mysql_query("UPDATE pendonor SET
                                      NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
                                      Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',

                                      TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
                                      Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
                                      kecamatan='$kecamatan',wilayah='$wilayah',KodePos='$kodepos',jumDonor='$jumdonor',
                                      telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
                                      pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali', apheresis='$apheresis',
                                      tglkembali_apheresis='$tglkembali_apheresis', up_data='2'
                                      where Kode='$kode'");
                            } else {
                                $tambah=mysql_query("UPDATE pendonor SET
                                      NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
                                      Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
                                      TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
                                      Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
                                      kecamatan='$kecamatan',wilayah='$wilayah',
                                      KodePos='$kodepos',jumDonor='$jumdonor',
                                      telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
                                      pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali',apheresis='$apheresis',
                                      tglkembali_apheresis='$tglkembali_apheresis', up_data='2'
                                      where Kode='$kode'");

                                      //pencatat='$namauser',up=b'1',waktu_update='$sekarang'
                            }
                                backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
                                
                                if ($tambah) {

                                    //=======Audit Trial====================================================================================
                                    $log_mdl ='REGISTRASI';
                                    $log_aksi='Edit pendonor: '.$kode.' - '.$nama;
                                    include_once "user_log.php";

                                $lacak=mysql_fetch_assoc(mysql_query("SELECT
                                       if(NoKTP <> '$noktp', CONCAT_WS(' | ','No. KTP',NoKTP,'$noktp'), '') as col1,
                                       if(Nama <> '$nama', CONCAT_WS(' | ','Nama',Nama,'$nama'), '') as col2,
                                       if(Alamat <> '$alamat', CONCAT_WS(' | ','Alamat',Alamat,'$alamat'), '') as col3,
                                       if(Jk<> '$jk', CONCAT_WS(' | ','Jenis Kelamin',Jk,'$jk'), '') as col4,
                                       if(Pekerjaan <> '$pekerjaan', CONCAT_WS(' | ','Pekerjaan',Pekerjaan,'$pekerjaan'), '') as col5,
                                       if(telp <> '$telp', CONCAT_WS(' | ','Telp',telp,'$telp'), '') as col6,
                                       if(TempatLhr <> '$tempatlhr', CONCAT_WS(' | ','Tempat Lahir',TempatLhr,'$tempatlhr'), '') as col7,
                                       if(TglLhr <> '$tgllhr', CONCAT_WS(' | ','Tgl Lahir',TglLhr,'$tgllhr'), '') as col8,
                                       if(ibukandung <> '$ibukandung', CONCAT_WS(' | ','Ibu',ibukandung,'$ibukandung'), '') as col9,
                                       if(Status <> '$status', CONCAT_WS(' | ','Menikah',Status,'$status'), '') as col10,
                                       if(GolDarah <> '$goldarah', CONCAT_WS(' | ','Gol. Darah',GolDarah,'$goldarah'), '') as col11,
                                       if(Rhesus<> '$rhesus', CONCAT_WS(' | ','Rhesus',Rhesus,'$rhesus'), '') as col12,
                                       if(`Call` <> '$call', CONCAT_WS(' | ','Dapat Dipanggil',`Call`,'$call'), '') as col13,
                                       if(KodePos <> '$kodepos', CONCAT_WS(' | ','Kode Pos',KodePos,'$kodepos'), '') as col14,
                                       if(jumDonor <> '$jumdonor', CONCAT_WS(' | ','Jumlah Donor',jumDonor,'$jumdonor'), '') as col15,
                                       if(tglkembali <> '$tglkembali', CONCAT_WS(' | ','Tgl Kembali',tglkembali,'$tglkembali'), '') as col16,
                                       if(telp2 <> '$telp2', CONCAT_WS(' | ','No.HP',telp2,'$telp2'), '') as col17,
                                       if(kelurahan <> '$kelurahan', CONCAT_WS(' | ','Kelurahan',kelurahan,'$kelurahan'), '') as col18,
                                       if(kecamatan<> '$kecamatan', CONCAT_WS(' | ','Kecamatan',kecamatan,'$kecamatan'), '') as col19,
                                       if(wilayah<> '$wilayah', CONCAT_WS(' | ','Wilayah',wilayah,'$wilayah'), '') as col20
                                       FROM pendonor
                                       WHERE Kode='$kode'"));
                                    $inslacak=mysql_query("INSERT INTO histori
                                          (notrans, username, level_editor, waktu, KodePendonor, action, jenis, tempat, up)
                                          VALUES
                                          ('$id_transaksi_baru','$usr','$lv0','$sekarang','$kode','$lacak[col1] $lacak[col2] $lacak[col3] $lacak[col4] $lacak[col5] $lacak[col6] $lacak[col7] $lacak[col8] $lacak[col9] $lacak[col10] $lacak[col11] $lacak[col12] $lacak[col13] $lacak[col14] $lacak[col15] $lacak[col16] $lacak[col17] $lacak[col18] $lacak[col19] $lacak[col20]', '1', '$temp', '$up')");
                                    $hapuskosong=mysql_query("DELETE FROM histori WHERE action='                   '");

                                    //=====================================================================================================

                                      echo "Data Telah berhasil di-Update <br> ";
                                      $idp=mysql_query("select * from tempat_donor where active='1'");
                                      $idp1=mysql_fetch_assoc($idp);
                                      if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'");
                                            
                                      switch ($lv0){
                                           case "mobile":
                                            $cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));
                                            if ($cek[Cekal]=="0") {
                            ?>
                                            <META http-equiv="refresh" content="0; url=pmimobile.php?module=trcnas&Kode=<?=$kode?>">
                                                <?
                                            } else { ?>

                                            <META http-equiv="refresh" content="0; url=pmimobile.php?module=search_pendonor">
                                                                    <? }
                                           break;
                                           case "kasir":
                                            $cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));
                                            if ($cek[Cekal]=="0") {
                                                ?><META http-equiv="refresh" content="0; url=pmikasir.php?module=trcnas&Kode=<?=$kode?>"><?
                                               } else {
                                            ?><META http-equiv="refresh" content="0; url=pmikasir.php?module=search_pendonor"><?
                                            }
                                            break;
                                           case "aftap":
                                            $cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));
                                            if ($cek[Cekal]=="0") {
                                                ?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=trcnas&Kode=<?=$kode?>"><?
                                               } else {
                                            ?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=search_pendonor"><?
                                            }
                                            break;
                                           case "admin":
                                                ?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pendonor"><?
                                           break;
                                           default:
                                                echo "$lv0 ANDA tidak memiliki hak akses";
                                      }
                                 }
                                 $_POST['periksa']="";
                            }
//

if (isset($_GET[Kode])) {
	 $perintah=mysql_query("select * from pendonor where Kode='$_GET[Kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Nomor formulir yang anda masukkan belum terdaftar";
		  ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=eregistrasi"><?
	 } else {	
?>
<h1 class="table">EDIT DATA PENDONOR</h1>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" width=65%  cellspacing="1" cellpadding="2">
<tr>
	 <td>Kode Pendonor</td>
	 <td class="input"><?=$row[Kode]?></td>
<td>Nama Ibu Kandung</td>
	 <td class="input">
		  <input name="ibukandung" type="text" size="30" value="<?=$row[ibukandung]?>">
	 </td>
</tr>
<tr>
	 <td>No. KTP</td>
	 <td class="input">
		  <input name="noktp" type="text" size="30" value="<?=$row[NoKTP]?>">
	 </td>
<td>Golongan Darah</td>
     <td class="input">
			<? 
			$sA='';$sB='';$sAB='';$sO='';
			if ($row[GolDarah]=='A') $sA='selected';
			if ($row[GolDarah]=='B') $sB='selected';
			if ($row[GolDarah]=='AB') $sAB='selected';
			if ($row[GolDarah]=='O') $sO='selected';
			if ($row[GolDarah]=='X') $sX='selected';
			?>
			<select name="goldarah">
				<option value="A" <?=$sA?>>A</option>
				<option value="B" <?=$sB?>>B</option>
				<option value="AB" <?=$sAB?>>AB</option>
				<option value="O" <?=$sO?>>O</option>
				<option value="X" <?=$sX?>>X</option>
			</select>
	 </td>

</tr>
<tr>
	 <td>Nama</td>
	 <td class="input">
		  <input name="nama" type="text" size="30" value="<?=$row[Nama]?>">
	 </td>
     <td>Rhesus</td>
     <td class="input">
			<? 
			$rn='';$rp='';
			if ($row[Rhesus]=='-') $rn='selected';
			if ($row[Rhesus]=='+') $rp='selected';
				?>
			<select name="rhesus">
				<option value="+" <?=$rp?>>(+)</option>
				<option value="-" <?=$rn?>>(-)</option>
			</select>
	 </td>

</tr>
<tr>
<td>Tempat Lahir</td>
	 <td class="input">
		  <input name="tempatlhr" type="text" size="30" value="<?=$row[TempatLhr]?>">
	 </td>
	 
<td >Telepon</td>
	 <td class="input">
		  <input name="telp" type="text" size="30" value="<?=$row[telp]?>">
	 </td>
</tr>
<tr>
<td>Tgl Lahir</td>
      <td class="input">
		  <INPUT TYPE="text" NAME="tgllhr" id="datepicker" VALUE="<?=$row[TglLhr]?>" SIZE=25  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
	 </td>

     
<td>HP</td>
	 <td class="input">
		  <input name="telp2" type="text" size="30" value="<?=$row[telp2]?>" required>
	 </td>

</tr>
<tr> 
<td>Umur</td>
	 <td class="input">
		  <input name="umur" type="text" size="2" value="<?=$row[umur]?>">Tanggal harus benar
	 </td>					

 <td>Dapat dipanggil</td>
     <td class="input">
        <?php
		  $type=$row[Call];
		  $selected[$type]="selected";?>
	 <select name="call">
		  <option value="1" <?=$selected["1"]?>>Dapat</option>
		  <option value="0" <?=$selected["0"]?>>Tidak</option>
	 </select>
     </td>

			   </tr>


<tr> 
<td>Jenis Kelamin</td>
     <td class="input">
		  <?php
			   $type=$row[Jk];
			   $checked[$type]="checked";
		  ?>
		  <input type="radio" name="jk" value="0" <?=$checked["0"]?>>
			   Laki-laki
		  <input type="radio" name="jk" value="1" <?=$checked["1"]?>>
		  Perempuan
	 </td>
      
<td>Alamat</td>
	 <td class="input">
		  <input name="alamat" type="text" size="30" value="<?=$row[Alamat]?>">
	 </td>

    </tr>

<tr>
     <td>Status Nikah</td>
     <td class="input">
		  <?php
			   $type=$row[Status];
				$checked["0"]='';
				$checked["1"]='';
			   $checked[$type]="checked";?>
		  <input type="radio" name="status" value="0" <?=$checked["0"]?>>
			   Belum Nikah
		  <input type="radio" name="status" value="1" <?=$checked["1"]?>>
			   Nikah
	 </td>
<td>Kelurahan</td>
	 <td class="input">
		  <input name="kelurahan" type="text" size="30" value="<?=$row[kelurahan]?>">
	 </td>
</tr>


<tr>
	 <td>Jumlah Donor (*)</td>
	 <td class="input">
		  <input name="jumdonor" type="text" size="30" value="<?=$row[jumDonor]?>">
	 </td>
<td>Kecamatan</td>
	 <td class="input">
		  <input name="kecamatan" type="text" size="30" value="<?=$row[kecamatan]?>">
	 </td>
</tr>
<tr>
	 <td>Tanggal Kembali (*)</td>
	 <td class="input">
		  <input name="tglkembali" type="text" size="30" value="<?=$row[tglkembali]?>">
	 </td>
	 
<td>Wilayah</td>
	 <td class="input">
		  <input name="wilayah" type="text" size="30" value="<?=$row[wilayah]?>">
	 </td>

</tr>
<? //} ?>

<tr>
<td>Tanggal Kembali Apheresis</td>
	 <td class="input">
		  <input name="tglkembali_apheresis" type="text" size="30" value="<?=$row[tglkembali_apheresis]?>">
	 </td>
<td>Kode Pos</td>
	 <td class="input">
		  <input name="kodepos" type="text" size="30" value="<?=$row[KodePos]?>">
	 </td>
</tr>

<tr>
	 
<td>Pekerjaan</td>
					<td class="input">
						 <select name="pekerjaan" >
								   <?php
								   $q="select * from pekerjaan";
								   $do=mysql_query($q,$con);
										$select="";
								   while($data=mysql_fetch_assoc($do)){
									if ($data[Nama]==$row[Pekerjaan]) $select='selected';
								   ?>
							  <option value="<?=$data[Nama]?>"<?=$select?>>
								   <?=$data[Nama]?>
							  </option>
								   <?
										$select="";
									}?>
						 </select>
					</td>	
 
<td>Donor Apheresis?</td>
     <td class="input">
			<? 
			$apheresis_no='';$apheresis_ya='';
			if ($row[apheresis]=='0') $apheresis_no='selected';
			if ($row[apheresis]=='1') $apheresis_ya='selected';
				?>
			<select name="apheresis">
				<option value="0" <?=$apheresis_no?>>Tidak Bersedia</option>
				<option value="1" <?=$apheresis_ya?>>Bersedia</option>
			</select>
	 </td>

</tr>

</table><br>
<input type="hidden" value="1" name="periksa">
<input type="hidden" name="mu" value="<?=$mu?>">
<input type="hidden" value="<?=$row[Kode]?>" name="kode">

<input type="submit" value="Update | Donor Biasa" name="submit" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
<input type="submit" value="Update | Apheresis" name="update" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
<input type="submit" value="Sinkron | Data Nasional" name="sinkron" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
</form>

<?
}}
?>
