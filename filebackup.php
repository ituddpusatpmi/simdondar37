<?php
function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    $size = filesize($file);
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
    }
?>

<?php
echo "<table>
             <tr><td>Ukuran</td>";
                            if (!empty($r[nama_file])){
                            $file = "/media/server/PMISOLO1/$r[nama_file]";                            
                            echo "<td>: ". fsize($file)."</td></tr>";
                            }else{
                                echo "<td>: </td></tr>";
                            }
echo "</table>";
?>
