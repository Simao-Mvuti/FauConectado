from django.contrib import admin
from .models import Avaliacao, CandidaturaMentor, Conteudo, Sugestao

admin.site.register(Avaliacao)


@admin.register(Conteudo)
class ConteudoAdmin(admin.ModelAdmin):
	list_display = ('titulo', 'data', 'publicado', 'ficheiro')
	list_filter = ('publicado', 'data')
	search_fields = ('titulo', 'conteudo')
	actions = ('aprovar_conteudos', 'ocultar_conteudos', 'delete_selected')

	@admin.action(description='Aprovar conteúdos selecionados')
	def aprovar_conteudos(self, request, queryset):
		atualizados = queryset.update(publicado=True)
		self.message_user(request, f'{atualizados} conteúdo(s) aprovado(s).')

	@admin.action(description='Ocultar conteúdos selecionados')
	def ocultar_conteudos(self, request, queryset):
		atualizados = queryset.update(publicado=False)
		self.message_user(request, f'{atualizados} conteúdo(s) ocultado(s).')


@admin.register(Sugestao)
class SugestaoAdmin(admin.ModelAdmin):
	list_display = ('tipo', 'mensagem_resumida', 'contacto', 'lida', 'criada_em')
	list_filter = ('tipo', 'lida')
	search_fields = ('mensagem', 'contacto')

	@admin.display(description='Mensagem')
	def mensagem_resumida(self, obj):
		return obj.mensagem[:70]


@admin.register(CandidaturaMentor)
class CandidaturaMentorAdmin(admin.ModelAdmin):
	list_display = ('nome', 'area', 'email', 'status', 'criada_em')
	list_filter = ('status', 'area')
	search_fields = ('nome', 'email', 'area')
	actions = ('aprovar_candidaturas', 'recusar_candidaturas', 'delete_selected')

	@admin.action(description='Aprovar candidaturas selecionadas')
	def aprovar_candidaturas(self, request, queryset):
		atualizados = queryset.update(status='aprovada')
		self.message_user(request, f'{atualizados} candidatura(s) aprovada(s).')

	@admin.action(description='Recusar candidaturas selecionadas')
	def recusar_candidaturas(self, request, queryset):
		atualizados = queryset.update(status='recusada')
		self.message_user(request, f'{atualizados} candidatura(s) recusada(s).')
