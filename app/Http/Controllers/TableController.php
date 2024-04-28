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
        //El numero de la mesa nueva sera el id de mesa mas bajo posible que no exista en la base de datos
        //Ejemplo: si exsiste la mesa 2,3,4 el id de la nueva mesa sera 1
        $number = 1;
        $tables = Table::all();
        foreach ($tables as $table) {
            if ($table->number == $number) {
                $number++;
            } else {
                break;
            }
        }

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

    public function deleteTable($id)
    {
        //Elimina la mesa de la base de datos
        Table::destroy($id);
        //Elimina el QR de la mesa
        $this->qrCodeController->deleteQrCode($id);
        //Redirige a la vista de mesas
        return response()->json([
            'message' => 'Table deleted successfully',
        ]);
    }


}
