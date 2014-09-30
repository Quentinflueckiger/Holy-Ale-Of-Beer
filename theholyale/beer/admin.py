from django.contrib import admin
from beer.models import Beer
from beer.models import Brand, Rating

# Register your models here.
admin.site.register(Beer)
admin.site.register(Brand)
admin.site.register(Rating)