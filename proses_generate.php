<?php
include "assets/phpqrcode/qrlib.php";

if (empty($_POST['url'])) {
    http_response_code(400);
    echo json_encode([
        'code' => 400,
        'message' => 'URL atau teks tidak boleh kosong.'
    ]);
    exit;
}

$url = $_POST['url'];
$logo = $_FILES['logo'];

$barcode = $url;
ob_start();
QRcode::png($barcode, null, QR_ECLEVEL_H, 10);
$imageData = ob_get_clean();
$base64Image = 'data:image/png;base64,' . base64_encode($imageData);

echo json_encode([
    'code' => 200,
    'message' => 'QR Code berhasil dibuat.',
    'image' => $base64Image
]);
