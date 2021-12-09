<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    use HasFactory;

  protected $table = 'concursos';

    protected $fillable = [
      'nome_concurso',
      'data_realizacao',
      'hora_inicio',
      'hora_termino',
      'tempo_duracao',
      'observacoes',
    ];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
}
