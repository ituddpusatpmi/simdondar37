$.fx.speeds._default = 1000;
var tr='';

//------------------perubahan baru-------------------
var jum_od=0;
var od_raw=0;
$(function(){
    // jQuery UI Dialog    
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
		$("#rerun")
			.button()
			.click(function() {
				for(h=0;h<4;h++){
					for(k=0;k<jum_kantong;k++){
						no_ktg="input#box-table-b"+h+"no_kantong"+k;
						//alert ($(no_ktg).val());
						if ($(no_ktg).val()=='' || $(no_ktg).val()==undefined){continue}
						q="input#box-table-b"+h+"od"+k;
						od="input#box-table-b"+h+"od"+k;
						jum_od=jum_od+$(q).val();
						test="input#box-table-b"+h+"jenis_test"+k;
						cut_off="input#cut_off"+h;
						greyzone="input#greyzone"+h;
						greyzone1=$(greyzone).val();
						gol_darah="select#box-table-b"+h+"gol_darah"+k;
						rhesus_darah="select#box-table-b"+h+"RhesusDrh"+k;
						od_raw=$(od).val();
						od_fixed=od_raw.replace(",", ".");
						co_raw=$(cut_off).val();
						co_fixed=co_raw.replace(",", ".");
										ratio=od_fixed;
										if (co_fixed>0) ratio=od_fixed/co_fixed;
										if(ratio<(nonreaktif1)){
											hasil='Non reaktif'
										}
										if (greyzone1>0) {
										if(ratio>=greyzone1){
											hasil='Grey Zone'
										}
										}
										if(ratio>=(reaktif1))
										{hasil='Reaktif'};
						if ($(q).val()>0){
							var ratio1 = Math.round(ratio*100)/100;
							tr=tr+"<tr><td>"+$(no_ktg).val()
								+"</td><td>"+$(test).val()
								+"</td><td>"+ratio1
								+"</td><td>"+hasil
								+"</td><td>"+$(gol_darah).val()
								+"</td><td>"+$(rhesus_darah).val()+"</td></tr>";
						}
					}
				}
				if (jum_od!='0'){
					table="<table class=\"ui-widget ui-widget-content\">"+
						"<thead><tr class=\"ui-widget-header\"><td>No Kantong</td><td>Tes</td><td>OD</td><td>Hasil</td><td>Gol. Darah</td><td>Rhesus</td></tr><thead>"
						+tr+"</table>";
					o="p#hasil";
					$(o).html(table);
					$('#konfirmasi').dialog('open');
					tr ='';
					return false;
					}
				return false;
			})
//------------------perubahan baru-------------------
        $('#konfirmasi').dialog({
            autoOpen: false,
            width: 500,
			//height: 300,
            modal: true,
            resizable: false,
            hide: "explode",
            buttons: {
                "Simpan": function() {
                    document.hasillab.submit();
                },
                "Batal": function() {
                    $(this).dialog("close");
                }
            }
        });
		$( "#ganti_reagen" ).dialog({
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
		$( "#pilih_tes" ).dialog({
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
		$( "#isi_kantong" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
});
