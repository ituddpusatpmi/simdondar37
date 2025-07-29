<?php
    session_start();
    include ('../config/dbi_connect.php');
    $notrans    = $_GET['trans'];
    $asal       = $_GET['asal'];
    
    $hapus  = mysqli_query($dbi,"update htransaksi set pengambilan='1',ketBatal='Permintaan Pendonor',petugas='$petugas', status_test='2',`Status`='2' where NoTrans='$notrans'");
    $hapus2 = mysqli_query($dbi,"UPDATE antrian set stat='1' where transaksi='$notrans'");
    
    if ($hapus){?>
        <div class="row">
            <div class="col-lg-12 col-lg-offset-3">
                <div class="alert alert-success alert-dismissable" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <strong>Data Aftap</strong> Berhasil Entry
                </div>
            </div>
        </div>
        <?php
        if ($asal == "both"){?>
            <META http-equiv="refresh" content="2; url=antripengambilan.php"><?php
        } elseif ($asal == "kiri"){?>
            <META http-equiv="refresh" content="2; url=antriankiri.php"><?php
        } elseif ($asal == "kanan"){?>
            <META http-equiv="refresh" content="2; url=antriankanan.php"><?php
        }
    }
?>
