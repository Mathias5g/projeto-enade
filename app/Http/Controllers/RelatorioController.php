<?php

namespace App\Http\Controllers;

use App\Models\Concurso;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Questao;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class RelatorioController extends Controller
{
    public function index()
    {
        $cursos = Curso::get();
        $concursos = Concurso::get();
        $disciplinas = Disciplina::get();
        return Inertia::render('relatorios/index', [
            'cursos' => $cursos,
            'concursos' => $concursos,
            'disciplinas' => $disciplinas,
        ]);
    }

    public function gerarRelatorio(Request $request)
    {
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

        if(!is_null($request->limite)) {
            $questoes->limit($request->limite);
        }


        $json = $questoes->paginate();

        return response()->json($json);
    }

    public function gerarPdfRelatorio(Request $request)
    {
        $date = new DateTime();
        $questoes = $request->data;
        $pdf = PDF::loadView('pdf_relatorio', compact('questoes'));
        return $pdf->download('relatorio'. $date->getTimestamp() . '.pdf');
    }
}
