<?php
include ("/var/www/simudda/config/db_connect.php");
$tanggal=date("Y-m-d");
$sqlconfig=mysql_fetch_assoc(mysql_query("select * from db_server limit 1", $con));
$sqludd=mysql_fetch_assoc(mysql_query("select * from utd where aktif=1", $con));
$server_usr=$sqlconfig['user'];
$server_ip=$sqlconfig['ip'];
$server_db=$sqlconfig['db'];
$server_pwd=$sqlconfig['password'];
$id_udd=$sqludd['id'];
$namaproduk[]='';
$namalengkap[]='';
$no=0;

$prod=mysql_query("select * from produk order by no",$con);
while ($produk1=mysql_fetch_assoc($prod)) {
    $no++;
    $namaproduk[$no]=$produk1[Nama]; $namalengkap[$no]=$produk1[lengkap];
    $A=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='A' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $sosA=mysql_query("select sosA from produk where Nama='$produk1[Nama]'");
    $sos1A=mysql_fetch_assoc($sosA);$Ap[$no]= $A-$sos1A[sosA]; if ($Ap[$no]<1) $Ap[$no]='0';
    $B=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='B' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $sosB=mysql_query("select sosB from produk where Nama='$produk1[Nama]'");
    $sos1B=mysql_fetch_assoc($sosB);$Bp[$no]= $B-$sos1B[sosB]; if ($Bp[$no]<1) $Bp[$no]='0';
    $AB=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='AB' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $sosAB=mysql_query("select sosAB from produk where Nama='$produk1[Nama]'");
    $sos1AB=mysql_fetch_assoc($sosAB);$ABp[$no]= $AB-$sos1AB[sosAB]; if ($ABp[$no]<1) $ABp[$no]='0';
    $O=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='O' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $sosO=mysql_query("select sosO from produk where Nama='$produk1[Nama]'");
    $sos1O=mysql_fetch_assoc($sosO);$Op[$no]= $O-$sos1O[sosO]; if ($Op[$no]<1) $Op[$no]='0';
    $A=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='A' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $An[$no]=$A;  if ($An[$no]<1) $An[$no]='0';
    $B=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='B' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $Bn[$no]=$B;  if ($Bn[$no]<1) $Bn[$no]='0';
    $AB=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='AB' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $ABn[$no]=$AB;  if ($ABn[$no]<1) $ABn[$no]='0';
    $O=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='O' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $On[$no]=$O;  if ($On[$no]<1) $On[$no]='0';
}  
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
$no=0;
$sqlharian="SELECT left(htransaksi.NoTrans,1) as jenis, 
	pendonor.Jk,htransaksi.JenisDonor,pendonor.GolDarah,pendonor.Rhesus,htransaksi.kendaraan,
	count(htransaksi.KodePendonor) as jumlah
	from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
    where 	date(htransaksi.Tgl)=current_date and (htransaksi.Pengambilan ='0' or  htransaksi.Pengambilan ='1' or  htransaksi.Pengambilan ='2') 
    group by left(htransaksi.NoTrans,1), pendonor.Jk,htransaksi.JenisDonor,pendonor.GolDarah, pendonor.Rhesus, htransaksi.kendaraan";
$harian=mysql_query($sqlharian,$con);
while ($data=mysql_fetch_assoc($harian)) {
    if (($data[jenis])=='D'){
	if ($data[Jk]=='0'){
	    if ($data[JenisDonor]=='0'){
		switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_lk_ds_a_neg=$data[jumlah];} else {$dg_lk_ds_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_lk_ds_ab_neg=$data[jumlah];} else {$dg_lk_ds_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_lk_ds_b_neg=$data[jumlah];} else {$dg_lk_ds_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_lk_ds_o_neg=$data[jumlah];} else {$dg_lk_ds_o_pos=$data[jumlah];} break;}
	    } else {switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_lk_dp_a_neg=$data[jumlah];} else {$dg_lk_dp_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_lk_dp_ab_neg=$data[jumlah];} else {$dg_lk_dp_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_lk_dp_b_neg=$data[jumlah];} else {$dg_lk_dp_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_lk_dp_o_neg=$data[jumlah];} else {$dg_lk_dp_o_pos=$data[jumlah];} break;}}
	} else { if ($data[JenisDonor]=='0'){
		switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_pr_ds_a_neg=$data[jumlah];} else  {$dg_pr_ds_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_pr_ds_ab_neg=$data[jumlah];} else {$dg_pr_ds_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_pr_ds_b_neg=$data[jumlah];} else {$dg_pr_ds_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_pr_ds_o_neg=$data[jumlah];} else {$dg_pr_ds_o_pos=$data[jumlah];} break;}
	    } else { switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_pr_dp_a_neg=$data[jumlah];} else {$dg_pr_dp_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_pr_dp_ab_neg=$data[jumlah];} else {$dg_pr_dp_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_pr_dp_b_neg=$data[jumlah];} else {$dg_pr_dp_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_pr_dp_o_neg=$data[jumlah];} else {$dg_pr_dp_o_pos=$data[jumlah];} break;}}
	}} else {if ($data[Jk]=='0'){if ($data[Rhesus]=='+'){
		switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_lk_ds_a_pos_bus=$data[jumlah];} else {$mu_lk_ds_a_pos_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_lk_ds_ab_pos_bus=$data[jumlah];} else {$mu_lk_ds_ab_pos_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_lk_ds_b_pos_bus=$data[jumlah];} else {$mu_lk_ds_b_pos_nbus=$data[jumlah];} break; 
		    case 'O' : if ($data[kendaraan]=='0'){$mu_lk_ds_o_pos_bus=$data[jumlah];} else {$mu_lk_ds_o_pos_nbus=$data[jumlah];} break;
		}} else{switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_lk_ds_a_neg_bus=$data[jumlah];} else {$mu_lk_ds_a_neg_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_lk_ds_ab_neg_bus=$data[jumlah];} else  {$mu_lk_ds_ab_neg_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_lk_ds_b_neg_bus=$data[jumlah];} else {$mu_lk_ds_b_neg_nbus=$data[jumlah];} break;
		    case 'O' : if ($data[kendaraan]=='0'){$mu_lk_ds_o_neg_bus=$data[jumlah];} else {$mu_lk_ds_o_neg_nbus=$data[jumlah];} break;
		}}} else {if ($data[Rhesus]=='+'){
		switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_pr_ds_a_pos_bus=$data[jumlah];} else {$mu_pr_ds_a_pos_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_pr_ds_ab_pos_bus=$data[jumlah];} else {$mu_pr_ds_ab_pos_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_pr_ds_b_pos_bus=$data[jumlah];} else {$mu_pr_ds_b_pos_nbus=$data[jumlah];} break; 
		    case 'O' : if ($data[kendaraan]=='0'){$mu_pr_ds_o_pos_bus=$data[jumlah];} else {$mu_pr_ds_o_pos_nbus=$data[jumlah];} break;
		}} else{switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_pr_ds_a_neg_bus=$data[jumlah];} else {$mu_pr_ds_a_neg_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_pr_ds_ab_neg_bus=$data[jumlah];} else  {$mu_pr_ds_ab_neg_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_pr_ds_b_neg_bus=$data[jumlah];} else {$mu_pr_ds_b_neg_nbus=$data[jumlah];} break;
		    case 'O' : if ($data[kendaraan]=='0'){$mu_pr_ds_o_neg_bus=$data[jumlah];} else {$mu_pr_ds_o_neg_nbus=$data[jumlah];} break;}}}}}

$sqlpendonor=mysql_query("SELECT Jk, GolDarah, Rhesus, count(Kode) As jumlah From pendonor group by JK, GolDarah, Rhesus",$con);
while ($sqlpendonor1=mysql_fetch_assoc($sqlpendonor)) {
    switch ($sqlpendonor1[Jk]){
	case '0':
		switch ($sqlpendonor1[GolDarah]){
		    case 'A': if ($sqlpendonor1[Rhesus]=='+'){$lk_Apos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$lk_Aneg=$sqlpendonor1[jumlah];}break;
		    case 'AB':if ($sqlpendonor1[Rhesus]=='+'){$lk_ABpos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$lk_ABneg=$sqlpendonor1[jumlah];}break;
		    case 'B': if ($sqlpendonor1[Rhesus]=='+'){$lk_Bpos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$lk_Bneg=$sqlpendonor1[jumlah];}break;
		    case 'O': if ($sqlpendonor1[Rhesus]=='+'){$lk_Opos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$lk_Oneg=$sqlpendonor1[jumlah];}break;}
	case '1':
		switch ($sqlpendonor1[GolDarah]){
		    case 'A': if ($sqlpendonor1[Rhesus]=='+'){$pr_Apos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$pr_Aneg=$sqlpendonor1[jumlah];}break;
		    case 'AB':if ($sqlpendonor1[Rhesus]=='+'){$pr_ABpos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$pr_ABneg=$sqlpendonor1[jumlah];}break;
		    case 'B': if ($sqlpendonor1[Rhesus]=='+'){$pr_Bpos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$pr_Bneg=$sqlpendonor1[jumlah];}break;
		    case 'O': if ($sqlpendonor1[Rhesus]=='+'){$pr_Opos=$sqlpendonor1[jumlah];}if ($sqlpendonor1[Rhesus]=='-'){$pr_Oneg=$sqlpendonor1[jumlah];}}}}
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor<10", $con));$Jum1=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=10 and JumDonor<25", $con));$Jum10=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=25 and JumDonor<50", $con));$Jum25=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=50 and JumDonor<75", $con));$Jum50=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=75 and JumDonor<100", $con));$Jum75=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=100", $con));$Jum100=$jum[jumlah];
$squmur=mysql_fetch_assoc(mysql_query("SELECT  SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) <30,1,0)) as 'umur17_30',SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) BETWEEN 31 and 40,1,0)) as 'umur31_40',
SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) BETWEEN 41 and 50,1,0)) as 'umur41_50',SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) BETWEEN 51 and 60,1,0)) as 'umur51_60',
    SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) >60,1,0)) as 'umur60_lebih'FROM pendonor",$con));
$umur17_30 =$squmur[umur17_30];$umur31_40 =$squmur[umur31_40];$umur41_50 =$squmur[umur41_50];$umur51_60 =$squmur[umur51_60];$umur60_lebih =$squmur[umur60_lebih];

$con_pmipusat=mysql_connect($server_ip,$server_usr,$server_pwd);	
mysql_select_db($server_db);
if (!$con_pmipusat){exit;}
for ($i=1;$i<count($namaproduk);$i++) {
	   $chkserver=mysql_fetch_assoc(mysql_query("select udd from stokdarah where udd='$id_udd' and produk='$namaproduk[$i]'", $con_pmipusat));
	   if ($chkserver[udd]==$id_udd) {$updserver=("UPDATE stokdarah SET nama='$namalengkap[$i]',a_pos  = '$Ap[$i]', b_pos  = '$Bp[$i]', o_pos  = '$Op[$i]', ab_pos = '$ABp[$i]', a_neg  = '$An[$i]',
		b_neg  = '$Bn[$i]', o_neg  = '$On[$i]', ab_neg = '$ABn[$i]', update_on=current_timestamp WHERE udd = '$id_udd' AND produk='$namaproduk[$i]'");
		$updserver1=mysql_query($updserver,$con_pmipusat);
		} else {$addserver=("INSERT INTO stokdarah (udd, produk, nama, a_pos, b_pos, o_pos, ab_pos, a_neg, b_neg, o_neg, ab_neg, ket, update_on)
			VALUES ('$id_udd', '$namaproduk[$i]', '$namalengkap[$i]','$Ap[$i]','$Bp[$i]','$Op[$i]','$ABp[$i]','$An[$i]','$Bn[$i]','$On[$i]','$ABn[$i]','', current_timestamp)");
		$addserver1=mysql_query($addserver,$con_pmipusat);}}
for ($i=1;$i<count($NoTrans)+1;$i++){
		$chkserver=mysql_fetch_assoc(mysql_query("select udd from kegiatan where udd='$id_udd' and NoTrans='$NoTrans[$i]'", $con_pmipusat));
		if ($chkserver[udd]==$id_udd){$updserver="UPDATE kegiatan set instansi='$instansi[$i]', alamat='$alamat[$i]', TglPenjadwalan='$TglPenjadwalan[$i]', jumlah='$jumlah[$i]',
		lat='$lat[$i]', lng='$lng[$i]', bus='$bus[$i]', update_on=current_timestamp WHERE NoTrans='$NoTrans[$i]' AND udd='$id_udd[$i]'";
		$updserver1=mysql_query($updserver,$con_pmipusat);
		}else{$addserver="INSERT INTO kegiatan (NoTrans, udd, instansi, alamat, TglPenjadwalan, jumlah, lat, lng, kendaraan, update_on)
		VALUES ('$NoTrans[$i]','$udd[$i]','$instansi[$i]','$alamat[$i]','$TglPenjadwalan[$i]','$jumlah[$i]','$lat[$i]','$lng[$i]','$kendaraan[$i]', current_timestamp)";
		$addserver1=mysql_query($addserver,$con_pmipusat);}}

$chkserver=mysql_fetch_assoc(mysql_query("select udd from transaksi where udd='$id_udd' and date(tanggal)=current_date", $con_pmipusat));
	if ($chkserver[udd]==$id_udd){
		$updserver=" UPDATE transaksi SET dg_lk_dp_a_pos  ='$dg_lk_dp_a_pos', dg_lk_dp_ab_pos ='$dg_lk_dp_ab_pos', dg_lk_dp_b_pos  ='$dg_lk_dp_b_pos',
			dg_lk_dp_o_pos  ='$dg_lk_dp_o_pos', dg_lk_dp_a_neg  ='$dg_lk_dp_a_neg', dg_lk_dp_ab_neg ='$dg_lk_dp_ab_neg', dg_lk_dp_b_neg  ='$dg_lk_dp_b_neg',
			dg_lk_dp_o_neg  ='$dg_lk_dp_o_neg', dg_lk_ds_a_pos  ='$dg_lk_ds_a_pos', dg_lk_ds_ab_pos ='$dg_lk_ds_ab_pos', dg_lk_ds_b_pos  ='$dg_lk_ds_b_pos',
			dg_lk_ds_o_pos  ='$dg_lk_ds_o_pos', dg_lk_ds_a_neg  ='$dg_lk_ds_a_neg', dg_lk_ds_ab_neg ='$dg_lk_ds_ab_neg', dg_lk_ds_b_neg  ='$dg_lk_ds_b_neg',
			dg_lk_ds_o_neg  ='$dg_lk_ds_o_neg', dg_pr_dp_a_pos  ='$dg_pr_dp_a_pos', dg_pr_dp_ab_pos ='$dg_pr_dp_ab_pos', dg_pr_dp_b_pos  ='$dg_pr_dp_b_pos',
			dg_pr_dp_o_pos  ='$dg_pr_dp_o_pos', dg_pr_dp_a_neg  ='$dg_pr_dp_a_neg', dg_pr_dp_ab_neg ='$dg_pr_dp_ab_neg', dg_pr_dp_b_neg  ='$dg_pr_dp_b_neg',
			dg_pr_dp_o_neg  ='$dg_pr_dp_o_neg', dg_pr_ds_a_pos  ='$dg_pr_ds_a_pos', dg_pr_ds_ab_pos ='$dg_pr_ds_ab_pos', dg_pr_ds_b_pos  ='$dg_pr_ds_b_pos',
			dg_pr_ds_o_pos  ='$dg_pr_ds_o_pos', dg_pr_ds_a_neg  ='$dg_pr_ds_a_neg', dg_pr_ds_ab_neg ='$dg_pr_ds_ab_neg', dg_pr_ds_b_neg  ='$dg_pr_ds_b_neg',
			dg_pr_ds_o_neg  ='$dg_pr_ds_o_neg', mu_lk_ds_a_pos_nbus  ='$mu_lk_ds_a_pos_nbus', mu_lk_ds_ab_pos_nbus ='$mu_lk_ds_ab_pos_nbus',
			mu_lk_ds_b_pos_nbus  ='$mu_lk_ds_b_pos_nbus', mu_lk_ds_o_pos_nbus  ='$mu_lk_ds_o_pos_nbus', mu_lk_ds_a_pos_bus   ='$mu_lk_ds_a_pos_bus',
			mu_lk_ds_ab_pos_bus  ='$mu_lk_ds_ab_pos_bus', mu_lk_ds_b_pos_bus   ='$mu_lk_ds_b_pos_bus', mu_lk_ds_o_pos_bus   ='$mu_lk_ds_o_pos_bus', 
			mu_lk_ds_a_neg_nbus  ='$mu_lk_ds_a_neg_nbus', mu_lk_ds_ab_neg_nbus ='$mu_lk_ds_ab_neg_nbus', mu_lk_ds_b_neg_nbus  ='$mu_lk_ds_b_neg_nbus',
			mu_lk_ds_o_neg_nbus  ='$mu_lk_ds_o_neg_nbus', mu_lk_ds_a_neg_bus   ='$mu_lk_ds_a_neg_bus', mu_lk_ds_ab_neg_bus  ='$mu_lk_ds_ab_neg_bus',
			mu_lk_ds_b_neg_bus   ='$mu_lk_ds_b_neg_bus', mu_lk_ds_o_neg_bus   ='$mu_lk_ds_o_neg_bus', mu_pr_ds_a_pos_nbus  ='$mu_pr_ds_a_pos_nbus',
			mu_pr_ds_ab_pos_nbus ='$mu_pr_ds_ab_pos_nbus', mu_pr_ds_b_pos_nbus  ='$mu_pr_ds_b_pos_nbus', mu_pr_ds_o_pos_nbus  ='$mu_pr_ds_o_pos_nbus',
			mu_pr_ds_a_pos_bus   ='$mu_pr_ds_a_pos_bus', mu_pr_ds_ab_pos_bus  ='$mu_pr_ds_ab_pos_bus', mu_pr_ds_b_pos_bus   ='$mu_pr_ds_b_pos_bus',
			mu_pr_ds_o_pos_bus   ='$mu_pr_ds_o_pos_bus', mu_pr_ds_a_neg_nbus  ='$mu_pr_ds_a_neg_nbus', mu_pr_ds_ab_neg_nbus ='$mu_pr_ds_ab_neg_nbus',
			mu_pr_ds_b_neg_nbus  ='$mu_pr_ds_b_neg_nbus', mu_pr_ds_o_neg_nbus  ='$mu_pr_ds_o_neg_nbus', mu_pr_ds_a_neg_bus   ='$mu_pr_ds_a_neg_bus',
			mu_pr_ds_ab_neg_bus  ='$mu_pr_ds_ab_neg_bus', mu_pr_ds_b_neg_bus   ='$mu_pr_ds_b_neg_bus', mu_pr_ds_o_neg_bus   ='$mu_pr_ds_o_neg_bus', update_on=current_timestamp
			WHERE udd ='$id_udd' AND date(tanggal) =current_date"; $updserver1=mysql_query($updserver,$con_pmipusat);
	}else{$addserver="INSERT INTO transaksi (udd, tanggal, dg_lk_dp_a_pos,  dg_lk_dp_ab_pos, dg_lk_dp_b_pos, dg_lk_dp_o_pos, 
			dg_lk_dp_a_neg, dg_lk_dp_ab_neg, dg_lk_dp_b_neg, dg_lk_dp_o_neg, dg_lk_ds_a_pos, dg_lk_ds_ab_pos, dg_lk_ds_b_pos, dg_lk_ds_o_pos,
			dg_lk_ds_a_neg, dg_lk_ds_ab_neg, dg_lk_ds_b_neg, dg_lk_ds_o_neg, dg_pr_dp_a_pos, dg_pr_dp_ab_pos, dg_pr_dp_b_pos, dg_pr_dp_o_pos,
			dg_pr_dp_a_neg, dg_pr_dp_ab_neg, dg_pr_dp_b_neg, dg_pr_dp_o_neg, dg_pr_ds_a_pos, dg_pr_ds_ab_pos, dg_pr_ds_b_pos, dg_pr_ds_o_pos,
			dg_pr_ds_a_neg, dg_pr_ds_ab_neg, dg_pr_ds_b_neg, dg_pr_ds_o_neg, mu_lk_ds_a_pos_nbus, mu_lk_ds_ab_pos_nbus, mu_lk_ds_b_pos_nbus, mu_lk_ds_o_pos_nbus,
			mu_lk_ds_a_pos_bus, mu_lk_ds_ab_pos_bus, mu_lk_ds_b_pos_bus, mu_lk_ds_o_pos_bus, mu_lk_ds_a_neg_nbus, mu_lk_ds_ab_neg_nbus, mu_lk_ds_b_neg_nbus, mu_lk_ds_o_neg_nbus,
			mu_lk_ds_a_neg_bus, mu_lk_ds_ab_neg_bus, mu_lk_ds_b_neg_bus, mu_lk_ds_o_neg_bus, mu_pr_ds_a_pos_nbus, mu_pr_ds_ab_pos_nbus, mu_pr_ds_b_pos_nbus, mu_pr_ds_o_pos_nbus,
			mu_pr_ds_a_pos_bus, mu_pr_ds_ab_pos_bus, mu_pr_ds_b_pos_bus, mu_pr_ds_o_pos_bus, mu_pr_ds_a_neg_nbus, mu_pr_ds_ab_neg_nbus, mu_pr_ds_b_neg_nbus, mu_pr_ds_o_neg_nbus,
			mu_pr_ds_a_neg_bus, mu_pr_ds_ab_neg_bus, mu_pr_ds_b_neg_bus, mu_pr_ds_o_neg_bus, update_on) VALUES ('$id_udd', current_date,
			'$dg_lk_dp_a_pos', '$dg_lk_dp_ab_pos', '$dg_lk_dp_b_pos', '$dg_lk_dp_o_pos', '$dg_lk_dp_a_neg', '$dg_lk_dp_ab_neg', '$dg_lk_dp_b_neg', '$dg_lk_dp_o_neg',
			'$dg_lk_ds_a_pos', '$dg_lk_ds_ab_pos', '$dg_lk_ds_b_pos', '$dg_lk_ds_o_pos', '$dg_lk_ds_a_neg', '$dg_lk_ds_ab_neg', '$dg_lk_ds_b_neg', '$dg_lk_ds_o_neg',
			'$dg_pr_dp_a_pos', '$dg_pr_dp_ab_pos', '$dg_pr_dp_b_pos', '$dg_pr_dp_o_pos', '$dg_pr_dp_a_neg', '$dg_pr_dp_ab_neg', '$dg_pr_dp_b_neg', '$dg_pr_dp_o_neg',
			'$dg_pr_ds_a_pos', '$dg_pr_ds_ab_pos', '$dg_pr_ds_b_pos', '$dg_pr_ds_o_pos', '$dg_pr_ds_a_neg', '$dg_pr_ds_ab_neg', '$dg_pr_ds_b_neg', '$dg_pr_ds_o_neg',
			'$mu_lk_ds_a_pos_nbus', '$mu_lk_ds_ab_pos_nbus', '$mu_lk_ds_b_pos_nbus', '$mu_lk_ds_o_pos_nbus', '$mu_lk_ds_a_pos_bus', '$mu_lk_ds_ab_pos_bus', '$mu_lk_ds_b_pos_bus', '$mu_lk_ds_o_pos_bus',
			'$mu_lk_ds_a_neg_nbus', '$mu_lk_ds_ab_neg_nbus', '$mu_lk_ds_b_neg_nbus', '$mu_lk_ds_o_neg_nbus', '$mu_lk_ds_a_neg_bus', '$mu_lk_ds_ab_neg_bus', '$mu_lk_ds_b_neg_bus', '$mu_lk_ds_o_neg_bus',
			'$mu_pr_ds_a_pos_nbus', '$mu_pr_ds_ab_pos_nbus', '$mu_pr_ds_b_pos_nbus', '$mu_pr_ds_o_pos_nbus', '$mu_pr_ds_a_pos_bus', '$mu_pr_ds_ab_pos_bus', '$mu_pr_ds_b_pos_bus', '$mu_pr_ds_o_pos_bus',
			'$mu_pr_ds_a_neg_nbus', '$mu_pr_ds_ab_neg_nbus', '$mu_pr_ds_b_neg_nbus', '$mu_pr_ds_o_neg_nbus', '$mu_pr_ds_a_neg_bus', '$mu_pr_ds_ab_neg_bus', '$mu_pr_ds_b_neg_bus', '$mu_pr_ds_o_neg_bus', current_timestamp)";
		$addserver1=mysql_query($addserver,$con_pmipusat);}
$chkserver=mysql_fetch_assoc(mysql_query("select udd from pendonor where udd='$id_udd'", $con_pmipusat));
	if ($chkserver[udd]==$id_udd){$updserver="UPDATE pendonor set lk_apos='$lk_Apos',lk_bpos='$lk_Bpos',lk_abpos='$lk_ABpos',lk_opos='$lk_Opos',
			lk_aneg='$lk_Aneg',lk_bneg='$lk_Bneg',lk_abneg='$lk_ABneg',lk_oneg='$lk_Oneg',
			pr_apos='$pr_Apos',pr_bpos='$pr_Bpos',pr_abpos='$pr_ABpos',pr_opos='$pr_Opos',
			pr_aneg='$pr_Aneg',pr_bneg='$pr_Bneg',pr_abneg='$pr_ABneg',pr_oneg='$pr_Oneg',
			d1='$Jum1',d10='$Jum10',d25='$Jum25',d50='$Jum50',d75='$Jum75',d100='$Jum100',
			umur17_30 ='$umur17_30',umur31_40 ='$umur31_40',umur41_50 ='$umur41_50',umur51_60 ='$umur51_60',umur60_lebih ='$umur60_lebih',
			update_on=current_timestamp WHERE udd='$id_udd'";$updserver1=mysql_query($updserver,$con_pmipusat);
	}else{$addserver="INSERT INTO pendonor (udd,lk_apos,lk_bpos,lk_abpos,lk_opos,lk_aneg,lk_bneg,lk_abneg,lk_oneg,pr_apos,
			pr_bpos,pr_abpos,pr_opos,pr_aneg,pr_bneg,pr_abneg,pr_oneg,d1,d10,d25,d50,d75,d100,
			umur17_30, umur31_40, umur41_50, umur51_60, umur60_lebih, update_on)
			VALUES ('$id_udd','$lk_Apos','$lk_Bpos','$lk_ABpos','$lk_Opos','$lk_Aneg','$lk_Bneg','$lk_ABneg','$lk_Oneg',
			'$pr_Apos','$pr_Bpos','$pr_ABpos','$pr_Opos','$pr_Aneg','$pr_Bneg','$pr_ABneg','$pr_Oneg',
			'$Jum1','$Jum10','$Jum25','$Jum50','$Jum75','$Jum100','$umur17_30', '$umur31_40', '$umur41_50', '$umur51_60', '$umur60_lebih',current_timestamp)";
		$addserver1=mysql_query($addserver,$con_pmipusat);}?>
