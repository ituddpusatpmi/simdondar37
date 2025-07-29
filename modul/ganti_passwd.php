<table>
<?php
switch($_GET[act]){
  // Tampil User
  default:
        echo "<tr><td class=judul_head >&#187;Atur User</td></tr>
          <table>
          <tr><td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>No</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Nama Lengkap</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Email</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Level</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Aksi</font></td></tr>";
    $tampil=mysql_query("SELECT * from user where user.id_user not in ('superadmin') ORDER BY id_user ");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
                if($bgcolor=='#f1f1f1'){$bgcolor='#ffffff';}
                else{$bgcolor='#f1f1f1';}
       echo "<tr><td bgcolor=$bgcolor>$no</td>
             <td bgcolor=$bgcolor>$r[id_user]</td>
             <td bgcolor=$bgcolor>$r[nama_lengkap]</td><td><a href=mailto:$r[email]>$r[email]</a></td><td bgcolor=$bgcolor>$r[level]</td>
             <td bgcolor=$bgcolor><a href=?module=aturuser&act=edituser&id=$r[id_user]>Edit</a> |
                       <a href=./aksi.php?module=aturuser&act=hapus&id=$r[id_user]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    echo" <form method=POST action='?module=aturuser&act=tambahuser'>
          <input type=submit value='Tambah User'></form>";
    break;

  case "tambahuser":
     echo "<tr><td class=judul_head>&#187;Tambah User</td></tr>
          <form method=POST action='./aksi.php?module=aturuser&act=input'>
          <table>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>     
              <td bgcolor=#FCC5C5>:<input type=text name='id_user'></td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Password</font></td>
              <td bgcolor=#FCC5C5>:<input type=password name='password'></td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Nama Lengkap</font></td> 
              <td bgcolor=#FCC5C5>:<input type=text name='nama_lengkap' size=30></td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Level User </font></td>  
              <td bgcolor=#FCC5C5>:<select name='leveluser'>
          <option value=0 selected>- Pilih level user -</option>";       
            $tampil=mysql_query("SELECT * FROM level");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[level]>$r[level]</option>";
            }
          echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>E-mail</font></td>
              <td bgcolor=#FCC5C5>:<input type=text name='email' size=30></td></tr>";
          echo "<tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

      echo "<tr><td class=judul_head>&#187;Edit User</td></tr>
          <form method=POST action=./aksi_user.php?module=ganti_passwd&act=update>
          <input type=hidden name=id value='$r[id_user]'>
          <table>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>     
              <td bgcolor=#FCC5C5>: $r[id_user]</td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Password</font></td>     
              <td bgcolor=#FCC5C5>:<input type=password name='password'> *) </td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Nama Lengkap</font></td> 
              <td bgcolor=#FCC5C5>:<input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>";
        echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>E-mail</font></td>
                 <td bgcolor=#FCC5C5>:<input type=text name='email' size=30 value='$r[email]'></td></tr>";
        echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>No. HP</font></td>
                 <td bgcolor=#FCC5C5>:<input type=text name='telp' size=30 value='$r[telp]'></td></tr>";
           echo"<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
           <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
