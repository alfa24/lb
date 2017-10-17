from django.apps import AppConfig
from django.core.urlresolvers import reverse_lazy as _


class UserProfilesConfig(AppConfig):
    name = 'main.users'
    verbose_name = 'Профили'

    def ready(self):
        from main.users import signals