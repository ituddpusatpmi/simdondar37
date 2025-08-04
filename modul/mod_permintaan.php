<body OnLoad="document.permintaandarah.no_formulir.focus();">

	<?php
	require_once('config/db_connect.php');
	session_start();
	$namaudd = $_SESSION[namaudd];
	$ptg =	mysql_query("SELECT `petugas` FROM htranspermintaan");
	if (!$ptg) {
		mysql_query("ALTER TABLE `htranspermintaan` ADD `petugas` VARCHAR(7 ) DEFAULT NULL AFTER `nojenis`");
	}
	$nat =	mysql_query("SELECT `nat` FROM dtranspermintaan");
	if (!$nat) {
		mysql_query("ALTER TABLE `dtranspermintaan` ADD `nat` CHAR(1 ) DEFAULT '0'");
	}
	$wil =	mysql_query("SELECT `wilayah` FROM htranspermintaan");
	if (!$wil) {
		mysql_query("ALTER TABLE `htranspermintaan` ADD `wilayah` CHAR(1 ) DEFAULT '0'");
	}

	mysql_query("create table if not EXISTS daftarpasien (
`Notrans` INT( 12 ) NOT NULL AUTO_INCREMENT ,
`tanggal` date DEFAULT NULL,
`noform` VARCHAR( 15) DEFAULT NULL,
`nama` VARCHAR( 20) DEFAULT NULL,
`rs` VARCHAR( 25) DEFAULT NULL,
`sifat` VARCHAR( 20) DEFAULT NULL,
`status` VARCHAR( 20) NOT NULL DEFAULT 'Proses Lab -+ 2 Jam',
`up` INT( 1) NOT NULL DEFAULT 0,
`jamtiba` time NOT NULL,
`jamsls` time NOT NULL,
`id_udd` VARCHAR( 6) NOT NULL,
PRIMARY KEY ( `Notrans` )) ");

	//copy table htranspermintaan
	mysql_query("create table if not EXISTS copyhtranspermintaan as select * from htranspermintaan");
	//hapus table htranspermintaan lama
	$col4 =	mysql_query("SELECT `no_rm` FROM `htranspermintaan`");
	if (!$col4) {
		mysql_query("drop table htranspermintaan");

		//buat tabel htranspermintaan baru
		mysql_query("CREATE TABLE htranspermintaan (
  	`noform` varchar(17) NOT NULL DEFAULT '',
  	`bagian` varchar(15) DEFAULT NULL,
  	`kelas` varchar(15) DEFAULT NULL,
  	`namadokter` varchar(30) DEFAULT NULL,
  	`tglminta` date DEFAULT NULL,
  	`diagnosa` varchar(30) DEFAULT NULL,
  	`alasan` varchar(25) DEFAULT NULL,
  	`hb` varchar(3) DEFAULT NULL,
  	`jenis` varchar(20) DEFAULT NULL,
  	`stat` varchar(20) DEFAULT NULL,
  	`rs` varchar(30) DEFAULT NULL,
  	`regrs` varchar(25) DEFAULT NULL,
  	`shift` varchar(25) DEFAULT NULL,
  	`tempat` varchar(20) DEFAULT NULL,
  	`nojenis` varchar(11) DEFAULT NULL,
  	`no_rm` varchar(20) DEFAULT NULL,
  	`umur` varchar(3) DEFAULT NULL,
  	`petugas` varchar(30) DEFAULT NULL,
  	`tgl_register` datetime DEFAULT NULL,
  	`ruangan` varchar(20) DEFAULT NULL,
  	`pernah_transfusi` char(1) DEFAULT NULL,
  	`kapan` varchar(15) DEFAULT NULL,
  	`jenis_permintaan` varchar(15) DEFAULT NULL,
  	`reaksi_transfusi` char(1) DEFAULT NULL,
  	`gejala` varchar(15) DEFAULT NULL,
  	`jml_kehamilan` varchar(3) DEFAULT NULL,
  	`abortus` varchar(10) DEFAULT NULL,
  	`ket` varchar(30) DEFAULT NULL,
  	PRIMARY KEY (`noform`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		mysql_query("CREATE TABLE `pasien` (
  	`no_rm` varchar(32) NOT NULL,
  	`nama` varchar(60) NOT NULL,
  	`alamat` varchar(100) NOT NULL,
  	`gol_darah` char(2) NOT NULL,
  	`rhesus` char(1) NOT NULL,
  	`kelamin` char(1) NOT NULL,
  	`keluarga` varchar(60) NOT NULL,
  	`tgl_lahir` date NOT NULL,
  	`tlppasien` varchar(14) NOT NULL,
  	PRIMARY KEY (`no_rm`)) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
	}

	$col5 =	mysql_query("SELECT `Nama` FROM `ruangan`");
	if (!$col5) {
		mysql_query("CREATE TABLE `ruangan`(`Nama` varchar (30), PRIMARY KEY(`Nama`))");
	}


	$col6 =	mysql_query("SELECT `nama` FROM `diagnosa`");
	if (!$col6) {
		mysql_query(" CREATE TABLE `diagnosa` (
	`kode` INT( 2 ) NOT NULL AUTO_INCREMENT ,
	`nama` VARCHAR( 40 ) NOT NULL,  
	PRIMARY KEY(`kode`)) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

		mysql_query("INSERT INTO `diagnosa` (`kode`,`nama`)VALUES ( NULL , 'Anemia Kronis'), ( NULL , 'Cidera / Kecelakaan'), ( NULL , 'DBD'), ( NULL , 'Keganasan'), ( NULL , 'Pendarahan Post Partum'), (  NULL , 'Pendarahan Lain terkait kehamilan'), ( NULL , 'Pendarahan Saluran Cerna'), ( NULL , 'Thalasemia'), ( NULL ,'Lain - lain')");
	}

	$col7 =	mysql_query("SELECT * FROM htranspermintaan where jenis_permintaan='0'");
	if ($col7) {
		mysql_query("update htranspermintaan set jenis_permintaan='Biasa' where jenis_permintaan='0'");
	}
	$col8 =	mysql_query("SELECT * FROM htranspermintaan where jenis_permintaan='1'");
	if ($col8) {
		mysql_query("update htranspermintaan set jenis_permintaan='Cadangan' where jenis_permintaan='1'");
	}
	$col9 =	mysql_query("SELECT * FROM htranspermintaan where jenis_permintaan='2'");
	if ($col9) {
		mysql_query("update htranspermintaan set jenis_permintaan='Siap Pakai' where jenis_permintaan='2'");
	}
	$col10 =	mysql_query("SELECT * FROM htranspermintaan where jenis_permintaan='3'");
	if ($col10) {
		mysql_query("update htranspermintaan set jenis_permintaan='Cyto/Segera' where jenis_permintaan='3'");
	}


	// update table dtranspermintaan
	$col2 =	mysql_query("SELECT ID FROM dtranspermintaan");
	if (!$col2) {
		mysql_query("ALTER TABLE `dtranspermintaan` ADD `ID` INT( 11 ) NOT NULL AUTO_INCREMENT FIRST , ADD PRIMARY KEY ( `ID` ) ");
	}
	//$col3=mysql_query("SELECT `no_rm` FROM dtranspermintaan");if (!$col3){mysql_query("ALTER TABLE `dtranspermintaan` ADD `no_rm` VARCHAR( 20 ) DEFAULT NULL ) ");}
	$pmb =	mysql_query("SELECT `tempat` FROM `dpembayaranpermintaan`");
	if (!$pmb) {
		mysql_query("ALTER table `dpembayaranpermintaan` ADD `tempat` VARCHAR( 7 ) NOT NULL DEFAULT 'UDD'");
	}
	$pmb1 =	mysql_query("SELECT `no_rm` FROM `dtranspermintaan`");
	if (!$pmb1) {
		mysql_query("ALTER TABLE `dtranspermintaan` ADD `no_rm` VARCHAR( 20 ) NOT NULL");
	}

	$rs =	mysql_query("select rs from kwitansi");
	if (!$rs) {
		mysql_query("ALTER TABLE `kwitansi` ADD `no_rm` VARCHAR( 15 ) NULL DEFAULT NULL ,
	ADD `rs` VARCHAR( 7 ) NULL DEFAULT NULL ,
	ADD `layanan` VARCHAR( 7 ) NULL DEFAULT NULL ");
		mysql_query("update kwitansi as kw,dtransaksipermintaan dt set kw.no_rm=dt.no_rm,kw.rs=dt.rs,kw.layanan=dt.layanan where kw.noform=dt.noform");
	}

	$pmb2 =	mysql_query("SELECT `rs` FROM `dpembayaranpermintaan`");
	if (!$pmb2) {
		mysql_query("ALTER table `dpembayaranpermintaan` 
	ADD `rs` VARCHAR( 8 ) NULL DEFAULT NULL,
	ADD `layanan` VARCHAR( 8 ) NULL DEFAULT NULL,
	ADD `kwitansi` VARCHAR( 15 ) NULL DEFAULT NULL,
	ADD `stat` INT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=Belum 1=Sudah Dicetak'");
		mysql_query("update dpembayaranpermintaan as kw,dtransaksipermintaan dt set kw.no_rm=dt.no_rm,kw.rs=dt.rs,kw.layanan=dt.layanan where kw.notrans=dt.noform");
	}

	$nojam =	mysql_query("SELECT `nojaminan` FROM `htranspermintaan`");
	if (!$nojam) {
		mysql_query("ALTER table `htranspermintaan` ADD `nojaminan` VARCHAR( 20 ) NULL DEFAULT '-'");
	}

	$umurpas = mysql_query("SELECT `umur` FROM `pasien`");
	if (!$umurpas) {
		mysql_query("ALTER table `pasien` ADD `umur` int( 3 ) NULL DEFAULT '0'");
		mysql_query("ALTER TABLE `dpembayaran` CHANGE `noForm` `noForm` VARCHAR( 17 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''");
		mysql_query("ALTER TABLE `dpembayaranpermintaan` CHANGE `notrans` `notrans` VARCHAR( 17 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''");
		mysql_query("ALTER TABLE `pembayaran` CHANGE `NoTrans` `NoTrans` VARCHAR( 17 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ");
	}

	$nonota = mysql_query("SELECT `nonota` FROM `pembayaran` ");
	if (!$nonota) {
		mysql_query("ALTER table `pembayaran` 
ADD `nonota` VARCHAR( 17) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
ADD `stat` INT( 1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=Belum 1=Sudah Cetak',
ADD `shift` VARCHAR( 4 ) NOT NULL ");
		mysql_query("update `pembayaran` as p `kwitansi` as k set p.nota=k.nomer where p.notrans=k.noform and p.jumlah=k.jumlah");
		mysql_query("ALTER TABLE `kwitansi` CHANGE `Tgl` `Tgl` DATETIME NULL DEFAULT NULL ");
	}


	?>



	<SCRIPT LANGUAGE="JavaScript" SRC="js/rs.js"></SCRIPT>
	<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
	<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
	<script type="text/javascript" src="js/tgl_lahir_minta.js"></script>
	<script type="text/javascript" src="js/tgl_butuh.js?v=1.0b"></script>
	<script type="text/javascript" src="js/disable_enter.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			$('#dokter').autocomplete({
					source: 'modul/suggest_dokter.php',
					minLength: 2
				}),
				$('#ruangan').autocomplete({
					source: 'modul/suggest_ruangan.php',
					minLength: 2
				}),
				$('#jenis').autocomplete({
					source: 'modul/suggest_jenis.php',
					minLength: 2
				}),
				$('#diagnosa').autocomplete({
					source: 'modul/suggest_diagnosa.php',
					minLength: 2
				}),
				$('#rmhsakit').autocomplete({
					source: 'modul/suggest_rs.php',
					minLength: 2
				});
		});
	</script>
	<style type="text/css">
		.styled-select select {
			background-color: #FCF9F9;
			border: none;
			width: auto;
			padding: 1px;
			font-size: 13px;
			cursor: pointer;
		}
	</style>
	<?php
	include("config/db_connect.php");
	//include ("config/db_connect_led.php");
	if (isset($_GET[Kode])) {
		$sql = "select no_rm from pasien where no_rm='$_GET[Kode]'";
		$sqlpasien = mysql_fetch_assoc(mysql_query($sql));
		if ($sqlpasien[no_rm] == $param_norm) {
			$pasienbaru = "0";
		} else {
			$pasienbaru = "1";
		}
	} else {
		$pasienbaru = "0";
	}

	$namauser = $_SESSION[namauser];
	$jamminta = date("H:i:s");
	$tahun = date("Y");
	$yesterday = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
	$tgl_yesterday = date("Y-m-d", $yesterday);
	$td0 = php_uname('n');
	$td0 = substr($td0, 0, 3);
	$a = "SELECT noform FROM htranspermintaan WHERE right(noform,4)='$tahun' ORDER BY noform DESC LIMIT 1";
	$b = mysql_query($a);
	$c = mysql_fetch_assoc($b);
	$d = mysql_num_rows($b);
	$pjg_form  = strlen($c[noform]);
	if ($d < 1) {
		$nomorform = "0000000";
	}
	$nomorform = (int)(substr($c[noform], 1, 7) + 1);
	$j_nol   = 7 - (strlen(strval($nomorform)));
	for ($i = 0; $i < $j_nol; $i++) {
		$jnol .= "0";
	}
	$noformfix = $jnol . $nomorform . "/" . $tahun;

	if (isset($_POST[submit1])) {
		$_POST[submit1] = "";
		$waktupermintaan = $_POST[tgl_permintaan];
		$tgl_permintaan = $waktupermintaan;
		$nama_dokter = mysql_real_escape_string($_POST[nama_dokter]);
		$nama_pasien = mysql_real_escape_string($_POST[nama_pasien]);
		$nama_bagian = mysql_real_escape_string($_POST[nama_bagian]);
		$nama_kelas = mysql_real_escape_string($_POST[nama_kelas]);
		$suami_istri = mysql_real_escape_string($_POST[suami_istri]);
		$alamat = mysql_real_escape_string($_POST[alamat]);
		$diagnosa = mysql_real_escape_string($_POST[diagnosa]);
		$alasan = mysql_real_escape_string($_POST[alasan]);
		$jenis = mysql_real_escape_string($_POST[jenis]);
		$tempat = mysql_real_escape_string($_POST[tempat]);
		$reg_rs = mysql_real_escape_string($_POST[reg_rs]);
		$golDrh = mysql_real_escape_string($_POST[golDrh]);
		$rhesus_psn = mysql_real_escape_string($_POST[rhesus_psn]);
		$shift = mysql_real_escape_string($_POST[shift]);
		$no_layanan = mysql_real_escape_string($_POST[noreglayanan]);
		$no_jaminan = mysql_real_escape_string($_POST[nojaminan]);
		$sampel = mysql_real_escape_string($_POST[sampel]);
		$hb = mysql_real_escape_string($_POST[hb]);
		$cek_dokter = 1;
		$sql_dkt = "select * from dokter where Nama like '%$_POST[nama_dokter]%'";
		$namars = mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where kode='$_POST[nama_rs]'"));

		$cek_dokter = mysql_num_rows(mysql_query($sql_dkt));
		if ($cek_dokter == 0) {
			$sql_dokter = mysql_fetch_assoc(mysql_query("select max(convert(`kode`, SIGNED INTEGER)) as Kode from dokter"));
			$int_kode = $sql_dokter['Kode'] + 1;
			$j_nol0 = 5 - (strlen(strval($int_kode)));
			for ($i = 0; $i < $j_nol0; $i++) {
				$nol .= "0";
			}
			$kdokter = $nol . $int_kode;


			$idokter_sql = "insert into dokter (kode,Nama) values ('$kdokter','$_POST[nama_dokter]')";
			$idokter = mysql_query($idokter_sql);
		}
		$cd = mysql_num_rows(mysql_query("select noform from htranspermintaan where noform='$noform_oto'"));


		//------------------------ set id pasien ------------------------->
		//digit pendonor 14 digit, 4kode utd, 3 nama, 2 tmpt aftap, 6 sequence, 
		$q_utd	= mysql_query("select id from utd where aktif='1'", $con);
		$utd	= mysql_fetch_assoc($q_utd);
		$nama1 = str_replace(".", "", $nama_pasien);
		$nama1 = str_replace(" ", "", $nama1);
		$nama1 = str_replace(",", "", $nama1);
		$nm = strtoupper(substr($nama1, 0, 3));
		$idp	= mysql_query("select id,id1 from tempat_donor where active='1'", $con);
		$idp1	= mysql_fetch_assoc($idp);
		$kdtp	= "P" . $utd[id] . $nm;
		$idp	= mysql_query("select no_rm from pasien where no_rm like '$kdtp%'
			      order by no_rm DESC", $con);
		$idp1	= mysql_fetch_assoc($idp);
		$idp2	= substr($idp1[no_rm], 9, 6);
		if ($idp2 < 1) {
			$idp2 = "00000";
		}
		$int_idp2 = (int)$idp2 + 1;
		$j_nol1 = 6 - (strlen(strval($int_idp2)));
		for ($i = 0; $i < $j_nol1; $i++) {
			$idp4 .= "0";
		}
		$norm = $kdtp . $idp4 . $int_idp2;
		//---------------------- END set id pasien ------------------------->


		//------------------------ set id permintaan ------------------------->
		$udd1   = mysql_query("select id from utd where aktif='1'");
		$udd    = mysql_fetch_assoc($udd1);
		$idp	= mysql_query("select * from tempat_donor where active='1'");
		$idp1	= mysql_fetch_assoc($idp);
		$th		= substr(date("Y"), 2, 2);
		$bl		= date("m");
		$tgl	= date("d");
		$kdtp	= $tempat . "-" . $tgl . $bl . $th . "-";
		$idp	= mysql_query("select noform from htranspermintaan where noform like '$kdtp%' order by noform DESC");
		$idp1	= mysql_fetch_assoc($idp);
		$idp2	= substr($idp1[noform], 11, 4);
		if ($idp2 < 1) {
			$idp2 = "0000";
		}
		$idp3	= (int)$idp2 + 1;
		$id31	= strlen($idp2) - strlen($idp3);
		$idp4	= "";
		for ($i = 0; $i < $id31; $i++) {
			$idp4 .= "0";
		}
		$noform_oto = $kdtp . $idp4 . $idp3;
		//------------------------ END set id transaksi ------------------------->


		$_POST[submit] = "";
		function trimed($txt)
		{
			$txt = trim($txt);
			while (strpos($txt, ' ')) {
				$txt = str_replace(' ', '', $txt);
			}
			return $txt;
		}

		if ($cd == '0') {
			$permintaan = "INSERT INTO `htranspermintaan` (`noform`, `bagian`, `kelas`, `namadokter`, `tglminta`, `diagnosa`, `alasan`, `hb`, `jenis`, `stat`, `rs`, `regrs`,`shift`, `tempat`, `nojenis`, `no_rm`, `umur`, `petugas`, `tgl_register`, `ruangan`, `pernah_transfusi`,`kapan`, `jenis_permintaan`, `reaksi_transfusi`, `gejala`, `jml_kehamilan`, `abortus`, `ket`,`nojaminan`,`sampel`,`tgl_sampel`)
				VALUES ('$noform_oto','$nama_bagian',
				'$_POST[nama_kelas]','$nama_dokter','$_POST[tgl_diperlukan]','$diagnosa','$alasan',
				'$hb','$jenis','0','$_POST[nama_rs]','$reg_rs','$shift','$tempat','$no_layanan','$norm','$_POST[umur]',
				'$_POST[sahper]',NOW(),'$_POST[nama_ruangan]','$_POST[pernahtransfusi]','$_POST[kapan]','$_POST[jnspermintaan]',
				'$_POST[reaksitransfusi]','$_POST[gejala]','$_POST[jmlkehamilan]','$_POST[abortus]','$_POST[ket]','$no_jaminan','$sampel',NOW())";


			$daftar = "INSERT INTO `daftarpasien`(`tanggal`,`noform`,`nama`,`rs`,`sifat`,`jamtiba`,`id_udd`) values('$waktupermintaan','$noform_oto','$nama_pasien','$namars[NamaRs]','$_POST[jnspermintaan]','$jamminta','$udd[id]')";

			if ($sampel == '1') {
				$insertsampel = mysql_query("INSERT INTO `terima_sampel`(`noform`,`pasien`,`goldrh`,`rs`,`petugas`) values('$noform_oto','$nama_pasien','$golDrh','$namars[NamaRs]','$_POST[sahper]')");
			}

			$p3 = mysql_query($permintaan);
			$p4 = mysql_query($daftar);
			//=======Audit Trial====================================================================================
			$log_mdl = 'PASIEN SERVICE';
			$log_aksi = 'Tambah Permintaan: ' . $noform_oto . ' - No. pasien : ' . $sqlpasien[no_rm];
			include_once "user_log.php";
			//=====================================================================================================
			for ($i = 0; $i < count($_POST['jenisproduk']); $i++) {
				$jenisproduk = $_POST['jenisproduk'][$i];
				$jumlahminta = $_POST['jmlminta'][$i];
				$nat = $_POST['nat'][$i];
				$ccminta = $_POST['ccminta'][$i];
				$volumeminta = $_POST['volumedarah'][$i];
				$intjumlahminta = intval($jumlahminta);
				if ($intjumlahminta > 0) {
					$sqlpermintaandetail = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values
									('$noform_oto','$jenisproduk','$_POST[goldarah]','$_POST[rhesus]','$jumlahminta','0','$ccminta','$_POST[keterangandrh]','$_POST[tgl_diperlukan]','$tempat','$norm','$nat')";
					$p1 = mysql_query($sqlpermintaandetail);
				}
			}
			if ($_POST[simpanpasien] !== "0") {
				$permintaan2 = "INSERT INTO `pasien` (`no_rm`, `nama`, `alamat`, `gol_darah`, `rhesus`, `kelamin`, `keluarga`, `tgl_lahir`,`tlppasien`,`umur`) VALUES
				 ('$norm', '$nama_pasien', '$alamat', '$golDrh', '$rhesus_psn', '$_POST[jk]', '$suami_istri', '$_POST[tgllhr]','$_POST[tlppasien]','$_POST[umur]')";
				$p3 = mysql_query($permintaan2);
				$bln = $_POST[umur] * 365;
				$th = $tgl_permintaan - $bln;
				$tgllhr1 = "update pasien set tgl_lahir=( now() - interval `umur` year ) where tgl_lahir like '0000-00%'";
				$tgllhr = mysql_query($tgllhr1);
			}



			if ($p1) $noform1 = str_replace("/", "-", $noform_oto);
			//Whatsapp
			$wa = "SELECT\n" .
				"pmi.htranspermintaan.regrs,\n" .
				"pmi.dtranspermintaan.NoForm,\n" .
				"pmi.dtranspermintaan.GolDarah,\n" .
				"pmi.dtranspermintaan.Rhesus,\n" .
				"pmi.dtranspermintaan.JenisDarah,\n" .
				"pmi.pasien.nama,\n" .
				"pmi.pasien.umur,\n" .
				"pmi.rmhsakit.NamaRs,\n" .
				"pmi.dtranspermintaan.Jumlah\n" .
				"FROM\n" .
				"pmi.dtranspermintaan\n" .
				"JOIN pmi.pasien\n" .
				"ON pmi.dtranspermintaan.no_rm = pmi.pasien.no_rm \n" .
				"JOIN pmi.htranspermintaan\n" .
				"ON pmi.dtranspermintaan.NoForm = pmi.htranspermintaan.noform \n" .
				"JOIN pmi.rmhsakit\n" .
				"ON pmi.htranspermintaan.rs = pmi.rmhsakit.Kode\n" .
				"where pmi.dtranspermintaan.NoForm='$noform_oto'";

			$cariwa = mysql_fetch_assoc(mysql_query($wa));
			if ($cariwa[JenisDarah] == "FFP KONVALESEN") {
				$sapa = 'Semangat Pagi';
				$pesan = $sapa . ', Info Permintaan Darah : Pasien ' . $cariwa[nama] . ' (' . $cariwa[umur] . ' thn) | Gol. ' . $cariwa[GolDarah] . '/' . $cariwa[Rhesus] . ' | ' . $cariwa[NamaRs] . ' RM(' . $cariwa[regrs] . ') | FFP Konvalesen sebanyak ' . $cariwa[Jumlah] . ' Kolf | Petugas : ' . $namauser;

				// WA Petugas
				$kirim = mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text)
                                            values ('0','082133888855','$pesan')");

				$kirim1 = mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text)
                                            values ('0','08562820827','$pesan')");

				$kirim2 = mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text)
                                            values ('0','082226257990','$pesan')");
			}

			$wil = mysql_fetch_assoc(mysql_query("select wilayah from rmhsakit where Kode='$_POST[nama_rs]'"));
			mysql_query("update `htranspermintaan` set wilayah='$wil[wilayah]' where noform='$noform_oto'");

			echo $kirim;
			//echo ("<font size=3>Formulir No. <b>'$noform_oto'</b> telah ditambah !!<br></font>
			//<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=idpasien_barcode2.php?idpendonor=$noform_oto\">");

			echo ("<font size=3>Formulir No. <b>'$noform_oto'</b> telah ditambah !!<br></font>
            <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir2.php?module=cetak_minta&noform=$noform_oto\">");
		} else {
			echo "<font size=3>No Formulir Telah digunakan sebelumnya</font><br>";
		}
	} ?>
	<form name="permintaandarah" autocomplete="off" method="post" action="<?php echo $PHP_SELF; ?>">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#FF6346;">
			<tr>
				<td align="center">
					<font size="4" color="white" face="Trebuchet MS"><b>FORMULIR PERMINTAAN DARAH</b></font>
				</td>
				<td align="right"><input type="submit" name="submit1" value="Simpan" class="swn_button_blue"></td>
			</tr>
		</table>
		<table border="0" style="border-collapse:collapse" cellpadding="1" cellspacing="0" width="100%">
			<tr>
				<td valign="top">
					<font size="3" color="red" face="Trebuchet MS">A. DATA RUMAH SAKIT</font>
					<table class="form" cellspacing="1" cellpadding="0" border="1" style="border-collapse:collapse">
						<tr>
							<td>No.Reg.RS</td>
							<!--td class="input" nowrap><input name="no_formulir" type="text" size="20" required value="<?= $noformfix ?>" onkeydown="drs(this.value);" placeholder='No-Urut/tahun'-->
							<td class="input" nowrap><!--input name="no_formulir" type="text" size="20" onkeydown="drs(this.value);" required placeholder='No-Urut/tahun'-->
								<input name="reg_rs" type="text" placeholder='No.Reg.RS'>
							</td>
						</tr>
						<tr>
							<td rowspan='2'>Nama RS</td>
							<!--td class="styled-select" bgcolor="#ffa688"><select name="nama_rs" required ></select></td-->
							<td class="input" nowrap><input type=text name="nama_rs" required id="rmhsakit" placeholder='Ketik Nama RS'>
							</td>
						</tr>
						<td class="styled-select" bgcolor="#ffa688">Jika Nama RS tidak ada, Input dari master RS terlebih dahulu</td>
			</tr>
			<tr>
				<td>Medis(Bagian)</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="nama_bagian">
						<?php
						$permintaan1 = "select * from bagian";
						$do1 = mysql_query($permintaan1);
						while ($data1 = mysql_fetch_assoc($do1)) {
							$select1 = ""; ?>
							<option value="<?= $data1[nama] ?>" <?= $select1 ?>><?= $data1[nama] ?></option><?
																																														} ?>
					</select></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="nama_kelas" nowrap>
						<?php
						$permintaan1 = "select * from kelas";
						$do1 = mysql_query($permintaan1);
						while ($data1 = mysql_fetch_assoc($do1)) {
							$select1 = ""; ?>
							<option value="<?= $data1[Nama] ?>" <?= $select1 ?>><?= $data1[Nama] ?></option>
						<? } ?>
					</select>
					Ruangan<input type=text name="nama_ruangan" id="ruangan" required placeholder='Bakung'></td>
			</tr>
			<tr>
				<td>Nama Dokter</td>
				<td class="input" nowrap><input type=text name="nama_dokter" required id="dokter" placeholder='Nama Dokter'></td>
			</tr>
			<tr>
				<td>Diagnosa Klinis</td>
				<!--td class="styled-select" bgcolor="#ffa688"><select name="diagnosa" nowrap>
					<?php
					$diagnosa1 = "select nama from diagnosa order by kode ASC";
					$diag = mysql_query($diagnosa1);
					while ($diag2 = mysql_fetch_assoc($diag)) {
						$diagnosa2 = ""; ?>
							<option value="<?= $diag2[nama] ?>"<?= $diagnosa2 ?>><?= $diag2[nama] ?></option><?

																																															} ?></select-->
				<td class="input"><input name="diagnosa" id="diagnosa" required type="text" required size="30" placeholder='DHF'></td>
			</tr>
			<tr>
				<td>Cara Bayar</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="jenis" nowrap>
						<?php
						$permintaan2 = "select * from jenis_layanan";
						$do2 = mysql_query($permintaan2);
						while ($data2 = mysql_fetch_assoc($do2)) {
							$select2 = ""; ?>
							<option value="<?= $data2[kode] ?>" <?= $select2 ?>><?= $data2[nama] ?></option><?
																																														} ?>
					</select>
					No.Kartu<input name="noreglayanan" type="text" size="6" placeholder='No.Kartu'>
					No.Jaminan<input name="nojaminan" type="text" size="8" placeholder='No.Jaminan'></td>
			</tr>
			<tr>
				<td>Alasan Transfusi</td>
				<td class="input"><input name="alasan" type="text" size="30" placeholder='Anemis'></td>
			</tr>
			<tr>
				<td>Jumlah HB</td>
				<td class="input"><input name="hb" type="text" size="5">gr/dl</td>
			</tr>
			<tr>
				<td>Pernah Transfusi</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="pernahtransfusi">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
					Kapan<input name="kapan" type="text" size="5" placeholder='Jika Ya(th)'>
				</td>
			</tr>
			<tr>
				<td>Reaksi Transfusi</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="reaksitransfusi">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
					Gejala<input name="gejala" type="text" size="10" placeholder='Jika Ya'>
				</td>
			</tr>
			<tr>
				<td>Jenis Permintaan</td>
				<td class="styled-select" bgcolor="#ffa688">
					<!--select name="jnspermintaan">
						<option value="0">Biasa</option>
						<option value="1">Cadangan</option>
						<option value="2">Siap Pakai</option>
						<option value="3">Cyto/Segera</option>
					</select-->
					<select name="jnspermintaan">
						<option value="Biasa">Biasa</option>
						<option value="Cadangan">Cadangan</option>
						<option value="Siap Pakai">Siap Pakai</option>
						<option value="Cyto/Segera">Cyto/Segera</option>
					</select>
					Keterangan<input name="ket" type="text" size="20" placeholder='Keterangan'>
				</td>
			</tr>
			<tr>
				<td class="input" colspan='2' alight="Center">Khusus Pasien Wanita</td>
				<!--td class="input"></td-->
			</tr>
			<tr>
				<td>Pernah Abortus</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="abortus">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
					Jumlah Kehamilan<input name="jmlkehamilan" type="text" size="10" placeholder='Jml Hamil'>
				</td>
			</tr>
		</table>
		</td>
		<td valign="top">
			<font size="3" color="red" face="Trebuchet MS">B. DATA PASIEN</font>
			<? if ($pasienbaru == "0") { ?>
				<table class="form" cellspacing="1" cellpadding="4" border="1" style="border-collapse:collapse">


					<!--tr><td>No RM</td>
					<td class="input"><input name="norm" id="norm" type="text" size="20" required placeholder='No. Rekam Medis'></td-->
					</tr>
					<tr>
						<td>Nama Pasien</td>
						<td class="input"><input name="nama_pasien" required type="text" size="20" placeholder='Nama Pasien'></td>
					</tr>
					<tr>
						<td>Golongan Darah</td>
						<td class="styled-select" bgcolor="#ffa688">
							<select name="golDrh">
								<option value="O">O</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="AB">AB</option>
								<option value="X">X</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Rhesus</td>
						<td class="styled-select" bgcolor="#ffa688">
							<select name="rhesus_psn">
								<option value="+">Positif (+)</option>
								<option value="-">Negatif (-)</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td class="input"><input type="radio" required name="jk" value="Laki-laki">Laki-laki <br>
							<input type="radio" name="jk" value="Perempuan">Perempuan
						</td>
					</tr>
					<tr>
						<td>Nama Keluarga</td>
						<td class="input"><input name="suami_istri" type="text" size="20" placeholder='Nama Keluarga'></td>
					</tr>
					<tr>
						<td>Tgl Lahir</td>
						<td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 onchange="document.permintaandarah.umur.value=Age(document.permintaandarah.datepicker.value);"></td>
						<!--td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 ></td-->
					</tr>
					<tr>
						<td>Umur(Th)</td>
						<td class="input"><input name="umur" type="text" size="3"></td>
					</tr>
					<tr>
						<td>Alamat Pasien</td>
						<td class="input"><input name="alamat" type="text" required size="20" placeholder='Alamat'></td>
					</tr>
					<tr>
						<td>No Telepon</td>
						<td class="input"><input name="tlppasien" type="text" size="13" placeholder='Telepon Keluarga'></td>
					</tr>
				</table>
			<? } else {
				$sqlpasien = mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$_GET[Kode]'"));
			?>
				<table class="form" cellspacing="1" cellpadding="5" border="1" style="border-collapse:collapse">
					<tr>
						<td>No RM</td>
						<td class="input"><?= $sqlpasien[no_rm] ?>
							<input name="norm" type=hidden value="<?= $sqlpasien[no_rm] ?>">
							<input name="simpanpasien" type=hidden value="0">
					</tr>
					<tr>
						<td>Nama Pasien</td>
						<td class="input"><?= $sqlpasien[nama] ?></td>
					</tr>
					<tr>
						<td>Golongan Darah</td>
						<td class="input"><?= $sqlpasien[gol_darah] ?>
							<input name="golDrh" type=hidden value="<?= $sqlpasien[gol_darah] ?>">
						</td>
					</tr>
					<tr>
						<td>Rhesus</td>
						<td class="input"><?= $sqlpasien[rhesus] ?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td><? if ($sqlpasien[jk] == "P") {
																		$kelamin = "Perempuan";
																	} else {
																		$kelamin = "Laki-laki";
																	} ?>
						<td class="input"><?= $kelamin ?></td>
					</tr>
					<tr>
						<td>Nama Keluarga</td>
						<td class="input"><?= $sqlpasien[keluarga] ?></td>
					</tr>
					<tr>
						<td>Tgl Lahir</td>
						<td class="input"><?= $sqlpasien[tgl_lahir] ?></td>
					</tr>
					<tr>
						<td>Alamat Pasien</td>
						<td class="input"><?= $sqlpasien[alamat] ?></td>
					</tr>
					<tr>
						<td>No Telepon</td>
						<td class="input"><?= $sqlpasien[tlppasien] ?></td>
					</tr>
				</table>
			<? } ?>
		</td>
		<td valign="top">
			<font size="3" color="red" face="Trebuchet MS">C.DATA PERMINTAAN DARAH</font>
			<table class="form" cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse">
				<tr>
					<td>Golongan Darah</td>
					<td class="styled-select" bgcolor="#ffa688">
						<select name="goldarah">
							<option value="O">O</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="AB">AB</option>
							<option value="X">X</option>
						</select>
						Rhesus
						<select name="rhesus">
							<option value="+">Positif (+)</option>
							<option value="-">Negatif (-)</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Sampel Darah</td>
					<td class="styled-select" bgcolor="#ffa688">
						<select name="sampel" required>
							<option value="">--Pilih--</option>
							<option value="1">Ada</option>
							<option value="0">Tidak Ada</option>
						</select>
					</td>
				</tr>
				<?
				$sqlproduk = "select nama,lengkap, volume from produk order by nama";
				$qproduk = mysql_query($sqlproduk);
				while ($produk1 = mysql_fetch_assoc($qproduk)) { ?>
					<tr>
						<td nowrap><?= $produk1[lengkap] ?></td>
						<input name="jenisproduk[]" type=hidden value="<?= $produk1[nama] ?>">
						<input name="volumedarah[]" type=hidden value="<?= $produk1[volume] ?>">
		</td>
		<td class="input"><input name="jmlminta[]" type="text" size="3">Kantong <input name="ccminta[]" type="text" size="2">CC
			<select name="nat[]">
				<option value="0">Biasa</option>
				<option value="1">NAT</option>
			</select>
		</td>



		</tr>
	<? } ?>
	<tr>
		<td>Tgl Diperlukan</td>
		<td class="input"><input type="text" name="tgl_diperlukan" id="butuh" required size=8 placeholder="YYYY-MM-DD">
			Ket.<input name="keterangandrh" type="text" size="10"></td>
	</tr>
	<tr>
		<td>Tgl Permintaan</td>
		<td class="input"><input type="text" name="tgl_permintaan" id="tgl_permintaan" required size=8 placeholder="YYYY-MM-DD"></td>
	</tr>
	<tr>
		<td>Tempat Permintaan</td>
		<td class="styled-select" bgcolor="#ffa688">
			<select name="tempat">
				<option value="UDD">UDD</option>
				<option value="BD1">BDRS</option>
				<option value="BD2">BDRS2</option>
				<option value="BD3">BDRS3</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Dicatat Oleh</td>
		<td class="styled-select" bgcolor="#ffa688"><select name="sahper">
				<? $user1 = "select * from user order by nama_lengkap ASC";
				$do1 = mysql_query($user1);
				while ($data1 = mysql_fetch_assoc($do1)) {
					if ($data1[id_user] == $namauser) $select = 'selected'; ?>
					<option value="<?= $data1[id_user] ?>" <?= $select ?>><?= $data1[nama_lengkap] ?></option><?
																																																		$select = "";
																																																	} ?>
			</select></td>
		</td>
	</tr>
	<tr>
		<td>Shift</td>
		<td class="styled-select" bgcolor="#ffa688">
			<? $s1 = '';
			$s2 = '';
			$s3 = '';
			$s4 = '';
			$waktu = date('H:i:s');
			$jam1 = mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
			$jam2 = mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));
			$jam3 = mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
			$jam4 = mysql_fetch_assoc(mysql_query("select * from shift where nama='IV'"));

			$sh1 = $jam1[jam];
			$sh2 = $jam2[jam];
			$sh3 = $jam3[jam];
			$sh4 = $jam4[jam];
			if ($waktu >= $sh1) {
				$s1 = 'selected';
			}
			if ($waktu >= $sh2) {
				$s2 = 'selected';
			}
			if ($waktu >= $sh3) {
				$s3 = 'selected';
			}
			if ($waktu < $sh1) {
				$s4 = 'selected';
			}
			?>
			<select name="shift">
				<option value="1" <?= $s1 ?>>SHIFT I</option>
				<option value="2" <?= $s2 ?>>SHIFT II</option>
				<option value="3" <?= $s3 ?>>SHIFT III</option>
				<option value="4" <?= $s4 ?>>SHIFT IV</option>

			</select>
		</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>