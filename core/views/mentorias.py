from django.shortcuts import render
from django.views.generic import ListView,CreateView
from ..models import Mentoria
from ..forms import MentoriaForm
from django.urls import reverse_lazy
from django.contrib import messages
from django.shortcuts import redirect


class MentoriasView(ListView):
    model = Mentoria
    template_name = "core/pages/mentorias.html"
    context_object_name = "mentorias"

    def get_queryset(self):
        mentores_publicos = Mentoria.publicos
        area = self.request.GET.get("area")
        ordenar = self.request.GET.get("ordenar","avaliacao")
        if area:
            mentores_publicos = mentores_publicos.filter(area=area)
        if ordenar == "nome":
            mentores_publicos = mentores_publicos.order_by("nome")
        else:
            mentores_publicos = mentores_publicos.order_by("-avaliacao_media", "nome")

        return mentores_publicos

class EnviarMentoriasView(CreateView):
    template_name = "core/pages/enviar-mentoria.html"
    form_class = MentoriaForm
    model = Mentoria
    success_url = reverse_lazy('mentorias')

    def form_valid(self, form):
        mentoria = form.save(commit=False)
        mentoria.save()
        messages.success(self.request, "Candidatura enviada com sucesso! Aguarde pela aprovação.")
        return redirect("mentorias") 
    
    def form_invalid(self, form):
        messages.error(self.request, "Não foi possível enviar a candidatura. Por favor, verifica os erros no formulário abaixo.")
        return super().form_invalid(form)