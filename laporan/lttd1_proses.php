<?
include('/var/www/simudda/config/db_connect.php');
$no=0;

$lk_b_17=0;		$lk_b_31=0;     $lk_b_41=0;     $lk_b_51=0;     $lk_b_61=0;     
$lk_l_17=0;     $lk_l_31=0;     $lk_l_41=0;     $lk_l_51=0;     $lk_l_61=0;     
$pr_b_17=0;     $pr_b_31=0;     $pr_b_41=0;     $pr_b_51=0;     $pr_b_61=0;     
$pr_l_17=0;     $pr_l_31=0;     $pr_l_41=0;     $pr_l_51=0;     $pr_l_61=0;     
$bumn_lk_b=0;	$plj_lk_b=0;	$mhs_lk_b=0;	$pns_lk_b=0;    $brh_lk_b=0;	$tni_lk_b=0;	$swt_lk_b=0;	$wst_lk_b=0;	$pol_lk_b=0;	$pdg_lk_b=0;	$ll_lk_b=0;
$bumn_lk_l=0;   $plj_lk_l=0;    $mhs_lk_l=0;    $pns_lk_l=0;    $brh_lk_l=0;    $tni_lk_l=0;    $swt_lk_l=0;    $wst_lk_l=0;    $pol_lk_l=0;    $pdg_lk_l=0;    $ll_lk_l=0;
$bumn_pr_b=0;   $plj_pr_b=0;    $mhs_pr_b=0;    $pns_pr_b=0;    $brh_pr_b=0;    $tni_pr_b=0;    $swt_pr_b=0;    $wst_pr_b=0;    $pol_pr_b=0;    $pdg_pr_b=0;    $ll_pr_b=0;
$bumn_pr_l=0;   $plj_pr_l=0;    $mhs_pr_l=0;    $pns_pr_l=0;    $brh_pr_l=0;    $tni_pr_l=0;    $swt_pr_l=0;    $wst_pr_l=0;    $pol_pr_l=0;    $pdg_pr_l=0;    $ll_pr_l=0;
$lk_p10=0;		$lk_p25=0;		$lk_p50=0;		$lk_p75=0;		$lk_p100=0;
$pr_p10=0;		$pr_p25=0;		$pr_p50=0;		$pr_p75=0;		$pr_p100=0;
$jml_lk_b=0;	$lk_b_cekal=0;	$lk_b_tolak=0;
$jml_lk_l=0;    $pr_b_cekal=0;  $pr_b_tolak=0;
$jml_pr_b=0;    $lk_l_cekal=0;  $lk_l_tolak=0;
$jml_pr_l=0;    $pr_l_cekal=0;  $pr_l_tolak=0;

$sql="SELECT case when Jk='0' then 'L' else 'P' end as jk,`pekerjaan`, CASE   WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'u31'
	WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'u41'  WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'u51'
	WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) > 60 THEN 'u61'else 'u16' END AS Umur,CASE WHEN jumDonor>2 THEN 'L' ELSE 'B' END AS lb,
	COUNT(Kode) AS jml FROM pendonor  GROUP BY  case when Jk='0' then 'L' else 'P' end,`pekerjaan`, CASE 
	WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'u31'   WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'u41'
	WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'u51'   WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) > 60 THEN 'u61'
	else 'u16' END, CASE WHEN jumDonor>2 THEN 'L' ELSE 'B' END";
$dta0=mysql_query($sql,$con);
while ($dta=mysql_fetch_assoc($dta0)) {
    $no++;
	if($dta['jk']=='L'){
		if ($dta['lb']=='B'){
			$jml_lk_b = $jml_lk_b + $dta['jml'];
			switch ($dta['Umur']){
				case 'u16' : $lk_b_17 = $lk_b_17 + $dta['jml'];break;
				case 'u31' : $lk_b_31 = $lk_b_31 + $dta['jml'];break;
				case 'u41' : $lk_b_41 = $lk_b_41 + $dta['jml'];break;
				case 'u51' : $lk_b_51 = $lk_b_51 + $dta['jml'];break;
				case 'u61' : $lk_b_61 = $lk_b_61 + $dta['jml'];break;
			}
			switch (trim(strtoupper($dta['pekerjaan']))){
				case 'BUMN'				: $bumn_lk_b = $bumn_lk_b + $dta['jml'];break;
				case 'MAHASISWA'		: $mhs_lk_b = $mhs_lk_b + $dta['jml'];break;
				case 'PEDAGANG'			: $pdg_lk_b = $pdg_lk_b + $dta['jml'];break;
				case 'PEG. NEGERI'		: $pns_lk_b = $pns_lk_b + $dta['jml'];break;
				case 'PEG. SWASTA'		: $swt_lk_b = $swt_lk_b + $dta['jml'];break;
				case 'PELAJAR'			: $plj_lk_b = $plj_lk_b + $dta['jml'];break;
				case 'PETANI / BURUH'	: $brh_lk_b = $brh_lk_b + $dta['jml'];break;
				case 'POLRI'			: $pol_lk_b = $pol_lk_b + $dta['jml'];break;
				case 'TNI'				: $tni_lk_b = $tni_lk_b + $dta['jml'];break;
				case 'WIRASWASTA'		: $wst_lk_b = $wst_lk_b + $dta['jml'];break;
				default					: $ll_lk_b = $ll_lk_b + $dta['jml'];break;
			}
		}else{
			$jml_lk_l = $jml_lk_l + $dta['jml'];
			switch ($dta['Umur']){
				case 'u16' : $lk_l_17 = $lk_l_17 + $dta['jml'];break;
				case 'u31' : $lk_l_31 = $lk_l_31 + $dta['jml'];break;
				case 'u41' : $lk_l_41 = $lk_l_41 + $dta['jml'];break;
				case 'u51' : $lk_l_51 = $lk_l_51 + $dta['jml'];break;
				case 'u61' : $lk_l_61 = $lk_l_61 + $dta['jml'];break;
			}
			switch (trim(strtoupper($dta['pekerjaan']))){
				case 'BUMN'				: $bumn_lk_l = $bumn_lk_l + $dta['jml'];break;
				case 'MAHASISWA'		: $mhs_lk_l = $mhs_lk_l + $dta['jml'];break;
				case 'PEDAGANG'			: $pdg_lk_l = $pdg_lk_l + $dta['jml'];break;
				case 'PEG. NEGERI'		: $pns_lk_l = $pns_lk_l + $dta['jml'];break;
				case 'PEG. SWASTA'		: $swt_lk_l = $swt_lk_l + $dta['jml'];break;
				case 'PELAJAR'			: $plj_lk_l = $plj_lk_l + $dta['jml'];break;
				case 'PETANI / BURUH'	: $brh_lk_l = $brh_lk_l + $dta['jml'];break;
				case 'POLRI'			: $pol_lk_l = $pol_lk_l + $dta['jml'];break;
				case 'TNI'				: $tni_lk_l = $tni_lk_l + $dta['jml'];break;
				case 'WIRASWASTA'		: $wst_lk_l = $wst_lk_l + $dta['jml'];break;
				default					: $ll_lk_l = $ll_lk_l + $dta['jml'];break;
			}
		}
	} else{ //Wanita
		if ($dta['lb']=='B'){
			$jml_pr_b = $jml_pr_b + $dta['jml'];
			switch ($dta['Umur']){
				case 'u16' : $pr_b_17 = $pr_b_17 + $dta['jml'];break;
				case 'u31' : $pr_b_31 = $pr_b_31 + $dta['jml'];break;
				case 'u41' : $pr_b_41 = $pr_b_41 + $dta['jml'];break;
				case 'u51' : $pr_b_51 = $pr_b_51 + $dta['jml'];break;
				case 'u61' : $pr_b_61 = $pr_b_61 + $dta['jml'];break;
			}
			switch (trim(strtoupper($dta['pekerjaan']))){
				case 'BUMN'				: $bumn_pr_b = $bumn_pr_b + $dta['jml'];break;
				case 'MAHASISWA'		: $mhs_pr_b = $mhs_pr_b + $dta['jml'];break;
				case 'PEDAGANG'			: $pdg_pr_b = $pdg_pr_b + $dta['jml'];break;
				case 'PEG. NEGERI'		: $pns_pr_b = $pns_pr_b + $dta['jml'];break;
				case 'PEG. SWASTA'		: $swt_pr_b = $swt_pr_b + $dta['jml'];break;
				case 'PELAJAR'			: $plj_pr_b = $plj_pr_b + $dta['jml'];break;
				case 'PETANI / BURUH'	: $brh_pr_b = $brh_pr_b + $dta['jml'];break;
				case 'POLRI'			: $pol_pr_b = $pol_pr_b + $dta['jml'];break;
				case 'TNI'				: $tni_pr_b = $tni_pr_b + $dta['jml'];break;
				case 'WIRASWASTA'		: $wst_pr_b = $wst_pr_b + $dta['jml'];break;
				default					: $ll_pr_b = $ll_pr_b + $dta['jml'];break;
			}
		}else{
			$jml_pr_l = $jml_pr_l + $dta['jml'];
			switch ($dta['Umur']){
				case 'u16' : $pr_l_17 = $pr_l_17 + $dta['jml'];break;
				case 'u31' : $pr_l_31 = $pr_l_31 + $dta['jml'];break;
				case 'u41' : $pr_l_41 = $pr_l_41 + $dta['jml'];break;
				case 'u51' : $pr_l_51 = $pr_l_51 + $dta['jml'];break;
				case 'u61' : $pr_l_61 = $pr_l_61 + $dta['jml'];break;
			}
			switch (trim(strtoupper($dta['pekerjaan']))){
				case 'BUMN'				: $bumn_pr_l = $bumn_pr_l + $dta['jml'];break;
				case 'MAHASISWA'		: $mhs_pr_l = $mhs_pr_l + $dta['jml'];break;
				case 'PEDAGANG'			: $pdg_pr_l = $pdg_pr_l + $dta['jml'];break;
				case 'PEG. NEGERI'		: $pns_pr_l = $pns_pr_l + $dta['jml'];break;
				case 'PEG. SWASTA'		: $swt_pr_l = $swt_pr_l + $dta['jml'];break;
				case 'PELAJAR'			: $plj_pr_l = $plj_pr_l + $dta['jml'];break;
				case 'PETANI / BURUH'	: $brh_pr_l = $brh_pr_l + $dta['jml'];break;
				case 'POLRI'			: $pol_pr_l = $pol_pr_l + $dta['jml'];break;
				case 'TNI'				: $tni_pr_l = $tni_pr_l + $dta['jml'];break;
				case 'WIRASWASTA'		: $wst_pr_l = $wst_pr_l + $dta['jml'];break;
				default					: $ll_pr_l = $ll_pr_l + $dta['jml'];break;
			}
		}
	}
}

$sql="select jK,sum(p10) as p10, sum(p25) as p25, sum(p50) as p50, sum(p75) as p75, sum(p100) as p100, count(kode) as jumlah
from pendonor where p10=3 or p25=3 or p50=3 or p75=3 or p100=3 group by jK";
$dta0=mysql_query($sql,$con);
while ($dta=mysql_fetch_assoc($dta0)) {
	if ($dta['jK']=='0'){
		$lk_p10	 = round($dta['p10']/3);
		$lk_p25	 = round($dta['p25']/3);
		$lk_p50	 = round($dta['p50']/3);
		$lk_p75	 = round($dta['p75']/3);
		$lk_p100 = round($dta['p100']/3);
	} else{
		$pr_p10	 = round($dta['p10']/3);
		$pr_p25	 = round($dta['p25']/3);
		$pr_p50	 = round($dta['p50']/3);
		$pr_p75	 = round($dta['p75']/3);
		$pr_p100 = round($dta['p100']/3);
	}
}

$sql="select jK, case when `jumDonor`>2 then 'L' else 'B' END as lb, count(Kode) as jml from pendonor where Cekal<>0 group by jK, case when `jumDonor`>2 then 'L' else 'B' END ";
$dta0=mysql_query($sql,$con);
while ($dta=mysql_fetch_assoc($dta0)) {
	if ($dta['jK']=='0'){
		if ($dta['lb']=='B'){$lk_b_cekal = $dta['jml'];} else {$lk_l_cekal = $dta['jml'];}
	} else{
		if ($dta['lb']=='B'){$pr_b_cekal = $dta['jml'];} else {$pr_l_cekal = $dta['jml'];}
	}
}

$sql="select case when pendonor.jK='0' then 'L' else 'P' end as jk, case when pendonor.jumDonor>2 then 'L' else 'B' END as lb, count(htransaksi.NoTrans) as jml
from htransaksi inner join pendonor on pendonor.kode=htransaksi.KodePendonor
where htransaksi.jumHB>1 group by case when pendonor.jK='0' then 'L' else 'P' end, case when pendonor.jumDonor>2 then 'L' else 'B' END";
$dta0=mysql_query($sql,$con);
while ($dta=mysql_fetch_assoc($dta0)) {
	if ($dta['jk']=='L'){
		if ($dta['lb']=='B'){$lk_b_tolak = $dta['jml'];} else {$lk_l_tolak = $dta['jml'];}
	} else{
		if ($dta['lb']=='B'){$pr_b_tolak = $dta['jml'];} else {$pr_l_tolak = $dta['jml'];}
	}
}


?>
