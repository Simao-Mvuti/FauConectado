from django.urls import path, include
from .views import RegistroView,DashboardView

urlpatterns = [
    path("dashboard",DashboardView.as_view(),name="dashboard"),
    path("registro/", RegistroView.as_view(), name="registro"),
    path("", include("django.contrib.auth.urls")),  # login, logout, password_change...
]