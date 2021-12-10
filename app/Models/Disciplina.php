<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $table = 'disciplinas';

    protected $fillable = [
      'nome_disciplina',
      'curso_id',
    ];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];

    public function cursos() {
        return $this->belongsToMany(Curso::class);
    }

    /*
      * //belongsTo (s)
      * Chave estrangeira
      * nome do metodo e escrecentar o sufixo _id
     *
      * //hasMany/hasOne
      *  chave estrangeira
      *  A chave estrangeira da tabela (modelo) associada
      *   deve ser o nome desse modelo (snake_case) com o sufixo _id
      * exemplo curso_id
     *
     * belongsToMany (s)
     * nome da tabela intermediaria
     * pega o nome dos dois modelos em (snake_case) singular em ordem alfabetica
     * curso_disciplina
     *
     * nome da chave estrangeira da tabela pivot com relação a esse modelo
     * curso_id
     *
     * nome da chave estrangeira ta tabela pivot em relação ao outro modelo
     * disciplina_id
     */
}
