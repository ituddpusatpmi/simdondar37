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
		<td background="architec/images/kanan.png"  width="100%">
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
	   		reagen  : "<a href='pmiimltd.php?module=reagen_arc'><b>REAGEN</b></a><br>Report penggunaan Reagen Architect i2000SR",
	   		trace   : "<a href='pmiimltd.php?module=trace_arc'><b>TRACE REAGEN</b></a><br><i>Trace</i> (jejak) Reagen Architect i2000SR",
	   		qc      : "<a href='pmiimltd.php?module=qc_arc'><b>KONTROL</b></a><br>Hasil Kontrol Reagen Architect i2000SR",
	   		laporan : "<a href='pmiimltd.php?module=sample_detail'><b>DETAIL DATA</b></a><br>Detail pemeriksaan IMLTD dengan Architect i2000SR"
	   };
	   var defaultDipTooltip = '<a href="pmiimltd.php?module=arc_laporan"><b>DETAIL DATA</b></a><br>Detail skirining IMLTD';
	   var konfirmDipTooltip = '<a href="pmiimltd.php?module=import_arc2000_to_konfirm"><b>KONFIRMASI</b></a><br>Konfirmasi skrining IMLTD';
	   var dataDipTooltip    = '<a href="pmiimltd.php?module=arc_data"><b>LIST PEMERIKSAAN</b></a><br>Daftar Pemeriksaan IMLTD dari mesin Architect i2000SR';
	   var cariDipTooltip    = '<a href="pmiimltd.php?module=cari_sample"><b>PENCARIAN DATA</b></a><br>Pencarian data skrining IMLTD';
	   var traceDipTooltip   = '<a href="pmiimltd.php?module=trace_arc"><b><i>TRACE</i> REAGEN</b></a><br><i>Trace</i> (jejak) Reagen Architect i2000SR';
	   var reagenDipTooltip  = '<a href="pmiimltd.php?module=reagen_arc"><b>REAGEN</b></a><br>Report penggunaan Reagen Architect i2000SR';
	   var qcDipTooltip      = '<a href="pmiimltd.php?module=qc_arc"><b>KONTROL</b></a><br>Hasil Kontrol Reagen Architect i2000SR';
	   var laporanDipTooltip = '<a href="pmiimltd.php?module=sample_detail"><b>DETAIL DATA</b></a><br>Detail hasil skrining IMLTD Architect i2000SR';

	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "7FFF00",
       		strokeColor: "FF00FF",
       		strokeOpacity: 0.8,
       		strokeWidth: 3,
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
                	fillColor: "00FFFF",
                	strokeColor: "FFFFFF",
                	toolTip: konfirmDipTooltip
                },
                {
                	key: "data",
                	fillColor: "7FFF00",
                	strokeColor: "FFFFFF",
                	toolTip: dataDipTooltip
                },
                {
                	key: "cari",
                	fillColor: "00FFFF",
                	strokeColor: "FF0000",
                	toolTip: cariDipTooltip
                },
                {
                	key: "reagen",
                	fillColor: "FF00FF",
                	strokeColor: "FFFFFF",
                	toolTip: reagenDipTooltip
                },
                {
                	key: "trace",
                	fillColor: "ADFF2F",
                	strokeColor: "FFFFFF",
                	toolTip: traceDipTooltip
                },
                {
                	key: "qc",
                	fillColor: "FF00FF",
                	strokeColor: "FFFFFF",
                	toolTip: qcDipTooltip
                },
                {
                   key: "laporan",
                   fillColor: "FFFF00",
                   strokeColor: "FFFFFF",
                   toolTip: laporanDipTooltip
                }
                ]
        });
      });
      </script>
	<map id="veg_map" name="veg">
		<area shape="rect" name="konfirm" coords="421,33,517,108" alt="Melihat Data Transfer" href=" " />
		<area shape="poly" name="data" coords="183,186,292,187,290,196,289,205,289,211,290,217,290,226,290,265,182,265,182,226,181,215,180,209,180,197,182,186" alt="Konfirmasi pemeriksaan" href=" " />	
		<area shape="poly" name="cari" coords="412,200,412,208,413,212,416,212,417,216,431,224,439,226,458,226,481,227,489,228,511,228,535,228,536,227,570,227,572,223,572,221,571,221,571,218,575,218,579,213,552,203,551,201,527,201,527,200,509,199,508,201,506,201,506,199,484,199,484,200,482,200,482,199,458,199,458,200,455,200,455,199,433,198,433,200,427,200,427,199,422,199,422,200,413,200" alt="Pencarian hasil pemeriksaan" href=" " />		
		<area shape="poly" name="laporan" coords="74,185,183,185,180,195,179,204,179,211,179,230,180,266,96,265,95,225,71,225,71,217,68,217,68,209,69,202,70,195,71,189,73,185" alt="Laporan Pemeriksaan Architect i2000SR" href=" " />
		<area shape="poly" name="reagen" coords="143,303,143,311,199,312,200,344,198,346,154,347,152,346,152,329,191,329,190,321,150,320,147,322,144,325,143,327,143,348,145,352,147,353,151,355,202,355,204,353,208,349,208,308,205,305,202,302" alt="Regen Architect i2000SR" href=" " />
		<area shape="poly" name="trace" coords="220,330,234,330,234,326,231,326,232,322,238,322,238,325,235,326,235,330,259,330,259,329,264,331,270,330,274,327,277,329,279,329,282,328,285,330,291,331,296,328,299,326,301,328,305,330,310,331,316,330,318,327,321,323,323,327,324,329,328,331,331,331,335,330,338,326,341,329,344,331,348,331,351,328,352,324,352,320,348,320,348,322,348,326,346,326,346,314,351,314,351,311,347,310,346,302,341,302,340,307,337,311,330,311,330,303,325,303,324,307,323,309,318,310,318,314,315,311,309,310,304,311,299,313,299,316,298,318,297,314,292,310,288,309,286,310,284,311,284,302,272,302,272,306,276,307,276,321,274,314,270,310,266,309,262,311,261,302,250,302,250,305,253,308,254,325,250,325,240,302,232,302,224,325,220,326,220,330" alt="Architect i2000SR" href=" " />
		<area shape="poly" name="qc" coords="293,187,291,197,290,206,290,212,291,218,292,226,292,265,399,266,401,246,402,218,399,218,399,206,398,187" alt="QC Architect i2000SR" href=" " />
    </map>
<body>
