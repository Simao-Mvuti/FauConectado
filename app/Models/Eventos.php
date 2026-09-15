<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Eventos extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'local',
        'categoria',
        'link',
        'user_id',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
