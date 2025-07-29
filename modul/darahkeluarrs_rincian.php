<?php

require_once('config/dbi_connect.php');
session_start();
$namaudd = $_SESSION['namaudd'];
?>

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
<style>
    tr {
        background-color: #ffffff;
    }

    .initial {
        background-color: #ffffff;
        color: #000000
    }

    .normal {
        background-color: #ffffff;
    }

    .highlight {
        background-color: #7CFC00
    }

    table {
        border-collapse: collapse;
        box-shadow: 2px 2px 2px grey;
    }

    table,
    th,
    td {
        border: 1px solid brown;
        padding: 3px;
    }

    body {
        font-family: "Lato", sans-serif;
    }
</style>
<?php

include('config/db_connect.php');
$today = date('Y-m-d');
$today1 = $today;
$src_rs = "";
$src_lay = "";
$src_shift = "";
$produk = "";
$gol_darah = "";
$rh_darah = "";
$bagian = "";
$wilayah = "";
$tempat = "";
if (isset($_POST['minta1'])) {
    $today = $_POST['minta1'];
    $today1 = $today;
}
if ($_POST['minta2'] != '')
    $today1 = $_POST['minta2'];
if ($_POST['gol_status'] != '')
    $src_status = $_POST['gol_status'];
if ($_POST['gol_rs'] != '')
    $src_rs = $_POST['gol_rs'];
if ($_POST['gol_layanan'] != '')
    $src_lay = $_POST['gol_layanan'];
if ($_POST['gol_shift'] != '')
    $src_shift = $_POST['gol_shift'];
if ($_POST['rm'] != '')
    $srcrm = $_POST['rm'];
if ($_POST['nomorf'] != '')
    $srcform = $_POST['nomorf'];
if ($_POST['hasil'] != '')
    $hasil = $_POST['hasil'];
if ($_POST['produk'] != '')
    $produk = $_POST['produk'];
if ($_POST['gol_darah'] != '')
    $gol_darah = $_POST['gol_darah'];
if ($_POST['rh_darah'] != '')
    $rh_darah = $_POST['rh_darah'];
if ($_POST['bagian'] != '')
    $bagian = $_POST['bagian'];
if ($_POST['wilayah'] != '')
    $wilayah = $_POST['wilayah'];
if ($_POST['tempat'] != '')
    $tempat = $_POST['tempat'];

?>
<div
    style="background-color: #ffffff;font-size:24px; color:blue;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">
    <b>RINCIAN PENGELUARAN DARAH KE RUMAH SAKIT</b>
</div><br>
<form method=post>
    <table>
        <tr style="font-size:14px; background-color: azure;">
            <th colspan="7">FILTER DATA</th>
            <td><input type="submit" name="submit" value="Tampikan data" class="swn_button_blue"></td>
        </tr>
        <tr style="font-size:14px; background-color: azure;">
            <td>Dari Tanggal</td>
            <td><input type=text name=minta1 id=datepicker size=10 value=<?php echo $today ?>></td>

            <td>Sampai Tanggal</td>
            <td><input type=text name=minta2 id=datepicker1 size=10 value=<?php echo $today1 ?>></td>

            <td>No Formulir</td>
            <td><input type=text name=nomorf id=nomorf size=10 value=<?php echo $srcform ?>></td>

            <td>No. RM</td>
            <td><input type=text name=rm id=rm size=10 value=<?php echo $srcrm ?>></td>

        </tr>
        <tr style="font-size:14px; background-color: azure;">
            <td>Rumah Sakit</td>
            <td>
                <select name="gol_rs">
                    <option value="" selected>-</option>
                    <?php

                    $qrs = mysqli_query($conn, "select * from rmhsakit order by NamaRs");

                    while ($rowrs1 = mysqli_fetch_array($qrs)) {
                        echo "<option value=$rowrs1[Kode]>$rowrs1[NamaRs]</option>";
                    }
                    ?>
                </select>
            </td>
            <td>Wilayah</td>
            <td>
                <select name="wilayah">
                    <option value="">-</option>
                    <option value="0">DALAM KOTA</option>
                    <option value="1">LUAR KOTA</option>
                </select>
            </td>
            <td>Bagian RS</td>
            <td>
                <select name="bagian">
                    <option value="" selected>-</option>
                    <?php

                    $ql = mysqli_query($conn, "select * from bagian ");

                    while ($rowl1 = mysqli_fetch_array($ql)) {
                        echo "<option value=$rowl1[nama]>$rowl1[nama]</option>";
                    }
                    ?>
                </select>
            </td>
            <td>Layanan</td>
            <td>
                <select name="gol_layanan">
                    <option value="" selected>-</option>
                    <?php

                    $ql = mysqli_query($conn, "select * from jenis_layanan ");

                    while ($rowl1 = mysqli_fetch_array($ql)) {
                        echo "<option value=$rowl1[kode]>$rowl1[nama]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr style="font-size:14px; background-color: azure;">
            <td>Status</td>
            <td>
                <select name="gol_status">
                    <option value="">-</option>
                    <option value="0">Dibawa/Keluar</option>
                    <option value="1">Dititip</option>
                    <option value="B">Batal</option>
                </select>
            </td>
            <td>Hasil Crossmatch</td>
            <td>
                <select name="hasil">
                    <option value="">-</option>
                    <option value="1">COMPATIBLE</option>
                    <option value="0">INCOMPATIBLE BLH KLR</option>
                    <option value="2">INCOMPATIBLE TDK BLH KLR</option>
                </select>
            </td>
            <td>Jenis Darah</td>
            <td>
                <select name="produk">
                    <option value="" selected>-</option>
                    <?php

                    $ql = mysqli_query($conn, "select * from produk ");

                    while ($rowl1 = mysqli_fetch_array($ql)) {
                        echo "<option value=$rowl1[Nama]>$rowl1[Nama]</option>";
                    }
                    ?>
                </select>
            </td>
            <td>Shift</td>
            <td>
                <select name="gol_shift">
                    <option value="">-</option>
                    <option value="1">SHIFT 1</option>
                    <option value="2">SHIFT 2</option>
                    <option value="3">SHIFT 3</option>
                    <option value="4">SHIFT 4</option>
                </select>
            </td>
        </tr>
        <tr style="font-size:14px; background-color: azure;">
            <td>Golda ABO</td>
            <td>
                <select name="gol_darah">
                    <option value="">-</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                </select>
            </td>
            <td>Rhesus</td>
            <td>
                <select name="rh_darah">
                    <option value="">-</option>
                    <option value="+">Positip</option>
                    <option value="-">Negatip</option>
                </select>
            </td>
            <td>Tempat</td>
            <td colspan="3">
                <select name="tempat">
                    <option value="">-</option>
                    <option value="UDD">UDD</option>
                    <option value="BDRS">BDRS</option>
                    <option value="BDRS2">BDRS2</option>
                </select>
            </td>
        </tr>
    </table>

</form>
<?php

if ($_POST['gol_darah'] == '') {
    $transaksipermintaan = mysqli_query($conn, "select * from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status like '%$src_status%' and rs like '%$src_rs%' and layanan like '%$src_lay' and shift_keluar like '%$src_shift%' and NoForm like '%$srcform%' and no_rm like '%$srcrm%' and StatusCross like '%$hasil%' and produk_darah like '%$produk%' and gol_darah like '%$gol_darah%' and rh_darah like '%$rh_darah%' and bagian like '%$bagian%' and wil_rs like '%$wilayah%' and tempat like '%$tempat%' order by NoForm ASC  ");
} else {
    $transaksipermintaan = mysqli_query($conn, "select * from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status like '%$src_status%' and rs like '%$src_rs%' and layanan like '%$src_lay' and shift_keluar like '%$src_shift%' and NoForm like '%$srcform%' and no_rm like '%$srcrm%' and StatusCross like '%$hasil%' and produk_darah like '%$produk%' and gol_darah = '$gol_darah' and rh_darah like '%$rh_darah%' and bagian like '%$bagian%' and wil_rs like '%$wilayah%' and tempat like '%$tempat%' order by NoForm ASC  ");
}
/*echo "select * from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status like '%$src_status%' and rs like '%$src_rs%' and layanan like '%$src_lay' and shift_keluar like '%$src_shift%' and NoForm like '%$srcform%' and no_rm like '%$srcrm%' and StatusCross like '%$hasil%' and produk_darah like '%$produk%' and gol_darah like '%$gol_darah%' and rh_darah like '%$rh_darah%' and bagian like '%$bagian%' and wil_rs like '%$wilayah%' and tempat like '%$tempat%' order by NoForm ASC  <br>";*/
$countp = mysqli_num_rows($transaksipermintaan); ?>
<br><br>
<table border=1 cellpadding=4 style="border-collapse:collapse">
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th colspan="27" align="left">
            <font size="4" color=00008B>Hasil Filter data : <?php echo $countp; ?> Kantong</font>
        </th>

    </tr>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th rowspan='2' align="center">NO</th>
        <th rowspan='2' align="center">NO FORMULIR</th>
        <th colspan='5' align="center">DATA PASIEN</th>
        <th colspan='3' align="center">DATA RUMAH SAKIT</th>
        <th colspan='4' align="center">DATA PERMINTAAN</th>

        <th colspan='3' align="center">DATA KANTONG DARAH/<BR>KOMPONEN DARAH</th>
        <th colspan='4' align="center">DATA UJI SILANG SERASI<br>CROSSMATCHING</th>
        <th colspan='6' align="center">DATA PEMBAYARAN &<br>STATUS PENGELUARAN DARAH</th>
    </tr>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th align="center">No RM</th>
        <th align="center">Nama Pasien</th>
        <th align="center">Alamat</th>
        <th align="center">Kel</th>
        <th align="center">Gol</th>

        <th align="center">Nama Rumah Sakit</th>
        <th align="center">Bagian</th>
        <th align="center">Ruangan</th>

        <th align="center">Jenis</th>
        <th align="center">Layanan</th>
        <th align="center">Tgl</th>
        <th align="canter">Shift</th>

        <th align="center">No Kantong</th>
        <th align="center">Golda</th>
        <th align="center">Produk</th>

        <th align="center">Hasil</th>
        <th align="center">Inisial Petugas</th>
        <th align="center">Tgl</th>
        <th align="center">Shift</th>

        <th align="center">Jenis<br>Biaya</th>
        <th align="center">Status</th>
        <th align="center">Tgl</th>
        <th align="center">Kasir</th>
        <th align="center">Shift</th>
        <th align="center">No Kwitansi</th>
    </tr>
    <?php

    $no = 1;
    while ($datatransaksipermintaan = mysqli_fetch_array($transaksipermintaan)) {
        switch ($datatransaksipermintaan['StatusCross']) {
            case '0': ?>
                <tr style="font-size:11px; color:blue; font-family:Verdana;" onMouseOver="this.className='highlight'"
                    onMouseOut="this.className='normal'"> <?php
                    break;

            case '2': ?>
                <tr style="font-size:11px; color:#ff0000; font-family:Verdana;" onMouseOver="this.className='highlight'"
                    onMouseOut="this.className='normal'"> <?php
                    break;

            default: ?>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'"
                    onMouseOut="this.className='normal'"><?php
                    break;

        }
        ?>

            <td align="right" nowrap><?php echo $no . '.' ?></td>

            <td align="left" nowrap><?php echo $datatransaksipermintaan['NoForm'] ?></td>

            <td align="center" nowrap><?php echo $datatransaksipermintaan['no_rm'] ?></td>

            <?php

            $pasien1 = mysqli_query($conn, "select * from pasien where no_rm='$datatransaksipermintaan[no_rm]'");
            $ambilpasien = mysqli_fetch_array($pasien1);
            ?>
            <td align="left" nowrap><?php echo $ambilpasien['nama'] ?></td>

            <td align="left" nowrap><?php echo $ambilpasien['alamat'] ?></td>

            <td align="center" nowrap><?php echo $ambilpasien['kelamin'] ?></td>

            <td align="center" nowrap><?php echo $ambilpasien['gol_darah'] ?> (<?php echo $ambilpasien['rhesus'] ?> )</td>


            <?php

            $rs1 = mysqli_query($conn, "select * from rmhsakit where Kode='$datatransaksipermintaan[rs]'");
            $ambilrs1 = mysqli_fetch_array($rs1);
            $layanan = mysqli_query($conn, "select * from jenis_layanan where kode='$datatransaksipermintaan[layanan]'");
            $layanan1 = mysqli_fetch_array($layanan);
            $layanan2 = mysqli_query($conn, "select * from htranspermintaan where noform='$datatransaksipermintaan[NoForm]'");
            $layanan3 = mysqli_fetch_array($layanan2);
            ?>
            <td align="left" nowrap><?php echo $ambilrs1['NamaRs'] ?></td>

            <td align="left" nowrap><?php echo $datatransaksipermintaan['bagian'] ?></td>

            <td align="left" nowrap><?php echo $layanan3['ruangan'] ?></td>

            <?php

            if ($layanan3['jenis_permintaan'] == '0')
                $jenisminta = 'Biasa';
            if ($layanan3['jenis_permintaan'] == '1')
                $jenisminta = 'Cadangan';
            if ($layanan3['jenis_permintaan'] == '2')
                $jenisminta = 'Siap Pakai';
            if ($layanan3['jenis_permintaan'] == '3')
                $jenisminta = 'Cyto';
            ?>
            <td align=center nowrap><?php echo $jenisminta ?></td>

            <td align="center" nowrap><?php echo $layanan1['nama'] ?></td>

            <td align="center" nowrap><?php echo $layanan3['tglminta'] ?></td>

            <td align="center" nowrap><?php echo $layanan3['shift'] ?></td>

            <td align="center" nowrap><?php echo $datatransaksipermintaan['NoKantong'] ?></td>

            <?php

            $kantong1 = mysqli_query($conn, "select * from stokkantong where NoKantong='$datatransaksipermintaan[NoKantong]'");
            $ambilkantong1 = mysqli_fetch_array($kantong1);
            ?>
            <td align="center" nowrap>
                <?php echo $datatransaksipermintaan['gol_darah'] ?>(<?php echo $datatransaksipermintaan['rh_darah'] ?>)
            </td>


            <td align="center" nowrap><?php echo $datatransaksipermintaan['produk_darah'] ?></td>

            <?php

            switch ($datatransaksipermintaan['StatusCross']) {
                case '0': ?>
                    <td align="center" nowrap>Incompatible Boleh Keluar</td> <?php
                    break;

                case '2': ?>
                    <td align="center" nowrap>Incompatible TIDAK Boleh Keluar</td> <?php
                    break;

                default: ?>
                    <td align="center" nowrap>Compatible</td> <?php
                    break;

            }
            $statuscross = 'Keluar';
            if ($datatransaksipermintaan['Status'] == "1")
                $statuscross = 'Titip';
            if ($datatransaksipermintaan['Status'] == "B")
                $statuscross = 'Batal';
            ?>
            <td align="center" nowrap><?php echo $datatransaksipermintaan['petugas'] ?></td>

            <td align="center" nowrap><?php echo $datatransaksipermintaan['tgl'] ?></td>

            <td align="center" nowrap><?php echo $datatransaksipermintaan['shift'] ?></td>

            <?php

            $pembayaran1 = mysqli_query($conn, "select * from dpembayaranpermintaan where notrans='$datatransaksipermintaan[NoForm]'");
            $pembayaran = mysqli_fetch_array($pembayaran1);
            ?>
            <td align="center" nowrap><?php echo $pembayaran['namabrg'] ?></td>

            <td align="center" nowrap><?php echo $statuscross ?></td>

            <td align="center" nowrap><?php echo $datatransaksipermintaan['tgl_keluar'] ?></td>

            <td align="left" nowrap><?php echo $pembayaran['petugas'] ?></td>

            <td align="center" nowrap><?php echo $datatransaksipermintaan['shift_keluar'] ?></td>

            <?php

            $kwitansi1 = mysqli_query($conn, "select * from kwitansi where NoForm='$datatransaksipermintaan[NoForm]'");
            $kwitansi = mysqli_fetch_array($kwitansi1);
            ?>
            <td align="center" nowrap><?php echo $kwitansi['nomer'] ?></td>

        </tr>
        <?php echo $no++;
    } ?>

</table>
<br>
<form name=xls method=post action=modul/rekap_darah_keluar_xls.php>
    <input type=hidden name=today value='<?php echo $today ?>'>

    <input type=hidden name=today1 value='<?php echo $today1 ?>'>

    <input type=hidden name=status value='<?php echo $src_status ?>'>

    <input type=hidden name=layanan value='<?php echo $src_lay ?>'>

    <input type=hidden name=shift2 value='<?php echo $src_shift ?>'>

    <input type=hidden name=NoForm value='<?php echo $srcform ?>'>

    <input type=hidden name=rs value='<?php echo $src_rs ?>'>

    <input type=hidden name=norm value='<?php echo $srcrm ?>'>

    <input type=hidden name=hasil value='<?php echo $hasil ?>'>


    <input type=hidden name=produk value='<?php echo $produk ?>'>

    <input type=hidden name=gol_darah value='<?php echo $gol_darah ?>'>

    <input type=hidden name=rh_darah value='<?php echo $rh_darah ?>'>

    <input type=hidden name=bagian value='<?php echo $bagian ?>'>

    <input type=hidden name=wilayah value='<?php echo $wilayah ?>'>

    <input type=hidden name=tempat value='<?php echo $tempat ?>'>

    <input type=submit name=submit2 value='Print Rincian Darah Keluar (.XLS)' class="swn_button_blue">
</form>
<br>
<div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2018-12-31</div>
