function scrollToContactMe() {
  if ($('#tsimdondar').length != 0) {
    $("html, body").animate({
      scrollTop: $('#contact').offset().top
    }, 1000);
  }
}
function scrollToSimdondar() {
  if ($('#tsimdondar').length != 0) {
    $("html, body").animate({
      scrollTop: $('#tsimdondar').offset().top
    }, 1000);
  }
}

function scrollToStok() {
  if ($('#stok').length != 0) {
    $("html, body").animate({
      scrollTop: $('#stok').offset().top
    }, 1000);
  }
}

function scrollToMU() {
  if ($('#jadwalmu').length != 0) {
    $("html, body").animate({
      scrollTop: $('#jadwalmu').offset().top
    }, 1000);
  }
}

$(document).ready(function(){
  $(window).scroll(function(){
  	var scroll = $(window).scrollTop();
	  if (scroll > 99) {
      document.getElementById("logo").style.color = "red";
      document.getElementById('brandimage').src='index/logosimdondar.png';
      document.getElementById('brandimage').style="max-width: auto; height:70px;"
	  }
	  else{
      document.getElementById("logo").style.color = "white";
      document.getElementById('brandimage').src='index/logosimdondar.png';
      document.getElementById('brandimage').style="max-width: auto; height:70px;"
	  }
  })
})

$('#mdlimn').on('shown.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
  var mresult='';
  switch (id){
    case 1 : mresult='<h4>Kepatuhan Kebersihan Tangan</h4><h3 class="text-danger"> Target : >85%</h3>';break;
    case 2 : mresult='<h4>Kepatuhan Penggunaan Alat Pelindung Diri<h4><h3 class="text-danger"> Target : 100%</h3>';break;
    case 3 : mresult='<h4>Pemenuhan Kebutuhan Darah Oleh UTD</h4><h3 class="text-danger"> Target : 100%</h3>';break;
    case 4 : mresult='<h4>Donasi dari Pendonor Darah Sukarela</h4><h3 class="text-danger"> Target : >90%</h3>';break;
    case 5 : mresult='<h4>Hasil Golongan Darah Pendonor Yang Berbeda Dengan Uji KGD</h4><h3 class="text-danger"> Target : < 2%</h3>';break;
    case 6 : mresult='<h4>Suhu Penyimpanan Produk Darah</h4><h3 class="text-danger"> Target : 100%</h3>';break;
    case 7 : mresult='<h4>Kepuasan Pelanggan</h4><h3 class="text-danger"> Target : > 76,6%</h3>';break;
  }
  $('#dlgcontent').html(mresult);

})

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");
togglePassword.addEventListener("click", function () {
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

