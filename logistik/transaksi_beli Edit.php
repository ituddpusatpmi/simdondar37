<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="css/bootstrap.css">
            <script src="js/jquery.js"></script>
            <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
            <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
            <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
            <script type="text/javascript" src="js/disable_enter.js"></script>
            <script src="js/jquery.ui.datepicker.js"></script>
            <script>
                //mendeksripsikan variabel yang akan digunakan
                var notrans;
                var tanggal;
                var tgljtempo;
                var kode;
                var namabrg;
                var harga;
                var qtytransaksi;
                var stoktotal;
                var subtotal1;
                var diskonpersen;
                var kodesup;
                var namasup;
                var alamatsup;
                var tlpsup;
                var prefix;
                var ppn=0;
                var subtotal=0;
                var potongan=0;
                var total=0;
                var biayalain=0;
                var sisa;
                var hutang;
                var nolot;
                var kadaluwarsa;
                
                $(function(){
                    //meload file pk dengan operator ambil barang dimana nantinya
                    //isinya akan masuk di combo box
                    $("#kode").load("transaksi_beli_proses.php","op=ambilbarang");
                    $("#kodesup").load("transaksi_beli_proses.php","op=ambilkodesupplier");
                    
                    //meload isi tabel
                    $("#barang").load("transaksi_beli_proses.php","op=barang");
                    
                    //mengkosongkan input text dengan masing2 id berikut
                    $("#namabrg").val("");
                    $("#harga").val("");
                    $("#qtytransaksi").val("");
                    $("#stoktotal").val("");
                    $("#namasup").val("");
                    $("#alamatsup").val("");
                    $("#tlpsup").val("");
                    $("#nolot").val("");
                    $("#kadaluwarsa").val("");
                    
                    
                                
                    //jika ada perubahan di kode barang
                    $("#kode").change(function(){
                        kode=$("#kode").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"transaksi_beli_proses.php",
                            data:"op=ambildata&kode="+kode,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                
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
                    })
                    //User memilih kode suplier
                    $("#kodesup").change(function(){
                        kodesup=$("#kodesup").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"transaksi_beli_proses.php",
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
                        diskonpersen=$("#diskonpersen").val();
                        potongan    =$("#potongan").val();
                        ppn         =$("#ppn").val();
                        biayalain   =$("#biayalain").val();
                        total       =$("#total").val();
                        nolot       =$("#nolot").val();
                        kadaluwarsa =$("#kadaluwarsa").val();
                        
                        if(kode=="Kode Barang"){
                            alert("Kode Barang Harus diisi");
                            exit();
                        }else if(qtytransaksi < 1){
                            alert("Jumlah beli tidak boleh 0");
                            $("#qtytransaksi").focus();
                            exit();
                        }
                        namabrg=$("#namabrg").val();
                        harga=$("#harga").val();
                                                
                        $("#status").html("proses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"transaksi_beli_proses.php",
                            data:"op=tambah&kode="+kode+"&namabrg="+namabrg+"&harga="+harga+"&qtytransaksi="+qtytransaksi+"&diskonpersen="+diskonpersen+"&nolot="+nolot+"&kadaluwarsa="+kadaluwarsa,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html("Ok");
                                }else{
                                    $("#status").html("Gagal");
                                }
                                $("#loading").hide();
                                $("#namabrg").val("");
                                $("#harga").val("");
                                $("#qtytransaksi").val(0);
                                $("#diskonpersen").val(0);
                                $("#stoktotal").val("");
                                $("#nolot").val("");
                                $("#kadaluwarsa").val("");
                                $("#kode").load("transaksi_beli_proses.php","op=ambilbarang");
                                $("#barang").load("transaksi_beli_proses.php","op=barang");
                                
                                //$("#hitungtotal").load("transaksi_beli_proses.php","op=hitungtotal&potongan="+potongan+"&ppn="+ppn+"&total="+total);
                                //$("#potongan").val(data[0]);
                                //$("#ppn").val(data[1]);
                                //$("#total").val(data[2]);
                            }
                        });
                    });
                    
                    //Hitung total on change
                    $("#hitungtotal").change(function(){
                        potongan    =$("#potongan").val();
                        ppn         =$("#ppn").val();
                        biayalain   =$("#biayalain").val();
                        
                        $.ajax({
                            url:"transaksi_beli_proses.php",
                            data:"op=hitungtotal&potongan="+potongan+"&ppn="+ppn+"&biayalain="+biayalain,
                            cache:false,
                             success:function(msg){
                                data=msg.split("|");
                                    $("#status").html("Gagal");
                                //masukan isi data ke masing - masing field
                                $("#potongan").val(data[0]);
                                $("#ppn").val(data[1]);
                                $("#biayalain").val(data[2]);
                                $("#total").val(data[3]);
                                //hilangkan status animasi dan loading
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        })
                    });
                    
                    $("#hitungtotal").click(function(){
                        potongan    =$("#potongan").val();
                        ppn         =$("#ppn").val();
                        biayalain   =$("#biayalain").val();
                        
                        $.ajax({
                            url:"transaksi_beli_proses.php",
                            data:"op=hitungtotal&potongan="+potongan+"&ppn="+ppn+"&biayalain="+biayalain,
                            cache:false,
                             success:function(msg){
                                data=msg.split("|");
                                    $("#status").html("Gagal");
                                //masukan isi data ke masing - masing field
                                $("#potongan").val(data[0]);
                                $("#ppn").val(data[1]);
                                $("#biayalain").val(data[2]);
                                $("#total").val(data[3]);
                                //hilangkan status animasi dan loading
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        })
                    });
                    
                    //jika tombol proses diklik
                    $("#proses").click(function(){
                        notrans     =$("#notrans").val();
                        tanggal     =$("#tanggal").val();
                        kodesup     =$("#kodesup").val();
                        prefix      ="PJ";
                        ppn         =$("#ppn").val();
                        potongan    =$("#potongan").val();
                        biayalain   =$("#biayalain").val();
                        hutang      =$("#hutang").val();
                        tgljtempo   =$("#tgljtempo").val();
                        
                        $.ajax({
                            url:"transaksi_beli_proses.php",
                            data:"op=proses&notrans="+notrans+"&tanggal="+tanggal+"&kodesup="+kodesup+"&prefix="+prefix+"&ppn="+ppn+"&potongan="+potongan+"&biayalain="+biayalain+"&hutang="+hutang+"&tgljtempo="+tgljtempo,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
                                    $("#status").html('Transaksi Pembelian berhasil');
                                    alert('Transaksi Berhasil');
                                    
                                    exit();
                                }else{
                                    $("#status").html('Transaksi Gagal');
                                    alert('Transaksi Gagal');
                                    exit();
                                }
                                $("#kode").load("transaksi_beli_proses.php","op=ambilbarang");
                                $("#barang").load("transaksi_beli_proses.php","op=barang");
                                
                                //$("#hitung").load("transaksi_beli_proses.php","op=hitungtotal&potongan="+potongan+"&ppn="+ppn+"&total="+total);
                                $("#potongan").val(0);
                                $("#ppn").val(0);
                                $("#biayalain").val(0);
                                $("#total").val(0);
                                                                
                                $("#loading").hide();
                                $("#namabrg").val("");
                                $("#harga").val("");
                                $("#diskonpersen").val("");
                                $("#qtytransaksi").val("");
                                $("#stoktotal").val("");
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
                
                //include('clogin.php');
                //include('config/db_connect.php');
                //$namauser=$_SESSION[namauser];
                $tgl=date('Y-m-d');
                $tg =substr($tgl,9,2);
                $tgl1=(int)$tg;
                $tgl1=$tgl1+25;
                $a= mktime(0,0,0,date("m"),$tgl1,date("Y"));
                $jtempo=date("Y-m-d",$a);
                
                //Membuat nomor transaksi 5 digit ==============================================                               
                $prefix   = "PJ";
                $kdthn    = substr(date("Y"),2,2);
                $kdprefix = $prefix.$kdthn;
                $jumdigit = 6;
                $kddata   = mysql_fetch_assoc(mysql_query("select notrans from hstok_transaksi where substring(notrans,1,4)='$kdprefix' order by notrans desc limit 1"));
                $nodata   = substr($kddata[notrans],4,$jumdigit);
                $no       = $nodata+1;
                $j_nol   = $jumdigit-(strlen(strval($no)));
                           for ($i=0; $i<$j_nol; $i++){
            	               $jnol.="0";
                            }
                $notrans  = $kdprefix.$jnol.$no;
                //Akhir pembuatan nomor transaksi otomatis======================================
                        
                echo "<div class='navbar-form pull-right'>
                                Nomor : <input type='text'  class='input-small' id='notrans' value='$notrans' readonly >
                                Tanggal :<input type='text' class='input-small' id='tanggal' value='$tgl' readonly>
                                Jatuh Tempo :<input type='text' class='input-small' id='tgljtempo' value='$jtempo'>
                                <input type='checkbox' id='hutang' />Hutang</label>
                      </div>";
                echo'<legend>Transaksi Penerimaan/Pembelian Barang</legend>
                     <label class="mini">Supplier</label>
                     <select id="kodesup"></select>
                     <input type="text" class="input-xlarge" id="namasup" placeholder="Nama supplier" readonly>
                     <input type="text" class="input-xlarge" id="alamatsup" placeholder="Alamat" readonly>
                     <input type="text" class="input-small" id="tlpsup" placeholder="telp" readonly>
                     
                     <label>Kode</label>
                     <select id="kode"></select>
                     <input type="text" class="input-large" id="namabrg" placeholder="Nama Barang" readonly>
                     <input type="text" class="input-small" id="harga" placeholder="Harga" class="span3">
                     <input type="text" class="input-mini" id="qtytransaksi" placeholder="Jumlah" class="span1">
                     <input type="text" class="input-mini" id="diskonpersen" placeholder="diskon" class="span1">
                     <input type="text" class="input-mini" id="nolot" placeholder="nolot" class="span1">
                     <input type="text" class="input-mini" id="kadaluwarsa" placeholder="ED" class="span1">
                     <button id="tambah" class="btn-warning">Tambah</button>
                            
                     <span id="status"></span>
                     <table id="barang" class="table table-condensed">              
                     
                     </table>';
                    echo"
                     <div id='hitungtotal' class='navbar-form pull-right'>
                                Potongan : <input type='text'  class='input-small' id='potongan'>
                                PPN : <input type='text'  class='input-small' id='ppn'>
                                Biaya lain : <input type='text'  class='input-small' id='biayalain'>
                                Total : <input type='text'  class='input-small' id='total'>
                      </div>
                     ";
                echo '
                     <div class="form-actions">
                        <button class="btn-primary" id="proses">Proses</button>
                     </div>';
                ?>
            </div>
        </body>
    </html>