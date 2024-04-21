<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Table;
use Illuminate\Http\Response;

class TableController extends Controller
{
    protected $qrCodeController;

    public function __construct(QrCodeController $qrCodeController)
    {
        $this->qrCodeController = $qrCodeController;
    }

    public function showTables()
    {
        $tables = Table::all();
        return view('dashboard-views.dashboard-tables', ['tables' => $tables]);
    }

    public function createTable()
    {
        //El numero de la mesa nueva sera el numero de mesas + 1
        $number = DB::table('tables')->count() + 1;
        //Crea la nueva mesa en la base de datos usando el modelo
        $table = new Table();
        $table->id = $number;
        $table->number = $number;
        $table->save();

        //Crear el QR de la mesa através de la función generateQrCode
        $this->qrCodeController->generateQrCode(route('eat-here.main', ['table' => $number]), $number);

        //Envia en la respuesta el numero de la mesa.
        return response()->json([
            'table_number' => $number,
        ]);
    }
}
