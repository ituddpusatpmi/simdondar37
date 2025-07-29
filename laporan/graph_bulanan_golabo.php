<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$tahun=$_GET['tahun'];
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
    <link type="text/css" href="/css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
    <link type="text/css" href="/css/style.css" rel="stylesheet" />
    <link type="text/css" href="/css/blitzer/suwena.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="/js/jsapi.js"></script>
    <style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
</head>
<body>
<?php
$title  = "GRAFIK PENYUMBANGAN DARAH BERDASARKAN GOLONGAN DARAH ABO TAHUN ".$tahun;
$query  = mysql_query("SELECT ELT(MONTH(htransaksi.Tgl), 'Januari','Februari','Maret', 'April','Mei','Juni', 'Juli', 'Agustus', 'September','Oktober','November','Desember') As Bulan,
count(case when pendonor.GolDarah='A' then 1 END) As 'Gol A',
count(case when pendonor.GolDarah='B' then 1 END) As 'Gol B',
count(case when pendonor.GolDarah='O' then 1 END) As 'Gol O',
count(case when pendonor.GolDarah='AB' then 1 END) As 'Gol AB'
from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
where year(htransaksi.Tgl)='$tahun' and (htransaksi.Pengambilan='0' or htransaksi.Pengambilan='2') group by month(htransaksi.Tgl)");
while($res = mysql_fetch_array($query)){
    $bulan = $res['Bulan'];
    $da= $res['Gol A'];
    $db= $res['Gol B'];
    $do= $res['Gol O'];
    $dab= $res['Gol AB'];
    $data .= '["'.$bulan.'",'.$da.','.$db.','.$do.','.$dab.'],';
}
$data = substr($data,0,(strlen($data)-1));
?>
<script type="text/javascript">
    google.load('visualization', '1.0', {packages:['columnchart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([['Bulan', 'Gol A','Gol B','Gol O','Gol AB'],<?php echo $data;?>]);
        var options = {'title':'',
                           width:750,height:300,
                           left:0,
                           is3D: true,
                           legend:'bottom',
                           titleY:'Jumlah Donor',
                           titleX:'Bulan'
                           };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
    };
    google.load('visualization', '1', {packages:['table']});
    google.setOnLoadCallback(drawTable);
    function drawTable() {
        var data = new google.visualization.DataTable();
                data.addColumn('string', 'Bulan');
                data.addColumn('number', 'Gol A');
                data.addColumn('number', 'Gol B');
                data.addColumn('number', 'Gol O');
                data.addColumn('number', 'Gol AB');
                data.addRows([<?php echo $data; ?>]);
        var options = {'title':''};
        var table = new google.visualization.Table(document.getElementById('table_div'));
        var formatter = new google.visualization.NumberFormat({prefix: '', negativeColor: 'red', negativeParens: true,fractionDigits:0,groupingSymbol:'.'});
                formatter.format(data, 1);
                formatter.format(data, 2);
                formatter.format(data, 3);
                formatter.format(data, 4);
                table.draw(data, {allowHtml: true, showRowNumber: true});
    };
</script>
    <table>
        <tr><td colspan=2 align="center"><font size="5" color="red" font-family="Trebhuces"><?=$title?><br></font></td></tr>
        <tr>
            <td valign="Top"><div id="chart_div"></div></td>
            <td valign="Top"><div id="table_div"></div></td>
            </td>
        </tr>
    </table>
  </body>
</html>