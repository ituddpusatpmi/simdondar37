<?php 
  $res="";
  $parameter=$_GET['param'];
  include('../config/dbi_connect.php');
  switch($parameter){
      case "1" : $q_param="SELECT DISTINCT `b_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `b_lot_reag`";break;
      case "2" : $q_param="SELECT DISTINCT `c_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `c_lot_reag`";break;
      case "3" : $q_param="SELECT DISTINCT `i_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `i_lot_reag`";break;
      case "4" : $q_param="SELECT DISTINCT `s_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `s_lot_reag`";break;
  }
  $lot=mysqli_query($dbi,$q_param);
  while ($rsl=mysqli_fetch_assoc($lot)){
      $res .= '<option value="'.$rsl['nolot'].'">'.$rsl['nolot'].'</option>';
  }
  echo $res;
?>
