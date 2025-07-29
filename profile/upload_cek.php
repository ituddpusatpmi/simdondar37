<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMDONDAR</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <br>
                <div class="panel with-nav-tabs panel-primary" id="shadow1">
                    <div class="panel-heading">
                        <div class="panel-title pull-left"><h4>DATA LAPORAN DI SERVER PUSAT</h4></div>
                        <div class="panel-title pull-right">
                            <select class="form-control" id="jenis">
                                <option value="1">Laporan Bulanan</option>
                                <option value="2">Laporan Tahunan</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        <div class="text-center" id='loading' style='display: none;'><img class="pmi" src='/profile/ajax-loader-3.gif'></div>
                        <div id="content_lap">
                            <br>
                            <h4 class="text-center" style="color: red;font-weight: bold">Pilih jenis laporan di kanan atas, kemudian klik Cek Laporan</h4>
                            <br>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" name="submit"  id="btn_upload" class="btn btn-default" ><i class="fa  fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Cek Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_upload").click(function(){
            var jenis = $('#jenis').val();
            $.ajax({
                url: '/profile/upload_cek_ajax.php',
                type: 'post',
                data: {j:jenis},
                beforeSend: function(){
                    $('#content_lap').hide();
                    $("#loading").show();
                },
                success: function(data){

                    $('#content_lap').empty();
                    $('#content_lap').html(data);
                    $('#content_lap').show();
                },
                complete:function(text){
                    $("#loading").hide();

                }
            });

        });
    });
</script>