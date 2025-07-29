<?
include "../config/db_connect.php";
$no_kantong = mysql_real_escape_string($_GET[NoKantong]);
$q_kantong=mysql_query("SELECT `sk_id`, `sk_trans`, `sk_tgl`, `sk_jenis`, `sk_kode`, `sk_donor`, `sk_gol`, `sk_rh`, `sk_user`, `sk_ptg_plebotomi`, `sk_tgl_plebotomi`, `sk_vol_plebotomi`, `sk_tmp_plebotomi`, `sk_on_insert` FROM `samplekode` 
                       where sk_kode='$no_kantong'");
if (mysql_num_rows($q_kantong)=='1') {
    echo '{"kantong":{';
        $kodependonor='';
        while($a_kantong=mysql_fetch_assoc($q_kantong)){
            if ($a_kantong[kodePendonor]=="0" or $a_kantong[kodePendonor]==""){
                $kodependonor_lama = $a_kantong[kodePendonor_lama];
            }else{
                $kodependonor = $a_kantong[kodePendonor];
            }
            echo '"gol":"'.$a_kantong[gol_darah].'",';
            
            $asal = $a_kantong[kantongAsal];
            if ($asal!=''){
                $q_komponen=mysql_query("select NoKantong,gol_darah
                       from stokkantong
                       where kantongAsal='$asal'");
            }
            echo '"saudara'.'":"'.$asal.',';
            while($a_komponen=mysql_fetch_assoc($q_komponen)){
                //echo $a_komponen[NoKantong].',';
            }
            echo '",';
            
        }
            if ($kodependonor_lama==""){
                $q_pendonor=mysql_query("select Nama,Kode from pendonor where Kode='$kodependonor'");
                while($a_pendonor=mysql_fetch_assoc($q_pendonor)){
                    echo '"nama":"'.$a_pendonor[Nama].'",';
                    echo '"kode":"'.$a_pendonor[Kode].'"';
                }
            }elseif ($kodependonor==""){
                $q_pendonor=mysql_query("select Nama,Kode from pendonor where Kode_lama='$kodependonor_lama'");
                while($a_pendonor=mysql_fetch_assoc($q_pendonor)){
                    echo '"nama":"'.$a_pendonor[Nama].'",';
                    echo '"kode":"'.$a_pendonor[Kode].'"';
                }
            }else{
                    echo '"nama":"';
                    echo '"kode":"';
            }
    echo '}}';
}
?>
