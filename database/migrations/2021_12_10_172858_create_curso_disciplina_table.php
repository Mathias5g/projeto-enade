<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoDisciplinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_disciplina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disciplina_id')->references('id')->on('disciplinas')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('curso_id')->references('id')->on('cursos')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('disciplinas_cursos');
    }
}
