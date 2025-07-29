<?
$server = "localhost";
$username = "root";
$password = "F201603907";
$database = "pmi";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

$sql_h="SELECT  `NoKantong`,`KodePendonor`, `gol_darah`,`rhesus`,`Tgl`, date_add(`Tgl`, interval 35 day) as tgl_ed
FROM `htransaksi` WHERE length(`NoKantong`)>1 and
`Instansi`='HOTEL BALI MANDIRA'
and date(`Tgl`)=current_date";
echo "$sql_h<br>";
$sql_h1=mysql_query($sql_h);	
while ($q=mysql_fetch_assoc($sql_h1)) {
	echo "$q[NoKantong]<br>";
	$updateserver=mysql_query("UPDATE stokkantong SET 
		Status='1', 
		mu='2',
		kodePendonor='$q[KodePendonor]',
		kadaluwarsa='$q[tgl_ed]',
		RhesusDrh='$q[RhesusDrh]',
		gol_darah='$q[gol_darah]',
		produk='WB',
		tgl_Aftap='$q[Tgl]'
		where 
		noKantong='$q[NoKantong]'");
}

