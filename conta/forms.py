# conta/forms.py
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth import get_user_model

class RegistoForm(UserCreationForm):
    class Meta(UserCreationForm.Meta):
        model = get_user_model()
        fields = ("username", "email")