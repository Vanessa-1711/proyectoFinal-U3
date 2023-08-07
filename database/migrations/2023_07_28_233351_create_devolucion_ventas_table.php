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
            $table->string('nombre_producto');
            $table->date('fecha_devolucion');
            $table->string('cliente');
            $table->string('estatus');
            $table->decimal('total_pagado', 8, 2);
            
            $table->decimal('adeudo', 8, 2);
            $table->string('estatus_pago');
            $table->string('imagen')->nullable();
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
