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
    $nodokumen="NO: UDDSLM-PD-L4-011-2022";
    include('config/db_connect.php');
    $today			=date("Y-m-d H:i:s");
    $namauser		=$_SESSION[namauser];
    $namauserlkp	=$_SESSION[nama_lengkap];
    $modul			="KARANTINA";
    $bag_pengirim	="AFTAP";
    $bag_penerima	="KOMPONEN";
    $notransaksi    =$_GET['no'];
    $utd            =mysql_fetch_assoc(mysql_query("select upper(`nama`) as `nama` from `utd` where `aktif`='1'"));
    $utd            =$utd['nama'];
    //echo "$notransaksi";
?>

<title>SIMDONDAR</title>
<head>
<style type="text/css" media="print">
    @page
    {
        size: landscape;
        margin-bottom: 20mm;
        margin-left: 0mm;
        margin-right: 0mm;
        margin-top: 15mm;
        header : {display: none !important;}
    }
    html
    {
        background-color: #ffffff;
        margin: 3px;  /* this affects the margin on the html before sending to printer */
    }
    body
    {
        border: solid 0px #ffffff ;
        margin: 0mm 15mm 10mm 10mm; /* margin you want for the content */
    }
    table th td {text-align: left;}
</style>
</head>
<body>

<?php
    $sql_h="SELECT `hst_id`, `hst_notrans`, `hst_bagpengirim`, `hst_bagpenerima`, `hst_tgl`, `hst_asal`, `hst_jenis_st`,
            `hst_user`, `hst_pengirim`, `hst_penerima`, `hst_penerima2`, `hst_kode_alat`, `hst_suhuterima`, `hst_kondisiumum`,
            `hst_peruntukan`, `hst_modul`, `hst_shift_pengirim`, `hst_shift_penerima` FROM `serahterima`
            WHERE `hst_notrans`='$notransaksi'";
    $sql_h1=mysql_fetch_assoc(mysql_query($sql_h));
?>

<table class="list" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
    <tr>
        <td style="height: 40px;font-size: 16px;font-weight: bold; text-align: center; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;" colspan="2">SERAH TERIMA DARAH DAN SAMPEL DARAH</td>
    </tr>
    <tr style="font-size:12px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td style="vertical-align: top; width=50%;">
            <table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
                <tr><td style="text-align: left">Tanggal transaksi</td>          <td><?php echo $sql_h1['hst_tgl']; ?></td></tr>
                <tr><td style="text-align: left">No. transaksi</td>              <td><?php echo $sql_h1['hst_notrans']; ?></td></tr>
                <tr><td style="text-align: left">Bagian yang mengirimkan</td>    <td><?php echo $sql_h1['hst_bagpengirim']; ?></td></tr>
                <tr><td style="text-align: left">Bagian yang menerima</td>       <td> KOMPONEN & UJI SARING IMLTD</td></tr>
          </table>
        </td>
        <td style="vertical-align: top;width=50%">
            <table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
                <tr><td style="text-align: left">Asal Kantong Darah</td>         <td><?php echo $sql_h1['hst_asal']; ?></td></tr>
                <tr><td style="text-align: left">Kode alat pengiriman</td>       <td><?php echo $sql_h1['hst_kode_alat']; ?></td></tr>
                <tr><td style="text-align: left">Suhu saat diterima</td>         <td><?php echo $sql_h1['hst_suhuterima']; ?><sup>o</sup>C</td></tr>
                <tr><td style="text-align: left">Keadaan umum</td>               <td><?php echo $sql_h1['hst_kondisiumum']; ?></td></tr>
          </table>
        </td>
    </tr>
</table>
<?
$sql_d="SELECT `dst_iddetail`, `dst_no_aftap`, `dst_tglaftap`, `dst_notrans`, `dst_nokantong`,
        CASE
        WHEN (`dst_statusktg`='1' and `dst_sahktg`='0') THEN 'Aftap'
        WHEN (`dst_statusktg`='1' and `dst_sahktg`='1') THEN 'Karantina'
        WHEN (`dst_statusktg`='2') THEN 'Sehat'
        WHEN (`dst_statusktg`='3') THEN 'Keluar'
        WHEN (`dst_statusktg`='4') THEN 'Reaktif-Rusak'
        WHEN (`dst_statusktg`='5') THEN 'Rusak-gagal'
        WHEN (`dst_statusktg`='6') THEN 'Rusak-Dimusnahkan'
        ELSE 'Tidak ada' end as `dst_statusktg`,
        `st_statusktg_new`, `dst_old_position`, `dst_new_position`,
        `dst_sahktg_new`, `dst_merk`, `dst_golda`, `dst_rh`, `dst_kodedonor`, `dst_berat`, `dst_volumektg`,
        CASE
        WHEN (`dst_jenisktg`='1') THEN 'Single'
        WHEN (`dst_jenisktg`='2') THEN 'Double'
        WHEN (`dst_jenisktg`='3') THEN 'Tiple'
        WHEN (`dst_jenisktg`='4') THEN 'Quadruple'
        WHEN (`dst_jenisktg`='6') THEN 'Pediatrik'
        END AS `dst_jenisktg`,
        CASE WHEN `dst_sample`='1' THEN 'Sesuai' ELSE 'Tdk Sesuai' END AS `dst_sample`,
        CASE WHEN `dst_sah`='1' THEN 'Sesuai' ELSE 'Tdk Sesuai' END AS `dst_sah`,
        CASE WHEN `dst_lamabaru`='0' THEN 'Baru' ELSE 'Lama' END AS `dst_lamabaru`,
        CASE WHEN `dst_kel`='0' THEN 'LK' ELSE 'PR' END AS `dst_kel`,
        CASE WHEN `dst_dsdp`='0' THEN 'DS' ELSE 'DP' END AS `dst_dsdp`,
	CASE
        WHEN (`dst_statuspengambilan`='0') THEN 'Berhasil'
        WHEN (`dst_statuspengambilan`='1') THEN 'Batal'
        WHEN (`dst_statuspengambilan`='2') THEN 'Gagal'
        END AS `dst_statuspengambilan`,
        `dst_umur`, `dst_lama_aftap`, `dst_ptgaftap`, `dst_volambil` FROM `serahterima_detail`
        WHERE `dst_notrans`='$notransaksi'";
//echo "$sql_d<br>";
$sql_d1=mysql_query($sql_d);
?>
<table class="list" border=1 cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead style="background-color:#DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
    <tr style="background-color: #DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <th style="text-align: center; height: 40px">No</th>
        <th style="text-align: center; height: 40px">Nomor<br>Kantong</th>
	<th style="text-align: center; height: 40px">Merk<br>Kantong</th>
	<th style="text-align: center; height: 40px">Jenis<br>Kantong</th>
        <th style="text-align: center; height: 40px">Nomor<br>Aftap</th>
	<th style="text-align: center; height: 40px">Lama<br>Aftap</th>
	<th style="text-align: center; height: 40px">Volume<br>Aftap</th>
	<th style="text-align: center; height: 40px">Status<br>Aftap</th>
        <th style="text-align: center; height: 40px">Status<br>Kantong</th>
        <th style="text-align: center; height: 40px">Kode<br>Donor</th>
        <th style="text-align: center; height: 40px">Jenis<br>Donor</th>
        <th style="text-align: center; height: 40px">Donor<br>Baru/Lama</th>
        <th style="text-align: center; height: 40px">Umur<br>Donor</th>
        <th style="text-align: center; height: 40px">Jns<br>Kel</th>
        <th style="text-align: center; height: 40px">Gol</th>
        <th style="text-align: center; height: 40px">Rh</th>
        <th style="text-align: center; height: 40px">Ptgs<br>Aftap</th>
        <th style="text-align: center; height: 40px">Sample</th>
        <th style="text-align: center; height: 40px">Pengesahan</th>
    </tr>
    </thead>
    <tbody>
    <?
    $no=0;
    while ($sgd=mysql_fetch_assoc($sql_d1)){
        $no++;
        ?>
        <tr style="font-size:12px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
            <td style="text-align: right;"> <?php echo $no.'.';?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_nokantong'];?> </td>
	    <td style="text-align: center;"> <?php echo $sgd['dst_merk'].' '.$sgd['dst_volambil'].' ml';?> </td>
	    <td style="text-align: center;"> <?php echo $sgd['dst_jenisktg'];?> </td>		
            <td style="text-align: center;"> <?php echo $sgd['dst_no_aftap'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_lama_aftap'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_volumektg'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_statuspengambilan'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_statusktg'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_kodedonor'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_dsdp'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_lamabaru'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_umur'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_kel'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_golda'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_rh'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_ptgaftap'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_sample'];?> </td>
            <td style="text-align: center;"> <?php echo $sgd['dst_sah'];?> </td>
        </tr>
        <?
    }
    ?>
    </tbody>
    </table>
<br>
<?
$usr        = mysql_fetch_assoc(mysql_query("select `nama_lengkap` from `user` where `id_user`='$sql_h1[hst_user]'"));
$pencatat   = $usr['nama_lengkap'];
$usr1        = mysql_fetch_assoc(mysql_query("select `nama_lengkap` from `user` where `id_user`='$sql_h1[hst_pengirim]'"));
$pengirim   = $usr1['nama_lengkap'];
$usr2        = mysql_fetch_assoc(mysql_query("select `nama_lengkap` from `user` where `id_user`='$sql_h1[hst_penerima]'"));
$penerima   = $usr2['nama_lengkap'];
$usr3        = mysql_fetch_assoc(mysql_query("select `nama_lengkap` from `user` where `id_user`='$sql_h1[hst_penerima2]'"));
$penerima2   = $usr3['nama_lengkap'];
?>
<table class="list" border=1 cellpadding="5" cellspacing="5" style="border-collapse:collapse">
    <thead
    <tr style="background-color: #DCDCDC;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <th style="text-align: center;height: 30px;"></th>
        <th style="text-align: center;height: 30px;" nowrap>Nama Petugas</th>
    </tr>
    </thead>
    <tr style="font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td nowrap>Petugas Pencatat</td>
        <td nowrap><?php echo $pencatat; ?></td>
    </tr>
    <tr style="font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td nowrap>Petugas Pengirim</td>
        <td nowrap><?php echo $pengirim; ?></td>
    </tr>
    <tr style="font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td nowrap>Petugas Penerima Bag Komponen</td>
        <td nowrap><?php echo $penerima; ?></td>
    </tr>
    <tr style="font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td nowrap>Petugas Penerima Bag IMLTD</td>
        <td nowrap><?php echo $sql_h1['hst_penerima2']; ?></td>
    </tr>
</table>
<br>
<a href="pmikomponen.php?module=sr_aftap_list">Kembali</a>
</body>
