<x-layouts.app title="Inscrição de Tutores | FauConectado">
    <div class="max-w-5xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-[30px] border border-gray-200 bg-white shadow-sm">
            <div class="grid lg:grid-cols-[1.1fr_0.9fr]">
                <div class="bg-[#173123] p-8 text-white lg:p-10">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-white/70">Quer ajudar a comunidade?</p>
                    <h1 class="mt-4 font-serif text-4xl leading-tight">Inscreve-te como tutor</h1>
                    <p class="mt-4 max-w-md text-white/75">
                        Partilha o teu conhecimento, responde dúvidas e ajuda outros estudantes a evoluir com apoio de qualidade.
                    </p>

                    <div class="mt-8 space-y-4">
                        <div class="rounded-2xl bg-white/5 p-4">
                            <p class="font-semibold">✅ Apoio transparente</p>
                            <p class="mt-1 text-sm text-white/70">Define horários, metodologias e condições diretamente com os alunos.</p>
                        </div>
                        <div class="rounded-2xl bg-white/5 p-4">
                            <p class="font-semibold">🎓 Reconhecimento da tua experiência</p>
                            <p class="mt-1 text-sm text-white/70">Mostra as cadeiras em que podes ajudar e o teu nível de acesso.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8 lg:p-10">
                    <form class="space-y-5">
                        <div>
                            <label for="nome" class="mb-2 block text-sm font-medium text-[#173123]">Nome completo</label>
                            <input id="nome" type="text" value="" placeholder="Nome e apelido" class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 placeholder:text-gray-400 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-[#173123]">Email</label>
                            <input id="email" type="email" value="" placeholder="nome@email.com" class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 placeholder:text-gray-400 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" />
                        </div>

                        <div>
                            <label for="curso" class="mb-2 block text-sm font-medium text-[#173123]">Curso / Área</label>
                            <input id="curso" type="text" value="" placeholder="Engenharia Informática" class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 placeholder:text-gray-400 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" />
                        </div>

                        <div>
                            <label for="cadeiras" class="mb-2 block text-sm font-medium text-[#173123]">Cadeiras que podes apoiar</label>
                            <input id="cadeiras" type="text" value="" placeholder="Ex.: Álgebra Linear, Programação" class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 placeholder:text-gray-400 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" />
                        </div>

                        <div>
                            <label for="bio" class="mb-2 block text-sm font-medium text-[#173123]">Bio / apresentação</label>
                            <textarea id="bio" rows="4" placeholder="Conta um pouco sobre a tua experiência e como podes ajudar." class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 placeholder:text-gray-400 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10"></textarea>
                        </div>

                        <button type="button" class="w-full rounded-full bg-[#173123] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#12281d]">
                            Enviar inscrição
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
