<?php
session_start();
require_once('../config/db_connect.php');

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$qstring = "SELECT Kode as id,NamaBrg as value FROM hstok WHERE NamaBrg LIKE '%".$term."%' and snack='1'";
$result = mysql_query($qstring);//query the database for entries containing the term

while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
{
                $data[] = array(
            'label' => $row['id'] .', '. $row['value'] ,
            'value' => $row['id'] .'; '. $row['value']
        );

	//	$row['value']=htmlentities(stripslashes($row['value']));
         //       $row['id']=(int)$row['id'];
           //     $row_set[] = $row;//build an array
}
echo json_encode($data);//format the array into json data
