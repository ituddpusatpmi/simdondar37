<?php
$display="";
if (!empty($_POST['sanple'])){
    include('../config/dbi_connect.php');
    $id_sample = mysqli_real_escape_string($dbi,$_POST['sanple']);
    $no_kantong0=substr($id_sample,0,-1);
    $no_kantonga=$no_kantong0.'A';
    $next=0;
    $mindray=mysqli_query($dbi,"SELECT `id`, `noKantong`, `OD`, `COV`, `notrans`,
            case
            when `jenisPeriksa`='0' then 'HBsAg'
            when `jenisPeriksa`='1' then 'Anti HCV'
            when `jenisPeriksa`='2' then 'Anti HIV'
            when `jenisPeriksa`='3' then 'Syphilis' End As Parameter,
            case
            when `Hasil`='0' then 'Non Reaktif'
            when `Hasil`='1' then 'Reaktif' 
            when `Hasil`='2' then 'Grayzone'  End As Hasil,
            `tglPeriksa`, upper(`dicatatOleh`) as `dicatatOleh`, upper(`dicekOleh`) as `dicekOleh`, upper(`DisahkanOleh`) as `DisahkanOleh`, `noLot`, upper(`Metode`) AS `Metode`, `ulang`, `up_data`, `insert_on`
            FROM `hasilelisa` WHERE (`noKantong`='$id_sample')  order by `id`");
    if(mysqli_num_rows($mindray)>0){
        $next=0;
        $display .='
        <div class="col-xs-12">
            <h4>Data Pemeriksaan IMLTD</h4>
                <div class="table-responsive shadow">
                    <table class="table table-hover table-bordered table-condensed">
                        <thead class="pmi">
                            <tr>
                                <th class="text-center">Transaksi</th>
                                <th class="text-center">Kantong<br>(Sample)</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Parameter</th>
                                <th class="text-center">OD</th>
                                <th class="text-center">Hasil</th>
                                <th class="text-center">Metode</th>
                                <th class="text-center">Nama Reagen</th>
                                <th class="text-center">Lot Reagen</th>
                                <th class="text-center">ED Reagen</th>
                                <th class="text-center">Pemeriksa</th>
                                <th class="text-center">Checker</th>
                                <th class="text-center">Pengesahan</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($imltd=mysqli_fetch_assoc($mindray)){
                            $no++;
                            switch($imltd['Hasil']){
                                case "Non Reaktif"  : $color='';break;
                                case "Grayzone"     : $color='style="background-color:#ffffb3;color:black;"';break;
                                case "Reaktif"      : $color='style="background-color:#F5DEDA;text-color:black;"';break;
                            }
                            $sq_reagen=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `Nama`, `noLot`, `tglKad`  FROM `reagen` WHERE kode='$imltd[noLot]'"));
                            if ($sq_reagen['noLot']==""){
                                $sq_reagen=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `Nama`, `noLot`, `tglKad`  FROM `reagen` WHERE noLot='$imltd[noLot]'"));
                            }
            $display .='
                            <tr>
                                <td class="text-center"><button type="button" class="btn btn-link btn-xs showModal" aria-label="Left Align" data-toggle="modal" data-target="#myModal" data-href="mindray/mindray_konfirm_rpt.php?notrans='.$imltd['notrans'].'nokantong='.$imltd['noKantong'].'&#zoom=FitH&pagemode=none" title="Cetak Hasil IMLTD Mindray sample: '.$imltd['noKantong'].' pemeriksaan no.: '.$imltd['notrans'].'">'.$imltd['notrans'].'</button></td>
                                <td class="text-center">'.$imltd['noKantong'].'</td>
                                <td class="text-center">'.$imltd['tglPeriksa'].'</td>
                                <td>'.$imltd['Parameter'].'</td>
                                <td class="text-center">'.$imltd['OD'].'</td>
                                <td '.$color.'>'.$imltd['Hasil'].'</td>
                                <td class="text-center">'.$imltd['Metode'].'</td>
                                <td>'.$sq_reagen['Nama'].'</td>
                                <td>'.$sq_reagen['noLot'].'</td>
                                <td>'.$sq_reagen['tglKad'].'</td>
                                <td>'.$imltd['dicatatOleh'].'</td>
                                <td>'.$imltd['dicekOleh'].'</td>
                                <td>'.$imltd['DisahkanOleh'].'</td>
                            </tr>';
                        }
        $display .='
                        </tbody>
                    </table>
                </div>
        </div>';
        //Cek di mindray_confirm
        $qry_cl =mysqli_query($dbi, "SELECT *,date(`koonfirm_time`) as tgl FROM `mindray_confirm` WHERE `id_tes` = '$id_sample'");
        if(mysqli_num_rows($qry_cl)>0){
            $display .='
                <div class="col-xs-12">
                    <h4>Data dari Alat Mindray CHLIA</h4>
                    <div class="table-responsive shadow">
                        <table class="table table-hover table-bordered table-condensed">
                            <thead class="pmi">
                                <tr>
                                    <th rowspan="2">Transaksi</th>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">No Sample</th>
                                    <th colspan="5">HBSAG</th>
                                    <th colspan="5">ANTI-HCV</th>
                                    <th colspan="5">ANTI-HIV</th>
                                    <th colspan="5">Syphilis/TP</th>
                                    <th rowspan="2">Operator</th>
                                </tr>
                                <tr>
                                    <th>OD</th>
                                    <th>Hasil</th>
                                    <th>Ref</th>
                                    <th>Lot</th>
                                    <th>ED</th>
                                    <th>OD</th>
                                    <th>Hasil</th>
                                    <th>Ref</th>
                                    <th>Lot</th>
                                    <th>ED</th>
                                    <th>OD</th>
                                    <th>Hasil</th>
                                    <th>Ref</th>
                                    <th>Lot</th>
                                    <th>ED</th>
                                    <th>OD</th>
                                    <th>Hasil</th>
                                    <th>Ref</th>
                                    <th>Lot</th>
                                    <th>ED</th>
                                </tr>
                            </thead>
                            <tbody>';
                            while($mdrconfirm=mysqli_fetch_assoc($qry_cl)){
                                $display .='
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-link btn-xs showModal" aria-label="Left Align" data-toggle="modal" data-target="#myModal" data-href="mindray/mindray_konfirm_rpt.php?notrans='.$imltd['notrans'].'nokantong='.$imltd['noKantong'].'&#zoom=FitH&pagemode=none" title="Cetak Hasil IMLTD Mindray sample: '.$mdrconfirm['id_tes'].' pemeriksaan no.: '.$mdrconfirm['no_trans'].'">'.$mdrconfirm['no_trans'].'</button>
                                    </td>
                                    <td>'.$mdrconfirm['tgl'].'</td>
                                    <td>'.$mdrconfirm['id_tes'].'</td>
                                    <td>'.$mdrconfirm['b_od'].'</td>
                                    <td>'.$mdrconfirm['b_hasil'].'</td>
                                    <td>'.$mdrconfirm['b_range'].' '.$mdrconfirm['b_unit'].'</td>
                                    <td>'.$mdrconfirm['b_lot_reag'].'</td>
                                    <td>'.$mdrconfirm['b_ed_reag'].'</td>
                                    <td>'.$mdrconfirm['c_od'].'</td>
                                    <td>'.$mdrconfirm['c_hasil'].'</td>
                                    <td>'.$mdrconfirm['c_range'].' '.$mdrconfirm['c_unit'].'</td>
                                    <td>'.$mdrconfirm['c_lot_reag'].'</td>
                                    <td>'.$mdrconfirm['c_ed_reag'].'</td>
                                    <td>'.$mdrconfirm['i_od'].'</td>
                                    <td>'.$mdrconfirm['i_hasil'].'</td>
                                    <td>'.$mdrconfirm['i_range'].' '.$mdrconfirm['i_unit'].'</td>
                                    <td>'.$mdrconfirm['i_lot_reag'].'</td>
                                    <td>'.$mdrconfirm['i_ed_reag'].'</td>
                                    <td>'.$mdrconfirm['s_od'].'</td>
                                    <td>'.$mdrconfirm['s_hasil'].'</td>
                                    <td>'.$mdrconfirm['s_range'].' '.$mdrconfirm['s_unit'].'</td>
                                    <td>'.$mdrconfirm['s_lot_reag'].'</td>
                                    <td>'.$mdrconfirm['s_ed_reag'].'</td>
                                    <td>'.$mdrconfirm['user'].'</td>
                                </tr>
                                ';
                            }
       $display .='         </tbody>
                        </table>
                    </div>
                </div>';
        }

    }else{
        $next=1;
        $display ='
            <div class="col-xs-12">
                <h3 class="text-danger">Tidak ada data sample : '.$id_sample.'</small></h3>
            </div>
            ';
    }
    $jumdata=0;
    $qkantong="SELECT * FROM `stokkantong` WHERE (`nokantong` like '$no_kantong0%') ORDER BY `noKantong` ASC";
    $q_kantong=mysqli_query($dbi,$qkantong);
    if ($q_kantong){$jumdata=mysqli_num_rows($q_kantong);}
    if ($jumdata>0){
        $next=0;
        $display .='
            <div class="col-xs-12">
                <h4>Data Kantong</h4>
                <div class="table-responsive shadow">
                    <table class="table table-hover table-bordered table-condensed">
                        <thead class="pmi">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">No Kantong</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Vol(ml)</th>
                                <th class="text-center">Golda</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tgl Aftap</th>
                                <th class="text-center">Tgl IMLTD</th>
                                <th class="text-center">Tgl KGD</th>
                                <th class="text-center">Tgl Pengolahan</th>
                                <th class="text-center">Tgl Release</th>
                                <th class="text-center">Tgl ED</th>
                                <th class="text-center">Tgl Keluar</th>
                                <th class="text-center">Tgl Musnah</th>
                                <th class="text-center">Sah</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $no=0;
                        while ($row=mysqli_fetch_assoc($q_kantong)){
                            $no++;
                            $sah='Belum';    if ($row['sah']=='1') $sah='Sudah';
                            $konfirm='Belum';if ($row['statKonfirmasi']=='1'){
                                $konfirm='Sudah';
                                $kgd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `tgl` FROM `dkonfirmasi` WHERE `NoKantong`='$no_kantonga'"));
                                if (strlen($row['produk'])>0){
                                    $tgl_kgd=$kgd['tgl'];
                                }else{
                                    $tgl_kgd='';
                                }
                            } 
                            $bawa=mysqli_fetch_assoc(mysqli_query($dbi,"select Status from dtransaksipermintaan where nokantong='$row[noKantong]'"));
                            
                            switch ($row['Status']) {
                                case 0 :
                                    $ckt_status="Kosong";
                                    if ($row['StatTempat']==NULL) $ckt_status="Kosong di Logistik";
                                    if ($row['StatTempat']=='0') $ckt_status="Kosong di Logistik";
                                    if ($row['StatTempat']=='1') $ckt_status="Kosong di Aftap";
                                    break;
                                case 1:
                                    $ckt_status="Aftap";
                                    if ($row['sah']=='1') $ckt_status="Karantina";
                                    break;
                                case 2:
                                    $ckt_status="Sehat";
                                    if (substr($row['stat2'],0,1)=='b') $tempat=" (BDRS)";
                                    break;
                                case 3:
                                    $ckt_status="Keluar";
                                    if ($bawa['Status']=='1') $ckt_status="Titip";
                                    break;
                                case 4:
                                    $ckt_status="Rusak";
                                    break;
                                case 5:
                                    $ckt_status="Rusak-Gagal";
                                    break;
                                case 6:
                                    $ckt_status="Dimusnahkan";
                                    $buang=mysqli_fetch_assoc(mysqli_query($dbi,"select * from ar_stokkantong where noKantong='$row[noKantong]'"));
                                    break;
                            }
                            switch($row['jenis']) {
                                case '1':$jenis='Single';break;
                                case '2':$jenis='Double';break;
                                case '3':$jenis='Triple';break;
                                case '4':$jenis='Quadruple';break;
                                case '6':$jenis='Pediatrik';break;
                                default:$jenis='';
                            }
                            $display .= '
                                <tr>
                                    <td class="text-right"> '.$no.'. </td>
                                    <td> '.$row['noKantong'].' </td>
                                    <td> '.$jenis.' </td>
                                    <td> '.$row['produk'].' </td>
                                    <td class="text-center"> '.$row['volume'].' </td>
                                    <td class="text-center"> '.$row['gol_darah'].$row['RhesusDrh'].' </td>
                                    <td> '.$ckt_status.' </td>
                                    <td> '.$row['tgl_Aftap'].'</td>
                                    <td> '.$row['tglperiksa'].'</td>
                                    <td> '.$tgl_kgd.'</td>
                                    <td> '.$row['tglpengolahan'].'</td>
                                    <td> '.$row['tgl_release'].'</td>
                                    <td> '.$row['kadaluwarsa'].'</td>
                                    <td> '.$row['tgl_keluar'].'</td>
                                    <td> '.$buang['tgl_buang'].'</td>
                                    <td> '.$sah.' </td>
                                </tr>
                            ';
                        }
        $display .='    </tbody>
                    </table>
                </div>
            </div>
            ';
        $next=1;
    }
    if($next>0){
        $donasi=mysqli_query($dbi,"SELECT * FROM `htransaksi` WHERE `NoKantong`='$no_kantonga'");
        if(mysqli_num_rows($donasi)>0){
            $trans=mysqli_fetch_assoc($donasi);
            switch ($trans['Pengambilan']){
                case "0" : $st_ambil="Berhasil";break;
                case "2" : $st_ambil="Gagal";break;
                case "1" : $st_ambil="Batal";break;
            }
            switch ($trans['caraAmbil']){
                case "0" : $cara_ambil="Donor Biasa";break;
                case "1" : $cara_ambil="Donor Tromboferesis";break;
                case "2" : $cara_ambil="Donor Leukaferesis";break;
                case "3" : $cara_ambil="Donor Plasmaferesis";break;
                case "4" : $cara_ambil="Donor Eritoferesis";break;
            }
            ($trans['JenisDonor']=='0') ? $dsdp="Donor Sukarela" : $dsdp = "Donor Pengganti";
            ($trans['donorbaru']=='0') ? $lamabaru="Donor Baru" : $lamabaru = "Donor Rutin";
            ($trans['Instansi']=='') ? $instansi="UDD PMI" : $instansi = $trans['Instansi'];
            ($trans['jk']=='0') ? $kelamin="Laki-laki" : $kelamin = "Perempuan";
            $display .='
            <div class="col-xs-12">
                <h4>Data Donasi</h4>
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-condensed">
                    <thead class="pmi">
                        <th>Tempat Donor</th>
                        <th>Jenis Pengambilan</th>
                        <th>Jenis Donor</th>
                        <th>Donor Baru/Lama</th>
                        <th>Donor ke</th>
                        <th>Kelamin</th>
                        <th>Umur</th>
                        <th>Pekerjaan</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-center">'.$instansi.'</td>
                        <td class="text-center">'.$cara_ambil.'</td>
                        <td class="text-center">'.$dsdp.'</td>
                        <td class="text-center">'.$lamabaru.'</td>
                        <td class="text-center">'.$trans['donorke'].'</td>
                        <td class="text-center">'.$kelamin.'</td>
                        <td class="text-center">'.$trans['umur'].'</td>
                        <td class="text-center">'.$trans['pekerjaan'].'</td>
                        </tr>
                    </tbody>
                </table>
            </div>';    
        }
    }
    
}
echo $display;
?>