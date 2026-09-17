from django.shortcuts import render

from ..models import Cadeira


def cadeiras(request):
    cadeiras_publicas = Cadeira.objects.filter(ativo=True)
    ano = request.GET.get("ano", "")

    if ano.isdigit():
        cadeiras_publicas = cadeiras_publicas.filter(ano=int(ano))

    return render(
        request,
        "core/pages/cadeiras.html",
        {
            "cadeiras": cadeiras_publicas.order_by("ano", "semestre", "nome"),
            "anos_disponiveis": range(1, 6),
        },
    )
