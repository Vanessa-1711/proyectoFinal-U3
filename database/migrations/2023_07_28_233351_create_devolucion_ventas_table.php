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
        Schema::create('devolucion_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_devolucion');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('products_id');
            $table->unsignedInteger('cantidad_devuelta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucion_ventas');
    }
};
