<?php
error_reporting (E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include '../adm/config.php';
include '../qrcode/qrlib.php';
$tempdir = "../temp/"; 
if (!file_exists($tempdir))
    mkdir($tempdir);

$idudd    = $_SESSION['idudd'];
$idunit   = $_SESSION['unit'];
$iduser   = $_SESSION['user'];
$transaksi = $_GET['id'];

$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$skg=DATE("Y-m-d");
$thn_skrg=DATE("Y");
$bln_skrg=DATE("m");
$tgl_skrg=DATE("d");
$bs=DATE("n",strtotime(DATE("Y-m-d")));
$sekarang=$tgl_skrg.' '.$bulan[$bs].' '.$thn_skrg;

$notrans=mysqli_query($con,"select * from v_antridonor where transaksi='$transaksi' limit 1");
$namaudd=mysqli_query($con,"select nama from utd where id='$idudd' limit 1");

if ($notrans) $trans=mysqli_fetch_assoc($notrans);
if ($namaudd) $udd=mysqli_fetch_assoc($namaudd);

$nomortrans = $trans['transaksi'];
QRCode::png($nomortrans,$tempdir.'trans.png','L',4,1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>PALANG MERAH INDONESIA</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta charset="utf-8" />
</head>

<body style="margin: 0;" onload="window.print()">
<!--body style="margin: 0;"-->

<div id="p1" style="overflow: hidden; position: relative; background-color: white; width: 1429px; height: 909px;">

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_1{left:48px;bottom:857px;letter-spacing:0.21px;}
#t2_1{left:48px;bottom:839px;letter-spacing:-0.1px;}
#t3E_1{left:1195px;bottom:834px;letter-spacing:0.11px;}
#t3_1{left:1295px;bottom:834px;letter-spacing:0.11px;}
#t4_1{left:363px;bottom:806px;letter-spacing:0.15px;}
#t5_1{left:456px;bottom:793px;letter-spacing:0.11px;}
#t6_1{left:48px;bottom:762px;letter-spacing:-0.13px;}
#t7_1{left:225px;bottom:761px;letter-spacing:-0.14px;}
#t8_1{left:870px;bottom:762px;letter-spacing:-0.11px;}
#t9_1{left:1048px;bottom:762px;letter-spacing:-0.14px;}
#ta_1{left:1230px;bottom:670px;letter-spacing:0.1px;}
#tb_1{left:1191px;bottom:622px;letter-spacing:4.21px;}
#tc_1{left:48px;bottom:733px;letter-spacing:-0.15px;}
#td_1{left:199px;bottom:733px;}
#te_1{left:211px;bottom:733px;letter-spacing:-0.14px;}
#tf_1{left:611px;bottom:733px;letter-spacing:-0.12px;}
#tg_1{left:732px;bottom:733px;letter-spacing:-0.13px;}
#th_1{left:611px;bottom:716px;letter-spacing:-0.13px;}
#ti_1{left:732px;bottom:716px;}
#tj_1{left:743px;bottom:716px;letter-spacing:-0.14px;}
#tk_1{left:611px;bottom:699px;letter-spacing:-0.13px;}
#tl_1{left:732px;bottom:699px;}
#tm_1{left:743px;bottom:699px;letter-spacing:-0.14px;}
#tn_1{left:611px;bottom:681px;letter-spacing:-0.15px;}

#tnn_1{left:611px;bottom:663px;letter-spacing:-0.15px;}
#tno_1{left:732px;bottom:663px;letter-spacing:-0.15px;}

#to_1{left:732px;bottom:681px;letter-spacing:-0.12px;}
#tp_1{left:48px;bottom:718px;letter-spacing:-0.14px;}
#tq_1{left:199px;bottom:718px;}
#tr_1{left:211px;bottom:718px;letter-spacing:-0.14px;}
#ts_1{left:48px;bottom:703px;letter-spacing:-0.12px;}
#tt_1{left:199px;bottom:703px;}
#tu_1{left:211px;bottom:703px;letter-spacing:-0.14px;}
#tv_1{left:48px;bottom:686px;letter-spacing:-0.15px;}
#tw_1{left:199px;bottom:686px;}
#tx_1{left:211px;bottom:686px;letter-spacing:-0.14px;}
#ty_1{left:48px;bottom:668px;letter-spacing:-0.12px;}
#tz_1{left:199px;bottom:668px;}
#t10_1{left:211px;bottom:668px;letter-spacing:-0.14px;}
#t11_1{left:48px;bottom:647px;letter-spacing:-0.12px;}
#t12_1{left:299px;bottom:647px;letter-spacing:-0.15px;}
#t13_1{left:359px;bottom:647px;letter-spacing:-0.15px;}
#t14_1{left:416px;bottom:647px;letter-spacing:-0.15px;}
#t15_1{left:472px;bottom:647px;letter-spacing:-0.15px;}
#t16_1{left:528px;bottom:647px;letter-spacing:-0.15px;}
#t17_1{left:48px;bottom:629px;letter-spacing:-0.12px;}
#t18_1{left:416px;bottom:629px;letter-spacing:-0.15px;}
#t19_1{left:472px;bottom:629px;letter-spacing:-0.12px;}
#t1a_1{left:48px;bottom:612px;letter-spacing:-0.12px;}
#t1b_1{left:559px;bottom:612px;letter-spacing:-0.15px;}
#t1c_1{left:619px;bottom:612px;letter-spacing:-0.12px;}
#t1d_1{left:48px;bottom:595px;letter-spacing:-0.11px;}
#t1e_1{left:940px;bottom:597px;letter-spacing:0.14px;}
#t1f_1{left:1368px;bottom:597px;}
#t1g_1{left:48px;bottom:570px;letter-spacing:0.1px;}
#t1h_1{left:565px;bottom:570px;letter-spacing:0.12px;}
#t1i_1{left:624px;bottom:570px;letter-spacing:0.1px;}
#t1j_1{left:48px;bottom:555px;letter-spacing:0.1px;}
#t1k_1{left:368px;bottom:555px;letter-spacing:0.06px;}
#t1l_1{left:567px;bottom:555px;letter-spacing:0.15px;}
#t1m_1{left:645px;bottom:555px;letter-spacing:0.06px;}
#t1n_1{left:48px;bottom:540px;letter-spacing:0.11px;}
#t1o_1{left:304px;bottom:540px;letter-spacing:0.06px;}
#t1p_1{left:567px;bottom:540px;letter-spacing:0.13px;}
#t1q_1{left:645px;bottom:540px;letter-spacing:0.06px;}
#t1r_1{left:48px;bottom:524px;letter-spacing:0.11px;}
#t1oa_1{left:304px;bottom:524px;letter-spacing:0.06px;}
#t1pa_1{left:567px;bottom:524px;letter-spacing:0.13px;}
#t1qa_1{left:645px;bottom:524px;letter-spacing:0.06px;}

#t1s_1{left:48px;bottom:509px;letter-spacing:0.11px;}
#t1t_1{left:256px;bottom:509px;letter-spacing:0.06px;}
#t1u_1{left:567px;bottom:509px;letter-spacing:0.15px;}
#t1v_1{left:645px;bottom:509px;letter-spacing:0.06px;}
#t1w_1{left:48px;bottom:494px;letter-spacing:0.11px;}
#t1x_1{left:262px;bottom:494px;letter-spacing:0.06px;}
#t1y_1{left:567px;bottom:494px;letter-spacing:0.13px;}
#t1z_1{left:645px;bottom:494px;letter-spacing:0.06px;}
#t20_1{left:48px;bottom:479px;letter-spacing:0.11px;}
#t21_1{left:48px;bottom:464px;letter-spacing:0.1px;}
#t22_1{left:228px;bottom:464px;letter-spacing:0.06px;}
#t23_1{left:567px;bottom:464px;letter-spacing:0.13px;}
#t24_1{left:645px;bottom:464px;letter-spacing:0.06px;}
#t25_1{left:48px;bottom:449px;letter-spacing:0.11px;}
#t26_1{left:48px;bottom:434px;letter-spacing:0.1px;}
#t27_1{left:400px;bottom:434px;letter-spacing:0.06px;}
#t28_1{left:567px;bottom:434px;letter-spacing:0.13px;}
#t29_1{left:645px;bottom:434px;letter-spacing:0.06px;}
#t2a_1{left:48px;bottom:420px;letter-spacing:0.11px;}
#t2b_1{left:48px;bottom:408px;letter-spacing:0.1px;}
#t2c_1{left:346px;bottom:408px;letter-spacing:0.06px;}
#t2d_1{left:567px;bottom:408px;letter-spacing:0.13px;}
#t2e_1{left:645px;bottom:408px;letter-spacing:0.06px;}
#t2f_1{left:48px;bottom:392px;letter-spacing:0.11px;}
#t2ca_1{left:346px;bottom:392px;letter-spacing:0.06px;}
#t2da_1{left:567px;bottom:392px;letter-spacing:0.13px;}
#t2ea_1{left:645px;bottom:392px;letter-spacing:0.06px;}


#t2g_1{left:48px;bottom:377px;letter-spacing:0.11px;}
#t2h_1{left:385px;bottom:377px;letter-spacing:0.06px;}
#t2i_1{left:567px;bottom:377px;letter-spacing:0.13px;}
#t2j_1{left:645px;bottom:377px;letter-spacing:0.06px;}
#t2k_1{left:48px;bottom:362px;letter-spacing:0.1px;}
#t2l_1{left:355px;bottom:362px;letter-spacing:0.06px;}
#t2m_1{left:567px;bottom:362px;letter-spacing:0.13px;}
#t2n_1{left:645px;bottom:362px;letter-spacing:0.06px;}
#t2o_1{left:48px;bottom:347px;letter-spacing:0.11px;}
#t2p_1{left:65px;bottom:332px;letter-spacing:0.1px;}
#t2q_1{left:242px;bottom:332px;letter-spacing:0.06px;}
#t2r_1{left:567px;bottom:332px;letter-spacing:0.13px;}
#t2s_1{left:645px;bottom:332px;letter-spacing:0.06px;}
#t2t_1{left:48px;bottom:317px;letter-spacing:0.11px;}
#t2u_1{left:48px;bottom:302px;letter-spacing:0.11px;}
#t2qa_1{left:242px;bottom:302px;letter-spacing:0.06px;}
#t2ra_1{left:567px;bottom:302px;letter-spacing:0.13px;}
#t2sa_1{left:645px;bottom:302px;letter-spacing:0.06px;}



#t2v_1{left:48px;bottom:286px;}
#t2w_1{left:76px;bottom:286px;letter-spacing:0.1px;}
#t2x_1{left:212px;bottom:286px;letter-spacing:0.06px;}
#t2y_1{left:567px;bottom:286px;letter-spacing:0.13px;}
#t2z_1{left:645px;bottom:286px;letter-spacing:0.06px;}
#t30_1{left:48px;bottom:271px;letter-spacing:0.11px;}
#t32a_1{left:334px;bottom:271px;letter-spacing:0.06px;}
#t33a_1{left:567px;bottom:271px;letter-spacing:0.13px;}
#t34a_1{left:645px;bottom:271px;letter-spacing:0.06px;}

#t31_1{left:48px;bottom:256px;letter-spacing:0.11px;}
#t32_1{left:334px;bottom:256px;letter-spacing:0.06px;}
#t33_1{left:567px;bottom:256px;letter-spacing:0.13px;}
#t34_1{left:645px;bottom:256px;letter-spacing:0.06px;}
#t35_1{left:48px;bottom:239px;letter-spacing:0.11px;}
#t32aa_1{left:334px;bottom:239px;letter-spacing:0.06px;}
#t33aa_1{left:567px;bottom:239px;letter-spacing:0.13px;}
#t34aa_1{left:645px;bottom:239px;letter-spacing:0.06px;}

#t36_1{left:48px;bottom:224px;letter-spacing:0.11px;}
#t37_1{left:329px;bottom:224px;letter-spacing:0.06px;}
#t38_1{left:567px;bottom:224px;letter-spacing:0.13px;}
#t39_1{left:645px;bottom:224px;letter-spacing:0.06px;}
#t3a_1{left:48px;bottom:208px;letter-spacing:0.11px;}
#t3b_1{left:348px;bottom:208px;letter-spacing:0.06px;}
#t3c_1{left:567px;bottom:208px;letter-spacing:0.13px;}
#t3d_1{left:645px;bottom:208px;letter-spacing:0.06px;}
#t3e_1{left:48px;bottom:193px;letter-spacing:0.1px;}
#t3f_1{left:337px;bottom:193px;letter-spacing:0.06px;}
#t3g_1{left:567px;bottom:193px;letter-spacing:0.13px;}
#t3h_1{left:645px;bottom:193px;letter-spacing:0.06px;}
#t3i_1{left:48px;bottom:178px;letter-spacing:0.1px;}
#t3j_1{left:379px;bottom:178px;letter-spacing:0.06px;}
#t3k_1{left:567px;bottom:178px;letter-spacing:0.13px;}
#t3l_1{left:645px;bottom:178px;letter-spacing:0.06px;}
#t3m_1{left:48px;bottom:163px;letter-spacing:0.11px;}
#t3n_1{left:65px;bottom:148px;letter-spacing:0.23px;}
#t3o_1{left:246px;bottom:148px;letter-spacing:0.13px;}
#t3p_1{left:567px;bottom:148px;letter-spacing:0.13px;}
#t3q_1{left:645px;bottom:148px;letter-spacing:0.06px;}
#t3r_1{left:48px;bottom:133px;letter-spacing:0.11px;}
#t3s_1{left:381px;bottom:133px;letter-spacing:0.06px;}
#t3t_1{left:567px;bottom:133px;letter-spacing:0.13px;}
#t3u_1{left:645px;bottom:133px;letter-spacing:0.06px;}
#t3v_1{left:48px;bottom:108px;letter-spacing:-0.15px;}
#t3w_1{left:48px;bottom:89px;letter-spacing:0.11px;}
#t3x_1{left:48px;bottom:72px;letter-spacing:0.11px;}
#t3y_1{left:48px;bottom:55px;letter-spacing:0.1px;}
#t3z_1{left:48px;bottom:37px;letter-spacing:0.1px;}
#t40_1{left:48px;bottom:20px;letter-spacing:0.1px;}
#t41_1{left:745px;bottom:570px;letter-spacing:0.11px;}
#t42_1{left:1224px;bottom:570px;letter-spacing:0.12px;}
#t43_1{left:1282px;bottom:570px;letter-spacing:0.1px;}
#t44_1{left:745px;bottom:555px;letter-spacing:0.11px;}
#t45_1{left:1150px;bottom:555px;letter-spacing:0.06px;}
#t46_1{left:1226px;bottom:555px;letter-spacing:0.13px;}
#t47_1{left:1304px;bottom:555px;letter-spacing:0.06px;}
#t48_1{left:745px;bottom:540px;letter-spacing:0.11px;}
#t4ab_1{left:935px;bottom:540px;letter-spacing:0.06px;}
#t4bb_1{left:1226px;bottom:540px;letter-spacing:0.13px;}
#t4cb_1{left:1304px;bottom:540px;letter-spacing:0.06px;}

#t49_1{left:745px;bottom:525px;letter-spacing:0.11px;}
#t4a_1{left:935px;bottom:525px;letter-spacing:0.06px;}
#t4b_1{left:1226px;bottom:525px;letter-spacing:0.13px;}
#t4c_1{left:1304px;bottom:525px;letter-spacing:0.06px;}
#t4d_1{left:745px;bottom:509px;letter-spacing:0.1px;}
#t4e_1{left:1226px;bottom:509px;letter-spacing:0.13px;}
#t4f_1{left:1304px;bottom:509px;letter-spacing:0.06px;}
#t4g_1{left:745px;bottom:494px;letter-spacing:0.11px;}
#t4h_1{left:767px;bottom:479px;letter-spacing:0.1px;}
#t4i_1{left:911px;bottom:479px;letter-spacing:0.06px;}
#t4j_1{left:1226px;bottom:479px;letter-spacing:0.13px;}
#t4k_1{left:1304px;bottom:479px;letter-spacing:0.06px;}
#t4l_1{left:745px;bottom:464px;letter-spacing:0.1px;}
#t4m_1{left:1081px;bottom:464px;letter-spacing:0.06px;}
#t4n_1{left:1226px;bottom:464px;letter-spacing:0.13px;}
#t4o_1{left:1304px;bottom:464px;letter-spacing:0.06px;}
#t4p_1{left:745px;bottom:449px;letter-spacing:0.1px;}
#t4q_1{left:924px;bottom:449px;letter-spacing:0.06px;}
#t4r_1{left:1226px;bottom:449px;letter-spacing:0.13px;}
#t4s_1{left:1304px;bottom:449px;letter-spacing:0.06px;}
#t4t_1{left:745px;bottom:434px;letter-spacing:0.1px;}

#t4x_1{left:745px;bottom:421px;letter-spacing:0.11px;}
#t4u_1{left:1081px;bottom:421px;letter-spacing:0.06px;}
#t4v_1{left:1226px;bottom:421px;letter-spacing:0.13px;}
#t4w_1{left:1304px;bottom:421px;letter-spacing:0.06px;}


#t4y_1{left:745px;bottom:408px;letter-spacing:0.1px;}
#t4z_1{left:952px;bottom:408px;letter-spacing:0.06px;}
#t50_1{left:1226px;bottom:408px;letter-spacing:0.13px;}
#t51_1{left:1304px;bottom:408px;letter-spacing:0.06px;}
#t52_1{left:745px;bottom:392px;letter-spacing:0.1px;}
#t53_1{left:1103px;bottom:392px;letter-spacing:0.06px;}
#t54_1{left:1226px;bottom:392px;letter-spacing:0.13px;}
#t55_1{left:1304px;bottom:392px;letter-spacing:0.06px;}
#t56_1{left:745px;bottom:377px;letter-spacing:0.1px;}
#t57_1{left:1062px;bottom:377px;letter-spacing:0.06px;}
#t58_1{left:1226px;bottom:377px;letter-spacing:0.13px;}
#t59_1{left:1304px;bottom:377px;letter-spacing:0.06px;}
#t5a_1{left:745px;bottom:362px;letter-spacing:0.11px;}
#t5b_1{left:1170px;bottom:362px;letter-spacing:0.06px;}
#t5c_1{left:1226px;bottom:362px;letter-spacing:0.13px;}
#t5d_1{left:1304px;bottom:362px;letter-spacing:0.06px;}
#t5e_1{left:745px;bottom:347px;letter-spacing:0.1px;}
#t5f_1{left:1134px;bottom:347px;letter-spacing:0.06px;}
#t5g_1{left:1226px;bottom:347px;letter-spacing:0.13px;}
#t5h_1{left:1304px;bottom:347px;letter-spacing:0.06px;}
#t5i_1{left:745px;bottom:332px;letter-spacing:0.12px;}
#t5j_1{left:745px;bottom:317px;letter-spacing:0.1px;}
#t5k_1{left:1003px;bottom:317px;letter-spacing:0.06px;}
#t5l_1{left:1226px;bottom:317px;letter-spacing:0.13px;}
#t5m_1{left:1304px;bottom:317px;letter-spacing:0.06px;}
#t5n_1{left:745px;bottom:302px;letter-spacing:0.1px;}
#t5o_1{left:1000px;bottom:302px;letter-spacing:0.06px;}
#t5p_1{left:1226px;bottom:302px;letter-spacing:0.13px;}
#t5q_1{left:1304px;bottom:302px;letter-spacing:0.06px;}
#t5r_1{left:745px;bottom:286px;letter-spacing:0.1px;}
#t5s_1{left:1008px;bottom:286px;letter-spacing:0.06px;}
#t5t_1{left:1226px;bottom:286px;letter-spacing:0.13px;}
#t5u_1{left:1304px;bottom:286px;letter-spacing:0.06px;}
#t5v_1{left:745px;bottom:271px;letter-spacing:0.1px;}
#t5w_1{left:1006px;bottom:271px;letter-spacing:0.06px;}
#t5x_1{left:1226px;bottom:271px;letter-spacing:0.13px;}
#t5y_1{left:1304px;bottom:271px;letter-spacing:0.06px;}
#t5z_1{left:745px;bottom:256px;letter-spacing:0.11px;}
#t60_1{left:1021px;bottom:256px;letter-spacing:0.06px;}
#t61_1{left:1226px;bottom:256px;letter-spacing:0.13px;}
#t62_1{left:1304px;bottom:256px;letter-spacing:0.06px;}
#t63_1{left:745px;bottom:239px;letter-spacing:0.11px;}
#t64_1{left:1015px;bottom:239px;letter-spacing:0.06px;}
#t65_1{left:1226px;bottom:239px;letter-spacing:0.13px;}
#t66_1{left:1304px;bottom:239px;letter-spacing:0.06px;}
#t67_1{left:745px;bottom:224px;letter-spacing:0.1px;}
#t68_1{left:881px;bottom:224px;letter-spacing:0.06px;}
#t69_1{left:1226px;bottom:224px;letter-spacing:0.13px;}
#t6a_1{left:1304px;bottom:224px;letter-spacing:0.06px;}
#t6b_1{left:745px;bottom:208px;letter-spacing:0.1px;}
#t6c_1{left:873px;bottom:208px;letter-spacing:0.06px;}
#t6d_1{left:1226px;bottom:208px;letter-spacing:0.13px;}
#t6e_1{left:1304px;bottom:208px;letter-spacing:0.06px;}
#t6f_1{left:745px;bottom:193px;letter-spacing:0.1px;}
#t6g_1{left:870px;bottom:193px;letter-spacing:0.06px;}
#t6h_1{left:1226px;bottom:193px;letter-spacing:0.13px;}
#t6i_1{left:1304px;bottom:193px;letter-spacing:0.06px;}
#t6j_1{left:745px;bottom:178px;letter-spacing:0.11px;}
#t6k_1{left:1008px;bottom:178px;letter-spacing:0.06px;}
#t6l_1{left:1226px;bottom:178px;letter-spacing:0.13px;}
#t6m_1{left:1304px;bottom:178px;letter-spacing:0.06px;}
#t6n_1{left:745px;bottom:163px;letter-spacing:0.11px;}
#t6o_1{left:1129px;bottom:163px;letter-spacing:0.06px;}
#t6p_1{left:1226px;bottom:163px;letter-spacing:0.13px;}
#t6q_1{left:1304px;bottom:163px;letter-spacing:0.06px;}
#t6r_1{left:745px;bottom:148px;letter-spacing:0.1px;}
#t6s_1{left:1086px;bottom:148px;letter-spacing:0.06px;}
#t6t_1{left:1226px;bottom:148px;letter-spacing:0.13px;}
#t6u_1{left:1304px;bottom:148px;letter-spacing:0.06px;}
#t6v_1{left:745px;bottom:133px;letter-spacing:0.1px;}
#t6w_1{left:902px;bottom:133px;letter-spacing:0.06px;}
#t6x_1{left:1226px;bottom:133px;letter-spacing:0.13px;}
#t6y_1{left:1304px;bottom:133px;letter-spacing:0.06px;}

#t6va_1{left:745px;bottom:118px;letter-spacing:0.1px;}
#t6wa_1{left:902px;bottom:118px;letter-spacing:0.06px;}
#t6xa_1{left:1226px;bottom:118px;letter-spacing:0.13px;}
#t6ya_1{left:1304px;bottom:118px;letter-spacing:0.06px;}

#t6z_1{left:927px;bottom:89px;letter-spacing:0.12px;}
#t70_1{left:927px;bottom:25px;letter-spacing:0.06px;}
#t71_1{left:1182px;bottom:89px;letter-spacing:0.12px;}
#t72_1{left:1182px;bottom:25px;letter-spacing:0.12px;}
#t73_1{left:4px;bottom:1px;letter-spacing:-0.24px;}

.s1{font-size:21px;font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:bold;}
.s2{font-size:17px;font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:bold;}
.s3{font-size:12px;font-family:Helvetica, Arial, sans-serif;color:#000;}
.s4{font-size:15px;font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:bold;}
.s5{font-size:14px;font-family:Helvetica, Arial, sans-serif;color:#000;}
.s6{font-size:14px;font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:bold;}
.s7{font-size:12px;font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:bold;}
.s8{font-size:11px;font-family:Helvetica, Arial, sans-serif;color:#000;}
.s9{font-size:2px;font-family:Helvetica, Arial, sans-serif;color:rgba(0,0,0,0);}
</style>
<!-- End inline CSS -->

<!-- Begin page background -->
<div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg1" style="-webkit-user-select: none;"><object width="1429" height="909" data="1/1.svg" type="image/svg+xml" id="pdf1" style="width:1429px; height:909px; -moz-transform:scale(1); z-index: 0;"></object></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_1" class="t s1"><?php echo $udd['nama'];?></span>
<span id="t2_1" class="t s2">Formulir Kuesioner dan Informed Consent Donor </span>
<span id="t3E_1" class="t s3">No. Dokumen : UDDSKA-PD-L4-001<br>Tgl. Berlaku : 01 MAR 2022<br>Tgl. Kaji Ulang : 01 MAR 2024<br>Halaman 1 dari 2 </span>
<!--span id="t3_1" class="t s3">Halaman 1 dari 2 </span-->
<span id="t4_1" class="t s4">Selamat Datang, Terima Kasih Atas Kesediaan Anda Meluangkan Waktu Untuk Menyumbangkan Darah </span>
<span id="t5_1" class="t s3">Mohon Formulir ini Diisi Dengan Sejujurnya Untuk Keselamatan Anda dan Calon Penerima Darah Anda </span>
<span id="t6_1" class="t s5">Tempat Penyumbangan : </span><span id="t7_1" class="t s6"><?php echo $udd['nama'];?> </span><span id="t8_1" class="t s5">Tanggal Donor : </span><span id="t9_1" class="t s5"><?php echo $sekarang;?> </span>
<span id="ta_1" class="t s3" align="center">No. Antrian : <br><font style="font-size:40px"><?php echo $trans['nomor'];?></font><?php QRcode::png($nomortrans, QR_ECLEVEL_M, 2);?></span>
<span id="tb_1" class="t s3" align="right"> Transaksi : <img src="../temp/trans.png" width="50px"><br><?php echo $trans['transaksi'];?></span>
<span id="tc_1" class="t s5">No.KTP </span><span id="td_1" class="t s5">: </span><span id="te_1" class="t s5"><?php echo $trans['NoKTP'];?> </span>
<span id="tf_1" class="t s5">No. Kartu Donor </span><span id="tg_1" class="t s5">: <?php echo $trans['pendonor'];?> </span>
<span id="th_1" class="t s5">Pekerjaan </span><span id="ti_1" class="t s5">: </span><span id="tj_1" class="t s5"><?php echo $trans['Pekerjaan'];?> </span>
<span id="tk_1" class="t s5">Alamat </span><span id="tl_1" class="t s5">: </span><span id="tm_1" class="t s5"><?php echo $trans['Alamat'].' '.$trans['kelurahan'].' '.$trans['kecamatan'].', '.$trans['wilayah'];?> </span>
<span id="tn_1" class="t s5">Nomor Telp</span><span id="to_1" class="t s5">: <?php echo $trans['telp2'];?></span>
<span id="tnn_1" class="t s5">Gol. Darah</span><span id="tno_1" class="t s5">: <b><?php echo $trans['GolDarah'].'('.$trans['Rhesus'].')';?></b></span>


<span id="tp_1" class="t s5">Nama Lengkap Donor </span><span id="tq_1" class="t s5">: </span><span id="tr_1" class="t s5"><b><?php echo $trans['nama'];?></b> </span>
<span id="ts_1" class="t s5">Tempat, Tanggal Lahir </span><span id="tt_1" class="t s5">: </span><span id="tu_1" class="t s5"><?php echo $trans['TempatLhr'].', '.$trans['TglLhr'];?> </span>
<span id="tv_1" class="t s5">Umur </span><span id="tw_1" class="t s5">: </span><span id="tx_1" class="t s5"><?php echo $trans['umur'].' Tahun';?> </span>
<span id="ty_1" class="t s5">Jenis Kelamin </span><span id="tz_1" class="t s5">: </span><span id="t10_1" class="t s5"><?php if ($trans['Jk']==0){ echo 'Laki-laki';} else { echo 'Perempuan';};?> </span>
<span id="t11_1" class="t s5">Penghargaan yang telah diterima : </span><span id="t12_1" class="t s5">10X </span><span id="t13_1" class="t s5">25X </span><span id="t14_1" class="t s5">50X </span><span id="t15_1" class="t s5">75X </span><span id="t16_1" class="t s5">100X </span>
<span id="t17_1" class="t s5">Bersediakah saudara donor pada waktu bulan puasa : </span><span id="t18_1" class="t s5">Ya </span><span id="t19_1" class="t s5">Tidak </span>
<span id="t1a_1" class="t s5">Bersediakah saudara donor saat dibutuhkan untuk komponen darah tertentu : </span><span id="t1b_1" class="t s5">Ya </span><span id="t1c_1" class="t s5">Tidak </span>
<span id="t1d_1" class="t s5">Sekarang Donor yang ke : <?php echo $trans['donorke'].' kali';?> </span>
<span id="t1e_1" class="t s4">Pilih dan Lengkapi Jawaban Anda dengan Tanda Centang </span><span id="t1f_1" class="t s4">V </span>
<span id="t1g_1" class="t s7">Dalam Hari Ini : </span><span id="t1h_1" class="t s7">Jawaban </span><span id="t1i_1" class="t s7">Diisi Petugas: </span>
<span id="t1j_1" class="t s3">1. Merasa sehat, tidak sedang flu/ batuk/ demam/ pusing ? </span><span id="t1k_1" class="t s3">..................................................... </span><span id="t1l_1" class="t s3"><?php echo $trans['satu'];?> </span><span id="t1m_1" class="t s3">................. </span>
<span id="t1n_1" class="t s3">2. Sedang minum antibiotik?</span><span id="t1o_1" class="t s3">........................................................................ </span><span id="t1p_1" class="t s3"><?php echo $trans['dua'];?> </span><span id="t1q_1" class="t s3">................. </span>
<span id="t1r_1" class="t s3">3. Sedang minum obat lain untuk infeksi?</span><span id="t1oa_1" class="t s3">........................................................................ </span><span id="t1pa_1" class="t s3"><?php echo $trans['tiga'];?> </span><span id="t1qa_1" class="t s3">................. </span>
<span id="t1s_1" class="t s3"><b>Dalam 48 jam</b></span>
<span id="t1w_1" class="t s3">4. Apakah anda sedang minum aspirin atau obat yang mengandung aspirin ?</span><span id="t1x_1" class="t s3">.................................................................................... </span><span id="t1y_1" class="t s3"><?php echo $trans['empat'];?> </span><span id="t1z_1" class="t s3">................. </span>
<span id="t20_1" class="t s7">Dalam waktu 1 minggu terakhir </span>
<span id="t21_1" class="t s3">5. Apakah anda mengalami sakit kepala dan demam bersamaan? </span><span id="t22_1" class="t s3">.............................................................................................. </span><span id="t23_1" class="t s3"><?php echo $trans['lima'];?> </span><span id="t24_1" class="t s3">................. </span>
<span id="t25_1" class="t s7">(Untuk Wanita) Dalam 6 minggu terakhir</span>
<span id="t26_1" class="t s3">6. Apakah saat ini Anda sedang Hamil? </span><span id="t27_1" class="t s3">.......................................... </span><span id="t28_1" class="t s3"><?php echo $trans['enam'];?> </span><span id="t29_1" class="t s3">................. </span>
<span id="t2a_1" class="t s7">Dalam 8 minggu terakhir </span>
<span id="t2b_1" class="t s3">7. Apakah Anda mendonorkan darah lengkap?</span><span id="t2c_1" class="t s3">........................................................... </span><span id="t2d_1" class="t s3"><?php echo $trans['tujuh'];?> </span><span id="t2e_1" class="t s3">................. </span>
<span id="t2f_1" class="t s3">8. Apakah Anda mendonorkan darah,trombosit atau plasma ? </span><span id="t2ca_1" class="t s3">........................................................... </span><span id="t2da_1" class="t s3"><?php echo $trans['delapan'];?> </span><span id="t2ea_1" class="t s3">................. </span>
<span id="t2g_1" class="t s3">9. Apakah anda pernah kontak dengan orang yang pernah menerima vaksinasi smallpox? </span><span id="t2h_1" class="t s3">............................................... </span><span id="t2i_1" class="t s3"><?php echo $trans['sembilan'];?> </span><span id="t2j_1" class="t s3">................. </span>
<span id="t2k_1" class="t s3"><b>Dalam 16 minggu terakhir</b></span>
<span id="t2o_1" class="t s3">10. Apakah anda mendonorkan 2 kantong sel darah merah </span>
<span id="t2p_1" class="t s3">- melalui proses aferesis ?</span><span id="t2q_1" class="t s3">.......................................................................................... </span><span id="t2r_1" class="t s3"><?php echo $trans['sepuluh'];?> </span><span id="t2s_1" class="t s3">................. </span>
<span id="t2t_1" class="t s7">Dalam 6 bulan terakhir </span>
<span id="t2u_1" class="t s3">11. Apakah anda pernah mengunjungi daerah endemis malaria? </span><span id="t2qa_1" class="t s3">.......................................................................................... </span><span id="t2ra_1" class="t s3"><?php echo $trans['sebls'];?> </span><span id="t2sa_1" class="t s3">................. </span>
<span id="t2v_1" class="t s3"><b>Dalam 12 bulan terakhir</b></span>
<span id="t30_1" class="t s3">12. Apakah anda pernah menerima transfusi darah ? </span><span id="t32a_1" class="t s3">.............................................................. </span><span id="t33a_1" class="t s3"><?php echo $trans['duabls'];?> </span><span id="t34a_1" class="t s3">................. </span>
<span id="t31_1" class="t s3">13. Apakah anda pernah mendapat transplantasi, organ, jaringan atau sumsum tulang?</span><span id="t32_1" class="t s3">.............................................................. </span><span id="t33_1" class="t s3"><?php echo $trans['tigabls'];?> </span><span id="t34_1" class="t s3">................. </span>
<span id="t35_1" class="t s3">14. Apakah anda pernah cangkok organ ?</span><span id="t32aa_1" class="t s3">.............................................................. </span><span id="t33aa_1" class="t s3"><?php echo $trans['empatbls'];?> </span><span id="t34aa_1" class="t s3">................. </span>
<span id="t36_1" class="t s3">15. Apakah anda pernah tertusuk jarum medis?</span><span id="t37_1" class="t s3">................................................................ </span><span id="t38_1" class="t s3"><?php echo $trans['limabls'];?> </span><span id="t39_1" class="t s3">................. </span>
<span id="t3a_1" class="t s3">16. Apakah anda pernah berhubungan seksual dengan orang dengan HIV/AIDS ?</span><span id="t3b_1" class="t s3">.......................................................... </span><span id="t3c_1" class="t s3"><?php echo $trans['enamtbls'];?> </span><span id="t3d_1" class="t s3">................. </span>
<span id="t3e_1" class="t s3">17. Apakah anda pernah berhubungan seks dengan pekerja seks komersial?</span><span id="t3f_1" class="t s3">.............................................................. </span><span id="t3g_1" class="t s3"><?php echo $trans['tujuhbls'];?> </span><span id="t3h_1" class="t s3">................. </span>
<span id="t3i_1" class="t s3">18. Apakah anda pernah berhubungan seks dengan penggunaan narkoba jarum suntik? </span><span id="t3j_1" class="t s3">................................................. </span><span id="t3k_1" class="t s3"><?php echo $trans['delapanbls'];?> </span><span id="t3l_1" class="t s3">................. </span>
<span id="t3m_1" class="t s3">19. Apakah anda pernah berhubungan seks dengan pengguna konsentrat  </span>
<span id="t3n_1" class="t s8">- faktor pembekuan?</span><span id="t3o_1" class="t s8">.............................................................................................. </span><span id="t3p_1" class="t s3"><?php echo $trans['sembilanbls'];?> </span><span id="t3q_1" class="t s3">................. </span>
<span id="t3r_1" class="t s3">20. <b>Wanita</b>, Apakah anda pernah berhububgan seks dengan laki-laki biseksual?</span><span id="t3s_1" class="t s3">................................................ </span><span id="t3t_1" class="t s3"><?php echo $trans['duapuluh'];?> </span><span id="t3u_1" class="t s3">................. </span>
<span id="t3v_1" class="t s8">Yth. <?php echo $udd['nama'];?> </span>
<span id="t3w_1" class="t s3">Saya telah mendapatkan dan membaca semua informasi yang diberikan serta menjawab pertanyaan dengan jujur. Saya mengerti dan bersedia </span>
<span id="t3x_1" class="t s3">meyumbangkan darah dengan volume sesuai standar yang diberlakukan dan setuju diambil contoh darahnya untuk keperluan pemeriksaan </span>
<span id="t3y_1" class="t s3">laboratorium berupa uji golongan darah, HIV, Hepatitis B, Hepatitis C, Sifilis dan infeksi lainnya yang diperlukan saya serta untuk kepentingan </span>
<span id="t3z_1" class="t s3">penelitian. Bila ternyata hasil pemeriksaan laboratorium perlu ditindaklanjuti, maka saya setuju untuk diberi kabar tertulis. Jika komponen plasma </span>
<span id="t40_1" class="t s3">tidak terpakai untuk transfusi, saya setuju dapat dijadikan produk plasma untuk pengobatan </span>
<span id="t41_1" class="t s7">Dalam 12 bulan terakhir </span><span id="t42_1" class="t s7">Jawaban </span><span id="t43_1" class="t s7">Diisi Petugas: </span>
<span id="t44_1" class="t s3">21. Apakah anda pernah berhubungan dengan penderita hepatitis?</span><span id="t45_1" class="t s3">................ </span><span id="t46_1" class="t s3"><?php echo $trans['duasatu'];?> </span><span id="t47_1" class="t s3">................. </span>
<span id="t48_1" class="t s3">22. Apakah anda pernah tinggal bersama penderita hepatitis? </span><span id="t4ab_1" class="t s3">................................................................................ </span><span id="t4bb_1" class="t s3"><?php echo $trans['duadua'];?> </span><span id="t4cb_1" class="t s3">................. </span>
<span id="t49_1" class="t s3">23. Apakah anda memiliki tatto?</span><span id="t4a_1" class="t s3">................................................................................ </span><span id="t4b_1" class="t s3"><?php echo $trans['duatiga'];?> </span><span id="t4c_1" class="t s3">................. </span>
<span id="t4d_1" class="t s3">24. Apakah anda menindik telinga atau bagian tubuh lainnya?................................... </span><span id="t4e_1" class="t s3"><?php echo $trans['duaempat'];?> </span><span id="t4f_1" class="t s3">................. </span>
<span id="t4g_1" class="t s3">25. Apakah anda sedang atau pernah mendapatkan </span>
<span id="t4h_1" class="t s3">pengobatan Sifilis atau GO (Kencing Nanah)?</span><span id="t4i_1" class="t s3">....................................................................................... </span><span id="t4j_1" class="t s3"><?php echo $trans['dualima'];?> </span><span id="t4k_1" class="t s3">................. </span>
<span id="t4l_1" class="t s3">26. Apakah anda pernah ditahan/dipenjara dalam waktu 72 jam?</span><span id="t4m_1" class="t s3">.................................... </span><span id="t4n_1" class="t s3"><?php echo $trans['duaenam'];?> </span><span id="t4o_1" class="t s3">................. </span>
<span id="t4p_1" class="t s3">27. Apakah anda menetap diberbagai alamat yang berbeda?</span><span id="t4q_1" class="t s3">................................................................................... </span><span id="t4r_1" class="t s3"><?php echo $trans['duatujuh'];?> </span><span id="t4s_1" class="t s3">................. </span>
<span id="t4t_1" class="t s3"><b>Dalam 3 tahun terakhir</b></span>
<span id="t4x_1" class="t s3">28. Apakah anda pernah berada diluar wilayah Indonesia? </span><span id="t4u_1" class="t s3">.................................... </span><span id="t4v_1" class="t s3"><?php echo $trans['duadelapan'];?> </span><span id="t4w_1" class="t s3">................. </span>
<span id="t4y_1" class="t s7">Tahun 1980 hingga sekarang</span>
<span id="t52_1" class="t s3">29. Apakah anda tinggal selama 5 tahun atau lebih di Eropa?</span><span id="t53_1" class="t s3">............................. </span><span id="t54_1" class="t s3"><?php echo $trans['duasembilan'];?> </span><span id="t55_1" class="t s3">................. </span>
<span id="t56_1" class="t s3">30. Apakah anda pernah menerima transfusi darah di Inggris?</span><span id="t57_1" class="t s3">......................................... </span><span id="t58_1" class="t s3"><?php echo $trans['tigapuluh'];?> </span><span id="t59_1" class="t s3">................. </span>
<span id="t5a_1" class="t s7">Dari tahun 1980 sampai dengan 1996</span>
<span id="t5e_1" class="t s3">31. Apakah anda tinggal selama 3 bulan atau lebih di Inggris?</span><span id="t5f_1" class="t s3">..................... </span><span id="t5g_1" class="t s3"><?php echo $trans['yigasatu'];?> </span><span id="t5h_1" class="t s3">................. </span>
<span id="t5i_1" class="t s7">Apakah Anda Pernah </span>
<span id="t5j_1" class="t s3">32. Menerima uang, obat, atau pembayaran lainnya untuk seks?</span><span id="t5k_1" class="t s3">........................................................... </span><span id="t5l_1" class="t s3"><?php echo $trans['tigadua'];?> </span><span id="t5m_1" class="t s3">................. </span>
<span id="t5n_1" class="t s3">33. <b>Laki-laki : </b>Pernah berhubungan seksual dengan laki-laki, walaupun sekali?</span><span id="t5o_1" class="t s3">........................................................... </span><span id="t5p_1" class="t s3"><?php echo $trans['tigatiga'];?> </span><span id="t5q_1" class="t s3">................. </span>
<span id="t5r_1" class="t s3">34. Pernah mendapat hasil Positif untuk test HIV/AIDS?</span><span id="t5s_1" class="t s3">......................................................... </span><span id="t5t_1" class="t s3"><?php echo $trans['tigaempat'];?> </span><span id="t5u_1" class="t s3">................. </span>
<span id="t5v_1" class="t s3">35. Pernah melakukan bekam/fasdhu?</span><span id="t5w_1" class="t s3">.......................................................... </span><span id="t5x_1" class="t s3"><?php echo $trans['tigalima'];?> </span><span id="t5y_1" class="t s3">................. </span>
<span id="t5z_1" class="t s3">36. Menggunakan jarum suntik untuk obat-obatan yang tidak diresepkan dokter?</span><span id="t60_1" class="t s3">...................................................... </span><span id="t61_1" class="t s3"><?php echo $trans['tigaenam'];?> </span><span id="t62_1" class="t s3">................. </span>
<span id="t63_1" class="t s3">37. Menggunakan konsentrat faktor pembekuan?</span><span id="t64_1" class="t s3">........................................................ </span><span id="t65_1" class="t s3"><?php echo $trans['tigatujuh'];?> </span><span id="t66_1" class="t s3">................. </span>
<span id="t67_1" class="t s3">38. Menderita Hepatitis ?</span><span id="t68_1" class="t s3">............................................................................................... </span><span id="t69_1" class="t s3"><?php echo $trans['tigadelapan'];?> </span><span id="t6a_1" class="t s3">................. </span>
<span id="t6b_1" class="t s3">39. Menderita Malaria ?</span><span id="t6c_1" class="t s3">................................................................................................. </span><span id="t6d_1" class="t s3"><?php echo $trans['tigasembilan'];?> </span><span id="t6e_1" class="t s3">................. </span>
<span id="t6f_1" class="t s3">40. Menderita kanker termasuk leukimia ?</span><span id="t6g_1" class="t s3">.................................................................................................. </span><span id="t6h_1" class="t s3"><?php echo $trans['empatpuluh'];?> </span><span id="t6i_1" class="t s3">................. </span>
<span id="t6j_1" class="t s3">41. Bermasalah dengan jantung dan paru-paru ?</span><span id="t6k_1" class="t s3">......................................................... </span><span id="t6l_1" class="t s3"><?php echo $trans['empatsatu'];?> </span><span id="t6m_1" class="t s3">................. </span>
<span id="t6n_1" class="t s3">42. Menderita pendarahan atau penyakit berhubungan dengan darah ?</span><span id="t6o_1" class="t s3">...................... </span><span id="t6p_1" class="t s3"><?php echo $trans['empatdua'];?> </span><span id="t6q_1" class="t s3">................. </span>
<span id="t6r_1" class="t s3">43. Berhubungan seksual dengan orang yang tinggal di Afrika?</span><span id="t6s_1" class="t s3">................................... </span><span id="t6t_1" class="t s3"><?php echo $trans['empattiga'];?> </span><span id="t6u_1" class="t s3">................. </span>
<span id="t6v_1" class="t s3">44. Pernah tinggal di Afrika ?</span><span id="t6w_1" class="t s3">........................................................................................ </span><span id="t6x_1" class="t s3"><?php echo $trans['empatempat'];?> </span><span id="t6y_1" class="t s3">................. </span>



<span id="t6z_1" class="t s7">Tanda Tangan Petugas </span>
<span id="t70_1" class="t s3">.......................................... </span>
<span id="t71_1" class="t s7">Tanda Tangan Pendonor </span>
<span id="t72_1" class="t s3"><b><?php echo $trans['nama'];?></b></span>
<!-- End text definitions -->


<?php mysqli_close()?>
<META http-equiv="refresh" content="0; url=donordarah.php">
</div>
</body>
</html>
