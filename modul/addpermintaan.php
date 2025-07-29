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
   // $('#norm').autocomplete({source:'modul/suggest_rm.php', minLength:2}),
    $('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2}),
    $('#diagnosa').autocomplete({source:'modul/suggest_diagnosa.php', minLength:2}),
    $('#rmhsakit').autocomplete({source:'modul/suggest_rs.php', minLength:2});});
</script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 1px;font-size: 13px;cursor: pointer; }</style>
<?php
include ("config/db_connect.php");
//date_default_timezone_set("Asia/Jakarta");
$usia=mysql_query("UPDATE pasien set umur=(TO_DAYS(NOW())- TO_DAYS(tgl_lahir)) / 365.25");
if (isset($_GET[Kode])) {
	$sql="select no_rm from pasien where no_rm='$_GET[Kode]'";
	$sqlpasien=mysql_fetch_assoc(mysql_query($sql));
	if ($sqlpasien[no_rm]==$param_norm){$pasienbaru="0";} else {$pasienbaru="1";}
} else {
	$pasienbaru="0";
}

$namauser=$_SESSION[namauser];
$waktupermintaan=date("Y-m-d H:i:s");
$tgl_permintaan=date("Y-m-d H:i:s");
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
	$no_jaminan=mysql_real_escape_string($_POST[nojaminan]);
    $sampel=mysql_real_escape_string($_POST[sampel]);
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
	$cd=mysql_num_rows(mysql_query("select noform from htranspermintaan where noform='$noform_oto'"));

	
 //------------------------ set id pasien ------------------------->
	 //digit pendonor 14 digit, 4kode utd, 3 nama, 2 tmpt aftap, 6 sequence, 
	 $q_utd	= mysql_query("select id from utd where aktif='1'",$con);			
	 $utd	= mysql_fetch_assoc($q_utd);
	 $nama1 = str_replace(".","",$nama_pasien);
	 $nama1 = str_replace(" ","",$nama1);
	 $nama1 = str_replace(",","",$nama1);
	 $nm=strtoupper(substr($nama1,0,3));
	 $idp	= mysql_query("select id,id1 from tempat_donor where active='1'",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 $kdtp	= "P".$utd[id].$nm;
	 $idp	= mysql_query("select no_rm from pasien where no_rm like '$kdtp%'
			      order by no_rm DESC",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= substr($idp1[no_rm],9,6);
	 if ($idp2<1) {
		  $idp2="00000";
	 }
	 $int_idp2=(int)$idp2+1;
	 $j_nol1= 6-(strlen(strval($int_idp2)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $norm=$kdtp.$idp4.$int_idp2;
	 //---------------------- END set id pasien ------------------------->

//------------------------ set id permintaan ------------------------->
$udd1   = mysql_query("select id from utd where aktif='1'");
$udd    = mysql_fetch_assoc($udd1);
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= $tempat."-".$tgl.$bl.$th."-";
$idp	= mysql_query("select noform from htranspermintaan where noform like '$kdtp%' order by noform DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[noform],11,4); 
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$noform_oto=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

		$_POST[submit]="";
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }

	if ($cd=='0') {
		$permintaan="INSERT INTO `htranspermintaan` (`noform`, `bagian`, `kelas`, `namadokter`, `tglminta`, `diagnosa`, `alasan`, `hb`, `jenis`, `stat`, `rs`, `regrs`,`shift`, `tempat`, `nojenis`, `no_rm`, `umur`, `petugas`, `tgl_register`, `ruangan`, `pernah_transfusi`,`kapan`, `jenis_permintaan`, `reaksi_transfusi`, `gejala`, `jml_kehamilan`, `abortus`, `ket`, `nojaminan`,`sampel`,`tgl_sampel`)
				VALUES ('$noform_oto','$nama_bagian',
				'$_POST[nama_kelas]','$nama_dokter','$_POST[tgl_diperlukan]','$diagnosa','$alasan',
				'$hb','$jenis','0','$_POST[nama_rs]','$reg_rs','$shift','$tempat','$no_layanan','$sqlpasien[no_rm]','$_POST[umur]',
				'$_POST[sahper]',NOW(),'$_POST[nama_ruangan]','$_POST[pernahtransfusi]','$_POST[kapan]','$_POST[jnspermintaan]',
				'$_POST[reaksitransfusi]','$_POST[gejala]','$_POST[jmlkehamilan]','$_POST[abortus]','$_POST[ket]','$no_jaminan','$sampel',NOW())";

		$daftar="INSERT INTO `daftarpasien`(`tanggal`,`noform`,`nama`,`rs`,`sifat`,`jamtiba`,`id_udd`) values('$waktupermintaan','$noform_oto','$nama_pasien','$namars[NamaRs]','$_POST[jnspermintaan]','$jamminta','$udd[id]')";
                          
        if ($sampel=='1'){
           $insertsampel= mysql_query("INSERT INTO `terima_sampel`(`noform`,`pasien`,`goldrh`,`rs`,`petugas`) values('$noform_oto','$nama_pasien','$golDrh','$namars[NamaRs]','$_POST[sahper]')");
        }

		$p3=mysql_query($permintaan);
        $p4=mysql_query($daftar);
		//=======Audit Trial====================================================================================
		$log_mdl ='PASIEN SERVICE';
		$log_aksi='Tambah Permintaan: '.$noform_oto.' - No. pasien : '.$sqlpasien[no_rm];
		include_once "user_log.php";
		//=====================================================================================================

		for ($i=0;$i<count($_POST['jenisproduk']);$i++) {
			$jenisproduk=$_POST['jenisproduk'][$i];
			$jumlahminta=$_POST['jmlminta'][$i];
			$ccminta=$_POST['ccminta'][$i];
			$nat=$_POST['nat'][$i];
			$volumeminta=$_POST['volumedarah'][$i];
			$intjumlahminta=intval($jumlahminta);
			if ($intjumlahminta>0){
				$sqlpermintaandetail="insert into dtranspermintaan (`NoForm`,`JenisDarah`,`GolDarah`,`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`,`no_rm`,`nat` ) values
									('$noform_oto','$jenisproduk','$_POST[goldarah]','$_POST[rhesus]','$jumlahminta','0','$ccminta','$_POST[keterangandrh]','$_POST[tgl_diperlukan]','$tempat','$sqlpasien[no_rm]','$nat')";
				$p1=mysql_query($sqlpermintaandetail);
				//=======Audit Trial====================================================================================
				/*$log_mdl ='PASIEN SERVICE';
				$log_aksi='Tambah permintaan: '.$noform_oto.' - Jenis : '.$jenisproduk;
				include_once "user_log.php";*/
				//=====================================================================================================
			
			}
		}
		
		if ($p1) $noform1=str_replace("/","-",$noform_oto);
                          
        //Whatsapp
        $wa="SELECT\n".
        "pmi.htranspermintaan.regrs,\n".
        "pmi.dtranspermintaan.NoForm,\n".
        "pmi.dtranspermintaan.GolDarah,\n".
        "pmi.dtranspermintaan.Rhesus,\n".
        "pmi.dtranspermintaan.JenisDarah,\n".
        "pmi.pasien.nama,\n".
        "pmi.pasien.umur,\n".
        "pmi.rmhsakit.NamaRs,\n".
        "pmi.dtranspermintaan.Jumlah\n".
        "FROM\n".
        "pmi.dtranspermintaan\n".
        "JOIN pmi.pasien\n".
        "ON pmi.dtranspermintaan.no_rm = pmi.pasien.no_rm \n".
        "JOIN pmi.htranspermintaan\n".
        "ON pmi.dtranspermintaan.NoForm = pmi.htranspermintaan.noform \n".
        "JOIN pmi.rmhsakit\n".
        "ON pmi.htranspermintaan.rs = pmi.rmhsakit.Kode\n".
        "where pmi.dtranspermintaan.NoForm='$noform_oto'";
        
        $cariwa=mysql_fetch_assoc(mysql_query($wa));
        if ($cariwa[JenisDarah]=="FFP KONVALESEN"){
                          $sapa='Semangat Pagi';
                          $pesan=$sapa.', Info Permintaan Darah : Pasien '.$cariwa[nama].' ('.$cariwa[umur].' thn) | Gol. '.$cariwa[GolDarah].'/'.$cariwa[Rhesus].' | '.$cariwa[NamaRs].' RM('.$cariwa[regrs].') | FFP Konvalesen sebanyak '.$cariwa[Jumlah].' Kolf | Petugas : '.$namauser ;
                                     
                          // WA Petugas
                          $kirim=mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text)
                          values ('0','082133888855','$pesan')");
                          
                          $kirim1=mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text)
                          values ('0','08562820827','$pesan')");
                                              
                          $kirim2=mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text)
                          values ('0','082226257990','$pesan')");
                          }
                                             echo $kirim;
			//echo ("<font size=3>Formulir No. <b>'$noform_oto'</b> telah ditambah !!<br></font>
			//<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=idpasien_barcode2.php?idpendonor=$noform_oto\">");
                                              
            echo ("<font size=3>Formulir No. <b>'$noform_oto'</b> telah ditambah !!<br></font>
            <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir2.php?module=cetak_minta&noform=$noform_oto\">");
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
			<tr><td>No.Reg.RS</td>
				<!--td class="input" nowrap><input name="no_formulir" type="text" size="20" required value="<?=$noformfix?>" onkeydown="drs(this.value);" placeholder='No-Urut/tahun'-->
			<td class="input" nowrap><!--input name="no_formulir" type="text" size="20" onkeydown="drs(this.value);" required placeholder='No-Urut/tahun'-->
				<input name="reg_rs" type="text" placeholder='No.Reg.RS'></td>
			</tr>
			<tr><td rowspan='2'>Nama RS</td>
				<!--td class="styled-select" bgcolor="#ffa688"><select name="nama_rs" required ></select></td-->
				<td class="input" nowrap><input type=text name="nama_rs" required id="rmhsakit" placeholder='Ketik Nama RS'></td>
			</tr>
				<td class="styled-select" bgcolor="#ffa688">Jika Nama RS tidak ada, Input dari master RS terlebih dahulu</td>
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
				<!--td class="styled-select" bgcolor="#ffa688"><select name="diagnosa" nowrap>
					<?php	
						$diagnosa1="select nama from diagnosa order by kode ASC";
						$diag=mysql_query($diagnosa1);
						while($diag2=mysql_fetch_assoc($diag)){
							$diagnosa2="";?>
							<option value="<?=$diag2[nama]?>"<?=$diagnosa2?>><?=$diag2[nama]?></option><?

						}?></select-->
				<td class="input"><input name="diagnosa" id="diagnosa" required type="text" required size="30" placeholder='DHF'></td>
			</tr>
			<tr><td>Cara Bayar</td>
				<td class="styled-select" bgcolor="#ffa688"><select name="jenis" nowrap>
						<?php
						$permintaan2="select * from jenis_layanan";
						$do2=mysql_query($permintaan2);
						while($data2=mysql_fetch_assoc($do2)){
							$select2="";?>
							<option value="<?=$data2[kode]?>"<?=$select2?>><?=$data2[nama]?></option><?
						}?></select>
				No.Kartu<input name="noreglayanan" type="text" size="6" placeholder='No.Kartu'>
				No.Jaminan<input name="nojaminan" type="text" size="8" placeholder='No.Jaminan'></td>
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
						<option value="Biasa">Biasa</option>
						<option value="Cadangan">Cadangan</option>
						<option value="Siap Pakai">Siap Pakai</option>
						<option value="Cyto/Segera">Cyto/Segera</option>
					</select>
					Keterangan<input name="ket" type="text" size="20" placeholder='Keterangan'></td>
			</tr>
			<tr><td class="input" colspan='2' alight="Center">Khusus Pasien Wanita</td>
				<!--td class="input"></td-->
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


				<!--tr><td>No RM</td>
					<td class="input"><input name="norm" id="norm" type="text" size="20" required placeholder='No. Rekam Medis'></td-->
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
	<td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 onchange="document.permintaandarah.umur.value=Age(document.permintaandarah.datepicker.value);"></td>
	<!--td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 ></td-->
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
			<tr><td>Jenis Kelamin</td><? if ($sqlpasien[kelamin]=="P"){$kelamin="Perempuan";}else{$kelamin="Laki-laki";}?>
				<td class="input"><?=$kelamin?></td></tr>
			<tr> <td>Nama Keluarga</td><td class="input"><?=$sqlpasien[keluarga]?></td></tr>
			<tr><td>Tgl Lahir</td><td class="input"><?=$sqlpasien[tgl_lahir]?></td></tr>
			<tr><td>Umur</td><td class="input" ><?=$sqlpasien[umur]?> th</td>
			<input name="umur" type=hidden value="<?=$sqlpasien[umur]?>"></tr>
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
					
				</select>
				Rhesus
				<select name="rhesus">
					<option value="+">Positif (+)</option>
					<option value="-">Negatif (-)</option>
				</select></td>
			</tr>
            <tr><td>Sampel Darah</td>
                <td class="styled-select" bgcolor="#ffa688">
                <select name="sampel" required>
                    <option value="">--Pilih--</option>
                    <option value="1">Ada</option>
                    <option value="0">Tidak Ada</option>
                </select>
               </td>
            </tr>
			<?
			$sqlproduk="select nama,lengkap, volume from produk order by nama";
			$qproduk=mysql_query($sqlproduk);
			while($produk1=mysql_fetch_assoc($qproduk)){?>
				<tr><td nowrap><?=$produk1[lengkap]?></td>
					<input name="jenisproduk[]" type=hidden value="<?=$produk1[nama]?>">
					<input name="volumedarah[]" type=hidden value="<?=$produk1[volume]?>">
					
					<td class="input"><input name="jmlminta[]" type="text" size="3">Kantong <input name="ccminta[]" type="text" size="2">CC 
					<select name="nat[]">
						<option value="0">Biasa</option>
						<option value="1">NAT</option>
					</select>
					</td>
				
				</tr>
			<?}?>			
			<tr><td>Tgl Diperlukan</td>
				<td class="input"><input type="text" name="tgl_diperlukan" id="butuh" required size=8>
				Ket.<input name="keterangandrh" type="text" size="10"></td>
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
					<?$user1="select * from user order by nama_lengkap ASC";
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
					<? $s1='';$s2='';$s3='';$s4='';
						$waktu=date('H:i:s');
						$jam1=mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
						$jam2=mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));	
						$jam3=mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
						$jam4=mysql_fetch_assoc(mysql_query("select * from shift where nama='IV'"));
						
						$sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];$sh4=$jam4[jam];
						if ($waktu >= $sh1 ){ $s1='selected';}
						if ($waktu >= $sh2 ){ $s2='selected';}
						if ($waktu >= $sh3 ){ $s3='selected';}
						if ($waktu < $sh1 ){ $s4='selected';}
					?>
					<select name="shift">
						<option value="1" <?=$s1?>>SHIFT I</option>
						<option value="2" <?=$s2?>>SHIFT II</option>
						<option value="3" <?=$s3?>>SHIFT III</option>
						<option value="4" <?=$s4?>>SHIFT IV</option>
						
					</select></td>  
			</tr>
		</table>
	</td>
	</tr>
	</table>
</form>
