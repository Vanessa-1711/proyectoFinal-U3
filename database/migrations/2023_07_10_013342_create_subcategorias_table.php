<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        
            Schema::create('subcategorias', function (Blueprint $table) {
                $table->id();
                $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
                $table->string('nombre');
                $table->string('codigo');
                $table->string('descripcion');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
