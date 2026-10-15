from django.test import TestCase
from django.core.exceptions import ValidationError
from django.test import TestCase, override_settings
from django.urls import reverse
from django.core.files.uploadedfile import SimpleUploadedFile
from django.contrib.auth.models import User
from .models import Materia
from .form import MateriaForm
import tempfile


class MateriaModelTest(TestCase):
    def test_criar_materia_com_dados_validos(self):
        titulo,descricao,ano,semestre,tipo,ficheiro = ("Aula 1","Primeira Aula",1,1,"RESUMO","aula.pdf")
        nova_materia = Materia.objects.create(titulo=titulo,descricao=descricao,ano=ano,semestre=semestre,tipo=tipo,ficheiro=ficheiro)

        self.assertEqual(nova_materia.titulo,titulo)
        self.assertEqual(nova_materia.descricao,descricao)
        self.assertEqual(nova_materia.ano,ano)
        self.assertEqual(nova_materia.tipo,tipo)
        self.assertEqual(nova_materia.ficheiro,ficheiro)
        self.assertEqual(nova_materia.votos,0.0)
        self.assertIsNotNone(nova_materia.criado_em)

 
    def test_materia_com_dados_invalidos(self):
        materia = Materia(        
            descricao="Primeira Aula",
            ano=12,
            semestre=6,
            tipo="RESUMO",
            ficheiro="aula.mp4",
        )
        with self.assertRaises(ValidationError) as ctx:
            materia.full_clean()

        erros = ctx.exception.message_dict
        self.assertIn("titulo", erros)     
        self.assertIn("ano", erros)       
        self.assertIn("ficheiro", erros)   
        self.assertIn("semestre",erros)
        

class MateriaFormTest(TestCase):
    def test_criar_materia_com_dados_validos(self):
        form = MateriaForm(
            data={
                "titulo": "P2",
                "descricao": "Segunda Prova Parcelar",
                "semestre": 1,
                "ano": 4,
            },
            files={
                "ficheiro": SimpleUploadedFile(
                    "aula.pdf", b"conteudo", content_type="application/pdf"
                ),
            },
        )
        self.assertTrue(form.is_valid(), form.errors)

    def test_form_vazio_e_invalido(self):
        form = MateriaForm(data={})
        self.assertFalse(form.is_valid())
        for campo in ["titulo", "ano", "semestre", "ficheiro"]:
            self.assertIn(campo, form.errors)
        self.assertNotIn("descricao", form.errors)  # opcional

    def test_extensao_nao_permitida(self):
        form = MateriaForm(
            data={"titulo": "V", "semestre": 1, "ano": 4},
            files={"ficheiro": SimpleUploadedFile("video.mp4", b"x", content_type="video/mp4")},
        )
        self.assertFalse(form.is_valid())
        self.assertIn("ficheiro", form.errors)



@override_settings(MEDIA_ROOT=tempfile.mkdtemp())
class MateriaViewTest(TestCase):
    def setUp(self):
        User.objects.create_user("ana", password="123")
        self.client.login(username="ana", password="123")

    def test_upload_valido_cria_materia(self):
        resposta = self.client.post(reverse("enviar_materia"), {
            "titulo": "P2",
            "descricao": "Segunda Prova Parcelar",
            "semestre": 1,
            "ano": 4,
            "ficheiro": SimpleUploadedFile(
                "aula.pdf", b"conteudo", content_type="application/pdf"
            ),
        })

        if resposta.context and "form" in resposta.context:
            print(resposta.context["form"].errors)  

        self.assertEqual(resposta.status_code, 302)
        self.assertEqual(Materia.objects.count(), 1)
        self.assertEqual(Materia.objects.first().titulo, "P2")