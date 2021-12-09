<?php

namespace App\Http\Controllers;

use App\Models\Concurso;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Questao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class QuestaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $cursos = Curso::get();
        $concursos = Concurso::get();
        $disciplinas = Disciplina::get();
        $questoes = Questao::join('concursos', 'concursos.id', '=', 'questoes.concurso_id')
            ->join('disciplinas', 'disciplinas.id', '=', 'questoes.disciplina_id')
            ->get();
        return Inertia::render('questoes/index', [
            'cursos' => $cursos,
            'concursos' => $concursos,
            'disciplinas' => $disciplinas,
            'questoes' => $questoes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $cursos = Curso::get();
        $concursos = Concurso::get();
        $disciplinas = Disciplina::get();
        return Inertia::render('questoes/form', ['cursos' => $cursos, 'concursos' => $concursos, 'disciplinas' => $disciplinas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_questao' => 'required',
            'tipo_questao' => 'required',
            'grau_dificuldade' => 'required',
            'pergunta' => 'required',
            'resposta' => 'required',
            'alternativa' => 'required',
            'concurso_id' => 'required',
            'disciplina_id' => 'required'
        ]);
        Questao::create($request->all());
        return Redirect::route('questoes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function show(Questao $questao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function edit(Questao $questao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questao $questao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questao $questao)
    {
        //
    }
}
