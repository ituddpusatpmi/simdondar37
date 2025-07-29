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
var gol_darah0;
var rhs_darah0;
var tgl_aftap0;
var status0;
var durasi0;
var noinv0;
var nmalat0;
var valid_kantong0;
function addRow(tableID) {
    var NoKantong   = document.komponen.nokantong.value;
    var mesin       = document.komponen.mesin.value;
    NoKantong       = NoKantong.toUpperCase();
    var lkantong    = NoKantong.length-1;
    jenis_kantong0  = "";
    noinv0          = "";
    nmalat0         = "";
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

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            function kadaluwarsa1(rc) {
                jkomp=$("#0jeniskomponen"+rc).val();
                //alert(jkomp);
                tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jenis_kantong0=='2' && i=='1')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jenis_kantong0=='3' && i=='1')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jenis_kantong0=='3' && i=='2')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
//                    if (jenis_kantong0=='3' && i=='2')
//                        tgl0 = Date.parse(tgl_aftap0).add(1).years();
                if (jkomp=='WE')
                    tgl0 = Date.today().setTimeToNow().add(5).hours();

                //if (rc=='3') tgl0 = Date.today().add(5).days();
                //     alert(tgl0)
                tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
                $("#0kadaluwarsa"+rc).val(tgl1);
                //$("#1kadaluwarsa"+rc).html(tgl1);
                //     alert(jkomp);
            }

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
            } else if (i=="0") {
                if (i == "0") {
                    var element42       = document.createElement("option");
                    element42.value     = "PRC";
                    element42.innerHTML = "PRC";
                    element4.appendChild(element42);
                    var element43       = document.createElement("option");
                    element43.value     = "WE";
                    element43.innerHTML = "WE";
                    element4.appendChild(element43);
                    var element44       = document.createElement("option");
                    element44.value     = "WB";
                    element44.innerHTML = "WB";
                    element4.appendChild(element44);
                }
            }
            if (jenis_kantong0=="3") {
                if (i=="2") {
                    var element44       = document.createElement("option");
                    element44.value     = "LP";
                    element44.innerHTML = "LP";
                    element4.appendChild(element44);
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
                if (i=="1") {
                    var element48       = document.createElement("option");
                    element48.value     = "TC";
                    element48.innerHTML = "TC";
                    element4.appendChild(element48);
                }
            }
            if (jenis_kantong0=="6" && status0=="2") {
                if (i=="0") {
                    var element49       = document.createElement("option");
                    element49.value     = "None";
                    element49.innerHTML = "None";
                    element4.appendChild(element49);
                }else if (i=="5") {
                    var element490      = document.createElement("option");
                    element490.value    = "None";
                    element490.innerHTML= "None";
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
            if (jenis_kantong0=="2") {
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
            element77.innerHTML = nmalat0;
            cell7.appendChild(element77);

            var cell8           = row.insertCell(8);
            var element8        = document.createElement("select");
            element8.name       = "pisah[]";
            var element71       = document.createElement("option");
            element71.value     = "0";
            element71.innerHTML = "Manual";
            element8.appendChild(element71);
            var element72       = document.createElement("option");
            element72.value     = "1";
            element72.innerHTML = "otomatis";
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
        }
    });
}
