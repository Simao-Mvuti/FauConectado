<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'avaliador_id',
        'avaliado_id',
        'nota',
        'comentario',
    ];

    public function avaliador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'avaliador_id');
    }

    public function avaliado(): BelongsTo
    {
        return $this->belongsTo(User::class, 'avaliado_id');
    }
}
