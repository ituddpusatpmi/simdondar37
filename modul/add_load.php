<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
	$('#instansi').autocomplete({source:'modul/suggest_zip.php', minLength:2});
	});
</script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.2.custom.css" />
<style type="text/css">li.ui-menu-item { font-size:12px !important; }</style>
<script>
$(function(){
$('div.clickdate').live('click',function() {
                    $("#datepicker").datepicker({
       yearRange: '2015:3000',
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
	showOn: 'focus'
            }).focus();
            });
});
</script>
<?
include "config/db_connect.php";
$utd=mysql_fetch_assoc(mysql_query("SELECT lat, lng FROM utd WHERE aktif='1'"));
?>
<script src="http://maps.google.co.id/maps/api/js?sensor=false&language=id" type="text/javascript"></script>
<script type="text/javascript">
var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
    var marker0;
    var mylat="<?=$utd[lat]?>";
    var mylon="<?=$utd[lng]?>";
     var start;
     var end;
     var pos;
var geocoder = new google.maps.Geocoder();

         function load(){
	directionsDisplay = new google.maps.DirectionsRenderer();
if (navigator.geolocation) 
	{
		navigator.geolocation.getCurrentPosition( loadM,loadM());
 	} 
 	else 
 	{
	  loadM();  
	}  
}
    function loadM(p) {
      map = new google.maps.Map(document.getElementById("map_canvas"), {
        mapTypeId: 'roadmap'
      });
            map.setZoom(4);
         if (typeof(p) == 'undefined') {
            pos=new google.maps.LatLng(mylat,mylon);
            map.setZoom(4);
            } else {
            pos=new google.maps.LatLng(p.coords.latitude,p.coords.longitude);
		mylat=p.coords.latitude;
		mylon=p.coords.longitude;
            map.setZoom(9);
            }
              map.setCenter(pos);
	  var icon0 = 'images/distance.png';
var marker = new google.maps.Marker({
	    position: pos,
	    map: map,
	    icon: icon0,
	    title:"You are here"
	});
/*
		directionsDisplay.setMap(map);
	start = new google.maps.LatLng(mylat,mylon);
      var infoWindow1 = new google.maps.InfoWindow;
      
       infowindow = new google.maps.InfoWindow({
	  content: 'heloo',
	});		 
      google.maps.event.addListener(map, "rightclick", function(event) {
        marker0 = new google.maps.Marker({
          position: event.latLng,
	    draggable: true,
          map: map
        });
        google.maps.event.addListener(marker0, "click", function() {
      	var latlng = marker0.getPosition();
	document.dinstansi.infolat.value = latlng.lat();
	document.dinstansi.infolng.value = latlng.lng();
          //infowindow.open(map, marker0);
        });
  // Update current position info.
  updateMarkerPosition(marker0.getPosition());
  geocodePosition(marker0.getPosition());
  // Add dragging event listeners.
  google.maps.event.addListener(marker0, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker0, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker0.getPosition());
  });
  
  google.maps.event.addListener(marker0, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker0.getPosition());
  });
    });
      // Change this depending on the name of your PHP file
      downloadUrl("modul/genxml_mobile.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var kodeinstansi = markers[i].getAttribute("kodeinstansi");
          var address = markers[i].getAttribute("address");
          var tgl = markers[i].getAttribute("tgl");
          //var id_mu = markers[i].getAttribute("id_mu");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html1 = "<b>" + name + "</b> <br/>"
                    + address + "<br/>Directions to <a href=http://maps.google.co.id/maps?daddr="+
                        markers[i].getAttribute("lat")+","+markers[i].getAttribute("lng")+"&saddr="+mylat+","+mylon+" target=new><b>Here</b></a>"+
			"<br/><img src=images/blood.png>";
          
	  var icon1 = 'images/udd_mobile.png';
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon1,
	    draggable: true,
	    title: name
          });
          //bindInfoWindow(marker, map, infoWindow1, html1,kodeinstansi,address,tgl);
          //bindInfoWindow(marker, map, infoWindow1, html1,kodeinstansi,address,tgl,id_mu);
        }
      });
*/
    }

    function saveData() {
      var instansi = escape(document.getElementById("instansi").value);
      var address = escape(document.getElementById("address").value);
      var datepicker = document.getElementById("datepicker").value;
      var lat = document.getElementById("infolat").value;
      var lng = document.getElementById("infolng").value;
      //var id_mu = document.getElementById("id_mu").value;

      var url = "modul/add_mu.php?instansi=" + instansi + "&address=" + address +
                "&datepicker=" + datepicker + "&lat=" + lat + "&lng=" + lng;
// + "&id_mu=" + id_mu;
      downloadUrl(url, function(data, responseCode) {
        if (responseCode == 200) {
		document.dinstansi.reset();
          document.getElementById("form_instansi").innerHTML = "Jadwal MU telah berhasil ditambahkan.";
        }
      });
    }
   
    
    //function bindInfoWindow(marker, map, infoWindow1, html1,kodeinstansi,address,tgl,id_mu) {
    function bindInfoWindow(marker, map, infoWindow1, html1,kodeinstansi,address,tgl) {
      google.maps.event.addListener(marker, 'click', function() {
	end = marker.position;
	calcRoute();
	  //map.setZoom(11);
        //infoWindow1.setContent(html1);
        //infoWindow1.open(map, marker);
      	var latlng = marker.getPosition();
	document.dinstansi.infolat.value = latlng.lat();
	document.dinstansi.infolng.value = latlng.lng();
	document.dinstansi.instansi.value = kodeinstansi;
	document.dinstansi.address.value = address;
	document.dinstansi.datepicker.value = tgl;
      });
      google.maps.event.addListener(map, "rightclick", function(event) {
        marker0 = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
        google.maps.event.addListener(marker0, "click", function() {
      	var latlng = marker0.getPosition();
	document.dinstansi.infolat.value = latlng.lat();
	document.dinstansi.infolng.value = latlng.lng();
          //infowindow.open(map, marker0);
        });
    });
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
	//document.dinstansi.id_mu.value = id_mu;
      });
      updateMarkerLatLng(marker.getPosition(),marker.title);
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
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}
function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}
function updateMarkerLatLng(latLng,nama) {
	document.dinstansi.infolat.value = latLng.lat();
	document.dinstansi.infolng.value = latLng.lng();
}

    function doNothing() {}

  function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=load&language=id";
    document.body.appendChild(script);
  }
  
window.onload = load;
  </script>
     <style>
      #map_canvas {
	left:5px;top:5px;position:absolute;width: 78%; height: 423px;
      }
      #form_instansi1 {
	position:absolute;top:5px;left:79%; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;
	}
      #form_instansi {
	position:absolute;top:165px;left:79%; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;
	}
      #infoPanel {
	position:absolute;top:265px;left:79%; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;
      }
      #infoPanel div {
        margin-bottom: 0px;
        margin-top: 0px;
	font-family: Arial; 
	font-size: 9px;
      }
      </style>
    <div id="map_canvas"></div>
	<div id="form_instansi1">
				<fieldset>
		<form name='dinstansi'>
		<table>
		<tr><td>Latittude</td><td><input type='text' id='infolat' /></td></tr>
		<tr><td>Longittude</td><td><input type='text' id='infolng' /></td></tr>
		<tr><td>Instansi:</td><td><input type='text' id='instansi'></td></tr>
      		<tr><td>Alamat:</td> <td><input type='text' id='address'/></td></tr>
                 <tr><td>Tanggal:</td> <td><div class='clickdate'><input type='text' id='datepicker'/> </div></td> </tr>
                <tr><td></td><td><input type='button' value='Save & Reset' onclick='saveData()'/></td></tr>
		</table></form>
				</fieldset>
	</div>
	<div id="form_instansi">
	</div>
      <div id="infoPanel">
        <div id="directionsPanel"></div>
<b>Marker status:</b>
<div id="markerStatus"><i>Click and drag the marker.</i></div>
<b>Current position:</b>
<div id="info"></div>
<b>Closest matching address:</b>
        <div id="address"></div>
<b>Update Position:</b>
        <div id="address1"></div>
      </div>
Q+                  B  >                                 B          ����   #   /var/www/simudda/modul/add_load.php����        I    ����             