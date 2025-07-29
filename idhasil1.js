function pdf1(nokantong) {
var http = new XMLHttpRequest();
var url = "idhasil.php";
var params = "nokantong="+nokantong;
http.open("GET", url+"?"+params, true);
http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4 && http.status == 200) {
		//alert(http.responseText);
		objAdobePrint.document.location.reload();
		setTimeout("printfile()",30);
	}
}
http.send(null);
}
function printfile()
{
            window.frames['objAdobePrint'].focus();
            //window.frames['objAdobePrint'].print();
	    //window.parent.objAdobePrint.contentWindow.print();
	    window.objAdobePrint.print();
	    //window.print();
            
}
