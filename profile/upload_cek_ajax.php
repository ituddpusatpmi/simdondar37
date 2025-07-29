<?php
$output='';
session_start();
include('../config/dbi_connect.php');
$v_jenis    = $_POST['j'];
$sqlconfig  = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * from db_server where modul='laporan'"));
$sqludd     = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * from utd where aktif=1"));
$id_udd         = $sqludd['id'];
$svr_lap_usr    = $sqlconfig['user'];
$svr_lap_ip     = $sqlconfig['ip'];
$svr_lap_db     = $sqlconfig['db'];
$svr_lap_pwd    = $sqlconfig['password'];
$svr_lap_mdl    = $sqlconfig['modul'];
$svr_lap_alias  = $sqlconfig['alias'];
$svr_lap_port   = $sqlconfig['port'];

// Connection to server
$con_lap = mysqli_connect($svr_lap_ip, $svr_lap_usr, $svr_lap_pwd, $svr_lap_db, $svr_lap_port);

$judul_lap='';
$q_lap_bln="";
if (!$con_lap){
    $message_connect_error = '<h2 class="text-center">Koneksi '.$svr_lap_alias.' Gagal!! ('.mysqli_error($con_lap).')</h2>';
} else {
    switch ($v_jenis){
        case '1':
            $judul_lap='DATA LAPORAN BULANAN di '.$svr_lap_alias;
            $chk0="SELECT CONCAT(`d_bulan`,' - ',`d_tahun`) as periode, `on_insert`, `on_update`,@@system_time_zone as waktu FROM `data_donasi`  WHERE  `d_jenis`='W' and `d_id_udd`='$id_udd' ORDER BY `d_tahun`, `d_bulan`";
            $chk=mysqli_query($con_lap, $chk0);
            $jmldata=mysqli_num_rows($chk);
            break;
        case '2' :
            $judul_lap='DATA LAPORAN TAHUNAN di '.$svr_lap_alias;
            $chk0="SELECT `u_tahun` as periode,`on_insert`,`on_update`,@@system_time_zone as waktu FROM `data_umum` WHERE `u_id_udd`='$id_udd' order by `u_tahun` ASC";
            $chk=mysqli_query($con_lap, $chk0);
            $jmldata=mysqli_num_rows($chk);
            break;

        default:break;
    }
    $output='
    <h4>'.$judul_lap.'</h4>
    <table class="table table-responsive table-bordered table-hover">
        <thead class="pmi">
            <tr>
                <th class="text-center" style="vertical-align: middle;">No</th>
                <th class="text-center" style="vertical-align: middle;">Periode</th>
                <th class="text-center" style="vertical-align: middle;">Upload Pertama</th>
                <th class="text-center" style="vertical-align: middle;">Update Terakhir</th>
            </tr>
        </thead>
        <tbody>';
    $no=0;
    if($jmldata>0){
        while ($dt=mysqli_fetch_assoc($chk)){
            $zona=$dt['waktu'];
            $no++;
            $output .='
                <tr>
                    <td class="text-center">'.$no.'</td>
                    <td class="text-center">'.$dt['periode'].'</td>
                    <td class="text-center">'.$dt['on_insert'].'</td>
                    <td class="text-center">'.$dt['on_update'].'</td>
                </tr>';
        }

        $output .='
            </tbody>
        </table>';
    }else{
        $output .='
        <tr>
            <td colspan="4" style="text-align:center;"> BELUM ADA DATA LAPORAN DI SERVER PUSAT</td>
        </tr>';

    }
}
echo $output;
?>