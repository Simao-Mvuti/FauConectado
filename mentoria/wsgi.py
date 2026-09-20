import os
import sys

# Adiciona a pasta do projeto ao caminho do Python
sys.path.insert(0, os.path.dirname(__file__))

# Aponta para a tua pasta 'mentoria'
os.environ['DJANGO_SETTINGS_MODULE'] = 'mentoria.settings'

# Carrega a aplicação Django de forma segura
from django.core.wsgi import get_wsgi_application
application = get_wsgi_application()