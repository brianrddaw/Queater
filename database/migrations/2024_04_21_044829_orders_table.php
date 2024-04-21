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
            $table->string('state')->default("new"); //Estado del pedido (new, pending, ready, delivered)(pending, preparing, ready, delivered)
            $table->foreignId('table_id')->nullable()->references('id')->on('tables'); //Identificador de la mesa
            $table->timestamps(); //Fecha del pedido
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_lines');

        //Delete table
        Schema::dropIfExists('orders');
    }
};
