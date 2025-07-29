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
        url: "cek_kantong_apheresis.php?op=cek&nolot="+nomor_lot+"&tanggal="+tanggal_input,
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
	$.ajax({
		url : "cek_kantong_apheresis.php?op=simpan&nokantong="+nkt+"&tgl="+tgl+"&merk="+merk+"&vol="+vol+"&jns="+jns,
		async: false,
		dataType: 'json',
		success: function(json) {
			pesan = json.pesan.pesanproses+", Nomor Kantong: "+json.pesan.nomorkantong+", Jenis: "+json.pesan.jenis;
			//alert(pesan)
		}
	});
	document.tambahkantong.nolot.value="";
	document.tambahkantong.nomorkantong.value="";
	setfocus();
}

function printfile(nokantong2,ck)
{
    $.fn
	.colorbox({href:'bkantong_apheresis.php?nk='+nokantong2+'&ck='+ck,
	iframe:true, innerWidth:350, innerHeight:350});            
}

function cetak(){
	var nomorkantong = document.tambahkantong.nomorkantong.value.toUpperCase();
	var jenis_kantong = document.tambahkantong.jenis.value;
	var ck = document.tambahkantong.cetakkantong.value;
	$.ajax({
		url : "cek_kantong_apheresis.php?op=udd",
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
<font size="4" color="red">INPUT KANTONG APHERESIS<br><br></font>
<body onLoad=setFocus()>
<form name="tambahkantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table class="form" border="1" align=top cellpadding="1" cellspacing="1">
		<tr>
			<td>Tanggal</td><td><INPUT type="date"  name="tanggal" id="tanggal" value="<?=$tanggal?>"></td></tr>
		<tr>
			<td>MERK</td>
			<td class="styled-select">
			     <select name="merk" >
				       <?php
				       $q="select merk from master_kantong group by merk";
				       $do=mysql_query($q,$con);
				       while($data=mysql_fetch_assoc($do)){
					    $select="";
				       ?>
				  <option value="<?=$data[merk]?>"<?=$select?>>
				       <?=$data[merk]?>
				  </option>
				       <?}?>
			     </select>
			</td></tr>
		<tr>
			<td>Volume</td>	
			<td class="styled-select">
				<select name="volume" >
				<option value="200" selected>200 CC</option>
				<option value="250">250 CC</option>
				<option value="350">350 CC</option>
				<option value="300">300 CC</option>
				<option value="450">450 CC</option>
				<option value="500">500 CC</option>
				<option value="550">550 CC</option>
				<option value="600">600 CC</option>
				<option value="650">650 CC</option>
				<option value="700">700 CC</option>
				</select></td></tr>
		<tr>
			<td>Jenis Kantong</td>
			<td class="styled-select">
				<select name="jenis">
				<? $select1=''; 	$select2='';
				if ($_POST[jenis]=='1') $select1='selected';
				if ($_POST[jenis]=='2') $select2='selected'; ?>
				<option value="1" <?=$select1?>>Single</option>
				<option value="2" <?=$select2?>>Double</option>
				</select></td></tr>
		<tr>
			<td>Jumlah Cetak</td>
			<? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='4';?>
			<td><INPUT size=2 type="text"  name="cetakkantong" id="cetakkantong" value="<?=$_POST[cetakkantong]?>"></td></tr>
		<tr><td>TGL EXP. KTG</td>
        <td class="input"><INPUT TYPE="text" NAME="tglkad" VALUE="" id="datepicker" SIZE=10 placeholder="YYYY-MM-DD"></td></tr>
		<tr>
			<td>No LOT/BATCH</td>
			<td><INPUT type="text"  name="nolot" id="nolot" maxlength="10" size="10" onkeydown="chang(event,this);" onchange="generated_nomor_kantong()">Maksimal 10 digit.<br></td></tr>
			
		<tr>
			<td>Nomor Kantong</td>
			<td><INPUT type="text"  name="nomorkantong" id="nomorkantong"></td></tr>
		<tr>
			<td>Format Nomor Kantong</td>
			<td><p>MMYYDD BATCH 01 A<br><br>(tanpa spasi)</p></td></tr>
	</table>
</form>
<input name=cetak type=button value="Simpan dan Cetak" onclick="cetak()" class="swn_button_red">
