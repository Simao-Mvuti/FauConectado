from django.urls import path
from .views import enviar_materia,listar_materia

urlpatterns = [
    path('enviar',enviar_materia,name="enviar_materia"),
    path('',listar_materia,name="listar_materia")
]

