<!DOCTYPE html>
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$title="";
$s1=""; $s2="";$s3="";$s4=""; $s5="";$s6="";
?>
<html>
<head>
    <script type="text/javascript" src="/js/rgbcolor.js"></script> 
    <script type="text/javascript" src="/js/canvg.js"></script>
    <script>
      function getImgData(chartContainer) {
        var chartArea = chartContainer.getElementsByTagName('svg')[0].parentNode;
        var svg = chartArea.innerHTML;
        var doc = chartContainer.ownerDocument;
        var canvas = doc.createElement('canvas');
        canvas.setAttribute('width', chartArea.offsetWidth);
        canvas.setAttribute('height', chartArea.offsetHeight);
        
        
        canvas.setAttribute(
            'style',
            'position: absolute; ' +
            'top: ' + (-chartArea.offsetHeight * 2) + 'px;' +
            'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
        doc.body.appendChild(canvas);
        canvg(canvas, svg);
        var imgData = canvas.toDataURL("image/png");
        canvas.parentNode.removeChild(canvas);
        return imgData;
      }
      
      function saveAsImg(chartContainer) {
        var imgData = getImgData(chartContainer);
        
        // Replacing the mime-type will force the browser to trigger a download
        // rather than displaying the image in the browser window.
        window.location = imgData.replace("image/png", "image/octet-stream");
      }
      
      function toImg(chartContainer, imgContainer) { 
        var doc = chartContainer.ownerDocument;
        var img = doc.createElement('img');
        img.src = getImgData(chartContainer);
        
        while (imgContainer.firstChild) {
          imgContainer.removeChild(imgContainer.firstChild);
        }
        imgContainer.appendChild(img);
      }
    </script>
  
    
    <script type="text/javascript" src="/js/jsapi.js"></script>
    <link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
    <style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $model=$_POST['modelgraph'];
    switch ($model){
        case '1' :
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN PEKERJAAN";
            $query   = mysql_query("SELECT pekerjaan, COUNT( Kode ) AS jml FROM pendonor GROUP BY pekerjaan");
            while($res = mysql_fetch_array($query)){$pekerjaan = $res['pekerjaan'];$jumlah= $res['jml'];$data .= '["'.$pekerjaan.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s1="selected";break;
        case '2':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN DONASI";
            $query   = mysql_query("SELECT CASE WHEN (jumDonor) BETWEEN  1 AND 10 THEN '1-10 Kali' WHEN (jumDonor) BETWEEN  11 AND 25 THEN '11-25 Kali' WHEN (jumDonor) BETWEEN  26 AND 50 THEN '26-50 Kali'
                WHEN (jumDonor) BETWEEN  51 AND 75 THEN '51-75 Kali' WHEN (jumDonor) BETWEEN  76 AND 100 THEN '76-100 Kali' WHEN (jumDonor) > 100 THEN '>100 Kali' END as donasi,
                COUNT(Kode) AS jml FROM pendonor where jumDonor>0 GROUP BY CASE WHEN (jumDonor) BETWEEN  1 AND 10 THEN '1-10 Kali' WHEN (jumDonor) BETWEEN  11 AND 25 THEN '11-25 Kali'
                WHEN (jumDonor) BETWEEN  26 AND 50 THEN '26-50 Kali' WHEN (jumDonor) BETWEEN  51 AND 75 THEN '51-75 Kali'
                WHEN (jumDonor) BETWEEN  76 AND 100 THEN '76-100 Kali' WHEN (jumDonor) > 100 THEN '>100 Kali' END");
            while($res = mysql_fetch_array($query)){$umur = $res['donasi'];$jumlah= $res['jml'];$data .= '["'.$umur.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s2="selected";break;
        case '3':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN RENTANG UMUR";
            $query   = mysql_query("SELECT  CASE WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'Umur 31-40'
                WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'Umur 41-50' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'Umur 51-60'
                WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) > 60 THEN 'Umur > 60' else 'Umur 17-30' END AS Umur, COUNT(Kode) AS jml FROM pendonor
                GROUP BY CASE WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'Umur 31-40' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'Umur 41-50'
                WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'Umur 51-60' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) > 60 THEN 'Umur > 60' else 'Umur 17-30' END");
            while($res = mysql_fetch_array($query)){$umur = $res['Umur'];$jumlah= $res['jml'];$data .= '["'.$umur.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s3="selected";
            break;
        case '4' :
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN GOLONGAN DARAH ABO";
            $query   = mysql_query("SELECT GolDarah, COUNT( Kode ) AS jml FROM pendonor where GolDarah<>'X' GROUP BY GolDarah");
            while($res = mysql_fetch_array($query)){$golongan = $res['GolDarah'];$jumlah= $res['jml'];$data .= '["'.$golongan.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s4="selected";break;
        case '5' :
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN GOLONGAN DARAH Rhesus";
            $query   = mysql_query("SELECT case when Rhesus='-' then 'Rhesus Negatif(-)' else 'Rhesus Positif(+)' end as Rh , COUNT( Kode ) AS jml FROM pendonor GROUP BY case when Rhesus='-' then 'Rh Negatif' else 'Rhesus Negatif' end ");
            while($res = mysql_fetch_array($query)){$golongan = $res['Rh'];$jumlah= $res['jml'];$data .= '["'.$golongan.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s5="selected";break;
        case '6' :
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN JENIS KELAMIN";
            $query   = mysql_query("SELECT case when Jk='0' then 'Laki-laki' else 'Perempuan' end as kel, COUNT( Kode ) AS jml FROM pendonor GROUP BY case when Jk='0' then 'Laki-laki' else 'Perempuan' end");
            while($res = mysql_fetch_array($query)){$kelamin = $res['kel'];$jumlah= $res['jml'];$data .= '["'.$kelamin.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s6="selected";break; 
    } 
    ?>
        <script type="text/javascript">
          google.load('visualization', '1.0', {'packages':['corechart']});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows([<?php echo $data; ?>]);
            var options = {'title':'','width':600,'height':300,is3D: false,left:0,titleTextStyle:{fontSize: 14, bold: true, italic: false },
                           legendtextStyle:{fontSize: 8, bold: false, italic: false },chartArea:{left:10,top:10,width:"90%",height:"90%"},pieStartAngle: 0};
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
          };
          google.load('visualization', '1', {packages:['table']});
          google.setOnLoadCallback(drawTable);
          function drawTable() {
            var data = new google.visualization.DataTable();
                data.addColumn('string', 'Keterangan');
                data.addColumn('number', 'Jumlah');
                data.addRows([<?php echo $data; ?>]);
            var options = {'title':''};
            var table = new google.visualization.Table(document.getElementById('table_div'));
            var formatter = new google.visualization.NumberFormat({prefix: '', negativeColor: 'red', negativeParens: true,fractionDigits:0,groupingSymbol:'.'});
                formatter.format(data, 1); // Apply formatter to second column
                table.draw(data, {allowHtml: true, showRowNumber: true});
          };
        </script>
<?}?>
    <font size="4" color="red" font-family="Arial">STATISTIK PENDONOR</font><br>
    <form name="filter" method="POST" action="<?echo $PHPSELF?>">
    <table class="form" cellspacing="0" cellpadding="0">
		<tr><td>Pilih jenis statistik : </td>
			<td class="styled-select">
				<select name="modelgraph">
					<option value="1" <?=$s1?>>Berdasarkan Pekerjaan</option>
					<option value="2" <?=$s2?>>Berdasarkan Donasi</option>
                    <option value="3" <?=$s3?>>Berdasarkan Rentang Umur</option>
                    <option value="4" <?=$s4?>>Berdasarkan Golongan Darah ABO</option>
                    <option value="5" <?=$s5?>>Berdasarkan Golongan Darah Rhesus</option>
                    <option value="6" <?=$s6?>>Berdasarkan Jenis Kelamin</option>
					</select>
			<td><input type=submit name=submit value="Tampilkan" class="swn_button_blue">
            <input type="button" class="swn_button_blue" onclick="saveAsImg(document.getElementById('chart_div'));" value="Simpan"></td></tr>
	</table>
    </form>
    <table>
        <tr><td><font size="4" color="red" font-family="Arial"><?=$title?></font></td></tr>
        <tr>
            <td valign="Top"><div id="chart_div"></></td>
            <td valign=top><div id="table_div"></div></td>
        </tr>
    </table>
  </body>
</html>