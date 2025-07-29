<HEAD>
<script language=javascript src="./js/terimakantong_luar.js" type="text/javascript"> </script>
<script language=javascript src="./js/util.js" type="text/javascript"> </script>
<script language="javascript" src="./js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style type="text/css">
@import url("css/stok_darah.css");
</style>
 <script language="javascript">
function setFocus(){document.tambahkantong.nokantong.focus();}
</script>
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>

<!-- This javascript is only used for the show/hide source on my example page.
     It is not used by the Calendar Popup script -->
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>

<!-- This prints out the default stylehseets used by the DIV style calendar.
     Only needed if you are using the DIV style popup -->
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>

<!-- These styles are here only as an example of how you can over-ride the default
     styles that are included in the script itself. -->
<SCRIPT LANGUAGE="JavaScript" ID="jscal1xx">
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</SCRIPT>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script language="javascript" src="js/jquery.js"></script>
 <script language="javascript" src="modul/thickbox/thickbox.js"></script>
	
<script language="javascript">
function selectutd(id){
	  $('input[@name=kodeSup]').val(id);
		tb_remove(); 
}
</script>
<STYLE>
        .TESTcpYearNavigation,
        .TESTcpMonthNavigation
                        {
                        background-color:#6677DD;
                        text-align:center;
                        vertical-align:center;
                        text-decoration:none;
                        color:#FFFFFF;
                        font-weight:bold;
                        }
        .TESTcpDayColumnHeader,
        .TESTcpYearNavigation,
        .TESTcpMonthNavigation,
        .TESTcpCurrentMonthDate,
        .TESTcpCurrentMonthDateDisabled,
 .TESTcpOtherMonthDate,
        .TESTcpOtherMonthDateDisabled,
        .TESTcpCurrentDate,
        .TESTcpCurrentDateDisabled,
        .TESTcpTodayText,
        .TESTcpTodayTextDisabled,
        .TESTcpText
                        {
                        font-family:arial;
                        font-size:8pt;
                        }
        TD.TESTcpDayColumnHeader
                        {
                        text-align:right;
                        border:solid thin #6677DD;
                        border-width:0 0 1 0;
                        }
        .TESTcpCurrentMonthDate,
        .TESTcpOtherMonthDate,
        .TESTcpCurrentDate
                        {
                        text-align:right;
                        text-decoration:none;
                        }
        .TESTcpCurrentMonthDateDisabled,
        .TESTcpOtherMonthDateDisabled,
        .TESTcpCurrentDateDisabled
                        {
                        color:#D0D0D0;
       text-align:right;
                        text-decoration:line-through;
                        }
        .TESTcpCurrentMonthDate
                        {
                        color:#6677DD;
                        font-weight:bold;
                        }
        .TESTcpCurrentDate
                        {
                        color: #FFFFFF;
                        font-weight:bold;
                        }
        .TESTcpOtherMonthDate
                        {
                        color:#808080;
                        }
        TD.TESTcpCurrentDate
                        {
                        color:#FFFFFF;
                        background-color: #6677DD;
                        border-width:1;
                        border:solid thin #000000;
                        }
        TD.TESTcpCurrentDateDisabled
                        {
                        border-width:1;
                        border:solid thin #FFAAAA;
                        }
TD.TESTcpTodayText,
        TD.TESTcpTodayTextDisabled
                        {
                        border:solid thin #6677DD;
                        border-width:1 0 0 0;
                        }
        A.TESTcpTodayText,
        SPAN.TESTcpTodayTextDisabled
                        {
                        height:20px;
                        }
        A.TESTcpTodayText
                        {
                        color:#6677DD;
                        font-weight:bold;
                        }
        SPAN.TESTcpTodayTextDisabled
                        {
                        color:#D0D0D0;
                        }
        .TESTcpBorder
                        {
                        border:solid thin #6677DD;
                        }
</STYLE>
<style>
   body,table,input{
   	font-size:12px
   }
 </style>
</HEAD>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$nkt1="";

if (isset($_POST[submit])) {
	for ($i=0; $i<sizeof($_POST[merk1]); $i++) {
		$nmr=$_POST[merk1][$i]; 				$njn=$_POST[jenis];	
		$nst=$_POST[status]; 					$nvo=$_POST[volume1][$i];
		$nkt=$_POST[no_kantong][$i];				$nkt1 .=$nkt.",";
		$nkt=ereg_replace("[^A-Za-z0-9]", "",strtoupper($nkt));	$prod=$_POST[produk1][$i];
		$today=date("Y-m-d");				        $utd=$_POST[kodeSup];
		$gol=$_POST[gol1][$i];					$tglaftap=$_POST[tglaftap1][$i];
		$exp=$_POST[tglkad1][$i];				$rh=$_POST[rh1][$i];
		$olah=$_POST[tglolah1][$i];				$pengirim=$_POST[pengirim1][$i];
		$njn2=$_POST[jenis2];
$tambah=mysql_query("insert into registrasi_qc (nokantong,produk,volume,goldarah,rhesus,tgl,tglaftap,tgl_pengolahan,kadaluwarsa,petugas_terima,petugas_serah,merk,jenis,asal_utd) values ('$nkt','$prod','$nvo','$gol','$rh','$today','$tglaftap','$olah','$exp','$namauser','$pengirim','$nmr','$njn2','$utd') ");

$tambah_stok=mysql_query("insert into stokkantong (noKantong,produk,gol_darah,RhesusDrh,tgl_Aftap,tglpengolahan,kadaluwarsa,merk,jenis,AsalUTD,volume,StatTempat,statQC,Status,statKonfirmasi,
sah,stat2) values ('$nkt','$prod','$gol','$rh','$tglaftap','$olah','$exp','$nmr','$njn2','$utd','$nvo','-','0','2','1',
'1','QC') ");
	
	}
	if ($tambah) {
        echo "Data Telah berhasil dimasukkan. ";?>
	<?}
} ?>
	<body onLoad=setFocus()>
	<form name="tambahkantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table align=top>
	<tr>
			<td>

<input name="submit" type="submit" value="Simpan" class="swn_button_blue">
<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" class="swn_button_red"/>
<a href="pmiqc.php?module=register_qc" class="swn_button_green">Kembali</a></td>

<!--input type="button" value="Add" onclick="addRow('box-table-b');"-->
			</td>
			<td> </td>
		</tr>
		<tr>
			<td valign=top>
				<table class="form" border="0" align=top>

						<tr style="visibility:hidden";  >
						<td >Jenis Kantong</td>
						<td class="input">
							<select name="jenis">
							<?
							$select1=''; 	$select2='';
							$select3='';	$select4='';
							$select6='';
							if ($_POST[jenis]=='1') $select1='selected';
							if ($_POST[jenis]=='2') $select2='selected';
							if ($_POST[jenis]=='3') $select3='selected';
							if ($_POST[jenis]=='4') $select4='selected';
							if ($_POST[jenis]=='6') $select6='selected';
							?>
							<option value="1" <?=$select1?>>Single</option>
							<option value="2" <?=$select2?>>Double</option>
							<option value="3" <?=$select3?>>Triple</option>
							<option value="4" <?=$select4?>>Quadruple</option>
							<option value="6" <?=$select6?>>Pediatrik</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Merk</td>
						<td class="input">
							<select name="merk">
							<?
							$select1='';	$select2='';
							$select3='';	$select4='';
							if ($_POST[merk]=='KARMI') $select1='selected';
							if ($_POST[merk]=='TERUMO') $select2='selected';
							if ($_POST[merk]=='JMS') $select3='selected';
							if ($_POST[merk]=='JML') $select4='selected';
							if ($_POST[merk]=='HLHAEMOPACK') $select5='selected';
							if ($_POST[merk]=='GREENCROSS') $selected6='selected';
							if ($_POST[merk]=='Produk DEMO') $select7='selected';
							?>
							<option value="KARMI" <?=$select1?>>KARMI</option>
							<option value="TERUMO" <?=$select2?>>TERUMO</option>
							<option value="JMS" <?=$select3?>>JMS</option>
							<option value="JML" <?=$select4?>>JML</option>
							<option value="HLHAEMOPACK" <?=$select5?>>HLHAEMOPACK</option>
							<option value="GREENCROSS" <?=$select6?>>GREENCROSS</option>
							<option value="Produk DEMO" <?=$select7?>>Produk DEMO</option>
							</select>
						</td>
					</tr>
			<tr>
			<td>Jenis Kantong</td>
			<td class="input">
				<select name="jenis2">
					<option value="1">Single</option>
					<option value="2">Double</option>
					<option value="3">Triple</option>
					<option value="4">Quadruple</option>
					<option value="6">Pediatrik</option>
					</select>
			</td>
			</tr>

					
			<tr> 
			<td>Jenis Produk</font></td>
			<td class="input">
				<select name="produk" >
					<option selected>--Pilih Produk--</option>
					<?php
						$permintaan1="select * from produk order by Nama DESC";
						$do1=mysql_query($permintaan1);
						while($data1=mysql_fetch_assoc($do1)){
							$select1="";?>
					<option value="<?=$data1[Nama]?>"<?=$select1?>>
						<?=$data1[Nama]?>
					</option>
						<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Golongan Darah</td>
			<td class="input">
				<select name="goldarah">
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="O">O</option>
					<option value="AB">AB</option>
					</select>
			</td>
		</tr>

		<tr>
			<td>Rhesus</td>
			<td class="input">
				<select name="rh">
					<option value="+">Positif</option>
					<option value="-">Negatif</option>
					</select>
			</td>
		</tr>

					<tr>
						<td>Volume</td>	
						
						<td class="input"><INPUT type="text" size="5" name="volume" id="volume">									</td>
					</tr>

	
<tr> 
<td>Asal Sampel</font></td>
<td class="input">
<select name="kodeSup" >
<option value="" selected>--Pilih UDD--</option>
            <?php
            $ql= mysql_query("select * from utd order by daerah ASC");
            while ($rowl1 = mysql_fetch_array($ql)){
                echo "<option value='$rowl1[id]'>$rowl1[nama]</option>";
            }
            ?>
</select>
</td>
</tr>

<tr><td>Nama Pengirim</td>
<td class="input"><INPUT type="text" size="30" name="pengirim" id="pengirim"></td>
</tr>
	
<td>Tgl Aftap</td>
        <td class="input"><INPUT TYPE="text" NAME="tglaftap" VALUE="" SIZE=8>
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglaftap,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglaftap,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>

<td>Tgl Kadaluarsa</td>
        <td class="input"><INPUT TYPE="text" NAME="tglkad" VALUE="" SIZE=8>
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglkad,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglkad,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>

<td>Tgl Pengolahan</td>
        <td class="input"><INPUT TYPE="text" NAME="tglolah" VALUE="" SIZE=8>
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglolah,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglolah,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>

					<tr>
						<td>Jumlah Cetak Barcode</td>
						<? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='2';?>
						<td class="input"><INPUT size=2 type="text"  name="cetakkantong" id="cetakkantong" value="<?=$_POST[cetakkantong]?>">
						</td>
					</tr>

					<tr>
						<td>No Kantong</td>
						<td class="input"><INPUT type="text"  name="nokantong" id="nokantong"  placeholder="Masukkan No.Kantong"
							onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');">
						</td>
					</tr>
				</table>
			</td>
			<td valign=top><br/><br/>
				<table class="list" id="box-table-b" width=350px align=top>
					<tr class="field">
						<td align='center'></td>
						<td align='center'>No</td>
						<td align='center'>No Kantong</td>
						<td align='center'>Volume</td>
						<td align='center'>Merk</td>
						<td align='center'>Produk</td>
						<td align='center'>Tgl Aftap</td>
						<td align='center'>Tgl Kadaluarsa</td>
						<td align='center'>Tgl Pengolahan</td>
						<td align='center'>Gol Darah</td>
						<td align='center'>Rhesus</td>
						<td align='center'>Nama Pengirim</td>
						
						
					</tr>

				</table>
			<!--<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" />

<input name="submit" type="submit" value="Simpan">
<!--<input type="button" value="Add" onclick="addRow('box-table-b');">--> 
			</td>


		</tr>
	
	</table>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
</form>
	
