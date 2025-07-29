<?php
  // script name: get_latest_data.php
  // coder: Sony AK Knowledge Center - www.sony-ak.com
  // code updated on Feb 26, 2010
include 'config/db_connect.php'; 
 
$nama_udd=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'")); 

  $A = mysql_fetch_assoc(mysql_query("select count(NoKantong)  as st1 from stokkantong where status='1' and kadaluwarsa > current_date and sah='1' and gol_darah='A' ")); 
  $B = mysql_fetch_assoc(mysql_query("select count(NoKantong)  as st1 from stokkantong where status='1' and kadaluwarsa > current_date and sah='1' and gol_darah='B' ")); 
  $AB = mysql_fetch_assoc(mysql_query("select count(NoKantong)  as st1 from stokkantong where status='1' and kadaluwarsa > current_date and sah='1' and gol_darah='AB' ")); 
  $O = mysql_fetch_assoc(mysql_query("select count(NoKantong)  as st1 from stokkantong where status='1' and kadaluwarsa > current_date and sah='1' and gol_darah='O' "));
/*
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='A' )as st1"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='B' )as st1"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='AB' )as st1"));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='O' )as st1"));
*/
$stok=mysql_query("update stok set wb_a='$A',wb_b='$B',wb_ab='$AB',wb_o='$O' where status='1'");

 
$propinsi=substr($_GET[udd],0,2);
  $A_propinsi = mysql_fetch_assoc(mysql_query("select 20*wb_a  as st1 from stok where status='1'")); 
  $B_propinsi = mysql_fetch_assoc(mysql_query("select 20*wb_b  as st1 from stok where status='1'")); 
  $AB_propinsi = mysql_fetch_assoc(mysql_query("select 20*wb_ab  as st1 from stok where status='1'")); 
  $O_propinsi = mysql_fetch_assoc(mysql_query("select 20*wb_o  as st1 from stok where status='1'")); 

  $A_nasional = mysql_fetch_assoc(mysql_query("select 150*wb_a  as st1 from stok where status='1'")); 
  $B_nasional = mysql_fetch_assoc(mysql_query("select 150*wb_b  as st1 from stok where status='1'")); 
  $AB_nasional = mysql_fetch_assoc(mysql_query("select 150*wb_ab  as st1 from stok where status='1'")); 
  $O_nasional = mysql_fetch_assoc(mysql_query("select 150*wb_o  as st1 from stok where status='1'")); 

  $xmlData = "<graph bgColor='EEE8DC' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='1000' numdivlines='2' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC'>";
  $xmlData .= "
   <categories font='Arial' fontSize='10' fontColor='000000'>
      <category name='A' hoverText='A'/>
      <category name='B' />
      <category name='O' />
      <category name='AB' />
   </categories>";
/*
  $xmlData .= "
    <dataset seriesname='Nasional' color='F20000'>
	<set value='$A_nasional[st1]' />
	<set value='$B_nasional[st1]' />
	<set value='$AB_nasional[st1]' />
	<set value='$O_nasional[st1]' />
     </dataset>";
  $xmlData .= "
   <dataset seriesname='Provinsi' color='FFF6445'>
	<set value='$A_propinsi[st1]' />
	<set value='$B_propinsi[st1]' />
	<set value='$AB_propinsi[st1]' />
	<set value='$O_propinsi[st1]' />
     </dataset>";
*/
  $xmlData .= "
   <dataset seriesname='$nama_udd[nama]' color='FF6445'>
	<set value='$A[st1]' />
	<set value='$B[st1]' />
	<set value='$O[st1]' />
	<set value='$AB[st1]' />
     </dataset>";
  $xmlData .= "</graph>";
  echo $xmlData;
?>
