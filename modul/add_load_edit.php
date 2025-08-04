<?php
require_once('config/db_connect.php');
session_start();
$namaudd = $_SESSION[namaudd];

$array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

$col3 = mysql_query("select * from kegiatan where tglpenjadwalan ='0000-00-00 00:00:00'");
if ($col3) {
  mysql_query("delete from kegiatan where tglpenjadwalan='0000-00-00 00:00:00'");
}
$col4 = mysql_query("SELECT `mu` FROM `kegiatan`");
if (!$col4) {
  mysql_query("ALTER TABLE `kegiatan`
ADD `mu` INT( 1 ) NOT NULL DEFAULT '2',
ADD `jammulai` TIME NULL ,
ADD `jamselesai` TIME NULL,
ADD `sukses` INT( 11 ) NOT NULL DEFAULT '0',
ADD `batal` INT( 11 ) NOT NULL DEFAULT '0',
ADD `gagal` INT( 11 ) NOT NULL DEFAULT '0' ");


  mysql_query("update kegiatan set tglpelaksanaan=tglpenjadwalan, status='1' where (status is NULL AND TglPelaksanaan not like '0000-00-00%' ");
  mysql_query("update kegiatan set sukses= (select count(distinct NoTrans) from htransaksi where tempat='m' and Pengambilan='0' and cast(tgl as date)=cast(kegiatan.TglPelaksanaan as date))");
  mysql_query("update kegiatan set batal= (select count(distinct NoTrans) from htransaksi where tempat='m' and Pengambilan='1' and cast(tgl as date)=cast(kegiatan.TglPelaksanaan as date))");
  mysql_query("update kegiatan set gagal= (select count(distinct NoTrans) from htransaksi where tempat='m' and Pengambilan='2' and cast(tgl as date)=cast(kegiatan.TglPelaksanaan as date))");
}

$null = mysql_query("SELECT * FROM `kegiatan` WHERE Status IS NULL");
if ($null) {
  mysql_query("ALTER TABLE `kegiatan` CHANGE `Status` `Status` INT( 1 ) NOT NULL DEFAULT '0'");
}

$survey = mysql_query("SELECT `survei` FROM `kegiatan`");
if (!$survey) {
  mysql_query("ALTER TABLE `kegiatan`
ADD `survei` INT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=Belum 1=Sudah',
ADD `tglsurvei` DATE NOT NULL DEFAULT '0000-00-00',
ADD `cp` VARCHAR(30 ) NULL DEFAULT NULL,
ADD `hpcp` VARCHAR(13 ) NULL DEFAULT NULL,
ADD `tempat` VARCHAR(15 ) NULL DEFAULT NULL,
ADD `surveyor` VARCHAR(30 ) NULL DEFAULT NULL,
ADD `layak` INT(1 ) NOT NULL DEFAULT '0',
ADD `ket` VARCHAR(35 ) NULL DEFAULT '-'");


  mysql_query("update kegiatan set Status='5' where Status='3' ");
  mysql_query("update kegiatan set Status='3' where Status='2' ");
  mysql_query("update kegiatan set Status='2' where Status='1' ");
  mysql_query("update kegiatan set Status='1' where Status='0' ");
  mysql_query("update kegiatan set Status='0' where Status='' ");
  mysql_query("update kegiatan set Status='4' where Status='5' ");
  mysql_query("ALTER TABLE `kegiatan` CHANGE `kendaraan` `kendaraan` INT( 1 ) NOT NULL DEFAULT '1' ");
}

?>



<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.2.custom.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/jquery.inputmask.bundle.min.js"></script>
<style type="text/css">
  li.ui-menu-item {
    font-size: 12px !important;
  }
</style>
<script type="text/javascript">
  jQuery(document).ready(function() {
    $('#instansi').autocomplete({
      source: 'modul/suggest_zip.php',
      minLength: 2
    });

    $('#jam_mulai, #jam_selesai').inputmask("99:99:99", {
      placeholder: "09:00:00",
      insertMode: false
    });
  });

  $('div.clickdate').live('click', function() {
    $("#datepicker").datepicker({
      yearRange: '2020:3000',
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      showOn: 'focus'
    }).focus();
  });
</script>
<?
include "config/db_connect.php";
$utd = mysql_fetch_assoc(mysql_query("SELECT lat, lng FROM utd WHERE aktif='1'"));
?>
<!--<script src="http://maps.google.co.id/maps/api/js?key=AIzaSyCAxfJQlGpCqxwpHPZCQKc9NFkJb32zPJs&language=id" type="text/javascript"></script>-->
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnDES5HQsG1RmgckdMeKGBxzBNA5yWMuw&sensor=false" type="text/javascript"></script-->
<!--script>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyDnDES5HQsG1RmgckdMeKGBxzBNA5yWMuw",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
</script-->
<script>
  (g => {
    var h, a, k, p = "The Google Maps JavaScript API",
      c = "google",
      l = "importLibrary",
      q = "__ib__",
      m = document,
      b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}),
      r = new Set,
      e = new URLSearchParams,
      u = () => h || (h = new Promise(async (f, n) => {
        await (a = m.createElement("script"));
        e.set("libraries", [...r] + "");
        for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
        e.set("callback", c + ".maps." + q);
        a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
        d[q] = f;
        a.onerror = () => h = n(Error(p + " could not load."));
        a.nonce = m.querySelector("script[nonce]")?.nonce || "";
        m.head.append(a)
      }));
    d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
  })({
    key: "AIzaSyBAFrTJz9AK9JYHD_58kwJNOWaR8VoBcSo",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
</script>

<script type="text/javascript">
  var directionDisplay;
  // var directionsService = new google.maps.DirectionsService();
  var map;
  var mylat = "<?= $utd[lat] ?>";
  var mylon = "<?= $utd[lng] ?>";
  var start;
  var end;
  var pos;

  // var geocoder = new google.maps.Geocoder();

  // function geocodePosition(pos) {
  //   geocoder.geocode({
  //     latLng: pos
  //   }, function(responses) {
  //     if (responses && responses.length > 0) {
  //       updateMarkerAddress(responses[0].formatted_address);
  //     } else {
  //       updateMarkerAddress('Cannot determine address at this location.');
  //     }
  //   });
  // }

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

  function updateMarkerLatLng(latLng, nama) {
    document.dinstansi.infolat.value = latLng.lat();
    document.dinstansi.infolng.value = latLng.lng();
  }

  function load() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(loadM, loadM());
    } else {
      //alert("I'm sorry, but geolocation services are not supported by your browser or you do not have a GPS device in your computer. I will use a sample location to produce the map instead.");
      loadM();
    }
  }

  function loadM(p) {
    gbarOptions = {
      resultList: document.getElementById('result_search')
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), {
      mapTypeId: 'roadmap'
    });
    map.setZoom(4);
    if (typeof(p) == 'undefined') {
      pos = new google.maps.LatLng(mylat, mylon);
      map.setZoom(4);
    } else {
      pos = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
      mylat = p.coords.latitude;
      mylon = p.coords.longitude;
      map.setZoom(9);
    }
    map.setCenter(pos);
    var icon0 = 'images/distance.png';
    // map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push((window.gbar = new window.jeremy.jGoogleBar(map, gbarOptions)).container);
    var marker = new google.maps.Marker({
      position: pos,
      map: map,
      icon: icon0,
      title: "You are here"
    });
    directionsDisplay.setMap(map);
    start = new google.maps.LatLng(mylat, mylon);
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
          "<tr><td>Tanggal:</td> <td><div class='clickdate'><input type='text' id='datepicker'/> </div></td> </tr>" +
          "<tr><td>Jam Mulai:</td> <td><div class='clickdate'><input type='text' id='jam_mulai'/> </div></td> </tr>" +
          "<tr><td>Jam Selesai:</td> <td><div class='clickdate'><input type='text' id='jam_selesai'/> </div></td> </tr>" +
          "<tr><td>Kendaraan:</td> <td><div class='clickdate'><input type='text' id='kendaraan'/> </div></td> </tr>" +
          "<tr><td>Snack:</td> <td><div class='clickdate'><input type='text' id='snack'/> </div></td> </tr>" +
          "<tr><td>Jenis Donor:</td> <td><div class='clickdate'><input type='text' id='jenisdonor'/> </div></td> </tr>" +
          "<tr><td>Latittude</td><td><input type='text' id='infolat' value=" + latlng.lat() + "/></td></tr>" +
          "<tr><td>Longittude</td><td><input type='text' id='infolng' value=" + latlng.lng() + "/></td></tr>" +
          "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr></table></form>";
        //document.getElementById('form_instansi').innerHTML = html0;
        document.dinstansi.infolat.value = latlng.lat();
        document.dinstansi.infolng.value = latlng.lng();
        document.dinstansi.instansi.value = '';
        document.dinstansi.namainstansi.value = '';
        document.dinstansi.jumlah.value = '';
        document.dinstansi.kendaraan.value = '';
        document.dinstansi.snack.value = '';
        document.dinstansi.jenisdonor.value = '';
        document.dinstansi.jam_mulai.value = '';
        document.dinstansi.jam_selesai.value = '';
        document.dinstansi.datepicker.value = '';

        //infowindow.open(map, marker0);
      });
    });
    // Change this depending on the name of your PHP file
    downloadUrl("modul/genxml_mobile.php", function(data) {
      var xml = data.responseXML;
      var markers = xml.documentElement.getElementsByTagName("marker");
      for (var i = 0; i < markers.length; i++) {
        var name = markers[i].getAttribute("name");
        var jumlah = markers[i].getAttribute("jumlah");
        var instansi = markers[i].getAttribute("kodeinstansi");
        var tgl = markers[i].getAttribute("tgl");
        var jam_mulai = markers[i].getAttribute("jam_mulai");
        var jam_selesai = markers[i].getAttribute("jam_selesai");
        var kendaraan = markers[i].getAttribute("kendaraan");
        var snack = markers[i].getAttribute("snack");
        var jenisdonor = markers[i].getAttribute("jenisdonor");
        var id_mu = markers[i].getAttribute("id_mu");
        var point = new google.maps.LatLng(
          parseFloat(markers[i].getAttribute("lat")),
          parseFloat(markers[i].getAttribute("lng")));
        var html1 = "<b>" + name + "</b> <br/>" +
          "<br/>Directions to <a href=http://maps.google.co.id/maps?daddr=" +
          markers[i].getAttribute("lat") + "," + markers[i].getAttribute("lng") + "&saddr=" + mylat + "," + mylon + " target=new><b>Here</b></a>" +
          "<br/><img src=images/blood.png>";

        var icon1 = 'images/udd_mobile.png';
        var marker = new google.maps.Marker({
          map: map,
          position: point,
          icon: icon1,
          draggable: true,
          title: name
        });
        bindInfoWindow(marker, map, infoWindow1, html1, instansi, jumlah, tgl);
      }
    });
  }

  function saveData() {
    var instansi = escape(document.getElementById("instansi").value);
    var jumlah = document.getElementById("jumlah").value;
    var datepicker = document.getElementById("datepicker").value;
    var jam_mulai = document.getElementById("jam_mulai").value;
    var jam_selesai = document.getElementById("jam_selesai").value;
    var kendaraan = document.getElementById("kendaraan").value;
    var snack = document.getElementById("snack").value;
    var jenisdonor = document.getElementById("jenisdonor").value;
    var lat = document.getElementById("infolat").value;
    var lng = document.getElementById("infolng").value;
    var id_mu = document.getElementById("id_mu").value;

    var url = "modul/add_mu.php?instansi=" + instansi + "&jumlah=" + jumlah + "&datepicker=" + datepicker + "&jam_mulai=" + jam_mulai + "&jam_selesai=" + jam_selesai + "&kendaraan=" + kendaraan + "&snack=" + snack + "&jenisdonor=" + jenisdonor + "&lat=" + lat + "&lng=" + lng + "&id_mu=" + id_mu;
    downloadUrl(url, function(data, responseCode) {
      if (responseCode == 200) {


      }
    });
    document.getElementById("form_instansi").innerHTML = "<b>Jadwal MU telah berhasil ditambahkan/diUpdate.</b>";
    document.dinstansi.reset();
    load();
  }


  function bindInfoWindow(marker, map, infoWindow1, html1, instansi, jumlah, tgl, jam_mulai, jam_selesai, kendaraaan, snack, jenisdonor, id_mu) {
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
      document.dinstansi.jam_selesai.value = jam_selesai;
      document.dinstansi.kendaraan.value = kendaraan;
      document.dinstansi.snack.value = snack;
      document.dinstansi.jenisdonor.value = jenisdonor;
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
      var latLng = marker.getPosition();
      document.dinstansi.infolat.value = latLng.lat();
      document.dinstansi.infolng.value = latLng.lng();
    });

    // google.maps.event.addListener(marker, 'dragend', function() {
    //   updateMarkerStatus('Drag ended');
    //   geocodePosition(marker.getPosition());
    //   document.dinstansi.id_mu.value = id_mu;
    //   updateMarkerLatLng(marker.getPosition(), marker.title);
    // });
  }

  // function calcRoute() {
  //   var request = {
  //     origin: start,
  //     destination: end,
  //     travelMode: google.maps.DirectionsTravelMode.DRIVING
  //   };
  //   directionsService.route(request, function(response, status) {
  //     if (status == google.maps.DirectionsStatus.OK) {
  //       directionsDisplay.setDirections(response);
  //     }
  //   });
  // }

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
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
  #map {
    height: 60%;
  }

  /* Optional: Makes the sample page fill the window. */
  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  #description {
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
  }

  #infowindow-content .title {
    font-weight: bold;
  }

  #infowindow-content {
    display: none;
  }

  #map #infowindow-content {
    display: inline;
  }

  .pac-card {
    margin: 10px 10px 0 0;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    font-family: Roboto;
  }

  #pac-container {
    padding-bottom: 12px;
    margin-right: 12px;
  }

  .pac-controls {
    display: inline-block;
    padding: 5px 11px;
  }

  .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }

  #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 400px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  #title {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
  }

  #target {
    width: 345px;
  }
</style>
<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="map"></div>
<script>
  // This example adds a search box to a map, using the Google Place Autocomplete
  // feature. People can enter geographical searches. The search box will return a
  // pick list containing a mix of places and predicted search terms.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initAutocomplete() {
    var currentMarker = null;
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: <?= $utd[lat] ?>,
        lng: <?= $utd[lng] ?>
      },
      zoom: 13,
      mapTypeId: 'roadmap'
    });

    google.maps.event.addListener(map, "rightclick", function(event) {
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();
      // populate yor box/field with lat, lng
      //alert("Mas Eko Jelek weeek, Lat=" + lat + "| Lng=" + lng);

      // Hapus marker sebelumnya (jika ada)
      if (currentMarker) {
        currentMarker.setMap(null);
      }

      // Tambahkan marker baru di lokasi klik kanan
      currentMarker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        title: "Lokasi yang dipilih"
      });

      // alert("Lokasi Berhasil Ditentukan");
      document.dinstansi.infolat.value = event.latLng.lat();
      document.dinstansi.infolng.value = event.latLng.lng();
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };


        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }
</script>
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAxfJQlGpCqxwpHPZCQKc9NFkJb32zPJs&libraries=places&callback=initAutocomplete" async defer></script-->
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5lcB7A8Y0NEPrrhs9WOGQeWGfo_P9ou0&callback=initAutocomplete&libraries=places&v=weekly"            defer></script-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAFrTJz9AK9JYHD_58kwJNOWaR8VoBcSo&callback=initAutocomplete&libraries=places&v=weekly" defer></script>

<div id="map_canvas"></div>
<div id="form_instansi1">
  <fieldset>
    <form name='dinstansi'>
      <table>
        <tr>
          <td>Latittude</td>
          <td><input type='text' id='infolat' /></td>
          <td>Longittude</td>
          <td><input type='text' id='infolng' /></td>
        </tr>
        <tr>
          <td>Instansi</td>
          <td><input type='text' id='instansi'></td>
          <td>Jumlah</td>
          <td><input type='text' id='jumlah' /></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>
            <div class='clickdate'><input type='text' id='datepicker' autocomplete="off" /> </div>
          </td>
          <td>Jam Mulai</td>
          <td><input type='text' id='jam_mulai' placeholder='09:00:00' /></td>
        </tr>
        <td>Jam Selesai</td>
        <td><input type='text' id='jam_selesai' placeholder='09:00:00' /></td>
        </tr>
        <tr>
          <td>Kendaraan</td>
          <td class="input">
            <select id='kendaraan'>
              <option value="0">Bus Donor</option>
              <option value="1">Mobile Donor</option>
            </select>
          </td>
          <td>Service Donor</td>
          <td class="input">
            <select id='snack'>
              <option value="Snack Donor">Snack Donor</option>
              <option value="Gula">Gula</option>
              <option value="Kupon">Kupon</option>
              <option value="Nasi Kotak">Nasi Kotak</option>
            </select>
          </td>
          <td>Jenis Donor</td>
          <td class="input">
            <select id='jenisdonor'>
              <option value="Umum">Umum</option>
              <option value="Internal">Internal</option>
            </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input type='hidden' id='id_mu'> <input type='button' value='Save' onclick='saveData()' /></td>
        </tr>
      </table>
    </form>
  </fieldset>
  <div id="form_instansi">
  </div>
</div>
<div id="infoPanel">
  <div id="directionsPanel"></div>
  <br><br>
  <!--b>Marker status:</b>
<div id="markerStatus"><i>Click and drag the marker.</i></div>
<b>Current position:</b>
<div id="info"></div>
<b>Closest matching address:</b-->
  <div id="address0"></div>
  <!-- <script type="text/javascript" src="js/jGoogleBarV3.min.js"></script> -->
  <!--div id="result_search"></div-->
</div>