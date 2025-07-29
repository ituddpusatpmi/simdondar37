<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/alert.js" type="text/javascript"> </script>
<script language=javascript src="js/jquery-1.4.2.min.js"></script>
<script language=javascript src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<style type="text/css">
<!--
	@import url("topstyle.css");
-->
</style>
<body OnLoad="document.checkkantong.id_kantong.focus();">
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namabdrs=$_SESSION[bdrs];
$idbdrs=mysql_fetch_assoc(mysql_query("select kode from bdrs where nama='$namabdrs' limit 1"));

if(isset($_POST['btn_simpan']))  { 
    $nokantong  	= $_POST['id_kantong'];
    $statusdarah	= $_POST['statuskantong'];
    //Cari stokkantong berdasarkan bdrs
    $sql="select * from stokkantong where noKantong='$nokantong' and stat2='$idbdrs[kode]' limit 1";
    $q_kantong=mysql_query($sql);
    $row=mysql_fetch_row($q_kantong);
    if ($row==0){
        echo "Nomor Kantong $nokantong TIDAK ADA pada stok BDRS $namabdrs";
    }else{
        $sql="update stokkantong set Status='$statusdarah' where noKantong='$nokantong' and stat2='$idbdrs[kode]'";
        $q_update=mysql_query($sql);
        if ($q_update){
         echo "Nomor Kantong $nokantong BERHASIL di proses pada BDRS $namabdrs";
        }
    }
    ?> <META http-equiv="refresh" content="5; url=pmibdrs.php?module=stok_update"><?
}?>
<h2><font color="red" >UPDATE STATUS KANTONG DARAH - <?=$namabdrs?> </h2></font>
<form class="table" name="checkkantong" id="checkkantong" method="POST">
	<table class="list" cellpadding=2 cellspacing=1>
		<tr class="field">
			<td align="left">Nomor kantong</td>
			<td><INPUT type="text" size="25" name="id_kantong" id="id_kantong"/></td>
		</tr>
          <tr class="field">
                <td align="left">Status</td>
                <td>
                    <select name="statuskantong" id="statuskantong">
                        <option value=3>Darah telah ditransfusikan</option>
                        <option value=5>Kantong Bocor</option>
                        <option value=5>Darah Rusak</option>
                        <option value=5>Darah kadaluwarsa</option>
                    </select>
                </td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="btn_simpan" value="Proses Kantong" class="swn_button"></td>
          </tr>
	</table>
</form>
</body>
