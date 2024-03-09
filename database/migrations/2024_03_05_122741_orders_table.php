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
            $table->boolean('take_away'); //Tipo de pedido (para llevar o para comer aquí)
            $table->string('state')->default("pending"); //Estado del pedido (pendiente, en preparación, listo, entregado)
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
