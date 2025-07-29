<!--
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/jquery-1.4.2.min.js"></script>
<script language=javascript src="js/jquery-ui-1.8.6.custom.min.js"></script>
--!> 
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<script language="javascript">
function selectSupplier(Kode){
	  $('input[@name=kodeSup]').val(Kode);
	    tb_remove(); 
}
function selectKode(Kode){
	  $('input[@name=kode]').val(Kode);
	    tb_remove(); 
		dbar(Kode);
}
function clearForm() {
        document.minta.kode.value="";
        document.minta.stoktotal.value="";
        document.minta.juminta.value="";
        document.minta.ket.value="";
}
function addRow(tableID) {


                        var table = document.getElementById(tableID);

                        var rowCount = table.rows.length;
                        var row = table.insertRow(rowCount);

                        var cell1 = row.insertCell(0);
                        var element1 = document.createElement("input");
                        element1.type = "checkbox";
                        cell1.appendChild(element1);
                        var cell10 = row.insertCell(1);
			var element10 = document.createElement("input");
                        element10.type = "text";
                        element10.size = "3";
                        element10.value = rowCount;
                        element10.innerHtml = rowCount;
                        cell10.appendChild(element10);

                        var cell2 = row.insertCell(2);
                        var element2 = document.createElement("input");
                        element2.type = "text";
                        element2.size = "11";
                        element2.value = document.minta.notrans.value;
                        element2.innerHtml = document.minta.notrans.value;
			element2.name = "notrans[]";
			cell2.appendChild(element2);

                        var cell3 = row.insertCell(3);
                        var element3 = document.createElement("input");
                        element3.type = "text";
                        element3.size = "14";
                        element3.value = document.minta.kode.value;
			element3.innerHtml = document.minta.kode.value;
                        element3.name = "kode[]";
                        //element3.onkeydown = "chang(event,this);";
                        cell3.appendChild(element3);

                        var cell4 = row.insertCell(4);
                        var element4 = document.createElement("input");
                        element4.type = "text";
                        element4.size = "12";
                        element4.value = document.minta.stoktotal.value;
			element4.innerHtml = document.minta.stoktotal.value;
                        element4.name = "stoktotal[]";
                        //element4.onkeydown = "chang(event,this);";
                        cell4.appendChild(element4);
			
                        var cell5 = row.insertCell(5);
                        var element5 = document.createElement("input");
                        element5.type = "text";
                        element5.size = "12";
                        element5.value = document.minta.juminta.value;
			element5.innerHtml = document.minta.juminta.value;
                        element5.name = "juminta[]";
                        //element4.onkeydown = "chang(event,this);";
                        cell5.appendChild(element5);
			
			var cell6 = row.insertCell(6);
                        var element6 = document.createElement("input");
                        element6.type = "text";
                        element6.size = "13";
                        element6.value = document.minta.ket.value;
			element6.innerHtml = document.minta.ket.value;
                        element6.name = "ket[]";
                        //element5.onkeydown = "chang(event,this);";
                        cell6.appendChild(element6);
                        clearForm();
                }
function deleteRow(tableID) {
                        var table = document.getElementById(tableID);
                        var rowCount = table.rows.length;
                        for(var i=0; i<rowCount; i++) {
                                var row = table.rows[i];
                                var chkbox = row.cells[0].childNodes[0];
                                if(null != chkbox && true == chkbox.checked) {
                                        table.deleteRow(i);
                                        rowCount--;
                                        i--;
                                }
		}
	}

 </script>
<style>
   body,table,input{
   	font-size:12px
   }
 </style>

<style type="text/css">
<!--
@import url("topstyleb.css");
-->
</style>
<script language="javascript">
    function setFocus(){document.minta.kode.focus();}
</script>
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namabagian=$_SESSION[namabagian];
$today=date('Y-m-d');
if (isset($_POST[submit])) {
    for ($i=0;$i<count($_POST[notrans]);$i++) {
        $nt=$_POST[notrans][$i];
        $kd=$_POST[kode][$i];
        $jm=$_POST[juminta][$i];
        $st=$_POST[stoktotal][$i];
        $kt=$_POST[ket][$i];
        $tambah=mysql_query("insert into dpermintaan (KodeBrg,jumMinta,JumBeri,Ket,notrans) values ('$kd','$jm','0','$kt','$nt')");
	if ($tambah) echo ("Data telah ditambahkan !! <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");
	$stok=mysql_fetch_assoc(mysql_query("select status from hstok where Kode='$kd'"));
	$lv=mysql_fetch_assoc(mysql_query("select level from user where id_user='$namauser'"));
	if ($lv[level]=='admin') $level="P";
	if (($lv[level]=='laboratorium') or ($lv[level]=='aftap') or ($lv[level]=='logistik')) $level="L";
	if ($lv[level]=='kasir') $level="K";
        $tambah1=mysql_query("insert into hpermintaan (NoTrans,tgl,nama,level,jenis,status) values ('$nt','$today','$namauser','$level','$stok[status]','0')");
    }
}
//======Membuat Nomor Otomatis================
$kodet = "P";
$kodet4 = $today=date("Y");
$kodet5 = substr($today,2,2);
$kodet6 = $today=date("dm");
$kodet7 = $kodet6.$kodet5;
$kodet1 = mysql_fetch_assoc(mysql_query("select notrans from dpermintaan where substring(notrans,2,6)='$kodet7' order by notrans desc limit 1"));
$kodet2 = substr($kodet1[notrans],8,3);
$kodet3 = $kodet2+1;
$kode_trans=$kodet.$kodet7;
if ($kodet2>="009") {
    $digi="0"; } else { $digi="00";} 
//============================================
?>
<body onLoad=setFocus()>
<form name="minta" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
<table>
    <tr>
        <td valign="top">
    <h1 class="table">Form Permintaan Barang</h1>
    <table class="form" border="0" cellspacing="1" cellpadding="2">
        <script type="text/javascript">
            function dbar(browser){
                var barang1;
                $.ajax({
                        url: "brg.php?kode="+browser,
                        async: false,
                        dataType: 'json',
                        success: function(json) {
                                barang1 = json.barang.stok;
                        }
                });
		document.minta.stoktotal.value=barang1;
            }
        </script>
        <script>
            function hitung(){
                var stok = eval(document.minta.stoktotal.value);
                var jum = eval(document.minta.juminta.value);
                var total = stok - jum;
                document.minta.stoktotal.value=total;
            }
        </script>
    <tr>
        <td>No Transaksi</td>
        <td class="input">
	<input type="hidden" name="notrans" id="notrans" value="<?=$kode_trans?>-<?=$digi?><?=$kodet3?>" >
	&nbsp <?=$kode_trans?>-<?=$digi?><?=$kodet3?></td>
        </tr>
    <tr>
	<td>Kode Barang </td>
	<td class="input"><input name="kode" id="kode" type="text" size="15"><a href="modul/daftar_barang.php?&width=400&height=350" class="thickbox"><img src="images/button_search.png" border="0" /></a></td>
	</tr>
    <tr>
	<td>Stok Barang</td>
	<td class="input"><input name="stoktotal" type="text" size="10"></td>
	</tr>
    <tr>
	<td>Jumlah Minta</td>
	<td class="input"><input onChange="hitung()" name="juminta" type="text" size="20"></td>
        </tr>
    <tr>
	<td>Keterangan</td>
	<td class="input"><input name="ket" type="text" size="20"></td>
        </tr>
    </table>
    </td>
    <td width="30"></td>
    <td valign=top>
        <table class="list" id="box-table-b" width=350px align=top cellpadding=2 cellspacing=2>
            <tr class="field">
                <td align='center'></td>
                <td align='center'>No</td>
                <td align='center'>No Transaksi</td>
                <td align='center'>Kode Barang</td>
                <td align='center'>Stok Barang</td>
                <td align='center'>Jumlah Minta</td>
                <td align='center'>Keterangan</td>
                </tr>
        </table>
        <INPUT type="button" value="Hapus baris" onclick="deleteRow('box-table-b')" />
        </td>
        </tr>
            <tr>
                <td><input name="submit" type="submit" value="Simpan">
                <input type="button" value="Tambah" onclick="addRow('box-table-b');">
                </td>
                <td> </td>
            </tr>
    </table>
</form>


<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
