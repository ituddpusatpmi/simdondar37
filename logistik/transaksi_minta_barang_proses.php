<?php
include "db/koneksi.php";
session_start();
$namauser = $_SESSION[namauser];
$levelusr = $_SESSION[leveluser];

$op = isset($_GET['op']) ? $_GET['op'] : null;
if ($op == 'ambilbarang') {
    $data = mysql_query("select * from hstok where stoktotal >='1' AND aktif='0'");
    echo "<option>Barang</option>";
    while ($r = mysql_fetch_array($data)) {
        echo "<option value='$r[kode]'>$r[namabrg]</option>";
    }
} elseif ($op == 'ambildata') {
    $kode = $_GET['kode'];
    $dt = mysql_query("select * from hstok where kode='$kode'");
    $d = mysql_fetch_array($dt);

    echo $d['namabrg'] . "|" . $d['harga'] . "|" . $d['stoktotal'];
} elseif ($op == 'ambilkodesupplier') {
    $data = mysql_query("select * from supplier where Jenis=2");
    echo "<option>Bagian</option>";
    while ($r = mysql_fetch_array($data)) {
        echo "<option value='$r[Kode]'>$r[Nama]</option>";
    }
} elseif ($op == 'ambildatasup') {
    $kodesup = $_GET['kodesup'];
    $dt = mysql_query("select Nama as namasup, Alamat as alamatsup, Telp1 as tlpsup from supplier where Kode='$kodesup'");
    $d = mysql_fetch_array($dt);
    echo $d['namasup'] . "|" . $d['alamatsup'] . "|" . $d['tlpsup'];
} elseif ($op == 'barang') {
    $brg = mysql_query("select * from hstok_order_detail_tmp where namauser='$namauser'");
    echo "<thead>
            <tr>
                <td>Kode</td>
                <td>Nama</td>
                <td>Order</td>
                <td>Aksi</td>
            </tr>
        </thead>";
    while ($r = mysql_fetch_array($brg)) {
        echo "<tr>

                <td>$r[kode]</td>
                <td>$r[namabrg]</td>
                <td>$r[qtyorder]</td>
                <td><a href='transaksi_minta_barang_proses.php?op=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
            </tr>";
    }
} elseif ($op == 'tambah') {
    $kode        = $_GET['kode'];
    $namabrg     = $_GET['namabrg'];
    $qtytransaksi = $_GET['qtytransaksi'];

    $tambah = mysql_query("INSERT into hstok_order_detail_tmp (kode,namabrg,harga,qtyorder,diskonpersen,subtotal,namauser)
                         values ('$kode','$namabrg',0,'$qtytransaksi',0,0,'$namauser')");
    if ($tambah) {
        echo "sukses";
    } else {
        echo "ERROR";
    }
} elseif ($op == 'hapus') {
    $kode = $_GET['kode'];
    $del = mysql_query("delete from hstok_order_detail_tmp where kode='$kode' and namauser='$namauser'");
    if ($del) {
        echo "<script>window.location='transaksi_minta_barang.php';</script>";
    } else {
        echo "<script>alert('Hapus Data Berhasil');
            window.location='transaksi_minta_barang.php';</script>";
    }
} elseif ($op == 'hapustemp') {
    mysql_query("delete from hstok_order_detail_tmp where namauser='$namauser'");
} elseif ($op == 'proses') {
    $prefix     = $_GET['prefix'];
    //buat nomor transaksi kembali, menghindari ada user lain yang melakukan transaksi yang sama
    //Membuat nomor transaksi 5 digit ==============================================                               
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

    $tanggal    = $_GET['tanggal'];
    $kodesup    = $_GET['kodesup'];
    $catatan_detail = $_GET['catatan_detail'];
    $uraian     = "Permintaan Barang-" . $notrans . "-" . $kodesup;

    $simpan = mysql_query("insert into hstok_order(notrans, supplier, tanggal, jenis, subtotal, potongan, ppn, biayalain,total, petugas,uraian, catatanlain)
                        values ('$notrans','$kodesup','$tanggal','$prefix',0,0,0,0,0, '$namauser', '$uraian','$catatan_detail')");
    if ($simpan) {
        $query = mysql_query("select kode, harga, qtyorder,diskonpersen,subtotal from hstok_order_detail_tmp where namauser='$namauser'");
        while ($r = mysql_fetch_row($query)) {
            $detail = mysql_query("insert into hstok_order_detail (notrans, kode, harga, qtyorder, diskonpersen, subtotal)
                        values ('$notrans','$r[0]','$r[1]','$r[2]','$r[3]','$r[4]')");
        }
        mysql_query("delete from hstok_order_detail_tmp where namauser='$namauser'");
        echo "sukses|" . $notrans . "|" . $levelusr;
    } else {
        echo "ERROR";
    }
}
