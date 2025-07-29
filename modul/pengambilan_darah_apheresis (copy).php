<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->		
<script src="js/modernizr-1.5.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script src="webforms2/webforms2.js"></script>
<script src="js/cookies.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<script src="js/html5forms.fallback.js"></script>



<script language="javascript">
function show0(id){
    var campur = document.getElementById('reagen'+id).value;
    var coba = document.getElementById('metode'+id).value;
    var jumtest = campur.split('*');
    document.getElementById('metode'+id).value=jumtest[5];
    document.getElementById('pl'+id).innerHTML = "Non-Reaktif";
    if (jumtest[5]=='rapid') {
	document.getElementById('cut'+id).disabled = true;
	document.getElementById('od'+id).disabled = true;
    }
} 
</script>
<script type="text/javascript" src="js/aftap.js"></script>
     <script type="text/javascript">
       jQuery(document).ready(function() {
	 $('#id_kantong11').focus();
       });
	window.onload = function(){ document.getElementById('id_kantong11').focus(); }
     </script>
	<style type="text/css">
		body {font-size: 62.5%; font-family:"Verdana",sans-serif; margin: 70px 10px;}
		fieldset { border:0;  margin-bottom: 40px;}	
		label,select,.ui-select-menu { float: left; margin-right: 10px; }
		select { width: 200px; }
		body a.customicons { height: 2.8em;}
		body .customicons li a, body a.customicons span.ui-selectmenu-status { line-height: 2em; padding-left: 30px !important; }
		body .video .ui-selectmenu-item-icon, body .podcast .ui-selectmenu-item-icon, body .rss .ui-selectmenu-item-icon { height: 24px; width: 24px; }
		body .video .ui-selectmenu-item-icon { background: url(sample_icons/24-video-square.png) 0 0 no-repeat; }
		body .podcast .ui-selectmenu-item-icon { background: url(sample_icons/24-podcast-square.png) 0 0 no-repeat; }
		body .rss .ui-selectmenu-item-icon { background: url(sample_icons/24-rss-square.png) 0 0 no-repeat; }
	</style>

<?
require_once('config/db_connect.php');
require_once('clogin.php');
$namauser=$_SESSION[namauser];
$sql=mysql_query("select mesin_apheresis from htransaksi");if (!$sql){mysql_query("ALTER TABLE  `htransaksi` ADD  `mesin_apheresis` VARCHAR( 15 ) NOT NULL DEFAULT  '-'");}

if ($_POST['submit']!=""){
	$tc_apr		= mktime(0,0,0,date("m"),date("d")+5,date("Y"));
	$prc_apr	= mktime(0,0,0,date("m"),date("d")+35,date("Y"));
	$lp_apr		= mktime(0,0,0,date("m"),date("d")+35,date("Y"));
	$kdl 		= mktime(0,0,0,date("m"),date("d")+14,date("Y"));
	$onebulan 	= mktime(0,0,0,date("m"),date("d")+30,date("Y"));
	$twobulan 	= mktime(0,0,0,date("m"),date("d")+60,date("Y"));
	$kembali0 	= mktime(0,0,0,date("m"),date("d")+75,date("Y"));
	$tensi 		= $_POST['tensi_diastol']."/".$_POST['tensi_sistol'];
	$idp		= mysql_query("select * from tempat_donor where active='1'");
	$status_test	= 1; 				$today 		= date('Y-m-d H:i:s');
	$kembalisatu 	= date('Y-m-d',$onebulan);	$kadaluwarsa	= date('Y-m-d H:i:s',$kdl);
	$tcapr		= date('Y-m-d H:i:s',$tc_apr);	$lpapr		= date('Y-m-d H:i:s',$lp_apr);
	$prcapr		= date('Y-m-d H:i:s',$prc_apr);
	$kembalidua 	= date('Y-m-d',$twobulan);	$normal		= date('Y-m-d H:i:s',$kembali0);
	$kodependonor	= $_POST['kodependonor'];
	$notrans 	= $_POST['notrans'];
	                                    		$keberhasilan 	= $_POST['keberhasilan'];	
	$volume_darahdiambil 	= $_POST['volume_darah'];
	$volume_darah	= round($volume_darahdiambil/2);
	$catatan 	= $_POST['catatan'];
	$reaksi 	= $_POST['reaksi'];		$caraambil 	= $_POST['caraambil'];
	$id_kantong 	= $_POST['id_kantong11'];
	$no_kantong0	=substr($id_kantong,0,-1);
	$namauser 	= $_SESSION['namauser'];
	$idp1		= mysql_fetch_assoc($idp);
	$mesin_apheresis= $_POST['mesin'];
	$GolDarah	= $_POST['goldarah'];
	$Rhesus		= $_POST['Rhesus'];
	$petugas	= $_POST['petugas'];
	$hematokrit	= $_POST['hematokrit'];
	$hemoglobin	= $_POST['hemoglobin'];
	$trombosit	= $_POST['trombosit'];
	$leukosit	= $_POST['leukosit'];
	$sisadarah	= $_POST['sisadarah'];
	if ($caraambil=='5') $kembali = date('Y-m-d',$kdl);
	if (substr($idp1[id1],0,1)=="M") { $mu="1";} else {$mu="";}
	$shift=mysql_fetch_assoc(mysql_query("select * from shift where jam_awal <=current_time"));
	$kota=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
	$pendonor=mysql_query("select * from pendonor where Kode='$kodependonor' ");
	$pendonor1=mysql_fetch_assoc($pendonor);
	$stok=mysql_query("select * from stokkantong where NoKantong='$id_kantong' and Status='0' and StatTempat='1'");
	$stok1=mysql_fetch_array($stok);
	$today=date('Y-m-d H:i:s');
	$reag0=$_POST[reagen0];
	$reag0_ex=explode('*',$reag0);
	$reag1=$_POST[reagen1];
	$reag1_ex=explode('*',$reag1);
	$reag2=$_POST[reagen2];
	$reag2_ex=explode('*',$reag2);
	$reag3=$_POST[reagen3];
	$reag3_ex=explode('*',$reag3);
	
	$rgn=mysql_query("SELECT * FROM reagen WHERE kode='$reag0_ex[0]'");
	$rg0a=mysql_fetch_assoc($rgn);
	$rgn1=mysql_query("SELECT * FROM reagen WHERE kode='$reag1_ex[0]'");
	$rg1=mysql_fetch_assoc($rgn1);
	$rgn2=mysql_query("SELECT * FROM reagen WHERE kode='$reag2_ex[0]'");
	$rg2=mysql_fetch_assoc($rgn2);
	$rgn3=mysql_query("SELECT * FROM reagen WHERE kode='$reag3_ex[0]'");
	$rg3=mysql_fetch_assoc($rgn3);
	
	$reagena=$rg0a[jumTest]-1;
	$reagenb=$rg1[jumTest]-1;
	$reagenc=$rg2[jumTest]-1;
	$reagend=$rg3[jumTest]-1;
	//--update jumlah test untuk masing-masing reagen----
	$jum_rgn=mysql_query("update reagen set jumTest='$reagena' where kode='$reag0_ex[0]'");
	$jum_rgn1=mysql_query("update reagen set jumTest='$reagenb' where kode='$reag1_ex[0]'");
	$jum_rgn2=mysql_query("update reagen set jumTest='$reagenc' where kode='$reag2_ex[0]'");
	$jum_rgn3=mysql_query("update reagen set jumTest='$reagend' where kode='$reag3_ex[0]'");
	
	//update : 2014-01-10 by suwena
	//------------ Generate no transaksi ---------------
	 $sql_elisa=mysql_fetch_assoc(mysql_query("select max(convert(notrans, SIGNED INTEGER)) as Kode from hasilelisa"));
	 $sql_rapid=mysql_fetch_assoc(mysql_query("select max(convert(NoTrans, SIGNED INTEGER)) as Kode from drapidtest"));
	 $int_elisa=$sql_elisa['Kode'];
	 $int_rapid=$sql_rapid['Kode'];
	 if($int_elisa>$int_rapid){$int_kode=$int_elisa;}else{$int_kode=$int_rapid;}
	 $int_kode=$int_kode+1;
	 $j_nol0= 8-(strlen(strval($int_kode)));
	 for ($i=0; $i<$j_nol0; $i++){
		  $nol .="0";
	 }
	 $notest=$nol.$int_kode;
	 //------------ END Generate no transaksi ---------------
	
	for($j=0;$j<4;$j++){
	    $co =$_POST['cut'.$j];
	    $rg0=$_POST['reagen'.$j];
	    $rg1=explode('*',$rg0);
	    $rg	=$rg1[0];	//kode reagen
	    if ($rg!='') {
			$metode=$rg1[5];
			$njt=$rg1[6];
			$od=$_POST['od'.$j];
			$od=str_replace(',','.',$od);
			if ($njt=="HBsAg") $njt1="0";
			if ($njt=="HCV") $njt1="1";
			if ($njt=="HIV") $njt1="2";
			if ($njt=="Syp") $njt1="3";
			if($njt!=""){
				$ratio=$od;
				if ($co>0) $ratio=$od/$co;
				if (($metode=='elisa') and ($od!='')){
					$tambah_sql="insert into hasilelisa (noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa, dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode,ulang)
								values ('$id_kantong','$ratio','$co','0','$notest','$njt1','$today','$namauser','$_POST[sah1]','$_POST[sah]','$rg','elisa','0')";
					$tambahsaring=mysql_query($tambah_sql);
				} else {
					$kontrol='1';
					$tambahsaring=mysql_query("insert into drapidtest (NoTrans,noKantong,Kontrol,jenisPeriksa,Hasil,nolot,tgl_tes,dicatatoleh,dicekOleh,DisahkanOleh,Metode,ulang) 
						values ('$notest','$id_kantong','$kontrol','$njt1','1','$rg','$today','$namauser','$_POST[sah1]','$_POST[sah]','rapid','0')");
					//2014-01-23 insert to 'hasilelisa', in future only 1 table for screening result include NAT: eficiency and faster report
					$tambah_sql1="insert into hasilelisa ( noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa, dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode)
					values ('$id_kantong','0','0','0','$notest','$njt1','$today', '$namauser','$_POST[sah1]','$_POST[sah]','$rg','rapid')";
					$tambah1=mysql_query($tambah_sql1);
				}
			}
	    }
	}
	if ($stok1['Status']=="0"){
	    if ($keberhasilan==0) { //0=berhasil, 1=batal, 2=gagal 
		$tambah=mysql_query("UPDATE htransaksi SET diambil='$volume_darah',reaksi='$reaksi', pengambilan='$keberhasilan',catatan='$catatan',Diambil='$volume_darah',jeniskantong='$stok1[jenis]',volumekantong='$stok1[volumeasal]',
			nokantong='$id_kantong',petugas='$petugas',kota='$kota[id]',shift='$shift[nama]',
			caraambil='$caraambil',status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$pendonor1[jumDonor]',
hematokrit='$hematokrit',hemoglobin='$hemoglobin',trombosit='$trombosit',leukosit='$leukosit',sisadarah='$sisadarah', mesin_apheresis='$mesin_apheresis' WHERE (Status='1' and NoTrans='$notrans')");
		if ($sisadarah<'100'){
		    $kembali1=mysql_query("UPDATE pendonor SET tglkembali='$kadaluwarsa',jumDonor=jumDonor+1,mu='$mu',up=b'1',tglkembali_apheresis='$kadaluwarsa' WHERE Kode='$kodependonor'");
		    $msmskembali=$kadaluwarsa;
		} elseif (($sisadarah>'100')and($sisadarah<'200')){
		    $kembali1=mysql_query("UPDATE pendonor SET tglkembali='$kadaluwarsa',jumDonor=jumDonor+1,mu='$mu',up=b'1',tglkembali_apheresis='$kadaluwarsa' WHERE Kode='$kodependonor'");
		    $msmskembali=$kadaluwarsa;
		}else{
		    $kembali1=mysql_query("UPDATE pendonor SET tglkembali='$kadaluwarsa',jumDonor=jumDonor+1,mu='$mu',up=b'1',tglkembali_apheresis='$normal' WHERE Kode='$kodependonor'");
		    $msmskembali=$normal;
		}
		if ($caraambil=='1'){
		    $tambah2=mysql_query("UPDATE stokkantong SET Status='2',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='TC Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today', 
			    tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$tcapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
		    $tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    $tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} else if ($caraambil=='3'){
		    $tambah2=mysql_query("UPDATE stokkantong SET Status='2',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='LP Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today',
			    tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$lpapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
		    $tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    $tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} else if ($caraambil=='4'){
		    $tambah2=mysql_query("UPDATE stokkantong SET Status='2',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='PRC Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today',
			    tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$prcapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
		    $tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    $tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} else {
		    $tambah2=mysql_query("UPDATE stokkantong SET Status='2',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='Lekosit Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today',
			    tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$tcapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
		    $tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    $tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		}   
	    } elseif ($keberhasilan==2){
		$tambah=mysql_query("UPDATE htransaksi SET diambil='$volume_darah',reaksi='$reaksi',
			pengambilan='$keberhasilan',catatan='$catatan',Diambil='$volume_darah',jeniskantong='$stok1[jenis]',volumekantong='$stok1[volumeasal]',
			nokantong='$id_kantong',petugas='$petugas',kota='$kota[id]',shift='$shift[nama]',
			caraambil='$caraambil',status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',hematokrit='$hematokrit',hemoglobin='$hemoglobin',donorke='$pendonor1[jumDonor]',
			trombosit='$trombosit',leukosit='$leukosit',sisadarah='$sisadarah', mesin_apheresis='$mesin_apheresis' WHERE (Status='1' and NoTrans='$notrans')");
		$kembali1=mysql_query("UPDATE pendonor SET tglkembali='$kembali',jumDonor=jumDonor+1,mu='$mu',up=b'1' WHERE Kode='$kodependonor'");
		if ($caraambil=='1'){
			$tambah2=mysql_query("UPDATE stokkantong SET Status='5',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='TC Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today',
			    tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$tcapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
			$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    	$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} else if ($caraambil=='3'){
			$tambah2=mysql_query("UPDATE stokkantong SET Status='5',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='LP Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today',
			    tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$lpapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
			$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    	$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} else if ($caraambil=='4'){
			$tambah2=mysql_query("UPDATE stokkantong SET Status='5',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='PRC Aferesis',
			    statKonfirmasi='1',sah='1',volume='$volume_darah', tglpengolahan='$today', tglperiksa='$today',kodePendonor='$kodependonor',kadaluwarsa='$prcapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
			$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    	$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		} else {
			$tambah2=mysql_query("UPDATE stokkantong
			    SET Status='5',hasil='2',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='Lekosit APR',StatKonfirmasi='1',sah='1',
			    volume='$volume_darah',tglperiksa='$today', tglpengolahan='$today', kodePendonor='$kodependonor',kadaluwarsa='$tcapr',mu='$mu',statQC='1' WHERE noKantong like '$no_kantong0%'");
			$tambah3=mysql_query("UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
		    	$tambah4=mysql_query("UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
		}
	    } elseif ($keberhasilan==1){
		$tambah=mysql_query("UPDATE htransaksi SET reaksi='$reaksi',pengambilan='$keberhasilan',catatan='$catatan',petugas='$petugas',status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$pendonor1[jumDonor]',Diambil='$volume_darah',kota='$kota[id]',shift='$shift[nama]', mesin_apheresis='$mesin_apheresis' WHERE (Status='1' and NoTrans='$notrans')");
		$tambah2=mysql_query("UPDATE stokkantong SET Status='0',mu='$mu' WHERE noKantong like '$no_kantong0%'");
	    }	
	    $tambah_tmp=mysql_query("UPDATE tempudd  SET petugas3='$petugas' where modul='MU CHECKUP'");
	    if ($tambah) {
		//=======Audit Trial====================================================================================
		$log_mdl ='PENGAMBILAN';
		$log_aksi='Pengambilan Apheresis: '.$notrans.' Pendonor: '.$kodependonor.' Kantong: '.$id_kantong;
		include_once "user_log.php";
		//=====================================================================================================

		//Eksekusi SMS==============================================================================
                //---Minta Id pendonor untuk set data pendonor----
                $pendonor=mysql_query("select kodependonor from stokkantong where nokantong='$id_kantong'");
                $datapendonor=mysql_fetch_assoc($pendonor);
                $idpendonor=$datapendonor[kodependonor];
                $dk=mysql_query("select nama,Jk,Status, telp,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>9");
                if (mysql_num_rows($dk)==1) {
			
                    $dk1=mysql_fetch_assoc($dk);
			if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Bpk';
			if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Sdr';
			if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Ibu';
			if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Sdri';
                    $ud=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='3'"));
					$pesansms=$ud[pesan];
                    $telp=$dk1[telp2];
                    $pesan='Yth. '.$sapa.'. '.$dk1[nama].', '.$pesansms;
                    $kirim=mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) values ('$telp','$pesan','1')");
                }
                // end ucapan===============================================================================
		echo "Data Telah berhasil dimasukkan<br>";
		switch ($_SESSION[leveluser]){
		    case "aftap":?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=check"> <? break;
		    case "mobile": ?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=search_pendonor"> <? break;
		    case "kasir": ?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=check"> <? break;
		    default: echo "Anda tidak memiliki hak akses";
		}
	    }
	    } else {
		echo "No tidak sesuai, silahkan periksa status kantong.<br>";
		switch ($_SESSION[leveluser]){
		    case "aftap": ?> <META http-equiv="refresh" content="1; url=pmiaftap.php?module=spengambilan"> <? break;
		    case "mobile": ?> <META http-equiv="refresh" content="1; url=pmimobile.php?module=transaksi"> <? break;
		    case "kasir": ?> <META http-equiv="refresh" content="1; url=pmikasir.php?module=spengambilan"> <? break;
		    default: echo "Anda tidak memiliki hak akses";
		}
	    }
                
	$_POST['periksa']="";
}

$cek_tmpudd=1;
$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
$query_combo = "select * from tempudd where modul='MU CHECKUP'";
$hasil_combo = mysql_query($query_combo);
$data_combo = mysql_fetch_array($hasil_combo);
$check=mysql_query("select * from pmi.htransaksi where (NoTrans='$_GET[NoTrans]' or NoTrans='$_POST[NoTrans]')");
$check1=mysql_fetch_assoc($check);
$q_dok=mysql_query("select Nama from dokter_periksa where kode='$check1[NamaDokter]'");
$a_dok=mysql_fetch_assoc($q_dok);
$check1[KodePendonor]=str_replace("'","\'",$check1[KodePendonor]);
$data=mysql_query("select Nama,GolDarah,Rhesus from pendonor where Kode='$check1[KodePendonor]'");
$data1=mysql_fetch_assoc($data);
?>
<font size="5" color=red font-family="Arial">PENGAMBILAN DARAH APHERESIS</font><br>
<form name="periksa" id="periksa" onsubmit="return ok()" method="post" action="<?=$PHPSELF?>" >
    <table class="form" cellspacing="1" cellpadding="1" border="0">
	<tr>
	    <td valign="top">
		<table class="form" cellspacing="3" cellpadding="2">
		    <tr><td>Kode Pendonor</td>
				<td class="input"><?=$check1[KodePendonor]?> &nbsp;</td>
		    </tr>
			<td>Pengambilan</td>
			<td class="input">
			    <script>
				function disabletext(val){
				    if(val=='0'){
					document.getElementById('comments').disabled = true;
					document.getElementById('id_kantong11').disabled = false;
					document.getElementById('id_kantong11').type = 'text';
				    }
				    if(val=='2'){
					document.getElementById('id_kantong11').type = 'text';
					document.getElementById('comments').disabled = false;
				    }
				    if(val=='1'){
					document.getElementById('comments').disabled = false;
					document.getElementById('id_kantong11').type = 'hidden';
				    }
				}
			    </script>
			    <input type='radio' name='keberhasilan' value='0' checked onclick='disabletext(this.value);'>Berhasil
			    <input type='radio' name='keberhasilan' value='2' onclick='disabletext(this.value);'>Gagal
			    <input type='radio' name='keberhasilan' value='1' onclick='disabletext(this.value);'>Batal &nbsp;<br>
			    <input name='catatan' id='comments' placeholder="Keterangan"></input>&nbsp;
			</td>
		    </tr>
		    <tr>
			<td>Diambil Sebanyak &nbsp;</td>
			<td class="input"> <input length="4" name="volume_darah" value="200" size="4">CC</input></td>
		    </tr>
			<tr>
			<td></td>
				<td class="input"><font size="1">Apabila kantong double, volume akan<br>dibagi rata ke tiap kantong</td>
		    </tr>
		    <tr>
			<td>Reaksi Donor</td>
			<td class="input">
			    <select name="reaksi" >
				<option value="Mual">Mual</option>
				<option value="Pusing">Pusing</option>
				<option value="Pingsan">Pingsan</option>
				<option selected value="Normal">Tidak Ada Keluhan</option>
			    </select>
			</td>
		    </tr>
		    <tr>
			<td>Cara Ambil</td>
			<td class="input">
			    <select name="caraambil" >
				<option selected value="1">Tromboferesis</option>
				<option value="2">Leukaferesis</option>
				<option value="3">Plasmaferesis</option>
				<option value="4">Eritoferesis</option>
			    </select>
			</td>
		    </tr>
			<tr>
			    <td>Petugas Aftap</td>
			    <td class="input">
				<select name="petugas"">
				    <? $dokter="select * from user order by nama_lengkap";
				    $do=mysql_query($dokter);
				    while($data=mysql_fetch_array($do)){					
					if ($data[id_user] == $data_combo[petugas3]){
					    echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
					}else{
					    echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
					}
				    } ?>
					<option value="--">-</option>
				</select>
			    </td>
			</tr>
		    <tr>
				<td>Mesin Apheresis</td>
				<td class="input">
					<select name="mesin">
						<option value="Com.Tech">Com.Tech</option>
						<option value="Trima.Acell">Trima.Acell</option>
						<option value="Amicus">Amicus</option>
						<option value="HAEMONETICS">HAEMONETICS</option>
					</select>
				</td>
		    </tr>
		    <tr><td>No Kantong</td><td class="input"><input name="id_kantong11" id="id_kantong11" onkeydown="chang(event,this);" type="text" size="20"></td></tr>
		</table>
	    </td>
	    <td valign="top">
		<table class="form" cellspacing="5" cellpadding="5">
		    <tr><td>Nama Pendonor</td><td class="input"><?=$data1[Nama]?> &nbsp;</td></tr>
		    <tr><td>Golongan Darah &nbsp;</td><td class="input"><? echo $data1[GolDarah]."(".$data1[Rhesus].")"?></td>
				<input type="hidden" name="goldarah" value="<?=$data1[GolDarah]?>">
				<input type="hidden" name="Rhesus" value="<?=$data1[Rhesus]?>"></tr>
		    <tr><td>Nama Dokter &nbsp;</td><td class="input"><?=$a_dok[Nama];?></td></tr>
		    <tr><td>Berat</td><td class="input"><?=$check1[beratBadan];?> &nbsp;kg</td></tr>
		    <tr><td>CuSO<sub>4</td><td class="input">Tenggelam</td></tr>
		    <tr><td>HCT</td><td class="input"><?=$check1[Hct];?> &nbsp; %</td></tr>
		    <tr><td>Tensi</td><td class="input"><?=$check1[tensi];?><td></tr>
		    <tr><td>Suhu</td><td class="input"><?=$check1[suhu];?><td></tr>
		    <tr><td>Nadi</td><td class="input"><?=$check1[nadi];?><td></tr>
		</table>
	    </td>
	<td>
	    <table class="form" cellspacing="1" cellpadding="1">
		<tr valign="top">
		    <td>HbsAg</td>
		    <td class="input">
			<select name="reagen0" id="reagen0" onChange="show0(0)" STYLE="width: 190px">
			    <option value="">Pilih reagen HBsAg</option>
				<? 
				$jreagen1=mysql_query("select * from reagen where Nama like '%HBsAg%' and aktif='1' and jumTest>0");
				while ($jreagen11=mysql_fetch_assoc($jreagen1)) { 
				    $nr1=strtoupper($jreagen11[Nama]);
				    $merk1=str_replace("HBSAG","",$nr1);
				    $merk1=str_replace(" ","",$merk1);
				    $merk11=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk1'"));
				    if ($merk11['nama_reagen']!='') {
								    $m_reagen1=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
								    where nama_reagen='$merk11[nama_reagen]' and jenis_reagen='HBsAg'"));?>
								    <option value="<?=$jreagen11[kode]?>*<?=$jreagen11[jumTest]?>*<?=$m_reagen1[reaktif]?>*<?=$m_reagen1[nonreaktif]?>*<?=$m_reagen1[greyzone]?>*<?=$jreagen11[metode]?>*HBsAg">
								    <?=$jreagen11[Nama]?>-<?=$jreagen11[kode]?>-<?=$jreagen11[jumTest]?> test</option><?
							    }
						    } ?>
					    </select>
						</td>
						<td>CutOff</td>
						<td class="input">
						  <input name="cut0" id="cut0" type="text" size="3" value='0'>
						  </td>
						<td>OD</td>
						<td class="input">
						  <input name="od0" id="od0" type="text" size="3" value='0'><label name="pl0" id="pl0"></label>
						  <input type="hidden" name="metode0" id="metode0" size="10">
						  <input type="hidden" name="jenis0" id="jenis0" size="10" value='HBsAg'>
						  </td>
					</tr>
				      <tr>
						<td>HCV</td>
						<td class="input">
						    <select name="reagen1" id="reagen1" onChange="show0(1)" STYLE="width: 190px">
						    <option value="">Pilih reagen HCV</option> <? 
						    $jreagen2=mysql_query("select * from reagen where Nama like '%Hcv%' and aktif='1' and jumTest>0");
						    while ($jreagen21=mysql_fetch_assoc($jreagen2)) { 
							    $nr2=strtoupper($jreagen21[Nama]);
							    $merk2=str_replace("HCV","",$nr2);
							    $merk2=str_replace(" ","",$merk2);
							    $merk21=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk2'"));
							    if ($merk21['nama_reagen']!='') {
								    $m_reagen2=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
								    where nama_reagen='$merk21[nama_reagen]' and jenis_reagen='HCV'"));?>
			  <option value="<?=$jreagen21[kode]?>*<?=$jreagen21[jumTest]?>*<?=$m_reagen2[reaktif]?>*<?=$m_reagen2[nonreaktif]?>*<?=$m_reagen2[greyzone]?>*<?=$jreagen21[metode]?>*HCV">
								    <?=$jreagen21[Nama]?>-<?=$jreagen21[kode]?>-<?=$jreagen21[jumTest]?> test</option><?
							    }
						    }?>
					    </select>
						    </td>
						</td>
						<td>CutOff</td>
						<td class="input">
						  <input name="cut1" id="cut1" type="text" size="3" value='0'>
						  </td>
						<td>OD</td>
						<td class="input">
						  <input name="od1" id="od1" type="text" size="3" value='0'><label name="pl1" id="pl1"></label>
						  <input type="hidden" name="metode1" id="metode1" size="10">
						  <input type="hidden" name="jenis1" id="jenis1" size="10" value='HCV'>
						  </td>
						
					</tr>
				      <tr>
						<td>HIV</td>
						<td class="input">
						    <select name="reagen2" id="reagen2" onChange="show0(2)" STYLE="width: 190px">
						    <option value="">Pilih reagen HIV</option> <? 
						    $jreagen3=mysql_query("select * from reagen where Nama like '%Hiv%' and aktif='1' and jumTest>0");
						    while ($jreagen31=mysql_fetch_assoc($jreagen3)) {
							    $nr3=strtoupper($jreagen31[Nama]);
							    $merk3=str_replace("HIV","",$nr3);
							    $merk3=str_replace(" ","",$merk3);
							    $merk31=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk3'"));
							    if ($merk31['nama_reagen']!='') {
								    $m_reagen3=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
								    where nama_reagen='$merk31[nama_reagen]' and jenis_reagen='HIV'"));?>
	    <option value="<?=$jreagen31[kode]?>*<?=$jreagen31[jumTest]?>*<?=$m_reagen3[reaktif]?>*<?=$m_reagen3[nonreaktif]?>*<?=$m_reagen3[greyzone]?>*<?=$jreagen31[metode]?>*HIV"><?=$jreagen31[Nama]?>-<?=$jreagen31[kode]?>-<?=$jreagen31[jumTest]?> test</option><?
							    }
						    }?>
					    </select>
						    </td>
						<td>CutOff</td>
						<td class="input">
						  <input name="cut2" id="cut2" type="text" size="3" value='0'>
						  </td>
						<td>OD</td>
						<td class="input">
						  <input name="od2" id="od2" type="text" size="3" value='0'><label name="pl2" id="pl2"></label>
						  <input type="hidden" name="metode2" id="metode2" size="10">
						  <input type="hidden" name="jenis2" id="jenis2" size="10" value='HIV'>
						  </td>
					</tr>
				        <tr>
						<td>Sypilis</td>
						<td class="input">
						   <select name="reagen3" id="reagen3" onChange="show0(3)" STYLE="width: 190px">
						    <option value="">Pilih reagen Syp </option> <? 
						    $jreagen4=mysql_query("select * from reagen where Nama like '%Syp%' and aktif='1' and jumTest>0");
						    while ($jreagen41=mysql_fetch_assoc($jreagen4)) {
							    $nr4=strtoupper($jreagen41[Nama]);
							    $merk4=str_replace("SYPHILIS","",$nr4);
							    $merk4=str_replace(" ","",$merk4);
							    $merk41=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk4'"));
							    if ($merk41['nama_reagen']!='') {
								    $m_reagen4=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
								    where nama_reagen='$merk41[nama_reagen]' and jenis_reagen='Syphilis'"));?>
	    <option value="<?=$jreagen41[kode]?>*<?=$jreagen41[jumTest]?>*<?=$m_reagen4[reaktif]?>*<?=$m_reagen4[nonreaktif]?>*<?=$m_reagen4[greyzone]?>*<?=$jreagen41[metode]?>*Syp"><?=$jreagen41[Nama]?>-<?=$jreagen41[kode]?>-<?=$jreagen41[jumTest]?> test</option><?
							    }
						    }?>
					    </select>
						    </td>
						<td>CutOff</td>
						<td class="input">
						  <input name="cut3" id="cut3" type="text" size="3" value='0'>
						  </td>
						<td>OD</td>
						<td class="input">
						  <input name="od3" id="od3" type="text" size="3" value='0'><label name="pl3" id="pl3"></label>
						  <input type="hidden" name="metode3" id="metode3" size="10">
						    <input type="hidden" name="jenis3" id="jenis3" size="10" value='Syp'>
						  </td>
					</tr>
					<tr>
			                  <td >Dicatat</td>
					  <td class="input"><?echo $namauser;?></td>
					</tr>
					<tr>
					      <td>Dicek</td>
						    <td class="input"> <select name="sah1" > <?
							      $user1="select * from user";
					      $do1=mysql_query($user1);
								      while($data1=mysql_fetch_assoc($do1)) {
									      $select1=""; ?>
									      <option value="<?=$data1[nama_lengkap]?>"<?=$select1?>>
									      <?=$data1[nama_lengkap]?>
									      </option>
							      <? } ?>
						      </select>
						    </td>
					</tr>			      
				      <tr>
					      <td>Disahkan</td>
						     <td class="input"> <select name="sah" > <?
							      $user="select * from dokter_periksa";
					                       $do=mysql_query($user);
								      while($data=mysql_fetch_assoc($do)) {
									      $select=""; ?>
									      <option value="<?=$data[Nama]?>"<?=$select?>>
									      <?=$data[Nama]?>
									      </option>
							      <? } ?>
						      </select>
						     </td>
					      </tr>
					<tr><td>Hematokrit</td><td class="input"><input name="hematokrit" id="hematokrit" type="text" size="3">%</td>
						<td>Hemoglobin</td>
						<td class="input"><input name="hemoglobin" id="hemoglobin" type="text" size="3">g/dL</td>
					</tr>
					<tr><td>Trombosit</td><td class="input"><input name="trombosit" id="trombosit" type="text" size="3">/uL</td>
						<td>Leukosit</td><td class="input"><input name="leukosit" id="leukosit"  type="text" size="3">/uL</td>
					</tr>
					<tr><td>Sisa Darah</td><td class="input"><input name="sisadarah" id="sisadarah" type="text" size="3">mL</td>
					</tr>
				</table>
			</td>			
		</tr>
	</table>
<input type="hidden" name="paket" value="1">
<input type="hidden" name="notrans" value="<?=$_GET[NoTrans]?>">
<input type="hidden" name="kodependonor" value="<?=$check1[KodePendonor]?>">
<input type="submit" name="submit" value="Simpan" class="swn_button_red">
</form>
<div class="alert" id="alert">
	<div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!">
		<p>Silahkan cek kembali kantong yang anda masukkan di menu Check Stok, atau masukkan kantong lain</p>
	</div>
</div>


