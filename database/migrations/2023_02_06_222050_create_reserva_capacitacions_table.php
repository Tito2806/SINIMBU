<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaCapacitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_capacitacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idCapacitacion')->nullable();
            $table->foreign("idCapacitacion")->references("id")->on("capacitacions")->onDelete("cascade")->onUpdate("cascade");
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->string('celular');
            $table->string('email');
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
        Schema::dropIfExists('reserva_capacitacions');
    }
}
