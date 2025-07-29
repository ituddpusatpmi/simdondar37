<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style>
 .awesomeText{
  color : #000;
  font-size : 100%;
}
  tr { background-color: #ffffe6}
  .initial { background-color: #ffffe6; color:#000000 }
  .normal { background-color: #ffffe6 }
  .highlight { background-color: #7CFC00 }
</style>

<?php
include('config/dbi_connect.php');
$tgl1=date('Y-m-d');
$tgl2=$tgl1;
if (isset($_POST['tgl1'])) {$tgl1=$_POST['tgl1'];$$tgl2=$tgl1;}
if ($_POST['tgl2']!='') $tgl2=$_POST['tgl2'];
$nama=$_POST['nama'];

?>
<div style="font-size:18px;color:#00008B;">RINCIAN PEMERIKSAAN <b>PCR DONOR PENYINTAS COVID-19</b></div>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name="tgl1" id=datepicker size=10 value="<?php echo $tgl1;?>"> Sampai :
		<input type=text name="tgl2" id=datepicker1 size=10 value="<?php echo $tgl2;?>">Pendonor :
        <input type=text name="nama" size=10 value="<?php echo $nama;?>">
		<input type=submit name=submit value="Tampikan data" class="swn_button_blue">
        <a href="pmikasir.php?module=swab" class="swn_button_blue">Input Hasil Swab PCR</a>
	</form>
</div>
<table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
<tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>          
	    <td>No</td>
        <td>Transaksi</td>
        <td>Tanggal</td>
        <td>Kode Pendonor</td>
        <td>Nama</td>
        <td>Gol Darah</td>
        <td>Hasil</td>
        <td>Metode</td>
        <td>Tempat Periksa</td>
        <td>P. Jawab Lab</td>
        <td>Keterangan</td>
	    </tr>
        <?php
        $sql="SELECT 
        `c`.`pcr_id`, `c`.`pcr_trx`, `c`.`pcr_pendonor`, `c`.`pcr_tglperiksa`, `c`.`pcr_RdRp_gen`, `c`.`pcr_labperiksa`, `c`.`pcr_N_gen`, `c`.`pcr_hasil`, `c`.`pcr_metode`, `c`.`pcr_pj_lab`, `c`.`pcr_ket`, `c`.`on_insert`, `c`.`user_input`, DATEDIFF(current_date,`c`.`pcr_tglperiksa`) as hari,  
        p.`Kode`, p.`Nama`, p.`Alamat`, p.`telp2`, case when p.`Jk`='0' THEN 'LK' ELSE 'PR' END AS `Kelamin`, p.`GolDarah`,p.`Rhesus`,p.`TglLhr`
        FROM `covid_pcr` `c` left join `pendonor` `p` on `p`.`Kode`=`c`.`pcr_pendonor`
        WHERE date(`c`.`pcr_tglperiksa`) between '$tgl1' and '$tgl2' and p.`Nama` like '%$nama%'";
        $sqov=mysqli_query($dbi,$sql);
        $no=0;
        while($dt=mysqli_fetch_assoc($sqov)){
            $no++;
            ?>
                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?php echo $no;?></td>
                    <td align="left"><?php echo $dt['pcr_trx'];?></td>
                    <td align="left"><?php echo $dt['pcr_tglperiksa'].' ('.$dt['hari'].' hari)';?></td>
                    <td align="left"><?php echo $dt['Kode'];?></td>
                    <td align="left"><?php echo $dt['Nama'];?></td>
                    <td align="center"><?php echo $dt['GolDarah'].$dt['Rhesus'];?></td>
                    <td align="right"><?php echo $dt['pcr_hasil'];?></td>
                    <td align="left"><?php echo $dt['pcr_metode'];?></td>
                    <td align="left"><?php echo $dt['pcr_labperiksa'];?></td>
                    <td align="left"><?php echo $dt['pcr_pj_lab'];?></td>
                    <td align="left"><?php echo $dt['pcr_ket'];?></td>
                </td>
                <?php
        }?>
</table>
