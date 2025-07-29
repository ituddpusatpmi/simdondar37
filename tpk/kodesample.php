<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script language="javascript">
	function setFocus(){document.kantong.nokantong.focus();}
</script>
</head>
<?
include('clogin.php');
include('config/dbi_connect.php');
session_start();
$lv0=$_SESSION['leveluser'];
$namauser=$_SESSION['namauser'];
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$hariini=date('Y-m-d H:i:s');
if (isset($_POST['simpan'])) { 
    // generate kode konfirmasi==========================================
	$k_today="S".date("dmy")."-";
	$idp	= mysqli_query($dbi,"select sk_trans from samplekode where sk_trans like '$k_today%'order by sk_trans DESC limit 1");
	$idp1	= mysqli_fetch_assoc($idp);
	$idp2	= substr($idp1['sk_trans'],8,3);
	if ($idp2<1) {$idp2="000";}
	$int_idp2=(int)$idp2+1;
	$j_nol1= 3-(strlen(strval($int_idp2)));
	$idp4='';
	for ($n=0; $n<$j_nol1; $n++){$idp4 .="0";}
    $notransaksi=$k_today.$idp4.$int_idp2;
    //==================================================================
    $jumlah_sample=0;
    for ($i=0; $i<sizeof($_POST['no']); $i++) { 
        $jumlah_sample++;
        $v_sample = $_POST['sample'][$i];
        $v_tipe = $_POST['tipe'][$i];
        $inst="INSERT INTO `samplekode`(`sk_trans`, `sk_tgl`, `sk_jenis`, `sk_kode`,`sk_user`) VALUES ('$notransaksi','$hariini','$v_tipe','$v_sample','$namauser')";
        $inst=mysqli_query($dbi,$inst);
        if ($inst){
            echo $v_sample.' - OK<br>';
            }else{
            echo $v_sample.' - Gagal<br>';
            }
    }
    //=======Audit Trail====================================================================================
    $log_mdl ='LOGISTIK';
    $log_aksi='Pembuatan Kode Sample: '.$notransaksi.', Jenis :'.$v_tipe.', Jumlah Sample: '.$jumlah_sample;
    include('user_log.php');
    //=====================================================================================================
  //  echo '<META http-equiv="refresh" content="2; url=pmi'.$lv0.'.php?module=labelsampel&ns=$notransaksi">';
   ?>

     <META http-equiv="refresh" content="2; url=pmi<?=$lv0?>.php?module=labelsampel&ns=<?=$notransaksi?>">
	
   <? 
    //echo '<META http-equiv="refresh" content="5; url=pmi'.$lv0.'.php?module=samplekode">';
}
if (isset($_POST['gen'])) { 
    $v_jenis=$_POST['jenis'];
    $v_jml=$_POST['jml'];
    $v_th=date('y');
    $v_bl=date('m');
    $v_hr=date('d');
    $v_prefixkode=$v_jenis.$v_th.$v_bl.$v_hr;
    $j1=$j2=$j3=$j4=$j5=$j6="";
    switch($v_jenis){
        case 'APH':$j1="selected";break;
        case 'TPK':$j2="selected";break;
        case 'KON':$j3="selected";break;
        case 'DP':$j4="selected";break;
        case 'QC':$j5="selected";break;
        case 'MCU':$j6="selected";break;
    }
} ?>
	<body onLoad=setFocus()>
	<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Kode Sample Pre Donasi</div>
	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table cellpadding=1 cellspacing="0" style="min-width:700px;" class="bayangan">
			<tr style="background-color:mistyrose; font-size:12px; color:#000000;">
				<td>Jenis Sample :<select name="jenis">
						<option value="APH" <?php echo $j1;?>>Apheresis</option>
						<option value="TPK" <?php echo $j2;?>>Plasma Konvalesen</option>
						<option value="KON" <?php echo $j3;?>>Konseling</option>
                        <option value="DP" <?php echo $j4;?>>Donor Pengganti</option>
                        <option value="QC" <?php echo $j5;?>>Quality Control</option>
                        <option value="MCU" <?php echo $j6;?>>Medical Checkup</option>
				</select></td>
				<td class="input">Jumlah :<input type="text"  name="jml" style="width:15mm;" required value="1"></td>
				<td class="input"><input name="gen" type="submit" value="Generated" class="swn_button_blue"></td>
			</tr>
	</table><br>		
	<table id="box-table-b" style="background-color:#FECCBF; font-size:14px; color:#000000; font-family:arial;border-collapse:collapse;min-width:700px;" class="bayangan">
		<tr style="background-color:mistyrose; font-size:16px; color:#000000;height:40px;">
			<th>No</th>
			<th>Kode Sample</th>
			<th>Jenis</th>
			<th>Pembuat</th>
		</tr>		
        <?php	
        $sql="SELECT `sk_kode` from `samplekode` where `sk_kode` like '$v_prefixkode%' and `sk_jenis`='$v_jenis' order by `sk_kode` DESC limit 1";
        $chkkode=mysqli_fetch_assoc(mysqli_query($dbi,$sql));
        $chkkode=$chkkode['sk_kode'];
        $int_kode=substr($chkkode,9,3);
        $int_kode=(int)$int_kode;
        $nomor=0;
        for ($i=0; $i<$v_jml; $i++){
            $nomor++;
            $int_kode++;
            $intkode=str_pad($int_kode,3,'0',STR_PAD_LEFT);
            $kodesample=$v_prefixkode.$intkode.$v_sufixkode;
            ?>
            <tr style="font-size:12px;height:30px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td><?php echo $nomor;?><input type="hidden" name="no[]" value="<?php echo $nomor;?>"></td>
                    <td><?php echo $kodesample;?><input type="hidden" name="sample[]" value="<?php echo $kodesample;?>"></td>
                    <td><?php echo $v_jenis;?><input type="hidden" name="tipe[]" value="<?php echo $v_jenis;?>"></td>
                    <td><?php echo $namauser;?></td>
                 </tr>
            <?php
        }
        ?>
	</table>
    <br>
	<input name="simpan" type="submit" value="Simpan" class="swn_button_blue">
    <a href="pmi<?php echo $lv0;?>.php?module=samplerekap" class="swn_button_blue">Rekap Sample</a>
</form>
<div style="font-size: 10px;color: #000000">Update 2020-12-24</div>

<style>
    tr { background-color: #ffffff;}
    	.initial { background-color: #ffffff; color:#000000 }
    	.normal { background-color: #ffffff; }
    	.highlight { background-color: #7CFC00 }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid brown;
		font-family:Arial;
		font-size:14px;
		text-align:center;
	}
    .bayangan {
			border:0.2px solid red;
			padding: 1px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
		}
</style>
