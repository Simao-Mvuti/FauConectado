from django.db import models
from django.conf import settings
from django.core.validators import FileExtensionValidator, MaxValueValidator, MinValueValidator

class Materia(models.Model):
    autor = models.ForeignKey(settings.AUTH_USER_MODEL, on_delete=models.CASCADE, related_name="materiais")
    titulo = models.CharField(max_length=30)
    descricao = models.TextField(blank=True)
    ano = models.PositiveSmallIntegerField(validators=[MinValueValidator(1), MaxValueValidator(5)])
    semestre = models.PositiveSmallIntegerField(validators=[MinValueValidator(1), MaxValueValidator(2)])
    aprovado = models.BooleanField(default=True)
    ficheiro = models.FileField(upload_to="materias/", validators=[FileExtensionValidator(["pdf", "docx", "txt", "png", "jpeg", "jpg"])])
    votos = models.IntegerField(default=0)  # Alterado para Integer para contagem inteira de votos
    criado_em = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return self.titulo


class VotoMateria(models.Model):
    utilizador = models.ForeignKey(settings.AUTH_USER_MODEL, on_delete=models.CASCADE, related_name="votos_dados")
    materia = models.ForeignKey(Materia, on_delete=models.CASCADE, related_name="votos_recebidos")
    criado_em = models.DateTimeField(auto_now_add=True)

    class Meta:
        unique_together = ('utilizador', 'materia')

    def __str__(self):
        return f"{self.utilizador.username} votou em {self.materia.titulo}"