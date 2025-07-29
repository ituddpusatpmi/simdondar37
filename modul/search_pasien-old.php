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
					/* no_rm */  null,
					/* nama */ null,
					/* alamat */ null,
					/* gol_darah */ null,
					/* rhesus */ null,
					/* kelamin */ null,
					/* keluarga */ null,
					/* tgl_lahir */ null,
					/* tlppasien */ null,
					
					
					],
		            "bJQueryUI": true,
				"sPaginationType": "full_numbers",
					"bProcessing": true,
					"bServerSide": true,
		            "sDom": '<"H"lrf>t<"F"ip>', //T=button, f=search, r=records, H=background header, l=paging
					"sAjaxSource": "modul/search_pasien_dt.php",
					"oLanguage": {
						"sLengthMenu": "Tampilkan _MENU_ data per halaman",
						"sZeroRecords": "Maaf, data tidak ditemukan",
						"sInfo": "Menampilkan data mulai _START_ sampai _END_ dari _TOTAL_ data",
						"sInfoEmpty": "Maaf, data tidak ditemukan",
						"sInfoFiltered": "(disaring dari _MAX_ data)",
						"sSearch": "Cari semua kolom:"
					}
				} );
				
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
			
				$('#example tbody tr td a img').live('click', function () {
					//console.log(this.value);
					//console.log(this.src);
					card=this.src.substr(35);
					if (card=='card.png'){
					    makeFrame(this.value);
					    $( "#pdf" ).dialog( "open" );
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
					  //  $( "#pdf" ).dialog( "open" );
			}
		} );
		</script>
	</head>
	
<body id="dt_example" class="ex_highlight_row">
	
	<div id="containerdt">
		<? if ($_SESSION[leveluser]=='kasir2') { ?>
		
			<h1 class="table">Data Pasien 
			|| 
			<input type="button" value="Pasien & Permintaan Baru" onClick="document.location.href='pmikasir2.php?module=permintaan';">
			 ||<?=$instan01[nama]?>
		</h1>
		<? } ?>
		<div id="dynamic">
		<table cellpadding="0" cellspacing="0" boarder="0" class="display" id="example">
			<thead>
				<tr>
					<th width="19%">No RM</th>
					<th width="20%">Nama</th>
					<th>Alamat</th>
					<th width="4%">Gol</th>
					<th width="4%">Rh</th>
					<th width="4%">Jk</th>
					<th width="4%">Keluarga</th>
					<th width="8%">Tgl Lhr</th>					
					<th width="8%">Telepon</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input type="text" name="search_no_rm" value="No RM" class="search_init" /></th>
					<th><input type="text" name="search_nama" value="Nama" class="search_init" /></th>
					<th><input type="text" name="search_alamat" value="Alamat" class="search_init" /></th>
					<th><input type="text" name="search_gol_darah" value="Gol" class="search_init" /></th>
					<th><input type="text" name="search_rhesus" value="Rh" class="search_init" /></th>
					<th><input type="text" name="search_kelamin" value="Kelamin" class="search_init" /></th>
					<th><input type="text" name="search_keluarga" value="Keluarga" class="search_init" /></th>
					<th><input type="text" name="search_tgl_lahir" value="Tgl Lahir" class="search_init" /></th>
					<th><input type="text" name="search_tlppasien" value="Telepon" class="search_init" /></th>
					
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td colspan="13" class="dataTables_empty">Loading data from server</td>
				</tr>
			</tbody>
		</table>
		
		</div>
		</div>
	</body>
	
	<div id="pdf" title="Kartu Donor">
	</div>
</html>
