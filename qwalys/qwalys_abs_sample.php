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
$qry        =mysql_query("select * from qwalys_abs_raw where qwalys_abs_raw.sample_id='$sample_id' and qwalys_abs_raw.runtime='$tgl'");
$data       =mysql_fetch_assoc($qry);
if($data[ket]==""){$konfirmed="0";}else{$konfirmed="1";}
$qry1       =mysql_query("select * from abs where abs_sample_id='$sample_id' and abs_notrans='$data[ket]'");
$data1      =mysql_fetch_assoc($qry1);
$pplate     =$data['microplate'];
$lot_plate  =substr($pplate,8,3);
$ed_plate   =substr($pplate,4,2).'/20'.substr($pplate,6,2);
$a_date     = "20".substr($pplate,6,2).'-'.substr($pplate,4,2).'-01';
$ed_plate   = date("Y-m-t", strtotime($a_date));
$user		= mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$data1[abs_user]'"));
$checker	= mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$data1[abs_checker]'"));
$supervisor	= mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$data1[abs_supervisor]'"));
$status_ktg=$data1['abs_kantong_status'];
			switch ($status_ktg){
				case '0' : $statuskantong_old='Kosong';break;
				case '1' : $statuskantong_old='Karantina';break;
				case '2' : $statuskantong_old='Sehat';break;
				case '3' : $statuskantong_old='Keluar';break;
				case '4' : $statuskantong_old='Rusak';break;
				case '5' : $statuskantong_old='Rusak-Gagal';break;
				case '6' : $statuskantong_old='Dimusnahkan';break;
				default  : $statuskantong_old='Tidak ada';
			}

?>
<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Detail Sample Pemeriksaan Antibody Screening - Qwalys<sup>&reg</sup> 3</div>
<br>
<table>
    <tr>
        <td valign="top" style="background-color: #ffffff">
            <table id="customers">
                <tr><th>Parameter</th>                  <td><?=$data['parameter2']?></td></tr>
                <tr><th>Metode</th>                     <td>Auto Qwalys 3</td></tr>
                <tr><th>Qwalys Software Version</th>    <td><?=$data['version']?></td></tr>
                <tr><th>Well/posisi</th>                <td><?=$data['wellplate']?></td></tr>
                <tr><th>Microplate</th>                 <td><?=$data['microplate']?></td></tr>
                <tr><th>Microplate batch & ED</th>      <td>Batch:<?=$lot_plate.', ED:'.$ed_plate?></td></tr>
                <tr><th>NanoLys</th>                    <td><?=$data['nl_barcode']?></td></tr>
                <tr><th>NanoLys batch & ED</th>         <td>Batch:<?=$data['nl_batch'].', ED:'.$data['nl_ed']?></td></tr>
                <tr><th>ScreenDiluent</th>              <td><?=$data['sd_barcode']?></td></tr>
                <tr><th>ScreenDiluent batch & ED</th>   <td>Batch:<?=$data['sd_batch'].', ED:'.$data['sd_ed']?></td></tr>
                <tr><th>HemaScreen Pool</th>            <td><?=$data['hsp_barcode']?></td></tr>
                <tr><th>HemaScreen Pool batch & ED</th> <td>Batch:<?=$data['hsp_batch'].', ED:'.$data['hsp_ed']?></td></tr>

            </table>
        </td>
        <td valign="top"  style="background-color: #ffffff">
            <table id="customers">
                <tr><th>Kode Sample/No Kantong</th>     <td style="font-size: 18px;"><b><?=$data['sample_id']?></b></td></tr>
                <tr><th>Tanggal Diperiksa</th>          <td><?=$data['runtime']?></td></tr>
                <? if ($konfirmed=="1"){?>
                	<tr><th>No Transaksi</th>               <td><?=$data['ket']?></td></tr>
	                <tr><th>Tanggal Dikonfirmasi</th>         <td><?=$data1['on_insert']?></td></tr>
    	            <tr><th>Status Kantong saat konfirmasi</th><td><?=$statuskantong_old?></td></tr>
    	            <tr><th>Kode Pendonor</th>              <td><?=$data1['abs_id_donor']?></td></tr>
    	            <tr><th>Hasil</th>                      <td style="font-size: 18px;"><b><?=$data['result_inter']?></b></td></tr>
    	            <tr><th>Status Hasil</th>               <td><?=$data['result_status']?></td></tr>
    	            <tr><th>Operator Qwalys</th>            <td><?=$data1['abs_user'].' - '.$user['nama_lengkap']?></td></tr>
    	            <tr><th>Petugas Konfirmasi</th>         <td><?=$data1['abs_checker'].' - '.$checker['nama_lengkap']?></td></tr>
    	            <tr><th>Petugas Pengesahan</th>         <td><?=$data1['abs_supervisor'].' - '.$supervisor['nama_lengkap']?></td></tr>
    	        <?} else {?>
    	        	<tr><th>No Transaksi</th>               <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	        	<tr><th>Tanggal Dikonfirmasi</th>       <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Status Kantong saat konfirmasi</th><td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Kode Pendonor</th>              <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Hasil</th>                      <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Status Hasil</th>               <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Operator Qwalys</th>            <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Petugas Konfirmasi</th>         <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	            <tr><th>Petugas Pengesahan</th>         <td>Pemeriksaan belum dikonfirmasi di SIMDONDAR</td></tr>
    	        <?}?>
                <tr><td colspan="2" style="background-color: #ffffff"><a href="pmikonfirmasi.php?module=qwalys_srcid"class="swn_button_blue">Kembali Cari Sample</a>
                	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a></td>
                </tr>
            </table>
        </td>
    </tr>

</table>
