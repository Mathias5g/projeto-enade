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
      'horaInicio',
      'horaTermino',
      'tempo_duracao',
      'observacoes',
    ];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
}
