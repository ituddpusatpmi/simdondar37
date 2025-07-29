<?
/*mysql_query("ALTER TABLE `user` CHANGE `multi` `multi` VARCHAR( 300 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ");
mysql_query("ALTER TABLE `htransaksi` CHANGE `notrans` `NoTrans` VARCHAR( 25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '-'");
mysql_query("ALTER TABLE `user` CHANGE `level` `level` ENUM( 'admin', 'kasir', 'mobile', 'laboratorium', 'logistik', 'aftap', 'keuangan', 'pimpinan', 'bdrs', 'p2d2s', 'komponen', 'konfirmasi', 'imltd', 'konseling', 'kasir2', 'qa','qc','tatausaha' ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'admin'");*/

$level=mysql_query("select `qc` from level");
if (!$level) {
    mysql_query(" TRUNCATE TABLE `level`");
    mysql_query("INSERT INTO `pmi`.`level` (`level`) VALUES ('admin'),( 'kasir'),( 'mobile'),( 'laboratorium'),( 'logistik'),( 'aftap'),( 'keuangan'),( 'pimpinan'),( 'bdrs'),( 'p2d2s'),( 'komponen'),( 'qa'),('qc'),( 'konfirmasi'),( 'imltd'),( 'konseling'),( 'kasir2'), ( 'tatausaha') ");
}
function hitungHari($awal,$akhir){
    $tglAwal = strtotime($awal);
    $tglAkhir = strtotime($akhir);
    $jeda = abs($tglAkhir - $tglAwal);
    return floor($jeda/(60*60*24));
}
?>
<table>
<?php
switch($_GET[act]){
  // Tampil User
  default:
        echo "<tr><td class=judul_head ><h2>&#187;Atur User</h2></td></tr>
          <table>
          <tr><td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>No</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Nama Lengkap</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Email</font></td>
	      <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Telp/HP</font></td>
	      <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Level</font></td>
	      <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Bagian</font></td>
	      <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Jabatan</font></td>
          <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Aksi</font></td>
	      <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Login</font></td>
	      <td bgcolor=#ED6161 align=center><strong><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Umur<br>Password</font></font></td></tr>
	  ";
    $tampil=mysql_query("SELECT * from user where `user`.`id_user` not in ('superadmin') and `aktif`='0' ORDER BY id_user ");
    $tgl_skr = date('Y-m-d');
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
        if($bgcolor=='#f1f1f1'){$bgcolor='#fffff';} else{$bgcolor='#f1f1f1';}
	    $jmllogin=mysql_query("select count(id) as jml from datalogin where username1='$r[id_user]'");
	    $j=mysql_fetch_assoc($jmllogin);
        $tgl_pwd  = $r['tglpwd'];
        if ($tgl_pwd==null){$tgl_pwd='0000-00-00';}
        $pwd_day = hitungHari($tgl_pwd,$tgl_skr);
       echo "<tr>
             <td nowrap bgcolor=$bgcolor align=right><font size=2>$no.</td>
             <td nowrap bgcolor=$bgcolor><strong><font color=#ED6161 size=2><a href=?module=aturuser&act=edituser&id=$r[id_user]>$r[id_user]</td>
             <td nowrap bgcolor=$bgcolor><font size=2>$r[nama_lengkap]</td>
	         <td nowrap bgcolor=$bgcolor><font size=2><a href=mailto:$r[email]>$r[email]</a></td>
	         <td nowrap bgcolor=$bgcolor><font size=2>$r[telp]</td>
	         <td nowrap bgcolor=$bgcolor><font size=2>$r[level]</td>
	         <td nowrap bgcolor=$bgcolor><font size=2>$r[bagian]</td>
	         <td nowrap bgcolor=$bgcolor><font size=2>$r[jabatan]</td>
             <td nowrap bgcolor=$bgcolor><font size=2><a href=?module=aturuser&act=edituser&id=$r[id_user]>Edit</a> |
				  <a href=../pmiadmin.php?module=sms_manual&nomortelp=$r[telp]>Kirim SMS</a></td>
	         <td nowrap align=right bgcolor=$bgcolor><font size=2><align=right>$j[jml]</td>
	         <td nowrap align=right bgcolor=$bgcolor><font size=2><align=right>$pwd_day</td>
	    </tr>";
      $no++;
    }
    echo "</table>";
    echo" <form method=POST action='?module=aturuser&act=tambahuser'>
          <input type=submit value='Tambah User'></form>";
    break;

  case "tambahuser":
     echo "<tr><td class=judul_head><h2>&#187;Tambah User</h2></td></tr>
          <form method=POST action='./aksi.php?module=aturuser&act=input'>
          <table>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>     
              <td bgcolor=#FCC5C5>:<input type='text' name='id_user'></td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Password</font></td>
              <td bgcolor=#FCC5C5>:<input type='password' name='password'></td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Nama Lengkap</font></td> 
              <td bgcolor=#FCC5C5>:<input type='text' name='nama_lengkap' size=30></td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Level User </font></td>  
              <td bgcolor=#FCC5C5>:<select name='leveluser'>
          <option value=0 selected>- Pilih level user -</option>";       
            $tampil=mysql_query("SELECT * FROM level");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[level]>$r[level]</option>";
            }
          echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>E-mail</font></td>
              <td bgcolor=#FCC5C5>:<input type=text name='email' size=30></td></tr>";
	  echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Telp/HP</font></td>
              <td bgcolor=#FCC5C5>:<input type=text name='telp' size=30></td></tr>";
	  echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Bagian</font></td>
              <td bgcolor=#FCC5C5>:<input type=text name='bagian' size=30></td></tr>";
	  echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Jabatan</font></td>
              <td bgcolor=#FCC5C5>:<input type=text name='jabatan' size=30></td></tr>";    
	      
          echo "<tr><td colspan=2><input type=submit value=Simpan>
                <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_assoc($edit);
?>
      <tr><td class=judul_head><h2>&#187;Edit User</h2></td></tr>
          <form method=POST action=./aksi.php?module=aturuser&act=update>
          <input type='hidden' name='id' value=<?=$r[id_user]?>>
          <table>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Username</font></td>     
              <td bgcolor=#FCC5C5><input type=text name='id_user' value="<?=$r[id_user]?>"</td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Password</font></td>     
              <td bgcolor=#FCC5C5><input type='password' name='password'> *) </td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Nama Lengkap</font></td> 
              <td bgcolor=#FCC5C5><input type="text" name='nama_lengkap' size="30"  value="<?=$r[nama_lengkap]?>"</td></tr>
          <tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Level User</font></td>  
              <td bgcolor=#FCC5C5><select name='leveluser'>
          <option value=0 selected>-Pilih level user-</option>
	    <?
		$level0[0]='p2d2s';
		$level0[1]='logistik';	
		$level0[2]='kasir';
		$level0[3]='aftap';
		$level0[4]='mobile';
		$level0[5]='konfirmasi';
		$level0[6]='imltd';
		$level0[7]='komponen';
		$level0[8]='qc';
		$level0[9]='qa';
		$level0[10]='kasir2';		
		$level0[11]='laboratorium';
        $level0[12]='pimpinan';
		$level0[13]='konseling';
		$level0[14]='admin';
		$level0[15]='tatausaha';	
           $tampil=mysql_query("SELECT * FROM level");
           while($w=mysql_fetch_array($tampil)){
                 if ($r[level]==$w[level]){
                echo "<option value=$w[level] selected>$w[level]</option>";
                     }
                else{
                echo "<option value=$w[level]>$w[level]</option>";
                }
             }
		$level1=explode(",",$r[multi]);
		for ($j=0;$j<sizeof($level1);$j++) {
			for ($i=0;$i<sizeof($level0);$i++) {
				if ($level1[$j]==$level0[$i]) $level[$i]='checked';
			}}
        echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana>Multi level</font></td>
      <td bgcolor=#FCC5C5>
	<input type=checkbox name='multilevel[0]' value='p2d2s' 		$level[0]>P2D2S	
	<input type=checkbox name='multilevel[1]' value='logistik' 		$level[1]>Logistik      	
	<input type=checkbox name='multilevel[2]' value='kasir' 		$level[2]>Admin Donor
	<input type=checkbox name='multilevel[3]' value='aftap' 		$level[3]>Aftap
	<input type=checkbox name='multilevel[4]' value='mobile' 		$level[4]>Mobile Unit<br>
	<input type=checkbox name='multilevel[5]' value='konfirmasi' 		$level[5]>Konfirmasi GOLDAR
	<input type=checkbox name='multilevel[6]' value='imltd' 		$level[6]>IMLTD
	<input type=checkbox name='multilevel[7]' value='komponen' 		$level[7]>Komponen
	<input type=checkbox name='multilevel[8]' value='qc'	 		$level[8]>QC
	<input type=checkbox name='multilevel[9]' value='qa'	 		$level[9]>QA
	<input type=checkbox name='multilevel[10]' value='kasir2' 		$level[10]>Admin Pasien<br>
  	<input type=checkbox name='multilevel[11]' value='laboratorium' 		$level[11]>Crossmatch
   	<input type=checkbox name='multilevel[12]' value='pimpinan' 		$level[12]>Pimpinan
   	<input type=checkbox name='multilevel[13]' value='konseling' 		$level[13]>Konseling
	<input type=checkbox name='multilevel[14]' value='admin' 		$level[14]>Administrator
	<input type=checkbox name='multilevel[15]' value='tatausaha' 		$level[15]>Tata Usaha
	
	
	
      	
      </td></tr>"; 
	    echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>E-mail</font></td>
                 <td bgcolor=#FCC5C5><input type=text name='email' size=30 value='$r[email]'></td></tr>";
	    echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Telp/HP</font></td>
                 <td bgcolor=#FCC5C5><input type=text name='telp' size=30 value='$r[telp]'></td></tr>";
	    echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Bagian</font></td>
                 <td bgcolor=#FCC5C5><input type=text name='bagian' size=30 value='$r[bagian]'></td></tr>";
	    echo"<tr><td bgcolor=#ED6161><font color=#ffffff size=2 face=Verdana, Arial, Helvetica, sans-serif>Jabatan</font></td>
                 <td bgcolor=#FCC5C5><input type=text name='jabatan' size=30 value='$r[jabatan]'></td></tr>";
		 
           echo"<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
           <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>



