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
<h1 class="list">REKAP PENGAJUAN PIAGAM</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Pilih Kategori Piagam</td>
					<td class="input">
						 <select name="piagam">
							  <option value="p10" selected>Piagam 10</option>
							  <option value="p25">Piagam 25</option>
							  <option value="p50">Piagam 50</option>
							  <option value="p75">Piagam 75</option>
							  <option value="p100">Piagam 100</option>
                                                         
					</td>
	<td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
if (isset($_POST[submit])){
        $piagam 	= $_POST[piagam];
	        switch ($piagam){
                       	case "p10":
				$piagam1="10 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>'9' and p10='0' order by Nama ASC ");break;
                        case "p25":
				$piagam1="25 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>'24' and p25='0' order by Nama ASC");break;
                     	case "p50":
				$piagam1="50 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>'49' and  p50='0' order by Nama ASC");break;
                        case "p75":
				$piagam1="75 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>'74' and p75='0' order by Nama ASC");break;
                        case "p100":
				$piagam1="100 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>'99' and p100='0' order by Nama ASC");break;
                           
		}

?>
<h3 class="list">Daftar Pendonor Yang Belum terima Piagam <?=$piagam1?> sebanyak <?=mysql_num_rows($data)?> Orang</h3>

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
		<td>Gol Darah</td>
		<td>Rhesus</td>
		<td>Handphone</td>
		<td>Donor Ke</td>
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
		<td><a href="pmip2d2s.php?module=eregistrasi&Kode=<?=$data1[Kode]?>"><?=$data1[Kode]?></a></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[Alamat]?></td>
		<td><?=$data1[TglLhr]?></td>
		<td><?=$jk?></td>
		<td><?=$data1[GolDarah]?></td>
		<td><?=$data1[Rhesus]?></td>
		<td><?=$data1[telp2]?></td>
		<td><?=$data1[jumDonor]?></td>
		</tr>
	<? } ?>
</table>
<br>
<form name=xls method=post action=modul/rekap_pengajuan_piagam_xls.php>
<input type=hidden name=piagam value='<?=$_POST[piagam]?>'>
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>

<?
}
?>
