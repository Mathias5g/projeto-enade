<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        $disciplinas = Disciplina::select('disciplinas.id', 'disciplinas.nome_disciplina', 'cursos.nome_curso')->join('cursos', 'cursos.id', '=', 'disciplinas.curso_id')->get();
        return Inertia::render('disciplinas/index', ['cursos' => $cursos, 'disciplinas' => $disciplinas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $action = route('disciplinas.store');
        $cursos = Curso::all();
        return Inertia::render('disciplinas/form', ['action' => $action, 'cursos' => $cursos]);
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
           'nome_disciplina' => 'required|unique:disciplinas|min:2',
           'curso_id' => 'required'
        ]);
        Disciplina::create($request->all());
        return Redirect::route('disciplinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Inertia\Response
     */
    public function show(Disciplina $disciplina)
    {
        $action = route('disciplinas.update', $disciplina);
        $cursos = Curso::all();
        return Inertia::render('disciplinas/form', ['disciplina' => $disciplina, 'action' => $action, 'cursos' => $cursos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Disciplina $disciplina)
    {
        $request->validate([
            'nome_disciplina' => 'required|min:2|unique:disciplinas,nome_disciplina,' . $disciplina->id,
            'curso_id' => 'required'
        ]);
        $disciplina->update($request->all());
        return Redirect::route('disciplinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return bool
     */
    public function destroy(Disciplina $disciplina)
    {
        return $disciplina->delete();
    }
}
