from django.db import models


class ApprovedManager(models.Manager):
    """Retorna apenas registos aprovados para exibição pública."""

    def get_queryset(self):
        return super().get_queryset().filter(estado="APROVADO")
