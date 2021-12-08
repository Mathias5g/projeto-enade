<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConcursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concursos', function (Blueprint $table) {
            $table->id();
            $table->string("nome_concurso");
            $table->timestamp("data_realizacao");
            $table->time("hora_inicio");
            $table->time("hora_termino");
            $table->integer("tempo_duracao");
            $table->string("observacoes", 300);
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
        Schema::dropIfExists('table_concursos');
    }
}
