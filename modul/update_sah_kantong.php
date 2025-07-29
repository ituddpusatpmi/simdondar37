<?
session_start();
//include ('clogin.php');
include ('config/db_connect.php');
$today=date("Y-m-d H:i:s");
$namauser=$_SESSION[namauser];
 $lv=$_SESSION[leveluser];
    $nkt=mysql_real_escape_string($_GET[noKantong]);
    $cek=mysql_query("select sah,jenis,gol_darah,RhesusDrh from stokkantong where sah='1' and Status='1' and nokantong='$nkt'");
	$cek1=mysql_fetch_assoc(mysql_query("select * from stokkantong where nokantong='$nkt'"));
	$cek2=mysql_fetch_assoc(mysql_query("select * from htransaksi where nokantong='$nkt'"));
	$pengesahan=mysql_query("insert into pengesahan (nokantong,tgl,ygmenyerahkan,jns,ket,shift) value ('$nkt','$today','$namauser','$cek1[jenis]','$cek2[Pengambilan]','$cek2[shift]')");
    $row=mysql_num_rows($cek);
    if ($row==0) {
		   $updatektg=mysql_query("update stokkantong set sah='1',tglpengolahan=tgl_Aftap where noKantong='$nkt' and Status='1'");
                   //Eksekusi SMS
                    //---Minta Id pendonor untuk set data pendonor----
                    $pendonor=mysql_query("select kodependonor from stokkantong where nokantong='$nkt'");
                    $datapendonor=mysql_fetch_assoc($pendonor);
                    $idpendonor=$datapendonor[kodependonor];
                    //---End Minta Id pendonor untuk set data pendonor----
                    //kirim ucapan terimakasih
                    $dk=mysql_query("select nama,Jk,Status,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>9");
                    if (mysql_num_rows($dk)==1) {
                            $dk1=mysql_fetch_assoc($dk);
				if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Bpk';
				if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Sdr';
				if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Ibu';
				if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Sdri';
                            $ud=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='3'"));
                            $telp=$dk1[telp2];
                            $pesan='Yth. '.$sapa.'. '.$dk1[nama].', '.$ud[pesan];
                            $kirim=mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
                                            values ('$telp','$pesan','1')");
                     }
                    // end ucapan
        
                    switch ($lv){
				case "aftap":
					?> <META http-equiv="refresh" content="1; url=../pmiaftap.php?module=rekap_transaksi1"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="1; url=../pmimobile.php?module=rekap_transaksi_harian"> <?
					break;
                                case "laboratorium":
					?> <META http-equiv="refresh" content="1; url=../pmilaboratorium.php?module=rekap_transaksi1"> <?
					break;
                                case "kasir":
					?> <META http-equiv="refresh" content="1; url=../pmikasir.php?module=rekap_transaksi1"> <?
					break;
                                case "bdrs":
					?> <META http-equiv="refresh" content="1; url=../pmibdrs.php?module=rekap_transaksi1"> <?
					break;
                                case "pimpinan":
					?> <META http-equiv="refresh" content="1; url=../pmipimpinan.php?module=rekap_transaksi1"> <?
					break;
				default:
					echo "Anda tidak memiliki hak akses";
				}
    backgroundPost('http://localhost/simudda/modul/background_up_karantina.php');

    } else {
        switch ($lv){
				case "aftap":
					?> <META http-equiv="refresh" content="1; url=../pmiaftap.php?module=rekap_transaksi1"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="1; url=../pmimobile.php?module=rekap_transaksi_harian"> <?
					break;
                                case "laboratorium":
					?> <META http-equiv="refresh" content="1; url=../pmilaboratorium.php?module=rekap_transaksi1"> <?
					break;
                                case "kasir":
					?> <META http-equiv="refresh" content="1; url=../pmikasir.php?module=rekap_transaksi1"> <?
					break;
                                case "bdrs":
					?> <META http-equiv="refresh" content="1; url=../pmibdrs.php?module=rekap_transaksi1"> <?
					break;
                                case "pimpinan":
					?> <META http-equiv="refresh" content="1; url=../pmipimpinan.php?module=rekap_transaksi1"> <?
					break;
				default:
					echo "Anda tidak memiliki hak akses";
				}
    }



