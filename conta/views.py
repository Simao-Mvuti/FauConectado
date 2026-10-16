from django.contrib.auth.mixins import LoginRequiredMixin
from django.urls import reverse_lazy
from django.views.generic import CreateView
from django.contrib.auth import login
from materia.models import Materia
from materia.form import MateriaForm  
from .forms import RegistoForm

class DashboardView(LoginRequiredMixin, CreateView):
    model = Materia
    form_class = MateriaForm 
    template_name = "registration/dashboard.html"
    success_url = reverse_lazy("dashboard") 

    def form_valid(self, form):
        form.instance.autor = self.request.user
        return super().form_valid(form)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        utilizador = self.request.user
        materiais = Materia.objects.filter(autor=utilizador).order_by('-id')
        
        context['materiais'] = materiais
        context['total_materiais'] = materiais.count()
        context['materiais_aprovados'] = materiais.filter(estado='aprovado').count()
        context['materiais_pendentes'] = materiais.filter(estado='pendente').count()

        return context
    
class RegistroView(CreateView):
    form_class = RegistoForm
    template_name = "registration/registro.html"
    success_url = reverse_lazy("listar_materia")

    def form_valid(self, form):
        resposta = super().form_valid(form)
        login(self.request, self.object)
        return resposta