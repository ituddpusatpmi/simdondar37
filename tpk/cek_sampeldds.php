<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMI KOTA SURAKARTA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../transfusi/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../transfusi/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../transfusi/dist/css/adminlte.min.css">
</head>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="../js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.9.custom.min.js"></script>


<style>
 .awesomeText{
  color : #000;
  font-size : 110%;
}
  tr { background-color: #ffffe6}
  .initial { background-color: #ffffe6; color:#000000 }
  .normal { background-color: #ffffe6 }
  .highlight { background-color: #7CFC00 }
  .ulang { background-color: #ffe6e6 }
</style>

<?php
include('config/dbi_connect.php');
require_once('clogin.php');
      
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$today=date('Y-m-d');
$today1=$today;
      
      //Query dinamis
      if (isset($_POST['minta1'])) {$today=$_POST['minta1'];$today1=$today;}
      if ($_POST['minta2']!='') $today1=$_POST['minta2'];
      if ($_POST['namadonor']!='') {
                      $srcnama  = $_POST['namadonor'];
                      $qnama       = " AND Nama like '%$srcnama%' ";
                                  } else {$qnama    ="";}
      if ($_POST['tmpsampel']!='') {
                      $srctmp      = $_POST['tmpsampel'];
                      $qtmp        = " AND sk_tmp_plebotomi like '%$srctmp%' ";
                      } else {$qtmp    ="";}
      if ($_POST['GOL']!='') {
                      $srcgol    = $_POST['GOL'];
                      $qgol      = " AND sk_gol = '$srcgol' ";
                      } else {$qgol    ="";}
      if ($_POST['pasien']!='') {
                      $srcpasien    = $_POST['pasien'];
                      $qpasien       = " AND namap like '%$srcpasien%' ";
                      } else {$qpasien    ="";}
      if ($_POST['JD']!='') {
                      $srcjd     = $_POST['JD'];
                      $qjd        = " AND JenisDonor = '$srcjd' ";
                      } else {$qjd    ="";}
      if ($_POST['STAT']!='') {
                      $srcstat  = $_POST['STAT'];
                      $qstat        = " AND sk_hasil = '$srcstat' ";
                      } else {$qstat    ="";}
      

?>
<div style="font-size:18px;color:#00008B;"><center><H2> <b>REKAP PEMERIKSAAN SAMPEL DARAH</b></H2></center></div>

      <br>


        <?php
        //pagination
       

        $sql="SELECT * from  v_cek_sampel_merge where (date(sk_tgl_plebotomi) between '$today' AND '$today1')
             $qnama $qtmp $qgol $qpasien $qjd  $qstat";

        $sq=mysqli_query($dbi,$sql);
        $no=1;
        $jum = mysqli_num_rows($sq);

      

      ?>
      <div class="awesomeText">
          <table width ="100%">
            <form method=post>
            <tr>
      <td>TANGGAL</td><td class="input"><input type="text" name=minta1 id=datepicker size=10 value=<?php echo $today; ?>>
      S/D <input type=text name=minta2 id=datepicker2 size=10 value=<?php echo $today1; ?>></td>
            <td>JENIS DONOR</td><td>
              <select name="JD" style="width:6cm;height:0.5cm">
                <option value="" selected>- SEMUA -</option>
                <option value="0">SUKARELA</option>
                <option value="1">PENGGANTI</option>
              </select>
            </td>
            </tr>
                <td class="input">NAMA PENDONOR</td>
                <td class="input"><input type="text" name="namadonor" style="width:6cm;height:0.5cm"></td>
              
                <td class="input">TEMPAT PENGAMBILAN (INSTANSI)</td>
                <td class="input"><input type="text" name="tmpsampel" style="width:6cm;height:0.5cm"></td>
            </tr>
            </tr>
      <td>GOL.DARAH</td><td>
                  <select name="GOL" style="width:6cm;height:0.5cm">
                    <h6><option value="" selected>- SEMUA -</option>
                    <h6><option value="A">A</option>
                    <h6><option value="B">B</option>
                    <h6><option value="O">O</option>
                    <h6><option value="AB">AB</option>
                  </select>
                </td>
                <td class="input">NAMA PASIEN </h6></td>
                <td class="input"><input class="input" type="text" name="pasien" style="width:6cm;height:0.5cm"></td>
            </tr>
            <td><input type="submit" class="swn_button_blue" value="CARI">
            </td>
            <td></td>
            <td>STATUS</td><td>
                  <select name="STAT" style="width:6cm;height:0.5cm">
                    <h6><option value="" selected>- SEMUA -</option>
                    <h6><option value="0">PROSES</option>
                    <h6><option value="1">LULUS</option>
                    <h6><option value="2">TIDAK LULUS</option>
                    <h6><option value="3">CEK ULANG</option>
                    <h6><option value="4">TERJADWAL</option>
                  </select>
                </td>
            </form>
            </table>
            
      </div>
      <p>
           


      <?php echo '<h6><b>Terdapat '.$jum.' Pemeriksaan Sampel</b></h5>    ';?>
      <form name=xls method=post action=tpk/cek_sampeldds_xls.php>
      <input type=hidden name="minta1" value="<?php echo $today ?>">
      <input type=hidden name="minta2" value="<?php echo $today1 ?>">
      <input type=hidden name="namadonor" value="<?php echo $srcnama ?>">
      <input type=hidden name="tmpsampel" value="<?php echo $srctmp ?>">
      <input type=hidden name="GOL" value="<?php echo $srcgol ?>">
      <input type=hidden name="pasien" value="<?php echo $srcpasien ?>">
      <input type=hidden name="JD" value="<?php echo $srcjd ?>">
      <input type=hidden name="STAT" value="<?php echo $srcstat ?>">

      <input type=submit name=submit2  class="swn_button_green" value='Rekap Pengambilan Sampel (.XLS)'>
      </form>
      <table border=1 width=100% cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
      <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
          <td rowspan=2>No</td>
          <td rowspan=2>Tanggal <br>Sampel</td>
          <td rowspan=2>Tempat Pengambilan</td>
          <td rowspan=2>ID Sampel</td>
          <td rowspan=2>Pendonor</td>
          <td rowspan=2>Gol.<br>Darah</td>
          <td rowspan=2>Jenis Donor</td>
          <td rowspan=2>No. Telp</td>
          <td colspan=2>Pasien Penerima</td>
          <td rowspan=2>Status Sampel</td>
          <td rowspan=2>Aksi</td>
      </tr>
     <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
            <td>Nama Pasien</td>
            <td>Rumah Sakit</td>
      </tr>

      <?php
      if ($jum < 1){?>
          <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
          <td align="center" colspan="12">Tidak Ada Data Pemeriksaan</td>
          </tr>
      <?php
      } else {
        while($dt=mysqli_fetch_assoc($sq)){?>

                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
  
                <form method="post" action="pmikasir.php?module=jadwalambil">
                        <td align="right"><?php echo $no++ ;?></td>
                        <td align="left"><?php echo $dt['sk_tgl_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_tmp_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_kode'];?><input type="hidden" name="sampelp" value="<?php echo $dt['sk_kode'];?>"></td>
                        <td align="left"><?php echo $dt['Nama'];?><input type="hidden" name="namap" value="<?php echo $dt['Nama'];?>"></td>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?><input type="hidden" name="golp" value="<?php echo $dt['sk_gol'].$dt['sk_rh'];?>"></td>
                                                <?php if ($dt['JenisDonor']=="1"){?>
                        <td align="left"><font color="RED">PENGGANTI</font></td>
                                                <?php } else {?>
                        <td align="left">SUKARELA</td>
                                                <?php }?>
                        <td align="left"><?php echo $dt['telp2'];?></td>
                                                <?php if ($dt['namap']!=""){?>
                        <td align="left"><?php echo $dt['namap'];?></td>
                        <td align="left"><?php echo $dt['NamaRs'];?></td><?} else {?>
                                                        <td align="left">-</td>
                                                        <td align="left">-</td>
                                                    <?}?>
                            
                        <?php if ($dt['sk_hasil']=="0"){
                            $stat = "<font color ='blue'>Antri Pelulusan</font>";
                           
                        } else if ($dt['sk_hasil']=="1"){
                            $stat = "<font color ='green'>Lulus / Antri Penjadwalan</font>";
                            
                        } else if ($dt['sk_hasil']=="2"){
                            $stat = "<font color ='red'>Tidak Lulus</font>";
                            
                        } else if ($dt['sk_hasil']=="3"){
                            $stat = "<font color ='green'>Lulus / Cek Ulang</font>";
                            
                        } else if ($dt['sk_hasil']=="4"){
                            $stat = "<font color ='black'>Sudah Dijadwalkan</font>";
                        
                        }else{ $stat = "Batal";
                        }?>
                        <td align="left"><?php echo $stat;?></td>
                        
                </form>
                        <td><a href="?module=ceklulus&kode=<?php echo $dt['sk_kode']; ?>"><input type="button"  class="swn_button_red" id="datatab" value="LIHAT DATA"></td>
                </tr>
                <?php
                                                              }}
                                                               mysql_close()?>
</table>





<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap 4 -->
      <script>
      $( function() {
        $("#datepicker").datepicker({
               dateFormat:"yy-mm-dd",
            });
      } );
      </script>
      <script>
      $( function() {
        $("#datepicker2").datepicker({
               dateFormat:"yy-mm-dd",
            });
      } );
      </script>


<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script>
      $(document).ready(function() {
        $('.datatab').DataTable();
      } );
      </script>
      </body>
</html>
