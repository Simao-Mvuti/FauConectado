from django.contrib import messages
from django.urls import reverse_lazy
from django.views.generic import CreateView, ListView
from django.contrib.auth.mixins import LoginRequiredMixin
from .models import Mentor
from .forms import MentorForm

class MentorCreateView(LoginRequiredMixin,CreateView):
    form_class = MentorForm
    template_name = "mentor/criar_mentor.html"
    success_url = reverse_lazy("mentoria")
    login_url = reverse_lazy("login")

    def form_valid(self, form):
        messages.success(self.request, "Cadastro realizado com sucesso! Agora é um explicador ativo.")
        return super().form_valid(form)

    def form_invalid(self, form):
        messages.error(self.request, "Por favor, preencha todos os campos obrigatórios.")
        return super().form_invalid(form)


class MentorListView(LoginRequiredMixin,ListView):
    template_name = "mentor/listar_mentores.html"
    context_object_name = "mentores"
    login_url = reverse_lazy("login")

    def get_queryset(self):
        qs = Mentor.objects.filter(aprovado=True).order_by("-votos")
        busca = self.request.GET.get("q", "").strip()
        if busca:
            qs = qs.filter(nome__icontains=busca)
        return qs

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["busca"] = self.request.GET.get("q", "").strip()
        return context