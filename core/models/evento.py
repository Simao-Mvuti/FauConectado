from django.db import models


class Evento(models.Model):
    titulo = models.CharField(max_length=100)
    descricao = models.TextField()
    data = models.DateTimeField()
    local = models.CharField(max_length=150)
    created_at = models.DateTimeField(auto_now_add=True)

    objects = models.Manager()
  
    def __str__(self):
        return self.titulo
