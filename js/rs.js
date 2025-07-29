var instansi_kode = [];
var instansi_nama = [];
function drs(noform) {
	var nama_rs = document.permintaandarah.nama_rs;
	ClearOptions(document.permintaandarah.nama_rs);
	var instansi1 = cariinstansi(noform);
//	AddToOptionList(document.permintaandarah.nama_rs, "Pilih", "Pilih RS");
	for (i=0; (i < instansi_kode.length); i++) {
	AddToOptionList(document.permintaandarah.nama_rs, instansi_kode[i], instansi_nama[i]);
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
function cariinstansi(noform)
   {
     $.ajax({
         url: "rs.php?nf="+noform,
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
