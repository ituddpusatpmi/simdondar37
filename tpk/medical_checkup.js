function setCheckedValue(radioObj, newValue) {
		if(!radioObj)
		    return;
			var radioLength = radioObj.length;
			if(radioLength == undefined) {
				radioObj.checked = (radioObj.value == newValue.toString());
				return;
			}
			for(var i = 0; i < radioLength; i++) {
				radioObj[i].checked = false;
				if(radioObj[i].value == newValue.toString()) {
					radioObj[i].checked = true;
				}
			}
	}

function suhutubuh(suhu){
		suhu=parseFloat(suhu)
		if(suhu>37){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}

function berat(hb){
		hb=parseFloat(hb)
		if(hb<45){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}

function chb(hb){
		hb=parseFloat(hb)
		if(hb!=1){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else {
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}

function sistol(hb){
		hb=parseFloat(hb)
		if(hb<90){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
		if(hb>150){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}

function diastol(hb){
		hb=parseFloat(hb)
		if(hb<60){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
		if(hb>100){
			setCheckedValue(document.periksa.elements['h_medical'],'1');
		}else{
			if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
		}
	}

function showHint(str){
   if (str.length==0){ 
      document.getElementById("imltd").innerHTML="Input kode sampel";
      document.getElementById("nat").innerHTML="Input kode sampel";
      document.getElementById("kgd").innerHTML="Input kode sampel";
      document.getElementById("titer").innerHTML="Input kode sampel";
      document.getElementById("abs").innerHTML="Input kode sampel";
      return;
   }
   if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
   } else  {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
   xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
          var hasil=xmlhttp.responseText;
          var res = hasil.split(";");
         document.getElementById("imltd").innerHTML=res[0];
         document.getElementById("nat").innerHTML=res[1];
         document.getElementById("kgd").innerHTML=res[2];
         document.getElementById("hemoglobin").value=res[4];
         document.getElementById("hematokrit").value=res[5];
         document.getElementById("trombosit").value=res[6];
         document.getElementById("leukosit").value=res[7];
         document.getElementById("abs").innerHTML=res[8];
         var samplevalid=res[9].trim();
         document.getElementById("id_samplevalid").value=samplevalid;
         if (document.getElementById('titer')){
             document.getElementById("titer").innerHTML=res[3];}
         document.getElementById("id_imltd").innerHTML=res[12];
         document.getElementById("id_nat").innerHTML=res[13];
        
      }
   }
   xmlhttp.open("GET","tpk/gethasilab.php?q="+str,true);
   xmlhttp.send();
}

function checkrequired(which){
    var pass=true
    var lolos="undifined";
    var msg="";
    var msg2="";
    var ele = document.getElementsByName('h_medical'); 
    for(i = 0; i < ele.length; i++) { 
        if(ele[i].checked) 
            lolos=  ele[i].value; 
    } 

    if (lolos==1){
        var r = confirm("Hasil Seleksi Tidak Lolos, apakah akan dilanjutkan?");
        if (r == true) {
            pass=true;
        } else {
            pass=false;
            mgs2=" Hasil seleksi tidak lolos ";
        }
    }
    
    if (document.images){
        for (i=0;i<which.length;i++){
            var tempobj=which.elements[i];
            if (tempobj.name.substring(0,3)=="req"){
                if (((tempobj.type=="text"||tempobj.type=="hidden"||tempobj.type=="textarea")&&tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
                    pass=false;
                    msg="Beberapa parameter masih belum terisi atau belum valid, data belum bisa disimpan!";
                    msg2="Lengkapi data dengan benar sebelum disimpan!";
                    break;
                }
            }
        }
    }

    if (!pass){
        alert(msg);
        document.getElementById("alert1").innerHTML=msg2;
        return false;
    }
    else
    return true;
}
