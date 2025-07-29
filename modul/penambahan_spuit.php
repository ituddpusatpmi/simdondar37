<head>
<script language=javascript src="./js/util.js" type="text/javascript"> </script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script language="javascript" src="./js/AjaxRequest.js" type="text/javascript"></script>
<style type="text/css">
@import url("css/stok_darah.css");
</style>
<style type="text/css">.styled-select select {background-color: #F7D7D7; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<script language="javascript">
	
function setFocus(){
	document.tambahkantong.nolot.focus();
}

var cle;
function detect(Event) {
  // Event appears to be passed by Mozilla
  // IE does not appear to pass it, so lets use global var
  if(Event==null) {alert('null'); Event=event;}cle = Event.keyCode;
}

var chang;
function chang(Event,quoi) {
	detect(Event);
	setTimeout('cle=""',100);
	if(cle=='13') 
	while(quoi!=null) {
		quoi = quoi.nextSibling;
		if(quoi.tagName=='INPUT') {
                quoi.focus(nomorkantong);
                quoi=null;
          }
	}
}

function generated_nomor_kantong(){
	var nomor_lot = document.tambahkantong.nolot.value.toUpperCase();
	var tanggal_input  = document.tambahkantong.tanggal.value;
	var jenis_kantong = document.tambahkantong.jenis.value;
	$.ajax({
        url: "cek_spuit.php?op=cek&nolot="+nomor_lot+"&tanggal="+tanggal_input,
        async: false,
        dataType: 'json',
        success: function(json) {
			hasilgenerated = json.kantong.nokantong;
			document.tambahkantong.nomorkantong.value=hasilgenerated;
		}	
	});
}

function simpankantong(){
	var nkt	= document.tambahkantong.nomorkantong.value;
	var tgl	= document.tambahkantong.tanggal.value;
	var merk	= document.tambahkantong.merk.value;
	var vol   = document.tambahkantong.volume.value;
	var jns	= document.tambahkantong.jenis.value;
	var keterangan	= document.tambahkantong.keterangan.value;
	
	$.ajax({
		url : "cek_spuit.php?op=simpan&nokantong="+nkt+"&tgl="+tgl+"&merk="+merk+"&vol="+vol+"&jns="+jns+"&keterangan="+keterangan,
		async: false,
		dataType: 'json',
		success: function(json) {
			pesan = json.pesan.pesanproses+", Nomor Kantong: "+json.pesan.nomorkantong+", Jenis: "+json.pesan.jenis;
			//alert(pesan)
		}
	});
	document.tambahkantong.nolot.value="";
	document.tambahkantong.nomorkantong.value="";
	document.tambahkantong.keterangan.value;
	setfocus();
}

function printfile(nokantong2,ck)
{
    $.fn
	.colorbox({href:'bspuit.php?nk='+nokantong2+'&ck='+ck,
	iframe:true, innerWidth:350, innerHeight:350});            
}

function cetak(){
	var nomorkantong = document.tambahkantong.nomorkantong.value.toUpperCase();
	var jenis_kantong = document.tambahkantong.jenis.value;
	var ck = document.tambahkantong.cetakkantong.value;
	$.ajax({
		url : "cek_spuit.php?op=udd",
		async: false,
		dataType: 'json',
		success: function(json) {
			namaudd_aktif=json.infoudd.namaudd;
		}	
	});
	var nokantong2=nomorkantong+","+jenis_kantong;
	if (nomorkantong==""){
		alert("Proses penyimpanan kantong tidak bisa dilakukan! Silahkan ulangi lagi.");
	}else{
		printfile(nokantong2,ck);
		simpankantong();
	}
}
</script>


</head>
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$tanggal=date("Y-m-d");
?>
<font size="4" color="red">INPUT SPUIT<br><br></font>
<body onLoad=setFocus()>
<form name="tambahkantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table class="form" border="1" align=top cellpadding="1" cellspacing="1">
		<tr>
			<td style="display:none;"><INPUT type="hidden"  name="tanggal" id="tanggal" value="<?=$tanggal?>"></td></tr>
		<tr>
			<td>Merk</td>
			<td class="styled-select">
				<select name="merk">
				<? $select1='';	$select2=''; $select3='';	$select4=''; $select5='';	$select6=''; $select7=''; $select8='';	
				if ($_POST[merk]=='TERUMO') $select1='selected';
				if ($_POST[merk]=='BD') $select2='selected';
				if ($_POST[merk]=='ONEMED') $select3='selected';
				?>
				<option value="TERUMO" <?=$select1?>>TERUMO</option>
				<option value="BD" <?=$select2?>>BD</option>
				<option value="ONEMED" <?=$select3?>>ONEMED</option>
				
				</select></td></tr>
		<tr>
			<td>Volume</td>	
			<td class="styled-select">
				<select name="volume" >
				<option value="1" selected>1 CC</option>
				<option value="3">3 CC</option>
				<option value="5"> 5 CC</option>
				<option value="10"> 10 CC</option>
				
				</select></td></tr>

		<tr>
			<td style="display:none;">Jenis Spuit</td>
			<td style="display:none;" class="styled-select">
				<select name="jenis">
				<? $select1=''; 
				if ($_POST[jenis]=='1') $select1='selected';
				 ?>
				<option value="1" <?=$select1?>>Single</option>
				
				</select></td></tr>
		<tr>
			<td>Jumlah Cetak</td>
			<? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='2';?>
			<td><INPUT size=2 type="text"  name="cetakkantong" id="cetakkantong" value="<?=$_POST[cetakkantong]?>"></td></tr>
		<tr>
			<td>No LOT/BATCH</td>
			<td><INPUT type="text"  name="nolot" id="nolot" maxlength="10" size="10" onkeydown="chang(event,this);" onchange="generated_nomor_kantong()"> Maksimal 10 digit.<br></td></tr>
		<tr>
			<td>Nomor Spuit</td>
			<td><INPUT type="text"  name="nomorkantong" id="nomorkantong"> Nomor otomatis dibuat oleh sistem</td></tr>
		<tr>
			<td>Format Nomor Spuit</td>
			<td><p>MMYYDD BATCH 01 A<br><br>(tanpa spasi)</p></td></tr>
		
		
		<tr>
			<? if (!isset($_POST[keterangan])) $_POST[keterangan]='1';?>
			<td style="display:none;"><INPUT size=2 type="text"  name="keterangan" id="keterangan" value="<?=$_POST[keterangan]?>"></td></tr>
		
			
	</table>


</form>
<input name=cetak type=button value="Simpan dan Cetak" onclick="cetak()" class="swn_button_red">
