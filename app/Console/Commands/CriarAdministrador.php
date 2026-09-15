<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CriarAdministrador extends Command
{
    protected $signature = 'administrador:criar {email : E-mail do administrador} {--nome=Administrador : Nome exibido} {--senha= : Senha do administrador}';

    protected $description = 'Cria ou promove um usuário para administrador';

    public function handle(): int
    {
        $senha = $this->option('senha') ?: $this->secret('Digite a senha do administrador');

        if (! $senha) {
            $this->error('A senha é obrigatória.');

            return self::FAILURE;
        }

        $usuario = User::updateOrCreate(
            ['email' => $this->argument('email')],
            [
                'name' => $this->option('nome'),
                'role' => 'admin',
                'password' => Hash::make($senha),
            ],
        );

        $this->info("Administrador {$usuario->email} configurado com sucesso.");

        return self::SUCCESS;
    }
}
