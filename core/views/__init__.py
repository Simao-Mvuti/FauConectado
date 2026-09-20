from .cadeiras import cadeiras
from .contacto import contacto
from .home import home
from .materias import MateriasView, EnviarMaterialView
from .mentorias import MentoriasView,EnviarMentoriasView
from .eventos import EventosView,EnviarEventosView

__all__ = [
    "cadeiras",
    "contacto",
    "home",
    "EventosView",
    "EnviarEventosView",
    "MentoriasView",
    "EnviarMentoriasView",
    "MateriasView",
    "EnviarMaterialView",
]
