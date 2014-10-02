from django.shortcuts import render
from django.template import RequestContext, loader
from beer.models import Beer
from django.http import HttpResponse

# Create your views here.
def index(request):
	beer_list = Beer.objects.order_by('name')
	template = loader.get_template('beer/index.html')
	context = RequestContext(request, {'beer_list' : beer_list})
	return HttpResponse(template.render(context))


def detail(request, beer_id):
	return HttpResponse("You're looking at beer #" + beer_id)