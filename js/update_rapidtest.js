/*
03-05-11 devit -> hasil tes diubah 0=reaktif, 1=nonreaktif 
11-05-11 devit -> simplified, update stock 
 
*/
var reagen_kode = [];
var reagen_nama = [];
var jt0;
var jt_p0=0;
var jt1;
var jt_p1=0;
var jt2;
var jt_p2=0;
var jt3;
var jt_p3=0;
var cle;

function show11(){
    var campur = document.hasillab.reagen0.value;
    var jumtest = campur.split('*');
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

function ok() {
    if(cle != '13') return true;
    else return false;
}

function setFocus(){document.hasillab.nokantong;}

//------------------------------- cek form -----------------------------------//
var n=0;
var gol_darah0;
var rh_darah0;
var valid_darah0;
//var no_kantong;
function check2() {
    valid_darah0 = '0';
	if ((document.hasillab.reagen0.value=="" && document.hasillab.jenis_tes0.value=="HBsAg")
        || (document.hasillab.reagen1.value=="" && document.hasillab.jenis_tes1.value=="HCV")
        || (document.hasillab.reagen2.value=="" && document.hasillab.jenis_tes2.value=="HIV")
        || (document.hasillab.reagen3.value=="" && document.hasillab.jenis_tes3.value=="Syp")) {
		//alert(document.hasillab.jenis_tes0.value);
        $( "#pilih_reagen" ).dialog( "open" );
		return false;
	} else {
        var no_kantong = document.hasillab.nokantong.value;
        $.ajax({
            url: "json_update_rapidtest.php?NoKantong="+no_kantong,
            async: false,
            dataType: 'json',
            success: function(json) {
				valid_darah0 = json.darah.valid;
				gol_darah0 = json.darah.gol;
				rh_darah0 = json.darah.rh;
			}
		});
		if (valid_darah0=='1'){
			if ((document.hasillab.jumTest0.value==0 && document.hasillab.jenis_tes0.value=="HBsAg")
				|| (document.hasillab.jumTest1.value==0 && document.hasillab.jenis_tes0.value=="HCV")
				|| (document.hasillab.jumTest2.value==0 && document.hasillab.jenis_tes0.value=="HIV")
				|| (document.hasillab.jumTest3.value==0 && document.hasillab.jenis_tes0.value=="Syp")) {
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
				jt_p0++; jt_p1++; jt_p2++; jt_p3++;
				document.hasillab.jumTest0.value=jt0-jt_p0;
				document.hasillab.jumTest1.value=jt1-jt_p1;
				document.hasillab.jumTest2.value=jt2-jt_p2;
				document.hasillab.jumTest3.value=jt3-jt_p3;
				no_kantong=document.hasillab.nokantong.value;
				add(no_kantong);
				setFocus();
			}
		} else if (valid_darah0=='2') {
			$( "#kantong_elisa" ).dialog( "open" );
			return false;
		} else {
			$( "#kantong_belum_ditest" ).dialog( "open" );
			return false;
		}
    }
}
//------------------------------- End cek form -------------------------------//

//------------------------------- Tambahakan Kantong -------------------------//
var jum_kantong=0;
var n_kt = [];
function add(no_kantong) {
	jum_kantong=jum_kantong+1;
	//alert(jum_kantong);
	row=jum_kantong-1;
	document.hasillab.jum_kantong.value=jum_kantong;
	
	if (document.hasillab.jenis_tes0.value!=""){
        addRow('box-table-b0','jenis_tes0',no_kantong,row);
	}
	if (document.hasillab.jenis_tes1.value!=""){
        addRow('box-table-b1','jenis_tes1',no_kantong,row);
	}
	if (document.hasillab.jenis_tes2.value!=""){
        addRow('box-table-b2','jenis_tes2',no_kantong,row);
	}
	if (document.hasillab.jenis_tes3.value!=""){
        addRow('box-table-b3','jenis_tes3',no_kantong,row);
	}
	if (document.hasillab.jenis_tes0.value==""
		&& document.hasillab.jenis_tes1.value==""
		&& document.hasillab.jenis_tes2.value==""
		&& document.hasillab.jenis_tes3.value==""){
		n_kt = [];
		$( "#pilih_tes" ).dialog( "open" );
		return false;
	}
}
//----------------------------- End Tambahakan Kantong -----------------------//

//----------------------------- Tambah baris ---------------------------------//
function addRow(tableID,jenistesID,no_kantong,id_row) {
	if (valid_darah0=='1') {
		var table = document.getElementById(tableID);

		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);
			
		var cell1 = row.insertCell(0);
		var element1 = document.createElement("div");
		element1.innerHTML = no_kantong;
		cell1.appendChild(element1);
			
		var element2 = document.createElement("input");
		element2.type = "hidden";
		element2.name = tableID+"no_kantong"+id_row;
		element2.id = tableID+"no_kantong"+id_row;
        element2.value = no_kantong;
		cell1.appendChild(element2);
			
		var element3 = document.createElement("input");
		element3.type = "hidden";
		element3.name = tableID+"jenis_test"+id_row;
		element3.id = tableID+"jenis_test"+id_row;
		switch (jenistesID){
			case "jenis_tes0":	
				element3.value = "HBsAg";
				break;
			case "jenis_tes1":	
				element3.value = "HCV";
				break;
			case "jenis_tes2":	
				element3.value = "HIV";
				break;
			default:			
				element3.value = "Syp";
		}
		cell1.appendChild(element3);

		var cell3 = row.insertCell(1);
		var element7 = document.createElement("div");
		element7.innerHTML = gol_darah0+'('+rh_darah0+')';
		cell3.appendChild(element7);
			
		var el_gol = document.createElement("input");
		el_gol.type = "hidden";
		el_gol.name = tableID+"gol_darah"+id_row;
		el_gol.id = tableID+"gol_darah"+id_row;
		el_gol.value = gol_darah0;
		cell3.appendChild(el_gol);
		var el_rh = document.createElement("input");
		el_rh.name = tableID+"RhesusDrh"+id_row;
		el_rh.id = tableID+"RhesusDrh"+id_row;
		el_rh.type = "hidden";
		el_rh.value = rh_darah0;
		cell3.appendChild(el_rh);
			
		var cell2 = row.insertCell(2);
		var element4 = document.createElement("select");
		element4.name = tableID+"hasiltest"+id_row;
			
		var element5 = document.createElement("option");
		element5.value = "1";
		element5.innerHTML = "Non Reaktif";
		element4.appendChild(element5);
			
		var element6 = document.createElement("option");
		element6.value = "0";
		element6.innerHTML = "Reaktif";
		element4.appendChild(element6);
		cell2.appendChild(element4);
		//ok();		
		//clearForm();
	}
}
//----------------------------- Tambah baris ---------------------------------//

function formSubmit(){
	document.getElementById("dtable").submit();
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
 
function carireagen(jenistest)
  {
    $.ajax({
        url: "json_reagen_rapid.php?jenistest="+jenistest,
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
