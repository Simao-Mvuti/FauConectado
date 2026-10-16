from django.db import models

from django.contrib.auth.models import AbstractUser

class Utilizador(AbstractUser):
    whatsapp = models.CharField(max_length=15, blank=True)
    sexo = models.CharField(max_length=10)
    