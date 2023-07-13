<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcasTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('marcas')) {
            Schema::create('marcas', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('descripcion');
                $table->string('imagen');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
    
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
