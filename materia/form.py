from pathlib import Path
from django import forms
from django.core.exceptions import ValidationError
from .models import Materia

class MateriaForm(forms.ModelForm):
    class Meta:
        model = Materia
        fields = ["titulo","ano","semestre","ficheiro"]

    def clean_ficheiro(self):
        ficheiro = self.cleaned_data.get("ficheiro")
        if ficheiro:
            limite_mb = 15
            if ficheiro.size > limite_mb * 1024 * 1024:
                raise ValidationError(f"O tamanho do ficheiro não pode exceder {limite_mb}MB.")

    
            extensao = Path(ficheiro.name).suffix.lower()
            extensoes_permitidas = {".pdf", ".docx", ".txt", ".png", ".jpeg"}

            if extensao not in extensoes_permitidas:
                raise ValidationError(f"Extensão de ficheiro não suportada. As extensões permitidas são: {', '.join(extensoes_permitidas)}")
        return ficheiro