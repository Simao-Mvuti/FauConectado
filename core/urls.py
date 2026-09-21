from django.urls import path
from django.conf import settings
from django.conf.urls.static import static
from .views import cadeiras, contacto, home, MateriasView,EnviarMaterialView,MentoriasView,EnviarMentoriasView,EventosView,EnviarEventosView

urlpatterns = [
    path("", home, name="home"),
    path("cadeiras/", cadeiras, name="cadeiras"),
    path("contribuir/", contacto, name="contribuir"),
    path("materias/", MateriasView.as_view(), name="materias"),
    path("mentorias/", MentoriasView.as_view(), name="mentorias"),
    path("eventos/",EventosView.as_view(),name="eventos"),
    path("materias/enviar/", EnviarMaterialView.as_view(), name="enviar_material"),
    path("mentorias/enviar",EnviarMentoriasView.as_view(),name="enviar_mentoria"),
    path("eventos/enviar",EnviarEventosView.as_view(),name="enviar_evento")
]

if settings.DEBUG:
  urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)