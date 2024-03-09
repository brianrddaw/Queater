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
        //Tabla de lineas de pedido
        Schema::create('orders_lines', function (Blueprint $table) {
            $table->id(); //Identificador de la linea de pedido
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade'); //Identificador del pedido
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade'); //Identificador del producto
            $table->integer('quantity'); //Cantidad del producto
            $table->timestamps(); //Fecha de la linea de pedido
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la tabla de líneas de pedido
        Schema::dropIfExists('orders_lines');
    }
};
