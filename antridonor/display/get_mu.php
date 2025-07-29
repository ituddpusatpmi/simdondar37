<?php
include ('db.php');
include ('config.php');
$mu_max_row = $mu_row_maxrows;
$awal = $_GET['baris'];
if(empty($awal)){$awal=0;}
$count=mysqli_fetch_array(mysqli_query($dbi,"select count(*) as total from v_mu_seminggu"));
$jmldata = $count['total'];
$qm="select * from v_mu_seminggu limit ".$awal.", ".$mu_max_row;
$qmu=mysqli_query($dbi,$qm);
$display='';
$display .='
    <table style="width:100%;border-collapse: collapse;">
          <tr style="height:'.$mu_thead_padding.'px;font-size:'.$mu_thead_fontsize.'px;">
            <th style="border:0.5px solid '.$mu_thead_fontcolor.';background-color:'.$mu_thead_backcolor.';color :'.$mu_thead_fontcolor.';width:40px;">NO</th>
            <th style="border:0.5px solid '.$mu_thead_fontcolor.';background-color:'.$mu_thead_backcolor.';color :'.$mu_thead_fontcolor.';width:60px;">HARI/TGL</th>
            <th style="border:0.5px solid '.$mu_thead_fontcolor.';background-color:'.$mu_thead_backcolor.';color :'.$mu_thead_fontcolor.';width:40px;">JAM</th>
            <th style="border:0.5px solid '.$mu_thead_fontcolor.';background-color:'.$mu_thead_backcolor.';color :'.$mu_thead_fontcolor.';">TEMPAT</th>
            <th style="border:0.5px solid '.$mu_thead_fontcolor.';background-color:'.$mu_thead_backcolor.';color :'.$mu_thead_fontcolor.';width:50px;">JML</th>
          </tr>
';
$no=$awal+1;
$datenow=date('Y-m-d');
$end_row=0;
/*while($mu=mysqli_fetch_assoc($qmu)){
    if ($datenow==$mu['TglPenjadwalan']){
        $display .=
        '
            <tr style="height:'.$mu_row_height.'px;background-color:'.$mu_row_backhightlight.';font-size:'.$mu_row_fontsize.'px;color:'.$mu_row_fonthightlight.';">
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;padding:'.$mu_row_padding.'px;">'.$no.'.</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.';px">'.$mu['tanggal'].'</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu['jam'].'</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';padding:'.$mu_row_padding.'px;">'.$mu['nama'].'</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu['jumlah'].'</td>
            </tr>
        ';
    }else{
        $display .=
        '
            <tr style="height:'.$mu_row_height.'px;font-size:'.$mu_row_fontsize.'px;color:'.$mu_row_fontcolor.';">
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;padding:'.$mu_row_padding.'px;">'.$no.'.</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.';px">'.$mu['tanggal'].'</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu['jam'].'</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';padding:'.$mu_row_padding.'px;">'.$mu['nama'].'</td>
                <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu['jumlah'].'</td>
            </tr>
        ';
    }
    $no++;$end_row++;
}*/

if ($end_row<$mu_max_row){
    $end_row=$mu_max_row-$end_row;
    $qm2="select * from v_mu_seminggu limit 0 ,".$end_row;
    $qmu2=mysqli_query($dbi,$qm2);
    $no2=1;
    while($mu2=mysqli_fetch_assoc($qmu2)){
        if ($datenow==$mu2['TglPenjadwalan']){
            $display .=
            '
                <tr style="height:'.$mu_row_height.'px;background-color:'.$mu_row_backhightlight.';font-size:'.$mu_row_fontsize.'px;color:'.$mu_row_fonthightlight.';">
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;padding:'.$mu_row_padding.'px;">'.$no2.'.</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.';px">'.$mu2['hari'].', '.$mu2['tanggal'].'</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu2['jam'].'</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';padding:'.$mu_row_padding.'px;">'.$mu2['nama'].'</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu2['jumlah'].'</td>
                </tr>
            ';
        }else{
            $display .=
            '
                <tr style="height:'.$mu_row_height.'px;font-size:'.$mu_row_fontsize.'px;color:'.$mu_row_fontcolor.';">
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;padding:'.$mu_row_padding.'px;">'.$no2.'.</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.';px">'.$mu2['hari'].', '.$mu2['tanggal'].'</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:center;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu2['jam'].'</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';padding:'.$mu_row_padding.'px;">'.$mu2['nama'].'</td>
                    <td style="border:0.5px solid '.$mu_row_linecolor.';text-align:right;white-space: nowrap;padding:'.$mu_row_padding.'px;">'.$mu2['jumlah'].'</td>
                </tr>
            ';
        }
        $no2++;;
    }
}
$awal=$awal+1;
if ($awal>$jmldata){$awal=0;}
$display .='</table>';
$display .='<input type="hidden" id="nomor" name="nomor" value="'.$awal.'">';
echo $display;
?>
