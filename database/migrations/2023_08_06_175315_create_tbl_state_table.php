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
        Schema::create('tbl_state', function (Blueprint $table) {
            $table->increments('state_id');
            $table->string('state_name', 30);
            $table->unsignedInteger('countryid');
            
            // Foreign Key Constraint
            $table->foreign('countryid')->references('id')->on('tbl_country');
        });
    }

    public function down()
    {
        Schema::table('tbl_state', function (Blueprint $table) {
            $table->dropForeign(['countryid']);
        });
        Schema::dropIfExists('tbl_state');
    }
};
