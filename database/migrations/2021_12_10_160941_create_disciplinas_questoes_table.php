<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinasQuestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina_questao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questao_id')->references('id')->on('questoes')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('disciplina_id')->references('id')->on('disciplinas')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('disciplina_questao');
    }
}
