<?php
//include("syn_config.php");
//Inisial UTD Aktif
$q_udd=$dblocal->prepare("SELECT `nomor`, `nama`, `alamat`, `lat`, `lng`, `id`, `down`, `aktif`, `daerah`, `zonawaktu`, `hari`, `jam`, `telp`, `fax` FROM `utd` WHERE `aktif`='1'");
$q_udd->execute();
$row = $q_udd->fetch();
print "UTD: $row[id]  $row[nama]\n";

//Inisial table pendonor field `up_data`
$col = $dblocal->prepare ("ALTER TABLE `pendonor` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {$col->execute();print "Inisial Table Pendonor: NEW\n";} catch (PDOException $e) { print "Inisial Table Pendonor: OLD\n";}

//Inisial table dokter periksa
$col = $dblocal->prepare ("ALTER TABLE `dokter_periksa` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {$col->execute();	print "Inisial Table Dokter: NEW\n";} catch (PDOException $e) {    print "Inisial Table Dokter: OLD\n";}
//Merubah panjang karakter nama dokter
$col = $dblocal->prepare ("ALTER TABLE `dokter_periksa` CHANGE `drnama` `drnama` VARCHAR(100) CHARACTER SET latin1 COLLATE lati1_swedish_ci NULL DEFAULT NULL COMMENT 'Nama Dokter UTD';");
	try {	$col->execute();	print "Inisial Table Dokter: NEW\n";} catch (PDOException $e) {    print "Inisial Table Dokter: OLD\n";}

//Inisial Table User
$col = $dblocal->prepare ("ALTER TABLE `user` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial User: NEW\n";} catch (PDOException $e) {    print "Inisial User: OLD\n";}
//Inisial Table stokkantong
$col = $dblocal->prepare ("ALTER TABLE `stokkantong` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial StokKantong: NEW\n";} catch (PDOException $e) {    print "Inisial StokKantong: OLD\n";}
//Inisial Table htransaksi
$col = $dblocal->prepare ("ALTER TABLE `htransaksi` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial htransaksi: NEW\n";} catch (PDOException $e) {    print "Inisial htransaksi: OLD\n";}
//Inisial Table dkonfirmasi
$col = $dblocal->prepare ("ALTER TABLE `dkonfirmasi` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial dkonfirmasi: NEW\n";} catch (PDOException $e) {    print "Inisial dkonfirmasi: OLD\n";}

//Inisial Table hasileilsa
$col = $dblocal->prepare ("ALTER TABLE `hasilelisa` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial Elisa: NEW\n";} catch (PDOException $e) {    print "Inisial Elisa: OLD\n";}
$col = $dblocal->prepare ("ALTER TABLE `hasilelisa` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST , ADD PRIMARY KEY ( `id` ) ;");
	try {	$col->execute();	print "Inisial Idx Elisa: NEW\n";} catch (PDOException $e) {    print "Inisial Idx Elisa: OLD\n";}
//Inisial Table rapidtest
$col = $dblocal->prepare ("ALTER TABLE `drapidtest` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial Rapid: NEW\n";} catch (PDOException $e) {    print "Inisial Rapid: OLD\n";}
$col = $dblocal->prepare ("ALTER TABLE `drapidtest` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST , ADD PRIMARY KEY ( `id` ) ;");
	try {	$col->execute();	print "Inisial Idx Rapid: NEW\n";} catch (PDOException $e) {    print "Inisial Idx Rapid: OLD\n";}
//Inisial table dpengolahan
$col = $dblocal->prepare ("ALTER TABLE `dpengolahan` ADD `up_data` INT NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up';");
	try {	$col->execute();	print "Inisial Pengolahan: NEW\n";} catch (PDOException $e) {    print "Inisial Pengolahan: OLD\n";}

?>
