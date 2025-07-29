<?php
$samplevalid="";
$syarattpk='2';
$syarataph='2';
if (isset($_GET['q'])) {
    $q=$_GET['q'];
    include ('../config/dbi_connect.php');
    $chk_sample=mysqli_num_rows(mysqli_query($dbi,"SELECT * FROM `samplekode` WHERE (`sk_donor` is null) and (`sk_kode`='$q')"));
    if ($chk_sample>0){
        $samplevalid="1";
        $sqlu="SELECT `jenisPeriksa`, `Hasil`, `noKantong`,`tglPeriksa`, `idsample` FROM `hasilelisa` WHERE `noKantong`='$q' or `idsample`='$q' and (`noKantong`=`idsample`) ORDER BY `tglPeriksa` DESC";
        $hasil = mysqli_query($dbi,$sqlu);
        $hint_imltd="<b>Tidak ada</b> hasill IMLTD";
        $ujs='2';
        $hasilb='';
        $hasilc='';
        $hasils='';
        $hasili='';
        while ($data = mysqli_fetch_array($hasil)){
            $tgl_imltd=$data['tglPeriksa'];
            if ($data['Hasil']=='0'){
                switch($data['jenisPeriksa']){
                    case "0";$hasilb='NR';break;
                    case "1";$hasilc='NR';break;
                    case "2";$hasili='NR';break;
                    case "3";$hasils='NR';break;
                }
                $hint_imltd="Hasil IMLTD <b>Non Reaktif</b>";
                $ujs='0';
            }else{
                switch($data['jenisPeriksa']){
                    case "0";$hasilb='R';break;
                    case "1";$hasilc='R';break;
                    case "2";$hasili='R';break;
                    case "3";$hasils='R';break;
                }
                $hint_imltd=$tgl_imltd.", hasil IMLTD <b>Reaktif</b>";
                $ujs='1';
            }
        }
        if ( ($ujs=='0') or ($ujs=='1')){
            $hint_imltd =$tgl_imltd.', HBV: <b>'.$hasilb.'</b>, ';
            $hint_imltd .='HCV: <b>'.$hasilc.'</b>, ';
            $hint_imltd .='HIV: <b>'.$hasili.'</b>, ';
            $hint_imltd .='SYP: <b>'.$hasils.'</b>';
        }
        $nat='2';
        $hint_nat="<b>Tidak ada</b> hasil pemeriksaan NAT";
        $qnat=mysqli_fetch_array(mysqli_query($dbi,"SELECT *,date(tglPeriksa) as tgl FROM `hasilnat` WHERE `idsample`='$q' ORDER BY `tglPeriksa` DESC"));
        if ($qnat>1){
            $tgl_nat=$qnat['tgl'];
            switch($qnat['Hasil']){
                case "0" : $hasiln="NR";$nat='0';break;
                case "1" : $hasiln="R";$nat='1';break;
                case "2" : $hasiln="GZ";$nat='1';break;
                default: $hasiln="??";break;
            }
            $hint_nat = $tgl_nat.", NAT: <b>".$hasiln."</b>";
        }

        $sqlkgd="SELECT `GolDarah`,`Rhesus`,`Cocok`,date(tgl) as tgl FROM `dkonfirmasi` WHERE  `idsample`='$q' OR `NoKantong`='$q' and  (`NoKantong`=`idsample`) ORDER BY `id` DESC LIMIT 1";
        $hasil=mysqli_query($dbi,$sqlkgd);
        $data=mysqli_fetch_array($hasil);
        $hint_kgd="<b>Tidak ada</b> hasil KGD";
        $kgd='2';
        $len_data=strlen($data['GolDarah']);
        if ($len_data>0){
            $tgl_kgd=$data['tgl'];
            $hint_kgd=$tgl_kgd.', KGD: <b>'.$data['GolDarah'].' Rh ('.$data['Rhesus'].')</b>';
            $kgd='0';
        }

        $titer='2';
        $hint_titer="<b>Tidak ada</b> hasil Titer Cov-19";
        $qtiter=mysqli_fetch_array(mysqli_query($dbi,"SELECT * FROM `covid` WHERE `cov_sampel`='$q' ORDER BY `cov_tgl` DESC LIMIT 1"));
        if ($qtiter>1){
            $titer='0';
            $hint_titer=$qtiter['cov_tgl'].', <b>'.$qtiter['cov_titer'].'</b><input type="hidden" name="titer" value="'.$qtiter['cov_titer'].'">';
        }
        $dl='2';
        $hem_hb='0';
        $hem_hct='0';
        $hem_plt='0';
        $hem_leu='0';
        $qhema=mysqli_fetch_array(mysqli_query($dbi,"SELECT `dl_id`, `dl_trx`, `dl_kantong`, `dl_sampel`, `dl_tgl`, `dl_labperiksa`, `dl_pj_lab`, `dl_hb`, `dl_hct`, 
                `dl_plt`, `dl_leu`, `on_insert`, `user_input` FROM `hematologi` WHERE `dl_sampel`='$q'"));
        if($qhema){
            $dl='0';
            $hem_hb     = $qhema['dl_hb'];
            $hem_hct    = $qhema['dl_hct'];
            $hem_plt    = $qhema['dl_plt'];
            $hem_leu    = $qhema['dl_leu'];
        }

        $sqlabs="SELECT date(`abs_tgl`) as tgl, `abs_result` as `hasil` FROM `abs` WHERE  `abs_kode_sample`='$q' ORDER BY `abs_id` DESC LIMIT 1";
        $hasil=mysqli_query($dbi,$sqlabs);
        $data=mysqli_fetch_array($hasil);
        $hint_abs="<b>Tidak ada</b> hasil Antibody Screening";
        $abs='2';
        $len_data=strlen($data['hasil']);
        if ($len_data>0){
            $tgl_abs=$data['tgl'];
            $hint_abs=$tgl_abs.', ABS: <b>'.$data['hasil'].'</b>';
            $abs='0';
        }
    }else{
        $hint_imltd=$hint_nat=$hint_kgd=$hint_titer=$hint_abs='Sample tidak ada';
        $hem_hb=$hem_hct=$hem_plt=$hem_leu="???";
        $samplevalid="";
    }
}
if ($ujs=='0' && $nat=='0' && $kgd=='0' && $abs=='0' && $titer=='0' && $dl=='0'){$syarattpk='0';}
if ($ujs=='0' && $kgd=='0' && $abs=='0' && $dl=='0'){$syarataph='0';}
if ($ujs=='1' || $nat=='1'){$syarattpk='1';$syarataph='1';}

$ouput=$hint_imltd.';'.$hint_nat.';'.$hint_kgd.';'.$hint_titer.';'.$hem_hb.';'.$hem_hct.';'.$hem_plt.';'.$hem_leu.';'.$hint_abs.';'.$samplevalid.';'.$syarataph.';'.$syarattpk.';'.$ujs.';'.$nat;
//echo $ouput;
?> 