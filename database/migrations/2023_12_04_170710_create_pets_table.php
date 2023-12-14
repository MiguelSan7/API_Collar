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
        Schema::create('pets', function (Blueprint $table) {
            $table->id('id_mascota');
            $table->string('nombre');
            $table->string('peso');
            $table->foreignId('id_collar')->constrained('collars', 'id_collar');
            // Especifica la columna a la que se hace referencia (id) y la tabla (users)
            $table->foreignId('id_usuario')->constrained('users', 'id_usuario');
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
        Schema::dropIfExists('pets');
    }
};
