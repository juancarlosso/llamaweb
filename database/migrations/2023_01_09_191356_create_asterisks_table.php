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
        Schema::create('servidores_asterisk', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100)->nullable();
            $table->string('ip',20)->nullable();
            $table->string('usuario',50)->nullable();
            $table->string('password',50)->nullable();
            $table->string('puerto',10)->nullable();
            $table->string('contexto',50)->nullable();
            $table->string('contexto_cd',50)->nullable();
            $table->string('marcar_login',30)->nullable();
            $table->string('puerto_http',10)->nullable();
            $table->string('puerto_http_publico',10)->nullable();
            $table->string('marcar_logout',50)->nullable();
            $table->string('marcar_pausa',50)->nullable();
            $table->string('marcar_despausa',50)->nullable();
            $table->string('ip_mysql',50)->nullable();
            $table->string('usuario_mysql',50)->nullable();
            $table->string('password_mysql',50)->nullable();
            $table->string('puerto_mysql',50)->nullable();
            $table->string('bd_mysql',50)->nullable();
            $table->string('tabla_mysql',50)->nullable();
            $table->string('version',10)->nullable();
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
        Schema::dropIfExists('asterisks');
    }
};
