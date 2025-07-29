<?php
	include "koneksi.php";
	
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];
	$wb_a = $_POST['wb_a'];
	$wb_b = $_POST['wb_b'];
	$wb_ab = $_POST['wb_ab'];
	$wb_o = $_POST['wb_o'];
	$prc_a = $_POST['prc_a'];
	$prc_b = $_POST['prc_b'];
	$prc_ab = $_POST['prc_ab'];
	$prc_o = $_POST['prc_o'];
	$ffp_a = $_POST['ffp_a'];
	$ffp_b = $_POST['ffp_b'];
	$ffp_ab = $_POST['ffp_ab'];
	$ffp_o = $_POST['ffp_o'];
	$lp_a = $_POST['lp_a'];
	$lp_b = $_POST['lp_b'];
	$lp_ab = $_POST['lp_ab'];
	$lp_o = $_POST['lp_o'];
	$tc_a = $_POST['tc_a'];
	$tc_b = $_POST['tc_b'];
	$tc_ab = $_POST['tc_ab'];
	$tc_o = $_POST['tc_o'];
	$ahf_a = $_POST['ahf_a'];
	$ahf_b = $_POST['ahf_b'];
	$ahf_ab = $_POST['ahf_ab'];
	$ahf_o = $_POST['ahf_o'];
	$pd_a = $_POST['pd_a'];
	$pd_b = $_POST['pd_b'];
	$pd_ab = $_POST['pd_ab'];
	$pd_o = $_POST['pd_o'];
	$udd_a1 = $_POST['udd_a1']; 
	$udd_b1 = $_POST['udd_b1'];
	$udd_ab1 = $_POST['udd_ab1'];
	$udd_o1 = $_POST['udd_o1'];
	$udd_a2 = $_POST['udd_a2'];
	$udd_b2 = $_POST['udd_b2'];
	$udd_ab2 = $_POST['udd_ab2'];
	$udd_o2 = $_POST['udd_o2'];
	$udd_a3 = $_POST['udd_a3'];
	$udd_b3 = $_POST['udd_b3'];
	$udd_ab3 = $_POST['udd_ab3'];
	$udd_o3 = $_POST['udd_o3'];
	$udd_a4 = $_POST['udd_a4'];
	$udd_b4 = $_POST['udd_b4'];
	$udd_ab4 = $_POST['udd_ab4'];
	$udd_o4 = $_POST['udd_o4'];
	$udd_a5 = $_POST['udd_a5'];
	$udd_b5 = $_POST['udd_b5'];
	$udd_ab5 = $_POST['udd_ab5'];
	$udd_o5 = $_POST['udd_o5'];
	$udd_a6 = $_POST['udd_a6'];
	$udd_b6 = $_POST['udd_b6'];
	$udd_ab6 = $_POST['udd_ab6'];
	$udd_o6 = $_POST['udd_o6'];
	$udd_a7 = $_POST['udd_a7'];
	$udd_b7 = $_POST['udd_b7'];
	$udd_ab7 = $_POST['udd_ab7'];
	$udd_o7 = $_POST['udd_o7'];	
	$uddl_a1 = $_POST['uddl_a1']; 
	$uddl_b1 = $_POST['uddl_b1'];
	$uddl_ab1 = $_POST['uddl_ab1'];
	$uddl_o1 = $_POST['uddl_o1'];
	$uddl_a2 = $_POST['uddl_a2'];
	$uddl_b2 = $_POST['uddl_b2'];
	$uddl_ab2 = $_POST['uddl_ab2'];
	$uddl_o2 = $_POST['uddl_o2'];
	$uddl_a3 = $_POST['uddl_a3'];
	$uddl_b3 = $_POST['uddl_b3'];
	$uddl_ab3 = $_POST['uddl_ab3'];
	$uddl_o3 = $_POST['uddl_o3'];
	$uddl_a4 = $_POST['uddl_a4'];
	$uddl_b4 = $_POST['uddl_b4'];
	$uddl_ab4 = $_POST['uddl_ab4'];
	$uddl_o4 = $_POST['uddl_o4'];
	$uddl_a5 = $_POST['uddl_a5'];
	$uddl_b5 = $_POST['uddl_b5'];
	$uddl_ab5 = $_POST['uddl_ab5'];
	$uddl_o5 = $_POST['uddl_o5'];
	$uddl_a6 = $_POST['uddl_a6'];
	$uddl_b6 = $_POST['uddl_b6'];
	$uddl_ab6 = $_POST['uddl_ab6'];
	$uddl_o6 = $_POST['uddl_o6'];
	$uddl_a7 = $_POST['uddl_a7'];
	$uddl_b7 = $_POST['uddl_b7'];
	$uddl_ab7 = $_POST['uddl_ab7'];
	$uddl_o7 = $_POST['uddl_o7'];
	$mu_a1 = $_POST['mu_a1'];
	$mu_b1 = $_POST['mu_b1'];
	$mu_ab1 = $_POST['mu_ab1'];
	$mu_o1 = $_POST['mu_o1'];
	$mu_a2 = $_POST['mu_a2'];
	$mu_b2 = $_POST['mu_b2'];
	$mu_ab2 = $_POST['mu_ab2'];
	$mu_o2 = $_POST['mu_o2'];
	$mu_a3 = $_POST['mu_a3'];
	$mu_b3 = $_POST['mu_b3'];
	$mu_ab3 = $_POST['mu_ab3'];
	$mu_o3 = $_POST['mu_o3'];
	$mu_a4 = $_POST['mu_a4'];
	$mu_b4 = $_POST['mu_b4'];
	$mu_ab4 = $_POST['mu_ab4'];
	$mu_o4 = $_POST['mu_o4'];
	$mu_a5 = $_POST['mu_a5'];
	$mu_b5 = $_POST['mu_b5'];
	$mu_ab5 = $_POST['mu_ab5'];
	$mu_o5 = $_POST['mu_o5'];
	$mu_a6 = $_POST['mu_a6'];
	$mu_b6 = $_POST['mu_b6'];
	$mu_ab6 = $_POST['mu_ab6'];
	$mu_o6 = $_POST['mu_o6'];
	$mu_a7 = $_POST['mu_a7'];
	$mu_b7 = $_POST['mu_b7'];
	$mu_ab7 = $_POST['mu_ab7'];
	$mu_o7 = $_POST['mu_o7'];
	$mu2_a1 = $_POST['mu2_a1'];
	$mu2_b1 = $_POST['mu2_b1'];
	$mu2_ab1 = $_POST['mu2_ab1'];
	$mu2_o1 = $_POST['mu2_o1'];
	$mu2_a2 = $_POST['mu2_a2'];
	$mu2_b2 = $_POST['mu2_b2'];
	$mu2_ab2 = $_POST['mu2_ab2'];
	$mu2_o2 = $_POST['mu2_o2'];
	$mu2_a3 = $_POST['mu2_a3'];
	$mu2_b3 = $_POST['mu2_b3'];
	$mu2_ab3 = $_POST['mu2_ab3'];
	$mu2_o3 = $_POST['mu2_o3'];
	$mu2_a4 = $_POST['mu2_a4'];
	$mu2_b4 = $_POST['mu2_b4'];
	$mu2_ab4 = $_POST['mu2_ab4'];
	$mu2_o4 = $_POST['mu2_o4'];
	$mu2_a5 = $_POST['mu2_a5'];
	$mu2_b5 = $_POST['mu2_b5'];
	$mu2_ab5 = $_POST['mu2_ab5'];
	$mu2_o5 = $_POST['mu2_o5'];
	$mu2_a6 = $_POST['mu2_a6'];
	$mu2_b6 = $_POST['mu2_b6'];
	$mu2_ab6 = $_POST['mu2_ab6'];
	$mu2_o6 = $_POST['mu2_o6'];
	$mu2_a7 = $_POST['mu2_a7'];
	$mu2_b7 = $_POST['mu2_b7'];
	$mu2_ab7 = $_POST['mu2_ab7'];
	$mu2_o7 = $_POST['mu2_o7'];
	$bu1 = $_POST['bu1'];
	$bu2 = $_POST['bu2'];
	$gerai_a1 = $_POST['gerai_a1'];
	$gerai_b1 = $_POST['gerai_b1'];
	$gerai_ab1 = $_POST['gerai_ab1'];
	$gerai_o1 = $_POST['gerai_o1'];
	$gerai_a2 = $_POST['gerai_a2'];
	$gerai_b2 = $_POST['gerai_b2'];
	$gerai_ab2 = $_POST['gerai_ab2'];
	$gerai_o2 = $_POST['gerai_o2'];
	$gerai_a3 = $_POST['gerai_a3'];
	$gerai_b3 = $_POST['gerai_b3'];
	$gerai_ab3 = $_POST['gerai_ab3'];
	$gerai_o3 = $_POST['gerai_o3'];
	$gerai_a4 = $_POST['gerai_a4'];
	$gerai_b4 = $_POST['gerai_b4'];
	$gerai_ab4 = $_POST['gerai_ab4'];
	$gerai_o4 = $_POST['gerai_o4'];
	$gerai_a5 = $_POST['gerai_a5'];
	$gerai_b5 = $_POST['gerai_b5'];
	$gerai_ab5 = $_POST['gerai_ab5'];
	$gerai_o5 = $_POST['gerai_o5'];
	$gerai_a6 = $_POST['gerai_a6'];
	$gerai_b6 = $_POST['gerai_b6'];
	$gerai_ab6 = $_POST['gerai_ab6'];
	$gerai_o6 = $_POST['gerai_o6'];
	$gerai_a7 = $_POST['gerai_a7'];
	$gerai_b7 = $_POST['gerai_b7'];
	$gerai_ab7 = $_POST['gerai_ab7'];
	$gerai_o7 = $_POST['gerai_o7'];
	$petugas1 = $_POST['petugas1'];
	$petugas2 = $_POST['petugas2'];
	$petugas3 = $_POST['petugas3'];
	$petugas4 = $_POST['petugas4'];
	$pakai = $_POST['pakai'];
	$pakai2 = $_POST['pakai2'];
	$pakai3 = $_POST['pakai3'];
	$pakai4 = $_POST['pakai4'];
	$pakai5 = $_POST['pakai5'];
	$pakai6 = $_POST['pakai6'];
	$pakai7 = $_POST['pakai7'];
	$pakai8 = $_POST['pakai8'];
	$pakai9 = $_POST['pakai9'];
	$pakai10 = $_POST['pakai10'];
	$pakai11 = $_POST['pakai11'];
	$pakai12 = $_POST['pakai12'];
	$pakai13 = $_POST['pakai13'];
	$pakai14 = $_POST['pakai14'];
	$pakai15 = $_POST['pakai15'];
	$pakai16 = $_POST['pakai16'];
	$pakai17 = $_POST['pakai17'];
	$pakai18 = $_POST['pakai18'];
	$pakai19 = $_POST['pakai19'];
	$pakai20 = $_POST['pakai20'];
	$pakai21 = $_POST['pakai21'];
	$pakai22 = $_POST['pakai22'];
	$pakai23 = $_POST['pakai23'];
	$pakai24 = $_POST['pakai24'];
	$pakai25 = $_POST['pakai25'];
	$pakai26 = $_POST['pakai26'];
	$pakai27 = $_POST['pakai27'];
	$pakai28 = $_POST['pakai28'];
	$musnah = $_POST['musnah'];
	$musnah2 = $_POST['musnah2'];
	$musnah3 = $_POST['musnah3'];
	$musnah4 = $_POST['musnah4'];
	$musnah5 = $_POST['musnah5'];
	$musnah6 = $_POST['musnah6'];
	$musnah7 = $_POST['musnah7'];
	$musnah8 = $_POST['musnah8'];
	$musnah9 = $_POST['musnah9'];
	$musnah10 = $_POST['musnah10'];
	$musnah11 = $_POST['musnah11'];
	$musnah12 = $_POST['musnah12'];
	$musnah13 = $_POST['musnah13'];
	$musnah14 = $_POST['musnah14'];
	$musnah15 = $_POST['musnah15'];
	$musnah16 = $_POST['musnah16'];
	$musnah17 = $_POST['musnah17'];
	$musnah18 = $_POST['musnah18'];
	$musnah19 = $_POST['musnah19'];
	$musnah20 = $_POST['musnah20'];
	$musnah21 = $_POST['musnah21'];
	$musnah22 = $_POST['musnah22'];
	$musnah23 = $_POST['musnah23'];
	$musnah24 = $_POST['musnah24'];
	$musnah25 = $_POST['musnah25'];
	$musnah26 = $_POST['musnah26'];
	$musnah27 = $_POST['musnah27'];
	$musnah28 = $_POST['musnah28'];
	$wba = $_POST['wba'];
	$wbb = $_POST['wbb'];
	$wbab = $_POST['wbab']; 
	$wbo = $_POST['wbo']; 
	$prca = $_POST['prca']; 
	$prcb = $_POST['prcb']; 
	$prcab = $_POST['prcab']; 
	$prco = $_POST['prco']; 
	$ffpa = $_POST['ffpa']; 
	$ffpb = $_POST['ffpb']; 
	$ffpab = $_POST['ffpab']; 
	$ffpo = $_POST['ffpo']; 
	$lpa = $_POST['lpa']; 
	$lpb = $_POST['lpb']; 
	$lpab = $_POST['lpab']; 
	$lpo = $_POST['lpo']; 
	$tca = $_POST['tca']; 
	$tcb = $_POST['tcb']; 
	$tcab = $_POST['tcab']; 
	$tco = $_POST['tco']; 
	$ahfa = $_POST['ahfa']; 
	$ahfb = $_POST['ahfb']; 
	$ahfab = $_POST['ahfab']; 
	$ahfo = $_POST['ahfo']; 
	$pda = $_POST['pda']; 
	$pdb = $_POST['pdb']; 
	$pdab = $_POST['pdab']; 
	$pdo = $_POST['pdo']; 
	$catatan = $_POST['catatan'];
	
$sql="insert into stok(tanggal,shift,wb_a,wb_b,wb_ab,wb_o,prc_a,prc_b,prc_ab,prc_o,ffp_a,ffp_b,ffp_ab,ffp_o,lp_a,lp_b,lp_ab,lp_o,tc_a,tc_b,
tc_ab,tc_o,ahf_a,ahf_b,ahf_ab,ahf_o,pd_a,pd_b,pd_ab,pd_o,udd_a1,udd_b1,udd_ab1,udd_o1,udd_a2,udd_b2,udd_ab2,udd_o2,udd_a3,udd_b3,udd_ab3,
udd_o3,udd_a4,udd_b4,udd_ab4,udd_o4,udd_a5,udd_b5,udd_ab5,udd_o5,udd_a6,udd_b6,udd_ab6,udd_o6,udd_a7,udd_b7,udd_ab7,udd_o7,uddl_a1,uddl_b1,
uddl_ab1,uddl_o1,uddl_a2,uddl_b2,uddl_ab2,uddl_o2,uddl_a3,uddl_b3,uddl_ab3,uddl_o3,uddl_a4,uddl_b4,uddl_ab4,uddl_o4,uddl_a5,uddl_b5,uddl_ab5,
uddl_o5,uddl_a6,uddl_b6,uddl_ab6,uddl_o6,uddl_a7,uddl_b7,uddl_ab7,uddl_o7,mu_a1,mu_b1,mu_ab1,mu_o1,mu_a2,mu_b2,mu_ab2,mu_o2,mu_a3,mu_b3,mu_ab3,
mu_o3,mu_a4,mu_b4,mu_ab4,mu_o4,mu_a5,mu_b5,mu_ab5,mu_o5,mu_a6,mu_b6,mu_ab6,mu_o6,mu_a7,mu_b7,mu_ab7,mu_o7,mu2_a1,mu2_b1,mu2_ab1,mu2_o1,mu2_a2,mu2_b2,
mu2_ab2,mu2_o2,mu2_a3,mu2_b3,mu2_ab3,mu2_o3,mu2_a4,mu2_b4,mu2_ab4,mu2_o4,mu2_a5,mu2_b5,mu2_ab5,mu2_o5,mu2_a6,mu2_b6,mu2_ab6,mu2_o6,mu2_a7,mu2_b7,mu2_ab7,
mu2_o7,bu1,bu2,gerai_a1,gerai_b1,gerai_ab1,gerai_o1,gerai_a2,gerai_b2,gerai_ab2,gerai_o2,gerai_a3,gerai_b3,gerai_ab3,gerai_o3,gerai_a4,gerai_b4,gerai_ab4,gerai_o4,
gerai_a5,gerai_b5,gerai_ab5,gerai_o5,gerai_a6,gerai_b6,gerai_ab6,gerai_o6,gerai_a7,gerai_b7,gerai_ab7,gerai_o7,petugas1,petugas2,petugas3,petugas4,catatan) values('$tanggal','$shift',
('$wba'-'$pakai'-'$musnah')+'$wb_a',('$wbb'-'$pakai2'-'$musnah2')+'$wb_b',('$wbab'-'$pakai3'-'$musnah3')+'$wb_ab' ,('$wbo'-'$pakai4'-'$musnah4')+'$wb_o',('$prca'-'$pakai5'-'$musnah5')+'$prc_a',
('$prcb'-'$pakai6'-'$musnah6')+'$prc_b',('$prcab'-'$pakai7'-'$musnah7')+'$prc_ab',('$prco'-'$pakai8'-'$musnah8')+'$prc_o',('$ffpa'-'$pakai9'-'$musnah9')+'$ffp_a',
('$ffpb'-'$pakai10'-'$musnah10')+'$ffp_b',('$ffpab'-'$pakai11'-'$musnah11')+'$ffp_ab',('$ffpo'-'$pakai12'-'$musnah12')+'$ffp_o',('$lpa'-'$pakai13'-'$musnah13')+'$lp_a',
('$lpb'-'$pakai14'-'$musnah14')+'$lp_b',('$lpab'-'$pakai15'-'$musnah15')+'$lp_ab',('$lpo'-'$pakai16'-'$musnah16')+'$lp_o',('$tca'-'$pakai17'-'$musnah17')+'$tc_a',
('$tcb'-'$pakai18'-'$musnah18')+'$tc_b',('$tcab'-'$pakai19'-'$musnah19')+'$tc_ab',('$tco'-'$pakai20'-'$musnah20')+'$tc_o',('$ahfa'-'$pakai21'-'$musnah21')+'$ahf_a',
('$ahfb'-'$pakai22'-'$musnah22')+'$ahf_b',('$ahfab'-'$pakai23'-'$musnah23')+'$ahf_ab',('$ahfo'-'$pakai24'-'$musnah24')+'$ahf_o',('$pda'-'$pakai25'-'$musnah25')+'$pd_a',
('$pdb'-'$pakai26'-'$musnah26')+'$pd_b',('$pdab'-'$pakai27'-'$musnah27')+'$pd_ab',('$pdo'-'$pakai28'-'$musnah28')+'$pd_o','$udd_a1','$udd_b1','$udd_ab1','$udd_o1',
'$udd_a2','$udd_b2','$udd_ab2','$udd_o2','$udd_a3','$udd_b3','$udd_ab3','$udd_o3','$udd_a4','$udd_b4','$udd_ab4','$udd_o4','$udd_a5','$udd_b5',
'$udd_ab5','$udd_o5','$udd_a6','$udd_b6','$udd_ab6','$udd_o6','$udd_a7','$udd_b7','$udd_ab7','$udd_o7','$uddl_a1','$uddl_b1','$uddl_ab1',
'$uddl_o1','$uddl_a2','$uddl_b2','$uddl_ab2','$uddl_o2','$uddl_a3','$uddl_b3','$uddl_ab3','$uddl_o3','$uddl_a4','$uddl_b4','$uddl_ab4','$uddl_o4',
'$uddl_a5','$uddl_b5','$uddl_ab5','$uddl_o5','$uddl_a6','$uddl_b6','$uddl_ab6','$uddl_o6','$uddl_a7','$uddl_b7','$uddl_ab7','$uddl_o7','$mu_a1',
'$mu_b1','$mu_ab1','$mu_o1','$mu_a2','$mu_b2','$mu_ab2','$mu_o2','$mu_a3','$mu_b3','$mu_ab3','$mu_o3','$mu_a4','$mu_b4','$mu_ab4','$mu_o4',
'$mu_a5','$mu_b5','$mu_ab5','$mu_o5','$mu_a6','$mu_b6','$mu_ab6','$mu_o6','$mu_a7','$mu_b7','$mu_ab7','$mu_o7','$mu2_a1',
'$mu2_b1','$mu2_ab1','$mu2_o1','$mu2_a2','$mu2_b2','$mu2_ab2','$mu2_o2','$mu2_a3','$mu2_b3','$mu2_ab3','$mu2_o3','$mu2_a4','$mu2_b4','$mu2_ab4','$mu2_o4',
'$mu2_a5','$mu2_b5','$mu2_ab5','$mu2_o5','$mu2_a6','$mu2_b6','$mu2_ab6','$mu2_o6','$mu2_a7','$mu2_b7','$mu2_ab7','$mu2_o7','$bu1','$bu2','$gerai_a1','$gerai_b1',
'$gerai_ab1','$gerai_o1','$gerai_a2','$gerai_b2','$gerai_ab2','$gerai_o2','$gerai_a3','$gerai_b3','$gerai_ab3','$gerai_o3','$gerai_a4','$gerai_b4',
'$gerai_ab4','$gerai_o4','$gerai_a5','$gerai_b5','$gerai_ab5','$gerai_o5','$gerai_a6','$gerai_b6','$gerai_ab6','$gerai_o6','$gerai_a7','$gerai_b7',
'$gerai_ab7','$gerai_o7','$petugas1','$petugas2','$petugas3','$petugas4','$catatan')";
$result=mysql_query($sql);

if($result){
include "home.php";
echo "";
}
else{
echo "ERROR";
}
?>