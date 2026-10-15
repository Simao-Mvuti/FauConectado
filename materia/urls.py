from django.urls import path
from .views import MateriaCreateView,MateriaListView

urlpatterns = [
    path('enviar',MateriaCreateView.as_view(),name="enviar_materia"),
    path('',MateriaListView.as_view(),name="listar_materia")
]

