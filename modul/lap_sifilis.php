<?
$sipilis17sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='0') and 
(NoKantong in (select noKantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis17sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='0') and 
(NoKantong in (select noKantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis17gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='0') and 
(NoKantong in (select noKantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis17gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='0') and 
(NoKantong in (select noKantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));
/*
$sipilis17spr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='1') and 
(NoKantong in (select noKantong from drapidtest where 
jenisperiksa='3' and Hasil='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3' and Hasil='1'))"));

$sipilis17swr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='1') and 
(NoKantong in (select noKantong from drapidtest where 
jenisperiksa='3' and Hasil='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3' and Hasil='1'))"));

$sipilis17gpr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='1') and 
(NoKantong in (select noKantong from drapidtest where 
jenisperiksa='3' and Hasil='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3' and Hasil='1'))"));

$sipilis17gwr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='1') and 
(NoKantong in (select noKantong from drapidtest where 
jenisperiksa='3' and Hasil='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3' and Hasil='1'))"));
*/
$sipilis17spr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode and datediff('$today',p.TglLhr)/360>=17 and datediff('$today',p.TglLhr)/360<=30 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and (tr.jenisperiksa='3' and tr.Hasil='0' or he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis17swr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode and datediff('$today',p.TglLhr)/360>=17 and datediff('$today',p.TglLhr)/360<=30 and p.Jk='1' and ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and (tr.jenisperiksa='3' and tr.Hasil='0' or he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis17gpr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode and datediff('$today',p.TglLhr)/360>=17 and datediff('$today',p.TglLhr)/360<=30 and p.Jk='0' and ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and (tr.jenisperiksa='3' and tr.Hasil='0' or he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis17gwr=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode and datediff('$today',p.TglLhr)/360>=17 and datediff('$today',p.TglLhr)/360<=30 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and (tr.jenisperiksa='3' and tr.Hasil='0' or he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis31sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where jenisperiksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis31sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where jenisperiksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis31gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis31gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis31spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis31swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis31gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis31gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis41sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis41sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis41gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis41gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis41spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis41swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis41gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis41gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis51sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis51sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis51gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis51gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis51spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis51swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis51gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis51gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis61sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis61sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis61gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis61gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>61 
and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='3') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='3'))"));

$sipilis61spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis61swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis61gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='0' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

$sipilis61gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='1' and 
ht.NoKantong=tr.noKantong and ht.NoKantong=he.noKantong and
( tr.jenisperiksa='3' and tr.Hasil='0' or 
he.jenisPeriksa='3' and he.Hasil='1')"));

?>
