from django.test import TestCase

from django.test import TestCase
from django.urls import reverse
from django.contrib.auth import get_user_model

User = get_user_model()

class AuthTest(TestCase):
    def test_paginas_abrem(self):
        for nome in ["login", "registro"]:
            with self.subTest(nome):
                self.assertEqual(self.client.get(reverse(nome)).status_code, 200)

    def test_registro_cria_utilizador_e_faz_login(self):
        resp = self.client.post(reverse("registro"), {
            "username": "ana",
            "password1": "Senha-forte-9271",
            "password2": "Senha-forte-9271",
        })
        self.assertEqual(resp.status_code, 302)
        self.assertTrue(User.objects.filter(username="ana").exists())
        self.assertIn("_auth_user_id", self.client.session)   # está autenticado

    def test_registro_passwords_diferentes(self):
        resp = self.client.post(reverse("registro"), {
            "username": "ana", "password1": "Senha-forte-9271", "password2": "outra",
        })
        self.assertEqual(resp.status_code, 200)
        self.assertEqual(User.objects.count(), 0)

    def test_login_e_logout(self):
        User.objects.create_user("ana", password="Senha-forte-9271")
        resp = self.client.post(reverse("login"), {"username": "ana", "password": "Senha-forte-9271"})
        self.assertEqual(resp.status_code, 302)
        self.client.post(reverse("logout"))
        self.assertNotIn("_auth_user_id", self.client.session)

    def test_enviar_materia_exige_login(self):
        resp = self.client.get(reverse("enviar_materia"))
        self.assertEqual(resp.status_code, 302)
        self.assertIn("login", resp.url)