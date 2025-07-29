<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<h1 class="list">REKAP PENGAJUAN PENGHARGAAN KARYAWAN</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Pilih Kategori Penghargaan</td>
					<td class="input">
						 <select name="piagam">
							  <option value="p10">Penghargaan 10 Tahun</option>
							  <option value="p20">Penghargaan 20 Tahun</option>
							  <option value="p30">Penghargaan 30 Tahun</option>
							                                                          
					</td>
	<td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
if (isset($_POST[submit])){
        $piagam 	= $_POST[piagam];
	        switch ($piagam){
                       	case "p10":
				$piagam1="Penghargaan 10 Tahun";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,Status,telp2,golongan,masakerja,TglLhr,ijasah,statuspeg,jabatan FROM pegawai where masakerja>='10' and p10='0' order by Nama ASC ");break;
                        case "p20":
				$piagam1="Penghargaan 20 Tahun";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,Status,telp2,golongan,masakerja,TglLhr,ijasah,statuspeg,jabatan FROM pegawai where masakerja>='20' and p20='0' order by Nama ASC");break;
                     	case "p30":
				$piagam1="Penghargaan 30 Tahun";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,Status,telp2,golongan,masakerja,TglLhr,ijasah,statuspeg,jabatan FROM pegawai where masakerja>='30' and p30='0' order by Nama ASC");break;
                           
		}

?>
<h3 class="list">Daftar karyawan yang belum menerima <?=$piagam1?> sebanyak <?=mysql_num_rows($data)?> Orang</h3>

<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Kode Pendonor</td>
		<td>Nama Pendonor</td>
		<td>Alamat</td>
		<td>Tgl Lahir</td>
                <td>JK</td>
		<td>Status<br>Pernikahan</td>
		<td>pendidikan<br>Terakhir</td>
		<td>Golongan</td>
		<td>Jabatan</td>
		<td>Status<br>Kepegawaian</td>
		<td>Handphone</td>
		<td>Masa Kerja</td>
		</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		switch ($data1[Jk]){
                       case "0":
				$jk="LK";break;
                       case "1":
				$jk="PR";break;
		}
	?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[Kode]?></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[Alamat]?></td>
		<td><?=$data1[TglLhr]?></td>
		<td><?=$jk?></td>
		<? if ($data1[Status]=='0')$status='Bujang';
			if ($data1[Status]=='1')$status='Menikah';
				if ($data1[Status]=='2')$status='Duda';
			if ($data1[Status]=='3')$status='Janda';
				if ($data1[Status]=='4')$status='Suami Karyawan';
			if ($data1[Status]=='5')$status='Istri Karyawan';
		?>
		<td><?=$status?></td>
		<td><?=$data1[ijasah]?></td>
		<td><?=$data1[golongan]?></td>
		<td><?=$data1[jabatan]?></td>

		<? if ($data1[statuspeg]=='0')$peg='Paruh Waktu';
			if ($data1[statuspeg]=='1')$peg='Kontrak';
			if ($data1[statuspeg]=='2')$peg='Tetap';
			if ($data1[statuspeg]=='3')$peg='PNS Diperbantukan';
			if ($data1[statuspeg]=='4')$peg='Resign';
			if ($data1[statuspeg]=='5')$peg='Pindah UDD';
			if ($data1[statuspeg]=='6')$peg='Meninggal';
		?>
		<td><?=$peg?></td>		
		<td><?=$data1[telp2]?></td>
		<td><?=$data1[masakerja]?> Tahun</td>
		</tr>
	<? } ?>
</table>
<br>
<form name=xls method=post action=kepegawaian/rekap_pengajuan_piagam_xls.php>
<input type=hidden name=piagam value='<?=$_POST[piagam]?>'>
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>

<?
}
?>
