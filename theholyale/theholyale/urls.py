from django.conf.urls import patterns, include, url

from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    # Examples:
    # url(r'^blog/', include('blog.urls')),
	url(r'^beer/', include('beer.urls')),

#	static pages (for the moment)
	url(r'^$', 'theholyale.views.home', name='home'),
	url(r'^blog$', 'theholyale.views.blog', name='blog'),
	url(r'^shops$', 'theholyale.views.shops', name='shops'),
	url(r'^about$', 'theholyale.views.about', name='about'),

					   
    url(r'^admin/', include(admin.site.urls)),
)
