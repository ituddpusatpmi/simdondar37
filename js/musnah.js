var nokantong1;
var alasanHTML;
function clearForm() {
	document.musnah.NoKantong.value="";
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
var nama_pendonor;
var kode_pendonor;

// Cek no kantong di stokkantong
function cari_kantong(tableID)
  {
	var no_label = document.musnah.NoKantong.value;
	var alasan = document.musnah.alasan.value;
		no_label = no_label.toUpperCase();
    $.ajax({
        url: "cek_kantong_darah.php?no_label="+no_label,
        async: false,
        dataType: 'json',
        success: function(json) {
			no_label1 = json.kantong.nokantong;
			gol_darah = json.kantong.gol_darah;
			rhesus_darah = json.kantong.rhesus;
			nama_pendonor = json.kantong.nama;
			kode_pendonor = json.kantong.kode;
		}	
    });
	if (no_label1!=''){
		addRow(tableID,no_label,gol_darah,rhesus_darah,alasan);
	} else {
			clearForm();	
		//alert('Kantong Belum Berisi darah atau belum terdaftar!!!');
	}
}
  
 function ok() {
 if(cle != '13') return true;
 else return false;
 }

		function addRow(tableID,no_label,gol_darah,rhesus_darah,alasan) {
	if (alasan=='0') alasanHTML='Gagal Aftap';
	if (alasan=='4') alasanHTML='Reaktif Dibuang';
	if (alasan=='1') alasanHTML='Lisis';
	if (alasan=='11') alasanHTML='Reaktif Rujuk KeUDDP';
	if (alasan=='2') alasanHTML='Kadaluarsa';
	if (alasan=='3') alasanHTML='Plebotomi';
	if (alasan=='5') alasanHTML='Lifemik';
	if (alasan=='6') alasanHTML='Greyzone';
	if (alasan=='7') alasanHTML='DCT Positif';
	if (alasan=='8') alasanHTML='Kantong Bocor';
	if (alasan=='9') alasanHTML='Satelit Rusak';
	if (alasan=='10') alasanHTML='Bekas WE';
	if (alasan=='12') alasanHTML='Hematokrit Tinggi';
	if (alasan=='13') alasanHTML='Limbah Sisa PRC';


		
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			cell1.class = 'input';
			var element1 = document.createElement("div");
			element1.innerHTML = rowCount;
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			cell2.class = 'input';
			var element2 = document.createElement("div");
			element2.innerHTML = no_label;
			cell2.appendChild(element2);
			var element22 = document.createElement("input");
			element22.type = "hidden";
			element22.name = "nokantongmusnah[]";
			element22.value = no_label;
			cell2.appendChild(element22);
			
			var cell3 = row.insertCell(2);
			cell3.class = 'input';
			var element3 = document.createElement("div");
			element3.innerHTML = gol_darah + "("+rhesus_darah+")";
			cell3.appendChild(element3);

			var cell4 = row.insertCell(3);
			cell4.class = 'input';
			var element4 = document.createElement("div");
			element4.innerHTML = alasanHTML; 
			cell4.appendChild(element4);
			var element42 = document.createElement("input");
			element42.type = "hidden";
			element42.name = "alasanmusnah[]";
			element42.value = alasan;
			cell4.appendChild(element42);
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
