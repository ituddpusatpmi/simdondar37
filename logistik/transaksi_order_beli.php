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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .frmSearch {
            border: 1px solid #a8d4b1;
            background-color: #c6f7d0;
            margin: 2px 0px;
            padding: 40px;
            border-radius: 4px;
        }

        #country-list {
            float: left;
            list-style: none;
            margin-top: -3px;
            padding: 0;
            width: 190px;
            position: absolute;
        }

        #country-list li {
            padding: 10px;
            background: #f0f0f0;
            border-bottom: #bbb9b9 1px solid;
        }

        #country-list li:hover {
            background: #ece3d2;
            cursor: pointer;
        }

        #search-box {
            padding: 10px;
            border: #a8d4b1 1px solid;
            border-radius: 4px;
        }
    </style>
    <script>
        // AJAX call for autocomplete
        $(document).ready(function() {
            $("#search-box").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "belibarang.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#search-box").css("background", "#FFF");
                    }
                });
            });
        });
        //To select country name
        function selectCountry(val) {
            $("#search-box").val(val);
            $("#kode").val(val);
            kode = $("#kode").val();
            $("#suggesstion-box").hide();
            //tampilkan status loading dan animasinya
            $("#status").html("loading. . .");
            $("#loading").show();

            //lakukan pengiriman data
            $.ajax({
                url: "transaksi_beli_proses.php",
                data: "op=ambildata&kode=" + kode,
                cache: false,
                success: function(msg) {
                    data = msg.split("|");

                    //masukan isi data ke masing - masing field
                    $("#namabrg").val(data[0]);
                    $("#harga").val(data[1]);
                    $("#stoktotal").val(data[2]);
                    $("#diskonpersen").val("");
                    $("#qtytransaksi").focus();
                    $("#nolot").val("");
                    $("#kadaluwarsa").val("");
                    //hilangkan status animasi dan loading
                    $("#status").html("");
                    $("#loading").hide();
                }
            });
        }
    </script>
    <script>
        //mendeksripsikan variabel yang akan digunakan
        var notrans;
        var tanggal;
        var tgljtempo;
        var kode;
        var namabrg;
        var harga;
        var rab;
        var qtytransaksi;
        var stoktotal;
        var subtotal1;
        var diskonpersen;
        var kodesup;
        var namasup;
        var alamatsup;
        var tlpsup;
        var prefix;
        var ppn = 0;
        var subtotal = 0;
        var potongan = 0;
        var total = 0;
        var biayalain = 0;
        var sisa;
        var catatan_detail;

        $(function() {
            //meload file pk dengan operator ambil barang dimana nantinya
            //isinya akan masuk di combo box
            $("#kode").load("transaksi_order_beli_proses.php", "op=ambilbarang");
            $("#kodesup").load("transaksi_order_beli_proses.php", "op=ambilkodesupplier");

            //meload isi tabel
            $("#barang").load("transaksi_order_beli_proses.php", "op=barang");

            //mengkosongkan input text dengan masing2 id berikut
            $("#namabrg").val("");
            $("#harga").val("");
            $("#qtytransaksi").val("");
            $("#stoktotal").val("");
            $("#rab").val("");
            $("#namasup").val("");
            $("#alamatsup").val("");
            $("#tlpsup").val("");
            $("#nolot").val("");
            $("#kadaluwarsa").val("");



            //jika ada perubahan di kode barang
            $("#kode").change(function() {
                kode = $("#kode").val();

                //tampilkan status loading dan animasinya
                $("#status").html("loading. . .");
                $("#loading").show();

                //lakukan pengiriman data
                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=ambildata&kode=" + kode,
                    cache: false,
                    success: function(msg) {
                        data = msg.split("|");

                        //masukan isi data ke masing - masing field
                        $("#namabrg").val(data[0]);
                        $("#harga").val(data[1]);
                        $("#stoktotal").val(data[2]);
                        $("#diskonpersen").val("");
                        $("#qtytransaksi").focus();
                        //hilangkan status animasi dan loading
                        $("#status").html("");
                        $("#loading").hide();
                    }
                });
            })
            //User memilih kode suplier
            $("#kodesup").change(function() {
                kodesup = $("#kodesup").val();

                //tampilkan status loading dan animasinya
                $("#status").html("loading. . .");
                $("#loading").show();

                //lakukan pengiriman data
                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=ambildatasup&kodesup=" + kodesup,
                    cache: false,
                    success: function(msg) {
                        data = msg.split("|");
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
            $("#tambah").click(function() {
                kode = $("#kode").val();
                stoktotal = $("#stoktotal").val();
                qtytransaksi = $("#qtytransaksi").val();
                rab = $("#rab").val();
                diskonpersen = $("#diskonpersen").val();
                potongan = $("#potongan").val();
                ppn = $("#ppn").val();
                biayalain = $("#biayalain").val();
                total = $("#total").val();
                nolot = $("#nolot").val();
                kadaluwarsa = $("#kadaluwarsa").val();


                if (kode == "Kode Barang") {
                    alert("Kode Barang Harus diisi");
                    exit();
                } else if (qtytransaksi < 1) {
                    alert("Jumlah order pembelian tidak boleh 0");
                    $("#qtytransaksi").focus();
                    exit();
                }
                namabrg = $("#namabrg").val();
                harga = $("#harga").val();

                $("#status").html("proses. . .");
                $("#loading").show();

                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=tambah&kode=" + kode + "&namabrg=" + namabrg + "&harga=" + harga + "&qtytransaksi=" + qtytransaksi + "&diskonpersen=" + diskonpersen + "&nolot=" + nolot + "&kadaluwarsa=" + kadaluwarsa + "&rab=" + rab,
                    cache: false,
                    success: function(msg) {
                        if (msg == "sukses") {
                            $("#status").html("Ok");
                        } else {
                            $("#status").html("Gagal");
                        }
                        $("#loading").hide();
                        $("#namabrg").val("");
                        $("#harga").val("");
                        $("#qtytransaksi").val(0);
                        $("#diskonpersen").val(0);
                        $("#stoktotal").val("");
                        $("#rab").val("");
                        $("#kode").load("transaksi_order_beli_proses.php", "op=ambilbarang");
                        $("#barang").load("transaksi_order_beli_proses.php", "op=barang");
                        $("#search-box").val("");
                        $("#search-box").focus();
                    }
                });
            });

            //jika batal tambah di klik
            $("#batal").click(function() {
                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=hapustemp",
                    cache: false,
                    success: function(msg) {
                        if (msg == "sukses") {
                            $("#status").html("Ok");
                        } else {
                            $("#status").html("Gagal");
                        }
                    }
                });
            });

            //Hitung total on change
            $("#hitungtotal").change(function() {
                potongan = $("#potongan").val();
                ppn = $("#ppn").val();
                ppntotal = $("#ppntotal").val();
                biayalain = $("#biayalain").val();

                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=hitungtotal&potongan=" + potongan + "&ppn=" + ppn + "&biayalain=" + biayalain + "&ppntotal=" + ppntotal,
                    cache: false,
                    success: function(msg) {
                        data = msg.split("|");
                        $("#status").html("Gagal");
                        //masukan isi data ke masing - masing field
                        $("#potongan").val(data[0]);
                        $("#ppn").val(data[1]);
                        $("#biayalain").val(data[2]);
                        $("#total").val(data[3]);
                        $("#ppntotal").val(data[4]);
                        //hilangkan status animasi dan loading
                        $("#status").html("");
                        $("#loading").hide();
                    }
                })
            });

            $("#hitungtotal").click(function() {
                potongan = $("#potongan").val();
                ppn = $("#ppn").val();
                ppntotal = $("#ppntotal").val();
                biayalain = $("#biayalain").val();

                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=hitungtotal&potongan=" + potongan + "&ppn=" + ppn + "&biayalain=" + biayalain + "&ppntotal=" + ppntotal,
                    cache: false,
                    success: function(msg) {
                        data = msg.split("|");
                        $("#status").html("Gagal");
                        //masukan isi data ke masing - masing field
                        $("#potongan").val(data[0]);
                        $("#ppn").val(data[1]);
                        $("#biayalain").val(data[2]);
                        $("#total").val(data[3]);
                        $("#ppntotal").val(data[4]);
                        //hilangkan status animasi dan loading
                        $("#status").html("");
                        $("#loading").hide();
                    }
                })
            });

            //jika tombol proses diklik
            $("#proses").click(function() {
                notrans = $("#notrans").val();
                tanggal = $("#tanggal").val();
                kodesup = $("#kodesup").val();
                prefix = "PO";
                ppn = $("#ppn").val();
                potongan = $("#potongan").val();
                biayalain = $("#biayalain").val();
                catatan_detail = $("#catatan_detail").val();

                if (kodesup == "Supplier") {
                    alert("Suplier harus dipilih");
                    exit();
                }
                $.ajax({
                    url: "transaksi_order_beli_proses.php",
                    data: "op=proses&notrans=" + notrans + "&tanggal=" + tanggal + "&kodesup=" + kodesup + "&prefix=" + prefix + "&ppn=" + ppn + "&potongan=" + potongan + "&biayalain=" + biayalain + "&catatan_detail=" + catatan_detail,
                    cache: false,
                    success: function(msg) {
                        data = msg.split("|");
                        if (data[0] == 'sukses') {
                            $("#status").html('Transaksi order pembelian barang berhasil diproses');
                            alert('Transaksi order pembelian barang berhasil diproses');
                            window.location = '../pmilogistik.php?module=rincian_order_beli&notrans=' + data[1];
                            exit();
                        } else {
                            $("#status").html('Transaksi order pembelian barang GAGAL diproses');
                            alert('Transaksi order pembelian barang GAGAL diproses');
                            exit();
                        }
                        $("#kode").load("transaksi_order_beli_proses.php", "op=ambilbarang");
                        $("#barang").load("transaksi_order_beli_proses.php", "op=barang");

                        $("#potongan").val(0);
                        $("#ppn").val(0);
                        $("#biayalain").val(0);
                        $("#total").val(0);
                        $("#catatan_detail").val("");

                        $("#loading").hide();
                        $("#namabrg").val("");
                        $("#harga").val(0);
                        $("#diskonpersen").val(0);
                        $("#qtytransaksi").val(0);
                        $("#stoktotal").val(0);
                        $("#rab").val("");
                    }
                })
            })
        });
        $(document).ready(function() {
            $('#kodesup').select2();
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
        $prefix   = "PO"; //Purchasing Order
        $kdthn    = substr(date("Y"), 2, 2);
        $kdprefix = $prefix . $kdthn;
        $jumdigit = 6;
        $kddata   = mysql_fetch_assoc(mysql_query("select notrans from hstok_order where substring(notrans,1,4)='$kdprefix' order by notrans desc limit 1"));
        $nodata   = substr($kddata[notrans], 4, $jumdigit);
        $no       = $nodata + 1;
        $j_nol   = $jumdigit - (strlen(strval($no)));
        for ($i = 0; $i < $j_nol; $i++) {
            $jnol .= "0";
        }
        $notrans  = $kdprefix . $jnol . $no;
        //Akhir pembuatan nomor transaksi otomatis======================================

        echo "<div class='navbar-form pull-right'>
                        <br>
                            Nomor : <input type='text'  class='input-small' id='notrans' value='$notrans' readonly >
                            Tanggal :<input type='date' class='input-medium' id='tanggal' value='$tgl'>
                      </div>";
        echo '<br><legend>Transaksi Order Pembelian Barang</legend>
                     <label>Supplier</label>
                     <select class="selectpicker" data-style="btn-primary" id="kodesup"></select>
                     <input type="text" class="input-xlarge" id="namasup" placeholder="Nama supplier" readonly>
                     <input type="text" class="input-xlarge" id="alamatsup" placeholder="Alamat" readonly>
                     <input type="text" class="input-medium" id="tlpsup" placeholder="telp" readonly>
                     
                     <label>Kode</label>
                    <input type="text" id="search-box" placeholder="Ketik Nama Barang" />
                    <div id="suggesstion-box"></div>
                     <input type="hidden" id="kode">
                     <input type="text" class="input-xlarge" id="namabrg" placeholder="Nama Barang" readonly>
                     <input type="text" class="input-mini" id="stoktotal" placeholder="stok" readonly>
                     <input type="text" class="input-medium" id="harga" placeholder="Harga" class="span3">
                     <input type="text" class="input-mini" id="qtytransaksi" placeholder="Jml Order" class="span1">
                     <input type="text" class="input-mini" id="diskonpersen" placeholder="diskon" class="span1">
                     <input type="text" class="input-mini" id="rab" placeholder="Anggaran" class="span1">
                     <button id="tambah" class="btn-warning">Ok</button>
                            
                     <span id="status"></span>
                     <table id="barang" class="table table-condensed">              
                     
                     </table>';
        echo "
                     <div id='hitungtotal' class='navbar-form pull-right'><br>
                            Potongan : <input type='text'  class='input-small' id='potongan'>
                            PPN : <input type='text'  class='input-mini' id='ppn'>
                            <input type='text'  class='input-small' id='ppntotal' readonly>
                            Biaya lain : <input type='text'  class='input-small' id='biayalain'>
                            Total : <input type='text'  class='input-small' id='total' readonly>
                      </div>
                     ";
        echo '
                     <div id="note" class="navbar-form pull-right">
                        <input type="text" class="input-xxlarge" id="peringatan" placeholder="Potongan, PPN, Biaya tidak boleh kosong. Bila tdk ada, ketik 0" readonly>
                        <br>
                        <input type="text" class="input-xxlarge" id="catatan_detail" placeholder="Catatan order">
                     </div>
                     ';
        echo '
                     <div class="form-actions">
                        <button class="btn-primary btn-large" id="proses">Proses Order Pembelian</button>
                        <button class="btn-primary btn-large" id="batal">Batal</button>
                     </div>';
        ?>
    </div>
</body>

</html>