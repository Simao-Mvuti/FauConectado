from django.contrib import admin
from .models import Materia

@admin.register(Materia)
class MateriaAdmin(admin.ModelAdmin):
    list_display = ("titulo","aprovado")
    list_filter = ("aprovado",)
    search_fields = ("titulo",)
    ordering = ("aprovado", "titulo")
    list_editable = ("aprovado",)
    readonly_fields = ("criado_em",)
