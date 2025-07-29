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
<h1 class="list">Penelusuran Data Pasien</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Masukkan Nomor Formulir pasien</td>
					<td class="input">
						 <input name="noform"> </input>
                                                         
					</td>
	<td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
if (isset($_POST[submit])){
       
	       {
                       	
				//$data=mysql_query("SELECT p.NoForm, p.bagian,p.NamaOS,p.jk,p.TglLahir,p.umur,p.jenis,p.rs,p.regRS,p.golDrh,p.rhesus,c.NoKantong,
//c.StatusCross,c.stat2,c.tgl,c.petugas,c.cheker,d.KodePendonor FROM htranspermintaan as p dtransaksipermintaan as c htransaksi as d where p.Noform='$noform' ");
		$data3=mysql_query("select no_rm,shift,bagian,TglMinta,rs,jenis,nojenis,regrs,jenis,bagian,umur,noform from htranspermintaan where noform='$_POST[noform]' ");
		$dataminta=mysql_fetch_assoc($data3);
		$layanan=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$dataminta[jenis]'"));
		//$dataminta=mysql_fetch_assoc($data3);
		$data4=mysql_query("select no_rm,nama,alamat,gol_darah,rhesus,kelamin from pasien where no_rm='$dataminta[no_rm]'");
		$datapasien=mysql_fetch_assoc($data4);
		$data=mysql_query("select * from dtransaksipermintaan where NoForm='$_POST[noform]' order by tgl ASC ");
		

     $jkps='Perempuan';                  
    if ($datapasien[kelamin]=='L') $jkps='Laki - laki';   
                    
                           
		}

?>
<table>


<h4 class="list"><tr><td>Nama Pasien</td><td>:</td><td><?=$datapasien[nama]?></td><td></td><td>No Formulir</td><td>:</td><td><?=$dataminta[noform]?></td></tr></h4>
<?
$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$dataminta[rs]'"));
?>
<h4 class="list"><tr><td>Alamat</td><td>:</td><td><?=$datapasien[alamat]?></td><td></td><td>Rumah Sakit</td><td>:</td><td><?=$rmhskt[NamaRs]?></td></tr></h4>
<h4 class="list"><tr><td>Usia</td><td>:</td><td><?=$dataminta[umur]?> tahun</td><td></td><td>Reg RS</td><td>:</td><td><?=$dataminta[regrs]?></td></tr></h4>
<h4 class="list"><tr><td>Jenis Kelamin</td><td>:</td><td><?=$jkps?></td><td></td><td>Jenis Layanan</td><td>:</td><td><?=$layanan[nama]?></td></tr></h4>
<h4 class="list"><tr><td>Gol & Rh Darah</td><td>:</td><td><?=$datapasien[gol_darah]?>(<?=$datapasien[rhesus]?>)</td><td></td><td>Bagian</td><td>:</td><td><?=$dataminta[bagian]?></td></tr></h4>
</table>
<table>
<h4 class="list">Jumlah Pemakaian Kantong Sebanyak :  <?=mysql_num_rows($data)?>  Kantong</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Tgl Cross</td>
		<td>nokantong</td>
		<td>Gol&Rh</td>
		<td>Produk</td>
		<td>Tgl Aftap</td>
		<td>Tgl IMLTD</td>
		<td>Status Kantong</td>	
		<td>Asal Kantong</td>
		<td>Metode Cross</td>
		<td>hasil Cross</td>
		<td>Aglutinasi</td>
		<td>Keterangan Cross</td>
		<td>Petugas Cross</td>
		<td>Cheker Cross</td>
		<td>Tempat Cross</td>
		<td>Status</td>
		<td>Kode Pendonor</td>
		<td>Nama Pendonor</td>
		</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	$hcross='compatible';                  
	if ($data1[StatusCross]=='0') $hcross='Compatible Boleh Keluar';
	if ($data1[StatusCross]=='2') $hcross='Compatible Tidak Boleh Keluar';
	$status='Titip / Belum Pembayaran';
	if ($data1[Status]=='0') $status='Sudah Dibawa ';	
	if ($data1[Status]=='B') $status='Batal';
	$pendonor=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$data1[NoKantong]'"));
	$pendonor1=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$pendonor[kodePendonor]'"));
	$kantong=mysql_fetch_assoc(mysql_query("select * from stokkantong where NoKantong='$data1[NoKantong]'"));
	$udd3=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'"));		
	$udd2=mysql_fetch_assoc(mysql_query("select nama from utd where id='$kantong[AsalUTD]'"));
	
	$kantong1='Sehat';
	if ($kantong[hasil]=='4') $kantong1='Reaktif';


	?>
		<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[tgl]?></td>
		<td><?=$data1[NoKantong]?></td>
		<td><?=$kantong[gol_darah]?>(<?=$kantong[RhesusDrh]?>)</td>
		<td><?=$kantong[produk]?></td>
		<td> <?=$kantong[tgl_Aftap]?></td>
		<td><?=$kantong[tglperiksa]?></td>
		<td><?=$kantong1?></td>
		<?
		if ($kantong[AsalUTD]=='') {$udd1=$udd3[nama];}else{$udd1=$udd2[nama];}
		?>
		<td><?=$udd1?></td>
		<td><?=$data1[MetodeCross]?></td>
		<td><?=$hcross?></td>
		<td><?=$data1[aglutinasi]?></td>
		<td><?=$data1[stat2]?></td>
		<td><?=$data1[petugas]?></td>
		<td><?=$data1[cheker]?></td>
		<td><?=$data1[tempat]?></td>
		<td><?=$status?></td>
		<td><?=$pendonor[kodePendonor]?></td>
		<td align="left"><?=$pendonor1[Nama]?></td>
		
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
