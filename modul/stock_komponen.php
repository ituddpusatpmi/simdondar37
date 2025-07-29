<head>
    <title>SIMDONDAR</title>
</head>
<?php
$started_at = microtime(true);
//0:Kurang, 1: tipis, 2: aman, 3: over

function switchColor($rowValue) {
    switch ($rowValue) {
        case '0' : echo 'red'; break;
        case '1' : echo 'yellow'; break;
        case '2' : echo 'white'; break;
        case '3' : echo 'green'; break;
        default  : echo 'white'; break;
    }
}
function FontColor($rowValue) {
    switch ($rowValue) {
        case '0' : echo 'white'; break;
        case '1' : echo 'black'; break;
        case '2' : echo 'black'; break;
        case '3' : echo 'white'; break;
        default  : echo 'black'; break;
    }
}
date_default_timezone_set("Asia/Jakarta");
include('config/db_connect.php');
$date = date('d-m-Y H:i:s', time());
//KEBUTUHAN STOK
//PRC
$prca=21;   $prcb=33;   $prco=48;   $prcab=6;
//TC
$tca=7;     $tcb=13;    $tco=17;    $tcab=2;
//Var Tampilan
$A=0;       $B=0;       $AB=0;      $O=0;
$jum_a=0;   $jum_b=0;   $jum_ab=0;  $jum_o=0;
$Ak=0;      $Bk=0;      $Ok=0;      $ABk=0;
$jum_ak=0;  $jum_bk=0;  $jum_abk=0; $jum_ok=0;


?>
<a name="atas" id="atas"></a>
<table border=0 cellpadding=2 cellspacing=1 width="700px">
    <tr>
        <td><font size="4" color="red" face="Arial"><b>STOK DARAH SEHAT</b></font></td>
        <td align="right"><font size="3" color="black" face="Trebuchet MS"><?=$date?> WITA</font></td>
    </tr>
</table>
<div id="content">
    <table border=1 cellpadding=1 cellspacing=1 width="700px" style="border-collapse:collapse">
        <tr bgcolor="#ED6161">
            <td width="200px" align=center rowspan="2"><font size="2" color="#ffffff" face="Trebuchet MS"><b>KOMPONEN DARAH</b></font></td>
            <td align=center colspan="5"><font size="2" color="#ffffff" face="Trebuchet MS"><b>RHESUS POSITIF</b></font></td>
            <td align=center colspan="5"><font size="2" color="#ffffff" face="Trebuchet MS"><b>RHESUS NEGATIF</b></font></td>
        </tr>
        <tr bgcolor="#ED6161">
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
            <td width="40px" align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td>
        </tr>
        <?
        $no_produk=0;
        $produk=mysql_query("select * from produk order by no");
        while ($produk1=mysql_fetch_assoc($produk)) {
        $no_produk++;
        $namaproduk=$produk1['Nama'];
        $qstok="select `produk`.`no` AS `no`, `produk`.`lengkap` AS `lengkap`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'A') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '+')) then 1 else 0 end)) AS `sGOLA`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'B') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '+')) then 1 else 0 end)) AS `sGOLB`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'O') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '+')) then 1 else 0 end)) AS `sGOLO`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'AB') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '+')) then 1 else 0 end)) AS `sGOLAB`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'A') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '-')) then 1 else 0 end)) AS `kGOLA`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'B') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '-')) then 1 else 0 end)) AS `kGOLB`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'O') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '-')) then 1 else 0 end)) AS `kGOLO`,
                    sum((case when ((`stokkantong`.`gol_darah` = 'AB') and (`stokkantong`.`Status` = '2') and (`RhesusDrh` = '-')) then 1 else 0 end)) AS `kGOLAB`,
                    count(`stokkantong`.`noKantong`) AS `jumlah`
                    from (`produk` left join `stokkantong` on((`produk`.`Nama` = `stokkantong`.`produk`)))
                    where (((`stokkantong`.`stat2` = '0') or isnull(`stokkantong`.`stat2`)) and (`stokkantong`.`sah` = '1')
                    and (`stokkantong`.`kadaluwarsa` > curdate()) and (`stokkantong`.`statKonfirmasi` = '1')
                    and (`stokkantong`.`Status` = '2') and (`stokkantong`.`produk`='$namaproduk')) group by `produk`.`no`,`produk`.`lengkap`";
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
                <td align=right bgcolor=#ED6161><font size=2 color=#ffffff face='Trebuchet MS'><?=$jumlah?></font></td>
                <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$Ak?></font></td>
                <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$Bk?></font></td>
                <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$Ok?></font></td>
                <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$ABk?></font></td>
                <td align=right bgcolor=#ED6161><font size=2 color=#ffffff face='Trebuchet MS'><?=$jumlahk?></font></td>
            </tr>
        <?
        } elseif ($produk1[Nama]=="TC"){?>
        <tr>
            <td align=left  bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'><?=$produk1[lengkap]?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantca)?>><font color=<?=FontColor($pesantca)?> size=2 face='Trebuchet MS'><?=$A?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantcb)?>><font color=<?=FontColor($pesantcb)?> size=2 face='Trebuchet MS'><?=$B?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantco)?>><font color=<?=FontColor($pesantco)?> size=2 face='Trebuchet MS'><?=$O?></font></td>
            <td align=right bgcolor=<?=switchColor($pesantcab)?>><font color=<?=FontColor($pesantcab)?> size=2 face='Trebuchet MS'><?=$AB?></font></td>
            <td align=right bgcolor=#ED6161><font size=2 color=#ffffff face='Trebuchet MS'><?=$jumlah?></font></td>
            <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$Ak?></font></td>
            <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$Bk?></font></td>
            <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$Ok?></font></td>
            <td align=right bgcolor=white><font size=2 face='Trebuchet MS'><?=$ABk?></font></td>
            <td align=right bgcolor=#ED6161><font size=2 color=#ffffff face='Trebuchet MS'><?=$jumlahk?></font></td>
            <?

            } else {
                echo "<tr>
				<td align=left  bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'>$produk1[lengkap]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$A</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$B</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$O</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$AB</font></td>
				<td align=right bgcolor=#ED6161> <font color=#ffffff size=2 face='Trebuchet MS'>$jumlah</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$Ak</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$Bk</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$Ok</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$ABk</font></td>
                <td align=right bgcolor=#ED6161> <font size=2 color=#ffffff face='Trebuchet MS'>$jumlahk</font></td>
				</tr>";
            }
            }
            echo "<tr bgcolor=#ED6161>
		<td align=center><font size=2 color=#ffffff face='Trebuchet MS'><b>JUMLAH</b></font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_a</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_b</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_o</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_ab</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$total</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_ak</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_bk</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_ok</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_abk</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$totalk</font></td>
		</tr>";
        ?>
    </table>
</div>
<table celpadding="1">
    <tr>
        <td><font size=2  face='Trebuchet MS'>Keterangan Warna (khusus komponen <b>PRC</b> dan <b>TC</b>):</td><td style="border:solid 0px #060" width="5"></td>
        <td align="center" style="border:solid 1px #060" width="50" bgcolor=<?=switchColor(0)?>><font color=<?=FontColor(0)?> size=2  face='Trebuchet MS'>Kurang</td><td style="border:solid 0px #060" width="5"></td>
        <td align="center" style="border:solid 1px #060" width="50" bgcolor=<?=switchColor(1)?>><font color=<?=FontColor(1)?> size=2  face='Trebuchet MS'>Tipis</td><td style="border:solid 0px #060" width="5"></td>
        <td align="center" style="border:solid 1px #060" width="50" bgcolor=<?=switchColor(2)?>><font color=<?=FontColor(2)?> size=2  face='Trebuchet MS'>Aman</td><td style="border:solid 0px #060" width="5"></td>
        <td align="center" style="border:solid 1px #060" width="50" bgcolor=<?=switchColor(3)?>><font color=<?=FontColor(3)?> size=2  face='Trebuchet MS'>Over</td><td style="border:solid 0px #060" width="5"></td>
    </tr>
</table>
<?php
	$total_sehat=$total + $totalk;
?>
<hr>
<div id="content">
    <div><font size="4" color="red" face="Arial"><b>RINCIAN STOK DARAH SEHAT : </b> <?=$total_sehat?> kantong</font></div>
    <div><a href="#bawah">Ke bawah</a></div>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse">
    <thead>
    <tr bgcolor="#ED6161">
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">No</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">No Kantong</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Produk</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Gol</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Aftap</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Pengolahan</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Pemeriksaan</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Kadaluwarsa</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Release</th>
        <th align=center><font size="2" color="#ffffff" face="Trebuchet MS">Hasil Release</th>
    </tr>
    </thead>
    <tbody>
<?php
$qdetail="select
          `p`.`no` AS `no`,
          `p`.`lengkap` AS `lengkap`,
          `s`.`noKantong`,
          `s`.`jenis`,
          `s`.`produk`,
          `s`.`gol_darah`,
          `s`.`RhesusDrh`,
          `s`.`tgl_Aftap`,
          `s`.`tglpengolahan`,
          `s`.`tglperiksa`,
          `s`.`kadaluwarsa`,
          `s`.`tgl_release`,
          CASE
            WHEN `s`.`hasil_release`='0' THEN 'BELUM RELEASE'
            WHEN `s`.`hasil_release`='1' THEN 'LULUS'
            WHEN `s`.`hasil_release`='2' THEN 'TDK LULUS'
            WHEN `s`.`hasil_release`='3' THEN 'LULUS DGN CATATAN'
          END as `hasil_release`

         from (`produk` p left join `stokkantong` s on((`p`.`Nama` = `s`.`produk`)))
         where (
          ((`s`.`stat2` = '0') or isnull(`s`.`stat2`)) and (`s`.`sah` = '1')
         and (`s`.`kadaluwarsa` > curdate()) and (`s`.`statKonfirmasi` = '1')
         and (`s`.`Status` = '2'))
         order by `p`.`no`,`p`.`lengkap`, `s`.`gol_darah`, `s`.`RhesusDrh`,
          `s`.`tgl_Aftap`, `s`.`tglpengolahan`, `s`.`tglperiksa`, `s`.`kadaluwarsa`,`s`.`tgl_release`";
$stok=mysql_query($qdetail);
$no=0;

while ($dt=mysql_fetch_assoc($stok)) {
    $no++;
    ?>
            <tr  bgcolor="white">
                <td align=right><font size=2 color=black face='Trebuchet MS'> <?=$no.'.';?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['noKantong'];?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['lengkap'];?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['gol_darah']."(".$dt['RhesusDrh'].")";?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['tgl_Aftap'];?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['tglpengolahan'];?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['tglperiksa'];?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['kadaluwarsa'];?> </td>
                <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['tgl_release'];?> </td>
		<?php
		switch ($dt['hasil_release']){
			case "BELUM RELEASE"	:?> <td align=left><font size=2 color=blue  face='Trebuchet MS'> <?=$dt['hasil_release'];?> </td> <?php ;break;
			case "LULUS"		:?> <td align=left><font size=2 color=black face='Trebuchet MS'> <?=$dt['hasil_release'];?> </td> <?php ;break;
			case "TDK LULUS"	:?> <td align=left><font size=2 color=red face='Trebuchet MS'> <?=$dt['hasil_release'];?> </td> <?php ;break;
			case "LULUS DGN CATATAN";?> <td align=left><font size=2 color=yellow face='Trebuchet MS'> <?=$dt['hasil_release'];?> </td> <?php ;break;
			default : break;
		}	
		?>
                
            </tr>


    <?php
}

?>
    </tbody>
</table>
</div>

<table border=0 cellpadding=2 cellspacing=1 width="700px">
    <tr>
	<td>
		<a href="#atas">Ke Atas</a>
		<a name="bawah" id="bawah"></a>
	</td>        
	<td align="right"><font size="1" color="black" face="Trebuchet MS">(<i>Loading</i> data dalam  <?=number_format((microtime(true) - $started_at),3,",",".") ?> dtk) &reg25092018</font></td>
    </tr>
</table>
