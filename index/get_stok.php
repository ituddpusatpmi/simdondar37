<?php
function switchColor($rowValue) {
    switch ($rowValue) {
        case '0' : return 'red'; break;
        case '1' : return 'yellow'; break;
        case '2' : return 'white'; break;
        case '3' : return 'green'; break;
        default  : return 'white'; break;
    }
}

function FontColor($rowValue) {
    switch ($rowValue) {
        case '0' : return 'white'; break;
        case '1' : return 'black'; break;
        case '2' : return 'black'; break;
        case '3' : return 'white'; break;
        default  : return 'black'; break;
    }
}

function switclass ($value){
    switch($value){
        case '0' : return 'card-header-danger'; break;
        case '1' : return 'card-header-warning'; break;
        case '2' : return ''; break;
        case '3' : return 'card-header-success'; break;
        default  : return ''; break;
    }
}
include('../config/dbi_connect.php');
$started_at = microtime(true);
mysqli_query($dbi, "SET SESSION sql_mode = ''");
$udd=mysqli_fetch_assoc(mysqli_query($dbi,"select nama,alamat,id, daerah,zonawaktu from utd where aktif='1'"));
$nama_udd=$udd['nama'];
$zona_waktu=$udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$tps_ap=$ovr_ap=0;
$tps_bp=$ovr_bp=0;
$tps_op=$ovr_op=0;
$tps_abp=$ovr_abp=0;
$tps_at=$ovr_at=0;
$tps_bt=$ovr_bt=0;
$tps_ot=$ovr_ot=0;
$tps_abt=$ovr_abt=0;


$result_info=mysqli_query($dbi,"SELECT uraian, jenis, a,b,o,ab FROM stok_info where jenis='PRC'");
while ($stk_i=mysqli_fetch_assoc($result_info)){
	switch($stk_i['uraian']){
	case "TIPIS":$tps_ap=$stk_i['a'];$tps_bp=$stk_i['b'];$tps_op=$stk_i['o'];$tps_abp=$stk_i['ab'];break;
	case "AMAN" :$amn_ap=$stk_i['a'];$amn_bp=$stk_i['b'];$amn_op=$stk_i['o'];$amn_abp=$stk_i['ab'];break;
	case "OVER" :$ovr_ap=$stk_i['a'];$ovr_bp=$stk_i['b'];$ovr_op=$stk_i['o'];$ovr_abp=$stk_i['ab'];break;
	default:break;
	}
}
$result_info=mysqli_query($dbi,"SELECT uraian, jenis, a,b,o,ab FROM stok_info where jenis='TC'");
while ($stk_i=mysqli_fetch_assoc($result_info)){
	switch($stk_i['uraian']){
	case "TIPIS":$tps_at=$stk_i['a'];$tps_bt=$stk_i['b'];$tps_ot=$stk_i['o'];$tps_abt=$stk_i['ab'];break;
	case "AMAN" :$amn_at=$stk_i['a'];$amn_bt=$stk_i['b'];$amn_ot=$stk_i['o'];$amn_abt=$stk_i['ab'];break;
	case "OVER" :$ovr_at=$stk_i['a'];$ovr_bt=$stk_i['b'];$ovr_ot=$stk_i['o'];$ovr_abt=$stk_i['ab'];break;
	default:break;
	}
}
//Var Tampilan
$A=0;       $B=0;       $AB=0;      $O=0;
$jum_a=0;   $jum_b=0;   $jum_ab=0;  $jum_o=0;
$Ak=0;      $Bk=0;      $Ok=0;      $ABk=0;
$jum_ak=0;  $jum_bk=0;  $jum_abk=0; $jum_ok=0;
$tipprca  = 'PRC Golongan A:&#13 -Stok Minimal : '.$tps_ap.', &#13 -Stok Maksimal : '.$ovr_ap;
$tipprcb  = 'PRC Golongan B:&#13 -Stok Minimal : '.$tps_bp.', &#13 -Stok Maksimal : '.$ovr_bp;
$tipprco  = 'PRC Golongan O:&#13 -Stok Minimal : '.$tps_op.', &#13 -Stok Maksimal : '.$ovr_op;
$tipprcab = 'PRC Golongan AB:&#13 -Stok Minimal : '.$tps_abp.', &#13 -Stok Maksimal : '.$ovr_abp;
$tiptca  = 'TC Golongan A:&#13 -Stok Minimal : '.$tps_at.', &#13 -Stok Maksimal : '.$ovr_at;
$tiptcb  = 'TC Golongan B:&#13 -Stok Minimal : '.$tps_bt.', &#13 -Stok Maksimal : '.$ovr_bt;
$tiptco  = 'TC Golongan O:&#13 -Stok Minimal : '.$tps_ot.', &#13 -Stok Maksimal : '.$ovr_ot;
$tiptcab = 'TC Golongan AB:&#13 -Stok Minimal : '.$tps_abt.', &#13 -Stok Maksimal : '.$ovr_abt;

$today=date('Y:m:d H:i:s');
$displaystok ='
<div class="card">
    <div class="card-header card-header-danger">
        <h4 class="card-title text-center">STOK DARAH per: '.$today.'</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead<>
                <tr class="card-header-danger">
                    <th class="text-white"><div class="d-none d-sm-block">JENIS KOMPONEN</div><div class="d-block d-sm-none">JENIS</div></th>
                    <th class="text-white"><div class="d-none d-sm-block text-center">GOL A</div><div class="d-block d-sm-none text-center">A</div></th>
                    <th class="text-white"><div class="d-none d-sm-block text-center">GOL B</div><div class="d-block d-sm-none text-center">B</div></th>
                    <th class="text-white"><div class="d-none d-sm-block text-center">GOL O</div><div class="d-block d-sm-none text-center">O</div></th>
                    <th class="text-white"><div class="d-none d-sm-block text-center">GOL AB</div><div class="d-block d-sm-none text-center">AB</div></th>
                    <th class="text-white"><div class="d-none d-sm-block text-center">JUMLAH</div><div class="d-block d-sm-none text-center">JML</div></th>
                </tr>
            </thead>
            <tbody>';
                $no=0; $ja=0;$jb=0;$jo=0;$jab=0;$ttl=0;
                $qstok=mysqli_query($dbi,"SELECT *  FROM  v_stok_sehat_all");
                while($stok=mysqli_fetch_assoc($qstok)){
                    if ($stok['Nama']=='PRC'){

                        If ( $stok['sGolA']<=$tps_ap){$pesanprca='0';}
                        If (($stok['sGolA']> $tps_ap) and ($stok['sGolA']<$amn_ap)){$pesanprca='1';}
                        If (($stok['sGolA']>=$amn_ap) and ($stok['sGolA']<$ovr_ap)){$pesanprca='2';}
                        If ( $stok['sGolA']>=$ovr_ap){$pesanprca='3';}    

                        If ( $stok['sGolB']<=$tps_bp){$pesanprcb='0';}
                        If (($stok['sGolB']> $tps_bp) and ($stok['sGolB']<$amn_bp)){$pesanprcb='1';}
                        If (($stok['sGolB']>=$amn_bp) and ($stok['sGolB']<$ovr_bp)){$pesanprcb='2';}
                        If ( $stok['sGolB']>=$ovr_bp){$pesanprcb='3';}    

                        If ( $stok['sGolO']<=$tps_op){$pesanprco='0';}
                        If (($stok['sGolO']> $tps_op) and ($stok['sGolO']<$amn_op)){$pesanprco='1';}
                        If (($stok['sGolO']>=$amn_op) and ($stok['sGolO']<$ovr_op)){$pesanprco='2';}
                        If ( $stok['sGolO']>=$ovr_op){$pesanprco='3';}    

                        If ( $stok['sGolAB']<=$tps_abp){$pesanprcab='0';}
                        If (($stok['sGolAB']> $tps_abp) and ($stok['sGolAB']<$amn_abp)){$pesanprcab='1';}
                        If (($stok['sGolAB']>=$amn_abp) and ($stok['sGolAB']<$ovr_abp)){$pesanprcab='2';}
                        If ( $stok['sGolAB']>=$ovr_abp){$pesanprcab='3';}    
                    }

                    if($stok['Nama']=='TC'){
                        $pesantca='2';
                        $pesantcb='2';		
                        $pesantco='2';
                        $pesantcab='2';
                        If ( $stok['sGolA']<=$tps_at){$pesantca='0';}
                        If (($stok['sGolA']> $tps_at) and ($stok['sGolA']<$amn_at)){$pesantca='1';}
                        If (($stok['sGolA']>=$amn_at) and ($stok['sGolA']<$ovr_at)){$pesantca='2';}
                        If ( $stok['sGolA']>=$ovr_at){$pesantca='3';}    
                        
                        If ( $stok['sGolB']<=$tps_bt){$pesantcb='0';}
                        If (($stok['sGolB']> $tps_bt) and ($stok['sGolB']<$amn_bt)){$pesantcb='1';}
                        If (($stok['sGolB']>=$amn_bt) and ($stok['sGolB']<$ovr_bt)){$pesantcb='2';}
                        If ( $stok['sGolB']>=$ovr_bt){$pesantcb='3';}   
                        
                        If ( $stok['sGolO']<=$tps_ot){$pesantco='0';}
                        If (($stok['sGolO']> $tps_ot) and ($stok['sGolO']<$amn_ot)){$pesantco='1';}
                        If (($stok['sGolO']>=$amn_ot) and ($stok['sGolO']<$ovr_ot)){$pesantco='2';}
                        If ( $stok['sGolO']>=$ovr_ot){$pesantco='3';}   
                        
                        If ( $stok['sGolAB']<=$tps_abt){$pesantcab='0';}
                        If (($stok['sGolAB']> $tps_abt) and ($stok['sGolAB']<$amn_abt)){$pesantcab='1';}
                        If (($stok['sGolAB']>=$amn_abt) and ($stok['sGolAB']<$ovr_abt)){$pesantcab='2';}
                        If ( $stok['sGolAB']>=$ovr_abt){$pesantcab='3';}   
                    }
                    $a =$stok['sGolA'];if(empty($a)){$a='-';}
                    $b =$stok['sGolB'];if(empty($b)){$b='-';}
                    $o =$stok['sGolO'];if(empty($o)){$o='-';}
                    $ab=$stok['sGolAB'];if(empty($ab)){$ab='-';}
                    $j =$stok['jumlah'];if(empty($j)){$j='-';}
                    $ja=$ja+$stok['sGolA'];$jb=$jb+$stok['sGolB'];$jo=$jo+$stok['sGolO'];$jab=$jab+$stok['sGolAB'];$ttl=$ttl+$stok['jumlah'];

                    $displaystok .=
                        '<tr>
                            <td nowrap class="text-left"><div class="d-none d-sm-block">' . $stok['lengkap'] . '</div><div class="d-block d-sm-none">' . $stok['Nama'] . '</div></td>';
                        if ($stok['Nama']=='PRC'){
                    $displaystok .='
                            <td class="text-center '.switclass($pesanprca).'" title="'.$tipprca.'">'.$a.'</td>
                            <td class="text-center '.switclass($pesanprcb).'" title="'.$tipprcb.'">'.$b.'</td>
                            <td class="text-center '.switclass($pesanprco).'" title="'.$tipprco.'">'.$o.'</td>
                            <td class="text-center '.switclass($pesanprcab).'" title="'.$tipprcab.'">'.$ab.'</td>';        
                        } elseif ($stok['Nama']=="TC"){
                    $displaystok .='
                            <td class="text-center '.switclass($pesantca).'" title="'.$tiptca.'">'.$a.'</td>
                            <td class="text-center '.switclass($pesantcb).'" title="'.$tiptcb.'">'.$b.'</td>
                            <td class="text-center '.switclass($pesantco).'" title="'.$tiptco.'">'.$o.'</td>
                            <td class="text-center '.switclass($pesantcab).'" title="'.$tiptcab.'">'.$ab.'</td>';
                        } else {
                    $displaystok .='
                            <td class="text-center">'.$a.'</td>
                            <td class="text-center">'.$b.'</td>
                            <td class="text-center">'.$o.'</td>
                            <td class="text-center">'.$ab.'</td>';
                        }
                    $displaystok .='<td class="text-center" style="vertical-align: middle;">'.$j.'</td></tr>';
                }
                $displaystok .='</tbody>';
                $displaystok .='<tfoot>
                                <tr class="card-header-danger">
                                    <th class="text-light">Jumlah</th>
                                    <th class="text-center text-light" style="vertical-align: middle;">'.$ja.'</th>
                                    <th class="text-center text-light style="vertical-align: middle;">'.$jb.'</th>
                                    <th class="text-center text-light" style="vertical-align: middle;">'.$jo.'</th>
                                    <th class="text-center text-light" style="vertical-align: middle;">'.$jab.'</th>
                                    <th class="text-center text-light" style="vertical-align: middle;">'.$ttl.'</th>
                                </tr>
                            </tfoot>';
$displaystok .='</table></div>
    </div>
</div>';
echo $displaystok;
?>