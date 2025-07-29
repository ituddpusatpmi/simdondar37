<?php
include "db/koneksi.php";
session_start();

$namauser = $_SESSION[namauser];
$levelusr = $_SESSION[leveluser];

$op = isset($_GET['op']) ? $_GET['op'] : null;
if ($op == 'ambilbarang') {
    $data = mysql_query("select * from hstok where stoktotal>0");
    echo "<option>Barang</option>";
    while ($r = mysql_fetch_array($data)) {
        echo "<option value='$r[kode]'>$r[namabrg]</option>";
    }
} elseif ($op == 'ambildata') {
    $kode = $_GET['kode'];
    $dt = mysql_query("select * from hstok where kode='$kode'");
    $d = mysql_fetch_array($dt);
    echo $d['namabrg'] . "|" . $d['hjual'] . "|" . $d['stoktotal'];
} elseif ($op == 'ambilkodesupplier') {
    $data = mysql_query("select * from supplier where Jenis=1");
    echo "<option>Customer</option>";
    while ($r = mysql_fetch_array($data)) {
        echo "<option value='$r[Kode]'>$r[Nama]</option>";
    }
} elseif ($op == 'ambildatasup') {
    $kodesup = $_GET['kodesup'];
    $dt = mysql_query("select Nama as namasup, Alamat as alamatsup, Telp1 as tlpsup from supplier where Kode='$kodesup'");
    $d = mysql_fetch_array($dt);
    echo $d['namasup'] . "|" . $d['alamatsup'] . "|" . $d['tlpsup'];
} elseif ($op == 'barang') {
    $brg = mysql_query("select * from hstok_transaksi_detail_tmp where namauser='$namauser'");
    echo "<thead>
            <tr>
                <td>Kode</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <td>Diskon</td>
                <td>Sub total</td>
                <td>No.Lot</td>
                <td>ED</td>
                <td>Aksi</td>
            </tr>
        </thead>";
    $subtotal = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $fsubtotal1 = number_format($subtotal[total], 0, ',', '.');
    while ($r = mysql_fetch_array($brg)) {
        $fharga = number_format($r[harga], 0, ',', '.');
        $fsubtotal = number_format($r[subtotal], 0, ',', '.');
        $fqtytransaksi = number_format($r[qtytransaksi], 0, ',', '.');
        echo "<tr>
                <td>$r[kode]</td>
                <td>$r[namabrg]</td>
                <td>$fharga</td>
                <td>$fqtytransaksi</td>
                <td>$r[diskonpersen]</td>
                <td>$fsubtotal</td>
                <td>$r[nomorlot]</td>
                <td>$r[kadaluwarsa]</td>
                <td><a href='transaksi_jual_proses.php?op=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
            </tr>";
    }
    echo "<tr><td colspan='4'> </td>
              <td>Sub Total</td>
              <td colspan='2'>$fsubtotal1</td>
              <td></td>
          </tr>
         ";
} elseif ($op == 'tambah') {
    $kode        = $_GET['kode'];
    $namabrg     = $_GET['namabrg'];
    $harga       = $_GET['harga'];
    $diskonpersen = $_GET['diskonpersen'];
    $qtytransaksi = $_GET['qtytransaksi'];
    $nomorlot    = $_GET['nolot'];
    $kadaluwarsa = $_GET['kadaluwarsa'];
    $subtotal    = ($harga - ($harga * $diskonpersen / 100)) * $qtytransaksi;

    $sql = "INSERT into hstok_transaksi_detail_tmp (kode,namabrg,harga,qtytransaksi,diskonpersen,subtotal,nomorlot,kadaluwarsa, namauser)
                         values ('$kode','$namabrg','$harga','$qtytransaksi','$diskonpersen','$subtotal','$nomorlot','$kadaluwarsa','$namauser')";
    $tambah = mysql_query("INSERT into hstok_transaksi_detail_tmp (kode,namabrg,harga,qtytransaksi,diskonpersen,subtotal,nomorlot,kadaluwarsa, namauser)
                         values ('$kode','$namabrg','$harga','$qtytransaksi','$diskonpersen','$subtotal','$nomorlot','$kadaluwarsa','$namauser')");
    if ($tambah) {
        echo "sukses";
    } else {
        echo $sql;
    }
} elseif ($op == 'hitungtotal') {
    $potongan    = $_GET['potongan'];
    $ppn         = $_GET['ppn'];
    $biayalain   = $_GET['biayalain'];
    $ppntotal    = $_GET['ppntotal'];
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $ppntotal    = ($subtotal[total] - $potongan) * $ppn / 100;
    $total       = $subtotal[total] - $potongan + (($subtotal[total] - $potongan) * $ppn / 100) + $biayalain;
    $total       = number_format($total, 0, ',', '.');
    $ppntotal    = number_format($ppntotal, 0, ',', '.');

    echo $potongan . "|" . $ppn . "|" . $biayalain . "|" . $total . "|" . $ppntotal;
} elseif ($op == 'hapus') {
    $kode = $_GET['kode'];
    $del = mysql_query("delete from hstok_transaksi_detail_tmp where kode='$kode' and namauser='$namauser'");
    if ($del) {
        echo "<script>window.location='transaksi_jual.php';</script>";
    } else {
        echo "<script>alert('Hapus Data Berhasil');
            window.location='transaksi_jual.php';</script>";
    }
} elseif ($op == 'hapustemp') {
    mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");
} elseif ($op == 'proses') {
    $notrans    = $_GET['notrans'];
    $tanggal    = $_GET['tanggal'];
    $kodesup    = $_GET['kodesup'];
    $prefix     = $_GET['prefix'];
    $ppn        = $_GET['ppn'];
    $potongan   = $_GET['potongan'];
    $biayalain  = $_GET['biayalain'];
    $hutang     = $_GET['hutang'];
    $tgljtempo  = $_GET['tgljtempo'];
    $nonota     = $_GET['nonota'];
    $uraian     = "Penjualan-" . $notrans . "-" . $kodesup;
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $total       = $subtotal[total] - $potongan + (($subtotal[total] - $potongan) * $ppn / 100) + $biayalain;

    $simpan = mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, subtotal, potongan, ppn, biayalain,total, sisa, petugas,hutangpiutang,jatuhtempo,uraian, noreferensi)
                        values ('$notrans','$kodesup','$tanggal','$prefix','$subtotal[total]','$potongan','$ppn',$biayalain,'$total', '$total', '$namauser', '$hutang', '$tgljtempo','$uraian','$nonota')");
    if ($simpan) {
        //=======Audit Trial====================================================================================
        $log_mdl = $levelusr;
        $log_aksi = "Penjualan barang no transaksi : " . $notrans . ", ke : " . $kodesup;
        include_once "user_log.php";
        //=====================================================================================================
        $query = mysql_query("select kode, harga, qtytransaksi,diskonpersen,subtotal, nomorlot, kadaluwarsa from hstok_transaksi_detail_tmp where namauser='$namauser'");
        while ($r = mysql_fetch_row($query)) {
            $detail = mysql_query("insert into hstok_transaksi_detail (notrans, kode, harga, qtytransaksi, qtykeluar, diskonpersen, subtotal, nomorlot, kadaluwarsa)
                        values ('$notrans','$r[0]','$r[1]','$r[2]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]')");
            $master = mysql_query("update hstok set stoktotal=stoktotal-'$r[2]', hjual='$r[1]' where kode='$r[0]'");
        } //While
        //hapus seluruh isi tabel sementara
        mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");
        echo "sukses";
    } else {
        echo "ERROR";
    }
}
