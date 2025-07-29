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
  font-size : 150%;
}
  tr { background-color: #ffffcc}
  .initial { background-color: #ffffcc; color:#000000 }
  .normal { background-color: #ffffcc }
  .highlight { background-color: #7CFC00 }
</style>

<?php
include('config/dbi_connect.php');
$tgl1=date('Y-m-d');
$tgl2=$tgl1;
if (isset($_POST['tgl1'])) {$tgl1=$_POST['tgl1'];$$tgl2=$tgl1;}
if ($_POST['tgl2']!='') $tgl2=$_POST['tgl2'];

?>
<div style="font-size:18px;color:#00008B;">RINCIAN <b>PEMERIKSAAN IMLTD - NAT</b></div>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name="tgl1" id=datepicker style="width:3cm;" value="<?php echo $tgl1;?>"> Sampai :
		<input type=text name="tgl2" id=datepicker1 style="width:3cm;" value="<?php echo $tgl2;?>">
		<input type=submit name=submit value="Tampikan data" class="swn_button_blue">
	</form>
</div>
<table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
    <tr style="background-color:#FF6346; font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>          
        <td>No</td>
        <td>Transaksi</td>
        <td>Tanggal</td>
        <td>No Sample</td>
        <td>No Kantong</td>
        <td>Gol darah</td>
        <td>OD/Ratio</td>
        <td>Hasil</td>
        <td>Metode</td>
        <td>Reagen</td>
        <td>No Lot</td>
        <td>ED</td>
        <td>Tempat Periksa</td>
	</tr>
        <?php
        $sql="SELECT *, date(tglPeriksa) as tanggal, case when Hasil='0' THEN 'Non Reaktif' WHEN hasil='1' THEN 'Reaktif' WHEN hasil='2' THEN 'Greyzone' END AS hasil 
              from hasilnat WHERE date(tglPeriksa) between '$tgl1' and '$tgl2'";
        $sqov=mysqli_query($dbi,$sql);
        $no=0;
        while($dt=mysqli_fetch_assoc($sqov)){
            $no++;
            ?>
                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?php echo $no;?></td>
                    <td align="left"><?php echo $dt['notrans'];?></td>
                    <td align="left"><?php echo $dt['tanggal'];?></td>
                    <td align="left"><?php echo $dt['idsample'];?></td>
                    <td align="left"><?php echo $dt['noKantong'];?></td>
                    <td align="center"><?php echo $dt['nat_goldarah'].$dt['nat_rhesus'];?></td>
                    <td align="right"><?php echo $dt['OD'];?></td>
                    <td align="left"><?php echo $dt['hasil'];?></td>
                    <td align="left"><?php echo $dt['Metode'];?></td>
                    <td align="left"><?php echo $dt['reagen'];?></td>
                    <td align="left"><?php echo $dt['noLot'];?></td>
                    <td align="left"><?php echo $dt['ed'];?></td>
                    <td align="left"><?php echo $dt['tempat_periksa'];?></td>
                </td>
                <?php
        }?>
</table>
