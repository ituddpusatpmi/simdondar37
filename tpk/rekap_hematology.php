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
require_once('clogin.php');
$tgl1=date('Y-m-d');
$tgl2=$tgl1;
if (isset($_POST['tgl1'])) {$tgl1=$_POST['tgl1'];$$tgl2=$tgl1;}
if ($_POST['tgl2']!='') $tgl2=$_POST['tgl2'];

?>
<div style="font-size:18px;color:#00008B;">RINCIAN <b>PEMERIKSAAN DARAH LENGKAP</b></div>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name="tgl1" id=datepicker size=10 value="<?php echo $tgl1;?>"> Sampai :
		<input type=text name="tgl2" id=datepicker1 size=10 value="<?php echo $tgl2;?>">
		<input type=submit name=submit value="Tampikan data" class="swn_button_blue">
    <a href="pmikonfirmasi.php?module=hematologi" class="swn_button_blue">Input</a>
	</form>
</div>
<table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
    <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>          
	    <td>No</td>
        <td>Transaksi</td>
        <td>Tanggal</td>
        <td>No Sample</td>
        <td>No Kantong</td>
        <td>Hemoglobin</td>
        <td>Hematokrit</td>
        <td>Trombosit</td>
        <td>Leukosit</td>
        <td>Tempat Periksa</td>
        <td>P. Jawab Lab</td>
        <td>Petugas</td>
	</tr>
        <?php
        $sql="SELECT `dl_id`, `dl_trx`, `dl_kantong`, `dl_sampel`, `dl_tgl`, `dl_labperiksa`, `dl_pj_lab`, `dl_hb`, `dl_hct`, `dl_plt`, `dl_leu`, `on_insert`, `user_input` 
            FROM `hematologi` WHERE date(dl_tgl) between '$tgl1' and '$tgl2'";
        $sq=mysqli_query($dbi,$sql);
        $no=0;
        while($dt=mysqli_fetch_assoc($sq)){
            $no++;
            ?>
                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?php echo $no;?></td>
                    <td align="left"><?php echo $dt['dl_trx'];?></td>
                    <td align="left"><?php echo $dt['dl_tgl'];?></td>
                    <td align="left"><?php echo $dt['dl_kantong'];?></td>
                    <td align="left"><?php echo $dt['dl_sampel'];?></td>
                    <td align="center"><?php echo $dt['dl_hb'];?></td>
                    <td align="center"><?php echo $dt['dl_hct'];?></td>
                    <td align="center"><?php echo $dt['dl_plt'];?></td>
                    <td align="center"><?php echo $dt['dl_leu'];?></td>
                    <td align="left"><?php echo $dt['dl_labperiksa'];?></td>
                    <td align="left"><?php echo $dt['dl_pj_lab'];?></td>
                    <td align="left"><?php echo $dt['user_input'];?></td>
                </td>
                <?php
        }?>
</table>
