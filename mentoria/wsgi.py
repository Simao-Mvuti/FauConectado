import os
import sys

# Caminho para o diretório raiz onde está o manage.py
path = '/home/simaomvuti/fauconect'
if path not in sys.path:
    sys.path.append(path)

# Aponta para as configurações do app 'core'
os.environ['DJANGO_SETTINGS_MODULE'] = 'core.settings'

from django.core.wsgi import get_wsgi_application
application = get_wsgi_application()