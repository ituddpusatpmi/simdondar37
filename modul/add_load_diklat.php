<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
	$('#instansi').autocomplete({source:'modul/suggest_diklat.php', minLength:2});
	});
</script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.2.custom.css" />
<style type="text/css">li.ui-menu-item { font-size:12px !important; }</style>
<script>
$(function(){
$('div.clickdate').live('click',function() {
                    $("#datepicker").datepicker({
       yearRange: '2012:3020',
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
	showOn: 'focus'
            }).focus();
            });
});
	</script>
    <script src="http://maps.google.co.id/maps/api/js?sensor=false&language=id" type="text/javascript"></script>
    <script type="text/javascript">
var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
     var mylat="-1.0000";
     var mylon="110.415688";
     var start;
     var end;
     var pos;

var geocoder = new google.maps.Geocoder();
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
  document.getElementById('address0').innerHTML = str;
}
function updateMarkerLatLng(latLng,nama) {
	document.dinstansi.infolat.value = latLng.lat();
	document.dinstansi.infolng.value = latLng.lng();
}
         function load(){
	directionsDisplay = new google.maps.DirectionsRenderer();
if (navigator.geolocation) 
	{
		navigator.geolocation.getCurrentPosition( loadM,loadM());
 	} 
 	else 
 	{
	  //alert("I'm sorry, but geolocation services are not supported by your browser or you do not have a GPS device in your computer. I will use a sample location to produce the map instead.");
	  loadM();  
	}  
}
    function loadM(p) {
    gbarOptions={
     resultList : document.getElementById('result_search')
    };
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
    map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push((window.gbar=new window.jeremy.jGoogleBar(map,gbarOptions)).container);
var marker = new google.maps.Marker({
	    position: pos,
	    map: map,
	    icon: icon0,
	    title:"You are here"
	});
		directionsDisplay.setMap(map);
	start = new google.maps.LatLng(mylat,mylon);
      var infoWindow1 = new google.maps.InfoWindow;
      
       infowindow = new google.maps.InfoWindow({
	  content: 'heloo',
	});		 
      google.maps.event.addListener(map, "rightclick", function(event) {
        marker0 = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
        google.maps.event.addListener(marker0, "click", function() {
      	var latlng = marker0.getPosition();
      	var html0 = "<table><tr><td>Alamat:</td> <td><input type='text' id='address'/></td> </tr>" +
                 "<tr><td>Tanggal:</td> <td><div class='clickdate'><input type='text' id='datepicker'/> </div></td> </tr>"+
		"<tr><td>Latittude</td><td><input type='text' id='infolat' value="+ latlng.lat() + "/></td></tr>"+
		"<tr><td>Longittude</td><td><input type='text' id='infolng' value="+ latlng.lng() + "/></td></tr>"+
                 "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr></table></form>";
  	//document.getElementById('form_instansi').innerHTML = html0;
	document.dinstansi.infolat.value = latlng.lat();
	document.dinstansi.infolng.value = latlng.lng();
	document.dinstansi.instansi.value ='';
 	document.dinstansi.namainstansi.value ='';
	document.dinstansi.jumlah.value ='';
	document.dinstansi.datepicker.value ='';
	document.dinstansi.jam_mulai.value ='';
	  
          //infowindow.open(map, marker0);
        });
    });
      // Change this depending on the name of your PHP file
      downloadUrl("modul/genxml_diklat.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var jumlah = markers[i].getAttribute("jumlah");
          var instansi = markers[i].getAttribute("kodeinstansi");
          var tgl = markers[i].getAttribute("tgl");
          var jam_mulai = markers[i].getAttribute("jam_mulai");
          var id_mu = markers[i].getAttribute("id_mu");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html1 = "<b>" + name + "</b> <br/>"
                    + "<br/>Directions to <a href=http://maps.google.co.id/maps?daddr="+
                        markers[i].getAttribute("lat")+","+markers[i].getAttribute("lng")+"&saddr="+mylat+","+mylon+" target=new><b>Here</b></a>"+
			"<br/><img src=images/blood.png>";
          
	  var icon1 = 'images/udd_diklat.png';
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon1,
	    draggable: true,
	    title: name
          });
          bindInfoWindow(marker, map, infoWindow1, html1, instansi, jumlah, tgl, id_mu,jam_mulai);
        }
      });
    }

    function saveData() {
      var instansi = escape(document.getElementById("instansi").value);
      var jumlah = document.getElementById("jumlah").value;
      var jam_mulai = escape(document.getElementById("jam_mulai").value);
      var datepicker = document.getElementById("datepicker").value;
      var lat = document.getElementById("infolat").value;
      var lng = document.getElementById("infolng").value;
      var id_mu = document.getElementById("id_mu").value;

      var url = "modul/add_diklat.php?instansi=" + instansi + "&jumlah=" + jumlah + "&jam_mulai=" + jam_mulai +
	"&datepicker=" + datepicker + "&lat=" + lat + "&lng=" + lng + "&id_mu=" + id_mu;
      downloadUrl(url, function(data, responseCode) {
        if (responseCode == 200) {
          document.getElementById("form_instansi").innerHTML = "<b>Jadwal DIKLAT telah berhasil ditambahkan/diUpdate.</b>";
		document.dinstansi.reset();
		load();
        }
      });
    }
   
    
    function bindInfoWindow(marker, map, infoWindow1, html1, instansi, jumlah, tgl, id_mu,jam_mulai) {
      google.maps.event.addListener(marker, 'click', function() {
	end = marker.position;
	//calcRoute();
	  //map.setZoom(11);
        //infoWindow1.setContent(html1);
        //infoWindow1.open(map, marker);
	var latlng = marker.getPosition();
	document.dinstansi.infolat.value = latlng.lat();
	document.dinstansi.infolng.value = latlng.lng();
	document.dinstansi.instansi.value = instansi;
	document.dinstansi.jumlah.value = jumlah;
	document.dinstansi.datepicker.value = tgl;
	document.dinstansi.jam_mulai.value = jam_mulai;
      });
      google.maps.event.addListener(map, "rightclick", function(event) {
	if (!marker0) {
        marker0 = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
	}
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
	var latLng=marker.getPosition();
	document.dinstansi.infolat.value = latLng.lat();
	document.dinstansi.infolng.value = latLng.lng();
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
	document.dinstansi.id_mu.value = id_mu; 
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
	left:5px;top:5px;position:absolute;width: 76%; height: 423px;
      }
      #form_instansi1 {
	position:absolute;top:5px;left:77.0%; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;
	}
      #infoPanel {
	position:absolute;top:235px;left:77.0%; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;
      }
      #infoPanel div {
        margin-bottom: 0px;
        margin-top: 0px;
	font-family: Arial; 
	font-size: 9px;
      }
   #resultsCanvas{
    height:100%;
    width:25%;
    float:left;
   }
      </style>
    <div id="map_canvas"></div>
	<div id="form_instansi1">
				<fieldset>
		<form name='dinstansi'>
		<table>
		<tr><td>Latittude</td><td><input type='text' id='infolat' /></td></tr>
		<tr><td>Longittude</td><td><input type='text' id='infolng' /></td></tr>
		<tr><td>Nama Diklat</td><td><input type='text' id='instansi'></td></tr>
		<tr><td>Jumlah Peserta</td><td><input type='text' id='jumlah'/></td> </tr>
                <tr><td>Tanggal</td> <td><div class='clickdate'><input type='text' id='datepicker'/> </div></td> </tr>
      		<tr><td>Jam</td> <td><input type='text' id='jam_mulai'/></td></tr>
                <tr><td></td><td><input type='hidden' id='id_mu'> <input type='button' value='Save & Reset' onclick='saveData()'/></td></tr>
		</table></form>
				</fieldset>
	<div id="form_instansi">
	</div>
	</div>
      <div id="infoPanel">
        <div id="directionsPanel"></div>
<br><br>
<b>Marker status:</b>
<div id="markerStatus"><i>Click and drag the marker.</i></div>
<b>Current position:</b>
<div id="info"></div>
<b>Closest matching address:</b>
        <div id="address0"></div>
  <script type="text/javascript" src="js/jGoogleBarV3.min.js"></script>
	<div id="result_search"></div>
      </div>
