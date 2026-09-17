from django.shortcuts import render

from ..models import Material


def materias(request):
    materiais = Material.publicos.select_related("cadeira")
    query = request.GET.get("q", "").strip()
    ano = request.GET.get("ano", "")
    semestre = request.GET.get("semestre", "")

    if query:
        materiais = materiais.filter(titulo__icontains=query)
    if ano.isdigit():
        materiais = materiais.filter(cadeira__ano=int(ano))
    if semestre in {"1", "2"}:
        materiais = materiais.filter(cadeira__semestre=int(semestre))

    return render(
        request,
        "core/pages/materias.html",
        {
            "materiais": materiais.order_by("-avaliacao_media", "-created_at"),
            "anos_disponiveis": range(1, 6),
        },
    )
