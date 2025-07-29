<?php
$host="localhost";  
$user="root"; 
$password="F201603907"; 
$database="wagw"; 
 
$conn=mysql_connect($host,$user,$password); 
$select_db = mysql_select_db($database, $conn);

if($conn !== false && $select_db !== false) {  //cek conn 
//echo "OKE"; 
}else{ 
    echo "DB Connection Fail !!  : ".mysql_error();
    exit();
}  
?>
