<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\AvaliacaoMaterial;

class Materias extends Model
{

    //
    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo',
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

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(AvaliacaoMaterial::class, 'materia_id');
    }

    public function getReputacaoAttribute(): float
    {
        return round((float) ($this->avaliacoes_avg_nota ?? $this->avaliacoes()->avg('nota') ?? 0), 1);
    }

    public function getTotalAvaliacoesAttribute(): int
    {
        return (int) ($this->avaliacoes_count ?? $this->avaliacoes()->count());
    }
}
