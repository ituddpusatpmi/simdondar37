var reagen_kode = [];
var reagen_nama = [];
var n_kt = [];
var jt0;
var jt1;
var jt2;
var jt3;
var cle;
var gol_darah0;
var rh_darah0;
var valid_darah0;
var n=0;
var id_row0=0;
var id_row1=0;
var id_row2=0;
var id_row3=0;
var jum_kantong=0;

function ok() {
    if(cle != '13') return true;
    else return false;
}

function clearForm() {
	document.hasillab.nokantong.value="";
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

function chang(Event,quoi) {
    detect(Event);
    setTimeout('cle=""',100);
    if(cle=='13')
        while(quoi!=null) {
            quoi = quoi.nextSibling;
            if(quoi.tagName=='INPUT') {
                //quoi.focus(nokantong);
                focus(document.hasillab.nokantong);
                quoi=null;
            }
        }
}


function check2() {
    valid_darah0 = '0';
	//alert(document.hasillab.reagen0.value);
	if ((document.hasillab.reagen0.value=="" && document.hasillab.jenis_tes0.value=="HBsAg")
        || (document.hasillab.reagen1.value=="" && document.hasillab.jenis_tes1.value=="HCV")
        || (document.hasillab.reagen2.value=="" && document.hasillab.jenis_tes2.value=="HIV")
        || (document.hasillab.reagen3.value=="" && document.hasillab.jenis_tes3.value=="Syp")) {
		$( "#pilih_reagen" ).dialog( "open" );
		return false;
	} else if((document.hasillab.co0.value=='' && document.hasillab.jenis_tes0.value=="HBsAg")
			  || (document.hasillab.co1.value=='' && document.hasillab.jenis_tes1.value=="HCV")
			  || (document.hasillab.co2.value=='' && document.hasillab.jenis_tes2.value=="HIV")
			  || (document.hasillab.co3.value=='' && document.hasillab.jenis_tes3.value=="Syp")){
		$( "#pilih_reagen" ).dialog( "open" );
		return false;
	} else {
        var no_kantong = document.hasillab.nokantong.value;
        $.ajax({
            url: "json_update_elisa.php?NoKantong="+no_kantong,
            async: false,
            dataType: 'json',
            success: function(json) {
				valid_darah0 = json.darah.valid;
				gol_darah0 = json.darah.gol;
				rh_darah0 = json.darah.rh;
			}
		});
		if (valid_darah0=='1'){
			if ((document.hasillab.jt0.value==0 && document.hasillab.jenis_tes0.value=="HBsAg")
				|| (document.hasillab.jt1.value==0 && document.hasillab.jenis_tes1.value=="HCV")
				|| (document.hasillab.jt2.value==0 && document.hasillab.jenis_tes2.value=="HIV")
				|| (document.hasillab.jt3.value==0 && document.hasillab.jenis_tes3.value=="Syp")) {
				$( "#ganti_reagen" ).dialog( "open" );
				return false;
		} else {
			var i;
			n++;
			for(i=0; i<=n; i++){
				if (n_kt[i]==document.hasillab.nokantong.value){
					$( "#kantong_sudah_diinput" ).dialog( "open" );
					return false;
				}
			}
			n_kt.push(document.hasillab.nokantong.value);
			jt0=document.hasillab.jt0.value;
			jt1=document.hasillab.jt1.value;
			jt2=document.hasillab.jt2.value;
			jt3=document.hasillab.jt3.value;
			//alert ('JT0: '+jt0+' JT1: '+jt1+' JT2: '+jt2+'JT3: '+jt3);
			if (document.hasillab.jenis_tes0.value=="HBsAg" && document.hasillab.reagen0.value!="") document.hasillab.jt0.value=jt0-1;
			if (document.hasillab.jenis_tes1.value=="HCV" && document.hasillab.reagen1.value!="") document.hasillab.jt1.value=jt1-1;
			if (document.hasillab.jenis_tes2.value=="HIV" && document.hasillab.reagen2.value!="") document.hasillab.jt2.value=jt2-1;
			if (document.hasillab.jenis_tes3.value=="Syp" && document.hasillab.reagen3.value!="") document.hasillab.jt3.value=jt3-1;
			if (jt0>0) document.getElementById('jt01').innerHTML ="JT("+document.hasillab.jt0.value+")";
			if (jt1>0) document.getElementById('jt11').innerHTML ="JT("+document.hasillab.jt1.value+")";
			if (jt2>0) document.getElementById('jt21').innerHTML ="JT("+document.hasillab.jt2.value+")";
			if (jt3>0) document.getElementById('jt31').innerHTML ="JT("+document.hasillab.jt3.value+")";
			add();
		}
		} else if (valid_darah0=='2') {
                $( "#kantong_rapid" ).dialog( "open" );
                return false;
		} else {
                $( "#kantong_belum_ditest" ).dialog( "open" );
                return false;
		}
	}
}

function add() {
	if (document.hasillab.jenis_tes0.value!=""){
		addRow('box-table-b0','jenis_tes0','0');
	}
	if (document.hasillab.jenis_tes1.value!=""){
		addRow('box-table-b1','jenis_tes1','1');
	}
	if (document.hasillab.jenis_tes2.value!=""){
		addRow('box-table-b2','jenis_tes2','2');
	}
	if (document.hasillab.jenis_tes3.value!=""){
		addRow('box-table-b3','jenis_tes3','3');
	}
	if (document.hasillab.jenis_tes0.value==""
		&& document.hasillab.jenis_tes1.value==""
		&& document.hasillab.jenis_tes2.value==""
		&& document.hasillab.jenis_tes3.value==""){
		n_kt = [];
		$( "#pilih_tes" ).dialog( "open" );
		return false;
	} 
		else {
		jum_kantong++;
		document.hasillab.jum_kantong.value=jum_kantong;
	}
	//	clearForm();
}

function hasil_test(){
	var jum_od=0;
	id_od=this.id;
	id_hs = id_od.replace('od','hs','gi');
	id_test = "jenis_tes"+id_od.substr(11,1);
	id_co = "co"+id_od.substr(11,1);
	id_reaktif = "r"+id_od.substr(11,1);
	id_nonreaktif = "nr"+id_od.substr(11,1);
	id_greyzone = "gz"+id_od.substr(11,1);
	id_print_hs = id_od.replace('od','print_hs','gi');
	val_od = this.value;
	
	//val_test = document.getElementById(id_test).value;
	val_test=$("#"+id_test).val();
	//alert(val_test);
	val_co = document.getElementById(id_co).value;
	val_reaktif = document.getElementById(id_reaktif).value;
	val_nonreaktif = document.getElementById(id_nonreaktif).value;
	val_greyzone = document.getElementById(id_greyzone).value;
	
	od_fixed=val_od.replace(",", ".");
	jum_od=jum_od+od_fixed;
	co_fixed=val_co.replace(",", ".");
	ratio=od_fixed;
	if (co_fixed>0) ratio=od_fixed/co_fixed;
	if(ratio<(val_nonreaktif)){
		hasil='Non reaktif';
		val_hasil=0;
	}
	if (val_greyzone>0) {
		if(ratio>=val_greyzone){
			hasil='Grey Zone'
			val_hasil=2;
		}
	}
	if(ratio>=(val_reaktif)){
		hasil='Reaktif'
		val_hasil=1;
		}
	ratio=roundNumber(ratio, 2);
				   
	document.getElementById(id_hs).value=val_hasil;
	document.getElementById(id_print_hs).innerHTML=hasil;
	
}

function addRow(tableID,jenistesID,id_row) {
	if(id_row==0){
		id_row=id_row0++;
	}else if(id_row==1){
		id_row=id_row1++;
	}else if(id_row==2){
		id_row=id_row2++;
	}else{id_row=id_row3++;}
	
	var NoKantong = document.hasillab.nokantong.value;
	var table = document.getElementById(tableID);

	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var cell1 = row.insertCell(0);
	var element1 = document.createElement("div");
	element1.innerHTML = jum_kantong+1;
	cell1.appendChild(element1);

	var cell2 = row.insertCell(1);
	var element2 = document.createElement("input");
	element2.type = "hidden";
	element2.name = tableID+"no_kantong"+id_row;
	element2.id = tableID+"no_kantong"+id_row;
	element2.value = document.hasillab.nokantong.value;
	cell1.appendChild(element2);

	var element3 = document.createElement("p");
	element3.innerHTML = document.hasillab.nokantong.value;
	cell2.appendChild(element3);
			
	var element4 = document.createElement("input");
	element4.type = "hidden";
	element4.name = tableID+"jenis_test"+id_row;
	element4.id = tableID+"jenis_test"+id_row;
	if (jenistesID == "jenis_tes0") element4.value = document.hasillab.jenis_tes0.value;
	if (jenistesID == "jenis_tes1") element4.value = document.hasillab.jenis_tes1.value;
	if (jenistesID == "jenis_tes2") element4.value = document.hasillab.jenis_tes2.value;
	if (jenistesID == "jenis_tes3") element4.value = document.hasillab.jenis_tes3.value;
	cell1.appendChild(element4);
	
	var cell3 = row.insertCell(2);
	var element5 = document.createElement("p");
	element5.innerHTML = gol_darah0+'('+rh_darah0+')';
	cell3.appendChild(element5);
	
	var element6 = document.createElement("input");
	element6.type = "hidden";
	element6.name = tableID+"gol_darah"+id_row;
	element6.id = tableID+"gol_darah"+id_row;
	element6.value = gol_darah0;
	cell1.appendChild(element6);
	var element7 = document.createElement("input");
	element7.name = tableID+"RhesusDrh"+id_row;
	element7.id = tableID+"RhesusDrh"+id_row;
	element7.type = "hidden";
	element7.value = rh_darah0;
	cell1.appendChild(element7);
	
	var cell4 = row.insertCell(3);
	var element8 = document.createElement("input");
	element8.type = "text";
	element8.style.width = "70";
	element8.name = tableID+"od"+id_row;
	element8.id = tableID+"od"+id_row;
	element8.value = '';
	element8.onkeyup =hasil_test;
	cell4.appendChild(element8);
	
	var cell5 = row.insertCell(4);
	var element9 = document.createElement("input");
	element9.type = "hidden";
	element9.style.width = "70";
	element9.name = tableID+"hs"+id_row;
	element9.id = tableID+"hs"+id_row;
	element9.value = '';
	cell5.appendChild(element9);
	
	var element10 = document.createElement("div");
	element10.innerHTML = '';
	element10.id = tableID+"print_hs"+id_row;
	cell5.appendChild(element10);
	
    //if(Event.keyCode != '13') return true;
    //else return false;
}

function deleteRow(tableID) {
	try {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;

		for(var i=0; i<rowCount; i++) {
			var row = table.rows[i];
			var chkbox = row.cells[0].childNodes[0];
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

function formSubmit() {
			document.getElementById("dtable").submit();
}
		
function hasil(test){
	alert(test);
}

function isiReagen(jenistesID) {
	if (jenistesID == "jenis_tes0") var jenistest = document.hasillab.jenis_tes0.value;
	if (jenistesID == "jenis_tes1") var jenistest = document.hasillab.jenis_tes1.value;
	if (jenistesID == "jenis_tes2") var jenistest = document.hasillab.jenis_tes2.value;
	if (jenistesID == "jenis_tes3") var jenistest = document.hasillab.jenis_tes3.value;
	var reagen1 = carireagen(jenistest);
	if (jenistesID == "jenis_tes0")  ClearOptions(document.hasillab.reagen0);
	if (jenistesID == "jenis_tes1")  ClearOptions(document.hasillab.reagen1);
	if (jenistesID == "jenis_tes2")  ClearOptions(document.hasillab.reagen2);
	if (jenistesID == "jenis_tes3")  ClearOptions(document.hasillab.reagen3);
	
	for (i=0; i<reagen_kode.length; i++) {
        if (jenistesID == "jenis_tes0") AddToOptionList(document.hasillab.reagen0, reagen_kode[i], reagen_nama[i]+"-"+reagen_kode[i]);
        if (jenistesID == "jenis_tes1") AddToOptionList(document.hasillab.reagen1, reagen_kode[i], reagen_nama[i]+"-"+reagen_kode[i]);
        if (jenistesID == "jenis_tes2") AddToOptionList(document.hasillab.reagen2, reagen_kode[i], reagen_nama[i]+"-"+reagen_kode[i]);
        if (jenistesID == "jenis_tes3") AddToOptionList(document.hasillab.reagen3, reagen_kode[i], reagen_nama[i]+"-"+reagen_kode[i]);
     }
}
function ClearOptions(OptionList) {
    // Always clear an option list from the last entry to the first
    for (x = OptionList.length; x >= 0; x = x - 1) {
       OptionList[x] = null;
    }
 }
function AddToOptionList(OptionList, OptionValue, OptionText) {
    OptionList[OptionList.length] = new Option(OptionText, OptionValue);
 }
function carireagen(jenistest){
    $.ajax({
        url: "json_reagen.php?jenistest="+jenistest,
        async: false,
        dataType: 'json',
        success: function(json) {
			reagen_kode.length=0;
			reagen_nama.length=0;
			jQuery.each(json.reagen,function(i,reagen){
				reagen_kode.push(reagen.kode);
				reagen_nama.push(reagen.nama);
			});
        }
    });
}
  
