<?
$hbsag17sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag17sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag17gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag17gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t17 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=17 
and datediff('$today',TglLhr)/360<=30 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag17spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag17swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag17gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag17gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t17 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=17 
and datediff('$today',p.TglLhr)/360<=30 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag31sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag31sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag31gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag31gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t31 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=31 
and datediff('$today',TglLhr)/360<=40 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag31spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag31swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag31gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag31gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t31 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=31 
and datediff('$today',p.TglLhr)/360<=40 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag41sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag41sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag41gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag41gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t41 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=41 
and datediff('$today',TglLhr)/360<=50 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag41spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag41swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag41gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag41gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t41 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=41 
and datediff('$today',p.TglLhr)/360<=50 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag51sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag51sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag51gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag51gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t51 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>=51 
and datediff('$today',TglLhr)/360<=60 and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag51spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag51swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag51gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag51gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t51 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>=51 
and datediff('$today',p.TglLhr)/360<=60 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag61sp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag61sw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='0' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag61gp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]' 
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>60 
and Jk='0' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag61gw=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as t61 
from htransaksi where Tgl>='$_POST[waktu]' and Tgl<='$_POST[waktu1]'
and Pengambilan='0' and JenisDonor='1' and KodePendonor in 
(select Kode from pendonor where datediff('$today',TglLhr)/360>61 
and Jk='1' and Cekal='0') and 
(NoKantong in (select nokantong from drapidtest where 
jenisPeriksa='0') or NoKantong in (select noKantong from hasilelisa where 
jenisPeriksa='0'))"));

$hbsag61spr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag61swr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='0' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag61gpr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='0' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

$hbsag61gwr=mysql_fetch_assoc(mysql_query("select count(ht.KodePendonor) as t61 
from htransaksi as ht,pendonor as p,drapidtest as tr,hasilelisa as he where ht.Tgl>='$_POST[waktu]' and ht.Tgl<='$_POST[waktu1]' 
and ht.Pengambilan='0' and ht.JenisDonor='1' and ht.KodePendonor=p.Kode
and datediff('$today',p.TglLhr)/360>61 and p.Jk='1' and 
ht.NoKantong=tr.nokantong and ht.NoKantong=he.noKantong and
(tr.jenisPeriksa='0' and tr.Hasil='0' or 
he.jenisPeriksa='0' and he.Hasil='1')"));

?>
