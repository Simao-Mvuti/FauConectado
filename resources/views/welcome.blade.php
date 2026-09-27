<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FauConectado | Comunidade Académica Transparente</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Configuração de Temas do Tailwind -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              fcGreenDark: '#133023',
              fcGreenCard: '#163829',
              fcGreenBox: '#1e4735',
              fcCoral: '#e0533c',
              fcBgLight: '#f3f6f2',
              fcTextDark: '#121c17',
              fcTextMuted: '#5f6c65',
            },
            fontFamily: {
              sans: ['"Plus Jakarta Sans"', 'sans-serif'],
              serif: ['"Playfair Display"', 'Georgia', 'serif'],
            }
          }
        }
      }
    </script>
</head>
<body class="bg-fcBgLight text-fcTextDark font-sans min-h-screen flex flex-col justify-between">

    <!-- Banner Superior de Transparência/Sustentabilidade -->
    <div class="bg-fcGreenDark text-white/90 text-xs py-2 px-4 text-center border-b border-white/10">
        <span class="font-medium">🌱 Projeto independente mantido por estudantes.</span> 
        <a href="#apoiar" class="underline text-fcCoral font-semibold ml-1 hover:text-white transition">Sabe como nos ajudar a manter o servidor no ar →</a>
    </div>

    <!-- Navegação -->
    <header class="py-5">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <!-- Logótipo -->
            <a href="#" class="flex items-center gap-2">
                <span class="w-9 h-9 bg-fcGreenDark text-white font-bold rounded-lg flex items-center justify-center text-lg">F</span>
                <span class="text-2xl font-bold tracking-tight">
                    <span class="text-fcGreenDark">Fau</span><span class="text-fcCoral">Conectado</span>
                </span>
            </a>

            <!-- Menu de Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-fcTextMuted">
                <a href="#" class="text-fcTextDark font-semibold">Início</a>
                <a href="#" class="hover:text-fcGreenDark transition">Materiais</a>
                <a href="#" class="hover:text-fcGreenDark transition">Mentores</a>
                <a href="#" class="hover:text-fcGreenDark transition">Cadeiras</a>
                <a href="#" class="hover:text-fcGreenDark transition">Apoiar Projeto</a>
            </nav>

            <!-- Botões de Ação -->
            <div class="flex items-center gap-3">
                <a href="#" class="text-sm font-semibold text-fcGreenDark hover:underline px-3 py-2">Entrar</a>
                <a href="#" class="bg-fcGreenDark text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-[#0b1d15] transition shadow-sm">
                    Junta-te à Comunidade
                </a>
            </div>
        </div>
    </header>

    <!-- Secção Principal (Hero) -->
    <main class="my-auto py-6">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Coluna da Esquerda: Mensagem Transparente -->
            <div class="lg:col-span-6 space-y-6">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[11px] font-bold tracking-widest text-fcGreenDark uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-fcCoral"></span>
                    PLATAFORMA COLABORATIVA & TRANSPARENTE
                </div>

                <!-- Título -->
                <h1 class="text-4xl lg:text-5xl font-serif font-bold text-fcGreenDark leading-[1.15]">
                    Aprende, partilha e conecta-te <span class="italic font-normal">sem rodeios.</span>
                </h1>

                <!-- Subtítulo -->
                <p class="text-base lg:text-lg text-fcTextMuted leading-relaxed">
                    Um espaço aberto para partilha de materiais de estudo e contacto direto com tutores e mentores da comunidade académica.
                </p>

                <!-- Pontos de Transparência (Checkmarks Honestos) -->
                <div class="space-y-3 pt-1 text-sm font-medium text-fcTextDark">
                    <div class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center text-xs font-bold mt-0.5">✓</span>
                        <span><strong>Repositório Aberto:</strong> Acede a resumos, testes e materiais partilhados por outros alunos.</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-fcCoral/10 text-fcCoral flex items-center justify-center text-xs font-bold mt-0.5">🤝</span>
                        <span><strong>Mentoria Direta:</strong> Cada tutor/mentor define autonomamente as suas regras, requisitos e horários de apoio.</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-fcGreenDark/10 text-fcGreenDark flex items-center justify-center text-xs font-bold mt-0.5">💚</span>
                        <span><strong>Manutenção Comunitária:</strong> Aceitamos contribuições voluntárias para cobrir os custos de alojamento e servidores.</span>
                    </div>
                </div>

                <!-- Chamada para Ação -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#" class="bg-fcGreenDark text-white px-7 py-3.5 rounded-full font-semibold flex items-center gap-2 hover:bg-[#0b1d15] transition shadow-md">
                        Explorar Conteúdos
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#apoiar" class="bg-white border border-[#dcdfd9] text-fcTextDark px-6 py-3.5 rounded-full font-semibold hover:bg-gray-50 transition flex items-center gap-2">
                        <span>Apoiar o Projeto</span>
                        <span class="text-xs bg-fcCoral/10 text-fcCoral px-2 py-0.5 rounded-full font-bold">Servidor</span>
                    </a>
                </div>
            </div>

            <!-- Coluna da Direita: Painel Informativo -->
            <div class="lg:col-span-6">
                <div class="bg-fcGreenCard rounded-[28px] p-7 text-white shadow-xl space-y-4">
                    
                    <!-- Topo do Cartão -->
                    <div class="flex justify-between items-center border-b border-white/10 pb-4">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-fcCoral">COMO FUNCIONA</span>
                            <h3 class="text-xl font-serif font-bold text-white">Regras claras para a comunidade</h3>
                        </div>
                        <span class="text-xs bg-white/10 text-white px-3 py-1 rounded-full font-medium">Transparência</span>
                    </div>

                    <!-- Bloco 1: Materiais -->
                    <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-fcCoral/20 text-fcCoral flex items-center justify-center font-bold text-lg shrink-0">
                            📂
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">Partilha de Materiais</h4>
                            <p class="text-xs text-white/70 mt-0.5">Apontamentos, resumos e provas antigas disponibilizados livremente pela comunidade.</p>
                        </div>
                    </div>

                    <!-- Bloco 2: Mentores (Requisitos Próprios) -->
                    <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 text-white flex items-center justify-center font-bold text-lg shrink-0">
                            🎓
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">Rede de Tutores & Mentores</h4>
                            <p class="text-xs text-white/70 mt-0.5">Contacta alunos experientes. Os requisitos de cada mentoria são acordados diretamente com o tutor.</p>
                        </div>
                    </div>

                    <!-- Bloco 3: Sustentabilidade -->
                    <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 text-white flex items-center justify-center font-bold text-lg shrink-0">
                            ⚡
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">Manutenção dos Servidores</h4>
                            <p class="text-xs text-white/70 mt-0.5">Para manter a plataforma online e rápida, contamos com doações comunitárias e parcerias.</p>
                        </div>
                    </div>

                    <!-- Rodapé do Cartão com Destaque de Apoio -->
                    <div id="apoiar" class="pt-2 grid grid-cols-2 gap-3 text-center">
                        <div class="bg-fcGreenBox rounded-xl p-3">
                            <div class="text-xs text-white/60 mb-1">Apoio aos servidores</div>
                            <a href="#" class="text-xs text-fcCoral font-bold hover:underline">Contribuir com o projeto →</a>
                        </div>
                        <div class="bg-fcGreenBox rounded-xl p-3">
                            <div class="text-xs text-white/60 mb-1">Queres ser tutor?</div>
                            <a href="#" class="text-xs text-white font-bold hover:underline">Define o teu perfil →</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <footer class="py-4"></footer>

</body>
</html>