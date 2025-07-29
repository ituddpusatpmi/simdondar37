<?php
session_start();
require_once('adm/config.php');
$koders = $_SESSION['RS'];
$user = $_SESSION['user'];
$namars = mysqli_fetch_assoc(mysqli_query($con,"SELECT NamaRs from rmhsakit where Kode='$koders'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><?php echo 'Salam Kemanusiaan,  '.$_SESSION['user'];?></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="?page=rs" class="d-block"><?php echo $namars['NamaRs']; ?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon ion ion-person-add"></i>
              <p>
                Permintaan Darah
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=cariminta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cari Permintaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=addminta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buat Permintaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=batalminta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Batalkan Permintaan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-angle-left"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=profil" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=index" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>

            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
  <!-- conent -->

            <form name="permintaandarah" autocomplete="off" method="post" action="<?php echo $PHP_SELF;?>">
            	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#FF6346;" >
            		<tr>
            			<td align="center"><font size="4" color="white" face="Trebuchet MS"><b>FORMULIR PERMINTAAN DARAH</b></font></td>
            			<td align="right"><input type="submit" name="submit1" value="Simpan" class="swn_button_blue"></td>
            		</tr>
            	</table>
            	<table border="0" style="border-collapse:collapse" cellpadding="1" cellspacing="0" width="100%">
            		<tr><td valign="top"><font size="3" color="red" face="Trebuchet MS">A. DATA RUMAH SAKIT</font>
            		<table class="form" cellspacing="1" cellpadding="0" border="1" style="border-collapse:collapse">
            			<tr><td>No.Reg.RS</td>
            				<!--td class="input" nowrap><input name="no_formulir" type="text" size="20" required value="<?=$noformfix?>" onkeydown="drs(this.value);" placeholder='No-Urut/tahun'-->
            			<td class="input" nowrap><!--input name="no_formulir" type="text" size="20" onkeydown="drs(this.value);" required placeholder='No-Urut/tahun'-->
            				<input name="reg_rs" type="text" placeholder='No.Reg.RS'></td>
            			</tr>



            			<tr><td>Nama Dokter</td>
            				<td class="input" nowrap><input type=text name="nama_dokter" required id="dokter" placeholder='Nama Dokter'></td>
            			</tr>


            			<tr><td>Alasan Transfusi</td>
            				<td class="input"><input name="alasan" type="text" size="30" placeholder='Anemis'></td>
            			</tr>
            			<tr><td>Jumlah HB</td>
            				<td class="input"><input name="hb" type="text" size="5">gr/dl</td>
            			</tr>
            			<tr><td>Pernah Transfusi</td>
            				<td class="styled-select" >
            					<select name="pernahtransfusi">
            						<option value="0">Tidak</option>
            						<option value="1">Ya</option>
            					</select>
            					Kapan<input name="kapan" type="text" size="5" placeholder='Jika Ya(th)'></td>
            			</tr>
            			<tr><td>Reaksi Transfusi</td>
            				<td class="styled-select" >
            					<select name="reaksitransfusi">
            						<option value="0">Tidak</option>
            						<option value="1">Ya</option>
            					</select>
            					Gejala<input name="gejala" type="text" size="10" placeholder='Jika Ya'></td>
            			</tr>
            			<tr><td>Jenis Permintaan</td>
            				<td class="styled-select" >
            					<select name="jnspermintaan">
            						<option value="Biasa">Biasa</option>
            						<option value="Cadangan">Cadangan</option>
            						<option value="Siap Pakai">Siap Pakai</option>
            						<option value="Cyto/Segera">Cyto/Segera</option>
            					</select>
            					Keterangan<input name="ket" type="text" size="20" placeholder='Keterangan'></td>
            			</tr>
            			<tr><td class="input" colspan='2' alight="Center">Khusus Pasien Wanita</td>
            				<!--td class="input"></td-->
            			</tr>
            			<tr><td>Pernah Abortus</td>
            				<td class="styled-select" >
            					<select name="abortus">
            						<option value="0">Tidak</option>
            						<option value="1">Ya</option>
            					</select>
            				Jumlah Kehamilan<input name="jmlkehamilan" type="text" size="10" placeholder='Jml Hamil'></td>
            			</tr>
            		</table>
            	</td>
            	<td  valign="top">
            		<font size="3" color="red" face="Trebuchet MS">B. DATA PASIEN</font>
            			<table class="form" cellspacing="1" cellpadding="4" border="1" style="border-collapse:collapse">


            				<!--tr><td>No RM</td>
            					<td class="input"><input name="norm" id="norm" type="text" size="20" required placeholder='No. Rekam Medis'></td-->
            				</tr>
            				<tr><td>Nama Pasien</td>
            					<td class="input"><input name="nama_pasien" required type="text" size="20" placeholder='Nama Pasien'></td>
            				</tr>
            				<tr><td>Golongan Darah</td>
            					<td class="styled-select" >
            						<select name="golDrh">
            							<option value="O">O</option>
            							<option value="A">A</option>
            							<option value="B">B</option>
            							<option value="AB">AB</option>
            						</select></td>
            				</tr>
            				<tr>
            					<td>Rhesus</td>
            					<td class="styled-select" >
            						<select name="rhesus_psn">
            							<option value="+">Positif (+)</option>
            							<option value="-">Negatif (-)</option>
            						</select></td>
            				</tr>
            				<tr><td>Jenis Kelamin</td>
            					<td class="input"><input type="radio" required name="jk" value="Laki-laki">Laki-laki <br>
            					<input type="radio" name="jk" value="Perempuan">Perempuan</td>
            				</tr>
            				<tr><td>Nama Keluarga</td>
            					<td class="input"><input name="suami_istri" type="text" size="20" placeholder='Nama Keluarga'></td>
            				</tr>
            				<tr><td>Tgl Lahir</td>
            	<td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 onchange="document.permintaandarah.umur.value=Age(document.permintaandarah.datepicker.value);"></td>
            	<!--td class="input"><input TYPE="text" NAME="tgllhr" id="datepicker" SIZE=9 ></td-->
            				</tr>
            				<tr><td>Umur(Th)</td>
            					<td class="input"><input name="umur" type="text" size="3"></td>
            				</tr>
            				<tr><td>Alamat Pasien</td>
            					<td class="input"><input name="alamat" type="text" required size="20" placeholder='Alamat'></td>
            				</tr>
            				<tr>
            					<td>No Telepon</td>
            					<td class="input"><input name="tlppasien" type="text" size="13" placeholder='Telepon Keluarga'></td>
            				</tr>
            			</table>

            	</td>
            	<td  valign="top">
            		<font size="3" color="red" face="Trebuchet MS">C.DATA PERMINTAAN DARAH</font>
            		<table class="form" cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse">
            			<tr><td>Golongan Darah</td>
            				<td class="styled-select" >
            				<select name="goldarah">
            					<option value="O">O</option>
            					<option value="A">A</option>
            					<option value="B">B</option>
            					<option value="AB">AB</option>

            				</select>
            				Rhesus
            				<select name="rhesus">
            					<option value="+">Positif (+)</option>
            					<option value="-">Negatif (-)</option>
            				</select></td>
            			</tr>
                        <tr><td>Sampel Darah</td>
                            <td class="styled-select" >
                            <select name="sampel" required>
                                <option value="">--Pilih--</option>
                                <option value="1">Ada</option>
                                <option value="0">Tidak Ada</option>
                            </select>
                           </td>
                        </tr>



            		</table>
            	</td>
            	</tr>
            	</table>
            </form>


            <!-- /.content -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="pmisurakarta.or.id">PMI Kota Surakarta</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
<?php mysqli_close(); ?>
