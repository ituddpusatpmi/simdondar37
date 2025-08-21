<?php
include ('db.php');

$antri = mysqli_query($dbi,"SELECT * from antrian where tgl=curdate() AND stat is null AND panggil=1 order by nomor DESC limit 1");
if (mysqli_num_rows($antri) > 0){
    $data = mysqli_fetch_assoc($antri);
    ?>
    <table width=100%>
        <tr>
        
            <td align="center" style="margin-top:10px;font-size:20px;text-align:center;font-weight:bold;text-shadow: 3px 3px 5px #000000;" width=50%>NOMOR ANTRIAN : <br>
            <font style="color:white;font-size:150px;"><?php echo $data['nomor'];?></font><br>
            <?php echo strtoupper($data['nama']);?>
            </td>
            <td align="center"><?php echo "<img src='../foto/".$data['pendonor'].".jpg' width='320' >";?><br>
            </td>
        </tr>
    </table>
    <?php
    /*$data = mysqli_fetch_assoc($antri);
    echo "NOMOR : ".$data['nomor']."<br>";
    echo "NAMA  : ".$data['nama']."<br>";
    echo "<img src=../foto/".$data['pendonor'].".jpg />";*/
} else {?>
    <table width=100%>
        <tr>
        
            <td align="center" style="margin-top:10px;font-size:20px;text-align:center;font-weight:bold;text-shadow: 3px 3px 5px #000000;" width=50%>NOMOR ANTRIAN : <br>
            -
            </td>
        </tr>
    </table>
    <?php
}


//mysqli_close();
?>