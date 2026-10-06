from django.contrib import admin
from .models import Materia

@admin.register(Materia)
class MateriaAdmin(admin.ModelAdmin):
    list_display = ("titulo","estado")
    list_filter = ("estado",)
    search_fields = ("titulo",)
    ordering = ("estado", "titulo")
    list_editable = ("estado",)
    readonly_fields = ("criado_em",)
