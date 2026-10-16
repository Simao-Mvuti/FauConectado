from django.shortcuts import render,redirect
from django.db.models import Q
from django.contrib import messages
from .form import MateriaForm
from .models import Materia
from django.views.generic import ListView
from django.urls import reverse_lazy
from django.views.generic import CreateView
from .form import MateriaForm
from django.contrib.auth.mixins import LoginRequiredMixin
from django.shortcuts import get_object_or_404, redirect
from django.contrib.auth.decorators import login_required
from django.contrib import messages
from django.http import FileResponse
from .models import Materia, VotoMateria




class MateriaListView(LoginRequiredMixin,ListView):
    model = Materia
    template_name = "materia/materia_listar.html"
    context_object_name = "materias"
    login_url = reverse_lazy("login")

    def get_queryset(self):
        qs = Materia.objects.filter(aprovado=True)

        busca = self.request.GET.get("q", "").strip()
        ano = self.request.GET.get("ano", "")
        semestre = self.request.GET.get("semestre", "")

        if busca:
            qs = qs.filter(Q(titulo__icontains=busca) | Q(descricao__icontains=busca))
        if ano:
            qs = qs.filter(ano=ano)
        if semestre:
            qs = qs.filter(semestre=semestre)
        return qs

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context.update({
            "busca": self.request.GET.get("q", "").strip(),
            "ano_selecionado": self.request.GET.get("ano", ""),
            "semestre_selecionado": self.request.GET.get("semestre", ""),
            "anos": [(i, f"{i}º Ano") for i in range(1, 6)],
            "semestres": [(1, "1º Semestre"), (2, "2º Semestre")],
            "moedas":self.request.user.moedas
        })
        return context


class MateriaCreateView(LoginRequiredMixin,CreateView):
    form_class = MateriaForm
    template_name = "materia/materia_enviar.html"
    success_url = reverse_lazy("listar_materia")
    login_url = reverse_lazy("login")

    def form_valid(self, form):
        materia = form.save(commit=False)
        materia.autor = self.request.user
        messages.success(self.request, "Matéria enviada com sucesso")
        return super().form_valid(form) 

    def form_invalid(self, form):
        messages.error(self.request, "Ocorreu um erro ao enviar. Verifique os campos abaixo.")
        return super().form_invalid(form)

CUSTO_DOWNLOAD = 2
RECOMPENSA_VOTO = 1

@login_required
def votar_materia(request, pk):
    materia = get_object_or_404(Materia, pk=pk)
    
    if materia.autor == request.user:
        messages.warning(request, "Não pode votar no seu próprio material.")
        return redirect('listar_materia')

    voto_existente = VotoMateria.objects.filter(utilizador=request.user, materia=materia).first()

    if voto_existente:
        messages.info(request, "Já votou neste material anteriormente.")
    else:
        VotoMateria.objects.create(utilizador=request.user, materia=materia)
        materia.votos += 1
        materia.save()

        materia.autor.moedas += RECOMPENSA_VOTO
        materia.autor.save()

        messages.success(request, f"Voto registado! +{RECOMPENSA_VOTO} moeda atribuída ao autor.")

    return redirect('listar_materia')


@login_required
def baixar_materia(request, pk):
    materia = get_object_or_404(Materia, pk=pk)

    if materia.autor == request.user:
        return FileResponse(materia.ficheiro.open('rb'), as_attachment=True)

    if request.user.moedas < CUSTO_DOWNLOAD:
        messages.error(request, f"Saldo insuficiente! Precisa de {CUSTO_DOWNLOAD} FC Coins para baixar. Saldo atual: {request.user.moedas} coins.")
        return redirect('listar_materia')

    request.user.moedas -= CUSTO_DOWNLOAD
    request.user.save()

    # Opcional: Dar a moeda ao autor ao ser baixado
    materia.autor.moedas += 1
    materia.autor.save()

    messages.success(request, f"Download efetuado! Foram deduzidas {CUSTO_DOWNLOAD} moedas.")
    return FileResponse(materia.ficheiro.open('rb'), as_attachment=True)