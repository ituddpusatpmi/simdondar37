<head>
    <title>SIMDONDAR</title>
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
            font-size: 100%;
        }
    </style>
    <style>
        #serahterima {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 14px;
            border-collapse: collapse;
        }
        #serahterima td, #serahterima th {
            border: 1px solid #ddd;
            padding: 5px;
        }
        #serahterima tr:nth-child(even){background-color: #ffe6e6;}
        #serahterima tr:hover {background-color: #ddd;}
        #serahterima th {
            padding-top: 2px;
            padding-bottom: 2px;
            font-weight: lighter;
            background-color: #ff9999;
            color: #000000;
        }
        #serahterima input{
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            background-color: lightyellow;
            color: #000000;
        }
    </style>

</head>
<body><center>
<?
$today=date("Y-m-d H:i:s");
$kodelaptop=php_uname('n');
$namauser		=$_SESSION[namauser];
$namauserlkp	=$_SESSION[nama_lengkap];

if(isset($_POST[submit])){
    //========================== UPDATE ======================================//
    $mulai=new DateTime(date("Y-m-d H:i:s"));
    $namauser = $_SESSION[namauser];
    $kodelaptop=php_uname('n');
    $con_local=mysql_connect("localhost","root","F201603907");
    mysql_select_db("pmi",$con_local);
    $con_server=mysql_connect($_POST['ip_server'],"root","F201603907");
    mysql_select_db("pmi",$con_server);

    //pendonor
    $jml_donorbaru=0;
    $jml_donorulang=0;
    $jml_datadonormu=0;
    $pd=mysql_query("select * from pendonor where mu='1'",$con_local);
    while ($pd1=mysql_fetch_assoc($pd)) {
	    //echo "<br> $pd1[Kode] Local";
        $jml_datadonormu++;
	    $pdserver=mysql_query("select * from pendonor where Kode='$pd1[Kode]'",$con_server);
	    if (mysql_num_rows($pdserver)=='1') {
		    //echo "<BR> $pd1[Kode] UPDATE";
            $jml_donorulang++;
		    $updateserver=mysql_query("UPDATE pendonor SET
                NoKTP='$pd1[NoKTP]',Nama='$pd1[Nama]',Alamat='$pd1[Alamat]',
                Jk='$pd1[Jk]',Pekerjaan='$pd1[Pekerjaan]',telp='$pd1[telp]',
                TempatLhr='$pd1[TempatLhr]',TglLhr='$pd1[TglLhr]',
                Status='$pd1[Status]',GolDarah='$pd1[GolDarah]',
                Rhesus='$pd1[Rhesus]',`Call`='$pd1[Call]',
                kelurahan='$pd1[kelurahan]',
                kecamatan='$pd1[kecamatan]',
                wilayah='$pd1[wilayah]',
                KodePos='$pd1[KodePos]',
                jumDonor='$pd1[jumDonor]',
                telp2='$pd1[telp2]',umur='$pd1[umur]',
                tglkembali='$pd1[tglkembali]',cetak='$pd1[cetak]',mu='2',instansi='$pd1[instansi]'
                where Kode='$pd1[Kode]'",$con_server);
    	} else {
            $jml_donorbaru++;
            $insertserver="INSERT INTO pendonor(Kode,Kode_lama,NoKTP,Nama,Alamat,Jk,Pekerjaan,telp,TempatLhr,TglLhr,Status,GolDarah,Rhesus,`Call`,Cekal,kelurahan,kecamatan,wilayah,KodePos,jumDonor,
            title,telp2,umur,jns,ketdarah,tglkembali,sukubangsa,cetak,ibukandung,mu,pencatat,up,up_data,waktu_update,tanggal_entry,p10,p25,p50,p75,p100,psatya,pprov,instansi)
                VALUES
            ('$pd1[Kode]','NULL','$pd1[NoKTP]','$pd1[Nama]','$pd1[Alamat]',
            '$pd1[Jk]','$pd1[Pekerjaan]','$pd1[telp]',
            '$pd1[TempatLhr]','$pd1[TglLhr]',
            '$pd1[Status]','$pd1[GolDarah]',
            '$pd1[Rhesus]','$pd1[Call]','0',
            '$pd1[kelurahan]', '$pd1[kecamatan]','$pd1[wilayah]','$pd1[KodePos]',
            '$pd1[jumDonor]','NULL', '$pd1[telp2]','$pd1[umur]','NULL','NULL',
            '$pd1[tglkembali]','NULL','$pd1[cetak]','$pd1[ibukandung]','2',
            '$namauser',b'1','0','$pd1[waktu_update]','$pd1[tanggal_entry]','0','0','0','0','0','0','0','$pd1[instansi]')";
            //echo "<BR> $insertserver";
            $insertserver0=mysql_query($insertserver,$con_server);
	    }
    }

    // htransaksi
    $jml_trxmu=0;
    $jml_trxbaru=0;
    $jml_trxlama=0;
    $ht=mysql_query("select * from htransaksi where mu='1'",$con_local);

    while ($ht1=mysql_fetch_assoc($ht)) {
        //echo "<br> $ht1[NoTrans] Local";
        $jml_trxmu++;
        $htserver=mysql_query("select * from htransaksi where NoTrans='$ht1[NoTrans]'",$con_server);
        if (mysql_num_rows($htserver)=='1') {
            $jml_trxlama++;
            //echo "<br> $ht1[NoTrans] UPDATE Transaksi";
            $updateserver=mysql_query("UPDATE htransaksi SET
                Tgl='$ht1[Tgl]', Diambil='$ht1[Diambil]',
		jam_ambil='$ht1[jam_ambil]',jam_selesai='$ht1[jam_selesai]',jam_mulai='$ht1[jam_mulai]',
                Reaksi='$ht1[Reaksi]', Pengambilan='$ht1[Pengambilan]',
                Catatan='$ht1[Catatan]',NamaDokter='$ht1[NamaDokter]',
                NoKantong='$ht1[NoKantong]', petugas='$ht1[petugas]',
                petugasHB='$ht1[petugasHB]',petugasTensi='$ht1[petugasTensi]',
                beratBadan='$ht1[beratBadan]', tensi='$ht1[tensi]',
                suhu='$ht1[suhu]', nadi='$ht1[nadi]',Hb='$ht1[Hb]',
                caraAmbil='$ht1[caraAmbil]', Hct='$ht1[Hct]',
                status_test='$ht1[status_test]', Status='$ht1[Status]', mu='2', gol_darah='$ht1[gol_darah]', rhesus='$ht1[rhesus]', kendaraan='$ht1[kendaraan]',jeniskantong='$ht1[jeniskantong]', volumekantong='$ht1[volumekantong]', umur='$ht1[umur]', donorbaru='$ht1[donorbaru]', pekerjaan='$ht1[pekerjaan]', jk='$ht1[jk]' ,donorke='$ht1[donorke]'
                where NoTrans='$ht1[NoTrans]'",$con_server);

        } else{
            $jml_trxbaru++;
            //echo "<br> $ht1[NoTrans] Tambah htransaksi.";
            $insertserver=mysql_query("INSERT INTO htransaksi (NoTrans,KodePendonor_lama,KodePendonor,Tgl,NoAntri,JenisDonor,Diambil,Reaksi,Pengambilan,Catatan,NamaDokter,
                          NoKantong,Status,Nopol,NoForm,StatDonor,tempat,petugas,user,ketPaket,ketBatal,petugasHB,petugasTensi,jumHB,beratBadan,Instansi,tahun,tensi,suhu,nadi,
                          Hb,Hct,jnsperiksa,caraAmbil,shift,kota,id_permintaan,mu,status_test,gol_darah,rhesus,kendaraan,
                jeniskantong, volumekantong, umur, donorbaru , pekerjaan, jk ,donorke,jam_ambil,jam_selesai,jam_mulai ) VALUES
                ('$ht1[NoTrans]','$ht1[KodePendonor_lama]',
                '$ht1[KodePendonor]','$ht1[Tgl]',
                '$ht1[NoAntri]','$ht1[JenisDonor]',
                '$ht1[Diambil]','$ht1[Reaksi]',
                '$ht1[Pengambilan]','$ht1[Catatan]','$ht1[NamaDokter]',
                '$ht1[NoKantong]','$ht1[Status]','$ht1[Nopol]',
                '$ht1[NoForm]','$ht1[StatDonor]','$ht1[tempat]',
                '$ht1[petugas]','$ht1[user]','$ht1[ketPaket]',
                '$ht1[ketBatal]','$ht1[petugasHB]','$ht1[petugasTensi]','$ht1[jumHB]',
                '$ht1[beratBadan]','$ht1[Instansi]','$ht1[tahun]',
                '$ht1[tensi]','$ht1[suhu]','$ht1[nadi]',
                '$ht1[Hb]','$ht1[Hct]','$ht1[jnsperiksa]',
                '$ht1[caraAmbil]','$ht1[shift]','$ht1[kota]',
                '$ht1[id_permintaan]','2','$ht1[status_test]','$ht1[gol_darah]','$ht1[rhesus]','$ht1[kendaraan]',
                '$ht1[jeniskantong]','$ht1[volumekantong]','$ht1[umur]','$ht1[donorbaru]','$ht1[pekerjaan]','$ht1[jk]','$ht1[donorke]',
		'$ht1[jam_ambil]','$ht1[jam_selesai]','$ht1[jam_mulai]')",$con_server);
        }
    }

    //stok kantong
    $jml_kantong=0;
    $sk=mysql_query("select * from stokkantong where mu='1'",$con_local);

    while ($sk1=mysql_fetch_assoc($sk)) {
        $jml_kantong++;
        //echo "<br> $sk1[NoTrans] Local";
        $skserver=mysql_query("select * from stokkantong where noKantong='$sk1[noKantong]'",$con_server);
        //echo "<BR> $sk1[noKantong] UPDATE Kantong";
        $updateserver=mysql_query("UPDATE stokkantong SET
            Status='$sk1[Status]',
            mu='2',
            kodePendonor='$sk1[kodePendonor]',
            kadaluwarsa='$sk1[kadaluwarsa]',
            RhesusDrh='$sk1[RhesusDrh]',
            gol_darah='$sk1[gol_darah]',
            produk='$sk1[produk]',
            tgl_Aftap='$sk1[tgl_Aftap]',
            lama_pengambilan='$sk1[lama_pengambilan]'
            where noKantong='$sk1[noKantong]'",$con_server);
        if ($sk1[Status]!=4 && $sk1[Status]!=5){
            $updateserver=mysql_query("UPDATE stokkantong SET sah='0' where noKantong='$sk1[noKantong]'",$con_server);
        }
    }

    //idcard
    $jml_idcard=0;
    $idc=mysql_query("select * from idcard where mu='1'",$con_local);
    while ($idc1=mysql_fetch_assoc($idc)) {
        //echo "<br> $idc1[kodependonor] Local";
        $pdidc=mysql_query("select * from idcard where kodependonor='$idc1[kodependonor]'",$con_server);
        if (mysql_num_rows($pdidc)>='0') {
            //echo "<BR> $idc1[kodependonor] Insert";
            $insertserver1="INSERT INTO idcard(kodependonor,tglcetak,petugas,tempat,mu)
                        VALUES('$idc1[kodependonor]','$idc1[tglcetak]','$idc1[petugas]','$idc1[tempat]','2')";
            //echo "<BR> $insertserver1";
            $insertserver2=mysql_query($insertserver1,$con_server);
            $jml_idcard++;
        }
    }

    //Kegiatan
    $tgl2=date("Y-m-d H:i:s");
    $tgl3=date("H:i:s");
    $jml_gagal=0;
    $jml_batal=0;
    $jml_berhasil=0;
    $hasil =mysql_fetch_assoc(mysql_query("select count(distinct NoTrans) as jum  from htransaksi where mu='1' and Pengambilan='0'",$con_local));
    $hasil1=mysql_fetch_assoc(mysql_query("select count(distinct NoTrans) as jum1 from htransaksi where mu='1' and Pengambilan='1'",$con_local));
    $hasil2=mysql_fetch_assoc(mysql_query("select count(distinct NoTrans) as jum2 from htransaksi where mu='1' and Pengambilan='2'",$con_local));
    $hasil0=mysql_fetch_assoc(mysql_query("select count(distinct NoTrans) as jum from htransaksi where mu='1'",$con_local));
    $kg=mysql_query("select * from kegiatan where mu='1'",$con_local);
    $jml_gagal      = $hasil2['jum2'];
    $jml_batal      = $hasil1['jum1'];
    $jml_berhasil   = $hasil['jum'];
    $jml_transaksi  = $hasil0['jum'];
    while ($kg1=mysql_fetch_assoc($kg)) {
        $kgs=mysql_query("update kegiatan set TglPelaksanaan='$kg1[TglPelaksanaan]', mu='2',jamselesai='$tgl3',status='1',
                    sukses='$hasil[jum]',batal='$hasil1[jum1]',gagal='$hasil2[jum2]' where NoTrans='$kg1[NoTrans]'");
    }
    $kg=mysql_query("select * from detailinstansi",$con_local);
    while ($kg1=mysql_fetch_assoc($kg)) {
        $kgs=mysql_query("update detailinstansi set nama='$kg1[nama]',alamat='$kg1[alamat]',telp='$kg1[telp]',cp='$kg1[cp]', jumdonor=jumdonor+1,
                    tglakhir_donor='$kg1[TglPelaksanaan]', tgldonor_lagi=date_add((tglakhir_donor), interval 60 day) where KodeDetail='$kg1[KodeDetail]'");

    }
    $status='BERHASIL';
    if ($kgs) {
            //echo "<b> Proses Tranfer Sudah berhasil dilakukan</b>";
            $status='BERHASIL';
            mysql_query ("update stokkantong set mu='3' where mu='1'",$con_local);
            mysql_query ("update idcard set mu='3' where mu='1'",$con_local);
            mysql_query ("update htransaksi set mu='3' where mu='1'",$con_local);
            mysql_query ("update pendonor set mu='3' where mu='1'",$con_local);
            mysql_query ("update kegiatan set mu='3' where mu='1'",$con_local);
    } else {
            //echo "<b>Proses Transfer ke Gagal</b>";
            $status='GAGAL';
            mysql_query ("update stokkantong set mu='3' where mu='1'",$con_local);
            mysql_query ("update idcard set mu='3' where mu='1'",$con_local);
            mysql_query ("update htransaksi set mu='3' where mu='1'",$con_local);
            mysql_query ("update pendonor set mu='3' where mu='1'",$con_local);
            mysql_query ("update kegiatan set mu='3' where mu='1'",$con_local);
            echo mysql_error();
    }
    //=======Audit Trial===================================================================================
    $kg=mysql_query("SELECT k.`kodeinstansi`, d.nama FROM `kegiatan` k inner join detailinstansi d on k.`kodeinstansi`= d.`KodeDetail` WHERE mu='3'",$con_local);
    $kg1=mysql_fetch_assoc($kg);
    $namainstansi=$kg1['nama'];
    $log_mdl ='MOBILE UNIT';
    $log_aksi='Upload Data Mobile Unit : '.$namainstansi;
    include "user_log.php";
    $log_aksi='Upload Data Pendonor Baru : '.$jml_donorbaru;
    include "user_log.php";
    $log_aksi='Upload Data Pendonor Ulang : '.$jml_donorulang;
    include "user_log.php";
    $log_aksi='Upload Data Transaksi Donor : '.$jml_transaksi.' (Berhasil : '.$jml_berhasil.'; Gagal : '.$jml_gagal.'; Batal : '.$jml_batal.')';
    include "user_log.php";
    $log_aksi='Upload Data Kantong :  '.$jml_kantong;
    include "user_log.php";
    //=====================================================================================================//Audit Trial
    //echo "<br> Audit trail ";
    $log_audit=0;
    $qlog="SELECT `id`, `komputer`, `time`, `time_aksi`, `user`, `modul`, `aksi_user`, `keterangan`, `tempat`, `upload` FROM `user_log` WHERE `upload`='0' order by `id`";
    $log0=mysql_query($qlog,$con_local);
    while($log=mysql_fetch_assoc($log0)){
        //echo ".";
        $log_audit++;
        $insert_server=mysql_query("INSERT INTO `user_log`(`time_aksi`,`komputer`, `user`, `modul`, `aksi_user`, `keterangan`, `tempat`) VALUES
                                    ('$log[time_aksi]','$log[komputer]','$log[user]','$log[modul]','$log[aksi_user]','','$log[tempat]')", $con_server);
        if ($insert_server){
            $update_local=mysql_query("UPDATE `user_log` set `upload`='1' WHERE `id`='$log[id]'",$con_local);
        }
    }

    //End of Audit Trial===============================


    //echo "<meta http-equiv=\"refresh\" content=\"5; URL=pmimobile.php?module=mobile_transfer\">";
    //******************************** UPDATE ***********************************//
    //REPORT UPLOAD
    $selesai=new DateTime(date("Y-m-d H:i:s"));
    $interval = $mulai->diff($selesai);
    ?>
    <div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">HASIL UPLOAD DATA MOBILE UNIT</div>
    <div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Tempat Mobile Unit : <?=$namainstansi?></div>
    <div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Kode Laptop MU : <?=$kodelaptop?></div>
    <div style="background-color: #ffffff;font-size:18px; color:#000000; font-family:Verdana;"><?='Waktu Upload :'.date('d-m-Y H:i:s');?></div>
    <table id="serahterima" style="border-collapse: collapse;border: 1px solid #808080;box-shadow: 1px 2px 2px #000000;">
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th>Keterangan</th>
            <th>Jumlah Data</th>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Donor MU</th>
            <td><?=$jml_datadonormu?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Donor Baru</th>
            <td><?=$jml_donorbaru?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Donor Ulang</th>
            <td><?=$jml_donorulang?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Transaksi Donor</th>
            <td><?=$jml_trxmu?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah transaksi UPDATE</th>
            <td align="left"><?=$jml_trxlama?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Transkaksi INSERT</th>
            <td><?=$jml_trxbaru?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Transaksi Donor</th>
            <td><?=$jml_transaksi?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Transaksi Donor Berhasil</th>
            <td><?=$jml_berhasil?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Transaksi Donor Gagal</th>
            <td><?=$jml_gagal?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Transaksi Donor Batal</th>
            <td><?=$jml_batal?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Kantong</th>
            <td><?=$jml_kantong?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Log Audit Trail</th>
            <td><?=$log_audit?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Jumlah Kartu Donor</th>
            <td><?=$jml_idcard?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Lama Upload </th>
            <td><?=$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S');?></td>
        </tr>
        <tr style="background-color:mistyrose; font-size:16px; color:#000000;">
            <th align="left">Petugas </th>
            <td><?=$namauserlkp.'('.$namauser.')';?></td>
        </tr>
    </table>
    <a href="javascript:window.print()">Update : 26-10-2018</a>
    <?php
}else{?>
    <div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">UPLOAD DATA MOBILE UNIT KE SERVER</div>
    <div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">KODE LAPTOP: <?=$kodelaptop;?></div>
    <div style="background-color: #ffffff;font-size:16px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Setelah meng-upload, data transaksi server sebelumnya akan diperbaharui.</div><br>
    <form name="download" method="post" action="<? $PHP_SELF ?>">
        <div style="background-color: #ffffff;font-size:18px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">SERVER SIMDONDAR :</div>
        <div><input type=text name=ip_server size=13 value='192.168.10.200'></div><br>
        <div><button type="submit" value="Simpan" name="submit" class="swn_button_red" role="button" aria-disabled="false">Proses Upload</div></button>
    </form>    
<?}
?>



