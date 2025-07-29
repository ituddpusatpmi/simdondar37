<?php
$sq_raw=mysql_query("CREATE TABLE IF NOT EXISTS imltd_arc_raw (  id int(11) NOT NULL AUTO_INCREMENT,
  instr varchar(15) NOT NULL,  instr_v varchar(5) NOT NULL,  scc_serial varchar(15) NOT NULL,  interface_sn varchar(15) NOT NULL,
  trans_time datetime NOT NULL,  id_tes varchar(50) NOT NULL,  carrier varchar(4) NOT NULL,  position varchar(2) NOT NULL,
  parameter varchar(15) NOT NULL,  lot_reag varchar(15) NOT NULL,  sn_reag varchar(10) NOT NULL,  abs varchar(10) NOT NULL,
  unit varchar(10) NOT NULL,  `range` varchar(25) NOT NULL,  flags varchar(20) NOT NULL,  `user` varchar(10) NOT NULL,
  run_time datetime NOT NULL,  arc_serial varchar(10) NOT NULL,  hasil varchar(20) NOT NULL,  date_insert timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status_konfirm char(1) NOT NULL DEFAULT '0',  keterangan varchar(25) NOT NULL,  first_name varchar(25) NOT NULL,  last_name varchar(25) NOT NULL,  PRIMARY KEY (id),  UNIQUE KEY id_tes (id_tes,parameter,run_time,arc_serial,carrier,position)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
$sq_qc=mysql_query("CREATE TABLE IF NOT EXISTS imltd_arc_qc (  id int(11) NOT NULL AUTO_INCREMENT,  instr varchar(15) NOT NULL,
  instr_v varchar(5) NOT NULL,  scc_serial varchar(15) NOT NULL,  interface_sn varchar(15) NOT NULL,  trans_time datetime NOT NULL,
  id_tes varchar(50) NOT NULL,  carrier varchar(4) NOT NULL,  position varchar(2) NOT NULL,  parameter varchar(15) NOT NULL,
  lot_reag varchar(15) NOT NULL,  sn_reag varchar(10) NOT NULL,  abs varchar(10) NOT NULL,  unit varchar(10) NOT NULL,
  `range` varchar(25) NOT NULL,  flags varchar(20) NOT NULL,  `user` varchar(10) NOT NULL,  run_time datetime NOT NULL,
  arc_serial varchar(10) NOT NULL,  hasil varchar(20) NOT NULL,  date_insert timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status_konfirm char(1) NOT NULL DEFAULT '0',  keterangan varchar(25) NOT NULL,  first_name varchar(25) NOT NULL,  last_name varchar(25) NOT NULL,
  PRIMARY KEY (id),  UNIQUE KEY id_tes (id_tes,parameter,run_time,arc_serial,carrier,position)) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
$sq_konfirm=mysql_query("CREATE TABLE IF NOT EXISTS imltd_arc_konfirm (  id int(11) NOT NULL AUTO_INCREMENT,  no_trans varchar(15) NOT NULL,  instr varchar(15) NOT NULL,
  instr_v varchar(5) NOT NULL,  scc_serial varchar(15) NOT NULL,  interface_sn varchar(15) NOT NULL,  arc_serial varchar(10) NOT NULL,  trans_time datetime NOT NULL,
  `user` varchar(10) NOT NULL,  id_tes varchar(50) NOT NULL,  carrier varchar(4) NOT NULL,  position varchar(2) NOT NULL,  b_lot_reag varchar(15) NOT NULL,
  b_id_raw int(11) NOT NULL,  b_ed_reag date NOT NULL,  b_kode_reag varchar(20) NOT NULL,  b_sn_reag varchar(10) NOT NULL,  b_abs varchar(10) NOT NULL,
  b_run_time datetime NOT NULL,  b_hasil varchar(20) NOT NULL,  b_ket_tes varchar(25) NOT NULL COMMENT 'ulang atau yg lain',  c_lot_reag varchar(15) NOT NULL,
  c_id_raw int(11) NOT NULL,  c_ed_reag date NOT NULL,  c_kode_reag varchar(20) NOT NULL,  c_sn_reag varchar(10) NOT NULL,  c_abs varchar(10) NOT NULL,
  c_run_time datetime NOT NULL,  c_hasil varchar(20) NOT NULL,  c_ket_tes varchar(25) NOT NULL COMMENT 'ulang atau yg lain',  i_lot_reag varchar(15) NOT NULL,
  i_id_raw int(11) NOT NULL,  i_ed_reag date NOT NULL,  i_kode_reag varchar(20) NOT NULL,  i_sn_reag varchar(10) NOT NULL,  i_abs varchar(10) NOT NULL,
  i_run_time datetime NOT NULL,  i_hasil varchar(20) NOT NULL,  i_ket_tes varchar(25) NOT NULL COMMENT 'ulang atau yg lain',  s_lot_reag varchar(15) NOT NULL,
  s_id_raw int(11) NOT NULL,  s_ed_reag date NOT NULL,  s_kode_reag varchar(20) NOT NULL,  s_sn_reag varchar(10) NOT NULL,  s_abs varchar(10) NOT NULL,
  s_run_time datetime NOT NULL,  s_hasil varchar(20) NOT NULL,  s_ket_tes varchar(25) NOT NULL COMMENT 'ulang atau yg lain',  konfirmer varchar(10) NOT NULL,
  koonfirm_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  disahkan varchar(20) NOT NULL,  status_kantong varchar(1) NOT NULL,
  konfirm_action varchar(10) NOT NULL,  PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SIMDONDAR</title>

<script type="text/javascript" src="architec/src/jquery.js"></script>
<script type="text/javascript" src="architec/dist/jquery.imagemapster.js"></script>

<style type="text/css">
p, div {
	font-family: Arial, Helvetica, Sans Serif;
	font-size: 12px;
	font-weight: normal;
}
</style>
<style type="text/css">
.bgimg {
    background-image: url('architec/images/4.jpg');
}
</style>

</head>

<body >

<table border='0'>
	<tr>
		<td>
			<div id="veg_demo" style=" margin: auto;">
				<div style="clear:both;margin-left:0px;"> <img id="veg" src="architec/Arci2000SR604x454_1.png" usemap="#veg" ></div>
    			<div style="clear:both; height:8px;"></div>
			</div>
		</td>
		<td background="architec/images/1.jpg" width="100%">
		       <div id="selections" style="color:black;font-size: 150%;"></div>
		</td>
	</tr>
</table>
<script type="text/javascript">

$(document).ready(function () {
	   var image = $('img');
	   var xref = {
	   		konfirm : "<a href='pmiimltd.php?module=import_arc2000_to_konfirm'><b>KONFIRMASI</b></a><br>Konfirmasi pemeriksaan IMLTD terhadap data yang ditransfer Architect i2000SR oleh interface untuk proses kantong darah",
	   		data    : "<a href='pmiimltd.php?module=arc_data'><b>LIST PEMERIKSAAN</b></a><br>Daftar Pemeriksaan IMLTD dari mesin Architect i2000SR",
	   		cari    : "<a href='pmiimltd.php?module=cari_sample'><b>PENCARIAN DATA</b></a><br>Pencarian data pemeriksaan IMLTD dengan Architect i2000SR",
	   		reagen    : "<a href='pmiimltd.php?module=reagen_arc'><b>REAGEN</b></a><br>Report penggunaan Reagen Architect i2000SR",
	   		laporan : "<a href='pmiimltd.php?module=sample_detail'><b>DETAIL DATA</b></a><br>Detail pemeriksaan IMLTD dengan Architect i2000SR"
	   };
	   var defaultDipTooltip = '<a href="pmiimltd.php?module=arc_laporan"><b>DETAIL DATA</b></a><br>Detail skirining IMLTD';
	   var konfirmDipTooltip = '<a href="pmiimltd.php?module=import_arc2000_to_konfirm"><b>KONFIRMASI</b></a><br>Konfirmasi skrining IMLTD';
	   var dataDipTooltip    = '<a href="pmiimltd.php?module=arc_data"><b>LIST PEMERIKSAAN</b></a><br>Daftar Pemeriksaan IMLTD dari mesin Architect i2000SR';
	   var cariDipTooltip    = '<a href="pmiimltd.php?module=cari_sample"><b>PENCARIAN DATA</b></a><br>Pencarian data skrining IMLTD';
	   var reagenDipTooltip    = '<a href="pmiimltd.php?module=reagen_arc"><b>REAGEN</b></a><br>Report penggunaan Reagen Architect i2000SR';
	   var laporanDipTooltip = '<a href="pmiimltd.php?module=sample_detail"><b>DETAIL DATA</b></a><br>Detail hasil skrining IMLTD Architect i2000SR';

	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "7FFF00",
       		strokeColor: "FFFFFF",
       		strokeOpacity: 1,
       		strokeWidth: 5,
       		stroke: true,
            isSelectable: false,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            onClick: function (e) {
                var newToolTip = defaultDipTooltip;
                $('#selections').html(xref[e.key]);
                if (e.key==='konfirm') {
                	newToolTip = "<a href='pmiimltd.php?module=import_arc2000_to_konfirm'><b>KONFIRMASI</b></a> Konfirmasi pemeriksaan Uji Saring dengan Architect i2000SR";
                }
                image.mapster('set_options',{areas: [{
                	key: "laporan",
                	toolTip: newToolTip
                	}]
                });
            },
            showToolTip: true,
            toolTipClose: ["tooltip-click", "area-click"],
            areas: [
                {
                	key: "konfirm",
                	fillColor: "FF0000",
                	strokeColor: "FFFFFF",
                	toolTip: konfirmDipTooltip
                },
                {
                	key: "data",
                	fillColor: "FFFF00",
                	strokeColor: "FFFFFF",
                	toolTip: dataDipTooltip
                },
                {
                	key: "cari",
                	fillColor: "00FF7F",
                	strokeColor: "FFFFFF",
                	toolTip: cariDipTooltip
                },
                {
                	key: "reagen",
                	fillColor: "00FF7F",
                	strokeColor: "FFFFFF",
                	toolTip: reagenDipTooltip
                },
                {
                   key: "laporan",
                   fillColor: "FFA500",
                   strokeColor: "FFFFFF",
                   toolTip: laporanDipTooltip
                }
                ]
        });
      });
      </script>
	<map id="veg_map" name="veg">
		<area shape="poly" name="konfirm" coords="422,33,517,34,518,108,422,108" alt="Melihat Data Transfer" href=" " />
		<area shape="poly" name="data" coords="74,185,182,186,180,198,180,208,179,219,69,218,69,206,71,196,73,185" alt="Konfirmasi pemeriksaan" href=" " />
		<area shape="poly" name="cari" coords="95,225,179,226,180,265,96,264" alt="Pencarian hasil pemeriksaan" href=" " />
		<area shape="poly" name="laporan" coords="397,188,398,206,398,219,289,220,289,206,289,196,290,187,397,188" alt="Laporan Pemeriksaan Architect i2000SR" href=" " />
		<area shape="poly" name="reagen" coords="143,302,201,303,205,304,207,307,208,310,209,339,208,349,206,353,202,356,149,355,143,350,143,337,143,326,147,322,149,320,191,320,191,330,152,329,152,345,154,346,198,346,199,345,200,313,198,312,143,311" alt="Regen Architect i2000SR" href=" " />
    </map>
<body>
