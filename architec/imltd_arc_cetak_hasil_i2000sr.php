<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?php
  include('clogin.php');
  include('config/db_connect.php');
  $namauser=$_SESSION[namauser];
  $namalengkap=$_SESSION[nama_lengkap];
  $no_id	= $_GET['noid'];
  $notrans	= $_GET['notrans'];
  $utd		= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
    $q_arc0="SELECT `id`, `no_trans`, `instr`, `instr_v`, `scc_serial`, `interface_sn`, `arc_serial`, date(`trans_time`) as trans_time, `user`,
            `id_tes`, `carrier`, `position`,
            `b_lot_reag`, `b_id_raw`, `b_ed_reag`, `b_kode_reag`, `b_sn_reag`, `b_abs`, `b_run_time`, `b_hasil`, `b_ket_tes`,
            `c_lot_reag`, `c_id_raw`, `c_ed_reag`, `c_kode_reag`, `c_sn_reag`, `c_abs`, `c_run_time`, `c_hasil`, `c_ket_tes`,
            `i_lot_reag`, `i_id_raw`, `i_ed_reag`, `i_kode_reag`, `i_sn_reag`, `i_abs`, `i_run_time`, `i_hasil`, `i_ket_tes`,
            `s_lot_reag`, `s_id_raw`, `s_ed_reag`, `s_kode_reag`, `s_sn_reag`, `s_abs`, `s_run_time`, `s_hasil`, `s_ket_tes`,
            `konfirmer`, `koonfirm_time`, `disahkan`, `status_kantong`, `konfirm_action`
            FROM `imltd_arc_konfirm` WHERE `id`='$no_id'";
  	$q_arc1=mysql_query($q_arc0);
    //echo "$q_arc0<br>";
    $hasil_b="";
    $hasil_c="";
    $hasil_i="";
    $hasil_s="";
    $abs_b=""; $ket_b="";
    $abs_c=""; $ket_c="";
    $abs_i=""; $ket_i="";
    $abs_s=""; $ket_s="";
    while ($imltd=mysql_fetch_assoc($q_arc1)){
          $tanggalperiksa=$imltd['koonfirm_time'];
          $sampleid=$imltd['id_tes'];
          switch ($imltd['b_hasil']){
              case '0' : $hasil_b="NR";break;
              case '1' : $hasil_b="R";break;
              case '2' : $hasil_b="GZ"; break;
              default  :  $hasil_b="";
          }
          switch ($imltd['c_hasil']){
              case '0' : $hasil_c="NR";break;
              case '1' : $hasil_c="R";break;
              case '2' : $hasil_c="GZ"; break;
              default  :  $hasil_c="";
          }
          switch ($imltd['i_hasil']){
              case '0' : $hasil_i="NR";break;
              case '1' : $hasil_i="R";break;
              case '2' : $hasil_i="GZ"; break;
              default  :  $hasil_i="";
          }
          switch ($imltd['s_hasil']){
              case '0' : $hasil_s="NR";break;
              case '1' : $hasil_s="R";break;
              case '2' : $hasil_s="GZ"; break;
              default  :  $hasil_s="";
          }
        if ($hasil_b!==""){
              $abs_b=$imltd['b_abs'];
              $ket_b=$imltd['b_ket_tes'];
          }
        if (!$hasil_c==""){
            $abs_c=$imltd['c_abs'];
            $ket_c=$imltd['c_ket_tes'];
        }
        if (!$hasil_i==""){
            $abs_i=$imltd['i_abs'];
            $ket_i=$imltd['i_ket_tes'];
        }
        if (!$hasil_s==""){
            $abs_s=$imltd['s_abs'];
            $ket_s=$imltd['s_ket_tes'];
        }
      }
    ?>
    <title>HASIL UJI SARING IMLTD <?=$utd[nama]?></title>
    <img src='images/header_pmi_750x62.png' width=750px>
    <body>
    <h1><?=$utd[nama]?></h1>
    <h2><strong><a href="javascript:window.print()">HASIL PEMERIKSAAN UJI SARING DARAH</a></strong></h2>
    <form name="transaksi"  method="post" action="<?=$PHPSELF?>">
        <table class="record" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
            <tr>
		        <td width=120>No. Periksa</td><td class="input" >: <?=$notrans.'/'.$no_id?></td>
		        <td width=130>Tgl. Periksa</td><td width=150 class="input">: <?=$tanggalperiksa?></td>
            </tr>
            <tr>
		        <td>ID Sampel</td><td class="input">: <?=$sampleid?></td>
		        <td></td><td class="input"></td>
            </tr>
        </table>
        <table class="record" border="1" cellspacing="0" cellpadding="5" width=750 style="border-collapse:collapse">
            <tr>
                <td align=center rowspan=2><b>No</td>
	            <td align=center rowspan=2><b>Parameter Uji Saring IMLTD</td>
	            <td align=center colspan=4><b>Hasil</td>
            </tr>
            <tr>
	            <td align=center><b>Metode</td>
	            <td align=center><b>OD</td>
	            <td align=center><b>Interpretasi</td>
	            <td align=center><b>Keterangan</td>
            </tr>
            <tr>
	            <td align=center>1.</td>
                <td>HBsAg</td>
                <td>CHLIA</td>
                <td align=right><?=$abs_b?></td>
                <td align=center><?=$hasil_b?></td>
	            <td align="left"><?=$ket_b?></td>
            </tr>
            <tr>
                <td align=center>2.</td>
                <td>Anti HCV</td>
                <td>CHLIA</td>
                <td align=right><?=$abs_c?></td>
                <td align=center><?=$hasil_c?></td>
                <td align="left"><?=$ket_c?></td>
            </tr>
            <tr>
                <td align=center>3.</td>
                <td>Anti HIV</td>
                <td>CHLIA</td>
                <td align=right><?=$abs_i?></td>
                <td align=center><?=$hasil_i?></td>
                <td align="left"><?=$ket_i?></td>
            </tr>
            <tr>
                <td align=center>4.</td>
                <td>Syphilis/TPHA</td>
                <td>CHLIA</td>
                <td align=right><?=$abs_s?></td>
                <td align=center><?=$hasil_s?></td>
                <td align="left"><?=$ket_s?></td>
            </tr>
        </table>
            <table class="list" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
            <tr>
                <td></td><td></td>
            </tr>
            <tr>
                <td align="center" valign="top"><br><br>Pemeriksa,<br><br><br><br></td>
                <td align="center" valign="top"><br><?=$utd[nama]?><br>Penanggung Jawab,</td>
            </tr>
            <tr>
                <td align="center" class="input" ><?=$namalengkap?></td>
                <td align="center" class="input" >.....................................</td>
            </tr>
        </table>
    </form>
    </body>