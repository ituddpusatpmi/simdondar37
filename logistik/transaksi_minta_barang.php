<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/bootstrap-select.css">
            
            <script src="css/bootstrap-select.js"></script>
            <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
            <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
            <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
            <script type="text/javascript" src="js/disable_enter.js"></script>
            <script src="js/jquery.ui.datepicker.js"></script>
<script language="javascript" src="thickbox/thickbox.js"></script>
<script language="javascript" src="js/jquery.js"></script>
<link href="thickbox/thickbox.css" rel="stylesheet" type="text/css" />

<style>
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<script>
// AJAX call for autocomplete
$(document).ready(function(){
    $("#search-box").keyup(function(){
        $.ajax({
        type: "POST",
        url: "readCountry.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
        });
    });
});
    

//To select country name
function selectCountry(val) {
$("#search-box").val(val);
    $("#kode").val(val);
    kode=$("#kode").val();
$("#suggesstion-box").hide();
    $("#status").html("loading. . .");
    $("#loading").show();
    
    //lakukan pengiriman data
    $.ajax({
        url:"transaksi_minta_barang_proses.php",
        data:"op=ambildata&kode="+kode,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            //masukan isi data ke masing - masing field
            $("#namabrg").val(data[0]);
            $("#stoktotal").val(data[2]);
            $("#qtytransaksi").focus();
            //hilangkan status animasi dan loading
            $("#status").html("");
            $("#loading").hide();
        }
    });
}
</script>
            <script>
                //mendeksripsikan variabel yang akan digunakan
                var levelusr;
                var notrans;
                var tanggal;
                var kode;
                var namabrg;
                var qtytransaksi;
                var stoktotal;
                var kodesup;
                var namasup;
                var alamatsup;
                var tlpsup;
                var prefix;
                var catatan_detail;
                
                $(function(){
                    //meload file pk dengan operator ambil barang dimana nantinya
                    //isinya akan masuk di combo box
                    $("#kode").load("transaksi_minta_barang_proses.php","op=ambilbarang");
                    $("#kodesup").load("transaksi_minta_barang_proses.php","op=ambilkodesupplier");
                    
                    //meload isi tabel
                    $("#barang").load("transaksi_minta_barang_proses.php","op=barang");
                    
                    //mengkosongkan input text dengan masing2 id berikut
                    $("#namabrg").val("");
                    $("#harga").val("");
                    $("#qtytransaksi").val("");
                    $("#stoktotal").val("");
                    $("#namasup").val("");
                                
                    //jika ada perubahan di kode barang
                    $("#kode").change(function(){
                        kode=$("#kode").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"transaksi_minta_barang_proses.php",
                            data:"op=ambildata&kode="+kode,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                //masukan isi data ke masing - masing field
                                $("#namabrg").val(data[0]);
                                $("#stoktotal").val(data[2]);
                                $("#qtytransaksi").focus();
                                //hilangkan status animasi dan loading
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        });
                    })
                  
                  
                  
                    //User memilih kode suplier
                    $("#kodesup").change(function(){
                        kodesup=$("#kodesup").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"transaksi_minta_barang_proses.php",
                            data:"op=ambildatasup&kodesup="+kodesup,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                //masukan isi data ke masing - masing field
                                $("#namasup").val(data[0]);
                                $("#alamatsup").val(data[1]);
                                $("#tlpsup").val(data[2]);
                                //hilangkan status animasi dan loading
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        });
                    });
                    
                    //jika tombol tambah di klik
                    $("#tambah").click(function(){
                        kode        =$("#kode").val();
                        stoktotal   =$("#stoktotal").val();
                        qtytransaksi=$("#qtytransaksi").val();
                        
                        if(kode=="Kode Barang"){
                            alert("Kode Barang Harus diisi");
                            exit();
                        }else if(qtytransaksi < 1){
                            alert("Jumlah permintaan tidak boleh 0");
                            $("#qtytransaksi").focus();
                            exit();
                        }
                        namabrg=$("#namabrg").val();
                                                
                        $("#status").html("proses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"transaksi_minta_barang_proses.php",
                            data:"op=tambah&kode="+kode+"&namabrg="+namabrg+"&qtytransaksi="+qtytransaksi,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html("Ok");
                                }else{
                                    $("#status").html("Gagal");
                                }
                                $("#loading").hide();
                                $("#namabrg").val("");
                                $("#search-box").val("");
                                $("#qtytransaksi").val("");
                                $("#stoktotal").val("");
                                $("#kode").load("transaksi_minta_barang_proses.php","op=ambilbarang");
                                $("#barang").load("transaksi_minta_barang_proses.php","op=barang");
                                $("#search-box").focus();
                            }
                        });
                    });
                    
                    //jika batal tambah di klik
                    $("#batal").click(function(){
                        $.ajax({
                            url:"transaksi_minta_barang_proses.php",
                            data:"op=hapustemp",
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html("Ok");
                                }else{
                                    $("#status").html("Gagal");
                                }
                            }
                        });
                    });
                    
                    //jika tombol proses diklik
                    $("#proses").click(function(){
                        notrans     =$("#notrans").val();
                        tanggal     =$("#tanggal").val();
                        kodesup     =$("#kodesup").val();
                        prefix      ="SO";
                        catatan_detail=$("#catatan_detail").val();
                        levelusr    ="";
                        
                        if(kodesup=="Bagian"){
                            alert("Bagian yang meminta harus dipilih");
                            exit();
                        }
                        $.ajax({
                            url:"transaksi_minta_barang_proses.php",
                            data:"op=proses&notrans="+notrans+"&tanggal="+tanggal+"&kodesup="+kodesup+"&prefix="+prefix+"&catatan_detail="+catatan_detail,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                if(data[0]=='sukses'){
                                    $("#status").html('Sukses');
                                    alert('Transaksi permintaan barang logistik berhasil diproses pada level '+data[2]);
                                    window.location='rincian_transaksi_minta_barang.php?notrans='+data[1];
                                    exit();
                                }else{
                                    $("#status").html('Transaksi permintaan barang GAGAL diproses');
                                    alert('Transaksi permintaan barang GAGAL diproses');
                                    exit();
                                }
                                $("#kode").load("transaksi_minta_barang_proses.php","op=ambilbarang");
                                $("#barang").load("transaksi_minta_barang_proses.php","op=barang");
                                
                                $("#catatan_detail").val("");
                                                                
                                $("#loading").hide();
                                $("#namabrg").val("");
                                $("#qtytransaksi").val(0);
                                $("#stoktotal").val(0);
                            }
                        })
                    })
                });
            </script>
        </head>
        <body>
            <div class="container">
                <?php
                include "db/koneksi.php";
                
                $tgl    = date('Y-m-d');
                $jtempo = date('Y-m-d');
                
                //Membuat nomor transaksi 5 digit ==============================================                               
                $prefix   = "SO"; //Purchasing Order
                $kdthn    = substr(date("Y"),2,2);
                $kdprefix = $prefix.$kdthn;
                $jumdigit = 6;
                $kddata   = mysql_fetch_assoc(mysql_query("select notrans from hstok_order where substring(notrans,1,4)='$kdprefix' order by notrans desc limit 1"));
                $nodata   = substr($kddata[notrans],4,$jumdigit);
                $no       = $nodata+1;
                $j_nol   = $jumdigit-(strlen(strval($no)));
                           for ($i=0; $i<$j_nol; $i++){
            	               $jnol.="0";
                            }
                $notrans  = $kdprefix.$jnol.$no;
                //Akhir pembuatan nomor transaksi otomatis======================================
                        
                echo "<div class='navbar-form pull-right'>
                        <br>
                            Nomor : <input type='text'  class='input-small' id='notrans' value='$notrans' readonly >
                            Tanggal :<input type='date' class='input-medium' id='tanggal' value='$tgl'>
                      </div>";
                echo'<br><legend>Transaksi Permintaan Barang</legend>
                     <label>Supplier</label>
                     <select class="selectpicker" data-style="btn-primary" id="kodesup"></select>
                     <input type="text" class="input-xlarge" id="namasup" placeholder="Nama bagian" readonly>
                     <label>Pilih Nama Barang</label>
                        <input type="text" id="search-box" placeholder="Ketik Nama Barang.." />
                        <div id="suggesstion-box"></div>
                     <input type="hidden" id="kode">
                     <input type="text" class="input-xlarge" id="namabrg" placeholder="Nama Barang" readonly>
                     <input type="text" class="input-mini" id="stoktotal" placeholder="stok" readonly>
                     <input type="text" class="input-mini" id="qtytransaksi" placeholder="Jumlah" class="span1">
                     <button id="tambah" class="btn-warning">Ok</button>
                            
                     <span id="status"></span>
                     <table id="barang" class="table">              
                     
                     </table>';                    
                echo '
                     <div id="note" class="navbar-form pull-right">
                        <br>
                        <input type="text" class="input-xxlarge" id="catatan_detail" placeholder="Catatan Permintaan">
                     </div>
                     ';
                echo '
                     <div class="form-actions">
                        <button class="btn-primary btn-large" id="proses">Proses Permintaan</button>
                        <button class="btn-primary btn-large" id="batal">Batal</button>
                     </div>';
                ?>
            </div>
        </body>
    </html>
