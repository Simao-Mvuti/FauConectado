from django.shortcuts import render,redirect
from django.db.models import Q
from django.contrib import messages
from .form import MateriaForm
from .models import Materia
from django.views.generic import ListView
from django.urls import reverse_lazy
from django.views.generic import CreateView
from .form import MateriaForm


class MateriaListView(ListView):
    model = Materia
    template_name = "materia/materia_listar.html"
    context_object_name = "materias"

    def get_queryset(self):
        qs = Materia.objects.filter(estado="APROVADO")

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
        })
        return context


class MateriaCreateView(CreateView):
    form_class = MateriaForm
    template_name = "materia/materia_enviar.html"
    success_url = reverse_lazy("listar_materia")

    def form_valid(self, form):
        messages.success(self.request, "Matéria enviada com sucesso")
        return super().form_valid(form) 

    def form_invalid(self, form):
        messages.error(self.request, "Ocorreu um erro ao enviar. Verifique os campos abaixo.")
        return super().form_invalid(form)