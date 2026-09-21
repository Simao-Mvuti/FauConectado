from django.shortcuts import render

from ..models import Cadeira


def cadeiras(request):
    cadeiras_publicas = Cadeira.objects.all()
    ano = request.GET.get("ano", "")

    if ano.isdigit():
        cadeiras_publicas = cadeiras_publicas.all()

    return render(
        request,
        "core/pages/cadeiras.html",
        {
            "cadeiras": cadeiras_publicas.order_by("ano", "semestre", "nome"),
            "anos_disponiveis": range(1, 6),
        },
    )
