<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

class BarcodeController extends Controller
{
    // Menampilkan barcode setelah data anak disimpan
    public function showBarcode($id)
    {
        $anak = Anak::findOrFail($id);
        $qrUrl = route('barcode.detail', $anak->id);

        $qrcode = base64_encode(QrCode::format('png')->size(200)->generate($qrUrl));

        return view('pages.hasil_deteksi', compact('anak', 'qrcode'));
    }

    // Halaman hasil setelah QR di-scan
    public function showDetail($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.hasil_deteksi', compact('anak'));
    }

    // Download QR
    public function download($id)
    {
        $anak = Anak::findOrFail($id);
        $qrUrl = route('barcode.detail', $anak->id);
        $qrcode = QrCode::format('png')->size(300)->generate($qrUrl);

        return Response::make($qrcode, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="barcode-anak-' . $anak->id . '.png"',
        ]);
    }
}
