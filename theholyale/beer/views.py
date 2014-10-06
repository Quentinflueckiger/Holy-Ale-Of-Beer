from django.shortcuts import render
from django.template import RequestContext, loader
from beer.models import Beer, Rating
from django.http import HttpResponse, Http404, HttpResponseRedirect
from django.shortcuts import render, get_object_or_404
from django.core.urlresolvers import reverse

# Create your views here.
def index(request):
	beer_list = Beer.objects.order_by('name')
	template = loader.get_template('beer/index.html')
	context = RequestContext(request, {'beer_list' : beer_list})
	return HttpResponse(template.render(context))


def detail(request, beer_id):
	try:
		beer = Beer.objects.get(pk=beer_id)
	except Beer.DoesNotExist:
			raise Http404
	return render(request, 'beer/detail.html', {'beer':beer})

def rate(request, beer_id):
	beer = get_object_or_404(Beer, pk=beer_id)
	try:
		r = request.POST['rating']
		c = request.POST['comment']
	except(KeyError):
		return render(request, 'beer/detail', {'beer':beer})
	else:
		Rating.objects.create(beer=Beer.objects.get(pk=beer_id), rating=int(r), comment=c)
		return HttpResponse("You're rating the beer with  %s stars" %  r)
