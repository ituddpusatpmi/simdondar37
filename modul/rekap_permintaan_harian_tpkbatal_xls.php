
<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_form_permintaan_darah.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');

    
$today   =$_POST[today];
$today1  =$_POST[today1];
$srcnama =$_POST[srcnama];
$srcrm   =$_POST[srccm];
$srcform =$_POST[srcform];
$src_abo =$_POST[src_abo];
$src_rh  =$_POST[src_rh];
$src_rs  =$_POST[src_rs];
$src_lyn =$_POST[src_lyn];
$src_produk=$_POST[src_produk];
?>
<font size="5" color=blue>REKAP PEMBATALAN PERMINTAAN DARAH</font><br>
<form method=post>
    <font size="3" color=blue>
    DARI TANGGAL :    <?=$today?>
    S/D TANGGAL  :    <?=$today1?>
    
    </font>
    <br>
    <font size="3" color=magenta>
    <!--input type="submit" name="submit" value="Lihat" class="swn_button_blue"-->
</form>
<?


if ($today==''){
$allcount=mysql_query("select * from htranspermintaan where CAST(htranspermintaan.tgl_register as date) >='2021-01-01' and CAST(htranspermintaan.tgl_register as date)<='$today1' ");
    $trans0=mysql_query("select htranspermintaan.*, pasien.nama, DATE_FORMAT(pasien.tgl_lahir, '%d-%m-%Y') as tgl_lahir, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin,pasien.umur, dtranspermintaan.JenisDarah,book_permintaan.tgl,
    book_permintaan.uraian,
    book_permintaan.petugas as petugasb,
    book_permintaan.detail FROM
    pmi.htranspermintaan
    JOIN pmi.pasien
    ON pmi.htranspermintaan.no_rm = pmi.pasien.no_rm
    JOIN pmi.dtranspermintaan
    ON pmi.dtranspermintaan.NoForm = pmi.htranspermintaan.noform
    JOIN pmi.book_permintaan
    ON pmi.book_permintaan.notrans = pmi.htranspermintaan.noform
                         where CAST(book_permintaan.tgl as date) >='2021-01-01' and CAST(book_permintaan.tgl as date)<='$today1'
                         and pasien.nama like '%$srcnama%'
                         and pasien.no_rm like '%$srcrm%'
                         and htranspermintaan.noform like '%$srcform%'
                         and pasien.gol_darah like '%$src_abo%'
                         and pasien.rhesus like '%$src_rh%'
                         and htranspermintaan.jenis like '%$src_lyn%'
                         and htranspermintaan.diagnosa like '%$src_diag%'
                         and htranspermintaan.rs like '%$src_rs%'
                         and htranspermintaan.bagian like '%$srcbagian%'
                         and htranspermintaan.status = 2
                        and dtranspermintaan.JenisDarah = 'FFP Konvalesen'
                        and book_permintaan.detail >0
                         group by htranspermintaan.noform
                         order by tgl_register desc");
                        } else {
                        $allcount=mysql_query("select * from htranspermintaan where CAST(htranspermintaan.tgl_register as date) >='$today' and CAST(htranspermintaan.tgl_register as date)<='$today1' ");
                        $trans0=mysql_query("select htranspermintaan.*, pasien.nama, DATE_FORMAT(pasien.tgl_lahir, '%d-%m-%Y') as tgl_lahir, pasien.alamat, pasien.gol_darah, pasien.rhesus, pasien.kelamin,pasien.umur, dtranspermintaan.JenisDarah, book_permintaan.tgl,
                        book_permintaan.uraian,
                        book_permintaan.petugas as petugasb,
                        book_permintaan.detail FROM
                        pmi.htranspermintaan
                        JOIN pmi.pasien
                        ON pmi.htranspermintaan.no_rm = pmi.pasien.no_rm
                        JOIN pmi.dtranspermintaan
                        ON pmi.dtranspermintaan.NoForm = pmi.htranspermintaan.noform
                        JOIN pmi.book_permintaan
                        ON pmi.book_permintaan.notrans = pmi.htranspermintaan.noform
                                             where CAST(book_permintaan.tgl as date) >='$today' and CAST(book_permintaan.tgl as date)<='$today1'
                                             and pasien.nama like '%$srcnama%'
                                             and pasien.no_rm like '%$srcrm%'
                                             and htranspermintaan.noform like '%$srcform%'
                                             and pasien.gol_darah like '%$src_abo%'
                                             and pasien.rhesus like '%$src_rh%'
                                             and htranspermintaan.jenis like '%$src_lyn%'
                                             and htranspermintaan.diagnosa like '%$src_diag%'
                                             and htranspermintaan.rs like '%$src_rs%'
                                             and htranspermintaan.bagian like '%$srcbagian%'
                                             and dtranspermintaan.JenisDarah = 'FFP Konvalesen'
                                             and htranspermintaan.status = 2
                                             and book_permintaan.detail like '%$src_batal%'
                                             group by htranspermintaan.noform
                                             order by tgl_register desc");
                        
                        }
$rows=mysql_num_rows($trans0);
$rows2=mysql_num_rows($allcount);

echo'Sebanyak ';
echo $rows ;
echo' data ';

echo'<b>';
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" >
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td rowspan=2 align="center">NO</td>
            <td rowspan=2 align="center">TGL MINTA</td>
            <td rowspan=2 align="center">TGL. BATAL</td>
            <td rowspan=2 align="center">NAMA PASIEN</td>
        <td rowspan=2 align="center">JENIS<br>KEL</td>
        <td rowspan=2 align="center">TGL LAHIR</td>
            <td rowspan=2 align="center">ALAMAT</td>
            <td rowspan=2 align="center">RUMAH SAKIT</td>
        <td rowspan=2 align="center">DIAGNOSA</td>
        <td rowspan=2 align="center">BAGIAN</td>
        <td rowspan=2 align="center">PERMINTAAN<br>PRODUK</td>
         <td rowspan=2 align="center">JENIS<br>LAYANAN</td>
            <td rowspan=2 align="center">GOL</td>
        <!--td rowspan=2 align="center">TGL DIPERLUKAN</td-->
        <td rowspan=2 align="center">JENIS BATAL</td>
        <td rowspan=2 align="center">KETERANGAN</td>
        <td rowspan=2 align="center">PETUGAS INPUT</td></tr>
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        </tr>
    <?
    $no=1;
    while ($trans=mysql_fetch_assoc($trans0)) {
        $jenisminta=mysql_fetch_assoc(mysql_query("select group_concat(' ',`JenisDarah`,'(',jumlah,')') as jenis from dtranspermintaan where `NoForm`='$trans[noform]'"));
        $dtrans=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah,GolDarah,JenisDarah from dtranspermintaan where NoForm='$trans[noform]'"));
        $nat0=mysql_fetch_assoc(mysql_query("select nat as statnat from dtranspermintaan where NoForm='$trans[noform]'"));
        $norm= $trans[no_rm];?>
        <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td align="right"><?=$no++?>.</td>
            
            
            <td class=input nowrap><?=$trans[tgl_register]?></td>
            <td class=input nowrap><?=$trans[tgl]?></td>
                                            <td class=input><?=$trans[nama].' ('.$trans[umur].'thn)'?></td>
            <td class=input><?=$trans[kelamin]?></td>
            <td class=input><?=$trans[tgl_lahir]?></td>
            <td class=input><?=$trans[alamat]?></td>
            <?$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$trans[rs]'"));?>
            <td class=input><?=$rmhskt[NamaRs]?></td>
            <td class=input><?=$trans[diagnosa]?></td>
            <td class=input><?=$trans[bagian]?></td>
            <td class=input nowrap><?=$trans[JenisDarah]?></td>
            <?
            $jenis=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$trans[jenis]'"));
                ?>
            <td class=input><?=$jenis[nama]?></td>
            <td class=input><?=$dtrans[GolDarah].'('.$trans[rhesus].')'?></td>
            <!--td class=input><?=$trans[tglminta]?></td-->

            <? $jnsbtl='LAIN-LAIN';
            if ($trans[detail]=='1') $jnsbtl='PASIEN SEMBUH';
            if ($trans[detail]=='2') $jnsbtl='PASIEN MENINGGAL';
            if ($trans[detail]=='3') $jnsbtl='PERMINTAAN RUMAH SAKIT';
            if ($trans[detail]=='4') $jnsbtl='PERMINTAAN KELUARGA';
            ?>
            <td class=input><? echo $jnsbtl?></td>
            <td class=input><?=$trans[uraian]?></td>
            <td class=input><?=$trans[petugasb]?></td>
    </tr>
<?
}
?>
</table>
<?
mysql_close();
?>
