from django.contrib import messages
from django.core.exceptions import ValidationError
from django.core.validators import validate_email
from django.http import FileResponse, Http404, HttpResponseRedirect
from django.shortcuts import get_object_or_404, redirect, render
from django.urls import reverse

from .models import Avaliacao, CandidaturaMentor, Conteudo, Sugestao

def listar_conteudos(request):
    conteudos = Conteudo.objects.filter(publicado=True).prefetch_related('avaliacoes')
    mentores = CandidaturaMentor.objects.filter(status='aprovada')
    return render(request, 'conteudo/index.html', {'conteudos': conteudos, 'mentores': mentores})


def criar_conteudo(request):
    if request.method != 'POST':
        return redirect('index')

    titulo = request.POST.get('titulo', '').strip()
    descricao = request.POST.get('descricao', '').strip()
    if not titulo or not descricao:
        messages.error(request, 'Indique um título e uma descrição para o conteúdo.')
        return redirect('index')

    Conteudo.objects.create(
        titulo=titulo,
        conteudo=descricao,
        ficheiro=request.FILES.get('ficheiro'),
        publicado=False,
    )
    messages.success(request, 'Conteúdo enviado para aprovação da equipa.')
    return redirect('index')


def avaliar_conteudo(request, conteudo_id):
    if request.method != 'POST':
        return redirect('index')

    conteudo = get_object_or_404(Conteudo, pk=conteudo_id, publicado=True)
    try:
        pontuacao = int(request.POST.get('pontuacao', 0))
    except (TypeError, ValueError):
        pontuacao = 0

    if pontuacao not in range(1, 6):
        messages.error(request, 'Escolha uma avaliação entre 1 e 5 estrelas.')
    else:
        _, criada = Avaliacao.objects.get_or_create(
            conteudo=conteudo,
            identificador_visitante=request.META.get('REMOTE_ADDR', 'anonimo'),
            defaults={'pontuacao': pontuacao},
        )
        messages.success(request, 'Obrigado pela sua avaliação.' if criada else 'Este conteúdo já foi avaliado neste dispositivo.')
    return HttpResponseRedirect(f'{reverse("index")}#conteudo-{conteudo_id}')


def baixar_conteudo(request, conteudo_id):
    conteudo = get_object_or_404(Conteudo, pk=conteudo_id, publicado=True)
    if not conteudo.ficheiro:
        raise Http404('Este conteúdo não tem ficheiro para baixar.')
    return FileResponse(
        conteudo.ficheiro.open('rb'),
        as_attachment=True,
        filename=conteudo.ficheiro.name.rsplit('/', 1)[-1],
    )


def enviar_sugestao(request):
    if request.method == 'POST':
        mensagem = request.POST.get('mensagem', '').strip()
        tipo = request.POST.get('tipo', 'sugestao')
        contacto = request.POST.get('contacto', '').strip()
        if tipo not in {'sugestao', 'critica', 'elogio'}:
            messages.error(request, 'Escolha um tipo de feedback válido.')
        elif not mensagem:
            messages.error(request, 'Escreva a sua sugestão ou crítica antes de enviar.')
        elif contacto:
            try:
                validate_email(contacto)
            except ValidationError:
                messages.error(request, 'Indique um email válido ou deixe o campo vazio.')
            else:
                Sugestao.objects.create(tipo=tipo, mensagem=mensagem, contacto=contacto)
                messages.success(request, 'Obrigado. O seu feedback foi recebido.')
        else:
            Sugestao.objects.create(tipo=tipo, mensagem=mensagem)
            messages.success(request, 'Obrigado. O seu feedback foi recebido.')
    return redirect(f'{reverse("index")}#feedback')


def candidatar_mentor(request):
    if request.method == 'POST':
        dados = {campo: request.POST.get(campo, '').strip() for campo in ('nome', 'email', 'area', 'apresentacao')}
        if not all(dados.values()):
            messages.error(request, 'Preencha todos os campos da candidatura.')
        else:
            try:
                validate_email(dados['email'])
            except ValidationError:
                messages.error(request, 'Indique um email válido para a candidatura.')
            else:
                CandidaturaMentor.objects.create(**dados)
                messages.success(request, 'Candidatura enviada. A equipa irá analisá-la.')
    return redirect(f'{reverse("index")}#mentoria')