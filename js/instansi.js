var instansi_kode = [];
var instansi_nama = [];
function dinstansi() {
	var tempat = document.periksa.tempat;
	var tempat1 = tempat[tempat.selectedIndex].value;
	ClearOptions(document.periksa.instansi);
	if (tempat1!='0-Dalam Gedung') {
	var instansi1 = cariinstansi();
	AddToOptionList(document.periksa.instansi, "Pilih", "Pilih Instansi");
	for (i=0; i<instansi_kode.length; i++) {
	AddToOptionList(document.periksa.instansi, instansi_kode[i], instansi_nama[i]);
	}
	}
}
function ClearOptions(OptionList) {
	for (x = OptionList.length; x >= 0; x = x - 1) {
		OptionList[x] = null;
	}
}
function AddToOptionList(OptionList, OptionValue, OptionText) {
	OptionList[OptionList.length] = new Option(OptionText, OptionValue);
	}
function cariinstansi()
   {
     $.ajax({
         url: "instansi.php",
         async: false,
         dataType: 'json',
         success: function(json) {
         instansi_kode.length=0;
         instansi_nama.length=0;
         jQuery.each(json.instansi,function(i,instansi){
         instansi_kode.push(instansi.kode);
         instansi_nama.push(instansi.nama);
         });
         }
     });
 }
