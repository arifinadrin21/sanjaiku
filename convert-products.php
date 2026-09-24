<?php

$folder = __DIR__ . '/public/storage/products';

$files = glob($folder . '/*.{jpg,jpeg,png}', GLOB_BRACE);

if (!$files) {
    exit("Tidak ada gambar JPG/JPEG/PNG ditemukan.\n");
}

foreach ($files as $file) {

    $info = getimagesize($file);

    if (!$info) {
        echo "Lewati: " . basename($file) . "\n";
        continue;
    }

    $source = imagecreatefromstring(file_get_contents($file));

    if (!$source) {
        echo "Gagal membaca: " . basename($file) . "\n";
        continue;
    }

    $originalWidth = imagesx($source);
    $originalHeight = imagesy($source);

    $maxWidth = 600;
    $maxHeight = 600;

    $ratio = min(
        $maxWidth / $originalWidth,
        $maxHeight / $originalHeight,
        1
    );

    $newWidth = (int) round($originalWidth * $ratio);
    $newHeight = (int) round($originalHeight * $ratio);

    $optimized = imagecreatetruecolor(
        $newWidth,
        $newHeight
    );

    // Background putih
    $white = imagecolorallocate(
        $optimized,
        255,
        255,
        255
    );

    imagefill(
        $optimized,
        0,
        0,
        $white
    );

    imagecopyresampled(
        $optimized,
        $source,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $originalWidth,
        $originalHeight
    );

    $fileName = pathinfo($file, PATHINFO_FILENAME);

    $output = $folder . '/' . $fileName . '.webp';

    imagewebp(
        $optimized,
        $output,
        80
    );

    imagedestroy($source);
    imagedestroy($optimized);

    $oldSize = round(filesize($file) / 1024, 1);
    $newSize = round(filesize($output) / 1024, 1);

    echo "----------------------------------------\n";
    echo "File   : " . basename($file) . "\n";
    echo "Ukuran : {$originalWidth}x{$originalHeight}\n";
    echo "Lama   : {$oldSize} KB\n";
    echo "WebP   : {$newSize} KB\n";
    echo "Output : " . basename($output) . "\n";
}

echo "\nSELESAI.\n";