
<head>
<script language=javascript src="idhasil.js" type="text/javascript"> </script>
<script language=javascript src="util.js" type="text/javascript"> </script>
</head>
<body OnLoad="document.label_lab.cetak.focus();">
<form name="label_lab">

<b>Cetak Sample Nomor Transaksi : <? echo $_GET['ns'];?></b><br>
<table border="0">
<?
require_once('config/db_connect.php');
$notrans=$_GET['ns'];
$kantong=mysql_query("select * from samplekode where sk_trans='$notrans'");
    while($kkomp=mysql_fetch_assoc($kantong)){
    
        if ($kkomp['sk_jenis']=="APH"){
               $jenis = "APHERESIS";
           }else if ($kkomp['sk_jenis']=="TPK"){
               $jenis = "PLASMA KONVALESEN";
           }else {
               $jenis = "KONSELING";
           }
       
?>

        <tr><td>No Sample :</td><td><? echo $kkomp['sk_kode']?></td></tr>
        <tr><td>Jenis Sample :</td><td><? echo $jenis?></td></tr>
<?
}
?>
<tr><td>
    <input name="cetak" type=button value="Cetak" id="cetak" onclick="$.fn.colorbox({href:'idsample_barcode.php?notrans=<?=$_GET['ns']?>', iframe:true, innerWidth:350, innerHeight:350},function(){ $().bind('cbox_closed', function(){window.location ='pmikomponen.php?module=laborat_komponen'})});">
    </td><td></td></tr>
</table>
</form>
</body>
