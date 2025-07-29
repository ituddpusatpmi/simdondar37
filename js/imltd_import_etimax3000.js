
function cek_validitas_kantong(no_kantong_cek){
	$.ajax({
		url : "modul/imltd_import_etimax3000_proses.php?op=cek_kantong&nomorkantong="+no_kantong_cek,
		async: false,
		dataType: 'json',
		success: function(json) {
			statuskantong = json.pesan.status;
		}
	});
	return statuskantong;
}

function ok() {
    if(cle != '13') return true;
    else return false;
}


function detect(Event) {
  // Event appears to be passed by Mozilla
  // IE does not appear to pass it, so lets use global var
    if(Event==null) {
        alert('null');
        Event=event;
    }
    cle = Event.keyCode;
}

function roundNumber(num, dec) {
  var result = String(Math.round(num*Math.pow(10,dec))/Math.pow(10,dec));
  if(result.indexOf('.')<0) {result+= '.';}
  while(result.length- result.indexOf('.')<=dec) {result+= '0';}
  return result;
}

function hasil_test(masukan,baris){
	var absorbance = document.getElementById('od'+baris).value;
	var varhasil="hasil"+baris;
	var jum_od=0;
	var co	= document.getElementById('cut_off').value;
	var co_fix = co.replace(",", ".");
	var v_reaktif = document.getElementById('reaktif_id').value;
	var v_nonreaktif = document.getElementById('nonreaktif_id').value;
	var v_greyzone = document.getElementById('greyzone_id').value;
	var absorbance_fix = absorbance.replace(",", ".");
	var ratio=0;
	var hasil="";
	ratio=absorbance_fix;
	if (co_fix>0) ratio=absorbance_fix/co_fix;
	if(ratio<(v_nonreaktif)){
		hasil='Non reaktif';
		val_hasil=0;
	}
	if (v_greyzone>0) {
		if(ratio>=v_greyzone){
			hasil='Grey Zone';
			val_hasil=2;
		}
	}
	if(ratio>=(v_reaktif)){
		hasil='Reaktif';
		val_hasil=1;
	}
	
	ratio=roundNumber(ratio, 3);
	document.getElementById('prn_ratio'+baris).innerHTML=ratio;
	document.getElementById('prn_hasil'+baris).innerHTML=hasil;
}