<?php
require_once('clogin.php');
$s1=""; $s2="";$s3="";$s1=""; $s4="";$s5="";$s6=""; $s7="";$s8="";
$level_user=$_SESSION['leveluser'];
$tahunini=date("Y");
?>
<html>
<head>
    <link type="text/css" href="/css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
    <link type="text/css" href="/css/style.css" rel="stylesheet" />
    <link type="text/css" href="/css/blitzer/suwena.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $tahun=$_POST['tgl1'];
    $model=$_POST['modelgraph'];
    switch ($model){
        case '1':$namagraph="graphtrendbulanan_dsdp";$s1="selected";break;
        case '2':$namagraph="graphtrendbulanan_lokasi";$s2="selected";break;
        case '3':$namagraph="graphtrendbulanan_golabo";$s3="selected";break;
        case '4':$namagraph="graphtrendbulanan_rh";$s4="selected";break;
        case '5':$namagraph="graphtrendbulanan_kel";$s5="selected";break;
        case '6':$namagraph="graphtrendbulanan_lamabaru";$s7="selected";break;
    } 
    header('location:pmi'.$level_user.'.php?module='.$namagraph.'&tahun='.$tahun);
}?>
    <font size="4" color="red" font-family="Arial">STATISTIK BULANAN</font><br>
    <form name="filter" method="POST" action="<?echo $PHPSELF?>">
    <table class="form" cellspacing="0" cellpadding="0">
		<tr><td>Pilih jenis statistik :</td>
			<td class="styled-select">
				<select name="modelgraph">
					<option value="1" <?=$s1?>>Donor Sukarela/Pengganti</option>
                    <option value="2" <?=$s2?>>Lokasi penyumbangan</option>
                    <option value="3" <?=$s3?>>Golongan Darah ABO</option>
                    <option value="4" <?=$s4?>>Golongan Darah Rhesus</option>
                    <option value="5" <?=$s5?>>Jenis Kelamin</option>
                    <option value="6" <?=$s7?>>Donor Lama/Baru</option>
					</select>
            <td>Tahun: </td>
			<td class="input">
				<input class=text name="tgl1" value="<?=$tahunini?>" type=text size=4>
			</td>   
			<td><input type=submit name=submit value="Tampilkan" class="swn_button_blue"></td></tr>
	</table>
    </form>
  </body>
</html>