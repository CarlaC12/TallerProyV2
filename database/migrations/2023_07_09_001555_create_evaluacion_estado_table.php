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
        Schema::create('evaluacion_estado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_id');
            $table->unsignedBigInteger('estado_id');
            $table->decimal('precision', 8, 2);
            $table->timestamps();

            $table->foreign('evaluacion_id')->references('id')->on('evaluaciondenver');
            $table->foreign('estado_id')->references('id')->on('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacion_estado');
    }
};
