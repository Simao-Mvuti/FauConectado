<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes_materiais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliador_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('materia_id')->constrained('materias')->cascadeOnDelete();
            $table->unsignedTinyInteger('nota');
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->unique(['avaliador_id', 'materia_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes_materiais');
    }
};
