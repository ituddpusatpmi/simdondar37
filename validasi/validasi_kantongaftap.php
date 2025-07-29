<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$jamskr=new DateTime(date("Y-m-d H:i:s"));
$hariini = date("Y-m-d");
?>
<!DOCTYPE html>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<html>
<head>
    <style>
        tr { background-color: #ffffff;}
        .initial { background-color: #ffffff; color:#000000 }
        .normal { background-color: #ffffff; }
        .highlight { background-color: #7CFC00 }
    </style>

    <style>
        .control {
            font-family: arial;
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 2px;
            padding-top: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        .control input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }
        .control_indicator {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e6e6e6;
            border: 0px solid #000000;
        }
        .control-radio .control_indicator {
            border-radius: undefined%;
        }

        .control:hover input ~ .control_indicator,
        .control input:focus ~ .control_indicator {
            background: #cccccc;
        }

        .control input:checked ~ .control_indicator {
            background: #ff0000;
        }
        .control:hover input:not([disabled]):checked ~ .control_indicator,
        .control input:checked:focus ~ .control_indicator {
            background: #0e6647d;
        }
        .control input:disabled ~ .control_indicator {
            background: #e6e6e6;
            opacity: 0.6;
            pointer-events: none;
        }
        .control_indicator:after {
            box-sizing: unset;
            content: '';
            position: absolute;
            display: none;
        }
        .control input:checked ~ .control_indicator:after {
            display: block;
        }
        .control-checkbox .control_indicator:after {
            left: 8px;
            top: 4px;
            width: 3px;
            height: 8px;
            border: solid #ffffff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .control-checkbox input:disabled ~ .control_indicator:after {
            border-color: #7b7b7b;
        }
    </style>

<style type="text/css">
	.styled-select select {
        background-color: #F0FFFF; border: none;width: auto;padding: 3px;font-size: 16px;cursor: pointer;
    }
</style>
<style>
    table {
    border-collapse: collapse;
    }
    table, th, td {
    border: 1px solid brown;
    }
</style>
<style>
body {font-family: "Lato", sans-serif;}
.tablink {
    background-color: red;
    color: white;
    float: left;
    border: 1px solid brown;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 15px;
    width: 16.6%;
}
.tablink:hover {
    background-color: #777;
}
/* Style the tab content */
.tabcontent {
    color: red;
    display: none;
    padding: 10px;
    border: 1px solid brown;
}
#visual {background-color:white;}
#kantong {background-color:white;}
#pemeriksaan {background-color:white;}
#pengolahan {background-color:white;}
#trace {background-color:white;}
#history {background-color:white;}
</style>

</head>
<body>
<?php
if(isset($_POST['Button']))  {
    $id_timbang=$_GET['id'];
    $nkt=$_GET['nokantong'];
    $mode_kembali=$_GET['mode'];
    
    $v_rspek_kantong = (isset($_POST['spek_kantong'])) ? 1 : 0;
    $v_rselang=(isset($_POST['selang'])) ? 1 : 0;
    $v_rkebocoran=(isset($_POST['bocor'])) ? 1 : 0;
    $v_rkode_unik=(isset($_POST['kode_unik'])) ? 1 : 0;
    $v_rhemolysis=(isset($_POST['hemolysis'])) ? 1 : 0;
    $v_rlipemik=(isset($_POST['lipemik'])) ? 1 : 0;
    $v_rikterik=(isset($_POST['ikterik'])) ? 1 : 0;
    $v_rkehijauan=(isset($_POST['kehijauan'])) ? 1 : 0;
    $v_rbekuan=(isset($_POST['bekuan'])) ? 1 : 0;
    $v_rspek_seleksi=(isset($_POST['seleksi'])) ? 1 : 0;
    $v_rspek_aftap=(isset($_POST['waktu_aftap'])) ? 1 : 0;
    $v_rspek_pengolahan=(isset($_POST['waktu_komponen'])) ? 1 : 0;
    $v_rspek_volume=(isset($_POST['volume_ok'])) ? 1 : 0;
    $v_rspek_imltd=(isset($_POST['imltd_ok'])) ? 1 : 0;
    $v_rspek_imltd_old=(isset($_POST['jejak_imltd'])) ? 1 : 0;
    $v_rnote=$_POST['catatan'];
    $v_ruser=$_POST['petugas'];
    $v_rchecker=$_POST['dicekoleh'];
    $v_rpengesah=$_POST['disahkanoleh'];
	$hasilrilis=$_POST['hasil_rilis'];

    switch($v_rstatus){
        case '0':$v_rsatus_ket='LULUS';$v_statusktg='1';break;
        case '1':$v_rsatus_ket='TIDAK LULUS';$v_statusktg='2';break;
        case '2':$v_rsatus_ket='LULUS (CATATAN)';$v_statusktg='3';break;
    }
    //Save tamporary pilihan petugas===============================================
	$checker=$_POST['dicekoleh'];
	$pengesah=$_POST['disahkanoleh'];
	$cetak=$_POST['cetak'];
	$cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='PROLIS'"));
	if ($cek_tmpudd==0) {
	        $tambah_tmp=mysql_query("INSERT INTO tempudd (modul,dokter,petugas1,petugas2, petugas3) values ('AFTAP','$namalengkap','$checker','$pengesah', '$cetak')");
	} else {
	        $tambah_tmp=mysql_query("UPDATE tempudd  SET dokter='$namalengkap',petugas1='$checker', petugas2='$pengesah', petugas3='$cetak' where modul='AFTAP'");
	}
	$cek="select `noKantong` ,`rnotrans` from `release` where `rnokantong`='$nkt'";
	$cek1=mysql_fetch_assoc(mysql_query($cek));
	$notrans_upd=$cek1['rnotrans'];
	if ($cek1['rnokantong']==$nkt){
		//=======Audit Trial====================================================================================
	    $log_mdl ='PROLIS';
	    $log_aksi='Update Release Produk nomor kantong : '.$nkt.', Status Release: '.$v_rsatus_ket;
	    include_once "user_log.php";
	    //=====================================================================================================
		//Save Upd release table
	    $sql="UPDATE `release` SET
	    	`rtgl`			='$v_rtgl',
          	`rberat_timbang`='$v_rberattimbang',
          	`rvolume` 		='$v_rvolume',
          	`rspek_volume`	='$v_rspek_volume',
          	`rproduk`		='$v_rproduk', 
          	`rgolda`		='$v_rgolda',
          	`rtgl_aftap`	='$v_rtgl_aftap',
          	`rtgl_olah`		='$v_rtgl_olah',
          	`rtgl_ed`		='$v_rtgl_ed',
          	`rspek_kantong`	='$v_rspek_kantong',
          	`rselang` 		='$v_rselang',
          	`rkebocoran`	='$v_rkebocoran',
          	`rkode_unik`	='$v_rkode_unik', 
          	`rhemolysis`	='$v_rhemolysis', 
          	`rlipemik` 		='$v_rlipemik',
          	`rikterik`		='$v_rikterik',
          	`rkehijauan`	='$v_rkehijauan', 
          	`rbekuan` 		='$v_rbekuan',
          	`rspek_seleksi`	='$v_rspek_seleksi',
          	`rspek_aftap` 	='$v_rspek_aftap',
          	`rspek_pengolahan`='$v_rspek_pengolahan',
          	`rspek_imltd` 	='$v_rspek_imltd',
          	`rjenis_imltd`	='$v_rjenis_imltd',
          	`rspek_imltd_old`='$v_rspek_imltd_old',
          	`rspek_kgd` 	='$v_rspek_kgd',
          	`rspek_kgd_old`	='$v_rspek_kgd_old',
          	`rstatus` 		='$v_rstatus',
          	`rsatus_ket`	='$v_rsatus_ket',
          	`rnote` 		='$v_rnote',
          	`ruser`			='$v_ruser',
          	`rchecker`		='$v_rchecker',
          	`rpengesah`     ='$v_rpengesah',
          	`on_update`     ='$v_rtgl'
          	WHERE
			`rnotrans`		='$notrans_upd' and `rnokantong`	='$nkt'";
	    $qact=mysql_query($sql);
    	$sql="UPDATE `timbang_darah` SET `konfirm`='1',`waktu_konfirm`='$v_rtgl',`notrans`='$v_rnotrans' where (`id`='$id_timbang') or (`nokantong`)='$nkt'";
	    $update=mysql_query($sql);
	    $qupd="UPDATE stokkantong set `tgl_release`='$v_rtgl',`hasil_release`='$v_statusktg',volume='$hasilrilis',abs='$v_rabs' where `noKantong`='$nkt'";
	    $qupd1=mysql_query($qupd);
        echo "PROSES <i>UPDATE</i> PRODUK RELEASE BERHASIL";
	}else{
	    //Generated NoTransaksi===============================================
    	$sql_r	= mysql_query("SELECT MAX(CONVERT(rnotrans, SIGNED INTEGER)) AS Kode FROM `release`");
	    $dta_r	= mysql_fetch_assoc($sql_r);
	    $int_r  = (int)($dta_r[Kode]);
	    $int_no=$int_r;
	    $int_no_inc=(int)$int_no+1;
	    $j_nol= 10-(strlen(strval($int_no_inc)));
    	for ($i=0; $i<$j_nol; $i++){$no_tmp .="0";}
	    $v_rnotrans = $no_tmp.$int_no_inc;
    	//echo "No. Transaksi :  ".$notrans." Tanggal Periksa : ".$today1." (".date_default_timezone_get().")<br>";
	    //------------ END Generate no transaksi ---------------

    	
    	//=======Audit Trial====================================================================================
	    $log_mdl ='PROLIS';
	    $log_aksi='Release Produk nomor kantong : '.$nkt.', Status Release: '.$v_rsatus_ket;
	    include_once "user_log.php";
	    //=====================================================================================================

    	//Save Add release table
	    $sql="INSERT INTO `release`(`rnotrans`, `rnokantong`, `rtgl`,
          `rberat_timbang`, `rvolume`, `rspek_volume`, `rproduk`, `rgolda`, `rtgl_aftap`, `rtgl_olah`, `rtgl_ed`,
          `rspek_kantong`, `rselang`, `rkebocoran`, `rkode_unik`, `rhemolysis`, `rlipemik`, `rikterik`,
          `rkehijauan`, `rbekuan`, `rspek_seleksi`, `rspek_aftap`, `rspek_pengolahan`, `rspek_imltd`, `rjenis_imltd`,
          `rspek_imltd_old`, `rspek_kgd`, `rspek_kgd_old`, `rstatus`, `rsatus_ket`, `rnote`, `ruser`,
          `rchecker`, `rpengesah`)
          VALUES ('$v_rnotrans','$nkt','$v_rtgl',
          '$v_rberattimbang','$v_rvolume','$v_rspek_volume','$v_rproduk','$v_rgolda','$v_rtgl_aftap','$v_rtgl_olah','$v_rtgl_ed',
          '$v_rspek_kantong','$v_rselang','$v_rkebocoran','$v_rkode_unik','$v_rhemolysis','$v_rlipemik','$v_rikterik',
          '$v_rkehijauan','$v_rbekuan','$v_rspek_seleksi','$v_rspek_aftap','$v_rspek_pengolahan','$v_rspek_imltd','$v_rjenis_imltd',
          '$v_rspek_imltd_old','$v_rspek_kgd','$v_rspek_kgd_old','$v_rstatus','$v_rsatus_ket','$v_rnote','$v_ruser',
          '$v_rchecker','$v_rpengesah')";
	    $qact=mysql_query($sql);
    	$sql="UPDATE `timbang_darah` SET `konfirm`='1',`waktu_konfirm`='$v_rtgl',`notrans`='$v_rnotrans' where (`id`='$id_timbang') or (`nokantong`)='$nkt'";
	    $update=mysql_query($sql);
	    $qupd="UPDATE stokkantong set `tgl_release`='$v_rtgl',`hasil_release`='$v_statusktg', volume='$hasilrilis',`abs`='$v_rabs' where `noKantong`='$nkt'";
	    $qupd1=mysql_query($qupd);
        //echo "PROSES RELEASE PRODUK BERHASIL";
    }

    //If ($cetak=='1'){
    //    echo "<br> MENCETAK<br>";
    //} else{
    //    echo "<br>TIDAK MENCETAK<br>";
    //}
    if ($mode_kembali==1){
        echo "<meta http-equiv='refresh' content='2;url=pmiqa.php?module=timbang'>";
    } else{
        //echo "<meta http-equiv='refresh' content='2;url=pmiqa.php?module=release'>";
	echo "<meta http-equiv='refresh' content='2;url=qa_label_cetak.php?noKantong=$nkt'>";    
}
} //post
    ?>
    <button class="tablink" onclick="bukatab('visual', this, 'Blue')" id="defaultOpen">Visual & Timbangan</button>
    <button class="tablink" onclick="bukatab('kantong', this, 'Blue')">Kantong & Donasi</button>
    <button class="tablink" onclick="bukatab('pemeriksaan', this, 'Blue')">Pemeriksaan</button>
    <button class="tablink" onclick="bukatab('pengolahan', this, 'Blue')">Pengolahan</button>
    <button class="tablink" onclick="bukatab('trace', this, 'Blue')">Trace Kantong</button>
	<button class="tablink" onclick="bukatab('history', this, 'Blue')">Jejak Pemeriksaan</button>

<form name="form_prolis" align="left" method="post" action="<?echo $PHPSELF?>">
    <div id="kantong" class="tabcontent">
        <font size="4" color=00008B><br>DATA KANTONG DAN DONASI</font>
        <? include "release/qa_release_donasi.php";?>
    </div>

    <div id="pemeriksaan" class="tabcontent">
        <font size="4" color=00008B><br>DATA PEMERIKSAAN IMLTD & KGD</font>
        <? include "release/qa_release_periksa.php";?>
    </div>

    <div id="pengolahan" class="tabcontent">
        <font size="4" color=00008B><br>DATA PENGOLAHAN KOMPONEN DARAH</font>
        <? include "release/qa_release_komponen.php";?>
    </div>

    <div id="trace" class="tabcontent">
        <font size="4" color=00008B><br>REKAM JEJAK KANTONG</font><br>
        <? include "release/qa_release_trace.php";?>
    </div>

    <div id="history" class="tabcontent">
        <? include "release/qa_release_periksa_last.php";?>
    </div>

    <div id="visual" class="tabcontent">
        <font size="4" color=00008B><br>PENGAMATAN VISUAL dan PENIMBANGAN BERAT KOMPONEN DARAH</font>
        <table cellpadding=3 cellspacing=3 width="100%" style="border: 0px; border-color: #ffffff;">
            <tr>
                <td valign="top">
                    <div class="control-group">
                        <label class="control control-checkbox">Identitas dan pemakaian kantong darah sesuai spesifikasi
                            <input type="checkbox" checked="checked" name="spek_kantong" id="spek_kantong" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Seleksi donor memenuhi kriteria
                            <input type="checkbox" checked="checked" name="seleksi" id="seleksi" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Tidak ada tanda-tanda visual kebocoran kantong
                            <input type="checkbox" checked="checked" name="bocor" id="bocor" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Kode unik sesuai dengan spesifikasi
                            <input type="checkbox" checked="checked" name="kode_unik" id="kode_unik" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Selang kantong sesuai dengan spesifikasi
                            <input type="checkbox" checked="checked" name="selang" id="selang" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Tidak ada Hemolysis
                            <input type="checkbox" checked="checked" name="hemolysis" id="hemolysis" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Tidak Lipemik
                            <input type="checkbox" checked="checked" name="lipemik" id="lipemik" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Tidak Ikterik
                            <input type="checkbox" checked="checked" name="ikterik" id="ikterik" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Plasma tidak Kehijauan
                            <input type="checkbox" checked="checked" name="kehijauan" id="kehijauan" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Tidak ada bekuan pada Sel Darah Merah
                            <input type="checkbox" checked="checked" name="bekuan" id="bekuan" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Waktu pengambilan terpenuhi
                            <input type="checkbox" checked="checked" name="waktu_aftap" id="waktu_aftap" /><div class="control_indicator"></div></label>
                        <label class="control control-checkbox">Waktu selesai pengolahan terpenuhi
                            <input type="checkbox" checked="checked" name="waktu_komponen" id="waktu_komponen"/><div class="control_indicator"></div></label>
                    <?if ($var_volume_kantong=='0'){
                        ?><label class="control control-checkbox">Volume produk sesuai spesifikasi
                            <input type="checkbox" checked="checked" name="volume_ok" id="volume_ok" /><div class="control_indicator"></div></label><?
                     } else {
                        ?><label class="control control-checkbox">Volume produk sesuai spesifikasi
                            <input type="checkbox" name="volume_ok" id="volume_ok" /><div class="control_indicator"></div></label><?
                     }?>
                    <? if ($var_imltd=='0'){
                        ?><label class="control control-checkbox">Hasil pemeriksaan memenuhi spesifikasi
                            <input type="checkbox" checked="checked" name="imltd_ok" id="imltd_ok" /><div class="control_indicator"></div></label><?
                    }else{
                        ?><label class="control control-checkbox">Hasil pemeriksaan memenuhi spesifikasi
                            <input type="checkbox"  name="imltd_ok" id="imltd_ok" /><div class="control_indicator"></div></label><?
                    }
                    ?>
		    <? if ($var_imltd_old=='0'){
                        ?><label class="control control-checkbox">Pemeriksaan donasi sebelumnya terpenuhi (bila ada)
                            <input type="checkbox" checked="checked" name="jejak_imltd" id="jejak_imltd" /><div class="control_indicator"></div></label><?
                    }else{
                        ?><label class="control control-checkbox">Pemeriksaan donasi sebelumnya terpenuhi (bila ada)
                            <input type="checkbox"  name="jejak_imltd" id="jejak_imltd" /><div class="control_indicator"></div></label><?
                    }
                    ?>	

                    </div>
                </td>
                <td valign="top">
                    <table width="100%" cellpadding="1" cellspacing="1">
                        <tr><td style="background-color: mistyrose" colspan="2">Nomor Kantong</td><td><?=$nkt?></td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Status kantong</td><td><?=$posisikantong.' - '.$statuskantong?> </td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Nama Produk</td><td><?=$jeniskomponen.' - '.$namakomponen?></td></tr>
	                         <input type='hidden' name='nama_produk' value='<?=$jeniskomponen?>'>
                        <tr><td style="background-color: mistyrose" colspan="2">Tanggal ED Produk</td><td><?=$tgledkomponen?></td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Berat Kantong Kosong</td><td><?=$beratkantongkosong?> gram</td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Berat jenis komponen</td><td><?=$beratjenis?></td></tr>
			<?php
			if ($jeniskomponen=="WB"){ ?>
				<tr><td style="background-color: mistyrose" colspan="2">Volume Antikoagulan</td><td><?=$antikoagulant."75 ml"?></td></tr>
			<?php } else {?>
				<tr><td style="background-color: mistyrose" colspan="2">Volume Antikoagulan</td><td><?=$antikoagulant."0 ml"?></td></tr>
			<?}?>			
                        <tr><td style="background-color: mistyrose" rowspan="4">Hasil<br>penimbangan<br>produk</td></tr>
                        <tr><td style="background-color: mistyrose">Tanggal</td><td><?=$tgltimbang?></td></tr>
                        <tr><td style="background-color: mistyrose">Petugas</td><td><?=$namapetugastimbang.' ('.$usertimbang.') '?></td></tr>
                        <tr><td style="background-color: mistyrose">Berat</td><td><input name="berat" type="text" size="7" style="font-family:monospace;" value=<?=$berattimbang?>>Kg</td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Volume standar</td><td><?=$vol_min.' - '.$vol_max;?> ml</td></tr>
<!-- Hitung berat -->
<? 
if ($jeniskomponen=="WB"){
$ml=(($berattimbang*1000)-115)/$beratjenis;
} else {
$ml=(($berattimbang*1000)-$beratkantongkosong)/$beratjenis;
}
?>

                        <tr><td style="background-color: mistyrose" colspan="2">Volume komponen darah </td><td><input type="text" name="vol_akhir" size="7" style="font-family:monospace;" value=<?=$ml?>> pembulatan : <input type="text" name="hasil_rilis" size="7" style="font-family:monospace;" value=<?=round($ml,0)?>> <!--?=round($ml,0)?-->
                        <?if ($var_volume_kantong=='1'){?>
                                ml </td></tr>
                        <?} else {?>
                            ml <font color="blue"><b>&radic;</b></font> </td></tr>
                        <?}?>

                        <tr><td style="background-color: mistyrose" colspan="2"><b>STATUS RELEASE</b></td>
                            <td>
                                <?
                                $sel1='';$sel2='';
                                //if (($var_volume_kantong=='1') or ($var_kgd_old=='1') or ($var_ed_kantong=='1') or ($var_kgd=='1') or ($var_imltd=='1'))
                                if (($var_volume_kantong=='1') or ($var_ed_kantong=='1') or  ($var_imltd=='1') or ($var_imltd_old=='1'))
                                {$sel1='';$sel2='selected';}
                                ?>
                                <select id="prolis" name="prolis" class="styled-select">
                                    <option value="1" <?=$sel1?>>TIDAK LULUS</option>
                                    <option value="0" <?=$sel2?>>LULUS</option>
                                    <option value="2" >DILULUSKAN DENGAN CATATAN</option>
                                </select>
                            </td></tr>
			<!--ABS | 20190531-->
			<tr><td style="background-color: mistyrose" colspan="2">Anti Body Screening</td>
                            <td>
                                
                                <select id="abs" name="abs" class="styled-select">
                                    <option value="Null" >Null</option>
				    <option value="Negatif" >Negatif</option>
                                    <option value="Positif" >Positif</option>
                                </select>
                            </td></tr>
			<!--============================-->

                        <tr><td style="background-color: mistyrose" colspan="2">Catatan</td><td><input type="text" name="catatan"></td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Petugas</td><td><?echo $namalengkap;?></td>
                            <input type="hidden" name="petugas" value=<?=$namauser?>></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Dicek oleh</td>
                            <td>
                                <select name="dicekoleh" class="styled-select"> <?
                                    $user1="select * from user order by nama_lengkap";
                                    $do1=mysql_query($user1);
                                    while($data1=mysql_fetch_assoc($do1)) {
                                        if ($data1[id_user]==$data_combo[petugas1]){
                                            $select=" selected";
                                        } else{
                                            $select="";
                                        }?>
                                        <option value="<?=$data1[id_user]?>"<?=$select?>><?=$data1[nama_lengkap]?></option><?
                                    }?>
                                </select>
                            </td></tr>
                        <tr><td style="background-color: mistyrose" colspan="2">Disahkan oleh</td>
                            <td>
                                <select name="disahkanoleh" class="styled-select"> <?
                                    $user1="select * from user order by nama_lengkap";
                                    $do1=mysql_query($user1);
                                    while($data1=mysql_fetch_assoc($do1)) {
                                        if ($data1[id_user]==$data_combo[petugas2]){
                                            $select=" selected";
                                        } else{
                                            $select="";
                                        }?>
                                        <option value="<?=$data1[id_user]?>"<?=$select?>><?=$data1[nama_lengkap]?></option><?
                                    }?>
                                </select>
                            </td></tr>


                    </table>

                </td>
            <tr>
        </table>
    </div>
    <?
    if ($mode_kembali==1){
        ?><a href="pmiqa.php?module=timbang"class="swn_button_blue">Kembali</a><?
    }else{
        ?><a href="pmiqa.php?module=release"class="swn_button_blue">Kembali</a><?
    }
    ?>

    <a href="pmiqa.php?module=input_qa"class="swn_button_blue">Kembali ke awal</a>
    <input type="submit" name="Button" value="Simpan" title="Proses kantong" class="swn_button_red" >
	
</form>

<script>
function bukatab(namatab,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(namatab).style.display = "block";
    elmnt.style.backgroundColor = color;
}
document.getElementById("defaultOpen").click();
</script>
</body>
</html>
