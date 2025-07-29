<?php
if (isset($_GET[q])) {
       include ('../config/db_connect.php');
       $q_utd	= mysql_query("select id from utd where aktif='1'");			
       $utd		= mysql_fetch_assoc($q_utd);
       $q		=$_GET["q"];
       $query = "SELECT * FROM pendonor WHERE Kode like '$utd[id]%' and Nama like '%$q%' order by Nama ASC limit 100"; 
       $hasil = mysql_query($query);?>
       <table class="list" cellspacing=0 cellpadding=3 border=1>
	  <tr class="field">
	      <td>Kode</td>
	      <td>Nama Pendonor</td>
	      <td>Kel</td>
	      <td>Gol</td>
	      <td>Tanggal Lahir</td>
	      <td>Alamat</td>
	      <td>Aksi</td>
	      </tr><?	
       while ($data = mysql_fetch_array($hasil)){
	      if($bgcolor=='#f1f1f1'){$bgcolor='#ffffff';}else{$bgcolor='#f1f1f1';}
	      if ($data['Cekal']==0) $cekal="-"; else $cekal="Ya";
	      if ($data['Jk']=="0") $jkel="L"; else $jkel="P";
	      $tgllahir=date("d/m/Y",strtotime($data['TglLhr']));
	      echo "
			  <tr class=\"record\">
					 <td bgcolor=$bgcolor align='left'>" . $data['Kode'] . "</td>
					 <td bgcolor=$bgcolor align='left'>" . $data['Nama'] . "</td>
					 <td bgcolor=$bgcolor align='center'>" . $jkel . "</td>
					 <td bgcolor=$bgcolor align='center'>" . $data['GolDarah'] . "</td>
					 <td bgcolor=$bgcolor align='center'>" . $tgllahir . "</td>
					 <td bgcolor=$bgcolor align='left'>" . $data['Alamat'] . "</td>";
			  ?>
			<td bgcolor=<?=$bgcolor?>> 	
			<a href=pmiadmin.php?module=sejarah&kode=<?=$data[Kode]?>>
			<img src="../images/button_search.png" width=20 height=20/></a>
		</td></tr>
	<?	
	}
	echo "</table>";
}

