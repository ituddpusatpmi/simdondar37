function clearForm() {
    document.komponen.nokantong.value="";
//    document.komponen.mesin.value="";
//    document.getElementById('nokantong').focus();
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
$(function(){
    $('tr').click(function(){
        alert(this.rowIndex);
    });
});
function kadaluwarsa1(rc) {
    jkomp=$("#0jeniskomponen"+rc).val();
//alert('jkomp');
    tgl0 = Date.parse(tgl_aftap0).add(35).days();
//if (jkomp=='TC') tgl0 = Date.parse(tgl_aftap0).add(5).days();
//if (jkomp=='FFP') tgl0 = Date.parse(tgl_aftap0).add(1).years();
//if (jkomp=='WE') tgl0 = Date.parse(tgl_aftap0).add(5).hours();
//if (rc=='3') tgl0 = Date.today().add(5).days();
    tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
    $("#0kadaluwarsa"+rc).val(tgl1);
    //$("#1kadaluwarsa"+rc).html(tgl1);
}
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
var valid_kantong0;
function addRow(tableID) {
    var NoKantong   = document.komponen.nokantong.value;
    var mesin       = document.komponen.mesin.value;
    NoKantong       = NoKantong.toUpperCase();
    var lkantong    = NoKantong.length-1;
    jenis_kantong0  = "";
    merk0           = "";
    metoda0         = "";
    noinv0          = "";
    nmalat0         = "";
    kode0	    = "";
    valid_kantong0  = "";
    durasi0 = "";
    var jkantong    = check3(NoKantong);
    var jmesin      = check4(mesin);
    var table       = document.getElementById(tableID);
    if (valid_kantong0 == "1") {
        for (var i=0; i<jenis_kantong0; i++) {
            if (i=="0") var NoKantong1 = NoKantong.substring(0,lkantong)+"A";
            if (i=="1") var NoKantong1 = NoKantong.substring(0,lkantong)+"B";
            if (i=="2") var NoKantong1 = NoKantong.substring(0,lkantong)+"C";
            if (i=="3") var NoKantong1 = NoKantong.substring(0,lkantong)+"D";
            if (i=="4") var NoKantong1 = NoKantong.substring(0,lkantong)+"E";
            if (i=="5") var NoKantong1 = NoKantong.substring(0,lkantong)+"F";

            if (metoda0=="TTB"){ var mtd="Top&Top (Biasa)";}
            else if (metoda0=="TTF"){ var mtd="Top&Top (Filter)";}
            else if (metoda0=="TBB"){ var mtd="Top&Bottom (Biasa)";}
            else if (metoda0=="TBF"){ var mtd="Top&Bottom (Filter)";}
            else{ var mtd="";}

            if(jenis_kantong0=="1"){
                var jnsktg = "Single";
            }else if(jenis_kantong0=="2"){
                var jnsktg = "Double";
            }else if(jenis_kantong0=="3"){
                var jnsktg = "Triple";
            }else if(jenis_kantong0=="4"){
                var jnsktg = "Quadruple ("+mtd+")";
            }else if(jenis_kantong0=="6"){
                var jnsktg = "Pediatrik";
            }else{
                var jnsktg = "Unknown";
            }

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            function kadaluwarsa1(rc) {
                jkomp=$("#0jeniskomponen"+rc).val();
                //alert(jkomp);
                tgl0 = Date.parse(tgl_aftap0).add(35).days();
                tgl4 = Date.today();
                if (jenis_kantong0=='2' && i=='1')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jenis_kantong0=='3' && i=='1')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jenis_kantong0=='3' && i=='2')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jenis_kantong0=='4')
                        if(merk0=="JMS"){
                            if(metoda0=="TTB" || metoda0=="TBB")
                            /** Exp kantong JMS LR (Leucoreduction) */
                                if(tgl_aftap0<tgl4){
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(40).days();
                                    if (i=="1") tgl0 = Date.parse(tgl_aftap0).add(5).days();
                                    if (i=="2") tgl0 = Date.parse(tgl_aftap0).add(1).years();
                                    if (i=="3") tgl0 = Date.parse(tgl_aftap0).add(40).days();
                                }else{
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(40).days();
                                    if (i=="1") tgl0 = Date.today();
                                    if (i=="2") tgl0 = Date.today();
                                    if (i=="3") tgl0 = Date.parse(tgl_aftap0).add(40).days();
                                }

                            if(metoda0=="TTF" || metoda0=="TBF")
                            /** Exp kantong JMS LD (Leucodepletet) Filter */
                                if(tgl_aftap0<tgl4){
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(21).days();
                                    if (i=="1") tgl0 = Date.parse(tgl_aftap0).add(1).years();
                                    if (i=="2") tgl0 = Date.today();
                                    if (i=="3") tgl0 = Date.today();
                                }else{
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(21).days();
                                    if (i=="1") tgl0 = Date.today();
                                    if (i=="2") tgl0 = Date.today();
                                    if (i=="3") tgl0 = Date.today();
                                }
                        }else{
                            if(metoda0=="TTB" || metoda0=="TBB")
                            /** Exp kantong NOT JMS LR (Leucoreduction) */
                                if(tgl_aftap0<tgl4){
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(42).days();
                                    if (i=="1") tgl0 = Date.parse(tgl_aftap0).add(5).days();
                                    if (i=="2") tgl0 = Date.parse(tgl_aftap0).add(42).days();
                                    if (i=="3") tgl0 = Date.parse(tgl_aftap0).add(21).days();
                                }else{
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(42).days();
                                    if (i=="1") tgl0 = Date.parse(tgl_aftap0).add(30).days();
                                    if (i=="2") tgl0 = Date.parse(tgl_aftap0).add(42).days();
                                    if (i=="3") tgl0 = Date.parse(tgl_aftap0).add(21).days();
                                }

                            if(metoda0=="TTF" || metoda0=="TBF")
                            /** Exp kantong NOT JMS LD (Leucodepletet) Filter */
                                if(tgl_aftap0<tgl4){
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(42).days();
                                    if (i=="1") tgl0 = Date.parse(tgl_aftap0).add(5).days();
                                    if (i=="2") tgl0 = Date.parse(tgl_aftap0).add(30).days();
                                    if (i=="3") tgl0 = Date.parse(tgl_aftap0).add(21).days();
                                }else{
                                    if (i=="0") tgl0 = Date.parse(tgl_aftap0).add(42).days();
                                    if (i=="1") tgl0 = Date.parse(tgl_aftap0).add(30).days();
                                    if (i=="2") tgl0 = Date.parse(tgl_aftap0).add(30).days();
                                    if (i=="3") tgl0 = Date.parse(tgl_aftap0).add(21).days();
                                }
                        }
                if (jkomp=='WE')
                    tgl0 = Date.today().setTimeToNow().add(5).hours();

                //if (rc=='3') tgl0 = Date.today().add(5).days();
                //     alert(tgl0)
                tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
                $("#0kadaluwarsa"+rc).val(tgl1);
                //$("#1kadaluwarsa"+rc).html(tgl1);
                //     alert(jkomp);
            }

            if(jenis_kantong0=='4'){
            // Insert Row untuk No.Kantong //
            var cell0           = row.insertCell(0);
            var element0        = document.createElement("input");
            element0.type       = "text";
            element0.name       = "no_kantong[]";
            element0.value      = NoKantong1;
            element0.size       = "9";
            cell0.appendChild(element0);
//            var element00        = document.createElement("p");
//            element00.innerHTML  = NoKantong1;
//            cell0.appendChild(element00);
            }else{
            // Insert Row untuk No.Kantong //
            var cell0           = row.insertCell(0);
            var element0        = document.createElement("input");
            element0.type       = "hidden";
            element0.name       = "no_kantong[]";
            element0.value      = NoKantong1;
            cell0.appendChild(element0);
            var element00        = document.createElement("p");
            element00.innerHTML  = NoKantong1;
            cell0.appendChild(element00);
            }

            // Insert Row untuk Taggal Aftap //
            var cell1           = row.insertCell(1);
            var element1        = document.createElement("p");
            element1.innerHTML  = tgl_aftap0;
            cell1.appendChild(element1);

            // Insert Row untuk ABO (Rh) //
            var cell2           = row.insertCell(2);
            var element2        = document.createElement("p");
            element2.innerHTML  = gol_darah0+'('+rhs_darah0+')';
            cell2.appendChild(element2);

            // Insert Row untuk Kadaluwarsa Produk (Default by Sistem or Manually) //
            var ambiltgl        = Date.parse(tgl_aftap0).add(2).days();
            var cell3           = row.insertCell(3);
            var element3        = document.createElement("input");
            element3.type       = "text";
            element3.name       = "kadaluwarsa[]";
            element3.id         = "0kadaluwarsa"+rowCount;
            element3.value      = '';
            cell3.appendChild(element3);

            // Insert Row untuk Jenis Kantong (Single,Double,...etc) //
            var cell04          = row.insertCell(4);
            var element04       = document.createElement("p");
            element04.innerHTML = jnsktg;
            element04.value     = jenis_kantong0;
            cell04.appendChild(element04);

            // Insert Row untuk Jenis Kantong (Single,Double,...etc) //
            var cell4           = row.insertCell(5);
            var element4        = document.createElement("select");
            element4.name       = "jeniskomponen[]";
            element4.id         = "0jeniskomponen"+rowCount;
            element4.onChange   = kadaluwarsa1(rowCount);

            if (jenis_kantong0=="6" && status0=="2"){
                if (i=="0"){
                    var element41       = document.createElement("option");
                    element41.value     = "None";
                    element41.innerHTML = "None";
                    element4.appendChild(element41);
                }
            }
//            else if (i=="0") {
//                if (i == "0") {
//                    var element42       = document.createElement("option");
//                    element42.value     = "PRC";
//                    element42.innerHTML = "PRC";
//                    element4.appendChild(element42);
//                    var element43       = document.createElement("option");
//                    element43.value     = "WE";
//                    element43.innerHTML = "WE";
//                    element4.appendChild(element43);
//                    var element44       = document.createElement("option");
//                    element44.value     = "WB";
//                    element44.innerHTML = "WB";
//                    element4.appendChild(element44);
//                }
//            }
            /** Produk pada Jenis Kantong Triple */
            if (jenis_kantong0=="3") {
                /** Kantong Satelite Kedua */
                if (i=="2") {
                    var element441       = document.createElement("option");
                    element441.value     = "LP";
                    element441.innerHTML = "LP";
                    element4.appendChild(element441);
                    var element45       = document.createElement("option");
                    element45.value     = "FP";
                    element45.innerHTML = "FP";
                    element4.appendChild(element45);
                    var element46       = document.createElement("option");
                    element46.value     = "FFP";
                    element46.innerHTML = "FFP";
                    element4.appendChild(element46);
                    var element47       = document.createElement("option");
                    element47.value     = "AHF";
                    element47.innerHTML = "AHF";
                    element4.appendChild(element47);
                }
                /** Kantong Satelite Pertama */
                if (i=="1") {
                    var element48       = document.createElement("option");
                    element48.value     = "TC";
                    element48.innerHTML = "TC";
                    element4.appendChild(element48);
                }
                if (i=="0") {
                    var element442       = document.createElement("option");
                    element442.value     = "PRC";
                    element442.innerHTML = "PRC";
                    element4.appendChild(element442);
                    var element443       = document.createElement("option");
                    element443.value     = "WE";
                    element443.innerHTML = "WE";
                    element4.appendChild(element443);
		}
            }
            /** Produk pada Jenis Kantong Quadruple */
            if (jenis_kantong0=="4") {
                if(merk0=="COMPOFLEX"){
                    if(metoda0=="TTB" || metoda0=="TBB"){
                        if(tgl_aftap0<tgl4){
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element409       = document.createElement("option");
                                element409.value     = "PRC";
                                element409.innerHTML = "PRC";
                                element4.appendChild(element409);
                                var element410       = document.createElement("option");
                                element410.value     = "Leucoreduction";
                                element410.innerHTML = "Leucoreduction";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element408       = document.createElement("option");
                                element408.value     = "TC";
                                element408.innerHTML = "TC";
                                element4.appendChild(element408);
                                var element412       = document.createElement("option");
                                element412.value     = "FFP";
                                element412.innerHTML = "FFP";
                                element4.appendChild(element412);
                                var element411       = document.createElement("option");
                                element411.value     = "AHF";
                                element411.innerHTML = "AHF";
                                element4.appendChild(element411);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element413       = document.createElement("option");
                                element413.value     = "FFP";
                                element413.innerHTML = "FFP";
                                element4.appendChild(element413);
                                var element414       = document.createElement("option");
                                element414.value     = "AHF";
                                element414.innerHTML = "AHF";
                                element4.appendChild(element414);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "PRC";
                                element40.innerHTML = "PRC";
                                element4.appendChild(element40);
                                var element401       = document.createElement("option");
                                element401.value     = "Leucoreduction";
                                element401.innerHTML = "Leucoreduction";
                                element4.appendChild(element401);
                                var element411       = document.createElement("option");
                                element411.value     = "WB";
                                element411.innerHTML = "WB";
                                element4.appendChild(element411);
                            }
                        }else{
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element410       = document.createElement("option");
                                element410.value     = "PRC";
                                element410.innerHTML = "PRC";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element408       = document.createElement("option");
                                element408.value     = "TC";
                                element408.innerHTML = "TC";
                                element4.appendChild(element408);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element404       = document.createElement("option");
                                element404.value     = "FFP";
                                element404.innerHTML = "FFP";
                                element4.appendChild(element404);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "BC";
                                element40.innerHTML = "BC";
                                element4.appendChild(element40);
                                var element409       = document.createElement("option");
                                element409.value     = "PRC";
                                element409.innerHTML = "PRC";
                                element4.appendChild(element409);
                            }
                        }
                    }

                    if(metoda0=="TTF" || metoda0=="TBF"){
                        if(tgl_aftap0<tgl4){
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element408       = document.createElement("option");
                                element408.value     = "WB";
                                element408.innerHTML = "WB";
                                element4.appendChild(element408);
                                var element410       = document.createElement("option");
                                element410.value     = "Leucodepletet";
                                element410.innerHTML = "Leucodepletet";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element404       = document.createElement("option");
                                element404.value     = "FFP";
                                element404.innerHTML = "FFP";
                                element4.appendChild(element404);
                                var element413       = document.createElement("option");
                                element413.value     = "LP";
                                element413.innerHTML = "LP";
                                element4.appendChild(element413);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element40       = document.createElement("option");
                                element40.value     = "LP";
                                element40.innerHTML = "LP";
                                element4.appendChild(element40);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element409       = document.createElement("option");
                                element409.value     = "LP";
                                element409.innerHTML = "LP";
                                element4.appendChild(element409);
                            }
                        }else{
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element408       = document.createElement("option");
                                element408.value     = "WB";
                                element408.innerHTML = "WB";
                                element4.appendChild(element408);
                                var element410       = document.createElement("option");
                                element410.value     = "Leucodepletet";
                                element410.innerHTML = "Leucodepletet";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element409       = document.createElement("option");
                                element409.value     = "LP";
                                element409.innerHTML = "LP";
                                element4.appendChild(element409);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element404       = document.createElement("option");
                                element404.value     = "LP";
                                element404.innerHTML = "LP";
                                element4.appendChild(element404);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "LP";
                                element40.innerHTML = "LP";
                                element4.appendChild(element40);
                            }
                        }
                    }
                }else{
                    if(metoda0=="TTB" || metoda0=="TBB"){
                        if(tgl_aftap0<tgl4){
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element409       = document.createElement("option");
                                element409.value     = "PRC";
                                element409.innerHTML = "PRC";
                                element4.appendChild(element409);
                                var element410       = document.createElement("option");
                                element410.value     = "Leucoreduction";
                                element410.innerHTML = "Leucoreduction";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element408       = document.createElement("option");
                                element408.value     = "TC";
                                element408.innerHTML = "TC";
                                element4.appendChild(element408);
                                var element412       = document.createElement("option");
                                element412.value     = "FFP";
                                element412.innerHTML = "FFP";
                                element4.appendChild(element412);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element404       = document.createElement("option");
                                element404.value     = "PRC";
                                element404.innerHTML = "PRC";
                                element4.appendChild(element404);
                                var element413       = document.createElement("option");
                                element413.value     = "LP";
                                element413.innerHTML = "LP";
                                element4.appendChild(element413);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "WB";
                                element40.innerHTML = "WB";
                                element4.appendChild(element40);
                            }
                        }else{
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element410       = document.createElement("option");
                                element410.value     = "PRC";
                                element410.innerHTML = "PRC";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element408       = document.createElement("option");
                                element408.value     = "LP";
                                element408.innerHTML = "LP";
                                element4.appendChild(element408);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element404       = document.createElement("option");
                                element404.value     = "PRC";
                                element404.innerHTML = "PRC";
                                element4.appendChild(element404);
                                var element405       = document.createElement("option");
                                element405.value     = "LP";
                                element405.innerHTML = "LP";
                                element4.appendChild(element405);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "WB";
                                element40.innerHTML = "WB";
                                element4.appendChild(element40);
                            }
                        }
                    }

                    if(metoda0=="TTF" || metoda0=="TBF"){
                        if(tgl_aftap0<tgl4){
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element409       = document.createElement("option");
                                element409.value     = "PRC";
                                element409.innerHTML = "PRC";
                                element4.appendChild(element409);
                                var element410       = document.createElement("option");
                                element410.value     = "Leucodepletet";
                                element410.innerHTML = "Leucodepletet";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element408       = document.createElement("option");
                                element408.value     = "TC";
                                element408.innerHTML = "TC";
                                element4.appendChild(element408);
                                var element410       = document.createElement("option");
                                element410.value     = "FFP";
                                element410.innerHTML = "FFP";
                                element4.appendChild(element410);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element413       = document.createElement("option");
                                element413.value     = "LP";
                                element413.innerHTML = "LP";
                                element4.appendChild(element413);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "WB";
                                element40.innerHTML = "WB";
                                element4.appendChild(element40);
                                var element41       = document.createElement("option");
                                element41.value     = "LP";
                                element41.innerHTML = "LP";
                                element4.appendChild(element41);
                            }
                        }else{
                            /** Kantong Utama (Jarum) */
                            if (i=="0") {
                                var element409       = document.createElement("option");
                                element409.value     = "PRC";
                                element409.innerHTML = "PRC";
                                element4.appendChild(element409);
                            }
                            /** Kantong Satelite Pertama */
                            if (i=="1") {
                                var element408       = document.createElement("option");
                                element408.value     = "LP";
                                element408.innerHTML = "LP";
                                element4.appendChild(element408);
                            }
                            /** Kantong Satelite Kedua */
                            if (i=="2") {
                                var element404       = document.createElement("option");
                                element404.value     = "LP";
                                element404.innerHTML = "LP";
                                element4.appendChild(element404);
                            }
                            /** Kantong Satelite Ketiga */
                            if (i=="3") {
                                var element40       = document.createElement("option");
                                element40.value     = "WB";
                                element40.innerHTML = "WB";
                                element4.appendChild(element40);
                            }
                        }
                    }
                }
            }
            if (jenis_kantong0=="6" && status0=="2") {
                if (i=="0") {
                    var element49       = document.createElement("option");
                    element49.value     = "LP";
                    element49.innerHTML = "LP";
                    element4.appendChild(element49);
                }else if (i=="5") {
                    var element490      = document.createElement("option");
                    element490.value    = "LP";
                    element490.innerHTML= "LP";
                    element4.appendChild(element490);
                }else{
                    var element491      = document.createElement("option");
                    element491.value    = "WB";
                    element491.innerHTML= "WB";
                    element4.appendChild(element491);
                    var element492      = document.createElement("option");
                    element492.value    = "PRC";
                    element492.innerHTML= "PRC";
                    element4.appendChild(element492);
                }
            }
            /** Kantong Double */
            if (jenis_kantong0=="2") {
                /** Kantong Satelite */
                if (i=="1") {
                    var element493       = document.createElement("option");
                    element493.value     = "LP";
                    element493.innerHTML = "LP";
                    element4.appendChild(element493);
                    var element494       = document.createElement("option");
                    element494.value     = "FP";
                    element494.innerHTML = "FP";
                    element4.appendChild(element494);
                    var element495      = document.createElement("option");
                    element495.value    = "FFP";
                    element495.innerHTML= "FFP";
                    element4.appendChild(element495);
                }
                if (i=="0") {
                    var element496       = document.createElement("option");
                    element496.value     = "PRC";
                    element496.innerHTML = "PRC";
                    element4.appendChild(element496);
                    var element497       = document.createElement("option");
                    element497.value     = "WE";
                    element497.innerHTML = "WE";
                    element4.appendChild(element497);
		}
            }
            cell4.appendChild(element4);

            // Insert Row untuk Volume Kantong (Auto by System or Manually) //
            if (jenis_kantong0=="2"){
                if (i=="1") {
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "\xB1150";
                    element6.innerHTML  = "\xB1150";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }else{
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "\xB1200";
                    element6.innerHTML  = "\xB1200";
                    element6.size        = "4";
                    cell6.appendChild(element6);
                }
            }
            if (jenis_kantong0=="3"){
                if (i=="0") {
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "\xB1200";
                    element6.innerHTML  = "\xB1200";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }else if (i=="1") {
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "\xB150";
                    element6.innerHTML  = "\xB150";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }else{
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "\xB1150";
                    element6.innerHTML  = "\xB1150";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }
            }
            /** Volume Default pada Jenis Kantong Quadruple */
            if (jenis_kantong0=="4") {
                if(merk0=="JMS"){
                    if(metoda0=="TTB" || metoda0=="TBB"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1100";
                                element6.innerHTML  = "\xB1100";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }else{
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB125";
                                element6.innerHTML  = "\xB125";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB125";
                                element6.innerHTML  = "\xB125";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }
                    }
                    if(metoda0=="TTF" || metoda0=="TBF"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1100";
                                element6.innerHTML  = "\xB1100";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB125";
                                element6.innerHTML  = "\xB125";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB125";
                                element6.innerHTML  = "\xB125";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }else{
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1350";
                                element6.innerHTML  = "\xB1350";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB125";
                                element6.innerHTML  = "\xB125";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB125";
                                element6.innerHTML  = "\xB125";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }
                    }
                }else{
                    if(metoda0=="TTB" || metoda0=="TBB"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1250";
                                element6.innerHTML  = "\xB1250";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1180";
                                element6.innerHTML  = "\xB1180";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }else{
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1250";
                                element6.innerHTML  = "\xB1250";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1180";
                                element6.innerHTML  = "\xB1180";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }
                    }
                    if(metoda0=="TTF" || metoda0=="TBF"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1150";
                                element6.innerHTML  = "\xB1150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }else{
                            if (i=="0") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1200";
                                element6.innerHTML  = "\xB1200";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="1") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else if (i=="2") {
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB150";
                                element6.innerHTML  = "\xB150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }else{
                                var cell6           = row.insertCell(6);
                                var element6        = document.createElement("input");
                                element6.name       = "vlm[]";
                                element6.value      = "\xB1150";
                                element6.innerHTML  = "\xB1150";
                                element6.size       = "4";
                                cell6.appendChild(element6);
                            }
                        }
                    }
                }
            }
            if (jenis_kantong0=="6" && status0=="2"){
                if (i=="0") {
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "None";
                    element6.innerHTML  = "None";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }else if (i=="5"){
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "None";
                    element6.innerHTML  = "None";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }else{
                    var cell6           = row.insertCell(6);
                    var element6        = document.createElement("input");
                    element6.name       = "vlm[]";
                    element6.value      = "\xB175";
                    element6.innerHTML  = "\xB175";
                    element6.size       = "4";
                    cell6.appendChild(element6);
                }
            }

            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "hidden"
            element7.name       = "alat[]";
            element7.value      = noinv0;
            cell7.appendChild(element7);
            var element77       = document.createElement("p");
            element77.innerHTML = kode0;
            cell7.appendChild(element77);

            var cell8           = row.insertCell(8);
            var element8        = document.createElement("select");
            element8.name       = "pisah[]";
            var element71       = document.createElement("option");
            element71.value     = "1";
            element71.innerHTML = "otomatis";
            element8.appendChild(element71);
            var element72       = document.createElement("option");
            element72.value     = "0";
            element72.innerHTML = "Manual";
            element8.appendChild(element72);
            cell8.appendChild(element8);

            if (jenis_kantong0=="2"){
                if (i=="1") {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "1";
                    element90.innerHTML = "Ya";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "0";
                    element91.innerHTML = "Tidak";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                } else {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "0";
                    element90.innerHTML = "Tidak";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "1";
                    element91.innerHTML = "Ya";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                }
            }
            if (jenis_kantong0=="3"){
                if (i=="0") {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "0";
                    element90.innerHTML = "Tidak";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "1";
                    element91.innerHTML = "Ya";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                } else if (i=="1") {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "0";
                    element90.innerHTML = "Tidak";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "1";
                    element91.innerHTML = "Ya";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                } else {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "1";
                    element90.innerHTML = "Ya";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "0";
                    element91.innerHTML = "Tidak";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                }
            }
            /** Volume Default pada Jenis Kantong Quadruple */
            if (jenis_kantong0=="4") {
                if(merk0=="JMS"){
                    if(metoda0=="TTB" || metoda0=="TBB"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            }
                        }else{
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            }
                        }
                    }
                    if(metoda0=="TTF" || metoda0=="TBF"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            }
                        }else{
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            }
                        }
                    }
                }else{
                    if(metoda0=="TTB" || metoda0=="TBB"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            }
                        }else{
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            }
                        }
                    }
                    if(metoda0=="TTF" || metoda0=="TBF"){
                        if(tgl_aftap0<tgl4){
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            }
                        }else{
                            if (i=="0") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                cell9.appendChild(element9);
                            } else if (i=="1") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else if (i=="2") {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "1";
                                element91.innerHTML = "Ya";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "0";
                                element90.innerHTML = "Tidak";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            } else {
                                var cell9 = row.insertCell(9);
                                var element9 = document.createElement("select");
                                element9.name = "musnahkan[]";
                                var element91 = document.createElement("option");
                                element91.value = "0";
                                element91.innerHTML = "Tidak";
                                element9.appendChild(element91);
                                var element90 = document.createElement("option");
                                element90.value = "1";
                                element90.innerHTML = "Ya";
                                element9.appendChild(element90);
                                cell9.appendChild(element9);
                            }
                        }
                    }
                }
            }
            if (jenis_kantong0=="6" && status0=="2"){
                if (i=="0") {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "1";
                    element90.innerHTML = "Ya";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "0";
                    element91.innerHTML = "Tidak";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                } else if (i=="5") {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "1";
                    element90.innerHTML = "Ya";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "0";
                    element91.innerHTML = "Tidak";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                } else {
                    var cell9 = row.insertCell(9);
                    var element9 = document.createElement("select");
                    element9.name = "musnahkan[]";
                    var element90 = document.createElement("option");
                    element90.value = "0";
                    element90.innerHTML = "Tidak";
                    element9.appendChild(element90);
                    var element91 = document.createElement("option");
                    element91.value = "1";
                    element91.innerHTML = "Ya";
                    element9.appendChild(element91);
                    cell9.appendChild(element9);
                }

        }
        }
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
