from django.urls import path
from .views import cadeiras, contacto, eventos, home, materias, mentores

urlpatterns = [
    path("", home, name="home"),
    path("materias/", materias, name="materias"),
    path("mentores/", mentores, name="mentores"),
    path("cadeiras/", cadeiras, name="cadeiras"),
    path("eventos/",    eventos, name="eventos"),
    path("contacto/", contacto, name="contacto"),
]
