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
  tr { background-color: #ffffe6}
  .initial { background-color: #ffffe6; color:#000000 }
  .normal { background-color: #ffffe6 }
  .highlight { background-color: #7CFC00 }
  .bayangan {
			border:0.2px solid red;
			padding: 1px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
		}
</style>

<?php
include('config/dbi_connect.php');
$tgl1=date('Y-m-d');
$tgl2=$tgl1;
if (isset($_POST['tgl1'])) {$tgl1=$_POST['tgl1'];$$tgl2=$tgl1;}
if ($_POST['tgl2']!='') $tgl2=$_POST['tgl2'];
($_POST['src']!='') ? $src=$_POST['src']:$src="";
$lv0=$_SESSION['leveluser'];
?>
<div style="padding-bottom:10px;font-size:18px;color:#00008B;">RINCIAN <b>PEMERIKSAAN Antibody Screening - Gell Tes</b></div>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name="tgl1" id=datepicker style="width:3cm;" value="<?php echo $tgl1;?>"> Sampai :
		<input type=text name="tgl2" id=datepicker1 style="width:3cm;" value="<?php echo $tgl2;?>"> Sample/Kantong :
        <input type=text name="src" style="width:5cm;" value="<?php echo $src;?>">
		<input type=submit name=submit value="Tampikan data" class="swn_button_blue">
        <a href="?module=abs_minput" class="swn_button_blue">Input ABS</a>
	</form>
</div>
<table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse" class="bayangan">
    <tr style="background-color:#ff9f80; font-size:14px; color:#000000;font-weight:none;" align='center'>
        <td rowspan="2">No</td>
        <td rowspan="2">Transaksi</td>
        <td rowspan="2">Tanggal</td>
        <td rowspan="2">No Sample</td>
        <td rowspan="2">No Kantong</td>
        <td rowspan="2">Gol darah</td>
        <td rowspan="2">Cell I</td>
        <td rowspan="2">Cell II</td>
        <td rowspan="2">Hasil</td>
        <td colspan="2">Anti-IgG+C3d</td>
        <td colspan="2">Cell I</td>
        <td colspan="2">Cell II</td>
        <td rowspan="2">Pemeriksa</td>
        <td rowspan="2">Checker</td>
        <td rowspan="2">Pengesah</td>
	</tr>
    <tr style="background-color:#ff9f80; font-size:14px; color:#000000;font-weight:none;" align='center'>
        <td>Lot</td><td>ED</td>
        <td>Lot</td><td>ED</td>
        <td>Lot</td><td>ED</td>
    </tr>
        <?php
        $sql="SELECT *, date(`absg_tgl`) as `tanggal`
              from `abs_gell` WHERE (date(`absg_tgl`) between '$tgl1' and '$tgl2') and (`absg_kantong` like '%$src%'  or `absg_sampleid` like '%$src%')";
        $sqov=mysqli_query($dbi,$sql);
        $no=0;
        while($dt=mysqli_fetch_assoc($sqov)){
            $no++;
            ?>
                <tr style="font-size:12px; color:#000000;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?php echo $no;?></td>
                    <td align="left"><?php echo $dt['absg_trans'];?></td>
                    <td align="center"><?php echo $dt['tanggal'];?></td>
                    <td align="left"><?php echo $dt['absg_kantong'];?></td>
                    <td align="left"><?php echo $dt['absg_sampleid'];?></td>
                    <td align="center"><?php echo $dt['absg_golda'].$dt['absg_rh'];?></td>
                    <td align="center"><?php echo $dt['absg_cell_reac'];?></td>
                    <td align="center"><?php echo $dt['absg_cell2_reac'];?></td>
                    <td align="center"><?php echo $dt['absg_result'];?></td>
                    <td align="center"><?php echo $dt['absg_igg_lot'];?></td>
                    <td align="center"><?php echo $dt['absg_igg_ed'];?></td>
                    <td align="center"><?php echo $dt['absg_cell1_lot'];?></td>
                    <td align="center"><?php echo $dt['absg_cell1_ed'];?></td>
                    <td align="center"><?php echo $dt['absg_cell2_lot'];?></td>
                    <td align="center"><?php echo $dt['absg_cell2_ed'];?></td>
                    <td align="left"><?php echo $dt['absg_pemeriksa'];?></td>
                    <td align="left"><?php echo $dt['absg_checker'];?></td>
                    <td align="left"><?php echo $dt['absg_approve'];?></td>
                </td>
                <?php
        }?>
</table>
<div style="padding-top:10px;font-size: 9px;color: #000000">Update 2021-01-25</div>
