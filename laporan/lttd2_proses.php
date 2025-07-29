<?
include('/var/www/simudda/config/db_connect.php');
$no=0;
$jml_mu=0;
$sql="SELECT count(`NoTrans`) as jml from kegiatan where (date(`TglPelaksanaan`)>='$tanggalawal' and date(`TglPelaksanaan`)<='$tanggalakhir')";
$data0=mysql_query($sql,$con);
$data=mysql_fetch_assoc($data0);
$jml_mu=$data['jml'];
$sql="SELECT 
    case when left(htransaksi.NoTrans,1)='D' THEN 'UDD' else 'MU' END as lokasi, 
    case when htransaksi.JenisDonor='0' THEN 'DS' else 'DP' end as jenisdonor,
    pendonor.GolDarah as goldarah, pendonor.Rhesus as rh,
    case when htransaksi.Pengambilan='0' THEN 'Berhasil' ELSE 'Gagal' END as pengambilan,
    case
    when htransaksi.caraAmbil='0' THEN 'Biasa'
    when htransaksi.caraAmbil='1' THEN 'Tromboferesis'
    when htransaksi.caraAmbil='2' THEN 'Leukoferesis'
    when htransaksi.caraAmbil='3' THEN 'Plasmaferesis'
    when htransaksi.caraAmbil='4' THEN 'Eritroferesis'
    when htransaksi.caraAmbil='5' THEN 'Plebotomi' end as caraambil,
    case 
    when (stokkantong.jenis='1' and htransaksi.caraAmbil<>'0') THEN 'Apheresis'
    when stokkantong.jenis='1' THEN 'Single'
    when stokkantong.jenis='2' THEN 'Double'
    when stokkantong.jenis='3' THEN 'Triple'
    when stokkantong.jenis='4' THEN 'Quadruple'
    when stokkantong.jenis='6' THEN 'Pediatrik' END as jeniskantong,
    case 
    when stokkantong.volumeasal='450' THEN '450'
    when stokkantong.volumeasal='400' THEN '400'
    when stokkantong.volumeasal='350' THEN '350'
    else '250' END as volume,
    count(htransaksi.KodePendonor) as jumlah
    from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor inner join stokkantong on stokkantong.noKantong=htransaksi.NoKantong
    where (date(htransaksi.Tgl)>='$tanggalawal' and date(htransaksi.Tgl)<='$tanggalakhir') and (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') 
    group by left(htransaksi.NoTrans,1), htransaksi.JenisDonor, pendonor.GolDarah, pendonor.Rhesus, htransaksi.Pengambilan, htransaksi.caraAmbil, stokkantong.jenis, stokkantong.volumeasal";

$data0=mysql_query($sql,$con);
$ds_udd=0;$dp_udd=0;
$ds_mu=0;$dp_mu=0;
$tot_mu=0;
$tot_udd=0;

$udd_a_neg=0;	$udd_ab_neg=0;	$udd_b_neg=0;	$udd_o_neg=0;
$udd_a_pos=0;	$udd_ab_pos=0;	$udd_b_pos=0;	$udd_o_pos=0;
$mu_a_neg=0;	$mu_ab_neg=0;	$mu_b_neg=0;	$mu_o_neg=0;
$mu_a_pos=0;	$mu_ab_pos=0;	$mu_b_pos=0;	$mu_o_pos=0;

$tot_ds_biasa=0;
$tot_dp_biasa=0;
$tot_a_neg_biasa=0;
$tot_a_pos_biasa=0;
$tot_ab_biasa=0;
$tot_ab_biasa=0;
$tot_b_neg_biasa=0;
$tot_b_pos_biasa=0;
$tot_o_neg_biasa=0;
$tot_o_pos_biasa=0;


$tro_ds=0;	$tro_dp=0;	$tot_tro=0;
$tro_a_neg=0;	$tro_ab_neg=0;	$tro_b_neg=0;	$tro_o_neg=0;
$tro_a_pos=0;	$tro_ab_pos=0;	$tro_b_pos=0;	$tro_o_pos=0;

$leu_ds=0;	$leu_dp=0;	$tot_leu=0;
$leu_a_neg=0;	$leu_ab_neg=0;	$leu_b_neg=0;	$leu_o_neg=0;
$leu_a_pos=0;	$leu_ab_pos=0;	$leu_b_pos=0;	$leu_o_pos=0;

$plas_ds=0;	$plas_dp=0;	$tot_plas=0;
$plas_a_neg=0;	$plas_ab_neg=0;	$plas_b_neg=0;	$plas_o_neg=0;
$plas_a_pos=0;	$plas_ab_pos=0;	$plas_b_pos=0;	$plas_o_pos=0;

$eri_ds=0;	$eri_dp=0;	$tot_eri=0;
$eri_a_neg=0;	$eri_ab_neg=0;	$eri_b_neg=0;	$eri_o_neg=0;
$eri_a_pos=0;	$eri_ab_pos=0;	$eri_b_pos=0;	$eri_o_pos=0;

$tot_ds_oto=0;
$tot_dp_oto=0;
$tot_a_neg_oto=0;
$tot_a_pos_oto=0;
$tot_ab_oto=0;
$tot_ab_oto=0;
$tot_b_neg_oto=0;
$tot_b_pos_oto=0;
$tot_o_neg_oto=0;
$tot_o_pos_oto=0;


$gagal_ds=0;	$gagal_dp=0;	$tot_gagal=0;
$gagal_a_neg=0;	$gagal_ab_neg=0;	$gagal_b_neg=0;	$gagal_o_neg=0;
$gagal_a_pos=0;	$gagal_ab_pos=0;	$gagal_b_pos=0;	$gagal_o_pos=0;

$plebo_ds=0;	$plebo_dp=0;	$tot_plebo=0;
$plebo_a_neg=0;	$plebo_ab_neg=0;	$plebo_b_neg=0;	$plebo_o_neg=0;
$plebo_a_pos=0;	$plebo_ab_pos=0;	$plebo_b_pos=0;	$plebo_o_pos=0;

$tot_ds=0;
$tot_dp=0;
$tot=0;
$tot_a_neg=0;
$tot_a_pos=0;
$tot_ab=0;
$tot_ab=0;
$tot_b_neg=0;
$tot_b_pos=0;
$tot_o_neg=0;
$tot_o_pos=0;

$ktg_udd_250_s=0;
$ktg_udd_350_s=0;
$ktg_udd_350_d=0;
$ktg_udd_450_d=0;
$ktg_udd_350_t=0;
$ktg_udd_450_t=0;
$ktg_udd_350_q=0;
$ktg_udd_450_q=0;
$ktg_udd_ped=0;
$ktg_udd_aph=0;

$ktg_mu_250_s=0;
$ktg_mu_350_s=0;
$ktg_mu_350_d=0;
$ktg_mu_450_d=0;
$ktg_mu_350_t=0;
$ktg_mu_450_t=0;
$ktg_mu_350_q=0;
$ktg_mu_450_q=0;
$ktg_mu_ped=0;
$ktg_mu_aph=0;

$ktg_ll_250_s=0;
$ktg_ll_350_s=0;
$ktg_ll_350_d=0;
$ktg_ll_450_d=0;
$ktg_ll_350_t=0;
$ktg_ll_450_t=0;
$ktg_ll_350_q=0;
$ktg_ll_450_q=0;
$ktg_ll_ped=0;
$ktg_ll_aph=0;
//echo "$sql<br>";

while ($data=mysql_fetch_assoc($data0)) {
    $no++;
    if($data['jenisdonor']=='DS'){
	$tot_ds=$tot_ds + $data['jumlah'];
    }else{
	$tot_dp=$tot_dp+$data['jumlah'];
    }
    
    $tot=$tot+$data['jumlah'];
    
    if (($data['pengambilan']=='Berhasil') and ($data['caraambil']=='Biasa')){
	if($data['jenisdonor']=='DS'){
	    $tot_ds_biasa=$tot_ds_biasa + $data['jumlah'];
	}else{
	    $tot_dp_biasa=$tot_dp_biasa+$data['jumlah'];
	}
    }
    
    //UDD, Berhasil, Biasa
    if (($data['lokasi']=='UDD') and ($data['pengambilan']=='Berhasil') and ($data['caraambil']=='Biasa')){
	if($data['jenisdonor']=='DS'){
	    $ds_udd=$ds_udd + $data['jumlah'];
	    $tot_udd=$tot_udd + $data['jumlah'];
	} else {
	    $dp_udd=$dp_udd + $data['jumlah'];
	    $tot_udd=$tot_udd + $data['jumlah'];
	}
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$udd_a_pos=$udd_a_pos+$data['jumlah'];}  else{$udd_a_neg=$udd_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$udd_ab_pos=$udd_ab_pos+$data['jumlah'];} else{$udd_ab_neg=$udd_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$udd_b_pos=$udd_b_pos+$data['jumlah'];}  else{$udd_b_neg=$udd_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$udd_o_pos=$udd_o_pos+$data['jumlah'];}  else{$udd_o_neg=$udd_o_neg+$data['jumlah'];}
	}
    } //End  of UDD, Berhasil, Biasa
    //-------------------------------------
    //MU, Berhasil, Biasa
    if (($data['lokasi']=='MU') and ($data['pengambilan']=='Berhasil') and ($data['caraambil']=='Biasa')){
	if($data['jenisdonor']=='DS'){
	    $ds_mu=$ds_mu + $data['jumlah'];
	    $tot_mu=$tot_mu + $data['jumlah'];
	} else {
	    $dp_mu=$dp_mu + $data['jumlah'];
	    $tot_mu=$tot_mu + $data['jumlah'];
	}
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$mu_a_pos=$mu_a_pos+$data['jumlah'];}  else{$mu_a_neg=$mu_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$mu_ab_pos=$mu_ab_pos+$data['jumlah'];} else{$mu_ab_neg=$mu_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$mu_b_pos=$mu_b_pos+$data['jumlah'];}  else{$mu_b_neg=$mu_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$mu_o_pos=$mu_o_pos+$data['jumlah'];}  else{$mu_o_neg=$mu_o_neg+$data['jumlah'];}
	}
    } //End  of MU, Berhasil, Biasa
    //-------------------------------------
    //Tromboferesia, Berhasil
    if (($data['caraambil']=='Tromboferesis') and ($data['pengambilan']=='Berhasil')){
	if ($data['jenisdonor']=='DS'){
	    $tro_ds=$tro_ds + $data['jumlah'];
	    $tot_ds_oto=$tot_ds_oto+$data['jumlah'];
	} else {
	    $tro_dp=$tro_dp + $data['jumlah'];
	    $tot_dp_oto=$tot_dp_oto+$data['jumlah'];
	}
	$tot_tro=$tot_tro + $data['jumlah'];
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$tro_a_pos=$tro_a_pos+$data['jumlah'];}  else{$tro_a_neg=$tro_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$tro_ab_pos=$tro_b_pos+$data['jumlah'];} else{$tro_ab_neg=$tro_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$tro_b_pos=$tro_b_pos+$data['jumlah'];}  else{$tro_b_neg=$tro_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$tro_o_pos=$tro_o_pos+$data['jumlah'];}  else{$tro_o_neg=$tro_o_neg+$data['jumlah'];}
	}
    }//End  Berhasil Tromboferesis
    //-------------------------------------
    //Berhasil, Leukoferesis
    if (($data['caraambil']=='Leukoferesis') and ($data['pengambilan']=='Berhasil')){
	if ($data['jenisdonor']=='DS'){
	    $leu_ds=$leu_ds + $data['jumlah'];
	    $tot_ds_oto=$tot_ds_oto+$data['jumlah'];
	} else {
	    $leu_dp=$leu_dp + $data['jumlah'];
	    $tot_dp_oto=$tot_dp_oto+$data['jumlah'];
	}
	$tot_leu=$tot_leu + $data['jumlah'];
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$leu_a_pos=$leu_a_pos+$data['jumlah'];}  else{$leu_a_neg=$leu_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$leu_ab_pos=$leu_ab_pos+$data['jumlah'];} else{$leu_ab_neg=$leu_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$leu_b_pos=$leu_b_pos+$data['jumlah'];}  else{$leu_b_neg=$leu_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$leu_o_pos=$leu_o_pos+$data['jumlah'];}  else{$leu_o_neg=$leu_o_neg+$data['jumlah'];}
	}
    }//End  Berhasil Leukoferesis
    //-------------------------------------
    //Berhasil, Plasmaferesis
    if (($data['caraambil']=='Plasmaferesis') and ($data['pengambilan']=='Berhasil')){
	if ($data['jenisdonor']=='DS'){
	    $plas_ds=$plas_ds + $data['jumlah'];
	    $tot_ds_oto=$tot_ds_oto+$data['jumlah'];
	} else {
	    $plas_dp=$plas_dp + $data['jumlah'];
	    $tot_dp_oto=$tot_dp_oto+$data['jumlah'];
	}
	$tot_plas=$tot_plas + $data['jumlah'];
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$plas_a_pos=$plas_a_pos+$data['jumlah'];}  else{$plas_a_neg=$plas_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$plas_ab_pos=$plas_ab_pos+$data['jumlah'];} else{$plas_ab_neg=$plas_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$plas_b_pos=$plas_b_pos+$data['jumlah'];}  else{$plas_b_neg=$plas_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$plas_o_pos=$plas_o_pos+$data['jumlah'];}  else{$plas_o_neg=$plas_o_neg+$data['jumlah'];}
	}
    }//End  Berhasil Plasmaferesis
    //-------------------------------------
    //Berhasil, Eritroferesis
    if (($data['caraambil']=='Eritroferesis') and ($data['pengambilan']=='Berhasil')){
	if ($data['jenisdonor']=='DS'){
	    $eri_ds=$eri_ds + $data['jumlah'];
	    $tot_ds_oto=$tot_ds_oto+$data['jumlah'];
	} else {
	    $eri_dp=$eri_dp + $data['jumlah'];
	    $tot_dp_oto=$tot_dp_oto+$data['jumlah'];
	}
	$tot_eri=$tot_eri + $data['jumlah'];
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$eri_a_pos=$eri_a_pos+$data['jumlah'];}  else{$eri_a_neg=$eri_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$eri_ab_pos=$eri_ab_pos+$data['jumlah'];} else{$eri_ab_neg=$eri_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$eri_b_pos=$eri_b_pos+$data['jumlah'];}  else{$eri_b_neg=$eri_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$eri_o_pos=$eri_o_pos+$data['jumlah'];}  else{$eri_o_neg=$eri_o_neg+$data['jumlah'];}
	}
    }//End  Berhasil Eritroferesis
    //-------------------------------------
    //Gagal Aftap
    if ($data['pengambilan']=='Gagal'){
	if ($data['jenisdonor']=='DS'){
	    $gagal_ds=$gagal_ds+$data['jumlah'];
	} else {$gagal_dp=$gagal_dp+$data['jumlah'];}
	$tot_gagal=$tot_gagal+$data['jumlah'];
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$gagal_a_pos=$gagal_a_pos+$data['jumlah'];}  else{$gagal_a_neg=$gagal_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$gagal_ab_pos=$gagal_ab_pos+$data['jumlah'];} else{$gagal_ab_neg=$gagal_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$gagal_b_pos=$gagal_b_pos+$data['jumlah'];}  else{$gagal_b_neg=$gagal_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$gagal_o_pos=$gagal_o_pos+$data['jumlah'];}  else{$gagal_o_neg=$gagal_o_neg+$data['jumlah'];}
	}
    }// END of Aftap gagal
    //------------------------------
    //Berhasil, Plebotomi
    if (($data['caraambil']=='Plebotomi') and ($data['pengambilan']=='Berhasil')){
	if ($data['jenisdonor']='DS'){
	    $plebo_ds=$plebo_ds + $data['jumlah'];
	    $tot_ds_oto=$tot_ds_oto+$data['jumlah'];
	} else {
	    $plebo_dp=$plebo_dp + $data['jumlah'];
	    $tot_dp_oto=$tot_dp_oto+$data['jumlah'];
	}
	$tot_plebo=$tot_plebo + $data['jumlah'];
	switch ($data['goldarah']){
	    case 'A'  : if ($data['rh']=='+'){$plebo_a_pos=$plebo_a_pos+$data['jumlah'];}  else{$plebo_a_neg=$plebo_a_neg+$data['jumlah'];}break;
	    case 'AB' : if ($data['rh']=='+'){$plebo_ab_pos=$plebo_ab_pos+$data['jumlah'];} else{$plebo_ab_neg=$plebo_ab_neg+$data['jumlah'];}break;
	    case 'B'  : if ($data['rh']=='+'){$plebo_b_pos=$plebo_b_pos+$data['jumlah'];}  else{$plebo_b_neg=$plebo_b_neg+$data['jumlah'];}break;
	    default   : if ($data['rh']=='+'){$plebo_o_pos=$plebo_o_pos+$data['jumlah'];}  else{$plebo_o_neg=$plebo_o_neg+$data['jumlah'];}
	}
    }//End  Berhasil Plebotomi
    //-------------------------------------
    //Penggunaan Kantong
    if ($data['lokasi']=='UDD'){
	switch ($data['jeniskantong']){
	    case 'Single' 	: if ($data['volume']=='350'){$ktg_udd_350_s=$ktg_udd_350_s+$data['jumlah'];}
				  if ($data['volume']=='250'){$ktg_udd_250_s=$ktg_udd_250_s+$data['jumlah'];}break;
	    case 'Double' 	: if ($data['volume']=='350'){$ktg_udd_350_d=$ktg_udd_350_d+$data['jumlah'];}
				  if ($data['volume']=='450'){$ktg_udd_450_d=$ktg_udd_450_d+$data['jumlah'];}break;
	    case 'Triple' 	: if ($data['volume']=='350'){$ktg_udd_350_t=$ktg_udd_350_t+$data['jumlah'];}
				  if ($data['volume']=='450'){$ktg_udd_450_t=$ktg_udd_450_t+$data['jumlah'];}break;
	    case 'Quadruple' 	: if ($data['volume']=='350'){$ktg_udd_350_q=$ktg_udd_350_q+$data['jumlah'];}
				  if ($data['volume']=='450'){$ktg_udd_450_q=$ktg_udd_450_q+$data['jumlah'];}break;
	    case 'Pediatrik' 	: $ktg_udd_ped=$ktg_udd_ped+$data['jumlah'];break;
	    case 'Apheresis'	: $ktg_udd_aph=$ktg_udd_aph+$data['jumlah'];break;
	}
    } else {
	switch ($data['jeniskantong']){
	    case 'Single' 	: if ($data['volume']=='350'){$ktg_mu_350_s=$ktg_mu_350_s+$data['jumlah'];}
				  if ($data['volume']=='250'){$ktg_mu_250_s=$ktg_mu_250_s+$data['jumlah'];}break;
	    case 'Double' 	: if ($data['volume']=='350'){$ktg_mu_350_d=$ktg_mu_350_d+$data['jumlah'];}
				  if ($data['volume']=='450'){$ktg_mu_450_d=$ktg_mu_450_d+$data['jumlah'];}break;
	    case 'Triple' 	: if ($data['volume']=='350'){$ktg_mu_350_t=$ktg_mu_350_t+$data['jumlah'];}
				  if ($data['volume']=='450'){$ktg_mu_450_t=$ktg_mu_450_t+$data['jumlah'];}break;
	    case 'Quadruple' 	: if ($data['volume']=='350'){$ktg_mu_350_q=$ktg_mu_350_q+$data['jumlah'];}
				  if ($data['volume']=='450'){$ktg_mu_450_q=$ktg_mu_450_q+$data['jumlah'];}break;
	    case 'Pediatrik' 	: $ktg_mu_ped=$ktg_mu_ped+$data['jumlah'];break;
	    case 'Apheresis'	: $ktg_mu_aph=$ktg_mu_aph+$data['jumlah'];break;
	}
    }
}
?>
