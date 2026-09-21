from django import forms
from .models import Mentoria  
from core.models import Evento
from django import forms
from core.models import Evento
from django import forms

from .models import Material,Evento,Mentoria


from core.models import Cadeira, Material
from django import forms


class MaterialForm(forms.ModelForm):

  class Meta:
    model = Material
    fields = ['cadeira', 'ficheiro']
    widgets = {
        'cadeira': forms.Select(
            attrs={
                'id': 'cadeira',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-3'
                    ' py-3 font-normal outline-none focus:border-forest'
                ),
            }
        ),
        'ficheiro': forms.FileInput(
            attrs={
                'id': 'ficheiro',
                'class': (
                    'mt-2 block w-full rounded-xl border border-dashed'
                    ' border-ink/20 bg-paper px-3 py-3 text-xs font-normal'
                ),
            }
        ),
    }

  def __init__(self, *args, **kwargs):
    super().__init__(*args, **kwargs)
    # Adiciona a opção "Outra" ou permite gerir cadeiras dinamicamente se necessário
    # Nota: Se o campo 'cadeira' for uma ForeignKey, podes adicionar uma opção vazia personalizada:
    self.fields['cadeira'].empty_label = 'Selecionar cadeira'
    # Se quiseres adicionar manualmente a opção "Outra" a um ModelChoiceField,
    # podes optar por transformá-lo num ChoiceField ou tratar na view.


class MentoriaForm(forms.ModelForm):

  class Meta:
    model = Mentoria
    fields = ['nome', 'curso', 'ano', 'contacto_publico']
    widgets = {
        'nome': forms.TextInput(
            attrs={
                'id': 'mentor-nome',
                'placeholder': 'O teu nome completo',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
        'curso': forms.TextInput(
            attrs={
                'id': 'mentor-curso',
                'placeholder': 'Ex.: Engenharia Informática',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
        'ano': forms.NumberInput(
            attrs={
                'id': 'mentor-ano',
                'placeholder': 'Ex.: 3',
                'min': '1',
                'max': '6',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
        'contacto_publico': forms.TextInput(
            attrs={
                'id': 'mentor-contacto',
                'placeholder': 'Ex.: +244 9XX XXX XXX',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
    }




class EventoForm(forms.ModelForm):

  class Meta:
    model = Evento
    fields = ['titulo', 'local', 'data', 'descricao']
    widgets = {
        'titulo': forms.TextInput(
            attrs={
                'id': 'titulo',
                'placeholder': 'Ex.: Workshop de Maquetes e Modelação',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
        'local': forms.TextInput(
            attrs={
                'id': 'local',
                'placeholder': 'Ex.: Auditório A / Online',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
        'data': forms.DateInput(
            attrs={
                'id': 'data',
                'type': 'date',
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            },
            format='%Y-%m-%d',
        ),
        'descricao': forms.Textarea(
            attrs={
                'id': 'descricao',
                'rows': '3',
                'placeholder': (
                    'Descreve o objetivo do evento e o público-alvo...'
                ),
                'class': (
                    'mt-2 w-full rounded-xl border border-ink/10 bg-paper px-4'
                    ' py-3 text-sm font-normal text-ink outline-none transition'
                    ' focus:border-forest'
                ),
            }
        ),
    }


