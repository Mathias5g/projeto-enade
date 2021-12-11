<?php

namespace App\Http\Controllers;

use App\Models\Concurso;
use App\Models\Curso;
use App\Models\Disciplina;
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

        if(!is_null($request->ano_concurso)) {
            $questoes->whereYear('concursos.data_realizacao', '=', $request->ano_concurso);
        }

        if(!is_null($request->grau_dificuldade)) {
            $questoes->where('questoes.grau_dificuldade', '=', $request->grau_dificuldade);
        }

        if(!is_null($request->disciplinas)) {
            $questoes->where('questoes.disciplina_id', '=', $request->disciplinas);
        }

        $json = $questoes
            ->select('questoes.id', 'questoes.pergunta', 'questoes.grau_dificuldade', 'questoes.tipo_questao', 'concursos.nome_concurso', 'disciplinas.nome_disciplina')
            ->join('concursos', 'concursos.id', '=', 'questoes.concurso_id')
            ->join('disciplinas', 'disciplinas.id', '=', 'questoes.disciplina_id')
            ->get();

        return response()->json($json);
    }

    public function concursos(Request $request) {
        $concursos = Concurso::query();

        if(!is_null($request->concursos)) {
            $concursos->where('concursos.id', '=', $request->concursos);
        }

        if(!is_null($request->ano_concurso)) {
            $concursos->whereYear('concursos.data_realizacao', '=', $request->ano_concurso);
        }

        $json = $concursos->get();

        return response()->json($json);
    }

    public function disciplinas(Request $request) {
        $disciplinas = Disciplina::query();

        if(!is_null($request->curso)) {
            $disciplinas->with('cursos')->whereRelation('cursos', 'curso_id', $request->curso);
        }

        if(!is_null($request->disciplina)) {
            $disciplinas->with('cursos')->where('disciplinas.id', '=', $request->disciplina);
        }

        $json = $disciplinas->get();
        return response()->json($json);
    }

    public function cursos(Request $request) {
        $cursos = Curso::query();

        if(!is_null($request->curso)) {
            $cursos->where('cursos.id', '=', $request->curso);
        }

        $json = $cursos->get();

        return response()->json($json);
    }
}
