var reagen_kode = [];
var reagen_nama = [];
var n_kt = [];
var jt0;
var jt_p0=0;
var jt1;
var jt_p1=0;
var jt2;
var jt_p2=0;
var jt3;
var jt_p3=0;
var cle;
var gol_darah0;
var rh_darah0;
var valid_darah0;
var nokantong;

function show11(){
    var campur = document.hasillab.reagen0.value;
    var jumtest = campur.split('*');
} 

function clearForm() {
	document.hasillab.nokantong.value="";
	//document.getElementById(nokantong).value="";
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

		var n=0;
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
            url: "json_gol_darah.php?NoKantong="+no_kantong,
            async: false,
            dataType: 'json',
            success: function(json) {
            gol_darah0 = json.darah.gol_darah;
            rh_darah0 = json.darah.RhesusDrh;
            valid_darah0 = json.darah.valid;
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
        jt_p0++;
        jt_p1++;
        jt_p2++;
        jt_p3++;
        document.hasillab.jumTest0.value=jt0-jt_p0;
        document.hasillab.jumTest1.value=jt1-jt_p1;
        document.hasillab.jumTest2.value=jt2-jt_p2;
        document.hasillab.jumTest3.value=jt3-jt_p3;
	nokantong=document.hasillab.nokantong.value;
        add(nokantong);
                focus(document.hasillab.nokantong);
	}
	} else {
                $( "#kantong_tdk_sesuai" ).dialog( "open" );
                return false;
	}
    }
}
function add(nokantong) {
	if (document.hasillab.jenis_tes0.value!=""){
        addRow('box-table-b0','jenis_tes0',nokantong);
	}
	if (document.hasillab.jenis_tes1.value!=""){
        addRow('box-table-b1','jenis_tes1',nokantong);
	}
	if (document.hasillab.jenis_tes2.value!=""){
        addRow('box-table-b2','jenis_tes2',nokantong);
	}
	if (document.hasillab.jenis_tes3.value!=""){
        addRow('box-table-b3','jenis_tes3',nokantong);
	}
	if (document.hasillab.jenis_tes0.value==""
		&& document.hasillab.jenis_tes1.value==""
		&& document.hasillab.jenis_tes2.value==""
		&& document.hasillab.jenis_tes3.value==""){
		n_kt = [];
		$( "#pilih_tes" ).dialog( "open" );
        //        $( "#kantong_tdk_sesuai" ).dialog( "open" );
		return false;
	} else {
		jum_kantong++;
		document.hasillab.jum_kantong.value=jum_kantong;
	}
}

		function addRow(tableID,jenistesID,nokantong) {
		var NoKantong = document.hasillab.nokantong.value;
			if (valid_darah0=='1') {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "no_kantong[]";
			element2.id = "no_kantong[]";
        	element2.value = nokantong;
			cell2.appendChild(element2);

			var cell3 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.name = "jenis_test[]";
			element3.id = "jenis_test[]";
			if (jenistesID == "jenis_tes0") element3.value = document.hasillab.jenis_tes0.value;
			if (jenistesID == "jenis_tes1") element3.value = document.hasillab.jenis_tes1.value;
			if (jenistesID == "jenis_tes2") element3.value = document.hasillab.jenis_tes2.value;
			if (jenistesID == "jenis_tes3") element3.value = document.hasillab.jenis_tes3.value;
			cell3.appendChild(element3);

			var cell4 = row.insertCell(3);
			var element3 = document.createElement("select");
			element3.name = "hasiltest[]";
			var element4 = document.createElement("option");
			element4.value = "0";
			element4.innerHTML = "Non Reaktif";
			element3.appendChild(element4);
			var element5 = document.createElement("option");
			element5.value = "1";
			element5.innerHTML = "Reaktif";
			element3.appendChild(element5);
			cell4.appendChild(element3);
		  		
			var cell5 = row.insertCell(4);
			var element3 = document.createElement("select");
			element3.name = "gol_darah[]";
			element3.id = "gol_darah[]";
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
			cell5.appendChild(element3);
			
			var cell6 = row.insertCell(5);
			var element3 = document.createElement("select");
			element3.name = "RhesusDrh[]";
			element3.id = "RhesusDrh[]";
			var element4 = document.createElement("option");
			element4.value = "+";
			if (rh_darah0=='+') {element4.selected ="selected";}
			element4.innerHTML = "+";
			element3.appendChild(element4);
			var element4 = document.createElement("option");
			element4.value = "-";
			if (rh_darah0=='-') {element4.selected ="selected";}
			element4.innerHTML = "-";
			element3.appendChild(element4);
			cell6.appendChild(element3);
			
			//clearForm();
			}

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
		function formSubmit()
		{
			document.getElementById("dtable").submit();
		}

/*
function check2(NoKantong)
  {
    $.ajax({
        url: "json_gol_darah.php?NoKantong="+NoKantong,
        async: false,
        dataType: 'json',
        success: function(json) {
	gol_darah0 = json.darah.gol_darah;
	rh_darah0 = json.darah.RhesusDrh;
	valid_darah0 = json.darah.valid;
        }
    });
}*/
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
