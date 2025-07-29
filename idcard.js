function pdf2(kode) {
var http = new XMLHttpRequest();
var url = "idcard_full.php";
var params = "idpendonor="+kode;
http.open("GET", url+"?"+params, true);
http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4 && http.status == 100) {
		alert('UDAH tercetak kan');
		//objAdobePrint.document.location.reload();
		//setTimeout("printfile()",10000);
		//printfile();
	}
}
http.send(null);
}
