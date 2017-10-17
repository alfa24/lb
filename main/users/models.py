from django.contrib.auth.models import User
from django.db import models

PROFILE_TYPE = (('company', 'Company'), ('client', 'Client'))


class City(models.Model):
    name = models.CharField(verbose_name="Название", max_length=30, blank=True, null=True, default=None)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.name

    class Meta:
        verbose_name = "Город"
        verbose_name_plural = 'Города'


class District(models.Model):
    name = models.CharField(verbose_name="Название", max_length=30, blank=True, null=True, default=None)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.name

    class Meta:
        verbose_name = "Городской район"
        verbose_name_plural = 'Городские районы'


# Специальности
class Speciality(models.Model):
    name = models.CharField(verbose_name="Название", max_length=30, blank=True, null=True, default=None)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.name

    class Meta:
        verbose_name = "Специальность"
        verbose_name_plural = 'Специальности'


class UserProfile(models.Model):
    ''''
    Основной профиль пользователя, содержит обище поля для всех типов пользователей сайта
    '''
    user = models.OneToOneField(User, on_delete=models.CASCADE, related_name='profile')
    phone = models.PositiveIntegerField(verbose_name="Телефон", blank=True, null=True, default=None)
    type = models.CharField(verbose_name='Тип профиля', max_length=40, blank=True, choices=PROFILE_TYPE)
    is_active = models.BooleanField(verbose_name="Активный", default=True)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.user.username

    class Meta:
        verbose_name = "Профиль пользователя"
        verbose_name_plural = 'Профили пользователей'


# Профиль компании
class ProfileCompany(models.Model):
    user_profile = models.OneToOneField(UserProfile, on_delete=models.CASCADE, related_name='company', blank=True,
                                        null=True, default=None)
    address = models.CharField(verbose_name="Адрес", max_length=100, blank=True, null=True, default=None)
    city = models.ForeignKey(City, verbose_name="Город", blank=True, null=True, default=None)
    district = models.ForeignKey(District, verbose_name="Район", blank=True, null=True, default=None)
    speciality = models.ForeignKey(Speciality, verbose_name="Специальность", blank=True, null=True, default=None)
    rating = models.DecimalField(verbose_name="Рейтинг", max_digits=3, decimal_places=2, blank=True, null=True,
                                 default=None)
    feedback_nmb = models.IntegerField(verbose_name="Кол-во звезд", blank=True, null=True, default=None)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.user_profile.user.username

    class Meta:
        verbose_name = "Компания"
        verbose_name_plural = 'Компании'


# Профиль клиента (потребителя услуг)
class ProfileClient(models.Model):
    user_profile = models.OneToOneField(UserProfile, on_delete=models.CASCADE, related_name='client', blank=True,
                                        null=True, default=None)
    created = models.DateTimeField(verbose_name="Создан", auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(verbose_name="Изменен", auto_now_add=False, auto_now=True)

    def __str__(self):
        return "%s" % self.user_profile.user.username

    class Meta:
        verbose_name = "Клиент"
        verbose_name_plural = 'Клиенты'
