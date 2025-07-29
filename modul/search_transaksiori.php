<?
include ('config/db_connect.php');
switch ($_SESSION[leveluser]){
    case "mobile":
        echo "<br><form method=post action='pmimobile.php?module=pengambilan'>";
        break;
     case "p2d2s":
        echo "<br><form method=post action='pmip2d2s.php?module=pengambilan'>";
        break;
    case "aftap":
        echo "<br><form method=post action='pmiaftap.php?module=pengambilan'>";
        break;
   case "kasir":
        echo "<br><form method=post action='pmikasir.php?module=pengambilan'>";
        break;
    default:
        echo "Anda tidak memiliki hak akses";
}
?>
<input type=hidden name=todo value=search>
<table class="form" cellspacing=1 cellpadding=0>
    <tr>
        <td>No Transaksi</td>
        <td class="input">
            <input type=text name=NoTrans >
        </td>
    </tr>
</table>

<input type=submit value=Submit><br>
</form>
<?
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,2);
$query = ("SELECT * FROM htransaksi where Status='1' and jumHB='1'");
if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM htransaksi where NoTrans like '$td0%' and Status='1' and jumHB='1' and date(Tgl)=current_date-7 and date(Tgl)<=current_date");
$hasil = mysql_query($query);
$apheresis=$hasil[apheresis];


?>
<h1 class="table">Data Transaksi Darah test</h1>
<table class="list" cellspacing=1 cellpadding=0>
    <tr class="field">
        <td>No Transaksi</td>
        <td>Nama Pendonor</td>
        <td>Kode Pendonor</td>
	 <td>Tgl Lahir</td>
	<td>Cara Ambil</td>
        <td>Batalkan Transaksi</td>
    </tr>
<?
while ($data = mysql_fetch_assoc($hasil))
{
					if ($data[apheresis]=='1'){$apheresis1='Apheresis';
					}else{$apheresis1='Biasa';}
	$data[KodePendonor]=str_replace("'","\'",$data[KodePendonor]);
    $query1 = mysql_query("SELECT * FROM pendonor where Kode='$data[KodePendonor]'");
    $hasil1 = mysql_fetch_array($query1);
    $apheresisfix=$hasil1['apheresis'];
	
    echo "
    <tr class=\"record\">
        <td>".$data['NoTrans']."</td>
        <td>";
    switch ($_SESSION[leveluser]){
case "mobile":
            echo "<a href=pmimobile.php?module=pengambilan&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;
case "p2d2s":
		if ($data[apheresis]=='1'){
         echo "<a href=pmip2d2s.php?module=pengambilan_apheresis&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>"; 
	}else{
            echo "<a href=pmip2d2s.php?module=pengambilan&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";}
            break;
	
case "aftap":
	if ($data[apheresis]=='1'){
         echo "<a href=pmiaftap.php?module=pengambilan_apheresis&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>"; 
	}else{
	 echo "<a href=pmiaftap.php?module=pengambilan&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";}
	break;

case "admin":
            echo "<a href=pmiadmin.php?module=pengambilan&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;

case "kasir":
	if ($data[apheresis]=='1'){
         echo "<a href=pmikasir.php?module=pengambilan_apheresis&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>"; 
	}else{
	 echo "<a href=pmikasir.php?module=pengambilan&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";}
	break;

        default:
            echo "Anda tidak memiliki hak akses";
    }
    echo "
        </td>
        <td>".$hasil1['Kode']."</td>
	<td>".$hasil1['TglLhr']."</td>
	<td>".$apheresis1."</td>
	<td><a href=pmi".$_SESSION[leveluser].".php?module=deltransaksi&NoTrans=".$data['NoTrans'].">Batalkan</a></td
        
    </tr>";
}
echo "</table>";
?>

