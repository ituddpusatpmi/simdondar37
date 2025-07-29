function clearForm() {
        document.komponen.nokantong.value="";
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
                quoi.focus(nokantong);
                quoi=null;
                }

 }
}
 function ok() {
 if(cle != '13') return true;
 else return false;
 }
var jenis_kantong0;
var valid_kantong0;
		function addRow(tableID) {
			var NoKantong = document.komponen.nokantong.value;
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

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "no_kantong[]";
			//element2.value = document.komponen.nokantong.value;
			element2.value = NoKantong1; 
			cell2.appendChild(element2);

			var cell3 = row.insertCell(2);
			var element3 = document.createElement("select");
			element3.name = "jeniskomponen[]";
			var element4 = document.createElement("option");
			element4.value = "PRC";
			if (i=="0") element4.selected = true;
			element4.innerHTML = "PRC";
			element3.appendChild(element4);
			var element5 = document.createElement("option");
			element5.value = "PLASMA";
			if (i=="1") element5.selected = true;
			element5.innerHTML = "PLASMA";
			element3.appendChild(element5);
			var element6 = document.createElement("option");
			element6.value = "TC";
			if (i=="2") element6.selected = true;
			element6.innerHTML = "TC";
			element3.appendChild(element6);
			cell3.appendChild(element3);
			var cell4 = row.insertCell(3);
			var element4 = document.createElement("select");
			element4.name = "musnahkan[]";
			var element5 = document.createElement("option");
			element5.value = "0";
			element5.selected = true;
			element5.innerHTML = "Tidak";
			element4.appendChild(element5);
			var element6 = document.createElement("option");
			element6.value = "1";
			element6.selected = false;
			element6.innerHTML = "Ya";
			element4.appendChild(element6);
			cell4.appendChild(element4);
			}
			} else {
			//alert('Kantong Belum terdaftar atau mungkin Single'); 
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
	jenis_kantong0 = json.darah.gol_darah;
	valid_kantong0 = json.darah.valid;
        }
    });
}
