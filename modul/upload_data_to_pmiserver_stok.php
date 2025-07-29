<?
include('clogin.php');
include('config/db_connect.php');
$no=0;
$produk=mysql_query("select * from produk order by no",$con);
while ($produk1=mysql_fetch_assoc($produk)) {
    $no++;
    $namaproduk[$no]=$produk1[Nama];
    $namalengkap[$no]=$produk1[lengkap];
    
    $A=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='A' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date "));
    $sosA=mysql_query("select sosA from produk where Nama='$produk1[Nama]'");
    $sos1A=mysql_fetch_assoc($sosA);
    $Ap[$no]= $A-$sos1A[sosA]; if ($Ap[$no]<1) $Ap[$no]='0';
    
    $B=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='B' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date "));
    $sosB=mysql_query("select sosB from produk where Nama='$produk1[Nama]'");
    $sos1B=mysql_fetch_assoc($sosB);
    $Bp[$no]= $B-$sos1B[sosB]; if ($Bp[$no]<1) $Bp[$no]='0';
    
    $AB=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='AB' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date "));
    $sosAB=mysql_query("select sosAB from produk where Nama='$produk1[Nama]'");
    $sos1AB=mysql_fetch_assoc($sosAB);
    $ABp[$no]= $AB-$sos1AB[sosAB]; if ($ABp[$no]<1) $ABp[$no]='0';
    
    $O=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='O' and RhesusDrh='+'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $sosO=mysql_query("select sosO from produk where Nama='$produk1[Nama]'");
    $sos1O=mysql_fetch_assoc($sosO);
    $Op[$no]= $O-$sos1O[sosO]; if ($Op[$no]<1) $Op[$no]='0';
    
    $A=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='A' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $An[$no]=$A;  if ($An[$no]<1) $An[$no]='0';
    $B=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='B' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $Bn[$no]=$B;  if ($Bn[$no]<1) $Bn[$no]='0';
    $AB=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='AB' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
    $ABn[$no]=$AB;  if ($ABn[$no]<1) $ABn[$no]='0';
    $O=mysql_num_rows(mysql_query("select Status from stokkantong where (produk='$produk1[Nama]' and Status='2' and gol_darah='O' and RhesusDrh='-'  and (stat2='0' or stat2 is null)) and sah='1' and statKonfirmasi='1' and kadaluwarsa > current_date"));
    $On[$no]=$O;  if ($On[$no]<1) $On[$no]='0';
}   
?>
