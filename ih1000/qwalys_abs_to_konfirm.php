<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$col4=mysql_query("SELECT `nolot_aa` FROM `dkonfirmasi`");if(!$col4){mysql_query("ALTER TABLE `dkonfirmasi` 
ADD `nolot_aa` VARCHAR( 12 ) NULL AFTER `ba`,
ADD `expa` DATE NULL AFTER `nolot_aa`,
ADD `nolot_ab` VARCHAR( 12 ) NULL AFTER `expa`,
ADD `expb` DATE NULL AFTER `nolot_ab`,
ADD `nolot_ad` VARCHAR( 12 ) NULL AFTER `expb`,
ADD `expd` DATE NULL AFTER `nolot_ad`");}
?>
<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script language=javascript src="js/konfirmasi_gol_darah1.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script language="javascript">
function setFocus(){document.kantong.nokantong.focus();}
</script>
</head>
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$today3=date('Y-m-d H:i:s');

if (isset($_POST['terima'])) {
	for ($i=0; $i<count($_POST[golfix]); $i++) {
		//print_r($_POST);
		//echo sizeof($_POST[goldarah]);
		//$kode=$_POST[kode][$i]; 
		$nokt=$_POST[nokt][$i];		
		$goldarah=$_POST[golfix][$i]; 		
		$rhesus=$_POST[rhfix][$i]; 		
		$nkt=$_POST[nokantong][$i];
		$cocok=$_POST[cocok][$i];
		$metode=$_POST[metode];
		$nolot=$_POST[nolot];
		$exp=$_POST[exp];
		$antiA=$_POST[antia][$i];
		$antiB=$_POST[antib][$i];


		$tA=$_POST[ta][$i];
		$tB=$_POST[tb][$i];
		$teo=$_POST[teo][$i];
		$ac=$_POST[ac][$i];
		$ABS=$_POST[abs][$i];
		$kodep=$_POST[kodep][$i];

		
		
		

		// generate kode konfirmasi
		$k_today="K".date("dmy")."-";
		$idp	= mysql_query("select NoKonfirmasi from dkonfirmasi where NoKonfirmasi like '$k_today%'
			      order by NoKonfirmasi DESC limit 1");
		$idp1	= mysql_fetch_assoc($idp);
		$idp2	= substr($idp1[NoKonfirmasi],8,3);
		if ($idp2<1) {
			$idp2="000";
		}
		$int_idp2=(int)$idp2+1;
		$j_nol1= 3-(strlen(strval($int_idp2)));
		$idp4='';
		for ($n=0; $n<$j_nol1; $n++){
			$idp4 .="0";
		}
		$no_konfirmasi=$k_today.$idp4.$int_idp2;
		//echo "<br>".$no_konfirmasi."*".$nkt;
		// End generate kode konfirmasi
		
		//cek gol darah sebelumnya
		$q_cek_gol=mysql_query("SELECT gol_darah,RhesusDrh,kodependonor from stokkantong where noKantong ='$nokt'");
		$a_cek_gol=mysql_fetch_assoc($q_cek_gol);	
        
        $tambah=mysql_query("UPDATE stokkantong set gol_darah='$goldarah',RhesusDrh='$rhesus',abs='$ABS', statKonfirmasi='1' where noKantong like '$nkt%'");
        $tambah1=mysql_query("UPDATE pendonor set GolDarah='$goldarah',Rhesus='$rhesus' where Kode='$kodep'");
        $komp=mysql_query("UPDATE dpengolahan set goldarah='$goldarah',rhesus='$rhesus' where noKantong like '$nkt%'");
        $nkt1=mysql_query("update stokkantong set kodependonor='$a_cek_gol[kodependonor]' where  (kodependonor='' or kodependonor is NULL) and nokantong like '$nkt%'");
        $tambah3=mysql_query("UPDATE htransaksi set gol_darah='$goldarah',rhesus='$rhesus' where nokantong like '$nkt%'");
        $tambah4=mysql_query("UPDATE konfirmasi_temp set stat='1' WHERE NoKantong='$nokt'");
        $tambah2=mysql_query("insert into dkonfirmasi(NoKonfirmasi,NoKantong,GolDarah,Rhesus,tgl,petugas,Cocok,goldarah_asal,
				rhesus_asal,metode,sel,antiA,antiB,antiO,serum,tA,tB,`tsO`,`antiD`,`ac`,`ba`,
				`nolot_aa`,`expa`,`nolot_ab`,`expb`,`nolot_ad`,`expd`)
				value ('$no_konfirmasi','$nokt','$goldarah','$rhesus','$today3','$namauser','$cocok','$a_cek_gol[gol_darah]',
				'$a_cek_gol[RhesusDrh]','$metode','0','$antiA','$antiB','-','0','$tA','$tB','$teo','4+','1','1',
				'$nolot','$exp','$nolot','$exp','$nolot','$exp')");
	//=======Audit Trial====================================================================================
	$log_mdl ='KONFIRMASI';
	$log_aksi='KGD: '.$nokt.', transaksi: '.$no_konfirmasi. 'Gol. Awal: '.$a_cek_gol[gol_darah].$a_cek_gol[RhesusDrh].', hasil: '.$goldarah.$rhesus;
	include('user_log.php');
	//=====================================================================================================
	
		}
	if ($tambah) {
        echo "Golongan Darah ABO dan Rhesus Telah berhasil diupdate";
	echo "<meta http-equiv='refresh' content='2;url=pmikonfirmasi.php?module=rekap_konfirmasi'>";?>
	<?}
} ?>
	<body onLoad=setFocus()>
	<form name="kantong" method="POST" action="<?=$PHPSELF?>">
	<table style="background-color:#FECCBF; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<?
		$no =0;
		$ambil = 	"SELECT\n".
				"konfirmasi_temp.tgl,\n".
				"SUBSTR(konfirmasi_temp.NoKantong,1,8) as NoKantong,\n".
				"stokkantong.NoKantong as nokt,\n".				
				"stokkantong.gol_darah as gollama,\n".
				"stokkantong.Status as statk,\n".
				"stokkantong.sah,\n".				
				"stokkantong.RhesusDrh as rhlama,\n".
				"CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN 'A'\n".
				"   WHEN '0 ' THEN 'O'\n".
				"	 WHEN 'B ' THEN 'B'\n".
				"   WHEN 'AB' THEN 'AB'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS golbaru,\n".
				"CASE SUBSTR(konfirmasi_temp.GolDarah,8,8)\n".
				"   WHEN 'negative' THEN '-'\n".
				"   WHEN 'positive' THEN '+'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,8,8) END AS rhesus,\n".
				"CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN '4+'\n".
				"   WHEN '0 ' THEN 'Neg'\n".
				"	 WHEN 'B ' THEN 'Neg'\n".
				"   WHEN 'AB' THEN '4+'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS antiA,\n".
				"CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN 'Neg'\n".
				"   WHEN '0 ' THEN 'Neg'\n".
				"	 WHEN 'B ' THEN '4+'\n".
				"   WHEN 'AB' THEN '4+'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS antiB,\n".
				"CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN 'Neg'\n".
				"   WHEN '0 ' THEN '4+'\n".
				"	 WHEN 'B ' THEN 'Neg'\n".
				"   WHEN 'AB' THEN '4+'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS TA,\n".
				"CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN '4+'\n".
				"   WHEN '0 ' THEN '4+'\n".
				"	 WHEN 'B ' THEN 'Neg'\n".
				"   WHEN 'AB' THEN 'Neg'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS TB,CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN 'Neg'\n".
				"   WHEN '0 ' THEN 'Neg'\n".
				"	 WHEN 'B ' THEN 'Neg'\n".
				"   WHEN 'AB' THEN 'Neg'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS TEO,\n".
				"	CASE SUBSTR(konfirmasi_temp.GolDarah,1,2)\n".
				"   WHEN 'A ' THEN 'Neg'\n".
				"   WHEN '0 ' THEN 'Neg'\n".
				"	 WHEN 'B ' THEN 'Neg'\n".
				"   WHEN 'AB' THEN 'Neg'\n".
				"   ELSE SUBSTR(konfirmasi_temp.GolDarah,1,2) END AS AC, 	 \n".
				"konfirmasi_temp.reagen,\n".
				"konfirmasi_temp.tgl_ed,\n".
				"konfirmasi_temp.petugas,\n".
				"SUBSTR(konfirmasi_temp.abs,5,8) as abs,\n".
				"stokkantong.`Status`,\n".
				"stokkantong.kodePendonor\n".
				"FROM\n".
				"konfirmasi_temp\n".
				"INNER JOIN stokkantong ON konfirmasi_temp.NoKantong = stokkantong.noKantong\n".
				"WHERE konfirmasi_temp.stat=0\n".
				"GROUP BY konfirmasi_temp.NoKantong";
?>
<?
		$ambilreagen =	mysql_fetch_assoc(mysql_query($ambil));
?>
					<tr >
						<td>METODE : <select name="metode">
						<option value="Otomatis">Otomatis</option>
						<option value="Bioplat">Bioplat</option>
						<option value="Tube Test">Tube Test</option>
						</select></td>
						<td class="input">LOT Reagen : <INPUT type="text"  name="nolot" size='9' value="<?=$ambilreagen[reagen]?>"'>
						</td>
						<td class="input">EXP. Reagen : <INPUT type="text"  name="exp" size='9' value="<?=$ambilreagen[tgl_ed]?>"'>
						

						

					</tr>
</table>
<table>
					<tr>
						

					</tr>
	</table>	

	


			<table class="form" id="box-table-b" width=800px align=top>
					<tr class="field">
						<td align='center'>No</td>
						<td align='center' width=100px>No Kantong</td>
						<td align='center' width=50px>Gol Darah Lama</td>
						<td align='center'>Gol Darah Baru</td>
						<td align='center'>Rhesus</td>
						<td align='center'>Cocok</td>
						
						<td align='center' width=100px>Anti A</td>
						
						<td align='center' width=100px>Anti B</td>
						

						<td align='center' width=100px>TA</td>
						<td align='center' width=100px>TB</td>
						<td align='center' width=100px>TO</td>
						<td align='center' width=100px>AC</td>
						<td align='center' width=100px>Anti D</td>
						
						<td align='center' width=100px>BA 6%</td>
						<td align='center' width=100px>ABS</td>
						<td align='center' width=100px>Kode Pendonor</td>
						<td align='center' width=100px>Status Kantong</td>
						
						</tr>
		<?
		$ambildata =	mysql_query($ambil);
		while ($temp=mysql_fetch_assoc($ambildata)) {
		$no++;
		?>
		
		<tr>
				<td class=input><?=$no?></td>
				<td class=input>
				<input type="hidden" name=nokt[] value=<?=$temp[nokt]?>>				
				<input type="hidden" name=nokantong[] value=<?=$temp[NoKantong]?>><?=$temp[NoKantong]?></td>
				<td class=input><?=$temp[gollama]?>(<?=$temp[rhlama]?>)</td>
				<td class=input align=center>
				<?
		        	$sel0="A";$sel1="B";$sel2="O";$sel3="AB";
		        	if ($temp[golbaru]=="A"){$sel0="selected";}
		        	if ($temp[golbaru]=="B"){$sel1="selected";}
		        	if ($temp[golbaru]=="O"){$sel2="selected";}
		        	if ($temp[golbaru]=="AB"){$sel3="selected";}
		        	?>
				<select name="golfix[]">
                		<option value="A" <?=$sel0?>>A</option>
                		<option value="B" <?=$sel1?>>B</option>
                		<option value="O" <?=$sel2?>>O</option>
                		<option value="AB" <?=$sel3?>>AB</option>
                		</select>
				</td>
				<td class=input>
				<?
		        	$rh0="+";$rh1="-";
		        	if ($temp[rhesus]=="+"){$rh0="selected";}
		        	if ($temp[rhesus]=="-"){$rh1="selected";}
		        	
		        	?>
				<select name="rhfix[]">
                		<option value="+" <?=$rh0?>>+</option>
                		<option value="-" <?=$rh1?>>-</option>
                		
                		</select>
				</td>
				 
				<?
					if (($temp[golbaru]==$temp[gollama])){
						$Cocok=0;
					}else{
						$Cocok=1;
					}
					
				?>
				<td class=input><input type="hidden" name=cocok[] value=<?=$Cocok?>><?=$Cocok?>
								
				</td>
				
				<td class=input><input type="hidden" name=antia[] value=<?=$temp[antiA]?>><?=$temp[antiA]?></td>
				<td class=input><input type="hidden" name=antib[] value=<?=$temp[antiB]?>><?=$temp[antiB]?></td>
				<td class=input><input type="hidden" name=ta[] value=<?=$temp[TA]?>><?=$temp[TA]?></td>
				<td class=input><input type="hidden" name=tb[] value=<?=$temp[TB]?>><?=$temp[TB]?></td>
				<td class=input><input type="hidden" name=teo[] value=<?=$temp[TEO]?>><?=$temp[TEO]?></td>
				<td class=input><input type="hidden" name=ac[] value=<?=$temp[AC]?>><?=$temp[AC]?></td>
				<td class=input><input type="hidden" name=antid[] value="Neg">Neg</td>
				<td class=input><input type="hidden" name=ba[] value="Neg">Neg</td>
				<td class=input><input type="hidden" name=abs[] value=<?=$temp[abs]?>><?=$temp[abs]?></td>
				<td class=input><input type="hidden" name=kodep[] value=<?=$temp[kodePendonor]?>><?=$temp[kodePendonor]?></td>
				<?
				$status_ktg=$temp['Status']; $kantong_sah=$temp['sah'];
			switch ($status_ktg){
				case '0' : $statuskantong='Kosong('.$status_ktg.')';
						   if ($c_ktg[StatTempat]==NULL) $statuskantong='Kosong-Logistik('.$status_ktg.')';		
						   if ($c_ktg[StatTempat]=='0')  $statuskantong='Kosong-Logistik ('.$status_ktg.')';
						   if ($c_ktg[StatTempat]=='1')  $statuskantong='Kosong-Aftap('.$status_ktg.')';
						   break;
				case '1' : if ($c_ktg['sah']=="1"){
								$statuskantong='Karantina('.$status_ktg.')';
							} else{
								$statuskantong='Belum disahkan('.$status_ktg.')';
							}
							break;
				case '2' : $statuskantong='Sehat('.$status_ktg.')';
							if (substr($c_ktg[stat2],0,1)=='b') $tempat=" (BDRS)";
							break;
				case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
				case '4' : $statuskantong='Rusak('.$status_ktg.')';break;
				case '5' : $statuskantong='Rusak-Gagal('.$status_ktg.')';break;
				case '6' : $statuskantong='Dimusnahkan('.$status_ktg.')';break;
				default  : $statuskantong='-';
			}
				?>
				<td class=input><?=$statuskantong?></td>

		</tr>
				<?}?>	
				</table>
<br>
				<input name="terima" type="submit" value="Proses Konfirmasi">
</form>

