from django.shortcuts import render
from django.template import RequestContext, loader

def home(request):
	return render(request, 'home.html')

def shops(request):
	return render(request, 'shops.html')

def about(request):
	return render(request, 'about.html')

def blog(request):
	return render(request, 'blog.html')