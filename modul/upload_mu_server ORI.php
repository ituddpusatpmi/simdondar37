<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/style.css" rel="stylesheet" />
<?

if(isset($_POST[submit])){
//========================== UPDATE ======================================//
$namauser = $_SESSION[namauser];
$con_local=mysql_connect("localhost","root","F201603907");
mysql_select_db("pmi",$con_local);
$con_server=mysql_connect($_POST['ip_server'],"pmimu","F201603907");
mysql_select_db("pmi",$con_server);

//pendonor
$pd=mysql_query("select * from pendonor where mu='1'",$con_local);
while ($pd1=mysql_fetch_assoc($pd)) {
echo "<BR> $pd1[Kode] Local";
$pdserver=mysql_query("select * from pendonor where Kode='$pd1[Kode]'",$con_server);
if (mysql_num_rows($pdserver)=='1') {
echo "<BR> $pd1[Kode] UPDATE";
	$updateserver=mysql_query("UPDATE pendonor SET 
		NoKTP='$pd1[NoKTP]',Nama='$pd1[Nama]',Alamat='$pd1[Alamat]',
		Jk='$pd1[Jk]',Pekerjaan='$pd1[Pekerjaan]',telp='$pd1[telp]',
		TempatLhr='$pd1[TempatLhr]',TglLhr='$pd1[TglLhr]',
		Status='$pd1[Status]',GolDarah='$pd1[GolDarah]',
		Rhesus='$pd1[Rhesus]',`call`='$pd1[Call]',
		kelurahan='$pd1[kelurahan]',
		kecamatan='$pd1[kecamatan]',
		wilayah='$pd1[wilayah]',
		KodePos='$pd1[KodePos]',
		jumDonor='$pd1[jumDonor]',
		telp2='$pd1[telp2]',umur='$pd1[umur]',
		tglkembali='$pd1[tglkembali]',mu='2' 
		where Kode='$pd1[Kode]'",$con_server);
} else
{
	$insertserver="insert into pendonor values
		('$pd1[Kode]','NULL','$pd1[NoKTP]','$pd1[Nama]','$pd1[Alamat]',
		'$pd1[Jk]','$pd1[Pekerjaan]','$pd1[telp]',
		'$pd1[TempatLhr]','$pd1[TglLhr]',
		'$pd1[Status]','$pd1[GolDarah]',
		'$pd1[Rhesus]','$pd1[Call]','0',
		'$pd1[kelurahan]',
		'$pd1[kecamatan]','$pd1[wilayah]','$pd1[KodePos]',
		'$pd1[jumDonor]','NULL',
		'$pd1[telp2]','$pd1[umur]','NULL','NULL',
		'$pd1[tglkembali]','NULL','NULL','$pd1[ibukandung]','2',
		'$namauser',b'1','NULL','0','0','0','0','0','0','0')"; 
echo "<BR> $insertserver";
	$insertserver0=mysql_query($insertserver,$con_server);
}
}
// htransaksi
$ht=mysql_query("select * from htransaksi where mu='1'",$con_local);

while ($ht1=mysql_fetch_assoc($ht)) {
	echo "<BR> $ht1[NoTrans] Local";
	$htserver=mysql_query("select * from htransaksi where NoTrans='$ht1[NoTrans]'",$con_server);
if (mysql_num_rows($htserver)=='1') {
echo "<BR> $ht1[NoTrans] UPDATE";
	echo "<br> Update htransaksi.";
	$updateserver=mysql_query("UPDATE htransaksi SET 
		Tgl='$ht1[Tgl]', Diambil='$ht1[Diambil]',
		Reaksi='$ht1[Reaksi]', Pengambilan='$ht1[Pengambilan]',
		Catatan='$ht1[Catatan]',NamaDokter='$ht1[NamaDokter]',
		NoKantong='$ht1[NoKantong]', petugas='$ht1[petugas]',
		petugasHB='$ht1[petugasHB]',petugasTensi='$ht1[petugasTensi]',
		beratBadan='$ht1[beratBadan]', tensi='$ht1[tensi]',
		suhu='$ht1[suhu]', nadi='$ht1[nadi]',Hb='$ht1[Hb]',
		caraAmbil='$ht1[caraAmbil]', Hct='$ht1[Hct]',
		status_test='$ht1[status_test]', Status='$ht1[Status]', mu='2'
		where NoTrans='$ht1[NoTrans]'",$con_server);

} else{
	echo "<BR> Insert htransaksi.";
	$insertserver=mysql_query("insert into htransaksi values
		('$ht1[NoTrans]','null',
		'$ht1[KodePendonor]','$ht1[Tgl]',
		'$ht1[NoAntri]','$ht1[JenisDonor]',
		'$ht1[Diambil]','$ht1[Reaksi]',
		'$ht1[Pengambilan]','$ht1[Catatan]','$ht1[NamaDokter]',
		'$ht1[NoKantong]','$ht1[Status]','$ht1[Nopol]',
		'$ht1[NoForm]','$ht1[StatDonor]','$ht1[tempat]',
		'$ht1[petugas]','$ht1[user]','$ht1[ketPaket]',
		'$ht1[ketBatal]','$ht1[petugasHB]','$ht1[petugasTensi]','$ht1[jumHB]',
		'$ht1[beratBadan]','$ht1[Instansi]','$ht1[tahun]',
		'$ht1[tensi]','$ht1[suhu]','$ht1[nadi]',
		'$ht1[Hb]','$ht1[Hct]','$ht1[jnsperiksa]',
		'$ht1[caraAmbil]','$ht1[shift]','$ht1[kota]',
		'$ht1[id_permintaan]','2','$ht1[status_test]')",$con_server);
}
}

//stok kantong
$sk=mysql_query("select * from stokkantong where mu='1'",$con_local);

while ($sk1=mysql_fetch_assoc($sk)) {
	echo "<BR> $sk1[NoTrans] Local";
	$skserver=mysql_query("select * from stokkantong where noKantong='$sk1[noKantong]'",$con_server);
echo "<BR> $sk1[noKantong] UPDATE";
	echo "<br> Update stok kantong.";
	$updateserver=mysql_query("UPDATE stokkantong SET 
		Status='$sk1[Status]', mu='2',kodePendonor='$sk1[kodePendonor]',
		kadaluwarsa='$sk1[kadaluwarsa]',RhesusDrh='$sk1[RhesusDrh]',gol_darah='$sk1[gol_darah]',tgl_Aftap='$sk1[tgl_Aftap]'
		where noKantong='$sk1[noKantong]'",$con_server);
	if ($sk1[Status]!=4 && $sk1[Status]!=5){
	$updateserver=mysql_query("UPDATE stokkantong SET 
		sah='0'	where noKantong='$sk1[noKantong]'",$con_server);
		
	}
}
//Kegiatan
//$yesterday = mktime(0,0,0,date("m"),date("d")-2,date("Y"));
//$tgl_yesterday=date("Y-m-d 00:00:00",$yesterday);
$tgl2=date("Y-m-d 00:00:00");
$kg=mysql_query("select * from kegiatan where TglPelaksanaan>'$tgl2'",$con_local);
while ($kg1=mysql_fetch_assoc($kg)) {
$kgs=mysql_query("update kegiatan set TglPelaksanaan='$kg1[TglPelaksanaan]' where NoTrans='$kg1[NoTrans]'");
}
$kg=mysql_query("select * from detailinstansi",$con_local);
while ($kg1=mysql_fetch_assoc($kg)) {
$kgs=mysql_query("update detailinstansi set nama='$kg1[nama]',alamat='$kg1[alamat]',telp='$kg1[telp]',cp='$kg1[cp]' where KodeDetail='$kg1[KodeDetail]'");
}

if ($kgs) {
        echo "<b> Proses Tranfer Sudah berhasil dilakukan</b>";
} else {
        echo "<b>Proses Transfer ke Gagal</b>";
        echo mysql_error();
}
echo "<meta http-equiv=\"refresh\" content=\"5; URL=pmimobile.php?module=mobile_transfer\">";
//******************************** UPDATE ***********************************//

}else{?>
    <h1>Apakah anda yakin untuk meng-upload data dari mobile unit ke server ?</h1>
    <h2>Setelah meng-upload, data transaksi server sebelumnya akan diperbaharui.</h2>
    <form name="download" method="post" action="<? $PHP_SELF ?>">
	IP SERVER <input type=text name=ip_server size=13 value='192.168.1.137'><br>
    <button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
        <span class="ui-button-text">Upload ke server</span>
    </button>
    </form>    
<?}
?>



