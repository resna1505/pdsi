<?php

namespace App\Services;

use App\Models\Anggota;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;

/**
 * Render Kartu Tanda Anggota (ukuran kartu ID standar 85,6 x 54 mm).
 */
class KtaService
{
    /**
     * Data untuk view member.kta.card.
     * $inline = true: gambar di-embed base64 (untuk PDF/JPG); false: pakai URL (untuk halaman web).
     */
    public function cardData(Anggota $anggota, bool $inline = true): array
    {
        $anggota->loadMissing('perhimpunan');

        if (!$anggota->kta_token && $anggota->no_kartu_anggota) {
            $anggota->forceFill(['kta_token' => Str::random(40)])->save();
        }

        if (!$inline) {
            $avatarPath = 'storage/images/users/' . $anggota->avatar;

            return [
                'anggota' => $anggota,
                'frontBg' => $this->publicUrl($anggota->ktaBackgroundPath('front')),
                'backBg' => $this->publicUrl($anggota->ktaBackgroundPath('back')),
                'avatar' => $anggota->avatar && is_file(public_path($avatarPath)) ? asset($avatarPath) : null,
                'qr' => $this->qrDataUri($anggota),
            ];
        }

        return [
            'anggota' => $anggota,
            'frontBg' => $this->imageDataUri($anggota->ktaBackgroundPath('front')),
            'backBg' => $this->imageDataUri($anggota->ktaBackgroundPath('back')),
            'avatar' => $this->avatarDataUri($anggota),
            'qr' => $this->qrDataUri($anggota),
        ];
    }

    public function verificationUrl(Anggota $anggota): ?string
    {
        if (!$anggota->kta_token) {
            return null;
        }

        return route('kta.verify', $anggota->kta_token);
    }

    public function pdf(Anggota $anggota)
    {
        $pdf = Pdf::loadView('member.kta.pdf', $this->cardData($anggota));
        // 85,6 x 54 mm dalam point
        $pdf->setPaper([0, 0, 242.65, 153.07]);

        return $pdf;
    }

    /**
     * Render satu sisi kartu ke JPG, kembalikan path file sementara.
     */
    public function jpg(Anggota $anggota, string $side): string
    {
        $html = view('member.kta.image', $this->cardData($anggota) + ['side' => $side])->render();

        $dir = storage_path('app/public/temp');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $path = $dir . '/' . Str::uuid() . '.jpg';

        $browsershot = Browsershot::html($html)
            ->noSandbox()
            ->timeout(60)
            ->setScreenshotType('jpeg', 95)
            ->windowSize(647, 408) // 85,6 x 54 mm pada 96 dpi, diperbesar 2x
            ->deviceScaleFactor(3)
            ->dismissDialogs()
            ->ignoreHttpsErrors();

        if ($chromePath = config('services.browsershot.chrome_path')) {
            $browsershot->setChromePath($chromePath);
        }

        $browsershot->save($path);

        return $path;
    }

    public function filename(Anggota $anggota, string $suffix, string $extension): string
    {
        return 'KTA_' . $suffix . '_' . Str::slug($anggota->nama, '_') . '.' . $extension;
    }

    private function publicUrl(string $path): string
    {
        return asset(ltrim(str_replace(public_path(), '', $path), '/'));
    }

    private function imageDataUri(?string $path): ?string
    {
        if (!$path || !is_file($path)) {
            return null;
        }

        return 'data:' . mime_content_type($path) . ';base64,' . base64_encode(file_get_contents($path));
    }

    /**
     * Foto anggota di-crop 3:4 agar tidak gepeng (DomPDF tidak mendukung object-fit).
     */
    private function avatarDataUri(Anggota $anggota): ?string
    {
        $path = $anggota->avatar ? public_path('storage/images/users/' . $anggota->avatar) : null;
        if (!$path || !is_file($path)) {
            return null;
        }

        if (!function_exists('imagecreatefromstring')) {
            return $this->imageDataUri($path);
        }

        $source = @imagecreatefromstring(file_get_contents($path));
        if (!$source) {
            return $this->imageDataUri($path);
        }

        $width = imagesx($source);
        $height = imagesy($source);
        $cropWidth = min($width, (int) round($height * 3 / 4));
        $cropHeight = min($height, (int) round($cropWidth * 4 / 3));
        $x = (int) (($width - $cropWidth) / 2);
        $y = (int) (($height - $cropHeight) / 4); // sedikit ke atas, agar wajah tidak terpotong

        $target = imagecreatetruecolor(450, 600);
        imagecopyresampled($target, $source, 0, 0, $x, $y, 450, 600, $cropWidth, $cropHeight);

        ob_start();
        imagejpeg($target, null, 90);
        $jpeg = ob_get_clean();

        imagedestroy($source);
        imagedestroy($target);

        return 'data:image/jpeg;base64,' . base64_encode($jpeg);
    }

    private function qrDataUri(Anggota $anggota): ?string
    {
        $url = $this->verificationUrl($anggota);
        if (!$url) {
            return null;
        }

        if (!function_exists('imagecreate')) {
            $svg = QrCode::format('svg')->size(300)->margin(1)->errorCorrection('M')->generate($url);

            return 'data:image/svg+xml;base64,' . base64_encode($svg);
        }

        // PNG via GD: DomPDF tidak bisa merender QR SVG, dan format PNG
        // simple-qrcode membutuhkan imagick.
        return 'data:image/png;base64,' . base64_encode($this->qrPng($url));
    }

    private function qrPng(string $content, int $moduleSize = 10, int $margin = 1): string
    {
        $matrix = Encoder::encode($content, ErrorCorrectionLevel::M())->getMatrix();
        $modules = $matrix->getWidth();
        $size = ($modules + $margin * 2) * $moduleSize;

        $image = imagecreate($size, $size);
        imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        for ($y = 0; $y < $modules; $y++) {
            for ($x = 0; $x < $modules; $x++) {
                if ($matrix->get($x, $y) === 1) {
                    $left = ($x + $margin) * $moduleSize;
                    $top = ($y + $margin) * $moduleSize;
                    imagefilledrectangle($image, $left, $top, $left + $moduleSize - 1, $top + $moduleSize - 1, $black);
                }
            }
        }

        ob_start();
        imagepng($image);
        $png = ob_get_clean();
        imagedestroy($image);

        return $png;
    }
}
