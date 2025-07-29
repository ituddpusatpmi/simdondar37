<?php
include "koneksi.php";

if(isset($_POST['id'])){
  $id = $_POST['id'];

  mysqli_query($koneksi, "DELETE from events where id='$id') ");
}
