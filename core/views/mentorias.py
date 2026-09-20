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
        queryset = Mentoria.objects.filter(estado__iexact="APROVADO") 
        
        curso = self.request.GET.get("area")
        if curso:
            queryset = queryset.filter(curso__iexact=curso)

        # Ordenação
        ordenar = self.request.GET.get("ordenar")
        if ordenar == "nome":
            queryset = queryset.order_by("nome")
        elif ordenar == "avaliacao":
            queryset = queryset.order_by("-avaliacao_media")

        return queryset

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        cursos_aprovados = (
            Mentoria.objects.filter(estado__iexact="APROVADO")
            .values_list("curso", flat=True)
            .distinct()
            .order_by("curso")
        )
        context["areas_mentorias"] = [(curso, curso) for curso in cursos_aprovados if curso]
        return context
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