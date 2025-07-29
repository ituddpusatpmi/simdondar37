<link type="text/css" href="topstyle.css" rel="stylesheet" />
<link type="text/css" href="css/style.css" rel="stylesheet" />
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/musnah.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
	
<script>
function cek(){
	if (document.musnah.alasan.value=='') alert('Pilih alasan pembuangan terlebih dahulu')
}
</script>
<?

require_once("modul/background_process.php");
require_once ('clogin.php');
require_once ('config/db_connect.php');

$petugas = $_SESSION[nama_lengkap];
$today=date("Y-m-d G:i:s");
$today1=date("Y-m-d H:i:s");

$null = mysql_query("update stokkantong set `Status`=3 where (`Status`=1 or `Status`=2) AND (date(kadaluwarsa) < (now() - INTERVAL 30 DAY))");

if (isset($_POST[submit])) {
	$al1='';
	$nk1='';
	for ($i=0;$i<sizeof($_POST[nokantongmusnah]);$i++) {
		$nkt=$_POST[nokantongmusnah][$i];
		$alasan=$_POST[alasanmusnah][$i];
		$keluarkan=mysql_query("update stokkantong set Status='6' where (noKantong='$nkt')");
		if ($keluarkan) {
			$nk1=$nk1.';'.$nkt;
			$al1=$al1.';'.$alasan;
			$keluarkan=mysql_query("insert into ar_stokkantong (
								noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,
								produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,
								kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,
								kadaluwarsa,tglpengolahan,mu,stokcheck)
						   select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,
								produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,
								kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,
								kadaluwarsa,tglpengolahan,mu,stokcheck
						   from stokkantong where noKantong='$nkt'");
			$update=mysql_query("update ar_stokkantong set alasan_buang='$alasan'where (noKantong='$nkt')");
			$update1=mysql_query("update ar_stokkantong set tgl_buang='$today1'where (noKantong='$nkt')");
			$update2=mysql_query("update ar_stokkantong set user='$petugas' where (noKantong='$nkt')");
			//$histori=mysql_query("insert into histori (`username`,`waktu`,`action`,`nokantong`,`statkan`) values ('$petugas','$today1','Menu Pemusnahan Ktg','$nkt','6')");
			echo "Memusnahkan $nkt";
		}else{
			echo "<BR>Kantong $nkt tidak ditemukan<BR>";
		}
	}
	if ($nk1!=''){
		//backgroundPost('http://localhost/simudda/modul/background_up.php');
		echo "<a href=modul/rekap_darah_musnah.php?nk1=$nk1&al1=$al1>Laporan Pemusnahan Darah</a><br>";
	}
}
if (isset($_POST[submit2])) {
	print_r($_POST);
	$kdl 	= mktime(0,0,0,date("m"),date("d")-35,date("Y"));
	$kdl1	= date('Y-m-d H:i:s',$kdl);
	$kdl0 	= mktime(0,0,0,date("m"),date("d")-90,date("Y"));
	$kdl10 	= date('Y-m-d',$kdl);

	$hasil=mysql_query("select noKantong as nk from stokkantong
			where
			(date(kadaluwarsa)<=current_date or 
			(produk='TC' and date(kadaluwarsa)<=current_date-6) or
			(produk='FP' and date(kadaluwarsa)<=current_date-6) or
			(produk='WB' and date(kadaluwarsa)<=current_date-21) or
			(produk='PRC' and date(kadaluwarsa)<=current_date-21) or
			(produk='FFP' and date(kadaluwarsa)<=current_date-365) or
			(produk='AHF' and date(kadaluwarsa)<=current_date-1) or
			(produk='WE' and date(kadaluwarsa)<=current_date-1)
			)
			AND
			(Status between 1 AND 2)");
	$TRec=mysql_num_rows($hasil);
	$al1='';
	$nk1='';
	$no=1;
	while($baris=mysql_fetch_assoc($hasil)){
		$nkt=$baris[nk];
		$alasan='2';
		$keluarkan=mysql_query("update stokkantong set Status='6' where (noKantong='$nkt')");
		if ($keluarkan){
			$nk1=$nk1.';'.$nkt;
			$al1=$al1.';'.$alasan;	
			$keluarkan=mysql_query("insert into ar_stokkantong (
								noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,
								produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,
								kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,
								kadaluwarsa,tglpengolahan,mu,stokcheck)
						   select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,
								produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,
								kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,
								kadaluwarsa,tglpengolahan,mu,stokcheck
						   from stokkantong where noKantong='$nkt'");
			$update=mysql_query("update ar_stokkantong set alasan_buang='$alasan'where (noKantong='$nkt')");
			$update1=mysql_query("update ar_stokkantong set tgl_buang='$today1'where (noKantong='$nkt')");
			$update2=mysql_query("update ar_stokkantong set user='$petugas' where (noKantong='$nkt')");
			//$histori=mysql_query("insert into histori (`username`,`waktu`,`action`,`nokantong`,`statkan`) values ('$petugas','$today1','Menu Pemusnahan Ktg','$nkt','6')");
		}else{
			echo "<BR>Kantong $nkt tidak ditemukan<BR>";
		}
		$no++;
	}
	if ($nk1!=''){
		//backgroundPost('http://localhost/simudda/modul/background_up.php');
		echo "<a href=modul/rekap_darah_musnah.php?nk1=$nk1&al1=$al1>Laporan Pemusnahan Darah</a><br>";
	}
}


$kdl 	= mktime(0,0,0,date("m"),date("d")-35,date("Y"));
$kdl1	= date('Y-m-d H:i:s',$kdl);
$kdl0 	= mktime(0,0,0,date("m"),date("d")-90,date("Y"));
$kdl10 	= date('Y-m-d',$kdl);


$hasil=mysql_query("select noKantong as nk, produk, tgl_Aftap, kadaluwarsa from stokkantong
			where
			(date(kadaluwarsa)<=current_date or 
			(produk='TC' and date(kadaluwarsa)<=current_date-6) or
			(produk='FP' and date(kadaluwarsa)<=current_date-6) or
			(produk='WB' and date(kadaluwarsa)<=current_date-21) or
			(produk='PRC' and date(kadaluwarsa)<=current_date-21) or
			(produk='FFP' and date(kadaluwarsa)<=current_date-365) or
			(produk='AHF' and date(kadaluwarsa)<=current_date-1) or
			(produk='WE' and date(kadaluwarsa)<=current_date-1)
			)
			AND
			(Status between 1 AND 2)");
$TRec=mysql_num_rows($hasil);
?>
	<form name="musnah" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table class="form" border="0">
		<tr>
			<td>Alasan</td>
			<td>
				<select name="alasan" onchange="document.musnah.NoKantong.focus()">
					
					
					<option value="0">Gagal Aftap</option>
                    <option value="10">Bekas Pembuatan TPK</option>
					<!--option value="4">Reaktif Buang</option>
					<option value="11">Reaktif Dirujuk Ke UTDP</option-->
					<option value="6">Greyzone</option>
					<option value="1">Lisis</option>
					<option value="2">Kadaluarsa</option>
					<option value="5">Lifemik</option>
					<option value="8">Kantong Bocor</option>
					<option value="10">Bekas Pembuatan WE</option>
					<option value="13">Plasma Sisa PRC</option>
					<option value="9">Satelit Rusak</option>
					<option value="7">DCT Positif</option>
					<option value="12">Hematokrit Tinggi</option>	
					<option value="3">Plebotomi Terapi</option>		
					<option value="14">Leukosit Tinggi</option>
					<option value="15">Produk Rusak</option>
					<option value="16">Produk Sample QC</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>No Kantong</td>
			<td><input type="text" name="NoKantong" onkeydown="cek(),chang(event,this);" onchange="cari_kantong('box-table-b');" > </td>
		</tr>
	</table>
	<table id="box-table-b" class="form" border="0">
	<tr><th>No</th><th>No Kantong</th><th>Golongan Darah</th><th>Alasan</th></tr>
	</table>
	<input type="submit" name="submit" value="Musnahkan !!">
</form>	
		
<table>
	<tr>
		<td valign="top">	
			<table class="list" id="box-table-b">
				<tr>
					<td></td>
					<td colspan=2>Darah Kadaluwarsa</td>
				</tr>
				<tr>
					<td></td>
					<form name="musnahsemua" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
					<td><input type="submit" name="submit2" value="Musnahkan kadaluwarsa"></td>
					</form>
				</tr>
				<tr class="field">
					<th><b>No</b></th>
					<th><b> <?=mysql_num_rows($hasil)?>-Kantong</b></th>
                    <th><b> Produk</b></th>
                    <th><b> Tgl. Aftap</b></th>
		    <th><b> Tgl. Kadaluwarsa</b></th>
				</tr>
				<?
				$no=1;
				while($baris=mysql_fetch_assoc($hasil)){ ?>
				<tr class="record">
					<td>
						<div align="center"><font size="2"><?=$no?></div>
					</td>
					<td>
						<?=$baris[nk]?>
					</td>
                   <td>
                       <?=$baris[produk]?>
                   </td>
                   <td>
                       <?=$baris[tgl_Aftap]?>
                   </td>
		  <td>
                       <?=$baris[kadaluwarsa]?>
                   </td>
				</tr>
				<?
				$no++;
			} ?>
</table>
			

</td><td valign="top">

<table class="list" id="box-table-b">
	<tr>
		<td colspan=2>Reaktif-RAPID</td>
	</tr>
    <tr class="field">
        <th><b>No</b></th>
	<?php
	$hasil_rapid=mysql_query("select distinct tr.nokantong as nk from drapidtest as tr,stokkantong as st
						 where tr.Hasil='0' and tr.tgl_tes!='0000-00-00' and tr.tgl_tes>'$kdl10'
							and st.Status='4' and st.noKantong=tr.nokantong");
	$no=1;
	$nrapid=mysql_num_rows($hasil_rapid);
	?>
        <th><b><?=$nrapid?> - Kantong</b></th>
    </tr>
	<?
	while($baris_rapid=mysql_fetch_assoc($hasil_rapid)){
	?>
	<tr class="record">
		<td>
			<div align="center"><font size="2"><?=$no?>.</div>
		</td>
		<td>
			<?=$baris_rapid[nk]?>
		</td>
	</tr>
        <?$no++;
	} ?>
</table>

</td><td valign="top">

<table class="list" id="box-table-b">
	<tr>
		<td colspan=2>Reaktif-ELISA</td>
	</tr>
	<tr class="field">
        <th><b>No</b></th>
	<?php
	$hasil_elisa=mysql_query("select distinct h.noKantong as nk from hasilelisa as h,stokkantong as st
				where h.Hasil='1' and h.tglPeriksa>'$kdl10' and h.tglPeriksa>'2011-05-04'
				and st.Status='4' and st.noKantong=h.noKantong");
	$no=1;
	$nelisa=mysql_num_rows($hasil_elisa);
	?>
        <th><b><?=$nelisa?> - Kantong</b></th></tr>
	<?    
	while($baris_elisa=mysql_fetch_assoc($hasil_elisa)){
	?>
	 <tr class="record">
        <td>
            <div align="center"><font size="2"><?=$no?></div>
        </td>
        <td>
		<?=$baris_elisa[nk]?>
        </td>
    </tr>
	<? $no++;
		} ?>
</table>
</td></tr></table>
</body>
