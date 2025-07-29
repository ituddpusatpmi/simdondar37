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
  $notrans	= $_GET['notrans'];
  $metode	= $_GET['metode'];
  $sampleid	= $_GET['nokantong'];
  $utd		= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
  if ($metode=='nat'){
  	$q_nat=mysql_query("SELECT `id`, `date_transfer`, `sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`,
        `internal_Control_result`, `analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`,
        `analyte_cutoff`, `neg_calibrator_analyte_avg`, `neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`,
        `hcv_pos_analyte_avg`, `hcv_pos_calibartor_ic_avg`, `lot_number`, `lot_date`, `procleix_sn`, `procleix_firmware`,
        `run_number_prefix`, `type_of_tube`, `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`, `userinput`, `konfirmasi`,
        `tgl_konfirmasi`, `userkonfirmasi` FROM `imltd_procleix_raw` WHERE `id`='$notrans'");
      while ($imltd=mysql_fetch_assoc($q_nat)){
          $tanggalperiksa=$imltd['date'];
          $hasil         =$imltd['interpretation'];
          $ic_rlu        =$imltd['internal_control_rlu'];
          $ic_result     =$imltd['internal_Control_result'];
          $anal_rlu      =$imltd['analyte_rlu'];
          $anal_result   =$imltd['analyte_s_co'];
      }
  }

if ($metode=='nat'){
    ?>
    <title>HASIL UJI SARING IMLTD NAT<?=$utd[nama]?></title>
    <img src='images/header_pmi_750x62.png' width=750px>
    <body>
    <h1><?=$utd[nama]?></h1>
    <h2><strong><a href="javascript:window.print()">HASIL PEMERIKSAAN UJI SARING DARAH (NAT)</a></strong></h2><br><br>
    <form name="transaksi"  method="post" action="<?=$PHPSELF?>">
        <table class="record" border="0" cellspacing="1" cellpadding="5" width=750 style="border-collapse:collapse">
            <tr>
		        <td width=120>No. Periksa</td><td class="input" >: <?=$notrans?></td>
		        <td width=120>Tgl. Periksa</td><td width=200 class="input">: <?=$tanggalperiksa?></td>
            </tr>
            <tr>
		        <td>ID Sampel<br></td><td class="input">: <?=$sampleid?></td>
		        <td></td><td class="input"></td>
            </tr>
        </table>
        <br><br>
        <table class="record" border="1" cellspacing="0" cellpadding="10" width=750 style="border-collapse:collapse">
            <tr>
                <td align=center colspan="2"><b>Internal Control</td>
	            <td align=center colspan="3"><b>Result</td>
            </tr>
            <tr>
	            <td align=center><b>RLU</td>
	            <td align=center><b>Result</td>
	            <td align=center><b>RLU</td>
	            <td align=center><b>S/CO</td>
                <td align=center><b>Interpretation</td>
            </tr>
            <tr>
                <td align=center><?=$ic_rlu?></td>
                <td align=center><?=$ic_result?></td>
                <td align=center><?=$anal_rlu?></td>
                <td align=center><?=$anal_result?></td>
                <td align=center><?=$hasil?></td>
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
    </body><?
}
