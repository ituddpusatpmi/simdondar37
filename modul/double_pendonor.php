<? include ('config/db_connect.php'); ?>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>

<script language="javascript">
function selectSupplier(Kode){
	  $('input[@name=id]').val(Kode);
	  tb_remove(); 
}
function selectKode(Kode){
	  $('input[@name=id]').val(Kode);
	  tb_remove(); 
	  dbar(Kode);
}
</script>
<script language="javascript">
function selectSupplier(Kode1){
	  $('input[@name=id1]').val(Kode1);
	  tb_remove(); 
}
function selectKode1(Kode1){
	  $('input[@name=id1]').val(Kode1);
	  tb_remove(); 
	  dbar(Kode1);
}
</script>


<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>

<!-- This javascript is only used for the show/hide source on my example page.
     It is not used by the Calendar Popup script -->
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>

<!-- This prints out the default stylehseets used by the DIV style calendar.
     Only needed if you are using the DIV style popup -->
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>

<!-- These styles are here only as an example of how you can over-ride the default
     styles that are included in the script itself. -->
<SCRIPT LANGUAGE="JavaScript" ID="jscal1xx">
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</SCRIPT>

</head>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script language="javascript">
function setFocus(){document.sehat.kode.focus();}
</script>




<h1>Hapus Data Pendonor Ganda </h1>
<form name=doublependonor method=post>
<table>
<tr><td align="right" >Klik  --> </td><td></td><td> <a href="modul/daftar_pendonor_ganda.php?&width=500&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a> Untuk Cari kode pendonor</td></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr><td>Kode Pendonor 1 </td><td>:</td><td><input placeholder='Yang akan Tinggal' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 2 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 3 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 4 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 5 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 6 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 7 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 8 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>
<tr><td>Kode Pendonor 9 </td><td>:</td><td><input placeholder='Yang akan DiHapus' type=text name='kode[]'></td></tr>

</table>
<input type=submit name=submit value="Submit">
</form>

<? 
if (isset($_POST[submit])) {
    //------------------------ set id transaksi ------------------------->
    $idp	= mysql_query("select * from tempat_donor where active='1'");
    $idp1	= mysql_fetch_assoc($idp);
    $th		= substr(date("Y"),2,2);
    $bl		= date("m");
    $tgl	= date("d");
    $kdtp	= substr($idp1['id1'],0,2).$tgl.$bl.$th."-";
    $idp	= mysql_query("select NoTrans from htransaksi where NoTrans like '$kdtp%' order by NoTrans DESC");
    $idp1	= mysql_fetch_assoc($idp);
    $idp2	= substr($idp1['NoTrans'],9,3);
    if ($idp2<1) {$idp2="000";}
    $idp3	= (int)$idp2+1;
    $id31	= strlen($idp2)-strlen($idp3);
    $idp4	= "";
    for ($i=0; $i<$id31; $i++){
        $idp4 .="0";
    }
    $id_transaksi_baru=$kdtp.$idp4.$idp3;
    //------------------------ END set id transaksi ------------------------->

    $inst=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where aktif='1'"));
    if(substr($idp1['id1'],0,1)=='M'){
        $temp="Mobile Unit - ".$inst['nama'];
        $up="0";
    }else{
        $temp="Dalam Gedung";
        $up="1";
    }

	$kode1=mysql_escape_string($_POST[kode][0]);
	for ($i=1;$i<9;$i++) {
		$kode=mysql_escape_string($_POST[kode][$i]);
		$d=mysql_query("SELECT count(nokantong) as jumlahdonor FROM `htransaksi` WHERE kodependonor='$kode' AND pengambilan='0' ");
		$e=mysql_fetch_array($d);
		$jumlahdonor=$e[jumlahdonor];
		if ($kode!='') {
			$jd=mysql_fetch_assoc(mysql_query("select jumDonor from pendonor where kode='$kode'"));
			mysql_query("update pendonor set jumDonor=jumDonor+$jumlahdonor where kode='$kode1'");
            mysql_query("INSERT INTO pendonor_recycle
             (MasterKode, Kode, Kode_lama, NoKTP, Nama, Alamat, Jk, Pekerjaan, telp, TempatLhr, TglLhr, Status, GolDarah, Rhesus, `Call`, Cekal, kelurahan, kecamatan, wilayah, KodePos, jumDonor, title, telp2, umur, jns, ketdarah, tglkembali, sukubangsa, cetak, ibukandung, mu, pencatat, up, waktu_update, p10, p25, p50, p75, p100, psatya, pprov, instansi, kartu_cetak, tanggal_cetak, tanggal_entry, tglkembali_apheresis, apheresis, `update`)
             (SELECT '$kode1', Kode, Kode_lama, NoKTP, Nama, Alamat, Jk, Pekerjaan, telp, TempatLhr, TglLhr, Status, GolDarah, Rhesus, `Call`, Cekal, kelurahan, kecamatan, wilayah, KodePos, jumDonor, title, telp2, umur, jns, ketdarah, tglkembali, sukubangsa, cetak, ibukandung, mu, pencatat, up, waktu_update, p10, p25, p50, p75, p100, psatya, pprov, instansi, kartu_cetak, tanggal_cetak, tanggal_entry, tglkembali_apheresis, apheresis, `update` FROM pendonor WHERE Kode='$kode')");
            mysql_query("INSERT INTO histori
             (notrans, username, level_editor, waktu, KodePendonor, action, jenis, tempat, up)
             VALUES
             ('$id_transaksi_baru','$_SESSION[namauser]','$_SESSION[leveluser]','$sekarang','$kode','Penghapusan Data Ganda berdasarkan Master Data Donor dengan Kode $kode1.', '2', '$temp', '$up')");

			mysql_query("delete from pendonor where kode='$kode'");
			mysql_query("update htransaksi set KodePendonor='$kode1' where KodePendonor='$kode'");
			mysql_query("update stokkantong set kodePendonor='$kode1' where kodePendonor='$kode'");
			echo "<br>Data pendonor dengan Kode $kode telah dihapus dan diupdate";
			//=======Audit Trial====================================================================================
			$log_mdl ='P2DDS';
			$log_aksi='Edit Pendonor Ganda: '.$kode1.', Kode digabung: '.$kode;
			include_once "user_log.php";
			//=====================================================================================================
		}
	}
}?>
