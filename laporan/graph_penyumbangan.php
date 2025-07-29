<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$title="";
$s1=""; $s2="";$s3="";$s1=""; $s4="";$s5="";$s6=""; $s7="";$s8="";
$level_user=$_SESSION['leveluser'];
$tgll=date("Ymd");
$awalbulan=date("Y-01-01");
$hariini = date("Y-m-d");
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
if (isset($_POST['submit'])) {
    $tglawal=$_POST['tgl1'];
    $tglakhir=$_POST['tgl2'];
    $model=$_POST['modelgraph'];
    $t1 = date("d M Y", strtotime($tglawal));
    $t2 = date("d M Y", strtotime($tglakhir));
    $title2 =' (Dari tgl : '.$t1.' - '.$t2.')';
    switch ($model){
        case '1' :
            $title  = "GRAFIK PIE PENYUMBANGAN DARAH BERDASARKAN JENIS DONOR";
            $query   = mysql_query("select case when htransaksi.JenisDonor='0' THEN 'Donor Sukarela' else 'Donor Pengganti' end as keterangan,
                        count(htransaksi.KodePendonor) as jml from htransaksi where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') group by case when htransaksi.JenisDonor='0' THEN 'Donor Sukarela' else 'Donor Pengganti' end");
            while($res = mysql_fetch_array($query)){
                $jenisdonor = $res['keterangan'];
                $jumlah= $res['jml'];
                $data .= '["'.$jenisdonor.'",'.$jumlah.'],';
            }
            $data = substr($data,0,(strlen($data)-1));$s1="selected";break;
        case '2':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN LOKASI PENYUMBANGAN";
            $query   = mysql_query("select case when left(htransaksi.NoTrans,1)='D' THEN 'Di UDD' else 'Mobile Unit' END as keterangan,
                        count(htransaksi.KodePendonor) as jml from htransaksi where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') group by case when left(htransaksi.NoTrans,1)='D' THEN 'Di UDD' else 'Mobile Unit' END");
            while($res = mysql_fetch_array($query)){$lokasi = $res['keterangan'];$jumlah= $res['jml'];$data .= '["'.$lokasi.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s2="selected";break;
        case '3':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN GOLONGAN DARAH ABO";
            $query   = mysql_query("select pendonor.GolDarah as keterangan, count(htransaksi.KodePendonor) as jml
                        from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
                        where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') and pendonor.GolDarah<>'X' group by pendonor.GolDarah");
            while($res = mysql_fetch_array($query)){$lokasi = $res['keterangan'];$jumlah= $res['jml'];$data .= '["'.$lokasi.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s3="selected";break;
        case '4':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN GOLONGAN DARAH RHESUS";
            $query   = mysql_query("select case when pendonor.Rhesus='+' Then 'Rhesus Positif(+)' Else 'Rhesus Negatif(-)' End as keterangan, count(htransaksi.KodePendonor) as jml
                        from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
                        where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') group by pendonor.Rhesus");
            while($res = mysql_fetch_array($query)){$lokasi = $res['keterangan'];$jumlah= $res['jml'];$data .= '["'.$lokasi.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s4="selected";break;
        case '5':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN JENIS KELAMIN";
            $query   = mysql_query("select case when pendonor.Jk='0' then 'Laki-laki' else 'Perempuan' end as keterangan, count(htransaksi.KodePendonor) as jml
                        from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
                        where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') group by case when pendonor.Jk='0' then 'Laki-laki' else 'Perempuan' end");
            while($res = mysql_fetch_array($query)){$lokasi = $res['keterangan'];$jumlah= $res['jml'];$data .= '["'.$lokasi.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s5="selected";break;
        case '6':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN PEKERJAAN";
            $query   = mysql_query("select pendonor.pekerjaan as keterangan, count(htransaksi.KodePendonor) as jml
                        from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor
                        where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') group by pendonor.pekerjaan");
            while($res = mysql_fetch_array($query)){$lokasi = $res['keterangan'];$jumlah= $res['jml'];$data .= '["'.$lokasi.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s6="selected";break;
         case '7':
            $title  = "GRAFIK PIE PENDONOR BERDASARKAN DONOR LAMA/BARU";
            $query   = mysql_query("select case when pendonor.jumDonor<3 then 'Donor Lama' else 'Donor Baru' End as keterangan, count(htransaksi.KodePendonor) as jml
                        from htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor where (date(htransaksi.Tgl)>='$tglawal' and date(htransaksi.Tgl)<='$tglakhir') and 
                        (htransaksi.Pengambilan ='0' or htransaksi.Pengambilan ='2') group by case when pendonor.jumDonor<3 then 'Donor Lama' else 'Donor Baru' End");
            while($res = mysql_fetch_array($query)){$lokasi = $res['keterangan'];$jumlah= $res['jml'];$data .= '["'.$lokasi.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s7="selected";break;} 
    ?>
        <script type="text/javascript">
          google.load('visualization', '1.0', {'packages':['corechart']});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows([<?php echo $data; ?>]); 
            var options = {'title':'',
                           width:600,height:300,
                           is3D: false,left:0,
                           titleTextStyle:{fontSize: 14, bold: true, italic: false },
                           legendtextStyle:{fontSize: 8, bold: false, italic: false },
                           chartArea:{left:10,top:10,width:"90%",height:"90%"},
                           pieSliceTextStyle :{fontSize: 10},
                           legend:{position:'right'},
                           tooltip:{textStyle: {color: '#FF0000'}, showColorCode: true},
                           pieStartAngle: 0};
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);};
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
                formatter.format(data, 1); 
                table.draw(data, {allowHtml: true, showRowNumber: true});};
        </script>
<?}?>
    <font size="4" color="red" font-family="Arial">STATISTIK PENYUMBANGAN DARAH</font><br>
    <form name="filter" method="POST" action="<?echo $PHPSELF?>">
    <table class="form" cellspacing="0" cellpadding="0">
		<tr><td>Pilih jenis</td>
			<td class="styled-select">
				<select name="modelgraph">
					<option value="1" <?=$s1?>>Donor Sukarela/Pengganti</option>
                    <option value="2" <?=$s2?>>Lokasi penyumbangan</option>
                    <option value="3" <?=$s3?>>Golongan Darah ABO</option>
                    <option value="4" <?=$s4?>>Golongan Darah Rhesus</option>
                    <option value="5" <?=$s5?>>Jenis Kelamin</option>
                    <option value="6" <?=$s6?>>Pekerjaan</option>
                    <option value="7" <?=$s7?>>Donor Lama/Baru</option>
					</select>
            <td>Dari tanggal: </td>
			<td class="input">
				<input class=text name="tgl1" id="datepicker" value="<?=$awalbulan?>" type=date size=10> sampai
				<input class=text name="tgl2" id="datepicker1" value="<?=$hariini?>" type=date size=10>
			</td>
			<td><input type=submit name=submit value="Tampilkan" class="swn_button_blue">
            <input type="button" class="swn_button_blue" onclick="saveAsImg(document.getElementById('chart_div'));" value="Simpan"></td></tr>
	</table>
    </form>
    <table>
        <tr><td colspan=2><font size="4" font-family="Trebhuces"><?=$title?> <?=$title2?></font></td></tr>
        <tr><td></td></tr>
        <tr>
            <td valign="Top"><div id="chart_div"></div></td>
            <td valign="Top"><div id="table_div"></div></td>
            </td>
        </tr>
    </table>
  </body>
</html>
