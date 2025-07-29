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

<title>Import hasil IMLTD bioMérieux Davinci Quatro</title>
</head>
<body>
<?php
if (!empty($_FILES["filecsv"]["tmp_name"])) {
	$namafile = $_FILES['filecsv']['tmp_name'];
	$pemisah=",";
	$datacsv = fopen($namafile, "r");
	$add=0;
	$upd=0;
	$cut_off=0.000;
	$reagen=$_POST[reagen0];
	$reag0_ex=explode('*',$reagen);
	$gagalimport=0;
	$kontrolvalid=0;
	$jml=0;
	$r_sampleid=0;$i1=0;
	$r_position=0;$i2=0;
	$r_welllabel=0;$i3=0;
	$r_odresult=0;$i4=0;
	$r_threshold=0;$i5=0;
	$r_ratio=0;$i6=0;
	$assaytitle="";
	$kodeassay="B1";
	$validrow="-";
	$cut_off_row=0;
	
	//Menentukan nomor baris
	while (($data = fgetcsv($datacsv, 150, $pemisah)) !== FALSE){
		$jml++;
		if ($jml==7){
			$assaytitle=str_replace("_par","",$data[1]);
			$kodeassay=substr($data[1], 0, 2);
		}
		if ($kodeassay!=="B1"){break;}
		if ($data[0]=="THRESHOLD RESULTS"){$cut_off_row=$jml+1;}
		if ($jml==$cut_off_row){$cut_off=$data[2];}
		if ($jml==8){$readtime1=$data[1];$readtime2=$data[2];}
		if ($data[0]=="Sample ID"){$r_sampleid=$jml+2;}
		if ($data[0]=="Position"){$r_position=$jml+2;}
		if ($data[0]=="Well Label"){$r_welllabel=$jml+2;}
		if ($data[0]=="OD Results"){$r_odresult=$jml+2;}
		if ($data[0]=="Threshold"){$r_threshold=$jml+2;}
		if ($data[0]=="Ratio"){$r_ratio=$jml+2;}
		if ($r_sampleid>0){
			if (($jml>=$r_sampleid) and ($jml<=$r_sampleid+7)){
				$i1++;
				if ($jml==$r_sampleid){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$ida[1]=$data[1];$ida[2]=$data[2];$ida[3]=$data[3];$ida[4]=$data[4];$ida[5]=$data[5];$ida[6]=$data[6];
					$ida[7]=$data[7];$ida[8]=$data[8];$ida[9]=$data[9];$ida[10]=$data[10];$ida[11]=$data[11];$ida[12]=$data[12];
				}
				if ($jml==$r_sampleid+1){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$idb[1]=$data[1];$idb[2]=$data[2];$idb[3]=$data[3];$idb[4]=$data[4];$idb[5]=$data[5];$idb[6]=$data[6];
					$idb[7]=$data[7];$idb[8]=$data[8];$idb[9]=$data[9];$idb[10]=$data[10];$idb[11]=$data[11];$idb[12]=$data[12];
				}
				if ($jml==$r_sampleid+2){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$idc[1]=$data[1];$idc[2]=$data[2];$idc[3]=$data[3];$idc[4]=$data[4];$idc[5]=$data[5];$idc[6]=$data[6];
					$idc[7]=$data[7];$idc[8]=$data[8];$idc[9]=$data[9];$idc[10]=$data[10];$idc[11]=$data[11];$idc[12]=$data[12];
				}
				if ($jml==$r_sampleid+3){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$idd[1]=$data[1];$idd[2]=$data[2];$idd[3]=$data[3];$idd[4]=$data[4];$idd[5]=$data[5];$idd[6]=$data[6];
					$idd[7]=$data[7];$idd[8]=$data[8];$idd[9]=$data[9];$idd[10]=$data[10];$idd[11]=$data[11];$idd[12]=$data[12];
				}
				if ($jml==$r_sampleid+4){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$ide[1]=$data[1];$ide[2]=$data[2];$ide[3]=$data[3];$ide[4]=$data[4];$ide[5]=$data[5];$ide[6]=$data[6];
					$ide[7]=$data[7];$ide[8]=$data[8];$ide[9]=$data[9];$ide[10]=$data[10];$ide[11]=$data[11];$ide[12]=$data[12];
				}
				if ($jml==$r_sampleid+5){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$idf[1]=$data[1];$idf[2]=$data[2];$idf[3]=$data[3];$idf[4]=$data[4];$idf[5]=$data[5];$idf[6]=$data[6];
					$idf[7]=$data[7];$idf[8]=$data[8];$idf[9]=$data[9];$idf[10]=$data[10];$idf[11]=$data[11];$idf[12]=$data[12];
				}
				if ($jml==$r_sampleid+6){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$idg[1]=$data[1];$idg[2]=$data[2];$idg[3]=$data[3];$idg[4]=$data[4];$idg[5]=$data[5];$idg[6]=$data[6];
					$idg[7]=$data[7];$idg[8]=$data[8];$idg[9]=$data[9];$idg[10]=$data[10];$idg[11]=$data[11];$idg[12]=$data[12];
				}
				if ($jml==$r_sampleid+7){
					$sampleid[$i1]=$data[1];	$sampleid[$i1+8]=$data[2];		$sampleid[$i1+16]=$data[3];
					$sampleid[$i1+24]=$data[4];	$sampleid[$i1+32]=$data[5];		$sampleid[$i1+40]=$data[6];
					$sampleid[$i1+48]=$data[7];	$sampleid[$i1+56]=$data[8];		$sampleid[$i1+64]=$data[9];
					$sampleid[$i1+72]=$data[10];$sampleid[$i1+80]=$data[11];	$sampleid[$i1+88]=$data[12];
					
					$idh[1]=$data[1];$idh[2]=$data[2];$idh[3]=$data[3];$idh[4]=$data[4];$idh[5]=$data[5];$idh[6]=$data[6];
					$idh[7]=$data[7];$idh[8]=$data[8];$idh[9]=$data[9];$idh[10]=$data[10];$idh[11]=$data[11];$idh[12]=$data[12];
				}
			}
		}
		if ($r_position>0){
			if (($jml>=$r_position) and ($jml<=$r_position+7)){
				$i2++;
				if ($jml==$r_position){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posa[1]=$data[1];$posa[2]=$data[2];$posa[3]=$data[3];$posa[4]=$data[4];$posa[5]=$data[5];$posa[6]=$data[6];
					$posa[7]=$data[7];$posa[8]=$data[8];$posa[9]=$data[9];$posa[10]=$data[10];$posa[11]=$data[11];$posa[12]=$data[12];
				}
				if ($jml==$r_position+1){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posb[1]=$data[1];$posb[2]=$data[2];$posb[3]=$data[3];$posb[4]=$data[4];$posb[5]=$data[5];$posb[6]=$data[6];
					$posb[7]=$data[7];$posb[8]=$data[8];$posb[9]=$data[9];$posb[10]=$data[10];$posb[11]=$data[11];$posb[12]=$data[12];
				}
				if ($jml==$r_position+2){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posc[1]=$data[1];$posc[2]=$data[2];$posc[3]=$data[3];$posc[4]=$data[4];$posc[5]=$data[5];$posc[6]=$data[6];
					$posc[7]=$data[7];$posc[8]=$data[8];$posc[9]=$data[9];$posc[10]=$data[10];$posc[11]=$data[11];$posc[12]=$data[12];
				}
				if ($jml==$r_position+3){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posd[1]=$data[1];$posd[2]=$data[2];$posd[3]=$data[3];$posd[4]=$data[4];$posd[5]=$data[5];$posd[6]=$data[6];
					$posd[7]=$data[7];$posd[8]=$data[8];$posd[9]=$data[9];$posd[10]=$data[10];$posd[11]=$data[11];$posd[12]=$data[12];
				}
				if ($jml==$r_position+4){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$pose[1]=$data[1];$pose[2]=$data[2];$pose[3]=$data[3];$pose[4]=$data[4];$pose[5]=$data[5];$pose[6]=$data[6];
					$pose[7]=$data[7];$pose[8]=$data[8];$pose[9]=$data[9];$pose[10]=$data[10];$pose[11]=$data[11];$pose[12]=$data[12];
				}
				if ($jml==$r_position+5){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posf[1]=$data[1];$posf[2]=$data[2];$posf[3]=$data[3];$posf[4]=$data[4];$posf[5]=$data[5];$posf[6]=$data[6];
					$posf[7]=$data[7];$posf[8]=$data[8];$posf[9]=$data[9];$posf[10]=$data[10];$posf[11]=$data[11];$posf[12]=$data[12];
				}
				if ($jml==$r_position+6){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posg[1]=$data[1];$posg[2]=$data[2];$posg[3]=$data[3];$posg[4]=$data[4];$posg[5]=$data[5];$posg[6]=$data[6];
					$posg[7]=$data[7];$posg[8]=$data[8];$posg[9]=$data[9];$posg[10]=$data[10];$posg[11]=$data[11];$posg[12]=$data[12];
				}
				if ($jml==$r_position+7){
					$position[$i2]=$data[1];	$position[$i2+8]=$data[2];		$position[$i2+16]=$data[3];
					$position[$i2+24]=$data[4];	$position[$i2+32]=$data[5];		$position[$i2+40]=$data[6];
					$position[$i2+48]=$data[7];	$position[$i2+56]=$data[8];		$position[$i2+64]=$data[9];
					$position[$i2+72]=$data[10];$position[$i2+80]=$data[11];	$position[$i2+88]=$data[12];
					
					$posh[1]=$data[1];$posh[2]=$data[2];$posh[3]=$data[3];$posh[4]=$data[4];$posh[5]=$data[5];$posh[6]=$data[6];
					$posh[7]=$data[7];$posh[8]=$data[8];$posh[9]=$data[9];$posh[10]=$data[10];$posh[11]=$data[11];$posh[12]=$data[12];
				}
			}
		}
		if ($r_welllabel>0){
			if (($jml>=$r_welllabel) and ($jml<=$r_welllabel+7)){
				$i3++;
				if ($jml==$r_welllabel){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$wela[1]=$data[1];$wela[2]=$data[2];$wela[3]=$data[3];$wela[4]=$data[4];$wela[5]=$data[5];$wela[6]=$data[6];
					$wela[7]=$data[7];$wela[8]=$data[8];$wela[9]=$data[9];$wela[10]=$data[10];$wela[11]=$data[11];$wela[12]=$data[12];
				}
				if ($jml==$r_welllabel+1){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$welb[1]=$data[1];$welb[2]=$data[2];$welb[3]=$data[3];$welb[4]=$data[4];$welb[5]=$data[5];$welb[6]=$data[6];
					$welb[7]=$data[7];$welb[8]=$data[8];$welb[9]=$data[9];$welb[10]=$data[10];$welb[11]=$data[11];$welb[12]=$data[12];
				}
				if ($jml==$r_welllabel+2){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$welc[1]=$data[1];$welc[2]=$data[2];$welc[3]=$data[3];$welc[4]=$data[4];$welc[5]=$data[5];$welc[6]=$data[6];
					$welc[7]=$data[7];$welc[8]=$data[8];$welc[9]=$data[9];$welc[10]=$data[10];$welc[11]=$data[11];$welc[12]=$data[12];
				}
				if ($jml==$r_welllabel+3){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$weld[1]=$data[1];$weld[2]=$data[2];$weld[3]=$data[3];$weld[4]=$data[4];$weld[5]=$data[5];$weld[6]=$data[6];
					$weld[7]=$data[7];$weld[8]=$data[8];$weld[9]=$data[9];$weld[10]=$data[10];$weld[11]=$data[11];$weld[12]=$data[12];
				}
				if ($jml==$r_welllabel+4){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$wele[1]=$data[1];$wele[2]=$data[2];$wele[3]=$data[3];$wele[4]=$data[4];$wele[5]=$data[5];$wele[6]=$data[6];
					$wele[7]=$data[7];$wele[8]=$data[8];$wele[9]=$data[9];$wele[10]=$data[10];$wele[11]=$data[11];$wele[12]=$data[12];
				}
				if ($jml==$r_welllabel+5){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$welf[1]=$data[1];$welf[2]=$data[2];$welf[3]=$data[3];$welf[4]=$data[4];$welf[5]=$data[5];$welf[6]=$data[6];
					$welf[7]=$data[7];$welf[8]=$data[8];$welf[9]=$data[9];$welf[10]=$data[10];$welf[11]=$data[11];$welf[12]=$data[12];
				}
				if ($jml==$r_welllabel+6){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$welg[1]=$data[1];$welg[2]=$data[2];$welg[3]=$data[3];$welg[4]=$data[4];$welg[5]=$data[5];$welg[6]=$data[6];
					$welg[7]=$data[7];$welg[8]=$data[8];$welg[9]=$data[9];$welg[10]=$data[10];$welg[11]=$data[11];$welg[12]=$data[12];
				}
				if ($jml==$r_welllabel+7){
					$welllabel[$i3]=$data[1];	$welllabel[$i3+8]=$data[2];		$welllabel[$i3+16]=$data[3];
					$welllabel[$i3+24]=$data[4];	$welllabel[$i3+32]=$data[5];		$welllabel[$i3+40]=$data[6];
					$welllabel[$i3+48]=$data[7];	$welllabel[$i3+56]=$data[8];		$welllabel[$i3+64]=$data[9];
					$welllabel[$i3+72]=$data[10];$welllabel[$i3+80]=$data[11];	$welllabel[$i3+88]=$data[12];
					
					$welh[1]=$data[1];$welh[2]=$data[2];$welh[3]=$data[3];$welh[4]=$data[4];$welh[5]=$data[5];$welh[6]=$data[6];
					$welh[7]=$data[7];$welh[8]=$data[8];$welh[9]=$data[9];$welh[10]=$data[10];$welh[11]=$data[11];$welh[12]=$data[12];
				}
			}
		}
		if ($r_odresult>0){
			if (($jml>=$r_odresult) and ($jml<=$r_odresult+7)){
				$i4++;
				if ($jml==$r_odresult){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$oda[1]=$data[1];$oda[2]=$data[2];$oda[3]=$data[3];$oda[4]=$data[4];$oda[5]=$data[5];$oda[6]=$data[6];
					$oda[7]=$data[7];$oda[8]=$data[8];$oda[9]=$data[9];$oda[10]=$data[10];$oda[11]=$data[11];$oda[12]=$data[12];
				}
				if ($jml==$r_odresult+1){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$odb[1]=$data[1];$odb[2]=$data[2];$odb[3]=$data[3];$odb[4]=$data[4];$odb[5]=$data[5];$odb[6]=$data[6];
					$odb[7]=$data[7];$odb[8]=$data[8];$odb[9]=$data[9];$odb[10]=$data[10];$odb[11]=$data[11];$odb[12]=$data[12];
				}
				if ($jml==$r_odresult+2){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$odc[1]=$data[1];$odc[2]=$data[2];$odc[3]=$data[3];$odc[4]=$data[4];$odc[5]=$data[5];$odc[6]=$data[6];
					$odc[7]=$data[7];$odc[8]=$data[8];$odc[9]=$data[9];$odc[10]=$data[10];$odc[11]=$data[11];$odc[12]=$data[12];
				}
				if ($jml==$r_odresult+3){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$odd[1]=$data[1];$odd[2]=$data[2];$odd[3]=$data[3];$odd[4]=$data[4];$odd[5]=$data[5];$odd[6]=$data[6];
					$odd[7]=$data[7];$odd[8]=$data[8];$odd[9]=$data[9];$odd[10]=$data[10];$odd[11]=$data[11];$odd[12]=$data[12];
				}
				if ($jml==$r_odresult+4){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$ode[1]=$data[1];$ode[2]=$data[2];$ode[3]=$data[3];$ode[4]=$data[4];$ode[5]=$data[5];$ode[6]=$data[6];
					$ode[7]=$data[7];$ode[8]=$data[8];$ode[9]=$data[9];$ode[10]=$data[10];$ode[11]=$data[11];$ode[12]=$data[12];
				}
				if ($jml==$r_odresult+5){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$odf[1]=$data[1];$odf[2]=$data[2];$odf[3]=$data[3];$odf[4]=$data[4];$odf[5]=$data[5];$odf[6]=$data[6];
					$odf[7]=$data[7];$odf[8]=$data[8];$odf[9]=$data[9];$odf[10]=$data[10];$odf[11]=$data[11];$odf[12]=$data[12];
				}
				if ($jml==$r_odresult+6){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$odg[1]=$data[1];$odg[2]=$data[2];$odg[3]=$data[3];$odg[4]=$data[4];$odg[5]=$data[5];$odg[6]=$data[6];
					$odg[7]=$data[7];$odg[8]=$data[8];$odg[9]=$data[9];$odg[10]=$data[10];$odg[11]=$data[11];$odg[12]=$data[12];
				}
				if ($jml==$r_odresult+7){
					$odresult[$i4]=$data[1];	$odresult[$i4+8]=$data[2];		$odresult[$i4+16]=$data[3];
					$odresult[$i4+24]=$data[4];	$odresult[$i4+32]=$data[5];		$odresult[$i4+40]=$data[6];
					$odresult[$i4+48]=$data[7];	$odresult[$i4+56]=$data[8];		$odresult[$i4+64]=$data[9];
					$odresult[$i4+72]=$data[10];$odresult[$i4+80]=$data[11];	$odresult[$i4+88]=$data[12];
					
					$odh[1]=$data[1];$odh[2]=$data[2];$odh[3]=$data[3];$odh[4]=$data[4];$odh[5]=$data[5];$odh[6]=$data[6];
					$odh[7]=$data[7];$odh[8]=$data[8];$odh[9]=$data[9];$odh[10]=$data[10];$odh[11]=$data[11];$odh[12]=$data[12];
				}
			}
		}
		if ($r_threshold>0){
			if (($jml>=$r_threshold) and ($jml<=$r_threshold+7)){
				$i5++;
				if ($jml==$r_threshold){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$tha[1]=$data[1];$tha[2]=$data[2];$tha[3]=$data[3];$tha[4]=$data[4];$tha[5]=$data[5];$tha[6]=$data[6];
					$tha[7]=$data[7];$tha[8]=$data[8];$tha[9]=$data[9];$tha[10]=$data[10];$tha[11]=$data[11];$tha[12]=$data[12];
				}
				if ($jml==$r_threshold+1){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$thb[1]=$data[1];$thb[2]=$data[2];$thb[3]=$data[3];$thb[4]=$data[4];$thb[5]=$data[5];$thb[6]=$data[6];
					$thb[7]=$data[7];$thb[8]=$data[8];$thb[9]=$data[9];$thb[10]=$data[10];$thb[11]=$data[11];$thb[12]=$data[12];
				}
				if ($jml==$r_threshold+2){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$thc[1]=$data[1];$thc[2]=$data[2];$thc[3]=$data[3];$thc[4]=$data[4];$thc[5]=$data[5];$thc[6]=$data[6];
					$thc[7]=$data[7];$thc[8]=$data[8];$thc[9]=$data[9];$thc[10]=$data[10];$thc[11]=$data[11];$thc[12]=$data[12];
				}
				if ($jml==$r_threshold+3){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$thd[1]=$data[1];$thd[2]=$data[2];$thd[3]=$data[3];$thd[4]=$data[4];$thd[5]=$data[5];$thd[6]=$data[6];
					$thd[7]=$data[7];$thd[8]=$data[8];$thd[9]=$data[9];$thd[10]=$data[10];$thd[11]=$data[11];$thd[12]=$data[12];
				}
				if ($jml==$r_threshold+4){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$the[1]=$data[1];$the[2]=$data[2];$the[3]=$data[3];$the[4]=$data[4];$the[5]=$data[5];$the[6]=$data[6];
					$the[7]=$data[7];$the[8]=$data[8];$the[9]=$data[9];$the[10]=$data[10];$the[11]=$data[11];$the[12]=$data[12];
				}
				if ($jml==$r_threshold+5){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$thf[1]=$data[1];$thf[2]=$data[2];$thf[3]=$data[3];$thf[4]=$data[4];$thf[5]=$data[5];$thf[6]=$data[6];
					$thf[7]=$data[7];$thf[8]=$data[8];$thf[9]=$data[9];$thf[10]=$data[10];$thf[11]=$data[11];$thf[12]=$data[12];
				}
				if ($jml==$r_threshold+6){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$thg[1]=$data[1];$thg[2]=$data[2];$thg[3]=$data[3];$thg[4]=$data[4];$thg[5]=$data[5];$thg[6]=$data[6];
					$thg[7]=$data[7];$thg[8]=$data[8];$thg[9]=$data[9];$thg[10]=$data[10];$thg[11]=$data[11];$thg[12]=$data[12];
				}
				if ($jml==$r_threshold+7){
					$threshold[$i5]=$data[1];	$threshold[$i5+8]=$data[2];		$threshold[$i5+16]=$data[3];
					$threshold[$i5+24]=$data[4];	$threshold[$i5+32]=$data[5];		$threshold[$i5+40]=$data[6];
					$threshold[$i5+48]=$data[7];	$threshold[$i5+56]=$data[8];		$threshold[$i5+64]=$data[9];
					$threshold[$i5+72]=$data[10];$threshold[$i5+80]=$data[11];	$threshold[$i5+88]=$data[12];
					
					$thh[1]=$data[1];$thh[2]=$data[2];$thh[3]=$data[3];$thh[4]=$data[4];$thh[5]=$data[5];$thh[6]=$data[6];
					$thh[7]=$data[7];$thh[8]=$data[8];$thh[9]=$data[9];$thh[10]=$data[10];$thh[11]=$data[11];$thh[12]=$data[12];
				}
			}
		}
		if ($r_ratio>0){
			if (($jml>=$r_ratio) and ($jml<=$r_ratio+7)){
				$i6++;
				if ($jml==$r_ratio){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratioa[1]=$data[1];$ratioa[2]=$data[2];$ratioa[3]=$data[3];$ratioa[4]=$data[4];$ratioa[5]=$data[5];$ratioa[6]=$data[6];
					$ratioa[7]=$data[7];$ratioa[8]=$data[8];$ratioa[9]=$data[9];$ratioa[10]=$data[10];$ratioa[11]=$data[11];$ratioa[12]=$data[12];
				}
				if ($jml==$r_ratio+1){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratiob[1]=$data[1];$ratiob[2]=$data[2];$ratiob[3]=$data[3];$ratiob[4]=$data[4];$ratiob[5]=$data[5];$ratiob[6]=$data[6];
					$ratiob[7]=$data[7];$ratiob[8]=$data[8];$ratiob[9]=$data[9];$ratiob[10]=$data[10];$ratiob[11]=$data[11];$ratiob[12]=$data[12];
				}
				if ($jml==$r_ratio+2){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratioc[1]=$data[1];$ratioc[2]=$data[2];$ratioc[3]=$data[3];$ratioc[4]=$data[4];$ratioc[5]=$data[5];$ratioc[6]=$data[6];
					$ratioc[7]=$data[7];$ratioc[8]=$data[8];$ratioc[9]=$data[9];$ratioc[10]=$data[10];$ratioc[11]=$data[11];$ratioc[12]=$data[12];
				}
				if ($jml==$r_ratio+3){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratiod[1]=$data[1];$ratiod[2]=$data[2];$ratiod[3]=$data[3];$ratiod[4]=$data[4];$ratiod[5]=$data[5];$ratiod[6]=$data[6];
					$ratiod[7]=$data[7];$ratiod[8]=$data[8];$ratiod[9]=$data[9];$ratiod[10]=$data[10];$ratiod[11]=$data[11];$ratiod[12]=$data[12];
				}
				if ($jml==$r_ratio+4){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratioe[1]=$data[1];$ratioe[2]=$data[2];$ratioe[3]=$data[3];$ratioe[4]=$data[4];$ratioe[5]=$data[5];$ratioe[6]=$data[6];
					$ratioe[7]=$data[7];$ratioe[8]=$data[8];$ratioe[9]=$data[9];$ratioe[10]=$data[10];$ratioe[11]=$data[11];$ratioe[12]=$data[12];
				}
				if ($jml==$r_ratio+5){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratiof[1]=$data[1];$ratiof[2]=$data[2];$ratiof[3]=$data[3];$ratiof[4]=$data[4];$ratiof[5]=$data[5];$ratiof[6]=$data[6];
					$ratiof[7]=$data[7];$ratiof[8]=$data[8];$ratiof[9]=$data[9];$ratiof[10]=$data[10];$ratiof[11]=$data[11];$ratiof[12]=$data[12];
				}
				if ($jml==$r_ratio+6){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratiog[1]=$data[1];$ratiog[2]=$data[2];$ratiog[3]=$data[3];$ratiog[4]=$data[4];$ratiog[5]=$data[5];$ratiog[6]=$data[6];
					$ratiog[7]=$data[7];$ratiog[8]=$data[8];$ratiog[9]=$data[9];$ratiog[10]=$data[10];$ratiog[11]=$data[11];$ratiog[12]=$data[12];
				}
				if ($jml==$r_ratio+7){
					$ratio[$i6]=$data[1];	$ratio[$i6+8]=$data[2];		$ratio[$i6+16]=$data[3];
					$ratio[$i6+24]=$data[4];	$ratio[$i6+32]=$data[5];		$ratio[$i6+40]=$data[6];
					$ratio[$i6+48]=$data[7];	$ratio[$i6+56]=$data[8];		$ratio[$i6+64]=$data[9];
					$ratio[$i6+72]=$data[10];$ratio[$i6+80]=$data[11];	$ratio[$i6+88]=$data[12];
					
					$ratioh[1]=$data[1];$ratioh[2]=$data[2];$ratioh[3]=$data[3];$ratioh[4]=$data[4];$ratioh[5]=$data[5];$ratioh[6]=$data[6];
					$ratioh[7]=$data[7];$ratioh[8]=$data[8];$ratioh[9]=$data[9];$ratioh[10]=$data[10];$ratioh[11]=$data[11];$ratioh[12]=$data[12];
				}
			}
		}
		
	}
	fclose($datacsv);
if ($kodeassay=="B1"){
	?>
	<font size=4 color="black"><b>Parameter : <?=$assaytitle?></b></font><br>
	<font size=3 color="black">Tanggal Pembacaan : <?=$readtime1?>, <?=$readtime2?></font><br>
	<font size=3 color="black">Cut-off : <?=$cut_off?></font><br>
	<a name="atas"></a><a href="#bawah" class="swn_button_blue">Ke bawah</a><br>
	<font size=2 color="red"><b>POSISI PLATE</b></font><br>
	<table class="list" border="1" cellpadding="2" cellspacing="1">
		<tr align="center" class="field">
			<td width="7%"></td>
			<td width="7%">1</td><td width="7%">2</td><td width="7%">3</td><td width="7%">4</td><td width="7%">5</td><td width="7%">6</td>
			<td width="7%">7</td><td width="7%">8</td><td width="7%">9</td><td width="7%">10</td><td width="7%">11</td><td width="7%">12</td>
		</tr>
		<tr class="record">
			<td>A</td>
			<td><?=$ida[1]?> <br><?=$posa[1]?> <br><?=$wela[1]?> <br><?=$oda[1]?> <br><?=$tha[1]?> <br><?=$ratioa[1]?></td>
			<td><?=$ida[2]?> <br><?=$posa[2]?> <br><?=$wela[2]?> <br><?=$oda[2]?> <br><?=$tha[2]?> <br><?=$ratioa[2]?></td>
			<td><?=$ida[3]?> <br><?=$posa[3]?> <br><?=$wela[3]?> <br><?=$oda[3]?> <br><?=$tha[3]?> <br><?=$ratioa[3]?></td>
			<td><?=$ida[4]?> <br><?=$posa[4]?> <br><?=$wela[4]?> <br><?=$oda[4]?> <br><?=$tha[4]?> <br><?=$ratioa[4]?></td>
			<td><?=$ida[5]?> <br><?=$posa[5]?> <br><?=$wela[5]?> <br><?=$oda[5]?> <br><?=$tha[5]?> <br><?=$ratioa[5]?></td>
			<td><?=$ida[6]?> <br><?=$posa[6]?> <br><?=$wela[6]?> <br><?=$oda[6]?> <br><?=$tha[6]?> <br><?=$ratioa[6]?></td>
			<td><?=$ida[7]?> <br><?=$posa[7]?> <br><?=$wela[7]?> <br><?=$oda[7]?> <br><?=$tha[7]?> <br><?=$ratioa[7]?></td>
			<td><?=$ida[8]?> <br><?=$posa[8]?> <br><?=$wela[8]?> <br><?=$oda[8]?> <br><?=$tha[8]?> <br><?=$ratioa[8]?></td>
			<td><?=$ida[9]?> <br><?=$posa[9]?> <br><?=$wela[9]?> <br><?=$oda[9]?> <br><?=$tha[9]?> <br><?=$ratioa[9]?></td>
			<td><?=$ida[10]?><br><?=$posa[10]?><br><?=$wela[10]?><br><?=$oda[10]?><br><?=$tha[10]?><br><?=$ratioa[10]?></td>
			<td><?=$ida[11]?><br><?=$posa[11]?><br><?=$wela[11]?><br><?=$oda[11]?><br><?=$tha[11]?><br><?=$ratioa[11]?></td>
			<td><?=$ida[12]?><br><?=$posa[12]?><br><?=$wela[12]?><br><?=$oda[12]?><br><?=$tha[12]?><br><?=$ratioa[12]?></td>
		</tr>
		<tr class="record">
			<td>B</td>
			<td><?=$idb[1]?> <br><?=$posb[1]?> <br><?=$welb[1]?> <br><?=$odb[1]?> <br><?=$thb[1]?> <br><?=$ratiob[1]?></td>
			<td><?=$idb[2]?> <br><?=$posb[2]?> <br><?=$welb[2]?> <br><?=$odb[2]?> <br><?=$thb[2]?> <br><?=$ratiob[2]?></td>
			<td><?=$idb[3]?> <br><?=$posb[3]?> <br><?=$welb[3]?> <br><?=$odb[3]?> <br><?=$thb[3]?> <br><?=$ratiob[3]?></td>
			<td><?=$idb[4]?> <br><?=$posb[4]?> <br><?=$welb[4]?> <br><?=$odb[4]?> <br><?=$thb[4]?> <br><?=$ratiob[4]?></td>
			<td><?=$idb[5]?> <br><?=$posb[5]?> <br><?=$welb[5]?> <br><?=$odb[5]?> <br><?=$thb[5]?> <br><?=$ratiob[5]?></td>
			<td><?=$idb[6]?> <br><?=$posb[6]?> <br><?=$welb[6]?> <br><?=$odb[6]?> <br><?=$thb[6]?> <br><?=$ratiob[6]?></td>
			<td><?=$idb[7]?> <br><?=$posb[7]?> <br><?=$welb[7]?> <br><?=$odb[7]?> <br><?=$thb[7]?> <br><?=$ratiob[7]?></td>
			<td><?=$idb[8]?> <br><?=$posb[8]?> <br><?=$welb[8]?> <br><?=$odb[8]?> <br><?=$thb[8]?> <br><?=$ratiob[8]?></td>
			<td><?=$idb[9]?> <br><?=$posb[9]?> <br><?=$welb[9]?> <br><?=$odb[9]?> <br><?=$thb[9]?> <br><?=$ratiob[9]?></td>
			<td><?=$idb[10]?><br><?=$posb[10]?><br><?=$welb[10]?><br><?=$odb[10]?><br><?=$thb[10]?><br><?=$ratiob[10]?></td>
			<td><?=$idb[11]?><br><?=$posb[11]?><br><?=$welb[11]?><br><?=$odb[11]?><br><?=$thb[11]?><br><?=$ratiob[11]?></td>
			<td><?=$idb[12]?><br><?=$posb[12]?><br><?=$welb[12]?><br><?=$odb[12]?><br><?=$thb[12]?><br><?=$ratiob[12]?></td>
		</tr>
		<tr class="record">
			<td>C</td>
			<td><?=$idc[1]?> <br><?=$posc[1]?> <br><?=$welc[1]?> <br><?=$odc[1]?> <br><?=$thc[1]?> <br><?=$ratioc[1]?></td>
			<td><?=$idc[2]?> <br><?=$posc[2]?> <br><?=$welc[2]?> <br><?=$odc[2]?> <br><?=$thc[2]?> <br><?=$ratioc[2]?></td>
			<td><?=$idc[3]?> <br><?=$posc[3]?> <br><?=$welc[3]?> <br><?=$odc[3]?> <br><?=$thc[3]?> <br><?=$ratioc[3]?></td>
			<td><?=$idc[4]?> <br><?=$posc[4]?> <br><?=$welc[4]?> <br><?=$odc[4]?> <br><?=$thc[4]?> <br><?=$ratioc[4]?></td>
			<td><?=$idc[5]?> <br><?=$posc[5]?> <br><?=$welc[5]?> <br><?=$odc[5]?> <br><?=$thc[5]?> <br><?=$ratioc[5]?></td>
			<td><?=$idc[6]?> <br><?=$posc[6]?> <br><?=$welc[6]?> <br><?=$odc[6]?> <br><?=$thc[6]?> <br><?=$ratioc[6]?></td>
			<td><?=$idc[7]?> <br><?=$posc[7]?> <br><?=$welc[7]?> <br><?=$odc[7]?> <br><?=$thc[7]?> <br><?=$ratioc[7]?></td>
			<td><?=$idc[8]?> <br><?=$posc[8]?> <br><?=$welc[8]?> <br><?=$odc[8]?> <br><?=$thc[8]?> <br><?=$ratioc[8]?></td>
			<td><?=$idc[9]?> <br><?=$posc[9]?> <br><?=$welc[9]?> <br><?=$odc[9]?> <br><?=$thc[9]?> <br><?=$ratioc[9]?></td>
			<td><?=$idc[10]?><br><?=$posc[10]?><br><?=$welc[10]?><br><?=$odc[10]?><br><?=$thc[10]?><br><?=$ratioc[10]?></td>
			<td><?=$idc[11]?><br><?=$posc[11]?><br><?=$welc[11]?><br><?=$odc[11]?><br><?=$thc[11]?><br><?=$ratioc[11]?></td>
			<td><?=$idc[12]?><br><?=$posc[12]?><br><?=$welc[12]?><br><?=$odc[12]?><br><?=$thc[12]?><br><?=$ratioc[12]?></td>
		</tr>
		<tr class="record">
			<td>D</td>
			<td><?=$idd[1]?> <br><?=$posd[1]?> <br><?=$weld[1]?> <br><?=$odd[1]?> <br><?=$thd[1]?> <br><?=$ratiod[1]?></td>
			<td><?=$idd[2]?> <br><?=$posd[2]?> <br><?=$weld[2]?> <br><?=$odd[2]?> <br><?=$thd[2]?> <br><?=$ratiod[2]?></td>
			<td><?=$idd[3]?> <br><?=$posd[3]?> <br><?=$weld[3]?> <br><?=$odd[3]?> <br><?=$thd[3]?> <br><?=$ratiod[3]?></td>
			<td><?=$idd[4]?> <br><?=$posd[4]?> <br><?=$weld[4]?> <br><?=$odd[4]?> <br><?=$thd[4]?> <br><?=$ratiod[4]?></td>
			<td><?=$idd[5]?> <br><?=$posd[5]?> <br><?=$weld[5]?> <br><?=$odd[5]?> <br><?=$thd[5]?> <br><?=$ratiod[5]?></td>
			<td><?=$idd[6]?> <br><?=$posd[6]?> <br><?=$weld[6]?> <br><?=$odd[6]?> <br><?=$thd[6]?> <br><?=$ratiod[6]?></td>
			<td><?=$idd[7]?> <br><?=$posd[7]?> <br><?=$weld[7]?> <br><?=$odd[7]?> <br><?=$thd[7]?> <br><?=$ratiod[7]?></td>
			<td><?=$idd[8]?> <br><?=$posd[8]?> <br><?=$weld[8]?> <br><?=$odd[8]?> <br><?=$thd[8]?> <br><?=$ratiod[8]?></td>
			<td><?=$idd[9]?> <br><?=$posd[9]?> <br><?=$weld[9]?> <br><?=$odd[9]?> <br><?=$thd[9]?> <br><?=$ratiod[9]?></td>
			<td><?=$idd[10]?><br><?=$posd[10]?><br><?=$weld[10]?><br><?=$odd[10]?><br><?=$thd[10]?><br><?=$ratiod[10]?></td>
			<td><?=$idd[11]?><br><?=$posd[11]?><br><?=$weld[11]?><br><?=$odd[11]?><br><?=$thd[11]?><br><?=$ratiod[11]?></td>
			<td><?=$idd[12]?><br><?=$posd[12]?><br><?=$weld[12]?><br><?=$odd[12]?><br><?=$thd[12]?><br><?=$ratiod[12]?></td>
		</tr>
		<tr class="record">
			<td>E</td>
			<td><?=$ide[1]?> <br><?=$pose[1]?> <br><?=$wele[1]?> <br><?=$ode[1]?> <br><?=$the[1]?> <br><?=$ratioe[1]?></td>
			<td><?=$ide[2]?> <br><?=$pose[2]?> <br><?=$wele[2]?> <br><?=$ode[2]?> <br><?=$the[2]?> <br><?=$ratioe[2]?></td>
			<td><?=$ide[3]?> <br><?=$pose[3]?> <br><?=$wele[3]?> <br><?=$ode[3]?> <br><?=$the[3]?> <br><?=$ratioe[3]?></td>
			<td><?=$ide[4]?> <br><?=$pose[4]?> <br><?=$wele[4]?> <br><?=$ode[4]?> <br><?=$the[4]?> <br><?=$ratioe[4]?></td>
			<td><?=$ide[5]?> <br><?=$pose[5]?> <br><?=$wele[5]?> <br><?=$ode[5]?> <br><?=$the[5]?> <br><?=$ratioe[5]?></td>
			<td><?=$ide[6]?> <br><?=$pose[6]?> <br><?=$wele[6]?> <br><?=$ode[6]?> <br><?=$the[6]?> <br><?=$ratioe[6]?></td>
			<td><?=$ide[7]?> <br><?=$pose[7]?> <br><?=$wele[7]?> <br><?=$ode[7]?> <br><?=$the[7]?> <br><?=$ratioe[7]?></td>
			<td><?=$ide[8]?> <br><?=$pose[8]?> <br><?=$wele[8]?> <br><?=$ode[8]?> <br><?=$the[8]?> <br><?=$ratioe[8]?></td>
			<td><?=$ide[9]?> <br><?=$pose[9]?> <br><?=$wele[9]?> <br><?=$ode[9]?> <br><?=$the[9]?> <br><?=$ratioe[9]?></td>
			<td><?=$ide[10]?><br><?=$pose[10]?><br><?=$wele[10]?><br><?=$ode[10]?><br><?=$the[10]?><br><?=$ratioe[10]?></td>
			<td><?=$ide[11]?><br><?=$pose[11]?><br><?=$wele[11]?><br><?=$ode[11]?><br><?=$the[11]?><br><?=$ratioe[11]?></td>
			<td><?=$ide[12]?><br><?=$pose[12]?><br><?=$wele[12]?><br><?=$ode[12]?><br><?=$the[12]?><br><?=$ratioe[12]?></td>
		</tr>
		<tr class="record">
			<td>F</td>
			<td><?=$idf[1]?> <br><?=$posf[1]?> <br><?=$welf[1]?> <br><?=$odf[1]?> <br><?=$thf[1]?> <br><?=$ratiof[1]?></td>
			<td><?=$idf[2]?> <br><?=$posf[2]?> <br><?=$welf[2]?> <br><?=$odf[2]?> <br><?=$thf[2]?> <br><?=$ratiof[2]?></td>
			<td><?=$idf[3]?> <br><?=$posf[3]?> <br><?=$welf[3]?> <br><?=$odf[3]?> <br><?=$thf[3]?> <br><?=$ratiof[3]?></td>
			<td><?=$idf[4]?> <br><?=$posf[4]?> <br><?=$welf[4]?> <br><?=$odf[4]?> <br><?=$thf[4]?> <br><?=$ratiof[4]?></td>
			<td><?=$idf[5]?> <br><?=$posf[5]?> <br><?=$welf[5]?> <br><?=$odf[5]?> <br><?=$thf[5]?> <br><?=$ratiof[5]?></td>
			<td><?=$idf[6]?> <br><?=$posf[6]?> <br><?=$welf[6]?> <br><?=$odf[6]?> <br><?=$thf[6]?> <br><?=$ratiof[6]?></td>
			<td><?=$idf[7]?> <br><?=$posf[7]?> <br><?=$welf[7]?> <br><?=$odf[7]?> <br><?=$thf[7]?> <br><?=$ratiof[7]?></td>
			<td><?=$idf[8]?> <br><?=$posf[8]?> <br><?=$welf[8]?> <br><?=$odf[8]?> <br><?=$thf[8]?> <br><?=$ratiof[8]?></td>
			<td><?=$idf[9]?> <br><?=$posf[9]?> <br><?=$welf[9]?> <br><?=$odf[9]?> <br><?=$thf[9]?> <br><?=$ratiof[9]?></td>
			<td><?=$idf[10]?><br><?=$posf[10]?><br><?=$welf[10]?><br><?=$odf[10]?><br><?=$thf[10]?><br><?=$ratiof[10]?></td>
			<td><?=$idf[11]?><br><?=$posf[11]?><br><?=$welf[11]?><br><?=$odf[11]?><br><?=$thf[11]?><br><?=$ratiof[11]?></td>
			<td><?=$idf[12]?><br><?=$posf[12]?><br><?=$welf[12]?><br><?=$odf[12]?><br><?=$thf[12]?><br><?=$ratiof[12]?></td>
		</tr>
		<tr class="record">
			<td>G</td>
			<td><?=$idg[1]?> <br><?=$posg[1]?> <br><?=$welg[1]?> <br><?=$odg[1]?> <br><?=$thg[1]?> <br><?=$ratiog[1]?></td>
			<td><?=$idg[2]?> <br><?=$posg[2]?> <br><?=$welg[2]?> <br><?=$odg[2]?> <br><?=$thg[2]?> <br><?=$ratiog[2]?></td>
			<td><?=$idg[3]?> <br><?=$posg[3]?> <br><?=$welg[3]?> <br><?=$odg[3]?> <br><?=$thg[3]?> <br><?=$ratiog[3]?></td>
			<td><?=$idg[4]?> <br><?=$posg[4]?> <br><?=$welg[4]?> <br><?=$odg[4]?> <br><?=$thg[4]?> <br><?=$ratiog[4]?></td>
			<td><?=$idg[5]?> <br><?=$posg[5]?> <br><?=$welg[5]?> <br><?=$odg[5]?> <br><?=$thg[5]?> <br><?=$ratiog[5]?></td>
			<td><?=$idg[6]?> <br><?=$posg[6]?> <br><?=$welg[6]?> <br><?=$odg[6]?> <br><?=$thg[6]?> <br><?=$ratiog[6]?></td>
			<td><?=$idg[7]?> <br><?=$posg[7]?> <br><?=$welg[7]?> <br><?=$odg[7]?> <br><?=$thg[7]?> <br><?=$ratiog[7]?></td>
			<td><?=$idg[8]?> <br><?=$posg[8]?> <br><?=$welg[8]?> <br><?=$odg[8]?> <br><?=$thg[8]?> <br><?=$ratiog[8]?></td>
			<td><?=$idg[9]?> <br><?=$posg[9]?> <br><?=$welg[9]?> <br><?=$odg[9]?> <br><?=$thg[9]?> <br><?=$ratiog[9]?></td>
			<td><?=$idg[10]?><br><?=$posg[10]?><br><?=$welg[10]?><br><?=$odg[10]?><br><?=$thg[10]?><br><?=$ratiog[10]?></td>
			<td><?=$idg[11]?><br><?=$posg[11]?><br><?=$welg[11]?><br><?=$odg[11]?><br><?=$thg[11]?><br><?=$ratiog[11]?></td>
			<td><?=$idg[12]?><br><?=$posg[12]?><br><?=$welg[12]?><br><?=$odg[12]?><br><?=$thg[12]?><br><?=$ratiog[12]?></td>
		</tr>
		<tr class="record">
			<td>H</td>
			<td><?=$idh[1]?> <br><?=$posh[1]?> <br><?=$welh[1]?> <br><?=$odh[1]?> <br><?=$thh[1]?> <br><?=$ratioh[1]?></td>
			<td><?=$idh[2]?> <br><?=$posh[2]?> <br><?=$welh[2]?> <br><?=$odh[2]?> <br><?=$thh[2]?> <br><?=$ratioh[2]?></td>
			<td><?=$idh[3]?> <br><?=$posh[3]?> <br><?=$welh[3]?> <br><?=$odh[3]?> <br><?=$thh[3]?> <br><?=$ratioh[3]?></td>
			<td><?=$idh[4]?> <br><?=$posh[4]?> <br><?=$welh[4]?> <br><?=$odh[4]?> <br><?=$thh[4]?> <br><?=$ratioh[4]?></td>
			<td><?=$idh[5]?> <br><?=$posh[5]?> <br><?=$welh[5]?> <br><?=$odh[5]?> <br><?=$thh[5]?> <br><?=$ratioh[5]?></td>
			<td><?=$idh[6]?> <br><?=$posh[6]?> <br><?=$welh[6]?> <br><?=$odh[6]?> <br><?=$thh[6]?> <br><?=$ratioh[6]?></td>
			<td><?=$idh[7]?> <br><?=$posh[7]?> <br><?=$welh[7]?> <br><?=$odh[7]?> <br><?=$thh[7]?> <br><?=$ratioh[7]?></td>
			<td><?=$idh[8]?> <br><?=$posh[8]?> <br><?=$welh[8]?> <br><?=$odh[8]?> <br><?=$thh[8]?> <br><?=$ratioh[8]?></td>
			<td><?=$idh[9]?> <br><?=$posh[9]?> <br><?=$welh[9]?> <br><?=$odh[9]?> <br><?=$thh[9]?> <br><?=$ratioh[9]?></td>
			<td><?=$idh[10]?><br><?=$posh[10]?><br><?=$welh[10]?><br><?=$odh[10]?><br><?=$thh[10]?><br><?=$ratioh[10]?></td>
			<td><?=$idh[11]?><br><?=$posh[11]?><br><?=$welh[11]?><br><?=$odh[11]?><br><?=$thh[11]?><br><?=$ratioh[11]?></td>
			<td><?=$idh[12]?><br><?=$posh[12]?><br><?=$welh[12]?><br><?=$odh[12]?><br><?=$thh[12]?><br><?=$ratioh[12]?></td>
		</tr>
	</table>
	<?$nomor=0;?>
	<br>
	<font size=4 color="red"><b>POSISI KOLOM</b></font><br>
	<table class="list" border="1" cellpadding="2" cellspacing="1">
		<tr class="field">
			<td>Nomor</td>
			<td>Sample ID</td>
			<td>Position</td>
			<td>Well Label</td>
			<td>OD Result</td>
			<td>Threshold</td>
			<td>Ratio</td>
			<td>Valid Result</td>
		</tr>
		<?php
		for ($z=0;$z<96;$z++){
			$nomor++;
			if ((strlen($sampleid[$nomor])!==0) and ($sampleid[$nomor]!=="NC1") and ($sampleid[$nomor]!=="PC1")){
				$tanggal=date("Y-m-d");
				//check apakah sudah ada nokantong
				$query ="SELECT nokantong from imltd_import_temp WHERE nokantong='$sampleid[$nomor]' limit 1";
				$qry_result	= mysql_query($query) or die(mysql_error());
				$row		= mysql_fetch_assoc($qry_result);
				$ktg       	= strlen($row[nokantong]);
				if (($sampleid[$nomor]!=="") and ($threshold[$nomor]!=="*")){
					if ($threshold[$nomor]=="React"){$hasiltmp="Reaktif";}else{$hasiltmp="Non Reaktif";}
					if ($ktg==0){
						$sql="insert into imltd_import_temp (tanggal,    nokantong,          hbsag_cut_off, hbsag_reader,        hbsag_result,           hbsag_od,        reagen_hbsag,   hbsag_metode)
													  values('$tanggal', '$sampleid[$nomor]','$cut_off',    '$odresult[$nomor]', '$hasiltmp',   '$ratio[$nomor]', '$reag0_ex[0]', '$reag0_ex[5]')";
						$tambah=mysql_query($sql,$con);
						$add++;
					}else{
						$sql=	"update imltd_import_temp set tanggal = '$tanggal', hbsag_cut_off = '$cut_off', hbsag_reader= '$odresult[$nomor]',
								hbsag_result	= '$hasiltmp', hbsag_od = '$ratio[$nomor]', reagen_hbsag = '$reag0_ex[0]',
								hbsag_metode	= '$reag0_ex[5]' WHERE nokantong = '$sampleid[$nomor]'";
						$tambah=mysql_query($sql,$con);
						$upd++;
					}
				}
			}
			echo "<tr class='record'>";
			echo "<td>$nomor </td>";
			echo "<td>$sampleid[$nomor] </td>";
			echo "<td>$position[$nomor] </td>";
			echo "<td>$welllabel[$nomor] </td>";
			echo "<td>$odresult[$nomor] </td>";
			if ($threshold[$nomor]=="React"){
				echo "<td><b>$threshold[$nomor]</b> </td>";
			}else{
				echo "<td>$threshold[$nomor] </td>";
			}
			echo "<td>$ratio[$nomor] </td>";
			if ($threshold[$nomor]=="*"){
				echo "<td>Invalid</td>";
			}else{
				echo "<td>-</td>";
			}
			echo "</tr>";
		}
		?>
		<tr class="field">
			<td colspan=9><?=$add?> data ditambahkan<br><?=$upd?> diupdate.</td>
		</tr>
	</table>
	
	<a href="pmiimltd.php?module=import_davincihcv"class="swn_button_blue">Lanjut ke Anti-HCV</a>
	<a href="pmiimltd.php?module=import_davincikonfirmasi"class="swn_button_blue">Konfirmasi hasil</a>
	<a href="pmiimltd.php?module=import_davinci"class="swn_button_blue">Kembali ke awal</a>
	<a name="bawah"></a><a href="#atas" class="swn_button_blue">Ke Atas</a>
<?
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('File tidak bisa diimport. Bukan Parameter HBsAg. Pastikan file yang dipilih adalah parameter HBsAg!!!!')
		window.location.href='pmiimltd.php?module=import_davinci';
    </SCRIPT>");
}
} else{?>
<form action="" method="post" enctype="multipart/form-data" name="UploadCSV" id="UploadCSV">
	<font size=6 color="blue"><b>Parameter HBsAg</b></font><br>
	<table class="list" border="1" cellpadding="2" cellspacing="1">
		<tr align="center" class="field">
			<td>Pilih Reagen Biomerieux HBsAg
			<select name="reagen0" id="reagen0" onChange="show0(0)" STYLE="width: 300px">
				<option value="">Pilih reagen Biomerieux HBsAg</option>
				<? 
				$jreagen1=mysql_query("select * from reagen where ((Nama like '%Biomerieux%HBsAg%') or (Nama like '%Biomerieux%HBsAg%')) and aktif='1' and jumTest>0");
				while ($jreagen11=mysql_fetch_assoc($jreagen1)) { 
					$nr1=strtoupper($jreagen11[Nama]);
					$merk1=str_replace("HBSAG","",$nr1);
					$merk1=str_replace(" ","",$merk1);
					$merk11=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk1'"));
					if ($merk11['nama_reagen']!='') {
						$m_reagen1=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
										where nama_reagen='$merk11[nama_reagen]' and jenis_reagen='HBsAg'"));?>
						<option value="	<?=$jreagen11[kode]?>*<?=$jreagen11[jumTest]?>*<?=$m_reagen1[reaktif]?>*<?=$m_reagen1[nonreaktif]?>*
										<?=$m_reagen1[greyzone]?>*<?=$jreagen11[metode]?>*<?=$jreagen11[noLot]?>*<?=$jreagen11[Nama]?>">
										<?=$jreagen11[Nama]?>-<?=$jreagen11[noLot]?>_<?=$jreagen11[jumTest]?> test
				</option><?
				}
				} ?>
			</select>
			<td><div id='kode0'></div></td>
			<td><div id='b0'></div></td>
	</tr>
	</table>
	<font size=4 color="black"><b>Pilih File CSV</b></font><br>
    <input type="file" name="filecsv" id="filecsv" class="swn_button_blue" />
    <input type="submit" name="button" id="button" value="Proses Import HBsAg" class="swn_button_blue"/>
</form>
<a href="pmiimltd.php?module=import_davincihcv"class="swn_button_blue">Lewatkan</a>
<a href="pmiimltd.php?module=import_davinci"class="swn_button_blue">Kembali ke awal</a>
<? }?>
</body>
</html>
