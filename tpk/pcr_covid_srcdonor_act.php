<?php
if (isset($_GET['q'])) {
    include ('../config/dbi_connect.php');
	$q	=$_GET["q"];
    $sql =mysqli_query($dbi,"SELECT p.`Kode`, p.`Nama`, p.`Alamat`, p.`telp2`, case when p.`Jk`='0' THEN 'LK' ELSE 'PR' END AS `Kelamin`, p.`GolDarah`,p.`Rhesus`,p.`TglLhr`, max(c.`pcr_tglperiksa`) as `swab_terakhir`, c.`pcr_hasil` FROM `pendonor` p left join `covid_pcr` `c` on c.`pcr_pendonor`=p.`Kode` WHERE p.`Kode` like '%$q%' or p.Nama like '%$q%'  group by p.`Kode` limit 1000"); 
	echo '
    <table class="list" cellspacing=0 cellpadding=4 border=1>
	  <tr class="field" style="height:40px;">
	      <td>Kode</td>
	      <td>Nama</td>
		  <td>Kel</td>
	      <td>Gol</td>
	      <td>Tgl Lahir</td>
	      <td>Alamat</td>
		  <td>Swab Terakhir</td>
		  </tr>';
       while ($data = mysqli_fetch_array($sql)){
	      if($bgcolor=='#f1f1f1'){$bgcolor='#ffffff';}else{$bgcolor='#f1f1f1';}
	      echo "
	      	<tr class=\"record\">
		 		<td bgcolor=$bgcolor align='left'>" . $data['Kode'] . "</td>
		 		<td bgcolor=$bgcolor align='left'><a href='pmikasir.php?module=swab1&kode=".$data['Kode']."'>" . $data['Nama'] . "</a></td>
          	 	<td bgcolor=$bgcolor align='center'>" . $data['Kelamin'] . "</td>
		 		<td bgcolor=$bgcolor align='center'>" . $data['GolDarah'].$data['Rhesus']. "</td>
		 		<td bgcolor=$bgcolor align='center'>" . $data['TglLhr'] . "</td>
				<td bgcolor=$bgcolor align='left'>" . $data['Alamat'] . "</td>
				<td bgcolor=$bgcolor align='left'>" . $data['swab_terakhir'].'  '.$data['pcr_hasil']."</td>
			</tr>";
	}
	echo "</table>";
}

