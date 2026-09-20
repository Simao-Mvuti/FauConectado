from django.shortcuts import render, redirect
from django.contrib import messages
from django.views.generic import ListView, CreateView
from ..models import Material, Cadeira
from ..forms import MaterialForm
from django.urls import reverse_lazy
from django.contrib import messages

class MateriasView(ListView):
    model = Material
    template_name = "core/pages/materias.html"
    context_object_name = "materiais"

    def get_queryset(self):
        materiais = Material.publicos.select_related("cadeira")

        query = self.request.GET.get("q", "").strip()
        ano = self.request.GET.get("ano", "")
        semestre = self.request.GET.get("semestre", "")

        if query:
            materiais = materiais.filter(titulo__icontains=query)

        if ano.isdigit():
            materiais = materiais.filter(cadeira__ano=int(ano))

        if semestre in {"1", "2"}:
            materiais = materiais.filter(cadeira__semestre=int(semestre))

        return materiais.order_by("-avaliacao_media", "-created_at")


class EnviarMaterialView(CreateView):
    model = Material
    form_class = MaterialForm
    template_name = "core/pages/enviar-materia.html"
    success_url = reverse_lazy('materias')

    def form_valid(self, form):
        materia = form.save(commit=False)
        ficheiro = form.cleaned_data["ficheiro"]
        materia.titulo = ficheiro.name
        materia.save()
        messages.success(self.request,"Material enviado com sucesso! Aguarde pela aprovação.")
           
        return redirect("materias")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        cadeiras = Cadeira.objects.filter(ativo=True).order_by("nome")
        context["cadeiras"] = cadeiras
        return context
   