<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositorioDeArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositorio_archivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('autor');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('TipodeArchivo');
            $table->string('documento');
            $table->date('fecha')->format('d/m/Y');
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
        Schema::dropIfExists('repositorio_de_archivos');
    }
}
