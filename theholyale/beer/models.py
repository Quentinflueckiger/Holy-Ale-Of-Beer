from django.db import models

# Create your models here.
class Brand(models.Model):
	name = models.CharField(max_length=100)
	url = models.URLField(max_length=200, blank=True)
	def __unicode__(self):
		return self.name

class Beer(models.Model):
	name = models.CharField(max_length=100)
	url = models.URLField(max_length=200, blank=True)
	brand = models.ForeignKey(Brand)
	def __unicode__(self):
		return self.brand.name  +" "+  self.name
	
class Rating(models.Model):
	beer = models.ForeignKey(Beer)
	rating = models.IntegerField(default=0) # ratings with value 0 will be ignored
	comment = models.CharField(max_length=300, blank=True)
	def __unicode__(self):
		return self.beer.__unicode__() + " %i* " % (self.rating)