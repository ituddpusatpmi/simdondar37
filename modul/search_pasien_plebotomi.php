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
					/* kode */  null,
					/* nama */ null,
					/* alamat */ null,
					/* kota */ null,
					/* kelamin */ null,
					/* lahir */ null,
					/* golda */ null,
					/* rhesus */ null,
					/* jumlah_plebotomi */ null 
					],
		            "bJQueryUI": true,
				"sPaginationType": "full_numbers",
					"bProcessing": true,
					"bServerSide": true,
		            "sDom": '<"H"lrf>t<"F"ip>', //T=button, f=search, r=records, H=background header, l=paging
					"sAjaxSource": "modul/search_plebotomi_dt.php",
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
	<?
	$instan0=mysql_query("select * from detailinstansi where aktif='1'");
	$instan01=mysql_fetch_assoc($instan0);
	$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);
	//$td0='M';
	if ($td0=='M') {
		$ninstan = mysql_num_rows($instan0);
		if ($ninstan!=1)  { $pesan="SILAKAN <b><a href=pmimobile.php?module=data_jadwal_mobile>PILIH/GANTI INSTANSI</a></b> DULU SEBELUM MELANJUTKAN!!!";}
		else { $pesan=$instan01[nama]; }
	//die('SILAKAN <b><a href=pmimobile.php?module=data_jadwal_mobile>PILIH/GANTI INSTANSI</a></b> DULU SEBELUM MELANJUTKAN!!!');
	}
	?>
	<div id="containerdt">
		<? if ($_SESSION[leveluser]=='kasir') { ?>
			<h1 class="table">DATA PASIEN PLEBOTOMI <?=$saya?>|| 
			<input type="button" value="Pasien Baru" onClick="document.location.href='pmikasir.php?module=registrasi_pasien_plebotomi';">
			 ||<input type="button" value="Laporan Plebotomi" onClick="document.location.href='pmikasir.php?module=laporan_pasien_plebotomi';"></h1>
		<? }  else { ?>
			<h1 class="table">DATA PASIEN PLEBOTOMI 
			<? if ($_SESSION[leveluser]!='admin') {?>|| 
			<input type="button" value="Pasien Baru" onClick="document.location.href='pmikasir2.php?module=registrasi_pasien_plebotomi';">
			 ||<input type="button" value="Laporan Plebotomi" onClick="document.location.href='pmikasir2.php?module=laporan_pasien_plebotomi';"> </h1>
		<? }  else { ?>
			<h1 class="table">DATA PASIEN PLEBOTOMI 
			<input type="button" value="Pasien Baru" onClick="document.location.href='pmikasir2.php?module=registrasi_pasien_plebotomi';">
			 ||<input type="button" value="Laporan Plebotomi" onClick="document.location.href='pmikasir2.php?module=laporan_pasien_plebotomi';"> </h1>
		<? } ?>
		<? } ?>
		<div id="dynamic">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th width="28%">Kode</th>
					<th width="25%">Nama</th>
					<th width="30%">Alamat</th>
					<th width="15%">Kota</th>
					<th width="5%">Kelamin</th>
					<th width="10%">Lahir</th>
					<th width="4%">Golda</th>
					<th width="4%">Rhesus</th>
					<th width="3%">Jumlah</th>
					
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input type="text" name="search_kode" value="Kode" class="search_init" /></th>
					<th><input type="text" name="search_nama" value="Nama" class="search_init" /></th>
					<th><input type="text" name="search_alamat" value="Alamat" class="search_init" /></th>
					<th></th>
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
	
	<div id="pdf" title="Nota Pendaftaran">
	</div>
</html>
