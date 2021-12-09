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
        return Inertia::render('concursos/form');
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
            'nome_concurso' => 'required',
            'data_realizacao' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tempo_duracao' => 'required',
            'observacoes' => 'required',
        ]);

        Concurso::create([
            'nome_concurso' => $request->nome_concurso,
            'data_realizacao' => $request->data_realizacao,
            'hora_inicio' => $request->hora_inicio,
            'hora_termino' => $request->hora_termino,
            'tempo_duracao' => $request->tempo_duracao,
            'observacoes' => $request->observacoes,
        ]);
        return Redirect::route('concursos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
