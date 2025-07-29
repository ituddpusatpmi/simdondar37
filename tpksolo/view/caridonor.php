<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include '../adm/config.php';
    $utd = mysqli_fetch_array(mysqli_query($con,"SELECT * from utd where `aktif`=1"));
    
    $id = $_SESSION['instansi'];
    $unit = $_SESSION['unit'];
    $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMDONDAR</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css" title="currentStyle">
            @import "./../css/dt_page.css";
            @import "./../css/dt_table.css";
            @import "./../css/dt_table_jui.css";
        </style>
        <link type="text/css" href="../../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link type="text/css" href="./../css/TableTools_JUI.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="./../js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="./../js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="./../js/jquery.dataTables.js"></script>



<script>
    jQuery(document).ready(function(){
      $('#instansi').autocomplete({source:'../../modul/suggest_udd.php', minLength:2});});
        function disabletext(val){
        if(val=='0'){
        document.getElementById('comments').hidden = true;
        } else {
            document.getElementById('comments').hidden = false;
        }
    }

</script>

</head>

<style>
.body{
    font-size:12px;
}
.box{

    height: 25px;
    padding: 20px;
}
.box2{

    height: 25px;
    padding: 20px;
}
.copyright{
        bottom: 0;
    width: 100%;
    position: fixed;
    height:40px;
    line-height:50px;
    background:RED;
    color:#fff;
    padding-left: 10px;
  }
  .input-tanggal{
    padding: 10px;
    font-size: 14pt;
}

</style>
<body>



  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<div class="card-header">
  <h4 class="text-center" style="font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">CARI DATA PENDONOR</h4>
    <a href="<?php echo $lvl;?>.php?module=donor_baru"><button name="baru" class="btn btn-warning float-right"><i class="nav-icon ion ion-ios-medkit"></i>  Donor Baru</button></a>
    <a href="?page=dash"><button name="baru" class="btn btn-info float-right"><i class="nav-icon ion ion-ios-medkit"></i>  Kembali</button></a>
</div>

  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->




<form method="POST"  onkeydown="return event.key != 'Enter';" onsubmit="return validasiregistrasi()">
<div class="row" align="center">
    <div class="col-lg-6">
    <!--row1--->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Kode Pendonor</span>
                </div>
                    <input type="text" name="kode" class="form-control" id="iddonor" placeholder="ID KARTU DONOR" onchange='disabletext(this.value);'>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">No. KTP/Identitas</span>
                </div>
                    <input type="text"  class="form-control" name="NoKTP" placeholder="No. KTP/Identitas">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nama Pendonor</span>
                </div>
                    <input type="text"  class="form-control" name="nama" id="nama" placeholder="Nama Pendonor" minlength="3">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Alamat</span>
                </div>
                    <input type="text"  class="form-control" name="alamat" placeholder="Alamat">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Kelurahan</span>
                </div>
                    <input type="text"  class="form-control" name="kelurahan" placeholder="Kelurahan Alamat">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Kecamatan</span>
                </div>
                    <input type="text"  class="form-control" name="kecamatan" placeholder="Kecamatan Alamat">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Wilayah</span>
                </div>
                    <input type="text"  class="form-control" name="wilayah" placeholder="Kab / Kota">
            </div>
        </div>
    <!--row1--->
    </div>
    <div class="col-lg-6">
    <!--row2--->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Asal UDD PMI</span>
                </div>
                    <input type="text"  class="form-control" name="udd" id="instansi" value="" placeholder="Kab / Kota" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tempat Lahir</span>
                </div>
                    <input type="text"  class="form-control" name="tmplahir" placeholder="Tempat Lahir">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tanggal Lahir</span>
                </div>
                    <input type="text"  class="form-control" name="tgl" placeholder="dd" size='2' maxlength="2">
                    <input type="text"  class="form-control" name="bln" placeholder="mm" size='2' maxlength="2">
                    <input type="text"  class="form-control" name="thn" placeholder="yyyy" size='4' maxlength="4">
            </div>
        </div>
        <div class="form-group">
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">Golongan Darah</span>
                 </div>
                   <select class="form-control" name="goldarah">
                     <option value="">SEMUA</option>
                     <option value="A">A</option>
                     <option value="B">B</option>
                     <option value="O">O</option>
                     <option value="AB">AB</option>
                   </select>
               </div>
         </div>
        <div class="form-group">
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">Rhesus Darah</span>
                 </div>
                   <select class="form-control" name="rhesus">
                     <option value="">SEMUA</option>
                     <option value="+">+</option>
                     <option value="-">-</option>
                   </select>
               </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">No. Handphone</span>
                </div>
                    <input type="text"  class="form-control" name="telp" placeholder="Nomor Handphone">
            </div>
        </div>
        <div class="form-group">
            <button name="nasional" type="submit" class="btn btn-success float-right"><i class="fa fa-search"></i>  Cari Data Nasional</button>
            <button name="lokal" type="submit" class="btn btn-warning float-right"><i class="fa fa-search"></i>  Cari Data Server Lokal</button>
        </div>
        
    <!--row2--->
    </div>
</div>
</form>
<!--p class="box"-->

    <?php
        //Query Dinamis
        $nama   = $_POST['nama'];
        $tgl    = $_POST['tgl'];
        $bln    = $_POST['bln'];
        $thn    = $_POST['thn'];
        $tgllhr = $thn."-".$bln."-".$tgl;
        if ($_POST['kode']!='') {
            $srckode  = $_POST['kode'];
            $qkode       = " AND Kode = '$srckode' ";
        } else {$qkode    ="";}
        
        if ($_POST['NoKTP']!='') {
            $srcktp  = $_POST['NoKTP'];
            $qktp       = " AND NoKTP = '$srcktp' ";
        } else {$qktp    ="";}
        
        if ($_POST['alamat']!='') {
            $srcalamat  = $_POST['alamat'];
            $qalamat       = " AND Alamat = '$srcalamat' ";
        } else {$qalamat    ="";}
        
        if ($_POST['kelurahan']!='') {
            $srckelurahan  = $_POST['kelurahan'];
            $qkelurahan       = " AND kelurahan = '$srckelurahan' ";
        } else {$qkelurahan    ="";}
        
        if ($_POST['kecamatan']!='') {
            $srckecamatan  = $_POST['kecamatan'];
            $qkecamatan       = " AND kecamatan = '$srckecamatan' ";
        } else {$qkecamatan    ="";}
        
        if ($_POST['wilayah']!='') {
            $srcwilayah  = $_POST['wilayah'];
            $qwilayah       = " AND wilayah = '$srcwilayah' ";
        } else {$qwilayah    ="";}
        
        if ($_POST['udd']!='') {
            $srcudd  = $_POST['udd'];
            $qudd       = " AND Kode = '$srcudd' ";
        } else {$qudd    ="";}
        
        if ($_POST['tmplahir']!='') {
            $srctmplahir  = $_POST['tmplahir'];
            $qtmplahir       = " AND TempatLhr = '$srctmplahir' ";
        } else {$qtmplahir    ="";}
        
        if (($tgl !='') && ($bln !='') && ($thn !='')) {
            $srctgl  = $tgllhr;
            $qtgl       = " AND TglLhr = '$srctgl' ";
        } else {$qtgl    ="";}
        
        if ($_POST['goldarah']!='') {
            $srcgoldarah  = $_POST['goldarah'];
            $qgoldarah       = " AND GolDarah = '$srcgoldarah' ";
        } else {$qgoldarah    ="";}
        
        if ($_POST['rhesus']!='') {
            $srcrhesus  = $_POST['rhesus'];
            $qrhesus       = " AND Rhesus = '$srcrhesus' ";
        } else {$qrhesus    ="";}
        
        if ($_POST['telp']!='') {
            $srctelp  = $_POST['telp'];
            $qtelp       = " AND telp2 = '$srctelp' ";
        } else {$qtelp    ="";}
        
        
    //Tombol Lokal
    if(isset($_POST['lokal'])){
        
      //echo "Nama hostname : ".$td0." & data lokal dipilih<br>";
      $jd="select * from pendonor where Nama like '%$nama%' $qkode $qktp $qalamat $qkelurahan $qkecamatan $qwilayah $qtmplahir $qtgl $qgoldarah $qrhesus $qtelp order by Nama asc";
      echo $jd;
      //$qjd = mysqli_query($dbi, $jd);
      $num = mysqli_num_rows($qjd);
        ?><table cellpadding="0" cellspacing="0" border="0" class="display"  width="100%">
            <tr style="background-color:#FF6346;  color:#FFFFFF; font-family:Verdana;">
            <td align="center">Kode Pendonor</td>
            <td align="center">Nama</td>
            <td align="center">Jenis Kelamin</td>
            <td align="center">Alamat</td>
            <td align="center">Gol Darah</td>
            <td align="center">Tempat<br>Tgl. Lahir</td>
            <td align="center">Telp/Hp</td>
            <td align="center">Jumlah Donor</td>
            <td align="center">Tanggal Kembali<br>Donor</td>
            <td align="center">IMLTD</td>
            <td align="center">Kartu</td>
            </tr>
        <?php
      if ($num > 0){
          $today=date('Y-m-d');
          while ($data = mysqli_fetch_array($qjd)) {
            //backcolor cekal
            if ($data['Cekal']=='1' || $data['Cekal']=='2' ){$style = "style=background-color:#FF6346; font-size:12px;";}else{$style = "style=background-color:#FFFFFF; font-size:12px;";}
              
            //jenis kelamin
            if ($data['Jk']=='0'){
            $jeniskelamin="Laki-Laki";}
            if ($data['Jk']=='1'){
            $jeniskelamin="Perempuan";}
              
            //Cekal
              if ($data['Cekal']=='1') {$imltd = "Konfirm ke Dokter";}
              else if ($data['Cekal']=='2') {$imltd = "Pernah Cek Ulang IMLTD";}
              else {$imltd = "OK";}
              
            ?>
        <tr <?php echo $style;?> onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
              <td align="center">
                <!-- Jika Wanita <4 & PRIA >4-->
                <?php if ($data['Jk']=="1"){
                $tahun=date('Y');
                $jumtransaksiperempuan = mysqli_query($dbi, "select * from htransaksi where KodePendonor='$kode' and year(tgl)='$tahun'");
                if (date('Y-m-d')>=$data['tglkembali'] and ($data['Cekal']=='0') and (mysqli_num_rows($jumtransaksiperempuan) <'4') ){?>
                    <img src="../images/bloodbag.png" width=25 height=15/><?php }} else if (date('Y-m-d')>=$data['tglkembali'] and ($data['Cekal']=='0') ){?>
                    <img src="../images/bloodbag.png" width=25 height=15/> <?php } ?>
                <a href="idcard_barcode.php?idpendonor=<? echo $data['Kode'] ?>"><img src="../images/barcode.png" width=25 height=15 /></a>
                <a href="/jqupc/index.php?ext=jpg&idpendonor=<? echo $data['Kode'] ?>"><img src="../images/idcard.png" width=25 height=15></a>
                <a href="pmi<?echo $_SESSION['leveluser'] ?>.php?module=eregistrasi&Kode=<? echo $data['Kode'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/ubah.png" width=25 height=15 /></a>
                 <!--Gift donor p2d2s 250121 BadBoy-->
                    <?php if ($_SESSION[leveluser]=='p2d2s'){?>
                    <a href="pmi<?php echo $_SESSION[leveluser] ?>.php?module=logpendonor&Kode=<?php  echo $data['Kode'] ?>&nama=<?php echo $data['Nama']?>"><img src="../images/piagam0.png" width=20 height=20></a>
                    <?php } ?><br>
                <a href="pmi<?php echo $_SESSION['leveluser'] ?>.php?module=history&q=<?php echo $data['Kode']?>" target="isiadmin" class="fisheyeItem"><?php echo $data['Kode'];?></a></td>
              <td align="center"><?php echo $data['Nama'];?></td>
              <td align="center"><?php echo $jeniskelamin;?></td>
              <td align="center"><?php echo $data['Alamat']." <br>".$data['kelurahan']." ".$data['kecamatan']." ".$data['wilayah'];?></td>
              <td align="center"><?php echo $data['GolDarah']." (".$data['Rhesus'].")";?></td>
              <td align="center"><?php echo $data['TempatLhr'].",<br>".$data['TglLhr'];?></td>
              <td align="center"><?php echo $data['telp2'];?></td>
              <td align="center"><?php echo $data['jumDonor'];?> kali</td>
              <td align="center"><?php echo $data['tglkembali'];?></td>
              <td align="center"><?php echo $imltd;?></td>
              <td align="center"><?php echo $data['cetak']="<a href=pmi".$_SESSION[leveluser].".php?module=historycetak&kode=".$data['Kode']." TITLE=\"DETIL\">".$data['cetak']." kali</a> "?></td>

         </tr>
        <?php }}else {
          echo "<tr><td align='center' colspan=12>Tidak Ada Data Pendonor</td></tr>";
      }?>
        </table>
    <?php }
        
        
    ///==>TOMBOL NASIONAL
    if(isset($_POST['nasional'])){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/simdondar/caripendonor.php",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('udd' => $srcudd, 'kode' => $srckode, 'nama' => $nama, 'NoKTP' => $srcktp, 'alamat' => $srcalamat, 'kelurahan' => $srckelurahan, 'kecamatan' => $srckecamatan, 'wilayah' => $srcwilayah, 'tmplahir' => $srctmplahir,  'tgllhr' => $srctgl,  'goldarah' => $srcgoldarah,  'rhesus' => $srcrhesus, 'telp2' => $srctelp),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
        $tgl= date("Y/m/d");
        $data = json_decode($response, true);?>
        <table cellpadding="0" cellspacing="0" border="0" class="display"  width="100%">
            <tr style="background-color:#FF6346;  color:#FFFFFF; font-family:Verdana;">
            <td align="center">Kode Pendonor</td>
            <td align="center">Nama</td>
            <td align="center">Jenis Kelamin</td>
            <td align="center">Alamat</td>
            <td align="center">Gol Darah</td>
            <td align="center">Tempat<br>Tgl. Lahir</td>
            <td align="center">Telp/Hp</td>
            <td align="center">Jumlah Donor</td>
            <td align="center">Tanggal Kembali<br>Donor</td>
            <td align="center">IMLTD</td>
            <td align="center">Foto</td>
            </tr><?php
                
        for($a=0; $a < count($data['data']); $a++){
          $no=$a+1;
          $chkdata=strlen($data['data'][$a]['pkode']);
          if ($chkdata>0){
            if ($data['data'][$a]['pcekal']=='1' || $data['data'][$a]['pcekal']=='2' ){$style = "style=background-color:#FF6346; font-size:12px;";}else{$style = "style=background-color:#FFFFFF; font-size:12px;";}
              
            //jenis kelamin
            if ($data['data'][$a]['pjk']=='0'){
            $jeniskelamin="Laki-Laki";}
            if ($data['data'][$a]['pjk']=='1'){
            $jeniskelamin="Perempuan";}
              
            //Cekal
              if ($data['data'][$a]['pcekal']=='1') {$imltd = "Konfirm ke Dokter";}
              else if ($data['data'][$a]['pcekal']=='2') {$imltd = "Pernah Cek Ulang IMLTD";}
              else {$imltd = "OK";}
            ?>
            <tr <?php echo $style;?> onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                  <td align="center">
                    <!-- Jika Wanita <4 & PRIA >4-->
                    <?php if ($data['data'][$a]['pjk']=="1"){
                    $tahun=date('Y');
                    $jumtransaksiperempuan = mysqli_query($dbi, "select * from htransaksi where KodePendonor='$kode' and year(tgl)='$tahun'");
                    if (date('Y-m-d')>=$data['data'][$a]['ptglkembali'] and ($data['data'][$a]['pcekal']=='0') and (mysqli_num_rows($jumtransaksiperempuan) <'4') ){?>
                        <img src="../images/bloodbag.png" width=25 height=15/><?php }} else if (date('Y-m-d')>=$data['data'][$a]['ptglkembali'] and ($data['data'][$a]['pcekal']=='0') ){?>
                        <img src="../images/bloodbag.png" width=25 height=15/> <?php }
                    echo  '<a href="'.$lvl.'.php?module=eregistrasiluar&id='.htmlspecialchars(serialize($data['data'][$a])).'"><img src="../images/ubah.png" width=25 height=15 /></a>';
                            ?>
                    <br>
                    <a href="pmi<?php echo $_SESSION['leveluser'] ?>.php?module=history_luar&q=<?php echo $data['data'][$a]['pkode']?>" target="isiadmin" class="fisheyeItem"><?php echo $data['data'][$a]['pkode'];?></a></td>
                  <td align="center"><?php echo $data['data'][$a]['pnama'];?></td>
                    <td align="center"><?php echo $jeniskelamin;?></td>
                    <td align="center"><?php echo $data['data'][$a]['palamat']." <br>".$data['data'][$a]['pkelurahan']." ".$data['data'][$a]['pkecamatan']." ".$data['data'][$a]['pwilayah'];?></td>
                    <td align="center"><?php echo $data['data'][$a]['pgoldarah']." (".$data['data'][$a]['prhesus'].")";?></td>
                    <td align="center"><?php echo $data['data'][$a]['ptempatlahir'].", <br>".$data['data'][$a]['ptgllahir'];?></td>
                    <td align="center"><?php echo $data['data'][$a]['ptelp2'];?></td>
                    <td align="center"><?php echo $data['data'][$a]['pjmldonor'];?> kali</td>
                    <td align="center"><?php echo $data['data'][$a]['ptglkembali'];?></td>
                    <td align="center"><?php echo $imltd;?></td>
                    <td align="center"><img class="img-hover-zoom--slowmo" src="https://dbdonor.pmi.or.id/pmi/image/<?php echo $data['data'][$a]['userfoto'];?>" style="max-width: 40%; height: auto;"></td>

    

       <?php }
       }
       if ($no=='0'){
          echo '<tr>';
          echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data Pendonor Nasional</td>';
          echo '</tr>';
       }
       echo '</tbody>
       </table>';
        
        
         } //ENDDDD
           
           
           
    ?>
<!--content-->
    </div>
  </div>





<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  //Date picker
  
  $("#datepicker").datepicker({
         dateFormat:"yy-mm-dd",
      });
} );
</script>
<script type="text/javascript">
    function validasiregistrasi()
    {
        if (document.getElementById('iddonor').value == '')
        {
            if (document.getElementById('nama').value.length < 3)
            {
                    alert('Pencarian Nama harus diisi/minimal 3 Karakter!');return false;
            }
        }
//        if (document.getElementById('alamat').value.length == 0)
//        {
//            alert('Alamat diisi dengan jelas dan lengkap ..');return false;
//        }
    }
</script>
<script>
$( function() {
  //Date picker
  $('#reservationdate').datetimepicker({
      format: 'yyyy-MM-DD'
  });

  //Date picker
  $('#reservationdate2').datetimepicker({
      format: 'yyyy-MM-DD'
  });

  //Date and time picker
  $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  $("#datepicker2").datepicker({
         dateFormat:"yy-mm-dd",
      });
} );
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../tpksoloplugins/jquery/jquery.min.js"></script>

</body>
</html>
