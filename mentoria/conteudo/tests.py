from django.core.files.uploadedfile import SimpleUploadedFile
from django.test import TestCase

from .models import Avaliacao, CandidaturaMentor, Conteudo, Sugestao


class ConteudoPublicoTests(TestCase):
	def test_visitante_pode_publicar_conteudo(self):
		response = self.client.post('/criar-conteudo', {
			'titulo': 'Django para iniciantes',
			'descricao': 'Material introdutório.',
			'ficheiro': SimpleUploadedFile('guia.txt', b'conteudo'),
		})

		self.assertRedirects(response, '/')
		conteudo = Conteudo.objects.get(titulo='Django para iniciantes')
		self.assertFalse(conteudo.publicado)
		self.assertNotContains(self.client.get('/'), 'Django para iniciantes')

		conteudo.publicado = True
		conteudo.save(update_fields=['publicado'])
		self.assertContains(self.client.get('/'), 'Django para iniciantes')

	def test_visitante_pode_avaliar_apenas_uma_vez(self):
		conteudo = Conteudo.objects.create(titulo='Teste', conteudo='Texto', publicado=True)

		self.client.post(f'/conteudo/{conteudo.id}/avaliar', {'pontuacao': 5})
		self.client.post(f'/conteudo/{conteudo.id}/avaliar', {'pontuacao': 1})

		self.assertEqual(Avaliacao.objects.filter(conteudo=conteudo).count(), 1)
		self.assertEqual(Avaliacao.objects.get(conteudo=conteudo).pontuacao, 5)

	def test_visitante_pode_baixar_ficheiro(self):
		conteudo = Conteudo.objects.create(
			titulo='Guia', conteudo='Texto',
			ficheiro=SimpleUploadedFile('guia.txt', b'conteudo'),
			publicado=True,
		)

		response = self.client.get(f'/conteudo/{conteudo.id}/baixar')

		self.assertEqual(response.status_code, 200)
		self.assertTrue(response['Content-Disposition'].startswith('attachment; filename="guia'))
		self.assertTrue(response['Content-Disposition'].endswith('.txt"'))

	def test_visitante_pode_enviar_sugestao(self):
		response = self.client.post('/feedback', {
			'tipo': 'critica',
			'mensagem': 'A pesquisa podia ser mais rápida.',
		})

		self.assertRedirects(response, '/#feedback')
		self.assertEqual(Sugestao.objects.get().tipo, 'critica')

	def test_feedback_invalido_nao_e_guardado(self):
		self.client.post('/feedback', {'tipo': 'spam', 'mensagem': 'Mensagem'})

		self.assertFalse(Sugestao.objects.exists())

	def test_email_invalido_nao_cria_candidatura(self):
		self.client.post('/candidatura-mentor', {
			'nome': 'Ana Silva', 'email': 'email-invalido',
			'area': 'História', 'apresentacao': 'Posso ajudar estudantes.',
		})

		self.assertFalse(CandidaturaMentor.objects.exists())

	def test_candidatura_pendente_nao_aparece_na_lista_publica(self):
		self.client.post('/candidatura-mentor', {
			'nome': 'Ana Silva', 'email': 'ana@example.com',
			'area': 'História', 'apresentacao': 'Posso ajudar estudantes.',
		})
		response = self.client.get('/')

		self.assertEqual(CandidaturaMentor.objects.get().status, 'pendente')
		self.assertNotContains(response, 'Ana Silva')

	def test_mentor_aprovado_aparece_na_lista_publica(self):
		CandidaturaMentor.objects.create(
			nome='Bruno Costa', email='bruno@example.com', area='Matemática',
			apresentacao='Posso explicar matemática.', status='aprovada',
		)

		response = self.client.get('/')

		self.assertContains(response, 'Bruno Costa')
		self.assertContains(response, 'Matemática')

	def test_mentor_recusado_deixa_de_aparecer(self):
		mentor = CandidaturaMentor.objects.create(
			nome='Carla Lima', email='carla@example.com', area='Design',
			apresentacao='Posso ajudar.', status='aprovada',
		)
		self.assertContains(self.client.get('/'), 'Carla Lima')

		mentor.status = 'recusada'
		mentor.save(update_fields=['status'])

		self.assertNotContains(self.client.get('/'), 'Carla Lima')
