<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<style type="text/css" title="currentStyle">
			@import "css/dt_page.css";
			@import "css/dt_table.css";
			@import "css/dt_table_jui.css";
		</style>
		<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
		<link type="text/css" href="css/TableTools_JUI.css" rel="stylesheet" />
		<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			var asInitVals = new Array();
			
			$(document).ready(function() {
				var oTable = $('#example').dataTable( {
				"aoColumns": [
					/* Kode */  null,
					/* Nama */ null,
					/* Alamat */ null,
					/* Gol */ null,
					/* Jk */ null,
					/* telp */ null,
					/* telp2 */ null,
					/* Tgl Kembali */ null
					],
		            "bJQueryUI": true,
				"sPaginationType": "full_numbers",
					"bProcessing": true,
					"bServerSide": true,
		            "sDom": '<"H"lrf>t<"F"ip>', //T=button, f=search, r=records, H=background header, l=paging
					"sAjaxSource": "modul/search_pendonor_calling_dt.php",
					"oLanguage": {
						"sLengthMenu": "Tampilkan _MENU_ data per halaman",
						"sZeroRecords": "Maaf, data tidak ditemukan",
						"sInfo": "Menampilkan data mulai _START_ sampai _END_ dari _TOTAL_ data",
						"sInfoEmpty": "Maaf, data tidak ditemukan",
						"sInfoFiltered": "(disaring dari _MAX_ data)",
						"sSearch": "Cari semua kolom:"
					}
				} );
				function make_version_dropdown (oObj) {
				var dropdown = "<select>"
				dropdown += "<option value='A'>A</option>";
				dropdown += "<option value='B'>B</option>";
				dropdown += "<option value='AB'>AB</option>";
				dropdown += "<option value='O'>O</option>";
				dropdown += "</select>";
 
				return dropdown;
				}
				
				$("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					oTable.fnFilter( this.value, $("tfoot input").index(this) );
				} );
				
				
				
				/*
				 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
				 * the footer
				 */
				$("tfoot input").each( function (i) {
					asInitVals[i] = this.value;
				} );
				
				$("tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$("tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				} );
			} );
		</script>
	</head>
	
<body id="dt_example" class="ex_highlight_row">
	<?
	$instan0=mysql_query("select * from detailinstansi where aktif='1'");
	$instan01=mysql_fetch_assoc($instan0);
	$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);
	//$td0='M';
	if ($td0=='M') {
		$ninstan = mysql_num_rows($instan0);
		if ($ninstan!=1) die('SILAKAN <b><a href=pmimobile.php?module=data_jadwal_mobile>PILIH/GANTI INSTANSI</a></b> DULU SEBELUM MELANJUTKAN!!!');
	}
	?>
	<div id="container">
		<div id="dynamic">
		<br>
		<br>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th width="12%">Kode</th>
					<th width="15%">Nama</th>
					<th width="18%">Alamat</th>
					<th width="4%">Gol</th>
					<th width="4%">Jk</th>
					<th width="5%">Tlp 1</th>
					<th width="5%">Tlp 2</th>
					<th width="10%">Tgl Kembali</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input type="text" name="search_kode" value="Kode" class="search_init" /></th>
					<th><input type="text" name="search_nama" value="Nama" class="search_init" /></th>
					<th><input type="text" name="search_alamat" value="Alamat" class="search_init" /></th>
					<th><input type="text" name="search_gol" value="Gol" class="search_init" /></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td colspan="8" class="dataTables_empty">Loading data from server</td>
				</tr>
			</tbody>
		</table>
		
		</div>
		<div class="spacer"></div>
	</body>
</html>
