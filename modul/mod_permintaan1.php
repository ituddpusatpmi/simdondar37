<SCRIPT LANGUAGE="JavaScript" SRC="js/rs.js"></SCRIPT>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir_minta.js"></script>
<script type="text/javascript" src="js/tgl_butuh.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    $('#dokter').autocomplete({source:'modul/suggest_dokter.php', minLength:2}),
    $('#norm').autocomplete({source:'modul/suggest_rm.php', minLength:2}),
    $('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2});});
</script>
<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 1px;font-size: 13px;cursor: pointer; }</style>
<?php
include ("config/db_connect.php");
if (isset($_GET[Kode])) {
	$sql="select no_rm from pasien where no_rm='$_GET[Kode]'";
	$sqlpasien=mysql_fetch_assoc(mysql_query($sql));
	if ($sqlpasien[no_rm]==$param_norm){$pasienbaru="0";} else {$pasienbaru="1";}
} else {
	$pasienbaru="0";
}

$namauser=$_SESSION[namauser];
$waktupermintaan=date("Y-m-d H:i:s");
$tgl_permintaan=date("Y-m-d");
$tahun=date("Y");
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$tgl_yesterday=date("Y-m-d",$yesterday);
$td0=php_uname('n');
$td0=substr($td0,0,3);
$a="SELECT noform FROM htranspermintaan WHERE right(noform,4)='$tahun' ORDER BY noform DESC LIMIT 1";
$b=mysql_query($a);
$c=mysql_fetch_assoc($b);
$d=mysql_num_rows($b);
$pjg_form  = strlen($c[noform]);
if ($d<1){$nomorform="0000000";}
$nomorform = (int)(substr($c[noform],1,7)+1);
$j_nol   = 7-(strlen(strval($nomorform)));
for ($i=0; $i<$j_nol; $i++){$jnol.="0";}
$noformfix=$jnol.$nomorform."/".$tahun;

if (isset($_POST[submit1])) {
	$_POST[submit1]="";
	$nama_dokter=mysql_real_escape_string($_POST[nama_dokter]);
	$nama_pasien=mysql_real_escape_string($_POST[nama_pasien]);
	$nama_bagian=mysql_real_escape_string($_POST[nama_bagian]);
	$nama_kelas=mysql_real_escape_string($_POST[nama_kelas]);
	$suami_istri=mysql_real_escape_string($_POST[suami_istri]);
	$alamat=mysql_real_escape_string($_POST[alamat]);
	$diagnosa=mysql_real_escape_string($_POST[diagnosa]);
	$alasan=mysql_real_escape_string($_POST[alasan]);
	$jenis=mysql_real_escape_string($_POST[jenis]);
	$tempat=mysql_real_escape_string($_POST[tempat]);
	$reg_rs=mysql_real_escape_string($_POST[reg_rs]);
	$golDrh=mysql_real_escape_string($_POST[golDrh]);
	$rhesus_psn=mysql_real_escape_string($_POST[rhesus_psn]);
	$shift=mysql_real_escape_string($_POST[shift]);
	$no_layanan=mysql_real_escape_string($_POST[noreglayanan]);
	$hb=mysql_real_escape_string($_POST[hb]);
	$cek_dokter=1;
	$sql_dkt="select * from dokter where Nama like '%$_POST[nama_dokter]%'";
	$cek_dokter=mysql_num_rows(mysql_query($sql_dkt));
	if ($cek_dokter==0) {
		$sql_dokter=mysql_fetch_assoc(mysql_query("select max(convert(`kode`, SIGNED INTEGER)) as Kode from dokter"));
		$int_kode=$sql_dokter['Kode']+1;
		$j_nol0= 5-(strlen(strval($int_kode)));
		for ($i=0; $i<$j_nol0; $i++){$nol .="0";}
		$kdokter=$nol.$int_kode;
		$idokter_sql="insert into dokter (kode,Nama) values ('$kdokter','$_POST[nama_dokter]')";
		$idokter=mysql_query($idokter_sql);
	}
	$cd=mysql_num_rows(mysql_query("select noform from htranspermintaan where noform='$_POST[no_formulir]'"));
	if ($cd=='0') {
		$permintaan="INSERT INTO `htranspermintaan` (`noform`, `bagian`, `kelas`, `namadokter`, `tglminta`, `diagnosa`, `alasan`, `hb`, `jenis`, `stat`, `rs`, `regrs`,
			    `shift`, `tempat`, `nojenis`, `no_rm`, `umur`, `petugas`, `tgl_register`, `ruangan`, `pernah_transfusi`,
				`kapan`, `jenis_permintaan`, `reaksi_transfusi`, `gejala`, `jml_kehamilan`, `abortus`, `ket`)
				VALUES ('$_POST[no_formulir]','$nama_bagian',
				'$_POST[nama_kelas]','$nama_dokter','$tgl_permintaan','$diagnosa','$alasan',
				'$hb','$jenis','0','$_POST[nama_rs]','$reg_rs','$shift','$tempat','$no_layanan','$_POST[norm]','$_POST[umur]',
				'$_POST[sahper]','$waktupermintaan','$_POST[nama_ruangan]','$_POST[pernahtransfusi]','$_POST[kapan]','$_POST[jnspermintaan]',
				'$_POST[reaksitransfusi]','$_POST[gejala]','$_POST[jmlkehamilan]','$_POST[abortus]','$_POST[ket]')";
		$p3=mysql_query($permintaan);
		for ($i=0;$i<count($_POST['jenisproduk']);$i++) {
			$jenisproduk=$_POST['jenisproduk'][$i];
			$jumlahminta=$_POST['jmlminta'][$i];
			$volumeminta=$_POST['volumedarah'][$i];
			$intjumlahminta=intval($jumlahminta);
			if ($intjumlahminta>0){
				$sqlpermintaandetail="insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat` ) values
									('$_POST[no_formulir]','$jenisproduk','$_POST[goldarah]','$_POST[rhesus]','$jumlahminta','0','$volumeminta','$_POST[keterangandrh]','$_POST[tgl_diperlukan]','$tempat')";
				$p1=mysql_query($sqlpermintaandetail);
			}
		}
		if ($_POST[simpanpasien]!=="0"){
			$permintaan2="INSERT INTO `pasien` (`no_rm`, `nama`, `alamat`, `gol_darah`, `rhesus`, `kelamin`, `keluarga`, `tgl_lahir`,`tlppasien`) VALUES
				 ('$_POST[norm]', '$nama_pasien', '$alamat', '$golDrh', '$rhesus_psn', '$_POST[jk]', '$suami_istri', '$_POST[tgllhr]','$_POST[tlppasien]')";
			$p3=mysql_query($permintaan2);
		}
		if ($p1) $noform1=str_replace("/","-",$_POST[no_formulir]);
			echo ("<font size=3>Formulir No. <b>'$_POST[no_formulir]'</b> telah ditambah !!<br></font>
			<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir2.php?module=cetak_minta&noform=$noform1\">");
	} else {
			echo "<font size=3>No Formulir Telah digunakan sebelumnya</font><br>";
	}
}?>
<form name="permintaandarah" autocomplete="off" method="post" action="<?php echo $PHP_SELF;?>">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#FF6346;" >
		<tr>
			<td align="center"><font size="4" color="white" face="Trebuchet MS"><b>FORMULIR PERMINTAAN DARAH</b></font></td>
			<td align="right"><input type="submit" name="submit1" value="Simpan" class="swn_button_blue"></td>
		</tr>
	</table>
	<table border="0" style="border-collapse:collapse" cellpadding="1" cellspacing="0" width="100%">
		<tr><td valign="top"><font size="3" color="red" face="Trebuchet MS">A. DATA RUMAH SAKIT</font>
		<table class="form" cellspacing="1" cellpadding="0" border="1" style="border-collapse:collapse">
			<tr><td>No. Formulir</td>
				<td class="input" nowrap><input name="no_formulir" type="text" size="20" required value="<?=$noformfix?>" onkeydown="drs(this.value);" placeholder='No-Urut/tahun'>
				No.Reg.RS<input name="reg_rs" type="text" placeholder='No.Reg.RS'></td>
			</tr>
			<tr><td>Nama RS</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="nama_rs" required ></select></td>
			</tr>
			<tr><td>Medis(Bagian)</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="nama_bagian">
					<?php
					$permintaan1="select * from bagian";
					$do1=mysql_query($permintaan1);
					while($data1=mysql_fetch_assoc($do1)){
						$select1="";?>
						<option value="<?=$data1[nama]?>"<?=$select1?>><?=$data1[nama]?></option><?
					}?></select></td>
			</tr>
			<tr><td>Kelas</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="nama_kelas" nowrap>
					<?php
						$permintaan1="select * from kelas";
						$do1=mysql_query($permintaan1);
						while($data1=mysql_fetch_assoc($do1)){
							$select1="";?>
					<option value="<?=$data1[Nama]?>"<?=$select1?>><?=$data1[Nama]?></option>
						<?}?>
				</select>
				Ruangan<input type=text name="nama_ruangan" id="ruangan" required placeholder='Bakung'></td>
			</tr>
			<tr><td>Nama Dokter</td>
				<td class="input" nowrap><input type=text name="nama_dokter" required id="dokter" placeholder='Nama Dokter'></td>
			</tr>
			<tr><td>Diagnosa Klinis</td>
				<td class="input"><input name="diagnosa" type="text" required size="30" placeholder='DHF'></td>
			</tr>
			<tr><td>Cara Bayar</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="jenis" nowrap>
						<?php
						$permintaan2="select * from jenis_layanan";
						$do2=mysql_query($permintaan2);
						while($data2=mysql_fetch_assoc($do2)){
							$select2="";?>
							<option value="<?=$data2[nama]?>"<?=$select2?>><?=$data2[nama]?></option><?
						}?></select>
				No. Reg. Pelayanan<input name="noreglayanan" type="text" size="10" placeholder='No. Reg Pelayanan'></td>
			</tr>
			<tr><td>Alasan Transfusi</td>
				<td class="input"><input name="alasan" type="text" size="30" placeholder='Anemis'></td>
			</tr>
			<tr><td>Jumlah HB</td>
				<td class="input"><input name="hb" type="text" size="5">gr/dl</td>
			</tr>
			<tr><td>Pernah Transfusi</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="pernahtransfusi">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
					Kapan<input name="kapan" type="text" size="5" placeholder='Jika Ya(th)'></td>
			</tr>
			<tr><td>Reaksi Transfusi</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="reaksitransfusi">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
					Gejala<input name="gejala" type="text" size="10" placeholder='Jika Ya'></td>
			</tr>
			<tr><td>Jenis Permintaan</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="jnspermintaan">
						<option value="0">Biasa</option>
						<option value="1">Cadangan</option>
						<option value="2">Siap Pakai</option>
						<option value="3">Cyto/Segera</option>
					</select>
					Keterangan<input name="ket" type="text" size="20" placeholder='Keterangan'></td>
			</tr>
			<tr><td class="input"></td>
				<td class="input">Khusus Pasien Wanita</td>
			</tr>
			<tr><td>Pernah Abortus</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="abortus">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
				Jumlah Kehamilan<input name="jmlkehamilan" type="text" size="10" placeholder='Jml Hamil'></td>
			</tr>
		</table>
	</td>
	<td  valign="top">
		<font size="3" color="red" face="Trebuchet MS">B. DATA PASIEN</font>
		<?if ($pasienbaru=="0"){?>
			<table class="form" cellspacing="1" cellpadding="4" border="1" style="border-collapse:collapse">
				<tr><td>No RM</td>
					<td class="input"><input name="norm" id="norm" type="text" size="20" required placeholder='No. Rekam Medis'></td>
				</tr>
				<tr><td>Nama Pasien</td>
					<td class="input"><input name="nama_pasien" required type="text" size="20" placeholder='Nama Pasien'></td>
				</tr>
				<tr><td>Golongan Darah</td>
					<td class="styled-select" bgcolor="#ffa688">
						<select name="golDrh">
							<option value="O">O</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="AB">AB</option>
							<option value="X">X</option>
						</select></td>
				</tr>
				<tr>
					<td>Rhesus</td>
					<td class="styled-select" bgcolor="#ffa688">
						<select name="rhesus_psn">
							<option value="+">Positif (+)</option>
							<option value="-">Negatif (-)</option>
						</select></td>
				</tr>
				<tr><td>Jenis Kelamin</td>
					<td class="input"><input type="radio" required name="jk" value="Laki-laki">Laki-laki <br>
					<input type="radio" name="jk" value="Perempuan">Perempuan</td>
				</tr>
				<tr><td>Nama Keluarga</td>
					<td class="input"><input name="suami_istri" type="text" size="20" placeholder='Nama Keluarga'></td>
				</tr>
				<tr><td>Tgl Lahir</td>
					<td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 required onchange="document.permintaandarah.umur.value=Age(document.permintaandarah.datepicker.value);"></td>
				</tr>
				<tr><td>Umur(Th)</td>
					<td class="input"><input name="umur" type="text" size="3"></td>
				</tr>
				<tr><td>Alamat Pasien</td>
					<td class="input"><input name="alamat" type="text" required size="20" placeholder='Alamat'></td>
				</tr>
				<tr>
					<td>No Telepon</td>
					<td class="input"><input name="tlppasien" type="text" size="13" placeholder='Telepon Keluarga'></td>
				</tr>
			</table>
		<?} else {
			$sqlpasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$_GET[Kode]'"));
			?>
			<table class="form" cellspacing="1" cellpadding="5" border="1" style="border-collapse:collapse">
			<tr><td>No RM</td><td class="input"><?=$sqlpasien[no_rm]?>
					<input name="norm" type=hidden value="<?=$sqlpasien[no_rm]?>">
					<input name="simpanpasien" type=hidden value="0"></tr>
			<tr><td>Nama Pasien</td><td class="input"><?=$sqlpasien[nama]?></td></tr>
			<tr><td>Golongan Darah</td><td class="input"><?=$sqlpasien[gol_darah]?>
					<input name="golDrh" type=hidden value="<?=$sqlpasien[gol_darah]?>"></td></tr>
			<tr><td>Rhesus</td><td class="input"><?=$sqlpasien[rhesus]?></td></tr>
			<tr><td>Jenis Kelamin</td><? if ($sqlpasien[jk]=="P"){$kelamin="Perempuan";}else{$kelamin="Laki-laki";}?>
				<td class="input"><?=$kelamin?></td></tr>
			<tr> <td>Nama Keluarga</td><td class="input"><?=$sqlpasien[keluarga]?></td></tr>
			<tr><td>Tgl Lahir</td><td class="input"><?=$sqlpasien[tgl_lahir]?></td></tr>
			<tr><td>Alamat Pasien</td>	<td class="input"><?=$sqlpasien[alamat]?></td></tr>
			<tr><td>No Telepon</td>	<td class="input"><?=$sqlpasien[tlppasien]?></td></tr>
		</table>
		<?}?>
	</td>
	<td  valign="top">
		<font size="3" color="red" face="Trebuchet MS">C.DATA PERMINTAAN DARAH</font>
		<table class="form" cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse">
			<tr><td>Golongan Darah</td>
				<td class="styled-select" bgcolor="#ffa688">
				<select name="goldarah">
					<option value="O">O</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="AB">AB</option>
					<option value="X">X</option>
				</select>
				Rhesus
				<select name="rhesus">
					<option value="+">Positif (+)</option>
					<option value="-">Negatif (-)</option>
				</select></td>
			</tr>
			<?
			$sqlproduk="select nama,lengkap, volume from produk order by nama";
			$qproduk=mysql_query($sqlproduk);
			while($produk1=mysql_fetch_assoc($qproduk)){?>
				<tr><td nowrap><?=$produk1[lengkap]?></td>
					<input name="jenisproduk[]" type=hidden value="<?=$produk1[nama]?>">
					<input name="volumedarah[]" type=hidden value="<?=$produk1[volume]?>">
					<td class="input"><input name="jmlminta[]" type="text" size="3">Kantong</td>
				</tr>
			<?}?>			
			<tr><td>Tgl Diperlukan</td>
				<td class="input"><input type="text" name="tgl_diperlukan" id="butuh" required size=8>
				Keterangan<input name="keterangandrh" type="text" size="10"></td>
			</tr>
			<tr><td>Tempat Permintaan</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="tempat">
						<option value="UDD">UDD</option>
						<option value="BDRS">BDRS</option>
					</select></td>
			</tr>
			<tr><td>Dicatat Oleh</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="sahper">
					<?$user1="select * from user WHERE id_user <> 'ADMIN' order by nama_lengkap ASC";
					$do1=mysql_query($user1);
					while($data1=mysql_fetch_assoc($do1)) {
						if ($data1[id_user]==$namauser) $select='selected';?>
							<option value="<?=$data1[id_user]?>"<?=$select?>><?=$data1[nama_lengkap]?></option><?
							$select="";
					}?>
					</select></td>
			</td></tr>
			<tr><td>Shift</td>
				<td class="styled-select" bgcolor="#ffa688">
					<select name="shift">
						<option value="Pagi">Pagi</option>
						<option value="Sore">Sore</option>
						<option value="Malam">Malam</option>
					</select></td>
			</tr>
		</table>
	</td>
	</tr>
	</table>
</form>
