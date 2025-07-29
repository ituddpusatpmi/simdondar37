<?php
  //require_once('adm/config.php');
  
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

  if(@$_GET['page'] == '' || @$_GET['page'] == 'index' )
  {
  include "view/index.php";
}
else if(@$_GET['page'] == 'loginrs' )
  {
  include "view/loginrs.php";
} else if (@$_GET['page'] == 'login'){
    include "view/login.php";
} else if (@$_GET['page'] == 'dash'){
    include "view/dashboard.php";
} else if (@$_GET['page'] == 'donor'){
    include "view/donordarah.php";
} else if (@$_GET['page'] == 'cetak'){
    include "view/formdonor.php";
} else if (@$_GET['page'] == 'apipdlokal'){
    include "api/apipendonorlokal.php";
} else if (@$_GET['page'] == 'logout'){
  include "view/logout.php";
}
  ?>
