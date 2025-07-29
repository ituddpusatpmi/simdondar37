<!DOCTYPE html>
<html>
<?php
error_reporting(E_ALL ^ E_NOTICE);
include('config.php');
include('db.php');

if ($_SESSION['ipserver'] == '') { ?>
  <META http-equiv="refresh" content="0; url=../index.php">
<?php
}
?>

<head>
  <meta charset="utf-8">
  <title>DISPLAY</title>
  <script type="text/javascript" src="js/autoscroll.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      refreshTable();
      refreshTablestok();
      refreshAntri()
    });

    function refreshTable() {
      var baris = document.getElementById("nomor").value;
      $('#jadwal_mu').load('get_mu.php?baris=' + baris + '&time=' + new Date().getTime(),
        function() {
          setTimeout(refreshTable, 5 * 1000);
        });
    }

    function refreshTablestok() {
      $('#stok_darah').load('get_stok.php?time=' + new Date().getTime(),
        function() {
          setTimeout(refreshTablestok, 30 * 1000);
        });
    }

    function refreshAntri() {
      var baris = document.getElementById("nomor").value;
      $('#antri_donor').load('getantridonor.php?baris=' + baris + '&time=' + new Date().getTime(),
        function() {
          setTimeout(refreshAntri, 5 * 1000);
        });
    }
  </script>
  <style>
    .center {
      margin: 0 auto;
      width: 100%;
    }

    .marquee {
      width: 97%;
      overflow: hidden;
      font-size: 30px;
      margin-top: 0px;
      font-family: 'Lato', sans-serif;
    }

    ul.marquee li {
      display: inline-block;
      padding: 1px 20px;
    }

    body {
      background: url(bgmerah3.jpg) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      overflow: hidden;
    }

    .atas {
      position: absolute;
      top: 0%;
      left: 0%;
      width: 100%;
      height: 10%;
      border: 1px none white;
      font-family: Helvetica;
      color: white;
      font-weight: bold;
      background-image: url(img/header.png), url(img/pmi.png);
      background-position: left, right;
      background-repeat: no-repeat, no-repeat;
      background-size: 90% 100%, 10.5% 100%;
    }

    .kanan {
      position: absolute;
      top: 12%;
      left: 50.5%;
      width: 49%;
      height: 79.5%;
      border: 1px none white;
    }

    .kiri {
      position: absolute;
      top: 10%;
      left: 0.5%;
      width: 49%;
      height: 80%;
      font-family: Helvetica;
      border: 1px none white;
    }

    .container_mu {
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .container_mu table thead th {
      position: sticky;
      top: 0;
    }

    .bawah {
      position: absolute;
      bottom: 0%;
      left: 10%;
      width: 80%;
      height: 5%;
      background: rgb(246, 246, 246);
      /* Old browsers */
      background: -moz-linear-gradient(top, rgb(246, 246, 246) 0%, rgb(225, 225, 225) 42%, rgb(241, 241, 241) 63%, rgb(255, 255, 255) 100%);
      /* FF3.6-15 */
      background: -webkit-linear-gradient(top, rgb(246, 246, 246) 0%, rgb(225, 225, 225) 42%, rgb(241, 241, 241) 63%, rgb(255, 255, 255) 100%);
      /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom, rgb(246, 246, 246) 0%, rgb(225, 225, 225) 42%, rgb(241, 241, 241) 63%, rgb(255, 255, 255) 100%);
      /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#ffffff', GradientType=0);
      /* IE6-9 */
    }

    .infokiri {
      position: absolute;
      bottom: 0%;
      left: 0%;
      width: 10%;
      height: 5%;
      color: white;
      font-size: 34px;
      text-align: center;
      font-family: Arial;
      text-shadow: 3px 3px 5px #000000;
      background: rgb(255, 29, 0);
      /* Old browsers */
      background: -moz-linear-gradient(left, rgb(255, 29, 0) 0%, rgb(132, 6, 2) 100%);
      /* FF3.6-15 */
      background: -webkit-linear-gradient(left, rgb(255, 29, 0) 0%, rgb(132, 6, 2) 100%);
      /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to right, rgb(255, 29, 0) 0%, rgb(132, 6, 2) 100%);
      /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff1d00', endColorstr='#840602', GradientType=1);
      /* IE6-9 */

    }

    @font-face {
      font-family: 'digital-7';
      src: url('font/digital-7.ttf');
    }

    .infokanan {
      position: absolute;
      bottom: 0%;
      left: 88%;
      width: 12%;
      height: 5%;
      color: yellow;
      font-size: 38px;
      text-align: center;
      font-family: 'digital-7';
      text-shadow: 3px 3px 5px #000000;
      background: rgb(132, 6, 2);
      /* Old browsers */
      background: -moz-linear-gradient(left, rgb(132, 6, 2) 0%, rgb(255, 29, 0) 100%);
      /* FF3.6-15 */
      background: -webkit-linear-gradient(left, rgb(132, 6, 2) 0%, rgb(255, 29, 0) 100%);
      /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to right, rgb(132, 6, 2) 0%, rgb(255, 29, 0) 100%);
      /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#840602', endColorstr='#ff1d00', GradientType=1);
      /* IE6-9 */
    }
  </style>

</head>

<body>
  <div class="atas">
    <div style="margin-top:5px;margin-left:10px; text-shadow: 5px 5px 10px #000000;font-size:<?php echo $udd_fontsize; ?>px;"><?php include_once('get_udd.php'); ?></div>
  </div>
  <div class="kiri" style="color:white;">
    <div id="antri_donor" style="margin-top:15px;border:5px solid white;width;80%;left:10%;padding:5px;"><?php include_once('getantridonor.php'); ?></div>
    <div style="margin-top:10px;font-size:24px;text-align:left;font-weight:bold;text-shadow: 3px 3px 5px #000000;">KEGIATAN DONOR DARAH MOBILE UNIT</div>
    <div class="container_mu" id="jadwal_mu"><?php include_once('get_mu.php'); ?></div>
  </div>
  <div class="kanan">
    <video loop autoplay muted style="border:5px solid white;width:98.5%;">
      <?php
      foreach (glob('video/*') as $video) {
        echo '<source src="' . $video . '"  type="video/mp4">';
      }
      ?>
      Your browser does not support the video tag
      ?>
    </video>
    <div id="stok_darah" style="border:5px solid white;width;80%;left:10%;padding:5px;"><?php include_once('get_stok.php'); ?></div>
    <!--div id="sponsor" style="color:white;margin-top:10px;font-size:24px;text-align:left;font-weight:bold;text-shadow: 3px 3px 5px #000000;">Supported by:</div>
    <div id="sponsor" style="color:white;margin-top:10px;font-size:24px;text-align:left;font-weight:bold;text-shadow: 3px 3px 5px #000000;"><?php echo "<center><img width='85%' src='img/sponsor.png'></center>"; ?></div-->
  </div>
  <div class="infokiri">Info</div>
  <div class="bawah">
    <ul class="marquee">
      <li style="font-weight:bold;color:blue;">Terima kasih sudah mendonorkan darah </li>
      <li style="font-weight:bold;color:red;">| Doa Kami, semoga Tuhan senantiasa membalas semua kebaikan Anda.. Amin </li>
      <li>Terapkan selalu protokol kesehatan</li>
      <li style="font-style: oblique;font-weight:bold;color:red;">5M (Mencuci Tangan, Menggunakan Masker, Menjaga Jarak, Menjauhi Kerumunan, Menguarangi Mobilitas)</li>
      <?php
      $berita = mysqli_query($dbi, "SELECT isi_agenda FROM `agenda` WHERE date( tgl_selesai ) >= current_date and date(tgl_mulai)<=current_date");
      while ($res = mysqli_fetch_assoc($berita)) {
        echo '<li style="color:#000000;">' . $res['isi_agenda'] . '</li>';
        $nocolor = '2';
      }
      //include "get_cov_ina.php";
      ?>
    </ul>
  </div>
  <div class="infokanan">
    <span id="span"></span>
  </div>
</body>

</html>
<script>
  function addZero(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }
  var span = document.getElementById('span');

  function time() {
    var d = new Date();
    var s = addZero(d.getSeconds());
    var m = addZero(d.getMinutes());
    var h = addZero(d.getHours());
    span.textContent = h + ":" + m + ":" + s;
  }
  setInterval(time, 1000);

  $(function() {
    $('.marquee').marquee({
      duration: 15000,
      duplicate: true
    });
  });
</script>


<script type='text/javascript'>
  var count = 1;
  var player = document.getElementById('myVideo');
  var mp4Vid = document.getElementById('mp4Source');
  player.addEventListener('ended', myHandler, false);

  function myHandler(e) {
    if (!e) {
      e = window.event;
    }
    count++;
    if (count > 2) {
      count = 0;
    }
    $(mp4Vid).attr('src', "video/video" + count + ".mp4");
    player.load();
    player.play();
  }
</script>
