from django.core.validators import MaxValueValidator, MinValueValidator
from django.db import models


class Avaliacao(models.Model):
    ALVO_CHOICES = [
        ("MATERIAL", "Material"),
        ("MENTOR", "Mentor"),
    ]

    alvo_tipo = models.CharField(max_length=10, choices=ALVO_CHOICES)
    alvo_id = models.PositiveIntegerField()
    nota = models.IntegerField(
        validators=[MinValueValidator(1), MaxValueValidator(5)]
    )
    comentario = models.TextField(blank=True, null=True)
    autor_nome = models.CharField(max_length=100, blank=True, null=True)
    autor_email = models.EmailField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"Nota {self.nota} para {self.alvo_tipo} ({self.alvo_id})"
