<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code Generator</title>
    <link href="assets/bootstrap-5.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        #preview {
            border: 1px dashed #ccc;
            padding: 20px;
            text-align: center;
            min-height: 200px;
        }

        #qr-result {
            margin-top: 20px;
        }

        .form-icon {
            width: 2rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4 text-center"><i class="bi bi-upc-scan me-2"></i>QR Code Generator</h2>

        <div class="card shadow">
            <div class="card-body">
                <form id="qrForm" action="proses_generate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="textInput" class="form-label">URL atau Teks</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan URL atau teks..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="logoInput" class="form-label">Upload Logo (opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-image"></i></span>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-qr-code me-1"></i>Generate QR Code
                    </button>
                </form>
            </div>
        </div>

        <div id="qr-result" class="mt-4">
            <h5>Preview:</h5>
            <div id="preview">QR Code akan muncul di sini...</div>
        </div>
    </div>

    <script src="assets/bootstrap-5.3.7/js/bootstrap.bundle.min.js"></script>
    <script src="assets/jquery/jquery.min.js"></script>
    <!-- Tambahkan script QR Code generator di sini -->
    <script>
        $(document).ready(function() {
            $('#qrForm').on('submit', function(e) {
                e.preventDefault();

                // Ambil input teks
                var url = $('#url').val();
                if (!url) {
                    alert('Mohon masukkan URL atau teks untuk QR Code.');
                    return;
                }

                // Buat form data untuk upload logo jika ada
                var formData = new FormData(this);
                formData.append('barcode', url);

                // Kirim data ke proses_generate.php
                $.ajax({
                    url: 'proses_generate.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        $('#preview').html(
                            `<img src="` + response.image + `" alt="QR Code" class="img-fluid"><br>
                            <a href="` + response.image + `" download="qr_code.png" class="btn btn-success mt-2">
                                <i class="bi bi-download me-1"></i>Download QR Code
                            </a>`
                        );
                        alert(response.message);
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat membuat QR Code.');
                    }
                });
            });
        });
    </script>
</body>

</html>