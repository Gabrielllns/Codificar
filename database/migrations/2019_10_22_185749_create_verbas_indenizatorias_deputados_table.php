<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerbasIndenizatoriasDeputadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verbas_indenizatorias_deputados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_deputado')->unsigned();
            $table->bigInteger('id_tipo_despesa')->unsigned();
            $table->string('mes_emissao', 3);
            $table->double('valor_reembolsado', 12, 2);

            $table->foreign('id_deputado')->references('id')->on('deputados')->onDelete('cascade');
            $table->foreign('id_tipo_despesa')->references('id')->on('tipo_despesa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verbas_indenizatorias_deputados');
    }
}
