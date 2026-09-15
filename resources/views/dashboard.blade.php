@extends('layout.app')

@section('content')
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <x-cabecalho-dashboard :user="$user" />

            <x-estatisticas-dashboard :stats="$estatisticas" />

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <x-progresso-estudo-dashboard
                        :ultimo-conteudo="$ultimoConteudo"
                        :total-conteudos="$estatisticas[0]['value']"
                    />
                    <x-conteudos-recentes-dashboard :conteudos="$conteudos" />
                </div>

                <div class="space-y-8">
                    <x-proximos-eventos-dashboard :eventos="$eventos" />
                </div>
            </div>

            <x-materiais-recentes-dashboard :materias="$materias" />
        </div>
    </div>
@endsection
