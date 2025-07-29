<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script>
$('div.clickdate').live('click',function() {
     $("#datepicker").datepicker({
		yearRange: '2011:2020',
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		showOn: 'focus'
     }).focus();
});
</script>
<?
include "config/db_connect.php";
$utd=mysql_fetch_assoc(mysql_query("SELECT lat, lng FROM utd WHERE aktif='1'"));
?>
<script src="http://maps.google.co.id/maps/api/js?sensor=false&language=id" type="text/javascript"></script>
<script type="text/javascript">
function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=load&language=id";
    document.body.appendChild(script);
}

var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
//var mylat="-8.6754";
//var mylon="115.2121";
var mylat="<?=$utd[lat]?>";
var mylon="<?=$utd[lng]?>";
var start;
var end;
var pos;

function load(){
	directionsDisplay = new google.maps.DirectionsRenderer();
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition( loadM,loadM());
 	} else {
		//alert("I'm sorry, but geolocation services are not supported by your browser or you do not have a GPS device in your computer. I will use a sample location to produce the map instead.");
		loadM();  
	}  
}

function loadM(p) {
     map = new google.maps.Map(document.getElementById("map_canvas"), {
		mapTypeId: 'roadmap'
     });
     map.setZoom(11);
	if (typeof(p) == 'undefined') {
          pos=new google.maps.LatLng(mylat,mylon);
          map.setZoom(11);
     } else {
          pos=new google.maps.LatLng(p.coords.latitude,p.coords.longitude);
		mylat=p.coords.latitude;
		mylon=p.coords.longitude;
          map.setZoom(11);
     }
     
	map.setCenter(pos);
	var icon0 = 'images/distance.png';
	var marker = new google.maps.Marker({
	    position: pos,
	    map: map,
	    icon: icon0,
	    title:"Anda berada disini"
	});
	directionsDisplay.setMap(map);
	start = new google.maps.LatLng(mylat,mylon);
     var infoWindow1 = new google.maps.InfoWindow;
      
     var html0 = "<table>" +
                 "<tr><td>Instansi:</td> <td><input type='text' id='name'/> </td> </tr>" +
                 "<tr><td>Alamat:</td> <td><input type='text' id='address'/></td> </tr>" +
                 "<tr><td>Tanggal:</td> <td><div class='clickdate'><input type='text' id='datepicker'/> </div></td> </tr>" +
                 "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr></table>";
     infowindow = new google.maps.InfoWindow({
	content: html0,
	});		 
      // Change this depending on the name of your PHP file
     downloadUrl("modul/genxml_mobile.php", function(data) {
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName("marker");
		for (var i = 0; i < markers.length; i++) {
		    var today = new Date();
		    var tglfix= today.getDate();
		    var tglbsk= today.getDate()+1;
		    var bulan= today.getMonth()+1;
		    var tahun= today.getFullYear();
		    var tglskr=tahun+"-"+bulan+"-"+tglfix;
		    var tglbesok=tahun+"-"+bulan+"-"+tglbsk;
		    var name = markers[i].getAttribute("name");
		    var hintname= markers[i].getAttribute("name") + " - " +markers[i].getAttribute("tgl");
		    var tanggal = markers[i].getAttribute("tgl");
		    var tagala = markers[i].getAttribute("tgla");
		    var jumlah = markers[i].getAttribute("jumlah");
		    var jam_mulai = markers[i].getAttribute("jam_mulai");
		    var dokter = markers[i].getAttribute("dokter");
		    var sopir = markers[i].getAttribute("sopir");
		    var admin = markers[i].getAttribute("admin");
		    var atd1 = markers[i].getAttribute("atd1");
		    var atd2 = markers[i].getAttribute("atd2");
		    var atd3 = markers[i].getAttribute("atd3");
		    var kendaraan = markers[i].getAttribute("kendaraan");
		    var point = new google.maps.LatLng(
		         parseFloat(markers[i].getAttribute("lat")),
		         parseFloat(markers[i].getAttribute("lng"))
		    );
		    var html1 = "<b>" + name + "</b> <br>"
			      +"Waktu: "+tanggal+" Jam: "+jam_mulai +" Jumlah: "+jumlah
			      +"<br>Dokter: "+dokter+ ", Sopir: "+sopir+", Admin:"+admin+", ATD:"+atd1+","+atd2+","+atd3 
			      +"<br>Tunjukkan arah ke <a href=http://maps.google.co.id/maps?daddr="+
			      markers[i].getAttribute("lat")+","+markers[i].getAttribute("lng")+"&saddr="+mylat+","+mylon+" target=new><b>sini</b></a>";
		    var icon1 = 'images/udd_mobile_now.png';
		    var icon2 = 'images/udd_mobile.png';
		    var icon3 = 'images/udd_mobile_besok.png';
		    var icon4 = 'images/udd_bus_now.png';
		    var icon5 = 'images/udd_bus.png';
		    var icon6 = 'images/udd_bus_besok.png';
			if (tagala ==  tglskr) {
			      if (kendaraan=='0') {var marker = new google.maps.Marker({map : map, position : point, icon : icon4, title: hintname});
			      } else{var marker = new google.maps.Marker({map : map, position : point, icon : icon1, title: hintname});}
			} else if(tagala ==  tglbesok) {
			      if (kendaraan=='0') {var marker = new google.maps.Marker({map : map, position : point, icon : icon6, title : hintname});
			      } else {var marker = new google.maps.Marker({map : map, position : point, icon : icon3, title : hintname});}
			} else {
			      if (kendaraan=='0') {var marker = new google.maps.Marker({map : map, position : point, icon : icon5, title : hintname});
			      } else {var marker = new google.maps.Marker({map : map, position : point, icon : icon2, title : hintname});}
			}
		bindInfoWindow(marker, map, infoWindow1, html1);
        }
     });
}

function saveData() {
     var name = escape(document.getElementById("name").value);
     var address = escape(document.getElementById("address").value);
     var datepicker = document.getElementById("datepicker").value;
     var latlng = marker0.getPosition();
     var url = "modul/addrow.php?name=" + name + "&address=" + address +
                "&datepicker=" + datepicker + "&lat=" + latlng.lat() + "&lng=" + latlng.lng();
     downloadUrl(url, function(data, responseCode) {
		if (responseCode == 200) {
			infowindow.close();
			document.getElementById("message").innerHTML = "Location added.";
			window.location.reload();
		}
     });
}
   
function bindInfoWindow(marker, map, infoWindow1, html1) {
     google.maps.event.addListener(marker, 'click', function() {
		end = marker.position;
		calcRoute();
		//map.setZoom(11);
		infoWindow1.setContent(html1);
		infoWindow1.open(map, marker);
     });
}

function calcRoute() {
	var request = {
        origin:start, 
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		}
	});
}

function downloadUrl(url, callback) {
	var request = window.ActiveXObject ?
     new ActiveXObject('Microsoft.XMLHTTP') :
     new XMLHttpRequest;
	request.onreadystatechange = function() {
		if (request.readyState == 4) {
		     request.onreadystatechange = doNothing;
		     callback(request, request.status);
		}
     };
     request.open('GET', url, true);
     request.send(null);
}


function doNothing() {}
  
window.onload = load;
  </script>
