<!DOCTYPE html>
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<title>SIMDONDAR</title>
<html>
<STYLE>
    tr { background-color: #ffffff;}
    .initial { background-color: #ffffff; color:#000000 }
    .normal { background-color: #ffffff; }
    .highlight { background-color: #7CFC00 }
</style>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<style>
    table {
        border-collapse: collapse;
    }
</style>
<style>
    table, th, td {
        font-size : 15px;
    }
</style>

<style>body {font-family: "trebuchet ms", sans-serif;}</style>
<?
include('config/db_connect.php');
$utd		= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
$today1=$_GET['tgl'];
$instansi=$_GET['instansi'];
$jam1=$_GET['jam1'];
$jam2=$_GET['jam2'];

$sq_mu="SELECT 
h.instansi,
DATE_FORMAT(date(h.`Tgl`),'%d-%m-%Y') as Tgl ,
DATE_FORMAT(max(h.`Tgl`),'%d-%m-%Y %H:%i:%s') as input_akhir,
DATE_FORMAT(min(h.`Tgl`),'%d-%m-%Y %H:%i:%s') as input_awal,
DATE_FORMAT(max(h.`insert_on`),'%d-%m-%Y %H:%i:%s') as time_upload,
count(h.`NoTrans`) as jml_donor,
count(case when h.`pengambilan`='0' then 1 END) AS berhasil,
count(case when h.`pengambilan`='1' then 1 END) AS batal,
count(case when h.`pengambilan`='2' then 1 END) AS gagal,
count(case when h.`JenisDonor`='0' and h.`pengambilan`='0' then 1 END) AS ds_berhasil,
count(case when h.`JenisDonor`='1' and h.`pengambilan`='0' then 1 END) AS dp_berhasil,
count(case when h.`gol_darah`='A' and h.`pengambilan`='0' then 1 END) AS A_berhasil,
count(case when h.`gol_darah`='B' and h.`pengambilan`='0' then 1 END) AS B_berhasil,
count(case when h.`gol_darah`='O' and h.`pengambilan`='0' then 1 END) AS O_berhasil,
count(case when h.`gol_darah`='AB' and h.`pengambilan`='0' then 1 END) AS AB_berhasil,
count(case when h.`rhesus`='+' and h.`pengambilan`='0' then 1 END) AS rhpos_berhasil,
count(case when h.`rhesus`='-' and h.`pengambilan`='0' then 1 END) AS rhmin_berhasil,
count(case when h.`jeniskantong`='1' then 1 END) AS kt_single,
count(case when h.`jeniskantong`='2' then 1 END) AS kt_double,
count(case when h.`jeniskantong`='3' then 1 END) AS kt_tripple,
count(case when h.`jeniskantong`='4' then 1 END) AS kt_quadrupple,
count(case when h.`jeniskantong`='6' then 1 END) AS kt_pediatrik,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='0') then 1 END) AS tensi_rendah,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='1') then 1 END) AS tensi_tinggi,
count(case when (h.`pengambilan`='1' and (h.`ketBatal`='2' or h.`ketBatal`='3')) then 1 END) AS hb_rendah,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='4') then 1 END) AS hb_tinggi,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='5') then 1 END) AS bb_kurang,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='6') then 1 END) AS obat,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='7') then 1 END) AS bepergian,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='8') then 1 END) AS medis,
count(case when (h.`pengambilan`='1' and h.`ketBatal`='9') then 1 END) AS prilaku,
count(case when ((h.`ketBatal`='10' or h.`ketBatal`='') and h.`pengambilan`='1') then 1 END) AS lain_lain
FROM `htransaksi` h WHERE date( h.Tgl ) = '$today1' AND h.instansi like '%$instansi%'";
//echo "$sq_mu";
$data=mysql_fetch_assoc(mysql_query($sq_mu));
$inputawal=$data['input_awal'];
$inputakhir=$data['input_akhir'];
$uploaddata=$data['time_upload'];
?>
<table width="900px" border="0">
    <tr>
        <td><?=$utd[nama]?></td>
        <td align="right">__________________</td>
    </tr>
    <tr>
        <td>Rekapitulasi Kegiatan Donor Darah</td>
        <td align="right"></td>
    </tr>
    <tr><td colspan="2"><hr width="900px"></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 20px; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif">LAPORAN KEGIATAN DONOR DARAH<br><?=$utd[nama]?></td></tr>
</table>
<br><br>
<table cellpadding=3 cellspacing=3 width='900px' style="border-collapse: collapse; border: 0px;">
	<tr><td>1.</td><td colspan="3">Tanggal Kegiatan</td>	<td width="400px">: <?=$data['Tgl']?></td></tr>
    <tr><td>2.</td><td colspan="3">Tempat Kegiatan</td>		<td>: <?=$data['instansi']?></td></tr>
    <tr><td>3.</td><td colspan="3">Jumlah Calon Donor</td>	<td>: <?=$data['jml_donor']?> orang (daftar hadir terlampir)</td></tr>
    <tr><td>4.</td><td colspan="3">Jumlah Donor yang menyumbangkan darah</td><td>: <?=$data['berhasil']?> orang
    																				    	( A=<?=$data['A_berhasil']?>;																					
    																						B=<?=$data['B_berhasil']?>;
    																						O=<?=$data['O_berhasil']?>;
    																						AB=<?=$data['AB_berhasil']?> )</td></tr>
    <tr><td>5.</td><td colspan="3">Jumlah Donor yang ditolak menyumbangkan darah</td><td>: <?=$data['batal']?> orang</td></tr>
    <tr><td>6.</td><td colspan="2">Jumlah kantong darah yang digunakan</td><td>a. Kantong Single</td><td>: <?=$data[kt_single]?> buah</td></tr>
    <tr><td colspan="3"></td><td width="150px" nowrap>b. Kantong Double</td><td>: <?=$data[kt_double]?> buah</td></tr>
    <tr><td colspan="3"></td><td>c. Kantong Tripple</td><td>: <?=$data[kt_tripple]?> buah</td></tr>
    <tr><td colspan="3"></td><td nowrap>d. Kantong Quadrupple</td><td>: <?=$data[kt_quadrupple]?> buah</td></tr>
    <tr><td colspan="3"></td><td>e. Kantong Pediatrik</td><td>: <?=$data[kt_pediatrik]?> buah</td></tr>
</table>   
<table cellpadding=3 cellspacing=3 width='900px' style="border-collapse: collapse;" border="1">   
    <tr><td width="50px" >7.</td><td colspan="3">Alasan Penolakan</td><td>Jumlah donor yang ditolak (Orang)</td></tr>
    <tr><td width="50px" colspan="2" align="right">1.</td><td colspan="2">Usia Kurang atau melebihi ketentuan</td><td></td></tr>
    <tr><td width="50px" colspan="2" align="right">2.</td><td colspan="2">Berat Badan Tidak Mencukupi</td><td><?=$data['bb_kurang']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">3.</td><td colspan="2">Kadar Hemoglobin kurang dari standar</td><td><?=$data['hb_rendah']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">4.</td><td colspan="2">Kadar Hemoglobin melebihi standar</td><td><?=$data['hb_tinggi']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">5.</td><td colspan="2">Tekanan Darah Rendah</td><td><?=$data['tensi_rendah']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">6.</td><td colspan="2">Tekanan Darah Tinggi</td><td><?=$data['tensi_tinggi']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">7.</td><td colspan="2">Konsumsi obat-obatan</td><td><?=$data['obat']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">8.</td><td colspan="2">Riwayat Bepergian</td><td><?=$data['bepergian']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">9.</td><td colspan="2">Alasan Medis (ditetapkan oleh dokter UTD)</td><td><?=$data['medis']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">10.</td><td colspan="2">Memiliki faktor resiko (ditetapkan oleh dokter UTD)</td><td><?=$data['prilaku']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">11.</td><td colspan="2">Tidak diketahui alasannya (<i>self diferral</i>)</td><td><?=$data['lain_lain']?></td></tr>
    <tr><td width="50px" colspan="2" align="right">12.</td><td colspan="2">Lainnya (Gagal aftap, berhenti menyumbangkan darah ditengah proses penyumbangan,
    					 misalnya karena pusing, mual, pingsan dan lain-lain)</td><td><?=$data['gagal']?></td></tr>
</table>
<br>
<table cellpadding=3 cellspacing=3 width='900px' style="border-collapse: collapse;" border="1">   
	<tr><td colspan="4">PETUGAS MOBILE UNIT</td></tr>
	<tr><td valign="top">1. Dokter</td><td valign="top">
	<?$q_dokter =mysql_query("SELECT distinct h.NamaDokter , u.`Nama` FROM `htransaksi` h inner join `dokter_periksa`u on u.`kode`=h.NamaDokter
						WHERE date(Tgl ) = '$today1' AND instansi = '$instansi'");
		while ($dokter=mysql_fetch_assoc($q_dokter)){
			echo "- $dokter[Nama]<br>";
		}?>
	</td>
        <td valign="top" nowrap>4. Petugas Pengambilan (aftaper)</td><td valign="top">
            <?$q_hb =mysql_query("SELECT distinct h.petugas , u.`nama_lengkap` FROM `htransaksi` h inner join `user`u on u.`id_user`=h.petugas
						WHERE date(Tgl ) = '$today1' AND instansi = '$instansi'");
            while ($data=mysql_fetch_assoc($q_hb)){
                echo "- $data[nama_lengkap]<br>";
            }?>
        </td>
    </tr>

	<tr><td valign="top">2. Petugas Tensi</td><td valign="top">
	<?$q_hb =mysql_query("SELECT distinct h.petugasTensi , u.`nama_lengkap` FROM `htransaksi` h inner join `user`u on u.`id_user`=h.petugasTensi
						WHERE date(Tgl ) = '$today1' AND instansi = '$instansi'");
		while ($data=mysql_fetch_assoc($q_hb)){
			echo "- $data[nama_lengkap]<br>";
		}?>
	</td>
        <td valign="top">5. Petugas input data (admin)</td><td valign="top">
            <?$q_hb =mysql_query("SELECT distinct h.`user` , u.`nama_lengkap` FROM `htransaksi` h inner join `user`u on u.`id_user`=h.`user`
						WHERE date(Tgl ) = '$today1' AND instansi = '$instansi'");
            while ($data=mysql_fetch_assoc($q_hb)){
                echo "- $data[nama_lengkap]<br>";
            }?>
        </td>
    </tr>
	<tr><td valign="top">3. Petugas HB</td><td valign="top">
	<?$q_hb =mysql_query("SELECT distinct h.petugasHB , u.`nama_lengkap` FROM `htransaksi` h inner join `user`u on u.`id_user`=h.petugasHB
						WHERE date(Tgl ) = '$today1' AND instansi = '$instansi'");
		while ($data=mysql_fetch_assoc($q_hb)){
			echo "- $data[nama_lengkap]<br>";
		}?>
	</td><td colspan="2">Keterangan/Masalah & Penyelesaian:<br><br><br><br></td></tr>
</table>
<?
$q="SELECT  h.tgl, DATE_FORMAT(max(p.insert_on),'%d-%m-%Y %H:%i:%s')  as  pengesehan_akhir, DATE_FORMAT(min(p.insert_on),'%d-%m-%Y %H:%i:%s') as pengesahan_awal
    FROM `htransaksi` h inner join pengesahan p on h.`NoKantong`=p.nokantong
    WHERE length(h.nokantong)>0 and date( h.Tgl ) = '$today1' AND h.instansi = '$instansi'";
//echo "$q";
$sah=mysql_fetch_assoc(mysql_query($q));
?>

<table cellpadding=3 cellspacing=3 width='900px' style="border-collapse: collapse;" border="1">
    <tr><td colspan="2">Keterangan Waktu:</td></tr>
    <tr><td>Data pertama diinput</td><td><?=$inputawal?> (Waktu versi laptop)</td></tr>
    <tr><td>Data terakhir diinput </td><td><?=$inputakhir?> (Waktu versi laptop)</td></tr>
    <tr><td>Upload Data ke Server SIMDONDAR</td><td><?=$uploaddata?> (Waktu versi Server)</td></tr>
    <tr><td>Pengesahan kantong darah di komponen pertama</td><td><?=$sah[pengesahan_awal]?> (Waktu versi Server)</td></tr>
    <tr><td>Pengesahan kantong darah di komponen terakhir</td><td><?=$sah[pengesehan_akhir]?> (Waktu versi Server)</td></tr>
    <tr><td>Waktu keberangkatan Mobile Unit</td><td><?=$jam1?> (Manual input)</td></tr>
    <tr><td>Waktu tiba kembali di UDD</td><td><?=$jam2?> (Manual input)</td></tr>
</table>
<br><br>
<table cellpadding=3 cellspacing=3  style="border-collapse: collapse; border: 2px;" width="900px">
    <tr>
        <td align="center" valign="top"><br>Penanggung Jawab MU,<br><br><br><br><br></td>
        <td align="center" valign="top"><br><?=$utd[nama]?><br>Diperiksa Oleh,</td>
    </tr>
    <tr>
        <td><br><br></td>
        <td></td></tr>
    <tr>
        <td align="center" class="input" >.....................................</td>
        <td align="center" class="input" ><a href="javascript:window.print()">.....................................</a></td>
    </tr>
</table>

<?
mysql_close();
?>
