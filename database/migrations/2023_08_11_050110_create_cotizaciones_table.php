<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->string('referencia')->unique();
            $table->foreignId('cliente')->constrained()->onDelete('cascade');
            $table->enum('estatus', ['enviada', 'pendiente', 'otro']);
            $table->decimal('total', 8, 2);
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
};
