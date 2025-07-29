<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php
  include('clogin.php');
  include('config/dbi_connect.php');
  $hariini = date("Y-m-d");
  if (isset($_POST['submit'])){
    $tanggal1 = $_POST['waktu'];
    $tanggal2 = $_POST['waktu1'];
    $user = $_POST['namauser'];
  }else{
    $tanggal1 = $hariini;
    $tanggal2 = $hariini;
    $user = "";
  }
?>
<body style="margin:30px">
  <div class="w3-container w3-red w3-card-2">
    <h2>DATA LOGIN SIMDONDAR</h2>
  </div>
  <form name="cari" method="POST" action="" class="w3-containner w3-card-2">
    <table class="w3-table-all">
      <tr>
        <td>Tanggal : </td>
        <td><input name="waktu" id="datepicker" value="<?php echo htmlspecialchars($tanggal1); ?>" type="text"></td>
        <td> Sampai Dengan</td>
        <td><input name="waktu1" id="datepicker1" value="<?php echo htmlspecialchars($tanggal2); ?>" type="text"></td>
        <td> Nama User </td>
        <td><input name="namauser" type="text" value="<?php echo htmlspecialchars($user); ?>"></td>
        <td> <input type="submit" name="submit" value="Submit" class="w3-btn w3-blue w3-hover-yellow"></td>
      </tr>
    </table>
  </form>
  <table class="w3-table-all w3-container">
    <tr class="w3-red">
      <td>NO.</td>
      <td>TGL.IN</td>
      <td>JAM IN</td>
      <td>NAMA USER</td>
      <td>KOMPUTER IP</td>
      <td>STATUS</td>
      <td>TGL.OUT</td>
      <td>JAM OUT</td>
    </tr>
    <?php
    $sql = "SELECT 
              DATE_FORMAT(datalogin.waktu, '%H:%i') as jam, 
              DATE_FORMAT(datalogin.waktu, '%d/%m/%Y') as tgl,
              datalogin.username1, datalogin.ip, 
              CASE datalogin.KompName WHEN 'Login Gagal' THEN 'LOGIN GAGAL' ELSE 'Sukses' END as statuslogin,
              DATE_FORMAT(datalogin.logout, '%H:%i') as jam_out,
              DATE_FORMAT(datalogin.logout, '%d/%m/%Y') as tgl_out
            FROM datalogin 
            WHERE 
              (DATE(datalogin.waktu) BETWEEN '$tanggal1' AND '$tanggal2')
              AND datalogin.username1 LIKE '%$user%'
            ORDER BY datalogin.waktu ASC";
    
    $query = mysqli_query($dbi,$sql);
    if (!$query) {
        die('Query Error: ' . mysqli_error($dbi));
    }
    
    $no = 0;
    while ($row = mysqli_fetch_assoc($query)) {
        $no++;
        echo '<tr>';
        echo '<td>' . $no . '</td>';
        echo '<td>' . htmlspecialchars($row['tgl']) . '</td>';
        echo '<td>' . htmlspecialchars($row['jam']) . '</td>';
        echo '<td>' . htmlspecialchars($row['username1']) . '</td>';
        echo '<td>' . htmlspecialchars($row['ip']) . '</td>';
        echo '<td>' . htmlspecialchars($row['statuslogin']) . '</td>';
        echo '<td>' . htmlspecialchars($row['tgl_out']) . '</td>';
        echo '<td>' . htmlspecialchars($row['jam_out']) . '</td>';
        echo '</tr>';
    }
    ?>
  </table>
</body>
