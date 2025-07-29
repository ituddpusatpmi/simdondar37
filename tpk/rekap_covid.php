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

?>
<div style="font-size:18px;color:#00008B;">RINCIAN <b>PEMERIKSAAN TITER ANTIBODY COVID-19</b></div>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name="tgl1" id=datepicker size=10 value="<?php echo $tgl1;?>"> Sampai :
		<input type=text name="tgl2" id=datepicker1 size=10 value="<?php echo $tgl2;?>">
		<input type=submit name=submit value="Tampikan data" class="swn_button_blue">
    <a href="pmikonfirmasi.php?module=antibodycovid" class="swn_button_blue">Input Titer Antibody</a>
	</form>
</div>
<table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
<tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>          
	    <td>No</td>
        <td>Transaksi</td>
        <td>Tanggal</td>
        <td>No Sample</td>
        <td>No Kantong</td>
        <td>Gol darah</td>
        <td>Titer</td>
        <td>Hasil</td>
        <td>Metode</td>
        <td>Reagen</td>
        <td>Tempat Periksa</td>
        <td>P. Jawab Lab</td>
        <td>Keterangan</td>
	    </tr>
        <?php
        $sql="SELECT `cov_id`, `cov_trx`, `cov_kantong`, `cov_sampel`, `cov_tgl`, `cov_goldarah`, `cov_rhesus`, `cov_labperiksa`, `cov_titer`, `cov_hasil`, `cov_namareagen`, `cov_pj_lab`, `cov_metode`, `cov_ket`, `on_insert`, `user_input` FROM `covid`
        WHERE date(cov_tgl) between '$tgl1' and '$tgl2'";
        $sqov=mysqli_query($dbi,$sql);
        $no=0;
        while($dt=mysqli_fetch_assoc($sqov)){
            $no++;
            ?>
                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?php echo $no;?></td>
                    <td align="left"><?php echo $dt['cov_trx'];?></td>
                    <td align="left"><?php echo $dt['cov_tgl'];?></td>
                    <td align="left"><?php echo $dt['cov_kantong'];?></td>
                    <td align="left"><?php echo $dt['cov_sampel'];?></td>
                    <td align="center"><?php echo $dt['cov_goldarah'].$dt['cov_rhesus'];?></td>
                    <td align="right"><?php echo $dt['cov_titer'];?></td>
                    <td align="left"><?php echo $dt['cov_hasil'];?></td>
                    <td align="left"><?php echo $dt['cov_metode'];?></td>
                    <td align="left"><?php echo $dt['cov_namareagen'];?></td>
                    <td align="left"><?php echo $dt['cov_labperiksa'];?></td>
                    <td align="left"><?php echo $dt['cov_pj_lab'];?></td>
                    <td align="left"><?php echo $dt['cov_ket'];?></td>
                </td>
                <?php
        }?>
</table>
