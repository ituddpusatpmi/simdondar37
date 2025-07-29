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
                quoi.focus(document.komponen.nokantong);
                quoi=null;
            }

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

function ok() {
    document.getElementById('nokantong').focus();
    if(cle != '13') return true;
    else return false;
}
var row_id;
/*$(function(){
    $('tr').click(function(){
        alert(this.rowIndex);
    });
});*/
/*function kadaluwarsa1(rc) {
    jkomp=$("#0jeniskomponen"+rc).val();
    tgl0 = Date.parse(tgl_aftap0).add(35).days();
    tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
    $("#0kadaluwarsa"+rc).val(tgl1);
}*/
var jenis_kantong0;
var merk0;
var metoda0;
var gol_darah0;
var rhs_darah0;
var tgl_aftap0;
var status0;
var durasi0;
var noinv0;
var nmalat0;
var kode0;
var nolot0;
var kodep0;
var valid_kantong0;
var jsplit;
function addRow(tableID) {
    var NoKantong   = document.komponen.nokantong.value;
    var mesin       = document.komponen.mesin.value;
    NoKantong       = NoKantong.toUpperCase();
    var lkantong    = NoKantong.length-1;
    tipe	    = NoKantong.substring(8);
    jenis_kantong0  = "";
    cputar	    = "";
    wputar	    = "";
    sputar	    = "";
    merk0           = "";
    metoda0         = "";
    noinv0          = "";
    nmalat0         = "";
    kode0	    = "";
    nolot0	    = "";
    kodep0	    = "";
    valid_kantong0  = "";
    status0	    = "";
    durasi0 = "";
    var jkantong    = check3(NoKantong);
    var jmesin      = check4(mesin);
    var table       = document.getElementById(tableID);
    
    if (valid_kantong0 == "1") {
	
            if(jenis_kantong0=="1"){
                var jnsktg = "Single";
            }else if(jenis_kantong0=="2"){
                var jnsktg = "Double";
            }else if(jenis_kantong0=="3"){
                var jnsktg = "Triple";
            }else if(jenis_kantong0=="4"){
                var jnsktg = "Quadruple";
            }else if(jenis_kantong0=="6"){
                var jnsktg = "Pediatrik";
            }else{
                var jnsktg = "Unknown";
            }

	    if(status0=="1"){
              var stt0 = "Karantina";
            }else if(status0=="2"){
                var stt0 = "Sehat";
            }

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);


	//FUNGSI KADALUARSA
            function kadaluwarsa1(rc) {
                jkomp=$("#0jeniskomponen"+rc).val();
                tgl0 = Date.parse(tgl_aftap0).add(35).days();
                tgl4 = Date.today();
                        
                if (jkomp=='WE')
                    tgl0 = Date.today().setTimeToNow().add(5).hours();
                if (jkomp=='PRC')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jkomp=='TC')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='FFP')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
                if (jkomp=='AHF')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='LP')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jkomp=='BC')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='PRC Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jkomp=='FFP Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
                if (jkomp=='TC Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='LP Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
                $("#0kadaluwarsa"+rc).val(tgl1);
            }

	

            
            // Insert Row untuk No.Kantong //
            
            var cell0           = row.insertCell(0);
            var element0        = document.createElement("p");
	    element0.type       = "hidden";
            element0.name       = "no_kantonga[]";
            cell0.appendChild(element0);
            var element00        = document.createElement("input");
            element00.type       = "text";
            element00.size       = "12";
            element00.name       = "no_kantong[]";
            element00.value      = "";
	    cell0.appendChild(element00);
            

            // Insert Row untuk Taggal Aftap //
            var cell1           = row.insertCell(1);
            var element1        = document.createElement("p");
	    element1.id		= "tglaftap"+rowCount;
            element1.innerHTML  = tgl_aftap0;
            cell1.appendChild(element1);
            var element111        = document.createElement("input");
	    element111.type		= "hidden";
	    element111.name		= "tglaftap[]";
	    element111.value		= tgl_aftap0;
            cell1.appendChild(element111);

            // Insert Row untuk ABO (Rh) //
            var cell2           = row.insertCell(2);
            var element2        = document.createElement("input");
	    element2.type	= "hidden";
	    element2.name	= "gol[]";
	    element2.value      = gol_darah0;
	    cell2.appendChild(element2);
	    var element22        = document.createElement("input");
	    element22.type	= "hidden";
	    element22.name	= "rh[]";
	    element22.value      = rhs_darah0;
            cell2.appendChild(element22);
	    var element222        = document.createElement("p");
            element222.innerHTML  = gol_darah0+'('+rhs_darah0+')';
            cell2.appendChild(element222);

	    // Insert Row untuk Jenis Kantong (Single,Double,...etc) //
            var cell3          = row.insertCell(3);
            var element3       = document.createElement("p");
            element3.innerHTML = jnsktg;
            element3.value     = jenis_kantong0;
            cell3.appendChild(element3);
	    var element33       = document.createElement("input");
            element33.type	= "hidden";
	    element33.name	= "alat[]";
            element33.value     = kode0;
            cell3.appendChild(element33);
		
	    // Insert Row untuk Jenis Produk //
            var cell4           = row.insertCell(4);
            var element4        = document.createElement("select");
            element4.name       = "jeniskomponen[]";
            //element4.id         = "0jeniskomponen"+rowCount;
            //element4.onChange   = kadaluwarsa1(rowCount);
	

            // Insert Row untuk Kadaluwarsa Produk (Default by Sistem or Manually) //
            var ambiltgl        = Date.parse(tgl_aftap0).add(35).days();
	    var tgl1            = ambiltgl.toString('yyyy-MM-dd HH:mm:ss');
            var cell5           = row.insertCell(5);
            var element5        = document.createElement("input");
            element5.type       = "text";
            element5.name       = "kadaluwarsa[]";
            element5.id         = "0kadaluwarsa"+rowCount;
            element5.value      = tgl1;
            cell5.appendChild(element5);

            // No. Kantong Asal (no. Kantong)
	    var cell6           = row.insertCell(6);
            var element6        = document.createElement("input");
            element6.name       = "no_kantonga[]";
	    element6.type       = "hidden";
	    element6.size       = "10";
	    element6.value      = NoKantong;
            cell6.appendChild(element6);
 	    var element66        = document.createElement("p");
	    element66.innerHTML  = NoKantong;
            cell6.appendChild(element66);

	    // No. Kantong Asal (Abs)
	    var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.name       = "nolot[]";
	    element7.size       = "20";
	    element7.type       = "hidden";
            element7.value      = nolot0;
            cell7.appendChild(element7);
 	    var element77       = document.createElement("p");
	    element77.innerHTML  =  nolot0;
            cell7.appendChild(element77);

	   // No. Kantong Asal (Pendonor)
	    
            var cell8           = row.insertCell(8);
            var element8        = document.createElement("input");
            element8.name       = "kodep[]";
	    element8.size       = "20";
	    element8.type       = "hidden";
            element8.value      = kodep0;
            cell8.appendChild(element8);
 	    var element88       = document.createElement("p");
	    element88.innerHTML  = kodep0;
            cell8.appendChild(element88);



	   // No. Kantong Asal (Status Kantong)
            var cell9           = row.insertCell(9);
            var element9        = document.createElement("input");
            element9.name       = "stt[]";
	    element9.size       = "9";
	    element9.type       = "hidden";
            element9.value      = status0;
            cell9.appendChild(element9);
	    var element99       = document.createElement("p");
	    element99.innerHTML  = stt0;
            cell9.appendChild(element99);


	    
		

	
	   

	    // Insert Volume (Default by Sistem or Manually) //
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "";
                    element10.innerHTML  = "";
                    element10.size       = "4";
                    cell10.appendChild(element10);
             
            
            

	    //Insert Metode Pemisahan
	    var cell11           = row.insertCell(11);
            var element11        = document.createElement("select");
            element11.name       = "pisah[]";
            var element111       = document.createElement("option");
            element111.value     = "1";
            element111.innerHTML = "otomatis";
            element11.appendChild(element111);
            var element112       = document.createElement("option");
            element112.value     = "0";
            element112.innerHTML = "Manual";
            element11.appendChild(element112);
            cell11.appendChild(element11);

	    // Insert mulai (Default by Sistem or Manually) //
            var cell12           = row.insertCell(12);
            var element12      = document.createElement("input");
            element12.type       = "text";
            element12.name       = "mulai[]";
            element12.id         = "0mulai";
	    element12.size       = "4";
            element12.value      = '';
            cell12.appendChild(element12);
            
	    // Insert selesai (Default by Sistem or Manually) //
            var cell13           = row.insertCell(13);
            var element13      = document.createElement("input");
            element13.type       = "text";
            element13.name       = "selesai[]";
            element13.id         = "0selesai";
	    element13.size       = "4";
            element13.value      = '';
            cell13.appendChild(element13);


            // Insert Row untuk Jenis Kantong (Single,Double,...etc) //
		// Double  A         
            if (jenis_kantong0=="2" && tipe=="B") { 
		    var element41       = document.createElement("option");
                    element41.value     = "TC Pooled";
                    element41.innerHTML = "TC Pooled";
		    element4.appendChild(element41);
                   
            }
            //Triple A
            else if (jenis_kantong0=="3" && tipe=="B") { 
		    var element41       = document.createElement("option");
                    element41.value     = "TC Pooled";
                    element41.innerHTML = "TC Pooled";
		    element4.appendChild(element41);
		
            }
            //Quadriple A
            else if (jenis_kantong0=="4" && tipe=="B") { 
		    var element41       = document.createElement("option");
                    element41.value     = "TC Pooled";
                    element41.innerHTML = "TC Pooled";
		    element4.appendChild(element41);
		
            }
		
		cell4.appendChild(element4);
            	element4.id         = "0jeniskomponen"+rowCount;
	        element4.onChange   = kadaluwarsa1(rowCount);
		clearForm();
            
           
    } else if (valid_kantong0 == "2") {
        //alert('Apabila Lama Pengambilan Lebih Dari 15 Menit')//
        $( "#jam_ambil_lebih" ).dialog( "open" );
//                alert("Durasi kondisi kedua".durasi0);
        clearForm();
        return false;
    } else {
        //alert('Apabila kantong //
        $( "#kantong_tdk_sesuai" ).dialog( "open" );
//                alert("Durasi kondisi terakhir".durasi0);
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
            jenis_kantong0  = json.darah.jenis_kantong;
            merk0           = json.darah.merk;
            metoda0         = json.darah.metoda;
            gol_darah0      = json.darah.gol_darah;
            rhs_darah0      = json.darah.rhs_darah;
            tgl_aftap0      = json.darah.tgl_aftap;
            status0         = json.darah.stt;
            durasi0         = json.darah.durasi;
	    kodep0          = json.darah.kodep;
	    abs0            = json.darah.abs0;
	    nolot0	    = json.darah.nolot0;
            valid_kantong0  = json.darah.valid;
        }
    });
}

function check4(mesin)
{ $.ajax({
        url: "json_mesin_laborat.php?mesin="+mesin, async: false, dataType: 'json',
        success: function(json) {
	    noinv0       = json.alat.noinv;
            nmalat0      = json.alat.nmalat;
            noseri0     = json.alat.noseri;
	    kode0	= json.alat.kode;
        }
    });
}
