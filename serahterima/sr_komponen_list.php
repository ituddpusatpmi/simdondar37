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
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser   =$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglawal    =date("Y-m-01");
$hariini    = date("Y-m-d");
$notransaksi="";
?>

<body>
<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">DAFTAR SERAH TERIMA DARAH & SAMPEL</div>
<div style="background-color: #ffffff;font-size:20px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Dari Bagian : Pengambilan Darah</div>
<br>
<?php
if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
?>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
    <table class="list" cellpadding=1 cellspacing="0" border="0">
        <tr class="field">
            <td align="left" nowrap>Dari tanggal :</td>
            <td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
            <td align="right" nowrap>sampai tanggal :</td>
            <td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
            <td><input type=submit name=submit class="swn_button_blue" value="Ok"></td>
        </tr>
    </table>
</form>

    <table id="serahterima"  style="border-collapse: collapse;border: 2px solid #808080;box-shadow: 1px 2px 2px #000000;">
        <tr style="font-size: 12px">
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">No</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">No. Transaksi</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Tanggal</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Waktu</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Asal</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Petugas</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Kode Alat</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Suhu</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Keadaan<br>umum</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">Jumlah<br>Kantong</th>
            <th colspan="3" style="height: 40px;text-align: center;font-weight: bold">Sudah Proses</th>
            <th colspan="3" style="height: 40px;text-align: center;font-weight: bold">Belum Proses</th>
            <th rowspan="2" style="height: 40px;text-align: center;font-weight: bold">AKSI</th>
        </tr>
        <tr style="font-size: 12px">
            <th style="height: 40px;text-align: center;font-weight: bold">Komponen</th>
            <th style="height: 40px;text-align: center;font-weight: bold">IMLTD</th>
            <th style="height: 40px;text-align: center;font-weight: bold">KGD</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Komponen</th>
            <th style="height: 40px;text-align: center;font-weight: bold">IMLTD</th>
            <th style="height: 40px;text-align: center;font-weight: bold">KGD</th>
        </tr>
        <?php
        $no=0;
        $qry="SELECT h.`hst_notrans`, h.`hst_tgl`, DATE_FORMAT(h.`hst_tgl`,'%d-%m-%Y') as `dt`, DATE_FORMAT(h.`hst_tgl`,'%H:%i') as `tm` ,h.`hst_asal`,h.`hst_user`, h.`hst_kode_alat`,h.`hst_suhuterima`,
              h.`hst_kondisiumum`, count(d.`dst_notrans`) as `jumlah`
              FROM `serahterima` h inner join serahterima_detail d on d.`dst_notrans`=h.`hst_notrans`
              WHERE `hst_modul`='KARANTINA' and (DATE(h.`hst_tgl`)>='$tglawal' and date(h.`hst_tgl`)<='$hariini')
              GROUP BY h.`hst_notrans`, h.`hst_tgl`, h.`hst_asal`,h.`hst_user`, h.`hst_kode_alat`,h.`hst_suhuterima`, h.`hst_kondisiumum`";
		//echo "$qry";
        $sql=mysql_query($qry);
        $no=0;
	$jmltotal=0;
        while ($tmp=mysql_fetch_assoc($sql)){
            $no++;
            $jumprop=mysql_fetch_assoc(mysql_query("SELECT COUNT(dst_nokantong) as jumlah FROM serahterima_detail WHERE dst_notrans='$tmp[hst_notrans]' AND dst_receive1 IS NOT NULL AND dst_stat_receive1!='0' AND dst_date_receive1 IS NOT NULL"));
            $jumproi=mysql_fetch_assoc(mysql_query("SELECT COUNT(dst_nokantong) as jumlah FROM serahterima_detail WHERE dst_notrans='$tmp[hst_notrans]' AND dst_receive2 IS NOT NULL AND dst_stat_receive2!='0' AND dst_date_receive2 IS NOT NULL"));
            $jumprok=mysql_fetch_assoc(mysql_query("SELECT COUNT(dst_nokantong) as jumlah FROM serahterima_detail WHERE dst_notrans='$tmp[hst_notrans]' AND dst_receive3 IS NOT NULL AND dst_stat_receive3!='0' AND dst_date_receive3 IS NOT NULL"));

            $jumblmp=mysql_fetch_assoc(mysql_query("SELECT COUNT(dst_nokantong) as jumlah FROM serahterima_detail WHERE dst_notrans='$tmp[hst_notrans]' AND dst_receive1 IS NULL AND dst_stat_receive1='0' AND dst_date_receive1 IS NULL"));
            $jumblmi=mysql_fetch_assoc(mysql_query("SELECT COUNT(dst_nokantong) as jumlah FROM serahterima_detail WHERE dst_notrans='$tmp[hst_notrans]' AND dst_receive2 IS NULL AND dst_stat_receive2='0' AND dst_date_receive2 IS NULL"));
            $jumblmk=mysql_fetch_assoc(mysql_query("SELECT COUNT(dst_nokantong) as jumlah FROM serahterima_detail WHERE dst_notrans='$tmp[hst_notrans]' AND dst_receive3 IS NULL AND dst_stat_receive3='0' AND dst_date_receive3 IS NULL"));
            ?>
            <tr style="font-size: 12px;height: 30px;">
                <td align="right"><?=$no?>.</td>
                <td style="text-align: center"><?=$tmp['hst_notrans']?></td>
                <td style="text-align: center"><?=$tmp['dt']?></td>
                <td style="text-align: center"><?=$tmp['tm']?></td>
				<td style="text-align: left"><?=$tmp['hst_asal']?></td>
                <td style="text-align: center"><?=$tmp['hst_user']?></td>
                <td style="text-align: center"><?=$tmp['hst_kode_alat']?></td>
                <td style="text-align: center"><?=$tmp['hst_suhuterima']?></td>
                <td style="text-align: center"><?=$tmp['hst_kondisiumum']?></td>
                <td style="text-align: center"><?=$tmp['jumlah']?></td>
                <td style="text-align: center"><?=$jumprop['jumlah']?></td>
                <td style="text-align: center"><?=$jumproi['jumlah']?></td>
                <td style="text-align: center"><?=$jumprok['jumlah']?></td>
                <td style="text-align: center"><?=$jumblmp['jumlah']?></td>
                <td style="text-align: center"><?=$jumblmi['jumlah']?></td>
                <td style="text-align: center"><?=$jumblmk['jumlah']?></td>
                <td style="text-align: center">
                    <a href="pmikomponen.php?module=sr_komponen&no=<?=$tmp['hst_notrans']?>">PROSES</a> |
                    <a href="pmikomponen.php?module=sr_rpt_ktg&no=<?=$tmp['hst_notrans']?>">CETAK</a> |
                    <a href="pmikomponen.php?module=sr_rpt_view&no=<?=$tmp['hst_notrans']?>">LIHAT</a>
                </td>
            </tr>
            <?php
	    $jmltotal   =$jmltotal+$tmp['jumlah'];
        }
        if ($no=="0"){
            ?><tr style="font-size: 16px;height: 40px; text-align: center;">
                <td colspan="12">Tidak ada data</td>
            </tr>
            <?
        } else {
            $jmltotalprop=mysql_fetch_assoc(mysql_query("SELECT COUNT(d.dst_nokantong) as jumlah FROM serahterima s INNER JOIN serahterima_detail d ON s.hst_notrans=d.dst_notrans WHERE (DATE(s.`hst_tgl`)>='$tglawal' and date(s.`hst_tgl`)<='$hariini') AND d.dst_receive1 IS NOT NULL AND d.dst_stat_receive1!='0' AND d.dst_date_receive1 IS NOT NULL
            "));
            $jmltotalproi=mysql_fetch_assoc(mysql_query("SELECT COUNT(d.dst_nokantong) as jumlah FROM serahterima s INNER JOIN serahterima_detail d ON s.hst_notrans=d.dst_notrans WHERE (DATE(s.`hst_tgl`)>='$tglawal' and date(s.`hst_tgl`)<='$hariini') AND d.dst_receive2 IS NOT NULL AND d.dst_stat_receive2='0' AND d.dst_date_receive2 IS NOT NULL
            "));
            $jmltotalprok=mysql_fetch_assoc(mysql_query("SELECT COUNT(d.dst_nokantong) as jumlah FROM serahterima s INNER JOIN serahterima_detail d ON s.hst_notrans=d.dst_notrans WHERE (DATE(s.`hst_tgl`)>='$tglawal' and date(s.`hst_tgl`)<='$hariini') AND d.dst_receive3 IS NOT NULL AND d.dst_stat_receive3!='0' AND d.dst_date_receive3 IS NOT NULL
            "));

            $jmltotalblmp=mysql_fetch_assoc(mysql_query("SELECT COUNT(d.dst_nokantong) as jumlah FROM serahterima s INNER JOIN serahterima_detail d ON s.hst_notrans=d.dst_notrans WHERE (DATE(s.`hst_tgl`)>='$tglawal' and date(s.`hst_tgl`)<='$hariini') AND d.dst_receive1 IS NULL AND d.dst_stat_receive1='0' AND d.dst_date_receive1 IS NULL
            "));
            $jmltotalblmi=mysql_fetch_assoc(mysql_query("SELECT COUNT(d.dst_nokantong) as jumlah FROM serahterima s INNER JOIN serahterima_detail d ON s.hst_notrans=d.dst_notrans WHERE (DATE(s.`hst_tgl`)>='$tglawal' and date(s.`hst_tgl`)<='$hariini') AND d.dst_receive2 IS NULL AND d.dst_stat_receive2='0' AND d.dst_date_receive2 IS NULL
            "));
            $jmltotalblmk=mysql_fetch_assoc(mysql_query("SELECT COUNT(d.dst_nokantong) as jumlah FROM serahterima s INNER JOIN serahterima_detail d ON s.hst_notrans=d.dst_notrans WHERE (DATE(s.`hst_tgl`)>='$tglawal' and date(s.`hst_tgl`)<='$hariini') AND d.dst_receive3 IS NULL AND d.dst_stat_receive3='0' AND d.dst_date_receive3 IS NULL
            "));

            ?>
	    <tr style="font-size: 12px;height: 40px; text-align: center;">
                 <td style="text-align: right" colspan="9">JUMLAH KANTONG</td>
		 <td style="text-align: center"><?=$jmltotal?></td>
		 <td style="text-align: center"><?=$jmltotalprop['jumlah']?></td>
		 <td style="text-align: center"><?=$jmltotalproi['jumlah']?></td>
		 <td style="text-align: center"><?=$jmltotalprok['jumlah']?></td>
		 <td style="text-align: center"><?=$jmltotalblmp['jumlah']?></td>
		 <td style="text-align: center"><?=$jmltotalblmi['jumlah']?></td>
		 <td style="text-align: center"><?=$jmltotalblmk['jumlah']?></td>
		 <td style="text-align: center" colspan="5"></td>
            </tr>	
	
	<?}?>
    </table>
<br>
<div style="font-size:10px; color:#000000; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;">Build : 26-05-2018</div>
