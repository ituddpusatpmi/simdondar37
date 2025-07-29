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
<div style="font-size:18px;color:#00008B;"><center><H2> <b>REKAP PEMERIKSAAN DARAH LENGKAP<br>LULUS PEMERIKSAAN</b></H2></center></div>

      <br>


        <?php
        //pagination
        $batas = 10;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;
        $sql1="SELECT * from v_sampelselesai WHERE (sk_hasil='1' or sk_hasil='3') order by sk_tgl_plebotomi ASC";
        $sq1=mysqli_query($dbi,$sql1);
        $jumlah_data = mysqli_num_rows($sq1);
        $total_halaman = ceil($jumlah_data / $batas);

        //

      if ($namadonor==''){
        $sql="SELECT * from v_sampelselesai WHERE (sk_hasil='1' or sk_hasil='3')  order by sk_tgl_plebotomi ASC limit $halaman_awal, $batas";
      }else{
           $sql="SELECT * from v_sampelselesai WHERE (sk_hasil='1' or sk_hasil='3') AND Nama like '%$namadonor%' order by sk_tgl_plebotomi ASC limit $halaman_awal, $batas";
      }

        $sq=mysqli_query($dbi,$sql);
        $nomor = $halaman_awal+1;
        $no=0;
        $nomor = $halaman_awal+1;
        $jum = mysqli_num_rows($sq);

      echo '<h5><b>Terdapat '.$jumlah_data.' Antrian Penjadwalan</b></h5>';

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

           



      <table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
      <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
          <td rowspan="2">No</td>
          <td rowspan="2">Tanggal <br>Sampel</td>
          <td rowspan="2">ID Sampel</td>
          <td rowspan="2">Pendonor</td>
          <td rowspan="2">Gol.<br>Darah</td>
          <td rowspan="2">No. Telp</td>
          <td rowspan="2">Jenis<br>Donor</td>
          <td colspan="3" style="background-color:#ffa600">Permintaan Darah</td>
          <td colspan="3" style="background-color:#5500ff">Titer</td>
          <td colspan="5" style="background-color:#a32103">Hematologi</td>
          <td rowspan="2" style="background-color:#33a303">Chlia</td>
          <td rowspan="2" style="background-color:#09e3b0">NAT</td>
          <td rowspan="2" style="background-color:#04b3bf">KGD</td>
          <td rowspan="2">Aksi</td>

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
      if ($jum < 1){?>
          <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
          <td align="center" colspan="22">Tidak Ada Data Pemeriksaan</td>
          </tr>
      <?php
      } else {
        while($dt=mysqli_fetch_assoc($sq)){
            $no++;

            if ($dt['sk_hasil']=="1"){ ?>
                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <?} else {?>
                 <tr style="font-size:12px; color:red; font-family:Verdana;" onMouseOver="this.className='ulang'" onMouseOut="this.className='ulang'">
                <?}?>
                <form method="post" action="pmikasir.php?module=jadwalambil">
                        <td align="right"><?php echo $nomor++ ;?></td>
                        <td align="left"><?php echo $dt['sk_tgl_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_kode'];?><input type="hidden" name="sampelp" value="<?php echo $dt['sk_kode'];?>"></td>
                        <td align="left"><?php echo $dt['Nama'];?><input type="hidden" name="namap" value="<?php echo $dt['Nama'];?>"></td>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?><input type="hidden" name="golp" value="<?php echo $dt['sk_gol'].$dt['sk_rh'];?>"></td>
                        <td align="left"><?php echo $dt['telp2'];?></td>
                    <?php //cari transaksi donor
                    $ht = mysqli_fetch_assoc(mysqli_query($dbi,"select NoTrans,id_permintaan, CASE donor_tpk
                    WHEN '0' THEN 'APH'
                    WHEN '1' THEN 'TPK'
                    END AS donor_tpk, CASE JenisDonor
                    WHEN '0' THEN 'DS'
                    WHEN '1' THEN 'DP'
                    END AS JenisDonor from htransaksi where KodePendonor='$dt[sk_donor]' order by insert_on DESC limit 1"));?>
                        <td align="left"><?php echo $ht['JenisDonor'].' ('.$ht['donor_tpk'].')';?><input type="hidden" name="transp" value="<?php echo $ht['NoTrans'];?>"></td>
                    <?php //cari pasien
                    $psn = mysqli_fetch_assoc(mysqli_query($dbi,"select noform,nama,NamaRs,umur, date(tgl_register) as tgl from v_caripasien where noform='$ht[id_permintaan]' limit 1"));
                        if ($ht['JenisDonor']=="DP"){?>
                        <td align="left"><?php echo $psn['tgl'];?><input type="hidden" name="mintap" value="<?php echo $psn['noform'];?>"></td>
                        <td align="left"><?php echo $psn['nama'].' ('.$psn['umur'].' thn)';?></td>
                        <td align="left"><?php echo $psn['NamaRs'];?></td>
                            <?}else {?>
                        <td align="left">-</td>
                        <td align="left">-</td>
                        <td align="left">-<?}?>
                    <?php //cari titer

                        if ($dt['cov_hasil'] == "Tidak Lolos" || $titer['cov_vol'] == "Rusak/Keruh" ) {
                            $color = "style='background-color: red;'";
                        }?>
                        <td align="left"><?php echo $dt['cov_vol'];?></td>
                        <td align="left"><?php echo $dt['cov_titer'];?></td>
                        <td align="left"><?php echo $dt['cov_hasil'];?></td>

                        <td align="left"><?php echo $dt['dl_hb'];?></td>
                        <td align="left"><?php echo $dt['dl_hct'];?></td>
                        <td align="left"><?php echo $dt['dl_plt'];?></td>
                        <td align="left"><?php echo $dt['dl_leu'];?></td>
                        <td align="left"><?php echo $dt['dl_hasil'];?></td>
                    <?php //cari IMLTD
                        $imltd = mysqli_fetch_assoc(mysqli_query($dbi,"select noKantong,
                                                                 case Hasil when '0' then 'NR'
                                                                 when '1' then 'R' end AS `Hasil`
                                                                 from hasilelisa where (noKantong='$dt[sk_kode]' or idsample='$dt[sk_kode]')  order by Hasil DESC limit 1 "));?>
                        <td align="left"><?php echo $imltd['Hasil'];?></td>
                    <?php //cari NAT
                         $nat = mysqli_fetch_assoc(mysqli_query($dbi,"select idsample, case Hasil
                                                                when '0' then 'NR'
                                                                when '1' then 'R' end AS `Hasil`
                                                                from hasilelisa where (noKantong='$dt[sk_kode]' or idsample='$dt[sk_kode]')  order by Hasil DESC limit 1"));?>
                        <td align="left"><?php echo $nat['Hasil'];?></td>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?></td>
                        <!--td><a href="pmikasir.php?module=jadwalsampel&act=lanjut&kode=<?php echo $dt['sk_kode'];?>"><br><input type="button"  class="swn_button_green" onclick="return confirm('Jadwalkan Pendonor')" value="JADWAL"></a> &nbsp;</td-->
                        <td><input type="submit"  class="swn_button_green" onclick="return confirm('Jadwalkan Pendonor')" value="JADWAL"></td>
                </form>
                </tr>
                <?php
                                                              }}
                                                               mysql_close()?>
</table>


 <nav>
                                                                  <ul class="pagination justify-content-center">
                                                                      <li class="page-item">
                                                                              <a class="page-link" <?php if($halaman > 1){ echo "href='?module=sampellulus&halaman=$Previous'"; } ?>>Previous</a>
                                                                      </li>
                                                                              <?php
                                                                              for($x=1;$x<=$total_halaman;$x++){
                                                                              ?>
                                                                              <li class="page-item"><a class="page-link" href="?module=sampellulus&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                                      <li class="page-item">
                                                                              <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?module=sampellulus&halaman=$next'"; } ?>>Next</a>
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
</html>
