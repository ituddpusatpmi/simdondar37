<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
//$col4=mysql_query("SELECT `kadaluwarsa_ktg` FROM `stokkantong`");
//if(!$col4){mysql_query("ALTER TABLE `stokkantong`
//ADD `kadaluwarsa_ktg` DATE NULL AFTER `hasil`,
//ADD `nolot_ktg` VARCHAR( 12 ) NULL AFTER `kadaluwarsa_ktg`");}
//$colm=mysql_query("SELECT metoda FROM stokkantong");
//if(!$colm){mysql_query("ALTER TABLE `stokkantong` ADD `metoda` VARCHAR( 11 ) NULL DEFAULT NULL AFTER `tglpengolahan` ");}
?>
<head>
    <!--<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>-->
    <!--<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>-->
    <!--<script type="text/javascript" src="js/tgl_rekap.js"></script>-->
    <!--<link href="css/style.css" rel="stylesheet" type="text/css" />-->
    <!--<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />-->
    <!--<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>-->
    <!--<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>-->
    <link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
    <script language=javascript src="./js/kantong_2015.js" type="text/javascript"> </script>
    <script language=javascript src="./js/util.js" type="text/javascript"> </script>
    <script language="javascript" src="./js/AjaxRequest.js" type="text/javascript"></script>
    <script language="javascript">
        function setFocus(){document.tambahkantong.nokantong.focus();}
    </script>
    <link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="js/jquery.js"></script>
    <script language="javascript" src="modul/thickbox/thickbox.js"></script>

    <!--<script language="javascript">-->
    <!--function selectutd(id){-->
    <!--	  $('input[@name=kodeSup]').val(id);-->
    <!--		tb_remove(); -->
    <!--}-->
    <!--</script>-->
</head>
<?php
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION['namauser'];
$nkt1="";

if (isset($_POST['submit'])) {
    for ($i=0; $i<sizeof($_POST['merk1']); $i++) {
        $nmr=$_POST['merk1'][$i];
        $njn=$_POST['jenis1'][$i];
        $nst="0";
        $nvo=$_POST['volume1'][$i];
        $nkt=$_POST['no_kantong'][$i];
        $nkt1 .=$nkt.",";
        $nkt=ereg_replace("[^A-Za-z0-9]", "",strtoupper($nkt));
        $today=date("Y-m-d H:i:s");
        $beli=$_POST['tglbeli1'][$i];
        $exp=$_POST['tglkad1'][$i];
        $nolot=$_POST['nolot1'][$i];
        $djn=$_POST['djenis1'][$i];
        $mtd=$_POST['metoda1'][$i];
        $mtd1=$_POST['metoda3'][$i];
        $mtdjadi=$mtd.$mtd1;

        /** Apabila Kantong  Quadruple Top&Top/Top&Bottom */
        if($njn=='4'){
            $tambah=mysql_query("insert into stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,StatTempat,stokcheck,volumeasal,metoda,kadaluwarsa_ktg,nolot_ktg,tglbeli)
				values ('$nkt','$njn','$nst','$today','$nvo','$nmr','0','$djn','$nvo','$mtdjadi','$exp','$nolot','$beli')");
	//=======Audit Trial====================================================================================
		$log_mdl ='LOGISTIK';
		$log_aksi='Pengesahan Kantong Logistik: '.$nkt;
		include('user_log.php');
	//=====================================================================================================

        /** Apabila Kantong Quadruple Biasa */
//        }elseif($njn=='4' && $mtd=='BS'){
//            $tambah=mysql_query("insert into stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,StatTempat,stokcheck,volumeasal,kadaluwarsa_ktg,nolot_ktg,tglbeli)
//				values ('$nkt','$njn','$nst','$today','$nvo','$nmr','0','$djn','$nvo','$exp','$nolot','$beli')");
	//=======Audit Trial====================================================================================
//		$log_mdl ='LOGISTIK';
//		$log_aksi='Pengesahan Kantong Logistik: '.$nkt;
//		include('user_log.php');
	//=====================================================================================================
        }else{
            $tambah=mysql_query("insert into stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,StatTempat,volumeasal,kadaluwarsa_ktg,nolot_ktg,tglbeli)
            values ('$nkt','$njn','$nst','$today','$nvo','$nmr','0','$nvo','$exp','$nolot','$beli')");
	//=======Audit Trial====================================================================================
		$log_mdl ='LOGISTIK';
		$log_aksi='Barcode Kantong : '.$nkt;
		include('user_log.php');
	//=====================================================================================================
        }
    }
    if ($tambah) {
        $ident=mysql_query("update stokkantong set ident='m' where nokantong like '%A'");
	echo "Data Telah berhasil dimasukkan. ";?>
    <?}
} ?>
<body onLoad=setFocus()>
<font size="4" color=red font-family="Arial">PENAMBAHAN KANTONG DARAH</font><br>
<form name="tambahkantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
    <table align=top>
        <tr>
            <td valign=top>
                <table class="form" border="0" align=top cellpadding="2" cellspacing="2">
                    <tr>
                        <td>TIPE BARCODE</td>
                        <td class="styled-select">
                            <select name="tipe_barcode">
                                <?
                                $select1='';	$select2=''; $select5='';
                                $select3='';	$select4=''; $select6='';
                                if ($_POST[tipe_barcode]=='C39E') $select5='selected';
                                if ($_POST[tipe_barcode]=='C39') $select4='selected';
                                if ($_POST[tipe_barcode]=='C128') $select1='selected';
                                if ($_POST[tipe_barcode]=='C128A') $select2='selected';
                                if ($_POST[tipe_barcode]=='C128B') $select3='selected';
				if ($_POST[tipe_barcode]=='CODABAR') $select6='selected';


                                ?>
                                <option value="C39" <?=$select4?>>CODE 39</option>
				<option value="C128" <?=$select1?>>CODE 128 AUT0</option>
				<option value="C39E" <?=$select5?>>CODE 39 EXTENDED</option>
                                <option value="C128A" <?=$select2?>>CODE 128A</option>
                                <option value="C128B" <?=$select3?>>CODE 128B</option>
				<option value="CODABAR" <?=$select6?>>CODABAR</option>
                            </select>
                        </td>
                    </tr>
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
</td>
                        <!--td class="styled-select">
                            <select name="merk">
                                <?
                                $select1='';	$select2='';
                                $select3='';	$select4='';
                                $select5='';	$select6='';
                                $select7='';	$select8='';
                                $select9='';	$select10='';
				$select11='';	$select12='';
                                if ($_POST[merk]=='KARMI') $select1='selected';
                                if ($_POST[merk]=='TERUMO') $select2='selected';
                                if ($_POST[merk]=='JMS') $select3='selected';
                                if ($_POST[merk]=='JML') $select4='selected';
                                if ($_POST[merk]=='HLHAEMOPACK') $select5='selected';
                                if ($_POST[merk]=='COMTEC') $select6='selected';
                                if ($_POST[merk]=='GREENCROSS') $select7='selected';
                                if ($_POST[merk]=='Produk DEMO') $select8='selected';
                                if ($_POST[merk]=='DEMOTEK') $select9='selected';
                                if ($_POST[merk]=='IControl') $select10='selected';
                                if ($_POST[merk]=='COMPOFLEX') $select11='selected';
				if ($_POST[merk]=='HAEMONETICS') $select12='selected';
				if ($_POST[merk]=='AMICORE') $select13='selected';
                                ?>
                                <option value="TERUMO" <?=$select2?>>TERUMO</option>
                                <option value="DEMOTEK" <?=$select9?>>DEMOTEK</option>
                                <option value="IControl" <?=$select10?>>IControl</option>
                                <option value="KARMI" <?=$select1?>>KARMI</option>
                                <option value="JMS" <?=$select3?>>JMS</option>
                                <option value="JML" <?=$select4?>>JML</option>
                                <option value="HLHAEMOPACK" <?=$select5?>>HLHAEMOPACK</option>
                                <option value="COMTEC" <?=$select6?>>COM.TECH</option>
                                <option value="GREENCROSS" <?=$select7?>>GREEN CROSS</option>
                                <option value="Produk DEMO" <?=$select8?>>Produk DEMO</option>
                                <option value="COMPOFLEX" <?=$select8?>>COMPOFLEX</option>
				<option value="HAEMONETICS" <?=$select12?>>HAEMONETICS</option>	
				<option value="AMICORE" <?=$select13?>>AMICORE</option>
                            </select>
                        </td-->
                    </tr>
                    <tr>
                        <td>VOLUME</td>
                        <td class="styled-select">
                            <select name="volume" >
                                <option value="350"  selected> 350 CC</option>
                                <option value="250">250 CC</option>
                                <option value="200">200 CC</option>
                                <option value="450">450 CC</option>
                                <option value="500">500 CC</option>
                            </select>
                        </td>
                    <tr>
                        <td>JENIS KANTONG</td>
                        <td class="styled-select">
                            <select name="jenisktg" id="jenisktg" onchange="viewjenis()">
                                <?
                                $select0='';    $select1=''; 	$select2='';
                                $select3='';	$select4='';    $select6='';
				$select7='';
                                if ($_POST['jenisktg']=='0') $select0='selected';
                                if ($_POST['jenisktg']=='1') $select1='selected';
                                if ($_POST['jenisktg']=='2') $select2='selected';
                                if ($_POST['jenisktg']=='3') $select3='selected';
                                if ($_POST['jenisktg']=='4') $select4='selected';
                                if ($_POST['jenisktg']=='6') $select6='selected';
				if ($_POST['jenisktg']=='7') $select7='selected';
                                ?>
                                <option value="0" <?=$select1?>>Pilih Jenis Kantong</option>
                                <option value="1" <?=$select1?>>Single</option>
                                <option value="2" <?=$select2?>>Double</option>
                                <option value="3" <?=$select3?>>Triple</option>
                                <option value="4" <?=$select4?>>Quadruple</option>
                                <option value="6" <?=$select6?>>Pediatrik</option>
				<option value="7" <?=$select7?>>Leukodepleted</option>
                            </select>
                            &nbsp;&nbsp;
                            <span id="bt" style="display: none">
							<select name="metoda" id="metoda">
<!--                                <option value="BS" selected>Biasa</option>-->
                                <option value="TB">TOP & BOTTOM</option>
                                <option value="TT">TOP & TOP</option>
<!--                                <option value="FT" --><?//=$select4?><!-->FILTER</option>-->
                            </select>
                                <input type="radio" id="radio1" name="metoda3" value="B" checked>
                                <label for="radio1">Biasa</label>
                                <input type="radio" id="radio2" name="metoda3" value="F">
                                <label for="radio2">Filter</label>
                            </span>
                            <!--                            <br>-->
                            <!--                            <span id="ctk1" style="display: none">-->
                            <!--                                A : <INPUT size=1 type="text"  name="cetakkantong1" id="cetakkantong" value="10">-->
                            <!--                            </span>-->
                            <!--                            <span id="ctk2" style="display: none">-->
                            <!--                                A : <INPUT size=1 type="text"  name="cetakkantong1" id="cetakkantong1" value="10">-->
                            <!--                                B : <INPUT size=1 type="text"  name="cetakkantong2" id="cetakkantong2" value="4">-->
                            <!--                            </span>-->
                            <!--                            <span id="ctk3" style="display: none">-->
                            <!--                                A : <INPUT size=1 type="text"  name="cetakkantong1" id="cetakkantong1" value="10">-->
                            <!--                                B : <INPUT size=1 type="text"  name="cetakkantong2" id="cetakkantong2" value="4">-->
                            <!--                                C : <INPUT size=1 type="text"  name="cetakkantong3" id="cetakkantong3" value="2">-->
                            <!--                            </span>-->
                            <!--                            <span id="ctk4" style="display: none">-->
                            <!--                                A : <INPUT size=1 type="text"  name="cetakkantong1" id="cetakkantong1" value="10">-->
                            <!--                                B : <INPUT size=1 type="text"  name="cetakkantong2" id="cetakkantong2" value="10">-->
                            <!--                                C : <INPUT size=1 type="text"  name="cetakkantong3" id="cetakkantong3" value="4">-->
                            <!--                                D : <INPUT size=1 type="text"  name="cetakkantong4" id="cetakkantong4" value="2">-->
                            <!--                            </span>-->
                            <!--                            <span id="ctk5" style="display: none">-->
                            <!--                                A : <INPUT size=1 type="text"  name="cetakkantong1" id="cetakkantong1" value="10">-->
                            <!--                                B : <INPUT size=1 type="text"  name="cetakkantong2" id="cetakkantong2" value="10">-->
                            <!--                                C : <INPUT size=1 type="text"  name="cetakkantong3" id="cetakkantong3" value="10">-->
                            <!--                                D : <INPUT size=1 type="text"  name="cetakkantong4" id="cetakkantong4" value="4">-->
                            <!--                                E : <INPUT size=1 type="text"  name="cetakkantong5" id="cetakkantong5" value="2">-->
                            <!--                            </span>-->
                            <!--                            <span id="ctk6" style="display: none">-->
                            <!--                            </span>-->
                        </td>
                    </tr>
                    <tr><td>TGL BELI</td>
                        <td class="input"><INPUT TYPE="text" NAME="tglbeli" VALUE="" id="datepicker" SIZE=10 placeholder="YYYY-MM-DD"></td>
                        <!--A HREF="#" onClick="cal1xx.select(document.forms[0].tglkad,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglkad,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td-->
                    </tr>
                    <tr><td>TGL EXP. KTG</td>
                        <td class="input"><INPUT TYPE="text" NAME="tglkad" VALUE="" id="datepicker1" SIZE=10 placeholder="YYYY-MM-DD"></td>
                        <!--A HREF="#" onClick="cal1xx.select(document.forms[0].tglkad,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglkad,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td-->
                    </tr>
                    <tr>
                        <td>NOLOT KTG</td>
                        <td "styled-select"><INPUT type="text"  name="nolot" size='9'  >
                        </td>
                    </tr>
                    <tr>
                        <td id="jmlcetak">JML CETAK</td>
                        <? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='10';?>
                        <td "styled-select">
                        A : <INPUT size=1 type="text"  name="cetakkantong1" id="cetakkantong1" value="6">
                        B : <INPUT size=1 type="text"  name="cetakkantong2" id="cetakkantong2" value="4">
                        C : <INPUT size=1 type="text"  name="cetakkantong3" id="cetakkantong3" value="2">
                        D : <INPUT size=1 type="text"  name="cetakkantong4" id="cetakkantong4" value="2">
                        E : <INPUT size=1 type="text"  name="cetakkantong5" id="cetakkantong5" value="2">
                        F : <INPUT size=1 type="text"  name="cetakkantong6" id="cetakkantong6" value="2">
                        </td>
                    </tr>
                    <tr>
                        <td>NO KANTONG</td>
                        <td class="input"><INPUT type="text"  name="nokantong" id="nokantong" placeholder="Sesuai No selang tanpa 'A'"
                                                 onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');">
                        </td>
                    </tr>
                    <tr><td colspan='2'>Jika Diketik Manual Tekan ENTER</td></tr>

                </table>
            </td>
            <td valign=top>
                <table border=0>
                    <tr>
                        <td>
                            <INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" class="swn_button_red" />
                            <input name="submit" type="submit" value="Simpan" class="swn_button_blue">
                        </td>
                    </tr>
                </table>
                <table class="list" id="box-table-b" width=500px align=top>
                    <tr class="field">
                        <th align='center'></th>
                        <th align='center'>NO</th>
                        <th align='center'>NOMOR<br>KANTONG</th>
                        <th align='center'>VOLUME</th>
                        <th align='center'>MERK</th>
                        <th align='center'>JENIS</th>
                        <th align='center'>EXP. KTG</th>
                        <th align='center'>NOLOT KTG</th>
                        <th align='center'></th>
                        <th align='center'></th>
                        <th align='center'>TGL BELI</th>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<script>
    function viewjenis(){
        var penerima=document.getElementById("jenisktg").value;
        if(penerima=='4'){
            document.getElementById("bt").style.display="inline";
        }else{
            document.getElementById("bt").style.display="none";
        }
    }
</script>

<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
