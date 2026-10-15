from django.urls import path
from .views import MentorCreateView,MentorListView

urlpatterns = [
    path('',MentorListView.as_view(),name="mentoria"),
    path('novo',MentorCreateView.as_view(),name="criar_mentor")
]
