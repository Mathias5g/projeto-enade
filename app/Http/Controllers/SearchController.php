<?php

namespace App\Http\Controllers;

use App\Models\Questao;
use Illuminate\Http\Request;

class SearchController
{
    public function questoes(Request $request) {
        $questoes = Questao::query();

        if(!is_null($request->concurso)) {
            $questoes->where('questoes.concurso_id', '=', $request->concurso);
        }

        if(!is_null($request->tipo_questao)) {
            $questoes->where('questoes.tipo_questao', '=', $request->tipo_questao);
        }

        if(!is_null($request->grau_dificuldade)) {
            $questoes->where('questoes.grau_dificuldade', '=', $request->grau_dificuldade);
        }

        if(!is_null($request->disciplinas)) {
            $questoes->where('questoes.disciplina_id', '=', $request->disciplina_id);
        }

        $json = $questoes->select('questoes.id', 'pergunta', 'grau_dificuldade', 'tipo_questao', 'concursos.nome_concurso', 'disciplinas.nome_disciplina')
            ->join('disciplinas', 'disciplinas.id', '=', 'questoes.disciplina_id')
            ->join('concursos', 'concursos.id', '=', 'questoes.concurso_id')
            ->get();


        return response()->json($json);
    }

    public function concursos(Request $request) {
        return response()->json(['ok']);
    }

    public function disciplinas(Request $request) {
        return response()->json(['ok']);
    }

    public function cursos(Request $request) {
        return response()->json(['ok']);
    }
}
