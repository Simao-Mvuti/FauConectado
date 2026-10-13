from django.urls import path
from .views import listar_mentores, criar_mentor

urlpatterns = [
    path('',listar_mentores,name="mentoria"),
    path('novo',criar_mentor,name="criar_mentor")
]
