<!DOCTYPE html>
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />

<html>
<STYLE>
    tr { background-color: #ffffff;}
    .initial { background-color: #ffffff; color:#000000 }
    .normal { background-color: #ffffff; }
    .highlight { background-color: #7CFC00 }
</style>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<style>
    table, th, td {
        font-size : 14px;
    }
</style>
<style>body {font-family: "Lato", sans-serif;}</style>
<?
include('config/db_connect.php');
$today=date('Y-m-d');


if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];

$sql_inst="SELECT `Instansi` , count( `NoTrans` ) AS jumlah FROM `htransaksi` WHERE date( `Tgl` ) = '$today1' GROUP BY `Instansi`";
?>
<font size="5" color=red font-family="Arial">LAPORAN AFTAP dan MOBILE UNIT</font><br>
	<form namme=rekap method=post>
	<table cellspacing="3" cellpadding="3" style="border-collapse: collapse;" border="1">
		<tr>
			<td>Tanggal Kegiatan</td><td><input type=text name=minta1 id=datepicker size=10 value=<?=$today?>></td>
			<td><input type=submit name=submit2 value=Ok class="swn_button_blue"></td>
		</tr>
		<tr>
			<td>Jam Berangkat</td><td><input type=text name=jamberangkat id=jamberangkat size=10 value=<?=$jamberangkat?>></td>
		</tr>
		<tr>
			<td>Jam Kedatangan</td><td><input type=text name=jamselesai id=jamselesai size=10 value=<?=$jamselesai?>></td>
		</tr>
		<tr>	
			<td>Instansi</td>
			<td  class="styled-select"><select name='instansi'>
				<?
				$sq_i=mysql_query($sql_inst);
				$rec=mysql_num_rows($sq_i);
				while($data=mysql_fetch_assoc($sq_i)){
                    if ($data[Instansi]==$instansi){
                        ?><option value="<?=$data['Instansi']?>" selected><?=$data['Instansi']?></option><?
                    } else {
                        ?><option value="<?=$data['Instansi']?>"><?=$data['Instansi']?></option><?
                    }
				}
				?>
			</select></td>
			<td><input type=submit name=submit value=Tampilkan class="swn_button_blue"></td>
		</tr>
	</table>
	</form>
<?php
if (isset($_POST['submit'])) {
	$instansi=$_POST['instansi'];
	$jam1=$_POST['jamberangkat'];
	$jam2=$_POST['jamselesai'];
	$URL="pmimobile.php?module=rekap_mu1&tgl=$today1&instansi=$instansi&jam1=$jam1&jam2=$jam2";
        header("Location: $URL");
}
?>

