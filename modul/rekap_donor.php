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
<h1 class="list">REKAP JUMLAH DONASI DONOR</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Dari Jumlah Donasi Ke : </td><td><input type="text" name="dari" size ="4"> </input></td><td> Sampai Jumlah Donasi Ke :   </td> </td><td><input type="text" name="sampai" size ="4"> </input></td>                                      
					
	<td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
if (isset($_POST[submit])){        
                      $dari1=$_POST[dari];
			$sampai1=$_POST[sampai];
				$data=mysql_query("SELECT * FROM pendonor where JumDonor >='$_POST[dari]' and JumDonor <='$_POST[sampai]' order by JumDonor ASC ");
                           
		

?>
<h4>Rekap jumlah donor dari : <?=$dari1?> kali, sampai dengan : <?=$sampai1?> kali</h4>
<h3 class="list">Berjumlah : <?=mysql_num_rows($data)?> Orang</h3>

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
		<td><?=$data1[Kode]?></td>
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
<form name=xls method=post action=modul/rekap_donor_xls.php>
<input type=hidden name=piagam value="<?=$_POST[piagam]?>">
<input type=hidden name=dari value="<?=$_POST[dari]?>">
<input type=hidden name=sampai value="<?=$_POST[sampai]?>">
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>

<?
}
?>
