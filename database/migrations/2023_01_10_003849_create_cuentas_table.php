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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->string('tabla_telefonos')->nullable();
            $table->string('tabla_resultados')->nullable();
            $table->string('canales',10)->nullable();
            $table->string('activa',1)->nullable();
            $table->string('grabacion')->nullable();
            $table->date('fecha_ini')->nullable();
            $table->string('hora_ini',10)->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('hora_fin',10)->nullable();
            $table->integer('bloque')->nullable();
            $table->string('ignorar',50)->nullable();
            $table->unsignedBigInteger('asterisk_id')->nullable();
            $table->foreign('asterisk_id')->references('id')->on('servidores_asterisk'); 
            $table->string('email')->nullable();
            $table->string('puerto',10)->nullable();
            $table->integer('cantidad_barridas')->nullable();
            $table->string('dispo_barrer')->nullable();
            $table->string('pausa',5)->nullable();
            $table->string('mostrar',1)->nullable();
            $table->string('tipo_robotica',1)->nullable();
            $table->string('idcuenta',5)->nullable();
            $table->string('queue',20)->nullable();
            $table->string('ivr',20)->nullable();
            $table->string('troncal',20)->nullable();
            $table->string('incluir_buzon',1)->nullable();
            $table->integer('slot')->nullable();
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
        Schema::dropIfExists('cuentas');
    }
};
