<? include ('../config/db_connect.php'); ?>
<link href="../modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../modul/thickbox/thickbox.js"></script>

<script language="javascript">
function selectSupplier(Kode){
      $('input[@name=id]').val(Kode);
      tb_remove();
}
function selectKode(Kode){
      $('input[@name=id]').val(Kode);
      tb_remove();
      dbar(Kode);
}
</script>
<script language="javascript">
function selectSupplier(Kode1){
      $('input[@name=id1]').val(Kode1);
      tb_remove();
}
function selectKode1(Kode1){
      $('input[@name=id1]').val(Kode1);
      tb_remove();
      dbar(Kode1);
}
</script>


<SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>

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

</head>

<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script language="javascript">
function setFocus(){document.sehat.kode.focus();}
</script>
<?
if ($_POST[konfirmasi]=='1') {
mysql_query("update stokkantong set status='3' where (status='1' or status='2')");
mysql_query("update dtransaksipermintaan set status='0' where status='1'");
}
if (isset($_POST[submit0])) {
?>
Anda Yakin akan mengosong seluruh STOK Darah ???
<br>
<form name=konfirm method=post>
<input type=hidden name=konfirmasi value='1'>
<input type=submit name=submit01 value='Klik Disini jika Ya'>
</form>
<?
} else {
if (isset($_POST[submit])) {
$sehatup1=mysql_query("update stokkantong set kodependonor='$_POST[id]'  where noKantong='$_POST[nokantong]' ");
$sehatup2=mysql_query("update htransaksi set kodependonor='$_POST[id]'  where NoKantong='$_POST[nokantong]' ");
$sehatup3=mysql_query("update stokkantong set kodependonor='$_POST[id1]'  where noKantong='$_POST[nokantong1]' ");
$sehatup4=mysql_query("update htransaksi set kodependonor='$_POST[id1]'  where NoKantong='$_POST[nokantong1]' ");
//$total=mysql_num_rows(mysql_query("select noKantong from stokkantong where gol_darah='$_POST[gol_darah]' and Status='$_POST[status]' and produk='$_POST[produk]' and sah='1'"));
if ($sehatup1) echo "Data Kantong pendonor dengan Kode: $_POST[id] dan $_POST[id1] telah diupdate dan ";
if ($sehatup2) echo "Data transaksi pendonor dengan Kode: $_POST[id] dan $_POST[id1] telah diupdate";
}
?>



    <body onLoad=setFocus()>
<!--b>Pengosongan Stok</b>:<br>
<form name=kosong method=POST>
<input type=submit name=submit0 value='KOSONGKAN !!!!'-->
</form>
<br>
<b>PERTUKARAN KANTONG</b><br>
<br>
<b>Masukkan nomor kantong yang sesuai dengan kode pendonornya</b><br>
<form name=sehat method=POST>
<table>
<tr><td>Nomor Kantong 1</td><td>:</td><td> <input type=text name=nokantong size=15 value=<?=$_POST[nokantong]?>>
</td></tr>
<tr><td>Kode Pendonor 1</td><td>:</td><td>  <input type=text name=id size=20 value=<?=$_POST[id]?>> <a href="../modul/daftar_pendonor_tertukar.php?&width=500&height=350" class="thickbox"><img src="../images/button_search.png" border="0" /></a>
</td></tr>
<tr><td>Nomor Kantong 2</td><td>:</td><td> <input type=text name=nokantong1 size=15 value=<?=$_POST[nokantong1]?>>
</td></tr>
<tr><td>Kode Pendonor 2</td><td>:</td><td>  <input type=text name=id1 size=20 value=<?=$_POST[id1]?>> <a href="../modul/daftar_pendonor_tertukar1.php?&width=500&height=350" class="thickbox"><img src="../images/button_search.png" border="0" /></a>

</td></tr-->
</table>
<input type=submit name=submit value=Submit>
</form>
<? } ?>
</body>

