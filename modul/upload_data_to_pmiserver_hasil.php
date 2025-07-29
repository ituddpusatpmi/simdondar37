<font size="3" color="red" face="Trebuchet MS"><b>REKAP STOK DARAH PER SAAT INI</b></font><BR>
<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="1">
	<tr class=field>
		<th rowspan="2">No.</th>
		<th rowspan="2">Produk Darah</th>
		<th colspan="2">A</th>
		<th colspan="2">B</th>
		<th colspan="2">O</th>
		<th colspan="2">AB</th>
	</tr>
	<tr class=field>
		<th>Rh Pos</th>		<th>Rh Neg</th>
		<th>Rh Pos</th>		<th>Rh Neg</th>
		<th>Rh Pos</th>		<th>Rh Neg</th>
		<th>Rh Pos</th>		<th>Rh Neg</th>
	</tr>
	<?for ($i=1;$i<count($namaproduk)+1;$i++){?>
		<tr class="record">
			<td class=input><?=$i?></td>
			<td class=input align="left"><?=$namalengkap[$i]?></td>
			<td class=input><?=$Ap[$i]?></td>			<td class=input><?=$An[$i]?></td>
			<td class=input><?=$Bp[$i]?></td>			<td class=input><?=$Bn[$i]?></td>
			<td class=input><?=$Op[$i]?></td>			<td class=input><?=$On[$i]?></td>
			<td class=input><?=$ABp[$i]?></td>			<td class=input><?=$ABn[$i]?></td>
		</tr>
	<?}?>
</table>


<font size="3" color="red" face="Trebuchet MS"><b>KEGIATAN MOBILE UNIT</b></font><BR>
<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="1">
	<tr class=field>
		<th>No.</th><th>TANGGAL</th><th>INSTANSI</th><th>ALAMAT</th><th>JUMLAH</th><th>LAT</th><th>LNG</th><th>Kendaraan</th>
	</tr>
	<?
	for ($i=1;$i<count($NoTrans)+1;$i++){?>
		<? if ($kendaraan[$i]=="0"){$bus_mu="BUS Donor";} else{$bus_mu="Mobil MU";}?>
		<tr class="record">
			<td class=input><?=$i?></td>
			<td class=input align="left"><?=$TglPenjadwalan[$i]?></td>
			<td class=input align="left"><?=$instansi[$i]?></td>
			<td class=input align="left"><?=$alamat[$i]?></td>
			<td class=input><?=$jumlah[$i]?></td>
			<td class=input><?=$lat[$i]?></td>
			<td class=input><?=$lng[$i]?></td>
			<td class=input><?=$bus_mu?></td>
		</tr>
	<?}?>
</table>

<font size="3" color="red" face="Trebuchet MS"><b>REKAP JUMLAH PENDONOR</b></font><BR>
	<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="1">
		<tr class=field>
			<th rowspan="2">No</th><th rowspan="2">Jenis Kelamin</th>
			<th colspan="2">A</th>	<th colspan="2">B</th>			<th colspan="2">O</th>			<th colspan="2">AB</th>
		</tr>
		<tr class=field>
			<th>Rh Pos</th>			<th>Rh Neg</th>
			<th>Rh Pos</th>			<th>Rh Neg</th>
			<th>Rh Pos</th>			<th>Rh Neg</th>
			<th>Rh Pos</th>			<th>Rh Neg</th>
		</tr>
	<tr class=record>
		<td class=input>1</td>
		<td class=input align=left>Laki-laki</td>
		<td class=input><?=$lk_Apos?></td>		<td class=input><?=$lk_Aneg?></td>
		<td class=input><?=$lk_Bpos?></td>		<td class=input><?=$lk_Bneg?></td>
		<td class=input><?=$lk_Opos?></td>		<td class=input><?=$lk_Oneg?></td>
		<td class=input><?=$lk_ABpos?></td>		<td class=input><?=$lk_ABneg?></td>
	</tr>
	<tr class=record>
		<td class=input>2</td>
		<td class=input align=left>Perempuan</td>
		<td class=input><?=$pr_Apos?></td>		<td class=input><?=$pr_Aneg?></td>
		<td class=input><?=$pr_Bpos?></td>		<td class=input><?=$pr_Bneg?></td>
		<td class=input><?=$pr_Opos?></td>		<td class=input><?=$pr_Oneg?></td>
		<td class=input><?=$pr_ABpos?></td>		<td class=input><?=$pr_ABneg?></td>
	</tr>
	<tr class=field>
		<th></th>
		<th colspan="4" align='left'>Rekapitulasi Jumlah Donasi</th>
		<th colspan="5" align='left'>Rekapitulasi Umur Pendonor</th>
	</tr>
	<tr class=field>
		<th></th>
		<th colspan="2">Donasi</th><th colspan="2">Jumlah</th><th colspan="2">Umur</th><th colspan="2">Jumlah</th><th></th>
	</tr>
	<tr class=record>
		<td>1</td><td colspan="2" class=input align='left'> < 10 Kali</td><td colspan="2" class=input><?=$Jum1?></td>
		<td colspan="2" class=input align='left'> 17 - 30 Tahun</td><td colspan="2" class=input><?=$umur17_30?></td><td></td>
	</tr>
	<tr class=record>
		<td>2</td><td colspan="2" class=input align='left'>10-24 Kali</td><td colspan="2" contextmenu=`><?=$Jum10?></td>
		<td colspan="2" class=input align='left'> 31 - 40 Tahun</td><td colspan="2" class=input><?=$umur31_40?></td><td></td>
	</tr>
	<tr class=record>
		<td>3</td><td colspan="2" class=input align='left'>25-49 Kali</td><td colspan="2" class=input><?=$Jum25?></td>
		<td colspan="2" class=input align='left'> 41 - 50 Tahun</td><td colspan="2" class=input><?=$umur41_50?></td><td></td>
	</tr>
	<tr class=record>
		<td>4</td>
		<td colspan="2" class=input align='left'>50-74 Kali</td><td colspan="2" class=input><?=$Jum50?></td>
		<td colspan="2" class=input align='left'> 51 - 60 Tahun</td><td colspan="2" class=input><?=$umur51_60?></td><td></td>
	</tr>
	<tr class=record>
		<td>5</td><td colspan="2" class=input align='left'>75-99 Kali</td><td colspan="2" class=input><?=$Jum75?></td>
		<td colspan="2" class=input align='left'> > 60  Tahun</td><td colspan="2" class=input><?=$umur60_lebih?></td><td></td>
	</tr>
	<tr class=record>
		<td>6</td>
		<td colspan="2" class=input align='left'>100 Kali/lebih</td><td colspan="2" class=input><?=$Jum100?></td>
		<td colspan="5"></td>
	</tr>
</table>


<font size="3" color="red" face="Trebuchet MS"><b>REKAP TRANSAKSI DONOR PER TANGGAL (<?=$tanggal?>)</b></font><BR>
	<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="1">
		<tr class=field>
			<th rowspan="3">No</th>
			<th rowspan="3">Lokasi Pengambilan</th>
			<th rowspan="3">Jenis Donor</th>
			<th rowspan="3">Jenis Kelamin</th>
			<th colspan="8">Golongan Darah (Kantong)</th>
		</tr>
		<tr class=field>
			<th colspan="2">A</th>			<th colspan="2">B</th>			<th colspan="2">O</th>			<th colspan="2">AB</th>
		</tr>
	<tr class=field>
		<th>Rh Pos</th>		<th>Rh Neg</th>
		<th>Rh Pos</th>		<th>Rh Neg</th>
		<th>Rh Pos</th>		<th>Rh Neg</th>
		<th>Rh Pos</th>		<th>Rh Neg</th>
	</tr>
	<tr class=record>
		<td rowspan='4'>1</td>
		<td rowspan='4' align='left'>Di UDD</td>
		<td align='left' rowspan='2'>Sukarela</td>
		<td align='left'>Laki-laki</td>
		<td><?=$dg_lk_ds_a_pos?></td><td><?=$dg_lk_ds_a_neg?></td>
		<td><?=$dg_lk_ds_b_pos?></td><td><?=$dg_lk_ds_b_neg?></td>
		<td><?=$dg_lk_ds_o_pos?></td><td><?=$dg_lk_ds_o_neg?></td>
		<td><?=$dg_lk_ds_ab_pos?></td><td><?=$dg_lk_ds_ab_neg?></td>
	</tr>
	<tr class=record>
		<td align='left'>Perempuan</td>
		<td><?=$dg_pr_ds_a_pos?></td><td><?=$dg_pr_ds_a_neg?></td>
		<td><?=$dg_pr_ds_b_pos?></td><td><?=$dg_pr_ds_b_neg?></td>
		<td><?=$dg_pr_ds_o_pos?></td><td><?=$dg_pr_ds_o_neg?></td>
		<td><?=$dg_pr_ds_ab_pos?></td><td><?=$dg_pr_ds_ab_neg?></td>
	</tr>
	<tr class=record>
		<td align='left' rowspan='2'>Pengganti</td>
		<td align='left'>Laki-laki</td>
		<td><?=$dg_lk_dp_a_pos?></td><td><?=$dg_lk_dp_a_neg?></td>
		<td><?=$dg_lk_dp_b_pos?></td><td><?=$dg_lk_dp_b_neg?></td>
		<td><?=$dg_lk_dp_o_pos?></td><td><?=$dg_lk_dp_o_neg?></td>
		<td><?=$dg_lk_dp_ab_pos?></td><td><?=$dg_lk_dp_ab_neg?></td>
	</tr>
	<tr class=record>
		<td align='left'>Perempuan</td>
		<td><?=$dg_pr_dp_a_pos?></td><td><?=$dg_pr_dp_a_neg?></td>
		<td><?=$dg_pr_dp_b_pos?></td><td><?=$dg_pr_dp_b_neg?></td>
		<td><?=$dg_pr_dp_o_pos?></td><td><?=$dg_pr_dp_o_neg?></td>
		<td><?=$dg_pr_dp_ab_pos?></td><td><?=$dg_pr_dp_ab_neg?></td>
	</tr>
	<tr class=record>
		<td rowspan='2'>2</td>
		<td align='left' rowspan='2'>Mobil Unit</td>
		<td align='left' rowspan='2'>Sukarela</td>
		<td align='left'>Laki-laki</td>
		<td><?=$mu_lk_ds_a_pos_nbus?></td><td><?=$mu_lk_ds_a_neg_nbus?></td>
		<td><?=$mu_lk_ds_b_pos_nbus?></td><td><?=$mu_lk_ds_b_neg_nbus?></td>
		<td><?=$mu_lk_ds_o_pos_nbus?></td><td><?=$mu_lk_ds_o_neg_nbus?></td>
		<td><?=$mu_lk_ds_ab_pos_nbus?></td><td><?=$mu_lk_ds_ab_neg_nbus?></td>
	</tr>
	<tr class=record>
		<td align='left'>Perempuan</td>
		<td><?=$mu_pr_ds_a_pos_nbus?></td><td><?=$mu_pr_ds_a_neg_nbus?></td>
		<td><?=$mu_pr_ds_b_pos_nbus?></td><td><?=$mu_pr_ds_b_neg_nbus?></td>
		<td><?=$mu_pr_ds_o_pos_nbus?></td><td><?=$mu_pr_ds_o_neg_nbus?></td>
		<td><?=$mu_pr_ds_ab_pos_nbus?></td><td><?=$mu_pr_ds_ab_neg_nbus?></td>
	</tr>
	<tr class=record>
		<td rowspan='2'>3</td>
		<td align='left' rowspan='2'>Mobil Unit Bus Donor</td>
		<td align='left' rowspan='2'>Sukarela</td>
		<td align='left'>Laki-laki</td>
		<td><?=$mu_lk_ds_a_pos_bus?></td><td><?=$mu_lk_ds_a_neg_bus?></td>
		<td><?=$mu_lk_ds_b_pos_bus?></td><td><?=$mu_lk_ds_b_neg_bus?></td>
		<td><?=$mu_lk_ds_o_pos_bus?></td><td><?=$mu_lk_ds_o_neg_bus?></td>
		<td><?=$mu_lk_ds_ab_pos_bus?></td><td><?=$mu_lk_ds_ab_neg_bus?></td>
	</tr>
	<tr class=record>
		<td align='left'>Perempuan</td>
		<td><?=$mu_pr_ds_a_pos_bus?></td><td><?=$mu_pr_ds_a_neg_bus?></td>
		<td><?=$mu_pr_ds_b_pos_bus?></td><td><?=$mu_pr_ds_b_neg_bus?></td>
		<td><?=$mu_pr_ds_o_pos_bus?></td><td><?=$mu_pr_ds_o_neg_bus?></td>
		<td><?=$mu_pr_ds_ab_pos_bus?></td><td><?=$mu_pr_ds_ab_neg_bus?></td>
	</tr>
</table>
