<?php
include "db/koneksi.php"; 
session_start();
$namauser=$_SESSION[namauser];

$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='ambilbarang'){
    $data=mysql_query("select * from hstok");
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
    $brg=mysql_query("select * from hstok_transaksi_detail_tmp where namauser='$namauser'");
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
    $subtotal=mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $fsubtotal1=number_format($subtotal[total],0,',','.');
    while($r=mysql_fetch_array($brg)){
        $fharga=number_format($r[harga],0,',','.');
        $fsubtotal=number_format($r[subtotal],0,',','.');
        $fqtytransaksi=number_format($r[qtytransaksi],0,',','.');
        echo "<tr>
                <td>$r[kode]</td>
                <td>$r[namabrg]</td>
                <td align='right'>$fharga</td>
                <td align='right'>$fqtytransaksi</td>
                <td align='right'>$r[diskonpersen]</td>
                <td align='right'>$fsubtotal</td>
                <td>$r[nomorlot]</td>
                <td>$r[kadaluwarsa]</td>
                <td><a href='transaksi_beli_proses.php?op=hapus&kode=$r[kode]' id='hapus'>X</a></td>
            </tr>";
    }
    echo "<tr><td colspan='4'> </td>
              <td>Sub Total</td>
              <td colspan='2' align='right'>$fsubtotal1</td>
              <td></td>
          </tr>
         ";
    
}
elseif($op=='tambah'){
    $kode        = $_GET['kode'];
    $namabrg     = $_GET['namabrg'];
    $po          = $_GET['po']; 
    $harga       = $_GET['harga'];
    $diskonpersen= $_GET['diskonpersen'];
    $qtytransaksi= $_GET['qtytransaksi'];
    $nomorlot    = $_GET['nolot'];
    $kadaluwarsa = $_GET['kadaluwarsa'];
    $subtotal    = ($harga-($harga*$diskonpersen/100))*$qtytransaksi;
    
    $tambah=mysql_query("INSERT into hstok_transaksi_detail_tmp (kode,namabrg,harga,qtytransaksi,diskonpersen,subtotal,nomorlot,kadaluwarsa,po,namauser)
                         values ('$kode','$namabrg','$harga','$qtytransaksi','$diskonpersen','$subtotal','$nomorlot','$kadaluwarsa','$po','$namauser')");
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
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $total       = $subtotal[total]-$potongan + (($subtotal[total]-$potongan)*$ppn/100)+$biayalain;
    $total       = number_format($total,0,',','.');
    $ppntotal    = ($subtotal[total]-$potongan)*$ppn/100;
    $ppntotal    = number_format($ppntotal,0,',','.');
    
    echo $potongan."|".$ppn."|".$biayalain."|".$total."|".$ppntotal;
    
}
elseif($op=='hapus'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from hstok_transaksi_detail_tmp where kode='$kode' and namauser='$namauser'");
    if($del){
        echo "<script>window.location='transaksi_beli.php';</script>";
    }else{
        echo "<script>alert('Hapus Data Gagal');
            window.location='transaksi_beli.php';</script>";
    }
}
elseif($op=='hapustemp'){
   mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");
}
elseif($op=='batal'){
   mysql_query("delete from hstok_transaksi_detail_tmp where namauser='$namauser'");
   echo "<script>alert('Transaksi dibatalkan'); window.location='transaksi_beli.php';</script>";
}
elseif($op=='proses'){
    $notrans    =$_GET['notrans'];
    $tanggal    =$_GET['tanggal'];
    $kodesup    =$_GET['kodesup'];
    $prefix     =$_GET['prefix'];
    $po         =$_GET['po'];
    $ppn        =$_GET['ppn'];
    $potongan   =$_GET['potongan'];
    $biayalain  =$_GET['biayalain'];
    $hutang     =$_GET['hutang'];
    $beli     	=$_GET['beli'];
    $tgljtempo  =$_GET['tgljtempo'];
    $nonota     =$_GET['nonota'];
    $uraian     = "Pembelian-".$notrans."-".$kodesup;
    $subtotal    = mysql_fetch_array(mysql_query("select sum(subtotal) as total from hstok_transaksi_detail_tmp where namauser='$namauser'"));
    $total       = $subtotal[total]-$potongan + (($subtotal[total]-$potongan)*$ppn/100) + $biayalain;
if($beli==0){
    
    $simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, subtotal, potongan, ppn, biayalain,total, sisa, petugas,hutangpiutang,jatuhtempo,uraian, noreferensi,po)
                        values ('$notrans','$kodesup','$tanggal','$prefix','$subtotal[total]','$potongan','$ppn',$biayalain,'$total', '$total', '$namauser', '$hutang', '$tgljtempo','$uraian','$nonota','$po')");
    $update_po=mysql_query("update hstok_order set noreferensi='$notrans', status_order='2' where notrans='$po'");
    if($simpan){
        $query=mysql_query("select kode, harga, qtytransaksi,diskonpersen,subtotal, nomorlot, kadaluwarsa from hstok_transaksi_detail_tmp where namauser='$namauser'");
        while($r=mysql_fetch_row($query)){
            $detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, harga, qtytransaksi, qtymasuk, diskonpersen, subtotal, nomorlot, kadaluwarsa)
                        values ('$notrans','$r[0]','$r[1]','$r[2]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]')");
            $master=mysql_query("update hstok set stoktotal=stoktotal+'$r[2]', harga='$r[1]' where kode='$r[0]'");
            
            //proses ke reagen apabila termasuk reagen IMLTD
            $sql        = mysql_query("select reagenujs,nama_reagen,metode,ketsatuan from hstok where kode='$r[0]'");
            $sql1       = mysql_fetch_array($sql);
            $statusimltd= 0;
            $statusimltd= $sql1['reagenujs']; 
            
            if($statusimltd==1){
                $nama_reagen= $sql1['nama_reagen'];
                $metode     = $sql1['metode'];
                $noLot      = $r[5];
                $kadaluwarsa= $r[6];
                $jmltest    = $sql1['ketsatuan'];
                $jmlkit     = $r[2];
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
	}elseif($beli==1){
	$simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, subtotal, potongan, ppn, biayalain,total, bayar, petugas,hutangpiutang,jatuhtempo,uraian, noreferensi,po,pelunasan)
                        values ('$notrans','$kodesup','$tanggal','$prefix','$subtotal[total]','$potongan','$ppn',$biayalain,'$total', '$total', '$namauser', '$hutang', '$tgljtempo','$uraian','$nonota','$po',curdate())");
    $update_po=mysql_query("update hstok_order set noreferensi='$notrans', status_order='2' where notrans='$po'");
    if($simpan){
        $query=mysql_query("select kode, harga, qtytransaksi,diskonpersen,subtotal, nomorlot, kadaluwarsa from hstok_transaksi_detail_tmp where namauser='$namauser'");
        while($r=mysql_fetch_row($query)){
            $detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, harga, qtytransaksi, qtymasuk, diskonpersen, subtotal, nomorlot, kadaluwarsa)
                        values ('$notrans','$r[0]','$r[1]','$r[2]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]')");
            $master=mysql_query("update hstok set stoktotal=stoktotal+'$r[2]', harga='$r[1]' where kode='$r[0]'");
            
            //proses ke reagen apabila termasuk reagen IMLTD
            $sql        = mysql_query("select reagenujs,nama_reagen,metode,ketsatuan from hstok where kode='$r[0]'");
            $sql1       = mysql_fetch_array($sql);
            $statusimltd= 0;
            $statusimltd= $sql1['reagenujs']; 
            
            if($statusimltd==1){
                $nama_reagen= $sql1['nama_reagen'];
                $metode     = $sql1['metode'];
                $noLot      = $r[5];
                $kadaluwarsa= $r[6];
                $jmltest    = $sql1['ketsatuan'];
                $jmlkit     = $r[2];
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
}
?>
