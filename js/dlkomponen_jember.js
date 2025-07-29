function clearForm() {
        document.komponen.nokantong.value="";
	//document.getElementById('nokantong').focus();
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
 function chang(Event,quoi) {
 detect(Event);
 setTimeout('cle=""',100);
 if(cle=='13')
  while(quoi!=null)
        {
        quoi = quoi.nextSibling;
        if(quoi.tagName=='INPUT')
                {
                quoi.focus(document.komponen.nokantong);
                quoi=null;
                }

 }
}
 function ok() {
	document.getElementById('nokantong').focus();
 if(cle != '13') return true;
 else return false;
 }
var row_id;
$(function(){
$('tr').click(function(){
        alert(this.rowIndex);
});
});
 function kadaluwarsa1(rc) {
jkomp=$("#0jeniskomponen"+rc).val();
//alert('jkomp');
tgl0 = Date.parse(tgl_aftap0).add(35).days();
if (jkomp=='TC') tgl0 = Date.parse(tgl_aftap0).add(5).days(); 
if (jkomp=='FFP') tgl0 = Date.parse(tgl_aftap0).add(1).years(); 
if (jkomp=='WE') tgl0 = Date.today().setTimeToNow().add(5).hours(); 
//if (rc=='3') tgl0 = Date.today().add(5).days(); 
tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
	$("#0kadaluwarsa"+rc).val(tgl1);
	//$("#1kadaluwarsa"+rc).html(tgl1);
}
var jenis_kantong0;
var gol_darah0;
var rhs_darah0;
var tgl_aftap0;
var valid_kantong0;
		function addRow(tableID) {
			var NoKantong = document.komponen.nokantong.value;
				NoKantong=NoKantong.toUpperCase();
			var lkantong = NoKantong.length-1;
			jenis_kantong0 = "";
			valid_kantong0 = "";
			var jkantong = check3(NoKantong);
			var table = document.getElementById(tableID);
			if (valid_kantong0 == "1") {
			for (var i=0; i<jenis_kantong0; i++) {
			if (i=="0") var NoKantong1 = NoKantong.substring(0,lkantong)+"A";
			if (i=="1") var NoKantong1 = NoKantong.substring(0,lkantong)+"B";
			if (i=="2") var NoKantong1 = NoKantong.substring(0,lkantong)+"C";
			if (i=="3") var NoKantong1 = NoKantong.substring(0,lkantong)+"D";
			if (i=="4") var NoKantong1 = NoKantong.substring(0,lkantong)+"E";
			if (i=="5") var NoKantong1 = NoKantong.substring(0,lkantong)+"F";
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);


			var cell2 = row.insertCell(0);
			var element12 = document.createElement("input");
			element12.type = "hidden";
			element12.name = "no_kantong[]";
			element12.value = NoKantong1; 
			cell2.appendChild(element12);
			var element2 = document.createElement("p");
			element2.innerHTML = NoKantong1; 
			cell2.appendChild(element2);
			
			var cell3 = row.insertCell(1);
			var element3 = document.createElement("p");
			element3.innerHTML = tgl_aftap0; 
			cell3.appendChild(element3);
			
			var cell4 = row.insertCell(2);
			var element4 = document.createElement("p");
			element4.innerHTML = gol_darah0+'('+rhs_darah0+')'; 
			cell4.appendChild(element4);
			

			var cell5 = row.insertCell(3);
/*
			var element6 = document.createElement("div");
			element6.innerHTML = '-'; 
			element6.id = "1kadaluwarsa"+rowCount;
			cell5.appendChild(element6);
*/
			var element61 = document.createElement("input");
			element61.type = "text";
			element61.name = "kadaluwarsa[]";
			element61.id = "0kadaluwarsa"+rowCount;
			element61.value = ''; 
			cell5.appendChild(element61);

			var cell6 = row.insertCell(4);
			var element5 = document.createElement("select");
			element5.name = "jeniskomponen[]";
			element5.id = "0jeniskomponen"+rowCount;
			element5.onChange = kadaluwarsa1(rowCount);
			if (i=="0") {
/*
			var element50 = document.createElement("option");
			element50.value = "WB";
			element50.innerHTML = "WB";
			element5.appendChild(element50);
*/
			var element51 = document.createElement("option");
			element51.value = "PRC";
			element51.innerHTML = "PRC";
			element5.appendChild(element51);
			var element55 = document.createElement("option");
			element55.value = "WE";
			element55.innerHTML = "WE";
			element5.appendChild(element55);
			}
			if (jenis_kantong0=="3") {
			if (i=="2") {
			var element52 = document.createElement("option");
			element52.value = "LP";
			element52.innerHTML = "LP";
			element5.appendChild(element52);
			var element54 = document.createElement("option");
			element54.value = "FP";
			element54.innerHTML = "FP";
			element5.appendChild(element54);
			var element541 = document.createElement("option");
			element541.value = "FFP";
			element541.innerHTML = "FFP";
			element5.appendChild(element541);
			}
			if (i=="1") {
			var element53 = document.createElement("option");
			element53.value = "TC";
			element53.innerHTML = "TC";
			element5.appendChild(element53);
			}
			} 
			if (jenis_kantong0=="2") {
			if (i=="1") {
			var element52 = document.createElement("option");
			element52.value = "LP";
			element52.innerHTML = "LP";
			element5.appendChild(element52);
			var element54 = document.createElement("option");
			element54.value = "FP";
			element54.innerHTML = "FP";
			element5.appendChild(element54);
			var element541 = document.createElement("option");
			element541.value = "FFP";
			element541.innerHTML = "FFP";
			element5.appendChild(element541);
			}
			} 
			cell6.appendChild(element5);
			
			var cell61 = row.insertCell(5);
			var element12 = document.createElement("input");
			element12.name = "vlm[]";
			element12.size = "4";
			cell61.appendChild(element12);


			var cell7 = row.insertCell(6);
			var element7 = document.createElement("select");
			element7.name = "musnahkan[]";
			var element71 = document.createElement("option");
			element71.value = "0";
			element71.innerHTML = "Tidak";
			element7.appendChild(element71);
			var element72 = document.createElement("option");
			element72.value = "1";
			element72.innerHTML = "Ya";
			element7.appendChild(element72);
			cell7.appendChild(element7);
			}
			} else {
			//alert('Kantong Belum terdaftar atau mungkin Single'); 
			$( "#kantong_tdk_sesuai" ).dialog( "open" );
                          clearForm();
                  return false;
			}
			clearForm();

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

function check3(NoKantong)
  {
    $.ajax({
        url: "json_jenis_kantong.php?NoKantong="+NoKantong,
        async: false,
        dataType: 'json',
        success: function(json) {
	jenis_kantong0 = json.darah.jenis_kantong;
	gol_darah0 = json.darah.gol_darah;
	rhs_darah0 = json.darah.rhs_darah;
	tgl_aftap0 = json.darah.tgl_aftap;
	valid_kantong0 = json.darah.valid;
        }
    });
}
