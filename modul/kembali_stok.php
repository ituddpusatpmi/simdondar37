<style type="text/css">
<!--
@import url("topstyle.css");

ALTER TABLE `kembalititipan` ADD `ket` INT( 1 ) NOT NULL DEFAULT '0' COMMENT '0:Titip 1:Incom 2:bdrs'
-->
</style>
<?
$namauser=$_SESSION[namauser];
$today=date("Y-m-d H:i:s");
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
include ('clogin.php');
include ('config/db_connect.php');
//echo $_SESSION[namauser];
if (isset($_POST['Button'])) {
if ($_POST[NoKantong]) {
$hasil=mysql_query("select noKantong from dtransaksipermintaan where noKantong='$_POST[NoKantong]' and status='1' and stat3='tidak' ");
$hasil1=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$_POST[NoKantong]' "));
$nhasil=mysql_num_rows($hasil);
$kembali=mysql_query("insert into kembalititipan (	noKantong,Status,volume,produk,gol_darah,RhesusDrh,tgl_Aftap,
							kadaluwarsa,tglpengolahan)
						   	select noKantong,Status,volume,produk,gol_darah,RhesusDrh,tgl_Aftap,
							kadaluwarsa,tglpengolahan
						   	from stokkantong where noKantong='$_POST[NoKantong]'");
$kembali1=mysql_query("update kembalititipan set tgl_kembali='$today', user='$namauser',ket='1' where noKantong='$_POST[NoKantong]'");
if ($nhasil==1) {
$keluarkan=mysql_query("update stokkantong set Status='2',hasil='2',sah='1',stat2='0',tgl_keluar=NULL where noKantong='$_POST[NoKantong]'");
$keluarkan1=mysql_query("update dtransaksipermintaan set Status='B' where NoKantong='$_POST[NoKantong]'");
//$hapuskirimbdrs=mysql_query("update kirimbdrs SET status='1' , petugas='$namauser' , tglkembali='$today' where nokantong='$_POST[NoKantong]'");
//$hapuskirimudd=mysql_query("update kirimudd SET status='1' , petugas='$namauser' , tglkembali='$today' where nokantong='$_POST[NoKantong]'");

} else {
echo "HANYA DARAH INCOMPATIBLE YANG BISA DIPROSES DISINI";
echo "<META http-equiv='refresh' content='3; url='<?echo $PHPSELF;?>";
}
}
if ($keluarkan) {
echo "<BR>Darah Sudah diubah Statusnya<BR>";
echo "<META http-equiv='refresh' content='0; url='<?echo $PHPSELF;?>";
}
} else {
//$hasil=mysql_query("select dt.NoKantong as,sk. from dtransaksipermintaan as dt,stokkantong as sk where (datediff('$today',sk.tgl_Aftap)<35 and sk.Status='3' and dt.Status='1' and dt.Nokantong=sk.NoKantong)");
/*
$hasil=mysql_query("SELECT dtransaksipermintaan.NoKantong as dtn, 
			stokkantong.tgl_aftap as sktgl
		FROM dtransaksipermintaan,stokkantong 
		WHERE (datediff('$today',stokkantong.tgl_Aftap)<35 
			AND stokkantong.Status='3' 
			AND dtransaksipermintaan.Status='1' 
			AND dtransaksipermintaan.Nokantong=stokkantong.NoKantong)");
$hasil=mysql_query("select * from stokkantong where datediff('$today',tgl_Aftap)<35 and Status='3' and
			NoKantong in (select NoKantong from dtransaksipermintaan where Status='1' and 
			NoForm in (select NoForm from dtranspermintaan where datediff('$today',TglPerlu)>2))");
*/
//$hasil=mysql_query("select st.NoKantong as dtn,st.gol_darah,dt.NoForm,concat(DATE_FORMAT(tgl,'%e '),' ',ELT( MONTH(tgl), 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),' ',DATE_FORMAT(tgl,' %Y')) as tgll from stokkantong as st,dtransaksipermintaan as dt where st.Status='3' and dt.Status='1'  and st.NoKantong=dt.NoKantong order by dt.tgl"); //and datediff('$today',dt.tgl)>=2
$hasil=mysql_query("select * from dtransaksipermintaan where status='1' and stat3='tidak'"); //and datediff('$today',dt.tgl)>=2
  $TRec=mysql_num_rows($hasil);
?>
<form align="left" method="post" action="<?echo $PHPSELF?>">
No Kantong<input type="text" name="NoKantong">
<br><input type="submit" name="Button" value="Submit">
	<table class="list" id="box-table-b">
    <tr class="field">
      <th><b>No</b></th>
	<th><b> <?=mysql_num_rows($hasil)?>-Kantong</b>
      </th>
	<th>Gol Darah</th>
	<th>Nomer Formulir</th>
	<th>Tanggal Cross</th>
	<th>Hasil Cross</th>
	<th>Petugas Cross</th>
    </tr>
	<input type="hidden" name="jumlah" value="<?=mysql_num_rows($hasil)?>">
    <?
	$no=1;
while($baris=mysql_fetch_assoc($hasil)){
?>
    <tr class="record">
      <td>
        <div align="center"><font size="2"><?=$no?>.
        </font></div>
      </td>
      <td>
	<?=$baris[NoKantong]?>
	</td>
	<td><?=$baris[gol_darah]?></td>
	<td><?=$baris[NoForm]?></td>
	<td><?=$baris[tgl]?></td>
	<td><?=$baris[StatusCross]?></td>
	<td><?=$baris[petugas]?></td>
    </tr>
    <?
$no++;
}
?>
</table>
</form>
                <? } ?>
