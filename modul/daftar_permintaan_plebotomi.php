<?
include ('config/db_connect.php');
switch ($_SESSION[leveluser]){
    case "mobile":
        echo "<br><form method=post action='pmiaftap.php?module=pengambilan_plebotomi'>";
        break;
    case "aftap":
        echo "<br><form method=post action='pmiaftap.php?module=pengambilan_plebotomi'>";
        break;
    case "kasir":
        echo "<br><form method=post action='pmikasir.php?module=pengambilan_plebotomi'>";
        break;
    default:
        echo "Anda tidak memiliki hak akses";
}
?>
<input type=hidden name=todo value=search>
<table class="form" cellspacing=2 cellpadding=2>
    <tr>
        <td>KODE TRANSAKSI</td>
        <td class="input">
            <input type=text name=notransaksi >
        </td>
    </tr>
</table>

<input type=submit value=Submit>||<input type="button" value="Rekap Pasien Plebotomi" onClick="document.location.href='pmiaftap.php?module=laporan_pasien_plebotomi';"></h1><br>
</form>
<?
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,2);
$query = ("SELECT * FROM transaksi_plebotomi where status='0'");
if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM transaksi_plebotomi where notransaksi like '$td0%' and status='0'");
$hasil = mysql_query($query);
?>
<h1 class="table">DAFTAR PERMINTAAN PASIEN PLEBOTOMI YANG BELUM DIAMBIL</h1>
<table class="list" cellspacing=2 cellpadding=3>
    <tr class="field">
        <td> NO. TRANSAKSI </td>
        <td> KODE PASIEN </td>
        <td> NAMA PASIEN </td>
        <td> ALAMAT </td>
        <td> KEL </td>
        <td> GOL </td>
        <td> RHESUS </td>
        <td> JML.PLEBOTOMI </td>
        <td> BATALKAN? </td>
    </tr>
<?
while ($data = mysql_fetch_assoc($hasil))
{
    $data[kodepasien]=str_replace("'","\'",$data[kodepasien]);
    $query1 = mysql_query("SELECT * FROM pasien_plebotomi where kode='$data[kodepasien]'");
    $hasil1 = mysql_fetch_assoc($query1);
    echo "
    <tr class=\"record\">
        <td>".$data['notransaksi']."</td>
        <td>".$hasil1['kode']."</td>
        <td>";
    switch ($_SESSION[leveluser]){
        case "mobile":
           echo "<a href=pmiaftap.php?module=pengambilan_plebotomi&notransaksi=".$data['notransaksi'].">".$hasil1['nama']."</a>";
            break;
        case "aftap":
            echo "<a href=pmiaftap.php?module=pengambilan_plebotomi&notransaksi=".$data['notransaksi'].">".$hasil1['nama']."</a>";
            break;
	 case "kasir":
            echo "<a href=pmiaftap.php?module=pengambilan_plebotomi&notransaksi=".$data['notransaksi'].">".$hasil1['nama']."</a>";
            break;
        case "admin":
            echo "<a href=pmiaftap.php?module=pengambilan_plebotomi&notransaksi=".$data['notransaksi'].">".$hasil1['nama']."</a>";
            break;
        default:
            echo "Anda tidak memiliki hak akses";
    }
    echo "
        </td>
  	<td>".$hasil1['alamat']."</td>
	<td>".$hasil1['kelamin']."</td>
	<td>".$hasil1['golda']."</td>
	<td>".$hasil1['rhesus']."</td>
	<td>".$hasil1['jumlah_plebotomi']."</td>
        <td><a href=modul/del_transaksi_plebotomi.php?notransaksi=".$data['notransaksi'].">Batalkan</a></td>
    </tr>";
}
echo "</table>";
?>
