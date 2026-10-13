from django.db import models

class Materia(models.Model):
    ESTADOS = [
        ("PENDENTE","Pendente"),
        ("APROVADO","Aprovado"),
        ("REJEITADO","Rejeitado")
        ]

    TIPOS = [
        {"EXAME","Exame"},
        {"RESUMO","Resumo"},
        {"TESTE","Teste"}
    ]

    ANOS = [(i, f"{i}º Ano") for i in range(1, 6)]
    SEMESTRES = [(1, "1º Semestre"),(2, "2º Semestre"),]


    titulo = models.CharField(max_length=30)
    descricao = models.TextField(blank=True)
    ano = models.PositiveSmallIntegerField(choices=ANOS)
    semestre = models.PositiveSmallIntegerField(choices=SEMESTRES)
    estado = models.CharField(max_length=10,choices=ESTADOS,default="APROVADO")
    tipo = models.CharField(max_length=10,choices=TIPOS,default="EXAME")
    ficheiro = models.FileField(upload_to="materias/")
    votos = models.FloatField(default=0.0)
    criado_em = models.DateTimeField(auto_now_add=True)

