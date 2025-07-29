<?
    /***********************************************
     * Author 	: suwena 
     * Date 	: 26 Mei 2018
     * Fungsi	: Form Serah Terima Darah dari Aftap/Mobile unit utk Karantina
     * Keterangan Modul : 
     * 		Pengganti pengesahan kantong
     * 		Sekaligus membuat formulir Serah Terima ke 
     *			- Bag Karantina atau Komponen
     *			- Bag Uji Saring Darah IMLTD
     *			- Bag Uji Konfirmasi Golongan Darah
     * 		Status Darah yang sah langsung menjadi KARANTINA
     * 		Stok Position : PENYIMPANAN DARAH KARANTINA
     * Table terkait : 
     *		- Select : stokkantong join htransaksi
     *		- exec   : serahterima_h, serahterima_detail, serahterima_detail_tmp
     ***********************************************/
    $nodokumen="UDDSLM-PD-L4-011-2022";
    include('config/db_connect.php');
    $today			=date("Y-m-d H:i:s");
    $namauser		=$_SESSION[namauser];
    $namauserlkp	=$_SESSION[nama_lengkap];
    $modul			="KARANTINA";
    $bag_pengirim	="AFTAP";
    $bag_penerima	="KOMPONEN";
?>

<body>

<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">SERAH TERIMA KANTONG & SAMPLE DARI AFTAP/MOBILE UNIT</div>
<hr style="width: 100%;text-align:left;margin-left:0;color: #0099ff" >
<?php
$sr=mysql_fetch_assoc(mysql_query("SELECT  `dst_asal`, `dst_kodealat`,  `dst_suhu`, `dst_keadaan` FROM `serahterima_detail_tmp` WHERE `dst_modul`='$modul' AND `dst_user`='$namauser'"));
$keadaan      =$sr['dst_keadaan'];
$suhu         =$sr['dst_suhu'];
$kode_alat    =$sr['dst_kodealat'];
$asal_sample  =$sr['dst_asal'];
?>
<form name=sahdarah method=post>
    <table style="width: 100%; border-collapse: collapse;border: 2px solid #808080;box-shadow: 1px 2px 2px #000000;">
        <tr>
            <td style="vertical-align: top; width=50%;">
                <table id="serahterima" style="width: 98%;">
                    <tr><th>Bagian yang mengirimkan</th>    <td><input name="bag_pengirim" id="bag_pengirim" type="text" disabled value="<?=$bag_pengirim?>"></td></tr>
                    <tr><th>Jenis Serah Terima</th>         <td>Kantong Aftap & Sample</td></tr>
                    <tr><th>Bagian yang menerima</th>       <td><input name="bag_penerima" id="bag_penerima" type="text" disabled value="<?=$bag_penerima?>"></td></tr>
                    <tr><th>Asal Kantong & Sample</th>      <td><input name="asal" id="asal" type="text" required onkeypress="return handleEnter(this, event)" value="<?=$asal_sample?>"></td></tr>
                 </table>
            </td>
            <td style="vertical-align: top;width=50%" align="right">
                <table id="serahterima" style="width: 98%;">
                    <tr><th>Kode alat pengiriman</th>       <td><input name="kodealat" id="kodealat" required onkeypress="return handleEnter(this, event)" type="text" value="<?=$kode_alat?>"></td></tr>
                    <tr><th>Suhu pada saat diterima</th>    <td><input name="suhu" id="suhu" type="text" required onkeypress="return handleEnter(this, event)" size="3" value="<?=$suhu?>"><sup>o</sup>C</td></tr>
                    <tr><th>Keadaan umum saat diterima</th> <td><input name="keadaan" id="keadaan" type="text" required onkeypress="return handleEnter(this, event)"" value="<?=$keadaan?>"></td></tr>
                    <tr><th>Peruntukan</th>                 <td>Pengolahan dan pemeriksaan IMLD & KGD</tr>
                </table>
            </td>
        </tr>
        </table>

            <br>
            <table id="entrybox" style="border-collapse: collapse;border: 2px solid #ff0000;width: 100%; box-shadow: 1px 2px 2px #800000;">
                <tr>
                    <td>Masukkan Nomor Kantong</td>
                    <td><input type=text name=nomorkantong id=nomorkantong autofocus onkeypress="return handleEnter(this, event)"></td>
                    <td>Status Sample</td>
                    <td><select name="sr_sample" id="sr_sample" onkeypress="return handleEnter(this, event)">
                            <option value="1">Sesuai</option>
                            <option value="0">Tidak Sesuai</option>
                        </select></td>
                    <td>Status serah terima</td>
                    <td><select name="sr_status" id="sr_status" onkeypress="return handleEnter(this, event)">
                            <option value="1">Sesuai</option>
                            <option value="0">Tidak Sah</option>
                        </select></td>
                    <td><input type="submit" name="submit1" value="Ok" class="swn_button_red" style="color: #ffff00"></td>
                </tr>
                <tr>
                    <td style="height: 30px">Status Proses</td><td colspan="7"><?=$message?></td>
                </tr>
            </table>


    <br>
    <table id="serahterima" width="100%" style="border-collapse: collapse;border: 1px solid #808080;box-shadow: 1px 2px 2px #000000;">
        <tr style="font-size: 12px">
            <th style="height: 40px;text-align: center;font-weight: bold">No</th>
            <th style="height: 40px;text-align: center;font-weight: bold">No Kantong</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Jenis<br>Ktg</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Merk</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Gol<br>Drh</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Tgl<br>Aftap</th>
            <th style="height: 40px;text-align: center;font-weight: bold">No Aftap</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Status<br>Kantong</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Lama<br>Aftap</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Kode Donor</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Jenis<br>Donor</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Dnr Ulang/<br>Baru</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Umur<br>Donor</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Jenis<br>Kel</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Ptgs<br>Aftap</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Sample<br>Darah</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Status<br>Terima</th>
            <th style="height: 40px;text-align: center;font-weight: bold">Aksi</th>
        </tr>
        <?php
        $no=0;
        $qry="SELECT `dst_id`, `dst_nokantong`, `dst_statusktg`, `dst_golda`, `dst_rh`, `dst_kodedonor`, `dst_berat`, `dst_volumektg`,`dst_sahktg`,`dst_merk`,
               `dst_ptgaftap`, `dst_volambil`, `dst_no_aftap`, date(`dst_tglaftap`) AS `dst_tglaftap`,
        	  CASE WHEN `dst_dsdp`='0' THEN 'DS' ELSE 'DP' END AS `dst_dsdp`, 
        	  CASE WHEN `dst_lamabaru`='0' THEN 'BR' ELSE 'UL' END AS `dst_lamabaru`,
        	  CASE WHEN `dst_kel`='0' THEN 'LK' ELSE 'PR' END AS `dst_kel`, 
        	  `dst_umur`, `dst_lama_aftap`,
              CASE
              WHEN `dst_jenisktg`='1' THEN 'SB'
              WHEN `dst_jenisktg`='2' THEN 'DB'
              WHEN `dst_jenisktg`='3' THEN 'TR'
              WHEN `dst_jenisktg`='4' THEN 'QD'
              WHEN `dst_jenisktg`='6' THEN 'PB' END As `dst_jenisktg`,
              CASE WHEN `dst_sample`='1' THEN 'Sesuai' ELSE 'Tdk Sesuai' END AS`dst_sample`,
              CASE WHEN `dst_sah`='0' THEN 'Tdk Sesuai' Else 'Sesuai' END AS `dst_sah`
              FROM `serahterima_detail_tmp`
              WHERE `dst_modul`='KARANTINA' and `dst_user`='$namauser' order by `dst_id` DESC";
		//echo "$qry";
        $sql=mysql_query($qry);
        $no=mysql_num_rows($sql)+1;
        while ($tmp=mysql_fetch_assoc($sql)){
            $no--;
            switch ($tmp[dst_statusktg]) {
                case '0':$ckt_status="Kosong";break;
                case '1':if($tmp['dst_sahktg']=="0"){ $ckt_status="Aftap";}else{$ckt_status="Karantina";}break;
                case '2':$ckt_status="Sehat";break;
                case '3':$ckt_status="Keluar";break;
                case '4':$ckt_status="Rusak-Reaktif";break;
                case '5':$ckt_status="Rusak-Gagal";break;
                case '6':$ckt_status="Rusak-Dimusnahkan";break;
                default : $ckt_status="Kantong Belum Terdaftar";
                break;
            }
            ?>
            <tr style="font-size: 12px">
                <td align="right"><?=$no?>.</td>
                <td><?=$tmp['dst_nokantong']?></td>
                <td align="center"><?=$tmp['dst_jenisktg']?></td>
                <td><?=$tmp['dst_merk'].' '.$tmp['dst_volumektg']?> ml</td>
                <td style="text-align: center"><?=$tmp['dst_golda'].$tmp['dst_rh']?></td>
                <td align="center"><?=$tmp['dst_tglaftap']?></td>
                <td><?=$tmp['dst_no_aftap']?></td>
                <td><?=$ckt_status?></td>
                <td><?=$tmp['dst_lama_aftap']?> mnt</td>

                <td><?=$tmp['dst_kodedonor']?></td>
                <td style="text-align: center"><?=$tmp['dst_dsdp']?></td>
				<td style="text-align: center"><?=$tmp['dst_lamabaru']?></td>
				<td style="text-align: center"><?=$tmp['dst_umur']?></td>
                <td style="text-align: center"><?=$tmp['dst_kel']?></td>
                <td style="text-align: center"><?=$tmp['dst_ptgaftap']?></td>
                <td><?=$tmp['dst_sample']?></td>
                <td style="text-align: center"><?=$tmp['dst_sah']?></td>
                
                <td><a href="pmikomponen.php?module=delrow&op=del&ktg=<?=$tmp['dst_nokantong']?>&usr=<?=$namauser?>&mdl=KARANTINA" onclick="return confirm('PERHATIAN \n \nYakin akan menghapus Nomor kantong \n<?=$tmp['dst_nokantong']?> ?');">Hapus</a></td>
            </tr>
            <?php
        }
        ?>
    	<tr>
    		<td style="vertical-align: top;" colspan="7">
                <table id="serahterima">
                    <tr><th>Petugas yang menyerahkan</th>
                        <td><select name="ptg_menyerahkan" id="ptg_menyerahkan">
                                <?
                                $usr=mysql_query("select nama_lengkap from user WHERE (upper(bagian) like '%AFTAP%' or upper(bagian) like '%PENGAMBILAN%') and aktif='0' order by nama_lengkap");
                                while ($usr1=mysql_fetch_assoc($usr)){
                                    ?><option value="<?=$usr1[nama_lengkap]?>"><?=$usr1['nama_lengkap']?><?
                                }
                                ?>
                        </select></td>
                    </tr>
                    <tr><th>Petugas yang menerima darah</th>
                        <td><select name="ptg_penerima" id="ptg_penerima">
                                <?
                                $usr=mysql_query("select nama_lengkap from user WHERE (upper(bagian) like '%KOMPONEN%' or upper(bagian) like '%PENGOLAHAN%' or upper(bagian) like '%KARANTINA%' or upper(bagian) like '%PENYIMPANAN%') and aktif='0' order by nama_lengkap");
                                while ($usr1=mysql_fetch_assoc($usr)){
                                ?><option value="<?=$usr1[nama_lengkap]?>"><?=$usr1['nama_lengkap']?><?
                                    }
                                    ?>
                            </select></td>
                    </tr>
                    <tr><th>Petugas yang menerima sampel</th>
                        <td><select name="ptg_sah" id="ptg_sah">
                                <?
                                $usr=mysql_query("select nama_lengkap from user WHERE (upper(bagian) like '%UJI SARING%' or upper(bagian) like '%IMLTD%' or upper(bagian) like '%SCREENING%' or upper(bagian) like '%KGD%') and aktif='0' order by nama_lengkap");
                                while ($usr1=mysql_fetch_assoc($usr)){
                                ?><option value="<?=$usr1[nama_lengkap]?>"><?=$usr1['nama_lengkap']?><?
                                    }
                                    ?>
                            </select></td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top;" colspan="11">
                <table id="serahterima" style="border: 0px; width: 100%;">
                    <tr><th colspan="2">CATATAN</th></tr>
                    <tr><th>Jenis Ktg (Kantong)</th><td>SB : Single; DB : Double; TR : Tripple; QD : Quadrupple; PB : Pediatrik</td></tr>
                    <tr><th>Jenis Donor</th><td>DS:Donor Sukarela; DP : Donor Pengganti</td></tr>
                    <tr><th>Dnr (Donor) Baru/Ulang</th><td>BR : Donor BARU; UL : Donor ULANG</td></tr>
                    <tr><th>Jenis Kelamin</th><td>LK : Laki-laki; PR : Perempuan</td></tr>
                </table>
            </td>
        </tr>
    </table>
    <hr style="width: 100%;text-align:left;margin-left:0; line-height: 1px" >
    <input type="submit" name="submit2" value="Simpan Proses Serah Terima" class="swn_button_blue">
    <a href="pmikomponen.php?module=batal&op=batal&usr=<?=$namauser?>&mdl=<?=$modul?>" onclick="return confirm('PERHATIAN \n \nYakin akan membatalkan transaksi Serah Terima ini?');" class="swn_button_blue">Batalkan Proses Serah Terima</a>
    <a href="serahterima/sr_aftap_rpt.php?notrans=<?=$notrans?>&nodok=<?=$nodokumen?>"class="swn_button_blue">Cetak</a>
</form>
