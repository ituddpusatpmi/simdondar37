<?
include ('config/db_connect.php');
switch ($_SESSION[leveluser]){
    case "mobile":
        echo "<form method=post action='pmimobile.php?module=checkup'>";
        break;
    case "p2d2s":
        echo "<form method=post action='pmip2d2s.php?module=checkup'>";
        break;
    case "aftap":
        echo "<form method=post action='pmiaftap.php?module=checkup'>";
        break;
    case "kasir":
        echo "<form method=post action='pmikasir.php?module=checkup'>";
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
            <input type=text name=NoTrans1>
        </td>
    </tr>
</table>

<input type=submit value=Submit><br>
</form>
<?
$td=mysql_fetch_assoc(mysql_query("select id1 from tempat_donor where active='1'"));
$query = ("SELECT * FROM htransaksi where Status='0' and NoTrans like '$td[id1]%' and date(Tgl)>=current_date-7 and date(Tgl)<=current_date"); //0=baru, 1=med cheked, 2=aftap
$hasil = mysql_query($query);
?>
<h1 class="table">Data Transaksi Darah</h1>
<table class="list" cellspacing=1 cellpadding=0>
    <tr class="field">
        <td>No Transaksi</td>
        <td>Nama Pendonor</td>
        <td>Kode Pendonor</td>
	<td>Tgl Lahir</td>
	<td>Cara Ambil</td>
        <!--td>Batalkan Transaksi</td-->
    </tr>
<?
while ($data = mysql_fetch_assoc($hasil))
{
	$data[KodePendonor]=str_replace("'","\'",$data[KodePendonor]);
    $query1 = mysql_query("SELECT * FROM pendonor where Kode='$data[KodePendonor]'");
    $hasil1 = mysql_fetch_assoc($query1);
    $apheresis=$hasil1[apheresis];
    if ($data[apheresis]=='1'){
	$apheresis='Apheresis';}
    else{
	$apheresis='Biasa';
    }

    echo "
    <tr class=\"record\">
        <td>".$data['NoTrans']."</td>
        <td>";
    switch ($_SESSION[leveluser]){
        case "mobile":
            echo "<a href=pmimobile.php?module=checkup&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;
	case "p2d2s":
            echo "<a href=pmip2d2s.php?module=checkup&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;
        case "aftap":
            echo "<a href=pmiaftap.php?module=checkup&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;
        case "admin":
            echo "<a href=pmiadmin.php?module=checkup&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;
	case "kasir":
            echo "<a href=pmikasir.php?module=checkup&NoTrans=".$data['NoTrans'].">".$hasil1['Nama']."</a>";
            break;
        default:
            echo "Anda tidak memiliki hak akses";
    }
    echo "
        </td>
        <td>".$hasil1['Kode']."</td>
	<td>".$hasil1['TglLhr']."</td>
	<td>".$apheresis."</td>
	
    </tr>";
}
echo "</table>";
?>
<!--td><a href=pmi".$_SESSION[leveluser].".php?module=delmedical&NoTrans=".$data['NoTrans'].">Batalkan</a></td-->
