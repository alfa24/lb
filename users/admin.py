from django.contrib import admin

# Register your models here.
from django import forms

from .models import UserProfile, ProfileCompany, ProfileClient


class UserProfileClientInline(admin.StackedInline):
    model = ProfileClient
    readonly_fields = []
    verbose_name = 'ID клиента'
    verbose_name_plural = 'Профиль клиента'


class UserProfileCompanyInline(admin.StackedInline):
    model = ProfileCompany
    readonly_fields = ['rating', 'feedback_nmb']
    verbose_name = 'ID компании'
    verbose_name_plural = 'Профиль компании'


class UserProfileAdmin(admin.ModelAdmin):
    verbose_name_plural = 'Пользователи и группы'
    inlines = []
    # readonly_fields = ['type']

    def change_view(self, request, object_id, form_url='', extra_context=None):
        if object_id:
            obj = self.model.objects.get(id=int(object_id))
            if obj.type == 'company':
                self.inlines = [UserProfileCompanyInline]
            elif obj.type == 'client':
                self.inlines = [UserProfileClientInline]

        return super().change_view(request, object_id, form_url, extra_context)


admin.site.register(UserProfile, UserProfileAdmin)
admin.site.register(ProfileCompany)
admin.site.register(ProfileClient)
