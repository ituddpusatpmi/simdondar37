<?php
            //UPLOAD FOTO
            $kodep  = $_GET['id'];
            $nama_file = $kodep.'.jpg';
            $direktori = '../foto/';
            $target = $direktori.$nama_file;
            move_uploaded_file($_FILES['webcam']['tmp_name'], $target);
            //UPLOAD
            mysqli_close()
?>
