<?php

    include '../adm/config.php';
    
    // cari dan tampilkan data ke AutoComplete
    $searchTerm = $_GET['term'];
    $query = $db->query("select * from utd where nama like '%".$searchTerm."%' ORDER BY nama ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = array(
                        'label' => $row['nama'] .', '. $row['id'] ,
                        'value' => $row['id']
                    );
    }
    echo json_encode($data);


