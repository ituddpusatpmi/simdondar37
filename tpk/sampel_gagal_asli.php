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
</style>

<?php
include('config/dbi_connect.php');
require_once('clogin.php');
$tgl1=date('Y-m-d');
$tgl2=$tgl1;
if (isset($_POST['tgl1'])) {$tgl1=$_POST['tgl1'];$$tgl2=$tgl1;}
if ($_POST['tgl2']!='') $tgl2=$_POST['tgl2'];

?>
<div style="font-size:18px;color:#00008B;"><center><H2><b>TIDAK LULUS PEMERIKSAAN DARAH LENGKAP</b></H2></center></div>
<!--div class="awesomeText">
    <form name=mintadarah1 method=post> Mulai:
        <input type=text name="tgl1" id=datepicker size=10 value="<?php echo $tgl1;?>"> Sampai :
        <input type=text name="tgl2" id=datepicker1 size=10 value="<?php echo $tgl2;?>">
        <input type=submit name=submit value="Tampikan data" class="swn_button_blue">
    <a href="pmikonfirmasi.php?module=hematologi" class="swn_button_blue">Input</a>
    </form>
</div-->
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
        <td rowspan="2">Keterangan</td>
        
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
        $batas = 10;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
        
        $previous = $halaman - 1;
        $next = $halaman + 1;
        $sql1="SELECT * from samplekode WHERE (sk_hasil='1' or sk_hasil='3') AND sk_tgl_plebotomi is not null";
        $sq1=mysqli_query($dbi,$sql1);
        $jumlah_data = mysqli_num_rows($sq1);
        $total_halaman = ceil($jumlah_data / $batas);
      
        $sql="SELECT * from samplekode WHERE sk_hasil between 2 AND 3 AND sk_tgl_plebotomi is not null";
        $sq=mysqli_query($dbi,$sql);
        $nomor = $halaman_awal+1;
        $no=0;
        $jum = mysqli_num_rows($sq);
      if ($jum < 1){?>
          <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
          <td align="center" colspan="22">Tidak Ada Data Pemeriksaan</td>
          </tr>
      <?php
      } else {
        while($dt=mysqli_fetch_assoc($sq)){
            $no++;
            ?>
                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                        <td align="right"><?php echo $nomor++ ;?></td>
                        <td align="left"><?php echo $dt['sk_on_insert'];?></td>
                        <td align="left"><?php echo $dt['sk_kode'];?></td>
                    <?php //cari donor
                        $donor = mysqli_fetch_assoc(mysqli_query($dbi,"select Nama,telp2 from pendonor where Kode='$dt[sk_donor]' limit 1"));?>
                        <td align="left"><?php echo $donor['Nama'];?></td>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?></td>
                        <td align="left"><?php echo $donor['telp2'];?></td>
                    <?php //cari transaksi donor
                    $ht = mysqli_fetch_assoc(mysqli_query($dbi,"select id_permintaan, CASE JenisDonor
                    WHEN '0' THEN 'DS'
                    WHEN '1' THEN 'DP'
                    END AS JenisDonor from htransaksi where KodePendonor='$dt[sk_donor]' order by insert_on DESC limit 1"));?>
                        <td align="left"><?php echo $ht['JenisDonor'];?></td>
                    <?php //cari pasien
                    $psn = mysqli_fetch_assoc(mysqli_query($dbi,"select nama,NamaRs,umur, date(tgl_register) as tgl from v_caripasien where noform='$ht[id_permintaan]' limit 1"));
                        if ($ht['JenisDonor']=="DP"){?>
                        <td align="left"><?php echo $psn['tgl'];?></td>
                        <td align="left"><?php echo $psn['nama'].' ('.$psn['umur'].' thn)';?></td>
                        <td align="left"><?php echo $psn['NamaRs'];?></td>
                            <?}else {?>
                        <td align="left">-</td>
                        <td align="left">-</td>
                        <td align="left">-<?}?>
                    <?php //cari titer
                        $titer = mysqli_fetch_assoc(mysqli_query($dbi,"select cov_titer, CASE cov_vol
                        WHEN '0' THEN 'Rusak/Keruh'
                        WHEN '1' THEN 'Baik/Cukup'
                        ELSE '-'
                        END AS cov_vol
                        ,CASE cov_hasil
                        WHEN '0' THEN 'Tidak Lolos'
                        WHEN '1' THEN 'Lolos'
                        ELSE '-'
                        END AS cov_hasil from covid where cov_sampel='$dt[sk_kode]' order by on_insert DESC limit 1"));
                        if ($titer['cov_hasil'] == "Tidak Lolos" || $titer['cov_vol'] == "Rusak/Keruh" ) {
                            $color = "style='background-color: red;'";
                        }?>
                        <td align="left"><?php echo $titer['cov_vol'];?></td>
                        <td align="left"><?php echo $titer['cov_titer'];?></td>
                        <td align="left"><?php echo $titer['cov_hasil'];?></td>
                    <?php //cari hemmatologi
                        $hm = mysqli_fetch_assoc(mysqli_query($dbi,"select dl_hb,dl_hct,dl_plt,dl_leu, CASE dl_hasil
                        WHEN '0' THEN 'Tidak Lolos'
                        WHEN '1' THEN 'Lolos'
                        ELSE 'Belum Ada'
                        END AS dl_hasil from hematologi where dl_sampel='$dt[sk_kode]' order by on_insert DESC limit 1"));
                        if ($hm['dl_hb']==""){?>
                        <td align="left">-</td>
                        <td align="left">-</td>
                        <td align="left">-</td>
                        <td align="left">-</td>
                        <td align="left">-</td>
                    <?php }else {?>
                        <td align="left"><?php echo $hm['dl_hb'];?></td>
                        <td align="left"><?php echo $hm['dl_hct'];?></td>
                        <td align="left"><?php echo $hm['dl_plt'];?></td>
                        <td align="left"><?php echo $hm['dl_leu'];?></td>
                        <td align="left"><?php echo $hm['dl_hasil'];?></td>
                    <?php }//cari IMLTD
                        $imltd = mysqli_fetch_assoc(mysqli_query($dbi,"select noKantong, Hasil from hasilelisa where (noKantong='$dt[sk_kode]' or idsample='$dt[sk_kode]')  order by Hasil DESC limit 1"));
                        if ($imltd['Hasil']=="0" ) {
                        echo '<td align="center">NR</td>';
                        } else if ($imltd['Hasil']=="1" ) {
                        echo '<td align="center" style="background-color:#FF0000">R</td>';
                        } else if ($imltd['Hasil']=="2" ) {
                        echo '<td align="center" style="background-color:#FF0000">GZ</td>';
                        } else {
                        echo '<td align="center">-</td>';
                        }?>
                    <?php //cari NAT
                         $nat = mysqli_fetch_assoc(mysqli_query($dbi,"select idsample,Hasil from hasilnat where idsample='$dt[sk_kode]'  order by Hasil DESC limit 1"));
                         if ($nat['Hasil']=="0" ) {
                         echo '<td align="center">NR</td>';
                         } else if ($nat['Hasil']=="1" ) {
                         echo '<td align="center" style="background-color:#FF0000">R</td>';
                            } else if ($nat['Hasil']=="2" ) {
                             echo '<td align="center" style="background-color:#FF0000">GZ</td>';
                             } else {
                             echo '<td align="center">-</td>';
                             }?>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?></td><?php
                         if ($dt['sk_hasil']=="2" ) {
                            echo '<td align="center">Tidak Lulus</td>';
                            } else if ($dt['sk_hasil']=="3" ) {
                            echo '<td align="center" style="background-color:#F11111">Sampel Ulang</td>';
                            }?>
                                            
                </tr>
                <?php
                                                              }}?>
</table>
