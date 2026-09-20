from django.db import models

from .managers import ApprovedManager


class Evento(models.Model):
    ESTADO_CHOICES = [
        ("PENDENTE", "Pendente"),
        ("APROVADO", "Aprovado"),
        ("REJEITADO", "Rejeitado"),
    ]

    titulo = models.CharField(max_length=100)
    descricao = models.TextField()
    data = models.DateTimeField()
    local = models.CharField(max_length=150)
    estado = models.CharField(
        max_length=10, choices=ESTADO_CHOICES, default="PENDENTE"
    )
    motivo_rejeicao = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    approved_at = models.DateTimeField(blank=True, null=True)

    objects = models.Manager()
    publicos = ApprovedManager()

    def __str__(self):
        return self.titulo
