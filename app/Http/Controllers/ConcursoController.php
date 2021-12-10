<?php

namespace App\Http\Controllers;

use App\Models\Concurso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ConcursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $concursos = Concurso::all();
        return Inertia::render('concursos/index', ['concursos' => $concursos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $action = route('concursos.store');
        return Inertia::render('concursos/form', ['action' => $action]);
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
            'nome_concurso' => 'required|unique:concursos|min:2',
            'data_realizacao' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tempo_duracao' => 'required',
            'observacoes' => 'required|min:3',
        ]);

        Concurso::create($request->all());
        return Redirect::route('concursos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Concurso $concurso
     * @return \Inertia\Response
     */
    public function show(Concurso $concurso)
    {
        $action = route('concursos.update', $concurso);
        return Inertia::render('concursos/form', ['concurso' => $concurso, 'action' => $action]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Concurso $concurso)
    {
        $request->validate([
            'nome_concurso' => 'required|unique:concursos|min:2',
            'data_realizacao' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tempo_duracao' => 'required',
            'observacoes' => 'required|min:3',
        ]);
        $concurso->update($request->all());
        return Redirect::route('concursos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(Concurso $concurso)
    {
        return $concurso->delete();
    }
}
