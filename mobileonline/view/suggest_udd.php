<?php

    include '../adm/config.php';
    
    $term = trim(strip_tags($_GET['term']));
     //query untuk menampilkan data dari tabel country
    $query = mysqli_query($con,"select * from utd where nama like '%".$searchTerm."%' ORDER BY nama ASC");

     $array=array();
     //looping data
     while($data=mysqli_fetch_assoc($query)){
         $data[] = array(
                         'label' => $row['nama'] .', '. $row['id'] ,
                         'value' => $row['id']
                     );
      //buat array yang nantinya akan di konversi ke json
         //array_push($array, $row);
        }

     //mengubah data object menjadi data json
     echo json_encode($array);
    ?>
