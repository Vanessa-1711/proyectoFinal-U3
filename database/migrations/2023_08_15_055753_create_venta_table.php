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
        Schema::create('venta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('referencia')->unique();
            $table->date('fecha');
            $table->double('total');
            $table->double('subtotal');
            $table->double('iva');
            $table->double('pagocon');
            $table->double('cambio')->nullable();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
