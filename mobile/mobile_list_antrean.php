<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem InforMasi DONor DARah</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    -->
</head>
<?php
$tgl= date("Y/m/d");
$message='';
$init_kegiatan=$_POST['jadwal'];
include ('config/db_connect.php');
?>
<body OnLoad="document.tglantrean.focus();" style="margin-top:30px;margin-left:10px;">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
      <div> <?php echo $message;?> </div>
			<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Registrasi dari Aplikasi Ayodonor</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
				<button name="cari" id="cari" class="btn btn-info " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">Check Pendaftaran via aplikasi mobile</button>
		</div>
	</div>
  <div class="row">
    <div class="col-lg-12">
      <div id='load_t' style='display: none;'>
        <img src='/mobile/loading.gif'>
      </div>
      <div id="list_antrean"></div>
    </div>
  </div>
</div> <!--container-->

<script src="bootsrtap/337/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $.ajax({
      url: "mobile/get_listantrean.php",
      beforeSend: function(){
          $("#list_antrean").hide();
          $("#load_t").show();
      },
      success: function(result){
        $("#list_antrean").show();
        $("#list_antrean").html(result);
      },
      complete:function(){
        $("#load_t").hide();
      }
    });
  $("#cari").click(function(){
    $.ajax({
      url: "mobile/get_listantrean.php",
      beforeSend: function(){
          $("#list_antrean").hide();
          $("#load_t").show();
      },
      success: function(result){
        $("#list_antrean").show();
        $("#list_antrean").html(result);
      },
      complete:function(){
        $("#load_t").hide();
      }
    });
  });
});
</script>
<style>
select{
		border: 0.4px;
    width: 100%;
	}
select.btn-mini {
    height: auto;
		border: 0;
    width: 100%;
    line-height: 10px;
}

/* this is optional (see below) */
select.btn {
    -webkit-appearance: button;
       -moz-appearance: button;
            appearance: button;
    padding-right: 1px;
}

select.btn-mini + .caret {
    margin-left: -20px;
    margin-top: 0px;
}
</style>
