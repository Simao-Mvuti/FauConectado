from django.db import models

class Mentor(models.Model):
    SEXO_CHOICES = [
        ('M', 'Masculino'),
        ('F', 'Feminino'),
    ]

    nome = models.CharField(max_length=30)
    whatsapp = models.CharField(max_length=15, help_text="Exemplo: +2449XXXXXXXX",unique=True)
    aprovado = models.BooleanField(default=False)
    votos = models.FloatField(default=0.0)
    criado_em = models.DateTimeField(auto_now_add=True)
