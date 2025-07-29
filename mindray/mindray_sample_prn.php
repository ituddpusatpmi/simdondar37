<?php
  include('../config/db_connect.php');
  $nokantong	= $_GET['nokantong'];
  $utd		= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
  $sql		= mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$nokantong' limit 1"));
  $kodependonor	= $sql['kodePendonor'];
  $donor	= mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kodependonor'"));
  $transaksi	= mysql_fetch_assoc(mysql_query("select * from htransaksi where NoKantong='$nokantong'"));
  $e_hbsag	= mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode,noKantong,noLot from hasilelisa where noKantong='$nokantong' and jenisPeriksa='0'"));
  $e_hcv	= mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode,noKantong,noLot from hasilelisa where noKantong='$nokantong' and jenisPeriksa='1'"));
  $e_hiv	= mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode,noKantong,noLot from hasilelisa where noKantong='$nokantong' and jenisPeriksa='2'"));
  $e_syp	= mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode,noKantong,noLot from hasilelisa where noKantong='$nokantong' and jenisPeriksa='3'"));
  $r_hbsag	= mysql_fetch_assoc(mysql_query("select Hasil,Metode,noKantong,nolot from drapidtest where noKantong='$nokantong' and jenisPeriksa='0'"));
  $r_hcv	= mysql_fetch_assoc(mysql_query("select Hasil,Metode,noKantong,nolot from drapidtest where noKantong='$nokantong' and jenisPeriksa='1'"));
  $r_hiv	= mysql_fetch_assoc(mysql_query("select Hasil,Metode,noKantong,nolot from drapidtest where noKantong='$nokantong' and jenisPeriksa='2'"));
  $r_syp	= mysql_fetch_assoc(mysql_query("select Hasil,Metode,noKantong,nolot from drapidtest where noKantong='$nokantong' and jenisPeriksa='3'"));
  $hbsag1=' ';  $hcv1	=' ';  	$hiv1=' ';  $syp1=' ';
  $hbsag2=' ';  $hcv2=' ';  	$hiv2=' ';  $syp2=' ';
  if ($e_hbsag[Hasil]=='1') $hbsag1='Reaktif';
  if ($e_hcv[Hasil]=='1') $hcv1='Reaktif';
  if ($e_hiv[Hasil]=='1') $hiv1='Reaktif';
  if ($e_syp[Hasil]=='1') $syp1='Reaktif';
  if ($r_hbsag[Hasil]=='0') $hbsag2='Reaktif';
  if ($r_hcv[Hasil]=='0') $hcv2='Reaktif';
  if ($r_hiv[Hasil]=='0') $hiv2='Reaktif';
  if ($r_syp[Hasil]=='0') $syp2='Reaktif';
  if ($e_hbsag[Hasil]=='0') $hbsag1='Non Reaktif';
  if ($e_hcv[Hasil]=='0') $hcv1='Non Reaktif';
  if ($e_hiv[Hasil]=='0') $hiv1='Non Reaktif';
  if ($e_syp[Hasil]=='0') $syp1='Non Reaktif';
  if ($r_hbsag[Hasil]=='1') $hbsag2='Non Reaktif';
  if ($r_hcv[Hasil]=='1') $hcv2='Non Reaktif';
  if ($r_hiv[Hasil]=='1') $hiv2='Non Reaktif';
  if ($r_syp[Hasil]=='1') $syp2='Non Reaktif';
?>
<title>HASIL UJI SARING IMLTD <?=$utd[nama]?></title>
<img src='../images/header_pmi_750x62.png' width=750px>
<body>
<h1><?=$utd[nama]?></h1>
<h2><strong><u>HASIL PEMERIKSAAN UJI SARING DARAH</u></h2></strong>
<form name="transaksi"  method="post" action="<?=$PHPSELF?>">
  <table class="record" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
    <tr>
	<td width=120>Nomor Kantong</td><td class="input" >: <?=$nokantong?></td>
	<td width=130>Tgl. Periksa</td><td width=150 class="input">:
	<?if ($hiv2==' '){?>
	    <?=$e_hiv[tglPeriksa]?><?;}else{?><?=$r_hiv[tglPeriksa]?><?;}
	  ?></td>
    </tr>
    <tr>
	<td>Nama Donor</td><td class="input">: <?=$donor[Nama]?></td>
	<td>Tgl. Donor</td><td class="input">: <?=$transaksi[Tgl]?></td>
    </tr>
    <tr>
	<td>Alamat</td><td class="input" >: <?=$donor[Alamat]?></td>
	<td>ID Donor</td><td class="input">: <?=$kodependonor?></td>
    </tr>
    <tr>
	<td>Telp</td><td class="input" >: <?=$donor[telp2]?></td>
	<td>Golongan Darah</td><td class="input">: <?=$donor[GolDarah]?>(<?=$donor[Rhesus]?>)</td>
    </tr>
  </table>
  <table class="record" border="1" cellspacing="0" cellpadding="5" width=750 style="border-collapse:collapse">
      <tr>
	<td align=center rowspan=2><b>No</td>
	<td align=center rowspan=2><b>Parameter Uji Saring IMLTD</td>
	<td align=center colspan=4><b>Hasil</td>
      </tr>
      <tr>
	<td align=center><b>Metode</td>
	<td align=center><b>OD</td>
	<td align=center><b>Interpretasi</td>
	<td align=center><b>Keterangan</td>
      </tr>
      <tr>
	<td align=center rowspan=2>1.</td><td rowspan=2>HBsAg</td><td>- Elisa</td><td align=right><?=$e_hbsag[OD]?></td><td align=center><?=$hbsag1?></td>
	<td></td>
      </tr>
      <tr>
	<td>- Rapid</td><td align=right><?=$r_hbsag[OD]?></td><td align=center><?=$hbsag2?></td><td></td>
      </tr>
      <tr>
	<td align=center rowspan=2>2.</td><td rowspan=2>Anti - HCV</td><td>- Elisa</td><td align=right><?=$e_hcv[OD]?></td><td align=center><?=$hcv1?></td>
	<td></td>
      </tr>
      <tr>
	<td>- Rapid</td><td align=right><?=$r_hcv[OD]?></td><td align=center><?=$hcv2?></td>
	<td></td>
      </tr>
      <tr>
	<td align=center rowspan=2>3.</td><td rowspan=2>Anti - HIV</td><td>- Elisa</td><td align=right><?=$e_hiv[OD]?></td><td align=center><?=$hiv1?></td>
	<td></td>
      </tr>
      <tr>
	<td>- Rapid</td><td align=right><?=$r_hiv[OD]?></td><td align=center><?=$hiv2?></td><td></td>
      </tr>
      <tr>
	<td align=center rowspan=2>4.</td><td rowspan=2>Syphilis</td><td>- Elisa</td><td align=right><?=$e_syp[OD]?></td><td align=center><?=$syp1?></td>
	<td></td>
      </tr>
      <tr>
	<td>- Rapid</td><td align=right><?=$r_syp[OD]?></td><td align=center><?=$syp2?></td><td></td>
      </tr>
  </table>

<table class="list" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
  <tr>
    <td></td><td></td>
  </tr>
  <tr>
   <td align="center" valign="top"><br>Pemeriksa,<br><br><br><br><br></td>
   <td align="center" valign="top"><br><?=$utd[nama]?><br>Penanggung Jawab/Dokter,</td>
  </tr>
  <tr>
    <td align="center" class="input" >.....................................</td>
    <td align="center" class="input" >.....................................</td>
  </tr>
</table>
</form>
</body>
<tfoot>
<table width=750px>
  <tr>
    <?$waktu=date('d/m/Y');?>
    <td align=right><a href="javascript:window.print()"><?=$waktu?></a></td>
    <td align=center></td>
    </tr>
</table>
</tfoot>
  

