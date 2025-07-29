<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem InforMasi DONor DARah</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    -->
</head>
<?
include ('config/dbi_connect.php');
session_start();
$dtd_id=$_GET['id'];
$tipe_donor=$_GET['type'];
switch ($tipe_donor){
  case "0":$jenis_pengambilan="Biasa";break;
  case "1":$jenis_pengambilan="Apheresis";break;
  case "2":$jenis_pengambilan="Plasma Konvalesen";break;
}
$namaudd=$_SESSION['namaudd'];
$dtd  = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT * FROM v_dtd_list WHERE dtd_id='$dtd_id'"));
$dtdKodedonor=$dtd['dtd_kdonor'];
$dnr  = mysqli_fetch_assoc(mysqli_query($dbi,"select * from pendonor where Kode='$dtdKodedonor'"));
$tempat = mysqli_fetch_assoc(mysqli_query($dbi,"select * from tempat_donor where active='1'"));
$shift = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama,jam,sampai_jam FROM `shift` WHERE (time(jam)<=current_time and time(sampai_jam)>=current_time)"));


//------------------------ set id transaksi ------------------------->
$udd1   = mysqli_query($dbi,"select id from utd where aktif='1'");
$udd    = mysqli_fetch_assoc($udd1);
$idp	  = mysqli_query($dbi,"select * from tempat_donor where active='1'");
$idp1	  = mysqli_fetch_assoc($idp);
$th		  = substr(date("Y"),2,2);
$bl		  = date("m");
$tgl	  = date("d");
$kdtp	  = substr($idp1[id1],0,2).$tgl.$bl.$th."-".$udd[id]."-";
$idp	  = mysqli_query($dbi,"select NoTrans from htransaksi where NoTrans like '$kdtp%' order by NoTrans DESC");
$idp1	  = mysqli_fetch_assoc($idp);
$idp2	  = substr($idp1[NoTrans],14,4);
if ($idp2<1) {$idp2="0000";}
$idp3	  = (int)$idp2+1;
$id31	  = strlen($idp2)-strlen($idp3);
$idp4	  = "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

$namauser = $_SESSION['namauser'];
$lv0=$_SESSION['leveluser'];
$today1=date("Y-m-d H:i:s");
$today2=date("Y-m-d");
$jam_donor=date("H:i:s");

if (isset($_POST['submit'])){
	$id = $dtdKodedonor;
  $idtrans=substr($id_transaksi_baru,0,8);
	$kota=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
	$umur=mysqli_fetch_assoc(mysqli_query($dbi,"select * from pendonor where Kode='$id'"));
	$check_p=mysqli_num_rows(mysqli_query($dbi,"select KodePendonor from htransaksi where NoTrans like '$idtrans%' and KodePendonor='$id'"));
	if ($check_p==0) {
    $tambah=mysqli_query($dbi,"insert into htransaksi 
        (NoTrans,KodePendonor,KodePendonor_lama,Tgl,Pengambilan,ketBatal,tempat,Instansi,
        JenisDonor,id_permintaan,Status,Nopol,apheresis,kendaraan,shift,kota,umur,jk,
        gol_darah,rhesus,pekerjaan,donorke,user,jam_mulai,rs) 
        value
        ('$id_transaksi_baru','$id','$id','$today1','-','9','$tmpt[0]','$dtd[Instansi]',
         '$_POST[JenisDonor]','','0','-','0','','$shif[nama]','$kota[id]','$umur[umur]','$umur[Jk]',
        '$umur[GolDarah]','$umur[Rhesus]','$umur[Pekerjaan]','$umur[jumDonor]','$namauser','$jam_donor','')");
    
    if ($tambah) {
      echo '<br>Proses :'.$id_transaksi_baru;
      $tglkembali=mysqli_query($dbi,"UPDATE pendonor SET tglkembali='$today1' WHERE Kode='$id'");
      //=======Audit Trial====================================================================================
      $log_mdl ='REGISTRASI';
      $log_aksi='Registrasi: '.$id_transaksi_baru.' Donor: '.$id;
      include_once "user_log.php";
      //=====================================================================================================
      //update dtd
      $upd_dtd=mysqli_query($dbi,"UPDATE dtd_list SET dtd_konfirm_stts='3', dtd_notrans='$id_transaksi_baru', dtd_tglkegiatan='$today2' WHERE dtd_id='$dtd_id'");
      //echo "Data Telah berhasil dimasukkan<br>";
      //echo '<META http-equiv="refresh" content="1; url=formulir_donor_bali2020.php?kode='.$id_transaksi_baru.', _blank>"';
      echo '<META http-equiv="refresh" content="0; url=pmip2d2s.php?module=dtd_transaksi&jadwal='.$dtd['dtd_agdid'].'"';
    }
  }
}
?>

<body style="margin-top: 20px;">
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="panel with-nav-tabs panel-primary" id="shadow1">
        <div class="panel-heading">
          <div style="font-weight: 200;font-size: 20px;"><strong>TRANSAKSI DONOR</strong></div>
        </div>
        <div class="panel-body">
          <div class="row">
            <form method="POST">
              <div class="table-responsive">
                <table class="table table-responsive table-hover">
                  <tr><td class="active">Kode Pendonor</td>    <td class="warning"><?php echo $dnr['Kode'];?></td></tr>
                  <tr><td>Nama Pendonor</td>    <td class="warning text-danger"><strong><?php echo $dnr['Nama'];?></strong></td></tr>
                  <tr><td>Alamat</td>           <td class="warning"><?php echo $dnr['Alamat'];?></td></tr>
                  <tr><td>Golongan Darah</td>   <td class="warning"><?php echo $dnr['GolDarah'].', Rh ('.$dnr['Rhesus'].')';?></td></tr>
                  <tr><td>Type Pennyumbangan</td><td class="warning"><?php echo $jenis_pengambilan;?></td></tr>
                  <tr><td>Tempat Donor</td>     <td class="warning">MU Dalam Gedung</td></tr>
                  <tr><td>Instansi</td>         <td class="warning"><?php echo $dtd['Instansi'];?></td></tr>
                  <tr>
                    <td>Jenis Donor</td>
                    <td class="warning">
                      <select class="form-control input-sm" name="JenisDonor">
                        <option value="0" >Sukarela</option>
                        <option value="1" >Pengganti</option>
                        <option value="3" >Autologus</option>
                      </select>
                    </td>
                  </tr>
                  <tr><td>Shif</td>     <td class="warning"><?php echo $shift['nama'];?></td></tr>
                </table>
              </div>
              <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Cetak Formulir Donor" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">
              <a href="pmip2d2s.php?module=dtd_transaksi&jadwal=<?php echo $dtd['dtd_agdid'];?>" class="btn btn-danger btn-sm"  style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">Kembali</a>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
