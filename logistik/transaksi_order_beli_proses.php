<?php
include "db/koneksi.php";
session_start();
$namauser=$_SESSION[namauser];
$namabagian=$_SESSION[namabagian];
$levelusr=$_SESSION[leveluser];  

$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='ambilbarang'){
    $data=mysql_query("select * from hstok where aktif='0'");
    echo"<option>Barang</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}
elseif($op=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysql_query("select * from hstok where kode='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['namabrg']."|".$d['harga']."|".$d['stoktotal'];
    
}
elseif($op=='ambilkodesupplier'){
    $data=mysql_query("select * from supplier where Jenis=0");
    echo"<option>Supplier</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[Kode]'>$r[Nama]</option>";
    }
}
elseif($op=='ambildatasup'){
    $kodesup=$_GET['kodesup'];
    $dt=mysql_query("select Nama as namasup, Alamat as alamatsup, Telp1 as tlpsup from supplier where Kode='$kodesup'");
    $d=mysql_fetch_array($dt);
    echo $d['namasup']."|".$d['alamatsup']."|".$d['tlpsup'];
    
}
elseif($op=='barang'){
    $brg=mysql_query("select * from hstok_order_detail_tmp where namauser='$namauser'");
    echo "<thead>
            <tr>
                <td>Kode</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Order</td>
                <td>Diskon</td>
                <td>Sub total</td>
                <td>Kode Anggaran</td>
                <td>Aksi</td>
            </tr>
        </thead>";
    $subtotal=mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_order_detail_tmp where namauser='$namauser'"));
    $fsubtotal1=number_format($subtotal[total],0,',','.');
    while($r=mysql_fetch_array($brg)){
        $fharga=number_format($r[harga],0,',','.');
        $fsubtotal=number_format($r[subtotal],0,',','.');
        $fqtytransaksi=number_format($r[qtyorder],0,',','.');
        echo "<tr>
                <td>$r[kode]</td>
                <td>$r[namabrg]</td>
                <td>$fharga</td>
                <td>$fqtytransaksi</td>
                <td>$r[diskonpersen]</td>
                <td>$fsubtotal</td>
                <td>$r[kode_rab]</td>
                <td><a href='transaksi_order_beli_proses.php?op=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
            </tr>";
    }
    echo "<tr><td colspan='4'> </td>
              <td>Sub Total</td>
              <td colspan='2'>$fsubtotal1</td>
              <td></td>
          </tr>
         ";
    
}
elseif($op=='tambah'){
    $kode        = $_GET['kode'];
    $namabrg     = $_GET['namabrg'];
    $harga       = $_GET['harga'];
    $diskonpersen= $_GET['diskonpersen'];
    $qtytransaksi= $_GET['qtytransaksi'];
    $rab         = $_GET['rab'];
    $subtotal    = ($harga-($harga*$diskonpersen/100))*$qtytransaksi;
    
    $tambah=mysql_query("INSERT into hstok_order_detail_tmp (kode,namabrg,harga,qtyorder,diskonpersen,subtotal,namauser,kode_rab)
                         values ('$kode','$namabrg','$harga','$qtytransaksi','$diskonpersen','$subtotal','$namauser','$rab')");
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
elseif($op=='hitungtotal'){
    $potongan    = $_GET['potongan'];
    $ppn         = $_GET['ppn'];
    $ppntotal    = $_GET['ppntotal'];
    $biayalain   = $_GET['biayalain'];
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_order_detail_tmp where namauser='$namauser'"));
    $total       = $subtotal[total]-$potongan + (($subtotal[total]-$potongan)*$ppn/100)+$biayalain;
    $total       = number_format($total,0,',','.');
    $ppntotal    = ($subtotal[total]-$potongan)*$ppn/100;
    $ppntotal    = number_format($ppntotal,0,',','.');
    
    echo $potongan."|".$ppn."|".$biayalain."|".$total."|".$ppntotal;
    
}
elseif($op=='hapus'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from hstok_order_detail_tmp where kode='$kode' and namauser='$namauser'");
    if($del){
        echo "<script>window.location='transaksi_order_beli.php';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='transaksi_order_beli.php';</script>";
    }
}
elseif($op=='hapustemp'){
   mysql_query("delete from hstok_order_detail_tmp where namauser='$namauser'");

}
elseif($op=='proses'){
    //buat nomor transaksi kembali, menghindari ada user lain yang melakukan transaksi yang sama
    //Membuat nomor transaksi 5 digit ==============================================                               
                $prefix   = "PO"; //Purchasing Order
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
    
    $tanggal    =$_GET['tanggal'];
    $kodesup    =$_GET['kodesup'];
    $prefix     =$_GET['prefix'];
    $ppn        =$_GET['ppn'];
    $potongan   =$_GET['potongan'];
    $biayalain  =$_GET['biayalain'];
    $catatan_detail=$_GET['catatan_detail'];
    $uraian     = "Order Pembelian-".$notrans."-".$kodesup;
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_order_detail_tmp where namauser='$namauser'"));
    $total       = $subtotal[total]-$potongan + (($subtotal[total]-$potongan)*$ppn/100) + $biayalain;
    
    $simpan=mysql_query("insert into hstok_order(notrans, supplier, tanggal, jenis, subtotal, potongan, ppn, biayalain,total, petugas,uraian, catatanlain)
                        values ('$notrans','$kodesup','$tanggal','$prefix','$subtotal[total]','$potongan','$ppn',$biayalain,'$total', '$namauser', '$uraian','$catatan_detail')");
    if($simpan){
	//=======Audit Trial====================================================================================
      	    $log_mdl =$levelusr;
            $log_aksi="Order Pembelian, no transaksi : ".$notrans.", ke : ".$kodesup;
            include_once "user_log.php";
        //=====================================================================================================
        $query=mysql_query("select kode, harga, qtyorder,diskonpersen,subtotal, kode_rab from hstok_order_detail_tmp where namauser='$namauser'");
        while($r=mysql_fetch_row($query)){
            $detail=mysql_query("insert into hstok_order_detail (notrans, kode, harga, qtyorder, diskonpersen, subtotal, kode_rab)
                        values ('$notrans','$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]')");
        }
        mysql_query("delete from hstok_order_detail_tmp where namauser='$namauser'");
        echo "sukses|".$notrans;
    }else{
        echo "ERROR";
    }
}
?>
