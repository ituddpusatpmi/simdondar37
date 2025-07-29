<?php
//parameter
$mu_pad_th=40;
$mu_pad_td=10;
$mu_height_td=40;
$mu_font_th=30;
$mu_font_td=16;
$mu_max_row=7;
$back_th='#ffffff';
$color_th='#ff0000';
$color_td='#ffffff';
$back_td='#ffe6e6';
$line_color='#ffcccc';
$color_today='#e6ffe6';
$tglskr=date('d-m-y');

include ('db.php');
$qm="select * from v_mu";
$qmu=mysqli_query($dbi,$qm);
$display ='
    <table style="width:100%;border-collapse: collapse;">
    <thead>
          <tr style="height:'.$mu_pad_th.'px;">
            <th style="border:0.5px solid '.$color_th.';background-color:'.$back_th.';color :'.$color_th.';">No</th>
            <th style="border:0.5px solid '.$color_th.';background-color:'.$back_th.';color :'.$color_th.';">TGL</th>
            <th style="border:0.5px solid '.$color_th.';background-color:'.$back_th.';color :'.$color_th.';">JAM</th>
            <th style="border:0.5px solid '.$color_th.';background-color:'.$back_th.';color :'.$color_th.';">TEMPAT</th>
            <th style="border:0.5px solid '.$color_th.';background-color:'.$back_th.';color :'.$color_th.';">JML</th>
          </tr>
    </thead>
    <tbody>
';
$no=$awal+1;
$baris2=0;
while($mu=mysqli_fetch_assoc($qmu)){
    $tglmu=$mu['tanggal'];
    $display .=
    '
        <tr style="height:'.$mu_height_td.'px;background:red;">
            <td style="border:0.5px solid '.$line_color.';padding:'.$mu_pad_td.'px;">'.$no.'.</td>
            <td style="border:0.5px solid '.$line_color.';text-align:center;white-space: nowrap;padding:'.$mu_pad_td.';px">'.$mu['tanggal'].'</td>
            <td style="border:0.5px solid '.$line_color.';text-align:center;white-space: nowrap;padding:'.$mu_pad_td.'px;">'.$mu['jam'].'</td>
            <td style="border:0.5px solid '.$line_color.';padding:'.$mu_pad_td.'px;">'.$mu['nama'].'</td>
            <td style="border:0.5px solid '.$line_color.';text-align:right;white-space: nowrap;padding:'.$mu_pad_td.'px;">'.$mu['jumlah'].'</td>
        </tr>
    ';
    $no++;
}
$display .='</tbody></table>';
echo $display;
?>

<script>
jQuery.fn.extend({
	        pic_scroll:function (){
	            $(this).each(function(){
	                var _this=$(this);
	                var ul=_this.find("table");
	                var li=ul.find("tbody");
	                var w=li.size()*li.outerHeight();
	                li.clone().prependTo(ul);
	                var i=1,l;
	                _this.hover(function(){i=0},function(){i=1});
	                function autoScroll(){
	                	l = _this.scrollTop();
	                	if(l>=w){
	                		_this.scrollTop(0);
	                	}else{
	                		_this.scrollTop(l + i);
	                	}
	                }
	                var scrolling = setInterval(autoScroll,150);
	            })
	        }
	    });
		$(function(){
			$(".container_mu").pic_scroll();
		})
</script>