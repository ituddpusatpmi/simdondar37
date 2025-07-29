<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<?php
$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0]; $tstart = $mtime;
$level_user=$_SESSION['leveluser'];
$tanggalawal=$_GET['tgl1'];
$tanggalakhir=$_GET['tgl2'];
$namaperiode=$_GET['namaperiode'];
$bln1=substr($tanggalawal,5,2);
$tgl1=substr($tanggalawal,8,2);
$thn1=substr($tanggalawal,0,4);
$periode1=$tgl1.'/'.$bln1.'/'.$thn1;
$bln2=substr($tanggalakhir,5,2);
$tgl2=substr($tanggalakhir,8,2);
$thn2=substr($tanggalakhir,0,4);
$periode2=$tgl2.'/'.$bln2.'/'.$thn2;
$labelperiode="Periode : ".$namaperiode." ".$thn1." (".$periode1." s/d ".$periode2.")";
include('laporan/lttd1_proses.php');
$utd= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
?>
<table width="1000px" border="0">
	<tr><td colspan=2 align="center" valign="middle"><font size="5" color=black font-family="Arial">LAPORAN KEGIATAN <?=$utd['nama']?></font></td></tr>
	<tr><td colspan=2 align="center" valign="middle"><font size="4" color=black font-family="Arial"><?=$labelperiode?><br><br></font></td></tr>
	<tr>
		<td align="left"><font size="4" color="black" font-family="Arial">KEADAAN DONOR DARAH</font>
		<td align="right"><font size="4" color="black" font-family="Arial">LTTD I</font>
	</tr>
</table>

<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="2" width="1000px">
	<tr class=field>
		<th rowspan="3">No</th>
		<th rowspan="3" colspan="2">Keterangan</th>
		<th colspan="4">DONOR DARAH SUKARELA (Or)</th>
		<th colspan="4">DONOR DARAH PENGGANTI (Or)</th>
		<th colspan="4">JUMLAH (0r)</th>
	</tr>
    <tr class=field>
		<th colspan="2">PRIA</th>
		<th colspan="2">WANITA</th>
		<th colspan="2">PRIA</th>
		<th colspan="2">WANITA</th>
		<th colspan=2">PRIA</th>
        <th colspan=2">WANITA</th>
	</tr>
    <tr class=field>
		<th>BARU</th><th>LAMA</th><th>BARU</th><th>LAMA</th><th>BARU</th><th>LAMA</th><th>BARU</th><th>LAMA</th><th>BARU</th><th>LAMA</th><th>BARU</th><th>LAMA</th>
	</tr>
    <tr class=field>
		<th>1</th><th colspan="2">2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th>
	</tr>
    <tr class=record>
        <td class=input rowspan="5" align="center">A</td>
        <td class=input rowspan="5" align="left">Umur</td>
        <td class=input align="left">: 17 - 30 tahun</td>
        <td class=input align="right"><?=$lk_b_17?></td>
        <td class=input align="right"><?=$lk_l_17?></td>
        <td class=input align="right"><?=$pr_b_17?></td>
        <td class=input align="right"><?=$pr_l_17?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_17?></td>
        <td class=input align="right"><?=$lk_l_17?></td>
        <td class=input align="right"><?=$pr_b_17?></td>
        <td class=input align="right"><?=$pr_l_17?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">: 31 - 40 tahun</td>
        <td class=input align="right"><?=$lk_b_31?></td>
        <td class=input align="right"><?=$lk_l_31?></td>
        <td class=input align="right"><?=$pr_b_31?></td>
        <td class=input align="right"><?=$pr_l_31?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_31?></td>
        <td class=input align="right"><?=$lk_l_31?></td>
        <td class=input align="right"><?=$pr_b_31?></td>
        <td class=input align="right"><?=$pr_l_31?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">: 41 - 50 tahun</td>
        <td class=input align="right"><?=$lk_b_41?></td>
        <td class=input align="right"><?=$lk_l_41?></td>
        <td class=input align="right"><?=$pr_b_41?></td>
        <td class=input align="right"><?=$pr_l_41?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_41?></td>
        <td class=input align="right"><?=$lk_l_41?></td>
        <td class=input align="right"><?=$pr_b_41?></td>
        <td class=input align="right"><?=$pr_l_41?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">: 51 - 60 tahun</td>
        <td class=input align="right"><?=$lk_b_51?></td>
        <td class=input align="right"><?=$lk_l_51?></td>
        <td class=input align="right"><?=$pr_b_51?></td>
        <td class=input align="right"><?=$pr_l_51?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_51?></td>
        <td class=input align="right"><?=$lk_l_51?></td>
        <td class=input align="right"><?=$pr_b_51?></td>
        <td class=input align="right"><?=$pr_l_51?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">: > 60 tahun</td>
        <td class=input align="right"><?=$lk_b_61?></td>
        <td class=input align="right"><?=$lk_l_61?></td>
        <td class=input align="right"><?=$pr_b_61?></td>
        <td class=input align="right"><?=$pr_l_61?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_61?></td>
        <td class=input align="right"><?=$lk_l_61?></td>
        <td class=input align="right"><?=$pr_b_61?></td>
        <td class=input align="right"><?=$pr_l_61?></td>
    </tr>
    <tr class=field>
        <td class=input align="center"></td>
        <td class=input align="center" colspan="2">Jumlah</td>
        <td class=input align="right"><?=$jml_lk_b?></td>
        <td class=input align="right"><?=$jml_lk_l?></td>
        <td class=input align="right"><?=$jml_pr_b?></td>
        <td class=input align="right"><?=$jml_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$jml_lk_b?></td>
        <td class=input align="right"><?=$jml_lk_l?></td>
        <td class=input align="right"><?=$jml_pr_b?></td>
        <td class=input align="right"><?=$jml_pr_l?></td>
    </tr>
    
    
    <tr class=record>
        <td class=input rowspan="11" align="center">B</td>
        <td class=input rowspan="11" align="left">Pekerjaan</td>
        <td class=input align="left">1). BUMN</td>
        <td class=input align="right"><?=$bumn_lk_b?></td>
        <td class=input align="right"><?=$bumn_lk_l?></td>
        <td class=input align="right"><?=$bumn_pr_b?></td>
        <td class=input align="right"><?=$bumn_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$bumn_lk_b?></td>
        <td class=input align="right"><?=$bumn_lk_l?></td>
        <td class=input align="right"><?=$bumn_pr_b?></td>
        <td class=input align="right"><?=$bumn_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">2). Pegawai Negeri</td>
        <td class=input align="right"><?=$pns_lk_b?></td>
        <td class=input align="right"><?=$pns_lk_l?></td>
        <td class=input align="right"><?=$pns_pr_b?></td>
        <td class=input align="right"><?=$pns_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pns_lk_b?></td>
        <td class=input align="right"><?=$pns_lk_l?></td>
        <td class=input align="right"><?=$pns_pr_b?></td>
        <td class=input align="right"><?=$pns_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">3). Karyawan Swasta</td>
        <td class=input align="right"><?=$swt_lk_b?></td>
        <td class=input align="right"><?=$swt_lk_l?></td>
        <td class=input align="right"><?=$swt_pr_b?></td>
        <td class=input align="right"><?=$swt_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$swt_lk_b?></td>
        <td class=input align="right"><?=$swt_lk_l?></td>
        <td class=input align="right"><?=$swt_pr_b?></td>
        <td class=input align="right"><?=$swt_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">4). TNI</td>
        <td class=input align="right"><?=$tni_lk_b?></td>
        <td class=input align="right"><?=$tni_lk_l?></td>
        <td class=input align="right"><?=$tni_pr_b?></td>
        <td class=input align="right"><?=$tni_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$tni_lk_b?></td>
        <td class=input align="right"><?=$tni_lk_l?></td>
        <td class=input align="right"><?=$tni_pr_b?></td>
        <td class=input align="right"><?=$tni_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">5). POLRI</td>
        <td class=input align="right"><?=$pol_lk_b?></td>
        <td class=input align="right"><?=$pol_lk_l?></td>
        <td class=input align="right"><?=$pol_pr_b?></td>
        <td class=input align="right"><?=$pol_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pol_lk_b?></td>
        <td class=input align="right"><?=$pol_lk_l?></td>
        <td class=input align="right"><?=$pol_pr_b?></td>
        <td class=input align="right"><?=$pol_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">6). Mahasiswa</td>
        <td class=input align="right"><?=$mhs_lk_b?></td>
        <td class=input align="right"><?=$mhs_lk_l?></td>
        <td class=input align="right"><?=$mhs_pr_b?></td>
        <td class=input align="right"><?=$mhs_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$mhs_lk_b?></td>
        <td class=input align="right"><?=$mhs_lk_l?></td>
        <td class=input align="right"><?=$mhs_pr_b?></td>
        <td class=input align="right"><?=$mhs_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">7). Pelajar</td>
        <td class=input align="right"><?=$plj_lk_b?></td>
        <td class=input align="right"><?=$plj_lk_l?></td>
        <td class=input align="right"><?=$plj_pr_b?></td>
        <td class=input align="right"><?=$plj_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$plj_lk_b?></td>
        <td class=input align="right"><?=$plj_lk_l?></td>
        <td class=input align="right"><?=$plj_pr_b?></td>
        <td class=input align="right"><?=$plj_pr_l?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">8). Wiraswasta</td>
        <td class=input align="right"><?=$wst_lk_b?></td>
        <td class=input align="right"><?=$wst_lk_l?></td>
        <td class=input align="right"><?=$wst_pr_b?></td>
        <td class=input align="right"><?=$wst_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$wst_lk_b?></td>
        <td class=input align="right"><?=$wst_lk_l?></td>
        <td class=input align="right"><?=$wst_pr_b?></td>
        <td class=input align="right"><?=$swt_pr_l?></td>
    </tr>
    
    <tr class=record>
        <td class=input align="left">9). Petani/Buruh</td>
        <td class=input align="right"><?=$brh_lk_b?></td>
        <td class=input align="right"><?=$brh_lk_l?></td>
        <td class=input align="right"><?=$brh_pr_b?></td>
        <td class=input align="right"><?=$brh_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$brh_lk_b?></td>
        <td class=input align="right"><?=$brh_lk_l?></td>
        <td class=input align="right"><?=$brh_pr_b?></td>
        <td class=input align="right"><?=$brh_pr_l?></td>
    </tr>
   
    <tr class=record>
        <td class=input align="left">10).Pedagang</td>
        <td class=input align="right"><?=$pdg_lk_b?></td>
        <td class=input align="right"><?=$pdg_lk_l?></td>
        <td class=input align="right"><?=$pdg_pr_b?></td>
        <td class=input align="right"><?=$pdg_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pdg_lk_b?></td>
        <td class=input align="right"><?=$pdg_lk_l?></td>
        <td class=input align="right"><?=$pdg_pr_b?></td>
        <td class=input align="right"><?=$pdg_pr_l?></td>
    </tr>
    
    <tr class=record>
        <td class=input align="left">11).Lain - lain</td>
        <td class=input align="right"><?=$ll_lk_b?></td>
        <td class=input align="right"><?=$ll_lk_l?></td>
        <td class=input align="right"><?=$ll_pr_b?></td>
        <td class=input align="right"><?=$ll_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$ll_lk_b?></td>
        <td class=input align="right"><?=$ll_lk_l?></td>
        <td class=input align="right"><?=$ll_pr_b?></td>
        <td class=input align="right"><?=$ll_pr_l?></td>
    </tr>
    
    <tr class=field>
        <td class=input align="center"></td>
        <td class=input align="center" colspan="2">Jumlah</td>
        <td class=input align="right"><?=$jml_lk_b?></td>
        <td class=input align="right"><?=$jml_lk_l?></td>
        <td class=input align="right"><?=$jml_pr_b?></td>
        <td class=input align="right"><?=$jml_pr_l?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$jml_lk_b?></td>
        <td class=input align="right"><?=$jml_lk_l?></td>
        <td class=input align="right"><?=$jml_pr_b?></td>
        <td class=input align="right"><?=$jml_pr_l?></td>
    </tr>
    
    
    <tr class=record>
        <td class=input rowspan="5" align="center">C</td>
        <td class=input rowspan="5" align="left">Jumlah Donor<br>yang mendapat<br>Penghargaan</td>
        <td class=input align="left">1). 10 Kali</td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_p10?></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pr_p10?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">2). 25 Kali</td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_p25?></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pr_p25?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">3). 50 kali</td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_p50?></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pr_p50?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">4). 75 Kali</td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_p75?></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pr_p75?></td>
    </tr>
    <tr class=record>
        <td class=input align="left">5). 100 Kali</td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_p100?></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pr_p100?></td>
    </tr>
    <tr class=field>
        <td class=input align="center"></td>
        <td class=input align="center" colspan="2">Jumlah</td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_p10 + $lk_p25 + $lk_p50 + $lk_p75 + $lk_p100?></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$pr_p10 + $pr_p25 + $pr_p50 + $pr_p75 + $pr_p100?></td>
    </tr>
    
    <tr class=record>
        <td class=input align="center">D</td>
        <td class=input colspan="2" align="left">Donor di tolak</td>
        <td class=input align="right"><?=$lk_b_tolak?></td>
        <td class=input align="right"><?=$lk_l_tolak?></td>
        <td class=input align="right"><?=$pr_b_tolak?></td>
        <td class=input align="right"><?=$pr_l_tolak?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_tolak?></td>
        <td class=input align="right"><?=$lk_l_tolak?></td>
        <td class=input align="right"><?=$pr_b_tolak?></td>
        <td class=input align="right"><?=$pr_l_tolak?></td>
    </tr>
    <tr class=record>
        <td class=input align="center">E</td>
        <td class=input colspan="2" align="left">Donor Cekal</td>
        <td class=input align="right"><?=$lk_b_cekal?></td>
        <td class=input align="right"><?=$lk_l_cekal?></td>
        <td class=input align="right"><?=$pr_b_cekal?></td>
        <td class=input align="right"><?=$pr_l_cekal?></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"></td>
        <td class=input align="right"><?=$lk_b_cekal?></td>
        <td class=input align="right"><?=$lk_l_cekal?></td>
        <td class=input align="right"><?=$pr_b_cekal?></td>
        <td class=input align="right"><?=$pr_l_cekal?></td>
    </tr>
</table>

<form name=xls method=post action=laporan/lttd1_xls.php>
<input type=hidden name=tgl1 value='<?=$tanggalawal?>'>
<input type=hidden name=tgl2 value='<?=$tanggalakhir?>'>
<input type=hidden name=namaperiode value='<?=$namaperiode?>'>
<input type=submit name=submit value="Unduh Laporan (.XLS)" class="swn_button_blue">
<a href="pmi<?=$level_user?>.php?module=laporan&jenis=1" class='swn_button_blue'>Kembali</a>
</form>
<?php
$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0]; $tend = $mtime;  $totaltime = ($tend - $tstart);
printf ("Waktu : %.4f detik.", $totaltime); ?>