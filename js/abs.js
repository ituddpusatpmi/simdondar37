var nokantong1;
function clearForm() {
	document.kantong.nokantong.value="";
}

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
  	while(quoi!=null) {
    	quoi = quoi.nextSibling;
        if(quoi.tagName=='INPUT') {
            quoi.focus(nokantong);
            quoi=null;
        }
 	}
}

function carisample(tableID,nomorsample) {
	var hasil="0";
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=1; i<rowCount; i++) {
		var row = table.rows[i];
		var sel = row.cells[2].childNodes[0];
		var value_cell=sel.textContent;
		if (nomorsample==value_cell){
			hasil="1";
		}
	}
	return hasil;
}

var no_label1;
var gol_darah;
var rhesus_darah;
// No Sample : XXXYYMMDDNNNZR
// Cek no kantong di stokkantong
function cari_kantong(tableID){
	
	var abo;
	var rh;
	var no_label = document.kantong.nokantong.value;
		no_label = no_label.toUpperCase();
		no_label1 = no_label;
	var adasample="0";
	 	adasample=carisample(tableID,no_label)
		n= no_label1.length;
		abo = no_label.substr(12,1);
		rh  = no_label.substr(13,1);
		gol_darah="?";
		rhesus_darah="?";
		format_abo="0";
		format_rh="0";
		switch(abo){ 
			case "1" : gol_darah = "A";break;
			case "2" : gol_darah = "B";break;
			case "3" : gol_darah = "O";break;
			case "4" : gol_darah = "AB";break;
			default  : gol_darah="?";format_abo="1";
		}
		switch(rh){
			case "1" : rhesus_darah = "+";break;
			case "2" : rhesus_darah = "-";break;
			default  : rhesus_darah = "?";format_rh="1";
		}
		nama_pendonor = "-";
		kode_pendonor = "-";
		produk = "-";
	if ( (n > 13) && (format_abo=="0") && (format_rh=="0") && (adasample==0)){
		addRow(tableID,no_label,gol_darah,rhesus_darah);
	} else if (format_abo=="1"){
		clearForm();	
		alert('Format kode sampel yang anda masukkan SALAH!!, Golongan Darah ABO tidak terdefinisikan');
	} else if (format_rh=="1"){
		clearForm();	
		alert('Format kode sampel yang anda masukkan SALAH!!, Golongan Darah Rhesus tidak dapat didefinisikan');
	} else if (adasample=="1"){
		clearForm();	
		alert('Kode sample yang dimasukkan sudah ada');
	}else{
		clearForm();	
		alert('Format kode sampel yang anda masukkan SALAH!!');
	}
}
  
function ok() {
 	if(cle != '13') return true;
 	else return false;
}

function addRow(tableID,no_label,gol_darah,rhesus_darah) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var cell1 = row.insertCell(0);
	var element1 = document.createElement("div");
		element1.innerHTML = rowCount;
		cell1.appendChild(element1);
	
	var cell0 = row.insertCell(1);
		var element0 = document.createElement("input");
		element0.type = "checkbox";
		cell0.appendChild(element0);

	var cell2 = row.insertCell(2);
	var element2 = document.createElement("div");
		element2.innerHTML = no_label;
		cell2.appendChild(element2);
	var element22 = document.createElement("input");
		element22.type = "hidden";
		element22.name = "nokantong[]";
		element22.value = no_label;
		cell2.appendChild(element22);

	var cell4 = row.insertCell(3);
	var element4 = document.createElement("div");
		element4.innerHTML = gol_darah + "("+rhesus_darah+")";
		cell4.appendChild(element4);
	var element41 = document.createElement("input");
		element41.type = "hidden";
		element41.name = "gol_donor[]";
		element41.value = gol_darah;
		cell4.appendChild(element41);
	var element42 = document.createElement("input");
		element42.type = "hidden";
		element42.name = "rh_donor[]";
		element42.value = rhesus_darah;
		cell4.appendChild(element42);

	var cell6 = row.insertCell(4);
	var element6 = document.createElement("select");
		element6.name = "cell1[]";
	var element60 = document.createElement("option");
		element60.value = "Neg";
		element60.innerHTML = "Neg";
		element6.appendChild(element60);
	var element61 = document.createElement("option");
		element61.value = "1+";
		element61.innerHTML = "1+";
		element6.appendChild(element61);
	var element62 = document.createElement("option");
		element62.value = "2+";
		element62.innerHTML = "2+";
		element6.appendChild(element62);
	var element63 = document.createElement("option");
		element63.value = "3+";
		element63.innerHTML = "3+";
		element6.appendChild(element63);
	var element64 = document.createElement("option");
		element64.value = "4+";
		element64.innerHTML = "4+";
		element6.appendChild(element64);
	cell6.appendChild(element6);

	var cell6 = row.insertCell(5);
	var element6 = document.createElement("select");
		element6.name = "cell2[]";
	var element60 = document.createElement("option");
		element60.value = "Neg";
		element60.innerHTML = "Neg";
		element6.appendChild(element60);
	var element61 = document.createElement("option");
		element61.value = "1+";
		element61.innerHTML = "1+";
		element6.appendChild(element61);
	var element62 = document.createElement("option");
		element62.value = "2+";
		element62.innerHTML = "2+";
		element6.appendChild(element62);
	var element63 = document.createElement("option");
		element63.value = "3+";
		element63.innerHTML = "3+";
		element6.appendChild(element63);
	var element64 = document.createElement("option");
		element64.value = "4+";
		element64.innerHTML = "4+";
		element6.appendChild(element64);
	cell6.appendChild(element6);
	clearForm();
}


function hapusbaris(tableID) {
	var txt;
	if (confirm("Hapus baris yang anda pilih?")) {
		try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[1].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
		}catch(e) {
			alert(e);
		}
	}
}

function formSubmit(){
	document.getElementById("tababs").submit();
}