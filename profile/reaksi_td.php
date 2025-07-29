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
require_once('config/db_connect.php');
$tahun=date('Y');
$v_tahun=$_POST['tahun_lap'];
if (empty($v_tahun)){$v_tahun=$tahun;}
$udd="select * from utd where aktif='1'";
$udd=mysql_fetch_assoc(mysql_query($udd));
$id_udd=$udd['id'];

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <br>
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4>DATA REAKSI TRANSFUSI</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-inline" role="form" method="POST" action="pmitatausaha.php?module=reaksi_transfusi">
                                        <div class="form-group">
                                            Pilih Tahun
                                            <select class="form-control" name="tahun_lap">
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
                                                <option value='<?php echo $tahun;?>' <?php echo $s6; ?> > <?php echo $tahun?> </option>
                                            </select>
                                        </div>
                                        <button class="btn btn-default" type="submit" id="shadow2"><i class="fa fa-check mr-1"></i> OK</button>
                                    </form>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover table-bordered">
                                        <thead class="pmi">
                                            <th class="text-center">No</th>
                                            <th class="text-center" style="width: 70%;">Jenis Reaksi</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Aksi</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $q_sel="SELECT `rtd_id`, `rtd_tahun`, `rtd_id_udd`, `rtd_jenis_rtd`, `rtd_jml` FROM `rpt_data_reaksi_td`
                                                    WHERE `rtd_tahun`='$v_tahun' and `rtd_id_udd`='$id_udd'";
                                            $q_sel=mysql_query($q_sel);
                                            $no=0;
                                            $total=0;
                                            while ($row=mysql_fetch_array($q_sel)){
                                                $no++;
                                                $total=$total+$row['rtd_jml'];
                                                echo '<tr>';
                                                echo    '<td class="text-right">'.$no.'.</td>';
                                                echo    '<td>'.$row["rtd_jenis_rtd"].'</td>';
                                                echo    '<td class="text-right">'.$row["rtd_jml"].'</td>';
                                                echo    '<td class="text-center" nowrap>
                                                            <a href="pmitatausaha.php?module=detail_reaksitd&m=2&x='.$row["rtd_id"].'"  id="shadow2" ><span class="fa fa-pencil" title="Ubah data bangunan">&nbsp;&nbspEdit</span></a>&nbsp;&nbsp';
                                                            ?><a href="pmitatausaha.php?module=aksi&act=d&mdl=rtd&x=<?php echo $row['rtd_id']; ?>" id="shadow2"><span class="fa fa-trash-o text-danger"  title="Hapus data" onclick="return confirm('Are you sure to delete this item?');">&nbsp;&nbspHapus</span></a><?php
                                                echo '</tr>';
                                            }
                                            if ($no==0){
                                                echo '<td colspan="3" class="text-center">Tidak ada data Reaksi Transfusi tahun '.$v_tahun.'</td>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-right">Jumlah</td>
                                            <td class="text-right"><?php echo $total;?></td><td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="pmitatausaha.php?module=detail_reaksitd&m=1" class="btn btn-default" id="shadow2"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Data</a>
                            <a href="pmitatausaha.php?module=profile" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
            </div>
        </div>
    </div>
</body>
</html>