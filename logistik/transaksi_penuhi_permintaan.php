<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?php
  include('clogin.php');
  include('config/db_connect.php');
  session_start();
  $namauser=$_SESSION[namauser];
  $levelusr=$_SESSION[leveluser];  
if ($_POST[submit]) {
  //membuat lagi nomor transaksi, untuk memastikan tidak double karena ada user lain yang entry bersamaan
  //Membuat nomor transaksi 5 digit ==============================================                               
    $prefix   = "IO"; //INVOICE ORDER
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
    $kodetrans  = $kdprefix.$jnol.$no;
  //Akhir pembuatan nomor transaksi otomatis======================================
  
  $tanggal	= date('Y-m-d');
  $box	   	= $_POST['notrans_order'];
  $jmlberi 	= $_POST['jumlahberi'];
  $kode    	= $_POST['kode'];
  $namabagian	= $_POST['bagian'];
  $notrans_minta= $_POST['notrans_order'][0];
  $exp   = $_POST['exp'];
  $nolot   = $_POST['nolot'];
  
   //insert ke table header htstok_transaksi
  $uraian     = "Penuhi Permintaan-".$kodetrans."-".$namabagian;  
  $simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, petugas,uraian, noreferensi)
                        values ('$kodetrans','$namabagian','$tanggal','$prefix','$namauser','$uraian','$notrans_minta')");
  //=======Audit Trial====================================================================================
  $log_mdl =$levelusr;
  $log_aksi="Penuhi Permintaan barang no permintaan : ".$kodetrans.", dari bagian : ".$namabagian;
  include_once "user_log.php";
  //=====================================================================================================
  $terpenuhi=0;
  for ($i=0;$i<count($box);$i++) {
    //echo "$box[$i] - $kode[$i] - (int)$jmlberi[$i] - $namabagian - $notrans_minta<br>";
    $notran_io     = $kodetrans;
    $notrans_minta = $box[$i];
    $exp1 = $exp[$i];
    $nolot1 = $nolot[$i];
    //insert ke table detail
    $int_jml=(int)($jmlberi[$i]);
    if ($int_jml>0){
	$detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, qtytransaksi, qtykeluar, nomorlot, kadaluwarsa)
                             values ('$kodetrans','$kode[$i]','$jmlberi[$i]','$jmlberi[$i]', '$nolot1[$i]','$exp1[$i]')");
	//update stok
	$master=mysql_query("update hstok set stoktotal=stoktotal-'$jmlberi[$i]' where kode='$kode[$i]'");
    
	//update hstok_order_detail
	$master=mysql_query("update hstok_order_detail set qtyterpenuhi=qtyterpenuhi+'$jmlberi[$i]' where kode='$kode[$i]' and notrans='$notrans_minta'");
	
	//Cek terpenuhi
	$cek   = mysql_fetch_assoc(mysql_query("select qtyorder, qtyterpenuhi from hstok_order_detail
					      where kode='$kode[$i]' and notrans='$notrans_minta' limit 1"));
	if ($cek[qtyorder] <= $cek[qtyterpenuhi]){
	    $terpenuhi=2;
	}else{
	    $terpenuhi=1;
	}
    }
  }
  //updeta status terpenuhi
  $master=mysql_query("update hstok_order set status_order='$terpenuhi' where notrans='$notrans_minta'");
  //pangggil form rincian transaksi pemenuhan barang
  
  echo '<META http-equiv="refresh" content="0; url=/logistik/rincian_transaksi_penuhi_permintaan.php?notrans='.$kodetrans.'">';
  
}

  $h=mysql_fetch_assoc(mysql_query("select hstok_order.notrans, hstok_order.tanggal, hstok_order.uraian, hstok_order.catatanlain,
					    hstok_order.catatanlain, hstok_order.subtotal, hstok_order.potongan,
					    hstok_order.ppn, hstok_order.biayalain, hstok_order.total,
					    hstok_order.petugas, hstok_order.supplier,
					    supplier.Kode, supplier.Nama, supplier.Alamat, supplier.Telp1, supplier.namaCp
				    from hstok_order left join supplier on supplier.Kode=hstok_order.supplier
				    where hstok_order.notrans='$_GET[notrans]'"));
  //Membuat nomor transaksi 5 digit ==============================================
    $prefix   = "IO"; //INVOICE ORDER
    $kdthn    = substr(date("Y"),2,2);
    $kdprefix = $prefix.$kdthn;
    $jumdigit1 = 6;
    $kddata   = mysql_fetch_assoc(mysql_query("select notrans from hstok_transaksi where substring(notrans,1,4)='$kdprefix' order by notrans desc limit 1"));
    $nodata   = substr($kddata[notrans],4,$jumdigit1);
    $no       = $nodata+1;
    $j_nol   = $jumdigit1-(strlen(strval($no)));
    for ($i=0; $i<$j_nol; $i++){
	$jnol.="0";
    }
    $kodetrans  = $kdprefix.$jnol.$no;
  //Akhir pembuatan nomor transaksi otomatis======================================
?>
<h1><strong>TRANSAKSI PENGELUARAN PERMINTAAN BARANG</h1></strong>
<form name="transaksi"  method="post" action="<?=$PHPSELF?>">
  <table class="form" border="0" cellspacing="1" cellpadding="5" width=750 style="border-collapse:collapse">
    <tr>
	<td width=120>Bagian</td><td class="input" >: <?=$h[supplier]?>
	<input type=hidden name="bagian" value=<?=$h[supplier]?>></td>
	<td width=130>Nomor Permintaan</td><td width=150 class="input">: <?=$h[notrans]?></td>
    </tr>
    <tr>
	<td></td><td class="input">: <?=$h[Nama]?></td>
	<td>Tanggal Permintaan</td><td class="input">: <?=$h[tanggal]?></td>
    </tr>
    <tr>
	<td>Penanggung Jawab</td><td class="input">: <?=$h[namaCp]?></td>
	<td>No.Pengeluaran</td><td class="input">: <?=$kodetrans?></td>
    </tr>
    <table class="list" border="0" cellspacing="5" cellpadding="5" width=750 style="border-collapse:collapse">
      <tr class="record">
	<td align="left" colspan=6>DETAIL PERMINTAAN BARANG</td>
      </tr>
    </table>
    <table class="list" border="1" cellspacing="0" cellpadding="0" width=750 style="border-collapse:collapse">
      <tr class="field">
	<td align="center">No</td>
	<td align="center">Kode</td>
	<td align="center" colspan=2>Nama Barang</td>
	<td align="center">Jml<br>diminta</td>
	<td align="center">Sudah<br>diberi</td>
	<td align="center">Stok<br>Barang</td>
	<td align="center">Jml.diberi<br>sekarang</td>
    <td align="center">No. Lot</td>
    <td align="center">Expired</td>
	<td align="center">Satuan</td>
      </tr>
      <?
      $no=0;
      $subtotal2=0;
      $detail=mysql_query("select hstok_order_detail.kode, hstok_order_detail.qtyorder, hstok_order_detail.qtyterpenuhi,
				hstok_order_detail.harga, hstok_order_detail.diskonpersen, hstok_order_detail.diskontotal, hstok_order_detail.subtotal,
				hstok_order_detail.catatan, hstok_order_detail.catatandetail,
				hstok_order_detail.catatandetail, hstok.namabrg,hstok.satuan
			from hstok_order_detail left join hstok on hstok.kode=hstok_order_detail.kode
			where hstok_order_detail.notrans='$_GET[notrans]' order by hstok_order_detail.id asc");
    while ($dtrans = mysql_fetch_assoc($detail)){
	  $no++;
	  $qtorder = number_format($dtrans['qtyorder'],0,',','.');
	  $qtyterpenuhi = number_format($dtrans['qtyterpenuhi'],0,',','.');
	  $stokbarang=mysql_fetch_assoc(mysql_query("select stoktotal from hstok where kode='$dtrans[kode]'"));
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['kode']."</td>
		<td align=left colspan=2>".$dtrans['namabrg']."</td>
		<td align=center>".$qtorder."</td>
		<td align=center>".$qtyterpenuhi."</td>
		<td align=center>".$stokbarang['stoktotal']."</td>
		<td class='input'><input name='jumlahberi[]' type='text' size='5'>
		    <input type=hidden name='notrans_order[]' value='$h[notrans]'>
		    <input type=hidden name='kode[]' value='$dtrans[kode]'></td>
        <td class='input'><input name='nolot[]' type='text' size='10'></td>
        <td class='input'><input name='exp[]' type='text' size='10' placeholder='yyyy-mm-dd'></td>
		<td align=left>".$dtrans['satuan']."</td>
		</tr>";
  }
  ?>
</table>
</table>
  <br>
<input name="submit" type="submit" value="Proses Pengeluaran Barang">
</form>


  

