<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('conteudos', function (Blueprint $table) {
            $table->string('status')->default('aprovado')->after('categoria');
            $table->foreignId('moderado_por')->nullable()->after('status')->constrained('users')->nullOnDelete();
            $table->timestamp('moderado_em')->nullable()->after('moderado_por');
            $table->text('motivo_rejeicao')->nullable()->after('moderado_em');
        });

        Schema::table('materias', function (Blueprint $table) {
            $table->string('status')->default('aprovado')->after('categoria');
            $table->foreignId('moderado_por')->nullable()->after('status')->constrained('users')->nullOnDelete();
            $table->timestamp('moderado_em')->nullable()->after('moderado_por');
            $table->text('motivo_rejeicao')->nullable()->after('moderado_em');
        });
    }

    public function down(): void
    {
        Schema::table('conteudos', function (Blueprint $table) {
            $table->dropForeign(['moderado_por']);
            $table->dropColumn(['status', 'moderado_por', 'moderado_em', 'motivo_rejeicao']);
        });

        Schema::table('materias', function (Blueprint $table) {
            $table->dropForeign(['moderado_por']);
            $table->dropColumn(['status', 'moderado_por', 'moderado_em', 'motivo_rejeicao']);
        });
    }
};
