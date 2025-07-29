<HEAD>
<script language=javascript src="./js/rujukan.js" type="text/javascript"> </script>
<script language=javascript src="./js/util.js" type="text/javascript"> </script>
<script language="javascript" src="./js/AjaxRequest.js" type="text/javascript"></script>
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
session_start();
$namauser=$_SESSION[namauser];
$nama_lengkap=$_SESSION[nama_lengkap];

include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$nkt1="";

//notransaksi
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$kd='DG';
if ($td1=='B') $kd=$td0;
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= $tgl.$bl.$th."-";
$idp	= mysql_query("select notrans from rujukanbaru where notrans like '%$kdtp%' order by notrans DESC");
$idp1	= mysql_fetch_assoc($idp);
//$idp2	= (int)(substr($idp1[nomer],9,3));
$idp2	= substr($idp1[notrans],9,3);
if ($idp2<1) {$idp2="000";}
$idp3	= (int)$idp2+1;
$id31	=3-(strlen(strval($idp3)));
//$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$notrans=$kd.$kdtp.$idp4.$idp3;
$noform1=$_GET[noform];
$jumlah1=mysql_fetch_assoc(mysql_query("select Kodependonor from stokkantong where NoKantong='$_GET[merk]')"));
$jumlah2=mysql_fetch_assoc(mysql_query("select Kodependonor_lama from stokkantong where NoKantong='$_GET[merk]')"));
$today=date("Y-m-d");
//batas notransaksi

if (isset($_POST[submit])) {
	for ($i=0; $i<sizeof($_POST[merk1]); $i++) {
		$nmr=$_POST[merk1][$i]; 				$njn=$_POST[sampel1][$i];	
		$nst=$_POST[status]; 					$nvo=$_POST[volume1][$i];
		$nkt=$_POST[no_kantong][$i];				$nkt1 .=$nkt.",";
		$nkt=ereg_replace("[^A-Za-z0-9]", "",strtoupper($nkt));	$prod=$_POST[produk];
		$today=date("Y-m-d");					$utd=$_POST[kodeSup];
		$gol=$_POST[goldarah];					$tglaftap=$_POST[tglaftap];
		$exp=$_POST[tglKad];					$rh=$_POST[rh];
		$tglperiksa=$_POST[tglperiksa];
        $tambah=mysql_query("insert into
				rujukanbaru (notrans,nosample,nokantongasal,jenis,status,tglinput,volume,gol_darah,RhesusDrh,uddtujuan,kodependonor,kodependonor_lama,tgl_Aftap,kadaluwarsa,tglperiksa,tglkirim,petugas) 
				values ('$notrans','$nkt','$nmr','$njn','$nst','$today','$nvo','$gol','$rh','$utd','$jumlah1','$jumlah2','$tglaftap','$exp','$tglperiksa','$tglaftap','$nama_lengkap')");
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
<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" />
				<input name="submit" type="submit" value="Simpan">
<!--input type="button" value="Add" onclick="addRow('box-table-b');"-->
			</td>
			<td> </td>
		</tr>
		<tr>
			<td valign=top>
				<table class="form" border="0" align=top>
	<tr>
						<td>No Kantong Asal</td>
						<td class="input">
							<input name="merk" size="15" >
							</input>
						</td>
					</tr>
					<!--tr>
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
							if ($_POST[merk]=='Produk DEMO') $select6='selected';
							?>
							<option value="KARMI" <?=$select1?>>KARMI</option>
							<option value="TERUMO" <?=$select2?>>TERUMO</option>
							<option value="JMS" <?=$select3?>>JMS</option>
							<option value="JML" <?=$select4?>>JML</option>
							<option value="HLHAEMOPACK" <?=$select5?>>HLHAEMOPACK</option>
							<option value="Produk DEMO" <?=$select6?>>Produk DEMO</option>
							</select>
						</td>
					</tr>
					
						<tr> 
			<td>Jenis Darah</font></td>
			<td class="input">
				<select name="produk" >
					<option selected>WB</option>
					<?php
						$permintaan1="select * from produk";
						$do1=mysql_query($permintaan1);
						while($data1=mysql_fetch_assoc($do1)){
							$select1="";?>
					<option value="<?=$data1[Nama]?>"<?=$select1?>>
						<?=$data1[Nama]?>
					</option>
						<?}?>
				</select>
			</td>
		</tr-->
		<tr>
			<td>Jenis Sample</td>
			<td class="input">
				<select name="sampel">
					<option value="Serum">Serum</option>
					<option value="Plasma">Plasma</option>
					</select>
			</td>
		</tr>
		<tr>
			<td>Golongan Darah</td>
			<td class="input">
				<select name="goldarah">
					<option value="O">O</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="AB">AB</option>
					</select>
			</td>
		</tr>

		<tr>
			<td>Rhesus Darah</td>
			<td class="input">
				<select name="rh">
					<option value="+">Positip</option>
					<option value="-">Negatip</option>
					</select>
			</td>
		</tr>

					<tr>
						<td>Volume</td>	
						<td class="input">
							<input name="volume" size="6" >
							
							</input>
						</td>
					<tr>
						<td>Lembar Cetak</td>
						<td class="input">
							<select name="jenis">
							<?
							$select1=''; 	$select2='';
							if ($_POST[jenis]=='1') $select1='selected';
							if ($_POST[jenis]=='2') $select2='selected';
							?>
							<option value="1" <?=$select1?>>Satu</option>
							<option value="2" <?=$select2?>>Dua</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Status</td>	
						<td class="input">
							<select name="status" >
							<option value="baik"  selected>Baik</option>
							<option value="lysis">Lysis</option>
							</select>
						</td>
					</tr>

	<tr>
<td>Kode UDD Tujuan</td>
	<td class="input"><input name="kodeSup" type="text" size="5" value="3174">Klik<a href="modul/daftar_udd.php?&width=500&height=400" class="thickbox"><img src="images/button_search.png" border="0" /></a>untuk lihat kode</td>
	</tr>
	<!--td>Tgl Aftap th-bln-tgl</td>
						<td class="input"><INPUT size=15 type="text"  name="tglaftap" >
						</td>
					</tr>
					<!--tr>
						<td>Tgl Kadaluarsa th-bln-tgl</td>
						<td class="input"><INPUT size=15 type="text"  name="tglexp" >
						</td>
					</tr-->
<td>Tgl Aftap</td>
        <td class="input"><INPUT TYPE="text" NAME="tglaftap" VALUE="" SIZE=8>
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglaftap,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglaftap,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>

<td>Tgl Kadaluarsa</td>
        <td class="input"><INPUT TYPE="text" NAME="tglKad" VALUE="" SIZE=8>
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglKad,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglKad,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>

<td>Tgl Periksa</td>
        <td class="input"><INPUT TYPE="text" NAME="tglperiksa" VALUE="" SIZE=8>
<A HREF="#" onClick="cal1xx.select(document.forms[0].tglperiksa,'anchor1xx','yyyy-MM-dd'); return false;" TITLE="cal1xx.select(document.forms[0].tglperiksa,'anchor1xx','yyyy-MM-dd'); return false;" NAME="anchor1xx" ID="anchor1xx">klik</A></td>
    </tr>

					<tr>
						<td>Jumlah Cetak</td>
						<? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='2';?>
						<td class="input"><INPUT size=2 type="text"  name="cetakkantong" id="cetakkantong" value="<?=$_POST[cetakkantong]?>">
						</td>
					</tr>

					<tr>
						<td>No Sample</td>
						<td class="input"><INPUT type="text"  name="nokantong" id="nokantong"  
							onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');">
						</td>
					</tr>
			<tr >
						<td></td>
					<td >S/P,0/1,0/1,0/1,(A,B,AB,O),25,01,01,13</td>
						
					</tr>

			<tr >
						<td >Ket Digit Penulisan Sample :</td>
					<td >Jenis Sampel,LK/PR,Baru/Lama,DS/DP,Gol Darah,Usia,Tgl,Bln,Tahun Aftap</td>
						
					</tr>

				</table>
			</td>

			<td valign=top>
				<table class="list" id="box-table-b" width=350px align=top>
					<tr class="field">
						<td align='center'></td>
						<td align='center'>No</td>
						<td align='center'>No Sample</td>
						<td align='center'>Volume</td>
						<td align='center'>No Kantong Asal</td>
						<td align='center'>Jenis</td>
						<td align='center'>Gol Darah</td>
						<td align='center'>Rhesus</td>
						
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
	
