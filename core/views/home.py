from django.db.models import Count
from django.shortcuts import render

from ..models import Cadeira, Material, Mentor


def home(request):
    materiais = Material.publicos.select_related("cadeira").order_by("-created_at")
    mentores = Mentor.publicos.order_by("-avaliacao_media", "nome")
    cadeiras = Cadeira.objects.filter(ativo=True).annotate(
        total_materiais=Count("materiais")
    )

    return render(
        request,
        "core/pages/home.html",
        {
            "materia_destaque": materiais.first(),
            "total_materiais": materiais.count(),
            "total_mentores": mentores.count(),
            "mentores": mentores[:3],
            "cadeiras_destaque": cadeiras.order_by("-total_materiais", "nome")[:4],
            "cadeiras": Cadeira.objects.filter(ativo=True).order_by(
                "ano", "semestre", "nome"
            ),
        },
    )
