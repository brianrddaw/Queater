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
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade'); //Identificador del pedido
            $table->string('image_url')->default('products_images/hamburguesa.webp'); //URL de la imagen del producto
            $table->boolean('availability')->default(true); //Disponibilidad del producto
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
