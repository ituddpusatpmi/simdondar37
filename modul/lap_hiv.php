<?
$hiv17sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv17sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv17gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv17gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv17spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv17swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv17gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv17gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv31sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv31sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv31gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv31gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv31spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv31swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv31gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv31gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv41sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv41sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv41gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv41gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv41spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv41swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv41gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv41gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv51sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv51sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv51gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv51gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv51spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv51swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv51gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv51gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv61sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv61sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv61gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv61gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>61 
and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='2') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='2'))"));

$hiv61spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv61swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv61gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

$hiv61gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='2' and tr.Hasil='0' or 
he.jenisPeriksa='2' and he.Hasil='1')"));

?>
