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
$date = date('d-m-Y H:i:s', time());
//KEBUTUHAN STOK
//PRC
$prca=21;   $prcb=33;   $prco=48;   $prcab=6;
//TC
$tca=3;     $tcb=3;    $tco=3;    $tcab=1;
//Var Tampilan
$A=0;       $B=0;       $AB=0;      $O=0;
$jum_a=0;   $jum_b=0;   $jum_ab=0;  $jum_o=0;
$Ak=0;      $Bk=0;      $Ok=0;      $ABk=0;
$jum_ak=0;  $jum_bk=0;  $jum_abk=0; $jum_ok=0;


?>
<table border=0 cellpadding=2 cellspacing=1 width="700px">
    <tr>
        <td><font size="4" color="red" face="Arial"><b>INFO <?=$utd[nama]?></b></font></td>
        <td align="right"><font size="3" color="black" face="Trebuchet MS"><?=$date?> WIB</font></td>
    </tr>
</table>
<div id="content">
    <table border=1 cellpadding=1 cellspacing=1 width="700px">
        <tr bgcolor="#ED6161">
            <td align=center colspan="11"><font size="3" color="white" face="Trebuchet MS"><b>STOK DARAH SAAT INI</b></font></td>
        </tr>
        <tr bgcolor="#ED6161">
            <td width="200px" align=center rowspan="2"><font size="2" color="#ffffff" face="Trebuchet MS"><b>KOMPONEN DARAH</b></font></td>
            <td align=center colspan="5"><font size="2" color="#ffffff" face="Trebuchet MS"><b>STOK SEHAT</b></font></td>
            <td align=center colspan="5"><font size="2" color="#ffffff" face="Trebuchet MS"><b>STOK KARANTINA</b></font></td>
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
        <!--td align="center" style="border:solid 1px #060" width="50" bgcolor=<?=switchColor(3)?>><font color=<?=FontColor(3)?> size=2  face='Trebuchet MS'>Over</td><td style="border:solid 0px #060" width="5"></td-->
    </tr>
</table>
<?php
//DATA DROPPING HARI INI
$qdrop="SELECT kirimbdrs.bdrs,bdrs.nama,
		sum((case when (`stokkantong`.`gol_darah` = 'A' and kirimbdrs.status='0')  then 1 else 0 end)) AS `DA`,
		sum((case when (`stokkantong`.`gol_darah` = 'B' and kirimbdrs.status='0')  then 1 else 0 end)) AS `DB`,
		sum((case when (`stokkantong`.`gol_darah` = 'O' and kirimbdrs.status='0')  then 1 else 0 end)) AS `DO`,
		sum((case when (`stokkantong`.`gol_darah` = 'AB' and kirimbdrs.status='0')  then 1 else 0 end)) AS `DAB`,
		sum((case when (`stokkantong`.`gol_darah` = 'A' and kirimbdrs.status='1')  then 1 else 0 end)) AS `KA`,
		sum((case when (`stokkantong`.`gol_darah` = 'B' and kirimbdrs.status='1')  then 1 else 0 end)) AS `KB`,
		sum((case when (`stokkantong`.`gol_darah` = 'O' and kirimbdrs.status='1')  then 1 else 0 end)) AS `KO`,
		sum((case when (`stokkantong`.`gol_darah` = 'AB' and kirimbdrs.status='1')  then 1 else 0 end)) AS `KAB`,
		count(kirimbdrs.nokantong) as jumlah
		FROM `kirimbdrs` inner join bdrs on bdrs.kode=kirimbdrs.bdrs  inner join stokkantong on stokkantong.nokantong=kirimbdrs.nokantong
		where  date(kirimbdrs.`tgl`)=current_date()
		group by kirimbdrs.bdrs, bdrs.nama";
$qutd="SELECT kirimudd.udd,utd.nama,
		sum((case when (`stokkantong`.`gol_darah` = 'A' and kirimudd.status='0')  then 1 else 0 end)) AS `DA`,
		sum((case when (`stokkantong`.`gol_darah` = 'B' and kirimudd.status='0')  then 1 else 0 end)) AS `DB`,
		sum((case when (`stokkantong`.`gol_darah` = 'O' and kirimudd.status='0')  then 1 else 0 end)) AS `DO`,
		sum((case when (`stokkantong`.`gol_darah` = 'AB' and kirimudd.status='0')  then 1 else 0 end)) AS `DAB`,
		sum((case when (`stokkantong`.`gol_darah` = 'A' and kirimudd.status='1')  then 1 else 0 end)) AS `KA`,
		sum((case when (`stokkantong`.`gol_darah` = 'B' and kirimudd.status='1')  then 1 else 0 end)) AS `KB`,
		sum((case when (`stokkantong`.`gol_darah` = 'O' and kirimudd.status='1')  then 1 else 0 end)) AS `KO`,
		sum((case when (`stokkantong`.`gol_darah` = 'AB' and kirimudd.status='1')  then 1 else 0 end)) AS `KAB`,
		count(kirimudd.nokantong) as jumlah
		FROM `kirimudd` inner join utd on utd.id=kirimudd.udd inner join stokkantong on stokkantong.nokantong=kirimudd.nokantong
		where  date(kirimudd.`tgl`)=date(current_date())
		group by kirimudd.udd, utd.nama";
?>
<table border=1 cellpadding=1 cellspacing=1 width=700px>
    <tr bgcolor="#ED6161">
        <td align=center colspan="11"><font size="3" color="white" face="Trebuchet MS"><b><i>DROPPING</i> DARAH HARI INI</b></font></td>
    </tr>
	<tr bgcolor=#ED6161>
        <td align=center rowspan="2" nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>BDRS/UTD PMI</b></font></td>
        <td align=center colspan="5" nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>PENGIRIMAN</b></font></td>
        <td align=center colspan="5" nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>KEMBALI</b></font></td>
    </tr>
    <tr bgcolor=#ED6161>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
        <td align=center nowrap><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</b></font></td>
    </tr>
    <?
    $d_jml=0;  $k_jml=0;
    $d_tot=0;  $k_tot=0;
    $d_jmlA=0; $d_jmlB=0;  $d_jmlO=0;  $d_jmlAB=0;
    $k_jmlA=0; $k_jmlB=0;  $k_jmlO=0;  $k_jmlAB=0;
    $sql=mysql_query($qdrop);
    while($data=mysql_fetch_assoc($sql)){
        $d_jml=0;
        $k_jml=0;

        $d_jmlA=$d_jmlA+$data['DA'];    $d_jmlB=$d_jmlB+$data['DB'];    $d_jmlO=$d_jmlO+$data['DO'];    $d_jmlAB=$d_jmlAB+$data['DAB'];
        $k_jmlA=$k_jmlA+$data['KA'];    $k_jmlB=$k_jmlB+$data['KB'];    $k_jmlO=$k_jmlO+$data['KO'];    $k_jmlAB=$k_jmlAB+$data['KAB'];

        $d_jml=$data['DA']+$data['DB']+$data['DO']+$data['DAB'];
        $k_jml=$data['KA']+$data['KB']+$data['KO']+$data['KAB'];

        $d_tot=$d_tot+$d_jml;
        $k_tot=$k_tot+$k_jml;

        echo "<tr>
				<td align=left  bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'>$data[nama]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DA]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DB]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DO]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DAB]</font></td>
				<td align=right bgcolor=#ED6161> <font color=#ffffff size=2 face='Trebuchet MS'>$d_jml</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KA]</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KB]</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KO]</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KAB]</font></td>
                <td align=right bgcolor=#ED6161> <font size=2 color=#ffffff face='Trebuchet MS'>$k_jml</font></td>
				</tr>";

    };
    $sql=mysql_query($qutd);
    while($data=mysql_fetch_assoc($sql)){
        $d_jml=0;
        $k_jml=0;

        $d_jmlA=$d_jmlA+$data['DA'];    $d_jmlB=$d_jmlB+$data['DB'];    $d_jmlO=$d_jmlO+$data['DO'];    $d_jmlAB=$d_jmlAB+$data['DAB'];
        $k_jmlA=$k_jmlA+$data['KA'];    $k_jmlB=$k_jmlB+$data['KB'];    $k_jmlO=$k_jmlO+$data['KO'];    $k_jmlAB=$k_jmlAB+$data['KAB'];

        $d_jml=$data['DA']+$data['DB']+$data['DO']+$data['DAB'];
        $k_jml=$data['KA']+$data['KB']+$data['KO']+$data['KAB'];
        $d_tot=$d_tot+$d_jml;
        $k_tot=$k_tot+$k_jml;
        echo "<tr>
				<td align=left  bgcolor=#FCC5C5> <font size=2 face='Trebuchet MS'>$data[nama]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DA]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DB]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DO]</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[DAB]</font></td>
				<td align=right bgcolor=#ED6161> <font color=#ffffff size=2 face='Trebuchet MS'>$d_jml</font></td>
				<td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KA]</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KB]</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KO]</font></td>
                <td align=right bgcolor=white> <font size=2 face='Trebuchet MS'>$data[KAB]</font></td>
                <td align=right bgcolor=#ED6161> <font size=2 color=#ffffff face='Trebuchet MS'>$k_jml</font></td>
				</tr>";
    }
    echo "<tr bgcolor=#ED6161>
		<td align=center><font size=2 color=#ffffff face='Trebuchet MS'><b>JUMLAH</b></font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$d_jmlA</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$d_jmlB</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$d_jmlO</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$d_jmlAB</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$d_tot</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$k_jmlA</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$k_jmlB</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$k_jmlO</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$k_jmlAB</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$k_tot</font></td>

		</tr>";
    ?>
</table>
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
$sql_mu="select instansi,
        COUNT(case when JenisDonor='0' THEN 1 END) As Sukarela,
        COUNT(case when JenisDonor='1' THEN 1 END) As Pengganti,
        COUNT(case when donorbaru='0' THEN 1 END) As baru,
        COUNT(case when donorbaru='1' THEN 1 END) As ulang,
        COUNT(case when Pengambilan='-' THEN 1 END) As Antri,
        COUNT(case when Pengambilan='0' THEN 1 END) As Berhasil,
        COUNT(case when Pengambilan='1' THEN 1 END) As Batal,
		COUNT(case when Pengambilan='2' THEN 1 END) As Gagal,
		COUNT(case when caraAmbil='0' THEN 1 END) As Biasa,
		COUNT(case when caraAmbil >'0' THEN 1 END) As Apheresis,
		COUNT(case when gol_darah='A' THEN 1 END) As A,
		COUNT(case when gol_darah='B' THEN 1 END) As B,
		COUNT(case when gol_darah='AB' THEN 1 END) As AB,
		COUNT(case when gol_darah='O' THEN 1 END) As O,
		COUNT(case when gol_darah='X' THEN 1 END) As X,
		COUNT(NoTrans) AS Jumlah from htransaksi
		where date(`Tgl`)=current_date and instansi='$instansi'
		group by date(Tgl), instansi";
$sq0="SELECT kegiatan.NoTrans,
	date(kegiatan.TglPenjadwalan) as tglasli,
	date_format(kegiatan.TglPenjadwalan,'%w') as hari,
    date_format(kegiatan.TglPenjadwalan,'%d-%m-%y') as tanggal,
    date_format(kegiatan.TglPenjadwalan,'%H:%i') as jam,
    kegiatan.jumlah as jumlah, kegiatan.lat as lat,
    kegiatan.lng as lng, detailinstansi.nama as nama, detailinstansi.alamat as alamat,
    kegiatan.Status, kegiatan.sukses, kegiatan.batal, kegiatan.gagal
    from kegiatan inner join detailinstansi on detailinstansi.KodeDetail=kegiatan.kodeinstansi
    where cast(kegiatan.TglPenjadwalan as date) = current_date
    ORDER BY kegiatan.TglPenjadwalan ASC";


?>
<br>
<table border=1cellpadding=2 cellspacing=1 width=700px>
    <tr bgcolor=#ED6161>
        <td colspan="17" align="center"><font size="3" color="#ffffff" face="Trebuchet MS"><b>DONASI DALAM GEDUNG & MOBILE UNIT</td>
    </tr>
    <tr bgcolor=#ED6161>
        <td rowspan="2" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>TEMPAT DONOR</td>
        <td rowspan="2" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>TAR<br>GET</td>
        <td colspan="4" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>PENDONOR</td>
        <td colspan="3" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>PENGAMBILAN</td>
        <td colspan="2" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>JENIS</td>
        <td colspan="5" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>GOLONGAN</td>
        <td rowspan="2" align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>JML</td>
    </tr>
    <tr bgcolor=#ED6161>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>DS</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>DP</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>BARU</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>ULANG</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>SUKSES</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>GAGAL</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>BATAL</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>BIASA</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>APH</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</td>
        <td align="center"><font size="2" color="#ffffff" face="Trebuchet MS"><b>X</td>
    </tr>
    <?
    //dalam gedung
    $instansi='';
    $tempatdonor="";
    $sql=mysql_query($sql_mu);
    while($data=mysql_fetch_assoc($sql)){
        if ($data[instansi]==""){$tempatdonor='Datang ke UTD';}else{$tempatdonor=$data[instansi];}
        $tot_ds=$tot_ds + $data[Sukarela];
        $tot_dp=$tot_dp + $data[Pengganti];
        $tot_baru=$tot_baru + $data[baru];
        $tot_ulang=$tot_ulang + $data[ulang];
        $tot_berhasil=$tot_berhasil + $data[Berhasil];
        $tot_gagal=$tot_gagal + $data[Gagal];
        $tot_biasa=$tot_biasa + $data[Biasa];
        $tot_batal=$tot_batal + $data[Batal];
        $tot_aph=$tot_aph + $data[Apheresis];
        $tot_a=$tot_a + $data[A];
        $tot_b=$tot_b + $data[B];
        $tot_ab=$tot_ab + $data[AB];
        $tot_o=$tot_o + $data[O];
        $tot_x=$tot_x + $data[X];
        $tot_ttl=$tot_ttl + $data[Jumlah];
        echo "
        <tr>
			<td align=left  bgcolor=#FCC5C5><font size=2 color=black face='Trebuchet MS'>$tempatdonor</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$target</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Sukarela]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Pengganti]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[baru]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[ulang]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Berhasil]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Gagal]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Batal]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Biasa]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Apheresis]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[A]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[B]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[O]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[AB]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[X]</td>
			<td align=right bgcolor=#ED6161><font size=2 color=white face='Trebuchet MS'><b>$data[Jumlah]</td>
        </tr>
        ";
    }
    //Mobile Unit
    $sqmu=mysql_query($sq0);
    while($donormu=mysql_fetch_assoc($sqmu)){
        $instansi=$donormu['nama'];
        $target=$donormu['jumlah'];
        $sql_mu="select instansi,
        COUNT(case when JenisDonor='0' THEN 1 END) As Sukarela,
        COUNT(case when JenisDonor='1' THEN 1 END) As Pengganti,
        COUNT(case when donorbaru='0' THEN 1 END) As baru,
        COUNT(case when donorbaru='1' THEN 1 END) As ulang,
        COUNT(case when Pengambilan='-' THEN 1 END) As Antri,
        COUNT(case when Pengambilan='0' THEN 1 END) As Berhasil,
        COUNT(case when Pengambilan='1' THEN 1 END) As Batal,
		COUNT(case when Pengambilan='2' THEN 1 END) As Gagal,
		COUNT(case when caraAmbil='0' THEN 1 END) As Biasa,
		COUNT(case when caraAmbil >'0' THEN 1 END) As Apheresis,
		COUNT(case when gol_darah='A' THEN 1 END) As A,
		COUNT(case when gol_darah='B' THEN 1 END) As B,
		COUNT(case when gol_darah='AB' THEN 1 END) As AB,
		COUNT(case when gol_darah='O' THEN 1 END) As O,
		COUNT(case when gol_darah='X' THEN 1 END) As X,
		COUNT(NoTrans) AS Jumlah from htransaksi
		where date(`Tgl`)=current_date and instansi='$instansi'
		group by date(Tgl), instansi";
        $tempatdonor="";
        $sql=mysql_query($sql_mu);
        while($data=mysql_fetch_assoc($sql)){
            if ($data[instansi]==""){$tempatdonor='DALAM GEDUNG';}else{$tempatdonor=$data[instansi];}
            $tot_ds=$tot_ds + $data[Sukarela];
            $tot_dp=$tot_dp + $data[Pengganti];
            $tot_baru=$tot_baru + $data[baru];
            $tot_ulang=$tot_ulang + $data[ulang];
            $tot_berhasil=$tot_berhasil + $data[Berhasil];
            $tot_gagal=$tot_gagal + $data[Gagal];
            $tot_biasa=$tot_biasa + $data[Biasa];
            $tot_batal=$tot_batal + $data[Batal];
            $tot_aph=$tot_aph + $data[Apheresis];
            $tot_a=$tot_a + $data[A];
            $tot_b=$tot_b + $data[B];
            $tot_ab=$tot_ab + $data[AB];
            $tot_o=$tot_o + $data[O];
            $tot_x=$tot_x + $data[X];
            $tot_ttl=$tot_ttl + $data[Jumlah];
            echo "
        <tr>
			<td align=left  bgcolor=#FCC5C5><font size=2 color=black face='Trebuchet MS'>$tempatdonor</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$target</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Sukarela]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Pengganti]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[baru]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[ulang]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Berhasil]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Gagal]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Batal]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Biasa]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[Apheresis]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[A]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[B]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[O]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[AB]</td>
			<td align=right bgcolor=white><font size=2 color=black face='Trebuchet MS'>$data[X]</td>
			<td align=right bgcolor=#ED6161><font size=2 color=white face='Trebuchet MS'><b>$data[Jumlah]</td>
        </tr>
        ";
        }
    }
    ?>
    <tr bgcolor=#ED6161>
        <td align="center" colspan=2><font size="2" color="#ffffff" face="Trebuchet MS"><b>JUMLAH</td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_ds?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_dp?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_baru?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_ulang?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_berhasil?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_gagal?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_batal?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_biasa?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_aph?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_a?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_b?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_o?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_ab?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_x?></td>
        <td align="right" class=input><font size="2" color="#ffffff" face="Trebuchet MS"><b><?=$tot_ttl?></td>
    </tr>
</table>
<table border=0 cellpadding=2 cellspacing=1 width="700px">
    <tr>
        <td><font size="1" color="black" face="Trebuchet MS">Data real time dari Sistem Informasi <?=$utd[nama]?></font></td>
        <td align="right"><font size="1" color="black" face="Trebuchet MS">(<i>Loading</i> data dalam  <?=number_format((microtime(true) - $started_at),3,",",".") ?> dtk) &reg10022018</font></td>
    </tr>
</table>



