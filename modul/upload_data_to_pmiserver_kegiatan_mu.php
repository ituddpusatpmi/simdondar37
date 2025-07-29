<?
include('config/db_connect.php');
$sqlmu="select kegiatan.NoTrans, kegiatan.TglPenjadwalan, detailinstansi.nama,detailinstansi.alamat, kegiatan.jumlah, kegiatan.id_udd, kegiatan.lat,
	kegiatan.lng, kegiatan.kendaraan from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
	where date(kegiatan.TglPenjadwalan) >=current_date order by kegiatan.TglPenjadwalan";
$no=0;

$sqlmu1=mysql_query($sqlmu,$con);
while ($sqlmu2=mysql_fetch_assoc($sqlmu1)) {
    $no++;
    $NoTrans[$no] 	= $sqlmu2['NoTrans'];
    $TglPenjadwalan[$no]= $sqlmu2['TglPenjadwalan'];
    $instansi[$no]	= $sqlmu2['nama'];
    $alamat[$no]	= $sqlmu2['alamat'];
    $jumlah[$no]	= $sqlmu2['jumlah'];
    $udd[$no]		= $sqlmu2['id_udd'];
    $lat[$no]		= $sqlmu2['lat'];
    $lng[$no]		= $sqlmu2['lng'];
    $kendaraan[$no]	= $sqlmu2['kendaraan'];
}
?>
