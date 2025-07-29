
<?php
  error_reporting (E_ALL ^ E_NOTICE);
  session_start();

  if ($_SESSION['ipserver']==''){?>
    <META http-equiv="refresh" content="0; url=index.php">
    <?php
  }

  include '../adm/config.php';
  $namautd            = mysqli_fetch_assoc(mysqli_query($con,"SELECT id,nama,alamat,daerah,telp from utd where aktif='1' limit 1"));
  $utd                = strtoupper($namautd['nama']);
  $_SESSION['idudd']  = $namautd['id'];
  $ip	              	= $_SESSION['ipserver'];

  //PANGGIL ANTRIAN


  //ANTRIAN PEMERIKSAAN
  $antri = mysqli_fetch_assoc(mysqli_query($con,"select * from v_panggilantri"));
  $daftar = mysqli_query($con,"select * from antrian where date(tgl) = curdate() AND panggil = '0' limit 10");

  //UPDATE ANTRIAN
  if(isset($_POST['lanjutPA'])){
    $nomorPA = $_POST['nomorPA'];
    $updatepanggil = mysqli_query($con,"UPDATE antrian set panggil=1 where nomor='$nomorPA' AND tgl=curdate()");
    ?>
    <META http-equiv="refresh" content="0; url=panggilantrian.php"><?php
  }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PALANG MERAH INDONESIA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!--PMI STYLE-->
  <link rel="stylesheet" href="../dist/css/bspmi.css">
  <!--PVOICE-->
  <script type="text/javascript" >
    $(document).ready(function(){
      $("#play").click(function(){
        document.getElementById('suarabel').play();		
      });
    });
</script>
</head>
<style type="text/css">
    .padding {
        
        background-image: url('../dist/img/registrasi.png');
        background-size: cover;
    }
    .box{
      height: 50px;
      padding-left: 10px;
      padding-right: 10px;  
    }

    .padd {
      padding-left: 10px;
      padding-top: 5px; 
      padding-right: 225px; 
      font-size: 12px;
    }

    .box2{

    height: 50px;

    }
    .copyright{
      bottom: 0;
      width: 100%;
      position: fixed;
      height:50px;
      line-height:50px;
      background:RED;
      color:#fff;
      padding-left: 10px;
    }
    </style>

<body class="padding">

<!--voice-->
        <audio id="suarabel" src="../dist/sound/in.wav"></audio>
        <audio id="suarabelnomorurut" src="../dist/sound/NomorAntrian.mp3"  ></audio>
        <audio id="suarabelsuarabelloket" src="../dist/sound/ruanghb.MP3"  ></audio>
        <audio id="belas" src="../dist/sound/belas.MP3"  ></audio>
        <audio id="sebelas" src="../dist/sound/sebelas.mp3"  ></audio>
        <audio id="puluh" src="../dist/sound/puluh.MP3"  ></audio>
        <audio id="sepuluh" src="../dist/sound/sepuluh.MP3"  ></audio>
        <audio id="ratus" src="../dist/sound/ratus.MP3"  ></audio>
        <audio id="seratus" src="../dist/sound/seratus.MP3"  ></audio>

    
<!--voice-->
<div class="padd" align="right">
    <font style="font-size: 18px;"><b><u><?php echo $utd;?></u></b></font><br>
    <?php echo $namautd['alamat'].', '.$namautd['daerah'];?><br>
    Telp. <?php echo $namautd['telp'];?><br>
</div>

<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <div class="box"></div>
  <div class="box">
  
  
  <!-- Contennt-->
  <p id="spasi2">
  <div class="row">
        	<div class="col-lg-4">
          <center><strong style="font-size: 25px;">PEMERIKSAAN AWAL</strong></center>
						<ol class="breadcrumb">
            
              <table width=80% class="table table-bordered table-hover table-striped">
              <tr>
                <td>Jumlah Antrian : <?php echo $antri['jmlpa'];?></td>
              <tr>
              </table>
							<table width=80% class="table table-bordered table-hover table-striped">
								<tr>
                <td bgcolor="#defad2" align="center">No. Antri : <br>
                <strong style="font-size: 50px;"><?php echo $antri['nomorpa'];?></strong><br>
                <?php echo strtoupper($antri['namapa']);?>
                </td>
								</tr>

							</table>

							<!--Pilih Menu-->
              <table width=100% class="table table-bordered table-hover table-striped">
								<tr>
                  <td align="center">
                    <button  class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="mulai();">PANGGIL</button>
                  </td>
                  <td align="center"> 
                    <form method="post" action="">
                    <input type="hidden"  name="nomorPA" value="<?php echo $antri['nomorpa'];?>" >
                    <input type="submit"  name="lanjutPA" value="LANJUT" class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px">
                    </form>
                  </td>
                </tr>
              </table>
							<!-- Pilih Menu -->
						</ol>
        	</div>
          <div class="col-lg-8">
            <center>
                <strong style="font-size: 25px;">DAFTAR ANTRIAN PENDONOR</strong>
            </center>
            <ol class="breadcrumb">
                  
                  <table width=80% class="table table-bordered table-hover table-striped">
                  <tr>
                    <th>NO. ANTRIAN</th>
                    <th>NAMA PENDONOR</th>
                    <th>DONOR KE</th>
                    <th>LENGAN DONOR</th>
                  </tr>
<?php
    $lengan = 'KEDUANYA';
    while ($list = mysqli_fetch_assoc($daftar)){
    if ($list['lengan'] == '2'){ $lengan ='KANAN';} elseif ($list['lengan'] == '1') {$lengan ='KIRI';}
    ?>
        <tr>
        <td><?php echo $list['nomor'];?></td>
        <td><?php echo strtoupper($list['nama']);?></td>
        <td><?php echo $list['donorke'];?></td>
        <td><?php echo $lengan; ?></td>
        </tr>
    <?php }
?>
                  </table>
            </ol>
          </div>
          
          
          
  </div>

  <p>
  <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4" align="center">
        
        <a href="panggilantrian.php"><button  class="btn btn-light btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" >RELOAD ANTRIAN</button>
        <a href="resetantri.php"><button  class="btn btn-dark btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" >RESET ANTRIAN</button></a>
        <a href="logout.php"><button  class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" >KELUAR AKUN</button></a>
        
      </div>
      <div class="col-lg-4"></div>
  </div>

  <?php

      //Pemeriksaan Awal
      $tcounter=$antri['nomorpa'];
			$panjang=strlen($tcounter);
			$antrian=$tcounter;
			
			for($i=0;$i<$panjang;$i++){
		?>
      <audio id="suarabel<?php echo $i; ?>" src="../dist/sound/<?php echo substr($tcounter,$i,1); ?>.MP3" ></audio>
    <?php
			}
            
		?>
  

  <!-- Content -->
  </div>
  <div class="copyright">
      <p align="center"><a href="https://pmi.or.id"><font style="color:white">Copyright @ 2021 | PALANG MERAH INDONESIA</a> 
  </div>


<?php mysqli_close()?>
<!--META http-equiv="refresh" content="120; url=panggilantrian.php"-->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <script type="text/javascript">
function mulai(){
	//MAINKAN SUARA BEL PADA SAAT AWAL
	document.getElementById('suarabel').pause();
	document.getElementById('suarabel').currentTime=0;
	document.getElementById('suarabel').play();
			
	//SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT		
	totalwaktu=document.getElementById('suarabel').duration*1000;	

	//MAINKAN SUARA NOMOR URUT		
	setTimeout(function() {
			document.getElementById('suarabelnomorurut').pause();
			document.getElementById('suarabelnomorurut').currentTime=0;
			document.getElementById('suarabelnomorurut').play();
	}, totalwaktu);
	totalwaktu=totalwaktu+1000;
	
	<?php
		//JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
		if($antrian<10){
	?>
			
			setTimeout(function() {
					document.getElementById('suarabel0').pause();
					document.getElementById('suarabel0').currentTime=0;
					document.getElementById('suarabel0').play();
				}, totalwaktu);
			
			totalwaktu=totalwaktu+1000;
	<?php		
		}elseif($antrian ==10){
			//JIKA 10 MAKA MAIKAN SUARA SEPULUH
	?>  
				setTimeout(function() {
						document.getElementById('sepuluh').pause();
						document.getElementById('sepuluh').currentTime=0;
						document.getElementById('sepuluh').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
		<?php		
			}elseif($antrian ==11){
				//JIKA 11 MAKA MAIKAN SUARA SEBELAS
		?>  
				setTimeout(function() {
						document.getElementById('sebelas').pause();
						document.getElementById('sebelas').currentTime=0;
						document.getElementById('sebelas').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
		<?php		
			}elseif($antrian ==100){
                //JIKA 100 MAKA MAIKAN SUARA SERATUS
        ?>
                setTimeout(function() {
                        document.getElementById('seratus').pause();
                        document.getElementById('seratus').currentTime=0;
                        document.getElementById('seratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
            }elseif($antrian < 20){
				//JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
		?>  				
				setTimeout(function() {
						document.getElementById('suarabel1').pause();
						document.getElementById('suarabel1').currentTime=0;
						document.getElementById('suarabel1').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
				setTimeout(function() {
						document.getElementById('belas').pause();
						document.getElementById('belas').currentTime=0;
						document.getElementById('belas').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
		<?php		
			} elseif ($antrian < 100){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel0').pause();
                        document.getElementById('suarabel0').currentTime=0;
                        document.getElementById('suarabel0').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                
        <?php
        
            } elseif ($antrian < 100){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel0').pause();
                        document.getElementById('suarabel0').currentTime=0;
                        document.getElementById('suarabel0').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                
        <?php
        
            } elseif ($antrian > 100 && $antrian < 120 ){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('seratus').pause();
                        document.getElementById('seratus').currentTime=0;
                        document.getElementById('seratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime=0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('belas').pause();
                        document.getElementById('belas').currentTime=0;
                        document.getElementById('belas').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
        
            }elseif ($antrian > 120 && $antrian < 200 ){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('seratus').pause();
                        document.getElementById('seratus').currentTime=0;
                        document.getElementById('seratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime=0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                
        <?php
        
            } elseif ($antrian > 199 && $antrian < 1000 ){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel0').pause();
                        document.getElementById('suarabel0').currentTime=0;
                        document.getElementById('suarabel0').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('ratus').pause();
                        document.getElementById('ratus').currentTime=0;
                        document.getElementById('ratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime=0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
        
            }else{
				//JIKA LEBIH DARI 100 
				//Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
				//Selebihnya akan langsung disebutkan angkanya saja 
				//tanpa kata "RATUS", "PULUH", maupun "BELAS"
		?>
		
		<?php 
			for($i=0;$i<$panjang;$i++){
		?>
		
		totalwaktu=totalwaktu+1000;
		setTimeout(function() {
						document.getElementById('suarabel<?php echo $i; ?>').pause();
						document.getElementById('suarabel<?php echo $i; ?>').currentTime=0;
						document.getElementById('suarabel<?php echo $i; ?>').play();
					}, totalwaktu);
		<?php
			}
			}
		?>
		
		
		totalwaktu=totalwaktu+1000;
		setTimeout(function() {
						document.getElementById('suarabelsuarabelloket').pause();
						document.getElementById('suarabelsuarabelloket').currentTime=0;
						document.getElementById('suarabelsuarabelloket').play();
					}, totalwaktu);
		
		totalwaktu=totalwaktu+1000;
		setTimeout(function() {
						document.getElementById('suarabelloket<?php echo $loket; ?>').pause();
						document.getElementById('suarabelloket<?php echo $loket; ?>').currentTime=0;
						document.getElementById('suarabelloket<?php echo $loket; ?>').play();
					}, totalwaktu);	
          <?php 
           // $updatepanggil = mysqli_query($con,"UPDATE antrian set panggil=1 where nomor='$tcounter' AND tgl=curdate()");
          ?>
}
</script>
  </body>
  </html>

  
