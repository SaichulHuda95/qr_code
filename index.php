<?php
// https://www.malasngoding.com
// memanggil library php qrcode
include "phpqrcode/qrlib.php";

// isi qrcode yang ingin dibuat. akan muncul saat di scan
$barcode = 'https://e-sppt.sampangkab.go.id/cek_pbb.php';
// lokasi simpan
$codesDir = "assets/";
// nama file
$codeFile = 'sppt_sampang.png';
$formData = $barcode;
// perintah untuk membuat qrcode dan menampilkannya secara langsung dengan format .PNG
QRcode::png($formData, $codesDir . $codeFile);
