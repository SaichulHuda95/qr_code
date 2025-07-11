<?php
include "phpqrcode/qrlib.php";

// Isi QR dan path
$barcode = 'https://e-sppt.sampangkab.go.id/cek_pbb.php';
$codesDir = "assets/";
$codeFile = 'qris.png';

// 1. Buat QR Code PNG (disimpan dulu)
QRcode::png($barcode, $codesDir . $codeFile, QR_ECLEVEL_H, 10); // gunakan level H biar tahan kerusakan saat ditutup logo

// 2. Buka gambar QR Code dan logo
$QR = imagecreatefrompng($codesDir . $codeFile);
$logo = imagecreatefrompng('assets/logo.png'); // ganti sesuai logo kamu

// 3. Ukuran gambar
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);

// 4. Hitung ukuran logo yang di-resize
$logo_qr_width = $QR_width / 4; // logo jadi 1/4 ukuran QR
$scale = $logo_width / $logo_qr_width;
$logo_qr_height = $logo_height / $scale;

// 5. Hitung posisi tengah
$from_width = ($QR_width - $logo_qr_width) / 2;

// 6. Tempel logo ke tengah QR
imagecopyresampled(
    $QR,
    $logo,
    $from_width,
    $from_width,
    0,
    0,
    $logo_qr_width,
    $logo_qr_height,
    $logo_width,
    $logo_height
);

// 7. Simpan hasil akhir
imagepng($QR, $codesDir . 'qris_logo.png');
imagedestroy($QR);
imagedestroy($logo);

echo "QR Code dengan logo berhasil dibuat: qris_logo.png";
