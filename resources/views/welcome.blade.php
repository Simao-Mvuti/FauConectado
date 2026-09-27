<x-layouts.app title="FauConectado | Aprende sem rodeios">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        <!-- Coluna da Esquerda: Chamada e Apresentação -->
        <div class="lg:col-span-6 space-y-4 sm:space-y-6 text-left">
            
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[10px] sm:text-[11px] font-bold tracking-widest text-fcGreenDark uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-fcCoral animate-pulse" aria-hidden="true"></span>
                PLATAFORMA COLABORATIVA & TRANSPARENTE
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-fcGreenDark leading-[1.18]">
                Aprende, partilha e conecta-te <span class="italic font-normal">sem rodeios.</span>
            </h1>

            <p class="text-sm sm:text-base lg:text-lg text-fcTextMuted leading-relaxed">
                Um espaço aberto para partilha de materiais de estudo e contacto direto com tutores e mentores da comunidade académica.
            </p>

            <!-- Lista de pontos -->
            <div class="space-y-2.5 pt-1 text-xs sm:text-sm font-medium text-fcTextDark">
                <div class="flex items-start gap-2.5">
                    <span class="w-4 h-4 rounded-full bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center text-[10px] font-bold mt-0.5 shrink-0" aria-hidden="true">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span><strong>Repositório Aberto:</strong> Resumos, testes e materiais partilhados livremente.</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="w-4 h-4 rounded-full bg-fcCoral/10 text-fcCoral flex items-center justify-center text-[10px] font-bold mt-0.5 shrink-0" aria-hidden="true">🤝</span>
                    <span><strong>Mentoria Direta:</strong> Cada tutor define os seus horários e requisitos de apoio.</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="w-4 h-4 rounded-full bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center text-[10px] font-bold mt-0.5 shrink-0" aria-hidden="true">💚</span>
                    <span><strong>Apoio Comunitário:</strong> Contribuições voluntárias mantêm os servidores ativos.</span>
                </div>
            </div>

            <!-- Botões -->
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <x-button variant="primary" href="/materias" class="group px-6 py-3 text-sm inline-flex items-center justify-center gap-2">
                    <span>Explorar Conteúdos</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </x-button>
                
                <x-button variant="outline" href="#apoiar" class="px-6 py-3 text-sm text-center">
                    Apoiar o Projeto
                </x-button>
            </div>
        </div>

        <!-- Coluna da Direita: Painel em Destaque Mobile-First -->
        <div class=" lg:col-span-6 mt-4 lg:mt-0">
            <div class="bg-fcGreenCard rounded-2xl sm:rounded-[28px] p-5 sm:p-7 text-white shadow-xl space-y-4">
                
                <div class="flex justify-between items-center border-b border-white/10 pb-3 sm:pb-4">
                    <div>
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-fcCoral">COMO FUNCIONA</span>
                        <h3 class="text-lg sm:text-xl font-serif font-bold text-white">Regras claras para todos</h3>
                    </div>
                    <span class="text-[10px] sm:text-xs bg-white/10 text-white px-2.5 py-1 rounded-full font-medium">Transparência</span>
                </div>

                <div class="space-y-3">
                    <x-feature-card 
                        icon="📂" 
                        title="Partilha de Materiais" 
                        description="Apontamentos e exames resolvidos disponibilizados livremente." 
                    />
                    
                    <x-feature-card 
                        icon="🎓" 
                        title="Tutores e Mentores" 
                        description="Contacta alunos experientes. Os requisitos são acordados diretamente com o mentor." 
                    />

                    <x-feature-card 
                        icon="⚡" 
                        title="Manutenção dos Servidores" 
                        description="Para manter a infraestrutura online, contamos com doações comunitárias." 
                    />
                </div>

                <div id="apoiar" class="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 text-center scroll-mt-6">
                    <div class="bg-fcGreenBox rounded-xl p-3 flex flex-col justify-center items-center">
                        <span class="text-xs text-white/60 mb-0.5">Apoio aos servidores</span>
                        <a href="#" class="text-xs text-fcCoral font-bold hover:underline inline-flex items-center gap-1">
                            Contribuir com o projeto <span aria-hidden="true">→</span>
                        </a>
                    </div>
                    <div class="bg-fcGreenBox rounded-xl p-3 flex flex-col justify-center items-center">
                        <span class="text-xs text-white/60 mb-0.5">Queres ser tutor?</span>
                        <a href="#" class="text-xs text-white font-bold hover:underline inline-flex items-center gap-1">
                            Define o teu perfil <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layouts.app>