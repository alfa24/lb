from django.shortcuts import render
# import requests
from users.models import ProfileCompany
from services.models import Service
from livebooking import settings


def search_result(request):
    setting = settings
    search_type = setting.PROFESSIONALS
    search_types = settings.search_types
    search_text = ''

    if request.GET:
        type_search = int(request.GET['search_type'])
        search_text = request.GET['search_text']

    if type_search == settings.PROFESSIONALS:
        items = ProfileCompany.objects.all()
    elif type_search == settings.SERVICES:
        items = Service.objects.all()

    return render(request, 'services/search_results.html', locals())


def professional(request):
    return render(request, template_name='services/professional.html')
