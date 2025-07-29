<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
?>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script language=javascript src="util.js" type="text/javascript"> </script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<style>
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
    table, th, td {
        border: 1px solid brown;
    }
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<style>body {font-family: "Lato", sans-serif;}</style>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMDONDAR</title>
</head>

<body>
	<?
		if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
		if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
        $status=$_POST['status'];
        $petugas=$_POST['petugas'];       
	?>
    <a name="atas" id="atas"></a>
	<font size="4" color=00008B>REKAP <b>KONFIRMASI GOLONGAN DARAH</b></font><br><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<table cellpadding=1 cellspacing="0" border="0">
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
				<td align="left" nowrap>Tanggal <input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size="10" style="font-family:monospace"></td>
				<td align="right" nowrap>s/d <input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size="10" style="font-family:monospace"></td>
				<td><input type=submit name=submit class="swn_button_blue" value="Tampilkan data">
			</tr>
		</table>	
	</form>

	<font size="4" color=00008B>Rekap Petugas dan Metode Pemeriksaan</b></font><br><br>
	<table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
			<th rowspan="3">NO.</th>
            <th rowspan="3">PETUGAS</th>
            <th colspan="14">METODE KONFIRMASI</th>
	    <th rowspan="3">TOTAL</th>
		</tr>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th colspan="3">OTOMATIS IMMUCOR</th>
            <th colspan="3">OTOMATIS QWALYS</th>
            <th rowspan="2">%<br>OTO<br>MATIS</th>
            <th colspan="3">MANUAL TUBE TEST</th>
            <th colspan="3">MANUAL BIOLATE</th>
	    <th rowspan="2">%<br>MANUAL</th>
        </tr>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th>Cocok</th>
            <th>Tdk Cocok</th>
            <th>Jml</th>
            <th>Cocok</th>
            <th>Tdk Cocok</th>
            <th>Jml</th>
            <th>Cocok</th>
            <th>Tdk Cocok</th>
            <th>Jml</th>
            <th>Cocok</th>
            <th>Tdk Cocok</th>
            <th>Jml</th>
        </tr>

	<?php
	$no=0;
	$sql="SELECT d.`petugas`, u.`nama_lengkap`,
		sum(case when d.`metode`='Auto-Immucor' and d. `Cocok`='0' THEN 1 else 0 END) as i_cocok,
		sum(case when d.`metode`='Auto-Immucor' and d.`Cocok`='1' THEN 1 else 0 END) as i_tdk_cocok,
		sum(case when d.`metode`='Auto-Qwalys' and d. `Cocok`='0' THEN 1 else 0 END) as q_cocok,
		sum(case when d.`metode`='Auto-Qwalys' and d.`Cocok`='1' THEN 1 else 0 END) as q_tdk_cocok,
		sum(case when d.`metode`='Tube Test' and d.`Cocok`='0' THEN 1 else 0 END) as t_cocok,
		sum(case when d.`metode`='Tube Test' and d.`Cocok`='1' THEN 1 else 0 END) as t_tdk_cocok,
		sum(case when d.`metode`='Bioplate' or d.`metode`='Bioplat' and d. `Cocok`='0' THEN 1 else 0 END) as b_cocok,
		sum(case when d.`metode`='Bioplate' or d.`metode`='Bioplat' and d.`Cocok`='1' THEN 1 else 0 END) as b_tdk_cocok
		FROM `dkonfirmasi` d inner join `user` u on u.id_user=d.`petugas`
		WHERE DATE(d.`tgl`)>='$tglawal' AND date(d.`tgl`)<='$hariini'
		group by `petugas`";
	//echo "$sql";
	$qraw=mysql_query($sql);
	$jml_i=0;	$jml_ic=0;	$jml_itc=0;
	$jml_q=0;	$jml_qc=0;	$jml_qtc=0;
	$jml_t=0;	$jml_tc=0;	$jml_ttc=0;
	$jml_b=0;	$jml_bc=0;	$jml_btc=0;
	$jml_raw=0;
	$jml_ttl=0; $oto_per=0;$oto_man=0;
	$jml_row=0;$jml_row_oto=0;$jmlrow_man=0;
	while($tmp=mysql_fetch_assoc($qraw)){$no++;
		$jml_ic		= $jml_ic + $tmp['i_cocok'];
		$jml_itc	= $jml_itc + $tmp['i_tdk_cocok'];
		$jml_i		= $jml_ic + $jml_itc;
		
		$jml_qc		= $jml_qc + $tmp['q_cocok'];
		$jml_qtc	= $jml_qtc + $tmp['q_tdk_cocok'];
		$jml_q		= $jml_qc + $jml_qtc;
		
		$jml_tc		= $jml_tc + $tmp['t_cocok'];
		$jml_ttc	= $jml_ttc + $tmp['t_tdk_cocok'];
		$jml_t		= $jml_tc + $jml_ttc;
		
		$jml_bc		= $jml_bc + $tmp['b_cocok'];
		$jml_btc	= $jml_btc + $tmp['b_tdk_cocok'];
		$jml_b		= $jml_bc + $jml_btc;
		
		$jml_ttl	= $jml_i + $jml_q + $jml_t + $jml_b;
		$jml_row_oto	= $tmp['i_cocok'] + $tmp['i_tdk_cocok'] + $tmp['q_cocok'] + $tmp['q_tdk_cocok'];
		$jml_row_man	= $tmp['t_cocok'] + $tmp['t_tdk_cocok'] +  $tmp['b_cocok'] + $tmp['b_tdk_cocok'];
		$jml_row	= $jml_row_oto + $jml_row_man;
		$oto_per	= round($jml_row_oto/$jml_row*100);
		$man_per	= round($jml_row_man/$jml_row*100);


		
        ?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td align="right"><?=$no.'.'?></td>
	    <td align="left" nowrap><?=$tmp['nama_lengkap']?></td>
            <td align="center"><?=$tmp['i_cocok']?></td>
            <td align="center"><?=$tmp['i_tdk_cocok']?></td>
            <td style="background-color:mistyrose;" align="center"><?=$tmp['i_cocok'] + $tmp['i_tdk_cocok'];?></td>
            <td align="center"><?=$tmp['q_cocok']?></td>
            <td align="center"><?=$tmp['q_tdk_cocok']?></td>
            <td style="background-color:mistyrose;" align="center"><?=$tmp['q_cocok'] + $tmp['q_tdk_cocok'];?></td>
	    <td style="background-color:mistyrose;" align="center"><?=$oto_per.'%';?></td>	
            <td align="center"><?=$tmp['t_cocok']?></td>
            <td align="center"><?=$tmp['t_tdk_cocok']?></td>
	    <td style="background-color:mistyrose;" align="center"><?=$tmp['t_cocok'] + $tmp['t_tdk_cocok'];?></td>	  
	    <td align="center"><?=$tmp['b_cocok']?></td>
            <td align="center"><?=$tmp['b_tdk_cocok']?></td>
            <td style="background-color:mistyrose;" align="center"><?=$tmp['b_cocok'] + $tmp['b_tdk_cocok'];?></td>
	    <td style="background-color:mistyrose;" align="center"><?=$man_per.'%';?></td>
            <td style="background-color:mistyrose;" align="center"><?=$tmp['i_cocok'] + $tmp['i_tdk_cocok'] + $tmp['q_cocok'] + $tmp['q_tdk_cocok'] + $tmp['t_cocok'] + $tmp['t_tdk_cocok'] +  $tmp['b_cocok'] + $tmp['b_tdk_cocok'];?></td>
		</tr>
	<?}
	if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td colspan=31 align="center">Tidak Ada Data Konfirmasi Golongan Darah</td>
	<?}?>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th colspan="2"> TOTAL </th>
            <th> <?=$jml_ic;?> </th>
            <th> <?=$jml_itc;?> </th>
            <th> <?=$jml_i;?> </th>
            <th> <?=$jml_qc;?> </th>
            <th> <?=$jml_qtc;?> </th>
            <th> <?=$jml_q;?> </th>
	    <th> <?=round(($jml_i+$jml_q)/$jml_ttl*100).'%';?> </th>
            <th> <?=$jml_tc;?> </th>
            <th> <?=$jml_ttc;?> </th>
            <th> <?=$jml_t;?> </th>
            <th> <?=$jml_bc;?> </th>
            <th> <?=$jml_btc;?> </th>
            <th> <?=$jml_b;?> </th>
	    <th> <?=round(($jml_t+$jml_b)/$jml_ttl*100).'%';?> </th>
            <th> <?=$jml_ttl;?> </th>
        </tr>
        </table>
        
     <br><font size="4" color=00008B>REKAP Lot Reagensia terpakai</b></font><br><br>
     <table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
			<th>NO.</th>
            <th>REAGENSIA</th>
            <th>No LOT</th>
			<th>ED</th>
			<th>JUMLAH</th>
		</tr>
		<?//Anti A
		$q="SELECT upper(`nolot_aa`) as nolot,`expa` as ed, count(`id`) as Jumlah  FROM `dkonfirmasi` WHERE DATE(`tgl`)>='$tglawal' AND date(`tgl`)<='$hariini' group by upper(`nolot_aa`),`expa`;";
		//echo "$q";
		$qr=mysql_query($q);
		$no=0;
		$total_antia=0;
		while($t=mysql_fetch_assoc($qr)){$no++;
			$total_antia=$total_antia + $t['Jumlah'];
			?>
		     	<tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td><?=$no."."?></td>
        		    <td>Anti A</td>
                    <td><a href="pmikonfirmasi.php?module=lot_kgd&t1=<?=$tglawal?>&t2=<?=$hariini?>&l=<?=$t[nolot]?>&ed=<?=$t[ed]?>&anti=A"><?=$t['nolot'];?></a> </td>
					<td><?=$t['ed'];?></td>
					<td align="right"><?=$t['Jumlah'];?></td>
				</tr>	
			<?
		}?>
		<?//Anti B
		$q="SELECT upper(`nolot_ab`) as nolot,`expb` as ed, count(`id`) as Jumlah  FROM `dkonfirmasi` WHERE DATE(`tgl`)>='$tglawal' AND date(`tgl`)<='$hariini' group by upper(`nolot_ab`),`expb`;";
		$qr=mysql_query($q);
		$no=0;
		$total_antib=0;
		while($t=mysql_fetch_assoc($qr)){$no++;
			$total_antib=$total_antib + $t['Jumlah'];
			?>
		     	<tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td><?=$no."."?></td>
        		    <td>Anti B</td>
        		    <td><a href="pmikonfirmasi.php?module=lot_kgd&t1=<?=$tglawal?>&t2=<?=$hariini?>&l=<?=$t[nolot]?>&ed=<?=$t[ed]?>&anti=B"><?=$t['nolot'];?></a> </td>
					<td><?=$t['ed'];?></td>
					<td align="right"><?=$t['Jumlah'];?></td>
				</tr>	
			<?
		}?>
		<?//Anti D
		$q="SELECT upper(`nolot_ad`) as nolot,`expd` as ed, count(`id`) as Jumlah  FROM `dkonfirmasi` WHERE DATE(`tgl`)>='$tglawal' AND date(`tgl`)<='$hariini' group by upper(`nolot_ad`),`expd`;";
		$qr=mysql_query($q);
		$no=0;
		$total_antid=0;
		while($t=mysql_fetch_assoc($qr)){$no++;
			$total_antid=$total_antid + $t['Jumlah'];
			?>
		     	<tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td><?=$no."."?></td>
        		    <td>Anti D</td>
                    <td><a href="pmikonfirmasi.php?module=lot_kgd&t1=<?=$tglawal?>&t2=<?=$hariini?>&l=<?=$t[nolot]?>&ed=<?=$t[ed]?>&anti=D"><?=$t['nolot'];?></a> </td>
					<td><?=$t['ed'];?></td>
					<td align="right"><?=$t['Jumlah'];?></td>
				</tr>	
			<?
		}?>
		<tr style="background-color:mistyrose; font-size:12px; color:#000000;">
			<th colspan="4">TOTAL ANTI A</th>
			<th><?=$total_antia;?></th>
		</tr>
		<tr style="background-color:mistyrose; font-size:12px; color:#000000;">
			<th colspan="4">TOTAL ANTI B</th>
			<th><?=$total_antib;?></th>
		</tr>
		<tr style="background-color:mistyrose; font-size:12px; color:#000000;">
			<th colspan="4">TOTAL ANTI D</th>
			<th><?=$total_antid;?></th>
		</tr>
	</table>	
    <div style="font-size: 10px;color: #000000">Update 2018-12-16</div>
</body>
</html>

