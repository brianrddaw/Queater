<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class QrCodeController extends Controller
{
    public function generateQrCode()
    {
        // Change the image format to PNG

        // String to generate the QR code
        $string = 'holaaaaa';

        // Generate the QR code
        $qr = QrCode::generate($string,storage_path('app/public/qrcodes_images/'). $string . '.svg');

        // Ruta del archivo SVG
        $svgFilePath = storage_path('app/public/qrcodes_images/'). $string . '.svg';

        // Ruta de salida para el archivo PNG
        $pngFilePath = storage_path('app/public/qrcodes_images/'). $string . '.png';


        //TODO: Crear la mesa en la base de datos y guardar la ruta de la imagen en la base de datos.
    }


    //TODO: Crear la función para descargar el archivo SVG en especifico.
    function downloadQrCode()
    {
        $filePath = 'qrcodes_images/holaaaaa.svg';

        // Verificar si el archivo existe
        if (Storage::disk('public')->exists($filePath)) {
            // Descargar el archivo SVG
            return Storage::disk('public')->download($filePath);
        } else {
            // Si el archivo no existe, redirigir o mostrar un mensaje de error
            return redirect()->back()->with('error', 'El archivo SVG no existe.');
        }

    }
}
