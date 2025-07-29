<?
include('clogin.php');
include('config/db_connect.php');
$sql="DROP VIEW IF EXISTS `lttd3`;
CREATE VIEW `lttd3` AS (
select 
drapidtest.tgl_tes AS tanggal,
drapidtest.noKantong AS nokantong,
drapidtest.jenisperiksa AS jenis,
drapidtest.nolot AS nomor_lot,
drapidtest.Metode AS metode,
case when drapidtest.Hasil='0' THEN 'R' ELSE 'NR' END as interpretasi,
from drapidtest) 
union 
(select
hasilelisa.tglPeriksa AS tanggal,
hasilelisa.noKantong AS nokantong,
hasilelisa.jenisPeriksa AS jenis,
hasilelisa.noLot AS nomor_lot,
hasilelisa.Metode AS metode,
case when hasilelisa.Hasil='1' THEN 'R' ELSE 'NR' END as interpretasi,
from hasilelisa)";
$data0=mysql_query($sql,$con);
if ($data0){echo "Berhasil menghapus lttd3";}else{"Tidak berhasil menghapus lttd3";}