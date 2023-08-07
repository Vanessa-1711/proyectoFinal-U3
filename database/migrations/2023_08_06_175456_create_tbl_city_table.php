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
        Schema::create('tbl_city', function (Blueprint $table) {
            $table->increments('city_id');
            $table->string('city_name', 30);
            $table->unsignedInteger('state_id');
            
            // Foreign Key Constraint
            $table->foreign('state_id')->references('state_id')->on('tbl_state');
        });
    }

    public function down()
    {
        Schema::table('tbl_city', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
        });
        Schema::dropIfExists('tbl_city');
    }
};
