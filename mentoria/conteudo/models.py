from django.db import models


class Conteudo(models.Model):
    titulo = models.CharField(max_length=120)
    conteudo = models.TextField(verbose_name='Descrição')
    ficheiro = models.FileField(upload_to='conteudos/', blank=True, null=True)
    data = models.DateTimeField(auto_now_add=True)
    publicado = models.BooleanField(default=False)

    def delete(self, *args, **kwargs):
        ficheiro = self.ficheiro
        resultado = super().delete(*args, **kwargs)
        if ficheiro:
            ficheiro.delete(save=False)
        return resultado

    @property
    def media_avaliacao(self):
        avaliacao = self.avaliacoes.aggregate(media=models.Avg('pontuacao'))['media']
        return round(avaliacao or 0, 1)


class Avaliacao(models.Model):
    conteudo = models.ForeignKey(
        Conteudo, on_delete=models.CASCADE, related_name='avaliacoes'
    )
    pontuacao = models.PositiveSmallIntegerField(choices=[(valor, valor) for valor in range(1, 6)])
    identificador_visitante = models.CharField(max_length=64)
    data = models.DateTimeField(auto_now_add=True)

    class Meta:
        constraints = [
            models.UniqueConstraint(
                fields=['conteudo', 'identificador_visitante'],
                name='uma_avaliacao_por_visitante',
            )
        ]


class Sugestao(models.Model):
    TIPO_CHOICES = [
        ('sugestao', 'Sugestão'),
        ('critica', 'Crítica'),
        ('elogio', 'Elogio'),
    ]

    tipo = models.CharField(max_length=20, choices=TIPO_CHOICES, default='sugestao')
    mensagem = models.TextField(max_length=1000)
    contacto = models.EmailField(blank=True)
    criada_em = models.DateTimeField(auto_now_add=True)
    lida = models.BooleanField(default=False)

    class Meta:
        ordering = ['-criada_em']


class CandidaturaMentor(models.Model):
    STATUS_CHOICES = [
        ('pendente', 'Pendente'),
        ('aprovada', 'Aprovada'),
        ('recusada', 'Recusada'),
    ]

    nome = models.CharField(max_length=120)
    email = models.EmailField()
    area = models.CharField(max_length=120)
    apresentacao = models.TextField(max_length=1200)
    status = models.CharField(max_length=20, choices=STATUS_CHOICES, default='pendente')
    criada_em = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ['nome']
