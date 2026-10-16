# core/context_processors.py
from django.core.cache import cache
from materia.models import Materia
from mentor.models import Mentor

def rodape_stats(request):
    stats = cache.get("rodape_stats")
    if stats is None:
        stats = {
            "stats_materiais": Materia.objects.filter(aprovado=True).count(),
            "stats_tutores": Mentor.objects.filter(aprovado=True).count(),
        }
        cache.set("rodape_stats", stats, 300)
    return stats