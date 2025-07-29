<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    document.checkkantong.nokantong1.focus();
});
</script>
<?
include('clogin.php');
include('config/db_connect.php');
$tangggal=date("Y-m-d");
if (isset($_POST[submit])) {
	$nokantong=substr($_POST[nokantong1],0,-1);
	$nokantongA=$nokantong.'A';
	$check="SELECT * from stokkantong where noKantong='$nokantongA'";
	$qchk=mysql_fetch_assoc(mysql_query($check));
	if ($nokantongA==$qchk['noKantong']){
		$nrapid1=mysql_num_rows(mysql_query("select nokantong from drapidtest where nokantong='$nokantongA'"));
		$nelisa1=mysql_num_rows(mysql_query("select noKantong from hasilelisa where noKantong='$nokantongA'"));
		$totalparam=$nrapid1+$nelisa1;
		switch ($totalparam){
			case '0' :?><script language="javascript">alert("Belum ada data pemeriksaan Uji Saring IMLTD!!????");</script><? break;
			case '4' :echo "<meta http-equiv=\"refresh\" content=\"0; URL=../pmikonseling.php?module=cetakhasil_imltd&nokantong=$nokantongA\">";break;
			default  :?><script language="javascript">alert("Pemeriksaan uji Saring IMLTD belum lengkap...");</script><?
		}
	} else{?><script language="javascript">alert("Nomor kantong yang anda masukkan belum terdaftar...");</script><?}
}?>
<form name="checkkantong" method="POST">
	<table summary="Check kantong">
		<tr><td> Masukkan No Kantong</td><td>:<input type=text name=nokantong1><input type=submit name=submit value="Cari" class="swn_button">
		</td></tr>
	</table>
</form>


<?

