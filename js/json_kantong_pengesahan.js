var cle;
 function detect(Event) {
  // Event appears to be passed by Mozilla
  // IE does not appear to pass it, so lets use global var
  if(Event==null) {
                alert('null');
                Event=event;
                }
  cle = Event.keyCode;
 }
var chang; 
 function chang(Event,quoi) {
 detect(Event);
 setTimeout('cle=""',100);
 if(cle=='13') 
  while(quoi!=null) 
        {
        quoi = quoi.nextSibling;
        if(quoi.tagName=='INPUT') 
                {
                quoi.focus(nokantong);
                quoi=null;
                }
        
 }
}
var no_label1;

// Cek no kantong di pengesahan //
function cari_kantong(tableID)
  {
	var no_label = document.sahdarah.nokantong.value.toUpperCase();
    $.ajax({
        url: "cek_kantong_pengesahan.php?no_label="+no_label,
        async: false,
        dataType: 'json',
        success: function(json) {
			no_label1 = json.kantong.nokantong;
		}	
    });
	if (no_label1==''){
		addRow(tableID,no_label);
	} else {
		alert('No kantong sudah terdaftar di database. Cek kembali Nomor Kantong yang Anda Masukan.');
	}
}

function ok() {
	if(cle != '13')
		return true;
	else
		return false;
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function formSubmit(){
	document.getElementById("dtable").submit();
}