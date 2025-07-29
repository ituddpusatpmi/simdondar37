<head>
    <title>SIMDONDAR Info</title>
</head>
<?php
$started_at = microtime(true);
//0:Kurang, 1: tipis, 2: aman, 3: over

function switchColor($rowValue) {
    switch ($rowValue) {
        case '0' : echo 'red'; break;
        case '1' : echo 'yellow'; break;
        case '2' : echo 'white'; break;
        case '3' : echo 'white'; break;
        default  : echo 'white'; break;
    }
}
function FontColor($rowValue) {
    switch ($rowValue) {
        case '0' : echo 'white'; break;
        case '1' : echo 'black'; break;
        case '2' : echo 'black'; break;
        case '3' : echo 'black'; break;
        default  : echo 'black'; break;
    }
}
//date_default_timezone_set("Asia/Makassar");

date_default_timezone_set("Asia/Jakarta");
include('../config/db_connect.php');
$utd		= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
$date = date('d M Y H:i:s', time());
//KEBUTUHAN STOK
//PRC
$prca=0;   $prcb=0;   $prco=0;   $prcab=0;
//TC
$tca=0;     $tcb=0;    $tco=0;    $tcab=0;
//Var Tampilan
$A=0;       $B=0;       $AB=0;      $O=0;
$jum_a=0;   $jum_b=0;   $jum_ab=0;  $jum_o=0;
$Ak=0;      $Bk=0;      $Ok=0;      $ABk=0;
$jum_ak=0;  $jum_bk=0;  $jum_abk=0; $jum_ok=0;


?>
<table border=0 cellpadding=2 cellspacing=1 width="500px">
    <tr>
        <td><font size="4" color="red" face="Arial"><b><?=$utd[nama]?></b></font></td>

    </tr>
</table>
<div id="content">
    <table border=1 cellpadding=1 cellspacing=1 width="500px">
        <tr bgcolor="#FF0000">
            <td align=center colspan="6" height="30px" ><font size="3" color="white" face="Trebuchet MS"><b>STOK DARAH <?=$date?> WIB</b></font></td>
        </tr>
        <tr bgcolor="#FF0000">
            <td width="200px" align=center rowspan="2"><font size="2" color="#ffffff" face="Trebuchet MS"><b>KOMPONEN DARAH</b></font></td>
            <!--td align=center colspan="5"><font size="2" color="#ffffff" face="Trebuchet MS"><b>STOK SEHAT</b></font></td-->
            <!--td align=center colspan="5"><font size="2" color="#ffffff" face="Trebuchet MS"><b>STOK KARANTINA</b></font></td-->
        </tr>
        <tr bgcolor="#FF0000">
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td>
            <!--td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td-->
        </tr>
        <?
        $no_produk=0;
        $produk=mysql_query("select * from produk where no between 1 and 4 order by no");
        while ($produk1=mysql_fetch_assoc($produk)) {
        $no_produk++;
        $namaproduk=$produk1['Nama'];
        $qstok="select `produk`.`no` AS `no`, `produk`.`lengkap` AS `lengkap`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'A') and (`stokkantong`.`Status` = '2')) then 1 else 0 end)) AS `sGOLA`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'B') and (`stokkantong`.`Status` = '2')) then 1 else 0 end)) AS `sGOLB`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'O') and (`stokkantong`.`Status` = '2')) then 1 else 0 end)) AS `sGOLO`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'AB') and (`stokkantong`.`Status` = '2')) then 1 else 0 end)) AS `sGOLAB`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'A') and (`stokkantong`.`Status` = '1')) then 1 else 0 end)) AS `kGOLA`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'B') and (`stokkantong`.`Status` = '1')) then 1 else 0 end)) AS `kGOLB`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'O') and (`stokkantong`.`Status` = '1')) then 1 else 0 end)) AS `kGOLO`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'AB') and (`stokkantong`.`Status` = '1')) then 1 else 0 end)) AS `kGOLAB`,
                    count(`stokkantong`.`noKantong`) AS `jumlah`
                    from (`produk` left join `stokkantong` on((`produk`.`Nama` = `stokkantong`.`produk`)))
                    where (((`stokkantong`.`stat2` = '0') or isnull(`stokkantong`.`stat2`)) and (`stokkantong`.`sah` = '1')
                    and (`stokkantong`.`kadaluwarsa` > curdate()) and (`stokkantong`.`statKonfirmasi` = '1')
                    and (`stokkantong`.`Status` in (1,2)) and (`stokkantong`.`produk`='$namaproduk')) group by `produk`.`no`,`produk`.`lengkap`";
        $st0=mysql_query($qstok);
        $st1=mysql_fetch_assoc($st0);
        $A=$st1['sGOLA'];
        $B=$st1['sGOLB'];
        $O=$st1['sGOLO'];
        $AB=$st1['sGOLAB'];
        $Ak=$st1['kGOLA'];
        $Bk=$st1['kGOLB'];
        $Ok=$st1['kGOLO'];
        $ABk=$st1['kGOLAB'];

        if ($A<1) $A='0';
        if ($B<1) $B='0';
        if ($AB<1) $AB='0';
        if ($O<1) $O='0';
        if ($Ak<1) $Ak='0';
        if ($Bk<1) $Bk='0';
        if ($ABk<1) $ABk='0';
        if ($Ok<1) $Ok='0';

        $jum_a=$jum_a+$A;
        $jum_b=$jum_b+$B;
        $jum_ab=$jum_ab+$AB;
        $jum_o=$jum_o+$O;
        $total=$jum_a+$jum_b+$jum_ab+$jum_o;
        $jum_ak=$jum_ak+$Ak;
        $jum_bk=$jum_bk+$Bk;
        $jum_abk=$jum_abk+$ABk;
        $jum_ok=$jum_ok+$Ok;
        $totalk=$jum_ak+$jum_bk+$jum_abk+$jum_ok;
        //0:Kurang, 1: tipis, 2: aman, 3: over
        $jumlah=$A+$B+$AB+$O;
        $jumlahk=$Ak+$Bk+$ABk+$Ok;


        if($produk1[Nama]=='PRC'){
            If ($A<=$prca){$pesanprca='0';}
            If (($A>=$prca) and ($A<=$prca*3)){$pesanprca='1';}
            If ($A>=$prca*3){$pesanprca='2';}
            If ($A>$prca*7){$pesanprca='3';}

            If ($B<=$prcb){$pesanprcb='0';}
            If (($B>=$prcb) and ($B<=$prcb*3)){$pesanprcb='1';}
            If ($B>=$prcb*3){$pesanprcb='2';}
            If ($B>$prcb*7){$pesanprcb='3';}

            If ($O<=$prco){$pesanprco='0';}
            If (($O>=$prco) and ($O<=$prco*3)){$pesanprco='1';}
            If ($O>=$prco*3){$pesanprco='2';}
            If ($O>$prco*7){$pesanprco='3';}

            If ($AB<=$prcab){$pesanprcab='0';}
            If (($AB>=$prcab) and ($O<=$prcO*3)){$pesanprcab='1';}
            If ($AB>=$prcab*3){$pesanprcab='2';}
            If ($AB>=$prcab*7){$pesanprcab='3';}
        }
        if($produk1[Nama]=='TC'){
		$pesantca='2';
		$pesantcb='2';		
		$pesantco='2';
		$pesantcab='2';
            If ($A<=1){$pesantca='0';}
            If (($A>1) and ($A<$tca)){$pesantca='1';}
            If ($A>=$tca){$pesantca='2';}
            If ($A>$tca*2){$pesantca='3';}

            If ($B<=1){$pesantcb='0';}
            If (($B>1) and ($B<$tcb)){$pesantcb='1';}
            If ($B>=$tcb){$pesantcb='2';}
            If ($B>$tcb*2){$pesantcb='3';}

            If ($O<=1){$pesantco='0';}
            If (($O>1) and ($O<$tco)){$pesantco='1';}
            If ($O>=$tco){$pesantco='2';}
            If ($O>$tco*2){$pesantco='3';}

            If ($BA<=1){$pesantcab='0';}
            If (($AB>1) and ($O<$tcab)){$pesantcab='1';}
            If ($AB>=$tcab){$pesantcab='2';}
            If ($AB>$tcab*2){$pesantcab='3';}

        }
        if ($produk1[Nama]=="PRC"){
            ?>
            <tr>
                <td align=left bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'><?=$produk1[lengkap]?></font></td>
                <td align=right bgcolor=<?=switchColor($pesanprca)?>><font color=<?=FontColor($pesanprca)?> size=2 face='Trebuchet MS'><?=$A?></font></td>
                <td align=right bgcolor=<?=switchColor($pesanprcb)?>><font color=<?=FontColor($pesanprcb)?> size=2 face='Trebuchet MS'><?=$B?></font></td>
                <td align=right bgcolor=<?=switchColor($pesanprco)?>><font color=<?=FontColor($pesanprco)?> size=2 face='Trebuchet MS'><?=$O?></font></td>
                <td align=right bgcolor=<?=switchColor($pesanprcab)?>><font color=<?=FontColor($pesanprcab)?> size=2 face='Trebuchet MS'><?=$AB?></font></td>
                <td align=right bgcolor=#FF0000><font size=2 color=#ffffff face='Trebuchet MS'><?=$jumlah?></font></td>
            </tr>
        <?
        } elseif ($produk1[Nama]=="TC"){?>
        <tr>
            <td align=left  bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'><?=$produk1[lengkap]?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantca)?>><font color=<?=FontColor($pesantca)?> size=2 face='Trebuchet MS'><?=$A?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantcb)?>><font color=<?=FontColor($pesantcb)?> size=2 face='Trebuchet MS'><?=$B?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantco)?>><font color=<?=FontColor($pesantco)?> size=2 face='Trebuchet MS'><?=$O?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantcab)?>><font color=<?=FontColor($pesantcab)?> size=2 face='Trebuchet MS'><?=$AB?></font></td>
            <td align=right bgcolor=#FF0000><font size=2 color=#ffffff face='Trebuchet MS'><?=$jumlah?></font></td>
            <?

            } else {
                echo "<tr>
				<td align=left  bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'>$produk1[lengkap]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$A</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$B</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$O</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$AB</font></td>
				<td align=right bgcolor=#FF0000> <font color=#ffffff size=2 face='Trebuchet MS'>$jumlah</font></td>
				
				</tr>";
            }
            }
            echo "<tr bgcolor=#FF0000>
		<td align=center><font size=2 color=#ffffff face='Trebuchet MS'><b>JUMLAH</b></font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_a</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_b</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_o</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_ab</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$total</font></td>
		

		</tr>";
            ?>
    </table>
</div>

    </tr>
</table-->
<p>

<?php
//DATA MOBILE UNIT HARI INI
$tot_ds=0;
$tot_dp=0;
$tot_baru=0;
$tot_ulang=0;
$tot_lk=0;
$tot_pr=0;
$tot_antri=0;
$tot_berhasil=0;
$tot_gagal=0;
$tot_batal=0;
$tot_biasa=0;
$tot_aph=0;
$tot_a=0;
$tot_b=0;
$tot_ab=0;
$tot_o=0;
$tot_x=0;
$tot_ttl=0;
$instansi='';
$no=0;

$sql_mu="SELECT kegiatan.NoTrans,
	case
	when date_format(kegiatan.TglPenjadwalan,'%w') = 0 THEN 'Minggu'
	when date_format(kegiatan.TglPenjadwalan,'%w') = 1 THEN 'Senin'
	when date_format(kegiatan.TglPenjadwalan,'%w') = 2 THEN 'Selasa'
	when date_format(kegiatan.TglPenjadwalan,'%w') = 3 THEN 'Rabu'
	when date_format(kegiatan.TglPenjadwalan,'%w') = 4 THEN 'Kamis'
	when date_format(kegiatan.TglPenjadwalan,'%w') = 5 THEN 'Jumat'
	when date_format(kegiatan.TglPenjadwalan,'%w') = 6 THEN 'Sabtu'
	end as hari,
	date(kegiatan.TglPenjadwalan) as tglasli,
    date_format(kegiatan.TglPenjadwalan,'%d-%m-%Y') as tanggal,
    date_format(kegiatan.TglPenjadwalan,'%H:%i') as jam,
    kegiatan.jumlah as jumlah, kegiatan.lat as lat,
    kegiatan.lng as lng, detailinstansi.nama as nama, detailinstansi.alamat as alamat,
    kegiatan.Status, kegiatan.sukses, kegiatan.batal, kegiatan.gagal
    from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
    where cast(kegiatan.TglPenjadwalan as date) between current_date AND current_date+6
    ORDER BY kegiatan.TglPenjadwalan ASC";




?>
<br>
<table border=1cellpadding=2 cellspacing=1 width=500px >
    <tr bgcolor=#FF0000>
        <td colspan="6" align="center" height="30px"><font size="3" color="#ffffff" face="Trebuchet MS"><b>KEGIATAN MOBILE UNIT</td>
    </tr>
    <tr bgcolor=#FF0000>
	<td align="center" ><font size="2" color="#ffffff" face="Trebuchet MS"><b>No.</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>HARI</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>TANGGAL</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>JAM</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>INSTANSI</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>ALAMAT</td>
    </tr>
    
    <?
    //dalam gedung
    $instansi='';
    $tempatdonor="";
    $sql=mysql_query($sql_mu);
    while($data=mysql_fetch_assoc($sql)){
        $no++;
        echo "
        <tr>
			<td align=left bgcolor=white><font size=2 color=black face='Trebuchet MS'>$no</td>
			<td align=left bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[hari]</td>
			<td align=left bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[tanggal]</td>
			<td align=left bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[jam]</td>
			<td align=left bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[nama]</td>
			<td align=left bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[alamat]</td>
			
        </tr>
        ";
    }
    
    ?>
    
</table>
<table border=0 cellpadding=2 cellspacing=1 width="500px">
    <tr>
        <td><font size="1" color="black" face="Trebuchet MS">Data real time dari Sistem Informasi <?=$utd[nama]?></font></td>
        <td align="right"><font size="1" color="black" face="Trebuchet MS">(<i>Loading</i> data dalam  <?=number_format((microtime(true) - $started_at),3,",",".") ?> dtk) &reg10022018</font></td>
    </tr>
</table>



