<table>
<?php

include "config/library.php";

switch($_GET[act]){
default:

     echo "<tr><td class=judul_head>&#187;Tambah Agenda Kegiatan</td></tr>
          <form method=POST action=?module=entryagenda&act=update enctype='multipart/form-data'>
          <table width=80%>
          <tr><td bgcolor=#ED6161><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Tema</font></td><td bgcolor=#FCC5C5> : <input type=text name='tema' size=50></td></tr>
          <tr><td bgcolor=#ED6161><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Isi Agenda</font></td><td bgcolor=#FCC5C5> : <textarea name='isi_agenda' cols=50 rows=10></textarea></td></tr>
          <tr><td bgcolor=#ED6161><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Tempat</font></td><td bgcolor=#FCC5C5> : <input type=text name='tempat' size=40></td></tr>";

     

  echo  "<tr><td bgcolor=#ED6161><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Tgl Mulai</font></td><td bgcolor=#FCC5C5> : ";
          combotgl(1,31,'tgl_mulai',Tgl);
          combobln(1,12,'bln_mulai',Bulan);
          combotgl($thn_sekarang-2,$thn_sekarang+2,'thn_mulai',Tahun);
 

    echo "<tr><td bgcolor=#ED6161><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Tgl Selesai</td><td bgcolor=#FCC5C5> : ";
          combotgl(1,31,'tgl_selesai',Tgl);
          combobln(1,12,'bln_selesai',Bulan);
          combotgl($thn_sekarang-2,$thn_sekarang+2,'thn_selesai',Tahun);

    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table>
          </form>";
    break;


  }

?>
