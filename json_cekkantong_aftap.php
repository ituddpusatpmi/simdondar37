<?
include "config/db_connect.php";
$no_kantong = mysql_real_escape_string($_GET[NoKantong]);
$q_kantong=mysql_query("select Status,StatTempat from stokkantong where NoKantong='$no_kantong'");
$a_kantong=mysql_fetch_assoc($q_kantong);
if ($a_kantong[Status]==0 and $a_kantong[StatTempat]=='0' )) { //isi & sah
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah belum disahkan"}';
    echo '}';
} elseif($a_kantong[Status]==2 ) { //sehat
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah berstatus sehat"}'; 
    echo '}';
} elseif($a_kantong[Status]==3 ) { 
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah berstatus keluar"}'; 
    echo '}';
} elseif($a_kantong[Status]==4 ) { 
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah berstatus rusak"}'; 
    echo '}';
} elseif($a_kantong[Status]==5 ) { 
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah berstatus rusak gagal"}'; 
    echo '}';
} elseif(mysql_numrows($q_kantong)==0) { 
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah belum terdaftar"}'; 
    echo '}';
} elseif($a_kantong[Status]==1 ) { 
    echo '{"kantong": ';
    echo '{"valid":"Kantong darah berstatus karantina"}'; 
    echo '}';
} else{ 
    echo '{"kantong": ';
    echo '{"valid":"1"}'; 
    echo '}';
}
echo mysql_error();
?>


