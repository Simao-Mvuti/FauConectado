from django.contrib.auth.mixins import LoginRequiredMixin
from django.urls import reverse_lazy
from django.views.generic import CreateView
from django.contrib.auth import login
from materia.models import Materia
from materia.form import MateriaForm  
from .forms import RegistoForm
from django.contrib.auth.tokens import default_token_generator
from django.utils.http import urlsafe_base64_encode
from django.utils.encoding import force_bytes
from django.core.mail import send_mail
from django.urls import reverse
from django.shortcuts import redirect
from .models import Utilizador
from django.contrib.auth.models import User
from django.utils.http import urlsafe_base64_decode
from django.views import View
from django.contrib import messages
from django.contrib.auth import get_user_model

User = get_user_model()


class DashboardView(LoginRequiredMixin, CreateView):
    model = Materia
    form_class = MateriaForm 
    template_name = "registration/dashboard.html"
    success_url = reverse_lazy("dashboard") 

    def form_valid(self, form):
        form.instance.autor = self.request.user
        return super().form_valid(form)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        utilizador = self.request.user
        materiais = Materia.objects.filter(autor=utilizador).order_by('-id')
        
        context['materiais'] = materiais
        context['total_materiais'] = materiais.count()
        context['materiais_aprovados'] = materiais.filter(aprovado=True).count()
        context['materiais_pendentes'] = materiais.filter(aprovado=True).count()

        return context
    

class RegistoView(CreateView):
    model = Utilizador
    form_class = RegistoForm
    template_name = 'registration/registro.html'
    success_url = reverse_lazy('login') # Redireciona para o login com aviso

    def form_valid(self, form):
        # 1. Cria o utilizador mas deixa-o INATIVO até confirmar o email
        user = form.save(commit=False)
        user.is_active = False 
        user.save()

        # 2. Gera o token e o UID para a recuperação/ativação segura
        token = default_token_generator.make_token(user)
        uid = urlsafe_base64_encode(force_bytes(user.pk))

        # 3. Cria o link de ativação (ex: http://127.0.0.1:8000/ativar/UID/TOKEN/)
        link_ativacao = self.request.build_absolute_uri(
            reverse('ativar_conta', kwargs={'uidb64': uid, 'token': token})
        )

        # 4. Envia o email
        assunto = 'Confirme a sua conta no FauConectado'
        mensagem = f'Olá, {user.username}!\n\nPor favor, clique no link abaixo para ativar a sua conta no FauConectado:\n{link_ativacao}\n\nSe não solicitou isto, ignore esta mensagem.'
        
        send_mail(
            assunto, 
            mensagem, 
            'no-reply@fauconectado.ao', 
            [user.email], 
            fail_silently=False
        )

        # Mensagem de sucesso para o utilizador
        messages.success(self.request, 'Registo efetuado com sucesso! Verifique o seu email para ativar a conta antes de entrar.')
        return redirect(self.success_url)


class AtivarContaView(View):
    def get(self, request, uidb64, token):
        try:
            uid = urlsafe_base64_decode(uidb64).decode()
            user = User.objects.get(pk=uid)
        except (TypeError, ValueError, OverflowError, User.DoesNotExist):
            user = None

        if user is not None and default_token_generator.check_token(user, token):
            user.is_active = True
            user.save()
            messages.success(request, 'Conta ativada com sucesso! Já pode iniciar sessão.')
            return redirect('login')
        else:
            messages.error(request, 'O link de ativação é inválido ou já expirou.')
            return redirect('login')