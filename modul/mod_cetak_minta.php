<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<?
include ("config/db_connect.php");
//$noform1=str_replace("-","/",$_GET[noform]);
//$noform1=$_GET[noform];

$noform2=$_GET[noform];
$minta=mysql_fetch_assoc(mysql_query("select * from htranspermintaan where NoForm='$noform2'"));
$norm= $minta[no_rm];

$notrans=mysql_fetch_assoc(mysql_query("select ID from dtranspermintaan where NoForm='$noform2'"));
$notrans1= $notrans[ID];

$dopasien=mysql_fetch_assoc(mysql_query("SELECT * FROM pasien WHERE no_rm='$norm'"))
?>
<font size="5" color="red" face="Trebuchet MS"><b>CETAK PENGAMBILAN DARAH<br> (Tulis No.Form di formulir permintaan)</b></font>
<table class="form" cellspacing="2" cellpadding="2">
    <tr><td>No. Dokumen</td>
        <td class="input"><h2><font size="4" color="BLUE"><?=$notrans1?></font></h2></td>
    </tr>
    <tr><td>No. Formulir</td>
        <td class="input"><h2><?=$minta[noform]?></h2></td>
    </tr>
    <tr><td>Nama Pasien</td>
        <td class="input"><?=$dopasien[nama]?></td>
    </tr>
    <tr><td>Alamat Pasien</td>
        <td class="input"><?=$dopasien[alamat]?></td>
    </tr>
<?
$rs1=mysql_query("select NamaRs from rmhsakit where Kode='$minta[rs]'");
$rs=mysql_fetch_assoc($rs1);
?>
    <tr><td>Nama RS</td>
        <td class="input"><?=$rs[NamaRs]?></td>
    </tr>
    <tr><td>Nama Ruangan</td>
        <td class="input"><?=$minta[bagian]?></td>
    </tr>
</table>

<br>
<? if (($_GET[jenisdarah]=='')&($_GET[jmlkntng]=='')){?>
    <input name=cetak type=button value="Cetak Bukti Pengambilan" class="swn_button_blue" onclick="$.fn.colorbox({href:'bukti.php?noform=<?=$minta[noform]?>',iframe:true,innerWidth:900,innerHeight:350},function(){ $().bind('cbox_closed',function(){window.location ='pmikasir2.php?module=cetak_minta&noform=<?=$minta[noform]?>'})});">
    <input type="button" class="swn_button_blue" onclick="location.href = '../idpasien_barcode2.php?idpendonor=<?=$minta[noform]?>';" value="Cetak Barcode Pasien">
    
    
    
<? } else {?>
    <input name=cetak type=button value="Cetak Bukti Pengambilan" class="swn_button_blue" onclick="$.fn.colorbox({href:'bukti_tambah.php?noform=<?=$minta[noform]?>&jenisdarah=<?=$_GET[jenisdarah]?>&jmlkntng=<?=$_GET[jmlkntng]?>',iframe:true,innerWidth:900,innerHeight:350},function(){ $().bind('cbox_closed',function(){window.location ='pmikasir2.php?module=cetak_minta&noform=<?=$minta[noform]?>'})});">
    <input type="button" class="swn_button_blue" onclick="location.href = '../idpasien_barcode2.php?idpendonor=<?=$minta[noform]?>';" value="Cetak Barcode Pasien">
<?}?>
