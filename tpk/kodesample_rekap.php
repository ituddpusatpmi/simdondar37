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
<div style="padding-bottom:10px;font-size:18px;color:#00008B;">RINCIAN <b>KODE SAMPEL PRE DONASI</b></div>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name="tgl1" id=datepicker style="width:3cm;" value="<?php echo $tgl1;?>">-
		<input type=text name="tgl2" id=datepicker1 style="width:3cm;" value="<?php echo $tgl2;?>"> Kode :
        <input type=text name="src" style="width:4cm;" value="<?php echo $src;?>">
		<input type=submit name=submit value="Ok" class="swn_button_blue">
        <a href="pmi<?php echo $lv0;?>.php?module=samplekode" class="swn_button_blue">Buat Kode</a>
	</form>
</div>
<table border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse;min-width:770px;" class="bayangan">
    <tr style="background-color:#ff9f80; font-size:14px; color:#000000;font-weight:none;" align='center'>
        <td>No</td>
        <td>Transaksi</td>
        <td>Tanggal</td>
        <td>Jam</td>
        <td>Kode Sample</td>
        <td>Gol Darah</td>
        <td>Jenis Sample</td>
        <td>Pembuat</td>
        <td>Pendonor</td>
	</tr>
        <?php
        $sql="SELECT `sk_id`, `sk_trans`, `sk_tgl`, `sk_jenis`, `sk_kode`, `sk_user`, `sk_gol`, `sk_rh`,`sk_on_insert`,`sk_donor` FROM `samplekode` 
              WHERE (date(`sk_tgl`) between '$tgl1' and '$tgl2') and (`sk_kode` like '%$src%')";
        $sqov=mysqli_query($dbi,$sql);
        $no=0;
        while($dt=mysqli_fetch_assoc($sqov)){
            $no++;
            switch($dt['sk_jenis']){
                case 'APH':$jenis="Apheresis";break;
                case 'TPK':$jenis="Plasma Konvalesen";break;
                case 'KON':$jenis="Donor Konseling";break;
            }
            ?>
                <tr style="font-size:12px; color:#000000;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?php echo $no;?></td>
                    <td align="left"><?php echo $dt['sk_trans'];?></td>
                    <td align="center"><?php echo $dt['sk_tgl'];?></td>
                    <td align="center"><?php echo date("h:i",$dt['sk_on_insert']);?></td>
                    <td align="left"><?php echo $dt['sk_kode'];?></td>
                    <td align="center"><?php echo $dt['sk_gol'].$dt['sk_rh'];?></td>
                    <td align="left"><?php echo $jenis;?></td>
                    <td align="center"><?php echo $dt['sk_user'];?></td>
                    <td align="center"><?php echo $dt['sk_donor'];?></td>
                </tr>
                <?php
        }
        if ($no==0){
            ?>
            <tr style="font-size:12px; color:#000000;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="center" colspan="9">Tidak ada data pembuatan kode</td>
            </tr><?php
        }
        ?>
</table>
<div style="padding-top:10px;font-size: 9px;color: #000000">Update 2021-01-25</div>
