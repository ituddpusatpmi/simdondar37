<?php
include 'config/db_connect.php';
  $date = date('d-m-Y H:i:s', time()-3600);
  $jum_a=0;
  $jum_b=0;
  $jum_ab=0;
  $jum_o=0;
  
?>
<font size="3" color="red" face="Trebuchet MS"><b>INFORMASI STOK DARAH</b><BR></font>
<font size="1" color="black" face="Trebuchet MS"><b>Update : <?=$date?> WITA</b></font>
<div id="content">
    <table border=0 cellpadding=2 cellspacing=1 width=490px>
      <tr bgcolor=#ED6161>
	  <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>PRODUK DARAH (KOMPONEN DARAH)</b></font></td>
	  <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>A</b></font></td>
	  <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>B</b></font></td>
	  <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>AB</b></font></td>
	  <td align=center><font size="2" color="#ffffff" face="Trebuchet MS"><b>O</b></font></td>
      </tr>
    <?

    $produk=mysql_query("select * from produk order by no");
    while ($produk1=mysql_fetch_assoc($produk)) {
      $A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
      $sosA=mysql_query("select sosA from produk where Nama='$produk1[Nama]'");
      $sos1A=mysql_fetch_assoc($sosA);
      
      $B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
      $sosB=mysql_query("select sosB from produk where Nama='$produk1[Nama]'");
      $sos1B=mysql_fetch_assoc($sosB);
      
      $AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
      $sosAB=mysql_query("select sosAB from produk where Nama='$produk1[Nama]'");
      $sos1AB=mysql_fetch_assoc($sosAB);
      
      $O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
      $sosO=mysql_query("select sosO from produk where Nama='$produk1[Nama]'");
      $sos1O=mysql_fetch_assoc($sosO);
      
      $A=$A-$sos1A[sosA];
      $B=$B-$sos1B[sosB];
      $AB=$AB-$sos1AB[sosAB];
      $O=$O-$sos1O[sosO];

      if ($A<1) $A='0';
      if ($B<1) $B='0';
      if ($AB<1) $AB='0';
      if ($O<1) $O='0';
      
      $jum_a=$jum_a+$A;	
      $jum_b=$jum_b+$B;
      $jum_ab=$jum_ab+$AB;
      $jum_o=$jum_o+$O;

      
      echo "<tr bgcolor=#FCC5C5>
		<td align=left><font size=2 face='Trebuchet MS'>$produk1[lengkap]</font></td>
		<td align=right><font size=2 face='Trebuchet MS'>$A</font></td>
		<td align=right><font size=2 face='Trebuchet MS'>$B</font></td>
		<td align=right><font size=2 face='Trebuchet MS'>$AB</font></td>
		<td align=right><font size=2 face='Trebuchet MS'>$O</font></td>
	</tr>";}
	echo "<tr bgcolor=#ED6161>
		<td align=center><font size=2 color=#ffffff face='Trebuchet MS'><b>JUMLAH</b></font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_a</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_b</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_ab</font></td>
		<td align=right><font size=2 color=#ffffff face='Trebuchet MS'>$jum_o</font></td>
	</tr>";
	?>
  </table>
<font size="1" color="black" face="Trebuchet MS">Data real time dari Sistem Informasi UDD PMI Provinsi Bali</font>
</div>
