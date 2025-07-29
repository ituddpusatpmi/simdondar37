<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<h1 class="list">CHECK PULSA DAN RESTART GAMMU</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Pilih Operator</td>
					<td class="input">
						 <select name="piagam">
							  <option value="0">INDOSAT</option>
							  <option value="1">TELKOMSEL</option>
							  <option value="2">XL</option>
							  <option value="4">3(BimaTri)</option>
							  <option value="3">HALO</option>
							  
                                                         
					</td>
	<td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
if (isset($_POST[submit])){
        $piagam 	= $_POST[piagam];
	        switch ($piagam){
                       	case "0":
				
// jalankan perintah cek pulsa via gammu
echo "Check Pulsa Indosat, ini akan restart gammu ";
exec('sudo /etc/init.d/gammu-smsd stop');
sleep(1);
echo "<br>Hasil cek Pulsa Indosat Anda adalah:<br><b>";
exec('sudo /usr/bin/gammu getussd *555*1#', $hasil);

sleep(1);
// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   //if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
   echo $hasil[$i++];echo "<br></b>";
}
// menampilkan sisa pulsa
//echo $hasil[$index];
echo "</b>";
exec('sudo /etc/init.d/gammu-smsd restart');
			break;
                        case "1":
				// jalankan perintah cek pulsa via gammu
echo "Check Pulsa Simpati, ini akan restart gammu";
exec('sudo /etc/init.d/gammu-smsd stop');
sleep(1);
echo "<br>Hasil cek Pulsa Telkomsel Anda adalah:<br><b>";
exec('sudo /usr/bin/gammu getussd *888#', $hasil);

sleep(1);
// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   //if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
   echo $hasil[$i++];echo "<br></b>";
}
// menampilkan sisa pulsa
//echo $hasil[$index];
echo "</b>";
exec('sudo /etc/init.d/gammu-smsd restart');
			break;
                     	case "2":
				// jalankan perintah cek pulsa via gammu
echo "Check Pulsa XL, ini akan restart gammu";
exec('sudo /etc/init.d/gammu-smsd stop');
sleep(1);
echo "<br>Hasil cek Pulsa XL Anda adalah:<br><b>";
exec('sudo /usr/bin/gammu getussd *123#', $hasil);

sleep(1);
// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   //if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
   echo $hasil[$i++];echo "<br></b>";
}
// menampilkan sisa pulsa
//echo $hasil[$index];
echo "</b>";
exec('sudo /etc/init.d/gammu-smsd restart');
			break;
			case "3":
				// jalankan perintah cek pulsa via gammu
echo "Check Pemakaian HALO, ini akan restart gammu";
exec('sudo /etc/init.d/gammu-smsd stop');
sleep(1);
echo "<br>Hasil cek pemakaian HALO Anda adalah:<br><b>";
exec('sudo /usr/bin/gammu getussd *888#', $hasil);

sleep(1);
// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   //if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
   echo $hasil[$i++];echo "<br></b>";
}
// menampilkan sisa pulsa
//echo $hasil[$index];
echo "</b>";
exec('sudo /etc/init.d/gammu-smsd restart');
			break;
			case "4":
				// jalankan perintah cek pulsa via gammu
echo "Check Pulsa 3(BimaTri), ini akan restart gammu";
exec('sudo /etc/init.d/gammu-smsd stop');
sleep(1);
echo "<br>Hasil cek kartu 3(BimaTri) Anda adalah:<br><b>";
exec('sudo /usr/bin/gammu getussd *111*1#', $hasil);

sleep(1);
// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   //if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
   echo $hasil[$i++];echo "<br></b>";
}
// menampilkan sisa pulsa
//echo $hasil[$index];
echo "</b>";
exec('sudo /etc/init.d/gammu-smsd restart');
			break;
                           
		}

?>

<?
}
?>
<!--?php
// jalankan perintah cek pulsa via gammu
echo "Check Pulsa, ini mau stop gammu dulu ya";
exec('sudo /etc/init.d/gammu-smsd stop');
sleep(1);
echo "<br>Sekarang jalankan perintah check pulsa<br><b>";
exec('sudo /usr/bin/gammu getussd *555#', $hasil);

sleep(1);
// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   //if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
   echo $hasil[$i++];echo "<br></b>";
}
// menampilkan sisa pulsa
//echo $hasil[$index];
echo "</b>";
exec('sudo /etc/init.d/gammu-smsd restart');
?>

