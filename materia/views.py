from django.shortcuts import render,redirect
from django.db.models import Q
from .form import MateriaForm
from .models import Materia

def listar_materia(request):
    materias = Materia.objects.filter(estado="APROVADO")

    busca = request.GET.get("q", "").strip()
    ano = request.GET.get("ano", "")
    semestre = request.GET.get("semestre", "")

    if busca:
        materias = materias.filter(
            Q(titulo__icontains=busca) | Q(descricao__icontains=busca)
        )

    if ano:
        materias = materias.filter(ano=ano)

    if semestre:
        materias = materias.filter(semestre=semestre)

    context = {
        "materias": materias,
        "busca": busca,
        "ano_selecionado": ano,
        "semestre_selecionado": semestre,
        "anos": Materia.ANOS,
        "semestres": Materia.SEMESTRES,
    }

    return render(request, "materia/materia_listar.html", context)

def enviar_materia(request):
    if request.method == "POST":
        form = MateriaForm(request.POST, request.FILES)

        if form.is_valid():
            form.save()
            return redirect("listar_materia")
    else:
        form = MateriaForm()

    return render(request, "materia/materia_enviar.html", {"form": form})