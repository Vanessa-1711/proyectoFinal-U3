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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
                $table->foreignId('subcategoria_id')->nullable()->constrained()->onDelete('cascade');
                $table->string('imagen');
                $table->decimal('precio_compra', 8, 2);
                $table->decimal('precio_venta', 8, 2);
                $table->integer('unidades_disponibles');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('marca_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};