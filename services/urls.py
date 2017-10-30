from django.conf.urls import url

from . import views

app_name = 'services'
urlpatterns = [
    url(r"^search/$", views.search_result, name="search_result"),
    url(r"^professional/$", views.professional, name="professional"),
]
