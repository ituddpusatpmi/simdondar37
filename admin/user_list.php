<head>
    <link rel="stylesheet" href="bootsrap337/w3.css">
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <style>
        .shadow{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .shadow-xx{
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
        }
        .form-group{
            margin-top: 1px;
            margin-bottom: 1px;
        }
        .table thead th {
            height: 40px;
            font-size: 14px;
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
    <?php
    include "config/dbi_connect.php";
    function hitungHari($awal,$akhir){
        $tglAwal = strtotime($awal);
        $tglAkhir = strtotime($akhir);
        $jeda = abs($tglAkhir - $tglAwal);
        return floor($jeda/(60*60*24));
    }
    ?>
</head>
<body>
    <div class="container-fluid" style="margin-left: 20px;margin-right:20px;margin-top:20px;">
        <div class="row">   
            <div class="col-xs-12">
                <div class="box">
                    <div class="pull-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle shadow" type="button" data-toggle="dropdown">Menu User <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Tampilan Data</li>
                                <li><a href="?module=aturuser&data=1">User Aktif</a></li>
                                <li><a href="?module=aturuser&data=2">User tidak aktif</a></li>
                                <li><a href="?module=aturuser">Semua</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Data</li>
                                <li><a href="?module=aksiuser&act=tambahuser">Tambah User</a></li>
                            </ul>
                        </div>
                    </div>
                    <h3>Daftar User</h3>
                </div>
            </div>
            <div class="col-xs-12" style="margin-top:10px;">
                <div style="overflow-x:auto;">
                    <table class="table table-hover table-bordered table-condensed">
                        <thead class="pmi">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Nama</th>
                                <th>Level Akses</th>
                                <th>Bagian</th>
                                <th>Jabatan</th>
                                <th>Umur<br>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $modedata=0;
                            if(isset($_GET['data'])){
                                $modedata=$_GET['data'];
                            }
                            switch($modedata){
                                case '1' : $where=" AND `aktif`='0' ";break; //Hanya yg aktif
                                case '2' : $where=" AND `aktif`='1' ";break; //Hanya yg tidak aktif
                                case '0' : $where="";break; //Semua user
                            }
                            $tampil=mysqli_query($dbi,"SELECT *, case when `aktif`='0' THEN 'Aktif' ELSE 'Non Aktif' END AS `status_aktif` from user  where `user`.`id_user` not in ('superadmin') ".$where." ORDER BY `aktif` asc,`bagian`ASC, `nama_lengkap` asc");
                            $tgl_skr = date('Y-m-d');
                            $no=0;
                            $arr_level=array();
                            $sqllevel=mysqli_query($dbi,"SELECT `level`, `alias` FROM `level` ORDER BY `urutan` ASC");
                            while($dtlevel=mysqli_fetch_assoc($sqllevel)){
                                $arr_level[$dtlevel['alias']] = $dtlevel['level'];
                            }
                            // var_dump($arr_level);
                            while ($r=mysqli_fetch_array($tampil)){
                                $no++;
                                $tgl_pwd  = $r['tglpwd'];
                                if ($tgl_pwd==null){$tgl_pwd='2011-01-01';}
                                $pwd_day = hitungHari($tgl_pwd,$tgl_skr);
                                $arr_level_akses=array();
                                $level_akses=$r['multi'];
                                $level_akses_ex=explode(',',$level_akses);
                                echo '<tr>
                                        <td class="text-right">'.$no.'</td>';
                                        if ($r['aktif']=='0'){
                                            echo '<td><a href=?module=aksiuser&act=edituser&id='.$r['id_user'].' class="btn btn-primary btn-block btn-xs shadow-xx">'.strtoupper($r['id_user']).'</td>';
                                        }else{
                                            echo '<td><a href=?module=aksiuser&act=edituser&id='.$r['id_user'].' class="btn btn-danger btn-block btn-xs shadow-xx">'.strtoupper($r['id_user']).'</td>';
                                        }
                                echo ' <td nowrap>'.$r['nama_lengkap'].'</td>'; 
                                echo ' <td>';
                                            foreach ($level_akses_ex as $row) {
                                                $test=array_keys($arr_level,$row);
                                                if(!empty($test)){
                                                    echo '<button type="button" class="btn btn-default btn-xs">'.$test[0].'</button> ';
                                                }
                                            }
                                echo ' </td>';
                                echo ' <td>'.$r['bagian'].'</td>';
                                echo ' <td nowrap>'.$r['jabatan'].'</td>';
                                echo ' <td class="text-right">'.number_format($pwd_day,0,'','.').'</td>';
                                echo ' </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <div>
    </div>
    <br>
</body>
