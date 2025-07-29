<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$today=date('Y-m-d');
$today1=$today;
$srcnama="";



if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[nama]!='') $srcnama=$_POST[nama];
?>
<style>
tr { background-color: #FDF5E6}
.initial { background-color: #FDF5E6; color:#000000 }
.normal { background-color: #FDF5E6 }
.highlight { background-color: #7FFF00 }
</style>
<center><font size="5" color=red>DAFTAR PENERIMAAN SAMPEL</font></center><br>
<form method=post>
    <font size="2" color=black>
    
      <table width ="30%">
      <tr>
          <td>TANGGAL</td><td><input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
          S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>></td>
      </tr>
      
      <tr>
        <td>NAMA PASIEN </td> <td><input type=text name=nama id=nama size=30 value=<?=$srcnama?>><input type="submit" name="submit" value="CARI" class="swn_button_blue"></td>
        
      </tr>
      
      </table>
</tr>
</form>
<?



$allcount=mysql_query("select *, date(tgl) as tanggal, time(tgl) as jam from terima_sampel where date(tgl) between '$today' AND '$today1' ");
    $trans0=mysql_query("select *, date(tgl) as tanggal, time(tgl) as jam from terima_sampel where date(tgl) between '$today' AND '$today1' and pasien like '%$srcnama%' order by tgl asc");
                        
$rows=mysql_num_rows($trans0);
$rows2=mysql_num_rows($allcount);

echo'<br><b>';
echo 'Terdapat '.$rows ;
/*echo' data dari total ';
echo $rows2;*/
echo' penerimaan sampel';
echo $src_produk ;
echo'<b>';
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" >
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td >NO</td>
        <td >TANGGAL</td>
        <td >JAM
        <td >NO. FORM</td>
        <td >NAMA PASIEN</td>
        <td >GOL. DARAH</td>
        <td >RUMAH SAKIT</td>
        <td >PETUGAS PENERIMA</td>
        </tr>
    <?
    $no=1;
    while ($trans=mysql_fetch_assoc($trans0)) {?>
        
        <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                                          
            <td align="right"><?=$no++?></td>
            <td><?=$trans[tanggal]?></td>
            <td><?=$trans[jam]?></td>
            <td><?=$trans[noform]?></td>
            <? $caripas = mysql_fetch_assoc(mysql_query("select no_rm,rs from htranspermintaan where noform='$trans[noform]'"));
                $pas = mysql_fetch_assoc(mysql_query("select nama from pasien where no_rm='$caripas[no_rm]'"));
                $rs  = mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$caripas[rs]'"));?>
            <td><?=$pas[nama]?></td>
            <td><?=$trans[goldrh]?></td>
            <td><?=$rs[NamaRs]?></td>
            <td><?=$trans[petugas]?></td>
           
    </tr>
    <?
    }
    ?>
</table>


