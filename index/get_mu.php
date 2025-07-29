<?php
include('../config/dbi_connect.php');
mysqli_query($dbi, "SET SESSION sql_mode = ''");
$displaymu ='';
$displaymu ='
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title text-center">JADWAL MOBILE UNIT</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
            <thead class="card-header-primary">
                <th class="text-center" style="vertical-align: middle;">NO.</th>
                <th class="text-center" style="vertical-align: middle;">HARI</th>
                <th class="text-center" style="vertical-align: middle;">TGL</th>
                <th class="text-center" style="vertical-align: middle;">JAM</th>
                <th class="text-center" style="vertical-align: middle;">JML</th>
                <th class="text-center" style="vertical-align: middle;">TEMPAT KEGIATAN</th>
                <th class="text-center" style="vertical-align: middle;">STATUS</th>
            </thead>
            <tbody>';
            $sq0="SELECT kegiatan.NoTrans, date(kegiatan.TglPenjadwalan) as tglasli, date_format(kegiatan.TglPenjadwalan,'%w') as hari,
                date_format(kegiatan.TglPenjadwalan,'%d-%m-%y') as tanggal, date_format(kegiatan.jammulai,'%H:%i') as jam, kegiatan.tempat, kegiatan.Status,
                kegiatan.jumlah as jumlah, kegiatan.lat as lat, kegiatan.lng as lng, detailinstansi.nama as nama, detailinstansi.alamat as alamat
                from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
                where cast(kegiatan.TglPenjadwalan as date)>=current_date ORDER BY kegiatan.TglPenjadwalan ASC";
            $no=0;
            $sql=mysqli_query($dbi,$sq0);
            $classstatus="";
            while($data=mysqli_fetch_assoc($sql)){
                $no++;
                switch ($data['hari']){
                    case '0':$hari="Minggu";break;
                    case '1':$hari="Senin";break;
                    case '2':$hari="Selasa";break;
                    case '3':$hari="Rabu";break;
                    case '4':$hari="Kamis";break;
                    case '5':$hari="Jumat";break;
                    case '6':$hari="Sabtu";break;
                }
                switch($data['Status']){
                    case "0":$status="Terjadwal";$classstatus="card-header-warning";break;
                    case "1":$status="Fixed";$classstatus="";break;
                }
                if ($data['tempat']==""){$tempat=$data['alamat'];}else{$tempat=$data['tempat'];}
                $displaymu .='
                <tr class="zoom">
                    <td class="text-right"  nowrap>'.$no.'.</td>
                    <td class="text-center" nowrap>'.$hari.'</td>
                    <td class="text-center" nowrap>'.$data['tanggal'].'</td>
                    <td class="text-center" nowrap>'.$data['jam'].'</td>
                    <td class="text-center" nowrap>'.$data['jumlah'].'</td>
                    <td class="text-left" nowrap><span class="text-primary">'.$data['nama'].'</span> <small>'.$tempat.'</small></td>
                    <td class="text-center '.$classstatus.'" nowrap>'.$status.'</td>
                </tr>';
            } 
$displaymu .='</tbody></table></div></div></div>
    <style>
    .zoom:hover {
        transform: scale(1.03);
        font-weight: 900;
    } 
    .zoom{  
        transform-origin: 0% 1%;
        transition: transform 1s, filter .5s ease-out;
    }
    </style>';
echo $displaymu;
?>