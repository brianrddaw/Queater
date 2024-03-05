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
        //Tabla de products
        Schema::create('products', function (Blueprint $table) {
            $table->id(); //Identificador del producto
            $table->string('name'); //Nombre del producto
            $table->string('description'); //Descripcion del producto
            $table->float('price'); //Precio del producto
            $table->boolean('availability')->default(true); //Disponibilidad del producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_lines');

        // Eliminar la tabla de productos
        Schema::dropIfExists('products');
    }
};
