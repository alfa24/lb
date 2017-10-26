from django.shortcuts import render
import requests

def index(request):
    return render(request, template_name='main/index.html')