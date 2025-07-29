<?
    /***********************************************
     * Author 	: suwena 
     * Date 	: 26 Mei 2018
     * Fungsi	: Form Serah Terima Darah dari Aftap/Mobile unit utk Karantina
     * Keterangan Modul : 
     * 		Pengganti pengesahan kantong
     * 		Sekaligus membuat formulir Serah Terima ke 
     *			- Bag Karantina atau Komponen
     *			- Bag Uji Saring Darah IMLTD
     *			- Bag Uji Konfirmasi Golongan Darah
     * 		Status Darah yang sah langsung menjadi KARANTINA
     * 		Stok Position : PENYIMPANAN DARAH KARANTINA
     * Table terkait : 
     *		- Select : stokkantong join htransaksi
     *		- exec   : serahterima_h, serahterima_detail, serahterima_detail_tmp
     ***********************************************/
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
    #serahterima {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 16px;
        border-collapse: collapse;
    }

    #serahterima td, #serahterima th {
        border: 1px solid #ddd;
        padding: 5px;
    }

    #serahterima tr:nth-child(even){background-color: #ffe6e6;}

    #serahterima tr:hover {background-color: #ddd;}

    #serahterima th {
        padding-top: 3px;
        padding-bottom: 3px;
        text-align: left;
        font-weight: lighter;
        background-color: #ff9999;
        color: #000000;
    }
    #serahterima input{
        padding-top: 2px;
        padding-bottom: 2px;
        text-align: left;
        background-color: lightyellow;
        color: #000000;
    }
</style>

<?php
include ('config/dbi_connect.php');
$namauser       = $_SESSION['namauser'];
$namalengkap    = $_SESSION['nama_lengkap'];
$level	        = $_SESSION['leveluser'];
$tglawal        = date("Y-m-01");
$hariini        = date("Y-m-d");
$notransaksi    = $_GET['no'];
?>

<body>
<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">DAFTAR TRANSAKSI PEMUSNAHAN PRODUK DARAH</div>

<br>
<?php

if (isset($_POST['submit2'])) {
    $sekarang   = date("Y-m-d H:i:s");
    $instansi   = $_POST['instansi'];
    $ptg_limbah = $_POST['ptg_penerima'];
    $berat  = $_POST['berat'];

    $sa="UPDATE `ar_stokkantong_trans`set `ptgs_kirim` ='$namalengkap',`pengelola`='$instansi',`ptgs_limbah`='$ptg_limbah', `diambil`='$sekarang', `berat`='$berat', `stat`='1' where notrans='$notransaksi'";
        //echo "$sa<br>";
        $a  = mysqli_query($dbi,$sa);

     //=======Audit Trial====================================================================================
     $log_mdl = $level;
     $log_aksi='Serah Terima Limbah Produk Darah  No. transaksi: '.$notransaksi.' Instansi Pengelola : '.$instansi;
     include "user_log.php";
     //=====================================================================================================

     echo "TRANSAKSI SERAH SETRIMA LIMBAH KE  SUKSES ";

     echo "<meta http-equiv='refresh' content='2;url=pmi$level.php?module=musnah_rpt_view&notrans=$tmp[notrans]'";
     

}


 $sql_h  = "SELECT *,  DATE_FORMAT(`tgl`, '%d %M %Y %H:%i') as `tglmusnah` from ar_stokkantong_trans  WHERE `notrans`='$notransaksi'";
 $sql_h1 = mysqli_fetch_assoc(mysqli_query($dbi, $sql_h));
                
?>


<form name="cari" method="POST" action="<?echo $PHPSELF?>">
    <table style="width: 100%; border-collapse: collapse;border: 2px solid #808080;box-shadow: 1px 2px 2px #000000;">
    <tr>
            <td style="vertical-align: top; width=100%;">

                <table id="serahterima" style="width: 98%;">
                    <tr><th>Nomor Transaksi</th>       <td><input type="hidden" name="trans" value=<?php echo $notransaksi;?> readonly><?php echo $notransaksi;?></td></tr>
                    <tr><th>Tanggal pemusnahan</td>            <td><?php echo $sql_h1['tglmusnah']; ?></td></tr>
                    <tr><th>Asal Pemusnahan</th>         <td><?php echo $sql_h1['bagian']; ?></td></tr>
                    <tr><th>Petugas Pemusnahan</th>         <td><?php echo $sql_h1['ptgs_musnah']; ?></td></tr>
                    <tr><th>Berat (Kg)</th>         <td><input name="berat" type="text" required></td></tr>
                    <tr><th>Instansi Pengelola Limbah</th>         <td>
                    <select name="instansi" id="ptg_menyerahkan" required>
                        <option value="">Pilih Instansi</option>
                                <?
                                $usr    = mysqli_query($dbi,"select * from supplier where jenis='4' order by Nama Asc");
                                while ($usr1    = mysqli_fetch_assoc($usr)){
                                    ?><option value="<?=$usr1[Kode]?>"><?=$usr1['Nama']?><?
                                }
                                ?>
                        </select>
                    </td></tr>
                    <tr><th>Petugas Instansi Pengelola Limbah</th>         <td><input name="ptg_penerima" type="text" required></td></tr>
                 </table>

            </td>
        </tr>       
    </table>
<p>
    <input type="submit" name="submit2" value="Simpan Transaksi Pemusnahan" onclick="return confirm('PERHATIAN \n \nSimpan transaksi pemusnahan darah ini?');" class="swn_button_green">
    <a href="pmi<?php echo $level;?>.php?module=musnahlist"><input type="button" class="swn_button_blue" value="Kembali"></a>
</form>

    
<br>
<div style="font-size:10px; color:#000000; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;">Build : 21-08-2024</div>
