<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
   // $('#dokter').autocomplete({source:'modul/suggest_dokter.php', minLength:2}),
    //$('#ruangan').autocomplete({source:'modul/suggest_ruangan.php', minLength:2}),
    //$('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2}),
    $('#nik').autocomplete({source:'kepegawaian/suggest_pegawai1.php', minLength:2});});
</script>
<?
if (isset($_POST[submit1])) {
echo "<a href=pmikepegawaian.php?module=sms_staf>KEMBALI</a>";
echo "<form method=post>
<table>
<tr><td valign=top>ISI Pesan</td><td valign=top>:</td><td><textarea rows=5 cols=50 wrap=physical name=pesan {font-family:Helvetica Neue, Helvetica, sans-serif; }></textarea></td></tr>
</table>
<input type=submit name=submit2 value='Kirimkan SMS!'>
";
echo "<table>";
$search=" WHERE length(telp2)>9 ";
if ($_POST[hp]!='') $search.=" AND telp2 like '$_POST[hp]'";
if ($_POST[level]!='') $search.=" AND kelompok='$_POST[level]'";
if ($_POST[bagian]!='') $search.=" AND bagian like '$_POST[bagian]'";
if ($_POST[jabatan]!='') $search.=" AND jabatan like '$_POST[jabatan]'";
echo "<tr><td>|</td><td>NOMOR</td><td>|</td><td>NAMA STAF</td><td>|</td><td>TELP</td><td>|</td><td>LEVEL</td><td>|</td><td>BAGIAN</td><td>|</td><td>JABATAN</td><td>|</td></tr>";
echo " ";
$pd=mysql_query("SELECT Nama,telp2,bagian,kelompok,jabatan FROM `pegawai` $search");
$no=0;
while ($pd1=mysql_fetch_assoc($pd)) {
    $no++;
    if (strlen($pd1[telp])>8) $telp=$pd1[telp2];
    echo "<tr><td>|</td><td>$no</td><td>|</td><td>$pd1[Nama]</td><td>|</td><td>$pd1[telp2]</td><td>|</td><td>$pd1[kelompok]</td><td>|</td><td>$pd1[bagian]</td><td>|</td><td>$pd1[jabatan]</td><td>|</td></tr>";
    echo "<input type=hidden name=staf[] value='$pd1[telp2]'>";
	echo "<input type=hidden name=nama[] value='$pd1[Nama]'>";
}
echo "</table></form>";
} 
if (isset($_POST[submit2])) {
    echo "Mengirimkan sms broadcast ke staf UDD......";

/*
$dk         = mysql_query("select nama,Jk,Status, Kode, telp2 from pendonor where Kode like '$utd[id]%' and substring(TglLhr,6,6) like '$today' and length(telp2)>9 and Cekal='0'");
    while ($dk1=mysql_fetch_assoc($dk)) {

	if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Bpk';
	if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Sdr';
	if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Ibu';
	if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Sdri';
        $telp   =$dk1[telp2];
        $pesan  ='Yth. '.$sapa.'. '.$dk1[nama].', '.$pengingat[pesan];
        $jmlSMS = ceil(strlen($pesan)/153);
        $pecah  = str_split($pesan, 153);
        $query  = "SHOW TABLE STATUS FROM sms LIKE 'outbox'";
        $hasil  = mysql_query($query);
        $data   = mysql_fetch_array($hasil);
        $newID  = $data['Auto_increment'];
        for ($i=1; $i<=$jmlSMS; $i++) {
            // membuat UDH untuk setiap pecahan, sesuai urutannya
            $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);
           // membaca text setiap pecahan
           $msg = $pecah[$i-1];
           if ($i == 1){
                // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
                $query = "INSERT INTO sms.outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart, CreatorID)
                          VALUES ('$telp', '$udh', '$msg', '$newID', 'true', '1')";
            } else {
                // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
                $query = "INSERT INTO sms.outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
                  VALUES ('$udh', '$msg', '$newID', '$i')";
            }
           // jalankan query
           mysql_query($query);
        }
        //$kirim  = mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) values ('$telp','$pesan','1')");
    }


*/
 //$pesan  ='Yth. '.$sapa.'. '.$dk1[nama].', '.$pengingat[pesan];
    for ($i=0;$i<sizeof($_POST[staf]);$i++) {
        $staf=$_POST[staf][$i];
	$nama=$_POST[nama][$i];
        $kirim="insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
			values ('$staf','yth. $nama , $_POST[pesan]','1')";
        //echo "$kirim <br>";
        $kirim1=mysql_query($kirim);
}
    echo '<META http-equiv="refresh" content="2; url=../pmikepegawaian.php?module=sms_pending">';
}
if (!isset($_POST[submit1]) and !isset($_POST[submit2])) {
?>
<h1>Broadcast SMS ke STAF</h1>
<form method=post>
<table>
<tr><td>No HP</td><td>:</td><td><input type=text name=hp id=nik placeholder="Ketikkan nama karyawan" size=25></td></tr>
<!--tr><td>Level</td><td>:</td><td><input name=level type=text></td></tr
Mencari satu data NIK <input type=text name=nik id=nik placeholder="Ketikkan nama karyawan" size=25 value=<?=$srcform?>

-->
<tr><td>Bagian</td><td>:</td><td>
<select name="level">
<option value="" selected>- SEMUA -</option>
	<option value="1">Teknis</option>
	<option value="0">Non Teknis</option>
	<option value="2">Managerial</option>
</select></td>

</tr>
<tr><td>Bagian</td><td>:</td><td>
<select name="bagian">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from bagianpeg ");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[kode]>$rowrs1[nama]</option>";
}
?>
</select></td>

</tr>
<!--tr><td>Bagian</td><td>:</td><td><input name=bagian type=text></td></tr-->
<tr><td>Jabatan</td><td>:</td><td>
<select name="jabatan">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from jabatanpeg order by kode ASC");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[nama]>$rowrs1[nama]</option>";
}
?>
</select>
</td>
</tr>
</table>
<input type=submit name=submit1 value=Submit>
</form>
<? } ?>
