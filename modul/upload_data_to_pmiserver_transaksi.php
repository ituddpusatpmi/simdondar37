<?
include('clogin.php');
include('config/db_connect.php');
$no=0;

$sqlharian="SELECT left(htransaksi.NoTrans,1) as jenis, pendonor.Jk,htransaksi.JenisDonor,
	pendonor.GolDarah,pendonor.Rhesus,htransaksi.kendaraan,count(htransaksi.KodePendonor) as jumlah
	from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
	where date(htransaksi.Tgl)='$_POST[tanggal]' and (htransaksi.Pengambilan ='0' or  htransaksi.Pengambilan ='1' or  htransaksi.Pengambilan ='2') 
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
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_lk_ds_o_neg=$data[jumlah];} else {$dg_lk_ds_o_pos=$data[jumlah];} break;
		    }
	    } else { 
		switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_lk_dp_a_neg=$data[jumlah];} else {$dg_lk_dp_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_lk_dp_ab_neg=$data[jumlah];} else {$dg_lk_dp_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_lk_dp_b_neg=$data[jumlah];} else {$dg_lk_dp_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_lk_dp_o_neg=$data[jumlah];} else {$dg_lk_dp_o_pos=$data[jumlah];} break;
		}
	    }
	} else { 
	    if ($data[JenisDonor]=='0'){ 
		switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_pr_ds_a_neg=$data[jumlah];} else  {$dg_pr_ds_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_pr_ds_ab_neg=$data[jumlah];} else {$dg_pr_ds_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_pr_ds_b_neg=$data[jumlah];} else {$dg_pr_ds_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_pr_ds_o_neg=$data[jumlah];} else {$dg_pr_ds_o_pos=$data[jumlah];} break;
		}
	    } else {
		switch ($data[GolDarah]){
		    case 'A' :  if ($data[Rhesus]=='-'){$dg_pr_dp_a_neg=$data[jumlah];} else {$dg_pr_dp_a_pos=$data[jumlah];} break;
		    case 'AB':  if ($data[Rhesus]=='-'){$dg_pr_dp_ab_neg=$data[jumlah];} else {$dg_pr_dp_ab_pos=$data[jumlah];} break;
		    case 'B' :  if ($data[Rhesus]=='-'){$dg_pr_dp_b_neg=$data[jumlah];} else {$dg_pr_dp_b_pos=$data[jumlah];} break;
		    case 'O' :  if ($data[Rhesus]=='-'){$dg_pr_dp_o_neg=$data[jumlah];} else {$dg_pr_dp_o_pos=$data[jumlah];} break;
		}
	    }
	}
    } else {
	if ($data[Jk]=='0'){
	    if ($data[Rhesus]=='+'){
		switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_lk_ds_a_pos_bus=$data[jumlah];} else {$mu_lk_ds_a_pos_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_lk_ds_ab_pos_bus=$data[jumlah];} else {$mu_lk_ds_ab_pos_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_lk_ds_b_pos_bus=$data[jumlah];} else {$mu_lk_ds_b_pos_nbus=$data[jumlah];} break; 
		    case 'O' : if ($data[kendaraan]=='0'){$mu_lk_ds_o_pos_bus=$data[jumlah];} else {$mu_lk_ds_o_pos_nbus=$data[jumlah];} break;
		}
	    } else{
		switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_lk_ds_a_neg_bus=$data[jumlah];} else {$mu_lk_ds_a_neg_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_lk_ds_ab_neg_bus=$data[jumlah];} else  {$mu_lk_ds_ab_neg_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_lk_ds_b_neg_bus=$data[jumlah];} else {$mu_lk_ds_b_neg_nbus=$data[jumlah];} break;
		    case 'O' : if ($data[kendaraan]=='0'){$mu_lk_ds_o_neg_bus=$data[jumlah];} else {$mu_lk_ds_o_neg_nbus=$data[jumlah];} break;
		}
	    }
	} else {
	    if ($data[Rhesus]=='+'){
		switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_pr_ds_a_pos_bus=$data[jumlah];} else {$mu_pr_ds_a_pos_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_pr_ds_ab_pos_bus=$data[jumlah];} else {$mu_pr_ds_ab_pos_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_pr_ds_b_pos_bus=$data[jumlah];} else {$mu_pr_ds_b_pos_nbus=$data[jumlah];} break; 
		    case 'O' : if ($data[kendaraan]=='0'){$mu_pr_ds_o_pos_bus=$data[jumlah];} else {$mu_pr_ds_o_pos_nbus=$data[jumlah];} break;
		}
	    } else{
		switch ($data[GolDarah]){
		    case 'A' : if ($data[kendaraan]=='0'){$mu_pr_ds_a_neg_bus=$data[jumlah];} else {$mu_pr_ds_a_neg_nbus=$data[jumlah];} break;
		    case 'AB': if ($data[kendaraan]=='0'){$mu_pr_ds_ab_neg_bus=$data[jumlah];} else  {$mu_pr_ds_ab_neg_nbus=$data[jumlah];} break;
		    case 'B' : if ($data[kendaraan]=='0'){$mu_pr_ds_b_neg_bus=$data[jumlah];} else {$mu_pr_ds_b_neg_nbus=$data[jumlah];} break;
		    case 'O' : if ($data[kendaraan]=='0'){$mu_pr_ds_o_neg_bus=$data[jumlah];} else {$mu_pr_ds_o_neg_nbus=$data[jumlah];} break;
		}
	    }   
	}
    }
}
?>
