
<?php
  include '../adm/config.php';



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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
						<h4><font color="black"><b>DATA PEMERIKSAAN SAMPEL DARAH<br>PMI KOTA SURAKARTA</b></font></h4><br>
					</div>
				</div>

<p id="spasi2">
  <div class="row">
    <div class="col-12 col-sm-12">
      <div class="col-3 col-sm-3">
        <a href="?page=hasilsampel"><button type="submit" name="cari" class="btn btn-success btn-block">KEMBALI</button></a>
      </div>
<p>



  <table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
  <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
      <td rowspan="2">Tanggal <br>Sampel</td>
      <td rowspan="2">ID Sampel</td>
      <td rowspan="2">Pendonor</td>
      <td rowspan="2">Gol.<br>Darah</td>
      <td rowspan="2">Asal Sampel</td>
      <td rowspan="2">No. Telp</td>
      <td rowspan="2">Jenis<br>Donor</td>
      <td colspan="3" style="background-color:#ffa600">Permintaan Darah</td>
      <td colspan="3" style="background-color:#5500ff">Titer</td>
      <td colspan="5" style="background-color:#a32103">Hematologi</td>
      <td rowspan="2" style="background-color:#33a303">Chlia</td>
      <td rowspan="2" style="background-color:#09e3b0">NAT</td>
      <td rowspan="2" style="background-color:#04b3bf">KGD</td>

  </tr>
  <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
      <td style="background-color:#ffa600">Tgl.</td>
      <td style="background-color:#ffa600">Nama</td>
      <td style="background-color:#ffa600">Rumah Sakit</td>

      <td style="background-color:#5500ff">Sampel</td>
      <td style="background-color:#5500ff">Nilai</td>
      <td style="background-color:#5500ff">Hasil</td>

      <td style="background-color:#a32103">HB</td>
      <td style="background-color:#a32103">HCT</td>
      <td style="background-color:#a32103">TC</td>
      <td style="background-color:#a32103">LEU</td>
      <td style="background-color:#a32103">Hasil</td>


  </tr>



  <?php
  //pagination
  $kode = $_GET['form'];
  $sql="SELECT * from v_sample_selesai WHERE `sk_kode`='$kode' limit 1";
  $sq=mysqli_query($con,$sql);

  $ht = mysqli_fetch_assoc(mysqli_query($con,"select NoTrans,id_permintaan, CASE donor_tpk
  WHEN '0' THEN 'APH'
  WHEN '1' THEN 'TPK'
  END AS donor_tpk, JenisDonor, CASE JenisDonor
  WHEN '0' THEN 'DS'
  WHEN '1' THEN 'DP'
  END AS JD from htransaksi where KodePendonor='$dt[sk_donor]' order by insert_on DESC limit 1"));

  $titer = mysqli_fetch_assoc(mysqli_query($con,"select cov_titer, CASE cov_vol\n".
  "WHEN '0' THEN 'Rusak/Keruh'\n".
  "WHEN '1' THEN 'Baik/Cukup'\n".
  "ELSE '-'\n".
  "END AS cov_vol\n".
  ",CASE cov_hasil\n".
  "WHEN '0' THEN 'Tidak Lolos'\n".
  "WHEN '1' THEN 'Lolos'\n".
  "ELSE '-'\n".
  "END AS cov_hasil from covid where cov_sampel='$kode' order by on_insert DESC limit 1"));

   $psn = mysqli_fetch_assoc(mysqli_query($con,"select nama,NamaRs,umur, date(tgl_register) as tgl from v_caripasien where noform='$ht[id_permintaan]' limit 1"));

   $hm = mysqli_fetch_assoc(mysqli_query($con,"select dl_hb,dl_hct,dl_plt,dl_leu, CASE dl_hasil
                            WHEN '0' THEN 'Tidak Lolos'
                            WHEN '1' THEN 'Lolos'
                            ELSE 'Cek Ulang'
                            END AS dl_hasil from hematologi where dl_sampel='$kode' order by on_insert DESC limit 1"));
  $imltd = mysqli_fetch_assoc(mysqli_query($con,"select noKantong, Hasil from hasilelisa where (noKantong='$kode' or idsample='$kode')  order by Hasil DESC limit 1"));

  $nat = mysqli_fetch_assoc(mysqli_query($con,"select idsample,Hasil from hasilnat where idsample='$kode'  order by Hasil DESC limit 1"));

  $nomor=1;

    while ($dt = mysqli_fetch_assoc($sq)) {?>

             <tr>

                    <td ><?php echo $dt['sk_tgl_plebotomi'];?></td>
                    <td ><?php echo $dt['sk_kode'];?><input type="hidden" name="sampelp" value="<?php echo $dt['sk_kode'];?>"></td>
                    <td ><?php echo $dt['Nama'];?><input type="hidden" name="namap" value="<?php echo $dt['Nama'];?>"></td>
                    <td ><?php echo $dt['sk_gol'].$dt['sk_rh'];?><input type="hidden" name="golp" value="<?php echo $dt['sk_gol'].$dt['sk_rh'];?>"></td>
                    <td ><?php echo $dt['sk_tmp_plebotomi'];?></td>
                    <td ><?php echo substr($dt['telp2'], 0, -5) . 'xxxxx';?></td>
                    <td align="left"><?php echo $ht['JD'];?><input type="hidden" name="transp" value="<?php echo $ht['NoTrans'];?>"></td>
                    <td align="left"><?php echo $psn['tgl'];?></td>
                    <td align="left"><?php echo $psn['nama'];?></td>
                    <td align="left"><?php echo $psn['NamaRs'];?></td>
                    <td align="left"><?php echo $titer['cov_vol'];?></td>
                    <td align="left"><?php echo $titer['cov_titer'];?></td>
                    <td align="left"><?php echo $titer['cov_hasil'];?></td>
                    <td align="left"><<?php echo $hm[dl_hb]?></td>
                    <td align="left"><?php echo $hm['dl_hct'];?></td>
                    <td align="left"><?php echo $hm['dl_plt'];?></td>
                    <td align="left"><?php echo $hm['dl_leu'];?></td>
                    <?php if ($hm['dl_hasil']=="Cek Ulang" ) {
                    echo '<td align="center" style="background-color:#FF0000">Cek Ulang</td>';
                    } else {
                    echo '<td align="center">'.$hm['dl_hasil'].'</td>';
                    }
                    if ($imltd[Hasil]=="0" ) {
                            echo '<td align="center">NR</td>';
                          } else if ($imltd['Hasil']=="1" ) {
                            echo '<td align="center" style="background-color:#FF0000">R</td>';
                          } else if ($imltd['Hasil']=="2" ) {
                            echo '<td align="center" style="background-color:#FF0000">GZ</td>';
                            } else {
                            echo '<td align="center">-</td>';
                            }
                            if ($nat['Hasil']=="0" ) {
                                     echo '<td align="center">NR</td>';
                                     } else if ($nat[Hasil]=="1" ) {
                                     echo '<td align="center" style="background-color:#FF0000">R</td>';
                                        } else if ($nat[Hasil]=="2" ) {
                                         echo '<td align="center" style="background-color:#FF0000">GZ</td>';
                                         } else {
                                         echo '<td align="center">-</td>';
                                         }?>
                                    <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?></td>





            </tr>
            <?php } ?>

</table>


    </div>

  </div>


    <!-- tabel navbar -->

<?php mysqli_close()?>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  </body>
  </html>
