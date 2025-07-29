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
  if ($metode=='elisa'){
  	$q_elisa=mysql_query("SELECT `id`, `noKantong`, `OD`, `COV`, `notrans`,
                          case
                            when `Hasil`='0' then 'Non Reaktif'
                            when `Hasil`='1' then 'Reaktif'
                            when `Hasil`='2' then 'Grayzone'  End As Hasil,
                          case
                            when `jenisPeriksa`='0' then 'HBsAg'
                            when `jenisPeriksa`='1' then 'Anti HCV'
                            when `jenisPeriksa`='2' then 'Anti HIV'
                            when `jenisPeriksa`='3' then 'Syphilis' End As Parameter,
                          `tglPeriksa`, `dicatatOleh`, `dicekOleh`, `DisahkanOleh`, `noLot`, `Metode`, `ulang`, `up_data`, `insert_on`
                          FROM `hasilelisa`	WHERE noKantong='$sampleid' and notrans='$notrans'");
      $hasil_b="";
      $hasil_c="";
      $hasil_i="";
      $hasil_s="";
      while ($imltd=mysql_fetch_assoc($q_elisa)){
          $tanggalperiksa=$imltd['tglPeriksa'];
          switch ($imltd['Parameter']){
              case "HBsAg":
                  $hasil_b  = $imltd['Hasil'];
                  $od_b     = $imltd['OD'];
                  $metode_b = $imltd['Metode'];break;
              case "Anti HCV":
                  $hasil_c  = $imltd['Hasil'];
                  $od_c     = $imltd['OD'];
                  $metode_c = $imltd['Metode'];break;
              case "Anti HIV":
                  $hasil_i  = $imltd['Hasil'];
                  $od_i     = $imltd['OD'];
                  $metode_i = $imltd['Metode'];break;
              case "Syphilis":
                  $hasil_s  = $imltd['Hasil'];
                  $od_s     = $imltd['OD'];
                  $metode_s = $imltd['Metode'];break;
              default:break;
          }

      }
  } else {
  	$q_rapid=mysql_query("SELECT `id`, `NoTrans`, `noKantong`, `Kontrol`,
						case
							when `jenisperiksa`='0' then 'HBsAg'
						    when `jenisperiksa`='1' then 'Anti HCV'
						    when `jenisperiksa`='2' then 'Anti HIV'
						    when `jenisperiksa`='3' then 'Syphilis' End As Parameter,
						 case
						    when `Hasil`='1' then 'Non Reaktif'
						    when `Hasil`='0' then 'Reaktif' End As Hasil,
						 `nolot`, `tgl_tes`, `dicatatoleh`, `dicekOleh`, `DisahkanOleh`, `Metode`, `ulang`, `up_data`
						  FROM `drapidtest`	WHERE noKantong='$sampleid' and NoTrans='$notrans'");
      $hasil_b="";
      $hasil_c="";
      $hasil_i="";
      $hasil_s="";
      while ($imltd=mysql_fetch_assoc($q_rapid)){
          $tanggalperiksa=$imltd['tgl_tes'];
          switch ($imltd['Parameter']){
              case "HBsAg":
                  $hasil_b  = $imltd['Hasil'];
                  $metode_b = $imltd['Metode'];break;
              case "Anti HCV":
                  $hasil_c  = $imltd['Hasil'];
                  $metode_c = $imltd['Metode'];break;
              case "Anti HIV":
                  $hasil_i  = $imltd['Hasil'];
                  $metode_i = $imltd['Metode'];break;
              case "Syphilis":
                  $hasil_s  = $imltd['Hasil'];
                  $metode_s = $imltd['Metode'];break;
              default:break;
          }
      }
  }

if ($metode=='elisa'){
    ?>
    <title>HASIL UJI SARING IMLTD <?=$utd[nama]?></title>
    <img src='images/header_pmi_750x62.png' width=750px>
    <body>
    <h1><?=$utd[nama]?></h1>
    <h2><strong><a href="javascript:window.print()">HASIL PEMERIKSAAN UJI SARING DARAH</a></strong></h2>
    <form name="transaksi"  method="post" action="<?=$PHPSELF?>">
        <table class="record" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
            <tr>
		        <td width=120>No. Periksa</td><td class="input" >: <?=$notrans?></td>
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
                <td><?=$metode_b?></td>
                <td align=right><?=$od_b?></td>
                <td align=center><?=$hasil_b?></td>
	            <td></td>
            </tr>
            <tr>
                <td align=center>2.</td>
                <td>Anti HCV</td>
                <td><?=$metode_c?></td>
                <td align=right><?=$od_c?></td>
                <td align=center><?=$hasil_c?></td>
                <td></td>
            </tr>
            <tr>
                <td align=center>3.</td>
                <td>Anti HIV</td>
                <td><?=$metode_i?></td>
                <td align=right><?=$od_i?></td>
                <td align=center><?=$hasil_i?></td>
                <td></td>
            </tr>
            <tr>
                <td align=center>4.</td>
                <td>Syphilis/TPHA</td>
                <td><?=$metode_s?></td>
                <td align=right><?=$od_s?></td>
                <td align=center><?=$hasil_s?></td>
                <td></td>
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
} else {
    ?>
    <title>HASIL UJI SARING IMLTD <?=$utd[nama]?></title>
    <img src='images/header_pmi_750x62.png' width=750px>
    <body>
    <h1><?=$utd[nama]?></h1>
    <h2><strong><a href="javascript:window.print()">HASIL PEMERIKSAAN UJI SARING DARAH</a></strong></h2>
    <form name="transaksi"  method="post" action="<?=$PHPSELF?>">
        <table class="record" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
            <tr>
                <td width=120>No. Periksa</td><td class="input" >: <?=$notrans?></td>
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
                <td align=center colspan=3><b>Hasil</td>

            </tr>
            <tr>
                <td align=center><b>Metode</td>
                <td align=center><b>Interpretasi</td>
                <td align=center><b>Keterangan</td>
            </tr>
            <tr>
                <td align=center>1.</td>
                <td>HBsAg</td>
                <td><?=$metode_b?></td>
                <td align=center><?=$hasil_b?></td>
                <td></td>
            </tr>
            <tr>
                <td align=center>2.</td>
                <td>Anti HCV</td>
                <td><?=$metode_c?></td>
                <td align=center><?=$hasil_c?></td>
                <td></td>
            </tr>
            <tr>
                <td align=center>3.</td>
                <td>Anti HIV</td>
                <td><?=$metode_i?></td>
                <td align=center><?=$hasil_i?></td>
                <td></td>
            </tr>
            <tr>
                <td align=center>4.</td>
                <td>Syphilis/TPHA</td>
                <td><?=$metode_s?></td>
                <td align=center><?=$hasil_s?></td>
                <td></td>
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
<?}
