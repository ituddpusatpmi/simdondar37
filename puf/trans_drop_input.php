<?php
require_once('clogin.php');
require_once('config/dbi_connect.php');
$namauser       = $_SESSION['namauser'];
$namalengkap    = $_SESSION['nama_lengkap'];
$leveluser      = $_SESSION['level'];
$tanggal        = date('Y-m-d');
$utd            = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `id`,`nama` FROM `utd` WHERE `aktif`='1';"));
$udd_kode       = $utd['id'];
$udd_nama       = $utd['nama'];
DEFINE("folderdistribusi","puf/");
DEFINE("namafilejson",$namauser.$udd_kode.'puf.json');
// Delete json file with current user==================
$json_data      =array();
$json_filemane  = folderdistribusi.namafilejson;
$jsonfile = json_encode($json_data);
file_put_contents($json_filemane, $jsonfile);
// ====================================================
?>
<link rel="stylesheet" href="bootsrap337/bspmi.css">
<link rel="stylesheet" href="bootsrap337/w3.css">
<link rel="stylesheet" href="puf/puf.css">
<link rel="stylesheet" href="bootsrap337/css/bootstrap.min.css">
<link rel="stylesheet" href="bootsrap337/chosen/chosen.css">
<style>
    .form-group{margin-top: 1px;margin-bottom: 1px;}
    .table thead th {
        padding: 2px !important;
        text-align: center;
        vertical-align: middle !important;
        text-shadow: 1px 1px  2px black;
    }
    .table tbody td {
        white-space: nowrap;
        vertical-align: middle !important;
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
    .swal2-popup {
        font-size: 1.6rem !important;
    }
    .table-condensed{
                font-size: 14px;
            }
</style>
<body style="font-size:13px;">
    <div id="loading"></div>
    <div class="container-fluid" style="margin: 20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel w3-border-theme shadow">
                    <div class="panel-heading w3-theme-d5 clearfix">
                        <div class="col-lg-9 col-md-8 col-sm-7 col-xs-8 text-left text-shadow" style="font-size: 150%;font-weight: bold;">Pengiriman Produk PuF</div>
                        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-4 text-right">
                            <a href="#" class="w3-btn w3-theme w3-hover-yellow" id="btnSimpan" style="display: none;"><i class="glyphicon glyphicon-floppy-save"></i> Simpan</a>
                            <a href="?module=fp_transport" class="w3-btn w3-theme w3-hover-yellow"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="FrmTransp" name="FrmTransp">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpTgl">Tanggal</label>
                                        <div class="col-xs-9">
                                            <input id="InpTgl" name="InpTgl" type="text" class="form-control input-sm w3-white" value="<?php echo $tanggal;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpJenisTujuan">Jenis Tujuan</label>
                                        <div class="col-xs-9">
                                            <select name="InpJenisTujuan" id="InpJenisTujuan" class="form-fontrol input-sm chosen-select" required readonly>
                                                    <?php 
                                                        $arr_tujuan=array("2"=>"UDD","1"=>"BDRS/UTDRS","3"=>"LAINNYA");
                                                        foreach($arr_tujuan as $val=>$cap){
                                                            echo '<option value="'.$val.'">'.$cap.'</option>';
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpKodeTujuan">Tujuan Pengiriman</label>
                                        <div class="col-xs-9">
                                            <select name="InpKodeTujuan" id="InpKodeTujuan" class="form-fontrol input-sm chosen-select" required placeholder_text="Pilih Tujuan">
                                                    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpPtgKirim">Dicatat oleh</label>
                                        <div class="col-xs-9">
                                            <input id="InpPtgKirimNama" name="InpPtgKirimNama" type="text" class="form-control input-sm w3-white" value="<?php echo $namalengkap;?>" readonly>
                                            <input id="InpPtgKirimKode" name="InpPtgKirimKode" type="hidden" class="form-control input-sm w3-white" value="<?php echo $namauser;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpCatatan">Catatan</label>
                                        <div class="col-xs-9">
                                            <input id="InpCatatan" name="InpCatatan" type="text" class="form-control input-sm" placeholder="Catatan" maxlength="50" autocomplete="off" value="Pengiriman PuF">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpKodeBox">Kode Box</label>
                                        <div class="col-xs-9">
                                            <input id="InpKodeBox" name="InpKodeBox" type="text" class="form-control input-sm" placeholder="Kode Otomatis" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpSuhu">Suhu saat dikirim</label>
                                        <div class="col-xs-9">
                                            <input id="InpSuhu" name="InpSuhu" type="text" class="form-control input-sm" autocomplete="off" onkeypress="return isNumberKey(event,this)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpTermometer">Kode Termometer</label>
                                        <div class="col-xs-9">
                                            <input id="InpTermometer" name="InpTermometer" type="text" class="form-control input-sm" placeholder="Kode monitor suhu"  maxlength="20" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpCaraKirim">Cara Kirim</label>
                                        <div class="col-xs-9">
                                            <select name="InpCaraKirim" id="InpCaraKirim" class="form-fontrol input-sm chosen-select" required>
                                                    <?php 
                                                        $arr_carakirimn=array("3"=>"Melalui Pihak Ketiga","1"=>"Diantar oleh UDD","2"=>"Diambil langsung");
                                                        foreach($arr_carakirimn as $val=>$cap){
                                                            echo '<option value="'.$val.'">'.$cap.'</option>';
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="InpPetugasKirim" id="lblPetugasKirim">Nama Pihak ketiga</label>
                                        <div class="col-xs-9">
                                            <input id="InpPetugasKirim" name="InpPetugasKirim" type="text" class="form-control input-sm" maxlength="100" autocomplete="OFF">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="w3-panel w3-card w3-theme-l2" style="margin-top: 10px;">
                                        <div class="form-group">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon w3-theme-l4">Barcode</span>
                                                    <input id="InpBarcode" name="InpBarcode" type="text" class="form-control" placeholder="Scan/masukkan nomor kantong" autofocus autocomplete="off" style="font-size: 150%;font-weight:bold;color:red;">
                                                    <span class="input-group-btn">
                                                        <a id="SubmitBarcode" name="SubmitBarcode" class="w3-btn w3-theme-d4 w3-hover-yellow w3-small"><i class="glyphicon glyphicon-download w3-large"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 text-left">
                                                <div id="tload" style="display: none;"><img src="profile/simdondar_loading1.gif"></div>
                                                <div id="pesan" style="font-size: 120%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-body" style="max-height: 40vh;overflow-y: scroll;padding:2px;" id="paneldata">
                                            <div class="table-responsive">
                                                <table class="table table-responsive table-bordered table-hover table-condensed" id="tabledata" style="margin-bottom: 2px;">
                                                    <thead class="w3-theme-d4" style="height: 45px;">
                                                        <th>X</th>
                                                        <th>No</th>
                                                        <th>No Kantong</th>
                                                        <th>Jenis Produk</th>
                                                        <th>Gol</th>
                                                        <th>Rh</th>
                                                        <th>Volume</th>
                                                        <th>Status</th>
                                                        <th>Tanggal<br>Aftap</th>
                                                        <th>Tanggal<br>Pengolahan</th>
                                                        <th>Tanggal<br>Kedaluwarsa</th>
                                                        <th>Tanggal<br>Release</th>
                                                        <th>Hasil<br>Release</th>
                                                        <th>Freezer</th>
                                                        <th>Rak</th>
                                                    </thead>
                                                    <tbody id="wltable">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="w3-panel w3-theme-l1" style="margin-top: 2px;margin-bottom:2px;">
                                        <div class="w3-large">Jumlah kantong: <span  id="info" class="w3-text-red">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
<script src="index/sweetalert2.11.js"></script>
<script>
    $(document).ready(function(){
        setDatePicker()
        setDateRangePicker(".startdate", ".enddate")
        setMonthPicker()
        setYearPicker()
        setYearRangePicker(".startyear", ".endyear");

        $('#InpPtgKirim').on('change', function() {
            var jid=$('#InpPtgKirim').val();var exjid=jid.split('|');
            $('#InpBagKirim').val(exjid[1]);
        });
        $('#InpJenisTujuan').prop('disabled', true).trigger("chosen:updated");

        $(window).keydown(function(event){
            if(event.keyCode == 13){
                if($(event.target)[0]=$('#InpBarcode')[0]){
                    event.preventDefault();
                    var nokantong=$('#InpBarcode').val();
                    tambahkankantong(nokantong);
                    return false;
                }else{
                    event.preventDefault();
                    return false;
                }
            }
        });

        $('#SubmitBarcode').on('click', function(){
            var nokantong=$('#InpBarcode').val();
            tambahkankantong(nokantong);
        })

        $("#wltable").delegate(".hapusbaris", "click", function() {
            var jtr=$(this);
            const rowIndex = $(this).closest('tr').index()+1;
            var jsonfile='<?php echo namafilejson;?>';
            var nokantong='-';
            nokantong=$(this).closest('tr').children('td').eq(2).text();
            Swal.fire({
                title: "Dihapus ",
                text: "Yakin akan menghapus kantong nomor "+nokantong+"?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus saja!",
                cancelButtonText:"Jangan!!!!!!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'puf/puf_proces.php?m=trans_delktg',
                        data: {rowIndex:rowIndex,nokantong:nokantong,jsonfile:jsonfile},
                        success:function(msg){
                            if(msg.status=='1'){
                                // $(this).closest("tr").remove();
                                jtr.closest("tr").remove();
                                $('#pesan').html("Nomor kantong "+msg.kantong+" sudah dihapus");
                            }else{
                                $('#pesan').html("Gagal menghapus kantong nomor kantong "+msg.kantong);
                            }
                            $('#pesan').html(msg);   
                        }
                    })
                    $("#InpBarcode").val('');
                    $("#InpBarcode").select();
                }
                infojumlahdata();
            });
        });

        $('#InpJenisTujuan').on('change', function() {
            showdestinationdata();
        });

        $('#InpCaraKirim').on('change', function() {
            var jcarakirim=$(this).val();
            switch (jcarakirim){
                case "3" : $('#lblPetugasKirim').text('Nama Pihak ketiga');break;
                case "2" : $('#lblPetugasKirim').text('Diambil oleh');break;
                case "1" : $('#lblPetugasKirim').text('Dikirim oleh');break;
            }
        });
        showdestinationdata();
    });

    function showdestinationdata(){
        var jenistujuan=$('#InpJenisTujuan').val();
        $.ajax({
            type: 'POST',
            url: 'puf/puf_proces.php?m=trans_tujuandistribusi',
            dataType:"json",
            data: {kodetujuan:jenistujuan},
            success: function (data) {
                var sel = $("#InpKodeTujuan");
                sel.empty();
                for (var i=0; i<data.length; i++) {
                    sel.append($("<option/>", {
                        value: data[i].id,
                        text: data[i].nama
                    })).trigger('chosen:updated');
                }
            }
        });
    }
    
    $(document).on('click','#btnSimpan',function(e){
        e.preventDefault();
        const jalert = ['Jenis tujuan distribusi belum dipilih', 'Tujuan Pengiriman belum ditentukan', 'Suhu pengiriman harus diisi','Cek input suhu pengiriman', 'Petugas pengirim atau yang mengambil harus diisi'];
        // validate
        var jinputtujuan=$('#InpJenisTujuan').val();
        var jinptkode=$('#InpKodeTujuan').val();
        var jinptsuhu=$('#InpSuhu').val();
        var jinptpetugas=$('#InpPetugasKirim').val();
        let valid=true;
        var noaalert=99;
        if(jinputtujuan=='0'){
            valid=false;
            noaalert=0;
        }
        if(valid==true){
            if(jinptkode=='0'){
                valid=false;
                noaalert=1;
            }
        }
        if(valid==true){
            if(jinptsuhu==''){
                valid=false;
                noaalert=2;
            }
        }
        if(valid==true){
            let x = Math.sign(jinptsuhu);
            if(x>=0){
                valid=false;
                noaalert=3;
            }
        }
        if(valid==true){
            if(jinptpetugas==''){
                valid=false;
                noaalert=4;
            }
        }
        if(valid==true){
            var dataform=$('#FrmTransp').serialize();
            var jsonfile='<?php echo namafilejson;?>';
            var udd='<?php echo $udd_kode;?>';
            $('#pesan').html('Proses penyimpanan');
            $.ajax({
                type: 'POST',
                url: 'puf/puf_proces.php?m=trans_save',
                data:dataform + "&jsonfile="+jsonfile+"&udd="+udd,
                beforeSend:function(){
                    $('#pesan').html('');
                    $("#tload").show();
                },
                success: function (msg) {
                    var statusstr='';
                    switch(msg.statusupload){
                        case 0 : var statusstr='Data distribusi tidak dapat diupload';break;
                        case 1 : var statusstr='Upload Sukses';break;
                        case 2 : var statusstr='Gagal di server pusat';break;
                    }
                    $('#pesan').html('Transaksi Pengiriman:'+msg.nomortransaksi+' '+statusstr);
                    Swal.fire({
                        title: "Simpan Data",
                        // text: JSON.stringify(msg),
                        text :'Transaksi Pengiriman:'+msg.nomortransaksi+' '+statusstr,
                        icon: "info",
                        customClass: {popup: 'swalbgsuccess'}
                    }).then(async (result) => {
                        setTimeout(function() { window.location.replace('?module=fp_drop_data'); }, 1000);
                    });
                },
                complete:function(){
                    $('#tload').hide();
                }                   
            });
        }else{
            Swal.fire({
                title: "Error",
                text: jalert[noaalert],
                icon: "error",
                customClass: {popup: 'swalbgwarning'},
                timer: 2000,
                timerProgressBar: true
            });
            return false;
        }
        
    });
    
    function tambahkankantong(nokantong){
        nokantong=nokantong.toUpperCase();
        var jsonfile='<?php echo namafilejson;?>';
        var udd='<?php echo $udd_kode;?>';
        var rowCount = $('#tabledata tbody tr').size();
        if (nokantong == null || nokantong == "" ) {
            $('#InpBarcode').prop('disabled', true);
            Swal.fire({
                title: "Error",
                text: "Masukkan kantong darah yang akan didistribusikan/dikirim",
                icon: "error",
                customClass: {popup: 'swalbgerror'},
                timer: 2000,
                timerProgressBar: true
            }).then((result) => {
                $('#InpBarcode').prop('disabled', false);
                $("#InpBarcode").select();
            });
        }else{
            var reports = $('table#tabledata > tbody');
            var tr1 = reports.find('tr:has(td:contains("'+nokantong+'"))');
            if (tr1.length) {
                $('#InpBarcode').prop('disabled', true);
                Swal.fire({
                    title: "Error",
                    text: "Nomor kantong "+nokantong+"  sudah ada dalam daftar",
                    icon: "error",
                    customClass: {popup: 'swalbgerror'},
                    timer: 2000,
                    timerProgressBar: true
                }).then((result) => {
                    $('#InpBarcode').prop('disabled', false);
                    $('#pesan').html("Nomor kantong <span class='w3-text red w3-large'>"+nokantong+"</span>  sudah ada dalam daftar");   
                    $("#InpBarcode").val('');
                    $("#InpBarcode").select();
                });                
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'puf/puf_proces.php?m=trans_addktg',
                    dataType: "json",
                    data: {kantong:nokantong,rows:rowCount,jsonfile:jsonfile,udd:udd},
                    beforeSend:function(){
                        $("#InpBarcode").val('');
                        $('#InpBarcode').prop('disabled', true);
                        $('#pesan').html('');
                        $("#tload").show();
                    },
                    success: function (msg) {
                        if(msg.status=='0'){
                            $('#wltable').append(msg.data);
                            $('#pesan').html(msg.pesan);
                        }else{
                            Swal.fire({
                                title: "Error",
                                html: msg.pesan,
                                icon: "error",
                                customClass: {popup: 'swalbgerror'},
                                timer: 2000,
                                timerProgressBar: true
                            }).then((result) => {
                                $('#InpBarcode').prop('disabled', false);
                                $('#pesan').html(msg.pesan);
                                $("#InpBarcode").val('');
                                $("#InpBarcode").select();
                            });                
                        }
                    },
                    complete:function(){
                        $('#tload').hide();
                        $('#InpBarcode').prop('disabled', false);
                        $("#InpBarcode").val('');
                        $("#InpBarcode").select();
                        var nowrowcount=$('#tabledata tbody tr').size();
                        if (nowrowcount>0){
                            $('#btnSimpan').show();
                        }else{
                            $('#btnSimpan').hide();
                        }
                        infojumlahdata();
                        let table = document.getElementById("paneldata");
                        table.scrollTop = table.scrollHeight;
                    }
                });
            }
        }
    }

    $('.chosen-select').chosen({width: "100%"});
    var load = document.getElementById("loading");window.addEventListener('load', function(){load.style.display = "none";});
    $("#InpBarcode").select();
    
    function isNumberKey(evt, obj) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        var value = obj.value;
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46) return false;
        if (charCode == 46) return true;
        if (charCode == 45 && value.length!==0) return false;
        if (charCode == 45) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    };

    function infojumlahdata(){
        var rowCount = $('#tabledata tbody tr').size();
        $('#info').html(rowCount)
    }
</script>