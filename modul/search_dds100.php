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
		<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			var asInitVals = new Array();
		$(function() {
			$(document).ready(function() {
				var oTable = $('#example').dataTable( {
				"aoColumns": [

					/* asaludd */ null,
					/* nama */ null,
					/* alamat */ null,
					/* kelamin */ null,
					/* tgllahir */ null,
					/* golda */ null,
					/* rhesus */ null,
					/* status */ null,
					/* nopiagam */ null,
					/* cincin */ null,
					/* tglterima */ null,
					/* tglinput */ null,
					/* petugas */ null
					],
				"aLengthMenu": [[10, 25, 50,75,100, -1], [10, 25, 50,75,100, "Semua"]],	
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"bProcessing": true,
				"bServerSide": true,
				
					
				"sDom": '<"H"lrf>t<"F"ip>', //T=button, f=search, r=records, H=background header, l=paging
					"sAjaxSource": "modul/dds_kontak_dt.php",
					"oLanguage": {
						"sLengthMenu": "Tampilkan _MENU_ data per halaman",
						"sZeroRecords": "Maaf, data tidak ditemukan",
						"sInfo": "Menampilkan data mulai _START_ sampai _END_ dari _TOTAL_ data",
						"sInfoEmpty": "Maaf, data tidak ditemukan",
						"sInfoFiltered": "(disaring dari _MAX_ data)",
						"sSearch": "Cari semua kolom:"
					}
				
				});
				
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
				
				$("tfoot input").focus( function (i) {
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
			
				
			});
	
			$( "#pdf" ).dialog({
		        autoOpen: false,
				width: 912,
				height: 500,
				modal: true,
		        hide: "explode",
				buttons: {}
			});
			function makeFrame(id) {
				$('#pdf iFrame').remove();
				ifrm = document.createElement("iFrame");
				ifrm.setAttribute("src", "idcard.php?idpendonor="+id);
				ifrm.style.width = 900+"px";
				ifrm.style.height = 500+"px";
				ifrm.style.border=0;
				document.getElementById('pdf').appendChild(ifrm);
			}
		} );
		</script>
	</head>
	
<body id="dt_example" class="ex_highlight_row">
	 
	<div id="containerdt">
		<? if ($_SESSION[leveluser]=='monev') { 
			?>
			<h1 class="table">DATA DDS PENERIMA PENGHARGAAN 100 KALI</h1>
			<button  value="tambah_kontak" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"
				onClick="document.location.href='pmimonev.php?module=formdds';">
				<span class="ui-button-text">Tambah DATA DDS 100</span>
			</button>
			<?
		} ?>

		<div id="dynamic">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th width="150">Asal UDD</th>
					<th width="80">Nama DDS</th>
					<th width="300"> Alamat</th>
					<th> JK</th>
					<th> Tgl Lahir</th>
					<th> Gol Darah</th>
					<th> Rhesus</th>
					<th> Status</th>
					<th> No Piagam</th>
					<th> Cincin</th>
					<th> Tgl Terima</th>
					<th> Tgl Input</th>				
					<th> Petugas</th>
		

</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input type="text" name="search_UDD" value="Cari Kode" class="search_init" /></th>
					<th><input type="text" name="search_Nama" value="Cari Nama" class="search_init" /></th>
					<th><input type="text" name="search_Alamat" value="Cari alamat" class="search_init" /></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td colspan="13" class="dataTables_empty">Loading data dari server</td>
				</tr>
			</tbody>
		</table>
		
		</div>
		</div>
	</body>
	
	</div>
</html>
