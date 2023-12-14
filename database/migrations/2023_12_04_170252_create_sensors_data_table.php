<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('tipo_sensor');
            $table->foreign('tipo_sensor')->references('id')->on('sensors')->onDelete('cascade');
            $table->string('valor');
            $table->unsignedBigInteger('collar');
            $table->timestamps();
            $table->foreign('collar')->references('id')->on('collars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensors_data');
    }
};
