<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {

            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->integer('titulo')->nullable();
            $table->integer('cantidad');
            $table->bigInteger('id_autor')->unsigned();
            $table->bigInteger('id_editorial')->unsigned();
            $table->bigInteger('id_materia')->unsigned();
            $table->date('anio_edicion')->nullable();
            $table->integer('num_pagina')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('estado');
            $table->timestamps();

             $table->foreign('id_autor')->references('id')->on('autors')->onDelete("cascade");
             $table->foreign('id_editorial')->references('id')->on('editorials')->onDelete("cascade");
             $table->foreign('id_materia')->references('id')->on('materias')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};