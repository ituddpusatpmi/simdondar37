<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_pengambilan_sampel.xls");
header("Pragma: no-cache");
header("Expires: 0");
    
include('../config/dbi_connect.php');
    $today    = $_POST['minta1'];
    $today1   = $_POST['minta1'];
    $srcnama  = $_POST['namadonor'];
    $srctmp   = $_POST['tmpsampel'];
    $srcgol   = $_POST['GOL'];
    $srcpasien  = $_POST['pasien'];
    $srcjd      = $_POST['JD'];
    $srcstat	= $_POST['STAT'];
    
    

     //Query dinamis
          if ($_POST['minta1']) {$today=$_POST['minta1'];$today1=$today;}
          if ($_POST['minta2']!='') $today1=$_POST['minta2'];
          if ($_POST['namadonor']!='') {
                          $srcnama  = $_POST['namadonor'];
                          $qnama       = " AND Nama like '%$srcnama%' ";
                                      } else {$qnama    ="";}
          if ($_POST['tmpsampel']!='') {
                          $srctmp      = $_POST['tmpsampel'];
                          $qtmp        = " AND sk_tmp_plebotomi like '%$srctmp%' ";
                          } else {$qtmp    ="";}
          if ($_POST['GOL']!='') {
                          $srcgol    = $_POST['GOL'];
                          $qgol      = " AND sk_gol = '$srcgol' ";
                          } else {$qgol    ="";}
          if ($_POST['pasien']!='') {
                          $srcpasien    = $_POST['pasien'];
                          $qpasien       = " AND namap like '%$srcpasien%' ";
                          } else {$qpasien    ="";}
          if ($_POST['JD']!='') {
                          $srcjd     = $_POST['JD'];
                          $qjd        = " AND JenisDonor = '$srcjd' ";
                          } else {$qjd    ="";}
          if ($_POST['STAT']!='') {
                      $srcstat  = $_POST['STAT'];
                      $qstat        = " AND sk_hasil = '$srcstat' ";
                      } else {$qstat    ="";}

          

    ?>

<div style="font-size:18px;color:#00008B;"><center><H2> <b>REKAP PEMERIKSAAN SAMPEL DARAH</b></H2></center></div>

      <br>


        <?php
        //pagination
       

        $sql="SELECT * from  v_cek_sampel_merge where (date(sk_tgl_plebotomi) between '$today' AND '$today1')
             $qnama $qtmp $qgol $qpasien $qjd $qstat ";

        $sq=mysqli_query($dbi,$sql);
        $no=1;
        $jum = mysqli_num_rows($sq);

      

      ?>
      <p>
           
      <table border=1 width=100% cellpadding=5 cellspacing=5 style="border-collapse:collapse" >
      <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
          <td rowspan=2>No</td>
          <td rowspan=2>Tanggal <br>Sampel</td>
          <td rowspan=2>Tempat Pengambilan</td>
          <td rowspan=2>ID Sampel</td>
          <td rowspan=2>Pendonor</td>
          <td rowspan=2>Gol.<br>Darah</td>
          <td rowspan=2>Jenis Donor</td>
          <td rowspan=2>No. Telp</td>
          <td colspan=2>Pasien Penerima</td>
          <td rowspan=2>Status Sampel</td>
      </tr>
     <tr style="background-color:red; font-size:14px; color:#FFFFFF; font-family:Verdana;"  align='center'>
            <td>Nama Pasien</td>
            <td>Rumah Sakit</td>
      </tr>

      <?php
      if ($jum < 1){?>
          <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
          <td align="center" colspan="11">Tidak Ada Data Pemeriksaan</td>
          </tr>
      <?php
      } else {
        while($dt=mysqli_fetch_assoc($sq)){?>

                <tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
  
                        <td align="right"><?php echo $no++ ;?></td>
                        <td align="left"><?php echo $dt['sk_tgl_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_tmp_plebotomi'];?></td>
                        <td align="left"><?php echo $dt['sk_kode'];?></td>
                        <td align="left"><?php echo $dt['Nama'];?></td>
                        <td align="left"><?php echo $dt['sk_gol'].$dt['sk_rh'];?></td>
                                                <?php if ($dt['JenisDonor']=="1"){?>
                        <td align="left"><font color="RED">PENGGANTI</font></td>
                                                <?php } else {?>
                        <td align="left">SUKARELA</td>
                                                <?php }?>
<td align="left"><?php echo "'".$dt['telp2'];?></td>
                                                <?php if ($dt['namap']!=""){?>
                        <td align="left"><?php echo $dt['namap'];?></td>
                        <td align="left"><?php echo $dt['NamaRs'];?></td><?} else {?>
                                                        <td align="left">-</td>
                                                        <td align="left">-</td>
                                                    <?}?>
                            
                        <?php if ($dt['sk_hasil']=="0"){
                            $stat = "<font color ='blue'>Antri Pelulusan</font>";
                           
                        } else if ($dt['sk_hasil']=="1"){
                            $stat = "<font color ='green'>Lulus / Antri Penjadwalan</font>";
                            
                        } else if ($dt['sk_hasil']=="2"){
                            $stat = "<font color ='red'>Tidak Lulus</font>";
                            
                        } else if ($dt['sk_hasil']=="3"){
                            $stat = "<font color ='green'>Lulus / Cek Ulang</font>";
                            
                        } else if ($dt['sk_hasil']=="4"){
                            $stat = "<font color ='black'>Sudah Dijadwalkan</font>";
                        
                        }else{ $stat = "Batal";
                        }?>
                        <td align="left"><?php echo $stat;?></td>
                        
            
                    
                </tr>
                <?php
                                                              }}
                                                               mysql_close()?>
</table>




