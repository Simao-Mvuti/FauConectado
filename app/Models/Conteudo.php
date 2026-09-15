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
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}