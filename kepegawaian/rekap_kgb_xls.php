<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_kgb.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<?$trans0=mysql_query("select * from pegawai where CAST(kgb1 as date)>='$today' and CAST(kgb1 as date)<='$today1' order by kgb1 ASC");?>
<h3 class="list">Jumlah Pengajuan KGB yang sudah waktunya dari Tgl <?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?><?=$pertgl?> - <?=$perbln?> - <?=$perthn?> <?='&nbsp'.'&nbsp'.'&nbsp'?>s/d<?='&nbsp'.'&nbsp'.'&nbsp'?> <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><?='&nbsp'.'&nbsp'.'&nbsp'?>Berjumlah<?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?><?=mysql_num_rows($trans0)?>  Data</h3>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<tr class="field">
		<tr>
					<th>No</th>
					<th>Tanggal KGB</th>
					<th>Tgl KGB terakhir</th>					
					<th>NIK</th>
					<th width="10%">Nama</th>
					<th>Alamat</th>
					<th width="10%">Wilayah</th>
					<th width="4%">Status</th>
					<th width="10%">Tpt Lahir</th>
					<th width="10%">Tgl Lahir</th>
					<th width="10%">Umur</th>
					<th width="4%">Jenis kelamin</th>
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

$tgl_form=$trans[kgb1];
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

$tgl_form1=$trans[kgb];
$tglf1=date("d",strtotime($tgl_form1));
$blnf1=date("n",strtotime($tgl_form1));
$thnf1=date("Y",strtotime($tgl_form1));
$bulanf1=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf11=$bulanf1[$blnf1];
$jamf1 = date("H:i:s",strtotime($tgl_form1));

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
<?
mysql_close();
?>
