/*
06-05-11 devit -> start 
*/

//function clearForm() {
	
	//document.konfirmasi.nokantong.value="";
//}

function detect(Event) {
    if(Event==null) {
        alert('null');
        Event=event;
    }
    cle = Event.keyCode;
}

function chang(Event,quoi) {
    detect(Event);
    setTimeout('cle=""',100);
    if(cle=='13')
        while(quoi!=null) {
            quoi = quoi.nextSibling;
            if(quoi.tagName=='input') {
                focus(document.konfirmasi.nokantong);
                quoi=null;
            }
        }
}

function ok() {
    if(cle != '13') return true;
    else return false;
}

function check2() {
    valid_darah0 = '0';
    $.ajax({
        url: "modul/json_cek_konfirmasi_gol.php?NoKantong="+document.konfirmasi.nokantong.value,
        async: false,
        dataType: 'json',
        success: function(json) {
        valid_darah0 = json.darah.valid;
        gol_darah0 = json.darah.gol;
        rhs_darah0 = json.darah.rhesus;
        }
    });
	if (valid_darah0=='1'){
		addRow(document.konfirmasi.nokantong.value);
	} else {
                $( "#kantong_tdk_sesuai" ).dialog( "open" );
                return false;
	}
}

function addRow(nokantong) {
	$.ajax({
		url: "modul/json_konfirmasi_gol_darah.php?NoKantong="+nokantong,
		async: false,
		dataType: 'json',
		success: function(json) {
			nama = json.kantong.nama;
			kode = json.kantong.kode;
			gol_darah = json.kantong.gol;
			saudara =json.kantong.saudara;
		}
	});
	
	if (nama==''){
        $( "#kantong_tdk_sesuai" ).dialog( "open" );
        return false;
	}
	
    var gol = document.createElement('p');
    gol.innerHTML = "Gol Darah Awal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;"+gol_darah;
    var parent = document.getElementById('box');
    parent.insertBefore(gol, null);
	
    var pendonor = document.createElement('p');
    pendonor.innerHTML = "Pendonor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;"+nama;
    var parent = document.getElementById('box');
    parent.insertBefore(pendonor, null);
	
    var input_pendonor = document.createElement('input');
    input_pendonor.type ="hidden";
    input_pendonor.value =kode;
    input_pendonor.name = "pendonor";
    var parent = document.getElementById('box');
    parent.insertBefore(input_pendonor, null);
	
	if (saudara==''){
		var kantong = document.createElement('p');
		kantong.innerHTML =  "No Kantong yg akan berubah :&nbsp;"+nokantong;
		var parent = document.getElementById('box');
		parent.insertBefore(kantong, null);
		
		var input_kantong = document.createElement('input');
		input_kantong.type ="hidden";
		input_kantong.value =nokantong;
		input_kantong.name = "nokantong";
		var parent = document.getElementById('box');
		parent.insertBefore(input_kantong, null);
	}else{
		var kantong = document.createElement('p');
		kantong.innerHTML =  "No Kantong yg akan berubah :&nbsp;"+nokantong;
		var parent = document.getElementById('box');
		parent.insertBefore(kantong, null);
		
		var input_kantong = document.createElement('input');
		input_kantong.type ="hidden";
		input_kantong.value =nokantong;
		input_kantong.name = "nokantong";
		var parent = document.getElementById('box');
		parent.insertBefore(input_kantong, null);
	}
	
	var element3 = document.createElement("select");
	element3.name = "gol_darah";
	var element4 = document.createElement("option");
	element4.value = "A";
	if (gol_darah0=='A') {element4.selected ="selected";}
	element4.innerHTML = "A";
	element3.appendChild(element4);
	var element4 = document.createElement("option");
	element4.value = "B";
	if (gol_darah0=='B') {element4.selected ="selected";}
	element4.innerHTML = "B";
	element3.appendChild(element4);
	var element4 = document.createElement("option");
	element4.value = 'AB';
	if (gol_darah0=='AB') {element4.selected ="selected";}
	element4.innerHTML = "AB";
	element3.appendChild(element4);
	var element4 = document.createElement("option");
	element4.value = "O";
	if (gol_darah0=='O') {element4.selected ="selected";}
	element4.innerHTML = "O";
	element3.appendChild(element4);
    var parent = document.getElementById('box');
    parent.insertBefore(element3, null);
	var element31 = document.createElement("select");
	element31.name = "rhs_darah";
	var element41 = document.createElement("option");
	element41.value = "+";
	if (rhs_darah0=='+') {element41.selected ="selected";}
	element41.innerHTML = "(+)";
	element31.appendChild(element41);
	var element51 = document.createElement("option");
	element51.value = "-";
	if (rhs_darah0=='-') {element51.selected ="selected";}
	element51.innerHTML = "(-)";
	element31.appendChild(element51);
    var parent = document.getElementById('box');
    parent.insertBefore(element31, null);
	
    if(Event.keyCode != '13') return true;
    else return false;
}

