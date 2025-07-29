var kode = "123456";
var nama = "Areil";
function pdf3() {
kode = document.cetakid.kode1.value;
nama = document.cetakid.nama1.value;
//var tgllahir = document.cetak.tgllahir.value;
//var goldarah = document.cetak.goldarah.value;
//var rhesus = document.cetak.rhesus.value;
var http = new XMLHttpRequest();
var url = "idcard_full.php";
//var kode = "ABC12345";
//var params = "idpendonor="+kode+"&nama="+nama+"&tgllahir="+tgllahir+"&goldarah="+goldarah+"&rhesus="+rhesus;
var params = "idpendonor="+kode
http.open("GET", url+"?"+params, true);
http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4 && http.status == 200) {
		//alert(http.responseText);
		objAdobePrint1.document.location.reload();
		setTimeout("printfile()",30);
	}
}
http.send(null);
}
function printfile()
{
            window.frames['objAdobePrint1'].focus();
            //window.frames['objAdobePrint1'].print();
	    //window.parent.objAdobePrint.contentWindow.print();
	    window.objAdobePrint1.print();
	    //window.print();
            
}
