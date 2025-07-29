<?
$mobilesingle250=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as single250
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='1' 
and volumeasal='250')"));

$mobilesingle350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as single350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='1' 
and volumeasal='350')"));

$mobilesingle450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as single450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='1' 
and volumeasal='450')"));

$mobiledouble350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as double350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='2' 
and volumeasal='350')"));

$mobiledouble450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as double450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='2' 
and volumeasal='450')"));

$mobiletriple350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as triple350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='3' 
and volumeasal='350')"));

$mobiletriple450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as triple450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='3' 
and volumeasal='450')"));

$mobilequadruple350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as quadruple350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='4' 
and volumeasal='350')"));

$mobilequadruple450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as quadruple450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='4' 
and volumeasal='450')"));

$mobilepediatrik=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as pediatrik
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
(tempat='2' or tempat='3' or tempat='M') and 
NoKantong in (select noKantong from stokkantong where jenis='6')"));
?>
