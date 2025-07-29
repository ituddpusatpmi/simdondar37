<?php
require_once('config/koneksi.php');
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='udd'){
     $nama_udd=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'"));
     echo '{"infoudd":';
     echo '{"namaudd":"'.$nama_udd[nama].'"';
     echo '}';
     echo '}';
}

if($op=='cek'){
     $tanggalinput 	= $_GET['tanggal'];
     $nomorlot		= $_GET['nolot'];
     $nomorlot      = mysql_real_escape_string($nomorlot);
     $tanggalinput  = substr($tanggalinput,2,2).substr($tanggalinput,5,2).substr($tanggalinput,8,2);
     $nobag = $tanggalinput.$nomorlot;

     //build query
     //$query         = "SELECT noKantong FROM stokkantong WHERE left(noKantong,$pj)='$nobag' order by noKantong desc limit 1";
     $query         ="SELECT noKantong from stokkantong WHERE LEFT(`noKantong`, LENGTH(`nokantong`) -3 )='$nobag' order by noKantong desc limit 1";
     $qry_result    = mysql_query($query) or die(mysql_error());
     $row           = mysql_fetch_assoc($qry_result);

     $pjg_ktg       = strlen($row[noKantong]);
     $nomor         = (int)(substr($row[noKantong],$pjg_ktg-3,2));
     $nomor1        = (int)($nomor+1);
     $j_nol1        = 2-(strlen(strval($nomor1)));
                      for ($i=0; $i<$j_nol1; $i++){
                         $nomor2 .="0";
                    }
     $kantongbaru   = $nobag.$nomor2.$nomor1;
     echo '{"kantong":';
     echo '{"nokantong":"'.$kantongbaru.'"';
     echo ',"tanggal":"'.$tanggalinput.'"';
     echo ',"tgl_aftap":"'."_".'"';
     echo ',"produk":"'."_".'"';
     echo '}';
     echo '}';
}elseif($op=='simpan'){
     //cek_kantong_apheresis.php?op=simpan&nokantong="+nkt+"&tgl="+tgl+"&merk="+merk+"&vol="+vol+"&jns="+jns+"&keterangan="+keterangan,
     $jenis         = $_GET['jns'];
     for ($i=0; $i<$jenis; $i++) {
          $nokantong     = $_GET['nokantong'];
          $tanggal       = $_GET['tgl'];
          $status        = "0";
          $volume        = $_GET['vol'];
          $merk          = $_GET['merk'];
          $kadaluwarsa_ktg=$_GET['kadaluwarsa_ktg'];
	  $keterangan    = $_GET['keterangan'];
          $lbl           = "";
          if ($i==0){
               $nkt=$nokantong."A";
               $lbl="A";
          }
          if ($i==1) $nkt=$nokantong."B";
          if ($i==2) $nkt=$nokantong."C";
          if ($i==3) $nkt=$nokantong."D";
          if ($i==4) $nkt=$nokantong."E";
          if ($i==5) $nkt=$nokantong."F";
     
          $tambah=mysql_query("insert into
               			stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,volumeasal,StatTempat,kadaluwarsa_ktg,keterangan) 
                              values ('$nkt','$jenis','$status','$tanggal','$volume','$merk','$volume','1','$kadaluwarsa_ktg','$keterangan')");
          if ($lbl=="A"){
               $ident=mysql_query("update stokkantong set ident='m' where nokantong='$nkt'");
          }
     };
     if ($tambah){
          echo '{"pesan":';
          echo '{"pesanproses":"'."SUKSES".'"';
          echo ',"nomorkantong":"'.$nkt.'"';
          echo ',"jenis":"'.$jenis.'"';
          echo ',"status":"'.$status.'"';
          echo ',"tanggal":"'.$tanggal.'"';
          echo ',"merk":"'.$merk.'"';
          echo ',"volume":"'.$volume.'"';
	  echo ',"keterangan":"'.$keterangan.'"';
          echo '}';
          echo '}';
     }else{
          echo '{"pesan":';
          echo '{"pesanproses":"'."GAGAL".'"';
          echo ',"nomorkantong":"'.$nkt.'"';
          echo ',"jenis":"'.$jenis.'"';
          echo ',"status":"'.$status.'"';
          echo ',"tanggal":"'.$tanggal.'"';
          echo ',"merk":"'.$merk.'"';
          echo ',"volume":"'.$volume.'"';
	  echo ',"keterangan":"'.$keterangan.'"';
          echo '}';
          echo '}';
     }
}

$col4=mysql_query("SELECT `kadaluwarsa_ktg` FROM `stokkantong`");if(!$col4){mysql_query("ALTER TABLE `stokkantong` 
ADD `kadaluwarsa_ktg` DATE NULL AFTER `hasil`,
ADD `nolot_ktg` VARCHAR( 12 ) NULL AFTER `kadaluwarsa_ktg`");}

$col5=mysql_query("SELECT * from stokkantong where kadaluwarsa_ktg is NULL");if($col5){mysql_query("update stokkantong set kadaluwarsa_ktg=(tglterima + interval 2 year) where kadaluwarsa_ktg is NULL ");}

$col3=mysql_query("SELECT * from stokkantong where kadaluwarsa_ktg like '0000%' ");if($col3){mysql_query("update stokkantong set kadaluwarsa_ktg=(tglterima + interval 2 year)  where kadaluwarsa_ktg like '0000%' ");}

$col2=mysql_query("SELECT * from stokkantong where statTempat is NULL");if($col2){mysql_query("update stokkantong set statTempat='0' where statTempat is NULL ");}
     
?>

