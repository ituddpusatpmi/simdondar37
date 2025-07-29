<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$jamskr=new DateTime(date("Y-m-d H:i:s"));
$hariini = date("Y-m-d");
    
       if(isset($_POST['submit1']))
       {
           $catat = $_POST['komentar'];
           $nama  = $namauser;
           $sh    = $_POST['shift'];
           
           $simpan = mysql_query("INSERT INTO catatan (ket,shift,ptgs1)values('$catat','$sh','$nama')");
           
           if($simpan){?>
                <meta http-equiv="refresh" content="0" />
               
           <?}
           
       }
    

    if (isset($_POST[batal2])) {

            ?><META http-equiv="refresh" content="0; url=pmikasir2.php?module=rekap_catatan"><?
                
            
              }
    
?>
<!DOCTYPE html>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<html>
<head>
    <style>
        tr { background-color: #ffffff;}
        .initial { background-color: #ffffff; color:#000000 }
        .normal { background-color: #ffffff; }
        .highlight { background-color: #7CFC00 }
    </style>

    <style>
        .control {
            font-family: arial;
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 2px;
            padding-top: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        .control input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }
        .control_indicator {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e6e6e6;
            border: 0px solid #000000;
        }
        .control-radio .control_indicator {
            border-radius: undefined%;
        }

        .control:hover input ~ .control_indicator,
        .control input:focus ~ .control_indicator {
            background: #cccccc;
        }

        .control input:checked ~ .control_indicator {
            background: #ff0000;
        }
        .control:hover input:not([disabled]):checked ~ .control_indicator,
        .control input:checked:focus ~ .control_indicator {
            background: #0e6647d;
        }
        .control input:disabled ~ .control_indicator {
            background: #e6e6e6;
            opacity: 0.6;
            pointer-events: none;
        }
        .control_indicator:after {
            box-sizing: unset;
            content: '';
            position: absolute;
            display: none;
        }
        .control input:checked ~ .control_indicator:after {
            display: block;
        }
        .control-checkbox .control_indicator:after {
            left: 8px;
            top: 4px;
            width: 3px;
            height: 8px;
            border: solid #ffffff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .control-checkbox input:disabled ~ .control_indicator:after {
            border-color: #7b7b7b;
        }
    </style>

<style type="text/css">
    .styled-select select {
        background-color: #F0FFFF; border: none;width: auto;padding: 3px;font-size: 16px;cursor: pointer;
    }
</style>
<style>
    table {
    border-collapse: collapse;
    }
    table, th, td {
    border: 1px solid brown;
    }
</style>
<style>
body {font-family: "Lato", sans-serif;}
.tablink {
    background-color: red;
    color: white;
    float: left;
    border: 1px solid brown;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 15px;
    width: 33.3%;
}
.tablink:hover {
    background-color: #777;
}
/* Style the tab content */
.tabcontent {
    color: black;
    display: none;
    padding: 10px;
    border: 1px solid brown;
}
#visual {background-color:white;}
#kantong {background-color:white;}
#pemeriksaan {background-color:white;}
#pengolahan {background-color:white;}
#trace {background-color:white;}
#history {background-color:white;}
</style>

</head>
<body>
<?php
if(isset($_POST['Button']))  {
    
} //post
    ?>
    <button class="tablink" onclick="bukatab('open', this, 'Blue')" id="defaultOpen">CATATAN BELUM SELESAI</button>
    <button class="tablink" onclick="bukatab('close', this, 'Blue')">CATATAN SUDAH SELESAI</button>
    <button class="tablink" onclick="bukatab('new', this, 'Blue')">TAMBAH CATATAN</button>
    


    <div id="close" class="tabcontent">
            <table cellpadding=3 cellspacing=3 width="100%" style="border: 0px; border-color: #ffffff;">
                       <tr>
                           <td valign="top">
                           <?
                               $open = mysql_query("SELECT
                               id,DATE_FORMAT(tgl_masuk, '%d %M %Y %H:%i:%s') as tgl_masuk,shift,ket,ptgs1,DATE_FORMAT(tgl_selesai, '%d %M %Y %H:%i:%s') as tgl_selesai,ptgs2,stat
                               FROM
                               pmi.catatan where stat=1");
                              
                           ?>
                               <table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
                                    <tr style="background-color:#FF0000">
                                       <td align="center" style="color:white; font-size:10pt;" width=5%>NO</td>
                                       <td align="center" style="color:white; font-size:10pt;" width=15%>TGL. CATATAN</td>
                                       <td align="center" style="color:white; font-size:10pt;" width=5%>SHIFT</td>
                                       <td align="center" style="color:white; font-size:10pt;" width=10%>PENCATAT</td>
                                       <td align="center" style="color:white; font-size:10pt;" width=35%>KETERANGAN</td>
                                       <td align="center" style="color:white; font-size:10pt;" width=15%>TGL. SELESAI</td>
                                       <td align="center" style="color:white; font-size:10pt;" width=15%>PETUGAS</td>
                                   </tr>
                       <? $no=0;
                       while($data = mysql_fetch_assoc($open)){
                       $no++;?>
                         <tr>
                             <td align="center"><?=$no?>.</td>
                             <td align="center"><?=$data[tgl_masuk]?></td>
                             <td align="center"><?=$data[shift]?></td>
                             <td align="center"><?=$data[ptgs1]?></td>
                             <td ><pre><?=$data[ket]?></pre></td>
                            <td align="center"><?=$data[tgl_selesai]?></td>
                             <td align="center"><?=$data[ptgs2]?></td>
                           
                               
                         </tr>
                           
                       <?
                       }
                       ?>
                       </table>
                           </td>
                       </tr>
                   </table>
    </div>

    

    <div id="open" class="tabcontent">
        <p>
        <table cellpadding=3 cellspacing=3 width="100%" style="border: 0px; border-color: #ffffff;">
            <tr>
                <td valign="top">
                <?
                    $open = mysql_query("SELECT
                    id,DATE_FORMAT(tgl_masuk, '%d %M %Y %H:%i:%s') as tgl_masuk,shift,ket,ptgs1,DATE_FORMAT(tgl_selesai, '%d %M %Y %H:%i:%s') as tgl_selesai,ptgs2,stat
                    FROM
                    pmi.catatan where stat=0");
                   
                ?>
                    <table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
                         <tr style="background-color:#FF0000">
                            <td align="center" style="color:white; font-size:10pt;" width=5%>NO</td>
                            <td align="center" style="color:white; font-size:10pt;" width=15%>TANGGAL</td>
                            <td align="center" style="color:white; font-size:10pt;" width=10%>SHIFT</td>
                            <td align="center" style="color:white; font-size:10pt;" width=10%>PETUGAS</td>
                            <td align="center" style="color:white; font-size:10pt;" width=35%>KETERANGAN</td>
                            <td align="center" style="color:white; font-size:10pt;" width=15%> AKSI</td>
                        </tr>
            <? $no=0;
            while($data = mysql_fetch_assoc($open)){
            $no++;?>
              <tr>
                  <td align="center"><?=$no?>.</td>
                  <td align="center"><?=$data[tgl_masuk]?></td>
                  <td align="center"><?=$data[shift]?></td>
                  <td align="center"><?=$data[ptgs1]?></td>
                  <td ><textarea cols="100" rows="10" readonly><?=$data[ket]?></textarea></td>
                  <td align="center">
                    <a href="../pmikasir2.php?module=rekap_edit&id=<? echo "$data[id]";?>" class="swn_button_red">Edit</a>
                    <a href="../pmikasir2.php?module=rekap_selesai&id=<? echo "$data[id]";?>" class="swn_button_blue">Selesai</a>
                        
                  </td>
                
                    
              </tr>
                
            <?
            }
            ?>
            </table>
                </td>
            </tr>
        </table>
    </div>
            
            
            <div id="new" class="tabcontent">
                <p>
                <table cellpadding=3 cellspacing=3 width="100%" style="border: 0px; border-color: #ffffff;">
                    <tr>
                        <td valign="top">
                        <form method="POST" action="">
                        <table cellpadding=3 cellspacing=3 width="100%" style="border: 0px;">
                            <tr>
                                <td valign="top">CATATAN : </td>
                                <td><textarea name="komentar" cols="100" rows="10">Silahkan keterangan anda</textarea>
                                    <input type="hidden" name="petugas" value="<?=$namauser?>">
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Shift</td>
                                        <td >
                                            <? $s1='';$s2='';$s3='';$s4='';
                                                $waktu=date('H:i:s');
                                                $jam1=mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
                                                $jam2=mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));
                                                $jam3=mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
                                                $jam4=mysql_fetch_assoc(mysql_query("select * from shift where nama='IV'"));
                                                
                                                $sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];$sh4=$jam4[jam];
                                                if ($waktu >= $sh1 ){ $s1='selected';}
                                                if ($waktu >= $sh2 ){ $s2='selected';}
                                                if ($waktu >= $sh3 ){ $s3='selected';}
                                                if ($waktu < $sh1 ){ $s4='selected';}
                                            ?>
                                            <?
                                $td0=php_uname('n');
                                $td0=strtoupper($td0);
                                $td0=substr($td0,0,1);
                                if ($td0!="M") { ?>
                                            <select name="shift">
                                                <option value="1" <?=$s1?>>SHIFT I</option>
                                                <option value="2" <?=$s2?>>SHIFT II</option>
                                                <option value="3" <?=$s3?>>SHIFT III</option>
                                                <option value="4" <?=$s4?>>SHIFT IV</option>
                                                
                                            </select></td>
                                    <?}?>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="submit1" class="swn_button_red" value="SIMPAN">
                                    <input type="submit" name="batal2" class="swn_button_red" value="BATAL">
                                </td>
                                        
                            </tr>
                        </table>
                        </form>
                        
                        </td>
                    </tr>
                </table>
            </div>
    


<script>
function bukatab(namatab,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(namatab).style.display = "block";
    elmnt.style.backgroundColor = color;
}
document.getElementById("defaultOpen").click();
</script>
</body>
            <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
            <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
            <script>
            $(document).ready(function() {
            $('.datatab').DataTable();
            } );
            </script>
</html>
