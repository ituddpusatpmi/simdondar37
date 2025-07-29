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
            $title  = "GRAFIK PIE KARYAWAN BERDASARKAN IJASAH";
            $query   = mysql_query("SELECT ijasah, COUNT( Kode ) AS jml FROM pegawai GROUP BY ijasah");
            while($res = mysql_fetch_array($query)){$pekerjaan = $res['ijasah'];$jumlah= $res['jml'];$data .= '["'.$pekerjaan.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s1="selected";break;
        case '2':
            $title  = "GRAFIK PIE KARYAWAN  BERDASARKAN MASA KERJA";
            $query   = mysql_query("SELECT CASE WHEN (masakerja) BETWEEN  1 AND 9.9 THEN '1 - 9 tahun' WHEN (masakerja) BETWEEN  10 AND 19.0 THEN '10 - 19 tahun' WHEN (masakerja) BETWEEN  20 AND 29.9 THEN '20 - 29 tahun'
                WHEN (masakerja) BETWEEN  30 AND 75 THEN '> 30 tahun'  END as masakerja,
                COUNT(Kode) AS jml FROM pegawai where masakerja>0 GROUP BY CASE WHEN (masakerja) BETWEEN  1 AND 9.9 THEN '1-9 tahun' WHEN (masakerja) BETWEEN  10 AND 19.9 THEN '10-19 tahun' WHEN (masakerja) BETWEEN  20 AND 29.9 THEN '20-29 tahun'
                WHEN (masakerja) BETWEEN  30 AND 75 THEN '> 30 tahun'  END");
            while($res = mysql_fetch_array($query)){$umur = $res['masakerja'];$jumlah= $res['jml'];$data .= '["'.$umur.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s2="selected";break;
        case '3':
            $title  = "GRAFIK PIE KARYAWAN BERDASARKAN RENTANG UMUR";
            $query   = mysql_query("SELECT  CASE WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'Umur 31-40'
                WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'Umur 41-50' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'Umur 51-60'
                WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) > 60 THEN 'Umur > 60' else 'Umur 17-30' END AS Umur, COUNT(Kode) AS jml FROM pegawai
                GROUP BY CASE WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'Umur 31-40' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'Umur 41-50'
                WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'Umur 51-60' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25) > 60 THEN 'Umur > 60' else 'Umur 17-30' END");
            while($res = mysql_fetch_array($query)){$umur = $res['Umur'];$jumlah= $res['jml'];$data .= '["'.$umur.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s3="selected";
            break;
        case '4' :

 							/* <option value="0" <?=$A3?> >Paruh Waktu</option>
							  <option value="1" <?=$B3?> >Kontrak</option>
							  <option value="7" <?=$H3?> >Tetap 80%</option>
							  <option value="2" <?=$C3?> >Tetap 100%</option>
							  <option value="3" <?=$D3?> >PNS Diperbantukan</option>
							  <option value="4" <?=$E3?> >resign</option>
							  <option value="5" <?=$F3?> >Pindah UDD</option>
							  <option value="6" <?=$G3?> >Meninggal</option>
							  <option value="8" <?=$I3?> >Purnatugas</option>
							  <option value="9" <?=$J3?> >Pensiun</option>*/


           $title  = "GRAFIK PIE KARYAWAN BERDASARKAN STATUS PEGAWAI";
            $query   = mysql_query("SELECT case 
			when statuspeg='0' then 'Paruhwaktu'       when statuspeg='1' then 'kontrak'      when statuspeg='2' then 'Tetap 100%' 
			when statuspeg='3' then 'PNS Dipikerjakan' when statuspeg='4' then 'Resign'       when statuspeg='5' then 'Pindah UDD' when statuspeg='6' then 'Meninggal'
			when statuspeg='7' then 'Capeg 80%'        when statuspeg='8' then 'Purna Tugas'  else 'Pensiun' 
			 end as kel, COUNT( Kode ) AS jml FROM pegawai GROUP BY CASE when statuspeg='0' then 'Paruhwaktu' when statuspeg='1' then 'kontrak' when statuspeg='2' then 'Tetap 100%' 
			when statuspeg='3' then 'PNS Dipikerjakan' when statuspeg='4' then 'Resign' when statuspeg='5' then 'Pindah UDD' when statuspeg='6' then 'Meninggal'
			when statuspeg='7' then 'Capeg 80%' when statuspeg='8' then 'Purna Tugas' else 'Pensiun' 
			 end");
            while($kel = mysql_fetch_array($query)){$kelompok = $kel['kel'];$jumlah= $kel['jml'];$data .= '["'.$kelompok.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s4="selected";break; 
        case '5' :
            $title  = "GRAFIK PIE KARYAWAN BERDASARKAN GOLONGAN";
            $query   = mysql_query("SELECT golongan, COUNT( Kode ) AS jml FROM pegawai GROUP BY golongan");
            while($res = mysql_fetch_array($query)){$pekerjaan = $res['golongan'];$jumlah= $res['jml'];$data .= '["'.$pekerjaan.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s5="selected";break;
        case '6' :
            $title  = "GRAFIK PIE KARYAWAN BERDASARKAN JENIS KELAMIN";
            $query   = mysql_query("SELECT case when Jk='0' then 'Laki-laki' else 'Perempuan' end as kel, COUNT( Kode ) AS jml FROM pegawai GROUP BY case when Jk='0' then 'Laki-laki' else 'Perempuan' end");
            while($res = mysql_fetch_array($query)){$kelamin = $res['kel'];$jumlah= $res['jml'];$data .= '["'.$kelamin.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s6="selected";break; 
	 case '7' :
             $title  = "GRAFIK PIE KARYAWAN BERDASARKAN KELOMPOK BAGIAN";
            $query   = mysql_query("SELECT case when kelompok='0' then 'Non Teknis' when kelompok='1' then 'Teknis' when kelompok='2' then 'Managerial' end as kel, COUNT( Kode ) AS jml FROM pegawai GROUP BY case when kelompok='0' then 'Non Teknis' when kelompok='1' then 'Teknis' when kelompok='2' then 'Managerial' end");
            while($kel = mysql_fetch_array($query)){$kelompok = $kel['kel'];$jumlah= $kel['jml'];$data .= '["'.$kelompok.'",'.$jumlah.'],';}
            $data = substr($data,0,(strlen($data)-1));$s7="selected";break; 
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
    <font size="4" color="red" font-family="Arial">STATISTIK KARYAWAN</font><br>
    <form name="filter" method="POST" action="<?echo $PHPSELF?>">
    <table class="form" cellspacing="0" cellpadding="0">
		<tr><td>Pilih jenis statistik : </td>
			<td class="styled-select">
				<select name="modelgraph">
					<option value="1" <?=$s1?>>Berdasarkan Ijasah</option>
					<option value="2" <?=$s2?>>Berdasarkan Masa Kerja</option>
                    <option value="3" <?=$s3?>>Berdasarkan Rentang Umur</option>
                    <option value="4" <?=$s4?>>Berdasarkan Status Karyawan</option>
                    <option value="5" <?=$s5?>>Berdasarkan Golongan/Pangkat</option>
                    <option value="6" <?=$s6?>>Berdasarkan Jenis Kelamin</option>
			<option value="7" <?=$s6?>>Berdasarkan Kelompok Bagian</option>
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
