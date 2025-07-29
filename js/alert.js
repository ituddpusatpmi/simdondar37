// increase the default animation speed to exaggerate the effect
$.fx.speeds._default = 1000;
$(function() {
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#ganti_reagen" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#kantong_terpenuhi" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#kantong_tdk_sesuai" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#kantong_reaktif" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#pilih_reagen" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#pilih_tes" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#kantong_sudah_diinput" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#berhasil" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#cut" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#kantong_elisa" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#kantong_belum_ditest" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#jam_ambil_lebih" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
});
