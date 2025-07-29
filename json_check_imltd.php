<?
include "config/db_connect.php";
$no_kantong = mysql_real_escape_string($_GET[NoKantong]);
//$q_kantong=mysql_fetch_assoc(mysql_query("select * from stokkantong where NoKantong='$no_kantong' and Status='1' and sah='1'"));
$q_kantong=mysql_query("select * from stokkantong where (status='1' OR status='2' OR status='6') and sah='1' and NoKantong='$no_kantong' ");
$jml = mysql_num_rows($q_kantong);
if ($jml == 1){
$a_kantong=mysql_fetch_assoc($q_kantong);
$rapid=mysql_query("select * from testrapid where nokantong='$no_kantong'");
$elisa=mysql_query("select * from hasilelisa where noKantong='$no_kantong'");

echo '{"darah": ';
        echo  '{
            "rh":"'.$a_kantong[RhesusDrh].'",
            "gol":"'.$a_kantong[gol_darah].'",';
            while($a_rapid=mysql_fetch_assoc($rapid)){
                if ($a_rapid[jenisPeriksa]=='0') echo '"HBsAg":"r'.$a_rapid[Hasil].'",';
                if ($a_rapid[jenisPeriksa]=='1') echo '"HCV":"r'.$a_rapid[Hasil].'",';
                if ($a_rapid[jenisPeriksa]=='2') echo '"HIV":"r'.$a_rapid[Hasil].'",';
                if ($a_rapid[jenisPeriksa]=='3') echo '"Syp":"r'.$a_rapid[Hasil].'",';
            }
            while($a_elisa=mysql_fetch_assoc($elisa)){
                if ($a_elisa[jenisPeriksa]=='0') echo '"HBsAg":"e'.$a_elisa[OD].'",';
                if ($a_elisa[jenisPeriksa]=='1') echo '"HCV":"e'.$a_elisa[OD].'",';
                if ($a_elisa[jenisPeriksa]=='2') echo '"HIV":"e'.$a_elisa[OD].'",';
                if ($a_elisa[jenisPeriksa]=='3') echo '"Syp":"e'.$a_elisa[OD].'",';
            }
    //if ($q_kantong[noKantong]==$no_kantong and mysql_num_rows($rapid)==0 and mysql_num_rows($elisa)==0) {
    if (($a_kantong[Status]=='1' or $a_kantong[Status]=='4' or $a_kantong[Status]=='2') and $a_kantong[sah]=='1' and mysql_num_rows($rapid)==0 and mysql_num_rows($elisa)==0) {
        echo '"valid":"1"}';
    } elseif($a_kantong[Status]==2 ) { //sehat
        echo '"valid":"Kantong darah berstatus sehat"}';
    } elseif($a_kantong[Status]==3 ) {
        echo '"valid":"Kantong darah berstatus keluar"}';
    //} elseif($a_kantong[Status]==4 ) {
        //echo '"valid":"Kantong darah berstatus rusak. Hubungi Koordinator lab untuk melakukan uji ulang."}';
    } elseif($a_kantong[Status]==5 ) {
        echo '"valid":"Kantong darah berstatus rusak gagal"}';
    } elseif(mysql_numrows($q_kantong)==0) {
        echo '"valid":"Kantong darah belum terdaftar"}';
    } elseif($a_kantong[Status]==0 ) {
        echo '"valid":"Kantong darah berstatus kosong"}';
    } else {
        echo '"valid":"0"}';
    }
    echo '}';

} else {
    $q_sampel=mysql_query("select * from samplekode where sk_kode='$no_kantong' ");
    $a_kantong=mysql_fetch_assoc($q_sampel);
    echo '{"darah": ';
        echo  '{
            "rh":"'.$a_kantong[sk_rh].'",
            "gol":"'.$a_kantong[sk_gol].'",';
            
            
    
    if ($a_kantong[sk_hasil]=='0') {
        echo '"valid":"1"}';
    } else {
        echo '"valid":"0"}';
    }
    echo '}';
}
?>
