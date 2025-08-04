-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2018 at 01:42 PM
-- Server version: 5.5.54
-- PHP Version: 5.3.10-1ubuntu3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pmi`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cek_titip`(OUT salah INT)
begin select count(d2.nokantong) INTO salah from dtransaksipermintaan as d1,dtransaksipermintaan as d2 where d1.nokantong=d2.nokantong and d1.status='1' and d2.status='0'; end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoall`(IN nomortelp varchar(20), OUT pesan varchar(500))
BEGIN
DECLARE pesanmu varchar(225);
DECLARE pesanstok varchar(225);
DECLARE infostokprc varchar(225);
DECLARE infostokwb varchar(225);
DECLARE infostoktc varchar(225);
DECLARE infokegiatan varchar(225);
DECLARE namaudd varchar(150);
DECLARE gol_a INT default 0;
DECLARE gol_b INT default 0;
DECLARE gol_ab INT default 0;
DECLARE gol_o INT default 0;
DECLARE tanggal varchar(12);

select nama from utd where aktif='1' into namaudd;
SELECT count(nokantong)-(select sosA from produk where nama='WB') INTO gol_a from stokkantong where status='2' and gol_darah='A' and produk='WB';
SELECT count(nokantong)-(select sosB from produk where nama='WB') INTO gol_b from stokkantong where status='2' and gol_darah='B' and produk='WB';
SELECT count(nokantong)-(select sosAB from produk where nama='WB') INTO gol_ab from stokkantong where status='2' and gol_darah='AB' and produk='WB';
SELECT count(nokantong)-(select sosO from produk where nama='WB') INTO gol_o from stokkantong where status='2' and gol_darah='O' and produk='WB';
select GREATEST(gol_a, 0) into gol_a;
select GREATEST(gol_b, 0) into gol_b;
select GREATEST(gol_ab, 0) into gol_ab;
select GREATEST(gol_o, 0) into gol_o;
select concat('WB: A(',gol_a,') B(',gol_b,') AB(',gol_ab,') O(',gol_o,')') into infostokwb;
SELECT count(nokantong)-(select sosA from produk where nama='PRC') INTO gol_a from stokkantong where status='2' and gol_darah='A' and produk='PRC'; 
SELECT count(nokantong)-(select sosB from produk where nama='PRC') INTO gol_b from stokkantong where status='2' and gol_darah='B' and produk='PRC'; 
SELECT count(nokantong)-(select sosAB from produk where nama='PRC') INTO gol_ab from stokkantong where status='2' and gol_darah='AB' and produk='PRC'; 
SELECT count(nokantong)-(select sosO from produk where nama='PRC') INTO gol_o from stokkantong where status='2' and gol_darah='O' and produk='PRC'; 
select GREATEST(gol_a, 0) into gol_a;
select GREATEST(gol_b, 0) into gol_b;
select GREATEST(gol_ab, 0) into gol_ab;
select GREATEST(gol_o, 0) into gol_o;
select concat('PRC: A(',gol_a,') B(',gol_b,') AB(',gol_ab,') O(',gol_o,')') into infostokprc;
SELECT count(nokantong)-(select sosA from produk where nama='TC') INTO gol_a from stokkantong where status='2' and gol_darah='A' and produk='TC'; 
SELECT count(nokantong)-(select sosB from produk where nama='TC') INTO gol_b from stokkantong where status='2' and gol_darah='B' and produk='TC'; 
SELECT count(nokantong)-(select sosAB from produk where nama='TC') INTO gol_ab from stokkantong where status='2' and gol_darah='AB' and produk='TC'; 
SELECT count(nokantong)-(select sosO from produk where nama='TC') INTO gol_o from stokkantong where status='2' and gol_darah='O' and produk='TC'; 
select GREATEST(gol_a, 0) into gol_a;
select GREATEST(gol_b, 0) into gol_b;
select GREATEST(gol_ab, 0) into gol_ab;
select GREATEST(gol_o, 0) into gol_o;
select concat('TC: A(',gol_a,') B(',gol_b,') AB(',gol_ab,') O(',gol_o,')') into infostoktc;
SELECT DATE_FORMAT( current_date,  '%d/%m/%Y' ) into tanggal;
select group_concat(concat('
[',date_format(kegiatan.`TglPenjadwalan`,'%H:%i'),'-', detailinstansi.nama,'-',CAST(kegiatan.jumlah  AS CHAR),' org]')) INTO infokegiatan from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi where date(kegiatan.`TglPenjadwalan`)=current_date;
If infokegiatan is null then
   select ('Tidak ada kegiatan mobile unit') into infokegiatan;
end if;

select concat('Informasi Stok UDD PMI ',namaudd,' tgl.',tanggal,': Stok ',infostokwb,', ',infostokprc,',  ',infostoktc) into pesanstok;
Select concat('Kegiatan Mobile Unit UDD PMI ',namaudd,' Tgl. ',tanggal,':',infokegiatan,' Terima kasih') into pesanmu;
select concat('UDD PMI ',namaudd,'
Info hari ini (',tanggal, ')  
Stok Darah : 
',infostokwb,',
',infostokprc,',
',infostoktc,'. 
Kegiatan Mobil Unit : ',infokegiatan,'.
Terima Kasih') into pesan;
INSERT INTO sms.outbox (DestinationNumber, TextDecoded, CreatorID) VALUES (nomortelp, pesan, '1');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infodonorkode`(IN kodedonor varchar(40), OUT pesan varchar(225))
BEGIN
select concat('Yth. ',Nama, ' [',kode,']','Jumlah Donor anda: ',jumDonor,' kali.Silahkan Donor lagi Tgl: ',DATE_FORMAT(tglkembali,'%e '), ELT(MONTH(tglkembali), 'Januari','Februari','Maret', 'April','Mei','Juni', 'Juli','Agustus', 'September','Oktober','November','Desember'),DATE_FORMAT(tglkembali,' %Y')) INTO PESAN from pendonor where kode=kodedonor AND Cekal='0';
If pesan is null then
   select concat('Maaf nomor ID ',kodedonor,' tidak ada dalam sistem kami.') into pesan;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infodonortelp`(IN telppengirim varchar(20), OUT pesan varchar(225))
BEGIN
select concat('Yth. ',Nama, ' [',kode,']','Jumlah Donor anda: ',jumDonor,' kali. Silahkan Donor lagi Tgl: ',DATE_FORMAT(tglkembali,'%e '), ELT(MONTH(tglkembali), 'Januari','Februari','Maret', 'April','Mei','Juni', 'Juli', 'Agustus', 'September','Oktober','November','Desember'),DATE_FORMAT(tglkembali,'%Y'))INTO PESAN from pendonor where Cekal ='0' and telp2=replace(telppengirim,'+62','0') LIMIT 1;
If pesan is null then
   select 'Maaf nomor handphone anda belum terdaftar di sistem kami' into pesan;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infomu`(IN nomortelp varchar(20), OUT pesan varchar(500))
BEGIN

DECLARE namaudd varchar(100);
DECLARE alamatudd varchar(200);
DECLARE infokegiatan varchar(225);
DECLARE tanggal varchar(12);


SELECT nama FROM pmi.utd where aktif='1' into namaudd;
SELECT alamat FROM pmi.utd where aktif='1' into alamatudd;

SELECT DATE_FORMAT( current_date,  '%d/%m/%Y' ) into tanggal;
select group_concat(concat('
[',date_format(kegiatan.`TglPenjadwalan`,'%H:%i'),'-', detailinstansi.nama,'-',CAST(kegiatan.jumlah  AS CHAR),' org]')) INTO infokegiatan from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi where date(kegiatan.`TglPenjadwalan`)=current_date order by kegiatan.`TglPenjadwalan`;
If infokegiatan is null then
   select ('Tidak ada kegiatan mobile unit') into infokegiatan;
end if;

select concat('',namaudd,'
Kegiatan Mobile Unit hari ini (',tanggal,'):',infokegiatan,'.
Terima Kasih') into pesan;
INSERT INTO sms.outbox (DestinationNumber, TextDecoded, CreatorID) VALUES (nomortelp, pesan, '1');


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infomutgl`(IN nomortelp varchar(20), IN tanggal_in varchar(10), OUT pesan varchar(500))
BEGIN

DECLARE infokegiatan varchar(225);
DECLARE tanggal varchar(12);

select(str_to_date(tanggal_in,'%d/%m/%Y')) into tanggal;
select group_concat(concat('
[',date_format(kegiatan.`TglPenjadwalan`,'%H:%i'),'-', detailinstansi.nama,'-',CAST(kegiatan.jumlah  AS CHAR),' Org]')) INTO infokegiatan
from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
where date(kegiatan.`TglPenjadwalan`)=tanggal order by kegiatan.`TglPenjadwalan`;

if (tanggal or tanggal_in) is null then
  select(' ') into tanggal;
  select('Format tanggal tidak cocok. Format tanggal : dd/mm/yyyy') into pesan;
elseif infokegiatan is null then
   select concat('Tidak ada kegiatan mobile unit.') into infokegiatan;
end if;
if infokegiatan is null then 
select('Format tanggal tidak cocok') into infokegiatan;
end if;
select(concat('UDD PMI KOTA GORONTALO
Kegiatan Mobile Unit tgl ',date_format(tanggal,'%d/%m/%Y'),': ',infokegiatan,'.
Terima Kasih.')) into pesan;
if pesan is null then
  select('Kegiatan Mobile Unit UDD PMI KAB. PEKALONGAN. Tidak bisa ditampilkan. Format tanggal tidak cocok. Format tanggal : dd/mm/yyyy') into pesan;
end if;

INSERT INTO sms.outbox (DestinationNumber, TextDecoded, CreatorID) VALUES (nomortelp, pesan, '1');

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infopetugasmu`(IN nomortelp varchar(20), OUT pesan varchar(500))
BEGIN

DECLARE infokegiatan varchar(225);
DECLARE tanggal varchar(12);


SELECT DATE_FORMAT( current_date,  '%d/%m/%Y' ) into tanggal;
select group_concat(concat('
[',date_format(kegiatan.`TglPenjadwalan`,'%H:%i'),'-', detailinstansi.nama,'-',CAST(kegiatan.jumlah  AS CHAR),' org]
Petugas : (',dokter,',',sopir,',',admin,',',atd1,',',atd2,',',atd3,')')) INTO infokegiatan
from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi 
where date(kegiatan.`TglPenjadwalan`)=current_date order by kegiatan.`TglPenjadwalan`;
If infokegiatan is null then
   select ('Tidak ada kegiatan mobile unit') into infokegiatan;
end if;

select concat('UDD PMI KOTA GORONTALO
Kegiatan Mobile Unit hari ini (',tanggal,'):',infokegiatan,'.
Terima Kasih') into pesan;
INSERT INTO sms.outbox (DestinationNumber, TextDecoded, CreatorID) VALUES (nomortelp, pesan, '1');


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infopetugasmutgl`(IN nomortelp varchar(20), IN tanggal_in varchar(10), OUT pesan varchar(500))
BEGIN

DECLARE infokegiatan varchar(225);
DECLARE tanggal varchar(12);

select(str_to_date(tanggal_in,'%d/%m/%Y')) into tanggal;
select group_concat(concat('
[',date_format(kegiatan.`TglPenjadwalan`,'%H:%i'),'-', detailinstansi.nama,'-',CAST(kegiatan.jumlah  AS CHAR),' Org]
Petugas : (',dokter,',',sopir,',',admin,',',atd1,',',atd2,',',atd3,')')) INTO infokegiatan
from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
where date(kegiatan.`TglPenjadwalan`)=tanggal order by kegiatan.`TglPenjadwalan`;

if (tanggal or tanggal_in) is null then
  select(' ') into tanggal;
  select('Format tanggal tidak cocok. Format tanggal : dd/mm/yyyy') into pesan;
elseif infokegiatan is null then
   select concat('Tidak ada kegiatan mobile unit.') into infokegiatan;
end if;
if infokegiatan is null then 
select('Format tanggal tidak cocok') into infokegiatan;
end if;
select(concat('UDD PMI KOTA GORONTALO
Kegiatan Mobile Unit tgl ',date_format(tanggal,'%d/%m/%Y'),': ',infokegiatan,'.
Terima Kasih.')) into pesan;
if pesan is null then
  select('Kegiatan Mobile Unit UDD PMI KOTA GORONTALO. Tidak bisa ditampilkan. Format tanggal tidak cocok. Format tanggal : dd/mm/yyyy') into pesan;
end if;

INSERT INTO sms.outbox (DestinationNumber, TextDecoded, CreatorID) VALUES (nomortelp, pesan, '1');

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `komponen`(OUT wb_a INT,OUT wb_b INT,OUT wb_ab INT,OUT wb_o INT,OUT wb_t INT,OUT prc_a INT,OUT prc_b INT,OUT prc_ab INT,OUT prc_o INT,OUT prc_t INT,OUT tc_a INT,OUT tc_b INT,OUT tc_ab INT,OUT tc_o INT,OUT tc_t INT,OUT lp_a INT,OUT lp_b INT,OUT lp_ab INT,OUT lp_o INT,OUT lp_t INT,OUT ffp_a INT,OUT ffp_b INT,OUT ffp_ab INT,OUT ffp_o INT,OUT ffp_t INT,OUT fp_a INT,OUT fp_b INT,OUT fp_ab INT,OUT fp_o INT,OUT fp_t INT,OUT we_a INT,OUT we_b INT,OUT we_ab INT,OUT we_o INT,OUT we_t INT,OUT ahf_a INT,OUT ahf_b INT,OUT ahf_ab INT,OUT ahf_o INT,OUT ahf_t INT)
begin 


select count(nokantong) INTO tc_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='TC'; 
select count(nokantong) INTO tc_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='TC'; 
select count(nokantong) INTO tc_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='TC'; 
select count(nokantong) INTO tc_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='TC'; 
select count(nokantong) INTO tc_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='TC'; 

select count(nokantong) INTO prc_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='PRC'; 
select count(nokantong) INTO prc_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='PRC'; 
select count(nokantong) INTO prc_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='PRC'; 
select count(nokantong) INTO prc_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='PRC'; 
select count(nokantong) INTO prc_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='PRC'; 

select count(nokantong) INTO wb_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='WB'; 
select count(nokantong) INTO wb_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='WB'; 
select count(nokantong) INTO wb_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='WB'; 
select count(nokantong) INTO wb_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='WB'; 
select count(nokantong) INTO wb_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='WB'; 

select count(nokantong) INTO lp_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='LP'; 
select count(nokantong) INTO lp_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='LP'; 
select count(nokantong) INTO lp_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='LP'; 
select count(nokantong) INTO lp_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='LP'; 
select count(nokantong) INTO lp_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='LP'; 

select count(nokantong) INTO we_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='WE'; 
select count(nokantong) INTO we_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='WE'; 
select count(nokantong) INTO we_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='WE'; 
select count(nokantong) INTO we_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='WE'; 
select count(nokantong) INTO we_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='WE'; 

select count(nokantong) INTO ffp_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='FFP'; 
select count(nokantong) INTO ffp_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='FFP'; 
select count(nokantong) INTO ffp_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='FFP'; 
select count(nokantong) INTO ffp_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='FFP'; 
select count(nokantong) INTO ffp_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='FFP';

select count(nokantong) INTO ahf_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='AHF'; 
select count(nokantong) INTO ahf_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='AHF'; 
select count(nokantong) INTO ahf_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='AHF'; 
select count(nokantong) INTO ahf_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='AHF'; 
select count(nokantong) INTO ahf_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='AHF';

select count(nokantong) INTO fp_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null) and produk='FP'; 
select count(nokantong) INTO fp_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null) and produk='FP'; 
select count(nokantong) INTO fp_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null) and produk='FP'; 
select count(nokantong) INTO fp_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null) and produk='FP'; 
select count(nokantong) INTO fp_t from stokkantong where Status='2' and (stat2='0' or stat2 is null) and produk='FP';

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stok`(OUT gol_a int,OUT gol_b int,OUT gol_ab int,OUT gol_o int)
BEGIN SELECT count(nokantong) INTO gol_a from stokkantong where status='2' and gol_darah='A'; SELECT count(nokantong) INTO gol_b from stokkantong where status='2' and gol_darah='B'; SELECT count(nokantong) INTO gol_ab from stokkantong where status='2' and gol_darah='AB'; SELECT count(nokantong) INTO gol_o from stokkantong where status='2' and gol_darah='O'; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stokdarah`(OUT gol_a int,OUT gol_b int,OUT gol_ab int,OUT gol_o int)
BEGIN
SELECT count(nokantong)-(select sum(sosA) from produk) INTO gol_a from stokkantong where status='2' and gol_darah='A' and produk <> 'NULL' and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL);
SELECT count(nokantong)-(select sum(sosB) from produk) INTO gol_b from stokkantong where status='2' and gol_darah='B' and produk <> 'NULL' and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL);
SELECT count(nokantong)-(select sum(sosAB) from produk) INTO gol_ab from stokkantong where status='2' and gol_darah='AB' and produk <> 'NULL' and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL);
SELECT count(nokantong)-(select sum(sosO) from produk) INTO gol_o from stokkantong where status='2' and gol_darah='O' and produk <> 'NULL' and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL);

select GREATEST(gol_a, 0) into gol_a;
select GREATEST(gol_b, 0) into gol_b;
select GREATEST(gol_ab, 0) into gol_ab;
select GREATEST(gol_o, 0) into gol_o;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stokdarahkomponen`(IN namakomponen varchar(10),OUT pesan varchar(225))
BEGIN
DECLARE singkatan varchar(20);
DECLARE namaudd varchar(150);
DECLARE komponenlengkap varchar(50);
DECLARE gol_a INT default 0;
DECLARE gol_b INT default 0;
DECLARE gol_ab INT default 0;
DECLARE gol_o INT default 0;

select Nama from produk where Nama=namakomponen INTO singkatan; 
select Nama from utd where aktif='1' INTO namaudd; 
if singkatan is null then
 SELECT CONCAT('Informasi Stok darah ',namaudd,'. Maaf nama produk darah "',  namakomponen,  '" tidak ada. Nama produk darah: ', (SELECT GROUP_CONCAT( nama ) FROM produk ),'. Terima kasih') INTO pesan;
else
BEGIN
select lengkap from produk where nama=namakomponen into komponenlengkap; 
SELECT count(nokantong)-(select sosA from produk where nama=namakomponen) INTO gol_a from stokkantong where status='2' and gol_darah='A' and produk=namakomponen and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL) and sah='1' and statKonfirmasi='1'; 
SELECT count(nokantong)-(select sosB from produk where nama=namakomponen) INTO gol_b from stokkantong where status='2' and gol_darah='B' and produk=namakomponen and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL) and sah='1' and statKonfirmasi='1';
SELECT count(nokantong)-(select sosAB from produk where nama=namakomponen) INTO gol_ab from stokkantong where status='2' and gol_darah='AB' and produk=namakomponen and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL) and sah='1' and statKonfirmasi='1'; 
SELECT count(nokantong)-(select sosO from produk where nama=namakomponen) INTO gol_o from stokkantong where status='2' and gol_darah='O' and produk=namakomponen and kadaluwarsa > current_date and (stat2='0' or stat2 is NULL) and sah='1' and statKonfirmasi='1'; 
select GREATEST(gol_a, 0) into gol_a;
select GREATEST(gol_b, 0) into gol_b;
select GREATEST(gol_ab, 0) into gol_ab;
select GREATEST(gol_o, 0) into gol_o;
select concat('Informasi Stok darah ',namaudd,'. Produk darah "',komponenlengkap,'" A(',gol_a,') B(',gol_b,') AB(',gol_ab,') O(',gol_o,'). Terima kasih.') into pesan;
END;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stoks`(OUT k_a INT,OUT k_b INT,OUT k_ab INT,OUT k_o INT,OUT s_a INT,OUT s_b INT,OUT s_ab INT,OUT s_o INT,OUT t_a INT,OUT t_b INT,OUT t_ab INT,OUT t_o INT)
begin 
select count(nokantong) INTO k_a from stokkantong where Status='1' and gol_darah='A' and sah='1'; 
select count(nokantong) INTO k_b from stokkantong where Status='1' and gol_darah='B' and sah='1'; 
select count(nokantong) INTO k_ab from stokkantong where Status='1' and gol_darah='AB' and sah='1'; 
select count(nokantong) INTO k_o from stokkantong where Status='1' and gol_darah='O' and sah='1'; 
select count(nokantong) INTO s_b from stokkantong where Status='2' and gol_darah='B' and (stat2='0' or stat2 is null); 
select count(nokantong) INTO s_a from stokkantong where Status='2' and gol_darah='A' and (stat2='0' or stat2 is null); 
select count(nokantong) INTO s_ab from stokkantong where Status='2' and gol_darah='AB' and (stat2='0' or stat2 is null); 
select count(nokantong) INTO s_o from stokkantong where Status='2' and gol_darah='O' and (stat2='0' or stat2 is null); 
select count(s.nokantong) INTO t_a from stokkantong as s,dtransaksipermintaan as d where s.Status='3' and s.NoKantong=d.NoKantong and d.Status='1' and s.gol_darah='A';
select count(s.nokantong) INTO t_b from stokkantong as s,dtransaksipermintaan as d where s.Status='3' and s.NoKantong=d.NoKantong and d.Status='1' and s.gol_darah='B';
select count(s.nokantong) INTO t_ab from stokkantong as s,dtransaksipermintaan as d where s.Status='3' and s.NoKantong=d.NoKantong and d.Status='1' and s.gol_darah='AB';
select count(s.nokantong) INTO t_o from stokkantong as s,dtransaksipermintaan as d where s.Status='3' and s.NoKantong=d.NoKantong and d.Status='1' and s.gol_darah='O';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `serahterima`
--

CREATE TABLE IF NOT EXISTS `serahterima` (
  `hst_id` int(11) NOT NULL AUTO_INCREMENT,
  `hst_notrans` varchar(15) NOT NULL,
  `hst_dari` varchar(50) NOT NULL,
  `hst_ke` varchar(50) NOT NULL,
  `hst_tgl` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hst_asal` varchar(100) NOT NULL,
  `hst_jenis_st` varchar(50) NOT NULL,
  `hst_pengirim` varchar(75) NOT NULL,
  `hst_penerima` varchar(75) NOT NULL,
  `hst_pengesah` varchar(75) NOT NULL,
  `hst_kode_alat` int(11) NOT NULL,
  `hst_suhuterima` varchar(4) NOT NULL,
  `hst_kondisiumum` varchar(50) NOT NULL,
  `hst_peruntukan` varchar(50) NOT NULL,
  PRIMARY KEY (`hst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Header Serah Teriima Kantong dan Sample' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `serahterima_detail`
--

CREATE TABLE IF NOT EXISTS `serahterima_detail` (
  `dstid` int(11) NOT NULL AUTO_INCREMENT,
  `dst_notrans` int(11) NOT NULL,
  `dst_nokantong` varchar(30) NOT NULL,
  `dst_statusktg` tinyint(4) NOT NULL,
  `dst_golda` varchar(2) NOT NULL,
  `dst_rh` varchar(1) NOT NULL,
  `dst_kodedonor` varchar(30) NOT NULL,
  `dst_berat` varchar(7) NOT NULL,
  `dst_volume` varchar(4) NOT NULL,
  `dst_jenisktg` varchar(2) NOT NULL,
  `dst_jenissample` varchar(10) NOT NULL,
  `dst_sah` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dstid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Detail serah terima kantong dan sample' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `serahterima_detail_tmp`
--

CREATE TABLE IF NOT EXISTS `serahterima_detail_tmp` (
  `dstid` int(11) NOT NULL AUTO_INCREMENT,
  `dst_notrans` int(11) NOT NULL,
  `dst_nokantong` varchar(30) NOT NULL,
  `dst_statusktg` tinyint(4) NOT NULL,
  `dst_golda` varchar(2) NOT NULL,
  `dst_rh` varchar(1) NOT NULL,
  `dst_kodedonor` varchar(30) NOT NULL,
  `dst_berat` varchar(7) NOT NULL,
  `dst_volume` varchar(4) NOT NULL,
  `dst_jenisktg` varchar(2) NOT NULL,
  `dst_jenissample` varchar(10) NOT NULL,
  `dst_sah` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dstid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Detail serah terima kantong dan sample' AUTO_INCREMENT=36 ;

