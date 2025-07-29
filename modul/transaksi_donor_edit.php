<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/instansi.js"></script>
			<script>
			function disabletext(val){ // masih belum berfungsi
				if(val=='0')
					document.getElementById('comments').disabled = true;
				else
					document.getElementById('comments').disabled = false;
			}
			</script>
<?
include ('config/db_connect.php');

//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= substr($idp1[id1],0,2).$tgl.$bl.$th."-";
$idp	= mysql_query("select NoTrans from htransaksi where NoTrans like '$kdtp%' order by NoTrans DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[NoTrans],9,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

$namauser = $_SESSION[namauser];
$lv0=$_SESSION[leveluser];
$today1=date("Y-m-d H:i:s");
if (isset($_POST['submit'])){
	$id = $_POST['Kode'];
	$id1 = $_POST['Kode_lama'];
	$apheresisfix=$_POST['apheresis'];
	$status_antrian=1;
	$nopol="-";
	$tmpt=explode("-",$_POST[tempat]);
	if ($tmpt[0]=='1') $nopol=$tmpt[1];
	echo "Check $id";
	echo "Check $id1";
	$idtrans=substr($id_transaksi_baru,0,8);
	$instansifix=$_POST[instansi];
	if (strlen($_POST[instansi])<=4){
		$a=mysql_query("SELECT nama FROM detailinstansi where KodeDetail='$_POST[instansi]'");
		$b=mysql_fetch_assoc($a);
		$instansifix=$b[nama];
	}
	$check_p=mysql_num_rows(mysql_query("select KodePendonor from htransaksi where NoTrans like '$idtrans%' and KodePendonor='$id'"));
	if ($check_p==0) {
	$tambah=mysql_query("insert into htransaksi 
			(NoTrans,KodePendonor,KodePendonor_lama,Pengambilan,tempat,Instansi,Tgl,
			JenisDonor,id_permintaan,Status,Nopol,apheresis) 
	value ('$id_transaksi_baru','$id','$id1','-','$tmpt[0]','$instansifix','$today1',
		'$_POST[JenisDonor]','$_POST[id_permintaan]','0','$nopol','$apheresisfix')");
	
	if ($tambah) {
		echo "Data Telah berhasil dimasukkan<br>";
		$idp=mysql_query("select * from tempat_donor where active='1'");
		$idp1=mysql_fetch_assoc($idp);
		if (substr($idp1[id1],0,1)=="M") mysql_query("update htransaksi set mu='1' where NoTrans='$id_transaksi_baru'"); 
		$_POST['periksa']="";
		$check_i=mysql_num_rows(mysql_query("select Kode from pendonor where Kode='$id' and instansi=''"));
		if ($check_i>=1) {			
		$updatedonor=mysql_query("UPDATE pendonor SET instansi='$instansifix' WHERE Kode='$id'");
		}
		$instansi=mysql_query("select instansi from pendonor where Kode='$id'");
		$instansi1=mysql_fetch_assoc($instansi);
		if ($instansi1[instansi] <> $instansifix){
			$updatedonor2=mysql_query("UPDATE pendonor SET instansi='$instansifix' WHERE Kode='$id'");
		}
	}
	}
	switch ($lv0){
		case "mobile":
			?><META http-equiv="refresh" content="1; url=pmimobile.php?module=checkup&NoTrans=<?=$id_transaksi_baru?>"><?
		break;
		case "kasir":
			?><META http-equiv="refresh" content="1; url=pmikasir.php?module=registrasi"><?
		break;
		case "aftap":
			?><META http-equiv="refresh" content="1; url=pmiaftap.php?module=registrasi"><?
		break;
		case "bdrs":
			?><META http-equiv="refresh" content="1; url=pmibdrs.php?module=registrasi"><?

		break;
		case "admin":
			?><META http-equiv="refresh" content="1; url=pmiadmin.php?module=registrasi"><?
		break;
		default:
			echo "Anda tidak memiliki hak akses";
    }
}
?>

<body onload=disabletext(0)>
<h1 class="table">FORM TRANSAKSI DARAH</h1>
<form name="periksa" method="post" action="<?=$PHP_SELF?>" >
<table class="form" cellspacing="0" cellpadding="2">
	<tr>
    <?php
	$check=mysql_query("select * from pendonor where Kode='$_GET[Kode]'");
	$check1=mysql_fetch_assoc($check);
	$tempat=mysql_query("select * from tempat_donor where active='1'");
	$tempat1=mysql_fetch_assoc($tempat);
	?>
		<td>Kode Baru</td>
		<td class="input">
			<input type=hidden name=Kode value="<?=$check1[Kode]?>">
			<?=$check1[Kode]?>
		</td>
		</tr>
		<tr>
		<td>Kode Lama</td>
		<td class="input">
			<input type=hidden name=Kode_lama value="<?=$check1[Kode_lama]?>">
			<?=$check1[Kode_lama]?>
			</td>
	</tr>
	<tr>
		<td>Nama Pendonor</td>
		<td class="input">
			<?=$check1[Nama]?>
		</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td class="input">
			<?=$check1[Alamat]?>
		</td>
	<tr>
		<td>Golongan Darah</td>
		<td class="input"><?=$check1[GolDarah]?>
		</td>
	</tr>
	<tr>
		<td>Rhesus</td>
		<td class="input"><?=$check1[Rhesus]?>
		</td>
	</tr>
	<tr>
		<td>Donor Apheresis</td>
		<?
		$apheresis1=$_GET[apheresis];
		$apheresis=$apheresis1;
		if ($apheresis1=='1'){
			$apheresis1='Ya';}
		else{$apheresis1='Tidak';
		}
		?>
		<td class="input">
		<input type="text" name="apheresis2" value="<?=$apheresis1?>" id="comments"><?$apheresis1?>
		<input type="hidden" name="apheresis" value="<?=$apheresis?>">
		</td>
	</tr>
	<tr>
		<td>Tempat</td>
		<td class="input">
		<?php
		$mu1=mysql_fetch_assoc(mysql_query("select * from tempat_donor where active='1'"));
		if (substr($mu1[id1],0,1)=="M") {
		echo $mu1[tempat];
		?>
			<input type="hidden" name="tempat" value="<?=$mu1[tempat]?>">
		</td></tr>
	<tr>
		<td>Instansi</td>
		<td class="input">
			<?
			$rs1=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where aktif='1'"));
		echo $rs1[nama];
		?>
			<input type="hidden" name="instansi" value="<?=$rs1[nama]?>">
		</td>
	</tr>
		<?
		} else {
		?>
			<select name="tempat" onChange="dinstansi();">
        <?
            $rs="select * from tempat_donor where id not like '1'";
                $do=mysql_query($rs);
                  while($data=mysql_fetch_assoc($do))
            {
            $select="";

            ?>
			<option value="<?=$data[id]?>-<?=$data[tempat]?>"<?=$select?>>
			<?=$data[tempat]?>
			</option>
        <?
        }
        ?>
			</select>
		</td>
		</td>
	<tr>
		<td>Instansi</td>
		<td class="input">
			<select name="instansi" id="instansi">
			<option></option>
			</select>
		</td>
		</td>
	</tr>
<? } ?>
	<tr>
		<td>Jenis Donor</td>
		<td class="input">
			<select name="JenisDonor" onchange='disabletext(this.value);'>
				<option value="0" >Sukarela</option>
				<option value="1" >Pengganti</option>
				<option value="3" >Autologus</option>
			</select>
	<tr>
		<td>No Formulir</td>
		<td class="input">
			<input name="id_permintaan" type="text" size="4" id='comments'></font>
		</td>
	</tr>
</table>
<br>

<input type="submit" name="submit" value="Lanjutkan ke Antrian AFTAP???">

</form>
