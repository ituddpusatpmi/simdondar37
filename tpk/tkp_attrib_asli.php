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
    <script type="text/javascript" src="js/tgl_rekap.js"></script>
    <link type="text/css" href="css/calender.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
    <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
</head>

<?php
include ('config/dbi_connect.php');
$namaudd=$_SESSION['namaudd'];
$tempat = mysqli_fetch_assoc(mysqli_query($dbi,"select * from tempat_donor where active='1'"));
$shift = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama,jam,sampai_jam FROM `shift` WHERE (time(jam)<=current_time and time(sampai_jam)>=current_time)"));
$shif = $shift['nama'];

$kode_donor=$_GET['kode'];

$namauser = $_SESSION['namauser'];
$lv0='pmi'.$_SESSION['leveluser'];
$today1=date("Y-m-d H:i:s");
$today2=date("Y-m-d");
$jam_donor=date("H:i:s");
$tipe_donor='0';
$qdonor=mysqli_query($dbi,"select * from pendonor where Kode='$kode_donor'");
$dtdonor=mysqli_fetch_assoc($qdonor);

?>
<div class="container-fluid" style="padding-top:20px;">
    <form action="<?php echo $lv0;?>.php?module=attribtpk" method="post">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel bayangan">
                    <div class="panel-heading pmi"><h4>Inform Concent Plasma Konvalesen</h4></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table borderless table-striped">
                                <tr><td>Kode</td><td><?php echo $dtdonor['Kode'];?></td></tr>
                                <tr><td>Nama</td><td><?php echo $dtdonor['Nama'];?></td></tr>
                                <tr><td>Gol</td><td><?php echo $dtdonor['GolDarah'].$dtdonor['Rhesus'];?></td></tr>
                                <tr><td>Alamat</td><td><?php echo $dtdonor['Alamat'];?></td></tr>
                                <tr><td>HP</td><td><?php echo $dtdonor['telp2'];?></td></tr>
                                <tr><td>Donasi</td><td><?php echo $dtdonor['jumDonor'];?></td></tr>
                                <tr><td>Tgl Pos Covid-19</td><td><input type=text name="tgl1" id=datepicker class="form-control" value="<?php echo $tgl1;?>"></td></tr>
                                <tr><td>Tgl Sembuh Covid-19</td><td><input type=text name="tgl1" id=datepicker class="form-control" value="<?php echo $tgl1;?>"></td></tr>
                                <tr>
                                    <td>Pernah Donor biasa</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="pernahdonor" class="onoffswitch-checkbox" id="pernahdonor" tabindex="0" checked>
                                            <label class="onoffswitch-label" for="pernahdonor"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pernah Donor Apheresis</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="pernahdonor_a" class="onoffswitch-checkbox" id="pernahdonor_a" tabindex="1">
                                            <label class="onoffswitch-label" for="pernahdonor_a"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pernah Transfusi (6 bln terakhir)</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="pernahdonor_t" class="onoffswitch-checkbox" id="pernahdonor_t" tabindex="1">
                                            <label class="onoffswitch-label" for="pernahdonor_t"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                        if ($dtdonor['Jk']=='1'){
                                            echo '
                                            <tr>
                                                <td>Untuk Wanita : Pernah hamil?</td>
                                                <td>
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="hamil" class="onoffswitch-checkbox" id="hamil" tabindex="1">
                                                        <label class="onoffswitch-label" for="hamil"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah anak</td>
                                                <td>
                                                    <input type="text" class="form-control" name="jumlahanak">
                                                </td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-4">
                <div class="panel bayangan">
                    <div class="panel-heading pmi"><h4>Penyakit penyerta/komorbid</h4></div>
                        <div class="table-responsive">
                            <table class="table borderless  table-striped">
                                <tr>
                                    <td>Penyakit jantung</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="jantung" class="onoffswitch-checkbox" id="jantung" tabindex="1">
                                            <label class="onoffswitch-label" for="jantung"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penyakit Hipertensi</td>
                                    <td style="width:15mm;">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="hipertensi" class="onoffswitch-checkbox" id="hipertensi" tabindex="1">
                                            <label class="onoffswitch-label" for="hipertensi"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penyakit paru-paru</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="paru" class="onoffswitch-checkbox" id="paru" tabindex="1">
                                            <label class="onoffswitch-label" for="paru"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penyakit Hati/Liver</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="hati" class="onoffswitch-checkbox" id="hati" tabindex="1">
                                            <label class="onoffswitch-label" for="hati"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penyakit Ginjal</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="ginjal" class="onoffswitch-checkbox" id="ginjal" tabindex="1">
                                            <label class="onoffswitch-label" for="ginjal"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penyakit Kronik/Neuromuskular</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="kronik" class="onoffswitch-checkbox" id="kronik" tabindex="1">
                                            <label class="onoffswitch-label" for="kronik"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penyakit HIV</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="hiv" class="onoffswitch-checkbox" id="hiv" tabindex="1">
                                            <label class="onoffswitch-label" for="hiv"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel bayangan">
                    <div class="panel-heading pmi"><h4>Gejala klinis</h4></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table borderless table-striped">
                                <tr>
                                    <td>Panas atau Riwayat demam > 38<sup>o</sup> celcius</td>
                                    <td  style="width:15mm;">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="panas" class="onoffswitch-checkbox" id="panas" tabindex="0">
                                            <label class="onoffswitch-label" for="panas"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Batuk</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="batuk" class="onoffswitch-checkbox" id="batuk" tabindex="1">
                                            <label class="onoffswitch-label" for="batuk"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sakit tenggorokan</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="tenggorokan" class="onoffswitch-checkbox" id="tenggorokan" tabindex="1">
                                            <label class="onoffswitch-label" for="tenggorokan"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sesak napas</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="sesak" class="onoffswitch-checkbox" id="sesak" tabindex="1">
                                            <label class="onoffswitch-label" for="sesak"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pilek</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="pilek" class="onoffswitch-checkbox" id="pilek" tabindex="1">
                                            <label class="onoffswitch-label" for="pilek"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lesu</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="lesu" class="onoffswitch-checkbox" id="lesu" tabindex="1">
                                            <label class="onoffswitch-label" for="lesu"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sakit kepala</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="kepala" class="onoffswitch-checkbox" id="kepala" tabindex="1">
                                            <label class="onoffswitch-label" for="kepala"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Diare</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="diare" class="onoffswitch-checkbox" id="diare" tabindex="1">
                                            <label class="onoffswitch-label" for="diare"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mual dan Muntah</td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="muntah" class="onoffswitch-checkbox" id="muntah" tabindex="1">
                                            <label class="onoffswitch-label" for="muntah"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 text-center">
                <input type=submit name="submit" value="Proses" class="btn btn-success btn-sm bayangan">
                <a href="<?=$lv0?>.php?module=mobile_antrean" class="btn btn-info btn-sm bayangan">Kembali</a>
            </div>
        </div>
    </form>
</div>