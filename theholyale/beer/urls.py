from django.conf.urls import patterns, url
from beer import views

urlpatterns = patterns('',
	url(r'^$', views.index, name='index'),
	url(r'^(?P<beer_id>[0-9]+)/$', views.detail, name='detail'),
    url(r'^(?P<beer_id>[0-9]+)/rate$', views.rate, name='rate'),
)