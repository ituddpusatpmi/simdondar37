<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script language=javascript src="../js/imltd_import_dacvinci.js" type="text/javascript"> </script>
<style type="text/css">
	@import url("topstyle.css");
</style>

<body>
<?
$today=date("Y-m-d");
$no=0;
$jmldiproses=0;
$ngz=0;
$nsehat=0;
$nrusak=0;
$jmlkantongrusakdiproses=0;
$jmlkantongsehatdiproses=0;
$jmlperiksa=1;
$msg="Hasil proses import hasil IMLTD bioM&eacuterieux Da Vinci Quatro ";

include ('clogin.php');
include ('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$today=date("Y-m-d");

if(isset($_POST['Button']))  {
	$msg=$msg."Jumlah diproses : ".count($_POST[pilih]).",  dari : ".$_POST['jumlahtotal']." kantong.";
	$namalengkap	= $_POST['namalengkap'];
	$totaltest		= $_POST['jumlahtotal'];
	$reagenhbsag	= $_POST['reagen_hbsag'];
	$reagenhcv		= $_POST['reagen_hcv'];
	$reagenhiv		= $_POST['reagen_hiv'];
	$reagensyp		= $_POST['reagen_syp'];
	$metode_hbsag	= $_POST['hbsag_metode'];
	$metode_hcv		= $_POST['hcv_metode'];
	$metode_hiv		= $_POST['hiv_metode'];
	$metode_syp		= $_POST['syp_metode'];
	
	$hbsag_cut_off	= $_POST['hbsag_cut_off'];
	$hcv_cut_off	= $_POST['hcv_cut_off'];
	$hiv_cut_off	= $_POST['hiv_cut_off'];
	$syp_cut_off	= $_POST['syp_cut_off'];
 
	//Update jumlah test reagen
	$jum_rgn0=mysql_query("update reagen set jumTest=jumTest-$totaltest where kode='$reagenhbsag'");
	$jum_rgn1=mysql_query("update reagen set jumTest=jumTest-$totaltest where kode='$reagenhcv'");
	$jum_rgn2=mysql_query("update reagen set jumTest=jumTest-$totaltest where kode='$reagenhiv'");
	$jum_rgn3=mysql_query("update reagen set jumTest=jumTest-$totaltest where kode='$reagensyp'");
	
	//MEMBUAT NOMOR TRANSAKSI===============================================
	$sql_elisa	= mysql_query("SELECT MAX(CONVERT(notrans, SIGNED INTEGER)) AS Kode FROM hasilelisa");
	$sql_rapid	= mysql_query("SELECT MAX(CONVERT(NoTrans, SIGNED INTEGER)) AS Kode FROM drapidtest");
	$dta_elisa	= mysql_fetch_assoc($sql_elisa);
	$dta_rapid	= mysql_fetch_assoc($sql_rapid);
	$int_elisa  = (int)($dta_elisa[Kode]);
	$int_rapid  = (int)($dta_rapid[Kode]);
	if ($int_elisa > $int_rapid){$int_no=$int_elisa;}else{$int_no=$int_rapid;}
	$int_no_inc=(int)$int_no+1;
	$j_nol= 8-(strlen(strval($int_no_inc)));
	for ($i=0; $i<$j_nol; $i++){$no_tmp .="0";}
	$notrans = $no_tmp.$int_no_inc;
	//------------ END Generate no transaksi ---------------
	
	for ($i=0;$i<count($_POST[kantong]);$i++) {
		//echo "Proses nomor kantong ".$_POST[kantong][$i]."<br>";
		$nktg			= $_POST[kantong][$i];
		$status_kantong = $_POST[status_kantong][$i];
		//echo "Status Kantong : ".$status_kantong."<br>";
		if ($status_kantong==1){
			//echo "Status Kantong : ".$status_kantong."<br>";
			//insert ke table elisa atau rapid===========
			$ratio_hbsag	= $_POST['hbsag_od'][$i];
			$ratio_hcv		= $_POST['hcv_od'][$i];
			$ratio_hiv		= $_POST['hiv_od'][$i];
			$ratio_syp		= $_POST['syp_od'][$i];
			$hasil_hbsag	= $_POST['hbsag_result'][$i];
			$hasil_hcv		= $_POST['hcv_result'][$i];
			$hasil_hiv		= $_POST['hiv_result'][$i];
			$hasil_syp		= $_POST['syp_result'][$i];
			
			//parameter hbsag----------------------------
			$metode=$_POST['hbsag_metode'];
			if ($metode=='elisa') {
				$tambah_sql="insert into hasilelisa ( noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa,
							dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode)
							values ('$nktg','$ratio_hbsag','$hbsag_cut_off','$hasil_hbsag','$notrans','0','$today',
							'$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','$reagenhbsag','elisa')";
				$tambah=mysql_query($tambah_sql);
				//echo "HBsag Elisa<br>";
			} else {
				$tambah=mysql_query("insert into drapidtest (NoTrans,noKantong,Kontrol,jenisPeriksa,Hasil,nolot,
									tgl_tes,dicatatoleh,dicekOleh,DisahkanOleh,Metode) 
									values ('$notrans','$nktg','1','0','$ratio_hbsag','$reagenhbsag',
									'$today','$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','Rapid')");
				//echo "HBsag Rapid<br>";
			}
			//parameter hcv------------------------------
			$metode=$_POST['hcv_metode'];
			//echo "HCV $metode<br>";
			if ($metode=='elisa') {
				$tambah_sql="insert into hasilelisa ( noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa,
							dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode)
							values ('$nktg','$ratio_hcv','$hcv_cut_off','$hasil_hcv','$notrans','1','$today',
							'$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','$reagenhcv','elisa')";
				$tambah=mysql_query($tambah_sql);
				//echo "HCV Elisa<br>";
			} else {
				$tambah=mysql_query("insert into drapidtest (NoTrans,noKantong,Kontrol,jenisPeriksa,Hasil,nolot,
									tgl_tes,dicatatoleh,dicekOleh,DisahkanOleh,Metode) 
									values ('$notrans','$nktg','1','1','$ratio_hcv','$reagenhbsag',
									'$today','$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','Rapid')");
				//echo "HCV Rapid<br>";
			}
			//parameter hiv------------------------------
			$metode=$_POST['hiv_metode'];
			//echo "HIV $metode<br>";
			if ($metode=='elisa') {
				$tambah_sql="insert into hasilelisa ( noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa,
							dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode)
							values ('$nktg','$ratio_hiv','$hiv_cut_off','$hasil_hiv','$notrans','2','$today',
							'$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','$reagenhiv','elisa')";
				$tambah=mysql_query($tambah_sql);
				//echo "HIV Elisa<br>";
			} else {
				$tambah=mysql_query("insert into drapidtest (NoTrans,noKantong,Kontrol,jenisPeriksa,Hasil,nolot,
									tgl_tes,dicatatoleh,dicekOleh,DisahkanOleh,Metode) 
									values ('$notrans','$nktg','1','2','$ratio_hiv','$reagenhbsag',
									'$today','$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','Rapid')");
				//echo "HIV Rapid<br>";
			}
			//parameter syp------------------------------
			$metode=$_POST['syp_metode'];
			if ($metode=='elisa') {
				$tambah_sql="insert into hasilelisa ( noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa,
							dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode)
							values ('$nktg','$ratio_syp','$syp_cut_off','$hasil_syp','$notrans','3','$today',
							'$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','$reagensyp','elisa')";
				$tambah=mysql_query($tambah_sql);
				//echo "Syphilis Elisa : $tambah_sql <br>";
			} else {
				$tambah=mysql_query("insert into drapidtest (NoTrans,noKantong,Kontrol,jenisPeriksa,Hasil,nolot,
									tgl_tes,dicatatoleh,dicekOleh,DisahkanOleh,Metode) 
									values ('$notrans','$nktg','1','3','$ratio_syp','$reagenhbsag',
									'$today','$namalengkap','$_POST[dicek_oleh]','$_POST[disahkan_oleh]','Rapid')");
				//echo "Syphilis Rapid<br>";
			}
			//end of insert to elisa atau rapid==========
		
			//Check di table elisa dan rapid memastikan semua parameter sudah diperiksa
			//untuk status kantong dan status cekal donor
			$nrapid1=mysql_num_rows(mysql_query("select nokantong from drapidtest where nokantong='$nktg'"));
			$nelisa1=mysql_num_rows(mysql_query("select noKantong from hasilelisa where noKantong='$nktg'"));
			if (($nrapid1+$nelisa1)=='4') {
				//Cari ID Pendonor
				//echo "Nrapid+nelisa=4<br>";
				$pendonor=mysql_query("select ht.kodePendonor as kp, st.gol_darah as gd from htransaksi as ht,stokkantong as st
								where ht.NoKantong='$nktg' and st.noKantong='$nktg'");
				$datapendonor=mysql_fetch_assoc($pendonor);
				$idpendonor=$datapendonor[kp];
				//echo "Kode Pendonor : $idpendonor<br>";
				
				//Mencari jumlah kantong satelite--------
				$no_kantong0=substr($nktg,0,-1);
				$q_jum_komponen=mysql_query("select NoKantong from stokkantong where NoKantong like '%$no_kantong0%'");
				$jum_komponen=mysql_num_rows($q_jum_komponen);
				//echo "Jumlah Komponen : $jum_komponen<br>";
				 
				//Memastikan tidak ada hasil positif-----
				$sqlupd=mysql_query("UPDATE htransaksi SET status_test='0' where NoKantong='$nktg'");
				$nrapid=mysql_num_rows(mysql_query("select * from drapidtest where nokantong='$nktg' and Hasil='0'"));
				$nelisa=mysql_num_rows(mysql_query("select * from hasilelisa where noKantong='$nktg' and Hasil='1'"));
				$nelisagz=mysql_num_rows(mysql_query("select * from hasilelisa where noKantong='$nktg' and Hasil='2'"));
				//Semua hasil negatif--------------------
				if ($nrapid==0 and $nelisa==0){
					//echo "nrapid=0 nelisa=0<br>";
					if ($nelisagz==0){ //Tidak ada greyzone & semua negatif
						$nsehat++;
						//echo "Kantong Sehat $nsehat<br>";
						$upd_donor_sehat=mysql_query("UPDATE pendonor SET Cekal='0' where Kode='$idpendonor'");	//bebas cekal
						//Sehatkan semua kantong kecuali yang rusak oleh komponen
						if ($jum_komponen>0){
							$qry_update_kantong="UPDATE stokkantong set Status='2', hasil='2',tglpengolahan=tgl_Aftap, tglperiksa='$today',ident='m'
									where NoKantong like '$no_kantong0%' and (Status='0' or Status='1')";
							$upd_kantong=mysql_query($qry_update_kantong);
							$jmlkantongsehatdiproses++;
							//echo "$no_kantong0 sehat<br>";
						} else {
							$upd_kantong=mysql_query("UPDATE stokkantong set Status='2',hasil='2',tglpengolahan=tgl_Aftap,tglperiksa='$today',ident='m'
									where NoKantong='$nktg'");
							$jmlkantongsehatdiproses++;
							//echo "$no_kantong sehat<br>";
						}
						
					} else { //ada grey zone-------------
						$ngz++;
						//echo "Ada greyzone<br>";
					}
				} else{ //Darah rusak / ada salah satu yang reaktif
					//update donor cekal-----------------
					//echo "Kantong Rusak<br>";
					$upd_donor_cekal=mysql_query("UPDATE pendonor SET Cekal='1' WHERE Kode='$idpendonor'");
					//insert ke table cekal
					$tambah_cekal=mysql_query("insert into cekal ('$idpendonor','$today','$_SESSION[namauser]','1')");
					$nrusak++;
					if ($jum_komponen>0) {
						$upd_kantong_rusak=mysql_query("UPDATE stokkantong set Status='4',hasil='4', tglpengolahan=tgl_Aftap, tglperiksa='$today',ident='m'
									where NoKantong like '$no_kantong0%'");
						$jmlkantongrusakdiproses++;
					} else {
						$upd_kantong_rusak=mysql_query("UPDATE stokkantong set Status='4',hasil='4',tglpengolahan=tgl_Aftap,tglperiksa='$today',ident='m'
										  where NoKantong='$nktg'");
						$jmlkantongrusakdiproses++;
					}
					
				}
			}
			//Proses di temporary --> flag sudah di proses
			$proses=mysql_query("update imltd_import_temp set sudah_proses='1' where (nokantong='$nktg')");
			//echo "Update status sudah diproses<br>";
		}
		
	}
	$msg=$msg." "."Jumlah kantong diproses :"?><br><?;
	$msg=$msg." "."Kantong Sehat (".$jmlkantongsehatdiproses."), ";
	$msg=$msg." "."Kantong Rusak (".$jmlkantongrusakdiproses."), ";
	$msg=$msg." "."Kantong Grayzone (".$ngz.")";
	echo "<SCRIPT>alert('$msg');</SCRIPT>";
	?><META http-equiv="refresh" content="0; url=pmiimltd.php?module=import_davinci"><?
} else if (isset($_POST['manualhbsag']))  {
	$jmlsample=$_POST['jumlahtotal'];
	$URL="pmiimltd.php?module=import_davincimanual&parameter=hbsag&jmlperiksa=+$jmlsample";
	header("Location: $URL");
} else if (isset($_POST['manualhcv']))  {
	$jmlsample=$_POST['jumlahtotal'];
	$URL="pmiimltd.php?module=import_davincimanual&parameter=hcv&jmlperiksa=+$jmlsample";
	header("Location: $URL");
}else if (isset($_POST['manualhiv']))  {
	$jmlsample=$_POST['jumlahtotal'];
	$URL="pmiimltd.php?module=import_davincimanual&parameter=hiv&jmlperiksa=$jmlsample";
	header("Location: $URL");
}else if (isset($_POST['manualsyp']))  {
	$jmlsample=$_POST['jumlahtotal'];
	$URL="pmiimltd.php?module=import_davincimanual&parameter=syp&jmlperiksa=$jmlsample";
	header("Location: $URL");
}

?>
	<?
	$param_all=1;
	$hasil=mysql_query("SELECT * from imltd_import_temp order by id");
	$c=mysql_fetch_assoc($hasil);
	$co_hbsag=0.000;
	$co_hcv=0.000;
	$co_hiv=0.000;
	$co_syp=0.000;
	$valid="-";
	if (strlen($c[hbsag_metode])==0){$param_all=0;}
	if (strlen($c[hcv_metode])==0){$param_all=0;}
	if (strlen($c[hiv_metode])==0){$param_all=0;}
	if (strlen($c[syp_metode])==0){$param_all=0;}
	?>
	<font size=5 color="blue"><b>KONFIRMASI PROSES HASIL bioM&eacuterieux Da Vinci Quatro</b></font><br>
	<a name="atas"></a>
	<a href="#bawah" class="swn_button_blue">Ke bawah</a>
	<form name="konfirmasi_import" id="konfirmasi_import" align="left" method="post">
		<table class="list" id="box-hasil" border="0" cellpadding="3" cellspacing="1">
			<tr class="field">
				<th colspan=2>PARAMETER</th>
				<th colspan=3>HBsAG-<?=$c[hbsag_metode]?></th><input type="hidden" name="hbsag_metode" value=<?=$c[hbsag_metode]?>>
				<th colspan=3>Anti-HCV-<?=$c[hcv_metode]?></th><input type="hidden" name="hcv_metode" value=<?=$c[hcv_metode]?>>
				<th colspan=3>Anti-HIV-<?=$c[hiv_metode]?></th><input type="hidden" name="hiv_metode" value=<?=$c[hiv_metode]?>>
				<th colspan=3>Syphilis-<?=$c[syp_metode]?></th><input type="hidden" name="syp_metode" value=<?=$c[syp_metode]?>>
				<th rowspan=4><b>Status<br>kantong</b></th>
				<th rowspan=4><b>Status<br>Proses</b></th>
			</tr>
			<tr class="field">
				<th colspan=2>Reagensia</th>
				<th colspan=3><?
					if ($c[reagen_hbsag]==""){?> 
						<input type="submit" name="manualhbsag" value="Manual" class="swn_button_green" title="Entry hasil manual Parameter HBsAg">
					<?} else {?>
						<?=$c[reagen_hbsag]?></th><input type="hidden" name="reagen_hbsag" value=<?=$c[reagen_hbsag]?>>
					<?}?>
				<th colspan=3><?
					if ($c[reagen_hcv]==""){?>
						<input type="submit" name="manualhcv" value="Manual" class="swn_button_green" title="Entry hasil manual Parameter Anti-HCV">
					<?} else {?>
						<?=$c[reagen_hcv]?></th><input type="hidden" name="reagen_hcv" value=<?=$c[reagen_hcv]?>>
					<?}?>
				<th colspan=3><?
					if ($c[reagen_hiv]==""){?>
						<input type="submit" name="manualhiv" value="Manual" class="swn_button_green" title="Entry hasil manual Parameter Anti-HIV">
					<?} else {?>
						<?=$c[reagen_hiv]?></th><input type="hidden" name="reagen_hiv" value=<?=$c[reagen_hiv]?>>
					<?}?>
				<th colspan=3><?
					if ($c[reagen_syp]==""){?>
						<input type="submit" name="manualsyp" value="Manual" class="swn_button_green" title="Entry hasil manual Parameter Syphilis">
					<?} else {?>
						<?=$c[reagen_syp]?></th><input type="hidden" name="reagen_syp" value=<?=$c[reagen_syp]?>>
					<?}?>
			</tr>
			<tr class="field">
				<th rowspan=2 align="center"><b>No</b></th>
				<th rowspan=2><b>No. Kantong</b></th>
				<th colspan=3><b>Cut-off : <?=$c[hbsag_cut_off]?></b></th><input type="hidden" name="hbsag_cut_off" value=<?=$c[hbsag_cut_off]?>>
				<th colspan=3><b>Cut-off : <?=$c[hcv_cut_off]?> </b></th><input type="hidden" name="hcv_cut_off" value=<?=$c[hcv_cut_off]?>>
				<th colspan=3><b>Cut-off : <?=$c[hiv_cut_off]?> </b></th><input type="hidden" name="hiv_cut_off" value=<?=$c[hiv_cut_off]?>>
				<th colspan=3><b>Cut-off : <?=$c[syp_cut_off]?> </b></th><input type="hidden" name="syp_cut_off" value=<?=$c[syp_cut_off]?>>
				
			</tr>
			<tr class="field">
				<th><b>Abs</b></th>
				<th><b>Ratio</b></th>
				<th><b>Hasil</b></th>
				<th><b>Abs</b></th>
				<th><b>Ratio</b></th>
				<th><b>Hasil</b></th>
				<th><b>Abs</b></th>
				<th><b>Ratio</b></th>
				<th><b>Hasil</b></th>
				<th><b>Abs</b></th>
				<th><b>Ratio</b></th>
				<th><b>Hasil</b></th>
			</tr>
			<input type="hidden" name="jumlah" value="<?=mysql_num_rows($hasil)?>"> <?
	$no=1;
	
	$hasil0=mysql_query("SELECT * from imltd_import_temp order by id");
	$jmldata=mysql_fetch_array($hasil0);
	if ($jmldata<=0){
		echo "<tr class='record'><td colspan=16>
					<b>BELUM ADA DATA YANG DIIMPORT</b>
					<br>Silahkan import hasil terlebih dahulu!!</td></tr>";
	}
	$hasil=mysql_query("SELECT * from imltd_import_temp order by id");
	while($baris=mysql_fetch_assoc($hasil)){
			//Check status kantong
			$cek_ktg=mysql_query("select Status, sah from stokkantong where noKantong='$baris[nokantong]'");
			$c_ktg=mysql_fetch_assoc($cek_ktg);
			$status_ktg=$c_ktg['Status'];
			$kantong_sah=$c_ktg['sah'];
			switch ($status_ktg){
				case '0' : $statuskantong='Kosong('.$status_ktg.')';break;
				case '1' :
						if ($c_ktg['sah']=="1"){
							$statuskantong='Karantina('.$status_ktg.')';
						} else{
							$statuskantong='Belum disahkan('.$status_ktg.')';
						}
						break;
				case '2' : $statuskantong='Sehat('.$status_ktg.')';break;
				case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
				case '4' : $statuskantong='Rusak-reaktif('.$status_ktg.')';break;
				case '5' : $statuskantong='Rusak-gagal('.$status_ktg.')';break;
				default : $statuskantong='Tidak ada('.$status_ktg.')';
			}
			?>
			<tr class="record">
				<td>
					<?
					if (($status_ktg=='1') and ($kantong_sah=='1')){
						$jmldiproses++;
						?>
						<div align="right"><font size="2"><?=$no?>.<input type=checkbox name=pilih[] checked="checked" value="<?=$baris[nokantong]?>"></div>
					<?}else{?>
						<div align="right"><font size="2"><?=$no?>.<input type=checkbox name=pilih[]  disabled="disabled" value="<?=$baris[nokantong]?>"></div>	
					<?}?>
				</td>
				<td>
					<input type="hidden" size=10 name=kantong[] value=<?=$baris[nokantong]?>>
					<?=$baris[nokantong]?>
				</td>
				<td>
					<input type="hidden" name=hbsag_reader[] value=<?=$baris[hbsag_reader]?>>
					<?=$baris[hbsag_reader]?>
				</td>
				<td>
					<input type="hidden" name=hbsag_od[] value=<?=$baris[hbsag_od]?>>
					<?=$baris[hbsag_od]?>
				</td>
				<?
				if ($baris[hbsag_result]=="Non Reaktif"){
					?><td><?=$baris[hbsag_result]?></td><input type="hidden" name=hbsag_result[] value="0"><?
				}else if ($baris[hbsag_result]=="Reaktif") {
					?><td><b><?=$baris[hbsag_result]?></b></td><input type="hidden" name=hbsag_result[] value="1"><?
				}else {
					?><td><?=$baris[hbsag_result]?></td><input type="hidden" name=hbsag_result[] value="2"><?
				}?>
				
				<td>
					<input type="hidden" name=hcv_reader[] value=<?=$baris[hcv_reader]?>>
					<?=$baris[hcv_reader]?>
				</td>
				<td>
					<input type="hidden" name=hcv_od[] value=<?=$baris[hcv_od]?>>
					<?=$baris[hcv_od]?>
				</td>
				<?
				if ($baris[hcv_result]=="Non Reaktif"){
					?><td><?=$baris[hcv_result]?></td><input type="hidden" name=hcv_result[] value="0"><?
				}else if ($baris[hcv_result]=="Reaktif") {
					?><td><b><?=$baris[hcv_result]?></b></td><input type="hidden" name=hcv_result[] value="1"><?
				}else {
					?><td><?=$baris[hcv_result]?></td><input type="hidden" name=hcv_result[] value="2"><?
				}?>
				<td>
					<input type="hidden" name=hiv_reader[] value=<?=$baris[hiv_reader]?>>
					<?=$baris[hiv_reader]?>
				</td>
				<td>
					<input type="hidden" name=hiv_od[] value=<?=$baris[hiv_od]?>>
					<?=$baris[hiv_od]?>
				</td>
				<?
				if ($baris[hiv_result]=="Non Reaktif"){
					?><td><?=$baris[hiv_result]?></td><input type="hidden" name=hiv_result[] value="0"><?
				}else if ($baris[hiv_result]=="Reaktif") {
					?><td><b><?=$baris[hiv_result]?></b></td><input type="hidden" name=hiv_result[] value="1"><?
				}else {
					?><td><?=$baris[hiv_result]?></td><input type="hidden" name=hiv_result[] value="2"><?
				}?>
				<td>
					<input type="hidden" name=syp_reader[] value=<?=$baris[syp_reader]?>>
					<?=$baris[syp_reader]?>
				</td>
				<td>
					<input type="hidden" name=syp_od[] value=<?=$baris[syp_od]?>>
					<?=$baris[syp_od]?>
				</td>
				<?
				if ($baris[syp_result]=="Non Reaktif"){
					?><td><?=$baris[syp_result]?></td><input type="hidden" name=syp_result[] value="0"><?
				}else if ($baris[syp_result]=="Reaktif") {
					?><td><b><?=$baris[syp_result]?></b></td><input type="hidden" name=syp_result[] value="1"><?
				}else {
					?><td><?=$baris[syp_result]?></td><input type="hidden" name=syp_result[] value="2"><?
				}?>
				<td>
					<?=$statuskantong?>
					<input type="hidden" name=status_kantong[] value=<?=$status_ktg?>>
				</td>
				<?
				if ($baris[sudah_proses]=="0"){
					?><td>-</td><?
				}else{
					?><td><b>Sudah</b></td><?
				}?><input type="hidden" name=sudah_proses[] value=<?=$baris[sudah_proses]?>>
			</tr>
		<?
		$no++;$jmlperiksa++;
	} ?><input type="hidden" name="jumlahtotal" value=<?=$no-1?>>
	<tr class="field">
		<td colspan="2" align="left">Dicatat Oleh </td>
		<input type="hidden" name="namalengkap" value=<?=$namalengkap?>>
		<td colspan="14" align="left"> <?echo $namalengkap;?></td>
	</tr>
	<tr class="field">
		<td colspan="2" align="left">Dicek Oleh</td>
		<td colspan="14" align="left"> 
			<select name="dicek_oleh" > <?
			$user1="select * from user where nama_lengkap not like '%$namalengkap%' order by nama_lengkap";
               $do1=mysql_query($user1);
			while($data1=mysql_fetch_assoc($do1)) {
				$select1=""; ?>
				<option value="<?=$data1[nama_lengkap]?>"<?=$select1?>><?=$data1[nama_lengkap]?></option><?
			}?>
			</select>
		</td>
	</tr>
	<tr class="field">
		<td colspan="2" align="left">Disahkan Oleh</td>
		<td colspan="14" align="left">
			<select name="disahkan_oleh" > <?
				$user="select * from dokter_periksa order by Nama";
				$do=mysql_query($user);
				while($data=mysql_fetch_assoc($do)) {
					$select=""; ?>
					<option value="<?=$data[Nama]?>"<?=$select?>><?=$data[Nama]?></option>
				<? } ?>
			</select>
		</td>
	</tr>
</table>
		<font size=2"><b>Catatan :</b>
		<ol>
			<li>Kantong darah yang diproses adalah kantong dengan Status : <b>Karantina</b> (1), sudah di<b><u>sah</b></u>kan serta semua parameter sudah terisi.</li>
			<li>Kantong darah yang akan diproses adalah kantong yang ditandai dengan tanda centang (check) di belakang nomor urut.</li>
			<li>Jumlah kantong yang akan diproses : <b><?=$jmldiproses?></b> kantong dari <b><?=$no-1?></b> kantong yang diimport.</li>
			<li>Terhadap parameter yang belum/tidak diimpor, bisa dimasukkan dalam '<b>Manual input</b>'.</li>
			<li>Proses status : kantong sudah pernah diproses atau belum.</li>
		</ol>
		</font>
		<a href="pmiimltd.php?module=import_davinci"class="swn_button" title="Kembali ke menu bioM&eacuterieux">Kembali ke awal</a>
		<?if ($param_all==1){?>
			<a href="javascript:window.print()" class="swn_button" title="Cetak ke printer">Cetak</a>
			<input type="submit" name="Button" value="Proses Import IMLTD" title="Proses kantong" class="swn_button">	<?
		}else{?>
			<font size=2"><b>Proses Import IMLTD belum bisa dilanjutkan (Parameter IMLTD belum lengkap)</b>
			<?
		}?>
		<a href="#atas" class="swn_button_blue">Ke Atas</a>
		<a name="bawah"></a>		
</form>
</body>
