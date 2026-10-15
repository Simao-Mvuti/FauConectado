from django.db import models

class Mentor(models.Model):
    SEXO_CHOICES = [
        ('M', 'Masculino'),
        ('F', 'Feminino'),
    ]

    nome = models.CharField(max_length=30)
    whatsapp = models.CharField(max_length=15, help_text="Exemplo: +2449XXXXXXXX",unique=True)
    sexo = models.CharField(max_length=1, choices=SEXO_CHOICES)
    votos = models.FloatField(default=0.0)
    criado_em = models.DateTimeField(auto_now_add=True)
