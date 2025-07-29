    
<?php 
session_start();
include "../koneksi.php";

$namauser = $_SESSION[namauser];
$today = date('YmdHis');
$notrans = $today . "-" . $namauser;
$level = $_SESSION[bagian];

        if (isset($_GET['filename'])) {
        $filename    = $_GET['filename'];

        $back_dir    ="../upload/";
        $file = $back_dir.$_GET['filename'];
	$nurdin=$file;
        
            
        }
    ?>


<?

$tambah = mysql_query("insert into lacakdokumen (notrans, nama_pengakses, level_pengakses,tanggal_akses,nama_dokumen) values ('$notrans','$namauser','$level','$today','$filename')");

?>

<div class="container">
<div class="box-body">
<div style='padding:10px;'>
<embed src="<?php echo $nurdin; ?>#toolbar=0" ondragstart="return false"  quality="high" name="fb" allowScriptAccess="always" allowFullScreen="true" pluginpage="http://www.adobe.com/go/getreader" type="application/pdf" width="100%" height="410"></embed></div></div>
</ul>
</ul>

</div>

