from django.shortcuts import render

from ..models import Evento


def eventos(request):
    eventos_publicos = Evento.publicos
    tipo = request.GET.get("tipo", "")
    data_de = request.GET.get("data_de", "")

    if tipo:
        eventos_publicos = eventos_publicos.filter(tipo=tipo)
    if data_de:
        eventos_publicos = eventos_publicos.filter(data__gte=data_de)

    return render(
        request,
        "core/pages/eventos.html",
        {
            "eventos": eventos_publicos.order_by("data", "hora"),
            "tipos_evento": Evento.TIPO_CHOICES,
        },
    )
