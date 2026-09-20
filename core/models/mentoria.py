from django.db import models

from .managers import ApprovedManager


class Mentoria(models.Model):
    ESTADO_CHOICES = [
        ("PENDENTE", "Pendente"),
        ("APROVADO", "Aprovado"),
        ("REJEITADO", "Rejeitado"),
    ]

    nome = models.CharField(max_length=100)
    curso = models.CharField(max_length=100)
    ano = models.IntegerField()
    descricao = models.TextField()
    contacto_publico = models.CharField(max_length=50)
    estado = models.CharField(
        max_length=10, choices=ESTADO_CHOICES, default="PENDENTE"
    )
    motivo_rejeicao = models.TextField(blank=True, null=True)
    avaliacao_media = models.FloatField(default=0.0)
    total_avaliacoes = models.IntegerField(default=0)
    created_at = models.DateTimeField(auto_now_add=True)
    approved_at = models.DateTimeField(blank=True, null=True)

    objects = models.Manager()
    publicos = ApprovedManager()

    def __str__(self):
        return self.nome
