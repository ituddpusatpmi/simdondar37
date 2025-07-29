<table>
<?php
    include "config/koneksi.php";
 

    $nm=$_GET["id"];
    $ps=$_GET["pass"];
    $new=$_POST["password"];
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$nm' AND password='$ps'");
    $r=mysql_fetch_array($edit);

      echo "<center><tr><td class=judul_head>&#187;Update Password</td></tr><br>
          <form method=POST action=aksi_user.php?id=$nm&pass=$new>
          <input type=hidden name=id value='$r[id_user]'>
          <table>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>     
              <td bgcolor=#FCC5C5>: $nm</td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Password</font></td>     
              <td bgcolor=#FCC5C5>:<input type=password name='password'> *) </td></tr>
           <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

?>
