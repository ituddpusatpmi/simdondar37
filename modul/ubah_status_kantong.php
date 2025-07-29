<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style>
    .awesomeText {
        color: #000;
        font-size: 150%;
    }
</style>
<script>
    $(document).ready(function()
    {
        // Stop user to press enter in textbox
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>
<style type="text/css">
    @import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
    .normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>

<body OnLoad="document.mintadarah1.minta1.focus();">
<?
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$today=date('Y-m-d');
$today1=$today;
$ket="";
if (!empty($_POST[submit])) {
    $nkt=$_POST[minta1];
    $aksi=$_POST[aksi];
    $status_cekal=$_POST[status_cekal];
    $no_kantong0=substr($nkt,0,-1);
    $nokantong_a=$no_kantong0.'A';
    $jumlah_ktg=0;
    $ubah='0';
    $komponen0=mysql_query("select * from stokkantong where upper(nokantong)=upper('$nkt') order by noKantong ASC");
    $komponen=mysql_fetch_assoc($komponen0);
        switch ($komponen[Status]) {
            case 0 :
                $ckt_status="Kosong";
                if ($komponen[StatTempat]==NULL) $ckt_status="Kosong Di Logistik";
                if ($komponen[StatTempat]=='0') $ckt_status="Kosong Di Logistik";
                if ($komponen[StatTempat]=='1') $ckt_status="Kosong Di Aftap";
                $ubah='1';
                break;
            case 1:
                $ckt_status="Aftap";
                if ($komponen[sah]=='1') $ckt_status="Baru Isi/Karantina";
                $ubah='0';
                break;
            case 2:
                $ckt_status="Sehat";
                if (substr($komponen[stat2],0,1)=='b') $tempat=" (BDRS)";
                $ubah='0';
                break;
            case 3:
                $ckt_status="Keluar_Bawa";
                if ($bawa[Status]=='1') $ckt_status="Keluar_Titip";
                $ubah='1';
                break;
            case 4:
                $ckt_status="Rusak";
                $ubah='0';
                break;
            case 5:
                $ckt_status="Rusak-Gagal";
                $ubah='1';
                break;
            case 6:
                $ckt_status="Dimusnahkan";
                $ubah='0';
                break;
        }
        $tglperiksa=$komponen['tglperiksa'];
        If ($ubah=='1'){echo "Status kantong $nkt tidak bisa diubah<br>";}
        if ($aksi=="2" and $ubah=='0'){
            $ket_aksi="SEHAT";
            echo "No Kantong : $komponen[noKantong] (kantong utama : $nokantong_a) status $ckt_status diubah menjadi $ket_aksi <br>";
            //Sehat
            $upd_ktga=mysql_query("UPDATE stokkantong set Status='2',hasil='2',sah='1',StatTempat='1', tglperiksa='$tglperiksa' where NoKantong='$nkt'");
            //UPDATE HTRANSAKSI
            $sql_htrans="UPDATE htransaksi SET `status_test`='0', `hasil_hbsag`='0', `hasil_hcv`='0', `hasil_hiv`='0', `hasil_syp`='0', `tglperiksa`='$tglperiksa' where NoKantong='$nokantong_a'";
            $sql_htransaksi=mysql_query($sql_htrans);
            //Cari Kode Pendonornya
            $pendonor	=mysql_query("select kodePendonor as kode from htransaksi where NoKantong='$nokantong_a'");
            $datapendonor=mysql_fetch_assoc($pendonor);
            $idpendonor	=$datapendonor['kode'];
            //update table pendonor
            $upd_donor_sehat=mysql_query("UPDATE pendonor SET Cekal='0' WHERE Kode='$idpendonor'");
            //Hapus dari ar_stokkantong
            $sq_ar_a="DELETE FROM `ar_stokkantong` WHERE noKantong='$nkt'";
            $keluarkan_a=mysql_query($sq_ar_a);
            //hapus dari table cekal
            $sq_ar_a="DELETE FROM `cekal` WHERE kode_pendonor='$idpendonor'";
            $keluarkan_a=mysql_query($sq_ar_a);
            //=======Audit Trial====================================================================================
            $log_mdl ='IMLTD';
            $log_aksi='Ubah Status Kantong :'.$nkt.' dari status '. $ckt_status.'ke status SEHAT, Pendonor: '.$idpendonor;
            include('user_log.php');
            //======================================================================================================
        }
        if ($aksi=="3" and $ubah=='0' and $status_cekal!=='0'){
            $ket_aksi="CEKAL";
            echo "No Kantong : $nkt ( kantong utama : $nokantong_a) status $ckt_status diubah menjadi $ket_aksi <br>";
            //=======Audit Trial====================================================================================
            $log_mdl ='IMLTD';
            $log_aksi='Ubah Status Kantong :'.$nkt.'dari status '. $ckt_status.'ke status MUSNAH - Reaktif, Pendonor: '.$idpendonor;
            include('user_log.php');
            //======================================================================================================
            //6.4 Update Stok kantong
            $tambah3s=mysql_query("UPDATE stokkantong set Status='6',hasil='4',sah='1',StatTempat='1', tglperiksa='$tglperiksa' where NoKantong='$nkt'");
            //6.5 Musnahkan kantong ke ar_stokkantong
            $sq_ar_a="insert into ar_stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat,kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap, kadaluwarsa,tglpengolahan,mu,stokcheck)
						        select noKantong,jenis,Status,tglTerima,volume,merk,kantongAsal,produk,sah,Isi,gol_darah,RhesusDrh,stat2,StatTempat, kodePendonor,statKonfirmasi,statQC,AsalUTD,tgl_Aftap,kadaluwarsa,tglpengolahan,mu,stokcheck from stokkantong where noKantong='$nkt'";
            $keluarkan_a=mysql_query($sq_ar_a);

            $sq_ar_upd="update ar_stokkantong set alasan_buang='4', tgl_buang='$tglperiksa', user='$namauser' where noKantong='$nkt'";
            $update=mysql_query($sq_ar_upd);
            if ($update){echo "-Pemusnahan kantong $komponen[noKantong] SUKSES<br>";}else{echo "-Pemusnahan kantong $komponen[noKantong] GAGAL<br>";}

            //CEKAL
            $ckl_b="";$ckl_c="";$ckl_i="";$ckl_s="";
            switch ($status_cekal){
                case"0" : break;
                case"1" : $ckl_b='1';break;
                case"2" : $ckl_c='1';break;
                case"3" : $ckl_i='1';break;
                case"4" : $ckl_s='1';break;
                default : break;
            }
            //6.1 MENCEKAL PENDONOR BERDASARKAN INPUT NOMOR KANTONG
            //Cari Kode Pendonornya
            $pendonor	    = mysql_query("select kodePendonor as kode from htransaksi where NoKantong='$nokantong_a'");
            $datapendonor   = mysql_fetch_assoc($pendonor);
            $idpendonor	    = $datapendonor['kode'];
            //6.2 update table pendonor
            $upd_donor_cekal=mysql_query("UPDATE pendonor SET Cekal='1' WHERE Kode='$idpendonor'");
            //6.3 Update Htransaksi
            $sq_htransaksi=mysql_query("UPDATE htransaksi SET `status_test`='0', `hasil_hbsag`='$ckl_b', `hasil_hcv`='$ckl_c', `hasil_hiv`='$ckl_i', `hasil_syp`='$ckl_s', `tglperiksa`='$tglperiksa' where NoKantong='$nkt'");
            //6.4 insert ke table cekal utk masing-masing parameter yang dicekal
            if ($upd_donor_cekal){
                echo "- ID $idpendonor CEKAL ($ckl_b $ckl_c $ckl_i $ckl_s) kantong $nokantong_a - $nkt<br>";
                //6.3.1 insert ke table cekal per masing2 parameter reaktif
                if ($ckl_b=="1"){
                    $tambah_cekal=mysql_query("INSERT INTO `cekal`(`kode_pendonor`, `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
							VALUES ('$idpendonor','$nkt', '$namauser','1', 'Ubah Status', '')");
                }
                if ($ckl_c=="1"){
                    $tambah_cekal=mysql_query("INSERT INTO `cekal`(`kode_pendonor`,  `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
                            VALUES ('$idpendonor','$nkt', '$namauser','2', 'Ubah Status', '')");
                }
                if ($ckl_i=="1"){
                    $tambah_cekal=mysql_query("INSERT INTO `cekal`(`kode_pendonor`,  `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
                            VALUES ('$idpendonor','$nkt', '$namauser','3', 'Ubah Status', '')");
                }
                if ($ckl_s=="1"){
                    $tambah_cekal=mysql_query("INSERT INTO `cekal`(`kode_pendonor`,  `nokantong`,`petugas`, `status`, `ket`, `notrans_imltd`)
                            VALUES ('$idpendonor','$nkt', '$namauser','4', 'Ubah Status', '')");
                }
            }

        }
    }


?>
<p style="font-size: 24px; color: red"><b>PERUBAHAN STATUS KANTONG</b>
<div>
    <form name=mintadarah1 method=post>
        <table class="list" border=1 cellpadding="2" cellspacing="2" style="border-collapse:collapse">
            <tr>
                <td>Masukkan nomor kantong</td>
                <td><INPUT type="text"  name="minta1"  size='23' required></td>
            </tr>
            <tr>
                <td>Perubahan Status kantong menjadi</td>
                <td>
                    <select name="aksi">
                        <option value="" >-</option>
                        <option value="2">Sehatkan</option>
                        <option value="3">Cekal</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Apabila Status Cekal, pilih parameter cekal</td>
                <td><select name="status_cekal">
                        <option value="0">-</option>
                        <option value="1">HBsAg</option>
                        <option value="2">Anti HCV</option>
                        <option value="3">Anti HIV</option>
                        <option value="4">Syphilis</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type=submit name=submit value='Proses Ubah Status Kantong' class="swn_button_red"></td>
            </tr>
        </table>
</form></div>

