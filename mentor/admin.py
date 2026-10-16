from django.contrib import admin
from .models import Mentor

@admin.register(Mentor)
class MateriaAdmin(admin.ModelAdmin):
    list_display = ("nome",)
    search_fields = ("nome",)
    ordering = ("nome",)
    readonly_fields = ("criado_em",)
