from pathlib import Path
import environ

BASE_DIR = Path(__file__).resolve().parent.parent


env = environ.Env(
    ALLOWED_HOSTS=(list, ["127.0.0.1", "localhost"]),
    LANGUAGE_CODE = (str,"pt-pt"),
    TIME_ZONE = (str,"UTC"),
    USE_I18N = (str,True),
    USE_TZ = (bool,True),
    STATIC_URL = (str,"static/")
)

environ.Env.read_env(BASE_DIR / '.env')

SECRET_KEY = env("SECRET_KEY")
DEBUG = env("DEBUG")
ALLOWED_HOSTS = env.list("ALLOWED_HOSTS")
# settings.py

# 1. Configura o Backend SMTP real do Gmail
EMAIL_BACKEND = env("EMAIL_BACKEND")

# 2. Configurações do Servidor SMTP
EMAIL_HOST = env("EMAIL_HOST")
EMAIL_PORT = env.int("EMAIL_PORT")
EMAIL_USE_TLS = env.bool("EMAIL_USE_TLS")

# 3. As tuas credenciais do Gmail
EMAIL_HOST_USER = env("EMAIL_HOST_USER")
EMAIL_HOST_PASSWORD = env("EMAIL_HOST_PASSWORD")

# 4. Remetente Padrão
DEFAULT_FROM_EMAIL = env("DEFAULT_FROM_EMAIL")

# Application definition

INSTALLED_APPS = [
    'django.contrib.admin',
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'tailwind',
    'theme',
    'django_browser_reload',
    'materia',
    'mentor',
    'apoiar',
    'conta',
]

TAILWIND_APP_NAME = 'theme'
INTERNAL_IPS = ["127.0.0.1"]

MIDDLEWARE = [
    'django.middleware.security.SecurityMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',
    'django.middleware.common.CommonMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',
    'django.contrib.auth.middleware.AuthenticationMiddleware',
    'django.contrib.messages.middleware.MessageMiddleware',
    'django.middleware.clickjacking.XFrameOptionsMiddleware',
    "django_browser_reload.middleware.BrowserReloadMiddleware",
]

ROOT_URLCONF = 'config.urls'

TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
                "config.context_processors.rodape_stats",
            ],
        },
    },
]

WSGI_APPLICATION = 'config.wsgi.application'


# Database
# https://docs.djangoproject.com/en/6.1/ref/settings/#databases

DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.sqlite3',
        'NAME': BASE_DIR / 'db.sqlite3',
    }
}


# Password validation
# https://docs.djangoproject.com/en/6.1/ref/settings/#auth-password-validators

AUTH_PASSWORD_VALIDATORS = [
    {
        'NAME': 'django.contrib.auth.password_validation.UserAttributeSimilarityValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.MinimumLengthValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.CommonPasswordValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.NumericPasswordValidator',
    },
]



LANGUAGE_CODE = env("LANGUAGE_CODE")
TIME_ZONE = env("TIME_ZONE", default="UTC")
USE_I18N = env("USE_I18N", default=True)
USE_TZ = env("USE_TZ", default=True)
STATIC_URL = env("STATIC_URL", default="static/")
STATIC_URL = 'static/'
STATIC_ROOT = BASE_DIR / 'staticfiles'

# Email
# https://docs.djangoproject.com/en/6.1/topics/email/#topic-email-configuration


AUTH_USER_MODEL = "conta.Utilizador"
LOGIN_REDIRECT_URL = "dashboard"
LOGOUT_REDIRECT_URL = "listar_materia"
LOGIN_URL = "login"
# Garante codificação correta para o envio de emails
DEFAULT_CHARSET = 'utf-8'