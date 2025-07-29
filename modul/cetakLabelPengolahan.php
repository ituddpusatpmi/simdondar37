<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Menu Cetak Manual Label</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }

        .form-label {
            font-weight: 600;
        }

        .container {
            max-width: 700px;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
            margin: 0;
        }

        h2 {
            margin-bottom: 30px;
        }
    </style>

</head>

<body>

    <div class="container">
        <h2 class="text-center"
            style="background-color: #912200; color: white; padding: 10px; border-radius: 8px; font-size: 24px;">CETAK
            LABEL KOMPONEN</h2>

        <form id="formLabelManual">
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Tipe Barcode</label>
                <div class="col-sm-8">
                    <select class="form-select" name="barcode" required>
                        <option value="C128">CODE 128 AUTO</option>
                        <option value="C128A">CODE 128 A</option>
                        <option value="C128B">CODE 128 B</option>
                        <option value="C39">CODE 39</option>
                        <option value="C39E">CODE 39 EXTENDED</option>
                        <option value="C93">CODE 93 - USS-93</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jenis Label</label>
                <div class="col-sm-8">
                    <select class="form-select" name="jenisLabel" required>
                        <option value="1">Label 1 Kolom -- (20mm x 50mm)</option>
                        <option value="2">Label 2 Kolom -- (20mm x 50mm)</option>
                    </select>

                </div>
            </div>

            <!-- Ukuran label dikomentari dulu -->
            <!--
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Ukuran Label</label>
                <div class="col-sm-8">
                    <select class="form-select" name="ukuran">
                        <option value="20x50">2 cm x 5 cm (20mm x 50mm)</option>
                        <option value="20x40">2 cm x 4 cm (20mm x 40mm)</option>
                    </select>
                </div>
            </div>
            -->

            <div class="row mb-4">
                <label class="col-sm-4 col-form-label">No. Kantong / Transaksi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="noData" placeholder="Contoh: E1234567A atau KV3XX-123456-1234"
                        required>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modalPreviewLabel" tabindex="-1" aria-labelledby="modalPreviewLabelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalPreviewLabelLabel">Label Komponen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe id="iframeLabel" style="width: 100%; height: 90vh; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {

            function handleInputChange() {
                var inputan = $('input[name="noData"]').val().trim();
                var barcode = $('select[name="barcode"]').val();
                var jenisLabel = $('select[name="jenisLabel"]').val();

                if (!inputan) {
                    alert("DATA tidak boleh kosong.");
                    return;
                }

                if (inputan.length < 8) {
                    alert("Panjang DATA minimal 8 karakter.");
                    return;
                }

                $.ajax({
                    url: 'modul/prosesCLKomponen.php',
                    type: 'POST',
                    data: {
                        inputan: inputan,
                        barcode: barcode,
                        kolom: jenisLabel
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log("Response dari PHP:", data);
                        if (data.status === 'ok') {
                            var targetFile = (jenisLabel === '1')
                                ? 'labelPengolahan1Kolom.php'
                                : 'labelPengolahan2Kolom.php';

                            var url = targetFile + "?nT=" + encodeURIComponent(inputan) + "&barcode=" + barcode + "&transaksi=" + encodeURIComponent(data.tipe);
                            $('#iframeLabel').attr('src', url);
                            var modal = new bootstrap.Modal(document.getElementById('modalPreviewLabel'));
                            modal.show();

                            // Refresh page when modal is closed
                            $('#modalPreviewLabel').on('hidden.bs.modal', function () {
                                location.reload();
                            });
                        } else {
                            alert("DATA tidak valid.");
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("Gagal mengambil data: " + xhr.responseText);
                    }
                });
            }

            $('input[name="noData"]').on('change', handleInputChange);

            $('#formLabelManual').on('submit', function (e) {
                e.preventDefault();
                handleInputChange();
            });
        });
    </script>

</body>

</html>
