<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
//Chek field on stokkantong for abs
$col=mysql_query("select `abs` from stokkantong limit 1");if (!$col){mysql_query("ALTER TABLE `stokkantong` ADD `abs` VARCHAR( 5 ) NOT NULL COMMENT 'Hasil Antibody Screening : Neg or Pos'");}
$col=mysql_query("select `abs` from pendonor limit 1");   if (!$col){mysql_query("ALTER TABLE `pendonor` ADD `abs` VARCHAR( 5 ) NOT NULL COMMENT 'Hasil Antibody Screening : Neg or Pos'");}

?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>
<style>
    .awesomeText {
    color: #000;
    font-size: 150%;
 }
</style>

<script>
$(function() {
	$('a[href*=#]:not([href=#])').click(function(){
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {$('html,body').animate({scrollTop: target.offset().top}, 1000);return false;}
    }
  });
});

</script>

<title>SIMDONDAR</title>
</head>
<body>
<?php
if(isset($_POST['Button']))  {
    //initial lanjut
    $lanjut = 0;
    $today           = date("Y-m-d");
    $time_now          = date("Y-m-d H:i:s");
    //Personal parameter
	$ptgKonfirmasi 	= $_POST[konfirmasi];
	$ptgSah			= $_POST[disahkan_oleh];
	$ptgOperator	= $_POST[operator];

    $q_psn        = $_POST['psn'];
    $q_ptgl       = $_POST['ptgl'];
    $q_puser      = $_POST['puser'];
    $q_pplate     = $_POST['pplate'];
    $q_pparam     = $_POST['pparam'];

    echo "$q_psn $q_ptgl $q_puser $q_pplate $q_pparam<br>";
	$jumlah_sample   =count($_POST[kantong]);
    echo "Jumlah sample : $jumlah_sample<br>";

	if ($lanjut == 0){
		//Generated NoTransaksi===============================================
		$sql_elisa	= mysql_query("SELECT MAX(CONVERT(abs_notrans, SIGNED INTEGER)) AS Kode FROM abs");
		$dta_elisa	= mysql_fetch_assoc($sql_elisa);
		$int_elisa  = (int)($dta_elisa[Kode]);
		$int_no=$int_elisa;
		$int_no_inc=(int)$int_no+1;
		$j_nol= 8-(strlen(strval($int_no_inc)));
		for ($i=0; $i<$j_nol; $i++){$no_tmp .="0";}
		$notrans = $no_tmp.$int_no_inc;
		echo "No. Transaksi :  ".$notrans." Tanggal Periksa : ".$today1." (".date_default_timezone_get().")<br>";
		//------------ END Generate no transaksi ---------------

		//Counting data
		for ($i=0;$i<count($_POST[kantong]);$i++) {
            //Collecting individual sample
            $v_id       = $_POST[id_raw][$i];
            $v_sample   = $_POST[kantong][$i];
            $v_hasil    = $_POST[hasil][$i];
            $v_aksi     = $_POST[aksi][$i];
            $v_stts_ktg = $_POST[statusktg][$i];
            $v_id_donor = $_POST[kodedonor][$i];
            $v_metode   = 'Automatic Qwalys';
            $v_jenis    = $_POST[jenis_kantong][$i];

          if($v_aksi!=='3'){
            //echo "Proses : $v_id $v_sample<br>";

           //process individual sample
		    //=======Audit Trial====================================================================================
		    $log_mdl ='ABS';
		    $log_aksi='ABS Qwalys :'.$notrans.'; ID:'.$v_sample.' Hasil : '.$v_hasil;
		    include('user_log.php');
		    //======================================================================================================
            //Add to table ABS
            $q_abs="INSERT INTO `abs` (`abs_notrans`, `abs_tgl`, `abs_sample_id`, `abs_id_donor`, `abs_metode`, `abs_ref_id`,
                                `abs_result`, `abs_kantong_status`, `abs_action`,`abs_user`, `abs_checker`, `abs_supervisor`)
                    VALUES      ('$notrans', '$time_now', '$v_sample', '$v_id_donor', '$v_metode', '$v_id',
                                 '$v_hasil', '$v_stts_ktg', '$v_aksi','$ptgOperator', '$ptgKonfirmasi', '$ptgSah')";
            $add_abs=mysql_query($q_abs);
            //Update masing2 Kantong field ABS (result : 0/1 1 : POS)
            $no_kantong0=substr($v_sample,0,-1);
            $check_ktg=mysql_query("select noKantong from stokkantong where noKantong like '$no_kantong0%'");
            $jml_kantong=mysql_num_rows($check_ktg);
            $last='';
            for($j=0;$j<$jml_kantong;$j++){
                switch ($j){
                    case 0 :$no_ktg=$no_kantong0.'A';break;
                    case 1 :$no_ktg=$no_kantong0.'B';break;
                    case 2 :$no_ktg=$no_kantong0.'C';break;
                    case 3 :$no_ktg=$no_kantong0.'D';break;
                    case 4 :$no_ktg=$no_kantong0.'E';break;
                    case 5 :$no_ktg=$no_kantong0.'F';break;
                    case 6 :$no_ktg=$no_kantong0.'G';break;
                    case 7 :$no_ktg=$no_kantong0.'H';break;
                    case 8 :$no_ktg=$no_kantong0.'I';break;
                }
                if ($v_hasil=='Pos'){
                    $qupd_ktg=mysql_query("update stokkantong set abs='$v_hasil', status='4'  where noKantong='$no_ktg'");
                } else {
                    $qupd_ktg=mysql_query("update stokkantong set abs='$v_hasil' where noKantong='$no_ktg'");
                }
                if ($qupd_ktg){
                    //echo "update stokkantong set abs='$v_hasil' where noKantong='$no_ktg'<br>";
                } else {
                    echo "Gagal Update Kantong $no_ktg<br>";
                }
            }
            $qupd_dnr=mysql_query("update pendonor set abs='$v_hasil' where Kode='$v_id_donor'");
            if ($qupd_dnr){
               //echo "Update pendonor : $v_id_donor<br>";
            }else{
               echo "Gagal Update pendonor : $v_id_donor<br>";
            }
            //Update Qwalys Raw : Konfirmed
            $qupd_raw=mysql_query("update qwalys_abs_raw set `confirm`='1', `confirm_user`='$ptgKonfirmasi', `ket`='$notrans' where `id`='$v_id'");
            if ($qupd_raw){echo "Confirmed id $v_id<br>";}else{echo "Confirmed Gagal id $v_id<br>";}
          } else {
              echo " sample $v_sample : ditunda<br>";
          }
        }
        echo "<meta http-equiv='refresh' content='5;url=pmikonfirmasi.php?module=qwalys_view_confirm&transaksi=$notrans'>";

	}
}

$psn        = $_GET['sn'];
$ptgl       = $_GET['tgl'];
$puser      = $_GET['user'];
$pplate     = $_GET['plate'];
$pparam     = $_GET['param'];

$q="SELECT q.`id` , q.`sn` , q.`sample_id` , q.`parameter1` , q.`microplate` , q.`parameter2` , q.`runtime` ,
                q.`result1` , q.`result_status` , q.`operator` , q.`wellplate` , q.`nl` , q.`nl_barcode` , q.`nl_batch` ,
                q.`nl_ed` , q.`sd` , q.`sd_barcode` , q.`sd_batch` , q.`sd_ed` , q.`hsp` , q.`hsp_barcode` , q.`hsp_batch` ,
                q.`hsp_ed` , q.`result_inter` , q.`result_grade` , s.nokantong, s.jenis, s.status, s.sah, s.gol_darah, s.RhesusDrh,
                s.sah, s.StatTempat, s.stat2, s.tgl_Aftap, s.kodePendonor
                FROM `qwalys_abs_raw` q
                LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                WHERE date( q.runtime ) = '$ptgl'
                AND q.microplate = '$pplate'
                AND q.`sn` = '$psn'
                AND q.`operator` = '$puser'
                AND q.`parameter2` = '$pparam' and `confirm` is null
                order by q.`id`";
$Sq=mysql_query($q);
//echo "$q<br>";
?>
<a name="atas" id="atas"></a>
<table border=0 cellpadding="5" cellspacing="5" width="80%">
   <tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;"><b>Konfirmasi Hasil Pemeriksaan Antibody Screening Qwalys 3</td>
		<td align="right" style="background-color: #ffffff"><a href="#bawah" class="swn_button_blue">Ke bawah</a></td>
   </tr>
</table>
<form name="manual_input" align="left" method="post" action="<?echo $PHPSELF?>">
	<table class="list" border=1 cellpadding="2" cellspacing="2" width="80%" style="border-collapse:collapse">
		<tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td rowspan=2 align="center">No</td>
			<td rowspan=2 align="center">Sample</td>
            <td colspan=5 align="center">Pemeriksaan</td>
			<td colspan=3 align="center">Kantong Darah</td>
			<td rowspan=2 align="center">Kode Pendonor</td>
            <td rowspan=2 align="center">Konfirm</td>
		</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">Well</td>
            <td align="center">Parameter</td>
            <td align="center">Reaksi</td>
            <td align="center">Inter pretasi</td>
            <td align="center">Mark</td>
            <td align="center">Tgl Aftap</td>
            <td align="center">Status</td>
			<td align="center">Golongan<br>Darah</td>
		</tr>
		<?
		$no	=0;
		while($data=mysql_fetch_assoc($Sq)){
			$no++;
			$status_ktg=$data['status']; $kantong_sah=$data['sah'];
			switch ($status_ktg){
				case '0' : $statuskantong='Kosong('.$status_ktg.')';
						   if ($c_ktg[StatTempat]==NULL) $statuskantong='Kosong-Logistik('.$status_ktg.')';		
						   if ($c_ktg[StatTempat]=='0')  $statuskantong='Kosong-Logistik ('.$status_ktg.')';
						   if ($c_ktg[StatTempat]=='1')  $statuskantong='Kosong-Aftap('.$status_ktg.')';
						   break;
				case '1' : if ($c_ktg['sah']=="1"){
								$statuskantong='Karantina('.$status_ktg.')';
							} else{
								$statuskantong='Belum disahkan('.$status_ktg.')';
							}
							break;
				case '2' : $statuskantong='Sehat('.$status_ktg.')';
							if (substr($c_ktg[stat2],0,1)=='b') $tempat=" (BDRS)";
							break;
				case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
				case '4' : $statuskantong='Rusak('.$status_ktg.')';break;
				case '5' : $statuskantong='Rusak-Gagal('.$status_ktg.')';break;
				case '6' : $statuskantong='Dimusnahkan('.$status_ktg.')';break;
				default  : $statuskantong='Tidak ada';
			}
			//Clear Var
				$cekal='0';

			if (($status_ktg=='1') and ($kantong_sah=='1')){$valid++;}
			?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <input type="hidden" name=id_raw[] value=<?=$data[id]?>>
                <input type="hidden" name=jenis_kantong[] value=<?=$data[jenis]?>>
                <td align='right'><input type="hidden" name=no[] 	 value=<?=$no?>> 	 <?=$no.'.'?></td>
				<td align='center'><input type="hidden" name=kantong[] value=<?=$data[sample_id]?>> <?=$data['sample_id']; ?></td>
                <td align='center'><input type="hidden" name=well[] value=<?=$data[wellplate]?>> 	 <?=$data[wellplate]?></td>
                <td align='center' nowrap><input type="hidden" name=parameter2[] value=<?=$data[parameter2]?>> 	 <?=$data[parameter2]?></td>
                <td align='center'><input type="hidden" name=reaksi[] value=<?=$data[result1]?>> 	 <?=$data[result1]?></td>
                <?php if($data[result_inter]=='Pos'){
                    $cekal='1';
                    ?> <td align='center'><input type="hidden" name=hasil[] value=<?=$data[result_inter]?>>  	<b><font color="red"> <?=$data[result_inter]?></b></font></td> <?
                } else {
                    ?> <td align='center'><input type="hidden" name=hasil[] value=<?=$data[result_inter]?>> 	 <?=$data[result_inter]?></td> <?
                }?>
                <td align='center'><input type="hidden" name=mark[] value=<?=$data[result_status ]?>> 	 <?=$data[result_status ]?></td>
                <td align='center' nowrap><input type="hidden" name=tglaftap[] value=<?=$data[tgl_Aftap]?>> 	 <?=$data[tgl_Aftap]?></td>
                <td align='center' nowrap><input type="hidden" name=statusktg[] value=<?=$status_ktg?>> 	 <?=$statuskantong?></td>
                <td align='center'><input type="hidden" name=golabo[] value=<?=$data[gol_darah]?>> 	 <?=$data[gol_darah].'('.$data[RhesusDrh].')'?></td>
                                   <input type="hidden" name=rhesus[] value=<?=$data[RhesusDrh]?>>
                <td align='center' nowrap><input type="hidden" name=kodedonor[] value=<?=$data[kodePendonor]?>> 	 <?=$data[kodePendonor]?></td>
                <input type=hidden name=sample[]   value="<?=$data['id']?>">

                <td align='left'>
                	<?
                	$sel0="";$sel1="";$sel2="";$sel3="";
                	if ($status_ktg=="1"){$sel3="selected";}
                	if ($status_ktg=="2"){$sel1="selected";}
                	if ($status_ktg=="0"){$sel3="selected";}
                	if (($cekal!=="0") and ($status_ktg=="2")){$sel2="selected";}
                	?>
                	<select name="aksi[]">
                		<option value="0" <?=$sel0?>>-</option>
                		<option value="1" <?=$sel1?>>Sehatkan</option>
                		<option value="2" <?=$sel2?>>Cekal</option>
                		<option value="3" <?=$sel3?>>Tunda Konfirmasi</option>
                	</select>
                </td>
				
			</tr>
		<?
		}
        ?>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center" colspan="12">REAGEN/BAHAN HABIS PAKAI YANG TERPAKAI</td>
        </tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="center">No.</td>
            <td align="center" colspan="3">Reagan/Bahan Habis Pakai</td>
            <td align="center" colspan="3">Barcode</td>
            <td align="center" colspan="2">Batch</td>
            <td align="center" colspan="1">ED</td>
            <td align="center" colspan="2">Ket</td>
        </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td align='right'>1.</td>
            <td align='left' colspan="3">Mircoplate</td>
            <td align='center' colspan="3"><?=$pplate?></td>
            <td align='center' colspan="2"><?=substr($pplate,8,3)?></td>
            <td align='center' colspan="2"><?=substr($pplate,4,2).'/'.substr($pplate,6,2)?></td>
            <td></td>
        </tr>
        <?
        $Sq=mysql_query("SELECT q.`nl` as nama , q.`nl_barcode` as barcode, q.`nl_batch` as batch ,q.`nl_ed` as ed
                         FROM `qwalys_abs_raw` q LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                         WHERE date( q.runtime ) = '$ptgl' AND q.microplate = '$pplate'
                         AND q.`sn` = '$psn' AND q.`operator` = '$puser' AND q.`parameter2` = '$pparam' and `confirm` is null
                         group by q.`nl_barcode`");
        $no	=1;
        while($reag=mysql_fetch_assoc($Sq)){
            $no++;?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='left' colspan="3"><?=$reag[nama]?></td>
                <td align='center' colspan="3"><?=$reag[barcode]?></td>
                <td align='center' colspan="2"><?=$reag[batch]?></td>
                <td align='center' colspan="2"><?=$reag[ed]?></td>
                <td></td>
            </tr>
        <?}?>
        <?
        $Sq=mysql_query("SELECT q.`sd` as nama , q.`sd_barcode` as barcode, q.`sd_batch` as batch ,q.`sd_ed` as ed
                         FROM `qwalys_abs_raw` q LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                         WHERE date( q.runtime ) = '$ptgl' AND q.microplate = '$pplate'
                         AND q.`sn` = '$psn' AND q.`operator` = '$puser' AND q.`parameter2` = '$pparam' and `confirm` is null
                         group by q.`sd`");
        while($reag=mysql_fetch_assoc($Sq)){
            $no++;?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='left' colspan="3"><?=$reag[nama]?></td>
                <td align='center' colspan="3"><?=$reag[barcode]?></td>
                <td align='center' colspan="2"><?=$reag[batch]?></td>
                <td align='center' colspan="2"><?=$reag[ed]?></td>
                <td></td>
            </tr>
        <?}?>
        <?
        $Sq=mysql_query("SELECT q.`hsp` as nama , q.`hsp_barcode` as barcode, q.`hsp_batch` as batch ,q.`hsp_ed` as ed
                         FROM `qwalys_abs_raw` q LEFT JOIN stokkantong s ON q.`sample_id` = s.nokantong
                         WHERE date( q.runtime ) = '$ptgl' AND q.microplate = '$pplate'
                         AND q.`sn` = '$psn' AND q.`operator` = '$puser' AND q.`parameter2` = '$pparam' and `confirm` is null
                         group by q.`hsp_barcode`");
        while($reag=mysql_fetch_assoc($Sq)){
            $no++;?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                <td align='right'><?=$no.'.'?></td>
                <td align='left' colspan="3"><?=$reag[nama]?></td>
                <td align='center' colspan="3"><?=$reag[barcode]?></td>
                <td align='center' colspan="2"><?=$reag[batch]?></td>
                <td align='center' colspan="2"><?=$reag[ed]?></td>
                <td></td>
            </tr>
        <?}?>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Dikonfirmasi oleh</td>
		<input type="hidden" name="konfirmasi" value="<?=$namauser?>">
		<td colspan="5" align="left"> <?echo $namalengkap;?></td>
        <td colspan="10" rowspan="3" align="left">
            <b>Catatan :</b>
                <ol>
                    <li>Kantong yang diproses adalah kantong yang terdaftar dalam sistem</li>
                    <li>Apabila kantong dicekal, pendonor otomatis dicekal dengan kode ABS(+)</li>
                    <li>Operator Qwalys 3 sebaiknya sesuai dengan username yang ada di SIMDONDAR</li>
                </ol>
        </td>
	</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Operator Qwalys</td>
		<td colspan="5" align="left">
			<select name="operator" > <?
				$user1="select * from user order by nama_lengkap";
				$do1=mysql_query($user1);
				while($data1=mysql_fetch_assoc($do1)) {
					if (strtoupper($data1[id_user])==strtoupper($userarc)){
						$select=" selected";
					} else{
						$select="";
					}?>
					<option value="<?=$data1[id_user]?>"<?=$select?>><?=$data1[nama_lengkap]?></option><?
				}?>
			</select>
		</td>
	</tr>
        <tr style="background-color:#ff0000;font-wight:bold; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td colspan="2" align="left" nowrap>Disahkan Oleh</td>
		<td colspan="5" align="left">
			<select name="disahkan_oleh" > <?
				$user="select * from user order by nama_lengkap";
				$do=mysql_query($user);
				while($data=mysql_fetch_assoc($do)) {
					$select1="";?>
					<option value="<?=$data[id_user]?>"<?=$select1?>><?=$data[nama_lengkap]?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	</table>
    <input type="hidden" name=psn value=<?=$psn?>>
    <input type="hidden" name=ptgl value=<?=$ptgl?>>
    <input type="hidden" name=puser value=<?=$puser?>>
    <input type="hidden" name=pplate value=<?=$pplate?>>
    <input type="hidden" name=pparam value=<?=$pparam?>>

	<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah">
	<a href="pmikonfirmasi.php?module=konfirm_abs"class="swn_button_blue">Kembali ke list data</a>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
    <?
    if ($no!==0){?>
	    <input type="submit" name="Button" value="Proses Konfirmasi" title="Proses kantong" class="swn_button_red">
    <?}?>
</form>
</body>
</html>
