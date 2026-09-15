<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliador_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('avaliado_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('nota');
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->unique(['avaliador_id', 'avaliado_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
