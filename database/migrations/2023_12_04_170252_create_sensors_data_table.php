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
            $table->id('id_sensor');
            $table->foreignId('id')->constrained('sensors');
            $table->string('valor');
            $table->unsignedBigInteger('id_collar'); // Cambiado a unsignedBigInteger
            $table->foreign('id_collar')->references('id_collar')->on('collars'); // Cambiado a id_collar
            $table->timestamps();
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
