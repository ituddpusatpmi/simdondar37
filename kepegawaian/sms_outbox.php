	<head>
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
					/* Tgl */  null,
					/* No */ null,
					/* No */ null,
					/* SMS */ null
					],
		            "bJQueryUI": true,
				"sPaginationType": "full_numbers",
					"bProcessing": true,
					"bServerSide": true,
		            "sDom": '<"H"lrf>t<"F"ip>', //T=button, f=search, r=records, H=background header, l=paging
					"sAjaxSource": "kepegawaian/sms_outbox_dt.php",
					"oLanguage": {
						"sLengthMenu": "Tampilkan _MENU_ data per halaman",
						"sZeroRecords": "Outbox telah dikosongkan / Semua pesan telah terkirim",
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
			} );
			
			$( "#hapus" ).dialog({
            autoOpen: false,
			width: 300,
			height: 200,
			modal: true,
            hide: "explode",
			buttons: {}
			});
			
			$( "#gagal" ).dialog({
            autoOpen: false,
			width: 300,
			height: 200,
			modal: true,
            hide: "explode",
			buttons: {}
			});
		} );
			
		function hapus(id){
			//console.log(id);
			$.ajax({
				url: "kepegawaian/sms_outbox_json.php?id="+id,
			    async: false,
			    dataType: 'json',
			    success: function(json) {
					if(json.update.sukses==1){
						$( "#hapus" ).dialog( "open" );
						location.reload();
					}else{
						$( "#gagal" ).dialog( "open" );
					}
			    }
			});
		}
	

		</script>
	</head>
	
<?
require_once("config/db_connect_sms.php");
if (isset($_POST[submit])) {
    $empty=mysql_query("TRUNCATE TABLE outbox");
    if($empty){
	echo '<META http-equiv="refresh" content="0; url=pmikepegawaian.php?module=outbox">';
    }else{
        echo mysql_error();
    }
}
?>
<body id="dt_example" class="ex_highlight_row">
	<div>
		<div id="dynamic">
		<br>
        <h2> Daftar Outbox SMS </h2>
        <form name="empty" method="post" action="pmikepegawaian.php?module=kosongkan_outbox">
            <button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
                <span class="ui-button-text">Batalkan semua pesan</span>
            </button>
        </form>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th width="150">Tanggal</th>
					<th width="150">Nomor Tujuan</th>
					<th width="700">Pesan</th>
					<th width="100">aksi</th>
					<th></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input type="text" name="search_kode" value="Tanggal" class="search_init" /></th>
					<th><input type="text" name="search_nama" value="Nomor Pengirim" class="search_init" /></th>
					<th><input type="text" name="search_alamat" value="Pesan" class="search_init" /></th>
					<th></th>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td colspan="8" class="dataTables_empty">Mengambil data dari server</td>
				</tr>
			</tbody>
		</table>
		
		</div>

		<div class="alert">
			<div id="hapus" title="Data telah tersimpan..">
				<p>Pesan telah dihapus</p>
			</div>
			<div id="gagal" title="Perubahan data gagal tersimpan..">
				<p>Pesan gagal dihapus</p>
			</div>
		</div>

	</body>


