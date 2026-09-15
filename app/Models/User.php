<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Conteudo;
use App\Models\Materias;
use App\Models\Eventos;
use App\Models\SolicitacaoTutoria;
use App\Models\CandidaturaTutor;
use App\Models\Avaliacao;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password','role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function conteudos(): HasMany
    {
        return $this->hasMany(Conteudo::class);
    }

    public function materiais(): HasMany
    {
        return $this->hasMany(Materias::class);
    }

    public function eventos(): HasMany
    {
        return $this->hasMany(Eventos::class);
    }

    public function solicitacoesTutoria(): HasMany
    {
        return $this->hasMany(SolicitacaoTutoria::class);
    }

    public function candidaturasTutor(): HasMany
    {
        return $this->hasMany(CandidaturaTutor::class);
    }

    public function avaliacoesRecebidas(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'avaliado_id');
    }

    public function avaliacoesFeitas(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'avaliador_id');
    }

    public function getReputacaoAttribute(): float
    {
        return round((float) ($this->avaliacoes_recebidas_avg_nota ?? $this->avaliacoesRecebidas()->avg('nota') ?? 0), 1);
    }

    public function getTotalAvaliacoesAttribute(): int
    {
        return (int) ($this->avaliacoes_recebidas_count ?? $this->avaliacoesRecebidas()->count());
    }

    public function eAdministrador(): bool
    {
        return $this->role === 'admin';
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}