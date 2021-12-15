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
        $questoes->with(['concurso', 'disciplinas']);

        if(!is_null($request->concurso)) {
            $questoes->whereRelation('concurso', 'concurso_id', $request->concurso);
        }

        if(!is_null($request->tipo_questao)) {
            $questoes->where('questoes.tipo_questao', '=', $request->tipo_questao);
        }

        if(!is_null($request->ano_concurso)) {
            $questoes->whereHas('concurso', function ($q) use ($request) {
                return $q->whereYear('data_realizacao', $request->ano_concurso);
            });
        }

        if(!is_null($request->grau_dificuldade)) {
            $questoes->where('questoes.grau_dificuldade', '=', $request->grau_dificuldade);
        }

        if(!is_null($request->disciplinas)) {
            $questoes->whereRelation('disciplinas', 'disciplina_id', $request->disciplinas);
        }

        $json = $questoes->get();

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
        $disciplinas->with('cursos');

        if(!is_null($request->curso)) {
            $disciplinas->whereRelation('cursos', 'curso_id', $request->curso);
        }

        if(!is_null($request->disciplina)) {
            $disciplinas->where('disciplinas.id', '=', $request->disciplina);
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
