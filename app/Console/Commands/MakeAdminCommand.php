<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:make-admin {email : E-mail de uma conta registada} {--force : Confirmar sem prompt interativo}')]
#[Description('Promove uma conta registada a administradora')]
class MakeAdminCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = (string) $this->argument('email');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Indica um endereço de e-mail válido.');

            return self::FAILURE;
        }

        $user = User::query()->where('email', $email)->first();

        if (! $user) {
            $this->error('Não existe uma conta registada com esse e-mail.');

            return self::FAILURE;
        }

        if ($user->isAdmin()) {
            $this->info('Esta conta já tem permissões de administração.');

            return self::SUCCESS;
        }

        if (! $this->option('force') && ! $this->confirm("Promover {$user->email} a administradora?")) {
            $this->warn('Operação cancelada.');

            return self::FAILURE;
        }

        $user->forceFill(['is_admin' => true])->save();

        $this->info("{$user->email} agora é administradora.");

        return self::SUCCESS;
    }
}
