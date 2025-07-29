<link rel="stylesheet" type="text/css" href="css/blitzer/jquery-ui-1.8.2.custom.css">

<style type="text/css">
fieldset{background-color: #ededed;border: 1px solid;}
legend{background-color: #ffffff;color: #cccccc;padding:5px;}
h1,h2,p,form {padding: 5px;}
h1,h2{font-size: 18px; color: #666666;}
legend,label,#dialog-email,#TB-email{font-weight:bold;margin-left: 10px;}
.container {width: 50%;margin-left: 25%;margin-top:2%;background: #ffffff;border: 4px solid #cccccc;}
.ui-dialog {font-size: 90%;}
form#hasillab fieldset{border-color: #ce0c0c;}
form#hasillab legend{background-color: #ce0c0c;}
.message {color: maroon;}
</style>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script language=javascript src="js/elisa.js" type="text/javascript"> </script>
<script language=javascript src="js/konfirmasi_elisa.js" type="text/javascript"> </script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<script language="javascript">
jum_select=0;
function setFocus(){document.hasillab.nokantong.focus();}
function show0(id){
	var campur = document.getElementById('reagen'+id).value;
	var jumtest = campur.split('*');
	if (id=='0') document.getElementById('b'+id).innerHTML=jumtest[5]+' -  HBsAg';
	if (id=='1') document.getElementById('b'+id).innerHTML=jumtest[5]+' -  HCV';
	if (id=='2') document.getElementById('b'+id).innerHTML=jumtest[5]+' -  HIV';
	if (id=='3') document.getElementById('b'+id).innerHTML=jumtest[5]+' -  Syphilis';
	document.getElementById('jt'+id).value=jumtest[1];
	document.getElementById('jt'+id+'1').innerHTML = "JT("+jumtest[1]+")";
	if (jumtest[5]=='elisa') {
		document.getElementById('co'+id+'1').innerHTML = "Cut Off";
		document.getElementById('co'+id).type = "text";
		document.getElementById('r'+id).value=jumtest[2];
		document.getElementById('r'+id+'1').innerHTML = "R("+jumtest[2]+")";
		document.getElementById('nr'+id).value=jumtest[3];
		document.getElementById('nr'+id+'1').innerHTML = "NR("+jumtest[3]+")";
		document.getElementById('gz'+id).value=jumtest[4];
		document.getElementById('gz'+id+'1').innerHTML = "GZ("+jumtest[4]+")";
	} else {
		document.getElementById('co'+id+'1').innerHTML = "";
		document.getElementById('co'+id).type = "hidden";
		document.getElementById('r'+id+'1').innerHTML ='';
		document.getElementById('nr'+id+'1').innerHTML ='';
		document.getElementById('gz'+id+'1').innerHTML ='';
	}
	document.getElementById('imltd'+id).value=jumtest[5];
	jum_select=jum_select+id;
	if (jum_select==6){
		document.getElementById('nokantong0').innerHTML = "No Kantong :";
		document.getElementById('nokantong').type = "text";
		jum_select=0;
		}
} 
</script>

<?
include('config/db_connect.php');
require_once("modul/background_process.php");

$namauser=$_SESSION[namauser];
$today=date("Y-m-d");
?>
<?php if (isset($_POST['submit'])){
    //print_r($_POST);
	$reag0=$_POST[reagen0];
	$reag0_ex=explode('*',$reag0);
	$reag1=$_POST[reagen1];
	$reag1_ex=explode('*',$reag1);
	$reag2=$_POST[reagen2];
	$reag2_ex=explode('*',$reag2);
	$reag3=$_POST[reagen3];
	$reag3_ex=explode('*',$reag3);
	
	//--update jumlah test untuk masing-masing reagen----
	$jum_rgn=mysql_query("update reagen set jumTest='$_POST[jt0]' where kode='$reag0_ex[0]'");
	$jum_rgn1=mysql_query("update reagen set jumTest='$_POST[jt1]' where kode='$reag1_ex[0]'");
	$jum_rgn2=mysql_query("update reagen set jumTest='$_POST[jt2]' where kode='$reag2_ex[0]'");
	$jum_rgn3=mysql_query("update reagen set jumTest='$_POST[jt3]' where kode='$reag3_ex[0]'");
	
	$ngz=0;
	$nsehat=0;
	$nrusak=0;	
	
    for($j=0;$j<4;$j++){
        $co	=$_POST['co'.$j];
        $rg0=$_POST['reagen'.$j];
        $rg1=explode('*',$rg0);
        $rg	=$rg1[0];	//kode reagen
		if ($rg!='') {
			$metode=$rg1[5];
			for($i=0;$i<$_POST[jum_kantong];$i++){
				//---Input dari form-------
				$nkt=$_POST['box-table-b'.$j.'no_kantong'.$i];
				$njt=$_POST['box-table-b'.$j.'jenis_test'.$i];
				$od=$_POST['box-table-b'.$j.'od'.$i];
				$hs=$_POST['box-table-b'.$j.'hs'.$i];
				if ($metode=='rapid') $hs=$od;
				$od=str_replace(',','.',$od);
				$ngd=$_POST['box-table-b'.$j.'gol_darah'.$i];
				//$nrd=$_POST['box-table-b'.$j.'RhesusDrh'.$i];
				if ($njt=="HBsAg") $njt1="0";
				if ($njt=="HCV") $njt1="1";
				if ($njt=="HIV") $njt1="2";
				if ($njt=="Syp") $njt1="3";
				//echo $njt1.','.$od.','.$hs.'<br>';
				//--- END Input dari form-------
				if($njt!=""){
					//------------ Generate no transaksi ---------------
					if ($metode=='elisa') {
						$idp=mysql_query("select notrans from hasilelisa
								 where notrans like '$jenis%' order by notrans DESC");
						$idp1=mysql_fetch_assoc($idp);
						$idp2=substr($idp1[notrans],3,5); 
					} else {
						$idp=mysql_query("select NoTrans from drapidtest
								where NoTrans like '$jenis%' order by NoTrans DESC");
						$idp1=mysql_fetch_assoc($idp);
						$idp2=substr($idp1[NoTrans],3,5);
					}
				if ($idp2<1) {$idp2="00000";}
				$idp3=(int)$idp2+1;
				
			    $id31= 6-(strlen(strval($idp3)));
				$idp4="";
				for ($i2=0; $i2<$id31; $i2++){
					$idp4 .="0";
				}
				$notest=$jenis.$idp4.$idp3;
	
				//------------ END Generate no transaksi ---------------
				$ratio=$od;
				if ($co>0) $ratio=$od/$co;
					if ($od!='') {
						if ($metode=='elisa') {
							$tambah_sql="insert into hasilelisa (
										noKantong,OD,COV,Hasil,notrans,jenisPeriksa,tglPeriksa,
										dicatatOleh,dicekOleh,DisahkanOleh,nolot,Metode)
									values ('$nkt','$ratio','$co','$hs','$notest','$njt1','$today',
										'$namauser','$_POST[sah1]','$_POST[sah]','$reag0_ex[0]','elisa')";
							$tambah=mysql_query($tambah_sql);
							//echo "<br> $tambah_sql <br>";
						} else {
							$kontrol='1';
							$tambah=mysql_query("insert into drapidtest (NoTrans,noKantong,Kontrol,jenisPeriksa,Hasil,nolot,tgl_tes,dicatatoleh,dicekOleh,DisahkanOleh,Metode) 
											values ('$notest','$nkt','$kontrol','$njt1','$hs','$reag0_ex[0]','$today','$namauser','$_POST[sah1]','$_POST[sah]','Rapid')");
						}
					}
			    	}
	
			//---Cek sudah di tes berapa kali?----
		    $nrapid1=mysql_num_rows(mysql_query("select nokantong from drapidtest where nokantong='$nkt'"));
		    $nelisa1=mysql_num_rows(mysql_query("select noKantong from hasilelisa where noKantong='$nkt'"));
		    if (($nrapid1+$nelisa1)=='4') {
				$tambah1=mysql_query("UPDATE htransaksi
										SET status_test='0'
										where NoKantong='$nkt'");
				$nrapid=mysql_num_rows(mysql_query("select * from drapidtest where nokantong='$nkt' and Hasil='0'"));
				$nelisa=mysql_num_rows(mysql_query("select * from hasilelisa where noKantong='$nkt' and Hasil='1'"));
				$nelisagz=mysql_num_rows(mysql_query("select * from hasilelisa where noKantong='$nkt' and Hasil='2'"));
			    
				//---Minta Id pendonor untuk set data pendonor----
				$pendonor=mysql_query("select ht.kodePendonor as kp, st.gol_darah as gd from htransaksi as ht,stokkantong as st
												where ht.NoKantong='$nkt' and st.noKantong='$nkt'");
				$datapendonor=mysql_fetch_assoc($pendonor);
				$idpendonor=$datapendonor[kp];
				//---End Minta Id pendonor untuk set data pendonor----
				
				if ($nrapid==0 and $nelisa==0) {
						$no_kantong0=substr($nkt,0,-1);
						$q_jum_komponen=mysql_query("select NoKantong from stokkantong where Status='1' and produk is not NULL and NoKantong like '%$no_kantong0%'");
						$jum_komponen=mysql_num_rows($q_jum_komponen);
					if ($nelisagz==0) {
								$nsehat++;
					//kirim ucapan terimakasih
					$dk=mysql_query("select nama,telp,telp2 from pendonor where Kode='$idpendonor' and 
										(LENGTH(telp)>10 or LENGTH(telp2)>10)");
					if (mysql_num_rows($dk)==1) {
						$dk1=mysql_fetch_assoc($dk);
					$ud=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='3'"));
					if (strlen($dk1['telp'])>10) $telp=$dk1[telp];
					if (strlen($dk1['telp2'])>10) $telp=$dk1[telp2];
					$telp=$dk1[telp2];
					$pesan='Yth. '.$dk1[nama].', '.$ud[pesan];
					//$kirim=mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
					//			values ('$telp','$pesan','1')");
					}
					// end ucapan
						$tambah3=mysql_query("UPDATE pendonor SET Cekal='0'
											where Kode='$idpendonor'");	//bebas cekal
						if ($jum_komponen>0) { $tambah3s=mysql_query("UPDATE stokkantong set Status='2',tglpengolahan=tgl_Aftap, tglperiksa='$today',ident='m' where NoKantong like '$no_kantong0%'"); }
							else { $tambah3s=mysql_query("UPDATE stokkantong set Status='2',tglpengolahan=tgl_Aftap,tglperiksa='$today',ident='m' where NoKantong='$nkt'"); }
/*
						switch ($jum_komponen){
							case 1:
								$q_cek_wb=mysql_query("select produk from stokkantong where NoKantong='$nkt' and produk=''");
								$a_cek=mysql_num_rows($q_cek_wb);
								if($a_cek>0){
									$tambah2=mysql_query("UPDATE stokkantong SET Status='2',produk='WB'
													where NoKantong='$nkt'");
								}else{
									$tambah2=mysql_query("UPDATE stokkantong SET Status='2'
													where NoKantong='$nkt'");
								}
								$nsehat++;
								break;
							case 2:
								$tambah2=mysql_query("UPDATE stokkantong SET Status='2'	where NoKantong='$nkt'");
								$B=$no_kantong0."B";
								$tambah2=mysql_query("UPDATE stokkantong SET Status='2'	where NoKantong='$B'");
								$nsehat +=2;
								break;
							case 3:
								$tambah2=mysql_query("UPDATE stokkantong SET Status='2'	where NoKantong='$nkt'");
								$B=$no_kantong0."B";
								$tambah2=mysql_query("UPDATE stokkantong SET Status='2'	where NoKantong='$B'");
								$C=$no_kantong0."C";
								$tambah2=mysql_query("UPDATE stokkantong SET Status='2'	where NoKantong='$C'");
								$nsehat +=3;
								break;
						}
*/
						//update stok udd & server
						/*switch ($ngd){
							case 'A':
					        $update_wb=mysql_query("UPDATE stok SET wb_a = wb_a - 1 where status ='0'");
					        $update_wb0=mysql_query("UPDATE stok SET wb_a = wb_a + 1 where status ='1'");
					        break;
							case 'B':
					        $update_wb=mysql_query("UPDATE stok SET wb_b = wb_b - 1 where status ='0'");
					        $update_wb0=mysql_query("UPDATE stok SET wb_b = wb_b + 1 where status ='1'");
					        break;
							case 'AB':
					        $update_wb=mysql_query("UPDATE stok SET wb_ab = wb_ab - 1 where status ='0'");
					        $update_wb0=mysql_query("UPDATE stok SET wb_ab = wb_ab + 1 where status ='1'");
					        break;
							case 'O':
					        $update_wb=mysql_query("UPDATE stok SET wb_o = wb_o - 1 where status ='0'");
					        $update_wb0=mysql_query("UPDATE stok SET wb_o = wb_o + 1 where status ='1'");
					        break;
							default:
					        $update_wb=mysql_query("UPDATE stok SET wb_x = wb_x - 1 where status ='0'");
					        $update_wb0=mysql_query("UPDATE stok SET wb_x = wb_x + 1 where status ='1'");
						}*/
						//echo $nsehat;
					} else {
						$ngz++;
						//echo $ngz;
					}
				} else {
					//echo $nrusak;
				    $tambah3=mysql_query("UPDATE pendonor
						     SET Cekal='1'
						     where Kode='$idpendonor'");
					$ccekal=mysql_query("insert into cekal ('$idpendonor','$today','$_SESSION[namauser]','1')");
								$nrusak++;
						if ($jum_komponen>0) { $tambah3s=mysql_query("UPDATE stokkantong set Status='4',tglpengolahan=tgl_Aftap, tglperiksa='$today',ident='m' where NoKantong like '$no_kantong0%'");}
							else { $tambah3s=mysql_query("UPDATE stokkantong set Status='4',tglpengolahan=tgl_Aftap,tglperiksa='$today',ident='m' where NoKantong='$nkt'"); }
/*
						switch ($jum_komponen){
							case 1:
								$tambah2=mysql_query("UPDATE stokkantong SET Status='4',produk='WB'
													where NoKantong='$nkt'");
								$nrusak++;
								break;
							case 2:
								$tambah2=mysql_query("UPDATE stokkantong SET Status='4'	where NoKantong='$nkt'");
								$B=$no_kantong0."B";
								$tambah2=mysql_query("UPDATE stokkantong SET Status='4'	where NoKantong='$B'");
								$nrusak +=2;
								break;
							case 3:
								$tambah2=mysql_query("UPDATE stokkantong SET Status='4'	where NoKantong='$nkt'");
								$B=$no_kantong0."B";
								$tambah2=mysql_query("UPDATE stokkantong SET Status='4'	where NoKantong='$B'");
								$C=$no_kantong0."B";
								$tambah2=mysql_query("UPDATE stokkantong SET Status='4'	where NoKantong='$C'");
								$nrusak +=3;
								break;
						}
*/
				}
				
		    }//
		
	//---End Cek sudah di tes berapa kali?----
		}
	}
	}
		//echo $no_kantong0.';'.$jum_komponen."<br>";
		echo mysql_error();
        echo "Data Telah berhasil dimasukkan:<br><ol><li>$nsehat &nbsp;-> &nbsp;Darah Sehat</li>
		<li>$nrusak &nbsp;-> &nbsp;Darah Rusak</li><li>$ngz &nbsp;->&nbsp;Grey Zone</li></ol>";
		backgroundPost('http://localhost/simudda/modul/background_up.php');
        echo "<input type='hidden' name='submit_ok' value='ok' />";
}
//------------------------------ END Submit ----------------------------//
?>
	<body onLoad=setFocus()>
	<table><tr><td><div id='nokantong0'>Pilih reagen pada semua jenis test, sebelum memasukkan no kantong</div></td><td>
	<INPUT type="hidden" size="12" name="nokantong" id="nokantong" onkeydown="chang(event,this,this.value)"/>
	</td></tr></table>
<form name="hasillab" autocomplete="off" id="hasillab" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table border=0>
		<tr>
			<td >
				<select name="reagen0" id="reagen0" onChange="show0(0)" STYLE="width: 190px">
					<option value="">Pilih reagen HBsAg</option>
					<? 
					$jreagen1=mysql_query("select * from reagen where Nama like '%HBsAg%' and aktif='1' and jumTest>0");
					while ($jreagen11=mysql_fetch_assoc($jreagen1)) { 
						$nr1=strtoupper($jreagen11[Nama]);
						$merk1=str_replace("HBSAG","",$nr1);
						$merk1=str_replace(" ","",$merk1);
						$merk11=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk1'"));
						if ($merk11['nama_reagen']!='') {
							$m_reagen1=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
							where nama_reagen='$merk11[nama_reagen]' and jenis_reagen='HBsAg'"));?>
							<option value="<?=$jreagen11[kode]?>*<?=$jreagen11[jumTest]?>*<?=$m_reagen1[reaktif]?>*<?=$m_reagen1[nonreaktif]?>*<?=$m_reagen1[greyzone]?>*<?=$jreagen11[metode]?>">
							<?=$jreagen11[Nama]?>-<?=$jreagen11[noLot]?></option><?
						}
					} ?>
				</select>
			</td>
			<td>
				<input type="hidden" name="jt0" id="jt0"><div id="jt01"></div>
				<input type="hidden" name="imltd0" id="imltd0"><div id="imltd01"></div>
			</td><td>
				<div id='co01'></div>
			</td><td>
				<input size ="3" type="hidden" name="co0" id="co0" value='0'>
			</td><td>
				<input type="hidden" id="r0"><div id="r01"></div>
			</td><td>
				<input type="hidden" id="nr0"><div id="nr01"></div>
			</td><td>
				<input type="hidden" id="gz0"><div id="gz01"></div>
			</td>
		</tr>
		<tr>
			<td colspan=9>
			<table border=1><tr><td width=175><div id='b0'></div></td><td>
				<TABLE class="form" id="box-table-b0">
				</TABLE>
			</td></tr></table>
			</td>
		</tr>
		<tr>
			<td>
				<select name="reagen1" id="reagen1" onChange="show0(1)" STYLE="width: 190px">
					<option value="">Pilih reagen HCV</option> <? 
					$jreagen2=mysql_query("select * from reagen where Nama like '%Hcv%' and aktif='1' and jumTest>0");
					while ($jreagen21=mysql_fetch_assoc($jreagen2)) { 
						$nr2=strtoupper($jreagen21[Nama]);
						$merk2=str_replace("HCV","",$nr2);
						$merk2=str_replace(" ","",$merk2);
						$merk21=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk2'"));
						if ($merk21['nama_reagen']!='') {
							$m_reagen2=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
							where nama_reagen='$merk21[nama_reagen]' and jenis_reagen='HCV'"));?>
<option value="<?=$jreagen21[kode]?>*<?=$jreagen21[jumTest]?>*<?=$m_reagen2[reaktif]?>*<?=$m_reagen2[nonreaktif]?>*<?=$m_reagen2[greyzone]?>*<?=$jreagen21[metode]?>">
							<?=$jreagen21[Nama]?>-<?=$jreagen21[noLot]?></option><?
						}
					}?>
				</select>
			</td>
			<td>
				<input type="hidden" name="jt1" id="jt1"><div id="jt11"></div>
				<input type="hidden" name="imltd1" id="imltd1"><div id="imltd11"></div>
			</td><td>
				<div id='co11'></div>
			</td><td>
				<input size ="3" type="hidden" name="co1" id="co1" value='0'>
			</td><td>
				<input type="hidden" id="r1"><div id="r11"></div>
			</td><td>
				<input type="hidden" id="nr1"><div id="nr11"></div>
			</td><td>
				<input type="hidden" id="gz1"><div id="gz11"></div>
			</td>
		</tr>
		<tr>
			<td colspan=9>
			<table border=1><tr><td width=175><div id='b1'></div></td><td>
				<TABLE class="form" id="box-table-b1">
				</TABLE>
			</td></tr></table>
			<!--<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b1')" />-->
			</td>
		</tr>
		<tr>
			<td>
				<select name="reagen2" id="reagen2" onChange="show0(2)" STYLE="width: 190px">
					<option value="">Pilih reagen HIV</option> <? 
					$jreagen3=mysql_query("select * from reagen where Nama like '%Hiv%' and aktif='1' and jumTest>0");
					while ($jreagen31=mysql_fetch_assoc($jreagen3)) {
						$nr3=strtoupper($jreagen31[Nama]);
						$merk3=str_replace("HIV","",$nr3);
						$merk3=str_replace(" ","",$merk3);
						$merk31=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk3'"));
						if ($merk31['nama_reagen']!='') {
							$m_reagen3=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
							where nama_reagen='$merk31[nama_reagen]' and jenis_reagen='HIV'"));?>
<option value="<?=$jreagen31[kode]?>*<?=$jreagen31[jumTest]?>*<?=$m_reagen3[reaktif]?>*<?=$m_reagen3[nonreaktif]?>*<?=$m_reagen3[greyzone]?>*<?=$jreagen31[metode]?>"><?=$jreagen31[Nama]?>-<?=$jreagen31[noLot]?></option><?
						}
					}?>
				</select>
			</td>
			<td>
				<input type="hidden" name="jt2" id="jt2"><div id="jt21"></div>
				<input type="hidden" name="imltd2" id="imltd2"><div id="imltd21"></div>
			</td><td>
				<div id='co21'></div>
			</td><td>
				<input size ="3" type="hidden" name="co2" id="co2" value='0'>
			</td><td>
				<input type="hidden" id="r2"><div id="r21"></div>
			</td><td>
				<input type="hidden" id="nr2"><div id="nr21"></div>
			</td><td>
				<input type="hidden" id="gz2"><div id="gz21"></div>
			</td>
		</tr>
		<tr>
			<td colspan=9>
			<table border=1><tr><td width=175><div id='b2'></div></td><td>
				<TABLE class="form" id="box-table-b2">
				</TABLE>
			</td></tr></table>
			<!--<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b2')" />-->
			</td>
		</tr>
		<tr>
			<td>
				<select name="reagen3" id="reagen3" onChange="show0(3)" STYLE="width: 190px">
					<option value="">Pilih reagen Syp </option> <? 
					$jreagen4=mysql_query("select * from reagen where Nama like '%Syp%' and aktif='1' and jumTest>0");
					while ($jreagen41=mysql_fetch_assoc($jreagen4)) {
						$nr4=strtoupper($jreagen41[Nama]);
						$merk4=str_replace("SYPHILIS","",$nr4);
						$merk4=str_replace(" ","",$merk4);
						$merk41=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk4'"));
						if ($merk41['nama_reagen']!='') {
							$m_reagen4=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
							where nama_reagen='$merk41[nama_reagen]' and jenis_reagen='Syphilis'"));?>
<option value="<?=$jreagen41[kode]?>*<?=$jreagen41[jumTest]?>*<?=$m_reagen4[reaktif]?>*<?=$m_reagen4[nonreaktif]?>*<?=$m_reagen4[greyzone]?>*<?=$jreagen41[metode]?>"><?=$jreagen41[Nama]?>-<?=$jreagen41[noLot]?></option><?
						}
					}?>
				</select>
			</td>
			<td>
				<input type="hidden" name="jt3" id="jt3"><div id="jt31"></div>
				<input type="hidden" name="imltd3" id="imltd3"><div id="imltd31"></div>
			</td><td>
				<div id='co31'></div>
			</td><td>
				<input size ="3" type="hidden" name="co3" id="co3" value='0'>
			</td><td>
				<input type="hidden" id="r3"><div id="r31"></div>
			</td><td>
				<input type="hidden" id="nr3"><div id="nr31"></div>
			</td><td>
				<input type="hidden" id="gz3"><div id="gz31"></div>
			</td>
		</tr>
		<tr>
			<td colspan=9>
			<table border=1><tr><td width=175><div id='b3'></div></td><td>
				<TABLE class="form" id="box-table-b3">
				</TABLE>
			</td></tr></table>
			<!--<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b2')" />-->
			</td>
		</tr>
		<tr>
			<td colspan="9">Dicatat Oleh :  <?echo $namauser;?></td>
		</tr>
		<tr>
		<td colspan="9">Dicek Oleh :
			<select name="sah1" > <?
				$user1="select * from user";
                $do1=mysql_query($user1);
					while($data1=mysql_fetch_assoc($do1)) {
						$select1=""; ?>
						<option value="<?=$data1[nama_lengkap]?>"<?=$select1?>>
						<?=$data1[nama_lengkap]?>
						</option>
				<? } ?>
			</select>
		</td></tr>

	<tr>
		<td colspan="9">Disahkan Oleh :
			<select name="sah" > <?
				$user="select * from dokter_periksa";
                $do=mysql_query($user);
					while($data=mysql_fetch_assoc($do)) {
						$select=""; ?>
						<option value="<?=$data[Nama]?>"<?=$select?>>
						<?=$data[Nama]?>
						</option>
				<? } ?>
			</select>
		</td></tr>
</table>
	<input type='hidden' name='jum_kantong' value='0' />
    <input id="submit" name="submit" type="submit" value="Submit" />
	<!--<button id="periksa">Periksa</button>-->
</form>

<div id="periksa" title="Isian belum lengkap"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span> 
<p id="id_periksa"></p>
	Silahkan lengkapi isian OD/Ratio Nomor kantong tersebut.
</div>
<div class="alert" id="alert">
	<div id="ganti_reagen" title="Waktu Ganti Reagen..!">
		<p>Silahkan isikan hasil test dan submit terlebih dahulu. Ganti reagen yang telah habis</p>
	</div>
	<div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!">
		<p>Silahkan cek kembali kantong yang anda masukkan, atau masukkan kantong lain</p>
	</div>
	<div id="pilih_reagen" title="Pilih semua reagen..!">
		<p>Silahkan pilih reagen pada semua jenis test terlebih dahulu sebelum memasukkan nomor kantong</p>
	</div>
	<div id="kantong_sudah_diinput" title="Kantong sudah diinput..!">
		<p>Silahkan masukkan kantong yang lain</p>
	</div>
	<div id="isi_kantong" title="Kantong sudah diinput..!">
		<p>Silahkan masukkan nomor kantong</p>
	</div>
	<div id="kantong_reaktif" title="Kantong reaktif...!">
		<p>Gunakan menu update elisa, untuk merubah hasil lab. Silahkan masukkan kantong yang lain</p>
	</div>
	<div id="pernah_ditest" title="Kantong sudah ditest...!">
		<p>Gunakan menu update elisa, untuk merubah hasil lab. Silahkan masukkan kantong yang lain</p>
	</div>
	<div id="yakin" title="Yakin...!">
		<p>Salah satu kantong yang anda periksa memiliki hasil reaktif.
        Jika anda yakin, maka tutup peringatan ini dan klik submit.</p>
	</div>
</div>
