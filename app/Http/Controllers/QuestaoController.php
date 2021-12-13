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
        $questoes = Questao::with(['concurso', 'disciplinas'])->get();

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
        $action = route('questoes.store');
        return Inertia::render('questoes/form', ['action' => $action, 'cursos' => $cursos, 'concursos' => $concursos, 'disciplinas' => $disciplinas]);
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
            'pergunta' => 'required|min:2',
            'resposta' => 'required|min:2',
            'alternativa' => 'required',
            'concurso_id' => 'required',
            'disciplinas' => 'required'
        ]);

        $questao = Questao::create($request->all());

        if($request->has('disciplinas')) {
            $questao->disciplinas()->sync($request->disciplinas);
        }

        return Redirect::route('questoes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questao  $questo
     * @return \Inertia\Response
     */
    public function show(Questao $questo)
    {
        $cursos = Curso::get();
        $concursos = Concurso::get();
        $disciplinas = Disciplina::get();
        $action = route('questoes.update', $questo);
        return Inertia::render('questoes/form', ['action' => $action, 'cursos' => $cursos, 'concursos' => $concursos, 'disciplinas' => $disciplinas, 'questao' => $questo, 'disciplina_questao' => $questo->disciplinas()->get()]);
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
     * @param  \App\Models\Questao  $questo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Questao $questo)
    {
        $request->validate([
            'numero_questao' => 'required',
            'tipo_questao' => 'required',
            'grau_dificuldade' => 'required',
            'pergunta' => 'required|min:2',
            'resposta' => 'required|min:2',
            'alternativa' => 'required',
            'concurso_id' => 'required',
            'disciplinas' => 'required'
        ]);
        $questo->update($request->all());
        $questo->disciplinas()->sync($request->disciplinas);
        return Redirect::route('questoes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questao  $questao
     * @return bool
     */
    public function destroy(Questao $questo)
    {
        return $questo->delete();
    }
}
