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

            $table->foreign('id_deputado')->references('id')->on('deputados')->onDelete('cascade');
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
