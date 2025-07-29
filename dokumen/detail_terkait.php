<?php
	include "koneksi.php";
	include "index.php";
	
	$detail = $_GET['detail'];
	
	$sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<br />
<form method="post" action="edit_terkait.php">
<table align="center" border="1" cellpadding="10" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td>
<table align="center">
<tr>
    <td rowspan="5"><div align="center">
      <select name="bidang">
        <option><?php echo $data['bidang']; ?></option>
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
      </select><text style="display:none"><input type="text" name="nomor" value="<?php echo $data['nomor']; ?>" /></text>
    </div></td>
</tr>
<tr>
	<td rowspan="5">&nbsp;</td>
</tr>
<tr>
	<td><div align="center">Judul Dokumen<br />
	    PKS <select name="nama1">
	      <option><?php echo $data['nama1']; ?></option>
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
    <td rowspan="5">&nbsp;</td>
    <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
	<td><div align="center">No. Dokumen<br />
	    PKS <select name="kontrol1">
	      <option><?php echo $data['kontrol1']; ?></option>
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
    <td rowspan="5">&nbsp;</td>
     <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td><div align="center">Dokumen Terkait<br />
        PKS <select name="terkait1">
          <option><?php echo $data['terkait1']; ?></option>
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
    <td rowspan="5">&nbsp;</td>
    <td rowspan="4"><input type="submit" value="+" /></td>
</tr>
<tr>
	 <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
	<td><div align="center">
	  IKA <select name="nama2">
	    <option><?php echo $data['nama2']; ?></option>
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
       <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
        <td><div align="center">
          IKA <select name="kontrol2">
            <option><?php echo $data['kontrol2']; ?></option>
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
     <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td><div align="center">
      IKA <select name="terkait2">
        <option><?php echo $data['terkait2']; ?></option>
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
     <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
	  IK <select name="nama3">
	    <option><?php echo $data['nama3']; ?></option>
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
       <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
        <td><div align="center">
          IK <select name="kontrol3">
            <option><?php echo $data['kontrol3']; ?></option>
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
     <?php
    $sql="select * from kontrol where nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
      IK <select name="terkait3">
        <option><?php echo $data['terkait3']; ?></option>
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
</table>
</td>
</tr>
</table>
</form>
</body>
</html>