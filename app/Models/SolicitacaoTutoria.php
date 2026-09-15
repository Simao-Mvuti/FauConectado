<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitacaoTutoria extends Model
{
    protected $table = 'solicitacoes_tutoria';

    protected $fillable = [
        'mentor_id',
        'assunto',
        'descricao',
        'status',
    ];

    public function solicitante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
