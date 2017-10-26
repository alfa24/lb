from django.db import models
from users.models import ProfileCompany


# Категория услуги
class ServiceCategory(models.Model):
    name = models.CharField(verbose_name="Название", max_length=50, blank=True, null=True, default=None)
    description = models.TextField(verbose_name="Описание", blank=True, null=True, default=None)
    on_home_page = models.BooleanField(verbose_name="На главной", default=True)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.name

    class Meta:
        verbose_name = "Категория услуги"
        verbose_name_plural = 'Категории услуг'


# Услуга
class Service(models.Model):
    name = models.CharField(verbose_name="Название", max_length=50, blank=True, null=True, default=None)
    description = models.TextField(verbose_name="Описание", blank=True, null=True, default=None)
    category = models.ForeignKey(ServiceCategory)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.name

    class Meta:
        verbose_name = "Услуга"
        verbose_name_plural = 'Услуги'


# Связываем профессионалов и услуги, которые они предоставляют
class ServiceProfessional(models.Model):
    professional = models.ForeignKey(ProfileCompany, null=False)
    service = models.ForeignKey(Service, null=False)
    duration_hours = models.DecimalField(verbose_name='Продолжительность (ч.)', max_digits=3, decimal_places=1,
                                         blank=True, null=True, default=None)
    price = models.DecimalField(verbose_name='Стоимость (руб.)', max_digits=10, decimal_places=2, blank=True, null=True,
                                default=None)
    description = models.TextField(verbose_name="Описание", blank=True, null=True, default=None)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.professional, self.service

    class Meta:
        verbose_name = "Услуга профессионала"
        verbose_name_plural = 'Услуги профессионалов'
