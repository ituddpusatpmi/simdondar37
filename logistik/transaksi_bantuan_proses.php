<?php
include "db/koneksi.php";
session_start();
$namauser=$_SESSION[namauser];

$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='ambilbarang'){
    $data=mysql_query("select * from hstok");
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
    echo"<option>Penyumbang</option>";
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
                <td><a href='transaksi_bantuan_proses.php?op=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
            </tr>";
    }
}
elseif($op=='tambah'){
    $kode        = $_GET['kode'];
    $namabrg     = $_GET['namabrg'];
    $qtytransaksi= $_GET['qtytransaksi'];
    $nomorlot    = $_GET['nolot'];
    $kadaluwarsa = $_GET['kadaluwarsa'];
    
    $tambah=mysql_query("INSERT into hstok_transaksi_detail_tmp (kode,namabrg,qtytransaksi,nomorlot,kadaluwarsa,namauser)
                         values ('$kode','$namabrg','$qtytransaksi','$nomorlot','$kadaluwarsa','$namauser')");
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
elseif($op=='hapus'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from hstok_transaksi_detail_tmp where kode='$kode' and namauser='$namauser'");
    if($del){
        echo "<script>window.location='transaksi_bantuan.php';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='transaksi_bantuan.php';</script>";
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
    $uraian     = "Penerimaan bantuan-".$notrans."-".$kodesup;
    
    $simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, petugas, uraian, noreferensi)
                        values ('$notrans','$kodesup','$tanggal','$prefix','$namauser', '$uraian','$nonota')");
    if($simpan){
        $query=mysql_query("select kode, qtytransaksi, nomorlot, kadaluwarsa from hstok_transaksi_detail_tmp where namauser='$namauser'");
        while($r=mysql_fetch_row($query)){
            $detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, qtytransaksi, qtymasuk, nomorlot, kadaluwarsa)
                        values ('$notrans','$r[0]','$r[1]','$r[1]','$r[2]','$r[3]')");
            $master=mysql_query("update hstok set stoktotal=stoktotal+'$r[1]' where kode='$r[0]'");
            
            //proses ke reagen apabila termasuk reagen IMLTD
            $sql        = mysql_query("select reagenujs,nama_reagen,metode,ketsatuan from hstok where kode='$r[0]'");
            $sql1       = mysql_fetch_array($sql);
            $statusimltd= 0;
            $statusimltd= $sql1['reagenujs']; 
            
            if($statusimltd==1){
                $nama_reagen= $sql1['nama_reagen'];
                $metode     = $sql1['metode'];
                $noLot      = $r[2];
                $kadaluwarsa= $r[3];
                $jmltest    = $sql1['ketsatuan'];
                $jmlkit     = $r[1];
                $kodestok   = $r[0];
            
                $nm     = substr($nama_reagen,0,2);
                $idp	= mysql_query("select max(kode) as kode from reagen where kode like '$nm%'");
                $idp1	= mysql_fetch_assoc($idp);
                $kdtp	= substr($idp1[kode],2);
                if ($kdtp<1) {
                    $kdtp="00000";
                }
                $kdtp2=(int)$kdtp;
                for ($jk=0;$jk<$jmlkit;$jk++){
                    $kdtp2++;
                    $j_nol1= 6-(strlen($kdtp2));
                    $idp4='';
                    for ($i=0; $i<$j_nol1; $i++){
                        $idp4 .="0";
                    }
                    $kode=$nm.$idp4.$kdtp2;	
                    $sqlreagen="insert into reagen (kodeSup,Nama,noLot,jumTest,metode,tglKad,status,kode,keterangan, kodestok) values
                            ('$kodesup','$nama_reagen','$noLot','$jmltest','$metode','$kadaluwarsa','0','$kode','$notrans','$kodestok')";
                    $insertreagen=mysql_query($sqlreagen); 
                } //Jumlah Kit
            } //IMLTD=1
        }//While
        //hapus seluruh isi tabel sementara
        mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
?>
