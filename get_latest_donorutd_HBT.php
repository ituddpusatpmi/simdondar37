<?php
require_once 'config/db_connect.php';
$array_bulan 	= array(1=>'Jan','Feb','Mar', 'Apr', 'Mei', 'Jun','Jul','Ags','Sep','Okt', 'Nop','Des');
$hari1		= date("dmy"); 
$bulan1		= date("my"); 
$tahun1		= date("y"); 
$tahun11	= date("Y");
$time 		= strtotime("-1 year", time());
$time1		= strtotime("-1 month", time());
$tahun00 	= date("Y", $time);
$bulan00 	= date("n", $time1);
$bulan10	= $array_bulan[$bulan00];
$bulan11	= $array_bulan[date("n")]; 
$hari11		= date("j").' '.$bulan11;

$hari 		= mysql_num_rows(mysql_query("select NoTrans from htransaksi where pengambilan='0' and date(`Tgl`)=date(current_date)")); 
$bulan 		= mysql_num_rows(mysql_query("select NoTrans from htransaksi where pengambilan='0' and year( `Tgl` ) = year( current_date ) AND month( `Tgl` ) = month( current_date )")); 
$bulansbl 	= mysql_num_rows(mysql_query("select NoTrans from htransaksi where pengambilan='0' and year( `Tgl` ) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND month( `Tgl` ) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)")); 
$tahun 		= mysql_num_rows(mysql_query("select NoTrans from htransaksi where pengambilan='0' and year( `Tgl` ) = year( current_date )")); 
$tahunsbl 	= mysql_num_rows(mysql_query("select NoTrans from htransaksi where pengambilan='0' and year( `Tgl` ) = year( current_date )-1")); 
$utd		= mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));

  $xmlData = "<graph formatNumberScale='0'  bgColor='9CA0A3' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='1000' numdivlines='2' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC'>";
  $xmlData .= "
   <categories font='Arial' fontSize='10' fontColor='000000'>
      <category name='$tahun00' hoverText='Tahun $tahun00' />	
      <category name='$tahun11' hoverText='Tahun $tahun11' />
      <category name='$bulan10' hoverText='$bulan10' />
      <category name='$bulan11' hoverText='Bulan $bulan11'/>
      <category name='Hari Ini' hoverText='$hari11'/>
   </categories>";

  $xmlData .= "
   <dataset seriesname='$utd[nama]' color='F20000'>
        <set value='$tahunsbl' />
	<set value='$tahun' />
	<set value='$bulansbl' />
	<set value='$bulan' />
	<set value='$hari' />
     </dataset>";
  $xmlData .= "</graph>";
  echo $xmlData;
?>
