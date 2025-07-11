# 📦 Tutorial Penggunaan QR Code Generator (PHP)

## ✅ Fitur

- Generate QR Code dari teks atau URL
- Simpan QR Code sebagai file `.png` di folder `assets/`
- Mendukung penambahan logo/icon di tengah QR Code _(opsional)_

---

## 🛠 Cara Penggunaan

1. **Ganti isi QR Code**

   - Buka file PHP utama.
   - Temukan variabel berikut:
     ```php
     $barcode = 'https://e-sppt.sampangkab.go.id/cek_pbb.php';
     ```
   - Ganti dengan teks atau link yang kamu inginkan.

2. **Ganti nama file hasil**

   - Masih di file yang sama, temukan baris ini:
     ```php
     $codeFile = 'qris.png';
     ```
   - Ganti nama file sesuai kebutuhan (contoh: `'kode_saya.png'`).

3. **Jalankan script-nya**
   - Jalankan file PHP tersebut melalui browser atau CLI.
   - QR Code akan otomatis digenerate dan disimpan di folder `assets/`.

---

## 📌 Penambahan Logo di Tengah QR (Opsional)

Jika ingin menambahkan **logo/icon di tengah QR Code**:

- Siapkan file PNG logo, misalnya `logo.png`
- Simpan di folder `assets/`
- Gunakan kode tambahan berikut:

```php
<?php
include "phpqrcode/qrlib.php";

$barcode = 'https://e-sppt.sampangkab.go.id/cek_pbb.php';
$codesDir = "assets/";
$codeFile = 'qris.png';

QRcode::png($barcode, $codesDir . $codeFile, QR_ECLEVEL_H, 10);

$QR = imagecreatefrompng($codesDir . $codeFile);
$logo = imagecreatefrompng('assets/logo.png');

$QR_width = imagesx($QR);
$QR_height = imagesy($QR);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);

$logo_qr_width = $QR_width / 4;
$scale = $logo_width / $logo_qr_width;
$logo_qr_height = $logo_height / $scale;

$from_width = ($QR_width - $logo_qr_width) / 2;

imagecopyresampled(
    $QR, $logo,
    $from_width, $from_width,
    0, 0,
    $logo_qr_width, $logo_qr_height,
    $logo_width, $logo_height
);

imagepng($QR, $codesDir . 'qris_logo.png');
imagedestroy($QR);
imagedestroy($logo);
?>
```
