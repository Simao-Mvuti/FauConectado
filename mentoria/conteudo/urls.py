from django.urls import path
from . import views

urlpatterns = [
    path('', views.listar_conteudos, name='index'),
    path('criar-conteudo', views.criar_conteudo, name='criar_conteudo'),
    path('conteudo/<int:conteudo_id>/avaliar', views.avaliar_conteudo, name='avaliar_conteudo'),
    path('conteudo/<int:conteudo_id>/baixar', views.baixar_conteudo, name='baixar_conteudo'),
    path('feedback', views.enviar_sugestao, name='enviar_sugestao'),
    path('candidatura-mentor', views.candidatar_mentor, name='candidatar_mentor'),
]