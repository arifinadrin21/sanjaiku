<?php

$folder = __DIR__ . '/public/storage/products';

$files = [
    '1786024124_kerupuk-sanjai-cabai-hijau_compressed.webp',
    '1790157404_kerupuk-sanjai-balado-manis.webp',
    '1789001679_keju-pedas_compressed.webp',
    '1786024015_kerupuk-sanjai-balado-pedas_compressed.webp',
    '1786023872_muhammad-arifin_compressed.webp',
];

foreach ($files as $file) {

    $source = $folder . '/' . $file;

    if (!file_exists($source)) {
        echo "Tidak ditemukan: $file\n";
        continue;
    }

    $image = imagecreatefromwebp($source);

    if (!$image) {
        echo "Gagal membaca: $file\n";
        continue;
    }

    $width = imagesx($image);
    $height = imagesy($image);

    $newWidth = 400;
    $newHeight = 240;

    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    imagealphablending($newImage, false);
    imagesavealpha($newImage, true);

    imagecopyresampled(
        $newImage,
        $image,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $width,
        $height
    );

    $output = $folder . '/' . pathinfo($file, PATHINFO_FILENAME) . '_400.webp';

    imagewebp($newImage, $output, 70);

    imagedestroy($image);
    imagedestroy($newImage);

    echo "Berhasil: $output\n";
}