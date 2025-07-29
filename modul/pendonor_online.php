<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
  include('clogin.php');
  include('config/db_connect_pusat.php');
	
?>
<h1 class="list">Penelusuran Data Pendonor Pusat</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Masukkan Kode Pendonor</td>
					<td class="input">
						 <input name="noform"> </input>
                                                         
					</td>
	<td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
$today=date('Y-m-d');
if (isset($_POST[submit])){
       
	       {
                       	
				//$data=mysql_query("SELECT p.NoForm, p.bagian,p.NamaOS,p.jk,p.TglLahir,p.umur,p.jenis,p.rs,p.regRS,p.golDrh,p.rhesus,c.NoKantong,
//c.StatusCross,c.stat2,c.tgl,c.petugas,c.cheker,d.KodePendonor FROM htranspermintaan as p dtransaksipermintaan as c htransaksi as d where p.Noform='$noform' ");
		$data3=mysql_query("select * from pendonor where Kode='$_POST[noform]' ");
		$dataminta=mysql_fetch_assoc($data3);
			$data4=mysql_query("select * from htransaksi where KodePendonor='$_POST[noform]' order by Tgl ASC");

		
		$kode=$dataminta[Kode];

     $jkps='Laki-laki';                  
    if ($dataminta[jk]=='1') $jkps='Perempuan';   
	$cekal='Confirm';                  
    if ($dataminta[Cekal]=='0') $cekal='OK'; 
	$ket='<input type=submit name=submit1 value="sudah waktnya donor">';
	if ($dataminta[Cekal]=='1' ) $ket='Tidak Boleh Donor'; 
	if ($dataminta[Cekal]=='0' and strtotime($dataminta[tglkembali])>=strtotime($today)) $ket='Belum Waktunya Donor'; 
               
                           
		}

?>
<table>

<h4 class="list"><tr><td>Kode Donor</td><td>:</td><td name='kode' type='text'><?=$dataminta[Kode]?></td><td></td><td name='alamat' type='text'>Alamat</td><td>:</td><td><?=$dataminta[Alamat]?></td><td></td><td>Tgl Kembali</td><td>:</td><td><?=$dataminta[tglkembali]?></td></tr></h4>
<h4 class="list"><tr><td>Nama Pasien</td><td>:</td><td name='nama' type='text'><?=$dataminta[Nama]?></td><td></td><td>Kelurahan</td><td>:</td><td><?=$dataminta[kelurahan]?></td><td></td><td>Ket</td><td>:</td><td><?=$ket?></td></tr></h4>
<h4 class="list"><tr><td>Tempat Lahir</td><td>:</td><td><?=$dataminta[TempatLhr]?></td><td></td><td>Kecamatan</td><td>:</td><td><?=$dataminta[kecamatan]?></td></tr></h4>
<h4 class="list"><tr><td>Tanggal Lahir</td><td>:</td><td><?=$dataminta[TglLhr]?></td><td></td><td>Wilayah</td><td>:</td><td><?=$dataminta[wilayah]?></td></tr></h4>
<h4 class="list"><tr><td>Usia</td><td>:</td><td><?=$dataminta[umur]?> tahun</td><td></td><td>Donor Ke</td><td>:</td><td><?=$dataminta[jumDonor]?> Kali</td></tr></h4>
<h4 class="list"><tr><td>Jenis Kelamin</td><td>:</td><td><?=$jkps?></td><td></td><td>Pekerjaan</td><td>:</td><td><?=$dataminta[Pekerjaan]?></td></tr></h4>
<h4 class="list"><tr><td>Gol & Rh Darah</td><td>:</td><td><?=$dataminta[GolDarah]?>(<?=$dataminta[Rhesus]?>)</td><td></td><td>Status</td><td>:</td><td><?=$cekal?></td></tr></h4>
<?
 if (isset($_POST[submit1])){ 
		/*MySQL connection local */

 // include('config/db_connect.php');
	
		$donorluar=mysql_query("insert into pendonor_luarkota (`Kode`,`Nama`,`Alamat`)value('$_GET[kode]','$_GET[nama]','$_GET[alamat]')");
		if ($donorluar){ echo "donor luar sudah masuk";} else {echo "Data tidak masuk";	}		

			}   
?>


</table>
<table>
<h4 class="list">Jumlah Pemakaian Kantong Sebanyak :  <?=mysql_num_rows($data4)?>  Kantong</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Tgl Donor</td>
		<td>nokantong</td>
		<td>Tempat</td>
		<td>Status</td>
		</tr>
	<?
	$no=0;
	while ($datapasien=mysql_fetch_assoc($data4)) { 
	$no++;
	
//	$datapasien=mysql_fetch_assoc($data4);
	
	$pengambilan='Batal';                  
	if ($datapasien[Pengambilan]=='2') $pengambilan='Gagal Aftap';
	if ($datapasien[Pengambilan]=='0') $pengambilan='Berhasil';
	$status='Titip / Belum Pembayaran';
	if ($data1[Status]=='0') $status='Sudah Dibawa ';	
	if ($data1[Status]=='B') $status='Batal';
	$pendonor=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$data1[NoKantong]'"));
	$pendonor1=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$pendonor[kodePendonor]'"));
	$kantong=mysql_fetch_assoc(mysql_query("select * from stokkantong where NoKantong='$data1[NoKantong]'"));
	$udd3=mysql_fetch_assoc(mysql_query("select nama from utd where id='$datapasien[kota]'"));		
	$udd2=mysql_fetch_assoc(mysql_query("select nama from utd where id='$kantong[AsalUTD]'"));
	
	$kantong1='Sehat';
	if ($kantong[hasil]=='4') $kantong1='Reaktif';
	

	?>
		<tr class="record">
		<td><?=$no?></td>
		<td><?=$datapasien[Tgl]?></td>
		<td><?=$datapasien[NoKantong]?></td>
		<td><?=$udd3[nama]?></td>
		<td><?=$pengambilan?></td>
		
		</tr>
	<? } ?>
</table>
<br>
<form name=xls method=post action=modul/check_data_pasien_xls.php>
<input type=hidden name=noform value='<?=$_POST[noform]?>'>
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>

<?
}
?>
