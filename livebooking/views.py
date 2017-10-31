from django.shortcuts import render
from services.models import ServiceCategory


def index(request):
    service_categories = ServiceCategory.objects.filter(on_home_page=True)[0:6]
    return render(request, 'main/index.html', locals())
