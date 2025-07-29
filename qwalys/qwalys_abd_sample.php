<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style>
    .awesomeText {
        color: #000;
        font-size: 150%;
    }
</style>

<style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size:14px;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 4px;
    }

    #customers tr:nth-child(even){background-color: #ffe6e6;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 4px;
        padding-bottom: 4px;
        text-align: left;
        background-color: #ff6666;
        color: white;
    }
</style>

<body>
<?
include('config/db_connect.php');

$sample_id  =$_GET['sample'];
$tgl        =$_GET['tgl'];
$qry        =mysql_query("select * from qwalys_abd_raw where qwalys_abd_raw.sample_id='$sample_id' and qwalys_abd_raw.runtime='$tgl'");
$data       =mysql_fetch_assoc($qry);
if($data[ket]==""){$konfirmed="0";}else{$konfirmed="1";}
$qry1       =mysql_query("select * from dkonfirmasi where nokantong='$sample_id' and NoKonfirmasi='$data[ket]'");
$data1      =mysql_fetch_assoc($qry1);
$pplate     =$data['microplate'];
$lot_plate=substr($pplate,8,3);
$ed_plate =substr($pplate,4,2).'/20'.substr($pplate,6,2);
$a_date   = "20".substr($pplate,6,2).'-'.substr($pplate,4,2).'-01';
$ed_plate = date("Y-m-t", strtotime($a_date));
switch ($data1[Cocok]){
	case "0" : $cocok="Cocok/Sesuai";break;
	case "1" : $cocok="Tidak Cocok/Tidak Sesuai";break;
	default  : $cocok="";
}
$user		= mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$data1[operator]'"));
$checker	= mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$data1[petugas]'"));
$supervisor	= mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$data1[pengesah]'"));
?>
<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Detail Sample Pemeriksaan ABD Grouping - Qwalys<sup>&reg</sup> 3</div>
<br>
<table>
    <tr>
        <td valign="top" style="background-color: #ffffff">
            <table id="customers">
                <tr><th>Kode Sample/No Kantong</th>     <td style="font-size: 18px;"><b><?=$data['sample_id']?></b></td></tr>
                <? if ($konfirmed=="1"){
                	?><tr><th>No Transaksi</th>         <td><?=$data['ket']?></td></tr><?
                } else {
                	?><tr><th>No Transaksi</th>         <td>Pemeriksaan belum dikonfirmasi</td></tr><?
                }?>
                
                <tr><th>Tanggal Diperiksa</th>          <td><?=$data['runtime']?></td></tr>
                <? if ($konfirmed=="1"){
                	?><tr><th>Tanggal Dikonfirmasi</th> <td><?=$data1['tgl']?></td></tr>
                	  <tr><th>Kode Pendonor</th>        <td><?=$data1['kode_donor']?></td></tr>
	                  <tr><th>Golongan Darah Awal</th>  <td><?=$data1['goldarah_asal'].$data1['rhesus_asal']?></td></tr><?
                } else {
                	?><tr><th>Tanggal Dikonfirmasi</th> <td>Pemeriksaan belum dikonfirmasi</td></tr>
                	  <tr><th>Kode Pendonor</th>        <td>Pemeriksaan belum dikonfirmasi</td></tr>
	                  <tr><th>Golongan Darah Awal</th>  <td>Pemeriksaan belum dikonfirmasi</td></tr><?
                }?>
                <tr><th>Parameter</th>                  <td><?=$data['parameter1']?></td></tr>
                <tr><th>Metode</th>                     <td>Auto Qwalys 3</td></tr>
                <tr><th>Qwalys Software Version</th>    <td><?=$data['version']?></td></tr>
                <? if ($konfirmed=="1"){
                	?>
	                <tr><th>Hasil Konfirmasi Gol Darah</th> <td><b><?=$data1['GolDarah'].$data1['Rhesus']?></b></td></tr>
    	            <tr><th>Keterangan Konfirmasi</th>      <td><?=$cocok?></td></tr>                
    	            <tr><th>Operator Qwalys</th>            <td><?=$data1['operator'].' - '.$user['nama_lengkap']?></td></tr>
    	            <tr><th>Petugas Konfirmasi</th>         <td><?=$data1['petugas'].' - '.$checker['nama_lengkap']?></td></tr>
    	            <tr><th>Petugas Pengesahan</th>         <td><?=$data1['pengesah'].' - '.$supervisor['nama_lengkap']?></td></tr><?
                } else {?>
                	<tr><th>Hasil Konfirmasi Gol Darah</th> <td>Pemeriksaan belum dikonfirmasi</td></tr>
    	            <tr><th>Keterangan Konfirmasi</th>      <td>Pemeriksaan belum dikonfirmasi</td></tr>                
    	            <tr><th>Operator Qwalys</th>            <td>Pemeriksaan belum dikonfirmasi</td></tr>
    	            <tr><th>Petugas Konfirmasi</th>         <td>Pemeriksaan belum dikonfirmasi</td></tr>
    	            <tr><th>Petugas Pengesahan</th>         <td>Pemeriksaan belum dikonfirmasi</td></tr><?
                }?>
            </table>
        </td>
        <td valign="top"  style="background-color: #ffffff">
            <table id="customers">

                <tr>
                	<th rowspan="2">Rincian Hasil</th>
                	<td height="31" colspan="6" style="text-align: center; font-size: 16px;"><?='Microplate : '.$pplate.', BATCH: '.$lot_plate.', ED: '.$ed_plate?></td>
                </tr>
                <tr height="33">
                	<th align="center"><?=$data['AntiA_Name']?></th>
                	<th align="center"><?=$data['AntiB_Name']?></th>
                	<th align="center"><?=$data['AntiD_Name']?></th>
                	<th align="center"><?=$data['AntiRHC_Name']?></th>
                	<th align="center"><?=$data['CellA1_Name']?></th>
                	<th align="center"><?=$data['CellB_Name']?></th>
                </tr>
                <tr>
                	<th>Well/Posisi</th>
                	<td align="center"><?=$data['AntiA_Well']?></td>
                	<td align="center"><?=$data['AntiB_Well']?></td>
                	<td align="center"><?=$data['AntiD_Well']?></td>
                	<td align="center"><?=$data['AntiRHC_Well']?></td>
                	<td align="center"><?=$data['CellA1_Well']?></td>
                	<td align="center"><?=$data['CellB_Well']?></td>
                </tr>
                <tr>
                	<th>Reaksi</th>
                	<td align="center"><?=$data['AntiA_Result']?></td>
                	<td align="center"><?=$data['AntiB_Result']?></td>
                	<td align="center"><?=$data['AntiD_Result']?></td>
                	<td align="center"><?=$data['AntiRHC_Result']?></td>
                	<td align="center"><?=$data['CellA1_Result']?></td>
                	<td align="center"><?=$data['CellB_Result']?></td>
                </tr>
                <tr>
                	<th>Nama Reagan/BHP</th>
                	<td align="center"><?=$data['AntiA_Reag1']?></td>
                	<td align="center"><?=$data['AntiB_Reag1']?></td>
                	<td align="center"><?=$data['AntiD_Reag1']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag1']?></td>
                	<td align="center"><?=$data['CellA1_Reag1']?></td>
                	<td align="center"><?=$data['CellB_Reag1']?></td>
                </tr>
                <tr>	
                	<th style="padding-left: 20px">- Barcode</th>
                	<td align="center"><?=$data['AntiA_Reag1Barcode']?></td>
                	<td align="center"><?=$data['AntiB_Reag1Barcode']?></td>
                	<td align="center"><?=$data['AntiD_Reag1Barcode']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag1Barcode']?></td>
                	<td align="center"><?=$data['CellA1_Reag1Barcode']?></td>
                	<td align="center"><?=$data['CellB_Reag1Barcode']?></td>
                </tr>	
                <tr>
                	<th style="padding-left: 20px">- Batch</th>
                	<td align="center"><?=$data['AntiA_Reag1Batch']?></td>
                	<td align="center"><?=$data['AntiB_Reag1Batch']?></td>
                	<td align="center"><?=$data['AntiD_Reag1Batch']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag1Batch']?></td>
                	<td align="center"><?=$data['CellA1_Reag1Batch']?></td>
                	<td align="center"><?=$data['CellB_Reag1Batch']?></td>
                </tr>
                <tr>	
                	<th style="padding-left: 20px">- ED</th>
                	<td align="center"><?=$data['AntiA_Reag1ED']?></td>
                	<td align="center"><?=$data['AntiB_Reag1ED']?></td>
                	<td align="center"><?=$data['AntiD_Reag1ED']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag1ED']?></td>
                	<td align="center"><?=$data['CellA1_Reag1ED']?></td>
                	<td align="center"><?=$data['CellB_Reag1ED']?></td>
                </tr>
             	<tr>
                	<th>Nama Reagan/BHP</th>
                	<td align="center"><?=$data['AntiA_Reag2']?></td>
                	<td align="center"><?=$data['AntiB_Reag2']?></td>
                	<td align="center"><?=$data['AntiD_Reag2']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag2']?></td>
                	<td align="center"><?=$data['CellA1_Reag2']?></td>
                	<td align="center"><?=$data['CellB_Reag2']?></td>	
                </tr>
                <tr>	
                	<th style="padding-left: 20px">- Barcode</th>
                	<td align="center"><?=$data['AntiA_Reag2Barcode']?></td>
                	<td align="center"><?=$data['AntiB_Reag2Barcode']?></td>
                	<td align="center"><?=$data['AntiD_Reag2Barcode']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag2Barcode']?></td>
                	<td align="center"><?=$data['CellA1_Reag2Barcode']?></td>
                	<td align="center"><?=$data['CellB_Reag2Barcode']?></td>
                </tr>	
                <tr>
                	<th style="padding-left: 20px">- Batch</th>
                	<td align="center"><?=$data['AntiA_Reag2Batch']?></td>
                	<td align="center"><?=$data['AntiB_Reag2Batch']?></td>
                	<td align="center"><?=$data['AntiD_Reag2Batch']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag2Batch']?></td>
                	<td align="center"><?=$data['CellA1_Reag2Batch']?></td>
                	<td align="center"><?=$data['CellB_Reag2Batch']?></td>
                </tr>
                <tr>	
                	<th style="padding-left: 20px">- ED</th>
                	<td align="center"><?=$data['AntiA_Reag2ED']?></td>
                	<td align="center"><?=$data['AntiB_Reag2ED']?></td>
                	<td align="center"><?=$data['AntiD_Reag2ED']?></td>
                	<td align="center"><?=$data['AntiRHC_Reag2ED']?></td>
                	<td align="center"><?=$data['CellA1_Reag2ED']?></td>
                	<td align="center"><?=$data['CellB_Reag2ED']?></td>
                </tr>
                <tr><td colspan="7" style="background-color: #ffffff" align="right"><a href="pmikonfirmasi.php?module=qwalys_srcid"class="swn_button_blue">Kembali Cari Sample</a>
                <a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a></td></tr>
            </table>
        </td>
    </tr>

</table>
