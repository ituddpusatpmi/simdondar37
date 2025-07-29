<?
$utdsingle250=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as single250
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='1' 
and volumeasal='250')"));

$utdsingle350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as single350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='1' 
and volumeasal='350')"));

$utdsingle450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as single450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='1' 
and volumeasal='450')"));

$utddouble350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as double350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='2' 
and volumeasal='350')"));

$utddouble450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as double450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='2' 
and volumeasal='450')"));

$utdtriple350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as triple350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='3' 
and volumeasal='350')"));

$utdtriple450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as triple450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='3' 
and volumeasal='450')"));

$utdquadruple350=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as quadruple350
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='4' 
and volumeasal='350')"));

$utdquadruple450=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as quadruple450
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='4' 
and volumeasal='450')"));

$utdpediatrik=mysql_fetch_assoc(mysql_query("select count(distinct NoKantong) 
as pediatrik
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' and  
tempat='0' and 
NoKantong in (select noKantong from stokkantong where jenis='6')"));
?>
