from django.apps import AppConfig


class UserProfilesConfig(AppConfig):
    name = 'users'
    verbose_name = 'Профили'

    def ready(self):
        pass