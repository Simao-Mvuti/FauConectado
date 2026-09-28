<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-12">
        
        <!-- Cabeçalho -->
        <div class="max-w-3xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[10px] sm:text-[11px] font-bold tracking-widest text-fcGreenDark uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-fcCoral animate-pulse"></span>
                TRANSPARÊNCIA & GUIA DA PLATAFORMA
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-fcGreenDark leading-[1.18]">
                Como funciona o <span class="italic font-normal">FauConectado?</span>
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-fcTextMuted leading-relaxed">
                A nossa missão é eliminar barreiras no acesso ao conhecimento académico através de colaboração aberta, tutoria entre pares e transparência total.
            </p>
        </div>

        <!-- Navegação por Abas Interativas (Livewire) -->
        <div class="space-y-6">
            <div class="flex flex-wrap gap-2 border-b border-gray-200 pb-3">
                <button 
                    wire:click="selecionarAba('repositorio')"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 flex items-center gap-2
                    {{ $abaAtiva === 'repositorio' ? 'bg-fcGreenDark text-white shadow-md' : 'bg-gray-100 text-fcTextDark hover:bg-gray-200' }}"
                >
                    <span>📂</span> Repositório Aberto
                </button>

                <button 
                    wire:click="selecionarAba('tutoria')"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 flex items-center gap-2
                    {{ $abaAtiva === 'tutoria' ? 'bg-fcGreenDark text-white shadow-md' : 'bg-gray-100 text-fcTextDark hover:bg-gray-200' }}"
                >
                    <span>🎓</span> Mentoria & Tutoria
                </button>

                <button 
                    wire:click="selecionarAba('apoio')"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 flex items-center gap-2
                    {{ $abaAtiva === 'apoio' ? 'bg-fcGreenDark text-white shadow-md' : 'bg-gray-100 text-fcTextDark hover:bg-gray-200' }}"
                >
                    <span>💚</span> Manutenção & Servidores
                </button>
            </div>

            <!-- Conteúdo da Aba 1: Repositório -->
            @if($abaAtiva === 'repositorio')
                <div class="bg-white rounded-2xl border border-fcGreenDark/10 p-6 sm:p-8 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6 transition-opacity duration-300">
                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center font-bold text-sm">1</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Pesquisa Direta</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Procura por cadeira, curso ou semestre para encontrar rapidamente apontamentos e exames resolvidos.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center font-bold text-sm">2</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Download Livre</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Aceda aos ficheiros sem necessidade de subscrições pagas nem limitações diárias de download.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center font-bold text-sm">3</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Partilha Comunitária</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Submeta os teus materiais para ajudar os colegas das edições futuras a ultrapassarem as mesmas cadeiras.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Conteúdo da Aba 2: Tutoria -->
            @if($abaAtiva === 'tutoria')
                <div class="bg-white rounded-2xl border border-fcGreenDark/10 p-6 sm:p-8 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6 transition-opacity duration-300">
                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcCoral/10 text-fcCoral flex items-center justify-center font-bold text-sm">1</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Escolhe o Mentor</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Consulta a lista de alunos experientes que já obtiveram bom aproveitamento na cadeira que precisas.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcCoral/10 text-fcCoral flex items-center justify-center font-bold text-sm">2</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Contacto Sem Intermediários</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Fala diretamente com o mentor para combinar disponibilidade, local/formato online e o objetivo do estudo.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcCoral/10 text-fcCoral flex items-center justify-center font-bold text-sm">3</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Acordo Transparente</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Cada tutor estabelece autonomamente os seus horários e eventuais condições de apoio.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Conteúdo da Aba 3: Apoio -->
            @if($abaAtiva === 'apoio')
                <div class="bg-white rounded-2xl border border-fcGreenDark/10 p-6 sm:p-8 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6 transition-opacity duration-300">
                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center font-bold text-sm">1</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Alojamento de Dados</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Os ficheiros partilhados exigem espaço de armazenamento em nuvem com alta velocidade de transferência.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center font-bold text-sm">2</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Doações Voluntárias</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Pequenos contributos da comunidade cobrem diretamente os custos recorrentes de alojamento e servidor.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="w-8 h-8 rounded-lg bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center font-bold text-sm">3</span>
                        <h3 class="font-bold text-fcGreenDark text-base">Projeto Sustentável</h3>
                        <p class="text-xs sm:text-sm text-fcTextMuted leading-relaxed">
                            Sem anúncios intrusivos ou mensalidades, mantendo o foco exclusivo no valor académico.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Acordeão Dinâmico de Perguntas Frequentes (FAQ) -->
        <div class="bg-[#142e23] rounded-2xl sm:rounded-[28px] p-6 sm:p-10 text-white shadow-xl space-y-6">
            <div class="border-b border-white/10 pb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-fcCoral">RESPOSTAS RÁPIDAS</span>
                <h2 class="text-xl sm:text-2xl font-serif font-bold text-white mt-1">Perguntas Frequentes</h2>
            </div>

            <div class="space-y-3">
                <!-- Item FAQ 1 -->
                <div class="border-b border-white/10 pb-3">
                    <button 
                        wire:click="toggleFaq(1)" 
                        class="w-full flex justify-between items-center text-left py-2 focus:outline-none"
                    >
                        <span class="font-bold text-sm sm:text-base text-white">É preciso pagar para ver ou descarregar materiais?</span>
                        <span class="text-fcCoral font-bold text-lg">{{ $faqAberto === 1 ? '−' : '+' }}</span>
                    </button>
                    @if($faqAberto === 1)
                        <p class="text-xs sm:text-sm text-white/70 mt-2 leading-relaxed">
                            Não. O acesso a todos os ficheiros do repositório é completamente livre e gratuito para estudantes.
                        </p>
                    @endif
                </div>

                <!-- Item FAQ 2 -->
                <div class="border-b border-white/10 pb-3">
                    <button 
                        wire:click="toggleFaq(2)" 
                        class="w-full flex justify-between items-center text-left py-2 focus:outline-none"
                    >
                        <span class="font-bold text-sm sm:text-base text-white">Como me posso inscrever como tutor/mentor?</span>
                        <span class="text-fcCoral font-bold text-lg">{{ $faqAberto === 2 ? '−' : '+' }}</span>
                    </button>
                    @if($faqAberto === 2)
                        <p class="text-xs sm:text-sm text-white/70 mt-2 leading-relaxed">
                            Basta criares uma conta, aceder ao teu painel de perfil e ativar a opção "Quero ser Tutor", indicando as cadeiras em que podes prestar apoio.
                        </p>
                    @endif
                </div>

                <!-- Item FAQ 3 -->
                <div class="border-b border-white/10 pb-3">
                    <button 
                        wire:click="toggleFaq(3)" 
                        class="w-full flex justify-between items-center text-left py-2 focus:outline-none"
                    >
                        <span class="font-bold text-sm sm:text-base text-white">Como é garantida a qualidade dos materiais?</span>
                        <span class="text-fcCoral font-bold text-lg">{{ $faqAberto === 3 ? '−' : '+' }}</span>
                    </button>
                    @if($faqAberto === 3)
                        <p class="text-xs sm:text-sm text-white/70 mt-2 leading-relaxed">
                            Os ficheiros partilhados contam com um sistema de avaliação comunitária e validação rápida para assegurar conteúdos relevantes e atualizados.
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Banner Inferior de Ação -->
        <div class="bg-fcGreenDark/5 p-8 rounded-2xl border border-fcGreenDark/10 text-center space-y-4">
            <h3 class="text-xl sm:text-2xl font-serif font-bold text-fcGreenDark">Tens tudo o que precisas para começar?</h3>
            <p class="text-xs sm:text-sm text-fcTextMuted max-w-xl mx-auto">
                Explora os conteúdos já partilhados pela comunidade ou entra em contacto com os tutores da tua faculdade.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center pt-2">
                <x-button variant="primary" href="/materias" class="px-6 py-3 text-sm">
                    Explorar Materiais
                </x-button>
                <x-button variant="outline" href="/tutores" class="px-6 py-3 text-sm">
                    Ver Tutores
                </x-button>
            </div>
        </div>

    </div>
</div>