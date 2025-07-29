<script language=javascript src="idhasil.js" type="text/javascript"> </script>
<script language=javascript src="util.js" type="text/javascript"> </script>
<body OnLoad="document.label_cross.noform.focus();">
<form name="label_kantong" method="POST">
    <table border=0>
        <tr>
            <td>No kantong</td>
            <td><input name="nokantong" type="text"></td>
        </tr>
        <tr>
            <td colspan=2>
            <input name="submit" type="submit" value="Submit">
            </td>
        </tr>
</form>

<?
require_once('config/db_connect.php');
if (isset($_POST[submit])) {
    $hasil=mysql_query("select * from stokkantong where noKantong='$_POST[nokantong]' ");
    $h=mysql_fetch_assoc($hasil);
    $n=mysql_num_rows($hasil);
    if ($h[StatTempat]=='') $tempat="Logistik";
    if ($h[StatTempat]=='1') $tempat="Lab";
    switch ($h[jenis]){
        case "1":
            $jenis="Single";
            break;
        case "2":
            $jenis="Double";
            break;
        case "3":
            $jenis="Triple";
            break;
        case "4":
            $jenis="Quadruple";
            break;
        case "6":
            $jenis="Pediatrik";
            break;
    }
//    if ($h[jenis]=='1') $jenis="Single";
//    if ($hasil[jenis]=='2') $jenis="Double";
//    if ($hasil[jenis]=='3') $jenis="Triple";
//    if ($hasil[jenis]=='4') $jenis="Quadrupe";
//    if ($hasil[jenis]=='6') $jenis="Pediatrik";


    switch ($h[Status]){
        case "0":
            $status="Kosong";
            break;
        case "1":
            $status="Karantina";
            break;
        case "2":
            $status="Sehat";
            break;
        case "3":
            $status="Keluar";
            break;
        case "6":
            $status="Musnah";
            break;
        case "4":
            $status="Rusak";
            break;
        case "5":
            $status="Rusak";
            break;
        case ">6":
            $status="Rusak";
            break;
    }


//    $nhasil1=mysql_num_rows($hasil);
//    $cek=mysql_query("select * from htranspermintaan where NoForm='$_POST[noform]'");
//    if (1>0) {
//        $h=mysql_fetch_assoc($cek);
//        $queryrs=mysql_query("select Kode, NamaRS from rmhsakit where Kode='$h[rs]'");
//	$queryrs1=mysql_fetch_assoc($queryrs);

//    if ($n>0) { ?>
<!--    <table border="0">-->
        <tr><td></td><td>No Kantong</td><td>:</td></td><td><b><?=$_POST['nokantong']?></b></td></tr>
<!--        <tr><td></td><td>Merek</td><td>:</td><td><b>--><?//=$h[merk]?><!--</b></td></tr>-->
<!--        <tr><td></td><td>Jenis</td><td>:</td><td><b>--><?//=$jenis?><!--</b></td></tr>-->
<!--        <tr><td></td><td>Status</td><td>:</td><td>--><?//=$status?><!--</td></tr>-->
<!--        <tr><td></td><td>Tempat</td><td>:</td><td>--><?//=$tempat?><!--</td></tr>-->
        <tr></td><td></td><td></td><td></tr>
        <!--<tr><td><input name=cetak1 type=button value="Barcode"
                       onclick="$.fn.colorbox({href:'idcard_barcode.php?idpendonor=<?=$h['noKantong']?>',
                           iframe:true, innerWidth:500, innerHeight:200});"></td></tr>-->
        <tr><td><input name=cetak1 type=button value="Barcode"
                       onclick="$.fn.colorbox({href:'labelkantong_manual.php?nokan=<?=$_POST['nokantong']?>',
                           iframe:true, innerWidth:500, innerHeight:200},function(){$().bind('cbox_closed',function(){window.location ='pmikomponen.php?module=label'})});"></td></tr>
<!--    </table>-->
<!--        --><?// } else {
//        echo "Kantong Nomor tersebut Belum Terdaftar";
//    }
}

?>


</table>
</body>
