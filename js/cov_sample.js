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
var gol_darah;
var rhesus_darah;

function cari_kantong(tableID)
  {
	var abo;
	var rh;
	var no_label = document.kantong.nokantong.value;
		no_label = no_label.toUpperCase();
		$.ajax({
        url: "cek_sampel_darah.php?no_label="+no_label,
        async: false,
        dataType: 'json',
        success: function(json) {
			no_label1 = json.kantong.nokantong;
			gol_darah = json.kantong.gol_darah;
			rhesus_darah = json.kantong.rhesus;
					}	
    });
	if (no_label1!=''){
		addRow(tableID,no_label,gol_darah,rhesus_darah);
	} else {
		clearForm();	
		alert('Format kode sampel yang anda masukkan SALAH!!, Golongan Darah ABO tidak terdefinisikan');
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
					element1.style.textAlign = "center"; 
			        element1.innerHTML = rowCount;
			    cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			    var element2 = document.createElement("div");
			        element2.innerHTML = no_label;
			    cell2.appendChild(element2);
			    var element22 = document.createElement("input");
			        element22.type = "hidden";
			        element22.name = "nokantong[]";
			        element22.value = no_label;
			    cell2.appendChild(element22);
			
			var cell3 = row.insertCell(2);
                	var element3 = document.createElement("select");
					element3.name = "vol[]";
					
					var element31 = document.createElement("option");
						element31.value = "1";
						element31.innerHTML = "Baik/Cukup";
						element3.appendChild(element31);
					var element32 = document.createElement("option");
						element32.value = "0";
						element32.innerHTML = "Rusak/Lysis";
						element3.appendChild(element32);

                    				cell3.appendChild(element3);
			
			var cell4 = row.insertCell(3);
				var element4 = document.createElement("div");
					element4.style.textAlign = "center"; 
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

			var cell5 = row.insertCell(4);
			    var element5 = document.createElement("input");
                    		element5.type = "text";
				element5.name = "titer[]";
                    		cell5.appendChild(element5);
            
            		var cell6 = row.insertCell(5);
                	var element6 = document.createElement("select");
					element6.name = "hasil[]";
					var element61 = document.createElement("option");
						element61.value = "-";
						element61.innerHTML = "Pilih Hasil";
						element6.appendChild(element61);
					var element62 = document.createElement("option");
						element62.value = "0";
						element62.innerHTML = "Tidak Lulus";
						element6.appendChild(element62);
					var element62 = document.createElement("option");
						element62.value = "1";
						element62.innerHTML = "Lulus";
						element6.appendChild(element62);

                    				cell6.appendChild(element6);
		
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
function formSubmit(){
	document.getElementById("dtable").submit();
}

function pdf1(nokantong1,ck) {
var http = new XMLHttpRequest();
var url = "bkantong.php";
var params = "nk="+nokantong1+"&ck="+ck;
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
function printfile(nokantong2,ck)
{
    $.fn
	.colorbox({href:'bkantong.php?nk='+nokantong2+'&ck='+ck,
	iframe:true, innerWidth:350, innerHeight:350});            
}
