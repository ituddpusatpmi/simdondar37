<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMDONDAR</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

</head>
<body>
<?php
session_start();
include('config/db_connect.php');
$tahun       = date("Y");
$v_tahun     = $tahun;
$v_tahun     = $_POST['tahun'];
if (empty($v_tahun)){$v_tahun=$tahun;}
$udd="select * from utd where aktif='1'";
$udd=mysql_fetch_assoc(mysql_query($udd));
$id_udd=$udd['id'];
$nama_udd=$udd['nama'];

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <br>
        <div class="panel with-nav-tabs panel-primary" id="shadow1">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-6"><h4 style="text-transform: uppercase;">LAPORAN JUMLAH PENDONOR</h4></div>
                    <div class="col-lg-6">
                        <div class="panel-title pull-right">
                            <form class="form-inline" role="form" method="POST" action="pmitatausaha.php?module=pendonor">
                                <div class="form-group">
                                    Tahun
                                    <select class="form-control" name="tahun">
                                        <?php
                                        $s1='';$s2='';$s3='';$s4='';$s5='';$s6='';
                                        switch ($v_tahun){
                                            case $tahun-5 : $s1='selected';break;
                                            case $tahun-4 : $s2='selected';break;
                                            case $tahun-3 : $s3='selected';break;
                                            case $tahun-2 : $s4='selected';break;
                                            case $tahun-1 : $s5='selected';break;
                                            case $tahun   : $s6='selected';break;
                                        }
                                        ?>
                                        <option value='<?php echo $tahun-5;?>' <?php echo $s1; ?> > <?php echo $tahun-5?> </option>
                                        <option value='<?php echo $tahun-4;?>' <?php echo $s2; ?> > <?php echo $tahun-4?> </option>
                                        <option value='<?php echo $tahun-3;?>' <?php echo $s3; ?> > <?php echo $tahun-3?> </option>
                                        <option value='<?php echo $tahun-2;?>' <?php echo $s4; ?> > <?php echo $tahun-2?> </option>
                                        <option value='<?php echo $tahun-1;?>' <?php echo $s5; ?> > <?php echo $tahun-1?> </option>
                                        <option value='<?php echo $tahun;?>'   <?php echo $s6; ?> > <?php echo $tahun?> </option>
                                    </select>
                                </div>
                                <button class="btn btn-default" type="submit" id="shadow2"><i class="fa fa-check mr-1"></i> OK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center"><h4>LAPORAN JUMLAH PENDONOR</h4></div>
                        <div class="text-center"><h4><?php echo $nama_udd;?></h4></div>
                        <div class="text-center"><h4 style="text-transform: uppercase;"> TAHUN <?php echo $v_tahun;?></h4></div>
                    </div>
                        <?php
                        $qd="select
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` <=17) THEN `KodePendonor` END )) AS dslk17,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` <=17) THEN `KodePendonor` END )) AS dspr17,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` <=17) THEN `KodePendonor` END )) AS dplk17,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` <=17) THEN `KodePendonor` END )) AS dppr17,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dslk18,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dspr18,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dplk18,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dppr18,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dslk24,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dspr24,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dplk24,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dppr24,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dslk44,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dspr44,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dplk44,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dppr44,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >64) THEN `KodePendonor` END )) AS dslk64,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >64) THEN `KodePendonor` END )) AS dspr64,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >64) THEN `KodePendonor` END )) AS dplk64,
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >64) THEN `KodePendonor` END )) AS dppr64
                                from htransaksi
                                where year(`Tgl`)='$v_tahun' AND `Pengambilan`='0'";
                        $qd=mysql_fetch_assoc(mysql_query($qd));
                        $cekal="select
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' or `JenisDonor` IS NULL  or `JenisDonor`='') THEN `KodePendonor` END )) AS ds,
                                COUNT(DISTINCT(CASE WHEN  `JenisDonor`='1' THEN `KodePendonor` END )) AS dp,
                                COUNT(DISTINCT(CASE WHEN  `JenisDonor` NOT IN ('1','0') THEN `KodePendonor` END )) AS ll
                                from `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
                                where year(h.`Tgl`)='$v_tahun' AND h.`Pengambilan`='0' and p.`Cekal`=1";
                        $cekal=mysql_fetch_assoc(mysql_query($cekal));
                        $dsbaru="select
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='A' and `rhesus`='+')  THEN `KodePendonor` END )) AS brap,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='B' and `rhesus`='+')  THEN `KodePendonor` END )) AS brbp,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='O' and `rhesus`='+')  THEN `KodePendonor` END )) AS brop,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='AB' and `rhesus`='+')  THEN `KodePendonor` END )) AS brabp,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='A' and `rhesus`='-')  THEN `KodePendonor` END )) AS bran,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='B' and `rhesus`='-')  THEN `KodePendonor` END )) AS brbn,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='O' and `rhesus`='-')  THEN `KodePendonor` END )) AS bron,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='AB' and `rhesus`='-')  THEN `KodePendonor` END )) AS brabn,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='A' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulap,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='B' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulbp,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='O' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulop,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='AB' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulabp,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='A' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulan,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='B' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulbn,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='O' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulon,
                                COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='AB' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulabn
                                from htransaksi
                                where year(`Tgl`)='$v_tahun' AND `Pengambilan`='0'";
                        $dsbaru=mysql_fetch_assoc(mysql_query($dsbaru));
                        ?>
                    <div class="col-lg-12">
                    <h5>B.1 JUMLAH PENDONOR DARAH (Jumlah orang yang mendonorkan darahnya)</h5>
                    <table class="table table-bordered table-responsive">
                        <thead class="pmi">
                            <tr>
                                <th rowspan="2" class="text-center">Jumlah Total Pendonor</th>
                                <th colspan="3" class="text-center">Jenis Pendonor</th>
                                <th colspan="2" class="text-center">Jenis Kelamin</th>
                                <th colspan="5" class="text-center">Kelompok Umur</th>
                            </tr>
                            <tr>
                                <th class="text-center">Sukarela</th>
                                <th class="text-center">Pengganti</th>
                                <th class="text-center">Bayaran</th>
                                <th class="text-center">Laki-Laki</th>
                                <th class="text-center">Perempuan</th>
                                <th class="text-center">17 Tahun</th>
                                <th class="text-center">18-24 Tahun</th>
                                <th class="text-center">25-44 Tahun</th>
                                <th class="text-center">45-64 Tahun</th>
                                <th class="text-center">>=65 Tahun </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $qd['dslk17']+$qd['dspr17']+$qd['dslk18']+$qd['dspr18']+$qd['dslk24']+$qd['dspr24']+$qd['dslk44']+$qd['dspr44']+$qd['dslk64']+$qd['dspr64']+$qd['dplk17']+$qd['dppr17']+$qd['dplk18']+$qd['dppr18']+$qd['dplk24']+$qd['dppr24']+$qd['dplk44']+$qd['dppr44']+$qd['dplk64']+$qd['dppr64'];?></td>
                                <td class="text-center"><?php echo $qd['dslk17']+$qd['dspr17']+$qd['dslk18']+$qd['dspr18']+$qd['dslk24']+$qd['dspr24']+$qd['dslk44']+$qd['dspr44']+$qd['dslk64']+$qd['dspr64'];?></td>
                                <td class="text-center"><?php echo $qd['dplk17']+$qd['dppr17']+$qd['dplk18']+$qd['dppr18']+$qd['dplk24']+$qd['dppr24']+$qd['dplk44']+$qd['dppr44']+$qd['dplk64']+$qd['dppr64'];?></td>
                                <td class="text-center">0</td>
                                <td class="text-center"><?php echo $qd['dslk17']+$qd['dplk17']+$qd['dslk18']+$qd['dplk18']+$qd['dslk24']+$qd['dplk24']+$qd['dslk44']+$qd['dplk44']+$qd['dslk64']+$qd['dplk64'];?></td>
                                <td class="text-center"><?php echo $qd['dspr17']+$qd['dppr17']+$qd['dspr18']+$qd['dppr18']+$qd['dspr24']+$qd['dppr24']+$qd['dspr44']+$qd['dppr44']+$qd['dspr64']+$qd['dppr64'];?></td>
                                <td class="text-center"><?php echo $qd['dslk17']+$qd['dspr17']+$qd['dplk17']+$qd['dppr17'];?></td>
                                <td class="text-center"><?php echo $qd['dslk18']+$qd['dspr18']+$qd['dplk18']+$qd['dppr18'];?></td>
                                <td class="text-center"><?php echo $qd['dslk24']+$qd['dspr24']+$qd['dplk24']+$qd['dppr24'];?></td>
                                <td class="text-center"><?php echo $qd['dslk44']+$qd['dspr44']+$qd['dplk44']+$qd['dppr44'];?></td>
                                <td class="text-center"><?php echo $qd['dslk64']+$qd['dspr64']+$qd['dplk64']+$qd['dppr64'];?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div> <!--Col lg 12-->
                    <div class="col-lg-12">
                        <h5>B.2 JUMLAH PENDONOR DARAH YANG DICEKAL</h5>
                        <table class="table table-bordered table-responsive">
                            <thead class="pmi">
                                <tr>
                                    <th colspan="3" class="text-center">Jumlah Pendonor yang dicekal Permanen</th>
                                    <th colspan="3" class="text-center">Jumlah Pendonor yang dicekal Sementara</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Sukarela</th>
                                    <th class="text-center">Pengganti</th>
                                    <th class="text-center">Bayaran</th>
                                    <th class="text-center">Sukarela</th>
                                    <th class="text-center">Pengganti</th>
                                    <th class="text-center">Bayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">0</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center"><?php echo $cekal['ds'];?></td>
                                    <td class="text-center"><?php echo $cekal['dp']+$cekal['ll'];?></td>
                                    <td class="text-center">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <h5>B.3 JUMLAH PENDONOR BARU DAN ULANG</h5>
                        <table class="table table-bordered table-responsive">
                            <thead class="pmi">
                            <tr>
                                <th colspan="8" class="text-center">Jumlah Pendonor Darah Baru menurut Golongan dan Rhesus Darah</th>
                                <th colspan="8" class="text-center">Jumlah Pendonor Darah Ulang menurut Golongan dan Rhesus Darah</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">A</th>
                                <th colspan="2" class="text-center">B</th>
                                <th colspan="2" class="text-center">O</th>
                                <th colspan="2" class="text-center">AB</th>
                                <th colspan="2" class="text-center">A</th>
                                <th colspan="2" class="text-center">B</th>
                                <th colspan="2" class="text-center">O</th>
                                <th colspan="2" class="text-center">AB</th>
                            </tr>
                            <tr>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                                <th class="text-center">Pos</th>
                                <th class="text-center">Neg</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center"><?php echo $dsbaru['brap'];?></td>
                                <td class="text-center"><?php echo $dsbaru['bran'];?></td>
                                <td class="text-center"><?php echo $dsbaru['brbp'];?></td>
                                <td class="text-center"><?php echo $dsbaru['brbn'];?></td>
                                <td class="text-center"><?php echo $dsbaru['brop'];?></td>
                                <td class="text-center"><?php echo $dsbaru['bron'];?></td>
                                <td class="text-center"><?php echo $dsbaru['brabp'];?></td>
                                <td class="text-center"><?php echo $dsbaru['brabn'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulap'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulan'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulbp'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulbn'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulop'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulon'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulabp'];?></td>
                                <td class="text-center"><?php echo $dsbaru['ulabn'];?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <a href="pmitatausaha.php?module=upload&mdl=musnah&t=<?php echo $v_tahun;?>&b=<?php echo $v_periode;?>&t1=<?php echo $tanggalawal;?>&t2=<?php echo $tanggalakhir;?>" class="btn btn-default" id="shadow2" title="Upload Laporan ke UDD Pusat. Yang dapat diupload adalah periode Bulanan"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload ke Pusat</a>
                <a href="pmitatausaha.php?module=rpt_pendonor&t=<?php echo $v_tahun;?>" class="btn btn-default" id="shadow2"><i class="fa fa-print" aria-hidden="true" title="Cetak Laporan"></i>&nbsp;&nbsp;Cetak Laporan</a>
                <a href="pmitatausaha.php?module=laporan" class="btn btn-default" id="shadow2" title="Kembali ke Menu Laporan"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
