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
date_default_timezone_set("Asia/Makassar");
include('config/db_connect.php');
$date = date('d-m-Y H:i:s', time());
$result_info=mysql_query("SELECT uraian, jenis, a,b,o,ab FROM stok_info where jenis='PRC'");
while ($stk_i=mysql_fetch_assoc($result_info)){
	switch($stk_i['uraian']){
	case "TIPIS":$tps_ap=$stk_i['a'];$tps_bp=$stk_i['b'];$tps_op=$stk_i['o'];$tps_abp=$stk_i['ab'];break;
	case "AMAN" :$amn_ap=$stk_i['a'];$amn_bp=$stk_i['b'];$amn_op=$stk_i['o'];$amn_abp=$stk_i['ab'];break;
	case "OVER" :$ovr_ap=$stk_i['a'];$ovr_bp=$stk_i['b'];$ovr_op=$stk_i['o'];$ovr_abp=$stk_i['ab'];break;
	default:break;
	}
}
$result_info=mysql_query("SELECT uraian, jenis, a,b,o,ab FROM stok_info where jenis='TC'");
while ($stk_i=mysql_fetch_assoc($result_info)){
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
?>
<div class="container">
	<div class="row">	
		<div class="col-lg-12">	
			<h3 class="text-nowrap"><strong>Update: <?= $date ?></strong></h3>
		</div>
	</div>
	<div class="row">
	   <div class="col-12">
			<table class="table table-striped table-hover table-bordered table-condensed" id="shadow1">
				<thead style="background-color:#32CD32;color:white;">
					<tr>
	                   	<th class="text-center" colspan="6" style="vertical-align: middle;font-size:18px;text-shadow:1px 1px gray;"><a href=modul/release.php><font color="white">DARAH RELEASE</a></font></th>
					</tr>
                   	<tr>
                       	<th class="text-center" rowspan="2" style="vertical-align: middle;">KOMPONEN<BR>DARAH</th>
                        <th class="text-center" colspan="4" style="vertical-align: middle;">GOL. DARAH</th>
			    		<th class="text-center" rowspan="2" style="vertical-align: middle;">JML</th>
					</tr>
					<tr>
                       	<th class="text-center" style="vertical-align: middle;">A</th>
                        <th class="text-center" style="vertical-align: middle;">B</th>
                        <th class="text-center" style="vertical-align: middle;">O</th>
                        <th class="text-center" style="vertical-align: middle;">AB</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=0; $ja=0;$jb=0;$jo=0;$jab=0;$ttl=0;
					$stk=mysql_query("select * from v_stok_release_all");
					while($stok=mysql_fetch_assoc($stk)) {
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
						$a=$stok['sGolA'];if(empty($a)){$a='-';}
						$b=$stok['sGolB'];if(empty($b)){$b='-';}
						$o=$stok['sGolO'];if(empty($o)){$o='-';}
						$ab=$stok['sGolAB'];if(empty($ab)){$ab='-';}
						$j=$stok['jumlah'];if(empty($j)){$j='-';}
						$ja=$ja+$stok['sGolA'];$jb=$jb+$stok['sGolB'];$jo=$jo+$stok['sGolO'];$jab=$jab+$stok['sGolAB'];$ttl=$ttl+$stok['jumlah'];
						?>
						<tr>
							<td class="text-left"  nowrap  style="vertical-align: middle;"><?php echo $stok['Nama'];?></td>
							<?php 
							if ($stok['Nama']=='PRC'){ ?>
								<td class="text-center" title="<?php echo $tipprca;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesanprca);?>; color: <?php echo FontColor($pesanprca);?>"><?php echo $a;?></td>
								<td class="text-center" title="<?php echo $tipprcb;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesanprcb);?>; color: <?php echo FontColor($pesanprcb);?>"><?php echo $b;?></td>
								<td class="text-center" title="<?php echo $tipprco;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesanprco);?>; color: <?php echo FontColor($pesanprco);?>"><?php echo $o;?></td>
								<td class="text-center" title="<?php echo $tipprcab;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesanprcab);?>; color: <?php echo FontColor($pesanprcab);?>"><?php echo $ab;?></td>
							<?php } elseif ($stok['Nama']=="TC"){ ?>
								<td class="text-center" title="<?php echo $tiptca;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesantca);?>; color: <?php echo FontColor($pesantca);?>"><?php echo $a;?></td>
								<td class="text-center" title="<?php echo $tiptcb;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesantcb);?>; color: <?php echo FontColor($pesantcb);?>"><?php echo $b;?></td>
								<td class="text-center" title="<?php echo $tiptco;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesantco);?>; color: <?php echo FontColor($pesantco);?>"><?php echo $o;?></td>
								<td class="text-center" title="<?php echo $tiptcab;?>" style="vertical-align: middle; background-color:<?php echo switchColor($pesantcab);?>; color: <?php echo FontColor($pesantcab);?>"><?php echo $ab;?></td>
							 <?php } else { ?>
								<td class="text-center" style="vertical-align: middle; "><?php echo $a;?></td>
								<td class="text-center" style="vertical-align: middle; "><?php echo $b;?></td>
								<td class="text-center" style="vertical-align: middle; "><?php echo $o;?></td>
								<td class="text-center" style="vertical-align: middle; "><?php echo $ab;?></td>
							<?php } ?>
							<td class="text-center" style="vertical-align: middle;"><?php echo $j;?></td>				
						</tr>
						<?php
					}
					?>
				</tbody>
				<tfoot style="background-color:#32CD32;color:white;">
					<tr>
						<th>Jumlah</th>
						<td class="text-center" style="vertical-align: middle;"><?php echo $ja;?></td>
						<td class="text-center" style="vertical-align: middle;"><?php echo $jb;?></td>
						<td class="text-center" style="vertical-align: middle;"><?php echo $jo;?></td>
						<td class="text-center" style="vertical-align: middle;"><?php echo $jab;?></td>
						<td class="text-center" style="vertical-align: middle;"><?php echo $ttl;?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>	
</div>

