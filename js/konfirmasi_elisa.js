var switch_submit=0;
$(function(){
	$('#yakin').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        resizable: false
		/*,
        buttons: {
            "Simpan": function() {
				//document.hasillab.submit();
				//$('form#hasillab').submit();
				return true;
            },
            "Batal": function() {
                    $(this).dialog("close");
				return false;
	                }
	    }*/
	});
// jQuery UI Dialog    
		$('form#hasillab').submit(function(){
			if(switch_submit==0){
				switch_submit=1;
			for(h=0;h<4;h++){
				for(k=0;k<jum_kantong;k++){
					od_val="input#box-table-b"+h+"od"+k;
					od_val_s="#box-table-b"+h+"od"+k;
					nk_val="input#box-table-b"+h+"no_kantong"+k;
					hs_val="input#box-table-b"+h+"hs"+k;
					if($(od_val).attr('type')=='text'){
						//alert($(hs_val).val());
						if($(hs_val).val()==1){
							$('#yakin').dialog('open');
							return false;
						}
					}else{
						//alert($(od_val_s+' option:selected').val());
						if($(od_val_s+' option:selected').val()==0){
							$('#yakin').dialog('open');
							return false;
						}
					}
					
					//if($(nk_val).val()==undefined) continue;
					
					if($(od_val).val()==""){
						switch (h){
							case 0:
								jenis_tes="HBsAg";
								break;
							case 1:
								jenis_tes="HCV";
								break;
							case 2:
								jenis_tes="HIV";
								break;
							case 3:
								jenis_tes="HIV";
								break;
						}
						tempat="p#id_periksa";
						pesan="<b>No kantong "+$(nk_val).val()+", jenis tes"+jenis_tes+"</b>";
						$(tempat).html(pesan);
						$('#periksa').dialog('open');
						return false;
					}
				}
			}
			}
			return true;
		});
			
		$( "#periksa" ).dialog({
            autoOpen: false,
			height: 100,
			modal: true,
            hide: "explode"
		});
		$( "#pernah_ditest" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
		$( "#ganti_reagen" ).dialog({
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
		$( "#kantong_rapid" ).dialog({
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
});

function roundNumber(num, dec) {
  var result = String(Math.round(num*Math.pow(10,dec))/Math.pow(10,dec));
  if(result.indexOf('.')<0) {result+= '.';}
  while(result.length- result.indexOf('.')<=dec) {result+= '0';}
  return result;
}
