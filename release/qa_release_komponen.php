<table class="list" border=1 cellpadding="5" cellspacing="5" width="100%" style="border-collapse:collapse">
    <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
        <td>No</td>
        <td>Tanggal</td>
        <td>Jenis Komponen</td>
        <td>Alat Pemutaran</td>
        <td>Alat Pemisahan</td>
        <td>Petugas</td>
    </tr>

    <?
    $a=mysql_query("SELECT  *, date(`insert_on`) as tanggal FROM `dpengolahan` where `nokantong`='$nkt' order by insert_on DESC");
    $no=0;
    while($komp=mysql_fetch_assoc($a)){?>
        <tr style="font-size:16px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <?$no++;?>
            <td align="right"><?=$no?></td>
            <td><?=$komp[tanggal].' '.$komp[mulai]?></td>
            <td><?=$komp[Produk]?></td>
            <td><?=$komp[aPutar]?></td>
            <td><?=$komp[aPisah]?></td>
            <td><?=$komp[petugas]?></td>
        </tr>
    <?}?>
    <?
    if ($no=="0"){
        ?><tr style="color:#000000;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
            <td colspan="23" class=input align="center">TIDAK ADA DATA PENGOLAHAN DARAH</td>
        </tr>
    <?}
    ?>
</table>
