from django.shortcuts import render
import requests
from livebooking import settings


def index(request):
    search_types = settings.search_types
    return render(request, 'main/index.html', locals())
