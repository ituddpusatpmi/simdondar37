

<body OnLoad="document.permintaandarah.no_formulir.focus();">

<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
    $noformrs   = $_GET['kode'];
    $idrs       = $_GET['rs'];
    $normps     = $_GET['norm'];
    $datars     = mysql_fetch_assoc(mysql_query("select * from htranspermintaanRS where noformRS='$noformrs'"));
    //$datars     = mysql_fetch_assoc(mysql_query("select * from htranspermintaanRS where noformRS"));
?>



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
    $('#ruangan').autocomplete({source:'modul/suggest_ruangan.php', minLength:2}),
    $('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2}),
    $('#rmhsakit').autocomplete({source:'modul/suggest_rs.php', minLength:2});});
</script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 1px;font-size: 13px;cursor: pointer; }</style>
<?php
include ("config/db_connect.php");
//include ("config/db_connect_led.php");


$namauser=$_SESSION[namauser];
$waktupermintaan=date("Y-m-d H:i:s");
$tgl_permintaan=date("Y-m-d H:i:s");
$jamminta=date("H:i:s");
$tahun=date("Y");
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$tgl_yesterday=date("Y-m-d",$yesterday);
$td0=php_uname('n');
$td0=substr($td0,0,3);


if (isset($_POST[submitok])) {
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
    $umur=mysql_real_escape_string($_POST[usia]);
	$cek_dokter=1;
	

	$namars=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where kode='$_POST[nama_rs]'"));

    


		$_POST[submit]="";
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }

		$permintaan="INSERT INTO `htranspermintaan` (`noform`, `bagian`, `kelas`, `namadokter`, `tglminta`, `diagnosa`, `alasan`, `hb`, `jenis`, `stat`, `rs`, `regrs`,`shift`, `tempat`, `nojenis`, `no_rm`, `umur`, `petugas`, `tgl_register`, `ruangan`, `pernah_transfusi`,`kapan`, `jenis_permintaan`, `reaksi_transfusi`, `gejala`, `jml_kehamilan`, `abortus`, `ket`,`nojaminan`,`sampel`,`tgl_sampel`)
				VALUES ('$noformrs','$nama_bagian',
				'$_POST[nama_kelas]','$nama_dokter',NOW(),'$diagnosa','$alasan',
				'$hb','$jenis','0','$_POST[nama_rs]','$reg_rs','$shift','$tempat','$no_layanan','$normps','$umur',
				'$_POST[sahper]','$waktupermintaan','$_POST[nama_ruangan]','$_POST[pernahtransfusi]','$_POST[kapan]','$_POST[jnspermintaan]',
				'$_POST[reaksitransfusi]','$_POST[gejala]','$_POST[jmlkehamilan]','$_POST[abortus]','$_POST[ket]','$no_jaminan','$sampel',NOW())";

	
	        	$daftar="INSERT INTO `daftarpasien`(`tanggal`,`noform`,`nama`,`rs`,`sifat`,`jamtiba`,`id_udd`) values('$waktupermintaan','$noformrs','$nama_pasien','$namars[NamaRs]','$_POST[jnspermintaan]','$jamminta','$udd[id]')";
                
                $updateRS ="UPDATE htranspermintaanRS set `status`='1',`noform`='$noformRS' where noformRS='$noformrs'";
        
                          if ($sampel=='1'){
                             $insertsampel= mysql_query("INSERT INTO `terima_sampel`(`noform`,`pasien`,`goldrh`,`rs`,`petugas`) values('$noformrs','$nama_pasien','$golDrh','$namars[NamaRs]','$_POST[sahper]')");
                          }
        
		$p3=mysql_query($permintaan);
		$p4=mysql_query($daftar);
        $p9=mysql_query($updateRS);
        //=======Audit Trial====================================================================================
        $log_mdl ='PASIEN SERVICE';
        $log_aksi='Tambah Permintaan RS Online: '.$noformrs.' - No. pasien : '.$normps;
        include_once "user_log.php";
        //=====================================================================================================
		
        //Whatsapp
        $wa     =   mysql_query("SELECT NamaRs, gateway from rmhsakit where Kode='$_POST[nama_rs]'");
        $cariwa =   mysql_fetch_assoc($wa);
        
    
                                            $sapa='Salam Kemanusiaan';
                                            $pesan=$sapa.', Info Permintaan Darah : Pasien '.$nama_pasien.' ('.$umur.' thn) | Gol. '.$golDrh.'/'.$rhesus_psn.' | Telah dirverifikasi dengan nomor registrasi : '.$noformrs ;
                                                       
                                            // WA Petugas
                                            $kirim=mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text) values ('0','$cariwa[gateway]','$pesan')");
    //CURL CLoud
    $postData = array("no_trans" => $noformrs, "status" => "1");
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://enigmeds.com/pmi_online/rs/valid.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($postData),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    //echo $response;
    //Curl End
                                            
                                            

				$wil=mysql_fetch_assoc(mysql_query("select wilayah from rmhsakit where Kode='$_POST[nama_rs]'"));
				mysql_query("update `htranspermintaan` set wilayah='$wil[wilayah]' where noform='$noformrs'");
                                                               
            echo $kirim;
			//echo ("<font size=3>Formulir No. <b>'$noform_oto'</b> telah ditambah !!<br></font>
			//<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=idpasien_barcode2.php?idpendonor=$noform_oto\">");
                                                                
            echo ("<font size=3>Formulir No. <b>'$noformrs'</b> telah ditambah !!<br></font>
            <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir2.php?module=cetak_minta&noform=$noformrs\">");
	
}?>
<form name="permintaandarah" autocomplete="off" method="post" action="<?php echo $PHP_SELF;?>">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#FF6346;" >
		<tr>
			<td align="center"><font size="4" color="white" face="Trebuchet MS"><b>FORMULIR PERMINTAAN DARAH</b></font></td>
			<!--td align="right"><input type="submit" name="submit1" value="Simpan" class="swn_button_blue"></td-->
		</tr>
	</table>
	<table border="0" style="border-collapse:collapse" cellpadding="1" cellspacing="0" width="100%">
		<tr><td valign="top"><font size="3" color="red" face="Trebuchet MS">A. DATA RUMAH SAKIT</font>
		<table class="form" cellspacing="1" cellpadding="0" border="1" style="border-collapse:collapse">
			<tr><td>No.Reg.RS</td>
			<td class="input" nowrap><?=$datars[regrs]?>
				<input name="reg_rs" type="hidden" value="<?=$datars[regrs]?>"></td>
			</tr>
			<tr><td>Nama RS</td>
				<td class="input" nowrap><?=$datars[rs]?>
                <input type="hidden" name="nama_rs" required value="<?=$datars[rs]?>">
					</td>
			<tr><td>Medis(Bagian)</td>
				<td class="input" nowrap>
                <?=$datars[bagian]?>
                <input type="hidden" name="nama_bagian" required value="<?=$datars[bagian]?>">
                </td>
			</tr>
			<tr><td>Kelas</td>
				<td class="input" nowrap>
                <?=$datars[kelas]?>
                <input type="hidden" name="nama_kelas" required value="<?=$datars[kelas]?>">
			</tr>
            <tr><td>Ruangan</td>
                <td class="input" nowrap>
                <?=$datars[ruangan]?>
                <input type="hidden" name="nama_ruangan" required value="<?=$datars[ruangan]?>">
                </td>
            </tr>
			<tr><td>Nama Dokter</td>
				<td class="input" nowrap><?=$datars[namadokter]?>
                <input type=hidden value="<?=$datars[namadokter]?>" name="nama_dokter" required ></td>
			</tr>
			<tr><td>Diagnosa Klinis</td>
                <td class="input" nowrap><?=$datars[diagnosa]?>
                <input type=hidden value="<?=$datars[namadokter]?>" name="diagnosa" required ></td>
    
            
			<tr><td>Cara Bayar</td>
				<td class="input" nowrap>
                        <!--select name="jenis" nowrap>
						<?php
						$permintaan2="select * from jenis_layanan";
						$do2=mysql_query($permintaan2);
						while($data2=mysql_fetch_assoc($do2)){
							$select2="";?>
							<option value="<?=$data2[kode]?>"<?=$select2?>><?=$data2[nama]?></option><?
						}?></select-->
                        
                <?php
                $permintaan2="select nama from jenis_layanan where kode='$datars[jenis_permintaan]' limit 1";
                //echo $permintaan2;
                $do2=mysql_query($permintaan2);
                $data2=mysql_fetch_assoc($do2);?>
                <input name="jenis" type="hidden" value="<?=$datars[jenis_permintaan]?>">
                <?=$data2[nama]?>
				<input name="noreglayanan" type="hidden" size="6" placeholder='No.Kartu'>
				<input name="nojaminan" type="hidden" size="8" placeholder='No.Jaminan'></td>
			</tr>
			<tr><td>Alasan Transfusi</td>
				<td class="input"><input name="alasan" type="text" value='<?=$datars[alasan]?>' size="30" placeholder='Anemis'></td>
			</tr>
			<tr><td>Jumlah HB</td>
				<td class="input">
                <input name="hb" type="text" value="<?=$datars[hb]?>" size="5">gr/dl</td>
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
					<!--select name="jnspermintaan">
						<option value="0">Biasa</option>
						<option value="1">Cadangan</option>
						<option value="2">Siap Pakai</option>
						<option value="3">Cyto/Segera</option>
					</select-->
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
		<? $sqlpasien=mysql_fetch_assoc(mysql_query("select *, timestampdiff(YEAR,`tgl_lahir`,curdate()) AS `usia` from pasien where no_rm='$normps'"));
            if(($sqlpasien['rhesus']=="P") OR ($sqlpasien['rhesus']=="+")){
                    $rhesus = "+";
                }else{
                    $rhesus = "-";
                }
            
                
                ?>
			<table class="form" cellspacing="1" cellpadding="5" border="1" style="border-collapse:collapse">
			<tr><td>No RM</td><td class="input"><?=$sqlpasien[no_rm]?>
					<input name="norm" type=hidden value="<?=$sqlpasien[no_rm]?>">
					<input name="simpanpasien" type=hidden value="0"></tr>
			<tr><td>Nama Pasien</td><td class="input"><?=$sqlpasien[nama]?>
                    <input name="nama_pasien" type="hidden" value="<?=$sqlpasien[nama]?>">
                    <input name="usia" type="hidden" value="<?=$sqlpasien[usia]?>"></td></tr>
			<tr><td>Golongan Darah</td><td class="input"><?=$sqlpasien[gol_darah]?>
					<input name="golDrh" type=hidden value="<?=$sqlpasien[gol_darah]?>"></td></tr>
			<tr><td>Rhesus</td><td class="input"><?=$rhesus?><input name="rhesus_psn" type=hidden value="<?=$rhesus?>"></td></tr>
			<tr><td>Jenis Kelamin</td><? if ($sqlpasien[jk]=="P"){$kelamin="Perempuan";}else{$kelamin="Laki-laki";}?>
				<td class="input"><?=$kelamin?></td></tr>
			<tr> <td>Nama Keluarga</td><td class="input"><?=$sqlpasien[keluarga]?></td></tr>
			<tr><td>Tgl Lahir</td><td class="input"><?=$sqlpasien[tgl_lahir]?></td></tr>
			<tr><td>Alamat Pasien</td>	<td class="input"><?=$sqlpasien[alamat]?></td></tr>
			<tr><td>No Telepon</td>	<td class="input"><?=$sqlpasien[tlppasien]?></td></tr>
		</table>
		
	</td>
	<td  valign="top">
		<font size="3" color="red" face="Trebuchet MS">C.DATA PERMINTAAN DARAH</font>
		<table class="form" cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse">
			
            <tr><td>Sampel Darah</td>
                <td class="styled-select" bgcolor="#ffa688">
                <select name="sampel" required>
                    <option value="">--Pilih--</option>
                    <option value="1">Ada</option>
                    <option value="0">Tidak Ada</option>
                </select>
               </td>
            </tr>
            
            <tr><td colspan="2" align="center" style= "text-align:center" bgcolor="#8c2300">Produk Darah</td></tr>
            <?php
            $dtrans="select * from dtranspermintaan where NoForm='$noformrs'";
            $dt2=mysql_query($dtrans);
            while($dt=mysql_fetch_assoc($dt2)){?>
                <tr><td><?=$dt[JenisDarah]?></td>
                    <td  bgcolor="#ffa688"><?=$dt[Jumlah]?></td>
            <?}?>
			
			<tr><td>Diterima Oleh</td>
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
        <p>
         <table class="form" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse">
            <tr></tr>
                <tr>
                <td class="styled-select" colspan="2" bgcolor="#ffffff" align="center">
                    <input type="submit" name="submitok" onclick="return confirm('Simpan Permintaan Darah? ')" value="Simpan" class="swn_button_blue">
                    <a href="pmikasir2.php?module=batalmintars&notrans=<?=$noformrs?>"><input type="button" name="submitbt" onclick="return confirm('Batalkan Permintaan Darah? ')" value="Batal" class="swn_button_red"></a>
                    <a href="pmikasir2.php?module=rsonline"><input type="button" name="submitkb" value="Kembali" class="swn_button_green"></a>
                </td>
            </tr>
         </table>
	</td>
	</tr>
	</table>
    
</form>
