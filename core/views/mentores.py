from django.shortcuts import render

from ..models import Mentor


def mentores(request):
    mentores_publicos = Mentor.publicos
    area = request.GET.get("area", "")
    ordenar = request.GET.get("ordenar", "avaliacao")

    if area:
        mentores_publicos = mentores_publicos.filter(area=area)
    if ordenar == "nome":
        mentores_publicos = mentores_publicos.order_by("nome")
    else:
        mentores_publicos = mentores_publicos.order_by("-avaliacao_media", "nome")

    return render(
        request,
        "core/pages/mentores.html",
        {
            "mentores": mentores_publicos,
            "areas_mentor": Mentor.AREA_CHOICES,
        },
    )
