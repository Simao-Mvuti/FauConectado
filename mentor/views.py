from django.shortcuts import render
from .models import Mentor

from django.shortcuts import render, redirect
from django.contrib import messages
from .models import Mentor

def criar_mentor(request):
    if request.method == 'POST':
        nome = request.POST.get('nome', '').strip()
        whatsapp = request.POST.get('whatsapp', '').strip()
        sexo = request.POST.get('sexo', '').strip()

        # Validação simples no backend
        if not nome or not whatsapp or not sexo:
            messages.error(request, 'Por favor, preencha todos os campos obrigatórios.')
            return render(request, 'mentor/criar_mentor.html', {
                'nome': nome,
                'whatsapp': whatsapp,
                'sexo': sexo,
                'sexos': Mentor.SEXO_CHOICES
            })

        # Criar o mentor no banco de dados
        Mentor.objects.create(
            nome=nome,
            whatsapp=whatsapp,
            sexo=sexo
        )

        messages.success(request, 'Cadastro realizado com sucesso! Agora é um explicador ativo.')
        return redirect('listar_mentores') # Redireciona para a lista de mentores

    # Método GET: Renderiza o formulário
    context = {
        'sexos': Mentor.SEXO_CHOICES
    }
    return render(request, 'mentor/criar_mentor.html', context)

def listar_mentores(request):
    busca = request.GET.get('q', '')
    mentores = Mentor.objects.all().order_by('-votos')

    if busca:
        mentores = mentores.filter(nome__icontains=busca)

    context = {
        'mentores': mentores,
        'busca': busca,
    }

    return render(request, 'mentor/listar_mentores.html', context)