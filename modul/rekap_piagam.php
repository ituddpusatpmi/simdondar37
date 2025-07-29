<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);



?>



<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
 //-->
</style>

<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
<input type=submit name=submit value=Submit>
<br>
<h1 class="table">Rekap Piagam Keluar dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
</br>
<!--form rekap-->
<?
$jum=mysql_fetch_assoc(mysql_query("select count(NoKantong) as kod from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and Status='0'  "));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendono) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
$umum=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as A from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis='umum' and ht.NoForm=dt.NoForm and dt.Status='0'"));

//"select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"

$pns=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as B from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like '%askes PNS%' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$inhealt=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as C from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like '%askes inhealt%' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$kesda=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as D from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis='jamkesda' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$kesmas=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as E from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like 'jamkesmas' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$persal=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as F from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like 'jampersal' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$perthal=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as G from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like 'jamperthal' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$sostek=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as H from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like 'jamsostek' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$prov=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as I from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis like 'jamkesprov' and ht.NoForm=dt.NoForm and dt.Status='0'"));
$kos=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as J from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis='' and ht.NoForm=dt.NoForm and dt.Status='0'"));

$wb=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as WB from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%WB%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$prc=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as PRC from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%PRC%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$tc=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as TC from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%TC%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$lp=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as LP from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%LP%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$fp=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as FP from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%FP%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$ffp=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as FFP from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%FFP%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$we=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as WE from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%WE%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$ahf=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as AHF from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%AHF%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$lcd=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as LCD from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk like '%leucodepleted%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$noket=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as J from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.produk='' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));

$a=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as A from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.gol_Darah='A' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$b=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as B from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.gol_Darah='B' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$ab=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as AB from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.gol_Darah='AB' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$o=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as O from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.gol_Darah='O' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$noket1=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as J1 from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.gol_Darah='' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$pos=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as POS from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.RhesusDrh like '%+%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$neg=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as NEG from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.RhesusDrh like '%-%' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));
$noket2=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as J2 from dtransaksipermintaan as dt , htranspermintaan as ht,stokkantong as st where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and st.RhesusDrh='' and st.nokantong=dt.NoKantong and ht.NoForm=dt.NoForm and dt.Status='0'"));

?>

<br>
<table>
<tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap Kantong Keluar dari Jenis Layanan</b></th>
<tr class="field">
<td><b>Jenis Pelayanan</b></td>
<td colspan=2><b>Jumlah Kantong</b></td>
</tr>
<tr><td>Umum</td>
<td class=input><?=$umum[A]?></td><td>= <?=(($umum[A]/$jum[kod])*100)?>%</td></tr>
<tr><td>Askes PNS</td>
<td class=input><?=$pns[B]?></td><td>= <?=(($pns[B]/$jum[kod])*100)?>%</td></tr>
<tr><td>Askes Inhealt</td>
<td class=input><?=$inhealt[C]?></td><td>= <?=(($inhealt[C]/$jum[kod])*100)?>%</td></tr>
<tr><td>Jamkesda</td>
<td class=input><?=$kesda[D]?></td><td>= <?=(($kesda[D]/$jum[kod])*100)?>%</td></tr>
<tr><td>Jamkesmas</td>
<td class=input><?=$kesmas[E]?></td><td>= <?=(($kesmas[E]/$jum[kod])*100)?>%</td></tr>
<tr><td>Jampersal</td>
<td class=input><?=$persal[F]?></td><td>= <?=(($persal[F]/$jum[kod])*100)?>%</td></tr>
<tr><td>Jamperthal</td>
<td class=input><?=$perthal[G]?></td><td>= <?=(($perthal[G]/$jum[kod])*100)?>%</td></tr>
<tr><td>Jamsostek</td>
<td class=input><?=$sostek[H]?></td><td>= <?=(($sostek[H]/$jum[kod])*100)?>%</td></tr>
<tr><td>Jamkesprov</td>
<td class=input><?=$prov[I]?></td><td>= <?=(($prov[I]/$jum[kod])*100)?>%</td></tr>
<tr><td>Tdk Ada Ket.</td>
<td class=input><?=$prov[I]?></td><td>= <?=(($kos[J]/$jum[kod])*100)?>%</td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input colspan=2><?=$jum[kod]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap Kantong Keluar dari Jenis Produk</b></th>
<tr class="field">
<td><b>Jenis Produk</b></td>
<td colspan=2><b>Jumlah Kantong</b></td>
</tr>
<tr><td>WB</td>
<td class=input><?=$wb[WB]?></td><td>= <?=(($wb[WB]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>PRC</td>
<td class=input><?=$prc[PRC]?></td><td>= <?=(($prc[PRC]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>TC</td>
<td class=input><?=$tc[TC]?></td><td>= <?=(($tc[TC]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>LP</td>
<td class=input><?=$lp[LP]?></td><td>= <?=(($lp[LP]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>FP</td>
<td class=input><?=$fp[FP]?></td><td>= <?=(($fp[FP]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>FFP</td>
<td class=input><?=$ffp[FFP]?></td><td>= <?=(($ffp[FFP]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>WE</td>
<td class=input><?=$we[WE]?></td><td>= <?=(($we[WE]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>AHF</td>
<td class=input><?=$ahf[AHF]?></td><td>= <?=(($ahf[AHF]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>Leucodepleted</td>
<td class=input><?=$lcd[LCD]?></td><td>= <?=(($lcd[LCD]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td>Tdk Ada Ket.</td>
<td class=input><?=$noket[J]?></td><td>= <?=(($noket[J]/($wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]))*100)?>%</td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input colspan=2><?=$wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$fp[FP]+$ffp[FFP]+$we[WE]+$ahf[AHF]+$lcd[LCD]+$noket[J]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap Kantong Keluar dari Gol dan Rh Darah</b></th>
<tr class="field">
<td><b>Gol Darah</b></td>
<td colspan=2><b>Jumlah Kantong</b></td>
</tr>
<tr><td>A</td>
<td class=input><?=$a[A]?></td><td>= <?=(($a[A]/($a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]))*100)?>%</td></tr>
<tr><td>B</td>
<td class=input><?=$b[B]?></td><td>= <?=(($b[B]/($a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]))*100)?>%</td></tr>
<tr><td>AB</td>
<td class=input><?=$ab[AB]?></td><td>= <?=(($ab[AB]/($a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]))*100)?>%</td></tr>
<tr><td>O</td>
<td class=input><?=$o[O]?></td><td>= <?=(($o[O]/($a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]))*100)?>%</td></tr>
<tr><td>Tdk Ada Ket.</td>
<td class=input><?=$noket1[J1]?></td><td>= <?=(($noket1[J1]/($a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]))*100)?>%</td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input colspan=2><?=$a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]?></td></tr>
<tr class="field">
<td><b>Rh Darah</b></td>
<td colspan=2><b>Jumlah Kantong</b></td>
</tr>
<tr><td>Positip</td>
<td class=input><?=$pos[POS]?></td><td>= <?=(($pos[POS]/($pos[POS]+$neg[NEG]+$noket2[J2]))*100)?>%</td></tr>
<tr><td>Negatip</td>
<td class=input><?=$neg[NEG]?></td><td>= <?=(($neg[NEG]/($pos[POS]+$neg[NEG]+$noket2[J2]))*100)?>%</td></tr>
<tr><td>Tdk Ada Ket.</td>
<td class=input><?=$noket2[J2]?></td><td>= <?=(($noket2[J2]/($pos[POS]+$neg[NEG]+$noket2[J2]))*100)?>%</td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input colspan=2><?=$pos[POS]+$neg[NEG]+$noket2[J2]?></td></tr>
</table>
</td>


</tr>
</table>
</br>


<!--batas form rekap -->

</form></div>
<br>
<h1 class="table">Rincian Darah Keluar dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
</br>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td><td>Kode Pendonor</td><td>Nama</td><td>Alamat</td><td>JK</td><td>Gol Darah</td><td>Jml Donor</td><td>HP</td><td>Status</td>	<td>Jenis Piagam</td><td>No Piagam</td><td>Tgl Diajukan</td>
	<td>Tgl Dicetak</td>
        <td>Tgl Dikirim</td>
        <td>Tgl Kembali</td>
        </tr>

</tr>	
<?
$no=1;
$q_dtransaksipermintaan=mysql_query("select lp.kodependonor,lp.tglDiajukan,lp.jenispiagam,lp.nopiagam,lp.tglDicetak,lp.tglDiberikan,lp.tglKembali,p.Kode,p.Nama,p.Alamat,p.Jk,p.GolDarah,p.telp2,p.cekal,p.jumDonor,p.p10,p.p25,p.p50,p.p75,p.p100,p.psatya,p.pprov from pendonor as p and piagam as lp where lp.tglDiberikan>='$today' and lp.tglDiberikan<='$today1' order by lp.jenispiagam ");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//	$q_dhasilcross=mysql_query("select Pemeriksa from dhasilcross where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
	$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
	$waktu=mysql_fetch_assoc(mysql_query("(select tglPeriksa as tgl from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select tgl_tes as tgl from testrapid where nokantong='$a_dtransaksipermintaan[NoKantong]') "));
	$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
	$pembayaran=mysql_query("select namabrg,petugas,subTotal,shift from dpembayaranpermintaan where no_kantong='$a_dtransaksipermintaan[NoKantong]' and notrans='$a_dtransaksipermintaan[NoForm]' ");
	$shift=mysql_query("select shift,NamaOS,bagian,TglMinta,rs,jenis,nojenis from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]' ");
	$a_stok=mysql_fetch_assoc($q_stok);
	$a_bayar=mysql_fetch_assoc($pembayaran);
	$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	$a_shift=mysql_fetch_assoc($shift);

	echo mysql_error();
	if($a_stok[produk]!=''){
		$produk=$a_stok[produk];
	}else{
		$produk='WB';
	}
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>    
<td class=input><?=$a_dtransaksipermintaan[Kode]?></td>
<td class=input><?=$a_dtransaksipermintaan[Nama]?></td>
<td class=input><?=$a_dtransaksipermintaan[Alamat]?></td>
<td class=input><?=$a_dtransaksipermintaan[Jk]?></td>
<td class=input><?=$a_dtransaksipermintaan[GolDarah]?></td>
<td class=input><?=$a_dtransaksipermintaan[jumDonor]?></td>
<td class=input><?=$a_dtransaksipermintaan[telp2]?></td>
<td class=input><?=$a_dtransaksipermintaan[cekal]?></td>
<td class=input><?=$a_dtransaksipermintaan[jenispiagam]?></td>
<td class=input><?=$a_dtransaksipermintaan[nopiagam]?>
<?
$blnkel1=substr($a_dtransaksipermintaan[tglDiajukan],5,2);
$tglkel1=substr($a_dtransaksipermintaan[tglDiajukan],8,2);
$thnkel1=substr($a_dtransaksipermintaan[tglDiajukan],0,4);

$blnkel2=substr($a_dtransaksipermintaan[tglDicetak],5,2);
$tglkel2=substr($a_dtransaksipermintaan[tglDicetak],8,2);
$thnkel2=substr($a_dtransaksipermintaan[tglDicetak],0,4);

$blnkel3=substr($a_dtransaksipermintaan[tglDiberikan],5,2);
$tglkel3=substr($a_dtransaksipermintaan[tglDiberikan],8,2);
$thnkel3=substr($a_dtransaksipermintaan[tglDiberikan],0,4);

$blnkel4=substr($a_dtransaksipermintaan[tglKembali],5,2);
$tglkel4=substr($a_dtransaksipermintaan[tglKembali],8,2);
$thnkel4=substr($a_dtransaksipermintaan[tglKembali],0,4);
?>
      	<td class=input><?=$tglkel1?>-<?=$blnkel1?>-<?=$thnkel1?></td>
	<td class=input><?=$tglkel2?>-<?=$blnkel2?>-<?=$thnkel2?></td>
	<td class=input><?=$tglkel3?>-<?=$blnkel3?>-<?=$thnkel3?></td>
	<td class=input><?=$tglkel4?>-<?=$blnkel4?>-<?=$thnkel4?></td>

	</tr>
	<?
}
?>
</table>
<br>
<form name=xls method=post action=modul/rekap_darah_keluar_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Darah Keluar (.XLS)'>
</form>

<?
mysql_close();
?>
