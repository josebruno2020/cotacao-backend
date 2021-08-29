<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateCotacaoFreteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao_frete', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transportadora_id')->unsigned();
            $table->string('uf', 2);
            $table->float('percentual_cotacao', 10, 2);
            $table->float('valor_extra', 10, 2);
            $table->timestamps();

            $table->foreign('transportadora_id')->references('id')->on('transportadoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacao_frete');
    }
}
