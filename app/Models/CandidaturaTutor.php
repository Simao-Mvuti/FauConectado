<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidaturaTutor extends Model
{
    protected $table = 'candidaturas_tutor';

    protected $fillable = [
        'area',
        'experiencia',
        'disponibilidade',
        'status',
    ];

    public function candidato(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
