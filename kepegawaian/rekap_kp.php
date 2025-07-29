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
<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('terima').focus();
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});});
  </script>
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

<h1 class="table">Isikan Range tanggal yang diinginkan<br>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai :
<input type=text name=minta1 id=datepicker size=10>
Sampai
<input type=text name=minta2 id=datepicker1 size=10>
<input type=submit name=submit value=Submit>

</form></div>
<?$trans0=mysql_query("select * from pegawai where CAST(kp1 as date)>='$today' and CAST(kp1 as date)<='$today1' order by kgb1 ASC");?>
<h2 class="table">Jumlah Pengajuan KP yang sudah waktunya dari Tgl <?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?><?=$pertgl?> - <?=$perbln?> - <?=$perthn?> <?='&nbsp'.'&nbsp'.'&nbsp'?>s/d<?='&nbsp'.'&nbsp'.'&nbsp'?> <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><?='&nbsp'.'&nbsp'.'&nbsp'?>Berjumlah<?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?><?=mysql_num_rows($trans0)?>  Data</h2>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<tr class="field">
		<tr>
					<th>No</th>
					<th>Tanggal KP</th>
					<th>Tgl KP Terakhir</th>					
					<th>NIK</th>
					<th width="10%">Nama</th>
					<th>Alamat</th>
					<th width="10%">Wilayah</th>
					<th width="4%">Status</th>
					<th width="10%">Tpt Lhr</th>
					<th width="10%">Tgl Lhr</th>
					<th width="10%">Umur</th>
					<th width="4%">Jenis Kelamin</th>
					<th width="4%">Ijazah</th>
					<th width="10%">Jabatan</th>
					<th width="10%">Gol</th>
					<th width="10%">Status Peg.</th>
					<th width="10%">TMT</th>
					<th width="5%">Masa kerja</th>
				</tr>
    
  
<?
$no=1;

while ($trans=mysql_fetch_assoc($trans0)) {
$dtrans=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah,GolDarah,JenisDarah from dtranspermintaan where NoForm='$trans[NoForm]'"));
?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td><?=$no++?></td> 
<?

$tgl_form=$trans[kp1];
$tglf=date("d",strtotime($tgl_form));
$blnf=date("n",strtotime($tgl_form));
$thnf=date("Y",strtotime($tgl_form));
$bulanf=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf1=$bulanf[$blnf];
$jamf = date("H:i:s",strtotime($tgl_form));

/*
$blnmin=substr($trans[TglMinta],5,2);
$tglmin=substr($trans[TglMinta],8,2);
$thnmin=substr($trans[TglMinta],0,4);*/
?>
	<td class=input><?=$tglf?> <?=$blnf1?> <?=$thnf?> </td>
	<?

$tgl_form1=$trans[kp];
$tglf1=date("d",strtotime($tgl_form1));
$blnf1=date("n",strtotime($tgl_form1));
$thnf1=date("Y",strtotime($tgl_form1));
$bulanf1=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf11=$bulanf1[$blnf1];
$jamf = date("H:i:s",strtotime($tgl_form1));

/*
$blnmin=substr($trans[TglMinta],5,2);
$tglmin=substr($trans[TglMinta],8,2);
$thnmin=substr($trans[TglMinta],0,4);*/
?>
	<td class=input><?=$tglf1?> <?=$blnf11?> <?=$thnf1?> </td>  
	<td class=input><?=$trans[Kode]?></td>
      	<td class=input><?=$trans[Nama]?></td>
	<td class=input><?=$trans[Alamat]?></td>
	<td class=input><?=$trans[Wilayah]?></td>
      	<td class=input><?=$trans[Status]?></td>
      	<td class=input><?=$trans[TempatLhr]?></td>
	<td class=input><?=$trans[TglLhr]?></td>
	<td class=input><?=$trans[umur]?> Tahun</td>
	<td class=input><?=$trans[Jk]?></td>
	<td class=input><?=$trans[ijasah]?></td>
      	<td class=input><?=$trans[jabatan]?></td>
      	<td class=input><?=$trans[golongan]?></td>
	<td class=input><?=$trans[statuspeg]?></td>
      	<td class=input><?=$trans[tmt]?></td>
      	<td class=input><?=$trans[masakerja]?> Tahun</td>
      	</tr>
<?
}
?>
</table>
<br>
<form name=xls method=post action=kepegawaian/rekap_kp_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Pengajuan KP (.XLS)'>
</form>
</table>
