from django.views.generic import ListView,CreateView
from ..models import Evento
from ..forms import EventoForm
from django.urls import reverse_lazy
from django.contrib import messages
from django.shortcuts import redirect

class EventosView(ListView):
    model = Evento
    context_object_name = "eventos"
    template_name = "core/pages/eventos.html"

    def get_queryset(self):
        eventos_publicos = Evento.publicos.all()
        tipo = self.request.GET.get("tipo","")
        data_de = self.request.GET.get("data_de","")
        if tipo:
            eventos_publicos = eventos_publicos.filter(tipo=tipo)
        if data_de:
            eventos_publicos = eventos_publicos.filter(data__gte=data_de)
        return eventos_publicos

class EnviarEventosView(CreateView):
    template_name = "core/pages/enviar-evento.html"
    form_class = EventoForm
    model = Evento
    success_url = reverse_lazy('eventos')

    def form_valid(self, form):
        form.save()
        messages.success(self.request,"Evento enviado com sucesso! Aguarde pela aprovação.")
        return redirect("eventos")
