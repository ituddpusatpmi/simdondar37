<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
//-->
</style>
<?
session_start();
include('clogin.php');
include('config/koneksi.php');
?>
<?php
//$today=date('Y-m-01');
$today=date('Y-m-d');
$today1=date('Y-m-d');


if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
  
$quser="select nama_lengkap from `user` order by nama_lengkap ASC";
?>
<a name="atas"><br>
<h2 class="list">DATA AKTIVITAS USER (<i>Audit Trail</i>) SIMDONDAR</h2>
<h3 class="list">Cari data aktivitas user</h3>
</a><a href="#bawah">Ke bawah</a><br>
<form namme=rekap method=post>
	<table border=1 cellpadding=5 cellspacing=2 width="100%">
	<tr>
	  <td>Tanggal : 
	  <input name="minta1" id="datepicker"  value="<?=$today?>" type=date> s/d
		<input name="minta2" id="datepicker1" value="<?=$today1?>" type=date>
	  </td>
	<td>  Nama User 	
	<select name="namauser"">
		<option value="">Semua</option>
		<? $do=mysql_query($quser);
		while($data=mysql_fetch_array($do)){?>
		  <option value="<?=$data['nama_lengkap']?>"><?=$data[nama_lengkap]?></option>
	  	<?}?>
	</select><br><input type="checkbox" name="chkbox" value="1">Tampilkan UNKNOWN user?</td>
    	<td> Modul<input name="modul" type=text size=10></td>
    	<td> Aktivitas<input name="aktivitas" type=text size=10>
	
	</td>
	<td><input type=submit name=submit value="Tampilkan"></td></tr></table>
</form>

<?
if (isset($_POST[submit])){

	$perbln=substr($_POST[minta1],5,2);
	$pertgl=substr($_POST[minta1],8,2);
	$perthn=substr($_POST[minta1],0,4);

	$perbln1=substr($_POST[minta2],5,2);
	$pertgl1=substr($_POST[minta2],8,2);
	$perthn1=substr($_POST[minta2],0,4);
    $user_src=$_POST['namauser'];
?>


<?  if ($_POST['chkbox']=="1"){	
    $data=mysql_query("SELECT 
			DATE_FORMAT(user_log.time, '%H:%i') as jam,
		    DATE_FORMAT(user_log.time, '%d/%m/%Y') as tgl,
			DATE_FORMAT(user_log.time_aksi, '%H:%i') as jam_aksi,
		    DATE_FORMAT(user_log.time_aksi, '%d/%m/%Y') as tgl_aksi,
		    user_log.user,
			user_log.komputer,
		    user_log.modul,
		    user_log.aksi_user,
		    case when SUBSTRING(user_log.tempat, 1, 1)='M' then 'Mobile Unit-' else '' end as tempat,
		        `user`.nama_lengkap
		        from user_log left join user on `user`.`id_user`=user_log.user
		        where date(user_log.time)>='$_POST[minta1]' and date(user_log.time)<='$_POST[minta2]' and
		        (`user`.nama_lengkap like '%$user_src%' or user_log.user like '%$user_src%') AND
		        user_log.modul like '%$_POST[modul]%' AND
		        user_log.aksi_user like '%$_POST[aktivitas]%'
		      order by user_log.time asc");
  } else {
    $data=mysql_query("SELECT DATE_FORMAT(user_log.time_aksi, '%H:%i') as jam,
		      	DATE_FORMAT(user_log.time_aksi, '%d/%m/%Y') as tgl,
		      	user_log.user,
			user_log.komputer,
		        user_log.modul,
		        user_log.aksi_user,
		        case when SUBSTRING(user_log.tempat, 1, 1)='M' then 'Mobile Unit-' else '' end as tempat,
		        `user`.nama_lengkap
		        from user_log inner join user on `user`.`id_user`=user_log.user
		        where date(user_log.time)>='$_POST[minta1]' and date(user_log.time)<='$_POST[minta2]' and
		        (`user`.nama_lengkap like '%$user_src%' or user_log.user like '%$user_src%') AND
		        user_log.modul like '%$_POST[modul]%' AND
		        user_log.aksi_user like '%$_POST[aktivitas]%'
		      order by user_log.time asc");
  }
?>
<table  cellpadding=3 cellspacing=1 width="100%">
	<tr class="field" style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:verdana;" 
	    onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align=center>NO.</td>
		<td align=center>TGL</td>
		<td align=center>JAM</td>
		<td align=center>USER</td>
        	<td align=center>NAMA LENGKAP</td>
		<td align=center>KOMPUTER IP</td>
		<td align=center>MODUL</td>
		<td align=center>AKTIVITAS</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	    $no++;?>
	<tr class="record" style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align=right><?=number_format($no,0,".",".")?></td>
		<td align=left><?=$data1[tgl]?></td>
		<td align=left><?=$data1[jam]?></td>
		<td align=left><?=$data1[user]?></td>
        <td align=left  nowrap><?=$data1[nama_lengkap]?></td>
		<td align=left><?=$data1[komputer]?></td>
		<td align=left><?=strtoupper($data1[modul])?></td>
		<td align=left><?=$data1[tempat].$data1[aksi_user]?></td>
	</tr>
	<? } ?>
</table>
<a href="#atas">Ke Atas</a>
	<a name="bawah"></a>
</form>
<?
}
?>
