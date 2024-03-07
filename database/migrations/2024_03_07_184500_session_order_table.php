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
        Schema::create('sessions_order', function (Blueprint $table) {
            $table->foreignId('session_id')->references('id')->on('sessions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade'); //Identificador del pedido
            $table->timestamps(); //Fecha de la linea de pedido
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('session_order');
    }
};
