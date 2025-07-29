var nokantong1;
function clearForm() {
	document.tambahkantong.nokantong.value="";
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

		function addRow(tableID) {
		var jenis_kantong = document.tambahkantong.jenis.value;
		var nokantong = document.tambahkantong.nokantong.value;
		var nokantong2=nokantong+","+jenis_kantong;	
		printfile(nokantong2);
		for (i=0; i < jenis_kantong; i++) {
		if (i==0) nokantongf=nokantong+"A";
		if (i==1) nokantongf=nokantong+"B";
		if (i==2) nokantongf=nokantong+"C";
		if (i==3) nokantongf=nokantong+"D";
		if (i==4) nokantongf=nokantong+"E";
		if (i==5) nokantongf=nokantong+"F";
		
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell0 = row.insertCell(0);
			var element0 = document.createElement("input");
			element0.type = "checkbox";
			cell0.appendChild(element0);
			var cell1 = row.insertCell(1);
			var element1 = document.createElement("input");
			element1.type = "text";
			element1.size = "3";
			element1.value = rowCount;
			element1.innerHtml = rowCount;
			cell1.appendChild(element1);

			var cell2 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.size = "12";
			element2.value = nokantongf;
			element2.innerHtml = nokantongf;
			element2.name = "no_kantong[]";
			cell2.appendChild(element2);

			var cell3 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.size = "6";
            		element3.name = "volume1[]";
			element3.value = document.tambahkantong.volume.value;
			element3.innerHtml = document.tambahkantong.volume.value;
			cell3.appendChild(element3);

            		var cell4 = row.insertCell(4);
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.size = "12";
			element4.name = "merk1[]";
			element4.value = document.tambahkantong.merk.value;
			element4.innerHtml = document.tambahkantong.merk.value;
			cell4.appendChild(element4);

            		var cell5 = row.insertCell(5);
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.size = "12";
			element4.name = "jenis1[]";
			element4.value = document.tambahkantong.jenis.value;
			element4.innerHtml = document.tambahkantong.jenis.value;
			cell5.appendChild(element4);
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
function pdf1(nokantong1) {
var http = new XMLHttpRequest();
var url = "bkantong.php";
var params = "nk="+nokantong1;
http.open("GET", url+"?"+params, true);
http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4 && http.status == 200) {
		//alert(http.responseText);
		objAdobePrint.document.location.reload();
		setTimeout("printfile()",1000);
	}
}
http.send(null);
}
function printfile(nokantong2)
{
    $.fn.colorbox({href:'bkantong.php?nk='+nokantong2, 
	iframe:true, innerWidth:350, innerHeight:350});            
}
