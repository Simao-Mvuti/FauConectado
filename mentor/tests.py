from django.test import TestCase
from django.core.exceptions import ValidationError
from .models import Mentor
from django.urls import reverse

class MentorModelTest(TestCase):
    def test_criar_mentor_com_dados_validos(self):
        nome,whatsaap,sexo = ("Simao Mvuti","244953835756","M")
        novo_mentor = Mentor.objects.create(nome=nome,whatsapp=whatsaap,sexo=sexo)
        self.assertEqual(novo_mentor.nome,nome)
        self.assertEqual(novo_mentor.whatsapp,whatsaap)
        self.assertEqual(novo_mentor.sexo,sexo)

    def test_criar_mentor_com_dados_invalidos(self):
        nome,whatsaap,sexo = ("","24495383575ndind92i2d6","S")
        novo_mentor = Mentor(nome=nome,whatsapp=whatsaap,sexo=sexo)

        with self.assertRaises(ValidationError) as ctx:
            novo_mentor.full_clean()

        erros = ctx.exception.message_dict
        self.assertIn("nome",erros)
        self.assertIn("whatsapp",erros)
        self.assertIn("sexo",erros)
    

class MentorViewTest(TestCase):
    def test_criar_mentor_valido(self):
        resp = self.client.post(reverse("criar_mentor"), {
            "nome": "Ana", "whatsapp": "923000000", "sexo": "F",
        })
        self.assertEqual(resp.status_code, 302)
        self.assertEqual(Mentor.objects.count(), 1)

    def test_whatsapp_errado(self):
        resp = self.client.post(reverse("criar_mentor"), {
            "nome": "Ana", "whatsapp": "9" * 22, "sexo": "F",
        })
        self.assertEqual(resp.status_code, 200)
        self.assertEqual(Mentor.objects.count(), 0)

    def test_busca_filtra_por_nome(self):
        Mentor.objects.create(nome="Ana", whatsapp="923", sexo="F")
        Mentor.objects.create(nome="Rui", whatsapp="924", sexo="M")
        resp = self.client.get(reverse("mentoria"), {"q": "ana"})
        self.assertEqual(len(resp.context["mentores"]), 1)