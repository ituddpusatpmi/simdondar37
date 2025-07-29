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

/*var row_id;
$(function(){
    $('tr').click(function(){
        alert(this.rowIndex);
    });
});
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
var noinv1;
var nmalat1;
var kode1;
var valid_kantong0;
var ktgl;
var kawal;
var kakhir;
function addRow(tableID) {
    var NoKantong   = document.komponen.nokantong.value;
    var mesin       = document.komponen.mesin.value;
    var pisah       = document.komponen.pisah.value;
    var Wkomp        = document.komponen.nokantong.value;
    NoKantong       = NoKantong.toUpperCase();
    var lkantong    = NoKantong.length-1;
    
    tipex        = NoKantong.substring(8);
    if (tipex == "A" || tipex == "B" || tipex == "C" || tipex == "D" || tipex == "E" || tipex == "F") {
        tipe        = NoKantong.substring(8);
    } else {
            tipex       = NoKantong.substring(9);
            if (tipex == "A" || tipex == "B" || tipex == "C" || tipex == "D" || tipex == "E" || tipex == "F"){
            tipe        = NoKantong.substring(9);
            }else{
                tipex       = NoKantong.substring(10);
                if (tipex == "A" || tipex == "B" || tipex == "C" || tipex == "D" || tipex == "E" || tipex == "F"){
                    tipe        = NoKantong.substring(10);
                }else{
                    tipe        = NoKantong.substring(7);
                }
                
            }
    }
    
    //tipe        = NoKantong.substring(8);
    
    jenis_kantong0  = "";
    cputar        = "";
    wputar        = "";
    sputar        = "";
    merk0           = "";
    metoda0         = "";
    noinv0          = "";
    nmalat0         = "";
    kode0        = "";
    noinv1          = "";
    nmalat1         = "";
    kode1        = "";
    valid_kantong0  = "";
    ktgl              = "";
    kawal           = "";
    kakhir        = "";
    
    
    durasi0 = "";
    var jkantong    = check3(NoKantong);
    var jmesin      = check4(mesin);
    var jnoKan        = check5(Wkomp);
    var jpisah        = check6(pisah);
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

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);


    //FUNGSI KADALUARSA
            function kadaluwarsa1(rc) {
                jkomp=$("#0jeniskomponen"+rc).val();
                tgl0 = Date.parse(tgl_aftap0).add(35).days();
                tgl4 = Date.today();
                        
                if (jkomp=='WE')
                    tgl0 = Date.today().setTimeToNow().add(5).hours();
                if (jkomp=='PRC' && jenis_kantong0=="2")
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
        if (jkomp=='PRC' && jenis_kantong0=="3")
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
            if (jkomp=='PRC' && jenis_kantong0=="4")
                    tgl0 = Date.parse(tgl_aftap0).add(42).days();
                if (jkomp=='TC')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='FFP')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
		if (jkomp=='FP')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
		if (jkomp=='FP 72')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
                if (jkomp=='AHF')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='LP')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jkomp=='BC')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='PRC Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
        if (jkomp=='PRC Leucodepleted')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
                if (jkomp=='FFP Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
                if (jkomp=='TC Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='LP Leucoreduced')
                    tgl0 = Date.parse(tgl_aftap0).add(35).days();
        if (jkomp=='TC Apheresis')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
                if (jkomp=='PRC Apheresis')
                    tgl0 = Date.parse(tgl_aftap0).add(42).days();
                if (jkomp=='LP Apheresis')
                    tgl0 = Date.parse(tgl_aftap0).add(5).days();
        if (jkomp=='FFP Konvalesen')
                    tgl0 = Date.parse(tgl_aftap0).add(365).days();
                tgl1 = tgl0.toString('yyyy-MM-dd HH:mm:ss');
                $("#0kadaluwarsa"+rc).val(tgl1);
                if (jkomp=='PRP')
                    tgl0 = Date.today().setTimeToNow().add(4).hours();
            }

    

            
            // Insert Row untuk No.Kantong //
            var cell0           = row.insertCell(0);
            var element0        = document.createElement("input");
            element0.type       = "hidden";
            element0.name       = "no_kantong[]";
            element0.value      = NoKantong;
            cell0.appendChild(element0);
            var element00        = document.createElement("p");
            element00.innerHTML  = NoKantong;
            cell0.appendChild(element00);
            

            // Insert Row untuk Taggal Aftap //
            var cell1           = row.insertCell(1);
            var element1        = document.createElement("p");
        element1.id        = "tglaftap"+rowCount;
            element1.innerHTML  = tgl_aftap0;
            cell1.appendChild(element1);

            // Insert Row untuk ABO (Rh) //
            var cell2           = row.insertCell(2);
            var element2        = document.createElement("p");
            element2.innerHTML  = gol_darah0+'('+rhs_darah0+')';
            cell2.appendChild(element2);

        // Insert Row untuk Jenis Kantong (Single,Double,...etc) //
            var cell3          = row.insertCell(3);
            var element3       = document.createElement("p");
            element3.innerHTML = jnsktg;
            element3.value     = jenis_kantong0;
            cell3.appendChild(element3);
        
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
            element5.value      = '';
            cell5.appendChild(element5);

            // Alat Pemutaran
        var cell6           = row.insertCell(6);
            var element6        = document.createElement("input");
            element6.type       = "hidden"
            element6.name       = "alat[]";
            element6.value      = kode0;
            cell6.appendChild(element6);
            var element66       = document.createElement("p");
            element66.innerHTML = kode0;
            cell6.appendChild(element66);
        var element666        = document.createElement("input");
            element666.type       = "hidden"
            element666.name       = "alatpisah[]";
            element666.value      = kode1;
            cell6.appendChild(element666);
     
       // Insert Row untuk Kecepatan Pemutaran (Default by Sistem or Manually) //
        //Double
        if (jenis_kantong0=='2'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "3000";
            cell7.appendChild(element7);
        }    //Triple
        if (jenis_kantong0=='3' && tipe=='A'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "2000";
            cell7.appendChild(element7);
        }
        if (jenis_kantong0=='3' && tipe=='B'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "3000";
            cell7.appendChild(element7);
        }
        if (jenis_kantong0=='3' && tipe=='C'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "3000";
            cell7.appendChild(element7);
        }
        //Quadriple
        if (jenis_kantong0=='4' && tipe=='A'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "4000";
            cell7.appendChild(element7);
        }
        if (jenis_kantong0=='4' && tipe=='B'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "170";
            cell7.appendChild(element7);
        }
        if (jenis_kantong0=='4' && tipe=='C'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "3000";
            cell7.appendChild(element7);
        }
        if (jenis_kantong0=='4' && tipe=='D'){
            var cell7           = row.insertCell(7);
            var element7        = document.createElement("input");
            element7.type       = "text";
            element7.name       = "kecepatan[]";
            element7.id         = "0kecepatan";
        element7.size       = "7";
            element7.value      = "4000";
            cell7.appendChild(element7);
        }


       // Insert Row Suhu Pemutaran (Default by Sistem or Manually) //
        //Double
        if (jenis_kantong0=='2'){
            var cell8           = row.insertCell(8);
            var element8      = document.createElement("input");
            element8.type       = "text";
            element8.name       = "suhu1[]";
            element8.id         = "0suhu";
        element8.size       = "4";
            element8.value      = "4";
            cell8.appendChild(element8);
        }
        //Triple
        if (jenis_kantong0=='3'){
            var cell8           = row.insertCell(8);
            var element8      = document.createElement("input");
            element8.type       = "text";
            element8.name       = "suhu1[]";
            element8.id         = "0suhu";
        element8.size       = "4";
            element8.value      = "22";
            cell8.appendChild(element8);
        }
        //Quadriple
        if (jenis_kantong0=='4' && tipe=='A'){
            var cell8           = row.insertCell(8);
            var element8      = document.createElement("input");
            element8.type       = "text";
            element8.name       = "suhu1[]";
            element8.id         = "0suhu";
        element8.size       = "4";
            element8.value      = "22";
            cell8.appendChild(element8);
        }
        if (jenis_kantong0=='4' && tipe=='B'){
            var cell8           = row.insertCell(8);
            var element8      = document.createElement("input");
            element8.type       = "text";
            element8.name       = "suhu1[]";
            element8.id         = "0suhu";
        element8.size       = "4";
            element8.value      = "22";
            cell8.appendChild(element8);
        }
        if (jenis_kantong0=='4' && tipe=='C'){
            var cell8           = row.insertCell(8);
            var element8      = document.createElement("input");
            element8.type       = "text";
            element8.name       = "suhu1[]";
            element8.id         = "0suhu";
        element8.size       = "4";
            element8.value      = "4";
            cell8.appendChild(element8);
        }
        if (jenis_kantong0=='4' && tipe=='D'){
            var cell8           = row.insertCell(8);
            var element8      = document.createElement("input");
            element8.type       = "text";
            element8.name       = "suhu1[]";
            element8.id         = "0suhu";
        element8.size       = "4";
            element8.value      = "22";
            cell8.appendChild(element8);
        }

    
       // Insert Row waktu Pemutaran (Default by Sistem or Manually) //
        //Double
        if (jenis_kantong0=='2'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "12";
            cell9.appendChild(element9);
        }    //Triple
        if (jenis_kantong0=='3' && tipe=='A'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "10";
            cell9.appendChild(element9);
        }
        if (jenis_kantong0=='3' && tipe=='B'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "20";
            cell9.appendChild(element9);
        }
        if (jenis_kantong0=='3' && tipe=='C'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "20";
            cell9.appendChild(element9);
        }    //Quadriple
        if (jenis_kantong0=='4' && tipe=='A'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "14";
            cell9.appendChild(element9);
        }
        if (jenis_kantong0=='4' && tipe=='B'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "12";
            cell9.appendChild(element9);
        }
        if (jenis_kantong0=='4' && tipe=='C'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "12";
            cell9.appendChild(element9);
        }
        if (jenis_kantong0=='4' && tipe=='D'){
            var cell9           = row.insertCell(9);
            var element9      = document.createElement("input");
            element9.type       = "text";
            element9.name       = "waktu[]";
            element9.id         = "0waktu";
        element9.size       = "4";
            element9.value      = "15";
            cell9.appendChild(element9);
        }

        // Insert Volume (Default by Sistem or Manually) //
            if (jenis_kantong0=="2"){
                if (tipe=="B") {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB150";
                    element10.innerHTML  = "\xB150";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }else{
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB150";
                    element10.innerHTML  = "\xB150";
                    element10.size        = "4";
                    cell10.appendChild(element10);
                }
            }
            if (jenis_kantong0=="3"){
                if (tipe=="A") {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB1200";
                    element10.innerHTML  = "\xB1200";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }else if (tipe=="B") {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB150";
                    element10.innerHTML  = "\xB150";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }else{
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB1150";
                    element10.innerHTML  = "\xB1150";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }
            }
            if (jenis_kantong0=="4"){
                if (tipe=="A") {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB1200";
                    element10.innerHTML  = "\xB1200";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }else if (tipe=="B") {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB150";
                    element10.innerHTML  = "\xB150";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }else if (tipe=="C") {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB1150";
                    element10.innerHTML  = "\xB1150";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }else {
                    var cell10           = row.insertCell(10);
                    var element10        = document.createElement("input");
                    element10.name       = "vlm[]";
                    element10.value      = "\xB150";
                    element10.innerHTML  = "\xB150";
                    element10.size       = "4";
                    cell10.appendChild(element10);
                }
            }
            

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
        element12.size       = "10";
        if (kawal==""){
        awal0 = new Date;
            awal1 = awal0.toString('HH:mm:ss');
            element12.value      = awal1;
        } else {
        element12.value      = kawal;
        }
            cell12.appendChild(element12);
            
        // Insert selesai (Default by Sistem or Manually) //
            var cell13           = row.insertCell(13);
            var element13      = document.createElement("input");
            element13.type       = "text";
            element13.name       = "selesai[]";
            element13.id         = "0selesai";
        element13.size       = "10";
        if (kakhir==""){
        akhir0= new Date().add(0.45).hours();
        
            akhir1 = akhir0.toString('HH:mm:ss');
            element13.value      = akhir1;
        } else {
        element13.value      = kakhir;
        }
            cell13.appendChild(element13);

            // Insert pembekuan (Default by Sistem or Manually) //
            var cell14 = row.insertCell(14);
                    var element14 = document.createElement("select");
                    element14.name = "beku[]";
                    var element141 = document.createElement("option");
                    element141.value = "0";
                    element141.innerHTML = "Tidak";
                    element14.appendChild(element141);
                    var element142 = document.createElement("option");
                    element142.value = "1";
                    element142.innerHTML = "Ya";
                    element14.appendChild(element142);
                    cell14.appendChild(element14);

        // Insert selesai (Default by Sistem or Manually) //
            var cell15           = row.insertCell(15);
            var element15      = document.createElement("input");
            element15.type       = "text";
            element15.name       = "suhuinti[]";
            element15.id         = "0ssuhuinti";
        element15.size       = "4";
            element15.value      = '-';
            cell15.appendChild(element15);


            // Insert Row untuk Jenis Kantong (Single,Double,...etc) //
        // Double  A

        if (merk0=="HAEMONETIC" || merk0=="COM.TECH" || merk0=="AMICORE") {
                  var element41       = document.createElement("option");
                    element41.value     = "TC Apheresis";
                    element41.innerHTML = "TC Apheresis";
            element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "LP Apheresis";
                    element42.innerHTML = "LP Apheresis";
                    element4.appendChild(element42);
            var element43       = document.createElement("option");
                    element43.value     = "PRC Apheresis";
                    element43.innerHTML = "PRC Apheresis";
            element4.appendChild(element43);
                    var element44       = document.createElement("option");
                    element44.value     = "FFP Konvalesen";
                    element44.innerHTML = "FFP Konvalesen";
            tgl0 = Date.parse(tgl_aftap0).add(365).days();
                    element4.appendChild(element44);

            
            
            }
        else if (jenis_kantong0=="2" && tipe=="A") {
            var element41       = document.createElement("option");
                    element41.value     = "PRC";
                    element41.innerHTML = "PRC";
            element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "WE";
                    element42.innerHTML = "WE";
                    element4.appendChild(element42);
            }    // Double  B
            else if (jenis_kantong0=="2" && tipe=="B") {
                    var element41       = document.createElement("option");
					element41.value    = "LP";
                    element41.innerHTML= "LP";
                    element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "FP";
                    element42.innerHTML = "FP";
                    element4.appendChild(element42);
                    var element43       = document.createElement("option");
                    element43.value     = "FP 72";
                    element43.innerHTML = "FP 72";
                    element4.appendChild(element43);
                    var element44       = document.createElement("option");
                    element44.value    = "FFP";
                    element44.innerHTML= "FFP";
                    element4.appendChild(element44);
                    var element45       = document.createElement("option");
                    element45.value    = "PRP";
                    element45.innerHTML= "PRP";
                    element4.appendChild(element45);
		    var element46       = document.createElement("option");
                    element46.value    = "AHF";
                    element46.innerHTML= "AHF";
                    element4.appendChild(element46);

        
            }
            //Triple A
            else if (jenis_kantong0=="3" && tipe=="A") {
                    var element41       = document.createElement("option");
                    element41.value     = "PRC";
                    element41.innerHTML = "PRC";
                    element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "WE";
                    element42.innerHTML = "WE";
                    element4.appendChild(element42);
        
            }
        //Triple Kantong B
        else if (jenis_kantong0=="3" && tipe=="B") {
        var element41       = document.createElement("option");
                element41.value     = "TC";
                element41.innerHTML = "TC";
                element4.appendChild(element41);
        var element42       = document.createElement("option");
                element42.value     = "PRP";
                element42.innerHTML = "PRP";
                element4.appendChild(element42);
                
        }
        
        //Triple Kantong C
        else if (jenis_kantong0=="3" && tipe=="C") {
            var element41       = document.createElement("option");
                    element41.value     = "LP";
                    element41.innerHTML = "LP";
                    element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "FP";
                    element42.innerHTML = "FP";
                    element4.appendChild(element42);
                    var element43       = document.createElement("option");
                    element43.value     = "FP 72";
                    element43.innerHTML = "FP 72";
                    element4.appendChild(element43);
                    var element44       = document.createElement("option");
                    element44.value     = "FFP";
                    element44.innerHTML = "FFP";
                    element4.appendChild(element44);
		    var element45       = document.createElement("option");
                    element45.value     = "AHF";
                    element45.innerHTML = "AHF";
                    element4.appendChild(element45);
                
        }
            //Quadriple A
            else if (jenis_kantong0=="4" && tipe=="A") {
                    var element41      = document.createElement("option");
                    element41.value     = "PRC";
                    element41.innerHTML = "PRC";
                    element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "PRC Leucoreduced";
                    element42.innerHTML = "PRC Leucoreduced";
                    element4.appendChild(element42);
        
            }
            else if (jenis_kantong0=="4" && tipe=="B") {
                    var element41      = document.createElement("option");
                    element41.value     = "TC";
                    element41.innerHTML = "TC";
                    element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "TC Leucoreduced";
                    element42.innerHTML = "TC Leucoreduced";
                    element4.appendChild(element42);
        
            }
            else if (jenis_kantong0=="4" && tipe=="C") {
                    var element41      = document.createElement("option");
                    element41.value     = "FFP";
                    element41.innerHTML = "FFP";
                    element4.appendChild(element41);
                    var element42       = document.createElement("option");
                    element42.value     = "FFP Leucoreduced";
                    element42.innerHTML = "FFP Leucoreduced";
                    element4.appendChild(element42);
            var element43      = document.createElement("option");
                    element43.value     = "LP";
                    element43.innerHTML = "LP";
                    element4.appendChild(element43);
                    var element44       = document.createElement("option");
                    element44.value     = "LP Leucoreduced";
                    element44.innerHTML = "LP Leucoreduced";
                    element4.appendChild(element44);
		    var element45       = document.createElement("option");
                    element45.value     = "FP";
                    element45.innerHTML = "FP";
                    element4.appendChild(element45);
                    var element46       = document.createElement("option");
                    element46.value     = "FP 72";
                    element46.innerHTML = "FP 72";
                    element4.appendChild(element46);
        
            }
            else if (jenis_kantong0=="4" && tipe=="D") {
                    var element41      = document.createElement("option");
                    element41.value     = "BC";
                    element41.innerHTML = "BC";
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
            valid_kantong0  = json.darah.valid;
        }
    });
}

function check4(mesin)
{ $.ajax({
        url: "json_mesin_laborat.php?mesin="+mesin,
    async: false,
    dataType: 'json',
        success: function(json) {
        noinv0       = json.alat.noinv;
            nmalat0      = json.alat.nmalat;
            noseri0     = json.alat.noseri;
        kode0    = json.alat.kode;
        }
    });
}

function check6(pisah)
{ $.ajax({
        url: "json_mesin_laborat.php?mesin="+pisah,
    async: false,
    dataType: 'json',
        success: function(json) {
        noinv1       = json.alat.noinv;
            nmalat1      = json.alat.nmalat;
            noseri1     = json.alat.noseri;
        kode1    = json.alat.kode;
        }
    });
}

function check5(Wkomp)
{ $.ajax({
        url: "json_waktu_komponen.php?NoKantong="+Wkomp,
    async: false,
    dataType: 'json',
        success: function(json) {
        knokan      = json.komp.kantong;
            ktgl          = json.komp.tanggal;
            kawal         = json.komp.mulai;
        kakhir    = json.komp.selesai;
        }
    });
}
