<?php
session_start();
$msg="";
require_once('clogin.php');
require_once('config/dbi_connect.php');
$leveluser=$_SESSION['level'];
$namauser=$_SESSION['namauser'];
$namalengkap=$_SESSION['nama_lengkap'];
$level = $_SESSION['leveluser'];
$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `nama`,`id` FROM `utd` WHERE `aktif`='1';"));
$id_uddaktif=$udd['id'];
$nama_uddaktif=$udd['nama'];
//echo $id_uddaktif;

$tgl    = date('Ymd');
$token  = "17091945".$tgl;
$notrans= $_GET['id'];
$mode   = $_GET['mode'];

(isset($_SESSION['tanggal1'])) ? $f_tanggal1=$_SESSION['tanggal1'] : $f_tanggal1 = date('Y-m-d');
(isset($_SESSION['tanggal2'])) ? $f_tanggal2=$_SESSION['tanggal2'] : $f_tanggal2 = date('Y-m-d');
(isset($_SESSION['status'])) ? $f_status=$_SESSION['status'] : $f_status = "";

if(isset($_POST['vfilter'])){
    $f_status       =$_SESSION['status']    = $_POST['fltstatus'];
    $f_tanggal1     =$_SESSION['tanggal1']  = $_POST['fltTanggal1'];
    $f_tanggal2     =$_SESSION['tanggal2']    = $_POST['fltTanggal2'];
}
if(isset($_POST['vreset'])){
    $f_status        = "";
    $f_tanggal1     = date('Y-m-d');
    $f_tanggal2     = date('Y-m-d');
}

//CURL Lihat Detail
$curlD = curl_init();
curl_setopt_array($curlD, array(
CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_detail_preterima.php",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => array('udd' => $notrans, 'key' => $token),
));
$responseD = curl_exec($curlD);
curl_close($curlD);
//echo $responseD;
$tgl= date("Y/m/d");
$dataD = json_decode($responseD, true);
//echo var_dump($data);
//echo 'Count Data :'.count($data).'<br>';




?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootsrap337/bspmi.css">
        <link rel="stylesheet" href="bootsrap337/w3.css">
        <link rel="stylesheet" href="pmf/pmfstyle.css">
        <link rel="stylesheet" href="bootsrap337/css/bootstrap.min.css">
        <link href="bootsrap337/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="bootsrap337/chosen/chosen.css">
        <link href="https://cdn.datatables.net/v/bs/dt-1.13.8/datatables.min.css" rel="stylesheet">
        <style>
             .shadow{box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);}
            .btn-pref .btn {
                border-radius:0 !important;
            }
            .modal-fullscreen {
                width: 98%;
                padding: 0;
            }

            .modal-half {
                width: 70%;
                padding: 0;
                position: fixed;
                left: 15%;
            }

            .modal-content {
                /* min-height: 90%; */
                width: 100%;
                border-radius: 25;
                margin: 0 0;
            }
            .modal-footer {
                border-radius: 25;
                bottom:0px;
                position:relative;
                width:100%;
            }
            .form-group{margin-top: 1px;margin-bottom: 1px;}
            .table thead th {
                height: 40px;
                padding: 2px !important;
                text-align: center !important;
                vertical-align: middle !important;
                text-shadow: 1px 1px  2px black;
                font-size : 1.2em;
                /* word-break:break-all; */
            }
            .table tbody td {
                font-size:1em;
                white-space: nowrap;
                vertical-align: middle !important;
            }
            .text-vertical{
                vertical-align: middle;
                text-align: center;
                transform: rotate(-90deg);
                white-space: nowrap;
            }
            #loading {
                    width: 50px;
                    height: 50px;
                    border-radius: 100%;
                    border: 5px solid #ccc;
                    border-top-color: #ff6a00;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    margin: auto;
                    z-index: 99;
                    animation: sp 2s ease infinite;
                }
                @keyframes sp {
                    from {transform: rotate(0deg);
                    } to {transform: rotate(360deg);
                    }
                }
                a{
                    text-decoration: none !important;
                }
                .table td.text {
                    max-width: 300px;
                }
                .table td.text span {
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: inline-block;
                    max-width: 100%;
                }

            .swal2-popup {font-size: 1.6rem !important;}
            .swal-footer {text-align: center;}
            .custom-swal {
                background: linear-gradient(to bottom, white, red) !important;
                border-radius: 15px !important;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5) !important;
                width: 800px !important;
                max-width: 95% !important;
                padding: 20px !important;
                overflow: hidden;
            }
        </style>
    </head>
    
    <body>
        <div id="loading"></div>
        <div class="container-fluid" style="margin: 30px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel w3-border-theme shadow">
                        <div class="panel-heading w3-theme-d5 clearfix">
                            <div class="col-lg-9 col-md-8 col-sm-7 col-xs-8 text-left text-shadow" style="font-size: 150%;font-weight: bold;">KONFIRMASI PENERIMAAN DARAH KONSOLIDASI</div>
                            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-4 text-right">
                                <form name="mFrmKirim" class="form-horizontal" id="mFrmKirim" action="" method="POST">
                                    <input type="hidden" class="form-control input-sm" name="noTrans" value="<?php echo $notrans;?>" >
                                    <input type="hidden" class="form-control input-sm" name="InpNotransaksi" value="<?php echo $notrans;?>" id="InpNotransaksi" readonly>
                                <?php if($mode =="proses"){?>
                                    <button type="button" name="vKirim" id="vKirim" class="w3-btn w3-theme w3-hover-green">PROSES</button>
                                <?php }else{?>
                                    <a href="?module=proseshapus" class="w3-btn w3-theme w3-hover-green" >HAPUS</a>
                                    <?php } ?> 
                                    <a href="?module=sr_aftap_kns" class="w3-btn w3-theme w3-hover-yellow" >KEMBALI</a>
                                </form>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12"><?php echo $msg;?></div>
                                <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-bordered table-striped table-md table-hover table-md display"  id="dtaudittrail">
                                                <thead class="w3-theme-d4" style="height: 40px;">
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th>No. Kantong</th>
                                                        <th>Tgl. Aftap</th>
                                                        <th>Kode<br>Pendonor</th>
                                                        <th>Merk</th>
                                                        <th>Volume</th>
                                                        <th>Gol.</th>
                                                        <th>Rhesus</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    for($a=0; $a < count($dataD['data']); $a++){
                                                        $no=$a+1;
                                                        $chkdata=strlen($dataD['data'][$a]['dst_nokantong']);
                                                        if ($chkdata>0){
                                                        
                                                        echo  "<tr>";
                                                        echo  "<td class='text-right' nowrap>".$no.".</td>";
                                                        echo  "<td>".$dataD['data'][$a]['dst_nokantong']."</td>"; 
                                                        echo  "<td>".$dataD['data'][$a]['dst_tglaftap']."</td>";
                                                        echo  "<td>".$dataD['data'][$a]['dst_kodedonor']."</td>";
                                                        echo  "<td>".$dataD['data'][$a]['dst_merk']."</td>";
                                                        echo  "<td>".$dataD['data'][$a]['dst_volambil']."</td>";
                                                        echo  "<td>".$dataD['data'][$a]['dst_golda']."</td>";
                                                        echo  "<td>".$dataD['data'][$a]['dst_rh']."</td>";
                                                        echo  "</tr>";
                                                        }
                                                    }
                                                    if ($no=='0'){
                                                        echo '<tr>';
                                                        echo '<td colspan="7" style="font-size:20px;" class="text-center">Tidak ada data antrian konsolidasi</td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

<script src="bootsrap337/js/jquery.min.js"></script>
<script src="bootsrap337/js/bootstrap.min.js"></script>
<script src="bootsrap337/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="bootsrap337/datepicker/custom.js"></script>
<script src="bootsrap337/chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/v/bs/dt-1.13.8/datatables.min.js"></script>
<script src="bootsrap337/sweetalert2/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        setDateRangePicker(".startdate", ".enddate")
        var table = $('#dtaudittrail').DataTable( { 
	        lengthMenu: [
                [5,10, 15, 25, 50, -1],
                [5,10, 15, 25, 50, 'All']
            ]
	    });
        var load = document.getElementById("loading");window.addEventListener('load', function(){load.style.display = "none";});
        $('.btn-kirim').on('click', function() {
            var noTrans = $(this).data('id'); 
            $('#InpNotransaksi').val(noTrans);
        });

        $('#vKirim').on('click', function() {
            var noTransaksi = $('#InpNotransaksi').val();
            var dari = $('#InpDari').val();
            var kirimKe = $('select[name="InpKirimke"]').val();
            if (!noTransaksi) {
                Swal.fire({
                    title: "Gagal!",
                    text: "Harap isi semua data sebelum mengirim.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }
            $('#mKirim').modal('hide');
            Swal.fire({
                title: "Mengirim Data...",
                text: "Harap tunggu, data sedang dikirim.",
                icon: "info",
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: function() {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: 'serahterima/ksl_terima_proses.php',
                type: 'POST',
                data: {
                    noTransaksi: noTransaksi
                },
                dataType: "json",
                success: function(response) {
                    console.log("Response dari server:", response); 
                    Swal.close();

                    if (response && response.status === "success") {
                        Swal.fire({
                            title: "Sukses!",
                            text: response.message || "Data berhasil diterima.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message || "Terjadi kesalahan saat mengirim data.",
                            icon: "error",
                            confirmButtonText: "Coba Lagi"
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);

                    let errorMessage = "Terjadi kesalahan saat menghubungi server.";
                    if (jqXHR.responseText) {
                        try {
                            let errorResponse = JSON.parse(jqXHR.responseText);
                            errorMessage = errorResponse.message || errorMessage;
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                        }
                    }

                    Swal.close();
                    Swal.fire({
                        title: "Gagal!",
                        text: errorMessage,
                        icon: "error",
                        confirmButtonText: "Coba Lagi"
                    });
                }
            });
        });
    });

    $('.chosen-select').chosen({width: "100%"});

    function setDateRangePicker(start, end) {
        $(start).datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $(end).datepicker('setStartDate', startDate);
            if ($(end).val() === '') {
                $(end).datepicker('setDate', startDate);
            }
        });

        $(end).datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $(start).datepicker('setEndDate', endDate);
        });
    }
</script>
<?php 

?>