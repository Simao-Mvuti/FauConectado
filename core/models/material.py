from django.db import models

from .cadeira import Cadeira
from .managers import ApprovedManager


class Material(models.Model):
    ESTADO_CHOICES = [
        ("PENDENTE", "Pendente"),
        ("APROVADO", "Aprovado"),
        ("REJEITADO", "Rejeitado"),
    ]

    cadeira = models.ForeignKey(
        Cadeira, on_delete=models.CASCADE, related_name="materiais"
    )
    titulo = models.CharField(max_length=30)
    descricao = models.TextField(blank=True)
    tipo = models.CharField(max_length=50)
    extensao = models.CharField(max_length=20)
    autor_nome = models.CharField(max_length=30)
    autor_email = models.EmailField(blank=True)
    estado = models.CharField(
        max_length=10, choices=ESTADO_CHOICES, default="PENDENTE"
    )
    avaliacao_media = models.FloatField(default=0.0)
    created_at = models.DateTimeField(auto_now_add=True)

    objects = models.Manager()
    publicos = ApprovedManager()

    def __str__(self):
        return self.titulo
