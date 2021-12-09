<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeysIdToQuestoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questoes', function (Blueprint $table) {
            $table->foreignId("concurso_id")->references("id")->on("concursos")->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId("disciplina_id")->references("id")->on("disciplinas")->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questoes', function (Blueprint $table) {
            $table->dropColumn("concurso_id");
          $table->dropColumn("disciplina_id");
        });
    }
}
