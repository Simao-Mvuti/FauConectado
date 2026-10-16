from django.db import models
from django.conf import settings
from django.core.validators import FileExtensionValidator,MaxValueValidator,MinValueValidator

class Materia(models.Model):
    ESTADOS = [
        ("PENDENTE","Pendente"),
        ("APROVADO","Aprovado"),
        ("REJEITADO","Rejeitado")
        ]

    TIPOS = [
        ("EXAME","Exame"),
        ("RESUMO","Resumo"),
        ("TESTE","Teste")
    ]

    autor = models.ForeignKey(settings.AUTH_USER_MODEL,on_delete=models.CASCADE,null=True,blank=True,related_name="materiais")
    titulo = models.CharField(max_length=30)
    descricao = models.TextField(blank=True)
    ano = models.PositiveSmallIntegerField(validators=[MinValueValidator(1),MaxValueValidator(5)])
    semestre = models.PositiveSmallIntegerField(validators=[MinValueValidator(1),MaxValueValidator(2)])
    estado = models.CharField(max_length=10,choices=ESTADOS,default="APROVADO")
    tipo = models.CharField(max_length=10,choices=TIPOS,default="EXAME")
    ficheiro = models.FileField(upload_to="materias/",validators=[FileExtensionValidator(["pdf", "docx", "txt", "png", "jpeg","jpg"])])
    votos = models.FloatField(default=0.0)
    criado_em = models.DateTimeField(auto_now_add=True)

