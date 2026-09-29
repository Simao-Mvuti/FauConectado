
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-10">

        <div class="max-w-3xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[10px] sm:text-[11px] font-bold tracking-widest text-fcGreenDark uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-fcCoral"></span>
                REDE DE MENTORIA ACADÉMICA
            </div>
            <h1 class="text-3xl sm:text-4xl font-serif font-bold text-fcGreenDark">
                Encontra apoio direto com quem <span class="italic font-normal">já passou pelo mesmo.</span>
            </h1>
            <p class="text-sm sm:text-base text-fcTextMuted leading-relaxed">
                Contacta alunos experientes da tua faculdade. Os horários, formato de estudo e eventuais contrapartidas são combinados diretamente entre ti e o tutor.
            </p>
        </div>

        <div class="bg-white p-4 rounded-xl border border-fcGreenDark/10 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="relative w-full md:w-96">
                <input type="text" placeholder="Pesquisar por nome ou área..." class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-fcGreenDark">
                <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <a href="{{ route('tutor.inscricao') }}" class="rounded-full bg-[#173123] px-4 py-2 text-sm font-semibold text-white hover:bg-[#12281d]">
                    Ser tutor
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tutores as $tutor)
                <div class="bg-white rounded-2xl border border-fcGreenDark/10 p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-4 border-b border-gray-100 pb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}" alt="{{ $tutor->name }}" class="w-14 h-14 rounded-full object-cover border-2 border-fcCoral">
                            <div>
                                <h3 class="font-bold text-fcGreenDark text-lg">{{ $tutor->name }}</h3>
                                <span class="text-xs text-fcTextMuted font-medium">{{ $tutor->email }}</span>
                            </div>
                        </div>

                        <div class="mt-4 space-y-2">
                            <p class="text-xs font-bold uppercase text-fcCoral tracking-wider"> Área </p>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="text-[11px] bg-fcGreenDark/5 text-fcGreenDark px-2.5 py-1 rounded-md font-medium">Apoio académico</span>
                            </div>
                        </div>

                        <p class="mt-4 text-xs text-fcTextDark leading-relaxed line-clamp-3">
                            Disponível para apoiar estudantes em materiais, dúvidas e revisão de conteúdos.
                        </p>
                    </div>

                    <div class="pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-fcTextMuted">💬 Resposta em ~2h</span>

                        <a href="mailto:{{ $tutor->email }}?subject=FauConectado%20-%20Pedido%20de%20apoio" class="rounded-full bg-fcGreenDark px-4 py-2 text-xs font-semibold text-white hover:bg-[#0b1d15]">
                            Contactar
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-gray-200 bg-white p-8 text-center text-sm text-fcTextMuted">
                    Ainda não existem tutores registados.
                </div>
            @endforelse
        </div>

        <div class="bg-fcGreenDark text-white p-6 sm:p-8 rounded-2xl flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-xl font-serif font-bold">Domina uma cadeira e queres ajudar outros alunos?</h3>
                <p class="text-xs sm:text-sm text-white/80">Regista-te como mentor na plataforma e define as tuas próprias regras de tutoria.</p>
            </div>
            <a href="{{ route('tutor.inscricao') }}" class="rounded-full bg-fcCoral px-6 py-3 text-sm font-semibold text-white hover:bg-fcCoral/90">
                Tornar-me Mentor
            </a>
        </div>

    </div>
