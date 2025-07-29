<?php
require_once('../config/koneksi.php');
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='kosongkan'){
	$sql=mysql_query("TRUNCATE TABLE `imltd_import_temp`");
	if ($ql){
		echo '{"result":';
		echo '{"sukses":"Gagal mengosongkan table import hasil imltd!!"';
		echo '}';
		echo '}';
	} else {
		echo '{"result":';
		echo '{"sukses":"Hasil import sementara Biomerieux DaVinci Quatro sudah dikosongkan."';
		echo '}';
		echo '}';
	}
}

if($op=='cek_kantong'){
	$no_kantong=$_GET['nomorkantong'];
	$sql=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$no_kantong'"));
	echo '{"pesan":';
     echo '{"nokantong":"'.$sql[noKantong].'"';
     echo ',"status":"'.$sql[Status].'"';
     echo ',"jenis":"'.$sql[jenis].'"';
     echo ',"produk":"'.$sql[produk].'"';
     echo ',"sah":"'.$sql[sah].'"';
     echo ',"konfirmasi":"'.$sql[statKonfirmasi].'"';
     echo ',"volume":"'.$sql[volume].'"';
     echo '}';
     echo '}';
}

if($op=='cek'){
     $tanggalinput 	= $_GET['tanggal'];
     $nomorlot		= $_GET['nolot'];
     $nomorlot      = mysql_real_escape_string($nomorlot);
     $tanggalinput  = substr($tanggalinput,2,2).substr($tanggalinput,5,2).substr($tanggalinput,8,2);
     $nobag = $tanggalinput.$nomorlot;

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
     $jenis         = $_GET['jns'];
     for ($i=0; $i<$jenis; $i++) {
          $nokantong     = $_GET['nokantong'];
          $tanggal       = $_GET['tgl'];
          $status        = "0";
          $volume        = $_GET['vol'];
          $merk          = $_GET['merk'];
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
               			stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,volumeasal) 
                              values ('$nkt','$jenis','$status','$tanggal','$volume','$merk','$volume')");
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
          echo '}';
          echo '}';
     }
}?>

