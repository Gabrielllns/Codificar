<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedesSociaisDeputadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redes_sociais_deputados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_deputado')->unsigned();
            $table->bigInteger('id_tipo_rede_social')->unsigned();
            $table->string('ds_url_perfil');

            $table->foreign('id_deputado')->references('id')->on('deputados')->onDelete('cascade');
            $table->foreign('id_tipo_rede_social')->references('id')->on('tipo_redes_sociais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redes_sociais_deputados');
    }
}
