<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class OptimizeProductImages extends Command
{
    protected $signature = 'images:optimize
        {--width=500 : Lebar maksimum gambar hasil resize}
        {--quality=75 : Kualitas kompresi WebP (0-100)}';

    protected $description = 'Resize dan kompres ulang semua gambar produk di storage/products';

    public function handle()
    {
        $disk = Storage::disk('public');
        $path = 'products';

        if (!$disk->exists($path)) {
            $this->error("Folder storage/app/public/{$path} tidak ditemukan.");
            return 1;
        }

        $manager = ImageManager::usingDriver(Driver::class);

        $files = $disk->files($path);
        $maxWidth = (int) $this->option('width');
        $quality  = (int) $this->option('quality');

        $totalBefore = 0;
        $totalAfter  = 0;

        foreach ($files as $file) {
            // Lewati file yang bukan gambar
            if (!preg_match('/\.(jpg|jpeg|png|webp)$/i', $file)) {
                continue;
            }

            $fullPath = $disk->path($file);
            $sizeBefore = filesize($fullPath);

            $image = $manager->decode($fullPath);

            // Crop ke rasio persegi (1:1) sesuai tampilan kartu produk,
            // lalu resize ke ukuran target. cover() akan crop bagian
            // tengah gambar supaya pas mengisi persegi tanpa distorsi.
            if ($image->width() !== $image->height() || $image->width() > $maxWidth) {
                $image->cover($maxWidth, $maxWidth);
            }

            // Encode ulang sebagai WebP dengan kompresi lebih ketat, lalu simpan
            $image->encodeUsingFormat(Format::WEBP, quality: $quality)
                ->save($fullPath);

            $sizeAfter = filesize($fullPath);

            $totalBefore += $sizeBefore;
            $totalAfter  += $sizeAfter;

            $this->info(sprintf(
                '%s: %s KB -> %s KB',
                basename($file),
                number_format($sizeBefore / 1024, 1),
                number_format($sizeAfter / 1024, 1)
            ));
        }

        $this->newLine();
        $this->info(sprintf(
            'Total: %s KB -> %s KB (hemat %s KB)',
            number_format($totalBefore / 1024, 1),
            number_format($totalAfter / 1024, 1),
            number_format(($totalBefore - $totalAfter) / 1024, 1)
        ));

        return 0;
    }
}