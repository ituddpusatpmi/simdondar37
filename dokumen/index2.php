<?php
	include "koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="images/int-redcros.gif" type="image/gif" >
<title>Kontrol Dokumen</title>
<style type="text/css">
		.ui-datepicker {
				font-family:Garamond;
				font-size:12px;
				margin-left:10px
				}
.coper {
	font-family: Cooper Black;
}
</style>
</head>

<body background="images/aa.jpg">
<table align="center" bgcolor="#CCCCCC">
<tr>
	<td>
    <table align="center">
    <tr valign="bottom">
    	<td>
        <img src="images/garis.jpg" height="50" width="900" />
        <img src="images/pmi.png" height="50" width="80" />
        </td>
    </tr>
    </table>
    </td>
</tr>
<tr>
	<td>
    <table align="center">
    <tr>
    	<td><img src="images/aplikasi2.png" /></td>
    </tr>
    </table>
    </td>
</tr>
<tr>
	<td>
    <table align="center">
    <tr>
    	<td><a href="index2.php"><img src="images/home.png" width="140" height="40" /></a></td>
        <td><a href="kebijakan.php"><img src="images/kebijakan.png" width="140" height="40" /></a></td>
        <td><a href="pks.php"><img src="images/pks.png" width="140" height="40" /></a></td>
        <td><a href="ik.php"><img src="images/ik.png" width="140" height="40" /></a></td>
        <td><a href="ika.php"><img src="images/ika.png" width="140" height="40" /></a></td>
        <td><a href="formulir.php"><img src="images/formulir.png" width="140" height="40" /></a></td>
        <td><a href="eksternal.php"><img src="images/eksternal.png" width="140" height="40" /></a></td>
        <td><a href="pendukung.php"><img src="images/pendukung.png" width="140" height="40" /></a></td>
    </tr>
    </table>
    </td>
</tr>
</table>
<p align="center" class="coper"><font size="5"><u>DOKUMEN TERKAIT</u></font></p>
<form method="post" action="exe_index2.php">
<table align="center" border="1" cellpadding="10" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td>
<table align="center">
<tr>
    <td rowspan="9"><div align="center">
      <select name="bidang">
        <option>Bidang</option>
        <option>Pelayanan</option>
        <option>Produksi</option>
        <option>Distribusi</option>
        <option>Sistem Kualitas</option>
        <option>Mobile Unit</option>
        <option>Logistik</option>
        <option>Kepegawaian</option>
        <option>Rumah Tangga</option>
        <option>Sistem Informasi</option>
        <option>Sekretaris</option>
      </select>
    </div></td>
</tr>
<tr>
	<td rowspan="8">&nbsp;</td>
</tr>
<tr>
	<td><div align="center">Judul Dokumen<br />
	    L-1 <select name="nama1">
	      <option></option>
	      <?php
    			$query = "select * from kebijakan order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
        </select>
	</div></td>
    <td rowspan="7">&nbsp;</td>
	<td><div align="center">No. Dokumen<br />
	    L-1 <select name="kontrol1">
	      <option></option>
	      <?php
    			$query = "select * from kebijakan order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
        </select>
	</div></td>
    <td rowspan="7">&nbsp;</td>
    <td><div align="center">Dokumen Terkait<br />
        L-1 <select name="terkait1">
          <option></option>
          <?php
    			$query = "select * from kebijakan order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
        </select>
	</div></td>
    <td rowspan="7">&nbsp;</td>
    <td rowspan="7"><input type="submit" value="+" /></td>
</tr>
<tr>
	<td><div align="center">
	    PKS <select name="nama2">
	      <option></option>
	      <?php
    			$query = "select * from pks order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
        </select>
	</div></td>
	<td><div align="center">
	    PKS <select name="kontrol2">
	      <option></option>
	      <?php
    			$query = "select * from pks order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
        </select>
	</div></td>
    <td><div align="center">
        PKS <select name="terkait2">
          <option></option>
          <?php
    			$query = "select * from pks order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
        </select>
	</div></td>
</tr>
<tr>
	<td><div align="center">
	  IKA <select name="nama3">
	    <option></option>
	    <?php
    			$query = "select * from ika order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
	    </select>
	  </div></td>
        <td><div align="center">
          IKA <select name="kontrol3">
            <option></option>
            <?php
    			$query = "select * from ika order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
          </select>
    </div></td>
    <td><div align="center">
      IKA <select name="terkait3">
        <option></option>
        <?php
    			$query = "select * from ika order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
      </select>
    </div></td>
</tr>
<tr>
	<td><div align="center">
	  IK <select name="nama4">
	    <option></option>
	    <?php
    			$query = "select * from ik order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
	    </select>
	  </div></td>
        <td><div align="center">
          IK <select name="kontrol4">
            <option></option>
            <?php
    			$query = "select * from ik order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
          </select>
    </div></td>
    <td><div align="center">
      IK <select name="terkait4">
        <option></option>
        <?php
    			$query = "select * from ik order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
      </select>
    </div></td>
</tr>
<tr>
	<td><div align="center">
	  L-3 <select name="nama5">
	    <option></option>
	    <?php
    			$query = "select * from formulir order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
	    </select>
	  </div></td>
        <td><div align="center">
          L-3 <select name="kontrol5">
            <option></option>
            <?php
    			$query = "select * from formulir order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
          </select>
    </div></td>
    <td><div align="center">
      L-3 <select name="terkait5">
        <option></option>
        <?php
    			$query = "select * from formulir order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
      </select>
    </div></td>
</tr>
<tr>
	<td><div align="center">
	  L-4 <select name="nama6">
	    <option></option>
	    <?php
    			$query = "select * from eksternal order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
	    </select>
	  </div></td>
        <td><div align="center">
          L-4 <select name="kontrol6">
            <option></option>
            <?php
    			$query = "select * from eksternal order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
          </select>
    </div></td>
    <td><div align="center">
      L-4 <select name="terkait6">
        <option></option>
        <?php
    			$query = "select * from eksternal order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
      </select>
    </div></td>
</tr>
<tr>
	<td><div align="center">
	  L-5 <select name="nama7">
	    <option></option>
	    <?php
    			$query = "select * from pendukung order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama1]</option>";
    			}
			?>
	    </select>
	  </div></td>
        <td><div align="center">
          L-5 <select name="kontrol7">
            <option></option>
            <?php
    			$query = "select * from pendukung order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
          </select>
    </div></td>
    <td><div align="center">
      L-5 <select name="terkait7">
        <option></option>
        <?php
    			$query = "select * from pendukung order by right(kontrol,3)";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[kontrol]</option>";
    			}
			?>
      </select>
    </div></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<br />
<table align="center" border="1" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
<tr class="coper">
	<td><div align="center">No.</div></td>
    <td><div align="center">Bidang</div></td>
    <td><div align="center">Judul Dokumen</div></td>
    <td><div align="center">No. Kontrol Dokumen</div></td>
    <td><div align="center">Dokumen Terkait</div></td>
    <td><div align="center">Aksi</div></td>
</tr>
<?php
	$donor = "select * from kontrol order by bidang";
	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
<tr>
	<td><div align="center"><?php echo $nourut; ?></div></td>
    <td><div align="center"><?php echo $data['bidang']; ?></div></td>
    <td><div align="center"><?php echo $data['nama1']; ?><?php echo $data['nama2']; ?><?php echo $data['nama3']; ?><?php echo $data['nama4']; ?><?php echo $data['nama5']; ?><?php echo $data['nama6']; ?><?php echo $data['nama7']; ?></div></td>
    <td><div align="center"><?php echo $data['kontrol1']; ?><?php echo $data['kontrol2']; ?><?php echo $data['kontrol3']; ?><?php echo $data['kontrol4']; ?><?php echo $data['kontrol5']; ?><?php echo $data['kontrol6']; ?><?php echo $data['kontrol7']; ?></div></td>
    <td><div align="center"><?php echo $data['terkait1']; ?><?php echo $data['terkait2']; ?><?php echo $data['terkait3']; ?><?php echo $data['terkait4']; ?><?php echo $data['terkait5']; ?><?php echo $data['terkait6']; ?><?php echo $data['terkait7']; ?></div></td>
	<td><a href="detail_terkait.php?detail=<?php echo $data['nomor']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_terkait.php?hapus=<?php echo $data['nomor']; ?>"><img src="images/hapus.png"></img></a></td>
</tr>
 <?php
		}
		?>
</table>
<br />
</body>
</html>
