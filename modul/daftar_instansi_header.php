<head>
<script type="text/javascript">
function showHint(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","modul/daftar_instansi.php?q1="+str,true);
xmlhttp.send();
}
</script>
PENCARIAN NAMA INSTANSI
</head>
<form> 
Ketik Nama Instansi : <input type="text" onkeyup="showHint(this.value)" size="40" />
</form>
<p><span id="txtHint"></span></p>

