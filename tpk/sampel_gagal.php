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
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>


<style>
 .awesomeText{
  color : #000;
  font-size : 75%;
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
$tgl1=date('Y-m-d');
      if (isset($_POST['namadonor'])) {$namadonor=$_POST['namadonor'];}

?>
<div style="font-size:18px;color:#00008B;"><center><H2> <b>REKAP PEMERIKSAAN DARAH LENGKAP<br>TIDAK LULUS PEMERIKSAAN</b></H2></center></div>

      <br>


        <?php
        //pagination
        $batas = 50;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;
        $sql1="SELECT * from v_sample_selesai WHERE sk_hasil='2' order by sk_tgl_plebotomi ASC";
        $sq1=mysqli_query($dbi,$sql1);
        $jumlah_data = mysqli_num_rows($sq1);
        $total_halaman = ceil($jumlah_data / $batas);

        //

      if ($namadonor==''){
        $sql="SELECT * from  v_sample_selesai WHERE sk_hasil='2'  order by sk_tgl_plebotomi ASC limit $halaman_awal, $batas";
      }else{
           $sql="SELECT * from  v_sample_selesai WHERE sk_hasil='2' AND Nama like '%$namadonor%' order by sk_tgl_plebotomi ASC limit $halaman_awal, $batas";
      }

        $sq=mysqli_query($dbi,$sql);
        $nomor = $halaman_awal+1;
        $no=0;
        $nomor = $halaman_awal+1;
        $jum = mysqli_num_rows($sq);

      echo '<h5><b>Terdapat '.$jumlah_data.' Data Sampel Darah</b></h5>';

      ?>
      <div class="awesomeText">
          <table>
            <form method=post>
              <td class="input"><h6>Nama Pendonor</h6></td>
              <td class="input"><input type="text" name="namadonor" style="width:6cm;height:0.5cm"></td>
               
              <td><input type="submit" class="swn_button_blue" value="CARI"></td>
          </form>
            </table>
      </div>

           



      <table border=1 width=100% cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
      <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
          <td>No</td>
          <td>Tanggal <br>Sampel</td>
          <td>Tempat Pengambilan</td>
          <td>ID Sampel</td>
          <td>Pendonor</td>
          <td>Gol.<br>Darah</td>
          <td>No. Telp</td>
          <td>Aksi</td>

      </tr>

      <?php
      if ($jum < 1){?>
          <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
          <td align="center" colspan="22">Tidak Ada Data Pemeriksaan</td>
          </tr>
      <?php
      } else {
        while($dt=mysqli_fetch_assoc($sq)){?>

                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
  
                <form method="post" action="pmikasir.php?module=jadwalambil">
                        <td align="right"><?php echo $nomor++ ;?></td>
                        <td align="left"><?php echo $dt['sk_tgl_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_tmp_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_kode'];?><input type="hidden" name="sampelp" value="<?php echo $dt['sk_kode'];?>"></td>
                        <td align="left"><?php echo $dt['Nama'];?><input type="hidden" name="namap" value="<?php echo $dt['Nama'];?>"></td>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?><input type="hidden" name="golp" value="<?php echo $dt['sk_gol'].$dt['sk_rh'];?>"></td>
                        <td align="left"><?php echo $dt['telp2'];?></td>
                </form>
                        <td><a href="?module=ceklulus&kode=<?php echo $dt['sk_kode']; ?>"><input type="button"  class="swn_button_red" id="datatab" value="LIHAT DATA"></td>
                </tr>
                <?php
                                                              }}
                                                               mysql_close()?>
</table>


<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item">
              <a class="page-link" <?php if($halaman > 1){ echo "href='?module=sampelgagal&halaman=$Previous'"; } ?>>Previous</a>
    </li>
    <?php
    for($x=1;$x<=$total_halaman;$x++){
    ?>
        <li class="page-item"><a class="page-link" href="?module=sampelgagal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
    <?php
    }
    ?>
        <li class="page-item">
        <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?module=sampelgagal&halaman=$next'"; } ?>>Next</a>
        </li>
    </ul>
</nav>


<!-- jQuery -->
<script src="../transfusi/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../transfusi/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../transfusi/dist/js/adminlte.min.js"></script>
</body>
      <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
      <script>
      $(document).ready(function() {
        $('.datatab').DataTable();
      } );
      </script>
</html>
