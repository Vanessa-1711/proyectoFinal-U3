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
        Schema::table('products', function (Blueprint $table) {
            // Agregar la columna 'eliminado' con valor por defecto de 0 (no eliminado)
            $table->tinyInteger('eliminado')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Al revertir la migración, eliminamos la columna 'eliminado'
            $table->dropColumn('eliminado');
        });
    }
};
