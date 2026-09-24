Add-Type -AssemblyName System.Drawing

$folder = Join-Path (Get-Location) "storage\app\public\products"

$files = Get-ChildItem $folder -File |
    Where-Object { $_.Extension -match '\.(png|jpg|jpeg)$' }

foreach ($file in $files) {

    try {
        $image = [System.Drawing.Image]::FromFile($file.FullName)

        $maxWidth = 1200

        if ($image.Width -gt $maxWidth) {
            $newWidth = $maxWidth
            $newHeight = [int]($image.Height * ($newWidth / $image.Width))
        } else {
            $newWidth = $image.Width
            $newHeight = $image.Height
        }

        $bitmap = New-Object System.Drawing.Bitmap($newWidth, $newHeight)

        $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
        $graphics.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
        $graphics.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
        $graphics.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality

        $graphics.DrawImage($image, 0, 0, $newWidth, $newHeight)

        $output = Join-Path $folder ($file.BaseName + "_compressed.jpg")

        $jpegCodec = [System.Drawing.Imaging.ImageCodecInfo]::GetImageEncoders() |
            Where-Object { $_.MimeType -eq "image/jpeg" }

        $encoderParams = New-Object System.Drawing.Imaging.EncoderParameters(1)
        $encoderParams.Param[0] = New-Object System.Drawing.Imaging.EncoderParameter(
            [System.Drawing.Imaging.Encoder]::Quality,
            80L
        )

        $bitmap.Save($output, $jpegCodec, $encoderParams)

        $graphics.Dispose()
        $bitmap.Dispose()
        $image.Dispose()

        Write-Host "Berhasil: $($file.Name) -> $(Split-Path $output -Leaf)"
    }
    catch {
        Write-Host "Gagal: $($file.Name)"
        Write-Host $_.Exception.Message
    }
}