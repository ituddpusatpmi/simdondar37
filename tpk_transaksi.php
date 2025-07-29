<link href="css/content2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){

//Larger thumbnail preview

$("ul.thumb li").hover(function() {
    $(this).css({'z-index' : '10'});
    $(this).find('img').addClass("hover").stop()
        .animate({
            marginTop: '-110px',
            marginLeft: '-110px',
            top: '55%',
            left: '55%',
            width: '140px',
            height: '155px',
            padding: '20px'
        }, 200);
    
    } , function() {
    $(this).css({'z-index' : '0'});
    $(this).find('img').removeClass("hover").stop()
        .animate({
            marginTop: '0',
            marginLeft: '0',
            top: '0',
            left: '0',
            width: '100px',
            height: '111px',
            padding: '5px'
        }, 400);
});

//Swap Image on Click
//    $("ul.thumb li a").click(function() {
        
//        var mainImage = $(this).attr("href"); //Find Image Name
//        $("#main_view img").attr({ src: mainImage });
//        return false;
//    });
 
});
</script>
</head>

<?php
    $level = $_SESSION['leveluser'];?>
<div class="container">
<ul class="thumb">
    <li><a href="pmi<?php echo $level;?>.php?module=hasilsampel"><img src="images/hasilsampel.png" alt="" /></a></li>
    <li><a href="pmi<?php echo $level;?>.php?module=sampellulus"><img src="images/sampellolos.png" alt="" /></a></li>
    <li><a href="pmi<?php echo $level;?>.php?module=sampelgagal"><img src="images/sampelgagal.png" alt="" /></a></li>
    <li><a href="pmi<?php echo $level;?>.php?module=ceksampeldds"><img src="images/cek_sampeldds.png" alt="" /></a></li>
    <li><a href="pmi<?php echo $level;?>.php?module=jadwalsampel"><img src="images/jadwalaph.png" alt="" /></a></li>
    

</ul>
</div>

