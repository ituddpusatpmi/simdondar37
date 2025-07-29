<head>
<script type="text/javascript">
function showHint(str){
   if (str.length==0){ 
      document.getElementById("txtHint").innerHTML="";
      return;
   }
   if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
   } else  {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
   xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
         document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
      }
   }
   xmlhttp.open("GET","tpk/ambil_sampletpk_act.php?q="+str,true);
   xmlhttp.send();
}
</script>
</head>
<div style="background-color: #ffffff;font-size:22px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Cari Pendonor</div>
<form>
    <table class="list" border=1 cellspacing=2 cellpadding=2>
        <tr class="field">
            <td class="input"> Cari pendonor </td><td><input type="text" placeholder="Cari kode atau nama pendonor" onkeyup="showHint(this.value)" style="width:10cm;" />
            </td>
        </tr>
    </table>
</form>
<p><span id="txtHint"></span></p>