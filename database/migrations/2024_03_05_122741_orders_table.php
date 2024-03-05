<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Tabla de pedidos
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); //Identificador del pedido
            $table->boolean('state')->default(true); //Estado del pedido false = pendiente, true = entregado
            $table->timestamps(); //Fecha del pedido
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Delete table
        Schema::dropIfExists('orders');
    }
};
