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
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];

$status1="";
$shift1="";
if ($_POST[statuskeluar]!='') $status1=$_POST[statuskeluar];
if ($_POST[shift1]!='')  $shift1=$_POST[shift1];
$v_metode=$_POST['metode_c'];
$v_hasil_cross=$_POST['hasil_c'];



?>
<style>
    tr { background-color: #ffffff;}
    .initial { background-color: #ffffff; color:#000000 }
    .normal { background-color: #ffffff; }
    .highlight { background-color: #7CFC00 }
</style>
<style>
    table {
        border-collapse: collapse;
        box-shadow: 2px 2px 2px grey;
    }
    table, th, td {
        border: 1px solid brown;
        padding: 3px;
    }
</style>
<style>
    body {font-family: "Lato", sans-serif;}
</style>
<div style="background-color: #ffffff;font-size:24px; color:blue;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">RINCIAN HASIL UJI SILANG SERASI/<i>CROSSMATCH</i></b></div><br>

<form name=mintadarah1 method=post>
    <table>
        <tr style="font-size:14px; background-color: ghostwhite;">
            <th colspan="5">FILTER DATA</th><td><input type="submit" name="submit" value="Tampikan data" class="swn_button_blue"></td>
        </tr>
        <tr style="font-size:14px; background-color: ghostwhite;">
            <td>Dari tanggal</td><td><input type=text name=minta1 id=datepicker size=10 value="<?=$today?>"></td>
            <td>sampai tanggal</td><td><input type=text name=minta2 id=datepicker1 size=10 value="<?=$today1?>"></td>
            <td>Shift</td>
            <td>
                <select name=shift1>
                    <option value="">-</option>
                    <option value=1>SHIFT 1</option>
                    <option value=2>SHIFT 2</option>
                    <option value=3>SHIFT 3</option>
                    <option value=4>SHIFT 4</option>
                </select>
            </td>
        </tr>
        <tr style="font-size:14px; background-color: ghostwhite;">
            <td>Hasil <i>Crossmatch</i></td>
            <td>
                    <select name="hasil_c">
                        <option value="">-</option>
                        <option value="1">Compatible</option>
                        <option value="0">Incompatible boleh keluar</option>
                        <option value="2">Incompatible tidak boleh kaluar</option>
                    </select>
            </td>
            <td>Metode</td>
            <td>
                <select name="metode_c">
                    <option value="">-</option>
                    <option value="Tube Test">Tube Test</option>
                    <option value="Gel Test">Gel Test</option>
                </select>
            </td>
            <td>Status Keluar</td>
            <td>
                <select name="statuskeluar">
                    <option value="">-</option>
                    <option value="0">Dibawa/keluar</option>
                    <option value="1">Dititip</option>
                    <option value="B">Batal</option>
                </select>
            </td>

        </tr>
    </table>
</form>
<?
$q="select * from dtransaksipermintaan
    where date(tgl)>='$today' and date(tgl)<='$today1'
    and status like '%$status1%'
    and statuscross like '%$v_hasil_cross%'
    and MetodeCross like '%$v_metode%'
    and shift like '%$shift1%'
    order by NoForm,petugas ASC ";

$q_dtransaksipermintaan=mysql_query($q);
$TRec=mysql_num_rows($q_dtransaksipermintaan);
?>

<table border=1 cellpadding=4  style="border-collapse:collapse" >
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th colspan="27" align="left"><font size="4" color=00008B>Hasil Filter data <i>crossmatch</i>: <?=$TRec;?> Kantong</font></th>
    </tr>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th rowspan='3'>No</th>
        <th rowspan='3'>Tgl Cross</th>
        <th rowspan='3'>No Formulir</th>
        <th rowspan='3'>Nama<br>Pasien</th>

        <th rowspan='3'>No Kantong</th>
        <th rowspan='3'>Golda</th>
        <th rowspan='3'>Produk</th>
        <th rowspan='3'>Volume</th>
        <th rowspan='3'>Metode</th>
        <th colspan='7'>Uji Silang Serasi (<i>Crossmatch)</i></th>
        <th colspan='3'>Petugas</th>
        <th rowspan='3'>Tgl Aftap</th>
        <th rowspan='3'>Tgl Exp.</th>
        <th rowspan='3'>Status</th>
        <th rowspan='3'>Tgl Keluar</th>
        <th rowspan='3'>Kode<br>Pendonor</th>

        <th rowspan='3'>Tempat</th>
        <th rowspan='3'>Shift</th>
	</tr>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th rowspan='2' >Gell Test</th>
        <th colspan='3'>Fase<br>(Metode Tube Test)</th>
        <th colspan='3'>Keterangan Hasil</th>
        <th rowspan='2' >Crossmatch</th>
        <th rowspan='2' >Checker</th>
        <th rowspan='2' >Pengesahan</th>
	</tr>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th nowrap>Fase I</th>
        <th nowrap>Fase II</th>
        <th nowrap>Fase III</th>
        <th nowrap>Hasil</th>
        <th nowrap>Kesimpulan</th>
        <th nowrap>Ket</th>
	</tr>
    <?
    $no=1;
    while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	    $q_stok=mysql_query("select gol_darah,produk,RhesusDrh,kodePendonor,kadaluwarsa,tgl_Aftap,volume from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
	    $a_stok=mysql_fetch_assoc($q_stok);
        $pasien=mysql_fetch_assoc(mysql_query("select shift,no_rm from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]'"));
	    $a_bayar=mysql_fetch_assoc($pembayaran);
	    $a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	    $a_shift=mysql_fetch_assoc($shift);
        $hasil='Compatible';
        if ($a_dtransaksipermintaan[StatusCross]=='0') $hasil='Incompatible Keluar';
        if ($a_dtransaksipermintaan[StatusCross]=='2') $hasil='Incompatible Tdk Keluar';
        $status='Titip';
        if ($a_dtransaksipermintaan[Status]=='0') $status='Dibawa';
        if ($a_dtransaksipermintaan[Status]=='B') $status='Batal';
        switch ($a_dtransaksipermintaan[StatusCross]){
            case '0' : ?><tr style="font-size:12px; color:blue; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"> <?;break;
            case '2' : ?><tr style="font-size:12px; color:#ff0000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"> <?;break;
            default  : ?><tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?;break;
        }
	    ?>
        <td align="right"><?=$no++.'.'?></td>
        <td align="left" nowrap><?=date("Y-m-d H:i",strtotime($a_dtransaksipermintaan[tgl]));?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[NoForm]?></td>
        <?
        $pasien1=mysql_fetch_assoc(mysql_query("select Nama from pasien where no_rm='$pasien[no_rm]'"));
        if ($a_dtransaksipermintaan['fase1']=='tdk dilakukan'){$fs_1='';}else{$fs_1=$a_dtransaksipermintaan['fase1'];}
        if ($a_dtransaksipermintaan['fase2']=='tdk dilakukan'){$fs_2='';}else{$fs_2=$a_dtransaksipermintaan['fase2'];}
        if ($a_dtransaksipermintaan['fase3']=='tdk dilakukan'){$fs_3='';}else{$fs_3=$a_dtransaksipermintaan['fase3'];}
        ?>
        <td align="left" nowrap><?=$pasien1[Nama]?></td>

        <td align="left" nowrap><?=$a_dtransaksipermintaan[NoKantong]?></td>
        <td align="center" nowrap><?=$a_stok[gol_darah]?> (<?=$a_stok[RhesusDrh]?>)</td>
        <td align="center" nowrap><?=$a_stok[produk]?></td>
        <td align="left" nowrap><?=$a_stok[volume].' ml'?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[MetodeCross]?></td>
        <td align="center" nowrap><?=$a_dtransaksipermintaan[aglutinasi]?></td>
        <td align="left" nowrap><?=$fs_1?></td>
        <td align="left" nowrap><?=$fs_2?></td>
        <td align="left" nowrap><?=$fs_3?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[stat2]?></td>
        <td align="left" nowrap><?=$hasil?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[Ket]?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[petugas]?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[cheker]?></td>
        <td align="left" nowrap><?=$a_dtransaksipermintaan[mengesahkan]?></td>
        <td align="left" nowrap><?=date("Y-m-d",strtotime($a_stok[tgl_Aftap]));?></td>
        <td align="left" nowrap><?=date("Y-m-d H:i",strtotime($a_stok[kadaluwarsa]));?></td>
        <td align="left" nowrap><?=$status?></td>

        <td align="left" nowrap><?=$a_dtransaksipermintaan[tgl_keluar]?></td>
        <td align="left" nowrap><?=$a_stok[kodePendonor]?></td>
        <td align="center" nowrap><?=$a_dtransaksipermintaan[tempat]?></td>
        <td align="center" nowrap><?=$a_dtransaksipermintaan[shift]?></td>
	</tr>
	<?
}
?>
<br>
</table>
<form name=xls method=post action=modul/rekap_hasil_crossmatch_xls.php>
    <input type=hidden name=pertgl value="<?=$pertgl?>">
    <input type=hidden name=perbln value="<?=$perbln?>">
    <input type=hidden name=perthn value="<?=$perthn?>">
    <input type=hidden name=pertgl1 value="<?=$pertgl1?>">
    <input type=hidden name=perbln1 value="<?=$perbln1?>">
    <input type=hidden name=perthn1 value="<?=$perthn1?>">
    <input type=hidden name=today1 value="<?=$today1?>">
    <input type=hidden name=today value="<?=$today?>">
    <input type=hidden name=status1 value="<?=$status1?>">
    <input type=hidden name=shift1 value="<?=$shift1?>">
<input type=submit name=submit2 value='Print Rekap Hasil Crossmatch (.XLS)' class="swn_button_blue">
</form>

<?
mysql_close();
?>
<div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2018-12-31</div>
