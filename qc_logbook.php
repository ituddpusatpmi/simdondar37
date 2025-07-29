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

//dihilangkan dari menu logistik1
//<li><a href="pmilogistik.php?module=reagen"><img src="images/entry_reagen.png" alt=""/></a></li> karena sudah ada transaksi koreksi stok
});
</script>
</head>

<div class="container">
<ul class="thumb">

    <!--li><a href="pmilogistik.php?module=penambahan_kantong"><img src="images/logistik_kantong_tambah1.png" alt=""/></a></li>
    <li><a href="pmilogistik.php?module=rekap_kantong_baru"><img src="images/rekap_kantong.png" alt=""/></a></li>
    <li><a href="pmilogistik.php?module=pengesahan_kantong"><img src="images/update_stock2.png" alt=""/></a></li>
    <li><a href="pmilogistik.php?module=rekap_pindahan_kantong"><img src="images/rekap_pindahan_kantong.png" alt=""/></a></li>

    <li><a href="pmilogistik.php?module=rekap_sisa_kantong_diaftap"><img src="images/rekap_kantong_aftap.png" alt=""/></a></li>

    <li><a href="pmilogistik.php?module=penghapusan_kantong"><img src="images/penghapusan_kantong.png" alt=""/></a></li>
        <li><a href="pmilogistik.php?module=master_reagen"><img src="images/logistik_masterreagen.png" alt=""/></a></li>
    
    <li><a href="pmilogistik.php?module=pindah_ke_lab"><img src="images/pindahan_reagen.png" alt=""/></a></li>
    <li><a href="pmilogistik.php?module=buang_reagen"><img src="images/set_kadaluarsa.png" alt=""/></a></li>
    <!--li><a href="pmilogistik.php?module=formulir"><img src="images/entri_form_darah.png" alt="" /></a></li>
    <li><a href="pmilogistik.php?module=pengadaan"><img src="images/entri_form_darah.png" alt="" /></a></li>
    <li><a href="pmilogistik.php?module=cetakulang_barcode"><img src="images/cetak_ulang_barcode.png" alt=""/></a></li>
    <li><a href="pmilogistik.php?module=penambahan_kantong_apheresis"><img src="images/kantong_apheresis.png" alt=""/></a></li>
    <li><a href="pmilogistik.php?module=penambahan_kantong_2014"><img src="images/cetak_barcode_kantong.png" alt=""/></a></li-->
    <li><a href="pmiqc.php?module=entry_logbook"><img src="images/logbook_add.png" alt=""/></a></li>
    <li><a href="pmiqc.php?module=rekap_logbook"><img src="images/logbook_data.png" alt=""/></a></li>
    <li><a href="pmiqc.php?module=new_logbook"><img src="images/logbook_new.png" alt=""/></a></li>
    <li><a href="pmiqc.php?module=rincian_logbook"><img src="images/logbook_report.png" alt=""/></a></li>
    
</ul>
</div>

