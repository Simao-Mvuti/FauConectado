from django import forms
from .models import Material,Evento,Mentoria


class MaterialForm(forms.ModelForm):
    class Meta:
        model = Material
        fields = ["cadeira", "ficheiro"]
    def clean_ficheiro(self):
            ficheiro = self.cleaned_data["ficheiro"]
    
            if not ficheiro.name.lower().endswith(".pdf"):
                raise forms.ValidationError("Apenas ficheiros PDF são permitidos.")
    
            if ficheiro.size > 10 * 1024 * 1024:
                raise forms.ValidationError(
                    "O ficheiro não pode ultrapassar 10 MB."
                )
    
            return ficheiro


class MentoriaForm(forms.ModelForm):
    class Meta:
        model = Mentoria
        fields = [
            'nome',
            'curso',
            'ano',
            'descricao',
            'contacto_publico',
        ]

class EventoForm(forms.ModelForm):
       class Meta:
             model = Evento
             fields = [
                 'titulo',
                 'descricao',
                 'data',
                 'local'
             ]

              