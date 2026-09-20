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
        Cadeira,
        on_delete=models.CASCADE,
        related_name="materiais"
    )

    titulo = models.CharField(max_length=200)
    ficheiro = models.FileField(upload_to="materiais/",blank=True,null=True,)
    descricao = models.TextField(blank=True)
    estado = models.CharField(
        max_length=10,
        choices=ESTADO_CHOICES,
        default="PENDENTE"
    )

    avaliacao_media = models.FloatField(default=0.0)
    created_at = models.DateTimeField(auto_now_add=True)

    objects = models.Manager()
    publicos = ApprovedManager()

    def __str__(self):
        return self.titulo