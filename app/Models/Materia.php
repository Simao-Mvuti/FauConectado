<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    /**
     * Tabela associada ao model.
     *
     * @var string
     */
    protected $table = 'materias';

    /**
     * Os atributos que podem ser preenchidos em massa (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descricao',
        'pontuacao',
        'votos',
        'categoria',
        'ano',
        'semestre',
        'file',
        'aprovado',
    ];

    /**
     * Valores padrão para atributos da tabela.
     *
     * @var array
     */
    protected $attributes = [
        'pontuacao' => 0.0,
        'votos' => 0,
        'aprovado' => false,
    ];

    /**
     * Os atributos que devem ser convertidos (Casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pontuacao' => 'float',
        'votos' => 'integer',
        'ano' => 'integer',
        'semestre' => 'integer',
        'aprovado' => 'boolean',
    ];
}
