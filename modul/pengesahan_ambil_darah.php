<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('terima').focus();
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});
	});
  </script>


<?
include ('clogin.php');
include ('config/db_connect.php');
$namauser = $_SESSION[namauser];
$today = date('Y-m-d H:i:s');
$today0 = date('Y-m-d');

//PENGESAHAN

$today1 = date('Ymd');
$max=mysql_fetch_assoc(mysql_query("select max(pengesahan.trans) as akhir from pengesahan where date(tgl)=curdate()"));
$maxt=$max['akhir'];
$maxp=$maxt+1;

if (isset($_POST[terima])) {
$kodek=$_POST['kode'];
$no_kantong = mysql_real_escape_string($_POST[terima]);
$ck=mysql_fetch_assoc(mysql_query("select Status,sah from stokkantong where noKantong='$no_kantong' and (sah='0' or sah is null or sah='' or sah='1')"));
	$cek1=mysql_fetch_assoc(mysql_query("select * from stokkantong where nokantong='$no_kantong'"));
	$cek2=mysql_fetch_assoc(mysql_query("select * from htransaksi where nokantong='$no_kantong'"));
	

if ($ck[Status]=='1' or $ck[Status]=='2')  {
$updatektg=mysql_query("update stokkantong set sah='1' where noKantong='$no_kantong'");
$pengesahan=mysql_query("insert into pengesahan (trans,nokantong,tgl,ygmenyerahkan,jns,ket,shift) value ('$kodek','$no_kantong','$today','$namauser','$cek1[jenis]','$cek2[Pengambilan]','$cek2[shift]')");

                   //Eksekusi SMS
                    //---Minta Id pendonor untuk set data pendonor----
                    /*$pendonor=mysql_query("select kodependonor from stokkantong where nokantong='$no_kantong'");
                    $datapendonor=mysql_fetch_assoc($pendonor);
                    $idpendonor=$datapendonor[kodependonor];
                    //---End Minta Id pendonor untuk set data pendonor----
                    //kirim ucapan terimakasih
                    $dk=mysql_query("select nama,Jk,Status,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>9");
                    if (mysql_num_rows($dk)==1) {
                            $dk1=mysql_fetch_assoc($dk);
				if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Bpk';
				if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Sdr';
				if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Ibu';
				if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Sdri';
                            $ud=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='3'"));
                            $telp=$dk1[telp2];
                            $pesan='Yth. '.$sapa.'. '.$dk1[nama].', '.$ud[pesan];
                            $kirim=mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
                                            values ('$telp','$pesan','1')");
			 
                     }*/
                    // end ucapan
   
    
echo  "Darah dengan NoKantong<b> $no_kantong </b>Telah Berhasil disahkan";


//		backgroundPost('http://localhost/simudda/modul/background_up_karantina.php');
} else {
echo "NoKantong<b> $no_kantong </b> TIDAK DITEMUKAN Atau Telah disahkan sebelumnya, silahkan Check Kantong melalui menu CHECK STOK";
}
}



if (isset($_POST['Button'])) {
	$box=$_POST['sah'];
	$nk=$_POST['nkantong'];
	$pengirim=$_POST['sah0'];
	$penerima=$_POST['sah1'];
	$penerima2=$_POST['sah2'];
	//$trans=$_POST['kode'];
	//$shift=$_POST['shift'];
	$jns=$_POST['jenis'];
	for ($i=0;$i<count($box);$i++) {
	if ($box[$i]!='0') {
		
		$sahkan=mysql_query("update pengesahan set trans='$maxp',ygmenyerahkan='$pengirim',ygmengesahkan='$penerima',up='1',penerimaktg='$penerima2' where nokantong='$box[$i]'");
 //=======Audit Trial==0==========================================================================
		}
		}
	if ($sahkan) echo "<META http-equiv='refresh' content='10; url=modul/rekap_pengesahan.php'>";
} else {
$td=mysql_fetch_assoc(mysql_query("select id1 from tempat_donor where active='1'"));
	if (substr($td[id1],0,1)=="M") { 
		$mu="1";
	} else {
		$mu="";
	}
	$hasil=mysql_query("select * from pengesahan where up='0' order by tgl ASC");
  	$TRec=mysql_num_rows($hasil);
	?>

	<? 
if (($_SESSION[leveluser]=='laboratorium') or ($_SESSION[leveluser]=='kasir') or ($_SESSION[leveluser]=='aftap') or ($_SESSION[leveluser]=='komponen')){ ?>
<div>
<form name=sahdarah method=post><h3>Pengesahan Penerimaan Darah, Masukkan No Kantong -->
<input type=text name=terima id=terima size=15 placeholder="Jika Diketik, ENTER" onChange="this.form.submit();"> </h3>

</form></div>
<? } ?>

	<h1 class="table">Approval Serah terima  Kantong dan Sampel Darah</h1>
	No. Transaksi : <input name=kode type=text size=15 value="<?=$maxp?>">
	<form align="left" method="post" action="<?=$PHPSELF?>">
  	<table class="list" width="100%" cellspacing="1" cellpadding="0" align="left">
    	<tr class="field">
			<td>No</td>
			<td>No. Kantong</td>
			<td>Jenis Kantong</td>
			<td>Tgl Aftap</td>
			<td>Tgl Pengesahan</td>
			<td>Status Aftap</td>
			<td>Shift</td>
			<td>Asal Sampel</td>
			<td>Instansi</td>
			<td>Pilih</td>
    	</tr>
	<input type="hidden" name="jumlah" value="<?=$TRec?>">
<?
	$no=1;
	while($baris=mysql_fetch_assoc($hasil)){
?>
    <tr class="record">
      <td><?=$no?>.</td>
      <td><?=$baris[nokantong]?>
	<input type=hidden name=nkantong[] value="<?=$baris[nokantong]?>">	
	</td> 
<?
$selkantong=mysql_fetch_assoc(mysql_query("SELECT metoda FROM stokkantong WHERE noKantong='$baris[nokantong]'"));
    switch ($selkantong['metoda']){
//            case "BS":  $metkantong ="BIASA";        break;
//            case "FT":  $metkantong ="FILTER";       break;
    case "TTB":  $metkantong ="TOP & TOP (Biasa)";    break;
    case "TTF":  $metkantong ="TOP & TOP (Filter)";    break;
    case "TBB":  $metkantong ="TOP & BOTTOM (Biasa)"; break;
    case "TBF":  $metkantong ="TOP & BOTTOM (Filter)"; break;
}

$jenis=$baris['jns'];
switch ($jenis)
{
case 1:
	$jenis='Single';
	break;
case 2:
	$jenis='Double';
	break;
case 3:
	$jenis='Triple';
	break;
case 4:
	$jenis='Quadruple ('.$metkantong.')';
	break;
case 6:
	$jenis='Pediatrik';
	break;
	
}
?>  
	<td><?=$jenis?></td>
<?
$stokkantong=mysql_fetch_assoc(mysql_query("select tgl_Aftap from stokkantong where noKantong='$baris[nokantong]'"));
?>
	<td><?=$stokkantong['tgl_Aftap']?></td>
	<td><?=$baris['tgl']?></td>
<?
$a_dtransaksipermintaan2=mysql_fetch_assoc(mysql_query("select Pengambilan,tempat,instansi from htransaksi where noKantong='$baris[nokantong]'"));
if ($baris['ket']=='0') $peng='Berhasil';
if ($baris['ket']=='2') $peng='Gagal';
if ($baris['ket']=='1') $peng='Batal';
if ($a_dtransaksipermintaan2['tempat']=='M') {$peng1='Mobile Unit';}else{$peng1='Dalam Gedung';}
?>
    <td><?=$peng?></td>
	<td><?=$baris['shift']?></td>
	<td><?=$peng1?></td>
	<td><?=$a_dtransaksipermintaan2['instansi']?></td>
	<td>
			<input type=checkbox name=sah[] value="<?=$baris['nokantong']?>" checked>Sah
			
	</td>
	</tr>
		<? $no++; } ?>
	<tr>
		<td colspan="9">Yang Menyerahkan :
			<select name="sah0" > <?
				$user1="select * from user order by id_user ASC";
                $do1=mysql_query($user1);
					while($data1=mysql_fetch_assoc($do1)) {
						$select1=""; ?>
						<option value="<?=$data1[id_user]?>"<?=$select1?>>
						<?=$data1[id_user]?>
						</option>
				<? } ?>
			</select>
		</td>
		
		</tr>
	<tr>
		<td colspan="9">Yang Menerima Sampel :
			<select name="sah1" > <?
				$user1="select * from user order by id_user ASC";
                $do1=mysql_query($user1);
					while($data1=mysql_fetch_assoc($do1)) {
						$select1=""; ?>
						<option value="<?=$data1[id_user]?>"<?=$select1?>>
						<?=$data1[id_user]?>
						</option>
				<? } ?>
			</select>
		</td></tr>
	<tr>
		<td colspan="9">Yang Menerima Kantong :
			<select name="sah2" > <?
				$user1="select * from user order by id_user ASC";
                $do1=mysql_query($user1);
					while($data1=mysql_fetch_assoc($do1)) {
						$select1=""; ?>
						<option value="<?=$data1[id_user]?>"<?=$select1?>>
						<?=$data1[id_user]?>
						</option>
				<? } ?>
			</select>
		</td></tr>
	
	<tr>
		<td colspan="3">
		<input type="hidden" name="jenis[]" value="0">
		<input type="submit" name="Button" value="Submit">
		</td>
	</tr>
</table>
</form>
<? 
} 
?>
