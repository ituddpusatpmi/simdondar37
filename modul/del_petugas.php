<?php
include ('../config/db_connect.php');
  $no=$_GET[NoTrans];
  $petugas=$_GET[petugas];
  $q=mysql_query("delete from `petugasmu` WHERE `NoTrans` = '$no' AND nama like '$petugas%'");

echo ("Data Jadwal MU telah diedit !!
<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=pmip2d2s.php?module=data_jadwal_mobile&aksi=edit&id=$_GET[NoTrans]\">");
	
?> 


