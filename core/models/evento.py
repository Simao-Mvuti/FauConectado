from django.db import models

from .managers import ApprovedManager


class Evento(models.Model):
    TIPO_CHOICES = [
        ("PALESTRA", "Palestra"),
        ("WORKSHOP", "Workshop"),
        ("ENCONTRO", "Encontro"),
    ]
    ESTADO_CHOICES = [
        ("PENDENTE", "Pendente"),
        ("APROVADO", "Aprovado"),
        ("REJEITADO", "Rejeitado"),
    ]

    titulo = models.CharField(max_length=100)
    tipo = models.CharField(max_length=20, choices=TIPO_CHOICES)
    descricao = models.TextField()
    data = models.DateField()
    hora = models.TimeField()
    local = models.CharField(max_length=150)
    link_externo = models.URLField(blank=True, null=True)
    organizador_nome = models.CharField(max_length=100)
    organizador_email = models.EmailField()
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
