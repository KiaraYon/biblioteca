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
         Schema::create('prestamos', function (Blueprint $table) {

            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_estudiante')->unsigned();
            $table->bigInteger('id_libro')->unsigned();
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion');
            $table->integer('cantidad');
            $table->text('observacion')->nullable();
            $table->integer('estado');
            $table->timestamps();

             $table->foreign('id_estudiante')->references('id')->on('estudiantes')->onDelete("cascade");
             $table->foreign('id_libro')->references('id')->on('libros')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};