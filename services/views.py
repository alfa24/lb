from django.shortcuts import render
import requests


def search_result(request):
    return render(request, template_name='services/search_results.html')


def professional(request):
    return render(request, template_name='services/professional.html')
