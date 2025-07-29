<?php
  require_once('adm/config.php');


  if(@$_GET['page'] == '' || @$_GET['page'] == 'index' )
  {
  include "view/index.php";
}
else if(@$_GET['page'] == 'loginrs' )
  {
  include "view/loginrs.php";
  } else if (@$_GET['page'] == 'login'){
      include "view/login.php";
  } else if (@$_GET['page'] == 'rs'){
      include "rs/index.php";
  } else if (@$_GET['page'] == 'addminta'){
      include "rs/addminta.php";
  } else if (@$_GET['page'] == 'frontantri'){
      include "api/front_antrian.php";
  } else if (@$_GET['page'] == 'apiminta'){
      include "api/apiminta.php";
  } else if (@$_GET['page'] == 'pasienonly'){
      include "view/pasienpmi.php";
  } else if (@$_GET['page'] == 'hasilsampel'){
      include "api/hasil_sampel.php";
  } else if (@$_GET['page'] == 'apisampel'){
      include "api/apisampel.php";
  } else if (@$_GET['page'] == 'sampeldnr'){
      include "view/sampeldonor.php";
  } else if (@$_GET['page'] == 'index2'){
      include "view/index2.php";
  } else if (@$_GET['page'] == 'apimintapk'){
      include "api/apiantripk.php";
  } else if (@$_GET['page'] == 'frontmintapk'){
      include "api/frontmintapk.php";
  } else if (@$_GET['page'] == 'frontmintapkgol'){
      include "api/frontmintapkgol.php";
  } else if (@$_GET['page'] == 'apimintapkgol'){
      include "api/apiantripkgolA.php";
  } else if (@$_GET['page'] == 'apimintapkgolb'){
      include "api/apiantripkgolB.php";
  } else if (@$_GET['page'] == 'apimintapkgolo'){
      include "api/apiantripkgolO.php";
  } else if (@$_GET['page'] == 'apimintapkgolab'){
      include "api/apiantripkgolAB.php";
  }
    ?>
