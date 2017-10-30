from django.shortcuts import render
# import requests
from users.models import ProfileCompany


def search_result(request):
    search_text = ''

    if request.GET:
        search_text = request.GET['search_text']

    items = ProfileCompany.objects.all()

    return render(request, 'services/search_results.html', locals())


def professional(request):
    return render(request, template_name='services/professional.html')
