<?
include('config/db_connect.php');
$sqlpendonor=mysql_query("SELECT Jk, GolDarah, Rhesus, count(Kode) As jumlah From pendonor group by JK, GolDarah, Rhesus",$con);

while ($sqlpendonor1=mysql_fetch_assoc($sqlpendonor)) {
    switch ($sqlpendonor1[Jk]){
	case '0':
		switch ($sqlpendonor1[GolDarah]){
		    case 'A': if ($sqlpendonor1[Rhesus]=='+'){$lk_Apos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$lk_Aneg=$sqlpendonor1[jumlah];}
			      break;
		    case 'AB':if ($sqlpendonor1[Rhesus]=='+'){$lk_ABpos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$lk_ABneg=$sqlpendonor1[jumlah];}
			      break;
		    case 'B': if ($sqlpendonor1[Rhesus]=='+'){$lk_Bpos=$sqlpendonor1[jumlah];}
		              if ($sqlpendonor1[Rhesus]=='-'){$lk_Bneg=$sqlpendonor1[jumlah];}
			      break;
		    case 'O': if ($sqlpendonor1[Rhesus]=='+'){$lk_Opos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$lk_Oneg=$sqlpendonor1[jumlah];}
			      break;
		}
	case '1':
		switch ($sqlpendonor1[GolDarah]){
		    case 'A': if ($sqlpendonor1[Rhesus]=='+'){$pr_Apos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$pr_Aneg=$sqlpendonor1[jumlah];}
			      break;
		    case 'AB':if ($sqlpendonor1[Rhesus]=='+'){$pr_ABpos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$pr_ABneg=$sqlpendonor1[jumlah];}
			      break;
		    case 'B': if ($sqlpendonor1[Rhesus]=='+'){$pr_Bpos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$pr_Bneg=$sqlpendonor1[jumlah];}
			      break;
		    case 'O': if ($sqlpendonor1[Rhesus]=='+'){$pr_Opos=$sqlpendonor1[jumlah];}
			      if ($sqlpendonor1[Rhesus]=='-'){$pr_Oneg=$sqlpendonor1[jumlah];}
		}
    }

}
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor<10", $con));$Jum1=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=10 and JumDonor<25", $con));$Jum10=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=25 and JumDonor<50", $con));$Jum25=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=50 and JumDonor<75", $con));$Jum50=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=75 and JumDonor<100", $con));$Jum75=$jum[jumlah];
$jum=mysql_fetch_assoc(mysql_query("select count(Kode) as jumlah from pendonor where JumDonor>=100", $con));$Jum100=$jum[jumlah];
$squmur=mysql_fetch_assoc(mysql_query("SELECT  SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) <30,1,0)) as 'umur17_30',SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) BETWEEN 31 and 40,1,0)) as 'umur31_40',
    SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) BETWEEN 41 and 50,1,0)) as 'umur41_50',SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) BETWEEN 51 and 60,1,0)) as 'umur51_60',
    SUM(IF((FLOOR((TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25)) >60,1,0)) as 'umur60_lebih'FROM pendonor",$con));
$umur17_30 =$squmur[umur17_30];$umur31_40 =$squmur[umur31_40];$umur41_50 =$squmur[umur41_50];$umur51_60 =$squmur[umur51_60];$umur60_lebih =$squmur[umur60_lebih];
?>
