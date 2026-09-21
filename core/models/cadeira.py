from django.db import models


class Cadeira(models.Model):
    nome = models.CharField(max_length=30, unique=True)
    ano = models.IntegerField()
    semestre = models.IntegerField()
    descricao = models.TextField(blank=True)
    updated_at = models.DateTimeField(auto_now=True)
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return self.nome
