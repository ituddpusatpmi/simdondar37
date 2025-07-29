<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
    <script type="text/javascript" src="js/jsapi.js"></script>
    <link type="text/css" href="/css/blitzer/suwena.css" rel="stylesheet" />
</head>
<body>
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$tahun=$_GET['tahun'];
$title  = "GRAFIK PENYUMBANGAN DARAH BERDASARKAN GOLONGAN DARAH RHESUS TAHUN ".$tahun;
$query  = mysql_query("SELECT ELT(MONTH(htransaksi.Tgl), 'Januari','Februari','Maret', 'April','Mei','Juni', 'Juli', 'Agustus', 'September','Oktober','November','Desember') As Bulan,
            COUNT(case when pendonor.Rhesus='+' THEN 1 END) As 'Rhesus Positif', COUNT(case when pendonor.Rhesus='-' THEN 1 END) As 'Rhesus Negatif'
            from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor where year(htransaksi.Tgl)='$tahun' and (htransaksi.Pengambilan='0' or htransaksi.Pengambilan='2') group by month(htransaksi.Tgl)");
while($res = mysql_fetch_array($query)){
    $bulan = $res['Bulan'];
    $ds= $res['Rhesus Positif'];
    $dp= $res['Rhesus Negatif'];
    $data .= '["'.$bulan.'",'.$ds.','.$dp.'],';
}
$data = substr($data,0,(strlen($data)-1));
?>
<script type="text/javascript">
    google.load('visualization', '1', {packages:['ColumnChart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([['Bulan', 'Rhesus Positif','Rhesus Negatif'],<?php echo $data;?>]);
        var options = {'title':'',width:'100%',height:300,left:0,is3D: true,legend:'bottom',titleY:'Jumlah Donor',titleX:'Bulan'};
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);};
    
    google.load('visualization', '1', {packages:['table']});
    google.setOnLoadCallback(drawTable);
    function drawTable() {
        var data = new google.visualization.DataTable();
            data.addColumn('string', 'Bulan');
            data.addColumn('number', 'Rhesus Positif');
            data.addColumn('number', 'Rhesus Negatif');
            data.addRows([<?php echo $data; ?>]);
        var options = {'title':''};
        var table = new google.visualization.Table(document.getElementById('table_div'));
        var formatter = new google.visualization.NumberFormat({prefix: '', negativeColor: 'red', negativeParens: true,fractionDigits:0,groupingSymbol:'.'});
            formatter.format(data, 1);
            formatter.format(data, 2);
            table.draw(data, {allowHtml: true, showRowNumber: true});};
</script>

    <table width="100%">
        <tr><td colspan=2 align="center"><font size="4" color="red" font-family="Trebhuces"><?=$title?><br></font></td></tr>
        <tr>
            <td valign="Top" width="75%"><div id="chart_div"></div></td>
            <td valign="Top"><div id="table_div"></div></td>
            </td>
        </tr>
    </table>
  </body>
</html>