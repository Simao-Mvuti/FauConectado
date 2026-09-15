<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvaliacaoMaterial extends Model
{
    protected $table = 'avaliacoes_materiais';

    protected $fillable = [
        'avaliador_id',
        'materia_id',
        'nota',
        'comentario',
    ];

    public function avaliador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'avaliador_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Materias::class, 'materia_id');
    }
}
