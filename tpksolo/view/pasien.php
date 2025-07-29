
<?php
  include '../adm/config.php';
  $noform = $_GET['form'];


    if(isset($_POST['batal'])) {
    echo "<script>alert('Anda tidak memiliki akses Rumah Sakit');</script>" ;
                      }

    if(isset($_POST['tambah'])) {
    echo "<script>alert('Anda tidak memiliki akses Rumah Sakit');</script>" ;
                      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMI KOTA SURAKARTA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<style type="text/css">
    .padding {
        padding: 15px 15px 15px 15px;
    }
    </style>
<body class="padding">
<p id="spasi">
				<div class="row" align="center">
					<div class="col-lg-12">
						<h4><font color="black"><b>DATA PERMINTAAN DARAH<br>PMI KOTA SURAKARTA</b></font></h4><br>
					</div>
				</div>

<p id="spasi2">
  <div class="row">
    <div class="col-12 col-sm-12">
<div class="col-3 col-sm-3">
        <a href="../?page=index"><button type="submit" name="cari" class="btn btn-success btn-block">KEMBALI</button>
      </div>
<p>
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#pasien" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">DATA PASIEN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">DONOR PENGGANTI</a>
            </li>

          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pasien-->
              <?php
              $cari = mysqli_query($con, "SELECT * FROM v_caripasien WHERE noform = '$noform' limit 1") or die (mysql_error($con));
              while ($row = mysqli_fetch_assoc($cari)) {?>

                <!--Tgl. Register   : -->
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td>1. </td>
                      <td>Tanggal Registrasi</td>
                      <td>:</td>
                      <td><?php echo $row['tgl_register'];?></td>

                    </tr>
                    <tr>
                      <td>2. </td>
                      <td>Nama Pasien</td>
                      <td>:</td>
                      <td><b><?php echo $row['nama'].' ('.$row['umur'].'thn)';?><b></td>

                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Jenis Kelamin</td>
                      <td>:</td>
                      <?php
                      if ($row['kelamin']=="L"){
                        echo "<td>Laki-Laki</td>";
                      } else {
                        echo "<td>Perempuan</td>";
                      }?>
                    </tr>
                    <tr>
                      <td>4. </td>
                      <td>Gol. Darah</td>
                      <td>:</td>
                      <td><?php echo $row['gol_darah'].'/'.$row['rhesus'];?></td>
                    </tr>
                    <tr>
                      <td>5. </td>
                      <td>Rumah Sakit</td>
                      <td>:</td>
                      <td><?php echo $row['NamaRs'];?></td>
                    </tr>
                    <tr>
                      <td>6. </td>
                      <td>Bagian</td>
                      <td>:</td>
                      <td><?php echo $row['bagian'];?></td>
                    </tr>
                    <tr>
                      <td>7. </td>
                      <td>Permintaan Produk</td>
                      <td>:</td>
                      <td><?php echo $row['JenisDarah'];?></td>
                    </tr>
                    <tr>
                      <td>8. </td>
                      <td>Sampel Darah Pasien</td>
                      <td>:</td>
                      <?php if($row['sampel']=="0"){
                        echo "<td><font color='RED'>Belum diterima PMI</font></td>";
                      } else {
                        echo "<td>Sudah diterima PMI</td>";
                      }?>
                    </tr>
                    <tr>
                      <td>9. </td>
                      <td>Jenis Permintaan</td>
                      <td>:</td>
                    <?php
                      $ind = mysqli_num_rows(mysqli_query($con,"select * from htransaksi where id_permintaan='$noform' limit 1"));
                      if($ind > 0){
                        echo "<td><font color='RED'>Donor Pengganti</font></td>";
                      } else {
                        echo "<td>Indent Stok PMI</td>";
                      }
                     ?>
                     <tr>
                       <td>10. </td>
                       <td>Status Permintaan</td>
                       <td>:</td>
                       <?php
                       if ($row['status']=="3"){
                          echo "<td>Darah Sudah Diberikan</td>";
                       }  else {
                       $nbayar=mysqli_num_rows(mysqli_query($con,"select * from dtransaksipermintaan where NoForm='$noform' and (`Status`='0' or `Status`='1')"));

                    					if ($nbayar > 0) {
                    						echo "<td>Selesai Crossmatch</td>";
                    					}else{
                                 echo "<td>Masih Dalam Proses</td>";
                              }
                       };?>
                     </tr>

                  </tbody>
                </table>

              <?php  }
              ?>
            </div>

<!--************************************cari data pasien-->
<!--************************************cari data pendonor-->
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <table class="table table-striped">
                <thead>
                  <tr>
                    <td>No.</td>
                    <td>ID Pendonor </td>
                    <td>Jenis Kelamin</td>
                    <td>Gol. Darah</td>
                    <td>Telp.</td>
                    <td>Status</td>
                </thead>
                 <tbody>
               <?php
               $caridp = mysqli_query($con,"select * from v_dp where id_permintaan='$noform'");
               $numdp = mysqli_num_rows($caridp);

               if ($numdp > 0){
                 $no = 1;
                 while ($datadp = mysqli_fetch_assoc($caridp)) {?>

                       <tr>
                         <td><?php echo $no++;?></td>
                         <td><?php echo substr($datadp['Nama'], 0, -5) . 'xxxxx';;?></td>
                         <td><?php if ($datadp['Jk']=="0"){
                            echo "Laki-Laki";
                         }else{
                            echo "Perempuan";
                         };?></td>
                         <td><?php echo $datadp['GolDarah'].'/'.$datadp['Rhesus'];?></td>
                         <td><?php echo substr($datadp['telp2'], 0, -3) . 'xxx';?></td>
                         <td><?php if ($datadp['Status']=="0"){
                            echo "Belum Penyadapan";
                         } if ($datadp['Status']=="2"){
                            echo "Sudah Penyadapan";
                         }else if ($datadp['Status']=="3"){
                            echo "Batal Penyadapan";

                         };?></td>
                       </tr>


               <?php }} else {
                 echo "Tidak Ada Data Pendonor Pengganti";
               }
                ?>
            </tbody>
            </table>
            </div>
<!--************************************cari data pendonor-->
<!--************************************EDIT DATA-->
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
              <form action="" method="post">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>BATALKAN PERMINTAAN</td>
                    <td><button type="submit" name="batal" class="btn btn-danger btn-block">PROSES</button></td>
                  </tr>
                  <tr>
                    <td>TAMBAHKAN PERMINTAAN</td>
                    <td><button type="submit" name="tambah" class="btn btn-success btn-block">PROSES</button></td>
                  </tr>
              </form>
            </div>

          </div>
        </div>
        <!-- /.card -->
      </div>

    </div>

  </div>


    <!-- tabel navbar -->

<?php mysqli_close()?>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  </body>
  </html>
