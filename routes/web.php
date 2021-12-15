<?php

use App\Http\Controllers\ConcursoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestaoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::resources([
      'cursos' => CursoController::class,
      'questoes' => QuestaoController::class,
      'disciplinas' => DisciplinaController::class,
      'concursos' => ConcursoController::class,
    ]);

    Route::post('/pesquisa/questoes', [SearchController::class, 'questoes'])->name('pesquisas.questoes');
    Route::post('/pesquisa/concursos', [SearchController::class, 'concursos'])->name('pesquisas.concursos');
    Route::post('/pesquisa/disciplinas', [SearchController::class, 'disciplinas'])->name('pesquisas.disciplinas');
    Route::post('/pesquisa/cursos', [SearchController::class, 'cursos'])->name('pesquisas.cursos');

    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::post('/relatorios/gerar', [RelatorioController::class, 'gerarRelatorio'])->name('relatorios.gerar');
});
