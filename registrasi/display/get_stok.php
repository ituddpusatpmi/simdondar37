<?php
include ('db.php');
include ('config.php');
error_reporting (E_ALL ^ E_NOTICE);
$waktu=date("d-m-Y H:i");
$fontheader=18;
$fonttd=16;
$fonttitle=24;

$padheader=5;
$padtd=5;

$qstok=mysqli_query($dbi,"SELECT *  FROM  `v_stok_release` ");
$displaystok='';
$displaystok .='<div style="background-color:none;padding:'.$stok_title_padding.'px;width:99%;text-align:center;color:'.$stok_title_fontcolor.';font-family:Arial;font-size:'.$stok_title_fontsize.'px;font-weight:bold;text-shadow: 3px 3px 5px #000000;">STOK DARAH <small>@'.$waktu.'</small></div>
    <table style="border-spacing: 1px;border-collapse: collapse;width:100%;font-size:'.$stok_thead_fontsize.'px;">
            <tr>
            <th style="border:0.5px solid white;background-color : '.$stok_thead_backcolor.';color : '.$stok_thead_fontcolor.';padding:'.$stok_thead_padding.'px;font-family:Arial;">Produk</th>
            <th style="border:0.5px solid white;background-color : '.$stok_thead_backcolor.';color : '.$stok_thead_fontcolor.';padding:'.$stok_thead_padding.'px;font-family:Arial;">A</th>
            <th style="border:0.5px solid white;background-color : '.$stok_thead_backcolor.';color : '.$stok_thead_fontcolor.';padding:'.$stok_thead_padding.'px;font-family:Arial;">B</th>
            <th style="border:0.5px solid white;background-color : '.$stok_thead_backcolor.';color : '.$stok_thead_fontcolor.';padding:'.$stok_thead_padding.'px;font-family:Arial;">O</th>
            <th style="border:0.5px solid white;background-color : '.$stok_thead_backcolor.';color : '.$stok_thead_fontcolor.';padding:'.$stok_thead_padding.'px;font-family:Arial;">AB</th>
            <th style="border:0.5px solid white;background-color : '.$stok_thead_backcolor.';color : '.$stok_thead_fontcolor.';padding:'.$stok_thead_padding.'px;font-family:Arial;">JML</th>
          </tr>
';
while($stok=mysqli_fetch_assoc($qstok)){
    $displaystok .=
    '
        <tr style="font-family:Arial;color:'.$stok_row_fontcolor.';font-size:'.$stok_row_fontsize.'px;background-color:white;'.$stok_row_backcolor.':">
            <td style="border:0.5px solid #C0C0C0;padding: '.$stok_row_padding.'px;text-align:left;white-space: nowrap;">'.$stok['lengkap'].'</td>
            <td style="border:0.5px solid #C0C0C0;padding: '.$stok_row_padding.'px;text-align:center;white-space: nowrap;">'.$stok['sGOLA'].'</td>
            <td style="border:0.5px solid #C0C0C0;padding: '.$stok_row_padding.'px;text-align:center;white-space: nowrap;">'.$stok['sGOLB'].'</td>
            <td style="border:0.5px solid #C0C0C0;padding: '.$stok_row_padding.'px;text-align:center;white-space: nowrap;">'.$stok['sGOLO'].'</td>
            <td style="border:0.5px solid #C0C0C0;padding: '.$stok_row_padding.'px;text-align:center;white-space: nowrap;">'.$stok['sGOLAB'].'</td>
            <td style="border:0.5px solid #C0C0C0;padding: '.$stok_row_padding.'px;text-align:center;white-space: nowrap;">'.$stok['jumlah'].'</td>
        </tr>
    ';
    $no++;
}
$displaystok .='</table>';
echo $displaystok;
?>
