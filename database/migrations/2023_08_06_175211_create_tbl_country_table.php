<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sortname', 3);
            $table->string('name', 150);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_country');
    }

};
