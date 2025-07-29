<?php
include "db/koneksi.php";
session_start();
$namauser=$_SESSION[namauser];

$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='ambilbarang'){
    $data=mysql_query("select * from hstok where stoktotal>0 and status<>'INV'");
    echo"<option>Barang</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[namabrg]</option>";
    }
}
elseif($op=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysql_query("select * from hstok where kode='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['namabrg']."|".$d['harga']."|".$d['stoktotal'];
    
}
elseif($op=='ambilkodesupplier'){
    $data=mysql_query("select * from supplier where Jenis=2");
    echo"<option>Bagian</option>";
    while($r=mysql_fetch_array($data)){
       // echo "<option value='$r[Kode]'>$r[Kode]</option>";
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
    $brg=mysql_query("select * from hstok_transaksi_detail_tmp where namauser='$namauser'");
    echo "<thead>
            <tr>
                <td>Kode</td>
                <td>Nama</td>
                <td>Jumlah</td>
                <td>No.Lot</td>
                <td>ED</td>
                <td>Aksi</td>
            </tr>
        </thead>";
    while($r=mysql_fetch_array($brg)){
        $fqtytransaksi=number_format($r[qtytransaksi],0,',','.');
        echo "<tr>
                <td>$r[kode]</td>
                <td>$r[namabrg]</td>
                <td>$fqtytransaksi</td>
                <td>$r[nomorlot]</td>
                <td>$r[kadaluwarsa]</td>
                <td><a href='transaksi_keluar_proses.php?op=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
            </tr>";
    }
}
elseif($op=='tambah'){
    $kode        = $_GET['kode'];
    $namabrg     = $_GET['namabrg'];
    $qtytransaksi= $_GET['qtytransaksi'];
    $nomorlot    = $_GET['nolot'];
    $kadaluwarsa = $_GET['kadaluwarsa'];
    
    $tambah=mysql_query("INSERT into hstok_transaksi_detail_tmp (kode,namabrg,qtytransaksi,nomorlot,kadaluwarsa, namauser)
                         values ('$kode','$namabrg','$qtytransaksi','$nomorlot','$kadaluwarsa','$namauser')");
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
elseif($op=='hitungtotal'){
    $potongan    = $_GET['potongan'];
    $ppn         = $_GET['ppn'];
    $biayalain   = $_GET['biayalain'];
    $ppntotal    = $_GET['ppntotal'];
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $ppntotal    = ($subtotal[total]-$potongan)*$ppn/100;
    $total       = $subtotal[total]-$potongan + (($subtotal[total]-$potongan)*$ppn/100)+$biayalain;
    $total       = number_format($total,0,',','.');
    $ppntotal    = number_format($ppntotal,0,',','.');
    
    echo $potongan."|".$ppn."|".$biayalain."|".$total."|".$ppntotal;
    
}
elseif($op=='hapus'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from hstok_transaksi_detail_tmp where kode='$kode' and namauser='$namauser'");
    if($del){
        echo "<script>window.location='transaksi_keluar.php';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='transaksi_keluar.php';</script>";
    }

}
elseif($op=='hapustemp'){
   mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");

}
elseif($op=='proses'){
    $notrans    =$_GET['notrans'];
    $tanggal    =$_GET['tanggal'];
    $kodesup    =$_GET['kodesup'];
    $prefix     =$_GET['prefix'];
    $nonota     =$_GET['nonota'];
    $uraian     = "Pengeluaran-".$notrans."-".$kodesup;
    
    $simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, petugas,uraian, noreferensi)
                        values ('$notrans','$kodesup','$tanggal','$prefix','$namauser','$uraian','$nonota')");
    if($simpan){
        $query=mysql_query("select kode, qtytransaksi, nomorlot, kadaluwarsa from hstok_transaksi_detail_tmp where namauser='$namauser'");
        while($r=mysql_fetch_row($query)){
            $detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, qtytransaksi, qtykeluar, nomorlot, kadaluwarsa)
                        values ('$notrans','$r[0]','$r[1]','$r[1]','$r[2]','$r[3]')");
            $master=mysql_query("update hstok set stoktotal=stoktotal-'$r[1]' where kode='$r[0]'");
        }//While
        //hapus seluruh isi tabel sementara
        mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
?>
