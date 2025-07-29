        <?
require_once('config/db_connect.php');
//include ('clogin.php');
            $rs="select * from detailinstansi";
echo '{"instansi": [';
$n=0;
                $do=mysql_query($rs);
$ninstansi=mysql_num_rows($do);
                  while($data=mysql_fetch_assoc($do))
            {
$n++;
$kode=$data['KodeDetail'];
$nama=$data['nama'];
echo '
{
"kode":"'.$kode.'",
"nama":"'.$nama.'"';
if ($n<$ninstansi) { echo '},';} else { echo '}'; }
}
echo ']}';
?>
