from django.urls import path
from .views import MateriaCreateView,MateriaListView,votar_materia,baixar_materia

urlpatterns = [
    path('enviar',MateriaCreateView.as_view(),name="enviar_materia"),
    path('',MateriaListView.as_view(),name="listar_materia"),
    path('<int:pk>/votar/', votar_materia, name='votar_materia'),
    path('<int:pk>/baixar/', baixar_materia, name='baixar_materia'),
]

