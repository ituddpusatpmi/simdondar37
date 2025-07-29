<style type="text/css">
<!--
@import url("topstyle.css");
-->
</style>
<body onload="document.musnah.NoKantong.focus()">
<?
$today=date("Y-m-d");

include ('clogin.php');
include ('config/db_connect.php');

if (isset($_POST['Button'])) {
	//Membuat nomor transaksi 5 digit ==============================================                               
        $prefix   = "AL"; //Ajdust Laborat
        $kdthn    = substr(date("Y"),2,2);
        $kdprefix = $prefix.$kdthn;
        $jumdigit = 6;
        $kddata   = mysql_fetch_assoc(mysql_query("select notrans from hstok_transaksi where substring(notrans,1,4)='$kdprefix' order by notrans desc limit 1"));
        $nodata   = substr($kddata[notrans],4,$jumdigit);
        $no       = $nodata+1;
        $j_nol   = $jumdigit-(strlen(strval($no)));
        for ($count=0; $count<$j_nol; $count++){
		$jnol.="0";
        }
        $notrans  = $kdprefix.$jnol.$no;
        //Akhir pembuatan nomor transaksi otomatis======================================
	for ($i=0;$i<count($_POST[aktif]);$i++) {
		$n_reag=$_POST[aktif][$i];
		$pindahkan=mysql_query("update reagen set aktif='0' where (kode='$n_reag')");
		
		//KURANGI STOK DI MASTER STOK (HSTOK) dan tambahkan record ke kartu stok
		$sqlreagen	= mysql_query("select kodestok,kode,noLot,tglKad from reagen where (kode='$n_reag')");
		$dsql		= mysql_fetch_array($sqlreagen);
		$tgl  		= date('Y-m-d');
		//update stok
		//$updatestok	= mysql_query("update hstok set stoktotal=stoktotal-1 where kode='$dsql[kodestok]'");
		
		//insert record ke kartu stok=======================================================================
		$kodelab	='IMLTD';//disesuaikan dengan kode kontak Lab IMLTD
		$tgl    	= date('Y-m-d');
		$uraian     	= "Pindah ke Lab-".$notrans."-UDD";
		$simpan=mysql_query("insert into hstok_transaksi(notrans, supplier, tanggal, jenis, petugas,hutangpiutang, uraian, noreferensi)
                                     values ('$notrans','$kodelab','$tgl','$prefix','$namauser', 0, '$uraian','Pindah ke Lab IMLTD')");
		$detail=mysql_query("insert into hstok_transaksi_detail (notrans, kode, qtytransaksi, qtykeluar, nomorlot, kadaluwarsa)
				     values ('$notrans','$dsql[kodestok]',1,1,'$dsql[noLot]','$dsql[tglKad]')");
		
		//====================================================================================================
	}

	if ($pindahkan) {
		echo "<BR>Reagen sudah dipindahkan<BR>";
		echo "<META http-equiv='refresh' content='0; url='<?echo $PHPSELF;?>";
	}
} else {
	$hasil=mysql_query("select * from reagen where aktif is null and (tglKad >'$today') order by Nama,tglKad");
	$TRec=mysql_num_rows($hasil);
	?>
	<form name="aktif" align="left" method="post" action="<?echo $PHPSELF?>">
		<input type="submit" name="Button" value="Pindahkan ke Lab. IMLTD">
		<table class="list" id="box-table-b" cellpadding="4" cellspacing="2" border="0">
			<tr class="field">
				<th><b> No</b></th>
				<th><b> Kode Reagen</b></th>
				<th><b> No Lot</b></th>
				<th><b> Nama Reagensia</b></th>
				<th><b> Kadaluarsa</b></th>
				<th><b> Jml Test</b></th>
				<th><b> Jenis</b></th>
				<th><b> Kode Stok</b></th>
			</tr>
			<input type="hidden" name="jumlah" value="<?=mysql_num_rows($hasil)?>"> <?
			$no=1;
			while($baris=mysql_fetch_assoc($hasil)){ ?>
				<tr class="record">
					<td><div align="center"><font size="2"><?=$no?>.
						<input type=checkbox name=aktif[] value="<?=$baris[kode]?>"></div></td>
					<td align="center"><?=$baris[kode]?></td>
					<td align="left"><?=$baris[noLot]?></td>
					<td align="left"><?=$baris[Nama]?></td>
					<td align="left"><?=$baris[tglKad]?></td>
					<td align="right"><?=$baris[jumTest]?></td>
					<td align="left"><?=$baris[metode]?></td>
					<td align="left" "><?=$baris[kodestok]?></td>
				</tr>
				<?
				$no++;
			} ?>
		</table>
	</form><?
} ?>
</body>
