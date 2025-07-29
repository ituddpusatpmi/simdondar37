<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />    
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>

<?php
session_start();
include('clogin.php');
//include "config/koneksi_nasional.php";
include('config/db_connect.php');
$data       = unserialize($_GET['id']);
$namauser   = $_SESSION['namauser'];
$lv0        = $_SESSION['leveluser'];
/*$svr=mysql_fetch_assoc(mysql_query("SELECT * from db_server"));
$con_local=mysql_connect("localhost","root","F201603907");
mysql_select_db("pmi",$con_local);
$con_server=mysql_connect("dbdonor.pmi.or.id","utdpmi","utdpmi10022017");
mysql_select_db("utdnasional",$con_server);
		  $lv0=$_SESSION[leveluser];
require_once('modul/background_process.php');
		  $idp=mysql_query("select * from tempat_donor where active='1'",$con_local);
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") { 
			   mysql_query("update pendonor set mu='1' where Kode='$kode'",$con_local); 
			   $mu="1"; 
		  } else {
			   $mu="";
		  }
 */
if (isset($_POST[submit])) {
	 $kode 		= $_POST["kode"];		$noktp 		= $_POST["noktp"];
	 $nama 		= $_POST["nama"];		$alamat		= $_POST["alamat"];
	 $jk 		= $_POST["jk"];			$pekerjaan 	= $_POST["pekerjaan"];
	 $telpa 	= $_POST["telp"]; 		$tempatlhr 	= $_POST["tempatlhr"];
	 $tgllhr 	= $_POST["tgllhr"];		$status 	= $_POST["status"];
	 $goldarah 	= $_POST["goldarah"];		$rhesus 	= $_POST["rhesus"];
	 $call 		= $_POST["call"];		$kelurahan 	= $_POST["kelurahan"];
	 $kecamatan     = $_POST["kecamatan"];		$wilayah        = $_POST["wilayah"];
	 $kodepos 	= $_POST["kodepos"];
	 $jumdonor 	= $_POST["jumdonor"];		$telp2a 		= $_POST["telp2"];
	 $umur 		= $_POST["umur"];		$ibukandung	=$_POST["ibukandung"];
	 $namauser 	= $_SESSION[namauser];		$sekarang	= date("Y-m-d h:m:s");
	 $tglkembali	= $_POST['tglkembali'];         $mu		=$_POST["mu"];
	 $apheresis	= $_POST['apheresis'];		$tglkembali_apheresis= $_POST['tglkembali_apheresis'];  
	 
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }
	  
	  $telp=trimed($telpa);
	  $telp2=trimed($telp2a);
    
      $cari =  mysql_query("select `Kode` from `pendonor` where `Kode`='$kode'");
      $jml  = mysql_num_rows($cari);
    
    if ($jml < 1){
        $query = "INSERT INTO pendonor (Kode,NoKTP,Nama,Alamat,Jk,Pekerjaan,telp,TempatLhr,TglLhr,Status,GolDarah,Rhesus,`call`,kelurahan,kecamatan,wilayah
            ,KodePos,jumDonor,telp2,umur,ibukandung,mu,pencatat,up,waktu_update,tglkembali,apheresis,tglkembali_apheresis,up_data)
            VALUES
            ('$kode','$noktp','$nama','$alamat','$jk','$pekerjaan','$telp','$tempatlhr',
              '$tgllhr','$status','$goldarah',
              '$rhesus','$call','$kelurahan',
              '$kecamatan','$wilayah','$kodepos','$jumdonor',
              '$telp2','$umur','$ibukandung','$mu',
              '$namauser','1','$sekarang','$tglkembali','$apheresis',
              '$tglkembali_apheresis','2')";
        echo $query;
        $tambah = mysql_query($query);

    } else {
        $query = "UPDATE pendonor SET
              NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
              Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
              TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
              Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
              kecamatan='$kecamatan',wilayah='$wilayah',KodePos='$kodepos',jumDonor='$jumdonor',
              telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
              pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali', apheresis='$apheresis',
              tglkembali_apheresis='$tglkembali_apheresis',up_data='2'
              where Kode='$kode'";
        echo $query;
        $tambah=mysql_query($query);
    }
	//backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	if ($tambah) {
		  echo "Data Telah berhasil di-Update <br> ";
		  $idp=mysql_query("select * from tempat_donor where active='1'",$con_local);
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'",$con_local); 
                
		  switch ($lv0){
			   case "mobile":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
?>				
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=transaksi_donor&Kode=<?=$kode?>">
					<? 
				} else { ?>
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=search_pendonor">
                                        <? }
			   break;
			   case "kasir":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));
				if ($cek['Cekal']=="0") {
					?><META http-equiv="refresh" content="0; url=pmikasir.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmikasir.php?module=search_pendonor"><?
				}
				break;
			   case "aftap":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));
				if ($cek['Cekal']=="0") {
					?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=search_pendonor"><?
				}
				break;
			   case "admin":
					?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pendonor"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}

	
?>
<h1 class="table">EDIT DATA PENDONOR</h1>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" width=65%  cellspacing="1" cellpadding="2">
<tr>
	 <td>Kode Pendonor</td>
	 <td class="input"> <?=$data['pkode']?></td>
<td>Nama Ibu Kandung</td>
	 <td class="input">
		  <input name="ibukandung" type="text" size="30" value="<?=$data['pibukandung']?>">
	 </td>
</tr>
<tr>
	 <td>No. KTP</td>
	 <td class="input">
		  <input name="noktp" type="text" size="30" value="<?=$data['pnoktp']?>">
	 </td>
<td>Golongan Darah</td>
     <td class="input">
			<? 
			$sA='';$sB='';$sAB='';$sO='';
			if ($data['pgoldarah']=='A') $sA='selected';
			if ($data['pgoldarah']=='B') $sB='selected';
			if ($data['pgoldarah']=='AB') $sAB='selected';
			if ($data['pgoldarah']=='O') $sO='selected';
			if ($data['pgoldarah']=='X') $sX='selected';
			?>
			<select name="goldarah">
				<option value="A" <?=$sA?>>A</option>
				<option value="B" <?=$sB?>>B</option>
				<option value="AB" <?=$sAB?>>AB</option>
				<option value="O" <?=$sO?>>O</option>
				<option value="X" <?=$sX?>>X</option>
			</select>
	 </td>

</tr>
<tr>
	 <td>Nama</td>
	 <td class="input">
		  <input name="nama" type="text" size="30" value="<?=$data['pnama']?>">
	 </td>
     <td>Rhesus</td>
     <td class="input">
			<? 
			$rn='';$rp='';
			if ($data['prhesus']=='-') $rn='selected';
			if ($data['prhesus']=='+') $rp='selected';
				?>
			<select name="rhesus">
				<option value="+" <?=$rp?>>(+)</option>
				<option value="-" <?=$rn?>>(-)</option>
			</select>
	 </td>

</tr>
<tr>
<td>Tempat Lahir</td>
	 <td class="input">
		  <input name="tempatlhr" type="text" size="30" value="<?=$data['ptempatlahir']?>">
	 </td>
	 
<td >Telepon</td>
	 <td class="input">
		  <input name="telp" type="text" size="30" value="<?=$data['ptelp2']?>">
	 </td>
</tr>
<tr>
<td>Tgl Lahir</td>
      <td class="input">
		  <INPUT TYPE="text" NAME="tgllhr" id="datepicker" VALUE="<?=$data['ptgllahir']?>" SIZE=25  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
	 </td>

     
<td>HP</td>
	 <td class="input">
		  <input name="telp2" type="text" size="30" value="<?=$data['ptelp2']?>">
	 </td>

</tr>
<tr> 
<td>Umur</td>
	 <td class="input">
		  <input name="umur" type="text" size="2" value="<?=$data['pumur']?>">Tanggal harus benar
	 </td>					

 <td>Dapat dipanggil</td>
     <td class="input">
        <?php
		  $type=$row['pcall'];
		  $selected[$type]="selected";?>
	 <select name="call">
		  <option value="1" <?=$selected["1"]?>>Dapat</option>
		  <option value="0" <?=$selected["0"]?>>Tidak</option>
	 </select>
     </td>

			   </tr>


<tr> 
<td>Jenis Kelamin</td>
     <td class="input">
		  <?php
			   $type=$data['pjk'];
			   $checked[$type]="checked";
		  ?>
		  <input type="radio" name="jk" value="0" <?=$checked["0"]?>>
			   Laki-laki
		  <input type="radio" name="jk" value="1" <?=$checked["1"]?>>
		  Perempuan
	 </td>
      
<td>Alamat</td>
	 <td class="input">
		  <input name="alamat" type="text" size="30" value="<?=$data['palamat']?>">
	 </td>

    </tr>

<tr>
     <td>Status Nikah</td>
     <td class="input">
		  <?php
			   $type=$data['pstatus'];
				$checked["0"]='';
				$checked["1"]='';
			   $checked[$type]="checked";?>
		  <input type="radio" name="status" value="0" <?=$checked["0"]?>>
			   Belum Nikah
		  <input type="radio" name="status" value="1" <?=$checked["1"]?>>
			   Nikah
	 </td>
<td>Kelurahan</td>
	 <td class="input">
		  <input name="kelurahan" type="text" size="30" value="<?=$data['pkelurahan']?>">
	 </td>
</tr>


<tr>
	 <td>Jumlah Donor (*)</td>
	 <td class="input">
		  <input name="jumdonor" type="text" size="30" value="<?=$data['pjmldonor']?>">
	 </td>
<td>Kecamatan</td>
	 <td class="input">
		  <input name="kecamatan" type="text" size="30" value="<?=$data['pkecamatan']?>">
	 </td>
</tr>
<tr>
	 <td>Tanggal Kembali (*)</td>
	 <td class="input">
		  <input name="tglkembali" type="text" size="30" value="<?=$data['ptglkembali']?>">
	 </td>
	 
<td>Wilayah</td>
	 <td class="input">
		  <input name="wilayah" type="text" size="30" value="<?=$data['pwilayah']?>">
	 </td>

</tr>
<? //} ?>

<tr>
<td>Tanggal Kembali Apheresis</td>
	 <td class="input">
		  <input name="tglkembali_apheresis" type="text" size="30" value="<?=$data['ptglkembaliapheresis']?>">
	 </td>
<td>Kode Pos</td>
	 <td class="input">
		  <input name="kodepos" type="text" size="30" value="<?=$data['pkodepos']?>">
	 </td>
</tr>

<tr>
	 
<td>Pekerjaan</td>
<td class="input">
     <input name="kodepos" type="text" size="30" value="<?=$data['ppekerjaan']?>">
</td>
 
<td>Donor Apheresis?</td>
     <td class="input">
			<? 
			$apheresis_no='';$apheresis_ya='';
			if ($data['papheresis']=='0') $apheresis_no='selected';
			if ($data['papheresis']=='1') $apheresis_ya='selected';
				?>
			<select name="apheresis">
				<option value="0" <?=$apheresis_no?>>Tidak Bersedia</option>
				<option value="1" <?=$apheresis_ya?>>Bersedia</option>
			</select>
	 </td>

</tr>

</table><br>
<input type="hidden" value="1" name="periksa">
<input type="hidden" name="mu" value="<?=$mu?>">
<input type="hidden" value="<?=$data['pkode']?>" name="kode">
<input type="submit" value="Simpan | Lanjutkan" name="submit">
<!--input type="submit" value="Update | Apheresis" name="update"-->
</form>

