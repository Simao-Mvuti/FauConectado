from django.urls import path, include
from .views import RegistoView,DashboardView,AtivarContaView

urlpatterns = [
    path("",DashboardView.as_view(),name="dashboard"),
    path("registro/", RegistoView.as_view(), name="registro"),
    path("", include("django.contrib.auth.urls")),  # login, logout, password_change...
    path('ativar/<str:uidb64>/<str:token>/', AtivarContaView.as_view(), name='ativar_conta'),
]