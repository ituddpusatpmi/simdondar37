<?php
  // script name: get_latest_data.php
  // coder: Sony AK Knowledge Center - www.sony-ak.com
  // code updated on Feb 26, 2010
 
//  $dbConn = mysql_connect('localhost', 'root', 'dewa') or die("Connection to database failed, perhaps the service is down !!");
 // mysql_select_db('pmi') or die("Database name not available !!");
require_once 'config/db_connect.php';
 
  $A = mysql_num_rows(mysql_query("select GolDarah from pendonor where GolDarah='A'")); 
  $B = mysql_num_rows(mysql_query("select GolDarah from pendonor where GolDarah='B'")); 
  $AB = mysql_num_rows(mysql_query("select GolDarah from pendonor where GolDarah='AB'")); 
  $O = mysql_num_rows(mysql_query("select GolDarah from pendonor where GolDarah='O'")); 
  $utd=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));

  $xmlData = "<graph formatNumberScale='0'  bgColor='9CA0A3' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='1000' numdivlines='2' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC'>";
  $xmlData .= "
   <categories font='Arial' fontSize='10' fontColor='000000'>
      <category name='A' hoverText='A'/>
      <category name='B' />
      <category name='O' />
      <category name='AB' />
   </categories>";
  $xmlData .= "
   <dataset seriesname='$utd[nama]' color='00E13C'>
	<set value='$A' />
	<set value='$B' />
	<set value='$O' />
	<set value='$AB' />
     </dataset>";
 
  $xmlData .= "</graph>";
  echo $xmlData;
?>
