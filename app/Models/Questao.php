<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;

    protected $table = 'questoes';

    protected $fillable = [
      'numero_questao',
      'tipo_questao',
      'grau_dificuldade',
      'pergunta',
      'resposta',
      'alternativa',
      'concurso_id',
      'disciplina_id',
    ];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];

    public function concurso() {
        return $this->belongsTo(Concurso::class);
    }

    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class);
    }
}
