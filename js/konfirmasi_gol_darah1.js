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
var nama_pendonor;
var kode_pendonor;

// Cek no kantong di stokkantong
function cari_kantong(tableID)
  {
	var no_label = document.kantong.nokantong.value;
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
			produk = json.kantong.produk;
		}	
    });
	if (no_label1!=''){
		addRow(tableID,no_label,gol_darah,rhesus_darah,nama_pendonor,kode_pendonor);
	} else {
			clearForm();	
		alert('Kantong Belum Berisi darah atau belum terdaftar!!!');
	}
}
  
 function ok() {
 if(cle != '13') return true;
 else return false;
 }

		function addRow(tableID,no_label,gol_darah,rhesus_darah,nama_pendonor,kode_pendonor) {
		
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("div");
			element1.innerHTML = rowCount;
			cell1.appendChild(element1);
/*
			var element12 = document.createElement("input");
			element12.type = "hidden";
			element12.name = "kode[]";
			element12.value = kode_pendonor;
			cell1.appendChild(element12);
*/
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
			var element3 = document.createElement("div");
			element3.innerHTML = produk;
			cell3.appendChild(element3);

			var cell4 = row.insertCell(3);
			var element4 = document.createElement("div");
			element4.innerHTML = gol_darah + "("+rhesus_darah+")";
			cell4.appendChild(element4);
/*
			var cell3 = row.insertCell(2);
			var element3 = document.createElement("div");
			element3.name = "goldarahasal[]";
			element3.innerHTML = gol_darah;
			cell3.appendChild(element3);

			var cell4 = row.insertCell(3);
			var element4 = document.createElement("div");
			element4.name = "rhesusasal[]";
			element4.innerHTML = rhesus_darah;
			cell4.appendChild(element4);
*/
			var cell5 = row.insertCell(4);
			var element5 = document.createElement("select");
			element5.name = "goldarah[]";
			var element30 = document.createElement("option");
			element30.value = "A";
			if (gol_darah=="A") element30.selected = true;
			element30.innerHTML = "A";
			element5.appendChild(element30);
			var element31 = document.createElement("option");
			element31.value = "B";
			if (gol_darah=="B") element31.selected = true;
			element31.innerHTML = "B";
			element5.appendChild(element31);
			var element32 = document.createElement("option");
			element32.value = "AB";
			if (gol_darah=="AB") element32.selected = true;
			element32.innerHTML = "AB";
			element5.appendChild(element32);
			var element33 = document.createElement("option");
			element33.value = "O";
			if (gol_darah=="O") element33.selected = true;
			element33.innerHTML = "O";
			element5.appendChild(element33);
			cell5.appendChild(element5);

			var cell6 = row.insertCell(5);
			var element6= document.createElement("select");
			element6.name = "rhesus[]";
			var element40 = document.createElement("option");
			element40.value = "+";
			if (rhesus_darah=="+") element40.selected = true;
			element40.innerHTML = "+";
			element6.appendChild(element40);
			var element41 = document.createElement("option");
			element41.value = "-";
			if (rhesus_darah=="-") element41.selected = true;
			element41.innerHTML = "-";
			element6.appendChild(element41);
			cell6.appendChild(element6);


			
			
/*
			var cell6 = row.insertCell(5);
			var element6 = document.createElement("select");
			element6.name = "metode[]";
			var element70 = document.createElement("option");
			element70.value = "Bioplate";
			element70.innerHTML = "Bioplate";
			element6.appendChild(element70);
			var element72 = document.createElement("option");
			element72.value = "Otomatis";
			element72.innerHTML = "Otomatis";
			element6.appendChild(element72);
			var element71 = document.createElement("option");
			element71.value = "Tube Test";
			element71.innerHTML = "Tube Test";
			element6.appendChild(element71);
			cell6.appendChild(element6);
/*
			var cell7 = row.insertCell(6);
			var element7 = document.createElement("select");
			element7.name = "sel[]";
			var element73 = document.createElement("option");
			element73.value = "0";
			element73.innerHTML = "Ya";
			element7.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "1";
			element74.innerHTML = "Tidak";
			element7.appendChild(element74);
			cell7.appendChild(element7);
*/
			var cell7 = row.insertCell(6);
			var element7 = document.createElement("select");
			element7.name = "antia[]";
			var element73 = document.createElement("option");
			element73.value = "1+";
			element73.innerHTML = "1+";
			element7.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "2+";
			element74.innerHTML = "2+";
			element7.appendChild(element74);
			var element75 = document.createElement("option");
			element75.value = "3+";
			element75.innerHTML = "3+";
			element7.appendChild(element75);
			var element76 = document.createElement("option");
			element76.value = "4+";
			if (gol_darah=="A") element76.selected = true;
			if (gol_darah=="AB") element76.selected = true;
			element76.innerHTML = "4+";
			element7.appendChild(element76);
			var element77 = document.createElement("option");
			element77.value = "Neg";
			if (gol_darah=="B") element77.selected = true;
			if (gol_darah=="O") element77.selected = true;
			element77.innerHTML = "Neg";
			element7.appendChild(element77);
			cell7.appendChild(element7);

			var cell8 = row.insertCell(7);
			var element8 = document.createElement("select");
			element8.name = "antib[]";
			var element73 = document.createElement("option");
			element73.value = "1+";
			element73.innerHTML = "1+";
			element8.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "2+";
			element74.innerHTML = "2+";
			element8.appendChild(element74);
			var element75 = document.createElement("option");
			element75.value = "3+";
			element75.innerHTML = "3+";
			element8.appendChild(element75);
			var element76 = document.createElement("option");
			element76.value = "4+";
			if (gol_darah=="B") element76.selected = true;
			if (gol_darah=="AB") element76.selected = true;
			element76.innerHTML = "4+";
			element8.appendChild(element76);
			var element77 = document.createElement("option");
			element77.value = "Neg";
			if (gol_darah=="A") element77.selected = true;
			if (gol_darah=="O") element77.selected = true;
			element77.innerHTML = "Neg";
			element8.appendChild(element77);
			cell8.appendChild(element8);
/*
			var cell10 = row.insertCell(9);
			var element10 = document.createElement("select");
			element10.name = "antio[]";
			var element73 = document.createElement("option");
			element73.value = "Neg";
			element73.innerHTML = "Neg";
			element10.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "Reaksi";
			element74.innerHTML = "Reaksi";
			element10.appendChild(element74);
			cell10.appendChild(element10);


			var cell10 = row.insertCell(9);
			var element10 = document.createElement("select");
			element10.name = "serum[]";
			var element73 = document.createElement("option");
			element73.value = "0";
			element73.innerHTML = "Ya";
			element10.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "1";
			element74.innerHTML = "Tidak";
			element10.appendChild(element74);
			cell10.appendChild(element10);
*/			
			var cell9 = row.insertCell(8);
			var element9 = document.createElement("select");
			element9.name = "ta[]";
			var element73 = document.createElement("option");
			element73.value = "1+";
			element73.innerHTML = "1+";
			element9.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "2+";
			element74.innerHTML = "2+";
			element9.appendChild(element74);
			var element75 = document.createElement("option");
			element75.value = "3+";
			element75.innerHTML = "3+";
			element9.appendChild(element75);
			var element76 = document.createElement("option");
			element76.value = "4+";
			if (gol_darah=="B") element76.selected = true;
			if (gol_darah=="O") element76.selected = true;
			element76.innerHTML = "4+";
			element9.appendChild(element76);
			var element77 = document.createElement("option");
			element77.value = "Neg";
			if (gol_darah=="A") element77.selected = true;
			if (gol_darah=="AB") element77.selected = true;
			element77.innerHTML = "Neg";
			element9.appendChild(element77);
			cell9.appendChild(element9);

			var cell10 = row.insertCell(9);
			var element10 = document.createElement("select");
			element10.name = "tb[]";
			var element73 = document.createElement("option");
			element73.value = "1+";
			element73.innerHTML = "1+";
			element10.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "2+";
			element74.innerHTML = "2+";
			element10.appendChild(element74);
			var element75 = document.createElement("option");
			element75.value = "3+";
			element75.innerHTML = "3+";
			element10.appendChild(element75);
			var element76 = document.createElement("option");
			element76.value = "4+";
			if (gol_darah=="A") element76.selected = true;
			if (gol_darah=="O") element76.selected = true;
			element76.innerHTML = "4+";
			element10.appendChild(element76);
			var element77 = document.createElement("option");
			element77.value = "Neg";
			if (gol_darah=="B") element77.selected = true;
			if (gol_darah=="AB") element77.selected = true;
			element77.innerHTML = "Neg";
			element10.appendChild(element77);
			cell10.appendChild(element10);

			var cell11 = row.insertCell(10);
			var element11 = document.createElement("select");
			element11.name = "anti[]";
			var element73 = document.createElement("option");
			element73.value = "Neg";
			element73.innerHTML = "Neg";
			element11.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "Reaksi";
			element74.innerHTML = "Reaksi";
			element11.appendChild(element74);
			cell11.appendChild(element11);

			var cell12 = row.insertCell(11);
			var element12 = document.createElement("select");
			element12.name = "ac[]";
			var element73 = document.createElement("option");
			element73.value = "1";
			element73.innerHTML = "Neg";
			element12.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "0";
			element74.innerHTML = "Pos";
			element12.appendChild(element74);
			cell12.appendChild(element12);

			var cell13 = row.insertCell(12);
			var element13 = document.createElement("select");
			element13.name = "antid[]";
			var element73 = document.createElement("option");
			element73.value = "Neg";
			if (rhesus_darah=="-") element73.selected = true;
			element73.innerHTML = "Neg";
			element13.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "4+";
			if (rhesus_darah=="+") element74.selected = true;
			element74.innerHTML = "4+";
			element13.appendChild(element74);
			var element75 = document.createElement("option");
			element75.value = "3+";
			element75.innerHTML = "3+";
			element13.appendChild(element75);
			var element76 = document.createElement("option");
			element76.value = "2+";
			element76.innerHTML = "2+";
			element13.appendChild(element76);
			var element77 = document.createElement("option");
			element77.value = "1+";
			element77.innerHTML = "1+";
			element13.appendChild(element77);
			cell13.appendChild(element13);

			var cell14 = row.insertCell(13);
			var element14 = document.createElement("select");
			element14.name = "ba[]";
			var element73 = document.createElement("option");
			element73.value = "1";
			element73.innerHTML = "Neg";
			element14.appendChild(element73);
			var element74 = document.createElement("option");
			element74.value = "0";
			element74.innerHTML = "Pos";
			element14.appendChild(element74);
			cell14.appendChild(element14);

			


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
