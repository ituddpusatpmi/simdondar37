<?php
require_once('../adm/config.php');
    
$today=date('Y-m-d');
$today1=$today;
$srcnama= $_POST['nama'];
$srcnik="";
$srctgllhr="";
$srcgol="";
$srcrh="";
$srcalamat="";
$srcjk="";
$key = '12131415';
    
    $response = array("error" => FALSE);
      //Parameter
      $nama = $_POST['nama'];
      $tgl1 = $_POST['tgl1'];
      $tgl2 = $_POST['tgl2'];
      $token = $_POST['token'];
    
    
            $namaps     = $_POST['namaps'];
            $normps     = $_POST['normps'];
            $noregrs    = $_POST['noregrs'];
            $dokter     = $_POST['dokter'];
            $bagian     = $_POST['bagian'];
            $kelas      = $_POST['kelas'];
            $ruang      = $_POST['ruang'];
            $diagnosa   = $_POST['diagnosa'];
            $hb         = $_POST['hb'];
            $golprd     = $_POST['golprd'];
            $rhprd      = $_POST['rhprd'];
            $natprd     = $_POST['natprd'];
            $jnspermintaanprd= $_POST['jnspermintaanprd'];
            $tgllhrps   = $_POST['tgllhrps'];
            $user       = $_POST['user'];
        
            $noidrs    = $_POST['rs'];
            $namars    = $_POST['namars'];

            //Jenis Produk
            $ahf    =$_POST['ahf'];
            $ffp    =$_POST['ffp'];
            $ffppk  = $_POST['ffppk'];
            $la     = $_POST['la'];
            $fp     = $_POST['fp'];
            $lp     = $_POST['lp'];
            $lpa    = $_POST['lpa'];
            $prc    = $_POST['prc'];
            $prcl   = $_POST['prcl'];
            $prp    = $_POST['prp'];
            $tc     = $_POST['tc'];
            $tca    = $_POST['tca'];
            $wb     = $_POST['wb'];
            $we     = $_POST['we'];
            $dokada = $_POST['dokumen'];
    
            if($token == $key){
    
    
            //------------------------ set id permintaan ------------------------->
            
            $th         = substr(date("Y"),2,2);
            $bl         = date("m");
            $tgl        = date("d"); $jam = date("H"); $menit = date("i");
            $kdtp       = $noidrs."-".$tgl.$bl.$th."-";
            $idps       = mysqli_query($con,"select noform from htranspermintaan where noform like '$kdtp%' order by noformRS DESC");
            $idps1      = mysqli_fetch_array($idps);
            $idps2      = substr($idps1['noform'],11,4);
            if ($idps2<1) {$idps2="0000";}
            $idps3      = (int)$idps2+1;
            $ids31      = strlen($idps2)-strlen($idps3);
            $idps4      = "";
            for ($i=0; $i<$ids31; $i++){
                $idps4 .="0";
            }
            $noform_oto=$kdtp.$jam.$menit;
            //------------------------ END set id transaksi ------------------------->
    
            //------------------------ CARI USIA ------------------------------------>
            $tanggal_lahir = new DateTime($tgllhrps);
            $sekarang = new DateTime("today");
            if ($tanggal_lahir > $sekarang) {
            $thn = "0";
            }
            $thn = $sekarang->diff($tanggal_lahir)->y;
    
    
            //------------------------ INSERT HTRANSPERMINTAANRS -------------------->
    
            $permintaan="INSERT INTO `htranspermintaanRS` (`noformRS`, `bagian`, `kelas`, `namadokter`, `tglminta`, `diagnosa`, `alasan`, `hb`, `stat`, `rs`, `regrs`, `tempat`, `nojenis`, `no_rm`, `umur`, `petugas`, `tgl_register`, `ruangan`,  `jenis_permintaan`,`dokumen`) VALUES ('$noform_oto','$bagian','$kelas','$dokter',NOW(),'$diagnosa','ANEMIA','$hb','0','$noidrs','$noregrs','UDD','','$normps','$thn','$user',NOW(),'$ruang','$jnspermintaanprd','$dokada')";
    
    
            //------------------------ INSERT DTRANSPERMINTAANRS -------------------->
    
            if ($ahf != ""){ $qahf = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','AHF','$golprd','$rhprd','$ahf','0','','', curdate(),'UDD','$normps','$natprd')";} else {$sahf="";}
            if ($ffp != ""){$qffp = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','FFP','$golprd','$rhprd','$ffp','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qffp="";}
            if ($ffppk != ""){$qffppk = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','FFP KONVALESEN','$golprd','$rhprd','$ffppk','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qffppk="";}
            if ($la != ""){$qla = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','Lekosit Aferesis','$golprd','$rhprd','$la','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qla="";}
            if ($fp != ""){$qfp = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','FP','$golprd','$rhprd','$fp','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qfp="";}
            if ($lp != ""){$qlp = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','LP','$golprd','$rhprd','$lp','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qlpa="";}
            if ($lpa != ""){$qlpa = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','LP Aferesis','$golprd','$rhprd','$lpa','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qlpa="";}
            if ($prc != ""){$qprc = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','PRC','$golprd','$rhprd','$prc','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qprc="";}
            if ($prcl != ""){$qprcl = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','PRC LEUCODEPLETED','$golprd','$rhprd','$prcl','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qprcl="";}
            if ($prp != ""){$qprp = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','PRP','$golprd','$rhprd','$prp','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qprp="";}
            if ($tc != ""){$qtc = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','TC','$golprd','$rhprd','$tc','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qtc="";}
            if ($tca != ""){$qtca = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','TC AFERESIS','$golprd','$rhprd','$tca','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qtca="";}
            if ($wb != ""){$qwb = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','WB','$golprd','$rhprd','$wb','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qwb="";}
            if ($we != ""){$qwe = "insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values ('$noform_oto','WE','$golprd','$rhprd','$we','0','','', curdate(),'UDD','$normps','$natprd')";} else {$qwe="";}
    
    
            
    
       
        //$query =   "select * from pasien where nama like '%$nama%'".$qgol.$qrh.$qalamat.$qnik.$qjk.$qnik.$qtgllhr;
        
        $result  = mysqli_query($con, $permintaan);
        //$result2  = mysqli_query($con, $qwb);
        //$result1 = mysqli_query($con, $qtc);
        //$number_of_rows = mysqli_num_rows($result);

        //$response = array();

        if (!$result) {
            $arr = array();
            $arr['info'] = 'error';
            $arr['msg'] = 'Data tidak berhasil diproses.';
            echo json_encode($arr);
            echo $permintaan;
            exit();
        } else {
            $result1  = mysqli_query($con, $qahf);
            $result2  = mysqli_query($con, $qffp);
            $result3  = mysqli_query($con, $qffppk);
            $result4  = mysqli_query($con, $qla);
            $result5  = mysqli_query($con, $qfp);
            $result6  = mysqli_query($con, $qlp);
            $result7  = mysqli_query($con, $qlpa);
            $result8  = mysqli_query($con, $qprc);
            $result9  = mysqli_query($con, $qprcl);
            $result10  = mysqli_query($con, $qprp);
            $result11  = mysqli_query($con, $qtc);
            $result12  = mysqli_query($con, $qtca);
            $result13  = mysqli_query($con, $qwb);
            $result14  = mysqli_query($con, $qwe);
            
            $conwa = mysqli_connect('localhost', 'root', 'F201603907', 'wagw');
            
            //Whatsapp PMI
            $sapa ="Semangat Pagi";
            $pesan= $sapa.', Info Permintaan Darah Online : RS.'.$namars.', atas nama pasien : '.$namaps.' ('.$thn.' thn) | Gol. '.$golprd.'/'.$rhprd.' |  RM('.$noregrs.') | Petugas : '.$user.'. Silahkan verifikasi melalui Simdondar ';
            
            $wa ="insert into wagw.outbox (wa_mode,wa_no,wa_text) values ('1','083150909275','$pesan')";
                       
            //WA petugas
            $kirim2 =mysqli_query($conwa,$wa);
            
        $arr = array();
        $arr['info'] = 'success';
        $arr['msg'] = 'Data berhasil diproses.';
        echo json_encode($arr);
        echo $permintaan.$wa;
            }
    } else{
        $arr = array();
        $arr['info'] = 'Invalid';
        $arr['msg'] = 'Token Tidak Valid';
        echo json_encode($arr);
    }
    
        mysqli_close();
?>
