<?php
  // script name: get_latest_data.php
  // coder: Sony AK Knowledge Center - www.sony-ak.com
  // code updated on Feb 26, 2010
include 'config/db_connect.php'; 
 
$nama_udd=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'")); 
  //Jumlah stok yang ditampilkan adalah jumlah total stok darah sehat dikurangi stok emergency 
  $A=mysql_fetch_assoc(mysql_query("select GREATEST((SELECT count(status)-(select sum(sosA) from produk)
				   from stokkantong where status='2' and gol_darah='A' and (length(produk)>0) and kadaluwarsa > current_date and
				   (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'), 0)  as st1"));
  $B=mysql_fetch_assoc(mysql_query("select GREATEST((SELECT count(status)-(select sum(sosB) from produk)
				   from stokkantong where status='2' and gol_darah='B' and (length(produk)>0) and kadaluwarsa > current_date and
				   (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'), 0)  as st1"));
  $AB=mysql_fetch_assoc(mysql_query("select GREATEST((SELECT count(status)-(select sum(sosAB) from produk)
				   from stokkantong where status='2' and gol_darah='AB' and (length(produk)>0) and kadaluwarsa > current_date and
				   (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'), 0)  as st1"));
  $O=mysql_fetch_assoc(mysql_query("select GREATEST((SELECT count(status)-(select sum(sosO) from produk)
				   from stokkantong where status='2' and gol_darah='O' and (length(produk)>0) and kadaluwarsa > current_date and
				   (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'), 0)  as st1"));

$propinsi=substr($_GET[udd],0,2);
  $A_propinsi = mysql_fetch_assoc(mysql_query("select 20*sum(wb_a+prc_a+tc_a+lp_a+fp_a)  as st1 from stok where status='1'")); 
  $B_propinsi = mysql_fetch_assoc(mysql_query("select 20*sum(wb_b+prc_b+tc_b+lp_b+fp_b)  as st1 from stok where status='1'")); 
  $AB_propinsi = mysql_fetch_assoc(mysql_query("select 20*sum(wb_ab+prc_ab+tc_ab+lp_ab+fp_ab)  as st1 from stok where status='1'")); 
  $O_propinsi = mysql_fetch_assoc(mysql_query("select 20*sum(wb_o+prc_o+tc_o+lp_o+fp_o)  as st1 from stok where status='1'")); 

  $A_nasional = mysql_fetch_assoc(mysql_query("select 150*sum(wb_a+prc_a+tc_a+lp_a+fp_a)  as st1 from stok where status='1'")); 
  $B_nasional = mysql_fetch_assoc(mysql_query("select 150*sum(wb_b+prc_b+tc_b+lp_b+fp_b)  as st1 from stok where status='1'")); 
  $AB_nasional = mysql_fetch_assoc(mysql_query("select 150*sum(wb_ab+prc_ab+tc_ab+lp_ab+fp_ab)  as st1 from stok where status='1'")); 
  $O_nasional = mysql_fetch_assoc(mysql_query("select 150*sum(wb_o+prc_o+tc_o+lp_o+fp_o)  as st1 from stok where status='1'")); 

  $xmlData = "<graph formatNumberScale='0' bgColor='EEE8DC' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' numdivlines='2' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC'>";
  $xmlData .= "
   <categories font='Arial' fontSize='10' fontColor='000000'>
      <category name='A' hoverText='Gol A'/>
      <category name='B' hoverText='Gol B'/>
      <category name='O' hoverText='Gol O'/>	
      <category name='AB' hoverText='Gol AB' />
   </categories>";

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
