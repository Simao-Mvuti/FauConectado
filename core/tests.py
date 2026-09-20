from datetime import date, time
import re

from django.core.exceptions import ValidationError
from django.urls import reverse
from django.test import TestCase

from .models import Avaliacao, Cadeira, Evento, Material, Mentor


class CadeiraModelTests(TestCase):
	def test_str_returns_name(self):
		cadeira = Cadeira.objects.create(nome="Programação I", ano=1, semestre=2)

		self.assertEqual(str(cadeira), "Programação I")




class ApprovedManagerTests(TestCase):
	def setUp(self):
		self.cadeira = Cadeira.objects.create(
			nome="Bases de Dados I", ano=2, semestre=1
		)

	def test_public_manager_returns_only_approved_materials(self):
		aprovado = Material.objects.create(
			cadeira=self.cadeira,
			titulo="Resumo aprovado",
			tipo="RESUMO",
			extensao="PDF",
			autor_nome="Estudante",
			estado="APROVADO",
		)
		Material.objects.create(
			cadeira=self.cadeira,
			titulo="Resumo pendente",
			tipo="RESUMO",
			extensao="PDF",
			autor_nome="Estudante",
			estado="PENDENTE",
		)

		self.assertQuerySetEqual(Material.publicos.all(), [aprovado], ordered=False)

	def test_public_manager_returns_only_approved_mentors_and_events(self):
		mentor = Mentor.objects.create(
			nome="Mentor aprovado",
			email="mentor@example.com",
			curso="Informática",
			ano=5,
			area="PROGRAMACAO",
			descricao="Ajuda em programação.",
			requisitos="Programação III.",
			dias_disponiveis="Sábado",
			contacto_publico="mentor@example.com",
			estado="APROVADO",
		)
		Evento.objects.create(
			titulo="Workshop aprovado",
			tipo="WORKSHOP",
			descricao="Workshop de programação.",
			data=date(2026, 10, 1),
			hora=time(17, 0),
			local="Auditório",
			organizador_nome="Equipa",
			organizador_email="equipa@example.com",
			estado="APROVADO",
		)
		Mentor.objects.create(
			nome="Mentor pendente",
			email="pendente@example.com",
			curso="Informática",
			ano=4,
			area="REDES",
			descricao="Ajuda em redes.",
			requisitos="Redes I.",
			dias_disponiveis="Domingo",
			contacto_publico="pendente@example.com",
			estado="PENDENTE",
		)

		self.assertEqual(list(Mentor.publicos.all()), [mentor])
		self.assertEqual(Evento.publicos.count(), 1)


class AvaliacaoModelTests(TestCase):
	def test_nota_must_be_between_one_and_five(self):
		avaliacao = Avaliacao(alvo_tipo="MENTOR", alvo_id=1, nota=6)

		with self.assertRaises(ValidationError):
			avaliacao.full_clean()


class PublicPageTests(TestCase):
	def setUp(self):
		self.cadeira_programacao = Cadeira.objects.create(
			nome="Programação I", ano=1, semestre=2, ativo=True
		)
		self.cadeira_matematica = Cadeira.objects.create(
			nome="Análise Matemática I", ano=1, semestre=1, ativo=True
		)
		self.material_programacao = Material.objects.create(
			cadeira=self.cadeira_programacao,
			titulo="Guia de programação",
			tipo="GUIA",
			extensao="PDF",
			autor_nome="Autor",
			estado="APROVADO",
			avaliacao_media=4.8,
		)
		Material.objects.create(
			cadeira=self.cadeira_matematica,
			titulo="Resumo de análise",
			tipo="RESUMO",
			extensao="PDF",
			autor_nome="Autor",
			estado="PENDENTE",
		)
		self.mentor = Mentor.objects.create(
			nome="Mentor de programação",
			email="mentor@example.com",
			curso="Informática",
			ano=5,
			area="PROGRAMACAO",
			descricao="Ajuda em programação.",
			requisitos="Programação I.",
			dias_disponiveis="Sábado",
			contacto_publico="mentor@example.com",
			estado="APROVADO",
			avaliacao_media=4.9,
		)
		Mentor.objects.create(
			nome="Mentor de redes",
			email="redes@example.com",
			curso="Informática",
			ano=4,
			area="REDES",
			descricao="Ajuda em redes.",
			requisitos="Redes I.",
			dias_disponiveis="Domingo",
			contacto_publico="redes@example.com",
			estado="PENDENTE",
		)

	def test_all_public_pages_are_available(self):
		page_names = ["home", "materias", "mentores", "cadeiras", "eventos", "contacto"]

		for page_name in page_names:
			with self.subTest(page=page_name):
				response = self.client.get(reverse(page_name))
				self.assertEqual(response.status_code, 200)

	def test_materials_page_shows_only_approved_materials(self):
		response = self.client.get(reverse("materias"))

		self.assertContains(response, self.material_programacao.titulo)
		self.assertNotContains(response, "Resumo de análise")

	def test_materials_page_filters_by_search_year_and_semester(self):
		response = self.client.get(
			reverse("materias"),
			{"q": "programação", "ano": "1", "semestre": "2"},
		)

		self.assertContains(response, self.material_programacao.titulo)
		self.assertNotContains(response, "Resumo de análise")

	def test_mentors_page_shows_only_approved_mentors(self):
		response = self.client.get(reverse("mentores"))

		self.assertContains(response, self.mentor.nome)
		self.assertNotContains(response, "Mentor de redes")

	def test_mentors_page_filters_by_area_and_name_order(self):
		response = self.client.get(
			reverse("mentores"),
			{"area": "PROGRAMACAO", "ordenar": "nome"},
		)

		self.assertContains(response, self.mentor.nome)
		self.assertNotContains(response, "Mentor de redes")

	def test_empty_public_catalogues_render_successfully(self):
		Material.objects.all().delete()
		Mentor.objects.all().delete()

		self.assertEqual(self.client.get(reverse("materias")).status_code, 200)
		self.assertEqual(self.client.get(reverse("mentores")).status_code, 200)
		self.assertContains(
			self.client.get(reverse("mentores")),
			"Ainda não existem mentores disponíveis",
		)

	def test_post_forms_include_csrf_token(self):
		protected_client = self.client_class(enforce_csrf_checks=True)
		response = protected_client.get(reverse("home"))

		self.assertContains(response, 'name="csrfmiddlewaretoken"', count=4)

		token = re.search(
			rb'name="csrfmiddlewaretoken" value="([^"]+)"', response.content
		).group(1).decode()
		post_response = protected_client.post(
			reverse("home"),
			{},
			HTTP_X_CSRFTOKEN=token,
		)

		self.assertNotEqual(post_response.status_code, 403)
