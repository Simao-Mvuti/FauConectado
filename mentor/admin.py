from django.contrib import admin
from .models import Mentor

@admin.register(Mentor)
class MateriaAdmin(admin.ModelAdmin):
    list_display = ("nome","sexo")
    list_filter = ("sexo",)
    search_fields = ("nome",)
    ordering = ("nome", "sexo")
    readonly_fields = ("criado_em",)
