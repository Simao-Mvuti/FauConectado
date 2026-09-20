from django.contrib import admin

from .models import Avaliacao, Cadeira, Evento, Material, Mentoria


@admin.register(Cadeira)
class CadeiraAdmin(admin.ModelAdmin):
	list_display = ("nome", "ano", "semestre", "ativo", "updated_at")
	list_filter = ("ano", "semestre", "ativo")
	search_fields = ("nome",)


@admin.register(Material)
class MaterialAdmin(admin.ModelAdmin):
	list_display = ("titulo", "cadeira", "estado", "avaliacao_media", "created_at")
	list_filter = ("estado", "cadeira__ano", "cadeira__semestre")
	search_fields = ("titulo", "autor_nome", "autor_email", "cadeira__nome")
	list_select_related = ("cadeira",)


@admin.register(Mentoria)
class MentorAdmin(admin.ModelAdmin):
	list_display = ("nome", "curso", "ano", "estado", "avaliacao_media")
	list_filter = ("estado",  "ano")
	search_fields = ("nome", "curso", "contacto_publico")


@admin.register(Evento)
class EventoAdmin(admin.ModelAdmin):
	list_display = ("titulo", "data",  "estado")
	list_filter = ("estado",  "data")
	search_fields = ("titulo", "descricao")
	date_hierarchy = "data"


@admin.register(Avaliacao)
class AvaliacaoAdmin(admin.ModelAdmin):
	list_display = ("alvo_tipo", "alvo_id", "nota", "autor_nome", "created_at")
	list_filter = ("alvo_tipo", "nota", "created_at")
	search_fields = ("autor_nome", "autor_email", "comentario")
