<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['titulo', 'conteudo', 'categoria','user_id'])]
class Conteudo extends Model
{
    protected $fillable = [
        'titulo',
        'conteudo',
        'categoria',
        'user_id',
        'status',
        'moderado_por',
        'moderado_em',
        'motivo_rejeicao',
    ];

    protected $casts = [
        'moderado_em' => 'datetime',
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}