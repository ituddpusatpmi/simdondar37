<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
<script src="bootsrap337/js/html5shiv.min.js"></script>
<script src="bootsrap337/js/respond.min.js"></script>
<link href="bootsrap337/bspmi.css" rel="stylesheet">
<script src="bootsrap337/js/jquery.min.js"></script>
<script src="bootsrap337/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bootsrap337/fonts/font-awesome.min.css" />
<link type="text/css" href="css/calender.css" rel="stylesheet" /> 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style>
    .sdw{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
<body style="margin: 50px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-3">
                <h1 class="text-success">Evolis Biorad</h1>
                <a href="?module=import_evolisproses&op=del&m=evolis" class="btn btn-danger btn-block sdw btn-lg">Clear Temporary</a>
                <a href="?module=import_evolishasil" class="btn btn-primary btn-block swd btn-lg">Import Hasil</a>
                <a href="?module=import_evoliskonfirmasi" class="btn btn-success btn-block sdw btn-lg">Konfirmasi Hasil</a>
		<br>
                <small class="text-danger">Team IT@<sup>Banyuwangi, 28-06-2022</sup></small>
            </div>
            <div class="col-xs-6">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                        for ($x = 1; $x <= 7; $x++) {
                            if ($x==1){$cls=" active ";}else{$cls="";}
                        echo '
                        <div class="item '.$cls.'">
                            <img src="evolis/img/Picture_0'.$x.'.png" alt="" style="max-width: 500px;">
                        </div>';    
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
