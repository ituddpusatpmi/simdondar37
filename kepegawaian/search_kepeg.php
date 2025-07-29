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
					/* Kode */  null,
					/* KTP */ null,
					/* Nama */ null,
					/* Alamat */ null,
					/* Status */ null,
					/* Tptlhr */ null,
					/* tgllhr */ null,
					/* umur */ null,
					/* Ijasah */ null,
					/* Jk */ null,
					/* jabatan */ null,
					/* Golongan */ null,
					/* satatuspeg */ null,
					/* tmt */ null,
					/* kgb */ null,
					/* kp */ null,
					/* telp2 */ null,
					/* masakerja */ null,
					/* pensiun */ null,
					/* Sisacuti */ null,
					
					],
		            "bJQueryUI": true,
				"sPaginationType": "full_numbers",
					"bProcessing": true,
					"bServerSide": true,
		            "sDom": '<"H"lrf>t<"F"ip>', //T=button, f=search, r=records, H=background header, l=paging
					"sAjaxSource": "kepegawaian/search_kepeg_dt.php",
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
	<!--?
	$instan0=mysql_query("select * from detailinstansi where aktif='1'");
	$instan01=mysql_fetch_assoc($instan0);
	$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);
	if ($td0=='M') {
		$ninstan = mysql_num_rows($instan0);
		if ($ninstan!=1)  { $pesan="SILAKAN <b><a href=pmimobile.php?module=data_jadwal_mobile>PILIH/GANTI INSTANSI</a></b> DULU SEBELUM MELANJUTKAN!!!";}
		else { $pesan=$instan01[nama]; }
	}
	?-->
	<div id="containerdt">
		<? if ($_SESSION[leveluser]=='kepegawaian') { ?>
			<h1 class="table">Data Karyawan <?=$saya?>|| 
			<input type="button" value="Input Data Karyawan" onClick="document.location.href='pmikepegawaian.php?module=registrasi';">
			 ||<?=$pesan?></h1>
		<? } else { ?>
			<h1 class="table">Data Pegawai 
			<? if ($_SESSION[leveluser]!='admin') {?>|| 
			<input type="button" value="Input Data Karyawan" onClick="document.location.href='pmikepegawaian.php?module=registrasi';">
			 ||<?=$instan01[nama]?>
		<? } ?> </h1>
		<? } ?>
		<div id="dynamic">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>

	
				<tr>
					<th>Kode</th>
					<th>No.<br>KTP</th>
					<th width="10%">Nama</th>
					<th>Alamat</th>
					<th width="4%">Status</th>
					<th width="4%">Tpt<br>Lhr</th>
					<th width="5%">Tgl<br>Lhr</th>
					<th width="4%">Umur</th>
					<th width="4%">Jk</th>
					<th width="4%">Ijazah</th>
					<th width="5%">Jabatan</th>
					<th width="5%">Gol</th>
					<th width="4%">Status<br>Peg.</th>
					<th width="3%">TMT<br>CAPEG</th>
					<th width="5%">KGB</th>
					<th width="5%">KP</th>
					<th width="6%">HP</th>
					<th width="5%">Masa<br>kerja</th>
					<th width="5%">Tgl<br>Pensiun</th>
					<th width="5%">Sisa<br>Cuti</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input type="text" name="search_kode" value="Kode" class="search_init" /></th>
					<th><input type="text" name="search_nama" value="Nama" class="search_init" /></th>
					<th><input type="text" name="search_alamat" value="Alamat" class="search_init" /></th>
					<th><input type="text" name="search_kelurahan" value="Kelurahan" class="search_init" /></th>
					<th><input type="text" name="search_kecamatan" value="Kecamatan" class="search_init" /></th>
					<th><input type="text" name="search_wilayah" value="Wilayah" class="search_init" /></th>
					<th><input type="text" name="search_gol" value="Gol" class="search_init" /></th>
					<th><input type="text" name="search_rhesus" value="Rhesus" class="search_init" /></th>
					<th><input type="text" name="search_apheresis" value="apheresis" class="search_init" /></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
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
