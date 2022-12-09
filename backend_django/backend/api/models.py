from django.db import models
from django.core.validators import MaxValueValidator, MinValueValidator
# Create your models here.
DATE_INPUT_FORMATS = ('%m/%d/%Y')


class DataEntry(models.Model):

    date = models.DateTimeField(null=False, blank=False)
    category = models.CharField(max_length=50, null=False, blank=False)
    lot_title = models.CharField(max_length=100, null=False, blank=False)
    lot_location = models.CharField(max_length=200, null=False, blank=False)
    lot_condition = models.CharField(max_length=200, null=False, blank=False)
    pre_tax_amount = models.FloatField(
        null=False, blank=False, validators=[MinValueValidator(0.0)])
    tax_name = models.CharField(max_length=200, blank=True)
    tax_amount = models.FloatField(
        null=True, blank=True)

    def __str__(self):
        return f"{self.date}, {self.category}, {self.lot_title}, {self.lot_location}, {self.lot_condition}, {self.pre_tax_amount}"
