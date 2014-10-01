from django.shortcuts import render
from django.http import HttpResponse

# Create your views here.
def index(request):
	return HttpResponse("Index of Beer")
def detail(request, beer_id):
	return HttpResponse("You're looking at beer #" + beer_id)