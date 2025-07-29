<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION['namaudd'];
//NOMOR TRANSAKSI THEO 080318
$max=mysql_fetch_assoc(mysql_query("select max(dpengolahan.trans) as akhir from dpengolahan where date(tgl)=curdate()"));
$maxt=$max['akhir'];
$maxp=$maxt+1;
?>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/date.js" type="text/javascript"> </script>
<script language=javascript src="js/dlkomponen.js" type="text/javascript"> </script>
<script language=javascript src="js/alert.js" type="text/javascript"> </script>
<script language=javascript src="js/jquery-1.4.2.min.js"></script>
<script language=javascript src="js/jquery-ui-1.8.6.custom.min.js"></script>
 <script type="text/javascript"> 

//Mencegah submit Enter di Form
function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script> 
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<style type="text/css">
    <!--
    @import url("topstyle.css");
    -->
</style>
<body OnLoad="document.komponen.nokantong.focus();">
<?
include('clogin.php');
include('config/db_connect.php');
$sekarang=DATE('Y-m-d H:i:s');
$namauser=$_SESSION['namauser'];

if (isset($_POST['submit'])) {
    $tglp= date("Y-m-d");

//------------------------ set id transaksi ------------------------->
    $kodet4 = $today=DATE("Y");
    $kodet5 = substr($today,2,2);
    $kodet6 = $today=date("dm");
    $kodet7 = $kodet6.$kodet5;
    $kdtp   = "KOMP-".$kodet6.$kodet5;
    $idp    = mysql_query("select notrans from hpengolahan where notrans like '$kdtp%' order by notrans DESC");
    $idp1   = mysql_fetch_assoc($idp);
    $idp2   = substr($idp1['notrans'],11,2);
    if ($idp2<1) {$idp2="00";}
    $idp3   = (int)$idp2+1;
    $id31   = strlen($idp2)-strlen($idp3);
    $idp4   = "";
    for ($i=0; $i<$id31; $i++){
        $idp4 .="0";
    }
    $id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

    for ($i=0;$i<count($_POST['no_kantong']);$i++) {
        $nkt    = $_POST['no_kantong'][$i];     $nkd    = $_POST['kadaluwarsa'][$i];
        $njt    = $_POST['jeniskomponen'][$i];  $vlm    = $_POST['vlm'][$i];
        $mesin  = $_POST['alat'][$i];           $pisah  = $_POST['pisah'][$i];			
        $musnah=$_POST['musnahkan'][$i];	$shift=$_POST[shift];
	$mulai	= $_POST['mulai'][$i];		$selesai= $_POST['selesai'][$i];	$alatpisah  = $_POST['alatpisah'][$i];
	$pcepat	= $_POST['kecepatan'][$i];	$psuhu	= $_POST['suhu1'][$i];		$pwaktu	= $_POST['waktu'][$i];
	$beku	= $_POST['beku'][$i];		$suhuinti= $_POST['suhuinti'][$i];
        $nktc   = substr($nkt,0,strlen($nkt)-1);$nktc   = $nktc."A";
	$tglp1= $tglp.' '.$mulai;
        $dtA=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$nktc' "));
        //$noseri=mysql_fetch_assoc(mysql_query("select sn,kode from logbook_h where no_inventarisasi='$mesin'"));

        if($musnah=='1'){
            $st="6";
        }else{
            $st=$dtA['Status'];
        }

        switch($njt){
            case 'WE':$kadaluwarsa=date("Y-m-d H:m:s",strtotime("+4 hours"));break;
            case 'FP':$kadaluwarsa=date("Y-m-d H:m:s",strtotime("+5 hours"));break;
            default:$kadaluwarsa='0000-00-00 00:00:00' ;
        }
//        echo "Pembuatan Komponen berhasil.<br>";
        $ikomp=mysql_query("update stokkantong set Status='$st', produk='$njt',sah='$dtA[sah]',volume='$vlm',
			kodePendonor='$dtA[kodePendonor]',kodePendonor_lama='$dtA[kodePendonor_lama]',
			tglpengolahan='$tglp1',tgl_Aftap='$dtA[tgl_Aftap]',kadaluwarsa='$kadaluwarsa'
			where noKantong='$nkt'");
        if($vlm!="None"){
            $hkom=mysql_query("INSERT INTO hpengolahan (notrans,user,nokantong,gd,rh,komponen,volume,musnah,tglpembuatan,pemisahan,Putar,Pisah)
                   values
                   ('$id_transaksi_baru','$namauser','$nkt','$dtA[gol_darah]','$dtA[RhesusDrh]','$njt','$vlm','$musnah','$sekarang','$pisah','$mesin','$alatpisah')");
        }
        //=======Audit Trial====================================================================================
        $log_mdl ='PENGOLAHAN';
        $log_aksi='Pengolahan: '.$nkt.', produk: '.$njt;
        include('user_log.php');
        //=====================================================================================================
        $jenis=mysql_fetch_assoc(mysql_query("select jenis, metoda, tgl_Aftap from stokkantong where nokantong='$nkt'"));
        $umur=mysql_fetch_assoc(mysql_query("select * from produk where Nama='$njt' "));
        $exp =mysql_query("update stokkantong set kadaluwarsa=(tgl_aftap + interval $umur[umurhari] day) where nokantong='$nkt' and kadaluwarsa like '0000-00%'");
            $exp1=mysql_query("update stokkantong set kadaluwarsa=(tglpengolahan + interval $umur[umurhari] day) where nokantong='$nkt' and produk like 'TC%'");
            $exp2=mysql_query("update stokkantong set kadaluwarsa=(tglpengolahan + interval $umur[umurhari] day) where nokantong='$nkt' and produk ='AHF'");
            $exp3=mysql_query("update stokkantong set kadaluwarsa=(tglpengolahan + interval $umur[umurhari] day) where nokantong='$nkt' and produk ='FFP'");
        $status=mysql_query("update stokkantong set Status='$dtA[Status]' where noKantong='$nkt' and Status < '3' ");
        $hkomp=mysql_query("select * from dpengolahan where noKantong='$nkt'");

            if (mysql_num_rows($hkomp)=='1') {
            $ukomp=mysql_query("UPDATE dpengolahan SET trans='$maxp',Produk='$njt', petugas='$namauser',metode='1',pcepat='$pcepat', psuhu='$psuhu',pwaktu='$pwaktu', bstatus='$beku', bsuhu='$suhuinti',mulai='$mulai', selesai='$selesai', tgl='$tglp1', cara='$mesin',pisah='$pisah',goldarah='$dtA[gol_darah]',rhesus='$dtA[RhesusDrh]',jenis='$jenis[jenis]', where noKantong='$nkt',shift='$shift'");
        }else{
            $ikomp=mysql_query("insert into dpengolahan (trans,noKantong,Produk,petugas,tgl,cara,pisah,goldarah,rhesus,jenis,shift,metode,pcepat,psuhu,pwaktu,bstatus,bsuhu,mulai,selesai) value('$maxp','$nkt','$njt','$namauser','$tglp1','$mesin','$pisah','$dtA[gol_darah]','$dtA[RhesusDrh]','$jenis[jenis]','$shift','1','$pcepat','$psuhu','$pwaktu','$beku','$suhuinti','$mulai','$selesai')");
        }
        if ($musnah=='1') {
            $musnahkan=mysql_query("update stokkantong set Status='6' where (noKantong='$nkt')");
        }
    }
    if ($ikomp) {
        echo "Data Telah berhasil diUPDATE<br>";
    }?>
    <META http-equiv="refresh" content="2; url=pmikomponen.php?module=shasil_labl_quick&ns=<?=$id_transaksi_baru?>">
    <?
    if ($dkomp) {
        echo "Data Telah berhasil ditambahkan<br>";
        ?>
<!--        <META http-equiv="refresh" content="2; url=pmikomponen.php?module=komponen"> -->
<!--        <META http-equiv="refresh" content="5; url=pmilaboratorium.php?module=shasil_labl_quick&ns=--><?//=$id_transaksi_baru?><!--">-->
        <META http-equiv="refresh" content="2; url=pmikomponen.php?module=shasil_labl_quick&ns<?=$id_transaksi_baru?>">
    <?}
}
?>

<h1 align="center">Pengolahan Komponen Metode Konvensional</h1>
<form name="komponen" id="komponen" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">

    <!--    <select id="pembuatan" name="pembuatan" onChange="vmetode()">-->
    
    <table >
				<tr><td>Shift</td>
				<td class="styled-select">
					<? $s1='';$s2='';$s3='';$s4='';
						$waktu=date('H:i:s');
						$jam1=mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
						$jam2=mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));	
						$jam3=mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
						$jam4=mysql_fetch_assoc(mysql_query("select * from shift where nama='IV'"));
						
						$sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];$sh4=$jam4[jam];
						if ($waktu >= $sh1 ){ $s1='selected';}
						if ($waktu >= $sh2 ){ $s2='selected';}
						if ($waktu >= $sh3 ){ $s3='selected';}
						if ($waktu < $sh1 ){ $s4='selected';}
					?>
					<?
						$td0=php_uname('n');
						$td0=strtoupper($td0);
						$td0=substr($td0,0,1);
						if ($td0!="M") { ?>
						: <select name="shift">
						<option value="1" <?=$s1?>>SHIFT I</option>
						<option value="2" <?=$s2?>>SHIFT II</option>
						<option value="3" <?=$s3?>>SHIFT III</option>
						<option value="4" <?=$s4?>>SHIFT IV</option>
						
					</select></td>
		<?}?>
		<?
		$td0=php_uname('n');
		$td0=strtoupper($td0);
		$td0=substr($td0,0,1);
		if ($td0=="M") { ?>
			<select name="shift" >
				<option value="MU"   >Mobile Unit</option>
			</select>
			<?}?>
			</tr>
			<tr><td>No. Transaksi</td> 
			    <td>: <input name=kode type=text onkeypress="cegah_submit()" size=3 value="<?=$maxp?>"></td>
			</tr>
			<tr><td>Alat Pemutaran</td> 
			<td>: <select id="mesin" name="mesin">
        			<option value="-" selected>- Pilih Mesin-</option>
				<option value="-">- Tidak Dilakukan -</option>
        			<?
					$alat1=mysql_query("SELECT kode,no_inventarisasi,nama_barang,sn FROM logbook_h WHERE status='1' AND fungsi='Pemutaran Komponen'");
					while($alat=mysql_fetch_assoc($alat1)){
				    	?>
				    	<option value="<?=$alat['no_inventarisasi']?>"><?=$alat['nama_barang']?></option>
					<?}?></td>
			</tr>
			<tr><td>Alat Pemisahan</td> 
			<td>: <select id="pisah" name="pisah">
        			<option value="-" selected>- Pilih Mesin-</option>
        			<?
					$alat1=mysql_query("SELECT kode,no_inventarisasi,nama_barang,sn FROM logbook_h WHERE status='1' AND fungsi='Pemisahan Komponen'");
					while($alat=mysql_fetch_assoc($alat1)){
				    	?>
				    	<option value="<?=$alat['no_inventarisasi']?>"><?=$alat['nama_barang']?></option>
					<?}?></td>
			</tr>
		    
	</table>

	<!--Nomor Kantong-->
	<br>Masukkan No. Kantong -->
    	<INPUT type="text" name="nokantong" id="nokantong" placeholder="input nomor kantong" onkeydown="chang(event,this);" onchange="addRow('box-table-b')" /> Jika diketik manual tekan ENTER



    <TABLE class="form" id="box-table-b">
        <tr class="field">
            <th rowspan='2'>No Kantong</th>
            <th rowspan='2'>Tgl Aftap</th>
            <th rowspan='2'>Gol Darah(Rh)</th>
            <th colspan='3'>Jenis</th>
	    <th colspan='4'>Pemutaran</th>
            <th rowspan='2'>Volume</th>
	    <th colspan='3'>Pengolahan</th>
            <th colspan='2'>Pembekuan</th>
        </tr>
        <tr>
            <th>Kantong</th>
            <th>Komponen</th>
	    <th>Kadaluwarsa Produk</th>
	    <th>Alat</th>
	    <th>Kecepatan<br>(Xg)</th>
	    <th>Suhu<br>(&deg;C)</th>
	    <th>Waktu<br>(menit)</th>
	    <th>Metode</th>
            <th>Mulai<br>(hh:mm)</th>
            <th>Selesai<br>(hh:mm)</th>
	    <th>Dilakukan ?</th>
            <th>Suhu Inti</th>
	
        </tr>
    </TABLE>
    <input type="submit" value="submit" name="submit">
</form>
<div class="alert" id="alert">
    <div id="ganti_reagen" title="Waktu Ganti Reagen..!">
        <p>Silahkan isikan hasil test dan submit terlebih dahulu. Ganti reagen yang telah habis</p>
    </div>
    <div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!">
        <p>Silahkan cek kembali kantong yang anda masukkan, atau masukkan kantong lain</p>
    </div>
    <div id="pilih_reagen" title="Pilih reagen..!">
        <p>Silahkan pilih reagen terlebih dahulu sebelum memasukkan nomor kantong</p>
    </div>
    <div id="kantong_sudah_diinput" title="Kantong sudah diinput..!">
        <p>Silahkan masukkan kantong yang lain</p>
    </div>
    <div id="jam_ambil_lebih" title="Spesifikasi Waktu Pengambilan..!">
        <p>Durasi pengambilan darah (Aftap) tidak memenuhi syarat pembuatan komponen.</p>
    </div>
</div>
</body>
