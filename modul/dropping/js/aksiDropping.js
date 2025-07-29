/* script.js */

function handleKeyPress(event) {
  var noTrans = document.getElementById("noTransIsi").value;
  var tglMinta = document.getElementById("tglMintaIsi").value;
  var tujuan = document.getElementById("tujuanIsi").value.trim();
  var jenisMinta = document.getElementById("jenisMintaIsi").value.trim();
  // var jMPisah = document.getElementById("jMPisah").value.trim();
  // var jSPisah = document.getElementById("jSPisah").value.trim();
  // var shift = document.getElementById("shift").value;

  if (event.key === "Enter") {
    const nomorKantong = event.target.value.trim(); // Trim untuk menghapus spasi ekstra
    if (nomorKantong) {
      if (isValidNomorKantong(nomorKantong)) {
        insertData(nomorKantong, noTrans, tglMinta, tujuan, jenisMinta);
      } else {
        // showAlert("Nomor Kantong tidak valid. Harap periksa kembali.");
        showModal("Nomor Kantong tidak valid. Harap periksa kembali.");
      }
    }
  }
}

function isValidNomorKantong(nomorKantong) {
  // Contoh validasi: nomor kantong harus terdiri dari angka
  //return /^\d+$/.test(nomorKantong); // apabila hanya angka saja nomor kantongnya
  return /^[a-zA-Z0-9]+$/.test(nomorKantong); // apabila huruf dan angka nomor kantongnya
}

function insertData(nomorKantong, noTrans, tglMinta, tujuan, jenisMinta) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "modul/dropping/droppingTemp.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.status === "error") {
        showModal(response.message); // Tampilkan modal dengan pesan error
      } else if (response.status === "success") {
        window.location.reload(); // Refresh halaman jika sukses
      }
    } else {
      showModal("Terjadi kesalahan saat menyimpan data.");
    }
  };

  xhr.onerror = function () {
    showModal("Terjadi kesalahan koneksi. Mohon coba lagi.");
  };

  xhr.send(
    "nomorKantong=" +
      encodeURIComponent(nomorKantong) +
      "&noTrans=" +
      encodeURIComponent(noTrans) +
      "&tglMinta=" +
      encodeURIComponent(tglMinta) +
      "&tujuan=" +
      encodeURIComponent(tujuan) +
      "&jenisMinta=" +
      encodeURIComponent(jenisMinta)
  ); // Pastikan untuk encode parameter
}

function showModal(message) {
  // Implementasikan modal bootstrap atau buat modal custom sesuai kebutuhan
  $("#errorModal .modal-body").html(message);
  $("#errorModal").modal("show");
}
