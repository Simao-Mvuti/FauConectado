from django.shortcuts import render


def contacto(request):
    return render(request, "core/pages/contribuir.html")
