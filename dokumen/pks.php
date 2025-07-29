<?php
	include "koneksi.php";
	//include "index.php";
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
	font-size:12px;
	margin:auto;
	width:100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<style> 
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 100%;
}
</style>
<style>
.button {
  padding: 10px 20px;
  font-size: 12px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #ff5a0b;
  border: none;
  border-radius: 8px;
  box-shadow: 0 5px #999;
}

.button1 {
  padding: 10px 20px;
  font-size: 12px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #ff0000;
  border: none;
  border-radius: 8px;
  box-shadow: 0 5px #999;
}


.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 3px #666;
  transform: translateY(3px);
}
</style>

</head>
<body>
<br />
<input id="myInput" type="text" placeholder="Search..">
<br><br>
<a href="input_pks.php"><button class="button">Tambah Dokumen</button></a>
<a href="rekap_musnah_pks.php"><button class="button1">Daftar Pemusnahan Dokumen</button></a>
<br><br>
<p align="center"><b> Dokumen SPO (L2)</b></p>
<table>
  <thead>
    <tr>
      	<th rowspan="2">No</th>
    	<th rowspan="2">Bidang</th>
    	<th rowspan="2">Judul Dokumen</th>
    	<th rowspan="2" style="width:10px">Identitas Dokumen Sebelumnya</th>
    	<th rowspan="2" style="width:10px">Tingkat Dokumen</th>
    	<th rowspan="2">No. Kontrol Dokumen</th>
    	<th rowspan="2" style="width:10px">Periode Kaji Ulang (bln)</th>
    	<th rowspan="2" style="width:10px">No. Versi</th>
    	<th rowspan="2">Tanggal Disahkan</th>
    	<th rowspan="2">Tanggal Berlaku</th>
    	<th rowspan="2">Tanggal Kaji Ulang</th>
	<th rowspan="2">File</th>
	<th colspan="3">Keterangan Masa Aktif Dokumen</th>
	<th rowspan="2">Pengeluaran Dokumen</th>
	<th rowspan="2">Peninjauan Kembali Dokumen</th>
	<th rowspan="2">Pemusnahan Dokumen</th>
    </tr>
    
	<tr>
	<th>Masih Berlaku</th>
	<th>Peninjauan Kembali</th>
	<th>Habis Masa Kadaluwarsa</th>
	</tr>
  	</thead>
  <tbody id="myTable">
    <?php
	$donor = "select * from pks where aktif='0' order by kontrol2";
	$proses = mysql_query($donor);

	// awal Konversi tanggal ke bahasa indonesia
	function format_indo($date){
    	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    	$tahun = substr($date, 0, 4);               
    	$bulan = substr($date, 5, 2);
    	$tgl   = substr($date, 8, 2);
    	$result = $tgl . " " . $BulanIndo[(int)$bulan-1]. " ". $tahun;
    	return($result);
	}
	// akhir Konversi tanggal ke bahasa indonesia

	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;

	// CEK huruf terkahir dari nomor kontrol
	$resultNoKontrol = substr($data['kontrol2'], -1 , 1) !== "-" ? $data['kontrol2'] : substr($data['kontrol2'], 0 , -1);

	//awal penanda dokumen
	$today=date('Y-m-d');
	if ($data['tgl_peninjauan']>="$today") $pengerjaan1='<span style="background-color:#3e8e41">Masih Berlaku</span>';
	if ($data['tgl_peninjauan']<="$today") $pengerjaan1='<span>-</span>';
	if ($data['tgl_peninjauan']=="$today") $pengerjaan1='<span>-</span>';

	if ($data['tgl_peninjauan']<="$today") $pengerjaan2='<span style="background-color:#B22222"><font style="color:white">Habis Masa Berlaku</font></span>';
	if ($data['tgl_peninjauan']>="$today") $pengerjaan2='<span>-</span>';
	if ($data['tgl_peninjauan']=="$today") $pengerjaan2='<span>-</span>';

	
	if ($data['tgl_notif']>="$today") $pengerjaan3='<span">-</span>';	
	if ($data['tgl_notif']<="$today") $pengerjaan3='<span style="background-color:yellow">Waktunya Peninjauan Kembali</span>';
	if ($data['tgl_notif']=="$today") $pengerjaan3='<span style="background-color:yellow">Waktunya Peninjauan Kembali</span>';
	
	//akhir penanda dokumen

	?>
        <tr>
        	<td><div align="center"><?php echo $nourut; ?></div></td>
            <td><div align="left"><?php echo $data['bidang']; ?></div></td>
            <td><div align="left"><a href="detail_pks2.php?detail=<?php echo $data['nama1']; ?>"><button class="button"><?php echo $data['nama1']; ?></button></a></div></td>
            <td><div align="center"><?php echo $data['nama2']; ?></div></td>
            <td><div align="center"><?php echo $data['tingkat']; ?></div></td>
            <td><div align="center"><?php echo $resultNoKontrol; ?></div></td>
            <td><div align="center"><?php echo $data['periode']; ?></div></td>
            <td><div align="center"><?php echo $data['no_versi']; ?></div></td>
            <td><div align="center"><?php echo format_indo($data['tgl_setuju']); ?></div></td>
            <td><div align="center"><?php echo format_indo($data['tgl_pelaksanaan']); ?></div></td>
            <td><div align="center"><?php echo format_indo($data['tgl_peninjauan']); ?></div></td>
	    <td><a href="download.php?filename=<?=$data['fileku']?>"><?php echo $data['fileku']; ?></a></td>
	    <td><div align="center"><?php echo $pengerjaan1; ?></div></td>
	    <td><div align="center"><?php echo $pengerjaan3; ?></div></td> 
	    <td><div align="center"><?php echo $pengerjaan2; ?></div></td> 
            <td><a href="keluar_pks.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/clip.png" width="30" height="30"></img>
	    </a></td>
            <td><a href="detail_pks.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/revisi.png" width="30" height="30"></img></a></td>
	    <td><a href="musnah_pks.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/musnah.png" width="30" height="30"></img></a></td>
	   
</tr>
	    
  <?php
		}
		?>
  </tbody>
</table>
<br><br>
</body>
</html>
