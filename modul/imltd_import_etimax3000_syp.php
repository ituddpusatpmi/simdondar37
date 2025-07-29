<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript">
jum_select=0;
function show0(id){
	var campur = document.getElementById('reagen'+id).value;
	var reagenpilih = campur.split('*');
	if (id=='0') document.getElementById('b'+id).innerHTML=reagenpilih[5]+' -  HBsAg - Lot. '+reagenpilih[6];
	if (id=='1') document.getElementById('b'+id).innerHTML=reagenpilih[5]+' -  HCV - Lot. '+reagenpilih[6];
	if (id=='2') document.getElementById('b'+id).innerHTML=reagenpilih[5]+' -  HIV - Lot. '+reagenpilih[6];
	if (id=='3') document.getElementById('b'+id).innerHTML=reagenpilih[5]+' -  Syphilis - Lot. '+reagenpilih[6];
	document.getElementById('kode'+id).innerHTML = reagenpilih[0];
	if (reagenpilih[0]==""){
		alert("Reagen harus dipilih")
	}
}
</script>
<title>Import hasil IMLTD Diasorin Eti-max 3000</title>
</head>
<body>
<?php
if (!empty($_FILES["filecsv"]["tmp_name"])){
	$namafile = $_FILES['filecsv']['tmp_name'];
	$pemisah="|";
	$datacsv = fopen($namafile, "r");
	$add=0;
	$upd=0;
	$nc1=0.000;
	$nc2=0.000;
	$nc3=0.000;
	$ncx=0.000;
	$pc1=0.000;
	$cut_off=0.000;
	$cut_off_factor=0.200;
	$reagen=$_POST[reagen3];
	$reag0_ex=explode('*',$reagen);
	$gagalimport=0;
	$kontrolvalid=0;
	$jml=0;
	?>
	<a name="atas"></a><h2>HASIL IMPORT SHYPILIS, File : <?=$_FILES['filecsv']['name']?></h2>
	<a href="#bawah" class="swn_button_blue">Ke bawah</a>
	<table class="list" border="0" cellpadding="2" cellspacing="1">
		<tr class="field">
			<td align="center" width="50px">Well<br>Location</td>
			<td align="center" width="100px">Patient<br> ID</td>
			<td align="center" width="200px">Assay</td>
			<td align="center" width="75px">Quant.<br> 1 value</td>
			<td align="center" width="75px">Cut Off</td>
			<td align="center" width="75px">OD</td>
			<td align="center" width="75px">Reader<br>value</td>
			<td align="center" width="150px">Qual.<br>value</td>
			<td align="center" width="100px">Flag</td>
		</tr>
		
	<?php	
		while (($data = fgetcsv($datacsv, 1000, $pemisah)) !== FALSE){
			$jml++;
			//Kontrol n check invalid kontrol NC1 & PC1
			if (($jml==7) or ($jml==8)){
				if($data[2]=="FAILED"){$kontrolvalid=1;}
			}
			if($data[0]=="A1"){$nc1=$data[4];} if($data[5]=="*"){$gagalimport=1;}
			if($data[0]=="B1"){$nc2=$data[4];} if($data[5]=="*"){$gagalimport=1;}
			if($data[0]=="C1"){$nc3=$data[4];} if($data[5]=="*"){$gagalimport=1;}
			if($data[0]=="D1"){$pc1=$data[4];} if($data[5]=="*"){$gagalimport=1;}
			$ncx=((float)$nc1+(float)$nc2+(float)$nc3)/3;
			$cut_off=(float)$ncx+(float)$cut_off_factor;
			$cut_off=round($cut_off, 3);
			$od			= $data[4]/$cut_off;
			$od			= round($od, 3);
			if(($data[0]=='A1')||($data[0]=="B1")||($data[0]=="C1")||($data[0]=="D1")){?>
				<tr class="record">
						<td align="center"><?=$data[0]?></td>
						<td align="center"><?=$data[1]?></td>
						<td align="left"><?=$data[2]?></td>
						<td align="right"><?=$data[3]?></td>
						<td align="right"></td>
						<td align="right"></td>
						<td align="right"><?=$data[4]?></td>
						<td><?=$data[5]?></td>
						<td><?=$data[6]?></td>
					</tr><?
			}
			//Datasheet
			if (($gagalimport==0) and ($kontrolvalid==0)){
				if ($jml>11 and $data[0]<>"[End Of Results]" and strlen($data[1])>0 and $data[1]<>"Patient ID") {
					$tanggal=date("Y-m-d");
					//check apakah sudah ada nokantong
					$query ="SELECT nokantong from imltd_import_temp WHERE nokantong='$data[1]' limit 1";
					$qry_result	= mysql_query($query) or die(mysql_error());
					$row		= mysql_fetch_assoc($qry_result);
					$ktg       	= strlen($row[nokantong]);
					if ($ktg==0){
						$sql="insert into imltd_import_temp (tanggal,nokantong,syp_cut_off,syp_quanti,syp_reader,syp_result,syp_od,reagen_syp,syp_metode)
							    values('$tanggal','$data[1]','$cut_off','$data[3]','$data[4]','$data[5]','$od','$reag0_ex[0]','$reag0_ex[5]')";
						$tambah=mysql_query($sql,$con);
						$add++;
					}else{
						$sql=	"update imltd_import_temp set tanggal = '$tanggal', syp_cut_off = '$cut_off', syp_quanti = '$data[3]', syp_reader = '$data[4]',
								syp_result	= '$data[5]', syp_od = '$od', reagen_syp = '$reag0_ex[0]', syp_metode = '$reag0_ex[5]' where nokantong = '$data[1]'";
						$tambah=mysql_query($sql,$con);
						$upd++;
					}
					?>
					<tr class="record">
						<td align="center"><?=$data[0]?></td>
						<td align="center"><?=$data[1]?></td>
						<td align="left"><?=$data[2]?></td>
						<td align="right"><?=$data[3]?></td>
						<td align="right"><?=$cut_off?></td>
						<td align="right"><?=$od?></td>
						<td align="right"><?=$data[4]?></td>
						<td><?=$data[5]?></td>
						<td><?=$data[6]?></td>
					</tr>	
					<?
				}
			}
		}
		fclose($datacsv);
		?>
		<tr class="field">
			<td colspan=9>
				<?if (($gagalimport==0) and ($kontrolvalid==0)){echo "$add data ditambahkan<br>$upd diupdate.";}
				else {echo "Import GAGAL<br>kontrol tidak valid!!!";}?>
			</td>
		</tr>
	</table>
	<a href="pmiimltd.php?module=import_etimax3000konfirmasi"class="swn_button">Konfirmasi hasil</a>
	<a href="pmiimltd.php?module=import_etimax3000"class="swn_button">Kembali ke awal</a>
	<a name="bawah"></a><a href="#atas" class="swn_button_blue">Ke Atas</a>
	<?
} else{?>
<form action="" method="post" enctype="multipart/form-data" name="ContohUploadCSV" id="ContohUploadCSV">
	<h2>SHYPILIS</h2>
	<h2>LANGKAH IMPOR ke 4 dari 4 langkah (terakhir)</h2>
	<table border=0>
	<tr>
		<td>Pilih Reagen Diasorin SYPHILIS
		<select name="reagen3" id="reagen3" onChange="show0(3)" STYLE="width: 300px">
			<option value="">Pilih reagen Diasorin SYPHILIS</option>
				<? 
				$jreagen1=mysql_query("select * from reagen where ((Nama like '%Diasorin%syp%') or (Nama like '%Murex%syp%')) and aktif='1' and jumTest>0");
					while ($jreagen11=mysql_fetch_assoc($jreagen1)) { 
					$nr1=strtoupper($jreagen11[Nama]);
					$merk1=str_replace("SYPHILIS","",$nr1);
					$merk1=str_replace(" ","",$merk1);
					$merk11=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk1'"));
						if ($merk11['nama_reagen']!='') {
						$m_reagen1=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
										where nama_reagen='$merk11[nama_reagen]' and jenis_reagen='Syphilis'"));?>
						<option value="	<?=$jreagen11[kode]?>*<?=$jreagen11[jumTest]?>*<?=$m_reagen1[reaktif]?>*<?=$m_reagen1[nonreaktif]?>*
										<?=$m_reagen1[greyzone]?>*<?=$jreagen11[metode]?>*<?=$jreagen11[noLot]?>*<?=$jreagen11[Nama]?>">
										<?=$jreagen11[Nama]?>-<?=$jreagen11[noLot]?>_<?=$jreagen11[jumTest]?> test
						</option><?
					}
				} ?>
		</select>
		</td>
		<td>
			<table border=0>
			<tr>
				<td>
					<div id='kode3'>
					</div>
				</td>
				<td>
					<div id='b3'>
					</div>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	<h2>Pilih file txt/csv untuk Parameter Syphilis</h2> 
    <input type="file" name="filecsv" id="filecsv" class="swn_button"/>
    <input type="submit" name="button" id="button" value="Proses Import Syphilis" class="swn_button"/>
</form>
<a href="pmiimltd.php?module=import_etimax3000konfirmasi"class="swn_button">Lewatkan</a>
<a href="pmiimltd.php?module=import_etimax3000"class="swn_button">Kembali ke awal</a>
<? }?>
</body>
</html>
