<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Pemeriksaan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Writer;

use Illuminate\Support\Facades\Response;

class BarcodeController extends Controller
{
    // Menampilkan barcode untuk hasil anak
    public function showBarcode($id)
    {
        $anak = Anak::findOrFail($id);
        $pemeriksaanTerakhir = $anak->pemeriksaan()->latest()->first();

        if ($pemeriksaanTerakhir) {
            $qrUrl = route('scan.hasil', ['id' => $pemeriksaanTerakhir->id_pemeriksaan]);
        } else {
            $qrUrl = route('scan_tinggi', ['id' => $anak->id]);
        }

        // Gunakan format SVG (tidak perlu imagick)
        $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(250)->generate($qrUrl);

        return view('pages.barcode', compact('anak', 'qrcode'));
    }


    // Download QR

    public function download($id)
    {
        $anak = Anak::findOrFail($id);
        $pemeriksaanTerakhir = $anak->pemeriksaan()->latest()->first();

        if ($pemeriksaanTerakhir) {
            $qrUrl = route('scan.hasil', ['id' => $pemeriksaanTerakhir->id_pemeriksaan]);
        } else {
            $qrUrl = route('scan_tinggi', ['id' => $anak->id]);
        }

        // Hasilkan QR Code dalam format SVG
        $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(300)->generate($qrUrl);

        return \Illuminate\Support\Facades\Response::make($qrcode, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="barcode-anak-' . $anak->id . '.svg"',
        ]);
    }
}
