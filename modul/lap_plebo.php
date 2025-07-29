<?
$plebos=mysql_num_rows(mysql_query("select NoKantong
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and 
caraAmbil='7' and JenisDonor='0'")); 

$plebop=mysql_num_rows(mysql_query("select NoKantong
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and 
caraAmbil='7' and JenisDonor='1'")); 

$pleboAplus=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as A
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='7'  and 
NoKantong in (select noKantong from stokkantong where gol_darah='A' 
and RhesusDrh='+')"));
 
$pleboAmin=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as A
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='7'and 
NoKantong in (select noKantong from stokkantong where gol_darah='A' 
and RhesusDrh='-')"));

$pleboBplus=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as B
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='7'and 
NoKantong in (select noKantong from stokkantong where gol_darah='B' 
and RhesusDrh='+')"));
 
$pleboBmin=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as B
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='7'and 
NoKantong in (select noKantong from stokkantong where gol_darah='B' 
and RhesusDrh='-')"));


$pleboOplus=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as O
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='5'and 
NoKantong in (select noKantong from stokkantong where gol_darah='O' 
and RhesusDrh='+')"));
 
$pleboOmin=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as O
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='5'and 
NoKantong in (select noKantong from stokkantong where gol_darah='O' 
and RhesusDrh='-')"));

$pleboABplus=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as AB
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='5'and 
NoKantong in (select noKantong from stokkantong where gol_darah='AB' 
and RhesusDrh='+')"));
 
$pleboABmin=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) as AB
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
caraAmbil='5'and 
NoKantong in (select noKantong from stokkantong where gol_darah='AB' 
and RhesusDrh='-')"));

?>
