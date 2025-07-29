<table>
<?php

include "config/library.php";

switch($_GET[act]){
default:

       echo "<tr><td class=judul_head>&#187;Atur Agenda</td></tr>
             <table>";
         ?>
          <form method=POST action=?module=tambahagenda&act=tambah enctype='multipart/form-data'>
         <?php
        echo "<table>
       
            <tr><td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>No.</font></td>
<td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Agenda</font></td>
<td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Tgl. Posting</font></td>
<td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>aksi</font></td></tr>";

      $tampil = mysql_query(" select tema,date_format(tgl_posting,'%d-%m-%Y') as tgl_posting,id_agenda from agenda");
       $no =1;
        while($rx=mysql_fetch_array($tampil)){
                if($bgcolor=='#f1f1f1'){$bgcolor='#ffffff';}
                else{$bgcolor='#f1f1f1';}
        echo "<tr><td bgcolor=$bgcolor>$no</td>
                <td bgcolor=$bgcolor>$rx[tema]</td>
                <td bgcolor=$bgcolor>$rx[tgl_posting]</td>
               <td bgcolor=$bgcolor><a href=?module=agendaedit&act=editlap&id=$rx[id_agenda]>Edit</a> |
               <a href=?module=agendahapus&act=hapuslap&id=$rx[id_agenda]>Hapus</a></td>
               </tr>";
        $no++;
        }
         echo"<table>";
         echo" <input type=submit value='Tambah Agenda'> ";

  }
  echo "</table>";
?>
