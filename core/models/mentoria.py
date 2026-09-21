from django.db import models

class Mentoria(models.Model):
    nome = models.CharField(max_length=100)
    curso = models.CharField(max_length=100)
    ano = models.IntegerField()
    contacto_publico = models.CharField(max_length=50)
    avaliacao_media = models.FloatField(default=0.0)
    total_avaliacoes = models.IntegerField(default=0)
    created_at = models.DateTimeField(auto_now_add=True)
    objects = models.Manager()
  

    def __str__(self):
        return self.nome
